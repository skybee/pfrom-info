<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


require_once './application/libraries/translate-stichoza/vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

class Stichoza_translate_self_lib{
    private $CI,
            $donorDbLangCode;
    
    public  $stichoza_translate_lib,
            $donorObj;
            
    
    function __construct($params) {
        $this->stichoza_translate_lib   = $params[0]; //$obj_Stichoza_translate_lib;
        $this->donorDbLangCode       = $params[1]; //LANG_CODE
        
        $this->CI =& get_instance();
//        $this->CI->load->database($dbConfig);
        $this->CI->load->model('Article_translate_self_m');
        
        $this->createDonorObj();
    }
    
    function getArticles($cnt=1,$langFor){
        $cnt = (int)$cnt;
        
        $artsAr = $this->CI->Article_translate_self_m->getDonorArtForLang($cnt,$langFor);
        
        if(is_array($artsAr)){ return $artsAr; }
        else{ return FALSE; }
    }
    
    function mergeLangCodeToLangName($langCodeAr){ //объединение langCode для перевода с соответствующими им языками
        $resultAr = array();
        foreach ($langCodeAr as $langCode){
            $langConf = $this->stichoza_translate_lib->getLangConf($langCode);
            $resultAr[$langConf['lang']][] = $langCode;
        }
        
        return $resultAr;
    }
    
    //------------------- private -------------------//
    
    private function createDonorObj(){
        $this->donorObj    = $this->stichoza_translate_lib->getAcceptorArticles($this->donorDbLangCode); //return Object of getAcceptorArticles;   
        
        if($this->donorObj->hasTranslateConf() !== TRUE){
            echo "\n\n-- NOTE: -- No Translate Configuration for Lang: ".LANG_CODE." --\n\n";
            return TRUE;
        }
    }
    
    //------------------- /private -------------------//
    
    
    function writeResultToDB(){
        return new writeResultToDB_self();
    }
}


class writeResultToDB_self{
    private $CI, 
            $acceptorLangCode, 
            $donorLangCode,
            $writeResultHelper; 
            
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('Article_translate_self_m');
        
        $this->writeResultHelper = new writeResultHelper();
    }
    
    function setAcceptorLangCode($langCode){
        $this->acceptorLangCode = $langCode;
//        echo "\n\n\t-- setAcceptorLangCode: {$langCode}\n";
    }
    function setDonorLangCode($langCode){
        $this->donorLangCode = $langCode;
//        echo "\n\n\t-- setDonorLangCode: {$langCode}\n";
    }
    
    function setTranslatedArticle($artId,$lang){
        $this->dbConnect($this->donorLangCode);
        return $this->CI->Article_translate_self_m->setTranslatedArticle($artId,$lang);
    }
    
    function insertTranslatedArt($title,$text,$donorData){
        $this->dbConnect($this->acceptorLangCode);
        
        $catID      = $this->writeResultHelper->determineCatId($title);
        $urlName    = $this->writeResultHelper->url_slug($title);
        $descript   = $this->writeResultHelper->getDescription($text);
        $donorID    = $this->writeResultHelper->getDonorId($donorData['canonical']);
        $text       = $this->writeResultHelper->addLikeMarker($text, 500);
        $text       = '<div data-parse-version="1" class="parse-version p-version-1">'.$text.'</div>';
        
        if( $this->writeResultHelper->checkDuplicate($title, $text, 10) ){
            return FALSE;
        }
        
        return $this->CI->Article_translate_self_m->insertTranslatedArt
                (
                    $catID,
                    $donorID,
                    $urlName,
                    $title,
                    $text,
                    $descript,
                    $donorData
                );
    }
    
    function dbClose(){ //закрытие соединения с БД
        if(isset($this->CI->db) && is_object($this->CI->db)){
            $this->CI->db->close();
        }
    }
    function dbConnect($langCode){
        $this->dbClose();
        $dbConfig = Stichoza_translate_lib::selectDBconfig($langCode);
        $this->CI->load->database($dbConfig);
    }
    
}

class writeResultHelper{
    
    private $shinglesObj;
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('Article_translate_self_m');
        $this->CI->load->model('Article_m');
        $this->CI->load->helper('parser/url_name2_helper');
        
        $this->shinglesObj = new shingles();
    }
    
    function determineCatId($title){
        $likeCatIDs = $this->CI->Article_translate_self_m->searchLikeCatIDs($title,20);
        
        $defaultCatID = 555; # default translate cat_id
        
        if($likeCatIDs == false){
            return $defaultCatID; 
        }
        
        $catIdRankAr = [];
        
        # обход и сложение ранков для категорий(cat_id)
        foreach($likeCatIDs as $idRank){
            
            if( isset($catIdRankAr[ $idRank['cat_id'] ]) ){
                $catIdRankAr[$idRank['cat_id']] = $catIdRankAr[$idRank['cat_id']] + round( $idRank['rank'], 2 );
            }
            else{
                $catIdRankAr[$idRank['cat_id']] =  round( $idRank['rank'], 2 );
            }
        }
        
        # сортировка по наибольшей сумме ранков
        arsort($catIdRankAr);
        # получение первого cat_id  с наибольшей суммой ранка
        $determineCatId = key($catIdRankAr);
        
        if($determineCatId == NULL){
            return $defaultCatID;
        }
        else{
            return $determineCatId;
        }
    }
    
    function url_slug($str){
        return url_slug($str, array('transliterate' => true));
    }
    
    function getDescription($text){
        $text   = strip_tags($text);
        $text   = Article_m::get_short_txt($text, 500, 'dot', '.');
        
        return $text;
    }
    
    function getDonorId($canonical){
        
        $donorUrlAr     = parse_url($canonical);
        
        if(!isset($donorUrlAr['host']) && empty($donorUrlAr['host'])){
            $donorUrlAr['host'] = 'pressfrom.com';
        }
        
        $donorData['host']  = trim($donorUrlAr['host']);
        $donorData['name']  = $donorData['host'];
        
        $donorMsnObj    = new donorMsn($donorData);
        $donorID        = $donorMsnObj->getId();
        
        unset($donorMsnObj);
        return $donorID;
    }
    
    function addLikeMarker($htmlTxt, $afterCntSimbol = 500){
        $startAfterCntSimbol = $afterCntSimbol;
        $marker     = '<!--likeMarker-->'; //"\n".'<h1>likeMarker</h1>'."\n";
        $tmpHtml    = $htmlTxt;
        $pArr       = explode('</p>', $tmpHtml);
        
        if(count($pArr)<1){ return $htmlTxt; /*######*/ }
        
        $cntSimbol = 0;
        foreach($pArr as $pStr)
        {
            $pStr .= '</p>';
            $pLenth = $this->txtLenth($pStr);
            
            $cntSimbol = $cntSimbol + $pLenth;
            
            if($cntSimbol >= $afterCntSimbol){
                $afterCntSimbol = round($afterCntSimbol * 1.2);
                $cntSimbol = 0;
                preg_match("#.{30}$#iu", $pStr, $matches);
                
                $searchStr  = $matches[0];
                $replaceStr = $searchStr.$marker;
                $replaceStr = str_ireplace('</p>', '<!--#--></p>', $replaceStr); //уникализация строки для исключения дублирования замены
                
//                echo $searchStr."<br />\n";
                
                $htmlTxt = str_ireplace($searchStr, $replaceStr, $htmlTxt);
            }
        }
        
        $lastCntTxt = round($startAfterCntSimbol * 0.7);
        
        $htmlTxt = preg_replace("#{$marker}(.{0,{$afterCntSimbol}})$#iu", "$1", $htmlTxt);
        $htmlTxt = $marker.$htmlTxt;
        return $htmlTxt;
    }
    
    function checkDuplicate($title,$text,$cntSearchNews=3){ #проверка дубля статьи в БД
        $this->shinglesObj->setNewsNewsData($title, $text);
        return $this->shinglesObj->findLikeNews($cntSearchNews);
    }
    
    private function txtLenth($html){
        $text   = strip_tags($html);
        $text   = preg_replace("#[/,:;\!\?\(\)\.\s]#iu", '', $text);
        $lenth  = mb_strlen($text);
        
        return $lenth;
    }
    
}


class donorMsn{
    
    private $donorData;
    
    
    function __construct($donorData) {
        $this->donorData = $donorData;
        $this->ci = & get_instance();
    }
    
    
    function getId(){
        $getSql = "SELECT `id`, `upd` FROM `donor` WHERE `host`='{$this->donorData['host']}' LIMIT 1";
        $query  = $this->ci->db->query($getSql); 
        
        if ($query->num_rows() < 1) // if no donor in db
        { 
            return $this->addDonor();
        }
        
        $row = $query->row_array();
        
        $timeUpd = strtotime("+1 day", strtotime($row['upd']));
        if(time()>$timeUpd)
        {
            $this->updDonor($row['id']);
        }
        
        return $row['id'];
    }
    
    
    private function addDonor(){
        
        $date       = date("Y-m-d H:i:s");
        $imgName    = $this->loadImg();
        
        $sql = "INSERT INTO `donor` "
                . "SET "
                . "`name`='{$this->ci->db->escape_str($this->donorData['name'])}', "
                . "`host`='{$this->donorData['host']}', "
                . "`img`='{$imgName}', "
                . "`upd`='{$date}'";
                
        $this->ci->db->query($sql);
        
        return $this->ci->db->insert_id();
    }
    
    
    private function updDonor($id){
        
        $date       = date("Y-m-d H:i:s");
//        $imgName    = $this->loadImg();
        
        $sql = "UPDATE `donor` "
                . "SET "
                . "`name`='{$this->ci->db->escape_str($this->donorData['name'])}', "
                . "`host`='{$this->donorData['host']}', "
//                . "`img`='{$imgName}', "
                . "`upd`='{$date}' "
                . "WHERE `id`='{$id}' "
                . "LIMIT 1";
                
        $this->ci->db->query($sql);        
    }
    
    
    private function loadImg(){
//        $imgData = Parse_lib::down_with_curl($this->donorData['img']);
//        $ImgFileName = $this->donorData['host'].'.png';
//        $ImgFilePath = './upload/_donor-logo/'.$ImgFileName;
//        
//        if(!empty($imgData)){
//            file_put_contents($ImgFilePath, $imgData);
//        }
//        
//        return $ImgFileName;
    }
    
}


class shingles{
 
    private 
            $titleFirst, 
            $textFirst, 
            $textSecond;
    
    function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('Article_translate_self_m');
    }
    
    function setNewsNewsData($title,$text){
        $this->titleFirst   = $title;
        $this->textFirst    = $text;
    }
    
    function findLikeNews($cntSearchNews=3){
        if(empty($this->titleFirst) || empty($this->textFirst)){  
            echo "\n\n --Empty find text data--\n\n"; 
            #совпадение не найдено
            return false;
        }
        
        #получение похожей статьи из БД
        $likeNewsData = $this->CI->Article_translate_self_m->searchLikeArt($this->titleFirst,$cntSearchNews);
        
        if(is_array($likeNewsData)==false){
            #совпадение не найдено
            return FALSE;
        }
        
        foreach ($likeNewsData as $likeNewsAr){
//            echo "\n\n ------- LIKE NEWS -------\n\n";
//            print_r($likeNewsAr);
//            echo "\n\n ------- /LIKE NEWS -------\n\n";
            
            #выход если получен пустой результат из БД
            #old code for one result 
//            if(!isset($likeNewsData['text'])){
//                echo "\n\n - Not find like Art in DB - \n\n";
//                return false;
//            }
            
            #получение хэшей из текстов
            $firstHashAr    = $this->get_shingles_hash($this->textFirst);
            $secondHashAr   = $this->get_shingles_hash($likeNewsAr['text']);
            
            if( $this->comparison_shingles_hash($firstHashAr, $secondHashAr) ){
                echo "\n - Статьи совпадают - \n";
                echo "\n 1: {$this->titleFirst}\n";
                echo "\n 2: {$likeNewsAr['text']} \n";
                echo "\n ID: {$likeNewsAr['id']} \n";

                return TRUE;
            }
        }
        
        #совпадение не найдено
        return FALSE;
    }
    
    private function get_shingles_hash( $text, $shingle_length = 7 ){ //возвращает массив хэшей шинглов
        $text = mb_strtolower($text);
//        $text = iconv('utf-8', 'cp1251//IGNORE', $text);
        $text = strip_tags($text);
        $html_pattern = "#&[a-z]{2,6};#i"; //== удаление мнимоники
        $text = preg_replace($html_pattern, ' ', $text);
        
        $pattern = "#(\pL{4,100})\W#ui";
        
        preg_match_all($pattern, $text, $word_ar);
        
        $word_ar = $word_ar[1];
           
        $count_word     = count($word_ar);
        $shingle_count  = $count_word - $shingle_length +1;
        
        $shingle_hash_ar = array();
        $shingle_str = '';
        for($i=0; $i<=$shingle_count; $i++ ){
            $stop_word_id = $i+$shingle_length; //id последнего слова для данного шингла
            for($ii=$i; $ii<$stop_word_id && $ii<$count_word; $ii++){
                $shingle_str .= $word_ar[$ii].' ';
            }
            if( $i%5 == 0)
//                $shingle_hash_ar[] = crc32($shingle_str);
                $shingle_hash_ar[] = sha1($shingle_str);
            $shingle_str = '';
        }
        
        return $shingle_hash_ar;
    }
    
    private function comparison_shingles_hash( $hash_ar_1, $hash_ar_2, $percent=60){ //принимает два массива хешей для сравнения и процент определяющий при каком колличестве совпадений тексты считаются идентичными
        
        if( !is_array($hash_ar_1) || !is_array($hash_ar_2) ) return FALSE;
        
        $cnt_hash = count($hash_ar_1);
        $cnt_comparison     = 0; //количество сравнений
        $cnt_coincidence    = 0; //количество совпадений
        
        for($i=0; $i<$cnt_hash; $i++){
//            if($i%5 == 0){ //сравнение каждого пятого хеша
                if( in_array($hash_ar_1[$i], $hash_ar_2) ){
                        $cnt_coincidence++;
                }        
                $cnt_comparison++;
//            } 
        }
        
        $percent_coincidence = round( $cnt_coincidence / ($cnt_comparison/100) ); //процент совпадений
        
        echo "\n\n".$percent_coincidence.'% совпадений '.$cnt_comparison.'/'.$cnt_coincidence."<br />\n\n";
        
        if($percent_coincidence >= $percent) //документы идентичны
            return TRUE;
        else    //документы различны
            return FALSE;
    }
    
}
    
    
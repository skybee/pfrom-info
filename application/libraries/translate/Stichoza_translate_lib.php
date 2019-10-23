<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


require_once './application/libraries/translate-stichoza/vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;

class Stichoza_translate_lib{
    private $CI;
    
    function __construct() {
        $this->CI =& get_instance();
//        $this->CI->load->config('multidomaine');
        $this->CI->load->library('multidomaine_lib');
    }

    static function selectDBconfig($langName){
        $CI =& get_instance();
        
        if(!function_exists('getDbConnectSetting')){  #костыль для подгрузки функциии выбора DB-конфига из файла /config/database.php
            $CI->load->database();
            $CI->db->close();
        }
        
        $staticDbConfig = getStaticDbConnectSetting();
        $dbConfig       = getDbConnectSetting($langName);
        $dbConfig       = array_merge($staticDbConfig,$dbConfig);
        
        if(is_array($dbConfig)){
            return $dbConfig;
        }
        else{
            return NULL;
        }
    }
    
    static function getRndProxy(){
        $proxyListFileName = './proxylist.txt';
        $randProxy = '';
        if(is_file($proxyListFileName)){
            $proxyListAr = file($proxyListFileName);
            
            if(is_array($proxyListAr)){
                shuffle($proxyListAr);
                
                $randProxy = $proxyListAr[0];
            }
        }
        
        if(!empty($randProxy)){
            return trim($randProxy);
        }
        else{
            return false;
        }
    }
    
    function getAcceptorArticles($langCode='us'){
        return new getAcceptorArticles($langCode);
    }
    
    function getLangConf($langCode){
        return $this->CI->multidomaine_lib->getMultidomaineConf($langCode);
    }
    
    function searchLikeArts(){
        return new searchLikeArtsInOtherDB();
    }
    
    function articlesRankSort(){
        return new articlesRankSort();
    }
    
    function cleanArtToTranslate(){
        return new cleanArtToTranslate();
    }
    
    function stTranslating(){
        return new stTranslating();
    }
    
    function writeResultToDB(){
        return new writeResultToDB();
    }
}




//---------------------------------------------------------------
class getAcceptorArticles{
    private $langCode, $CI, $translateConf;
    
    function __construct($langCode) {
        $this->langCode = $langCode;
        $dbConfig = Stichoza_translate_lib::selectDBconfig($langCode);
        
        $this->CI =& get_instance();
        $this->CI->load->database($dbConfig);
        $this->CI->load->model('Article_translate_m');
        $this->CI->load->config('multidomaine');
        $this->CI->load->library('multidomaine_lib');
        
        $this->translateConf = $this->getTranslateConf($langCode);
        
//        print_r($this->translateConf);
    }
    function __destruct() {
        $this->dbClose(); //закрытие соединения с БД
    }
    function dbClose(){ //закрытие соединения с БД
        $this->CI->db->close();
    }
    
    function getArticles($cnt=1){
        $cnt = (int)$cnt;
        
        $artsAr = $this->CI->Article_translate_m->getAcceptorArt($cnt, $this->translateConf['cat_id']);
        
        if(is_array($artsAr)){ return $artsAr; }
        else{ return FALSE; }
    }
    
    function getLangFrom(){ //получение списка языков в которых будет произведен поиск
        return $this->translateConf['lang_from'];
    }
    
    private function getTranslateConf($langCode){
        $langConf = $this->CI->multidomaine_lib->getMultidomaineConf($langCode);
        
        if($langConf!==false && is_array($langConf) && isset($langConf['translate'])){
            return $langConf['translate'];
        }
        else{
            echo "Error Translate Config: ".__FILE__;
            return NULL;
        }
    }
}


class searchLikeArtsInOtherDB{ //поиск релевантных записей в дороских базах 
    private $CI, $title, $titleLang, $dbLang, $dbLangConf, $countryCode;
    
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('Article_translate_m');
    }
    
    
    function setTitle($var)         {$this->title = $var;}
    function setTitleLang($var)     {$this->titleLang = $var;}
    function setDbLang($var)        {$this->dbLang = $var;}
    function setCountryCode($var)   {$this->countryCode = $var;}
    function setDbLangConf($var)    {
        $this->dbLangConf = $var;
        $this->setDbLang($var['lang']);
    }
    
    function getLikeArts($cnt=2){
        $this->dbConnect();
        $translatedTitle = $this->translate(STICHOZA_USE_PROXY); //$useProxy = true
        
        if($translatedTitle==false || empty($translatedTitle)){
            return false;
        }
        $likeArts = $this->CI->Article_translate_m->searchLikeArts($translatedTitle,$this->titleLang,$cnt);
        $this->dbClose();
        
        if(is_array($likeArts) && count($likeArts)>=1){
            foreach ($likeArts as $key=>$row){ //добавление код языка к массиву статьи
                $likeArts[$key]['lang']         = $this->dbLang;
                $likeArts[$key]['country_code'] = $this->countryCode;
            }
        }
        
        
        #-------------------------------------------------------
        echo "Title: ".$this->title."\n";
        echo "Title Lang: ".$this->titleLang."\n";
        echo "dbLang: ".$this->dbLang."\n";
//        print_r($this->dbLangConf);
        echo "Translated: ".$translatedTitle."\n\n";
        
//        print_r($likeArts);
        echo "\n\n-------------\n\n";
        #-------------------------------------------------------
        
        return $likeArts;
    }
    
    function translate($useProxy=true,$cntUse=0){
        
        $tr = new GoogleTranslate();
        $proxy = false;
        if($useProxy===true){
            $proxy = Stichoza_translate_lib::getRndProxy();
            $tr->setOptions(['proxy' => "http://{$proxy}"]);
            echo "\nUSE PROXY: {$proxy} - CntUse:{$cntUse} - Title Translate\n\n";
        }
        $tr->setSource($this->titleLang);
        $tr->setTarget($this->dbLang);
        try{
            $translatedTitle = $tr->translate($this->title);
        } 
        catch (Exception $e){
            if($cntUse<3){
                $msg = 'Proxy: '.$proxy.' - '.$e->getMessage();
                $this->translateErrorLog($msg);
                $translatedTitle = $this->translate($useProxy,$cntUse+1);
            }
            else{
                $translatedTitle = false;
            }
        }
        
        return $translatedTitle;
    }
    
    private function translateErrorLog($msg){
        $logFileName = './translate_error.log';
        
        $msg = date("Y-m-d H:i:s")." - ".$msg."\n";
        
        file_put_contents($logFileName, $msg, FILE_APPEND | LOCK_EX);
    }
    
    private function dbConnect(){
        $dbConfig = Stichoza_translate_lib::selectDBconfig($this->countryCode);
        $this->CI->load->database($dbConfig);
    }
    private function dbClose(){
        $this->CI->db->close();
    }
} 


class stTranslating{
    
    private $text,$langIn,$langOut;
    
    function getTranslate($text,$langIn,$langOut,$useProxy=true){
        $this->text     = $text;
        $this->langIn   = $langIn;
        $this->langOut  = $langOut;
        
        echo "\n\n\n getTranslate Method: \n\n";
        echo $this->langIn." > ".$this->langOut."\n\n";
        echo $this->text."\n\n---------\n\n";
        
        $translatedTxt = $this->translate($useProxy);
        echo $translatedTxt."\n\n---------\n\n";
        
        return $translatedTxt;
    }
    
    private function translate($useProxy=true,$cntUse=0){
        
        $tr = new GoogleTranslate();
        $proxy = false;
        if($useProxy===true){
            $proxy = Stichoza_translate_lib::getRndProxy();
            $tr->setOptions(['proxy' => "http://{$proxy}"]);
            echo "\nUSE PROXY: {$proxy} - CntUse:{$cntUse} - Text Translate\n\n";
        }
        $tr->setSource($this->langIn);
        $tr->setTarget($this->langOut);
        try{
            $translatedTitle = $tr->translate($this->text);
        } 
        catch (Exception $e){
            if($cntUse<3){
                $msg = 'Proxy: '.$proxy.' - '.$e->getMessage();
                $this->translateErrorLog($msg);
                $translatedTitle = $this->translate($useProxy,$cntUse+1);
            }
            else{
                $translatedTitle = false;
            }
        }
        
        return $translatedTitle;
    }
    
    private function translateErrorLog($msg){
        $logFileName = './translate_error.log';
        
        $msg = date("Y-m-d H:i:s")." - ".$msg."\n";
        
        file_put_contents($logFileName, $msg, FILE_APPEND | LOCK_EX);
    }
}


class articlesRankSort{
    private $atrsArray;
    
    function __construct() {
        $this->atrsArray = [];
    }
    
    function addArts($artsAr){
        if(is_array($artsAr)){
            $this->atrsArray = array_merge($this->atrsArray, $artsAr);
        }
    }
    
    function sortByRank(){
        $tmpAr = $this->atrsArray;
        usort($tmpAr,function($a,$b){
            if ($a['rank'] == $b['rank']){ return 0; }
            return ($a['rank'] > $b['rank']) ? -1 : 1;
        });
        $this->atrsArray = $tmpAr;
    }
    
    function getSortedArray(){
        $this->sortByRank();
        
        return $this->atrsArray;
    }
}


class cleanArtToTranslate{
    private $originTxt,$txtMarkers;
    
    function setText($txt){
        $txt = $this->delTagFromTxt($txt);
        $this->originTxt = $txt;
    }
    
    function addTitleToTxt($title){
        $this->originTxt = '<title>'.$title.'</title>'.$this->originTxt;
    }
    function getTitleFromTxt(){
        $pattern = "#<title>([\s\S]+?)</title>#i";
        preg_match($pattern, $this->originTxt, $matches);
        $this->originTxt = preg_replace($pattern, '', $this->originTxt);
        
        return $matches[1];
    }
    
    function getText(){
        return $this->originTxt;
    }
    
    function tagToMarker(){ //замена тегов на маркер X1
        $pattern = "#<[\s\S]+?>#i";
        preg_match_all($pattern, $this->originTxt, $matches);
        $marksTxt = $this->originTxt;
        
        $marksTxt = preg_replace("/X(\d+)/i",    "Х-$",    $marksTxt);
        $marksTxt = preg_replace($pattern,  'X1',  $marksTxt);
        $marksTxt = preg_replace("/X1 /i", 'X1',  $marksTxt);
        $marksTxt = preg_replace("/X1(\d)/i", 'X1 $1',  $marksTxt);
        $marksTxt = preg_replace("#\s{2,}#i", ' ',  $marksTxt);
        
        $marksTxt = $this->joinMarks($marksTxt);
        $this->originTxt =  $marksTxt;
        $this->txtMarkers = $matches[0];
    }
    function markerToTag(){ //замена маркеров X1 на теги из массива $this->txtMarkers
        
        $pattern    = "/X1/i";
        $txt        = $this->originTxt;
        $marksAr    = $this->txtMarkers;
        
        $txt        = $this->UnJoinMarks($txt);
        
        foreach ($marksAr as $txtMarkers){
            $txt = preg_replace($pattern,$txtMarkers, $txt, 1);
        }
        
        $this->originTxt = $txt;   
    }
    
    private function joinMarks($marksTxt){ //компановка X1 маркеров X1X1X1 > Xn
        $pattern = "/(X1){2,}/i";
        preg_match_all($pattern,$marksTxt,$matches);
        
        $joinedAr = $matches[0];
        foreach($joinedAr as $marksStr){
            $marksStrLengt = mb_strlen($marksStr);
            $joinedCnt = $marksStrLengt/2;
            $marksTxt = preg_replace("/{$marksStr}/i", "X{$joinedCnt}", $marksTxt, 1);
        }
        $marksTxt = preg_replace("/(X\d+)/i", " $1 ", $marksTxt);
        
        return $marksTxt;
        
    }
    private function UnJoinMarks($marksTxt){ //распаковка Xn маркеров Xn > X1X1X1 
        $pattern = "#X([2-9]\d*)#i";
        
        while(preg_match($pattern, $marksTxt, $matches)){ //поиск и замена X2+ 
            preg_match($pattern, $marksTxt, $matches);
            
            $markSerch      = $matches[0];
            $markCnt        = (int) $matches[1];
            $marksReplace   = '';
            
            for($i=1;$i<=$markCnt;$i++){ // составление строки из X1
                $marksReplace .= 'X1';
            }
            
            $marksTxt = str_ireplace($markSerch, $marksReplace, $marksTxt);
        }
        
        return $marksTxt;
    }
    
    private function delTagFromTxt($marksTxt){
        $marksTxt = preg_replace("#<script[\s\S]*</script>#i", ' ', $marksTxt);
        $marksTxt = strip_tags($marksTxt,'<p><span><br><img><strong><i><video>');
        
        return $marksTxt;
    }
}


class writeResultToDB{
    private $CI, $acceptorLangCode, $donorLangCode; 
            
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('Article_translate_m');
    }
    
    function setAcceptorLangCode($langCode){
        $this->acceptorLangCode = $langCode;
    }
    function setDonorLangCode($langCode){
        $this->donorLangCode = $langCode;
    }
    
    function setTranslatedArticle($artId,$lang){
        $this->dbConnect($this->donorLangCode);
        return $this->CI->Article_translate_m->setTranslatedArticle($artId,$lang);
    }
    
    function insertTranslatedArt($artId,$title,$text,$host){
        $this->dbConnect($this->acceptorLangCode);
        return $this->CI->Article_translate_m->insertTranslatedArt($artId,$title,$text,$host);
    }
    
    function dbClose(){ //закрытие соединения с БД
        if(isset($this->CI->db) && is_object($this->CI->db)){
            $this->CI->db->close();
        }
    }
    private function dbConnect($langCode){
        $this->dbClose();
        $dbConfig = Stichoza_translate_lib::selectDBconfig($langCode);
        $this->CI->load->database($dbConfig);
    }
    
}

class stichoza_translate_helper{  
    function clearTitleForSearch($str){
        $str = strip_tags($str);
//        $str = preg_replace('#[^\w\d\s]#iu','',$str);
        return $str;
    }
}



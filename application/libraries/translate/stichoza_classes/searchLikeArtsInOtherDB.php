<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
        $translatedTitle = $this->translate(false); //$useProxy = true
        
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

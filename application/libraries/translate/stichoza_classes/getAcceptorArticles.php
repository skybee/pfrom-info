<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

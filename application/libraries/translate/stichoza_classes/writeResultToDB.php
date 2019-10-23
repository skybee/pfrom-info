<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


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
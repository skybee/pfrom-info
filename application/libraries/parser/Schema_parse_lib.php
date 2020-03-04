<?php

class Schema_parse_lib{
    private $url, $CI;
    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('parser/Parse_lib');
        $this->CI->load->helper('parser/simple_html_dom_helper');
    }
    
    function setUrl($url){
        $this->url = $url;
    }
    
    function getSchemaData(){
        if(empty($this->url)){echo "Err: URL Empty"; return FALSE;}
        $html       = $this->download();
        $schmData   = $this->findSchmData($html);
        
        return $schmData;
    }
    
    
    private function download(){
        $html = Parse_lib::down_with_curl($this->url, false, true); //$url, $getInfo, $useProxy,
        return $html;
    }
    
    
    private function findSchmData($html){
        if(empty($html)){echo "Err: HTML Empty"; return FALSE;}
            
        $this->htmlObj =  new simple_html_dom();
        $this->htmlObj->load($html);
        if( !is_object($this->htmlObj) ){echo "Err: Can't create HTML Obj"; return FALSE;}
        
        $schmDataAr = $this->findSchmJsonLd();
        if($schmDataAr){
            return $schmDataAr;
        }
    }
    
    
    private function findSchmJsonLd(){
        if( !is_object($this->htmlObj->find('script[type=application/ld+json]',0)) ){
            return false;
        }
        
        echo "Fined application/ld+json\n";
        
        $unionJsonAr = [];
        /*--? Возможно стоит объединить блоки 'application/ld+json' в один и производить  поиск по нему ?--*/
        foreach($this->htmlObj->find('script[type=application/ld+json]') as $ldJsonObj ){
            $ldJsonTxt      = $ldJsonObj->innertext; 
            $arrFromJson    = json_decode($ldJsonTxt,TRUE);
            $unionJsonAr[]  = $arrFromJson;
            
//            echo "\n---- arrFromJson ----\n";
//            print_r($arrFromJson);
//            echo "\n---- /arrFromJson ----\n";

//            $resultAuthorData   = $this->findArticleData($arrFromJson);
//            if($resultAuthorData!==false){ break; }
        }
        
        $resultAuthorData   = $this->findArticleData($unionJsonAr);
        
        if(is_array($resultAuthorData)){
            return $resultAuthorData;
        }
        else{
            return false;
        }
    }
    
    private function findArticleData($inputAr){
        $authorDataAr = [];
        
        $searchNodes = ['publisher','author'];
        
        foreach ($searchNodes as $nodeName){
            $foundNode = $this->searchArNode($nodeName, $inputAr);
            if(is_array($foundNode) || !empty($foundNode)){
                $authorDataAr[$nodeName] = $foundNode;
            }
        }
        
        if(count($authorDataAr)>=1){
            return $authorDataAr;
        }
        else{ return false;}
    }
    
    private function searchArNode($nodeName,$array){
        if(isset($array[$nodeName])){
            return $array[$nodeName];
        }
        
        foreach($array as $key => $val){
            if(is_array($val)){
                $tmpAnswer = self::searchArNode($nodeName, $val);
                if(is_array($tmpAnswer)){
                    return $tmpAnswer;
                }
            }
        }
    }
    
    private function findSchmOrg(){
        if( !is_object($this->htmlObj->find('[itemscope]',0)) ){
            return false;
        }
    }
}


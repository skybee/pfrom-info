<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Partner_lib{
    function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->helper('parser/simple_html_dom');
    }
    
    function findLinks($html){
        $htmlObj =  str_get_html($html);
        
        $linksAr = [];
        
//        print_r($htmlObj);
        
        if( is_object($htmlObj->find('span.out-link',0) ) ){
            foreach($htmlObj->find('span.out-link') as $key => $linkObj){
                $linksAr[$key]['src']       = $linkObj->attr['src'];
                $linksAr[$key]['class']     = $linkObj->attr['class'];
                $linksAr[$key]['anchor']    = $linkObj->innertext;  
            }
        }
        
        if(count($linksAr)<1){
            return NULL;
        }
        
        $linksAr = $this->addPartnerNameToLink($linksAr);
        
        return $linksAr;
    }
    
    function changeLinkInTxt($html,$linksData){
        $inTxtLiks = $this->findLinks($html);
        if(count($inTxtLiks) != count($linksData['src'])){
            return FALSE;
        }
        
        $htmlObj =  str_get_html($html);
        
        if( is_object($htmlObj->find('span.out-link',0) ) ){
            foreach($htmlObj->find('span.out-link') as $key => $linkObj){
                $linkObj->attr['src']   = $linksData['src'][$key];
                $linkObj->innertext     = $linksData['anchor'][$key];
                if(trim($linksData['class'][$key]) == 'out-link'){ //добавление партнерских CSS-классов ссылок
                    $linkObj->attr['class'] = $linksData['class'][$key].$this->addPartnerCssClasses($inTxtLiks[$key]['partner']);
                }
                else{
                    $linkObj->attr['class'] = $linksData['class'][$key];
                }
            }
        }
        
        return $htmlObj->save();
    }
    
    function addPartnerCssClasses($parterName){
        if(empty($parterName)){ return ''; }
        
        $classes = ' partner-link ';
        
        if($parterName == 'Amazon'){
            $classes .= ' partner-amz ';
        }
        elseif($parterName == 'Walmart'){
            $classes .= ' partner-walmart ';
        }
        
        return $classes;
    }
    
    function addPartnerNameToLink($linksAr){
        foreach($linksAr as $key => $linkData){
            
            if(preg_match("#//(www\.|)(amzn\.to|amazon\.com)#i", $linkData['src'])!= false){
                $linksAr[$key]['partner'] = 'Amazon';
            }
            elseif(preg_match("#//(www\.|)(goto\.walmart\.com|walmart.com)#i", $linkData['src'])!= false){
                $linksAr[$key]['partner'] = 'Walmart';
            }
            else{
                $linksAr[$key]['partner'] = '';
            }
        }
        
        return $linksAr;
    }
}
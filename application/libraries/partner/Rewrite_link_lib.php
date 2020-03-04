<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Rewrite_link_lib{
    private $ci;
    function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->library('parser/Parse_lib');
        $this->ci->load->library('partner/Partner_lib');
        $this->ci->load->helper('parser/simple_html_dom');
    }
    
    function getProductRealUrl($link, $useProxy=false){
        $curlResult = Parse_lib::down_with_curl($link, TRUE, $useProxy);
        $realUrl = $curlResult['http_data']['url'];
        
        return $realUrl;
    }
    
    function createMyAmzLink($longUrl,$myTag='newsexpress04-20'){
        $pattern = "#(http.+/[a-z\d]{10})(|/|\?)#i";
        preg_match($pattern, $longUrl, $matches);
//        print_r($matches);
        
        if(!empty($matches[1])){
            $myLink = $matches[1]."/?tag=".$myTag;
        }
        else{
            $myLink = $longUrl;
        }
        
        return $myLink;
    }
    
    function changeLinkInTxt($html,$linksAr){
        $linksAr        = $this->rewriteLinksArFor_changeLinkInTxt($linksAr);
        $changedHtml    = $this->ci->partner_lib->changeLinkInTxt($html,$linksAr);
        
        return $changedHtml;
    }
    
    function findLinks($html){
        $linksAr = $this->ci->partner_lib->findLinks($html);
        return $linksAr;
    }
    
    function updArt($postData){
        return $this->ci->partner_lib->updArt($postData);
    }
    
    private function rewriteLinksArFor_changeLinkInTxt($linksAr){
        $rewriteAr = array();
        foreach ($linksAr as $key => $linksData){
            $rewriteAr['src'][$key]     = $linksData['src'];
            $rewriteAr['class'][$key]   = $linksData['class'];
            $rewriteAr['anchor'][$key]  = $linksData['anchor'];
            $rewriteAr['partner'][$key] = $linksData['partner'];
        }
        
        return $rewriteAr;
    }
}


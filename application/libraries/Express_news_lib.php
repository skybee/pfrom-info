<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Express_news_lib{
    
    function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->helper('parser/download_helper');
    }
    
    
    function get_news()
    {
        $hosts = $this->get_express_host();
        
        $data = array();
        
        foreach($hosts as $host)
        {
            
            if($host == $_SERVER['HTTP_HOST']){
                continue;
            }
            
            $url = 'http://'.$host.'/api/main/get_top_news/';
            
            $newsData = $this->download_data($url);
            
            if($newsData)
            {
                $newsData['host'] = $host;
                $data[] = $newsData;
            }
        }
        
        return $data;
    }
    
    function get_news_OneHost($langCodeAr, $host = false){
        if(empty($host)){
            $host = $_SERVER['HTTP_HOST'];
        }
        
        $data = array();
        
        foreach($langCodeAr as $langCode){
            if($langCode == LANG_CODE){
                continue;
            }
            
            $url = 'https://'.$host.'/'.$langCode.'/api/main/get_top_news/';
            
            $newsData = $this->download_data($url);
            
//            print_r($newsData);
            
            if($newsData)
            {
                $newsData['host']       = $host;
                $newsData['lang_code']  = $langCode;
                $data[] = $newsData;
            }
        }
        
        return $data;
    }
    
    private function get_express_host()
    {
        $hosts = array(
            'us.pressfrom.com',
            'ca.pressfrom.com',
            'au.pressfrom.com',
            'uk.pressfrom.com',
            'de.pressfrom.com',
            'fr.pressfrom.com',
            'smiexpress.ru'
            );
        
        return $hosts;
    }
    
    private function download_data($url)
    {
        $json = down_with_curl($url);
        
        $dataAr = json_decode($json, true);
        
        if(is_array($dataAr)&&count($dataAr)>1)
        {
            return $dataAr;
        }
        else {
            return false;
        }
    }
} 
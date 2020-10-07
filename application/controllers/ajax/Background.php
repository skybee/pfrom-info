<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 


class Background extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('article_m');
    }
    
    function set_top(){
        
        $id     = (int) $_POST['docId'];
        $ip     = $_SERVER['HTTP_X_REAL_IP'];
//        $ip     = $_SERVER['REMOTE_ADDR'];
        $ref    = $_POST['ref'];
        $rank   = 1;
        
        if($_SERVER["REQUEST_METHOD"] != 'POST')                                exit('! Wrong Method');
        if($id <= 1)                                                            exit('! Wrong Post ID');
        if(filter_var($ip, FILTER_VALIDATE_IP) === false)                       exit('! Wrong IP');
        
        if( preg_match("#^66\.249\.\d{1,3}\.\d{1,3}#i", $ip) )                  exit('Lock IP'); //GoogleBot
        if( preg_match("#^(141\.8\.142|178\.154\.171)\.\d{1,3}#i", $ip) )       exit('Lock IP'); //YandexBot
        if( preg_match("#^109\.239\.235\.\d{1,3}#i", $ip) )                     exit('Lock IP'); //May be GoogleBot
        
        if( preg_match("#(google|yandex|bing|yahoo|duckduckgo|mail.ru|Nigma|Rambler|Ukr.net)#i", $ref) ){
            $rank = 3;
        }
        
        $log_str = "ID: {$id} - IP: {$ip} - {$ref}\n";
        
        $this->article_m->set_article_rank($id, $ip, $rank);
    }
    
    function get_right_hc(){        
        if( isset($_COOKIE['country']) && mb_strlen($_COOKIE['country']) == 2  ){
            $country = $_COOKIE['country'];
        }
        else{
            $country = $this->getCountrySetCoockie();
        }
        
        if( $country == 'UA'){
            $this->load->view('ads/house_v');
        }
    }
    
    private function getCountrySetCoockie(){
        $this->load->helper('geoip/geoip_helper');
        
        $country = get_country();
        
        setcookie('country', $country, time()+3600*24 );
        
        return $country;
    }
}
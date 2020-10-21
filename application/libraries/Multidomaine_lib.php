<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multidomaine_lib
{
    function __construct() {
        $this->ci = &get_instance();
    }
    
    function getHostData($thisHost=false)
    {   
        $multidomaineAll    = $this->ci->config->item('multidomaine');
        $hostSet            = $multidomaineAll['host_set'];
        
        if($thisHost == false){
            $thisHost           = $_SERVER['HTTP_HOST'];
        }
        
        if(isset($hostSet[$thisHost]))
        {
            $this->multidomaine = $multidomaineAll[$hostSet[$thisHost]];
        }
        else
        {
            $this->multidomaine = $multidomaineAll['ru'];
        }
        
        return $this->multidomaine;
    }
    
    function getHostsList(){
        
        //<UPD multidomain>
        return $this->getMainHostList();
        //</UPD multidomain>
        
        $multidomaineAll    = $this->ci->config->item('multidomaine');
        $aliases = $multidomaineAll['aliases'];
        
        foreach ($multidomaineAll['host_set'] as $host => $c_code){
            if(in_array($host, $aliases)){continue;}
            $hostsList[] = $host;
        }
        
        return $hostsList;
    }
    
    function getMainHostList(){
        $multidomaineAll    = $this->ci->config->item('multidomaine');
        
        return $multidomaineAll['main_host'];
    }
    
    function getParseLang(){
        $multidomaineAll    = $this->ci->config->item('multidomaine');
        
        return $multidomaineAll['parse_lang'];
    }
    
    function getMultidomaineConf($langCode){
        $allMultidomaineConf = $this->ci->config->item('multidomaine');
        if(isset($allMultidomaineConf[$langCode]) && is_array($allMultidomaineConf[$langCode])){
            return $allMultidomaineConf[$langCode];
        }
        else{
            return false;
        }
    }
}
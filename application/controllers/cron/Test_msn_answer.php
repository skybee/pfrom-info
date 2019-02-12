<?php

class Test_msn_answer extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    function index(){
        echo "test_msn_answer class";
    }
    
    function test(){
        header("Content-type:text/plain;Charset=utf-8");
        
        $this->load->library('parser/Parse_lib');
        
        $url = "https://www.msn.com/en-us/news/world/two-migrant-caravan-teens-slain-in-tijuana/ar-BBRa1nT";
        
        $answer = $this->parse_lib->down_with_curl($url, true, true, 0);
        
        print_r($answer);
    }
}


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './application/controllers/cron/Sitemap_generator.php';

class PayPosts extends Sitemap_generator{
    
    function __construct() {
        parent::__construct();
        
        $this->cntUrlFromDB = 100;
    }
    
    function index(){
        echo 'Index Function';
    }
    
    protected function getUrlRowsFromDB($lang, $cnt=100){
        $dbConfig = stichoza_translate_lib::selectDBconfig($lang);
        $this->load->database($dbConfig);
        
        $sql = "SELECT `article`.`id`,`article`.`date`,`article`.`url_name`, "
                . "`category`.`full_uri` "
                . "FROM `article` "
                . "LEFT JOIN `category` "
                . "ON `article`.`cat_id` = `category`.`id` "
                . "WHERE `article`.`pay_article` = 1 "
                . "ORDER BY `article`.`id` DESC "
                . "LIMIT {$cnt} ";
                
//        echo '<pre>'.$sql.'</pre><br /><br />';        
        
        $query = $this->db->query($sql);
        
        $resultRows = [];
        foreach($query->result_array() as $row)
        {
            $row['time']    = strtotime($row['date']);
            $row['lang']    = $lang;
            $resultRows[]   = $row;
        }
        
        $this->db->close();
        
        return $resultRows;
    }
    
    
}


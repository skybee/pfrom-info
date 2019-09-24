<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class History_m extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function getPeriodHistory($monthAgo=1){
        $dateStart = date("Y-m-d", strtotime(" - {$monthAgo} month" ));
        
        $sql = "SELECT COUNT(`id`) AS 'cnt', DATE_FORMAT(`date`, '%Y-%m-%d') AS `ddate` "
                . "FROM `article` WHERE `date` > '{$dateStart}' "
                . "GROUP BY `ddate` ORDER BY `ddate`";
                
        $query = $this->db->query($sql);
        
        if($query->num_rows() < 1){ return false;}
        
        $result = array();
        foreach($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    function getCountry(){
        
    }
}
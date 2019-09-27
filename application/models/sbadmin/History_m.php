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
    
    function getPeriodHistory($monthAgo=1, $category=false){
        $dateStart = date("Y-m-d", strtotime(" - {$monthAgo} month" ));
        
        $sqlWhere = '';
        if($category !== false){ // условие для выбора данных для категории
            $category = (int) $category;
            $sqlWhere = " AND `cat_id`='{$category}' ";
        }
        
        $sql = "SELECT COUNT(`id`) AS 'cnt', DATE_FORMAT(`date`, '%Y-%m-%d') AS `ddate` "
                . "FROM `article` WHERE `date` > '{$dateStart}' {$sqlWhere} "
                . "GROUP BY `ddate` ORDER BY `ddate`";
                
        $query = $this->db->query($sql);
        
        if($query->num_rows() < 1){ return false;}
        
        $result = array();
        foreach($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    function getCategoryHistory($monthAgo=1){
        $sqlSelectCat = "SELECT `url_name`,`name`,`id`,`full_uri` FROM `category` "
                . "WHERE `parent_id` !='0' "
                . "ORDER BY `parent_id`, `sort`";
        
        $query = $this->db->query($sqlSelectCat);
        
        if($query->num_rows() < 1){ return false;}
        
        $categoryAr = array();
        foreach ($query->result_array() as $row){
            $row['dateData'] = $this->getPeriodHistory($monthAgo, $row['id']);
            $categoryAr[] = $row;
        }
        
        return $categoryAr;
    }
}
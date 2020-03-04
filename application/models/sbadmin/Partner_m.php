<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Partner_m extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function searchPartnerArts($limit=5){
        $limit = (int)$limit;
        $sql = "SELECT `article`.`id`, `article`.`text` "
                . "FROM `article` "
                . "LEFT OUTER JOIN `article_partner` ON `article`.`id` = `article_partner`.`article_id` "
                . "WHERE "
                    . "`article_partner`.`id` IS NULL "
                . "AND "
                    . "(`text` LIKE '%amzn.to%' "
                    . "OR "
                    . "`text` LIKE '%amazon.com%') "
                . "LIMIT {$limit}";
                
//        echo $sql;        
                
        $query = $this->db->query($sql);

        if($query->num_rows()<1){return NULL;}
        
        $result=[];
        
        foreach ($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    function addPartnerArts($data){
        $sql = "INSERT INTO `article_partner` "
                . "SET `article_id` = ? , `partner_name` = ? ";
        
        $insertData = array(
            $this->db->escape_str($data['id']),
            $this->db->escape_str($data['partner_name'])
        );
        
        return $this->db->query($sql,$insertData);
    }
    
    function getPartnerArtsList($order='views',$cnt=100){
        
        $orderAr = [
            'views' => '`article`.`views` DESC',
            'date'  => '`article`.`date` DESC'
        ];
        
        $sql ="SELECT "
                . "`article`.`id`, `article`.`views`, `article`.`title`, `article`.`date`, "
                . "`category`.`name`, "
                . "`article_partner`.`partner_name` "
            . "FROM "
                . "`article`,`category`,`article_partner` "
            . "WHERE "
                . "`article`.`cat_id` = `category`.`id` "
                . "AND "
                . "`article`.`id` = `article_partner`.`article_id` "
            . "ORDER BY {$orderAr[$order]} "
            . "LIMIT {$cnt} ";
        
//        echo $sql;
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() < 1){ return NULL;}
        
        $returnResult = array();
        foreach($query->result_array() as $row){
            $returnResult[] = $row;
        }
        
        return $returnResult;
    }
    
    function getArtData($id){
        $sql = "SELECT * FROM `article` WHERE `id` = {$id} ";
        
        $query = $this->db->query($sql);
        
        return $query->row_array();
    }
    
    function updArt($postData){
        $sql = "UPDATE `article` SET `title`= ? , `text`= ? WHERE `id`= ? LIMIT 1 ";
        $sqlData = [
            $postData['title'],
            $postData['text'],
            $postData['id']
        ];
        
//        print_r($sqlData);
        
        return $this->db->query($sql,$sqlData);
    }
    
    function updPartnerArt($artId){
        $date = date("Y-m-d");
        $sql = "UPDATE `article_partner` SET `update_date`='{$date}' WHERE `article_id`='{$artId}' LIMIT 1 ";
        
        return $this->db->query($sql); 
    }
    
    function getArtsForUpd($cnt=1){
        $sql = "SELECT `article`.* "
                . "FROM `article` "
                . "INNER JOIN `article_partner` "
                . "ON `article`.`id` = `article_partner`.`article_id` "
                . "WHERE "
                #. "`article`.`id` = '852' "
                . "`article_partner`.`update_date` = '0000-00-00' "
                #. "ORDER BY RAND() "
                . "LIMIT {$cnt}";
        
//        echo $sql;
        
        $query = $this->db->query($sql);
        
        if($query->num_rows() < 1){
            return NULL;
        }
        
        $result = [];
        
        foreach ($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
}
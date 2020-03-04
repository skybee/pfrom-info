<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Parse_schema_m extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    
    function getEmptyAuthorArt($cnt=5){ //получение не обработанных записей
        $sql = "SELECT `id`,`canonical` FROM `article` "
                . "WHERE "
                . "`author_id`=0 "
                . "AND "
                . "`canonical` != '' "
                . "ORDER BY `id` DESC "
                . "LIMIT {$cnt} ";
                
        $query = $this->db->query($sql);
        
        if($query->num_rows()<1){
            return NULL;
        }
        
        $result = [];
        foreach($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    function insertAuthorData($jsonData,$articleID){
        $sqlAuthorInsert = "INSERT INTO `author` SET `data`=? ";
        
        if($this->db->query($sqlAuthorInsert,[$jsonData])){
            return $this->db->insert_id();
        }
        else{ return false; }
    }
    
    function updArticleAuthorID($articleID,$authorID){
        $sqlAuthorID = "UPDATE `article` SET `author_id`=? WHERE `id`=? LIMIT 1";
        return $this->db->query($sqlAuthorID,[$authorID,$articleID]);
    }
    
}
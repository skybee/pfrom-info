<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article_translate_m extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function getAcceptorArt($cnt=1,$catIDs){ // $cnt=int, $catIDs='1,5,12,25'
        $cnt = (int)$cnt;
        
        $sql = "SELECT `article`.`id`, `article`.`title` "
                . "FROM `article` "
                . "LEFT OUTER JOIN `article_like_translate` "
                . "ON `article`.`id` = `article_like_translate`.`article_id` "
                . "WHERE "
                . "`article_like_translate`.`id` IS NULL "
                . "AND "
                . "`cat_id` IN ({$catIDs})  "
                . "ORDER BY `date` DESC "
                . "LIMIT {$cnt} ";
                
        $query = $this->db->query($sql);
        
        if($query->num_rows()<1){
            echo "No Accept Articles: ".__FILE__;
            return NULL;
        }
        
        $result = [];
        foreach ($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    function searchLikeArts($searchTxt,$langToTranslate,$limit=10){
        $limit = (int)$limit;
        $searchTxt          = $this->db->escape_str($searchTxt);
        $langToTranslate    = $this->db->escape_str($langToTranslate);
        $sql = "SELECT `article`.`id`,`article`.`title`,`article`.`text`,`article`.`main_img`, "
                . "MATCH (`article`.`title`,`article`.`text`) AGAINST ('{$searchTxt}') AS 'rank' "
                . "FROM `article` "
                . "LEFT OUTER JOIN `article_translated` "
                . "ON `article`.`id` = `article_translated`.`article_id` "
                . "WHERE "
                    . "`article_translated`.`id` IS NULL "
                    . "AND " 
                    . "MATCH (`article`.`title`,`article`.`text`) AGAINST ('{$searchTxt}') "
                    . "AND "
                    . "CHAR_LENGTH(`article`.`text`) < 8000 "
                    . "AND "
                    . "CHAR_LENGTH(`article`.`text`) > 3000 "
                . "LIMIT {$limit}";
                
        $query = $this->db->query($sql);        
        
        if($query->num_rows()<1){
            echo "\nNo Like Articles: ".__FILE__."\n";
            return NULL;
        }
        
        $result = [];
        foreach ($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    function setTranslatedArticle($artId,$lang){
        $sql = "INSERT INTO `article_translated` SET `article_id`= ?, `language`= ? ";
        
        return $this->db->query($sql,[$artId,$lang]);
    }
    
    function insertTranslatedArt($artId,$title,$text,$host){
        $sql = "INSERT INTO `article_like_translate` "
                . "SET "
                . "`article_id`= ?, "
                . "`title`  = ?, "
                . "`text`   = ?, "
                . "`host`   = ? ";
        
        return $this->db->query($sql,[$artId,$title,$text,$host]);
    }
}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Article_translate_self_m extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    
    function getDonorArtForLang($cnt=1,$langFor){ // $cnt=int, $langFor - язык на который будет переводится
        $cnt = (int)$cnt;
                
        $sql = "SELECT `article`.* "
                . "FROM `article` "
                . "LEFT OUTER JOIN `article_translated_self` "
                . "ON "
                        . "`article`.`id` = `article_translated_self`.`article_id` "
                    . "AND "
                        . "`article_translated_self`.`language` =  '{$langFor}' "
                . "WHERE "
                        . "`article_translated_self`.`id` IS NULL "
                    . "AND "
                        . "CHAR_LENGTH(`article`.`text`) < '8000' "
                    . "AND "
                        . "`article`.`pay_article` = '0' "
                . "ORDER BY `article`.`date` DESC "
                . "LIMIT {$cnt}";
                
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
    
    function setTranslatedArticle($artId,$lang){
        $sql = "INSERT INTO `article_translated_self` SET `article_id`= ?, `language`= ? ";
//        echo "\n\n{$sql}\n -- {$artId} / {$lang} \n";
        return $this->db->query($sql,[$artId,$lang]);
    }
    
    function insertTranslatedArt($catId,$donorId,$urlName,$title,$text,$description,$donorData){
        $sql = "INSERT INTO `article` "
                . "SET "
                . "`cat_id`         = ?, "
                . "`date`           = ?, "
                . "`url_name`       = ?, "
                . "`title`          = ?, "
                . "`description`    = ?, "
                . "`text`           = ?, "
                . "`main_img`       = ?, "
                . "`donor_id`       = ?, "
                . "`scan_url_id`    = ?, "
                . "`author_id`      = ?, "
                . "`canonical`      = ?, "
                . "`show_ads`       = ?, "
                . "`pay_article`    = ? "; # 7-translated
        
        $insertResult   = $this->db->query($sql,
                [
                    $catId,
                    $donorData['date'],
                    $urlName,
                    $title,
                    $description,
                    $text,
                    $donorData['main_img'],
                    $donorId,
                    $donorData['scan_url_id'],
                    $donorData['author_id'],
                    $donorData['canonical'],
                    $donorData['show_ads'],
                    '7' # 7-translated
                ]);
        
        if($insertResult){
            return $this->db->insert_id();
        }
        else{
            return FALSE;
        }
    }
    
    function searchLikeCatIDs($searchTxt,$limit=10){
        $searchTxt  = $this->db->escape_str($searchTxt);
        
        $sql = "SELECT "
                    . "`article`.`cat_id`, "
                    . "MATCH (`article`.`title`,`article`.`text`) AGAINST ('{$searchTxt}') AS 'rank' "
                . "FROM "
                    . "`article` "
                . "WHERE " 
                    . "MATCH (`article`.`title`,`article`.`text`) AGAINST ('{$searchTxt}') "
                . "LIMIT {$limit}";
                
        $query = $this->db->query($sql);        
        
        if($query->num_rows()<1){
            echo "\nNo Like CatID: ".__FILE__."\n";
            return false;
        }
        
        $result = [];
        foreach ($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;        
    }
    
    function searchLikeArt($searchTxt,$limit=1){
        $searchTxt  = $this->db->escape_str($searchTxt);
        
        $sql = "SELECT `id`, `title`, `text` "
                . "FROM "
                . "`article` "
                . "WHERE " 
                    . "MATCH (`article`.`title`,`article`.`text`) AGAINST ('{$searchTxt}') "
                . "LIMIT {$limit} ";
                    
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
        
}
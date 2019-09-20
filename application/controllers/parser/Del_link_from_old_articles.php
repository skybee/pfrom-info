<?php
set_time_limit( 600 );
ini_set('safe_mode', false);
header("Content-type:text/plain;Charset=utf-8");

class Del_link_from_old_articles extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('parser/simple_html_dom');
//        $this->load->library('parser/Parse_page_msn_lib');
    }
    
    function del_links($cntArts=1){
        $cntArts = (int) $cntArts;
        $articles = $this->getArtWithLinks($cntArts);
        
        if($articles==false OR count($articles)<1){
            echo "Нет статей для обработки \n";
            return false;
        }
        
        foreach ($articles as $key=>$articleAr){
            $articleAr['text'] = $this->delLinksFromTxt($articleAr['text']);
            
            if($this->updateArtHtml($articleAr['id'], $articleAr['text'])){
                echo "ID: {$articleAr['id']} - Updated \n\n----------\n\n";
            }
            else{
                echo "ID: {$articleAr['id']} - ERROR Update \n\n----------\n\n";
            }
            flush();
        }
    }
    
    private function getArtWithLinks($cnt){
        $sql = "SELECT `id`, `text` FROM `article` WHERE `text` LIKE '%<a %' LIMIT {$cnt} ";
//        echo $sql;
        
        $query = $this->db->query($sql);
        if($query->num_rows() < 1){ return false; }
        
        $result = array();
        
        foreach ($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    private function delLinksFromTxt($html){
        $htmlObj = str_get_html($html);
        
        if(is_object($htmlObj->find('a',0)) === false && preg_match("#<a #i", $html) === false){
            return $html;
        }
        
        foreach($htmlObj->find('a') as $linkObj){
            $anchor = $linkObj->innertext;
            $href   = $linkObj->href;
            
            $spanLink = '<span class="out-link" src="'.$href.'">'.$anchor.'</span>';
            
            $linkObj->outertext = $spanLink;
        }
        
        $html = (string) $htmlObj->outertext;
        
        $html = str_ireplace('<a ', '<span ', $html);
        $html = str_ireplace('</a>','</span>', $html);
        
        
        
        return $html;
    }
    
    private function updateArtHtml($id, $html){
        $sql = "UPDATE `article` SET `text`=? WHERE `id`=? LIMIT 1 ";
        
        if($this->db->query($sql,array($html,$id)))
            return true;
        else
            return false;
    } 
}


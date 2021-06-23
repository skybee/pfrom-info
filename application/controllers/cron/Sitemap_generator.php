<?php

class Sitemap_generator extends CI_Controller
{
    protected $cntUrlFromDB = 5000, $langList = ['fr','de','uk','us','ca','au','br'];
    function __construct() {
        parent::__construct();
        $this->langAr = array();
        
        $this->load->library('translate/Stichoza_translate_lib');
    }
    
    function index(){
        echo "index";
    }
    
    
    
    function create(){
        
        $urlsList = $this->getMergeResult();
        
//        echo "<pre>".print_r($urlsList,1)."</pre>";
        
        $xmlBody = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xmlBody .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        
        foreach ($urlsList as $urlData){
            $url = "https://pressfrom.info/{$urlData['lang']}/{$urlData['full_uri']}-{$urlData['id']}-{$urlData['url_name']}.html";
            $xmlBody .= "\t<url>\n";
            $xmlBody .= "\t\t<loc>{$url}</loc>\n";
            $xmlBody .= "\t</url>\n";
        }
        
        $xmlBody .= "</urlset>";
        
        if( file_put_contents('./sitemap/sitemap.xml', $xmlBody) ){
            echo "File writed";
        }

    }
    
    
    
    protected function getMergeResult(){
        $mergeResult = [];
        
        foreach ($this->langList as $lang){
            $rowsAr         = $this->getUrlRowsFromDB($lang, $this->cntUrlFromDB);
            $mergeResult    = array_merge($mergeResult, $rowsAr);
        }
        
        usort($mergeResult,array("Sitemap_generator", "arraySortRule"));
//        echo "<pre>".print_r($mergeResult,1)."</pre>";
        return $mergeResult;
    }
    
    
    protected function arraySortRule($a, $b){
        if ($a['time'] == $b['time']) {
            return 0;
        }
        return ($a['time'] < $b['time']) ? -1 : 1;
    }
    
    
    protected function getUrlRowsFromDB($lang, $cnt=1000){
        $dbConfig = stichoza_translate_lib::selectDBconfig($lang);
        $this->load->database($dbConfig);
        
        $sql = "SELECT `article`.`id`,`article`.`date`,`article`.`url_name`, "
                . "`category`.`full_uri` "
                . "FROM `article` "
                . "LEFT JOIN `category` "
                . "ON `article`.`cat_id` = `category`.`id` "
                . "ORDER BY `article`.`id` DESC "
                . "LIMIT {$cnt} ";
        
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


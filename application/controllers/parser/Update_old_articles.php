<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit( 600 ); 
//ini_set('open_basedir','none');
ini_set('safe_mode', false);
header("Content-type:text/plain;Charset=utf-8");

class Update_old_articles extends CI_Controller
{
    private $updHtmlObj, $updModel;
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('parser/simple_html_dom');
        
        $this->updHtmlObj   = new updHtmlText(); //обработчик html 
        $this->updModel     = new updOldArtsModel();
    }
    
    
    function update($cntArts = 1){
        $sqlWhere = " " 
                    . "`text` LIKE '%<button%' OR " //button fix
                    . "`text` LIKE '%class=\"metadata\"%' OR " //video player fix
                    . "`text` LIKE '%id=\"findacar\"%' OR " //search block in car
                    . "`text` LIKE '%class=\"ec-module%' OR "
                    . "`text` LIKE '%class=\"msnews-container%' OR "
                    . "`text` LIKE '%class=\"autos_rlc1%' OR "
                    . "`text` LIKE '%class=\"researchcars%' OR "
                    . "`text` LIKE '%<style>%' "; 
        //class="metadata"
        //id="findacar"
        
        $cntArts = (int) $cntArts;
        if( $cntArts < 1 ){ $cntArts = 1; }
        
        $articles = $this->updModel->getArticles($sqlWhere, $cntArts);
        if(!is_array($articles)){ exit("No Articles"); }
        
        foreach ($articles as $articleData){
            echo "Work with ID: ".$articleData['id']."\n";
            
            $this->updHtmlObj->createHtmlObj($articleData['text']);
            
            $this->delFromHtmlObj(); //удаление мусорных тегов
            
            $cleanHtmlText          = $this->updHtmlObj->getHtml();
            $cleanHtmlText          = $this->delFromHtmlWithPattern($cleanHtmlText);
            $articleData['text']    = $cleanHtmlText;
            $this->updHtmlObj->clean();
            
//            echo $cleanHtmlText;
            $updAnswer = NULL;
            $updAnswer = $this->updModel->updArticleInDB($articleData);
                
            if($updAnswer === true){
                echo "ID: ".$articleData['id']." Updated \n";
            }
            else{
                echo "ERROR | ID: ".$articleData['id']." Don`t Updated \n";
            }
            
            echo "\n\n---------------------\n\n";
            flush();
        }
    }

    private function delFromHtmlObj(){
        $this->updHtmlObj->delAll('#findacar'); // del auto search block 
        $this->updHtmlObj->delAll('button'); // del all <button>
        $this->updHtmlObj->delAll('div.ec-module'); //msn <iframe> in div.ec-module
        $this->updHtmlObj->delAll('div.msnews-container'); //msnNewsBlock .msnews-container
        $this->updHtmlObj->delAll('div.autos_rlc1'); //autos_rlc1 search block in Auto
        $this->updHtmlObj->delAll('div.researchcars'); //autos search block in Auto
        $this->updHtmlObj->delAll('style'); //style in text
       
        
        //<video player content>
        $this->updHtmlObj->delAll('div.metadata'); //del video info
        $this->updHtmlObj->delAll('div.playlist-and-storepromo'); //del video info
        $this->updHtmlObj->delAll('div.nextvideo-outer'); //del video info
        //<video player content> 
    }
    
    private function delFromHtmlWithPattern($html){
        $pattern = "#<!--\s*\[if gte mso 10\]>\s*<style>[\s\S]+?</style>\s*<!\[endif\]\s*-->#i";
        
        $html = preg_replace($pattern, '<!-- DelStyle -->', $html);
        
        return $html;
    }
}






class updHtmlText
{
    
    private $html, $htmlObj;
    
    function __construct() {
        
    }
    
    public function createHtmlObj($html){
        $this->html     = $html;
        
        if(empty($html)){return false;}
        
        $this->htmlObj  = new simple_html_dom();
        $this->htmlObj->load($html);
    }
    
    public function getHtml(){
        if(is_object($this->htmlObj)){
            return $this->htmlObj->save();
        }
        else{
            return $this->html;
        }
    }
    
    public function clean(){
        $this->html     = '';
        unset($this->htmlObj);
        $this->htmlObj  = '';
    }
    
    //<Del From Object Function>
    
    public function delSingle($selector, $key){
        if( is_object( $this->htmlObj->find($selector, $key) ) ){
            $this->htmlObj->find($selector, $key)->outertext = '<!-- W-Del '.$selector.' -->';
            $this->htmlObj->load($this->htmlObj->save());
        }
    }
    
    public function delAll( $selector ){
        if(is_object( $this->htmlObj->find($selector,0) ) ){
            $cntElements = count($this->htmlObj->find($selector));
            for($i=0;$i<$cntElements;$i++){
                $this->htmlObj->find($selector,$i)->outertext = '<!-- W-Del '.$selector.' -->';
            } 
            $this->htmlObj->load($this->htmlObj->save());
        }
    }
    
    public function delAllWrapper($selector){
        if(is_object( $this->htmlObj->find($selector,0) ) ){
            $cntElements = count($this->htmlObj->find($selector));
            for($i=0;$i<$cntElements;$i++){
                $this->htmlObj->find($selector,$i)->outertext = $this->htmlObj->find($selector,$i)->innertext.'<!-- W-Del '.$selector.' -->';
            }
            $this->htmlObj->load($this->htmlObj->save());
        }
    }
    
    //</Del From Object Function>
    
}


class updOldArtsModel
{
    private $ci;
    
    function __construct() {
        $this->ci =& get_instance();
    }
    
    public function getArticles($sqlWhere,$cntArts=1){
        $sql = "SELECT * FROM `article` WHERE {$sqlWhere} LIMIT {$cntArts}";
        $query = $this->ci->db->query($sql);
        if($query->num_rows() < 1){ return false; }
        
        $result = array();
        
        foreach ($query->result_array() as $row){
            $result[] = $row;
        }
        
        return $result;
    }
    
    public function updArticleInDB($articleData){
        if(!is_array($articleData)){ return false; }
        
        $sql = "UPDATE `article` SET `text`=? WHERE `id`=? LIMIT 1";
        $sqlData = array($articleData['text'], $articleData['id']);
        
        return $this->ci->db->query($sql,$sqlData);
    }
}
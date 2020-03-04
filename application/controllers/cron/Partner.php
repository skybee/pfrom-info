<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Partner extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('sbadmin/Partner_m');
    }
    
    function index(){}
    
    function search_partner_arts(){
        header("Content-type:text/plain; Charset=utf-8");
        set_time_limit(300);
        
        $searchedArts = $this->Partner_m->searchPartnerArts(3);
        
        if($searchedArts == NULL){
            echo "Not Found Partner Arts \n";
            return FALSE;
        }
        
        foreach ($searchedArts as $artData){
            $artData['partner_name'] = $this->getParentName($artData['text']);
            if($this->Partner_m->addPartnerArts($artData)){
                echo "ADD OK - ID: {$artData['id']} | PartnerName: {$artData['partner_name']} \n";
            }
            else{
                echo "ERROR - ID: {$artData['id']} | PartnerName: {$artData['partner_name']} \n";
            }
        }
    }
    
    private function getParentName($text){
        $pattern_nameAr = array(
            ["#//(www\.|)(amzn\.to|amazon\.com)#i", 'Amazon'],
            ["#//(www\.|)(goto\.walmart\.com|walmart.com)#i", 'Walmart'],
        );
        
        $partnerName = '';
        
        foreach ($pattern_nameAr as $pattern_name){
            if(preg_match($pattern_name[0], $text)){
                $partnerName .= $pattern_name[1].'/ ';
            }
        }
        
        return $partnerName;
    }
    
    function rewrite_amz_link($cnt=1){
        header("Content-type:text/plain; Charset=utf-8");
        set_time_limit(300);
        
        $this->load->library('partner/Rewrite_link_lib');
        $cnt = (int)$cnt;
        $useProxy = TRUE; //FALSE;
        $myAmzTag = 'newsexpress04-20';
        
        $artsAr = $this->Partner_m->getArtsForUpd($cnt);
        
        foreach($artsAr as $artData){
            $linksAr = $this->rewrite_link_lib->findLinks($artData['text']); //получение span ссылок из статьи

            if($linksAr == NULL ){
                echo "\nNot Link in text\n";
                $this->Partner_m->updPartnerArt($artData['id']);
                continue;
            }
            
            foreach ($linksAr as $key => $linkData){ //обход и преобразование ссылок
                if($linkData['partner'] == 'Amazon'){
                    $realUrl = $this->rewrite_link_lib->getProductRealUrl($linkData['src'],$useProxy);
                    sleep(1);
                    
                    $myUrl = $this->rewrite_link_lib->createMyAmzLink($realUrl,$myAmzTag);
                    $linksAr[$key]['src'] = $myUrl;
                    
//                    echo "\n".$linkData['src']."\n".$realUrl."\n";
                    echo "\n"."-My: ".$myUrl;
//                    echo "\n---------------------------------------\n";
                    flush();
                }
            }
            
            $changedHtml = $this->rewrite_link_lib->changeLinkInTxt($artData['text'], $linksAr);
            if($changedHtml===false){
                echo "Links Count Error";
                return FALSE;
            }
            
            $artData['text'] = $changedHtml;
            
            if($this->Partner_m->updArt($artData)){ //UPD Ok
                echo "\n UPD Ok | ID: ".$artData['id'];
                if($this->Partner_m->updPartnerArt($artData['id'])){
                    echo " | Partner UPD Ok";
                }
            }
            else{ //UPD Error
                echo "\n UPD Error | ID: ".$artData['id'];
            }
            echo "\n-------------------------------------------------------------------------\n";
            flush();
//            print_r($linksAr);
            
            
//            echo "\n\n------------------------- ORIGIN ----------------------------\n\n";
//            echo $artData['text'];
//            echo "\n\n------------------------- /ORIGIN ----------------------------\n\n";
//            echo "\n\n------------------------- CHANGED ----------------------------\n\n";
//            echo $changedHtml;
//            echo "\n\n------------------------- /CHANGED ----------------------------\n\n";
            
        }
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Minox_lib{
    
    private $CI,$LinksTxtAr,$minoxArt=false,$payArticleMark=3;//3-маркер минокса в БД
    
    function __construct() {
        $this->CI =& get_instance();
    }
    
    function addLinkToTxt($txt,$pay_article){
        if(mt_rand(1,10000) <= 10){ $this->markMinArticles(); } //upd mark in DB (1/1000 loaded)
        
        if($pay_article != 3 || $this->isBot()){ return $txt; }
        
        $this->minoxArt = true;
        
        return $this->insertLinkInTxt($txt);
    }
    
    function getLinkToMinoxPage($linkAttr=''){
        mt_srand( abs( crc32($_SERVER['REQUEST_URI']) ) );
        if(mt_rand(1,10000)>50)  // 10000/50 показ на каждой 200й страницеs
        { 
            mt_srand();
            return '';
        }
        
        $sql = "SELECT "
                . "`article`.`url_name`, `article`.`id`, `article`.`title`, "
                . "`category`.`full_uri` "
                . "FROM "
                . "`article`, `category` "
                . "WHERE "
                . "`article`.`pay_article` = '3' "
                . "AND "
                . "`category`.`id` = `article`.`cat_id` ";
        
        $query = $this->CI->db->query($sql);
        
        $resultArtsAr = array();
        
        if($query->num_rows()>=1){
            foreach ($query->result_array() as $row){
                $resultArtsAr[] = $row;
            }
        }
        
        if(count($resultArtsAr)<1)
        {
            mt_srand();
            return '';
        }
        
        $rndArtData = $resultArtsAr[mt_rand(0,count($resultArtsAr)-1)];
        
        $linkTxt =  "<a {$linkAttr} href=\"/".LANG_CODE."/{$rndArtData['full_uri']}-{$rndArtData['id']}-{$rndArtData['url_name']}.html\" class=\"right-last-news-item\" >"
                    . "Minoxidil: ".$rndArtData['title']
                    . "</a>";
        
        mt_srand();
        return $linkTxt;
    }
    
    
    private function markMinArticles(){ //add mark to articles in BD
        $sql =  "UPDATE `article` SET `pay_article`='{$this->payArticleMark}' "
                ."WHERE MATCH (`title`,`text`) AGAINST ('minoxidil') ";
        $this->CI->db->query($sql);
    }
    
    private function insertLinkInTxt($txt){
        $rndTxt     = $this->getRndLink();
        $minoxLink  = '<br /><a href="http://minoxidil-ua.com/" target="_blank" class="out-link">'.$rndTxt.'</a>';
        $txt = preg_replace("#<\!--MinxLink-->#iu", $minoxLink, $txt, 1); 
        
        return $txt;
    }
    
    private function getRndLink($int=1) {
        $linksTxtAr = $this->getLinksTxtAr();
        
        mt_srand( abs( crc32($_SERVER['REQUEST_URI'])*$int ) );
        $rndTxt = $linksTxtAr[mt_rand(0,count($linksTxtAr)-1)];
        mt_srand();
        
        return $rndTxt;
    }
    
    private function getLinksTxtAr(){
        $linksTxt = [
                        'Buy Minoxidil 5% Kirkland in Ukraine',
                        'Buy Minoxidil 5% Kirkland ',
                        'Buy Minoxidil 5% Kirkland for women in Ukraine',
                        'Buy Minoxidil 5% Kirkland for women ',
                        'Buy Minoxidil 5% Kirkland for beard in Ukraine',
                        'Buy Minoxidil 5% Kirkland for beard ',
                        'Buy Minoxidil 5% Rogaine in Ukraine',
                        'Buy Minoxidil 5% Rogaine ',
                        'Buy Minoxidil 5% Rogaine for women in Ukraine',
                        'Buy Minoxidil 5% Rogaine for women ',
                        'Buy Minoxidil 5% Rogaine for beard in Ukraine',
                        'Buy Minoxidil 5% Rogaine for beard ',
                        'Buy Minoxidil 5% in Ukraine',
                        'Buy Minoxidil 5% ',
                        'Buy Minoxidil 5% for women in Ukraine',
                        'Buy Minoxidil 5% for women ',
                        'Buy Minoxidil 5% for beard in Ukraine',
                        'Buy Minoxidil 5% for beard ',
                        'Buy Minoxidil 10% Kirkland in Ukraine',
                        'Buy Minoxidil 10% Kirkland ',
                        'Buy Minoxidil 10% Kirkland for women in Ukraine',
                        'Buy Minoxidil 10% Kirkland for women ',
                        'Buy Minoxidil 10% Kirkland for beard in Ukraine',
                        'Buy Minoxidil 10% Kirkland for beard ',
                        'Buy Minoxidil 10% Rogaine in Ukraine',
                        'Buy Minoxidil 10% Rogaine ',
                        'Buy Minoxidil 10% Rogaine for women in Ukraine',
                        'Buy Minoxidil 10% Rogaine for women ',
                        'Buy Minoxidil 10% Rogaine for beard in Ukraine',
                        'Buy Minoxidil 10% Rogaine for beard ',
                        'Buy Minoxidil 10% in Ukraine',
                        'Buy Minoxidil 10% ',
                        'Buy Minoxidil 10% for women in Ukraine',
                        'Buy Minoxidil 10% for women ',
                        'Buy Minoxidil 10% for beard in Ukraine',
                        'Buy Minoxidil 10% for beard ',
                        'Buy Minoxidil 2% Kirkland in Ukraine',
                        'Buy Minoxidil 2% Kirkland ',
                        'Buy Minoxidil 2% Kirkland for women in Ukraine',
                        'Buy Minoxidil 2% Kirkland for women ',
                        'Buy Minoxidil 2% Kirkland for beard in Ukraine',
                        'Buy Minoxidil 2% Kirkland for beard ',
                        'Buy Minoxidil 2% Rogaine in Ukraine',
                        'Buy Minoxidil 2% Rogaine ',
                        'Buy Minoxidil 2% Rogaine for women in Ukraine',
                        'Buy Minoxidil 2% Rogaine for women ',
                        'Buy Minoxidil 2% Rogaine for beard in Ukraine',
                        'Buy Minoxidil 2% Rogaine for beard ',
                        'Buy Minoxidil 2% in Ukraine',
                        'Buy Minoxidil 2% ',
                        'Buy Minoxidil 2% for women in Ukraine',
                        'Buy Minoxidil 2% for women ',
                        'Buy Minoxidil 2% for beard in Ukraine',
                        'Buy Minoxidil 2% for beard ',
                        ' Minoxidil 5% Kirkland in Ukraine',
                        ' Minoxidil 5% Kirkland ',
                        ' Minoxidil 5% Kirkland for women in Ukraine',
                        ' Minoxidil 5% Kirkland for women ',
                        ' Minoxidil 5% Kirkland for beard in Ukraine',
                        ' Minoxidil 5% Kirkland for beard ',
                        ' Minoxidil 5% Rogaine in Ukraine',
                        ' Minoxidil 5% Rogaine ',
                        ' Minoxidil 5% Rogaine for women in Ukraine',
                        ' Minoxidil 5% Rogaine for women ',
                        ' Minoxidil 5% Rogaine for beard in Ukraine',
                        ' Minoxidil 5% Rogaine for beard ',
                        ' Minoxidil 5% in Ukraine',
                        ' Minoxidil 5% ',
                        ' Minoxidil 5% for women in Ukraine',
                        ' Minoxidil 5% for women ',
                        ' Minoxidil 5% for beard in Ukraine',
                        ' Minoxidil 5% for beard ',
                        ' Minoxidil 10% Kirkland in Ukraine',
                        ' Minoxidil 10% Kirkland ',
                        ' Minoxidil 10% Kirkland for women in Ukraine',
                        ' Minoxidil 10% Kirkland for women ',
                        ' Minoxidil 10% Kirkland for beard in Ukraine',
                        ' Minoxidil 10% Kirkland for beard ',
                        ' Minoxidil 10% Rogaine in Ukraine',
                        ' Minoxidil 10% Rogaine ',
                        ' Minoxidil 10% Rogaine for women in Ukraine',
                        ' Minoxidil 10% Rogaine for women ',
                        ' Minoxidil 10% Rogaine for beard in Ukraine',
                        ' Minoxidil 10% Rogaine for beard ',
                        ' Minoxidil 10% in Ukraine',
                        ' Minoxidil 10% ',
                        ' Minoxidil 10% for women in Ukraine',
                        ' Minoxidil 10% for women ',
                        ' Minoxidil 10% for beard in Ukraine',
                        ' Minoxidil 10% for beard ',
                        ' Minoxidil 2% Kirkland in Ukraine',
                        ' Minoxidil 2% Kirkland ',
                        ' Minoxidil 2% Kirkland for women in Ukraine',
                        ' Minoxidil 2% Kirkland for women ',
                        ' Minoxidil 2% Kirkland for beard in Ukraine',
                        ' Minoxidil 2% Kirkland for beard ',
                        ' Minoxidil 2% Rogaine in Ukraine',
                        ' Minoxidil 2% Rogaine ',
                        ' Minoxidil 2% Rogaine for women in Ukraine',
                        ' Minoxidil 2% Rogaine for women ',
                        ' Minoxidil 2% Rogaine for beard in Ukraine',
                        ' Minoxidil 2% Rogaine for beard ',
                        ' Minoxidil 2% in Ukraine',
                        ' Minoxidil 2% ',
                        ' Minoxidil 2% for women in Ukraine',
                        ' Minoxidil 2% for women ',
                        ' Minoxidil 2% for beard in Ukraine',
                        ' Minoxidil 2% for beard '
                    ];
        
        return $linksTxt;
    }
    
    private function isBot(){ //определять бота анализаторов ссылок
        $pattern = "#(LinkpadBot|SolomonoBot|rogerBot|Exabot|MJ12bot|DotBot|Gigabot|AhrefsBot|Yahoo|msnbot|bingbot|SemrushBot|Blekkobot|megaindex)#i";
        
        if( preg_match( $pattern, $_SERVER['HTTP_USER_AGENT']) ){
            return true;
        }
        else{
            return false; 
        }
    }
}



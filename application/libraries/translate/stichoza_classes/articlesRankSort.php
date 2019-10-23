<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class articlesRankSort{
    private $atrsArray;
    
    function __construct() {
        $this->atrsArray = [];
    }
    
    function addArts($artsAr){
        if(is_array($artsAr)){
            $this->atrsArray = array_merge($this->atrsArray, $artsAr);
        }
    }
    
    function sortByRank(){
        $tmpAr = $this->atrsArray;
        usort($tmpAr,function($a,$b){
            if ($a['rank'] == $b['rank']){ return 0; }
            return ($a['rank'] > $b['rank']) ? -1 : 1;
        });
        $this->atrsArray = $tmpAr;
    }
    
    function getSortedArray(){
        $this->sortByRank();
        
        return $this->atrsArray;
    }
}
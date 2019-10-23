<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class cleanArtToTranslate{
    private $originTxt,$txtMarkers;
    
    function setText($txt){
        $txt = $this->delTagFromTxt($txt);
        $this->originTxt = $txt;
    }
    
    function getText(){
        return $this->originTxt;
    }
    
    function tagToMarker(){ //замена тегов на маркер X1
        $pattern = "#<[\s\S]+?>#i";
        preg_match_all($pattern, $this->originTxt, $matches);
        $marksTxt = $this->originTxt;
        
        $marksTxt = preg_replace("/X(\d+)/i",    "Х-$",    $marksTxt);
        $marksTxt = preg_replace($pattern,  'X1',  $marksTxt);
        $marksTxt = preg_replace("/X1 /i", 'X1',  $marksTxt);
        $marksTxt = preg_replace("/X1(\d)/i", 'X1 $1',  $marksTxt);
        $marksTxt = preg_replace("#\s{2,}#i", ' ',  $marksTxt);
        
        $marksTxt = $this->joinMarks($marksTxt);
        $this->originTxt =  $marksTxt;
        $this->txtMarkers = $matches[0];
    }
    function markerToTag(){ //замена маркеров X1 на теги из массива $this->txtMarkers
        
        $pattern    = "/X1/i";
        $txt        = $this->originTxt;
        $marksAr    = $this->txtMarkers;
        
        $txt        = $this->UnJoinMarks($txt);
        
        foreach ($marksAr as $txtMarkers){
            $txt = preg_replace($pattern,$txtMarkers, $txt, 1);
        }
        
        $this->originTxt = $txt;   
    }
    
    private function joinMarks($marksTxt){ //компановка X1 маркеров X1X1X1 > Xn
        $pattern = "/(X1){2,}/i";
        preg_match_all($pattern,$marksTxt,$matches);
        
        $joinedAr = $matches[0];
        foreach($joinedAr as $marksStr){
            $marksStrLengt = mb_strlen($marksStr);
            $joinedCnt = $marksStrLengt/2;
            $marksTxt = preg_replace("/{$marksStr}/i", "X{$joinedCnt}", $marksTxt, 1);
        }
        $marksTxt = preg_replace("/(X\d+)/i", " $1 ", $marksTxt);
        
        return $marksTxt;
        
    }
    private function UnJoinMarks($marksTxt){ //распаковка Xn маркеров Xn > X1X1X1 
        $pattern = "#X([2-9]\d*)#i";
        
        while(preg_match($pattern, $marksTxt, $matches)){ //поиск и замена X2+ 
            preg_match($pattern, $marksTxt, $matches);
            
            $markSerch      = $matches[0];
            $markCnt        = (int) $matches[1];
            $marksReplace   = '';
            
            for($i=1;$i<=$markCnt;$i++){ // составление строки из X1
                $marksReplace .= 'X1';
            }
            
            $marksTxt = str_ireplace($markSerch, $marksReplace, $marksTxt);
        }
        
        return $marksTxt;
    }
    
    private function delTagFromTxt($marksTxt){
        $marksTxt = preg_replace("#<script[\s\S]*</script>#i", ' ', $marksTxt);
        $marksTxt = strip_tags($marksTxt,'<p><span><br><img><strong><i><video>');
        
        return $marksTxt;
    }
}
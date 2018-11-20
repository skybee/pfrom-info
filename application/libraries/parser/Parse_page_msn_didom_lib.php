<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once('./application/libraries/DiDOM/src/DiDom/ClassAttribute.php');
require_once('./application/libraries/DiDOM/src/DiDom/Document.php');
require_once('./application/libraries/DiDOM/src/DiDom/Element.php');
require_once('./application/libraries/DiDOM/src/DiDom/Encoder.php');
require_once('./application/libraries/DiDOM/src/DiDom/Errors.php');
require_once('./application/libraries/DiDOM/src/DiDom/Query.php');
require_once('./application/libraries/DiDOM/src/DiDom/StyleAttribute.php');
require_once('./application/libraries/DiDOM/src/DiDom/Exceptions/InvalidSelectorException.php');
use DiDom\ClassAttribute;
use DiDom\Document;
use DiDom\Element;
use DiDom\Encoder;
use DiDom\Errors;
use DiDom\Query;
use DiDom\StyleAttribute;
use DiDom\Exceptions\InvalidSelectorException;


class Parse_page_msn_didom_lib{
   
    public $donorData, $cleaner, $data = array('img'=>false,'title'=>false,'description'=>false,'text'=>false,'date'=>false,'canonical'=>false);
    public $htmlObj, $articleBodyObj;
    
    function __construct() {}
    
    function get_data( $html, $donorData ){
        $html = $this->predParseHTML( $html );
        $this->htmlObj =  new Document();
        $this->htmlObj->loadHtml($html);
        if( !is_object($this->htmlObj) ) return false;
        
        $this->parseDOM();
        
        $this->data['text'] =  video_replace_lib::get_video_tags( $this->data['text'] );
        
        $returnData = $this->data;
        
        //=== Delete Last Data ===//
        $this->htmlObj          = NULL;
        $this->articleBodyObj   = NULL;
        $this->donorData        = NULL;
        $this->cleaner          = NULL;
        $this->data             = array('img'=>false,'title'=>false,'description'=>false,'text'=>false,'date'=>false,'canonical'=>false);
        //=== Delete Last Data ===//
        
        return $returnData; 
    }
    
    
    function parseDOM(){
        if( $this->htmlObj->has('.collection-headline h1') ){
            $this->data['title'] = $this->htmlObj->find('.collection-headline h1')[0]->innerHtml();
        }
        elseif($this->htmlObj->has('.collection-headline-flex h1')){ //new page stile
            $this->data['title'] = $this->htmlObj->find('.collection-headline-flex h1')[0]->innerHtml();
        }
        
        $this->data['title'] = trim($this->data['title']);
        
        if( $this->htmlObj->has('section.articlebody') ){
//            $this->articleBodyObj = $this->htmlObj->find('section.articlebody',0);
            $this->changeVideo();
            $this->imgInTxt();
            $this->slideerRewrite();
            $this->delTagFromObj();
            $this->changeLink();
            
            
            $htmlTxt = $this->htmlObj->find('section.articlebody')[0]->innerHtml();
            $htmlTxt = $this->delHtmlTagData($htmlTxt);
            $htmlTxt = $this->delAttrFromHtml($htmlTxt);
            $htmlTxt = $this->delTagFromHtml($htmlTxt);
            $htmlTxt = preg_replace("#<(/|)h1#iu", "<$1h2", $htmlTxt); // h1 to h2
            $htmlTxt = $this->addLikeMarker($htmlTxt, 500);
            $htmlTxt = iconv('utf-8', 'utf-8//IGNORE', $htmlTxt ); //исправление некорректных символов
            $this->data['text'] = '<div data-parse-version="1" class="parse-version p-version-1">'.$htmlTxt.'</div>';
        }
        
        #<DonorData>
        
        if( $this->htmlObj->has('.sourcename-txt a') ){
            $this->data['donor-data']['name'] = $this->htmlObj->find('.sourcename-txt a')[0]->innerHtml();
            
            $donorUrl   = $this->htmlObj->find('.sourcename-txt a')[0]->attr('href');
            $donorUrlAr = parse_url($donorUrl);
            
            $this->data['donor-data']['host'] = trim($donorUrlAr['host']);
        }
        elseif ( $this->htmlObj->has('.partnerlogo-img a') ) { // ===== new page style =====
            $this->data['donor-data']['name'] = $this->htmlObj->find('.partnerlogo-img a')[0]->attr('title');
            
            $donorUrl   = $this->htmlObj->find('.partnerlogo-img a')[0]->attr('href');
            $donorUrlAr = parse_url($donorUrl);
            
            $this->data['donor-data']['host'] = trim($donorUrlAr['host']);
        }
        else{   
            if($this->htmlObj->has('.sourcename-txt')){ //получение хоста по имени из массива сохраненных
                $donorName      = trim($this->htmlObj->find('.sourcename-txt')[0]->innerHtml());
                echo "<br />\n--Text Source--".$donorName."--/Text Source--\n<br />";
                $donorInfoAr    = get_donor_info_by_name($donorName);
                
                if(is_array($donorInfoAr))
                {
                    $this->data['donor-data']['name'] = $donorName;
                    $this->data['donor-data']['host'] = $donorInfoAr['host'];
                }
            }
            
            if(isset($donorInfoAr) == false OR $donorInfoAr == false)
            {
                $this->data['donor-data']['host'] = 'www.msn.com';
                $this->data['donor-data']['name'] = 'MSN';
                if($this->htmlObj->has('link[rel=shortcut icon]') ){
                    $this->data['donor-data']['img'] = 'http:'.$this->htmlObj->find('link[rel=shortcut icon]')[0]->attr('href');
                }
            }
        }
        
        if($this->htmlObj->has('meta[name=description]')){
            $description = $this->htmlObj->find('meta[name=description]')[0]->attr('content');
            $this->data['description'] = $this->getBigDescription($description, $this->data['text'], 600, 1500);
        }
        
        if( $this->htmlObj->find('link[rel=canonical]') ){
            $this->data['canonical'] = $this->htmlObj->find('link[rel=canonical]')[0]->attr('href');
        }
        #</DonorData>
    }
    
    
    //  < parseDOM Function >
    
    private function changeVideo(){
        if( !$this->htmlObj->has('.wcvideoplayer') ){
            return false;
        }
        
        foreach($this->htmlObj->find('.wcvideoplayer') as $key => $videoObj){
            $metaData   = $videoObj->attr('data-metadata');
            $metaData   = html_entity_decode($metaData);
            $metaDataAr = json_decode($metaData,true);
//            print_r($metaDataAr);
            
            $htmlVideo = '<video width="100%" height="auto"  poster="'.$metaDataAr['headlineImage']['url'].'" controls > '
                    . '<source src="'.$metaDataAr['videoFiles'][0]['url'].'" > '
                    . 'Your browser does not support this video'
                    . '</video>';
            
//            $videoObj->outertext = $htmlVideo;
            $videoElement = new Element('span');
            $videoElement->setInnerHtml($htmlVideo);
            $this->htmlObj->find('.wcvideoplayer')[$key]->replace($videoElement);
        }
    }

    private function imgInTxt(){
        if( !$this->htmlObj->has('img') ){
            return false;
        }
        
        foreach($this->htmlObj->find('img') as $imgObj){
            if( !$imgObj->hasAttribute('data-src') ){
                continue;
            }
            
            $imgJson    = $imgObj->attr('data-src');
            $imgJson    = html_entity_decode($imgJson);
            $imgAr      = json_decode($imgJson, true);
            if(is_array($imgAr['default']))
            {
                $imgSrc     = 'http:'.$imgAr['default']['src'];
            }
            else
            {
                $imgSrc     = 'http:'.$imgAr['default'];
            }
            
            //<MaxImgSize>
            preg_match("#w=(\d+)#iu", $imgSrc, $matches);
//            print_r($matches);
            if(isset($matches[1]) && $matches[1] > 800) // 616 px
            {
                $searchAr   = array("#h=\d{2,4}#iu","#w=\d{2,4}#iu","#q=\d{1,2}#iu");
                $replaceAr  = array("h=","w=800");
                $imgSrc     = preg_replace($searchAr, $replaceAr, $imgSrc);
            }
            //</MaxImgSize>
            
            $imgSrc = preg_replace("#q=\d{1,2}#iu", "q=100", $imgSrc); // quality 100%
            
//            echo $imgSrc."\n\n" ;
            
            $imgObj->attr('src',$imgSrc);
            
            if( $imgObj->hasAttribute('alt') || empty($imgObj->attr('alt')) )
            {
                $imgObj->attr('alt',$this->data['title']);
            }
            $imgObj->removeAttribute('data-src');
        }
    } 
    
    private function slideerRewrite(){
        if( !$this->htmlObj->has('.inline-slideshow') )
        {
            return false;
        }
        
        foreach($this->htmlObj->find('.inline-slideshow') as $key => $sliderObj)
        {
            $i=0;
            foreach($this->htmlObj->find('.inline-slideshow')[$key]->find('ul.slideshow li') as $key2 => $slideLi)
            {
                $slideTxtData  = $sliderObj->find('.gallerydata div.slidemetadata-container')[$i]->html();
                $slideTxtData .= $sliderObj->find('.gallerydata div.body-text')[$i]->html();
                
//                $slideLi->setInnerHtml($slideLi->innerHtml()."\n".$slideTxtData);
                $this->htmlObj->find('.inline-slideshow')[$key]->find('ul.slideshow li')[$key2]->setInnerHtml($slideLi->innerHtml()."\n".$slideTxtData);
                $i++;
            }
            
            $sliderObj->find('.gallerydata')[0]->remove();
        }
    }
    
    private function delTagFromObj(){
        
        $this->delAll('div.thumbnail-container'); //del fullScreen btn in photoSlider
        $this->delAllWrapper('div.arsegment'); //del virtual page tag
        
        $this->delAll('#findacar'); // del auto search block 
        $this->delAll('button'); // del all <button>
        $this->delAll('div.ec-module'); //msn <iframe> in div.ec-module
        $this->delAll('div.msnews-container'); //msnNewsBlock .msnews-container
        $this->delAll('div.autos_rlc1'); //autos_rlc1 search block in Auto
        $this->delAll('div.researchcars'); //autos search block in Auto
        $this->delAll('style'); //style in text
       
        
        //<video player content>
        $this->delAll('div.metadata'); //del video info
        $this->delAll('div.playlist-and-storepromo'); //del video info
        $this->delAll('div.nextvideo-outer'); //del video info
        //<video player content>     
    }
    
    private function delHtmlTagData($html){
        $pattern = "#data-[\w-]+\s*=\s*\"[\s\S]*?\"#iu";
        
        $cleanHtml = preg_replace($pattern, '', $html);
        
        return $cleanHtml;
    }
    
    private function delTagFromHtml($html){
        
        $pattern = "#</?(figure|figcaption)[\S\s]*?>#iu";
        $newHtml = preg_replace($pattern, '', $html);
        
        $patternP = "#<p>\s*</p>#iu";
        $newHtml = preg_replace($patternP, '', $newHtml);
        
        return $newHtml;
    }
    
    private function delAttrFromHtml($html){
        
        $patternXmlns   = "#xmlns=\"http://www.w3.org/1999/xhtml\"#iu";
        $newHtml        = preg_replace($patternXmlns, '', $html);
        
        $patternSpace   = "#\s+>#iu"; //space in tag 
        $newHtml        = preg_replace($patternSpace, '>', $newHtml);
        
        $patternSpace2  = "#>\s+#iu"; //space in tag 
        $newHtml        = preg_replace($patternSpace2, '> ', $newHtml);
        
        $patternSpace3  = "#\s+<#iu"; //space in tag 
        $newHtml        = preg_replace($patternSpace3, ' <', $newHtml);
        
        return $newHtml;
    }
    
    private function getBigDescription($descripion, $txtHtml, $minLenth=300, $maxLenth = 1500){
        
        $descripion = str_ireplace('...', '', $descripion);
        
        $descLenth = $this->txtLenth($descripion);
        if($descLenth > $minLenth){
            if($descLenth > $maxLenth)
            {
                $descripion = $this->get_short_txt($descripion, $maxLenth, 'dot');
                #echo "\n\n<br />Max Lenth - ".$maxLenth."<br />\n\n";
            }
            $descripion  = preg_replace("#\.[^\.]+$#iu", '.', $descripion);
            return $descripion;
        }
        
        $intPlusDesc = $minLenth - $descLenth + 30; //30 - deleted search str

        $text       = strip_tags($txtHtml);
        
        $searchDescriptSrt = $this->getSearchDescription($descripion);
        if($searchDescriptSrt)
        {
            $pos        = mb_stripos($text, $searchDescriptSrt);
            if($pos!==false)
            {
                $descPlus   = mb_substr($text, $pos, $intPlusDesc);
                $descPlus   = str_ireplace($searchDescriptSrt, ' ', $descPlus);
                $descPlus   = preg_replace("#\.[^\.]+$#iu", '.', $descPlus);
                
                $descripion .=  $descPlus;
            }
            elseif($this->htmlObj->has('section.articlebody')){ //add text in <p/> to description
                $articleObj = $this->htmlObj->find('section.articlebody')[0];
                if($articleObj->has('span.storyimage')[0])
                {
                    $articleObj->find('span.storyimage')[0]->remove();
                }
                if($articleObj->has('p')[1])
                {
                    $pTxt   = $articleObj->find('p')[1]->innerHtml();
                    $pTxt   = strip_tags($pTxt);
                    $descPlus   = mb_substr($pTxt, 0, $intPlusDesc+30); //+30 - deleted search text in upper function
                    $descPlus   = preg_replace("#\.[^\.]+$#iu", '.', $descPlus);
                    
                    $descripion .=  $descPlus;
                }
            }
        }
        
        return $descripion;
    }
    
    private function txtLenth($html){
        $text   = strip_tags($html);
        $text   = preg_replace("#[/,:;\!\?\(\)\.\s]#iu", '', $text);
        $lenth  = mb_strlen($text);
        
        return $lenth;
    }
    
    private function getSearchDescription($descripion){
        if(preg_match("#.{30}$#iu", $descripion, $arr))
        {
            return $arr[0];
        }
        else
        {
            return false;
        }
    }
    
    private function changeLink(){
        if($this->htmlObj->has('a')[0] == false){
            return false;
        }
        
        foreach($this->htmlObj->find('a') as $key => $linkObj){
            $anchor = $linkObj->innertext;
            $href   = $linkObj->href;
            
            $spanLink = '<span class="out-link" src="'.$href.'">'.$anchor.'</span>';
            
//            $linkObj->outertext = $spanLink;
            $aSpanElement = new Element('span'); 
            $aSpanElement->setInnerHtml($spanLink);
            $this->htmlObj->find('a')[$key]->remove($aSpanElement);
        }
    }
    
    private function addLikeMarker($htmlTxt, $afterCntSimbol = 500){
        $startAfterCntSimbol = $afterCntSimbol;
        $marker     = '<!--likeMarker-->'; //"\n".'<h1>likeMarker</h1>'."\n";
        $tmpHtml    = $htmlTxt;
        $pArr       = explode('</p>', $tmpHtml);
        
        if(count($pArr)<1){ return $htmlTxt; /*######*/ }
        
        $cntSimbol = 0;
        foreach($pArr as $pStr)
        {
            $pStr .= '</p>';
            $pLenth = $this->txtLenth($pStr);
            
            $cntSimbol = $cntSimbol + $pLenth;
            
            if($cntSimbol >= $afterCntSimbol){
                $afterCntSimbol = round($afterCntSimbol * 1.2);
                $cntSimbol = 0;
                preg_match("#.{30}$#iu", $pStr, $matches);
                
                $searchStr  = $matches[0];
                $replaceStr = $searchStr.$marker;
                $replaceStr = str_ireplace('</p>', '<!--#--></p>', $replaceStr); //уникализация строки для исключения дублирования замены
                
//                echo $searchStr."<br />\n";
                
                $htmlTxt = str_ireplace($searchStr, $replaceStr, $htmlTxt);
            }
        }
        
        $lastCntTxt = round($startAfterCntSimbol * 0.7);
        
        $htmlTxt = preg_replace("#{$marker}(.{0,{$afterCntSimbol}})$#iu", "$1", $htmlTxt);
        $htmlTxt = $marker.$htmlTxt;
        return $htmlTxt;
    }
    
    private function get_short_txt( $text, $length = 100, $txtFin = 'word' ){
        $text = strip_tags($text);
        $text = mb_substr($text, 0, $length);
        
        if( $txtFin == 'word' ){
            $replacePattern = "# \S+$#i";
            $replace = '';
        }
        elseif( $txtFin == 'dot' ){
            $replacePattern = "#\. [^\.]+$#i";
            $replace = '.';
        }
        
        $text = preg_replace( $replacePattern, $replace, $text );
        
        return $text;
    }
    
    //  </ parseDOM Function >
    
    
    //<Del From Object Function>
    
    private function delSingle($selector, $key){
        if( $this->htmlObj->has($selector)[$key] ){
            $this->htmlObj->find($selector)[$key]->remove();
//            $this->htmlObj->loadHtml($this->htmlObj->html());
        }
    }
    
    private function delAll( $selector ){
        if( $this->htmlObj->has($selector) ){
            $cntElements = count($this->htmlObj->find($selector));
//            for($i=0;$i<$cntElements;$i++){
//                $this->htmlObj->find($selector)[$i]->remove();
//            }
            foreach ($this->htmlObj->find($selector) as $nextElement){
                $nextElement->remove();
            }
//            $this->htmlObj->loadHtml($this->htmlObj->html());            
        }
    }
    
    private function delAllWrapper($selector){
        if( $this->htmlObj->has($selector) ){
            $cntElements = $this->htmlObj->count($selector);
//            for($i=0;$i<$cntElements;$i++){
//                $element = new Element('span');
//                $element->setInnerHtml( $this->htmlObj->find($selector)[$i]->innerHtml() );
//                $this->htmlObj->find($selector)[$i]->replace($element);
//            }
            foreach ($this->htmlObj->find($selector) as $key => $nextElement){
                $element = new Element('span');
                $element->setInnerHtml( $nextElement->innerHtml() );
                $nextElement->replace($element);
            }
            
//            $this->htmlObj->loadHtml($this->htmlObj->html()); 
        }
    }
    
    //</Del From Object Function>
    
    
    function predParseHTML( $html ){ return $html; }
}
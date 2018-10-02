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

//$document = new Document($html);

class Parse_page_didom_lib{
    function __construct() {}
    
    function get_data($html, $donorData){
        $parseObj   = new parseMsn( $donorData );
        
        return  $parseObj->get_data($html);
    }
}


abstract class parse_page{
    
    protected $donorData, $cleaner, $html_obj, $data = array('img'=>false,'title'=>false,'description'=>false,'text'=>false,'date'=>false,'canonical'=>false);
    
    function __construct( $donorData ) {
        $this->donorData = $donorData;
    }
    
    function get_data( $html ){
        
        $html = $this->predParseHTML( $html );
//        $this->html_obj = str_get_html($html);
        $this->html_obj = new Document($html); //DiDOM Create Object
        if( !is_object($this->html_obj) ) return false;
//        $this->cleaner  = new cleanDOM( $this->html_obj );
        $this->parseDOM();
        
        unset( $this->html_obj );
        
        $this->data['text'] =  video_replace_lib::get_video_tags( $this->data['text'] );
        
        return $this->data;
    }
    
    function predParseHTML( $html ){ return $html; }
    
    abstract protected function parseDOM();
    
    protected function getNbrMonthFromStr( $str ){
        $patternAr = array(1=>'янва','февр','март','апрел','ма(й|я)','июн','июл','август','сентяб','октяб','ноябр','декабр');
        
        foreach( $patternAr as $mNmbr => $pattern ){
            $pattern = "#".$pattern."#iu";
            if( preg_match($pattern, $str) ){
                if( $mNmbr < 10 ) $mNmbr = '0'.$mNmbr;
                return $mNmbr;
            }
        }
        
        return 5;
    }
    
}
  

class parseMsn extends parse_page{
    
    function parseDOM() {
        
        if( $this->html_obj->has('.collection-headline h1') ){
            $this->data['title'] = $this->html_obj->find('.collection-headline h1')[0]->text();
        }
        elseif( $this->html_obj->has('.collection-headline-flex h1') ){ //new page stile
            $this->data['title'] = $this->html_obj->find('.collection-headline-flex h1')[0]->text();
        }
        
        if( $this->html_obj->has('section.articlebody') ){
            $textObj = $this->html_obj->find('section.articlebody')[0];
            $textObj = $this->changeVideo($textObj);
            $textObj = $this->imgInTxt($textObj);
            $textObj = $this->slideerRewrite($textObj);
            $textObj = $this->delTagFromObj($textObj);
            $textObj = $this->changeLink($textObj);
            $htmlTxt = $textObj->innertext;
            $htmlTxt = $this->delHtmlTagData($htmlTxt);
            $htmlTxt = $this->delAttrFromHtml($htmlTxt);
            $htmlTxt = $this->delTagFromHtml($htmlTxt);
            $htmlTxt = preg_replace("#<(/|)h1#iu", "<$1h2", $htmlTxt); // h1 to h2
            $htmlTxt = $this->addLikeMarker($htmlTxt, 500);
            $htmlTxt = iconv('utf-8', 'utf-8//IGNORE', $htmlTxt ); //исправление некорректных символов
            $this->data['text'] = '<div data-parse-version="1" class="parse-version p-version-1">'.$htmlTxt.'</div>';
        }
        
        #<DonorData>
        if( $this->html_obj->has('.partnerlogo-img img') ){
            $imgJson    = $this->html_obj->find('.partnerlogo-img img')[0]->attr('data-src');
            
            $imgJson    = html_entity_decode($imgJson);
            $imgAr      = json_decode($imgJson, true);
            $imgSrc     = 'http:'.$imgAr['default'];

            $searchAr   = array("#h=\d{2,3}#iu","#w=\d{2,3}#iu","#q=\d{1,2}#iu");
            $replaceAr  = array("h=32","w=32","q=100");
            $imgSrc     = preg_replace($searchAr, $replaceAr, $imgSrc);
            
            $this->data['donor-data']['img'] = $imgSrc;
        }
        
        if( $this->html_obj->has('.sourcename-txt a') ){
            $this->data['donor-data']['name'] = $this->html_obj->find('.sourcename-txt a')[0]->text();
            
            $donorUrl   = $this->html_obj->find('.sourcename-txt a')[0]->attr('href');
            $donorUrlAr = parse_url($donorUrl);
            
            $this->data['donor-data']['host'] = trim($donorUrlAr['host']);
        }
        elseif ( $this->html_obj->has('.partnerlogo-img a') ) { // ===== new page style =====
            $this->data['donor-data']['name'] = $this->html_obj->find('.partnerlogo-img a')[0]->attr('title');
            
            $donorUrl   = $this->html_obj->find('.partnerlogo-img a')[0]->attr('href');
            $donorUrlAr = parse_url($donorUrl);
            
            $this->data['donor-data']['host'] = trim($donorUrlAr['host']);
        }
        else{   
            if( $this->html_obj->has('.sourcename-txt') ){ //получение хоста по имени из массива сохраненных
                $donorName      = trim( $this->html_obj->find('.sourcename-txt')[0]->text() );
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
                if( $this->html_obj->has('link[rel=shortcut icon]') ){
                    $this->data['donor-data']['img'] = 'http:'.$this->html_obj->find('link[rel=shortcut icon]')[0]->attr('href');
                }
            }
        }
        
        if( $this->html_obj->has('meta[name=description]') ){
            $description = $this->html_obj->find('meta[name=description]')[0]->attr('content');
            $this->data['description'] = $this->getBigDescription($description, $this->data['text'], 600, 1500);
            #echo "\n\n<br />------<br />\n".$this->data['description']."\n<br />------<br />\n\n";
        }
        
        if( $this->html_obj->has('link[rel=canonical]') ){
            $this->data['canonical'] = $this->html_obj->find('link[rel=canonical]')[0]->attr('href');
        }
        #</DonorData>
    }
    
    private function changeVideo($textObj){
        if(!$textObj->has('.wcvideoplayer')){
            return $textObj;
        }
        
        foreach($textObj->find('.wcvideoplayer') as $videoObj){
            $metaData   = $videoObj->attr('data-metadata');
            $metaData   = html_entity_decode($metaData);
            $metaDataAr = json_decode($metaData,true);
//            print_r($metaDataAr);
            
            $htmlVideo = '<video width="100%" height="auto"  poster="'.$metaDataAr['headlineImage']['url'].'" controls > '
                    . '<source src="'.$metaDataAr['videoFiles'][0]['url'].'" > '
                    . 'Your browser does not support this video'
                    . '</video>';
            
            
            $newTmpElement = new Element('span','Hello');
            
            $videoObj->first('div')->replace($newTmpElement);
//            $videoObj->setInnerHtml($htmlVideo);
            
            
            echo "\n\n\n--------------------------\n\n\n".$videoObj->html()."\n\n\n--------------------------\n\n\n";
            
//            $videoObj->outertext = $htmlVideo;
        }
        
        echo $textObj->html();
        
        return $textObj;
    }


    private function imgInTxt($textObj){
        if( !is_object($textObj->find('img',0)) )
        {
            return $textObj;
        }
        
        foreach($textObj->find('img') as $imgObj)
        {
            if(!isset($imgObj->attr['data-src']))
            {
                continue;
            }
            
            $imgJson    = $imgObj->attr['data-src'];
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
            if(isset($matches[1]) && $matches[1] > 616)
            {
                $searchAr   = array("#h=\d{2,4}#iu","#w=\d{2,4}#iu","#q=\d{1,2}#iu");
                $replaceAr  = array("h=","w=616");
                $imgSrc     = preg_replace($searchAr, $replaceAr, $imgSrc);
            }
            //</MaxImgSize>
            
            $imgSrc = preg_replace("#q=\d{1,2}#iu", "q=100", $imgSrc); // quality 100%
            
            $imgObj->attr['src'] = $imgSrc;
            
            if( !isset($imgObj->attr['alt']) || empty($imgObj->attr['alt']) )
            {
                $imgObj->attr['alt'] = $this->data['title'];
            }
            unset($imgObj->attr['data-src']);
        }
        
        return $textObj;
    } 
    
    private function slideerRewrite($textObj){
        if( !is_object($textObj->find('.inline-slideshow',0)) )
        {
            return $textObj;
        }
        
        foreach($textObj->find('.inline-slideshow') as $sliderObj)
        {
            $i=0;
            foreach($sliderObj->find('ul.slideshow li') as $slideLi)
            {
                $slideTxtData  = $sliderObj->find('.gallerydata div.slidemetadata-container',$i)->outertext;
                $slideTxtData .= $sliderObj->find('.gallerydata div.body-text',$i)->outertext;
                
                $slideLi->innertext = $slideLi->innertext."\n".$slideTxtData;
                $i++;
            }
            $sliderObj->find('.gallerydata',0)->outertext = '';
        }
        
        return $textObj;
    }
    
    private function delTagFromObj($textObj){
//        $cleaner  = new cleanDOM($textObj);
//        
//        $cleaner->delAll('div.thumbnail-container'); //del fullScreen btn in photoSlider
//        $cleaner->delAllWrapper('div.arsegment'); //del virtual page tag
//        
//        $cleaner->delAll('#findacar'); // del auto search block 
//        $cleaner->delAll('button'); // del all <button>
//        $cleaner->delAll('div.ec-module'); //msn <iframe> in div.ec-module
//        
//        //<video player content>
//        $cleaner->delAll('div.metadata'); //del video info
//        $cleaner->delAll('div.playlist-and-storepromo'); //del video info
//        $cleaner->delAll('div.nextvideo-outer'); //del video info
//        //<video player content>
        
        $textObj = staticCleanDOM::delAll($textObj,'div.thumbnail-container'); //del fullScreen btn in photoSlider
        $textObj = staticCleanDOM::delAllWrapper($textObj,'div.arsegment'); //del virtual page tag
        
        $textObj = staticCleanDOM::delAll($textObj,'#findacar'); // del auto search block 
        $textObj = staticCleanDOM::delAll($textObj,'button'); // del all <button>
        $textObj = staticCleanDOM::delAll($textObj,'div.ec-module'); //msn <iframe> in div.ec-module
        
        //<video player content>
        $textObj = staticCleanDOM::delAll($textObj,'div.metadata'); //del video info
        $textObj = staticCleanDOM::delAll($textObj,'div.playlist-and-storepromo'); //del video info
        $textObj = staticCleanDOM::delAll($textObj,'div.nextvideo-outer'); //del video info
        //<video player content>        

        
        echo "\n\n-------------\n\n".$textObj->innertext."\n\n-------------\n\n";
        
        return $textObj;
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
            elseif(is_object($this->html_obj->find('section.articlebody',0))){ //add text in <p/> to description
                $articleObj = $this->html_obj->find('section.articlebody',0);
                if(is_object($articleObj->find('span.storyimage',0)))
                {
                    $articleObj->find('span.storyimage',0)->outertext = '';
                }
                if(is_object($articleObj->find('p',1)))
                {
                    $pTxt   = $articleObj->find('p',1)->innertext;
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
    
    private function changeLink($textObj){
        if(is_object($textObj->find('a',0)) == false){
            return $textObj;
        }
        
        foreach($textObj->find('a') as $linkObj){
            $anchor = $linkObj->innertext;
            $href   = $linkObj->href;
            
            $spanLink = '<span class="out-link" src="'.$href.'">'.$anchor.'</span>';
            
            $linkObj->outertext = $spanLink;
        }
        
        return $textObj;
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
}

class cleanDOM{
    
    private $DOM;
    
    function __construct( &$dom ) {
        $this->DOM = $dom;
    }
    
    function delSingle($selector, $key){
        if( is_object( $this->DOM->find($selector, $key) ) ){
            $this->DOM->find($selector, $key)->outertext = '';
        }
    }
    
    function delAll( $selector ){
        if( is_array( $this->DOM->find($selector) ) ){
            foreach( $this->DOM->find($selector) as $nextElement ){
                $nextElement->outertext = '';
            } 
        }
    }
    
    function delAllWrapper($selector){
        if( is_array( $this->DOM->find($selector) ) ){
            foreach( $this->DOM->find($selector) as $nextElement ){
                $nextElement->outertext = $nextElement->innertext;
            } 
        }
    }
    
    static function st_delSingle($dom, $selector, $key){
        if( is_object( $dom->find($selector, $key) ) ){
            $dom->find($selector, $key)->outertext = ' 123 ';
            $dom->find($selector, $key)->innertext = ' 456 ';
        }
        return $dom;
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Parse_page_msn_lib{
   
    public $donorData, $cleaner, $data = array('img'=>false,'title'=>false,'description'=>false,'text'=>false,'date'=>false,'canonical'=>false);
    public $htmlObj, $articleBodyObj;
    
    function __construct() {}
    
    function get_data( $html, $donorData ){
        $html = $this->predParseHTML( $html );
        $this->htmlObj =  new simple_html_dom();
        $this->htmlObj->load($html);
        if( !is_object($this->htmlObj) ) return false;
        
        $this->parseDOM();
        
        $this->htmlObj->clear();
        unset($this->htmlObj);
        
        $this->data['text'] =  video_replace_lib::get_video_tags( $this->data['text'] );
        
        return $this->data;
    }
    
    
    function parseDOM(){
        if( is_object( $this->htmlObj->find('.collection-headline h1',0) ) ){
            $this->data['title'] = $this->htmlObj->find('.collection-headline h1',0)->innertext;
        }
        elseif(is_object( $this->htmlObj->find('.collection-headline-flex h1',0) )){ //new page stile
            $this->data['title'] = $this->htmlObj->find('.collection-headline-flex h1',0)->innertext;
        }
        
        if( is_object( $this->htmlObj->find('section.articlebody',0) ) ){
//            $this->articleBodyObj = $this->htmlObj->find('section.articlebody',0);
            $this->changeVideo();
            $this->imgInTxt();
            $this->slideerRewrite();
            $this->delTagFromObj();
            $this->changeLink();
            
            
            $htmlTxt = $this->htmlObj->find('section.articlebody',0)->innertext;
            $htmlTxt = $this->delHtmlTagData($htmlTxt);
            $htmlTxt = $this->delAttrFromHtml($htmlTxt);
            $htmlTxt = $this->delTagFromHtml($htmlTxt);
            $htmlTxt = preg_replace("#<(/|)h1#iu", "<$1h2", $htmlTxt); // h1 to h2
            $htmlTxt = $this->addLikeMarker($htmlTxt, 500);
            $htmlTxt = iconv('utf-8', 'utf-8//IGNORE', $htmlTxt ); //исправление некорректных символов
            $this->data['text'] = '<div data-parse-version="1" class="parse-version p-version-1">'.$htmlTxt.'</div>';
        }
        
        #<DonorData>
        
        if( is_object( $this->htmlObj->find('.sourcename-txt a',0) ) ){
            $this->data['donor-data']['name'] = $this->htmlObj->find('.sourcename-txt a',0)->innertext;
            
            $donorUrl   = $this->htmlObj->find('.sourcename-txt a',0)->href;
            $donorUrlAr = parse_url($donorUrl);
            
            $this->data['donor-data']['host'] = trim($donorUrlAr['host']);
        }
        elseif ( is_object($this->htmlObj->find('.partnerlogo-img a',0)) ) { // ===== new page style =====
            $this->data['donor-data']['name'] = $this->htmlObj->find('.partnerlogo-img a',0)->title;
            
            $donorUrl   = $this->htmlObj->find('.partnerlogo-img a',0)->href;
            $donorUrlAr = parse_url($donorUrl);
            
            $this->data['donor-data']['host'] = trim($donorUrlAr['host']);
        }
        else{   
            if( is_object($this->htmlObj->find('.sourcename-txt',0)) ){ //получение хоста по имени из массива сохраненных
                $donorName      = trim($this->htmlObj->find('.sourcename-txt',0)->innertext);
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
                if( is_object( $this->htmlObj->find('link[rel=shortcut icon]',0) ) ){
                    $this->data['donor-data']['img'] = 'http:'.$this->htmlObj->find('link[rel=shortcut icon]',0)->href;
                }
            }
        }
        
        if( is_object( $this->htmlObj->find('meta[name=description]',0) ) ){
            $description = $this->htmlObj->find('meta[name=description]',0)->content;
            $this->data['description'] = $this->getBigDescription($description, $this->data['text'], 600, 1500);
        }
        
        if( is_object( $this->htmlObj->find('link[rel=canonical]',0) ) ){
            $this->data['canonical'] = $this->htmlObj->find('link[rel=canonical]',0)->href;
        }
        #</DonorData>
    }
    
    
    //  < parseDOM Function >
    
    private function changeVideo(){
        if( !is_object($this->htmlObj->find('.wcvideoplayer',0)) ){
            return false;
        }
        
        foreach($this->htmlObj->find('.wcvideoplayer') as $videoObj){
            $metaData   = $videoObj->attr['data-metadata'];
            $metaData   = html_entity_decode($metaData);
            $metaDataAr = json_decode($metaData,true);
//            print_r($metaDataAr);
            
            $htmlVideo = '<video width="100%" height="auto"  poster="'.$metaDataAr['headlineImage']['url'].'" controls > '
                    . '<source src="'.$metaDataAr['videoFiles'][0]['url'].'" > '
                    . 'Your browser does not support this video'
                    . '</video>';
            
            $videoObj->outertext = $htmlVideo;
        }
    }

    private function imgInTxt(){
        if( !is_object($this->htmlObj->find('img',0)) ){
            return false;
        }
        
        foreach($this->htmlObj->find('img') as $imgObj){
            if(!isset($imgObj->attr['data-src'])){
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
            if(isset($matches[1]) && $matches[1] > 800) //616px
            {
                $searchAr   = array("#h=\d{2,4}#iu","#w=\d{2,4}#iu","#q=\d{1,2}#iu");
                $replaceAr  = array("h=","w=800","q=100");
                $imgSrc     = preg_replace($searchAr, $replaceAr, $imgSrc);
            }
            //</MaxImgSize>
            
//            $imgSrc = preg_replace("#q=\d{1,2}#iu", "q=100", $imgSrc); // quality 100%
            
            $imgObj->attr['src'] = $imgSrc;
            
            if( !isset($imgObj->attr['alt']) || empty($imgObj->attr['alt']) )
            {
                $imgObj->attr['alt'] = $this->data['title'];
            }
            unset($imgObj->attr['data-src']);
        }
    } 
    
    private function slideerRewrite(){
        if( !is_object($this->htmlObj->find('.inline-slideshow',0)) )
        {
            return false;
        }
        
        foreach($this->htmlObj->find('.inline-slideshow') as $sliderObj)
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
        $this->delAll('div.configurableAd'); //msn ads
        $this->delAll('#WidgetDiv'); //msn widgetLink
        $this->delAll('#ContentDiv'); //msn videoADS 
        $this->delAll('div.readmore'); //msn ads
        $this->delAll('iframe'); //msn iframe   ---!!!--- ???
       
        
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
            elseif(is_object($this->htmlObj->find('section.articlebody',0))){ //add text in <p/> to description
                $articleObj = $this->htmlObj->find('section.articlebody',0);
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
    
    private function changeLink(){
        if(is_object($this->htmlObj->find('a',0)) == false){
            return false;
        }
        
        foreach($this->htmlObj->find('a') as $linkObj){
            $anchor = $linkObj->innertext;
            $href   = $linkObj->href;
            
            $spanLink = '<span class="out-link" src="'.$href.'">'.$anchor.'</span>';
            
            $linkObj->outertext = $spanLink;
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
        if( is_object( $this->htmlObj->find($selector, $key) ) ){
            $this->htmlObj->find($selector, $key)->outertext = '';
            $this->htmlObj->load($this->htmlObj->save());
        }
    }
    
    private function delAll( $selector ){
        if(is_object( $this->htmlObj->find($selector,0) ) ){
            $cntElements = count($this->htmlObj->find($selector));
            for($i=0;$i<$cntElements;$i++){
                $this->htmlObj->find($selector,$i)->outertext = '<!-- WWW -->';
            } 
            $this->htmlObj->load($this->htmlObj->save());
        }
    }
    
    private function delAllWrapper($selector){
        if(is_object( $this->htmlObj->find($selector,0) ) ){
            $cntElements = count($this->htmlObj->find($selector));
            for($i=0;$i<$cntElements;$i++){
                $this->htmlObj->find($selector,$i)->outertext = $this->htmlObj->find($selector,$i)->innertext;
            }
            $this->htmlObj->load($this->htmlObj->save());
        }
    }
    
    //</Del From Object Function>
    
    
    function predParseHTML( $html ){
        
        //change ID #ContentDiv(int) BEGIN
        $pattern = "#\"(ContentDiv)\d+\"#i";
        $replacement = "\"$1\"";
        $html = preg_replace($pattern, $replacement, $html);
        //change ID #ContentDiv END
        
        return $html;
    }
}

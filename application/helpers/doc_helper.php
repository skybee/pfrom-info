<?php if (!defined('BASEPATH')) exit('No direct script access allowed');





//function getDescriptionFromText( string &$text, integer $length ){
//}


function botRelNofollow(){
    
//    $ip = $_SERVER['HTTP_X_REAL_IP'];
//    $pattern    = "#^(127\.0|66\.249|203\.208|72\.14|209\.85)\.\d{1,3}\.\d{1,3}#i";
    $pattern = "#(Yandex|google|rogerbot|Exabot|MJ12bot|DotBot|Gigabot|AhrefsBot|Yahoo|msnbot|bingbot|SolomonoBot|SemrushBot|Blekkobot)#i";
 
    $rel = '';
    
//    if( preg_match($pattern, $ip) ){
//        $rel = ' rel="nofollow" ';
//    }
    
    if( preg_match( $pattern, $_SERVER['HTTP_USER_AGENT']) ){
        $rel = ' rel="nofollow" ';
    }
    
    return $rel;
}

function serpDataFromJson($json,$splitUp=0)
{
    if(empty($json)){
        return false;
    }
    
    $data = json_decode($json, true);
    
    if(!is_array($data) || count($data)<1)
    {
        $json = stripcslashes($json);
        $data = json_decode($json, true); 
    }
    
    if($splitUp>0){
        $data = arraySplitUp($data,$splitUp);
    }
    
    return $data;
}

function arraySplitUp($dataAr,$nmbrSplit=0){
    if(!is_array($dataAr)|| count($dataAr)<2){return $dataAr;}
    
    $arrCnt = count($dataAr);
    $splitUpArr[1]  = [];
    $splitUpArr[2]  = [];
    for($i=0; $i<$arrCnt; $i++){
        if($i%2 == 0){
            $splitUpArr[1][]  = $dataAr[$i];
        }
        else{
            $splitUpArr[2][] = $dataAr[$i];
        }
    }
    
    if( isset($splitUpArr[$nmbrSplit])      && 
        is_array($splitUpArr[$nmbrSplit])   && 
        count($splitUpArr[$nmbrSplit]) >= 1
    ){
        return $splitUpArr[$nmbrSplit];
    }
    else{
        return $dataAr;
    }
}

function insertLikeArticleInTxt($text, $likeList) //== Not use 
{   
    return $text; # -- TMP -- #
    
    if(!isset($likeList[0])){
        return $text; 
    }

//    echo $likeList[0]['text'];
    
    $newsUrl    = '/'.LANG_CODE."/{$likeList[0]['full_uri']}-{$likeList[0]['id']}-{$likeList[0]['url_name']}.html";
    
    $likeTitle  = str_replace('$', '&dollar;', $likeList[0]['title']);
    $likeText   = str_replace('$', '&dollar;', $likeList[0]['text']);

    $search     = "/([\s\S]{500}(<\/p>|<br.{0,2}>\s*<br.{0,2}>))/i";
    $replace    = "$1 \n "
                . '<style> '
                    . '@media(max-width: 980px){ #left div.single div.mobile-in-txt .mobile-intxt-grey{width: 468px; height: 60px;} } '
                    . '@media(max-width: 540px){ #left div.single div.mobile-in-txt .mobile-intxt-grey{width: 320px; height: 100px;} } '
                    . '@media(max-width: 340px){ #left div.single div.mobile-in-txt .mobile-intxt-grey{width: 234px; height: 60px;} } '
                . '</style> '
                .'<h3 class="look_more_hdn" rel="'.$newsUrl.'"><span>Смотрите также:</span> '.$likeTitle
                    ."<span class=\"gAd\" data=\"mobile greyInTxt\"></span> \n  "
                . "</h3>\n";
    
    $replace   .= '<p class="look_more_hdn">'."\n";

    if(!empty($likeList[0]['main_img'])){
//        $replace .= '<img lazyload="lazyload" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/'.$likeList[0]['main_img'].'" alt="'.$likeTitle.'" onerror="imgError(this);" />'."\n";
        $replace .= '<img src="/upload/images/small/'.$likeList[0]['main_img'].'" alt="'.$likeTitle.'" onerror="imgError(this);" />'."\n";
    }
    $replace    .= $likeText."\n "
                . "<span style=\"display:block; margin-top:15px;\"> \n"
                . "<span class=\"gAd\" data=\"content greyInTxt\"></span> \n "
                . "</span> \n"
                . "</p>\n";

    $text = preg_replace($search, $replace, $text, 1);

    return $text;
}

function insertLikeArtInTxt($text, $likeList, $likeSerpAr)
{
    if(!isset($likeList[0])){
        return $text; 
    }
    
//    print_r($likeSerpAr);
    
    $i =0; 
    $ii=0; //для LikeSerp
    foreach ($likeList as $likeArticle)
    {
        $newsUrl        = '/'.LANG_CODE."/{$likeArticle['full_uri']}-{$likeArticle['id']}-{$likeArticle['url_name']}.html";
        ####
        $likeArticle['description'] = html_entity_decode($likeArticle['description']);
        $likeArticle['description'] = strip_tags($likeArticle['description']);
        ####
        $likeTitle      = str_replace('$', '&dollar;', $likeArticle['title']);
        $likeText       = str_replace('$', '&dollar;', $likeArticle['description']);
        $likeSerpTxt    = '';
        if(is_array($likeSerpAr) AND isset($likeSerpAr[$ii]))
        {
            $likeSerpTxt    = "<p>\n".$likeSerpAr[$ii]['text']."\n</p>\n";
            
            if(isset($likeSerpAr[$ii+1]))
            {
                $likeSerpTxt   .= "<p>\n".$likeSerpAr[$ii+1]['text']."\n</p>";
            }
        }
        
        $likeArtHtml =  "\n"
                        .' <h3 class="look_more_hdn" rel="'.$newsUrl.'">'
//                        . '<img lazyload="lazyload-mobile" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/'.$likeArticle['main_img'].'" alt="" onerror="imgError(this);" class="look_more_img_mobile"/>'."\n"
//                        . '<img src="/upload/images/small/'.$likeArticle['main_img'].'" alt="" onerror="imgError(this);" class="look_more_img_mobile"/>'."\n"
                        .$likeTitle
//                        . '<img lazyload="lazyload-mobile" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/real/'.$likeArticle['main_img'].'" alt="" onerror="imgError(this);" class="look_more_img_mobile"/>'."\n"
                        . "</h3>\n"
                        . '<blockquote class="look_more_quote">'."\n"
                        . '<p class="look_more_hdn"> '."\n "
                        . "\t".'<span class="lmh_height_txt">'."\n"
                        . '<img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/real/'.$likeArticle['main_img'].'"  alt="'.$likeTitle.'" onerror="imgError(this);" class="look_more_img_desktop" />'."\n"
//                        . '<img lazyload="lazyload-mobile" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/'.$likeArticle['main_img'].'" alt="" onerror="imgError(this);" class="look_more_img_mobile"/>'."\n"
//                        . '<img src="/upload/images/real/'.$likeArticle['main_img'].'"  alt="'.$likeTitle.'" onerror="imgError(this);" />'."\n"
                        .$likeText
                        . "\t</span>\n "
                        . '<img lazyload="lazyload-mobile" width="300px" height="200px" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/real/'.$likeArticle['main_img'].'" alt="" onerror="imgError(this);" class="look_more_img_mobile"/>'."\n"
                        . "</p>\n "
                        . "\n</blockquote> \n "
                        . "<span class=\"gads_in_more_hdn\"> <span class=\"gAd\" data=\"LoockMoreInTxt\"></span> </span>\n " //GAds Block for JS Change
                        .'<blockquote class="serp-blockquote">'."\n".$likeSerpTxt."\n".'</blockquote>'."\n";
        
        if($i==1){ // Add Minoxidil Link Marker 
            $likeArtHtml .= '<!--MinxLink-->'."\n";
        }
        
        if($i==0)
        {
            $likeArtHtml = "\n".'<span class="first-like-art-in-txt">'.$likeArtHtml.'</span>';
        }
        
//        $text = str_ireplace('<!--likeMarker-->', $likeArtHtml, $text, 1);
        $text = preg_replace("#<\!--likeMarker-->#iu", $likeArtHtml, $text, 1);
        
        $i++; 
        $ii = $ii+2;
    }
    
    $lastLikeSerp = $likeList[count($likeList)-1];
    
    $text .= "\n".'<p class="serp-blockquote">'."\n".$lastLikeSerp['title'].".<br />\n".$lastLikeSerp['description']."\n</p>\n";
    
    return $text;
}

function addResponsiveVideoTag($text){
    $pattern = "#(<(iframe|embed)[\s\S]+?(youtube.com|vimeo.com|tsn.ua)[\s\S]+?</(iframe|embed)>)#i";
    
    $text = preg_replace($pattern, "<div class=\"respon_video\">$1</div>", $text);
    
    return $text;
}

function cctv_article_linkator( $text ){ 
    
    return $text;
    
    $pattern_list['http://cctv-pro.com.ua/category/CCTV-Cameras/']                      = "#(купол[а-я]*|уличн[а-я]+|поворотн[а-я]+|наружн[а-я]+|)\s*(ip-|cctv-|ptz-|)(теле|видео|)камер[а-я]*\s*((видео|)наблюден[а-я]+|)#ui";
    $pattern_list['http://cctv-pro.com.ua/category/CCTV-Kits/']                         = "#комплект.{1,20}видеонаблюден[а-я]+#ui";
    $pattern_list['http://cctv-pro.com.ua/#home']                                       = "#(устан[а-я]*|монт[а-я]*|инстал[а-я]*)\s*(систем.{0,20}|.{0,20}камер[а-я]*|)\s*видеонаблюден[а-я]+#ui";
    $pattern_list['http://cctv-pro.com.ua/']                                            = "#(систем.{1,20}|)видеонаблюден[а-я]+#ui";
    $pattern_list['http://cctv-pro.com.ua/category/CCTV-DVR/']                          = "#(цифров[а-я]*|сетев[а-я]*|ip-|)\s*видеорегистр[а-я]*#ui";
    $pattern_list['http://cctv-pro.com.ua/category/Intercom/#home']                     = "#(устан[а-я]*|монт[а-я]*)\s*(видео|аудио|)\s*домофон[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|commax)|)#ui";
    $pattern_list['http://cctv-pro.com.ua/category/Intercom/']                          = "#(панель|монитор|)\s*(видео|аудио|)\s*домофон[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|commax)|)#ui";

    
    // -== House Control ==- //
    $conditionPattern = "кондиционер[а-я]{0,4}";
    $pattern_list['http://house-control.org.ua/category/kondicionery/']                 = "#\s[а-я\s-]{7,25}\s+{$conditionPattern}#ui";
    $pattern_list['http://house-control.org.ua/category/kondicionery/#second']          = "#{$conditionPattern}\s+[а-я\s-]{7,25}\s#ui";
    $pattern_list['http://house-control.org.ua/category/kondicionery/#third']           = "#\s[а-я-]{5,20}\s+{$conditionPattern}\s+[а-я-]{5,20}#ui";
    
    $pattern_list['http://house-control.org.ua/category/ohranna_pozharnaja_signalizacija/']     = "#(систем[а-я]*.{0,15}|)\s*(охран[а-я]*|(охран[а-я]*.{0,3}|)пожар[а-я]*|)\s*сигнализ[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|магазин[а-я]*|склад[а-я]*)|)#ui";
    $pattern_list['http://house-control.org.ua/category/kontrol_dostupa/']                      = "#(систем[а-я]*.{0,15}|)\s*контр[а-я]*\s*(.{0,10}управ[а-я]*|)\s*доступ[а-я]*#ui";
    
    $pattern_list['http://house-control.org.ua/category/kamera/']                               = "#(купол[а-я]*|уличн[а-я]+|поворотн[а-я]+|наружн[а-я]+|)\s*(ip-|cctv-|ptz-|)(теле|видео|)камер[а-я]*\s*((видео|)наблюден[а-я]+|)#ui";
    $pattern_list['http://house-control.org.ua/category/cctv-komplekt-videonabludenie/']        = "#комплект.{1,20}видеонаблюден[а-я]+#ui";
    $pattern_list['http://house-control.org.ua/info/services/']                                 = "#(устан[а-я]*|монт[а-я]*|инстал[а-я]*)\s*(систем.{0,20}|.{0,20}камер[а-я]*|)\s*видеонаблюден[а-я]+#ui";
    $pattern_list['http://house-control.org.ua/category/cctv-systems/']                         = "#(систем.{1,20}|)видеонаблюден[а-я]+#ui";
    $pattern_list['http://house-control.org.ua/category/multiformatnye-registratory/']          = "#(цифров[а-я]*|сетев[а-я]*|ip-|)\s*видеорегистр[а-я]*#ui";
    $pattern_list['http://house-control.org.ua/info/services/#domofone']                        = "#(устан[а-я]*|монт[а-я]*)\s*(видео|аудио|)\s*домофон[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|commax)|)#ui";
    $pattern_list['http://house-control.org.ua/category/domofony/']                             = "#(панель|монитор|)\s*(видео|аудио|)\s*домофон[а-я]*\s*(.{0,20}(дом[а-я]*|офис[а-я]*|квартир[а-я]*|commax)|)#ui";
    
    
    $key = 1;
    foreach( $pattern_list as $url => $pattern ){
        if( !empty($pattern) ){
            if( preg_match($pattern, $text, $keyword_ar ) ){
//                echo '<pre>'.print_r($keyword_ar[0],1).'</pre>';
                $replace_key = "#$key#";
                
                $replace_ar['search'][$key]     = $replace_key;
                $replace_ar['replace'][$key]    = ' <a target="_blaank" href="'.$url.'">'.$keyword_ar[0].'</a> ';
                
                $text = preg_replace("#{$keyword_ar[0]}#ui", $replace_key, $text, 1);
            }
        }
        $key++;
    }
    
    if( isset($replace_ar) && $replace_ar['search'] > 1 ){
        $text = str_ireplace( $replace_ar['search'], $replace_ar['replace'], $text);
    }
    
    return $text;
}

function get_sape_donor_link(){
    
    $file       = 'sape_a_link_donor.txt';
    $rand_str   = $_SERVER['REQUEST_URI'];
    
    
    if(!is_file($file)){return '';};
    
    $link_ar = file( $file );
    
    mt_srand( abs( crc32($rand_str) ) );
    $rndInt     = mt_rand(1,1000);
    $rndInt2    = mt_rand(1,1000);
    $return     = $link_ar[mt_rand(0, count($link_ar)-1)];
    mt_srand();
    
    if($rndInt <= 50){ // return Link
        
        if($rndInt2 <= 500) // Add nofollow
        {
            $return = preg_replace("#<a #", '<a rel="nofollow" ', $return);
        }
        
        return $return;
    }
    else{
        return '';
    }
}


function addTranslateToMainTxt($mainTxt,$translateData){
    if(empty($translateData['text'])){return $mainTxt;}
    
    $GAdsBlock  = '<div class="content-gAd content-gAd-bottom content-gAd-bottom-after-news" >
                        <div class="content-gAd-center">
                            <span class="gAd" data="content bottom Netboard" load-queue="2"></span>
                        </div>
                    </div>';
    
    $translateHtml = "\n".'<div class="like-trnslte">'."\n";
    $translateHtml .= '<h2 id="trnslte_title">'.ucfirst(trim($translateData['title'])).'</h2>'."\n";
    $translateHtml .= $translateData['text'];
    $translateHtml .= "\n</div>\n";
    
    $translateHtml = '<tlate>'.$GAdsBlock.$translateHtml.'</tlate>';
    
    
    $patternLastDiv = "#(</div>\s*)$#i";
    
    if(preg_match($patternLastDiv, $mainTxt)){
        $mainTxt = preg_replace($patternLastDiv, $translateHtml."$1", $mainTxt);
    }
    else{
        $mainTxt .= $translateHtml;
    }
    
    return $mainTxt;
}

function rewriteImgInToLazyLoad($html){
    
    //========== Return First Img Without LazyLoad ==========//
    $html = preg_replace("#<img #i",'<gmi ', $html,1); //удаление <img
    //========== Return First Img Without LazyLoad ==========//
    
    $pattern        = "#(<img[\s\S]+?)src=['\"](\S+?)['\"]([\s\S]*?>)#i";
    $replacement    = "$1 data-src=\"$2\" src=\"/img/no_img/content/no_img_content_flip.jpg\" lazyload=\"lazyload\" $3";
    
    $html = preg_replace($pattern, $replacement, $html);
    
    //========== Return First Img Without LazyLoad ==========//
    $html = preg_replace("#<gmi #i",'<img ', $html,1); //возвращение <img
    //========== Return First Img Without LazyLoad ==========//
    
    
//    echo '<!-- ';
//    print_r($matches);
//    echo ' -->';
    
    return $html;
}

function setSizeForFirstImg($html){
    if( preg_match("#(<img[\s\S]+?)src=['\"](\S+?)['\"]([\s\S]*?>)#i", $html, $matches) === false ){
        return $html;
    }
    
    if(isset($matches[2]) && !empty($matches[2])){
        $fileName = '.'.$matches[2];
        $fileName = preg_replace("#\?\S+$#i", '', $fileName); //удаление: ?content=1
        
        if( file_exists($fileName) ){
            $imgSize = getimagesize($fileName);
            
            if( isset($imgSize[3]) && !empty($imgSize[3]) ){
                $replacement = '<img '.$imgSize[3].' style="height: auto;" ';
                $html = preg_replace("#<img #i",$replacement, $html,1);
            }
        }
    }
    
    return $html;
}

function getAuthorJsonData($jsonFromDB, $payArticleInt = 0){ # payPostInt = 8 - translated news
    if(empty($jsonFromDB) || $payArticleInt == 8){
        $jsonFromDB = getDefaultAuthorJsonData();
    }
    $arr = json_decode($jsonFromDB, true);
    
    if(isset($arr['publisher'])){
        $resultAr['publisher']  = json_encode($arr['publisher']);
    }
    if(isset($arr['author'])){
        $resultAr['author']     = json_encode($arr['author']);
    }
    
    return $resultAr;
}

function getDefaultAuthorJsonData(){
    if($_SERVER['HTTP_HOST'] == 'pressfrom.info'){
        $defaultJson = '{"publisher":{"@type":"Organization","name":"PressFrom","url":"https:\/\/pressfrom.info","logo":{"@type":"ImageObject","url":"https:\/\/pressfrom.info\/img\/logo-pressfrom-1-fff.png"}},"author":{"@type":"Organization","name":"PressFrom","url":"https:\/\/pressfrom.info","logo":{"@type":"ImageObject","url":"https:\/\/pressfrom.info\/img\/logo-pressfrom-1-fff.png"}}}';
    }
    elseif($_SERVER['HTTP_HOST'] == 'pressreview24.com'){
        $defaultJson = '{"publisher":{"@type":"Organization","name":"PressReview24","url":"https:\/\/pressreview24.com","logo":{"@type":"ImageObject","url":"https:\/\/pressreview24.com/img/pr24/logo-1.png"}},"author":{"@type":"Organization","name":"PressReview24","url":"https:\/\/pressreview24.com","logo":{"@type":"ImageObject","url":"https:\/\/pressreview24.com/img/pr24/logo-1.png"}}}';
    }
    else{
        $defaultJson = '{"publisher":{"@type":"Organization","name":"PressReview24","url":"https:\/\/pressreview24.com","logo":{"@type":"ImageObject","url":"https:\/\/pressreview24.com/img/pr24/logo-1.png"}},"author":{"@type":"Organization","name":"PressReview24","url":"https:\/\/pressreview24.com","logo":{"@type":"ImageObject","url":"https:\/\/pressreview24.com/img/pr24/logo-1.png"}}}';
    }
    
    return $defaultJson;
}

function getRedirectHost($rndStr){
    
    $hostsAr = [
        'francais-express.com',
        'pressfrom.com',
        'smiexpress.ru',
        'lalalay.com',
        'odnako.su',
        'pressreview24.com'
        ];
    
    mt_srand( abs( crc32($rndStr) ) );
    $rndHost = $hostsAr[mt_rand(0, count($hostsAr)-1)];
    mt_srand();
    
    return $rndHost;
}


$( document ).ready(function(){

    // <top adsense after image> //
//    gAdsInContentHtml = '<div class="content-gAd content-gAd-bottom content-gAd-in-text" >\n\
//                            <div class="content-gAd-center">\n\
//                                <span class="gAd" data="InArticles"></span>\n\
//                            </div>\n\
//                        </div>';
    window.cntCall_getArtGAdsHTML = 1;
    
    function getArtGAdsHTML(){
        // <top adsense after image> //
        gAdsInContentHtml =     '<div class="content-gAd content-gAd-bottom content-gAd-in-text" >\n\
                                    <div class="content-gAd-center">\n\
                                        <span class="gAd" data="InArticles" load-queue="'+window.cntCall_getArtGAdsHTML+'"></span>\n\
                                    </div>\n\
                                </div>';
        
        window.cntCall_getArtGAdsHTML ++;
        return gAdsInContentHtml;
    }
    
    if( $('span.storyimage').length > 0 ){ //add after first(main) img
        $('span.storyimage:first').after(getArtGAdsHTML());
    }
    else if( $('ul.slideshow').length > 0){ //add in slider
        $('ul.slideshow:first li:first').after( '<li id="adsInSliderList"></li>');
        $(getArtGAdsHTML()).appendTo('li#adsInSliderList');
    }
    
    if($('h2.look_more_hdn').length >= 3){ //add after like news block
//        $('p.look_more_hdn:eq(2)').after(getArtGAdsHTML());
        $('span.gads_in_more_hdn:eq(2)').after(getArtGAdsHTML());
        if($('h2.look_more_hdn').length >= 5){ //add after like news block
            $('span.gads_in_more_hdn:eq(4)').after(getArtGAdsHTML());
        }
    }
    
    // </top adsense after image> //

    if(addGadPosition()){ // добовляет дополнительные места(теги) для рекламы
        
//        function writeGAdsCode(){
//            if($('body').is('span.gAd')){
//                alert('span.gAd non found');
//                return false;
//            }
//            
//            spanGAds = $('span.gAd');
//            blockName = spanGAds.attr('data');
//            toWrite = loadGAd(blockName);
//            spanGAds.replaceWith(toWrite);
//            
//            setTimeout("writeGAdsCode()", 2000);
//        }
//        writeGAdsCode();
        
//        function sleep(ms) {
//            ms += new Date().getTime();
//            while (new Date() < ms){}
//        } 
        
        $('span.gAd').each(function(){ // простановка блоков рекламы
            blockName = $(this).attr('data');
            toWrite = loadGAd(blockName);
            $(this).replaceWith(toWrite);
            
//            sleep(2000);
        });
    }

});


var cntAdsInArticleIncrement = 1; // счетчик колличества проставленных блоков в статье
var cntAdsInArtGreyIncrement = 1; //// счетчик колличества проставленных блоков в статье(в see more серых)


function loadGAd( blockName ){

    width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if( width <= 980 ){
        return loadGAdMobile(blockName);
    }
    else{
        return loadGAdDesctop(blockName);
    }  
}


function addGadPosition(){ // добовляет дополнительные места(теги) для рекламы 

    // 2й блок справа
    leftHeight     = $("#left").outerHeight(true); 
    rightHeight    = $("#right").outerHeight(true);
    if(leftHeight-rightHeight > 700){
        $("#right").append('<h3 class="widget-title" style="margin-bottom: -10px; margin-top: 30px;"><span class="title">&nbsp;</span></h3><div class="right_gad_block" style="margin-top: 30px;"><span class="gAd" data="right top" load-queue="10" ></span></div>');   
    }
    
    return true;
}


function loadGAdMobile(blockName){

    toWrite = '<!-- No Ads -->';
    
    if( blockName == 'content noImg' || blockName == 'content bottom Netboard' ){
        /* Grey in Text */
        toWrite = "<!-- mobile -->\
                    <ins class=\"adsbygoogle mobile-noimg\"\
                         style=\"display:block\"\
                         data-ad-client=\"ca-pub-6096727633142370\"\
                         data-ad-slot=\"8859464449\"\
                         data-ad-format=\"rectangle\"></ins>\
                    <script>\
                    (adsbygoogle = window.adsbygoogle || []).push({});\
                    </script>";
    }
    
    if(blockName == 'mobile greyInTxt'){
        /* Grey in Text */
        toWrite = " <div class=\"mobile-in-txt\"> \n\
                        <!-- Mobile In Text -->\
                        <ins class=\"adsbygoogle mobile-intxt-grey\"\
                             style=\"display:block\"\
                             data-ad-client=\"ca-pub-6096727633142370\"\
                             data-ad-slot=\"8410309242\"\
                             data-ad-format=\"horizontal\"></ins>\
                        <script>\
                        (adsbygoogle = window.adsbygoogle || []).push({});\
                        </script> \n\
                    </div> ";
    }
    
    if(blockName == 'InArticles'){ //TMP Test from big size site
        rndInt = $('#jsrnd').attr('rnd');
        
        //PFinfo Mobi inArt Adaptive
        toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"2670565727\" \
                            data-ad-format=\"auto\" \
                            data-full-width-responsive=\"true\"> \
                        </ins> \
                        <script> \
                             (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        
        if(cntAdsInArticleIncrement == 2){
            //  PFinfo Mobi inArt Feed TitleTop 
            toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-format=\"fluid\" \
                            data-ad-layout-key=\"-am+4z+b-2a+gu\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"3397609443\"> \
                        </ins> \
                        <script> \
                             (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        }
        
        window.cntAdsInArticleIncrement ++;
        
//        if(rndInt == 1){
//         // PFinfo Mobi inArt In-Article
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block; text-align:center;\" \
//                            data-ad-layout=\"in-article\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"8326627839\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        
//        if(rndInt == 2){
//        //  PFinfo Mobi inArt Feed TitleTop 
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-layout-key=\"-am+4z+b-2a+gu\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"3397609443\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        
//        if(rndInt == 3){
//        // PFinfo Mobi inArt Feed TitleBottom
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-layout-key=\"-5c+c9+8-38+ij\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"6042834529\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        
//        if(rndInt == 4){
//        //PFinfo Mobi inArt Adaptive
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"2670565727\" \
//                            data-ad-format=\"auto\" \
//                            data-full-width-responsive=\"true\"> \
//                        </ins> \
//                        <script> \
//                             (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
    }
    
    if(blockName == 'InCategoryList'){
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-6f+cl+4s-a-43\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"5504059340\"> \
                    </ins> \
                    <script> \
                         (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    
    if(blockName == 'LoockMoreInTxt'){
        // PFinfo Mobi in LikeNews
//        toWrite = " <ins class=\"adsbygoogle\" \
//                        <ins class=\"adsbygoogle\" \
//                            style=\"display:inline-block;width:auto;height:60px\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"7812756355\"> \
//                        </ins> \
//                    <script> \
//                        (adsbygoogle = window.adsbygoogle || []).push({}); \
//                    </script>";
        
        // PFinfo Mobi in LikeNews 320x100
        toWrite = " <ins class=\"adsbygoogle\" \
                        <ins class=\"adsbygoogle\" \
                            style=\"display:inline-block;width:320px;height:100px\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"4760051757\"> \
                        </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
        
        if( window.cntAdsInArtGreyIncrement == 3 || window.cntAdsInArtGreyIncrement == 5 ){
            toWrite = '<!-- No Ads second block -->';
        }
        window.cntAdsInArtGreyIncrement ++;
    }
    
    return toWrite;
}

function loadGAdDesctop(blockName){
    
    toWrite         = '<!-- No Ads -->';
    
    if( blockName == 'right top' ){ 
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:inline-block;width:300px;height:600px\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8418393106\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    
    if(blockName == 'InCategoryList'){
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-dy+4w-5g-di+1j2\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8136724446\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    
    if(blockName == 'InArticles'){
//        rndInt = $('#jsrnd').attr('rnd');
            //PFinfo FullScr inArt Feed
            toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-format=\"fluid\" \
                            data-ad-layout-key=\"-d2+6f-3y-ip+1my\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"8912358297\"> \
                        </ins> \
                        <script> \
                            (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        
//        if(window.cntAdsInArticleIncrement == 2 || window.cntAdsInArticleIncrement == 4){ //PFinfo FullScr inArt Adaptive
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block; min-height:100px;\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"9281283135\" \
//                            data-ad-format=\"auto\" \
//                            data-full-width-responsive=\"true\"> \
//                        </ins> \
//                        <script> \
//                            (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        else if(window.cntAdsInArticleIncrement == 5){ //PFinfo FullScr inArt In-Article
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block; text-align:center;\" \
//                            data-ad-layout=\"in-article\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"1907966247\"> \
//                        </ins> \
//                        <script> \
//                            (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
//        else { //PFinfo FullScr inArt Feed
//            toWrite = " <ins class=\"adsbygoogle\" \
//                            style=\"display:block\" \
//                            data-ad-format=\"fluid\" \
//                            data-ad-layout-key=\"-d2+6f-3y-ip+1my\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"8912358297\"> \
//                        </ins> \
//                        <script> \
//                            (adsbygoogle = window.adsbygoogle || []).push({}); \
//                        </script>";
//        }
        
        window.cntAdsInArticleIncrement ++;
    }
    
    if( blockName == 'content bottom Netboard' ){
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:inline-block;width:580px;height:400px\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"2826759265\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    if(blockName == 'UnderSlider'){ //PR24 info LinkBlock under slider
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block;height:30px;\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"5033317876\" \
                        data-ad-format=\"link\" \
                        data-full-width-responsive=\"true\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }
    if(blockName == 'LoockMoreInTxt'){ 
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block; max-height:90px;\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8066584408\" \
                        data-ad-format=\"horizontal\" \
                        data-full-width-responsive=\"true\"></ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
        if(window.cntAdsInArtGreyIncrement == 3 || window.cntAdsInArtGreyIncrement == 5 ){
            toWrite = '<!-- No Ads second block -->';
        }
        window.cntAdsInArtGreyIncrement ++;
    }

    return toWrite;
}
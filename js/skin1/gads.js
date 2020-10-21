

$( document ).ready(function(){

    // <top adsense after image> //
    gAdsInContentHtml = '<div class="content-gAd content-gAd-bottom content-gAd-in-text" >\n\
                            <div class="content-gAd-center">\n\
                                <span class="gAd" data="InArticles"></span>\n\
                            </div>\n\
                        </div>';
    
    if( $('span.storyimage').length > 0 ){ //add after first(main) img
        $('span.storyimage:first').after(gAdsInContentHtml);
    }
    else if( $('ul.slideshow').length > 0){ //add in slider
        $('ul.slideshow:first li:first').after( '<li id="adsInSliderList"></li>');
        $(gAdsInContentHtml).appendTo('li#adsInSliderList');
    }
    
    if($('h3.look_more_hdn').length >= 3){ //add after like news block
//        $('p.look_more_hdn:eq(2)').after(gAdsInContentHtml);
        $('span.gads_in_more_hdn:eq(2)').after(gAdsInContentHtml);
        if($('h3.look_more_hdn').length >= 5){ //add after like news block
            $('span.gads_in_more_hdn:eq(4)').after(gAdsInContentHtml);
        }
    }
    
    // </top adsense after image> //
    setTimeout(function(){
        paste_code('GAdsMainCode'); //добавление основного кода на страницу
        
        if(addGadPosition()){ // добовляет дополнительные места(теги) для рекламы
            $('span.gAd').each(function(){ // простановка блоков рекламы
                blockName = $(this).attr('data');
                toWrite = loadGAd(blockName);
                $(this).replaceWith(toWrite);
            });
        }
    }, 2000);

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
        $("#right").append('<h3 class="widget-title" style="margin-bottom: -10px; margin-top: 30px;"><span class="title">&nbsp;</span></h3><div class="right_gad_block" style="margin-top: 30px;"><span class="gAd" data="right top"></span></div>');   
    }
    
    return true;
}


function loadGAdMobile(blockName){

    toWrite = '<!-- No Ads -->';
    
    if( blockName == 'content noImg' || blockName == 'content bottom Netboard' ){
        /* Grey in Text */
        toWrite = "<!-- mobile -->\
                    <ins class=\"adsbygoogle mobile-noimg\" \
                         style=\"display:block\" \
                         data-ad-client=\"ca-pub-6096727633142370\" \
                         data-ad-slot=\"8859464449\" \
                         data-ad-format=\"rectangle\" \
                         data-full-width-responsive=\"false\"> \
                    </ins> \
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
                            data-full-width-responsive=\"false\"> \
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
                            data-ad-slot=\"3397609443\" \
                            data-full-width-responsive=\"false\"> \
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
//        toWrite = " <ins class=\"adsbygoogle\" \
//                        <ins class=\"adsbygoogle\" \
//                            style=\"display:inline-block;width:320px;height:100px\" \
//                            data-ad-client=\"ca-pub-6096727633142370\" \
//                            data-ad-slot=\"4760051757\"> \
//                        </ins> \
//                    <script> \
//                        (adsbygoogle = window.adsbygoogle || []).push({}); \
//                    </script>";
        
        // <!-- Test Mobile Small -->
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block;margin-left:0;\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"7018265929\" \
                        data-ad-format=\"auto\" \
                        data-full-width-responsive=\"false\"></ins> \
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
//    if(blockName == 'UnderSlider'){ //PR24 info LinkBlock under slider
//        toWrite = " <ins class=\"adsbygoogle\" \
//                        style=\"display:block;height:30px;\" \
//                        data-ad-client=\"ca-pub-6096727633142370\" \
//                        data-ad-slot=\"5033317876\" \
//                        data-ad-format=\"link\" \
//                        data-full-width-responsive=\"true\"> \
//                    </ins> \
//                    <script> \
//                        (adsbygoogle = window.adsbygoogle || []).push({}); \
//                    </script>";
//    }
    if(blockName == 'InSlider'){ //Black in Slider FullScr
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block;height:125px\" \
                        data-ad-format=\"fluid\" \
                        data-ad-layout-key=\"-gg+3r+8c-bc-1v\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"9221992516\"> \
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
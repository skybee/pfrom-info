

$( document ).ready(function(){

    // <top adsense after image> //
    gAdsInContentHtml = '<div class="content-gAd content-gAd-bottom" >\n\
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
    
    if($('h2.look_more_hdn').length >= 3){ //add after like news block
//        $('p.look_more_hdn:eq(2)').after(gAdsInContentHtml);
        $('span.gads_in_more_hdn:eq(2)').after(gAdsInContentHtml);
        if($('h2.look_more_hdn').length >= 5){ //add after like news block
            $('span.gads_in_more_hdn:eq(4)').after(gAdsInContentHtml);
        }
    }
    
    // </top adsense after image> //

    if(addGadPosition()){ // добовляет дополнительные места(теги) для рекламы
        $('span.gAd').each(function(){ // простановка блоков рекламы
            blockName = $(this).attr('data');
            toWrite = loadGAd(blockName);
            $(this).replaceWith(toWrite);
        });
    }

});


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
        $("#right").append('<h3 class="widget-title" style="margin-bottom: -10px; margin-top: 30px;"><span class="title">Ads</span></h3><div class="right_gad_block" style="margin-top: 30px;"><span class="gAd" data="right top"></span></div>');   
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
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block; text-align:center;\" \
                        data-ad-layout=\"in-article\" \
                        data-ad-format=\"fluid\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"8326627839\"> \
                    </ins> \
                    <script> \
                         (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
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
        rndInt = $('#jsrnd').attr('rnd');
        if(rndInt == 1){ //_test Full inArt Adaptive
            toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"9281283135\" \
                            data-ad-format=\"auto\" \
                            data-full-width-responsive=\"true\"> \
                        </ins> \
                        <script> \
                            (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        }
        if(rndInt == 2){ //_test Full inArt Feed
            toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block\" \
                            data-ad-format=\"fluid\" \
                            data-ad-layout-key=\"-ek+56-1c-c4+10c\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"8912358297\"> \
                        </ins> \
                        <script> \
                            (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        }
        if(rndInt == 3){ //_test Full inArt In-Article
            toWrite = " <ins class=\"adsbygoogle\" \
                            style=\"display:block; text-align:center;\" \
                            data-ad-layout=\"in-article\" \
                            data-ad-format=\"fluid\" \
                            data-ad-client=\"ca-pub-6096727633142370\" \
                            data-ad-slot=\"1907966247\"> \
                        </ins> \
                        <script> \
                            (adsbygoogle = window.adsbygoogle || []).push({}); \
                        </script>";
        }
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
    if(blockName == 'LoockMoreInTxt'){ //PR24 info LinkBlock under slider
        toWrite = " <ins class=\"adsbygoogle\" \
                        style=\"display:block;height:26px;\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"9048159474\" \
                        data-ad-format=\"link\" \
                        data-full-width-responsive=\"true\"> \
                    </ins> \
                    <script> \
                        (adsbygoogle = window.adsbygoogle || []).push({}); \
                    </script>";
    }

    return toWrite;
}
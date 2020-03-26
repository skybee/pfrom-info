/*

 - http://express-info.lh/js/skin1/paste_code.js

 - http://express-info.lh/js/skin1/sb.js?v=20200323-1354

 - http://express-info.lh/js/skin1/gads.js?v=20191217-1940

*/

 /* FILE START: http://express-info.lh/js/skin1/paste_code.js */ 
//function paste_code_do(selector){
//    $(selector).append(htmlCode);
//}



function paste_code(placeName){
    
    
    switch (placeName){
        case 'GAdsMainCode':
            htmlCode = "<script data-ad-client=\"ca-pub-6096727633142370\" async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\
                        <script>\
                            (adsbygoogle = window.adsbygoogle || []).push({ \
                                google_ad_client: \"ca-pub-6096727633142370\",\
                            });\
                        </script>";
            $('span.paste_GAdsMainCode').append(htmlCode);
            break;
            
        case 'YandexMetrika':
            htmlCode = "<script type=\"text/javascript\" >\
                            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};\
                            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})\
                            (window, document, \"script\", \"https://mc.yandex.ru/metrika/tag.js\", \"ym\");\
                            \
                            ym(50253969, \"init\", {\
                                 clickmap:true,\
                                 trackLinks:true,\
                                 accurateTrackBounce:true,\
                                 webvisor:false\
                            });\
                         </script>\
                         <noscript><div><img src=\"https://mc.yandex.ru/watch/50253969\" style=\"position:absolute; left:-9999px;\" alt=\"\" /></div></noscript>";
            $('span.paste_YandexMetrika').append(htmlCode);
            break;
            
        case 'YandexButtons':
            htmlCode = "<script async type=\"text/javascript\" src=\"//yandex.st/share/share.js\" charset=\"utf-8\"></script>";
            $('span.paste_YandexButtons').append(htmlCode);
            break;
    }
}
 /* FILE END: http://express-info.lh/js/skin1/paste_code.js */ 



 /* FILE START: http://express-info.lh/js/skin1/sb.js?v=20200323-1354 */ 
function imgError(image){
    image.onerror = "";
//    image.src = "/img/default_news_error.jpg";
//    return true;
    
    
    
    imgNameAr = [
        'no_img_340x220-1.jpg',
        'no_img_340x220-2.jpg',
        'no_img_340x220-3.jpg',
        'no_img_340x220-4.jpg',
        'no_img_340x220-5.jpg',
        'no_img_340x220-6.jpg',
        'no_img_340x220-7.jpg',
        'no_img_340x220-8.jpg',
        'no_img_340x220-9.jpg'
    ];
    
    // использование Math.round() даст неравномерное распределение!
    function getRandomInt(min, max)
    {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }
   
    rndImgName = imgNameAr[getRandomInt(0,imgNameAr.length-1)];
    
    image.src   = "/img/no_img/"+rndImgName;
    image.style.transform = "none";  
    return true;
}

$( document ).ready(function(){
    
    //MAIL Show in footer
    $('a#foot_mail').attr('href','mailto:mail'+'@'+'pressfrom'+'.info').text('mail'+'@'+'pressfrom'+'.info');
    
    $('#left .copy-url img, .like-article-list img, #out_window img').error( //удаление изображений 404
                function(){
                    $(this).remove();
                }
            );
    
    
    // <add url link to copy post>
    var source_link = '<p>Source: <a href="' + location.href + '">' + location.href + '</a></p>';
    $(
        function($)
        {
            if (window.getSelection) $('.copy-url').bind(
                'copy',
                function()
                {
                    var selection = window.getSelection();
                    var range = selection.getRangeAt(0);

                    var magic_div = $('<div>').css({ overflow : 'hidden', width: '1px', height : '1px', position : 'absolute', top: '-10000px', left : '-10000px' });
                    magic_div.append(range.cloneContents(), source_link);
                    $('body').append(magic_div);

                    var cloned_range = range.cloneRange();
                    selection.removeAllRanges();

                    var new_range = document.createRange();
                    new_range.selectNode(magic_div.get(0));
                    selection.addRange(new_range);

                    window.setTimeout(
                        function()
                        {
                            selection.removeAllRanges();
                            selection.addRange(cloned_range);
                            magic_div.remove();
                        }, 0
                    );
                }
            );
        }
    );
    // </add url link to copy post>
    
    
    setTimeout('setTop()', 15000);
    
    
    

    
    if(!$('#show_only_dectop__js_checker').is(':visible')){ //old id: #right
        ifMobile();
    }
    else{
        ifDesktop();
    }
    
    
    // <Content Link>
//    setTimeout(function(){
//        if($('span.out-link').length > 0)
//        {
//            counter_convert_link = 0;
//            $('span.out-link').each(function(){
//                counter_convert_link ++;
//                if(counter_convert_link>=3){ 
//                    return true;
//                }
//
//                url     = $(this).attr('src');
//                inner   = $(this).html();
//                cls     = $(this).attr('class');
//                stl     = $(this).attr('style');
//                aHtml = '<a target="_blank" href="'+url+'" class="'+cls+'" style="'+stl+'" rel="nofollow" >'+inner+'</a>';
//                $(this).replaceWith(aHtml);
//
//            });
//        }
//    },10000);
    
    $('span.out-link').mouseover(function(){
        url     = $(this).attr('src');
        inner   = $(this).html();
        cls     = $(this).attr('class');
        stl     = $(this).attr('style');
        aHtml = '<a target="_blank" href="'+url+'" class="'+cls+'" style="'+stl+'" rel="nofollow" >'+inner+'</a>';
        $(this).replaceWith(aHtml);
    });
    // <Content Link>
    
    
    // <Like Link in Text>
    if($('h3.look_more_hdn').length > 0)
    {
        $('h3.look_more_hdn').each(function(){
            likeInTxtLink = $(this).attr('rel');
            $(this).wrapInner('<a href="'+likeInTxtLink+'"></a>');
        });
    }
    // <Like Link in Text>
    
    
    // <show out window> //
    setTimeout('setOutWindow()', 5000);
    var cntShowOutWindow = 0;
    $('#top_hide_line').mouseover(function(){
        if(outWindow==1 && cntShowOutWindow < 2 && $("#out_window").length > 0){
            $('#ow_bg').css({'display':'block'}).animate({opacity:'0.7'},400,function(){
                $('#out_window').css({'display':'block'}).animate({top:'50px'},400);
            });
            cntShowOutWindow++;
            outWindow = 0;
            //setTimeout('setOutWindow()', 10000);
        }
    });
    $('#ow_close').click(function(){
        $('#out_window').animate({top:'-800px'},400,function(){
            $('#out_window').css({'display':'none'});
            $('#ow_bg').animate({opacity:'0'},400,function(){
                $('#ow_bg').css({'display':'none'});
            })
        });
        setTimeout('setOutWindow()', 5000);
    });
    // </show out window> //
    
    setRightBlockTopSpace(); // Set RightTop Space size
    
//    setTimeout('pagePreloadClose()', 1500); //Close Page Preload
    
    //Rewrite TranslateTxt Position
    $('tlate').appendTo('.like-translate-bottom-position');
    
    
    //LazyLoad IMG
    setTimeout(
    $("img[lazyload=lazyload]").lazy({ 
        effect: "fadeIn",
        effectTime: 600,
        threshold: 200
    }), 5000);


    // Load YandexMetrika
//    setTimeout(paste_code('YandexMetrika'),5000); //3000
    
    // Load YandexButtons
//    setTimeout(paste_code('YandexButtons'),10000); //10000

});

var outWindow = 0;
function setOutWindow(){outWindow=1;}


function setTop(){
    var docId = $('#docId').attr('docId');
    if( !docId ){ return; }
    
    langCode = $('#langCode').attr('data');
    
    $.post( '/'+langCode+'/ajax/background/set_top/', {docId: docId, ref: document.referrer} );
}



// < Preload Page Close >
function pagePreloadClose(){
    $('.page-preload-bg').fadeOut(500);
}
// </ Preload Page Close >


//===================== <if Mobile> =====================//
function ifMobile(){
    
    // <show this cat>
    if( $('span').is('#opt-tag-main-cat') ){ 
        $mainCatName = $('#opt-tag-main-cat').text();
        mobMenuTabIndex = $('#mobile_menu_tabs #nav-tabs li[catname='+$mainCatName+']').index();
    }
     if( $('span').is('#opt-tag-sub-cat') ){ 
        $subCatName = $('#opt-tag-sub-cat').text();
        $('.mobile_sub_menu li[catname='+$subCatName+']').addClass('mobile_sub_menu_active');
    }
    // </show this cat>
    
//    alert('123-'+mobMenuTabIndex);
    $('#mobile_menu_tabs').tabs({active: mobMenuTabIndex});
    
    $('#mobile_nav_btn').click(function(){
            $('#mobile_menu').slideToggle();
        }
    );
    
    //change mobile menu link
    $('#mobile_menu li span').each(function(){
        spanUrl     = $(this).attr('data-url');
        spanAnchor  = $(this).attr('data-anchor');
        $(this).replaceWith('<a href="'+spanUrl+'">'+spanAnchor+'</a>');
    });
    
    
    // top slider mobile
    //initialize swiper when document ready
    var mySwiper = new Swiper ('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
    
    
    
    //LazyLoad IMG for Mobile
    setTimeout(
    $('img[lazyload="lazyload-mobile"]').lazy({ 
        effect: "fadeIn",
        effectTime: 600,
        threshold: 200
    }),5000);
    
}
//===================== </if Mobile> =====================//


//===================== <if Desktop> =====================//
function ifDesktop(){
    
    //========== <Sliders> ==========//
    window.setTimeout("showTopSliderTimeOut()",1000);   
    //========== </Sliders> ==========//


    // <zoom img>
//    $('.image-popup-no-margins').magnificPopup({
//                type: 'image',
//                closeOnContentClick: true,
//                closeBtnInside: false,
//                fixedContentPos: true,
//                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
//                image: {
//                        verticalFit: true
//                },
//                zoom: {
//                        enabled: true,
//                        duration: 300 // don't foget to change the duration also in CSS
//                }
//        });
    // </zoom img>

    // <show this cat>
    if( $('span').is('#opt-tag-main-cat') ){ 
        $mainCatName = $('#opt-tag-main-cat').text();
        $('.firstnav-menu li[catname='+$mainCatName+']').addClass('main-nav-cat-active');
        window.mobMenuTabIndex = $('#mobile_menu_tabs #nav-tabs li[catname='+$mainCatName+']').index();
    }
     if( $('span').is('#opt-tag-sub-cat') ){ 
        $subCatName = $('#opt-tag-sub-cat').text();
        $('.secondnav-menu li[catname='+$subCatName+']').addClass('sub-nav-cat-active');
    }
    // </show this cat>

//    $('#right-ajax-block').load('/ajax/background/get_right_hc/');

    // <serp result add link>
    if($('.serp_block').length > 0){
        var serp_h4 = $('.serp_block h4');
        var serp_length = serp_h4.length;

        for(i=0; i<serp_length; i++)
        {
            $('.serp_block h4').eq(i).wrap('<a href="'+$('.serp_block h4').eq(i).attr('rel')+'" target="_blank"></a>')
        }
    }
    // <serp result add link>
    
    //LazyLoad IMG for Desktop
    setTimeout(
    $('img[lazyload="lazyload-desktop"]').lazy({ 
        effect: "fadeIn",
        effectTime: 600,
        threshold: 200
    }),5000);
    
    //Load Games
//    setTimeout('$("#bottom-games").load("/html/bottom-games.html");', 10000);
}
//===================== <if Desktop> =====================//


//===================== <TopSliderLoad> =====================//
function showTopSliderTimeOut(){
        $('#featured .featured-hide-preload').css({'display':'block'});
        $('#featured .featured-hide-preload').animate({opacity:1}, 400,function(){
            $('.bxslider').bxSlider({
                mode: 'fade',
                pagerCustom: '#bx-pager',
                controls: false,
                auto: true,
                speed: 600,
                pause: 4000,
                onSlideBefore: lazySliderBefore
            });
        });
//        alert("slider");
};

function lazySliderBefore(thisBlock){
    thisImg = $('img', thisBlock);
    newSrc = thisImg.attr('data-src');
    if(newSrc !== undefined){
        thisImg.attr('src',newSrc);
        thisImg.removeAttr('data-src');
    }
}
//===================== </TopSliderLoad> =====================//



// ===== <YouTube Video Load> ===== //
$( document ).ready(function(){
    setTimeout("replace_yt_video('.yt_video_top')", 7000);
    setTimeout("replace_yt_video('.yt_video')", 15000);
});

function replace_yt_video(selector){
    $(selector).replaceWith(function(){
        return '<iframe width="'+$(this).attr('width')+'" height="'+$(this).attr('height')+'"  src="'+$(this).attr('src')+'" frameborder="0" allowfullscreen></iframe>';
    });
}
// ===== </YouTube Video Load> ===== //


function setRightBlockTopSpace(){ //установка верхнего отступа правой колонки, в зависимости от высоты заголовка 
    startSpaceSize = 45;
    titleHeight = $('.single h1').outerHeight(true);
    rightSpaceSize = startSpaceSize + titleHeight;
    $('#fscreen-right-top-padding').css('height', rightSpaceSize+'px');
//    alert(titleHeight);
}
 /* FILE END: http://express-info.lh/js/skin1/sb.js?v=20200323-1354 */ 



 /* FILE START: http://express-info.lh/js/skin1/gads.js?v=20191217-1940 */ 


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
                        style=\"display:block\" \
                        data-ad-client=\"ca-pub-6096727633142370\" \
                        data-ad-slot=\"7018265929\" \
                        data-ad-format=\"auto\" \
                        data-full-width-responsive=\"true\"></ins> \
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
 /* FILE END: http://express-info.lh/js/skin1/gads.js?v=20191217-1940 */ 


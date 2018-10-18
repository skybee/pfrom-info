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
    
    

    
    if(!$('#right').is(':visible')){
        ifMobile();
    }
    else{
        ifDesktop();
    }
    
    
    // <Content Link>
    if($('span.out-link').length > 0)
    {
        $('span.out-link').each(function(){
            url     = $(this).attr('src');
            inner   = $(this).html();
            cls     = $(this).attr('class');
            stl     = $(this).attr('style');
            aHtml = '<a target="_blank" href="'+url+'" class="'+cls+'" style="'+stl+'" >'+inner+'</a>';
            $(this).replaceWith(aHtml);
        });
    }
    // <Content Link>
    
    
    // <Like Link in Text>
    if($('h2.look_more_hdn').length > 0)
    {
        $('h2.look_more_hdn').each(function(){
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
    
});

var outWindow = 0;
function setOutWindow(){outWindow=1;}


function setTop(){
    var docId = $('#docId').attr('docId');
    if( !docId ){ return; }
    
    $.post( '/ajax/background/set_top/', {docId: docId, ref: document.referrer} );
}

//===================== <if Mobile> =====================//
function ifMobile(){
    
    $('#mobile_menu_tabs').tabs();
    
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
}
//===================== </if Mobile> =====================//


//===================== <if Desktop> =====================//
function ifDesktop(){
    //========== <Sliders> ==========//
    function lazySliderBefore(thisBlock){
        thisImg = $('img', thisBlock);
        newSrc = thisImg.attr('data-src');
        if(newSrc !== undefined){
            thisImg.attr('src',newSrc);
            thisImg.removeAttr('data-src');
        }
    }

    function loadSliderPagerImg(){
        imges = $('#bx-pager li img');
        $('#bx-pager li img').each(function(){
            newSrc = $(this).attr('data-src');
            $(this).attr('src',newSrc);
        });
    }
    loadSliderPagerImg();
   

    $('.bxslider').bxSlider({
        mode: 'fade',
        pagerCustom: '#bx-pager',
        controls: false,
        auto: true,
        speed: 600,
        pause: 6000,
        onSlideBefore: lazySliderBefore
    });    
    //========== </Sliders> ==========//


    // <zoom img>
    $('.image-popup-no-margins').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
                image: {
                        verticalFit: true
                },
                zoom: {
                        enabled: true,
                        duration: 300 // don't foget to change the duration also in CSS
                }
        });
    // </zoom img>

    // <show this cat>
    if( $('span').is('#opt-tag-main-cat') ){ 
        $mainCatName = $('#opt-tag-main-cat').text();
        $('.firstnav-menu li[catname='+$mainCatName+']').addClass('main-nav-cat-active');
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
    
    //Load Games
//    setTimeout('$("#bottom-games").load("/html/bottom-games.html");', 10000);
}
//===================== <if Desktop> =====================//



// ===== <YouTube Video Load> ===== //
$( document ).ready(function(){
    setTimeout("replace_yt_video('.yt_video_top')", 6000);
    setTimeout("replace_yt_video('.yt_video')", 10000);
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
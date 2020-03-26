$( document ).ready(function(){
    
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
    if($('h3.look_more_hdn').length > 0)
    {
        $('h3.look_more_hdn').each(function(){
            likeInTxtLink = $(this).attr('rel');
            $(this).wrapInner('<a href="'+likeInTxtLink+'"></a>');
        });
    }
    // <Like Link in Text>
    
    //LazyLoad IMG
    setTimeout(
    $("img[lazyload=lazyload]").lazy({ 
        effect: "fadeIn",
        effectTime: 600,
        threshold: 200
    }), 5000);
    
    
    /*=== Chose: Mobile/Desktop Script  ===*/
    if($('.mean-bar').is(':visible')){
        ifMobile();
    }
    else{
        ifDesktop();
    }
    /*=== /Chose: Mobile/Desktop Script  ===*/
});


//===================== <if Mobile> =====================//
function ifMobile(){
    
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
    
    //LazyLoad IMG for Desktop
    setTimeout(
    $('img[lazyload="lazyload-desktop"]').lazy({ 
        effect: "fadeIn",
        effectTime: 600,
        threshold: 200
    }),5000);
}
//===================== </if Desktop> =====================//
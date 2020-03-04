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
    
});
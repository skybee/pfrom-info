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
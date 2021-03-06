<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="<?=$this->multidomaine['lang'];?>"> 
    <head>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        
        
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133437377-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-133437377-1');
        </script>
        
        <meta name="theme-color" content="#151515" />
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?= $meta['title'] ?></title>
        <link rel="shortcut icon" href="/img/favico.png" type="image/png" />
        
<!--        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/style.css?v=<?=js_version('/css/skin1/style.css')?>" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/sb_top_slider.css" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/default.css" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/skin.css" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/font.css?v=<?=js_version('/css/skin1/font.css')?>" />
        <?php if(0):?><link rel="stylesheet" type="text/css" href="/css/skin1/magnific-popup.css" /><?php endif;?>
        <link rel="stylesheet" type="text/css" href="/css/skin1/likely.css" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/msn-parse.css?v=<?=js_version('/css/skin1/msn-parse.css')?>" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/mobile.css?v=<?=js_version('/css/skin1/mobile.css')?>" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/media-queries.css?v=<?=js_version('/css/skin1/media-queries.css')?>" />
        <link rel="stylesheet" type="text/css" href="/css/skin1/mobile_gads.css?v=<?=js_version('/css/skin1/mobile_gads.css')?>" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.15/swiper-bundle.min.css" />-->

        <link rel="stylesheet" type="text/css" href="/css/all-style.css?v=<?=js_version('/css/all-style.css')?>" />
        
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <?php #if(isset($meta['canonical'])) echo $meta['canonical']; ?>
        
        <?php if(isset($meta['og'])) echo $meta['og']; ?>
        
        <?php if(isset($meta['noindex']) && $meta['noindex'] == true ): ?>
            <meta name="robots" content="noindex, follow" />
        <?php endif; ?>
         
        <?php if(isset($meta['canonical']) && !empty($meta['canonical']) ): ?>
            <link rel="canonical" href="<?=$meta['canonical']?>" />
        <?php endif; ?>       
        
        <?php if(XYZ_HOST == false):?>    
        <script type='text/javascript'>
            var host = location.hostname;
            if(host !== 'express-info.lh' && host !== 'press'+'from'+'.info' ){
                window.location.replace('https://'+'press'+'from'+'.info');
            }
        </script>
        <?php endif;?>
            
        <script defer type='text/javascript' src="/js/skin1/lib/jquery-1.12.4.min.js"></script>
        <!--<script defer type='text/javascript' src="/js/skin1/lib/swiper-6.4.15.min.js">/*---LOAD in sb.js---*/</script>-->
        <script defer type='text/javascript' src="/js/skin1/lib/jquery.lazy.min.js">/*---NOT COMENT in Production---*/</script>
        <!--<script defer type='text/javascript' src='/js/skin1/lib/jquery-ui.min-tabs-1.12.1.js'>/*---LOAD in sb.js---*/</script>-->
        <!--<script defer type='text/javascript' src='/js/skin1/lib/likely.js'>/*---LOAD in sb.js---*/</script>-->

        
<!--        <script defer type='text/javascript' src='/js/skin1/lib/all-lib.js?v=<?=js_version('/js/skin1/lib/all-lib.js')?>'>
            /*---!!!---NOT COMENT in Production---*/
        </script>-->
        
        
        <script defer type='text/javascript' src='/js/skin1/paste_code.js'></script>
        <script defer type='text/javascript' src='/js/skin1/sb.js?v=<?=js_version('/js/skin1/sb.js')?>'></script>
        <script defer type='text/javascript' src='/js/skin1/gads.js?v=<?=js_version('/js/skin1/gads.js')?>'></script>
            
        <!--<script defer type='text/javascript' src='/js/all-script.js?v=<?=js_version('/js/all-script.js')?>'></script>-->
        
        
        <!-- Google Ads -->
        <?php if(!isset($doc_data['show_ads']) || $doc_data['show_ads'] == 1): //отключение рекламы ?> 
<!--            <script data-ad-client="ca-pub-6096727633142370" async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({ //объявления уровня страницы
                    google_ad_client: "ca-pub-6096727633142370",
                    enable_page_level_ads: true
                });
            </script>-->
        <?php endif; ?>        
        
        <script type="application/ld+json">
            {
                "@context": "https://schema.org", 
                "@type": "Organization",
                "name": "PressFrom",
                "url": "https://pressfrom.info",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "465 E Aultman St, Ely, NV 89301, US",
                    "addressRegion": "NV",
                    "postalCode": "89301",
                    "addressCountry": "USA"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "contactType": "customer support",
                    "email": "mail@pressfrom.info"
                }
            }
        </script>
        
    </head>

    <body>
        <span id="langCode" data="<?=LANG_CODE?>" style="display: none;" ></span>
        
        <!-- Google Ads -->
        <?php if(!isset($doc_data['show_ads']) || $doc_data['show_ads'] == 1): //отключение рекламы ?>
        <span class="paste_code paste_GAdsMainCode"></span>
        <?php endif; ?>
        
        <?php // if(isset($preload)) echo $preload;?>
        
<!--        <div style="position: fixed; top:0; left: 0; width: 100%; height: 200%; background-color: #009DDB; z-index: 100; " class="sbtmplock">
            <div style="color: #fff; font-size: 24px; text-align: center; margin-top: 20%;">
                The page you are looking for is temporarily unavailable. 
                <br />
                Please try again later
            </div>
        </div>-->
        
        <?php  if( isset($this->catNameAr[0]) ): ?> <span style="display:none;" id="opt-tag-main-cat" ><?=$this->catNameAr[0]?></span> <?php endif; ?>
        <?php  if( isset($this->catNameAr[1]) ): ?> <span style="display:none;" id="opt-tag-sub-cat"  ><?=$this->catNameAr[1]?></span> <?php endif; ?>
        
        <div id="container">

            <div id="headernavigation">

                <div class="navigation">
                    <ul class="firstnav-menu">
                        <?php foreach ($main_menu_list as $main_link): ?>
                            <li class="page_item page-item-372" catname="<?=$main_link['url_name']?>">
                                <a href="/<?=LANG_CODE?>/<?= $main_link['url_name'] ?>/"><?= $main_link['name'] ?></a>
                                <div class="firstnav-menu-arrow"></div>
                            </li>
                        <?php endforeach; ?>
                    </ul> 
                    
                    
                    <style>
                        #headernavigation div.navigation a.lang-link{
                            float:right;
                            padding-right: 0;
                            opacity: 0.9;
                        }
                        @media(max-width: 980px){#headernavigation div.navigation a.lang-link{display: none;}}
                    </style>    
                    
                    <?php #if(preg_match("#(pressfrom.com|lalalay.com|francais-express.com)$#i", $_SERVER['HTTP_HOST'], $pregHostResult)):?>
                    <a class="lang-link" href="/br/">BR</a>
                    <a class="lang-link" href="/au/">AU</a>
                    <a class="lang-link" href="/fr/">FR</a>
                    <a class="lang-link" href="/de/">DE</a>
                    <a class="lang-link" href="/uk/">UK</a>
                    <a class="lang-link" href="/ca/">CA</a>
                    <a class="lang-link" href="/us/">US</a>
                    <?php #endif;?>
                    
                    
                </div><!-- #navigation closer -->
                
                <a href="/<?=LANG_CODE?>/" title="<?=$this->multidomaine['site_name_str'];?>" id="mobile_logo" style="background-image: url('/img/<?=$this->multidomaine['logo_img_mobile'];?>')"></a>
                
                <!-- Mobile Menu -->
                <?=$mobile_menu;?>
                <!-- Mobile Menu -->
                
                
            </div><!-- #headernavigation closer -->
            <div id="content">
                <div id="white_space">
                    <div id="content_holder">
                        <div id="header">
                            <a href="/<?=LANG_CODE?>/">
                                <img width="176" height="58" loading="lazy" src="/img/<?=$this->multidomaine['logo_img'];?>" border="0" alt="<?=$this->multidomaine['site_name_str'];?> Logo" class="logo"  /></a>
                            <!--                            <div class="ad "></div> #ad 468x60 closer -->

                            <div class="search_top_block">
                                <form action="/search/1/" method="get" name="search" >
                                    <input type="text" name="q" value="" />
                                    <div id="top_search_submit" onclick="document.search.submit();"></div>
                                </form>
                            </div>
                        </div><!-- #header closer -->

                        <div id="categories">
                            <ul class="secondnav-menu">
                                <?php foreach ($second_menu_list as $second_menu_ar): ?>
                                    <li class="cat-item cat-item-<?= $second_menu_ar['id'] ?>" catname="<?=$second_menu_ar['url_name']?>">
                                        <a href="/<?=LANG_CODE?>/<?= $second_menu_ar['full_uri'] ?>" ><?= $second_menu_ar['name'] ?></a>
                                        <div class="secondnav-menu-arrow"></div>
                                        
                                        <?php if( isset($second_menu_ar['sub_cat_list']) ): ?>
                                        <ul class="secondnav-drop-cat">
                                            <?php foreach($second_menu_ar['sub_cat_list'] as $third_menu_ar): ?>
                                            <li><a href="/<?=LANG_CODE?>/<?= $third_menu_ar['full_uri'] ?>" ><?= $third_menu_ar['name'] ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- #categories closer -->

                        <div class="cat_line"></div>

                        <div class="top_gads">
                            <!--<span class="gAd" data="under slider"></span>-->
                        </div>

                        <!-- !!! Top Slider Here-->

                        <div id="middle">
<!--                            <div class="under_slider_gads">
                                <span class="gAd" data="UnderSlider" load-queue="1"></span>
                            </div>-->
                            <div id="left">
                                <!--<info-page-replace>-->
                                <?= $content ?>
                                <!--</info-page-replace>-->
                            </div><!-- #left closer -->
                            <div id="right">
                                <?= $right; ?>
                            </div><!-- #right closer -->
                        </div><!-- #content_holder closer -->
                        
                        <?= $top_slider; ?>
                        
                    </div>
                </div><!-- #content closer -->
            </div>

            <div id="footer_widget" >
                <div class="inside">
                    <div id="footer_all_cat_block">
                        <?php
                        foreach ($footer_menu_list as $menuList):
                            ?>
                            <div class="footer_acb_main_cat">
                                <a href="/<?=LANG_CODE?>/<?= $menuList['url_name'] ?>/" class="footer_main_cat_a"><?= $menuList['name'] ?></a><br />
                                <div class="footer_acb_sec_cat">
                                    <?php
                                    if ($menuList['s_cat'] != NULL):
                                        foreach ($menuList['s_cat'] as $sCat):
                                            ?>
                                            <a href="/<?=LANG_CODE?>/<?= $menuList['url_name'] ?>/<?= $sCat['url_name'] ?>/"><?= $sCat['name'] ?></a>
                                        <?php endforeach;
                                    endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                        <div class="footer_acb_main_cat">
                            <a href="/info/contact/" class="footer_main_cat_a">
                                About Us
                            </a>

                            <div class="footer_acb_sec_cat">
                                <a href="/info/contact/">Contact</a>
                                <a href="/info/privacy-policy/">Privacy Policy</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="footer_contact">
                        <span><?=$this->multidomaine['contact_str'];?></span>
                        <br />
                        <ul>
                            <li>
                                Name:&nbsp;&nbsp;<span>PressFrom</span>
                            </li>
                            <li>
                                E-mail:&nbsp;&nbsp;<a href="mailto:<?=$this->multidomaine['e_mail'];?>"><?=$this->multidomaine['e_mail'];?></a>
                                <!--<a href="#" id="foot_mail"></a>-->
                            </li>
                            <li>On Advertising:</li>
                            <li>
                                E-mail:&nbsp;&nbsp;<a href="mailto:advert@pressfrom.info">advert@pressfrom.info</a>
                                <!--<a href="#" id="foot_mail"></a>-->
                            </li>
                            <li>
                                465 E Aultman St, Ely, NV 89301, US
                            </li>
                        </ul>
                    </div>
                </div><!-- #inside -->
            </div><!-- #footer_widget closer -->
  
            <div id="footer">
                <div class="inside">
                    <div class="left">&copy; 2016 <?=$this->multidomaine['site_name_str'];?>. All Rights Reserved.</div><!-- #left -->
                    <div class="right"></div><!-- #right -->
                </div><!-- #inside -->
            </div><!-- #footer -->
        </div><!-- #container closer -->

        
        <div style="overflow: hidden; height: 1px; width: 1px; position: absolute; top: -100px;">
            <!--LiveInternet counter-->
            <script type="text/javascript"><!--
            document.write("<a href='http://www.liveinternet.ru/click' " +
                        "target=_blank><img src='//counter.yadro.ru/hit?t14.5;r" +
                        escape(document.referrer) + ((typeof (screen) == "undefined") ? "" :
                        ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                                screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
                        ";" + Math.random() +
                        "' alt='' title='LiveInternet: показано число просмотров за 24" +
                        " часа, посетителей за 24 часа и за сегодня' " +
                        "border='0' width='88' height='31'><\/a>")
                        //--></script>
            <!--/LiveInternet--> 
        </div>
        
        <div id="top_hide_line"></div>
        <div id="ow_bg"></div>
        <?php if(isset($out_popup)) echo $out_popup;?>
        
        <span class="paste_code paste_YandexMetrika"></span>
        <div id="show_only_dectop__js_checker"></div>        
    </body>
</html>
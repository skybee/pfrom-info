<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- TMP RAND INT-->
<?php 
    $rndInt = mt_rand(1, 4000);
    if($rndInt <= 1000 ){
        $js_int = 1;
    }
    elseif($rndInt <= 2000){
        $js_int = 2;
    }
    elseif($rndInt <= 3000){
        $js_int = 3;
    }
    else{
        $js_int = 4;
    }
?>
<span id="jsrnd" rnd="<?=$js_int?>" frand="<?=$rndInt?>" style="display: none;"></span>
<!-- /TMP RAND INT-->

<style>
    #fscreen-right-top-padding{ display: block;}
</style>


<span id="docId" docId="<?=$doc_data['id']?>" style="display: none" ></span>

<div class="single">
    <div class="active">
        <h1><i><?=$cat_ar['name']?></i><?=$doc_data['title']?></h1>
    </div>
    
    <div class="doc-date doc-date-top">
        
        <div class="social_btn social_btn_top">
            <span class="paste_code paste_YandexButtons"></span>
<!--            <script async type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>-->
            <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareTheme="counter" data-yashareType="normal" data-yashareQuickServices="<?=$this->multidomaine['social_btn_list'];?>"></div> 
        </div>
        
        <div class="dd_left">
            <?php $dateAr =& $doc_data['date_ar']; ?>
            <span class="long_date_str">
            <?=$dateAr['time'].'&nbsp;&nbsp;'.$dateAr['day_nmbr'].'&nbsp;'.$dateAr['month_str'].'&nbsp; '.$dateAr['year_nmbr'];?>
            </span>
<!--            <span class="short_date_str">
                <?=$dateAr['time'].'&nbsp;&nbsp;'.$dateAr['day_nmbr'].'.'.$dateAr['month_nmbr'].'.'.$dateAr['year_short_nmbr'];?>
            </span>-->
        </div>
        
        <div class="dd_right">
            <span class="short_date_str">
            <?=$dateAr['time'].'&nbsp;&nbsp;'.$dateAr['day_nmbr'].'&nbsp;'.$dateAr['month_str'].'&nbsp; '.$dateAr['year_nmbr'];?>
            </span>
            <span class="long_date_str">
                <span id="source_str"><?=$this->multidomaine['source_str'];?></span>:&nbsp;&nbsp;
<!--            <span class="doc-donor-link out-link" src="http://<?=$doc_data['d_host']?>/" <?=$donor_rel;?> target="_blank" style="background-image: url('/upload/_donor-logo/<?=$doc_data['d_img']?>');">
                <?=$doc_data['d_name']?>
            </span>-->
                
            <!--     
            <span class="doc-donor-link out-link" src="http://<?=$doc_data['d_host']?>/" <?=$donor_rel;?> target="_blank" style="background-image: url('https://favicon.yandex.net/favicon/<?=$doc_data['d_host']?>');">
                <?=  preg_replace("#www\.#i", '', $doc_data['d_host'])?>
            </span>
            -->
            
            <a class="doc-donor-link out-link" href="http://<?=$doc_data['d_host']?>/" <?=$donor_rel;?> target="_blank" style="background-image: url('https://favicon.yandex.net/favicon/<?=$doc_data['d_host']?>');">
                <?=  preg_replace("#www\.#i", '', $doc_data['d_host'])?>
            </a>
                
            </span>
        </div>
    </div><!-- #date -->
   
    <style>
        #left div.single div.thumb-gAd .gad-bottom-respon{width: 616px;}
        @media(max-width: 980px){ #left div.single div.content-gAd-bottom .mobile-noimg{width: 336px; height: 280px;} }
        @media(max-width: 340px){ #left div.single div.content-gAd-bottom .mobile-noimg{width: 300px; height: 250px;} }
    </style>
    
    <?php #print_r($doc_data); ?>
    
    <!-- CONTENT START -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org", 
            "@type": "NewsArticle",
            "headline": "<?=htmlspecialchars($doc_data['title'],ENT_COMPAT)?>",
            "image": "https://static.pressfrom.info/upload/images/real/<?=$doc_data['main_img']?>",
            "datePublished": "<?=$dateAr['year_nmbr'].'-'.$dateAr['month_nmbr'].'-'.$dateAr['day_nmbr']?>",
            "dateModified":  "<?=$dateAr['year_nmbr'].'-'.$dateAr['month_nmbr'].'-'.$dateAr['day_nmbr']?>",
            "publisher": <?=$doc_data['author_json']['publisher']?>,
            "author": <?=$doc_data['author_json']['author']?>,
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"
            }
        }
    </script>
    
    <div class="content copy-url" >
    <!--
    <div class="content copy-url" itemscope itemtype="http://schema.org/Article">
        <span class="schema_org_data" style="display:none;">
            <span itemprop="headline" ><?=$doc_data['title']?></span>
            <span itemprop="datePublished" ><?=$dateAr['year_nmbr'].'-'.$dateAr['month_nmbr'].'-'.$dateAr['day_nmbr']?></span>
            <span itemprop="dateModified" ><?=$dateAr['year_nmbr'].'-'.$dateAr['month_nmbr'].'-'.$dateAr['day_nmbr']?></span>
            <link itemprop="image" href="https://static.pressfrom.info/upload/images/real/<?=$doc_data['main_img']?>" />
        </span>
        -->
        <section>
        <?=$doc_data['text']?>
        </section>
    </div><!-- #content -->
    <!-- CONTENT END -->
    
    <div class="doc-date doc-date-bottom">
        <div class="social_btn">
            <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareTheme="counter" data-yashareType="normal" data-yashareQuickServices="<?=$this->multidomaine['social_btn_list'];?>"></div> 
        </div>
        <div class="dd_left long_date_str">
            &mdash; &nbsp; <?=$this->multidomaine['repost_news_str'];?>
        </div>
    </div>
    
    
    <style>
        #left div.single div.thumb-gAd .gad-bottom-respon{width: 616px;}
        @media(max-width: 980px){ #left div.single div.content-gAd-bottom .mobile-noimg{width: 336px; height: 280px;} }
        @media(max-width: 340px){ #left div.single div.content-gAd-bottom .mobile-noimg{width: 300px; height: 250px;} }
    </style>
    <div class="content-gAd content-gAd-bottom content-gAd-bottom-after-news " >
        <div class="content-gAd-center">
            <span class="gAd" data="content bottom Netboard" load-queue="2"></span>
        </div>
    </div>

    <div id="video_holder" style="display:none;"></div>
    
    
    <?php if($like_video): ?>
    <div class="likevideo">
        <div class="listing in-doc-listing">
            <div class="header">
                <h2 class="doc-cat-title"><?=$this->multidomaine['like_video_str'];?>:</h2>
            </div>
            <div id="like-video-container">
                <?php foreach ($like_video as $lVideo): ?>
                <div class="like-video-item">
                    <div class="like-video-item-left">
                        <div class="respon_video">
                            <div class="yt_video" width="auto" height="auto" style="width:100%;height:100%;" src="https://www.youtube.com/embed/<?=$lVideo['video_id']?>" >
                                <div class="yt_preloader"></div>
                            </div>
                            <!--<iframe width="auto" height="auto"  src="https://www.youtube.com/embed/<?=$lVideo['video_id']?>" frameborder="0" allowfullscreen></iframe>-->
                        </div>
                    </div>
                    <div class="like-video-item-right">
                        <h3><?=$lVideo['title']?></h3>
                        <p><?=$lVideo['description']?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    
    <div class="othernews">
        
        <!-- likeArticlesSlider -->
        <div id="like-acle-slider" class="listing in-doc-listing">
            <div class="header">
                <h2 class="doc-cat-title"><?=$this->multidomaine['like_news_str'];?>:</h2>
            </div><!-- #header -->
            
            <div class="like-article-list">
                <?php
                    foreach ($like_articles as $likeArts):
                        $newsUrl    = '/'.LANG_CODE."/{$likeArts['full_uri']}-{$likeArts['id']}-{$likeArts['url_name']}.html";
                        $imgUrl     = '/upload/images/small/' . $likeArts['main_img']
                ?>
                <div class="like-article-item">
                    <a href="<?=$newsUrl?>">
                        <img lazyload="lazyload" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="<?=$imgUrl?>" alt="<?=$likeArts['title']?>" />
                        <!--<img src="<?=$imgUrl?>" alt="<?=$likeArts['title']?>" />-->
                        <?=Article_m::get_short_txt($likeArts['title'],80,'word','...')?>
                    </a>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
        <!-- /likeArticlesSlider -->
        
    </div><!-- #othernews -->
    
    <?php if(0): ?>
    <div class="doc-comments">
        <div class="listing in-doc-listing" style="margin-bottom:10px; margin-top: 15px;">
            <div class="header">
                <h2 class="doc-cat-title"><?=$this->multidomaine['comments_str'];?>:</h2>
            </div>
        </div>
        
        <!-- KAMENT -->
<!--        <div id="kament_comments"></div>
        <script type="text/javascript">
                /* * * НАСТРОЙКА * * */
                var kament_subdomain = 'odnako';

                /* * * НЕ МЕНЯЙТЕ НИЧЕГО НИЖЕ ЭТОЙ СТРОКИ * * */
                (function() {
                        var node = document.createElement('script'); node.type = 'text/javascript'; node.async = true;
                        node.src = 'http://' + kament_subdomain + '.svkament.ru/js/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(node);
                })();
        </script>
        <noscript>Для отображения комментариев нужно включить Javascript</noscript>-->
        <!-- /KAMENT -->
        
        <div id="hypercomments_widget"></div>
        <script type="text/javascript">
            _hcwp = window._hcwp || [];
            _hcwp.push({widget:"Stream", widget_id: 19400});
            (function() {
            if("HC_LOAD_INIT" in window)return;
            HC_LOAD_INIT = true;
            var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
            var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
            hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/19400/"+lang+"/widget.js";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hcc, s.nextSibling);
            })();
        </script>
        <a href="#" class="hc-link" title="comments widget">comments powered by HyperComments</a>
        
    </div>
    <?php endif; ?>
    
    <div class="content copy-url content-bottom-translate" > <!-- JS remove translate to here -->
        <div data-parse-version="1" class="parse-version p-version-1" style="padding-bottom: 0;">
            <div class="like-translate-bottom-position"></div>
        </div>
    </div>
    
    <div style="font-size: 10px; color: #999; margin-top: 10px; float: left;">usr:  <?=$doc_data['views']?></div>

</div>

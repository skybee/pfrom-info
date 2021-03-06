<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="fscreen-right-top-padding"></div>

<!-- TOP Video -->
<?php 
    if(isset($like_video) && $like_video!==false ): 
        $videoData = $like_video[0];
?>
    <h3 class="widget-title" id="like_video_title">
        <span class="title" style="color:#d80000;"><?=$this->multidomaine['like_video_str'];?></span>
    </h3>
    <div class="right_video">
        <div class="yt_video yt_video_top" width="325" height="220" style="width:325px;height:220px;" src="https://www.youtube.com/embed/<?=$videoData['video_id']?>" >
            <div class="yt_preloader"></div>
        </div>
        <!--<iframe width="325" height="220"  src="https://www.youtube.com/embed/<?=$videoData['video_id']?>" frameborder="0" allowfullscreen></iframe>-->
        <span id="right_video_title"><?=$videoData['title']?></span>
    </div>
<?php endif;?>

<?php if(0/*LANG_CODE == 'us'*/):?>
<div style="float: left; margin: 0px 0px 20px 0px; font-size: 12px; color: #6b6b6b;">
    As an Amazon Associate I earn from qualifying purchases.
</div>
<?php endif; ?>

<!-- TOP News -->
<h3 class="widget-title">
    <span class="title"><?=$this->multidomaine['top_news_str'];?></span>
</h3>

<div class="right-top-news">
    
    <?php
        $cntFirstBlockNews = 6;
        if(isset($doc_data)){
            $cntFirstBlockNews = 4;
        }
        $i=0;
        foreach($right_top as $key => $article):
            $newsUrl    = '/'.LANG_CODE."/{$article['full_uri']}-{$article['id']}-{$article['url_name']}.html";
        if($i==0):
    ?>
    <div class="big-rtn">
        <a href="<?=$newsUrl?>" >
            <img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="https://static.pressfrom.info/upload/images/real/<?=$article['main_img']?>" alt="<?=$article['title']?>" onerror="imgError(this);" />
        </a>
        <div class="big-rtn-title">
            <a href="<?=$newsUrl?>" >
                <?=Article_m::get_short_txt($article['title'],80,'word','...')?>
            </a>
        </div>
    </div>
    <?php else: ?>
    <div class="small-rtn">
        <div style="display: table;">
            <div style="display: table-cell; vertical-align: middle;">
                <a href="<?=$newsUrl?>" >
                    <!--<img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/<?=$article['main_img']?>"  alt="<?=$article['title']?>" onerror="imgError(this);" />-->
                    <img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/<?=$article['main_img']?>"  alt="<?=$article['title']?>" onerror="imgError(this);" />
                </a>
            </div>
            <div style="display: table-cell; vertical-align: middle;">
                <a href="<?=$newsUrl?>" class="small-rtn-txt-link" >
                    <?= Article_m::get_short_txt($article['title'],75,'word','...')?>
                </a>
            </div>
        </div>
    </div>
    <?php 
        endif;
        unset($right_top[$key]);
        $i++;
        if($i == $cntFirstBlockNews ){break;}
        endforeach; 
    ?>    
</div>


<h3 class="widget-title" style="margin-bottom: -10px; margin-top: 30px;">
    <span class="title">&nbsp;</span>
</h3>


<div class="right_gad_block" style="margin-top: 30px;">
    <span class="gAd" data="right top"></span>
</div>



<!--
<div id="right-ajax-block">
</div>
-->




<h3 class="widget-title">
    <span class="title"><?=$this->multidomaine['top_news_str'];?></span>
</h3>

<div class="right-top-news">
    
    <?php
        $i=0;
        foreach($right_top as $article):
            $newsUrl    = '/'.LANG_CODE."/{$article['full_uri']}-{$article['id']}-{$article['url_name']}.html";
        if($i==0):
    ?>
    <div class="big-rtn">
        <a href="<?=$newsUrl?>" >
            <!--<img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/real/<?=$article['main_img']?>" alt="<?=$article['title']?>" onerror="imgError(this);" />-->
            <img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/real/<?=$article['main_img']?>" alt="<?=$article['title']?>" onerror="imgError(this);" />
        </a>
        <div class="big-rtn-title">
            <a href="<?=$newsUrl?>" >
                <?=$article['title']?>
            </a>
        </div>
    </div>
    <?php else: ?>
    <div class="small-rtn">
        <div style="display: table;">
            <div style="display: table-cell; vertical-align: middle;">
                <a href="<?=$newsUrl?>" >
                    <!--<img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/<?=$article['main_img']?>"  alt="<?=$article['title']?>" onerror="imgError(this);" />-->
                    <img lazyload="lazyload-desktop" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/<?=$article['main_img']?>"  alt="<?=$article['title']?>" onerror="imgError(this);" />
                </a>
            </div>
            <div style="display: table-cell; vertical-align: middle;">
                <a href="<?=$newsUrl?>" class="small-rtn-txt-link" >
                    <?= Article_m::get_short_txt($article['title'],75,'word','...')?>
                </a>
            </div>
        </div>
    </div>
    <?php 
        endif;
        $i++;
        endforeach; 
    ?>    
</div>



<h3 class="widget-title" style="margin-top: 30px;">
    <span class="title"><?=$this->multidomaine['last_news_str'];?></span>
</h3>

<div class="last_news_list">
<?php
    foreach ($last_news['all'] as $lnews ):
?>
    <div class="lnl_news">
        <!--
        <span>
            <?#=$lnews['date_ar']['time']?> 
        </span>
        -->
        <a href="<?='/'.LANG_CODE."/{$lnews['full_uri']}-{$lnews['id']}-{$lnews['url_name']}.html"?>" class="right-last-news-item">
            <!--<img src="/upload/_donor-logo/<?=$lnews['d_img']?>" alt="<?=$lnews['d_name']?>" title="<?=$lnews['d_name']?>" />-->
            <?=$lnews['title']?>
        </a>    
    </div>
<?php
    endforeach;
?> 
    
    <?php if(isset($minox_link) && !empty($minox_link)): //MinoxidilPage Link ?>
        <div class="lnl_news">
            <?=$minox_link?>
        </div>
    <?php endif; ?>
    
    <?php if($payart_url = getRndPaylink(1) ): ?>
        <div class="lnl_news">
            <a href="<?=$payart_url?>" class="right-last-news-item"><?=$payart_url?></a>
        </div>
    <?php endif; ?>
    
</div>


<?php if(  isset($serp_list) && $serp_list != false && $pay_article !== '1' ):  ?> 

<h3 class="widget-title mobile-visible" style="margin-top: 30px;">
    <span class="title"><?=$this->multidomaine['serp_news_str'];?></span>
</h3>


    
<div class="serp_block mobile-visible">
    <?php $i=0; ?>
    <?php foreach($serp_list as $serp): ?>
    <span class="out-link" src="<?=$serp['url']?>" rel="nofollow" target="_blank">
        <?=$serp['title']?>
        <!-- <span>- <?=$serp['host']?></span> -->
    </span>
    <p>
        <?=$serp['text']?>

        <?php if($i<3): //показывать первые 5 ссылок ?>
        <a href="<?=$serp['url']?>" target="_blank" rel="nofollow" style="color:#4c8296;">
            <?=$serp['host']?>
        </a>
        <?php endif;?>
    </p>

    <?php
        $i++;
        if($i>=10){ break; }
        endforeach; 
    ?>
</div>
    

<?php endif; ?>


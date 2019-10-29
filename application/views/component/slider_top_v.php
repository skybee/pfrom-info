<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!-- SLIDER -->
<div id="featured" >
    <div class="featured-hide-preload">
    
    <ul class="ui-tabs-nav" id="bx-pager">
        <?php  $i = 0;
            foreach($articles as $article):
        ?>
        <li class="ui-tabs-nav-item ">
            <a href="" data-slide-index="<?=$i?>">
                <img src="/upload/images/small/<?=$article['main_img']?>" alt="" onerror="imgError(this);" />
            </a>
        </li>
        <?php $i++; endforeach; ?>
    </ul>


<ul class="bxslider">    
<?php 
    $i=0;
    foreach($articles as $article):
        
    $newsUrl    = '/'.LANG_CODE."/{$article['full_uri']}-{$article['id']}-{$article['url_name']}.html"; 
    $dateAr     =& $article['date'];
    $dateStr    = $dateAr['day_str'].', '.$dateAr['day_nmbr'].' '.$dateAr['month_str'].' '.$dateAr['year_nmbr'];
?>
    <li>
    <!-- 1 Content -->
    <div id="fragment-<?=$i?>" class="ui-tabs-panel " style="margin-top:1px; background-color:transparent; float:left;">
        <a href="<?=$newsUrl?>" class="top_slide_main_img">
            <?php if($i==0): ?>
            <!--medium--><img src="/upload/images/real/<?=$article['main_img']?>" alt="" border="0" onerror="imgError(this);" />
            <?php else: ?>
            <!--medium--><img data-src="/upload/images/real/<?=$article['main_img']?>" src="/img/default_news.jpg" alt="" border="0" onerror="imgError(this);" />
            <?php endif;?>
        </a>
        <div class="info">
            <h2>
                <a href="<?=$newsUrl?>" >
                    <?=Article_m::get_short_txt($article['title'],100,'word','...')?>
                </a>
            </h2>
            <span class="date"><?=$dateStr?></span>
            <p><?=$article['text']?> [&hellip;]</p>
        </div><!-- #info closer -->
    </div><!-- #fragment-1 closer -->
    </li>
<?php
    $i++;
    endforeach; 
?>
</ul>
    </div>
</div><!-- #featured closer -->
<!-- SLIDER END -->



<!--======================= MOBILE SLIDER ==========================-->



<!-- Mobile Top Slider START -->

<div class="mobile-slider">
    <!-- Slider main container -->
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php 
                $cntArt = count($articles);
                for($i=0;$i<$cntArt;$i++):
            ?>
                    <div class="swiper-slide">
                        
                        <?php $newsUrl    = '/'.LANG_CODE."/{$articles[$i]['full_uri']}-{$articles[$i]['id']}-{$articles[$i]['url_name']}.html"; ?>
                        
                        <div class="mob-slider-news">
                            <a href="<?=$newsUrl?>" class="mob-slider-news-imglink">
                                <img src="/upload/images/small/<?=$articles[$i]['main_img']?>" alt="" onerror="imgError(this);" />
                            </a>
                            <h4>
                            <a href="<?=$newsUrl?>" class="mob-slider-news-titlelink">
                                <?=Article_m::get_short_txt($articles[$i]['title'],90,'word','...')?>
                            </a>
                            </h4>>
                        </div>
                        
                        <?php $i++ ?>
                        
                        <?php if($i<$cntArt): ?>
                        <?php $newsUrl    = '/'.LANG_CODE."/{$articles[$i]['full_uri']}-{$articles[$i]['id']}-{$articles[$i]['url_name']}.html"; ?>
                            
                            <div class="mob-slider-news">
                                <a href="<?=$newsUrl?>" class="mob-slider-news-imglink">
                                    <img src="/upload/images/small/<?=$articles[$i]['main_img']?>" alt="" onerror="imgError(this);" />
                                </a>
                                <h4>
                                <a href="<?=$newsUrl?>" class="mob-slider-news-titlelink">
                                    <?=Article_m::get_short_txt($articles[$i]['title'],100,'word','...')?>
                                </a>
                                </h4>
                            </div>
                        <?php endif;?>
                        
                    </div>
            <?php endfor; ?>
        </div>
        
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
</div>
<!-- Mobile Top Slider END -->

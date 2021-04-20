<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!-- SLIDER -->
<div id="sb_top_slider">
    <div id="sb_top_slider_left">
        
<?php 
    $i=0;
    foreach($articles as $article):
        if($i>=6) break;
        
    $newsUrl    = '/'.LANG_CODE."/{$article['full_uri']}-{$article['id']}-{$article['url_name']}.html"; 
    $dateAr     =& $article['date'];
    $dateStr    = $dateAr['day_str'].', '.$dateAr['day_nmbr'].' '.$dateAr['month_str'].' '.$dateAr['year_nmbr'];
?>
        
        <a class="sb_ts_news_container" style="background-image: url(/upload/images/real/<?=$article['main_img']?>)" href="<?=$newsUrl?>">
            <span>
                <?=Article_m::get_short_txt($article['title'],90,'word','...')?>
            </span>
        </a>
<?php
    $i++;
    endforeach; 
?>
        
    </div>
    
    <div id="sb_top_slider_right">
        <span class="gAd" data="InTopSlider" load-queue="1"></span>
    </div>
</div>
<!-- SLIDER END -->



<!--======================= MOBILE SLIDER ==========================-->



<?php if(isset($article_page) == false): //отключение мобильного слайдера на странице статьи ?> 

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
                                
                                <?php // if($i<2): ?>
                                <img loading="lazy" src="https://static.pressfrom.info/upload/images/small/<?=$articles[$i]['main_img']?>" alt="" onerror="imgError(this);" width="120px" height="80px" />
                                <?php // else: ?>
                                    <!--<img lazyload="lazyload-mobile" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="https://static.pressfrom.info/upload/images/small/<?=$articles[$i]['main_img']?>" alt="" onerror="imgError(this);" />-->
                                <?php // endif; ?>
                                
                            </a>
                            <h4>
                            <a href="<?=$newsUrl?>" class="mob-slider-news-titlelink">
                                <?=Article_m::get_short_txt($articles[$i]['title'],70,'word','...')?>
                            </a>
                            </h4>>
                        </div>
                        
                        <?php $i++ ?>
                        
                        <?php if($i<$cntArt): ?>
                        <?php $newsUrl    = '/'.LANG_CODE."/{$articles[$i]['full_uri']}-{$articles[$i]['id']}-{$articles[$i]['url_name']}.html"; ?>
                            
                            <div class="mob-slider-news">
                                <a href="<?=$newsUrl?>" class="mob-slider-news-imglink">
                                    
                                    <?php // if($i<2): ?>
                                        <img src="https://static.pressfrom.info/upload/images/small/<?=$articles[$i]['main_img']?>" alt="" onerror="imgError(this);" width="120px" height="80px" />
                                    <?php // else: ?>
                                        <!--<img lazyload="lazyload-mobile" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="https://static.pressfrom.info/upload/images/small/<?=$articles[$i]['main_img']?>" alt="" onerror="imgError(this);" />-->
                                    <?php // endif; ?>
                                    
                                </a>
                                <h4>
                                <a href="<?=$newsUrl?>" class="mob-slider-news-titlelink">
                                    <?=Article_m::get_short_txt($articles[$i]['title'],76,'word','...')?>
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

<?php else: ?>
<style>
    @media screen and (max-width: 980px){
        #middle { margin-top: 0px; }
    }
</style>
<?php endif; ?>


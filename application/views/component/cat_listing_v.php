<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
    $i=0;
    foreach( $mainpage_cat_list as $catlist_ar ): 
        $i++;
?>

<div class="cat_listing">

    <div class="header">
        <h1>
            <a href="/<?=LANG_CODE?>/<?=$catlist_ar['s_cat_ar']['full_uri']?>">
                <?=$catlist_ar['s_cat_ar']['name']?>
            </a>
        </h1>
    </div><!-- #header -->

    <div class="content">
        <div class="left">
            <div class="imgholder">
                <a href="/<?=LANG_CODE?><?="/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[0]['id']}-{$catlist_ar[0]['url_name']}.html"?>">
                    <!--medium-->
                    <?php if($i<=2):?>
                        <img src="/upload/images/real/<?=$catlist_ar[0]['main_img']?>" alt="<?=$catlist_ar[0]['title']?>" border="0" onerror="imgError(this);" />
                    <?php else: ?>
                        <!--<img lazyload="lazyload" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/real/<?=$catlist_ar[0]['main_img']?>" alt="<?=$catlist_ar[0]['title']?>" border="0" onerror="imgError(this);" />-->
                        <img src="/upload/images/real/<?=$catlist_ar[0]['main_img']?>" alt="<?=$catlist_ar[0]['title']?>" border="0" onerror="imgError(this);" />
                    <?php endif; ?>
                    
                </a>
                <div class="description">
                    <h3>
                        <a href="/<?=LANG_CODE?><?="/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[0]['id']}-{$catlist_ar[0]['url_name']}.html"?>">
                            <?= Article_m::get_short_txt($catlist_ar[0]['title'],90,'word','...')?>
                        </a>
                    </h3>
                </div><!-- #description -->
            </div><!-- #imgholder -->
        </div><!-- #left -->
        
        
        <div class="right">
            
            <?php for($ii=1;$ii<=3;$ii++): ?>
            
                <?php if( isset($catlist_ar[$ii]) ): ?>
                <div class="small-listing">
                    <div class="thumb">
                        <a href="/<?=LANG_CODE?><?="/{$catlist_ar[$ii]['full_uri']}-{$catlist_ar[$ii]['id']}-{$catlist_ar[$ii]['url_name']}.html"?>">
                            <?php if($i<=2):?>
                                <img src="/upload/images/small/<?=$catlist_ar[$ii]['main_img']?>" alt="<?=$catlist_ar[1]['title']?>"  border="0" onerror="imgError(this);" />
                            <?php else: ?>
                                <!--<img lazyload="lazyload" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="/upload/images/small/<?=$catlist_ar[$ii]['main_img']?>" alt="<?=$catlist_ar[1]['title']?>"  border="0" onerror="imgError(this);" />-->
                                <img src="/upload/images/small/<?=$catlist_ar[$ii]['main_img']?>" alt="<?=$catlist_ar[1]['title']?>"  border="0" onerror="imgError(this);" />
                            <?php endif; ?>
                        </a>
                    </div><!-- #thumb -->
                    <div class="description">
                        <h4>
                            <a href="/<?=LANG_CODE?><?="/{$catlist_ar[$ii]['full_uri']}-{$catlist_ar[$ii]['id']}-{$catlist_ar[$ii]['url_name']}.html"?>">
                                <?= Article_m::get_short_txt($catlist_ar[$ii]['title'],100,'word','...')?>
                            </a>
                        </h4>
                    </div><!-- #description -->
                </div><!-- #small-listing -->
                <?php endif; ?>
            
            <?php endfor; ?>
            
        </div><!-- #right -->
    </div><!-- #content -->
</div><!-- #listing -->

<?php endforeach; ?>

<?php
//    if($_SERVER['REQUEST_URI'] == '/'){
//        echo '<div style="display:none;">'."\n";
//        
//        echo '<a href="/sitemap_link_page/news/">Sitemap 1</a>'."\n";
//        for($i=2; $i<=100; $i++){
//            echo '<a href="/sitemap_link_page/news/'.$i.'/">Sitemap '.$i.'</a>'."\n";
//        }
//        
//        echo '<a href="/sitemap_link_page/hi-tech/">Sitemap 1</a>'."\n";
//        for($i=2; $i<=50; $i++){
//            echo '<a href="/sitemap_link_page/hi-tech/'.$i.'/">Sitemap '.$i.'</a>'."\n";
//        }
//        
//        echo '</div>';
//    }
?>


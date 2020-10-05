<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="cat_listing">

<!--    <div class="header" style="margin-bottom: 40px;">
        <h1>
            ИНТЕРЕСНОЕ В СЕТИ
        </h1>
    </div>-->
    
    <!-- likeArticlesSlider -->
    
        <?php
            foreach($express_news as $expressData):
                
//            print_r($expressData);    
                
            $hostData   = $expressData['host_data'];
            $newsData   = $expressData['news'];
            $host       = $expressData['host'];
            $lang_code  = $expressData['lang_code'];
        ?>
    
        <div id="like-acle-slider" class="listing in-doc-listing" lang="<?=$hostData['lang'];?>">
            <div class="header">
                <h2 class="doc-cat-title"><?=$hostData['site_name_str'];?> (<?=$hostData['lang'];?>):</h2>
            </div>
            
            <div class="like-article-list">
                <?php
                    foreach ($newsData as $news):
//                        $newsUrl    = 'http://'.$host.'/'.$news['full_uri'].'-'.$news['id'].'-'.$news['url_name'].'/';
//                        $imgUrl     = 'http://'.$host.'/upload/images/small/'.$news['main_img'];
                        
                        $newsUrl    = '/'.$lang_code.'/'.$news['full_uri'].'-'.$news['id'].'-'.$news['url_name'].'.html';
                        
                        # !!! TMP pressreview24.com Links
//                        if(mt_rand(1,1000)<=300){
//                            $newsUrl = 'https://pressreview24.com'.$newsUrl;
//                        }
//                        $imgUrl     = '/'.$lang_code.'/upload/images/small/'.$news['main_img'];
                        $imgUrl     = '/upload/images/small/'.$news['main_img'];
                ?>
                <div class="like-article-item">
                    <a href="<?=$newsUrl?>">
                        <!--<img lazyload="lazyload" src="/img/no_img/flip/no_img_340x220-3.jpg" data-src="<?=$imgUrl?>" alt="<?=htmlspecialchars($news['title'])?>" />-->
                        <img src="<?=$imgUrl?>" alt="<?=htmlspecialchars($news['title'])?>" />
                        <?=Article_m::get_short_txt($news['title'],100,'word','...')?>
                    </a>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
        <?php endforeach; ?>
        <!-- /likeArticlesSlider -->

</div>




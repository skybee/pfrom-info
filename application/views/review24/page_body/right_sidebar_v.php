<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!-- Right Sidebar Start -->
<div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
<!--    <div class="sidebar-box">
        <div class="topic-border color-cod-gray mb-30">
            <div class="topic-box-lg color-cod-gray">Stay Connected</div>
        </div>
        <ul class="stay-connected mb-40 overflow-hidden">
            <li class="facebook">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <div class="connection-quantity">50.2 k</div>
                <p>Fans</p>
            </li>
            <li class="twitter">
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <div class="connection-quantity">10.3 k</div>
                <p>Followers</p>
            </li>
            <li class="linkedin">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
                <div class="connection-quantity">25.4 k</div>
                <p>Fans</p>
            </li>
            <li class="rss">
                <i class="fa fa-rss" aria-hidden="true"></i>
                <div class="connection-quantity">20.8 k</div>
                <p>Subscriber</p>
            </li>
        </ul>
    </div>-->
<!--    <div class="sidebar-box">
        <div class="ne-banner-layout1 text-center">
            <a href="#">
                <img src="img/banner/banner3.jpg" alt="ad" class="img-fluid">
            </a>
        </div>
    </div>-->
    <div class="sidebar-box">
        <div class="topic-border color-cod-gray mb-30">
            <div class="topic-box-lg color-cod-gray">
                <?=$this->multidomaine['top_news_str'];?>
            </div>
        </div>
        
        <?php
            $articleFirst   = array_shift($right_top);
            $newsUrl        = "/".LANG_CODE."/{$articleFirst['full_uri']}-{$articleFirst['id']}-{$articleFirst['url_name']}.html";
        ?>
        
        <div class="img-overlay-70 img-scale-animate">
            <img src="/upload/images/real/<?=$articleFirst['main_img']?>" alt="" class="img-fluid width-100">
            <div class="mask-content-xs">
                <h2 class="title-medium-light size-lg">
                    <a href="<?=$newsUrl?>">
                        <?= Article_m::get_short_txt($articleFirst['title'], 75, 'word', '...'); ?>
                    </a>
                </h2>
            </div>
        </div>
        
        <div class="row right-top-news-row">
            <?php
                $i=0;
                foreach($right_top as $key => $article):
                    $newsUrl    = "/".LANG_CODE."/{$article['full_uri']}-{$article['id']}-{$article['url_name']}.html";
            ?>
            <div class="col-6">
                <div class="mt-30">
                    <div class="position-relative">
                        <a href="<?=$newsUrl?>" class="img-opacity-hover mb-10">
                            <img src="/upload/images/small/<?=$article['main_img']?>" alt="" class="img-fluid">
                        </a>
                    </div>
                    <h3 class="title-medium-dark size-md mb-none">
                        <a href="<?=$newsUrl?>" >
                            <?= Article_m::get_short_txt($article['title'], 75, 'word', '...'); ?>
                        </a>
                    </h3>
                </div>
            </div>
            <?php
                $i++;
                if($i == 8 ){break;}
                endforeach;
            ?>
        </div>
        
        <div>
            <!-- PR24 - 300x600 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:300px;height:600px"
                 data-ad-client="ca-pub-6096727633142370"
                 data-ad-slot="8418393106"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
        
    </div>

    <!-- Serp News Start -->
    <div class="sidebar-box">
        <div class="topic-border color-cod-gray mb-30">
            <div class="topic-box-lg color-cod-gray"><?=$this->multidomaine['serp_news_str'];?></div>
        </div>
        <ul class="mb-40 overflow-hidden right-serp">
            <?php $i=0; ?>
            <?php foreach($serp_list as $serp): ?>
            <li>
                <span class="out-link" src="<?=$serp['url']?>" rel="nofollow" target="_blank">
                    <?=$serp['title']?>
                </span>
                <p>
                    <?=$serp['text']?>
                    <a href="<?=$serp['url']?>" target="_blank" rel="nofollow" style="color:#4c8296;">
                        <?=$serp['host']?>
                    </a>
                </p>
            </li>
            <?php
                $i++;
                if($i>=10){ break; }
                endforeach; 
            ?>
        </ul>
    </div>
    <!-- Serp News End -->
    
</div>


<!-- Right Sidebar End -->
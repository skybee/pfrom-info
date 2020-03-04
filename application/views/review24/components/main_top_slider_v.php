<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- News Slider Area Start Here -->
<section class="container">
    <div class="bg-body box-layout">
        <div class="section-space-bottom-less4">
            <div class="row tab-space2">
<!--                <div class="col-lg-5 col-md-12">
                    <div class="img-overlay-70 img-scale-animate mb-4">
                        <img src="/upload/images/real/<?=$articles[0]['main_img'];?>" alt="news" class="img-fluid width-100">
                        <div class="mask-content-lg">
                            <div class="topic-box-sm color-cod-gray mb-20">Cycling</div>
                            <div class="post-date-light">
                                <ul>
                                    <li>
                                        <span>by</span>
                                        <a href="single-news-1.html">Adams</a>
                                    </li>
                                    <li>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                        <?php #echo $articles[0]['month_str']." ".$articles[0]['day_nmbr'].", &nbsp; ".$articles[0]['year_nmbr'];?>
                                    </li>
                                </ul>
                            </div>
                            <h1 class="title-medium-light">
                                <a href="single-news-1.html"><?=$articles[0]['title'];?></a>
                            </h1>
                        </div>
                    </div>
                </div>-->
                <div class="col-lg-12 col-md-12">                    
                    <div class="row tab-space2">
                        <?php
                            $i=0;
                            foreach ($articles as $articleAr):
                                if($i>=6) break;
                                $i++;
                        ?>
                        <div class="col-sm-4 col-12">
                            <div class="img-overlay-70 img-scale-animate mb-4">
                                <div class="mask-content-sm">
                                    <!--<div class="topic-box-sm color-cod-gray mb-10">Boxing</div>-->
                                    <h3 class="title-medium-light">
                                        <a href="<?="/".LANG_CODE."/{$articleAr['full_uri']}-{$articleAr['id']}-{$articleAr['url_name']}.html"?>">
                                            <?=$articleAr['title'];?>
                                        </a>
                                    </h3>
                                </div>
                                <img src="/upload/images/real/<?=$articleAr['main_img'];?>" alt="news" class="img-fluid width-100">
                            </div>
                        </div>
                        <?php
                            endforeach;
                        ?>
                        
                        
<!--                        <div class="col-sm-6 col-12">
                            <div class="img-overlay-70 img-scale-animate mb-4">
                                <div class="mask-content-sm">
                                    <div class="topic-box-sm color-cod-gray mb-10">Car Racing</div>
                                    <h3 class="title-medium-light">
                                        <a href="single-news-3.html"><?=$articles[2]['title'];?></a>
                                    </h3>
                                </div>
                                <img src="/upload/images/real/<?=$articles[2]['main_img'];?>" alt="news" class="img-fluid width-100">
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="img-overlay-70 img-scale-animate mb-4">
                                <div class="mask-content-sm">
                                    <div class="topic-box-sm color-cod-gray mb-10">Football</div>
                                    <h3 class="title-medium-light">
                                        <a href="single-news-3.html"><?=$articles[3]['title'];?></a>
                                    </h3>
                                </div>
                                <img src="/upload/images/real/<?=$articles[3]['main_img'];?>" alt="news" class="img-fluid width-100">
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="img-overlay-70 img-scale-animate mb-4">
                                <div class="mask-content-sm">
                                    <div class="topic-box-sm color-cod-gray mb-10">Ragbe</div>
                                    <h3 class="title-medium-light">
                                        <a href="single-news-1.html"><?=$articles[4]['title'];?></a>
                                    </h3>
                                </div>
                                <img src="/upload/images/real/<?=$articles[4]['main_img'];?>" alt="news" class="img-fluid width-100">
                            </div>
                        </div>-->
                        
                        
<!--                        <div class="col-sm-6 col-12">
                            <div class="img-overlay-70 img-scale-animate mb-4">
                                <div class="mask-content-sm">
                                    <div class="topic-box-sm color-cod-gray mb-10">Car Racing</div>
                                    <h3 class="title-medium-light">
                                        <a href="single-news-3.html"><?=$articles[0]['title'];?></a>
                                    </h3>
                                </div>
                                <img src="/upload/images/real/<?=$articles[0]['main_img'];?>" alt="news" class="img-fluid width-100">
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="img-overlay-70 img-scale-animate mb-4">
                                <div class="mask-content-sm">
                                    <div class="topic-box-sm color-cod-gray mb-10">Car Racing</div>
                                    <h3 class="title-medium-light">
                                        <a href="single-news-3.html"><?=$articles[5]['title'];?></a>
                                    </h3>
                                </div>
                                <img src="/upload/images/real/<?=$articles[5]['main_img'];?>" alt="news" class="img-fluid width-100">
                            </div>
                        </div>-->
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Slider Area End Here -->
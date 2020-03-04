<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!doctype html>
<html class="no-js" lang="<?=$this->multidomaine['lang'];?>">
    <head>
        <!-- NOINDEX --> <meta name="robots" content="noindex, nofollow" /> 
        
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $meta['title'] ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php if(isset($meta['og'])) echo $meta['og']; ?>
        
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
        <!-- Normalize CSS -->
        <link rel="stylesheet" href="/css/review24/normalize.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="/css/review24/main.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/css/review24/bootstrap.min.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="/css/review24/animate.min.css">
        <!-- Font-awesome CSS-->
        <link rel="stylesheet" href="/css/review24/font-awesome.min.css">
        <!-- Owl Caousel CSS -->
        <link rel="stylesheet" href="/css/review24/owl.carousel.min.css">
        <link rel="stylesheet" href="/css/review24/owl.theme.default.min.css">
        <!-- Main Menu CSS -->
        <link rel="stylesheet" href="/css/review24/meanmenu.min.css">
        <!-- Magnific CSS -->
        <link rel="stylesheet" type="text/css" href="/css/review24/magnific-popup.css">
        <!-- Switch Style CSS -->
        <link rel="stylesheet" href="/css/review24/hover-min.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="/css/review24/style.css">
        <!-- SB style CSS -->
        <link rel="stylesheet" href="/css/review24/sb.css">
        <!-- For IE -->
        <link rel="stylesheet" type="text/css" href="/css/review24/ie-only.css" />
        <!-- Modernizr Js -->
        <script src="/js/review24/modernizr-2.8.3.min.js"></script>
        
        <!-- Google Ads -->
        <!--<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
        
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter49638307 = new Ya.Metrika2({
                            id:49638307,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true,
                            webvisor:true
                        });
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/tag.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks2");
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/49638307" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        
    </head>

    <body>
        
        <?php if(ENVIRONMENT != 'development'): ?>
<!--        <div style="position: fixed; top:0; left: 0; width: 100%; height: 200%; background-color: #009DDB; z-index: 200; " class="sbtmplock">
            <div style="color: #fff; font-size: 24px; text-align: center; margin-top: 20%;">
                The page you are looking for is temporarily unavailable. 
                <br />
                Please try again later
            </div>
        </div>-->
        <?php endif; ?>
        
        <?php  if( isset($this->catNameAr[0]) ): ?> <span style="display:none;" id="opt-tag-main-cat" ><?=$this->catNameAr[0]?></span> <?php endif; ?>
        <?php  if( isset($this->catNameAr[1]) ): ?> <span style="display:none;" id="opt-tag-sub-cat"  ><?=$this->catNameAr[1]?></span> <?php endif; ?>
        
        <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an 
        <strong>outdated</strong> browser. Please 
        <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->
        <!-- Add your site or application content here -->
        <!-- Preloader Start Here -->
        <!--<div id="preloader"></div>-->
        <!-- Preloader End Here -->
        <div id="wrapper">
            
            <!-- Header Area Start Here -->
            <?= $r24_header; ?>
<!-- DEL --><?php #include './components/header.php';?>
            <!-- Header Area End Here -->
            
            <!-- News Feed Area Start Here -->
            <?= $r24_top_news_feed; ?>
<!-- DEL --><?php #include './components/top_news_feed.php';?>
            <!-- News Feed Area End Here -->
            
            
            <!-- News Slider Area Start Here -->
            <?= $r24_main_top_slider; ?>
<!-- DEL --><?php #include './components/main_top_slider.php';?>
            <!-- News Slider Area End Here -->
            
            <!-- Popular News Area Start Here -->
            <!-- Body Start-->
            <section class="container">
                <div class="bg-body box-layout">
                    <div class="section-space-bottom-less30">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">                    
<!-- DEL --><?php #include './components/main_body.php'; ?>
                            <?= $r24_content; ?>    
                            </div>
            <!-- Right Sidebar Start -->
                <?= $r24_right; ?>
<!-- DEL --><?php #include './components/body/body_right_sidebar.php';?>
            <!-- Right Sidebar End -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Body End -->
            <!-- Popular News Area End Here -->
            
            
            <!-- Video Area Start Here -->
<!--            <section class="container">
                <div class="overlay-dark box-layout" style="background-image: url('img/banner/video-back2.jpg');">
                    <div class="section-space-less30">
                        <div class="topic-border color-cinnabar mb-30">
                            <div class="topic-box-lg color-cinnabar">Watch Videos</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-md-12 mb-30">
                                <div class="img-overlay-90">
                                    <div class="text-center">
                                        <a class="play-btn popup-youtube" href="http://www.youtube.com/watch?v=1iIZeIy7TqM">
                                            <img src="img/banner/play.png" alt="play" class="img-fluid">
                                        </a>
                                    </div>
                                    <img src="img/news/news258.jpg" alt="news" class="img-fluid width-100">
                                    <div class="mask-content-lg">
                                        <div class="topic-box-sm color-white mb-20">Car Racing</div>
                                        <div class="post-date-light">
                                            <ul>
                                                <li>
                                                    <span>by</span>
                                                    <a href="single-news-1.html">Adams</a>
                                                </li>
                                                <li>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </span>March 22, 2017</li>
                                            </ul>
                                        </div>
                                        <h2 class="title-medium-light size-lg">
                                            <a href="single-news-1.html">Fitness area coverded they Governed this inCan't shed those Gym?</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="media mb-30 bg-primarytextcolor on-hover-bg-gray">
                                    <a class="img-opacity-hover width27-lg" href="single-news-1.html">
                                        <img src="img/news/news259.jpg" alt="news" class="img-fluid">
                                    </a>
                                    <div class="media-body media-padding8">
                                        <div class="topic-box-sm color-white mb-10">Swiming</div>
                                        <h3 class="title-medium-light mb-none">
                                            <a href="single-news-2.html">Patricia Urquiola transparent area furney Italia with iridescent</a>
                                        </h3>
                                    </div>
                                </div>
                                <div class="media mb-30 bg-primarytextcolor on-hover-bg-gray">
                                    <a class="img-opacity-hover width27-lg" href="single-news-1.html">
                                        <img src="img/news/news260.jpg" alt="news" class="img-fluid">
                                    </a>
                                    <div class="media-body media-padding8">
                                        <div class="topic-box-sm color-white mb-10">Ragbe</div>
                                        <h3 class="title-medium-light mb-none">
                                            <a href="single-news-2.html">Patricia Urquiola transparent area furney Italia with iridescent</a>
                                        </h3>
                                    </div>
                                </div>
                                <div class="media mb-30 bg-primarytextcolor on-hover-bg-gray">
                                    <a class="img-opacity-hover width27-lg" href="single-news-1.html">
                                        <img src="img/news/news261.jpg" alt="news" class="img-fluid">
                                    </a>
                                    <div class="media-body media-padding8">
                                        <div class="topic-box-sm color-white mb-10">Football</div>
                                        <h3 class="title-medium-light mb-none">
                                            <a href="single-news-2.html">Patricia Urquiola transparent area furney Italia with iridescent</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
            <!-- Video Area End Here -->
            
            
            <!-- Latest Article Area Start Here -->
<!--            <section class="container">
                <div class="bg-body box-layout">
                    <div class="section-space-less30">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="topic-border color-scampi mb-30">
                                    <div class="topic-box-lg color-scampi">Latest Article</div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="media media-none--lg mb-30">
                                            <div class="position-relative width-40">
                                                <a href="single-news-1.html" class="img-opacity-hover">
                                                    <img src="img/news/news265.jpg" alt="news" class="img-fluid">
                                                </a>
                                                <div class="topic-box-top-xs">
                                                    <div class="topic-box-sm color-cod-gray mb-20">Cycling</div>
                                                </div>
                                            </div>
                                            <div class="media-body p-mb-none-child media-margin30">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>by</span>
                                                            <a href="single-news-1.html">Adams</a>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>March 22, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-semibold-dark size-lg mb-15">
                                                    <a href="single-news-1.html">Erik Jones has day he won’t soon forget as Denny backup at Bristol</a>
                                                </h3>
                                                <p>Separated they live in Bookmarksgrove right at the coast of the Semantics,
                                                    a large language ocean. A river named Duden flows by their place and
                                                    ...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="media media-none--lg mb-30">
                                            <div class="position-relative width-40">
                                                <a href="single-news-1.html" class="img-opacity-hover">
                                                    <img src="img/news/news266.jpg" alt="news" class="img-fluid">
                                                </a>
                                                <div class="topic-box-top-xs">
                                                    <div class="topic-box-sm color-cod-gray mb-20">Play</div>
                                                </div>
                                            </div>
                                            <div class="media-body p-mb-none-child media-margin30">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>by</span>
                                                            <a href="single-news-1.html">Adams</a>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>March 22, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-semibold-dark size-lg mb-15">
                                                    <a href="single-news-1.html">Conwy becomes host county for Wales Rally GB</a>
                                                </h3>
                                                <p>Separated they live in Bookmarksgrove right at the coast of the Semantics,
                                                    a large language ocean. A river named Duden flows by their place and
                                                    ...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="media media-none--lg mb-30">
                                            <div class="position-relative width-40">
                                                <a href="single-news-1.html" class="img-opacity-hover">
                                                    <img src="img/news/news267.jpg" alt="news" class="img-fluid">
                                                </a>
                                                <div class="topic-box-top-xs">
                                                    <div class="topic-box-sm color-cod-gray mb-20">Tennies</div>
                                                </div>
                                            </div>
                                            <div class="media-body p-mb-none-child media-margin30">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>by</span>
                                                            <a href="single-news-1.html">Adams</a>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>March 22, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-semibold-dark size-lg mb-15">
                                                    <a href="single-news-1.html">M-Sport Hits 250 At Happy Hunting Ground</a>
                                                </h3>
                                                <p>Separated they live in Bookmarksgrove right at the coast of the Semantics,
                                                    a large language ocean. A river named Duden flows by their place and
                                                    ...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="media media-none--lg mb-30">
                                            <div class="position-relative width-40">
                                                <a href="single-news-1.html" class="img-opacity-hover">
                                                    <img src="img/news/news268.jpg" alt="news" class="img-fluid">
                                                </a>
                                                <div class="topic-box-top-xs">
                                                    <div class="topic-box-sm color-cod-gray mb-20">Bike Riding</div>
                                                </div>
                                            </div>
                                            <div class="media-body p-mb-none-child media-margin30">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>by</span>
                                                            <a href="single-news-1.html">Adams</a>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>March 22, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-semibold-dark size-lg mb-15">
                                                    <a href="single-news-1.html">The 10 best things we heard in NFL Week 15</a>
                                                </h3>
                                                <p>Separated they live in Bookmarksgrove right at the coast of the Semantics,
                                                    a large language ocean. A river named Duden flows by their place and
                                                    ...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="media media-none--lg mb-30">
                                            <div class="position-relative width-40">
                                                <a href="single-news-1.html" class="img-opacity-hover">
                                                    <img src="img/news/news269.jpg" alt="news" class="img-fluid">
                                                </a>
                                                <div class="topic-box-top-xs">
                                                    <div class="topic-box-sm color-cod-gray mb-20">Fotball</div>
                                                </div>
                                            </div>
                                            <div class="media-body p-mb-none-child media-margin30">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>by</span>
                                                            <a href="single-news-1.html">Adams</a>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>March 22, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-semibold-dark size-lg mb-15">
                                                    <a href="single-news-1.html">The 10 best things we heard in NFL Week 15</a>
                                                </h3>
                                                <p>Separated they live in Bookmarksgrove right at the coast of the Semantics,
                                                    a large language ocean. A river named Duden flows by their place and
                                                    ...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                                        <div class="media media-none--lg mb-30">
                                            <div class="position-relative width-40">
                                                <div class="position-relative">
                                                    <a href="single-news-1.html" class="img-opacity-hover">
                                                        <img src="img/news/news267.jpg" alt="news" class="img-fluid">
                                                    </a>
                                                    <div class="topic-box-top-xs">
                                                        <div class="topic-box-sm color-cod-gray mb-20">Tennies</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-body p-mb-none-child media-margin30">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>by</span>
                                                            <a href="single-news-1.html">Adams</a>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>March 22, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-semibold-dark size-lg mb-15">
                                                    <a href="single-news-1.html">M-Sport Hits 250 At Happy Hunting Ground</a>
                                                </h3>
                                                <p>Separated they live in Bookmarksgrove right at the coast of the Semantics,
                                                    a large language ocean. A river named Duden flows by their place and
                                                    ...
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ne-sidebar sidebar-break-md col-lg-4 col-md-12">
                                <div class="sidebar-box">
                                    <div class="topic-border color-cod-gray mb-30">
                                        <div class="topic-box-lg color-cod-gray">Categories</div>
                                    </div>
                                    <ul class="archive-list">
                                        <li>
                                            <a href="#">Football
                                                <span> (12)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Tenis
                                                <span> (04)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Golf
                                                <span> (11)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">WRC
                                                <span> (79)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Horse Racing
                                                <span> (05)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Cycling Tour
                                                <span> (07)</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Video
                                                <span> (41)</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="sidebar-box">
                                    <div class="ne-banner-layout1 text-center">
                                        <a href="#">
                                            <img src="img/banner/banner3.jpg" alt="ad" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <div class="sidebar-box">
                                    <div class="topic-border color-cod-gray mb-30">
                                        <div class="topic-box-lg color-cod-gray">Most Reviews</div>
                                    </div>
                                    <div class="add-item5-lg">
                                        <div class="media bg-body item-shadow-gray mb30-list">
                                            <a class="img-opacity-hover width40-lg" href="single-news-1.html">
                                                <img src="img/news/news262.jpg" alt="news" class="img-fluid">
                                            </a>
                                            <div class="media-body">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>February 10, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-medium-dark mb-none">
                                                    <a href="single-news-2.html">Can Be Monit roade year with Program.</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="media bg-body item-shadow-gray mb30-list">
                                            <a class="img-opacity-hover width40-lg" href="single-news-1.html">
                                                <img src="img/news/news263.jpg" alt="news" class="img-fluid">
                                            </a>
                                            <div class="media-body">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>February 10, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-medium-dark mb-none">
                                                    <a href="single-news-2.html">Can Be Monit roade year with Program.</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="media bg-body item-shadow-gray mb30-list">
                                            <a class="img-opacity-hover width40-lg" href="single-news-1.html">
                                                <img src="img/news/news264.jpg" alt="news" class="img-fluid">
                                            </a>
                                            <div class="media-body">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>February 10, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-medium-dark mb-none">
                                                    <a href="single-news-2.html">Can Be Monit roade year with Program.</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="media bg-body item-shadow-gray mb30-list">
                                            <a class="img-opacity-hover width40-lg" href="single-news-1.html">
                                                <img src="img/news/news262.jpg" alt="news" class="img-fluid">
                                            </a>
                                            <div class="media-body">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>February 10, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-medium-dark mb-none">
                                                    <a href="single-news-2.html">Can Be Monit roade year with Program.</a>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="media bg-body item-shadow-gray mb30-list">
                                            <a class="img-opacity-hover width40-lg" href="single-news-1.html">
                                                <img src="img/news/news263.jpg" alt="news" class="img-fluid">
                                            </a>
                                            <div class="media-body">
                                                <div class="post-date-dark">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                            </span>February 10, 2017</li>
                                                    </ul>
                                                </div>
                                                <h3 class="title-medium-dark mb-none">
                                                    <a href="single-news-2.html">Can Be Monit roade year with Program.</a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
            <!-- Latest Article Area End Here -->
            
            
            <!-- Footer Area Start Here -->
            <footer>
                <div class="footer-area-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="footer-box">
                                    <h2 class="title-bold-light title-bar-left text-uppercase">Most Viewed Posts</h2>
                                    <ul class="most-view-post">
                                        <li>
                                            <div class="media">
                                                <a href="post-style-1.html">
                                                    <img src="img/footer/post1.jpg" alt="post" class="img-fluid">
                                                </a>
                                                <div class="media-body">
                                                    <h3 class="title-medium-light size-md mb-10">
                                                        <a href="#">Basketball Stars Face Off itim ate Playoff Beard Battle</a>
                                                    </h3>
                                                    <div class="post-date-light">
                                                        <ul>
                                                            <li>
                                                                <span>
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                </span>November 11, 2017</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <a href="post-style-2.html">
                                                    <img src="img/footer/post2.jpg" alt="post" class="img-fluid">
                                                </a>
                                                <div class="media-body">
                                                    <h3 class="title-medium-light size-md mb-10">
                                                        <a href="#">Basketball Stars Face Off in ate Playoff Beard Battle</a>
                                                    </h3>
                                                    <div class="post-date-light">
                                                        <ul>
                                                            <li>
                                                                <span>
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                </span>August 22, 2017</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <a href="post-style-3.html">
                                                    <img src="img/footer/post3.jpg" alt="post" class="img-fluid">
                                                </a>
                                                <div class="media-body">
                                                    <h3 class="title-medium-light size-md mb-10">
                                                        <a href="#">Basketball Stars Face tim ate Playoff Battle</a>
                                                    </h3>
                                                    <div class="post-date-light">
                                                        <ul>
                                                            <li>
                                                                <span>
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                </span>March 31, 2017</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-3 col-md-6 col-sm-12">
                                <div class="footer-box">
                                    <h2 class="title-bold-light title-bar-left text-uppercase">Popular Categories</h2>
                                    <ul class="popular-categories">
                                        <li>
                                            <a href="#">Gadgets
                                                <span>15</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Architecture
                                                <span>10</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">New look 2017
                                                <span>14</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Reviews
                                                <span>13</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Mobile and Phones
                                                <span>19</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Recipes
                                                <span>26</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">Decorating
                                                <span>21</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">IStreet fashion
                                                <span>09</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12">
                                <div class="footer-box">
                                    <h2 class="title-bold-light title-bar-left text-uppercase">Post Gallery</h2>
                                    <ul class="post-gallery shine-hover ">
                                        <li>
                                            <a href="gallery-style1.html">
                                                <figure>
                                                    <img src="img/footer/post4.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style2.html">
                                                <figure>
                                                    <img src="img/footer/post5.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style1.html">
                                                <figure>
                                                    <img src="img/footer/post6.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style2.html">
                                                <figure>
                                                    <img src="img/footer/post7.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style1.html">
                                                <figure>
                                                    <img src="img/footer/post8.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style2.html">
                                                <figure>
                                                    <img src="img/footer/post9.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style1.html">
                                                <figure>
                                                    <img src="img/footer/post10.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style2.html">
                                                <figure>
                                                    <img src="img/footer/post11.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="gallery-style1.html">
                                                <figure>
                                                    <img src="img/footer/post12.jpg" alt="post" class="img-fluid">
                                                </figure>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-area-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="index.html" class="footer-logo img-fluid">
                                    <img src="/img/pr24/logo-1.png" alt="logo" class="img-fluid">
                                </a>
                                <ul class="footer-social">
                                    <li>
                                        <a href="#" title="facebook">
                                            <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="twitter">
                                            <i class="fa fa-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="google-plus">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="linkedin">
                                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="pinterest">
                                            <i class="fa fa-pinterest" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="rss">
                                            <i class="fa fa-rss" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="vimeo">
                                            <i class="fa fa-vimeo" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul>
                                <p>© 2017 newsedge Designed by RadiusTheme. All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer Area End Here -->
            <!-- Modal Start-->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="title-login-form">Login</div>
                        </div>
                        <div class="modal-body">
                            <div class="login-form">
                                <form>
                                    <label>Username or email address *</label>
                                    <input type="text" placeholder="Name or E-mail" />
                                    <label>Password *</label>
                                    <input type="password" placeholder="Password" />
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox" type="checkbox" checked>
                                        <label for="checkbox">Remember Me</label>
                                    </div>
                                    <button type="submit" value="Login">Login</button>
                                    <button class="form-cancel" type="submit" value="">Cancel</button>
                                    <label class="lost-password">
                                        <a href="#">Lost your password?</a>
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal End-->
            <!-- Offcanvas Menu Start -->
            <div id="offcanvas-body-wrapper" class="offcanvas-body-wrapper">
                <div id="offcanvas-nav-close" class="offcanvas-nav-close offcanvas-menu-btn">
                    <a href="#" class="menu-times re-point">
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <div class="offcanvas-main-body">
                    <ul id="accordion" class="offcanvas-nav panel-group">
                        <li class="panel panel-default">
                            <div class="panel-heading">
                                <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <i class="fa fa-home" aria-hidden="true"></i>Home Pages</a>
                            </div>
                            <div aria-expanded="false" id="collapseOne" role="tabpanel" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="offcanvas-sub-nav">
                                        <li>
                                            <a href="index.html">Home 1</a>
                                        </li>
                                        <li>
                                            <a href="index2.html">Home 2</a>
                                        </li>
                                        <li>
                                            <a href="index3.html">Home 3</a>
                                        </li>
                                        <li>
                                            <a href="index4.html">Home 4</a>
                                        </li>
                                        <li>
                                            <a href="index5.html">Home 5</a>
                                        </li>
                                        <li>
                                            <a href="index6.html">Home 6</a>
                                        </li>
                                        <li>
                                            <a href="index7.html">Home 7</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="author-post.html">
                                <i class="fa fa-user" aria-hidden="true"></i>Author Post Page</a>
                        </li>
                        <li class="panel panel-default">
                            <div class="panel-heading">
                                <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>Post Pages</a>
                            </div>
                            <div aria-expanded="false" id="collapseTwo" role="tabpanel" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="offcanvas-sub-nav">
                                        <li>
                                            <a href="post-style-1.html">Post Style 1</a>
                                        </li>
                                        <li>
                                            <a href="post-style-2.html">Post Style 2</a>
                                        </li>
                                        <li>
                                            <a href="post-style-3.html">Post Style 3</a>
                                        </li>
                                        <li>
                                            <a href="post-style-4.html">Post Style 4</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="panel panel-default">
                            <div class="panel-heading">
                                <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>News Details Pages</a>
                            </div>
                            <div aria-expanded="false" id="collapseThree" role="tabpanel" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="offcanvas-sub-nav">
                                        <li>
                                            <a href="single-news-1.html">News Details 1</a>
                                        </li>
                                        <li>
                                            <a href="single-news-2.html">News Details 2</a>
                                        </li>
                                        <li>
                                            <a href="single-news-3.html">News Details 3</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="archive.html">
                                <i class="fa fa-archive" aria-hidden="true"></i>Archive Page</a>
                        </li>
                        <li class="panel panel-default">
                            <div class="panel-heading">
                                <a aria-expanded="false" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>Gallery Pages</a>
                            </div>
                            <div aria-expanded="false" id="collapseFour" role="tabpanel" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="offcanvas-sub-nav">
                                        <li>
                                            <a href="gallery-style-1.html">Gallery Style 1</a>
                                        </li>
                                        <li>
                                            <a href="gallery-style-2.html">Gallery Style 2</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>404 Error Page</a>
                        </li>
                        <li>
                            <a href="contact.html">
                                <i class="fa fa-phone" aria-hidden="true"></i>Contact Page</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Offcanvas Menu End -->
        </div>
        <!-- jquery-->
        <script src="/js/review24/jquery-2.2.4.min.js " type="text/javascript"></script>
        <!-- Plugins js -->
        <script src="/js/review24/plugins.js " type="text/javascript"></script>
        <!-- Popper js -->
        <script src="/js/review24/popper.js " type="text/javascript"></script>
        <!-- Bootstrap js -->
        <script src="/js/review24/bootstrap.min.js " type="text/javascript"></script>
        <!-- WOW JS -->
        <script src="/js/review24/wow.min.js"></script>
        <!-- Owl Cauosel JS -->
        <script src="/js/review24/owl.carousel.min.js " type="text/javascript"></script>
        <!-- Meanmenu Js -->
        <script src="/js/review24/jquery.meanmenu.min.js " type="text/javascript"></script>
        <!-- Srollup js -->
        <script src="/js/review24/jquery.scrollUp.min.js " type="text/javascript"></script>
        <!-- jquery.counterup js -->
        <script src="/js/review24/jquery.counterup.min.js"></script>
        <script src="/js/review24/waypoints.min.js"></script>

        <!-- Isotope js -->
        <script src="/js/review24/isotope.pkgd.min.js " type="text/javascript"></script>
        <!-- Magnific Popup -->
        <script src="/js/review24/jquery.magnific-popup.min.js"></script>
        <!-- Ticker Js -->
        <script src="/js/review24/ticker.js " type="text/javascript"></script>
        <!-- Custom Js -->
        <script src="/js/review24/main.js " type="text/javascript"></script>
        <!-- Skybee Js -->
        <script src="/js/review24/sb.js " type="text/javascript"></script>
    </body>

</html>

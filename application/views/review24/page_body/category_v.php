<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
    <!-- News Block Start -->
    <?php
        if( isset($news_page_list) && $news_page_list != NULL ):
        foreach( $news_page_list as $news_page_ar ):
            $news_url   = "/".LANG_CODE."/{$news_page_ar['full_uri']}-{$news_page_ar['id']}-{$news_page_ar['url_name']}.html";
            $dateAr     =& $news_page_ar['date'];
            $dateStr    = $dateAr['day_str'].' &nbsp;'.$dateAr['time'].', &nbsp;&nbsp;'.$dateAr['day_nmbr'].' '.$dateAr['month_str'].' '.$dateAr['year_nmbr'];
    ?>
    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
        <div class="media media-none--lg mb-30 sb-cat-list-block">
            <div class="position-relative width-40">
                <a href="<?=$news_url?>" class="img-opacity-hover img-overlay-70 cat-img-a">
                    <?php 
                        if( !empty($news_page_ar['main_img']) )
                            $imgUrl = '/upload/images/real/'.$news_page_ar['main_img']; #<!--medium-->
                        else
                            $imgUrl = '/img/default_news.jpg';
                    ?>
                    <img src="<?=$imgUrl?>" alt="news" class="img-fluid cat-img">
                </a>
            </div>
            <div class="media-body p-mb-none-child media-margin30">
                <h3 class="title-semibold-dark size-lg mb-15">
                    <a href="<?=$news_url?>"><?=$news_page_ar['title']?></a>
                </h3>
                <div class="post-date-dark">
                    <ul>
                        <li>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                            <?=$dateStr;?>
                        </li>
                    </ul>
                </div>
                <p>
                    <?=$news_page_ar['text']?>
                </p>
            </div>
        </div>
    </div>
    <!-- News Block End -->
    <?php
    endforeach; 
    else:
    ?>
        Нет результатов для отображения
    <?php
        endif;
    ?>
</div>

<!-- Paginator Start-->
<div class="row mt-20-r mb-30">
    <div class="col-sm-12 col-12">
        <div class="pagination-btn-wrapper text-center--xs mb15--xs">
            <ul>
                <?php
                    foreach ($pager_ar as $page): 
                    if( !isset($search_url_str) )
                        $pager_url = '/'.LANG_CODE.'/'.$cat_ar['full_uri'].$page.'/';
                    else
                        $pager_url = '/'.LANG_CODE.'/search/'.$page.'/?q='.$search_url_str;
                ?>
                    <?php if($page != $page_nmbr && $page != '...'): ?>
                    <li>
                        <a href="<?=$pager_url?>"><?=$page?></a>
                    </li>
                    <?php else: ?>
                    <li class="active">
                        <!--<span class="pager_not_link"><?=$page?></span>-->
                        <a href="javascript:void(0)"><?=$page?></a>
                    </li>
                    <?php endif;?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<!--    <div class="col-sm-6 col-12">
        <div class="pagination-result text-right pt-10 text-center--xs">
            <p class="mb-none">Page 1 of 4</p>
        </div>
    </div>-->
</div>
<!-- Paginator End-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
//    print_r($doc_data);
?>

<div class="news-details-layout1">

    <h1 class="title-semibold-dark size-c30 post-pr">
        <i><?=$cat_ar['name']?>:</i><?=$doc_data['title']?>
    </h1>
    <ul class="post-info-dark mb-30">
        <li class="doc-top-info">
            <span>By</span>
            <span class="doc-donor-link out-link" src="http://<?=$doc_data['d_host']?>/" <?=$donor_rel;?> target="_blank" style="background-image: url('https://favicon.yandex.net/favicon/<?=$doc_data['d_host']?>');">
                <?=  preg_replace("#(www\.|\.com)#i", '', $doc_data['d_host'])?>
            </span>
        <li>
            <a href="#">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <?="{$doc_data['date_ar']['month_str']}&nbsp;&nbsp;{$doc_data['date_ar']['day_nmbr']},&nbsp;&nbsp;{$doc_data['date_ar']['year_nmbr']}"?>
            </a>
        </li>
<!--        <li>
            <a href="#">
                <i class="fa fa-eye" aria-hidden="true"></i>202</a>
        </li>-->
<!--        <li>
            <a href="#">
                <i class="fa fa-comments" aria-hidden="true"></i>20</a>
        </li>-->
    </ul>
    
    <!-- Text Start -->
    <div class="content-pr copy-url">
        <?=$doc_data['text']?>
    </div>
    <!-- Text End -->
    
    
    
    <!-- Like News BEGIN -->
    <div class="topic-border color-cod-gray mb-30">
        <div class="topic-box-lg color-cod-gray">
            <?=$this->multidomaine['like_news_str'];?>
        </div>
    </div>
    
    <div class="row">
            <!-- Fist Col Start -->
            <div class="col-md-6 col-sm-12">
                <!-- First SubNews Start-->
                <?php
                    for($i=0;$i<=3;$i++):
                        if(!isset($like_articles[$i])){ break; }
                        $subUrl = '/'.LANG_CODE."/{$like_articles[$i]['full_uri']}-{$like_articles[$i]['id']}-{$like_articles[$i]['url_name']}.html";
                ?>
                <div class="media sb-tabnews-sm-dot">
                    <a class="img-opacity-hover" href="<?=$subUrl?>">
                        <img src="/upload/images/small/<?=$like_articles[$i]['main_img']?>" alt="news" class="img-fluid">
                    </a>
                    <div class="media-body">
                        <h3 class="title-medium-dark size-md mb-none">
                            <a href="<?=$subUrl?>">
                                <?= Article_m::get_short_txt($like_articles[$i]['title'], 90, 'word', '...') ?>
                            </a>
                        </h3>
                    </div>
                </div>
                <?php endfor; ?>
                <!-- First SubNews End-->
                
            </div>
            <!-- Fist Col End -->
            
            <!-- Second Col Start -->
            <div class="col-md-6 col-sm-12">
                <!-- Second SubNews Start-->
                <?php
                    for($i=4;$i<=7;$i++):
                        if(!isset($like_articles[$i])){ break; }
                        $subUrl = '/'.LANG_CODE."/{$like_articles[$i]['full_uri']}-{$like_articles[$i]['id']}-{$like_articles[$i]['url_name']}.html";
                ?>
                <div class="media sb-tabnews-sm-dot">
                    <a class="img-opacity-hover" href="<?=$subUrl?>">
                        <img src="/upload/images/small/<?=$like_articles[$i]['main_img']?>" alt="news" class="img-fluid">
                    </a>
                    <div class="media-body">
                        <h3 class="title-medium-dark size-md mb-none">
                            <a href="<?=$subUrl?>">
                                <?= Article_m::get_short_txt($like_articles[$i]['title'], 90, 'word', '...') ?>
                            </a>
                        </h3>
                    </div>
                </div>
                <?php endfor; ?>
                <!-- Second SubNews End-->
            </div>
            <!-- Second Col End -->
        </div>
    <!-- Like News END -->
    
</div>

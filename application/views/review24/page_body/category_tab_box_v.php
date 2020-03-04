<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
//print_r($mainpage_cat_list);
?>


<?php foreach( $mainpage_cat_list as $catlist_ar ): ?>

<!-- MainPage Category TabBox Start -->
<div class="mb-20-r ne-isotope">
    <div class="topic-border color-azure-radiance mb-30">
        <div class="topic-box-lg color-azure-radiance">
            <a href="/<?=LANG_CODE?>/<?=$catlist_ar['s_cat_ar']['full_uri']?>">
                <?=$catlist_ar['s_cat_ar']['name']?>
            </a>
        </div>
    </div>
    
    <div class="featuredContainer">
        <div class="row">
            
            <!-- Fist Col Start -->
            <div class="col-md-6 col-sm-12">
                <!-- First TopNews Start -->
                <div class="mb-30">
                    <div class="img-scale-animate mb-20">
                        <a href="<?='/'.LANG_CODE."/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[0]['id']}-{$catlist_ar[0]['url_name']}.html"?>">
                            <img src="/upload/images/real/<?=$catlist_ar[0]['main_img']?>" alt="news" class="img-fluid width-100">
                        </a>
                    </div>
                    <div class="post-date-dark">
                        <ul>
                            <li>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                                <?php 
                                    $newsDateAr = get_date_str_ar($catlist_ar[0]['date']);
                                    echo "{$newsDateAr['month_str']} {$newsDateAr['day_nmbr']}, {$newsDateAr['year_nmbr']}";
                                ?>
                            </li>
                        </ul>
                    </div>
                    <h3 class="title-semibold-dark size-lg mb-15">
                        <a href="<?='/'.LANG_CODE."/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[0]['id']}-{$catlist_ar[0]['url_name']}.html"?>">
                            <?= Article_m::get_short_txt($catlist_ar[0]['title'], 70, 'word', '...') ?>
                        </a>
                    </h3>
<!--                    <p>
                        Happy Sunday from Software Expand! In thiseek's edition of Feedback Loop,
                        we talk about the future of Phone, whether it makes sense...
                    </p>-->
                </div>
                <!-- First TopNews End -->
                
                <!-- First SubNews Start-->
                <?php
                    for($i=2;$i<=4;$i++):
                        if(!isset($catlist_ar[$i])){ break; }
                        $subUrl = '/'.LANG_CODE."/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[$i]['id']}-{$catlist_ar[$i]['url_name']}.html";
                ?>
                <div class="media sb-tabnews-sm-dot">
                    <a class="img-opacity-hover" href="<?=$subUrl?>">
                        <img src="/upload/images/small/<?=$catlist_ar[$i]['main_img']?>" alt="news" class="img-fluid">
                    </a>
                    <div class="media-body">
                        <h3 class="title-medium-dark size-md mb-none">
                            <a href="<?=$subUrl?>">
                                <?= Article_m::get_short_txt($catlist_ar[$i]['title'], 90, 'word', '...') ?>
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
                <!-- Second TopNews Start -->
                <?php if(isset($catlist_ar[1])):?>
                <div class="mb-30">
                    <div class="img-scale-animate mb-20">
                        <a href="<?='/'.LANG_CODE."/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[1]['id']}-{$catlist_ar[1]['url_name']}.html"?>">
                            <img src="/upload/images/real/<?=$catlist_ar[1]['main_img']?>" alt="news" class="img-fluid width-100">
                        </a>
                    </div>
                    <div class="post-date-dark">
                        <ul>
                            <li>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </span>
                                <?php 
                                    $newsDateAr = get_date_str_ar($catlist_ar[1]['date']);
                                    echo "{$newsDateAr['month_str']} {$newsDateAr['day_nmbr']}, {$newsDateAr['year_nmbr']}";
                                ?>
                            </li>
                        </ul>
                    </div>
                        <h3 class="title-semibold-dark size-lg mb-15">
                            <a href="<?='/'.LANG_CODE."/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[1]['id']}-{$catlist_ar[1]['url_name']}.html"?>">
                                <?= Article_m::get_short_txt($catlist_ar[1]['title'], 70, 'word', '...')  ?>
                            </a>
                        </h3>
<!--                    <p>Happy Sunday from Software Expand! In thiseek's edition of Feedback Loop,
                        we talk about the future of Phone, whether it makes sense...
                    </p>-->
                </div>
                <?php endif; ?>
                <!-- Second TopNews End -->
                
                <!-- Second SubNews Start-->
                <?php
                    for($i=5;$i<=8;$i++):
                        if(!isset($catlist_ar[$i])){break;}
                        $subUrl = '/'.LANG_CODE."/{$catlist_ar['s_cat_ar']['full_uri']}-{$catlist_ar[$i]['id']}-{$catlist_ar[$i]['url_name']}.html";
                ?>
                <div class="media sb-tabnews-sm-dot">
                    <a class="img-opacity-hover" href="<?=$subUrl?>">
                        <img src="/upload/images/small/<?=$catlist_ar[$i]['main_img']?>" alt="news" class="img-fluid">
                    </a>
                    <div class="media-body">
                        <h3 class="title-medium-dark size-md mb-none">
                            <a href="<?=$subUrl?>">
                                <?= Article_m::get_short_txt($catlist_ar[$i]['title'], 90, 'word', '...') ?>
                            </a>
                        </h3>
                    </div>
                </div>
                <?php endfor; ?>
                <!-- Second SubNews End-->
            </div>
            <!-- Second Col End -->
        </div>
    </div><!-- -->
</div>
<?php endforeach; ?>
<!-- MainPage Category TabBox End -->
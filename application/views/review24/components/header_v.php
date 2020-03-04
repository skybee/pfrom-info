<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!-- Header Area Start Here -->
<header>
    <div id="header-layout2" class="header-style5">
        <div class="header-top-bar">
            <div class="top-bar-top bg-primarytextcolor box-layout">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12">
                            <ul class="news-info-list text-center--md">
                                <li class="country-select-li-contain">
                                    
                                    <i class="fa fa-map-marker" aria-hidden="true" style="position: relative; left: 3px;"></i>
                                    <span id="country_name"><?=$this->multidomaine['country_name']?></span>
                                    <ul class="country-select-ul-contain" >
                                        <li><a href="/us/">United States</a></li>
                                        <li><a href="/uk/">United Kingdom</a></li>
                                        <li><a href="/ca/">Canada</a></li>
                                        <li><a href="/au/">Australia</a></li>
                                        <li><a href="/de/">Deutschland</a></li>
                                        <li><a href="/fr/">France</a></li>
                                        <li><a href="/ru/">Russia</a></li>
                                    </ul>
                                    
                                </li>
                                
                                <li class="main-top-menu">
                                    <?php foreach($main_menu_list as $main_menuAr): ?>
                                    <a href="<?='/'.LANG_CODE.'/'.$main_menuAr['full_uri']?>" title="<?=$main_menuAr['title']?>">
                                        <?=$main_menuAr['name']?>
                                    </a>
                                    <?php endforeach; ?>
                                </li>
                                
                                <li>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <span id="current_date"></span>
                                </li>  
                            </ul>
                        </div>
                        <div class="col-lg-3 d-none d-lg-block">
                            <ul class="header-social">
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="bg-body box-layout">
                    
                    <div class="top-bar-bottom pt-20 pb-20 d-none d-lg-block">
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-4">
                                <div class="logo-area">
                                    <a href="/<?=LANG_CODE?>/" class="img-fluid">
                                        <img src="/img/pr24/logo-1.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <div class="ne-banner-layout1 pull-right">
                                    <!--Right Logo Content-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu-area" id="sticker">
            <div class="container">
                <div class="bg-body box-layout">
                    <div class="bg-primarytextcolor pl-15 pr-15">
                        <div class="row no-gutters d-flex align-items-center">
                            <div class="col-lg-10 col-md-10 d-none d-lg-block position-static min-height-none">
                                <div class="ne-main-menu">
                                    <nav id="dropdown">
                                        <ul>
                                            <?php foreach ($second_menu_list as $second_menu_ar): ?>
                        <!--class="active"-->   <li class="cat-item cat-item-<?= $second_menu_ar['id'] ?>" catname="<?=$second_menu_ar['url_name']?>">
                                                <a href="/<?=LANG_CODE?>/<?= $second_menu_ar['full_uri'] ?>"><?= $second_menu_ar['name'] ?></a>
                                                <?php if( isset($second_menu_ar['sub_cat_list']) ): ?>
                                                <ul class="ne-dropdown-menu">
                                                    <?php foreach($second_menu_ar['sub_cat_list'] as $third_menu_ar): ?>
                                                        <li>
                                                            <a href="/<?=LANG_CODE?>/<?= $third_menu_ar['full_uri'] ?>" ><?= $third_menu_ar['name'] ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <?php endif; ?>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 text-right position-static min-height-none">
                                <div class="header-action-item on-mobile-fixed">
                                    <ul>
                                        <li>
                                            <form id="top-search-form" class="header-search-light">
                                                <input type="text" class="search-input" placeholder="Search...." required="" style="display: none;">
                                                <button class="search-button">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </li>
                                        <li class="d-none d-sm-block d-md-block d-lg-none">
                                            <button type="button" class="login-btn" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-user" aria-hidden="true"></i>Sign in
                                            </button>
                                        </li>
                                        <li>
                                            <div id="side-menu-trigger" class="offcanvas-menu-btn offcanvas-btn-repoint">
                                                <a href="#" class="menu-bar">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                                <a href="#" class="menu-times close">
                                                    <span></span>
                                                    <span></span>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Area End Here -->
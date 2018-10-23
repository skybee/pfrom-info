<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
//print_r($mobile_menu_list);
$mobile_menu_list = array_reverse($mobile_menu_list);
?>

<a href="javascript:void(0);" id="mobile_nav_btn">
</a>

<div id="mobile_menu">
    <div id="mobile_menu_tabs">
        <ul id="nav-tabs">
            <?php foreach ($mobile_menu_list as $i => $menuTop):?>
            <li catname="<?=$menuTop['url_name']?>"><a href="#tabs-<?=$i?>"><?=$menuTop['name']?></a></li>
            <?php endforeach;?>
        </ul>
        
        <?php foreach ($mobile_menu_list as $i => $menuTop):?>
        <div id="tabs-<?=$i?>">
            <ul class="mobile_sub_menu">
                <li>
                    &nbsp;&nbsp;
                    <span data-url="/<?=LANG_CODE?>/<?=$menuTop['full_uri']?>" data-anchor="<?=$menuTop['name']?>/" ></span>
                    <!--<a href="/<?=$menuTop['full_uri']?>"><?=$menuTop['name']?> / Главная</a>-->
                </li>
            <?php foreach ($menuTop['sub_menu'] as $subMenu):?>
                <li catname="<?=$subMenu['url_name']?>">
                    <span data-url="/<?=LANG_CODE?>/<?=$subMenu['full_uri']?>" data-anchor="<?=$subMenu['name']?>" ></span>
                    <!--<a href="/<?=$subMenu['full_uri']?>"><?=$subMenu['name']?></a>-->
                    
                    <?php if(isset($subMenu['sub_cat_list'])):?>
                    <ul class="mobile_sub_menu mobile_sub_sub_menu">
                        <?php foreach ($subMenu['sub_cat_list'] as $subSubMenu):?>
                        <li>
                            <span data-url="/<?=LANG_CODE?>/<?=$subSubMenu['full_uri']?>" data-anchor="<?=$subSubMenu['name']?>" ></span>
                            <!-- <a href="/<?=$subSubMenu['full_uri']?>"><?=$subSubMenu['name']?></a> -->
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php endif;?>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
        <?php endforeach;?>
    </div>
</div>


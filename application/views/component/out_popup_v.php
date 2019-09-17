<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="out_window">
    <div id="ow_title"><?=$this->multidomaine['outwindow_str'];?></div>
    <div id="ow_body">
        <?php 
            $i=0;
            foreach($like_articles as $lArticle):
            $i++;
            if($i > 3){ break; }
            $url = '/'.LANG_CODE.'/'.$lArticle['full_uri'].'-'.$lArticle['id'].'-'.$lArticle['url_name'].'.html';
        ?>
        <div class="ow_item">
            <a href="<?=$url;?>">
                <img src="/upload/images/real/<?=$lArticle['main_img'];?>" onerror="imgError(this);" />
            </a>
            <a href="<?=$url;?>" class="ow_item_title">
                <?=Article_m::get_short_txt($lArticle['title'],110,'word','...');?>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <div id="ow_close"></div>
</div>
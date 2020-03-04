<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- News Feed Area Start Here -->
<section class="container">
    <div class="bg-body box-layout">
        <div class="row no-gutters d-flex align-items-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-5">
                <div class="topic-box mt-4 mb-5"><?=$this->multidomaine['top_news_str'];?></div>
            </div>
            <div class="col-lg-10 col-md-9 col-sm-8 col-7">
                <div class="feeding-text-dark2">
                    <ol id="sample" class="ticker">
                        <?php
                            $feedNewsAr = $right_top;
                            shuffle($feedNewsAr);
                            $i=0;
                            foreach($feedNewsAr as $key => $article):
                                $newsUrl    = "/".LANG_CODE."/{$article['full_uri']}-{$article['id']}-{$article['url_name']}.html";
                        ?>
                        <li>
                            <a href="<?=$newsUrl?>"><?=$article['title']?></a>
                        </li>
                        <?php
                            $i++;
                            if($i >= 3 ){break;}
                            endforeach;
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- News Feed Area End Here -->
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        if(     $_SERVER['HTTP_HOST'] != 'pressfrom.info' 
                && $_SERVER['HTTP_HOST'] != 'express-info.lh' 
                && $_SERVER['HTTP_HOST'] != 'pressfrom.vbox' 
//                && $_SERVER['HTTP_HOST'] != 'pressreview24.com' 
                && $_SERVER['HTTP_HOST'] != 'pressreview24.lh'
                && $_SERVER['HTTP_HOST'] != 'unionpress24.lh'
        ){

            header("HTTP/1.1 301 Moved Permanently"); 
            header("Location: https://pressfrom.info/".LANG_CODE."{$_SERVER['REQUEST_URI']}"); 
            exit(); 
        }
        
        $this->load->database();
        $this->load->model('list_m');
        $this->load->model('article_m');
        $this->load->model('category_m');
        $this->load->helper('date_convert');
        $this->load->helper('doc_helper');
        $this->load->helper('js_version');
        $this->load->driver('cache');
        $this->load->config('category'); // -?
        $this->load->config('multidomaine');
        $this->load->library('multidomaine_lib');
        $this->load->library('cat_lib');
        $this->load->library('Express_news_lib');
        $this->load->library('minox/Minox_lib');
//        $this->load->library('user_agent');
        
        $this->catNameAr = $this->cat_lib->getCatFromUri();
        $this->catConfig = $this->cat_lib->getCatConfig();
        
        $this->cacheTime['footerCat']     = 180; //minutes
        
        $this->topSliderTxtLength       = 290;
        
        $this->multidomaine = $this->multidomaine_lib->getHostData();
        
        ///////// TMP /////////
        //$this->db->query("INSERT INTO `shingles` SET `hash`='{$_SERVER['HTTP_X_REAL_IP']}'");

    }

    function index(){ 
        $mainCatData = $this->category_m->get_cat_data_from_id(1);
        $this->catNameAr[0] = $mainCatData['url_name'];
        $this->main_page($mainCatData['url_name']);
    }

    function main_page($cat_name) {
        $this->output->cache( $this->catConfig['cache_time_main_page_m'] );

        $data_ar['main_cat_ar']         = $this->article_m->get_cat_data_from_url_name($cat_name);
        
        if(!isset($data_ar['main_cat_ar']['id'])){
            show_404(); exit();
        }
        
//        if($cat_name == 'news')
//        {
            #$data_ar['express_news'] = $this->express_news_lib->get_news();
            $expressNewsLangCodeAr = ['us','ca','uk','de','fr','au','ru','br'];
            $data_ar['express_news'] = $this->express_news_lib->get_news_OneHost($expressNewsLangCodeAr, false);
//        }
        
        
        $data_ar['main_menu_list']      = $this->list_m->get_cat(0);
        $data_ar['second_menu_list']    = $this->list_m->get_sCat_from_name($this->catNameAr[0]);
        $data_ar['footer_menu_list']    = $this->list_m->get_footer_cat_link();
        $mobile_menu_list               = $this->list_m->getMenuListForMobile();
        $data_ar['mainpage_cat_list']   = $this->article_m->get_mainpage_cat_news( // 9.5 sec.
                                                $data_ar['second_menu_list'],
                                                $this->multidomaine['host_conf']['conf']['mainpage_cat_list']
                                            ); 
        $data_ar['meta']['title']       = $data_ar['main_cat_ar']['title'];
        
        $top_slider['articles']         = $this->article_m->get_top_slider_data(
                                                $data_ar['main_cat_ar']['id'], 
                                                8, 
                                                $this->catConfig['top_news_time_h'], 
                                                $this->topSliderTxtLength, 
                                                true, 
                                                true
                                                ); // 1.5 sec.
        $right['right_top']             = $this->article_m->get_top_slider_data(
                                                $data_ar['main_cat_ar']['id'], 
                                                $this->multidomaine['host_conf']['conf']['right_top'], 
                                                $this->catConfig['right_top_news_time_h'], 
                                                $this->topSliderTxtLength, 
                                                true, 
                                                true, 
                                                'right_top'
                                                );
        $top_slider['main_cat_url']     = $data_ar['main_cat_ar']['url_name'];
        $right['last_news']             = $this->article_m->get_last_left_news( 
                                                $data_ar['main_cat_ar']['id'], 
                                                50 
                                                ); // 1.5 sec.

        
        $tpl_ar = $data_ar; //== !!! tmp
        
        if($this->multidomaine['host_conf']['tpl'] == 'pressfrom'){    
            $tpl_ar['content']  = $this->load->view('component/main_latest_v', $data_ar, true);
            $tpl_ar['content'] .= $this->load->view('component/cat_listing_v', $data_ar, true);
            $tpl_ar['content'] .= $this->load->view('component/main_other_news_v', $data_ar, true);// .'<div>'.$msg.'</div>';
            $tpl_ar['right']        = $this->load->view('component/right_last_news_v', $right, true);
            $tpl_ar['top_slider']   = $this->load->view('component/slider_top_v', $top_slider, true);
            $tpl_ar['mobile_menu']  = $this->load->view('component/mobile_menu_v', 
                                                        array('mobile_menu_list'=>$mobile_menu_list), 
                                                        true
                                                        );

            $this->load->view('main_v', $tpl_ar);
        }
        elseif($this->multidomaine['host_conf']['tpl'] == 'press24'){
            $tpl_ar['r24_header']           = $this->load->view('review24/components/header_v', $data_ar, true);
            $tpl_ar['r24_top_news_feed']    = $this->load->view('review24/components/top_news_feed_v', $right, true);
            $tpl_ar['r24_main_top_slider']  = $this->load->view('review24/components/main_top_slider_v', $top_slider, true);
            $tpl_ar['r24_right']            = $this->load->view('review24/page_body/right_sidebar_v', $right, true);
            $tpl_ar['r24_content']          = $this->load->view('review24/page_body/category_tab_box_v', $data_ar, true);
            
            $this->load->view('review24/main_v', $tpl_ar);
        }

	$this->changeOutput();
    }

    function document($url_id_name) {
        
        preg_match("#-(\d+)-(.+)#i", $url_id_name, $url_id_name_ar); //зазбор URL_name
        $doc_id = $url_id_name_ar[1];
        $doc_urlname = $url_id_name_ar[2];

        $data_ar['doc_data']            = $this->article_m->get_doc_data($doc_id);
        
        if (!$data_ar['doc_data']){
            $cat_url = preg_replace("#/-\d+-\S+$#i", '/', $_SERVER['REQUEST_URI']);
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".'/'.LANG_CODE."{$cat_url}#404");
            exit();
        }

        $right['serp_list'] = serpDataFromJson(
                                $data_ar['doc_data']['serp_object'],
                                $this->multidomaine['host_conf']['conf']['serp_split_up']
                            );
        
        unset($data_ar['doc_data']['serp_object']);
        
        /* ! LANG_CODE Down */ 
        $true_url = '/' .$data_ar['doc_data']['cat_full_uri'].'-'
                        .$data_ar['doc_data']['id'].'-'
                        .$data_ar['doc_data']['url_name'].'.html';
        
        if( $true_url != $_SERVER['REQUEST_URI'] ){
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".'/'.LANG_CODE.$true_url);
            exit();
        }
        
        # Redirect to PR24
        # $this->docRedirectToPR24('document', $data_ar['doc_data']['date']);
        
        $data_ar['cat_ar']              = $this->category_m->get_cat_data_from_id($data_ar['doc_data']['cat_id']);
        $data_ar['like_articles']       = $this->article_m->get_like_articles( 
                                                $data_ar['doc_data']['id'], 
                                                $data_ar['doc_data']['cat_id'] /*$data_ar['cat_ar']['parent_id']*/, 
                                                $data_ar['doc_data']['title'], 
                                                16, //old 8 (8*2sites) 
                                                $this->catConfig['like_news_day_d'], 
                                                $data_ar['doc_data']['date'] 
                                                );
        
        if(count($data_ar['like_articles'])>=12){ //разбивка likeNews на 2 сайта
            $data_ar['like_articles']   = arraySplitUp(
                                            $data_ar['like_articles'],
                                            $this->multidomaine['host_conf']['conf']['serp_split_up']
                                        );
        }
        
//        $data_ar['like_translate']      = $this->article_m->getTranslateForArticle(
//                                                $data_ar['doc_data']['id'],
//                                                'pressfrom.info'
//                                                );
//        
//        $data_ar['doc_data']['text']    = addTranslateToMainTxt($data_ar['doc_data']['text'], $data_ar['like_translate']);
        
        $data_ar['main_menu_list']      = $this->list_m->get_cat(0);
        $data_ar['second_menu_list']    = $this->list_m->get_sCat_from_name($this->catNameAr[0]);
        $data_ar['footer_menu_list']    = $this->list_m->get_footer_cat_link();
        $mobile_menu_list               = $this->list_m->getMenuListForMobile();
        $data_ar['meta']['title']       = $data_ar['cat_ar']['name'].': '
                                            .$data_ar['doc_data']['title'].' - '
//                                            .$data_ar['like_translate']['title'].' - '
                                            .$this->multidomaine['site_name_str'];
        $data_ar['donor_rel']           = ' rel="nofollow" '; #botRelNofollow();

        //пометка изображений в тексте (костыль для редиректа при image 404)
        $data_ar['doc_data']['text']    =  preg_replace(
                                            "#(/upload/images\S+\.(jpg|jpeg|gif|png|img))#i", 
                                            "$1?content=1", 
                                            $data_ar['doc_data']['text']
                                        );
        //LazyLoad Text Rewrite
        $data_ar['doc_data']['text']    = rewriteImgInToLazyLoad($data_ar['doc_data']['text']);
        
        
        //вставка like_articles[0] в текст
        $data_ar['doc_data']['text']    =   insertLikeArtInTxt(
                                                $data_ar['doc_data']['text'], 
                                                $data_ar['like_articles'], 
                                                $right['serp_list']
                                            );
        $data_ar['doc_data']['text']    =   $this->minox_lib->addLinkToTxt(
                                                $data_ar['doc_data']['text'],
                                                $data_ar['doc_data']['pay_article']
                                            );
        $data_ar['doc_data']['text']    =   addResponsiveVideoTag($data_ar['doc_data']['text']);
        
        $data_ar['doc_data']['author_json'] = getAuthorJsonData(
                                                    $data_ar['doc_data']['author_data'],
                                                    $data_ar['doc_data']['pay_article']
                                                );

        $data_ar['like_video']          = $this->article_m->get_like_video($data_ar['doc_data']['id'],2);
        
        $top_slider['articles']         = $this->article_m->get_top_slider_data( 
                                                $data_ar['cat_ar']['id'], 
                                                8, 
                                                $this->catConfig['top_news_time_h'], 
                                                $this->topSliderTxtLength, 
                                                true, 
                                                false
                                            );
        $right['right_top']             = $this->article_m->get_top_slider_data( 
                                                $data_ar['cat_ar']['parent_id'], 
                                                $this->multidomaine['host_conf']['conf']['right_top'], 
                                                $this->catConfig['right_top_news_time_h'], 
                                                $this->topSliderTxtLength, 
                                                true, 
                                                true, 
                                                'right_top'
                                            );
        $right['last_news']             = $this->article_m->get_last_left_news( 
                                                $data_ar['cat_ar']['parent_id'], 
                                                $this->multidomaine['host_conf']['conf']['last_news'] 
                                            );
        
        $right['minox_link']            = $this->minox_lib->getLinkToMinoxPage();
        $right['pay_article']           = $data_ar['doc_data']['pay_article'];
        
        if($_SERVER['HTTP_HOST'] !== $this->multidomaine['host']){ //Aliases Canonical
//            $canonicalUrl                   = 'http://'.$this->multidomaine['host'].$_SERVER['REQUEST_URI'];
//            
//            $url_str = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//            $url_int = abs(crc32($url_str));
//            
//            mt_srand($url_int);
//            $rnd_int = mt_rand(1, 1000);
//            mt_srand();
//            
//            if($rnd_int<=500){
//                $data_ar['meta']['canonical']   = '<link rel="canonical" href="'.$canonicalUrl.'" />'."\n";
//            }
//            else{
//                $data_ar['source_url'] = $canonicalUrl;
//            }
        }
        
        $tpl_ar = $data_ar; //== !!! tmp
        
        if($this->multidomaine['host_conf']['tpl'] == 'pressfrom'){
            $tpl_ar['content']      = $this->load->view('page/doc_v', $data_ar, true); // .'<div>'.$msg.'</div>';
            $tpl_ar['top_slider']   = $this->load->view('component/slider_top_v', $top_slider, true);
            $tpl_ar['right']        = $this->load->view('component/right_last_news_v', $right, true);
            $tpl_ar['meta']['og']   = $this->load->view('component/meta_og_v', $data_ar['doc_data'], true);
            $tpl_ar['mobile_menu']  = $this->load->view(    
                                                        'component/mobile_menu_v', 
                                                        array('mobile_menu_list'=>$mobile_menu_list), 
                                                        true
                                                    );
            $tpl_ar['out_popup']    = $this->load->view('component/out_popup_v', $data_ar['like_articles'], true);

            $this->load->view('main_v', $tpl_ar);
        }
        elseif($this->multidomaine['host_conf']['tpl'] == 'press24'){
            $tpl_ar['r24_header']           = $this->load->view('review24/components/header_v', $data_ar, true);
            $tpl_ar['r24_top_news_feed']    = $this->load->view('review24/components/top_news_feed_v', $right, true);
            $tpl_ar['r24_main_top_slider']  = $this->load->view('review24/components/main_top_slider_v', $top_slider, true);
            $tpl_ar['r24_right']            = $this->load->view('review24/page_body/right_sidebar_v', $right, true);
            $tpl_ar['r24_content']  = $this->load->view('review24/page_body/post_v', $data_ar, true);
            $tpl_ar['meta']['og']   = $this->load->view('review24/components/meta_og_v', $data_ar['doc_data'], true);

            $this->load->view('review24/main_v', $tpl_ar);
        }

	$this->changeOutput();
    }

    function cat_list($cat_name, $page) {
        
        $page = (int) $page;
        if (!$page) $page = 1;

        $data_ar['cat_ar'] = $this->category_m->get_cat_data_from_url( $cat_name );
        
        if( !isset($data_ar['cat_ar']['id']) ){
            show_404(); exit();
        }
        
//        if($data_ar['cat_ar']['parent_id'] === 0)
//        {
//            return $this->main_page($data_ar['url_name']);
//        }
        
        // TMP PR24 Link
        // if($page <=10){ $this->PR24CatLink = "https://pressreview24.com/".TMP_HOST_LANG.preg_replace("#\d+/$#i", '', $_SERVER['REQUEST_URI']); }
        
        if($page > 100) { // temp redirect 
            header("Location: /{$data_ar['cat_ar']['full_uri']}", true, 302);
            exit();
        }
        
        $data_ar['news_page_list']      = $this->article_m->get_page_list(
                                                $data_ar['cat_ar']['id'], 
                                                $page, 
                                                15, 
                                                $this->multidomaine['host_conf']['conf']['cat_list_txt_lenth'] 
                                            );
        $data_ar['pager_ar']            = $this->article_m->get_pager_ar( 
                                                $data_ar['cat_ar']['id'], 
                                                $page, 
                                                15, 
                                                4
                                            );
        $data_ar['page_nmbr']           = $page;
        
        if (!$data_ar['news_page_list'])
        {
            show_404();
        }
        $data_ar['main_menu_list']      = $this->list_m->get_cat(0);
        $data_ar['second_menu_list']    = $this->list_m->get_sCat_from_name($this->catNameAr[0]);
        $data_ar['footer_menu_list']    = $this->list_m->get_footer_cat_link();
        $mobile_menu_list               = $this->list_m->getMenuListForMobile();
        $data_ar['meta']['title']       = $data_ar['cat_ar']['title']; 
        if( $page > 1){
            $data_ar['meta']['title']  .= ' - '.$this->multidomaine['page_str'].' '.$page;
//            $data_ar['meta']['noindex'] = true;
        }

        $top_slider['articles'] = $this->article_m->get_top_slider_data( 
                                        $data_ar['cat_ar']['id'], 
                                        8, 
                                        $this->catConfig['top_news_time_h'], 
                                        $this->topSliderTxtLength, 
                                        true, 
                                        false
                                    );
        $right['right_top']     = $this->article_m->get_top_slider_data( 
                                        $data_ar['cat_ar']['parent_id'], 
                                        $this->multidomaine['host_conf']['conf']['right_top'], 
                                        $this->catConfig['right_top_news_time_h'], 
                                        $this->topSliderTxtLength, 
                                        true, 
                                        true, 
                                        'right_top'
                                    );
        $right['last_news']     = $this->article_m->get_last_left_news( 
                                        $data_ar['cat_ar']['parent_id'], 
                                        50 
                                    );
        
        $tpl_ar = $data_ar; //== !!! tmp
        
        if($this->multidomaine['host_conf']['tpl'] == 'pressfrom'){
            $tpl_ar['content']      = $this->load->view('page/cat_list_v', $data_ar, true);
            $tpl_ar['top_slider']   = $this->load->view('component/slider_top_v', $top_slider, true);
            $tpl_ar['right']        = $this->load->view('component/right_last_news_v', $right, true);
            $tpl_ar['mobile_menu']  = $this->load->view(
                                                        'component/mobile_menu_v', 
                                                        array('mobile_menu_list'=>$mobile_menu_list), 
                                                        true
                                                    );

            $this->load->view('main_v', $tpl_ar);
        }
        elseif($this->multidomaine['host_conf']['tpl'] == 'press24'){
            $tpl_ar['r24_header']           = $this->load->view('review24/components/header_v', $data_ar, true);
            $tpl_ar['r24_top_news_feed']    = $this->load->view('review24/components/top_news_feed_v', $right, true);
            $tpl_ar['r24_main_top_slider']  = $this->load->view('review24/components/main_top_slider_v', $top_slider, true);
            $tpl_ar['r24_right']            = $this->load->view('review24/page_body/right_sidebar_v', $right, true);
            $tpl_ar['r24_content']          = $this->load->view('review24/page_body/category_v', $data_ar, true);

            $this->load->view('review24/main_v', $tpl_ar);
        }
	
        $this->changeOutput();
    }
    
    function search( $page=1 ){
        $page = (int) $page; if (!$page) $page = 1;
        
        $searchStr   = $_GET['q'];
        $searchStr   = preg_replace("#[^a-z а-яё]#iu", ' ', $searchStr);
        
//        $data_ar['main_cat_ar']         = $this->article_m->get_cat_data_from_url_name($cat_name);
        #$data_ar['news_page_list']      = $this->article_m->get_search_page_list($searchStr, $page, 15 );
        #$data_ar['pager_ar']            = $this->article_m->get_search_pager_ar( $searchStr, $page, 15, 4);
        #$data_ar['page_nmbr']           = $page;
        
        #if (!$data_ar['news_page_list'])
        #    $data_ar['news_page_list'] = NULL; #show_404();
        $data_ar['main_menu_list']      = $this->list_m->get_cat(0);
        $data_ar['second_menu_list']    = $this->list_m->get_cat(1);
        $data_ar['footer_menu_list']    = $this->list_m->get_footer_cat_link();
        $mobile_menu_list               = $this->list_m->getMenuListForMobile();
        $data_ar['meta']['title']       = 'Поиск: &laquo;'.$searchStr.'&raquo;  - '.$this->multidomaine['page_str'].' '.$page;
        
        $top_slider['articles']         = $this->article_m->get_top_slider_data(
                                                1, 
                                                8, 
                                                $this->catConfig['right_top_news_time_h'], 
                                                $this->topSliderTxtLength, 
                                                true, 
                                                true
                                            ); // 1.5 sec.
        $right['right_top']             = $this->article_m->get_top_slider_data(
                                                1, 
                                                $this->multidomaine['host_conf']['conf']['right_top'], 
                                                $this->catConfig['right_top_news_time_h'], 
                                                $this->topSliderTxtLength, 
                                                true, 
                                                true, 
                                                'right_top'
                                            );
        
        $right['last_news']              = $this->article_m->get_last_left_news( 1, 50 );
        
        //<Rename for cat list view>
        $data_ar['cat_ar']['p_name']    = 'Поиск временно отключен';
        $data_ar['cat_ar']['name']      = '';#$searchStr;
        $data_ar['search_url_str']      = str_replace(' ', '+', $searchStr);
        //</Rename for cat list view>
        
        $tpl_ar                 = $data_ar; //== !!! tmp
        $tpl_ar['content']      = $this->load->view('page/cat_list_v', $data_ar, true);
        $tpl_ar['top_slider']   = $this->load->view('component/slider_top_v', $top_slider, true);
        $tpl_ar['right']        = $this->load->view('component/right_last_news_v', $right, true);
        $tpl_ar['mobile_menu']  = $this->load->view(
                                                    'component/mobile_menu_v', 
                                                    array('mobile_menu_list'=>$mobile_menu_list), 
                                                    true
                                                );

        $this->load->view('main_v', $tpl_ar);
    }
    
    function info($pageName){
        $this->index(); // загрузка главной страницы
        
        $output = $this->output->get_output();
        
        $title = ''; $content = '';
        
        if($_SERVER['HTTP_HOST'] == 'pressfrom.info' || $_SERVER['HTTP_HOST'] == 'express-info.lh'){
            if($pageName=='contact'){
                $title      = 'Contact | About Us |'.$this->multidomaine['site_name_str'];
                $content    = $this->load->view('page/info_page/contact_v', NULL, true);
            }
            elseif($pageName=='privacy-policy'){
                $title      = 'Privacy Policy - '.$this->multidomaine['site_name_str'];
                $content    = $this->load->view('page/info_page/privacy_policy_v', NULL, true);
            }
            
            $output = preg_replace("#(<title>)[\s\S]+?(</title>)#i", "$1".$title."$2", $output);
            $output = preg_replace("#<!--<info-page-replace>-->[\s\S]+?<!--</info-page-replace>-->#i", $content, $output);
        }
        else{
            if($pageName=='contact'){
                $title      = 'Contact | About Us |'.$this->multidomaine['site_name_str'];
                $content    = $this->load->view('review24/info_page/contact_v', NULL, true);
            }
            elseif($pageName=='privacy-policy'){
                $title      = 'Privacy Policy - '.$this->multidomaine['site_name_str'];
                $content    = $this->load->view('review24/info_page/privacy_policy_v', NULL, true);
            }
            
            $output = preg_replace("#(<title>)[\s\S]+?(</title>)#i", "$1".$title."$2", $output);
            $output = preg_replace("#<!--<info-page>-->[\s\S]+?<!--</info-page>-->#i", $content, $output);
        }
        
        if(empty($title) || empty($content)){
            header("HTTP/1.1 301 Moved Permanently"); 
            header("Location: /".LANG_CODE."/"); 
            exit();
        }
        
        $this->output->set_output($output);
    }
    
    
    
    function _sitemap_link_page( $cat, $page = 1 ){
        $this->output->cache( 3600*24*10 );
        
        $query      = $this->db->query(" SELECT `sub_cat_id`, `name` FROM `category` WHERE `url_name` = '{$cat}' LIMIT 1 ");
        $row        = $query->row_array();
        $subCatId   = $row['sub_cat_id'];
        $catNmae    = $row['name'];
        
        if( empty($subCatId) ) exit("<h1>Cat Name Error</h1>");
        
        $cnt    = 150;
        $stop   = $page * $cnt;
        $start  = $stop - $cnt;
        
        $sql = "SELECT "
                . "`article`.`url_name`, `article`.`title`, `article`.`id`, `article`.`views`, "
                . "`category`.`full_uri` "
                . "FROM "
                . "`article`, `category` "
                . "WHERE "
                . "`article`.`cat_id` IN ({$subCatId}) "
                . "AND "
                . "`category`.`id` = `article`.`cat_id` "
                . "ORDER BY `article`.`views` DESC "
                . "LIMIT {$start}, {$cnt} ";
        
        $query = $this->db->query($sql);
        
        if( $query->num_rows() < 1 ) exit("<h1>No link</h1>\n".$sql);
        
        $html   = '<html><head><title>'.$catNmae.' '.$this->multidomaine['page_str'].' - '.$page.'</title></head><body>';
        
        foreach( $query->result_array() as $catData ){
            $html   .= $catData['views'].' - '.$catData['title']."<br />\n";
            $html   .= '<a href="/'.LANG_CODE."/{$catData['full_uri']}-{$catData['id']}-{$catData['url_name']}.html\" >".$catData['title'].'</a>'."<br /><br />\n\n";
        }
        
        $html  .= '</body></html>';
        
        $data['html'] = $html;
        
        $this->load->view('page/spe_link_v', $data );
    }
    
//    private function docRedirectToPR24($page=false, $timestamp=false) { 
//        $pr24Url = 'https://pressreview24.com/'.TMP_HOST_LANG.$_SERVER['REQUEST_URI'];
//       
//        if($page=='document'){ // If this page = News(document)
//            $pr24Url = preg_replace("#/$#i", '', $pr24Url);
//            $pr24Url = $pr24Url.'.html   ';
//        }
//
//        if($timestamp != false){ //cnt Day redirect
//            $periodTime = 90*(3600*24);  //cnt sec.
//            $newsTime   = strtotime($timestamp);
//            $nowTime    = time();
//            
//            if($nowTime < $newsTime+$periodTime){ return false; }
//        }
//       
//       if(preg_match("#Googlebot#i", $_SERVER['HTTP_USER_AGENT'])){
//            header("HTTP/1.1 301 Moved Permanently"); 
//            header("Location: {$pr24Url}"); 
//            exit();
//       }
//    }
    
    private function changeOutput(){
        
        //Add lang code to IMG Path
//        $output = $this->output->get_output();
//        $output = preg_replace("#(['\"])(/upload/images/)#i", "$1/".LANG_CODE."$2", $output);
//        $this->output->set_output($output);
    }

}

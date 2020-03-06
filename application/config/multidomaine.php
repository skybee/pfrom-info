<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//logo-pressfrom-mob-1.png

define('STATIC_REMOTE_HOST', 'us.static.lalalay.com');
define('STATIC_REMOTE_ADD_URI', '/file_remote/add_file/');
define('STATIC_REMOTE_DEL_URI', '/file_remote/del_file/');

$config_var['pressfrom.com']['mail']                    = 'mail@pressfrom.info';
$config_var['pressfrom.com']['logo_img']                = 'logo-pressfrom-1.png';
$config_var['pressfrom.com']['logo_img_mobile']         = 'logo-pressfrom-mob-1.png';
$config_var['pressfrom.com']['site_name']               = 'PressFrom';
$config_var['pressfrom.com']['tpl']                     = 'pressfrom';
$config_var['pressfrom.com']['conf'] = [
    'right_top'=>8,
    'last_news'=>10,
    'cat_list_txt_lenth'=>250,
    'mainpage_cat_list'=>4
    ];


$config_var['pressreview24.com']['mail']                = 'mail@pressreview24.com';
$config_var['pressreview24.com']['logo_img']            = 'logo-pressfrom-1.png';
$config_var['pressreview24.com']['logo_img_mobile']     = 'logo-pressfrom-mob-1.png';
$config_var['pressreview24.com']['site_name']           = 'PressReview24';
$config_var['pressreview24.com']['tpl']                 = 'press24';
$config_var['pressreview24.com']['conf'] = [
    'right_top'=>9,
    'last_news'=>20,
    'cat_list_txt_lenth'=>180,
    'mainpage_cat_list'=>8
    ];

$config_var['unionpress24.lh']                          = $config_var['pressreview24.com'];

$config_var['francais-express.com']['mail']             = 'mail@francais-express.com';
$config_var['francais-express.com']['logo_img']         = 'logo-fr.jpg';
$config_var['francais-express.com']['logo_img_mobile']  = 'logo-fr-mobile.png';
$config_var['francais-express.com']['site_name']        = 'Francais Express';

$config_var['lalalay.com']['mail']                      = 'mail@lalalay.com';
$config_var['lalalay.com']['logo_img']                  = 'logo-pressfrom-1.png';
$config_var['lalalay.com']['logo_img_mobile']           = 'logo-fr-mobile.png';
$config_var['lalalay.com']['site_name']                 = 'LaLaLay';

$config_var['smiexpress.ru']['mail']                    = 'mail@smiexpress.ru';
$config_var['smiexpress.ru']['logo_img']                = 'logo-ru.jpg';
$config_var['smiexpress.ru']['logo_img_mobile']         = 'logo-ru-mobile.png';
$config_var['smiexpress.ru']['site_name']               = 'СМИ Express';

$config_var['default'] = $config_var['pressfrom.com'];


$lock_host = array(
    'telegraph.co.uk',
    'theguardian.com', 
    'independent.co.uk', 
    'standard.co.uk', 
    'mirror.co.uk', 
    'birminghammail.co.uk', 
    'liverpoolecho.co.uk',
    'manchestereveningnews.co.uk',
    '\.aol.co.uk',
    
    'homify.de',
    'modepilot.com',
    'welt.de',
    'teleschau.de',
    
    '750g.com',
    'bfmtv.fr',
    'bfmtv.com',
    'mamamia.com.au',
    'cbs.com',
    
    '\.abril.com.br',
    'motor1.com',
    'rideapart.com',
    'www.roadandtrack.com'
);

function get_country_code(){
    return LANG_CODE;
}

function get_host_conf($config_var){
    $host = $_SERVER['HTTP_HOST'];
    
    if(preg_match("#^([a-z]{2}\.|)([a-z\d\.-]+)$#i", $host, $matches)){
        if(isset($config_var[$matches[2]])){
            return $config_var[$matches[2]];
        }
    }
    
    return $config_var['default'];
}


$config_var['default'] = get_host_conf($config_var);


$config['multidomaine']['main_host'] = [
    'smiexpress.ru',
    'fr.pressfrom.com',
    'de.pressfrom.com',
    'uk.pressfrom.com',
    'us.pressfrom.com',
    'ca.pressfrom.com',
    'au.pressfrom.com',
    'br.pressfrom.com'
];

$config['multidomaine']['parse_lang'] = [
    'ru',
    'fr',
    'de',
    'uk',
    'us',
    'ca',
    'au',
    'br'
];

$config['multidomaine']['host_set'][$_SERVER['HTTP_HOST']] = get_country_code();


//===== Ru =====//
$config['multidomaine']['ru']['host_conf']          = $config_var['default'];
$config['multidomaine']['ru']['site_name_str']      = $config_var['default']['site_name'].' - Россия';
$config['multidomaine']['ru']['lang']               = 'ru';
$config['multidomaine']['ru']['country_name']       = 'Russia';
$config['multidomaine']['ru']['logo_img']           = $config_var['default']['logo_img'];
$config['multidomaine']['ru']['logo_img_mobile']    = $config_var['default']['logo_img_mobile'];
$config['multidomaine']['ru']['e_mail']             = $config_var['default']['mail'];
$config['multidomaine']['ru']['host']               = 'smiexpress.ru';
$config['multidomaine']['ru']['contact_str']        = 'Контакты';
$config['multidomaine']['ru']['top_news_str']       = 'TOP Новости';
$config['multidomaine']['ru']['last_news_str']      = 'Последние Новости';
$config['multidomaine']['ru']['like_news_str']      = 'Смотрите также';
$config['multidomaine']['ru']['like_video_str']     = 'Тематическое видео';
$config['multidomaine']['ru']['serp_news_str']      = 'Похожее в сети';
$config['multidomaine']['ru']['comments_str']       = 'Комментарии';
$config['multidomaine']['ru']['source_str']         = 'Источник';
$config['multidomaine']['ru']['repost_news_str']    = 'Поделится Новостью в Соц. Сетях';
$config['multidomaine']['ru']['page_str']           = 'Страница';
$config['multidomaine']['ru']['month_ar']           = array( 1=>'января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
$config['multidomaine']['ru']['day_ar']             = array('Воскресенье','Понедельник','Вторник','Среда','Четверг','Пятница','Суббота');
$config['multidomaine']['ru']['xml_yandex_url']     = 'https://xmlsearch.yandex.com/xmlsearch?user=mail@lalalay.com&key=03.1130000018332401:db8ac7bad789ba8f7aabca04b0aa6308&maxpassages=5&groupby=groups-on-page%3D15';
$config['multidomaine']['ru']['social_btn_list']    = 'vkontakte,facebook,twitter,odnoklassniki';
$config['multidomaine']['ru']['outwindow_str']      = 'Это интересно!';
$config['multidomaine']['ru']['lock_donor']         = $lock_host;
$config['multidomaine']['ru']['static_server']      = 'ru.static.lalalay.com';
$config['multidomaine']['ru']['del_old_art_catid']  = '2,3,6,7,8,12,20,22'; //Category IDs from which old news will be deleted; Format: 1,2,3,...
$config['multidomaine']['ru']['translate']['lang_from'] = [];
$config['multidomaine']['ru']['translate']['cat_id']    = '';

//===== Fr =====//
$config['multidomaine']['fr']['host_conf']          = $config_var['default'];
$config['multidomaine']['fr']['site_name_str']      = $config_var['default']['site_name'].' - France';
$config['multidomaine']['fr']['lang']               = 'fr';
$config['multidomaine']['fr']['country_name']       = 'France';
$config['multidomaine']['fr']['logo_img']           = $config_var['default']['logo_img'];
$config['multidomaine']['fr']['logo_img_mobile']    = $config_var['default']['logo_img_mobile'];
$config['multidomaine']['fr']['e_mail']             = $config_var['default']['mail'];
$config['multidomaine']['fr']['host']               = 'fr.pressfrom.com';
$config['multidomaine']['fr']['contact_str']        = 'Contact';
$config['multidomaine']['fr']['top_news_str']       = 'Actualités à la une';
$config['multidomaine']['fr']['last_news_str']      = 'Les Dernières Nouvelles';
$config['multidomaine']['fr']['like_news_str']      = 'Voir aussi';
$config['multidomaine']['fr']['like_video_str']     = 'Thématique de la vidéo';
$config['multidomaine']['fr']['serp_news_str']      = 'Semblable dans le réseau';
$config['multidomaine']['fr']['comments_str']       = 'Commentaires';
$config['multidomaine']['fr']['source_str']         = 'Source';
$config['multidomaine']['fr']['repost_news_str']    = 'Partager dans le Soc. Réseaux';
$config['multidomaine']['fr']['page_str']           = 'Page';
$config['multidomaine']['fr']['month_ar']           = array( 1=>'janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre');
$config['multidomaine']['fr']['day_ar']             = array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
$config['multidomaine']['fr']['xml_yandex_url']     = 'https://xmlsearch.yandex.com/xmlsearch?user=mail@lalalay.com&key=03.1130000018332401:db8ac7bad789ba8f7aabca04b0aa6308&maxpassages=5&groupby=groups-on-page%3D15';
$config['multidomaine']['fr']['social_btn_list']    = 'facebook,twitter,gplus';
$config['multidomaine']['fr']['outwindow_str']      = 'C\'est intéressant!';
$config['multidomaine']['fr']['lock_donor']         = $lock_host;
$config['multidomaine']['fr']['static_server']       = 'fr.static.lalalay.com';
$config['multidomaine']['fr']['del_old_art_catid']  = '2,3,4,7,10';
$config['multidomaine']['fr']['translate']['lang_from'] = ['us','uk','ca','au'];
$config['multidomaine']['fr']['translate']['cat_id']    = '5,6,10,11,12,16,17,18,19,20';

//===== De =====//
$config['multidomaine']['de']['host_conf']          = $config_var['default'];
$config['multidomaine']['de']['site_name_str']      = $config_var['default']['site_name'].' - Deutschland';
$config['multidomaine']['de']['lang']               = 'de';
$config['multidomaine']['de']['country_name']       = 'Deutschland';
$config['multidomaine']['de']['logo_img']           = $config_var['default']['logo_img'];
$config['multidomaine']['de']['logo_img_mobile']    = $config_var['default']['logo_img_mobile'];
$config['multidomaine']['de']['e_mail']             = $config_var['default']['mail'];
$config['multidomaine']['de']['host']               = 'de.pressfrom.com';
$config['multidomaine']['de']['contact_str']        = 'Kontakte';
$config['multidomaine']['de']['top_news_str']       = 'Popular News';
$config['multidomaine']['de']['last_news_str']      = 'Aktuelle Nachrichten';
$config['multidomaine']['de']['like_news_str']      = 'Siehe auch';
$config['multidomaine']['de']['like_video_str']     = 'Aktuelle videos';
$config['multidomaine']['de']['serp_news_str']      = 'Ähnliches im Netz';
$config['multidomaine']['de']['comments_str']       = 'Kommentare';
$config['multidomaine']['de']['source_str']         = 'Quelle';
$config['multidomaine']['de']['repost_news_str']    = 'Teilen Sie Neuigkeiten in der SOC. Netzwerke';
$config['multidomaine']['de']['page_str']           = 'Seite';
$config['multidomaine']['de']['month_ar']           = array( 1=>'januar','februar','märz','april','mai','juni','juli','august','september','oktober','november','dezember');
$config['multidomaine']['de']['day_ar']             = array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
$config['multidomaine']['de']['xml_yandex_url']     = 'https://xmlsearch.yandex.com/xmlsearch?user=mail@lalalay.com&key=03.1130000018332401:db8ac7bad789ba8f7aabca04b0aa6308&maxpassages=5&groupby=groups-on-page%3D15';
$config['multidomaine']['de']['social_btn_list']    = 'facebook,twitter,gplus';
$config['multidomaine']['de']['outwindow_str']      = 'Das ist interessant!';
$config['multidomaine']['de']['lock_donor']         = $lock_host;
$config['multidomaine']['de']['static_server']      = 'de.static.lalalay.com';
$config['multidomaine']['de']['del_old_art_catid']  = '3,4,7,8,9';
$config['multidomaine']['de']['translate']['lang_from'] = ['us','uk','ca','au'];
$config['multidomaine']['de']['translate']['cat_id']    = '5,6,9,10,11,12,13,14,15,16,17,18';


//===== Gb =====//
$config['multidomaine']['uk']['host_conf']          = $config_var['default'];
$config['multidomaine']['uk']['site_name_str']      = $config_var['default']['site_name'].' - United Kingdom';
$config['multidomaine']['uk']['lang']               = 'en';
$config['multidomaine']['uk']['country_name']       = 'United Kingdom';
$config['multidomaine']['uk']['logo_img']           = $config_var['default']['logo_img'];
$config['multidomaine']['uk']['logo_img_mobile']    = $config_var['default']['logo_img_mobile'];
$config['multidomaine']['uk']['e_mail']             = $config_var['default']['mail'];
$config['multidomaine']['uk']['host']               = 'uk.pressfrom.com';
$config['multidomaine']['uk']['contact_str']        = 'Contacts';
$config['multidomaine']['uk']['top_news_str']       = 'TOP News';
$config['multidomaine']['uk']['last_news_str']      = 'Latest News';
$config['multidomaine']['uk']['like_news_str']      = 'See also';
$config['multidomaine']['uk']['like_video_str']     = 'Topical videos';
$config['multidomaine']['uk']['serp_news_str']      = 'Similar from the Web';
$config['multidomaine']['uk']['comments_str']       = 'Comments';
$config['multidomaine']['uk']['source_str']         = 'Source';
$config['multidomaine']['uk']['repost_news_str']    = 'Share news in the SOC. Networks';
$config['multidomaine']['uk']['page_str']           = 'Page';
$config['multidomaine']['uk']['month_ar']           = array( 1=>'january','february','march','april','may','june','july','august','september','october','november','december');
$config['multidomaine']['uk']['day_ar']             = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$config['multidomaine']['uk']['xml_yandex_url']     = 'https://xmlsearch.yandex.com/xmlsearch?user=mail@lalalay.com&key=03.1130000018332401:db8ac7bad789ba8f7aabca04b0aa6308&maxpassages=5&groupby=groups-on-page%3D15';
$config['multidomaine']['uk']['social_btn_list']    = 'facebook,twitter,gplus';
$config['multidomaine']['uk']['outwindow_str']      = 'This is interesting!';
$config['multidomaine']['uk']['lock_donor']         = $lock_host;
$config['multidomaine']['uk']['static_server']      = 'uk.static.lalalay.com';
$config['multidomaine']['uk']['del_old_art_catid']  = '3,5,6,7,9,10,11,12';
$config['multidomaine']['uk']['translate']['lang_from'] = [];
$config['multidomaine']['uk']['translate']['cat_id']    = '';


//===== US =====//
$config['multidomaine']['us'] = $config['multidomaine']['uk'];
$config['multidomaine']['us']['country_name']       = 'United States';
$config['multidomaine']['us']['site_name_str']      = $config_var['default']['site_name'].' - US';
$config['multidomaine']['us']['e_mail']             = $config_var['default']['mail'];
$config['multidomaine']['us']['host']               = 'us.pressfrom.com';
$config['multidomaine']['us']['logo_img']           = $config_var['default']['logo_img'];
$config['multidomaine']['us']['logo_img_mobile']    = $config_var['default']['logo_img_mobile'];
$config['multidomaine']['us']['lock_donor']         = $lock_host;
$config['multidomaine']['us']['static_server']       = 'us.static.lalalay.com';
$config['multidomaine']['us']['del_old_art_catid']  = '3,4,5,9,17,18';
$config['multidomaine']['us']['translate']['lang_from'] = ['de','fr'];
$config['multidomaine']['us']['translate']['cat_id']    = '8,10,13,14,17';


//===== CA =====//
$config['multidomaine']['ca'] = $config['multidomaine']['us'];
$config['multidomaine']['ca']['country_name']       = 'Canada';
$config['multidomaine']['ca']['site_name_str']      = $config_var['default']['site_name'].' - Canada';
$config['multidomaine']['ca']['host']               = 'ca.pressfrom.com';
$config['multidomaine']['ca']['lock_donor']         = $lock_host;
$config['multidomaine']['ca']['static_server']      = 'ca.static.lalalay.com';
$config['multidomaine']['ca']['del_old_art_catid']  = '4,7,8,11';
$config['multidomaine']['ca']['translate']['lang_from'] = [];
$config['multidomaine']['ca']['translate']['cat_id']    = '';


//===== AU =====//
$config['multidomaine']['au'] = $config['multidomaine']['us'];
$config['multidomaine']['au']['country_name']       = 'Australia';
$config['multidomaine']['au']['site_name_str']      = $config_var['default']['site_name'].' - Australia';
$config['multidomaine']['au']['host']               = 'au.pressfrom.com';
$config['multidomaine']['au']['lock_donor']         = $lock_host;
$config['multidomaine']['au']['static_server']      = 'au.static.lalalay.com';
$config['multidomaine']['au']['del_old_art_catid']  = '3,4,7,8,9';
$config['multidomaine']['au']['translate']['lang_from'] = [];
$config['multidomaine']['au']['translate']['cat_id']    = '';


//===== ID =====//
$config['multidomaine']['br'] = $config['multidomaine']['us'];
$config['multidomaine']['br']['site_name_str']      = $config_var['default']['site_name'].' - Brasil';
$config['multidomaine']['br']['lang']               = 'pt';
$config['multidomaine']['br']['country_name']       = 'Brasil';
$config['multidomaine']['br']['logo_img']           = $config_var['default']['logo_img'];
$config['multidomaine']['br']['logo_img_mobile']    = $config_var['default']['logo_img_mobile'];
$config['multidomaine']['br']['e_mail']             = $config_var['default']['mail'];
$config['multidomaine']['br']['host']               = 'br.pressfrom.com';
$config['multidomaine']['br']['contact_str']        = 'Contatos';
$config['multidomaine']['br']['top_news_str']       = 'TOP notícias';
$config['multidomaine']['br']['last_news_str']      = 'Últimas notícias';
$config['multidomaine']['br']['like_news_str']      = 'Ver também';
$config['multidomaine']['br']['like_video_str']     = 'Vídeos temáticos';
$config['multidomaine']['br']['serp_news_str']      = 'Semelhante a partir da Web';
$config['multidomaine']['br']['comments_str']       = 'Comentários';
$config['multidomaine']['br']['source_str']         = 'Fonte';
$config['multidomaine']['br']['repost_news_str']    = 'Compartilhe notícias nas redes sociais';
$config['multidomaine']['br']['page_str']           = 'Página';
$config['multidomaine']['br']['month_ar']           = array( 1=>'janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro');
$config['multidomaine']['br']['day_ar']             = array('Domingo','Segunda','Terça-feira','Quarta-feira','Quinta','Sexta-feira','Sábado');
$config['multidomaine']['br']['xml_yandex_url']     = 'https://xmlsearch.yandex.com/xmlsearch?user=mail@lalalay.com&key=03.1130000018332401:db8ac7bad789ba8f7aabca04b0aa6308&maxpassages=5&groupby=groups-on-page%3D15';
$config['multidomaine']['br']['social_btn_list']    = 'facebook,twitter,gplus';
$config['multidomaine']['br']['outwindow_str']      = 'Isto é interessante!';
$config['multidomaine']['br']['lock_donor']         = $lock_host;
$config['multidomaine']['br']['static_server']      = 'br.static.lalalay.com';
$config['multidomaine']['br']['del_old_art_catid']  = 'all';
$config['multidomaine']['br']['translate']['lang_from'] = [];
$config['multidomaine']['br']['translate']['cat_id']    = '';
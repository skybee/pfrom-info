<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Del_html_from_news extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('parser/simple_html_dom_helper');
    }
    
    function index(){
        echo "del_html";
    }

    function del($cnt = 1) {
//        $sql = "SELECT * FROM `article` WHERE `text` LIKE '%videojsplayer%' LIMIT {$cnt}";
        $sql = "SELECT * FROM `article` WHERE MATCH (`title`,`text`) AGAINST ('videojsplayer') LIMIT {$cnt}";

//        $sql = "SELECT * FROM `article` WHERE `id`='520671' ";

        $query = $this->db->query($sql);

        foreach ($query->result_array() as $newsRow) {
            echo "In Work ID: {$newsRow['id']} <br />\n";

            
            $newHtmlTxt = $this->DOM_CleanVideoJS($newsRow['text']);
            
            $updSql = "UPDATE `article` SET `text`=? WHERE `id`=? LIMIT 1 ";
            $this->db->query($updSql,array($newHtmlTxt,$newsRow['id']));
            
            echo "\n\n<br /><br />-----------------------------------<br /><br />\n\n";
        }
    }

    private function DOM_CleanVideoJS($html) {
        $htmlObj = new simple_html_dom();
        $htmlObj->load($html);
        if (!is_object($htmlObj))
            return false;

        if (!is_object($htmlObj->find('.videojsplayer', 0))) {
            return $html; #false;
        }

        foreach ($htmlObj->find('.videojsplayer') as $videoObj) { //обход плееров
            $this->delImgFilesFromObj($videoObj); //удаление изображений

            if (!is_object($videoObj->find('video', 0))) {
                continue;
            }

            $videoTagObj = $videoObj->find('video', 0);
            $divInfoObj = $videoObj->find('.video-js', 0);
            $sourceObj = $videoTagObj->find('source', 0);

//            $metaData   = $videoTagObj->attr['data-pluginconfig'];
//            $metaData   = html_entity_decode($metaData);
//            $metaDataAr = json_decode($metaData,true);

            $metaDataAr['videoUrl'] = $sourceObj->attr['src'];
            $metaDataAr['posterUrl'] = $divInfoObj->attr['poster'];

//            echo "\n\n---------------\n\n";
//            print_r($metaDataAr);
//            echo "\n\n---------------\n\n";

            $htmlVideo = '<video width="100%" height="auto"  poster="' . $metaDataAr['posterUrl'] . '" controls > '
                    . '<source src="' . $metaDataAr['videoUrl'] . '" > '
                    . 'Your browser does not support this video'
                    . '</video>';

            $videoObj->outertext = $htmlVideo;
        }

        $newHtml = $htmlObj->save();

        $htmlObj->clear();
        unset($htmlObj);

        return $newHtml;
    }

    private function delImgFilesFromObj($htmlObj) {
        if (!is_object($htmlObj->find('img', 0))) {
            return false;
        }

        foreach ($htmlObj->find('img') as $imgObj) {
            $imgSrc = $imgObj->attr['src'];

            if (preg_match("#upload/images#i", $imgSrc) !== false) {
                echo $this->del_img('.'.$imgSrc);
            }
        }
    }

    private function del_img($fName) {

//        return $this->remote_serv_transfer_lib->del_remote_file($fName);

        $fName = preg_replace("#^([a-z]+.+)#", "./$1", $fName);

        $msg = '';
        if (is_file($fName)) {
            if (unlink($fName)) {
                $msg .= 'OK: Файл удален - ' . $fName . "<br />\n";
            } else {
                $msg .= 'ERROR: Ошибка удаления файла - ' . $fName . "<br />\n";
            }
        } else {
            $msg .= 'NOTE: Файл не найден - ' . $fName . "<br />\n";
        }

        return $msg;
    }

}

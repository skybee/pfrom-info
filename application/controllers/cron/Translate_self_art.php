<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

header('Content-Type: text/plain; charset=utf-8');

define('STICHOZA_USE_PROXY', TRUE); // включить/выключить Proxys


class Translate_self_art extends CI_Controller{
    private $helper, $minLikeRank=6;
    
    function __construct() {
        parent::__construct();
        $this->benchmark->mark('all_start');
    }
    
    function __destruct() {
        $this->benchmark->mark('all_end');
        echo "\n\n\t -- All time: ".$this->benchmark->elapsed_time('all_start','all_end')."\n\n";
        echo "\n\n\n\n \t ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ \n\n\n\n";
    }
    
    function stichoza_translate_do($cnt=1,$donorDbLangCode=LANG_CODE){
$this->benchmark->mark('first_point_start');
        
        $this->load->library('translate/Stichoza_translate_lib');
        $this->load->library('translate/Stichoza_translate_self_lib',
                                [   
                                    $this->stichoza_translate_lib, //перенос внутрь библиотеки ?
                                    $donorDbLangCode
                                ], 
                                'translate_self_lib'
                            );
        $this->helper = new stichoza_translate_helper();
        
        $cnt = (int) $cnt; if($cnt<1){$cnt=1;}
        
        //получение массива языков в которых будет выполнятся поиск и перевод
        $langsFromAr        = $this->translate_self_lib->donorObj->getLangFrom();
        //получение объединенных языков/langCod-ов для перевода 
        $langToTranslateAr  = $this->translate_self_lib->mergeLangCodeToLangName($langsFromAr);
        
        $donorLangConf   = $this->stichoza_translate_lib->getLangConf($donorDbLangCode);
        
$this->benchmark->mark('first_point_end');
echo "\n\n\t -- First Point: ".$this->benchmark->elapsed_time('first_point_start', 'first_point_end')."\n\n";
        
        # SET pay_article = 8 WHERE text > 8000
        $this->translate_self_lib->CI->Article_translate_self_m->setNotMarkOnLongArts();

        for($i=0;$i<$cnt;$i++):
            #обход языков перевода
            foreach($langToTranslateAr as $langTo => $langCodeToAr){
$this->benchmark->mark('second_point_start');                
                $cleanArt       = $this->stichoza_translate_lib->cleanArtToTranslate();
                $translate      = $this->stichoza_translate_lib->stTranslating();
                $writeResult    = $this->translate_self_lib->writeResultToDB();
                $writeResult->dbConnect($donorDbLangCode); //костылька
            
                $langCodeTo     = $langCodeToAr[mt_rand(0,count($langCodeToAr)-1)];
$this->benchmark->mark('second_point_end');
echo "\n\n\t -- Second Point: ".$this->benchmark->elapsed_time('second_point_start', 'second_point_end')."\n\n";
                
                echo "\n\n LangTo: ".$langTo." - ".$langCodeTo."\n\n";

$this->benchmark->mark('getArticles_start');
                #получение статей для перевода
                $donorArts   = $this->translate_self_lib->getArticles(1,$langTo);
$this->benchmark->mark('getArticles_end');
echo "\n\n\t -- getArticles Point: ".$this->benchmark->elapsed_time('getArticles_start', 'getArticles_end')."\n\n";

                #обход выбранных статей  #foreach ($donorArts as $donorArt){ 
                $donorArt      = $donorArts[0]; 
                
                echo $donorArt['title']."\n\n";
                $this->translate_self_lib->donorObj->dbClose();
                
//                print_r($donorArts); 
//                exit();
                
                
                //---- do translate here: -----//
                
                # подготовка текста к переводу и перевод
//                $cleanArt       = $this->stichoza_translate_lib->cleanArtToTranslate();
//                $translate      = $this->stichoza_translate_lib->stTranslating();
//                $writeResult    = $this->translate_self_lib->writeResultToDB();
$this->benchmark->mark('setText_start');                
                $cleanArt->setText( $donorArt['text'] );
                $cleanArt->addTitleToTxt( $donorArt['title'] );
//            echo "\n\n---------\nOrigin: \n\n".$cleanArt->getText()."\n------------------\n\n";
                $cleanArt->tagToMarker();
                $marksTxt = $cleanArt->getText();
$this->benchmark->mark('setText_end');
echo "\n\n\t -- setText Point: ".$this->benchmark->elapsed_time('setText_start', 'setText_end')."\n\n";

$this->benchmark->mark('getTranslate_start');
                $marksTxtTranslated = $translate->getTranslate(
                        $marksTxt,
                        $donorLangConf['lang'],
                        $langTo,
                        STICHOZA_USE_PROXY); //text,langIn,langOut,useProxy
$this->benchmark->mark('getTranslate_end');
echo "\n\n\t -- getTranslate Point: ".$this->benchmark->elapsed_time('getTranslate_start', 'getTranslate_end')."\n\n";

$this->benchmark->mark('markerToTag_start');
                $cleanArt->setText($marksTxtTranslated);
                $cleanArt->markerToTag();
                $titleTranslated    = $cleanArt->getTitleFromTxt();
                $txtTranslated      = $cleanArt->getText(); 
//            echo "\n----\n txtTranslated: \t {$titleTranslated} \n----\n".$txtTranslated;
$this->benchmark->mark('markerToTag_end'); 
echo "\n\n\t -- markerToTag Point: ".$this->benchmark->elapsed_time('markerToTag_start', 'markerToTag_end')."\n\n";

$this->benchmark->mark('writeResult_start');
                # Write To DB /
                $writeResult->setAcceptorLangCode($langCodeTo);
                $writeResult->setDonorLangCode($donorDbLangCode);
$this->benchmark->mark('writeResult_end'); 
echo "\n\n\t -- writeResult Point: ".$this->benchmark->elapsed_time('writeResult_start', 'writeResult_end')."\n\n";                
                
                # отметка, что новость была взята на перевод
                $writeResult->setTranslatedArticle($donorArt['id'], $langTo);
                # запись переведенной новости 
                if( $insertID = $writeResult->insertTranslatedArt($titleTranslated,$txtTranslated,$donorArt) ){
                    echo "\n\n ADD News: {$langCodeTo} / ID: {$insertID} \n\n";
                }
                else{
                    echo "\n\n ERROR: News did not ADD \n\n";
                }
                
                $writeResult->dbClose();
                unset($writeResult);
//                sleep(2);
            }
        endfor;
        
        
        
        
        
        
        
        
//        echo "\n\n----\n\n";
//        print_r($langsFromAr);
//        echo "\n\n----\n\n";
//        print_r($donorLangConf);
//        echo "Ok";
    }
}
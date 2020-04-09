<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

header('Content-Type: text/plain; charset=utf-8');

define('STICHOZA_USE_PROXY', TRUE); // включить/выключить Proxys


class Translate_self_art extends CI_Controller{
    private $helper, $minLikeRank=6;
    
    function __construct() {
        parent::__construct();
    }
    
    function stichoza_translate_do($cnt=1,$donorDbLangCode=LANG_CODE){
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
        
        
        
        for($i=0;$i<$cnt;$i++):
            #обход языков перевода
            foreach($langToTranslateAr as $langTo => $langCodeToAr){
            
                $cleanArt       = $this->stichoza_translate_lib->cleanArtToTranslate();
                $translate      = $this->stichoza_translate_lib->stTranslating();
                $writeResult    = $this->translate_self_lib->writeResultToDB();
                $writeResult->dbConnect($donorDbLangCode); //костылька
            
                $langCodeTo     = $langCodeToAr[mt_rand(0,count($langCodeToAr)-1)];
                
                echo "\n\n LangTo: ".$langTo." - ".$langCodeTo."\n\n";

                #получение статей для перевода
                $donorArts   = $this->translate_self_lib->getArticles(1,$langTo);
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
                
                $cleanArt->setText( $donorArt['text'] );
                $cleanArt->addTitleToTxt( $donorArt['title'] );
//            echo "\n\n---------\nOrigin: \n\n".$cleanArt->getText()."\n------------------\n\n";
                $cleanArt->tagToMarker();
                $marksTxt = $cleanArt->getText();
                $marksTxtTranslated = $translate->getTranslate(
                        $marksTxt,
                        $donorLangConf['lang'],
                        $langTo,
                        STICHOZA_USE_PROXY); //text,langIn,langOut,useProxy
                $cleanArt->setText($marksTxtTranslated);
                $cleanArt->markerToTag();
                $titleTranslated    = $cleanArt->getTitleFromTxt();
                $txtTranslated      = $cleanArt->getText(); 
//            echo "\n----\n txtTranslated: \t {$titleTranslated} \n----\n".$txtTranslated;
                
                # Write To DB /
                $writeResult->setAcceptorLangCode($langCodeTo);
                $writeResult->setDonorLangCode($donorDbLangCode);
                
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
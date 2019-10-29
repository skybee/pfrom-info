<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

header('Content-Type: text/plain; charset=utf-8');

define('STICHOZA_USE_PROXY', TRUE); // включить/выключить Proxys


class Translate extends CI_Controller{
    private $helper, $minLikeRank=6;
    
    function __construct() {
        parent::__construct();
    }
    
    function stichoza_translate_do($cnt=1,$acceptorDbLangCode=LANG_CODE){
        $this->load->library('translate/Stichoza_translate_lib');
        $this->helper = new stichoza_translate_helper();
        
        $cnt = (int)$cnt;
        if($cnt<1){$cnt=1;}
        
        $acceptorObj    = $this->stichoza_translate_lib->getAcceptorArticles($acceptorDbLangCode); //return Object of getAcceptorArticles;   
        
        if($acceptorObj->hasTranslateConf() !== TRUE){
            echo "\n\n-- NOTE: -- No Translate Configuration for Lang: ".LANG_CODE." --\n\n";
            return TRUE;
        }
        
        $acceptorArts   = $acceptorObj->getArticles($cnt); //получение статей для перевода [id],[title]
        $langFrom       = $acceptorObj->getLangFrom(); //получение массива языков в которых будет выполнятся поиск и перевод
        
        $acceptorLangConf = $this->stichoza_translate_lib->getLangConf($acceptorDbLangCode);
        
        $acceptorObj->dbClose();
        unset($acceptorObj);
        
        foreach($acceptorArts as $acceptArt){ //обход выбранных статей
            $acceptSearchTitle  = $this->helper->clearTitleForSearch($acceptArt['title']);
            $sortLikeArts       = $this->stichoza_translate_lib->articlesRankSort();
            $cleanArt           = $this->stichoza_translate_lib->cleanArtToTranslate();
            $translate          = $this->stichoza_translate_lib->stTranslating();
            $writeResult        = $this->stichoza_translate_lib->writeResultToDB();
            
            #обход языков(БД) доноров
            foreach($langFrom as $LFrom){ 
                $searchLikeArts = $this->stichoza_translate_lib->searchLikeArts();
                $searchLikeArts->setCountryCode($LFrom);
                $searchLikeArts->setTitle($acceptSearchTitle);
                $searchLikeArts->setTitleLang($acceptorLangConf['lang']);
                $searchLikeArts->setDbLangConf($this->stichoza_translate_lib->getLangConf($LFrom));
                $likeArts = $searchLikeArts->getLikeArts(2);
                $sortLikeArts->addArts($likeArts); //добавления статей из разных баз в массив для сортировки
                unset($searchLikeArts);
            }
            
            #получение сортированного массива по наибольшей схожести с искомой статьей
            $unitedLikeArts = $sortLikeArts->getSortedArray();
            unset($sortLikeArts);
            
            print_r($unitedLikeArts);
            
            $hostsAr = ['pressfrom.info','pressreview24.com']; //отдельный перевод для каждого хоста
            
            foreach($hostsAr as $key=>$host){
                $relevantArtData = $unitedLikeArts[$key];
                
                
                echo "\n\n-----------\n\nRank[{$key}] = ".$relevantArtData['rank']."\n";
                if($relevantArtData['rank'] > $this->minLikeRank){
                    echo "Will be translated\n";
                }
                else{
                    echo "Will Not be translated\n";
                    $writeResult->setAcceptorLangCode($acceptorDbLangCode);
                    $writeResult->insertTranslatedArt($acceptArt['id'],'','',$host);
                    $writeResult->dbClose();
                    continue;
                }
                
            
                #подготовка текста к переводу и перевод
                $cleanArt->setText($relevantArtData['text']);
                $cleanArt->addTitleToTxt($relevantArtData['title']);
            echo "\n\n---------\nOrigin: \n\n".$cleanArt->getText()."\n------------------\n\n";
                $cleanArt->tagToMarker();
                $marksTxt = $cleanArt->getText();
                $marksTxtTranslated = $translate->getTranslate(
                        $marksTxt,
                        $relevantArtData['lang'],
                        $acceptorLangConf['lang'],
                        STICHOZA_USE_PROXY); //text,langIn,langOut,useProxy
                $cleanArt->setText($marksTxtTranslated);
                $cleanArt->markerToTag();
                $titleTranslated    = $cleanArt->getTitleFromTxt();
                $txtTranslated      = $cleanArt->getText(); 
            echo "\n----\n txtTranslated: \n----\n".$txtTranslated;

                #Write To DB /
                $writeResult->setAcceptorLangCode($acceptorDbLangCode);
                $writeResult->setDonorLangCode($relevantArtData['country_code']);
                $writeResult->setTranslatedArticle($relevantArtData['id'], $acceptorLangConf['lang']);
                $writeResult->insertTranslatedArt($acceptArt['id'],$titleTranslated,$txtTranslated,$host);
                $writeResult->dbClose();
                
                sleep(5);
            }
        }
    }
}

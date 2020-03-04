<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once('./application/libraries/DiDOM/src/DiDom/ClassAttribute.php');
require_once('./application/libraries/DiDOM/src/DiDom/Document.php');
require_once('./application/libraries/DiDOM/src/DiDom/Element.php');
require_once('./application/libraries/DiDOM/src/DiDom/Encoder.php');
require_once('./application/libraries/DiDOM/src/DiDom/Errors.php');
require_once('./application/libraries/DiDOM/src/DiDom/Query.php');
require_once('./application/libraries/DiDOM/src/DiDom/StyleAttribute.php');
require_once('./application/libraries/DiDOM/src/DiDom/Exceptions/InvalidSelectorException.php');
use DiDom\ClassAttribute;
use DiDom\Document;
use DiDom\Element;
use DiDom\Encoder;
use DiDom\Errors;
use DiDom\Query;
use DiDom\StyleAttribute;
use DiDom\Exceptions\InvalidSelectorException;


class merger_css_js extends CI_Controller{
    
    private $mergerCSS,$mergerJS,$mainHost,$mainScheme,$urlList;
    
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        
        header("Content-Type:text/plain; charset=utf-8");
        
        # example: http://express-info.lh/tmp/merger_css_js/?fileType=css&url=http://express-info.lh
        
        $url        = $_GET['url'];
        $fileType   = $_GET['fileType'];
        
        if(empty($url) || empty($fileType)){ exit("\n empty url var. url={$url} | fileType={$fileType}  \n"); }
        
        $this->getMainHost($url);
        
        $html = file_get_contents($url);
        
        $htmlObj =  new Document();
        $htmlObj->loadHtml($html);
        if( !is_object($htmlObj) ){ 
            echo "htmlObj is false";
            return false;
        }
        
        // find CSS files
        if($htmlObj->has('link[rel=stylesheet]') && $fileType=='css'){
            foreach($htmlObj->find('link[rel=stylesheet]') as $key => $linkObj){
                $CSSfileUri = $linkObj->href;
                $this->getNewFileContent($CSSfileUri, 'css');
            }
        }
        
        // find JS files
        if($htmlObj->has('script[src]') && $fileType=='js'){
            foreach($htmlObj->find('script[src]') as $key => $scriptObj){
                $JSfileUri = $scriptObj->src;
                if(preg_match("#google#i", $JSfileUri)){continue; }
                if(preg_match("#cloudflare#i", $JSfileUri)){ continue; }
                $this->getNewFileContent($JSfileUri, 'js');
            }
        }
        
//        echo $this->mergerCSS;
        
        $this->saveMergerFile($fileType);
    }
    
    private function getNewFileContent($url,$fileType){
        if(preg_match("#^/[^/]#i", $url)){
            $url = $this->mainScheme.'://'.$this->mainHost.$url;
        }
        if(preg_match("#^//[^/]#i", $url)){
            $url = 'http:'.$url;
        }
        
        $this->urlList .= "\n - {$url}\n";
        
        if($fileType == 'css'){
            $fileContent = file_get_contents($url);
            $fileContent = preg_replace("#(@charset[\s\S]+?;)#i", "/*$1*/", $fileContent);
            $this->mergerCSS .= "\n\n /* FILE START: {$url} */ \n";
            $this->mergerCSS .= $fileContent;
            $this->mergerCSS .= "\n /* FILE END: {$url} */ \n\n";
        }
        elseif($fileType == 'js'){
            $fileContent = file_get_contents($url);
//            $fileContent = preg_replace("#(@charset[\s\S]+?;)#i", "/*$1*/", $fileContent);
            $this->mergerJS .= "\n\n /* FILE START: {$url} */ \n";
            $this->mergerJS .= $fileContent;
            $this->mergerJS .= "\n /* FILE END: {$url} */ \n\n";
        }
    }
    
    private function getMainHost($mainURL){
        $urlData = parse_url($mainURL);
        $this->mainHost     = $urlData['host'];
        $this->mainScheme   = $urlData['scheme'];
    }
    
    private function saveMergerFile($fileType){
         $cssFName  = './css/all-style.css';
         $jsFName   = './js/all-script.js';
         if($fileType == 'css'){
             $CssContent = "/*\n{$this->urlList}\n*/".$this->mergerCSS;
             if(file_put_contents($cssFName, $CssContent)){ echo "\n CSS File Updated \n {$this->urlList}";}
         }
        elseif($fileType == 'js') {
            $JsContent = "/*\n{$this->urlList}\n*/".$this->mergerJS;
            if(file_put_contents($jsFName, $JsContent)){ echo "\n JS File Updated \n {$this->urlList}";}
        }
    }
}
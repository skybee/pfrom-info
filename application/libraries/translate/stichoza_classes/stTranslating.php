<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class stTranslating{
    
    private $text,$langIn,$langOut;
    
    function getTranslate($text,$langIn,$langOut,$useProxy=true){
        $this->text     = $text;
        $this->langIn   = $langIn;
        $this->langOut  = $langOut;
        
        echo "/n/n/n getTranslate Method: \n\n";
        echo $this->langIn." > ".$this->langOut."\n\n";
        echo $this->text."\n\n---------\n\n";
        
        $translatedTxt = $this->translate($useProxy);
        echo $translatedTxt."\n\n---------\n\n";
        
        return $translatedTxt;
    }
    
    private function translate($useProxy=true,$cntUse=0){
        
        $tr = new GoogleTranslate();
        $proxy = false;
        if($useProxy===true){
            $proxy = Stichoza_translate_lib::getRndProxy();
            $tr->setOptions(['proxy' => "http://{$proxy}"]);
        }
        $tr->setSource($this->langIn);
        $tr->setTarget($this->langOut);
        try{
            $translatedTitle = $tr->translate($this->text);
        } 
        catch (Exception $e){
            if($cntUse<3){
                $msg = 'Proxy: '.$proxy.' - '.$e->getMessage();
                $this->translateErrorLog($msg);
                $translatedTitle = $this->translate($useProxy,$cntUse+1);
            }
            else{
                $translatedTitle = false;
            }
        }
        
        return $translatedTitle;
    }
    
    private function translateErrorLog($msg){
        $logFileName = './translate_error.log';
        
        $msg = date("Y-m-d H:i:s")." - ".$msg."\n";
        
        file_put_contents($logFileName, $msg, FILE_APPEND | LOCK_EX);
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Parse_schema_author extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('Parse_schema_m', 'schema_m');
        $this->load->library('parser/Schema_parse_lib', NULL, 'schmPrsLib');
    }
    
    
    function parse($cnt=10){
        header('Content-Type: text/plain; charset=utf-8');
        
        $cnt    = (int)$cnt;
        $arts   = $this->schema_m->getEmptyAuthorArt($cnt);
//        
//      SchemaTag    https://ftw.usatoday.com/2020/02/76ers-joel-embiid-shaq-soft/
//        /*test Url*/ $arts[]['canonical'] = 'https://www.nytimes.com/2020/02/07/opinion/senate-impeachment-acquittal.html?partner=msn';

        
        foreach ($arts as $key => $artData){
            echo "\n\n-------------------------- {$key} --------------------------\n\n";
            
            $artURL = $artData['canonical'];
            $this->schmPrsLib->setUrl($artURL);
            $data = $this->schmPrsLib->getSchemaData();
            
            print_r($artData);
            echo "\n----\n";
            print_r($data);
            
            if(is_array($data)==false){ 
                $this->schema_m->updArticleAuthorID($artData['id'],1);
                continue;
            }
            
            $jsonData = json_encode($data);
            $authorID = $this->schema_m->insertAuthorData($jsonData,$artData['id']);            
            $this->schema_m->updArticleAuthorID($artData['id'],$authorID);
            
            echo "\n--OK: ArtID:{$artData['id']} / AuthID:{$authorID} --\n"; 
            
//            echo "\n Lenth: ".mb_strlen($jsonData)."\n";
            echo "\n Json: {$jsonData} \n";
            
            flush();
        }
    }
    
    function get_my_author_data(){
        header('Content-Type: text/plain; charset=utf-8');
        
        $data['publisher']  = [
            '@type'=>'Organization', 
            'name'=>'PressFrom', 
            'url'=>'https://pressfrom.info',
            'logo'=>['@type'=>'ImageObject','url'=>'https://pressfrom.info/img/logo-pressfrom-1-fff.png']
            ];
        $data['author']     = $data['publisher'];
        $jsonData = json_encode($data);
        
        print_r($data);
        echo "\n\n Json: \n\n".$jsonData."\n\n";
        
    }
    
    
}


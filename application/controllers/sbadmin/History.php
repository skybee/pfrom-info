<?php defined('BASEPATH') OR exit('No direct script access allowed');

// URL: /ru/sbadmin/history/show_graph/3/

class History extends CI_Controller{
    
    
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('sbadmin/history_m');
    }
    
//    function index(){ echo "index"; }
    
    function show_graph($month=3)
    {
        $month = (int) $month;
        
        $dateDataAr     = $this->history_m->getPeriodHistory($month);
        $categoryData   = $this->history_m->getCategoryHistory($month);
        $categoryData   = $this->addVarNamesForJS($categoryData);
                
        $viewData['dateDataAr']     = $dateDataAr;
        $viewData['categoryData']   = $categoryData;
        
//        print_r($viewData['categoryData']);
        
        $viewData['mainMenu']       = $this->load->view('sbadmin/component/right_main_menu_v','',true);
        $viewData['mainMenu']      .= $this->load->view('sbadmin/component/history_menu_v','',true);
        $viewData['rightContent']   = $this->load->view('sbadmin/page/history_v',$viewData,true);
        
        $this->load->view('sbadmin/index_v',$viewData);
    }
    
    function addVarNamesForJS($catDataAr){ // добавление имен используемых в jsграфиков
        
        foreach ($catDataAr as $key => $catData){
            $functionName = str_ireplace('-','',$catData['url_name']);
            
            $catDataAr[$key]['funcName'] = $functionName;
        }
        
        return $catDataAr;
    }
}
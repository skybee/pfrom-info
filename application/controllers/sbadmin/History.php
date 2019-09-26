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
        
        $dataDateAr = $this->history_m->getPeriodHistory($month);
        $viewData['dateDataAr'] = $dataDateAr;
//        print_r($dataDateAr);
        $this->load->view('sbadmin/index_v',$viewData);
    }
}
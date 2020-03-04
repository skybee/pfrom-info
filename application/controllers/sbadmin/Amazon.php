<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Amazon extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('sbadmin/Partner_m');
        $this->load->library('partner/Partner_lib');
        
        if(ENVIRONMENT != 'development'){ exit("Development Error"); }
    }
    
    function index(){echo "index";}
    
    function arts_list($order='views'){
        $viewData['mainMenu']       = $this->load->view('sbadmin/component/right_main_menu_v','',true);
        $viewData['mainMenu']      .= $this->load->view('sbadmin/component/partner_menu_v','',true);
        $linkList['links_list']     = $this->Partner_m->getPartnerArtsList($order,200);
        $viewData['rightContent']   = $this->load->view('sbadmin/page/partner_linklist_v',$linkList,true);
        $this->load->view('sbadmin/index_v',$viewData);
    }
    
    function change_art($artID){
        $artID = (int)$artID;
        
        $artData['artData']             = $this->Partner_m->getArtData($artID);
        $artData['artData']['links']    = $this->partner_lib->findLinks($artData['artData']['text']);
//        print_r($tmp);
        
        $viewData['mainMenu']       = $this->load->view('sbadmin/component/right_main_menu_v','',true);
        $viewData['rightContent']   = $this->load->view('sbadmin/page/article_edit_v',$artData,true);
        $this->load->view('sbadmin/index_v',$viewData);
    }
    
    function edit_art_action(){
        $artData['id']      = $this->input->post('id');
        $artData['title']   = $this->input->post('title'); 
        $artData['text']    = htmlspecialchars_decode($this->input->post('text'));
        
        $linksData['class'] = $this->input->post('class');
        $linksData['src']   = $this->input->post('src');
        $linksData['anchor']= $this->input->post('anchor');
        
        $artData['text']    = $this->partner_lib->changeLinkInTxt($artData['text'],$linksData);
        if($artData['text']===false){
            echo "Links Count Error";
            return FALSE;
        }
        
//        print_r($artData);
        
        if($this->Partner_m->updArt($artData)){ //UPD Ok
            echo "UPD Ok | ID: ".$artData['id'];
        }
        else{ //UPD Error
            echo "UPD Error | ID: ".$artData['id'];
        }
    }
}
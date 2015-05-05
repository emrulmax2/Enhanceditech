<?php
  
class Communication_student extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
      $this->load->model('student_data','', TRUE);     
      $this->load->model('agent','', TRUE);     
      $this->load->model('course_relation','', TRUE);     
      $this->load->model('course','', TRUE);     
      $this->load->model('semister','', TRUE);     
      $this->load->model('awarding_body','', TRUE);     
      $this->load->model('lcc_inbox','', TRUE);     
      $this->load->model('lcc_communication','', TRUE);     
      $this->load->model('staff','', TRUE);     
      $this->load->model('student_upload','', TRUE);     
    
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');                  
}

public function index(){

    $data                   =   array(); 
    $menuleft               =   array();
    $data["statements"]     =   array();
    $varsessioncheck_id     =   $this->session->userdata('uid');

    $label                  =   $this->session->userdata('label');    
        
    $data["fullname"]       =   $this->session->userdata('fullname');        
    $data["student_email"]  =   $this->session->userdata('username'); 
    
    $data['bodytitle']       =   "Communications";
    $data['faicon']          =   "fa-comments-o";
    $data['breadcrumbtitle'] =   "Dashboard > Communications";
    $data['ref']             = 'edit';


    $data['message']        =   "";
    
    
    $action 				= $this->input->get('action'); 
    $id 					= $this->input->get('id');     
    $data['inboxlists']      = $this->lcc_inbox->get_by_student_ID($id);
    $data['communicationlist']      = $this->lcc_communication->get_by_student_ID($id);       
    $data['settings']		= $this->settings->get_settings(); 
    $data["agent_list"] 	= $this->agent->get_all();
    
    // alert count part
    
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;
    $student_data_ids                   = $this->student_data->get_student_data_ids($data["student_email"]);
    
    foreach($student_data_ids as $ids) {
        foreach($ids as $id) {
          $data["alert_count"]          += $this->lcc_inbox->get_alert_of_student($id);  
          $data["inbox_alert_count"]    += $this->lcc_inbox->get_communication_alert_of_student($id);  
        }
    }
    // alert count part end
    
    // Start of post part
     if($_POST){
         
     }
     
     // END of post part  
     foreach($student_data_ids as $email => $ids) {
      foreach($ids as $id) {    
        $data["communication"]= $this->lcc_communication->get_by_student_ID($id);
      }
    }
    foreach($student_data_ids as $email => $ids) {
        foreach($ids as $id) {
            $data["inbox"] = $this->lcc_inbox->get_by_student_ID($id);
        }
    }      
      
    if(!empty($varsessioncheck_id) && $label == "student" && $action==Null){
          
            
            
        $data['user_data'] = $this->student_data->get_userinfo_by_ID($varsessioncheck_id); 

        $this->load->view('dashboard_header',$data);    
        $this->load->view('student/dashboard_topmenu');
        $this->load->view('student/dashboard_sidebar');
        $this->load->view('student/dashboard_body');
        $this->load->view('other_footer'); 

          
        
    }else if(!empty($varsessioncheck_id) && $label == "student" && $action=="details"){   
            
        //$this->lcc_inbox->updateNotificationstatusByAppID($id,"yes");
        $data['staff_id']        =   $this->lcc_inbox->get_last_staffbyID($id);    
        $data['student_appid']   =   $id;    
        $data['user_data'] = $this->student_data->get_userinfo_by_ID($varsessioncheck_id); 

        $this->load->view('dashboard_header',$data);    
        $this->load->view('student/dashboard_topmenu');
        $this->load->view('student/dashboard_sidebar');
        $this->load->view('student/communication_view');
        $this->load->view('other_footer'); 

          
        
    } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
        redirect('/admin_dashboard/'); 
	}else if(!empty($varsessioncheck_id) && $label=="student" ){
	    redirect('/user_dashboard/');
	}else if(!empty($varsessioncheck_id) && $label=="registered" ){
	    redirect('/student_dashboard/'); 
        
	                 
    }else{
        redirect('/logout/'); 
    }
    
    
       
} // end of index
   
}  
  
?>
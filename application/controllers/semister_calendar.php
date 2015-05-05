<?php
  
class Semister_calendar extends CI_Controller {   
    
   function __construct() {
  
      parent::__construct();    
      $this->load->model('login','', TRUE);     
      $this->load->model('student_assign_class','', TRUE);     
      $this->load->model('student_data','', TRUE);     
      $this->load->model('agent','', TRUE);     
      $this->load->model('course_relation','', TRUE);     
      $this->load->model('course','', TRUE);     
      $this->load->model('semister','', TRUE);     
      $this->load->model('awarding_body','', TRUE);     
      $this->load->model('lcc_inbox','', TRUE);     
      $this->load->model('lcc_communication','', TRUE);     
      $this->load->model('staff','', TRUE);     
      $this->load->model('student_gender','', TRUE);     
      $this->load->model('student_title','', TRUE);     
      $this->load->model('country','', TRUE);     
      $this->load->model('register','', TRUE);     
      $this->load->model('attendance','', TRUE);     
      $this->load->model('class_plan','', TRUE);     
      $this->load->model('class_lists','', TRUE);     
      $this->load->model('student_attendance_excuse','', TRUE);     
      $this->load->model('coursemodule','', TRUE);     
      $this->load->model('student_marital_status','', TRUE);     
      $this->load->model('student_others_ethnicity','', TRUE);     
      $this->load->model('student_others_disabilities','', TRUE);    
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');                  
      $this->load->model('time_plan');                  
      $this->load->model('room_plan');                  
      $this->load->library('php_mailer');                  
}

public function index(){

    $data                   =   array(); 
    $menuleft               =   array();
    $data["statements"]     =   array();
    $data["inbox"]          =   array();
    $varsessioncheck_id     =   $this->session->userdata('uid');
    $label                  =   $this->session->userdata('label');        
    $data["fullname"]       =   $this->student_data->get_fullname_by_ID($this->session->userdata('uid'));        
    $data["student_email"]  =   $this->session->userdata('username'); 
    $data['bodytitle']		  =	"Semester Calender";
    $data['breadcrumbtitle']=	"Dashboard > Semester Calender";
    $data['faicon']			    =	"fa-calendar";    
    $data['message']        =   "";
    $action 				        =   $this->input->get('action'); 
    $app_id 				        =   $this->input->get('id');      
    $data['settings']		    = $settings =   $this->settings->get_settings(); 
    $data["summary_data"] 	=   $this->dashboard->get_all_todays_count();
    $data["agent_list"] 	  =   $this->agent->get_all();
    $data["course_lists"]   =   $this->course_relation->get_by_current_date();
    $data["alert_count"] 	  =   0;
    $student_data_ids 		  =   $this->student_data->get_student_data_ids($data["student_email"]);


    // alert count part
    $data["alert_count"]            =   0;
    $data["inbox_alert_count"]      =   0;
    $student_data_ids               =   $this->student_data->get_student_data_ids($data["student_email"]);
    
    foreach($student_data_ids as $ids) {
        foreach($ids as $id) {
          $data["alert_count"]       += $this->lcc_inbox->get_alert_of_student($id);  
          $data["inbox_alert_count"] += $this->lcc_inbox->get_communication_alert_of_student($id);  
        }
    }

    
    foreach($student_data_ids as $email => $ids ) {
      foreach($ids as $id) { $data["communication"]   = $this->lcc_communication->get_by_student_id($id); }
	}
	foreach($student_data_ids as $email => $ids ) {
		foreach($ids as $id) {
            $i =0; $count = 0;
            
    		$data["inbox"] = $this->lcc_inbox->get_by_student_ID($id);
            
           
		
        }
	}
        // alert count part end
               
                
    if(!empty($varsessioncheck_id) && $label == "registered" && $action==Null){

        $data['user_data']        = $this->student_data->get_student_app_list_by_ID($varsessioncheck_id);

        $student_id = $student_data_ids[$data["student_email"]][0];
        $register_id = $this->register->get_id_by_student_data_ID($student_id);

        $class_plan_ids = $this->student_assign_class->get_by_register_id($register_id);
        $data["class_list_dates"] = array();
        foreach ($class_plan_ids as $k => $v) {
          $data["class_list_dates"][] = $this->class_lists->get_by_class_plan_id_with_class_plan_table_data($v['class_plan_id']);
        }

        
        
        // $this->load->view('dashboard_header',$data);    
        // $this->load->view('student/register/dashboard_topmenu');
        // $this->load->view('student/register/dashboard_sidebar');
        // $this->load->view('student/register/semister_calendar');
        // $this->load->view('student/register/dashboard_footer');

        $this->load->view('student/register/student_portal_header', $data);
        
        $this->load->view('student/register/student_portal_sidebar');
        
        
        $this->load->view('student/register/semister_calendar');
        $this->load->view('student/register/student_portal_footer'); 

    } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
        redirect('/admin_dashboard/'); 
	}else if(!empty($varsessioncheck_id) && $label=="student" ){
	    redirect('/user_dashboard/');
	}else if(!empty($varsessioncheck_id) && $label=="registered" ){
	    redirect('/student_dashboard/');  
    
    } else {
        
        redirect('/logout/'); 
    }
    
    
       
} // end of index
   
}  
  
?>
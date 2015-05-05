<?php
  
class Print_student_list extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();
    $this->load->model('login','', TRUE);   
    $this->load->helper('functions');      
    $this->load->helper('form');      
    $this->load->library('session');            
    $this->load->model('lcc_inbox');          
    $this->load->model('lcc_communication'); 
    $this->load->model('student_data','', TRUE);   
    $this->load->model('student_data_extend','', TRUE);    
    $this->load->model('staff','', TRUE);     
    $this->load->model('course','', TRUE); 
    $this->load->model('semister','', TRUE); 
    $this->load->model('course_relation','', TRUE); 
    $this->load->model('class_plan','', TRUE); 
    $this->load->model('semister','', TRUE); 
    $this->load->model('coursemodule','', TRUE); 
    $this->load->model('semester_plan','', TRUE); 
    $this->load->model('time_plan','', TRUE); 
    $this->load->model('room_plan','', TRUE); 
    $this->load->model('class_lists','', TRUE); 
    $this->load->model('register','', TRUE); 
    $this->load->model('student_assign_class','', TRUE); 
    $this->load->model('attendance','', TRUE);                   
    $this->load->model('settings','', TRUE);                   
}

  public function index(){

        $data["alert_count"]                =   0;
        $data["inbox_alert_count"]          =   0;
        $page                               = $this->input->get('page');
        $class_plan_id                      = $this->input->get('class_plan_id');


        if($this->session->userdata("print_routine_search")) {
            
            $data['routine_date']    =   $this->session->userdata("print_routine_search");

            $data['attendance']    = $this->attendance->get_attendance_by_date($data['routine_date']['terms']['date_class_list']);
            if(!empty($data['attendance'])) {
              $data['attendance']    = array_reverse($data['attendance']);
            }

           
            if(!empty($class_plan_id)){ 
              $class_plan_data      = $this->class_plan->get_by_ID(intval($class_plan_id)); 
              $data['class_plan']     =   $class_plan_data;
              $data['student_data_list']  = $this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));     
            }

            $data['settings'] = $this->settings->get_settings();
            //var_dump($data['settings']); die();
            	
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/assign_student_view_list_print');
            $this->load->view('staff/other_footer');
            	
            	
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
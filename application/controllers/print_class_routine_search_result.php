<?php
  
class Print_class_routine_search_result extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      
      $this->load->model('semister');          
      $this->load->model('settings');          
      $this->load->model('archive');          
      $this->load->model('course');          
      $this->load->model('course_relation');          
      $this->load->model('agent');              
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');        
      $this->load->model('student_data');
      $this->load->model('student_upload');
      $this->load->model('notes');
      $this->load->model('staff','', TRUE);
      $this->load->model('staff_upload','', TRUE);
      $this->load->model('awarding_body','', TRUE);
      $this->load->model('login','', TRUE);                          
      $this->load->model('settings','', TRUE);                          
      $this->load->model('class_plan','', TRUE);                          
      $this->load->model('time_plan','', TRUE);                          
      $this->load->model('room_plan','', TRUE);                          
      $this->load->model('coursemodule','', TRUE);                          
}

  public function index(){

        $data["alert_count"]                =   0;
        $data["inbox_alert_count"]          =   0;
        $page                               = $this->input->get('page');


        if($this->session->userdata("print_routine_search")) {
            
            $sesData        =   $this->session->userdata("print_routine_search");
            $terms          =   $sesData['terms'];

            $data['result'] =   $this->class_plan->makePrintClassListWithpaginationForPrint($terms,$page,base_url()."index.php/print_class_routine_management/?action=search","yes");
            	
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/print_class_routine_result');
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
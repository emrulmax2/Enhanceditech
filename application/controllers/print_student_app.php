<?php
  
class Print_student_app extends CI_Controller {   
    
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
      $this->load->model('student_gender','', TRUE);                          
      $this->load->model('student_marital_status','', TRUE);                          
      $this->load->model('student_others_disabilities','', TRUE);                          
      $this->load->model('student_others_ethnicity','', TRUE);                          
      $this->load->model('country','', TRUE);                          
      $this->load->model('student_others_ethnicity','', TRUE);                          
}

public function index(){
	
	
	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');   
        $data['settings']       =   $this->settings->get_settings();  
	    $data['message']        =   "";
        $data['bodytitle']      =   "Students Admission";
        $data['breadcrumbtitle']=   "Dashboard > Students Admission > Print Student Application";
        $data['faicon']         =   "fa-users";
        
        
        $data["alert_count"]                =   0;
        $data["inbox_alert_count"]          =   0;
        $data["alert_count"]                = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
        $data["inbox_alert_count"]          = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);
        
         
    	$id                     = $this->input->get('id');
   
        $student_data           = array();
                
        	

        if(!empty($varsessioncheck_id)) {
        	

        	$std_data                = $this->student_data->get_studentdata_for_edit($id);
  
  			foreach($std_data as $k=>$v){
				$data['user_data'][$k] = addslashes(tinymce_decode($v));				
  			}
  			
  			$data['settings'] = $this->settings->get_settings();
  			
  			
        	
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/student/print_form');
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attendance_list extends CI_Controller {

	function __construct()
	{
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
	}


	public function index(){

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');  
	    $data['message']        =   "";

	    //////////////////////////////////////////////////////	    
		/// get staff access
		//if($this->session->userdata('label')=="staff"){
		//	$staff_privileges_course_management = $data['staff_privileges_course_management'] = $this->session->userdata('staff_privileges_course_management');		
		//}	    
	    /////////////////////////////////////////////////////

	    // alert count part
	    
	    $data["alert_count"]                =   0;
	    $data["inbox_alert_count"]          =   0;
	    
	    
	    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
	    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
	    
	    // alert count part end


    
    	$action 				= $this->input->get('action');
    	$id 					= $this->input->get('id');
    	$class_plan_id			= $this->input->get('class_plan_id');
    	$page                   = $this->input->get('page');

        
        if($_POST){
        	
        	
        	
        	if($action=="search"){
								
					$terms = array();
					foreach($this->input->post() as $k=>$v){
						
						if($k!="ref" && $k!="ref_id"){  if(!empty($v)){ $$k=tinymce_encode($v); $terms[$k] = $$k; }  }
					}

					//var_dump($terms);
					$sesData = array();
				    $sesData['print_routine_search']['terms'] = $terms;
				    $this->session->set_userdata($sesData);
				    //var_dump($terms);
				    					
				
        	}else{
				
				
				
        	}	
        	
         	
        	
		}
        
        
	         
	  
	           
		if(!empty($varsessioncheck_id) && $action==""){

	        $data['bodytitle']       =   "Class Routine";
	        $data['faicon']          =   "fa-calendar";
	        $data['breadcrumbtitle'] =   "Dashboard > Class Routine"; 
	        $data['print_btn']		 =  "";

			
	        $data['ref'] = "";
			$data['ref_id'] = "";
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/print_attendance_list_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="search"){

	        $data['bodytitle']       =   "Print Class Routine";
	        $data['faicon']          =   "fa-print";
	        $data['breadcrumbtitle'] =   "Dashboard > Print Class Routine";

			
	        $data['ref']    = "";
			$data['ref_id'] = "";
			
         	$sesData        =   $this->session->userdata("print_routine_search");
         	$terms          =   $sesData['terms'];

		 	$data['result'] =   $this->class_plan->makePrintClassListWithpagination($terms,$page,base_url()."index.php/attendance_list/?action=search","yes");
		 	

		 	$data['print_btn'] = "<a class='btn btn-md btn-warning btn-assign-student' href='".base_url()."index.php/print_class_routine_search_result'><i class=\"fa fa-print\"></i> Print</a>";
		 			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/print_attendance_list_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="view_student_list"){

	        $data['bodytitle']       =   "Feed Attendance";
	        $data['faicon']          =   "fa-check-square-o";
	        $data['breadcrumbtitle'] =   "Dashboard > Print Class Routine > Feed Attendance"; 


	        $data['routine_date']    =   $this->session->userdata("print_routine_search");

	        $data['attendance']		 = $this->attendance->get_attendance_by_date($data['routine_date']['terms']['date_class_list']);
	        if(!empty($data['attendance'])) {
	        	$data['attendance']		 = array_reverse($data['attendance']);
	        }

	       
			if(!empty($class_plan_id)){ 
				$class_plan_data 			=	$this->class_plan->get_by_ID(intval($class_plan_id)); 
				$data['class_plan']			=   $class_plan_data;
				$data['student_data_list']	=	$this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));		 
			}
			
			
			
	        $data['ref'] 					= "save_to_attendance";
	        $data['ref_id']					= "";			 
			 
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/attendance_list_for_class_routine');
	        $this->load->view('staff/other_footer');	        
	        	        
                                                 
		
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL){       
	           
	        $data['bodytitle']       =   "Assign Students Management";
	        $data['faicon']          =   "fa-plug";
	        $data['breadcrumbtitle'] =   "Dashboard > Assign Students Management";  
	        
	        $data['time_plan'] = $this->time_plan->get_by_ID($id);
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $data['time_plan']['id'];
	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/assign_student_body_form');
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

/* End of file gender_management.php */
/* Location: ./application/controllers/registration/gender_management.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assign_student_management extends CI_Controller {

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
		$this->load->model('status','', TRUE); 
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
				    $sesData['reg_student_search']['terms'] = $terms;
				    $this->session->set_userdata($sesData);					
				
        	}else{
				
				
        	}	
        	
        	
		}
        
        
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){	         
	  
	           
		if(!empty($varsessioncheck_id) && $action==""){

	        $data['bodytitle']       =   "Assign Students Management";
	        $data['faicon']          =   "fa-plug";
	        $data['breadcrumbtitle'] =   "Dashboard > Assign Students Management"; 



	        $class_plan_id_list = $this->session->userdata('class_plan_id_list_for_assign_student');
	        $data['course_list'] = array();
	        foreach($class_plan_id_list as $class_plan_id){
				$class_plan_data 		=	$this->class_plan->get_by_ID($class_plan_id); 
				$data['class_plan'][]   =   $class_plan_data;
				$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan_data['course_relation_id']);
				if(!in_array($c_s_data['course_id'],$data['course_list']))	$data['course_list'][]	=	$c_s_data['course_id'];
				
	        }
            $data['semester_list'] = $this->semister->get_all_by_des_order();
            $data['status_list'] = $this->status->get_all();
			
	        $data['ref'] = "";
			$data['ref_id'] = "";
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/assign_student_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="search"){

	        $data['bodytitle']       =   "Assign Students Management";
	        $data['faicon']          =   "fa-plug";
	        $data['breadcrumbtitle'] =   "Dashboard > Assign Students Management"; 



	        $class_plan_id_list = $this->session->userdata('class_plan_id_list_for_assign_student');
	        $data['course_list'] = array();
	        foreach($class_plan_id_list as $class_plan_id){
				$class_plan_data 		=	$this->class_plan->get_by_ID($class_plan_id); 
				$data['class_plan'][]   =   $class_plan_data;
				$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan_data['course_relation_id']);
				if(!in_array($c_s_data['course_id'],$data['course_list']))	$data['course_list'][]	=	$c_s_data['course_id'];
	        }
            $data['semester_list'] = $this->semister->get_all_by_des_order();
			$data['status_list'] = $this->status->get_all();
            
	        $data['ref'] = "";
			$data['ref_id'] = "";
			
        	 $sesData   = $this->session->userdata("reg_student_search");
        	 $terms     = $sesData['terms'];			
			 $data['result']=$this->student_data_extend->makeRegisteredStudentListWithpagination($terms,$page,base_url()."index.php/assign_student_management/?action=search","yes");			
			 //var_dump($data['result']);
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/assign_student_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="view_student_list"){

	        $data['bodytitle']       =   "Assign Students Management";
	        $data['faicon']          =   "fa-plug";
	        $data['breadcrumbtitle'] =   "Dashboard > Assign Students Management"; 



/*	        $class_plan_id_list = $this->session->userdata('class_plan_id_list_for_assign_student');
	        $data['course_list'] = array();
	        foreach($class_plan_id_list as $class_plan_id){
				$class_plan_data 		=	$this->class_plan->get_by_ID($class_plan_id); 
				$data['class_plan'][]   =   $class_plan_data;
				$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan_data['course_relation_id']);
				if(!in_array($c_s_data['course_id'],$data['course_list']))	$data['course_list'][]	=	$c_s_data['course_id'];
	        }
            $data['semester_list'] = $this->semister->get_all();
			
	        $data['ref'] = "";
			$data['ref_id'] = "";
			
        	 $sesData   = $this->session->userdata("reg_student_search");
        	 $terms     = $sesData['terms'];			
			 $data['result']=$this->student_data_extend->makeRegisteredStudentListWithpagination($terms,$page,base_url()."index.php/assign_student_management/?action=search","yes");*/			
			 //var_dump($data['result']);
			if(!empty($class_plan_id)){ 
				$class_plan_data 			=	$this->class_plan->get_by_ID(intval($class_plan_id)); 
				$data['class_plan']			=   $class_plan_data;
				$data['student_data_list']	=	$this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));		 
			}
			
			
			
	        $data['ref'] = "";
	        $data['ref_id'] = "";			 
			 
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/assign_student_view_list');
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
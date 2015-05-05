<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_induction_assign_student extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login','', TRUE);   
		$this->load->helper('functions');      
		$this->load->helper('form');      
		$this->load->library('session');        
		$this->load->model('course');    
		$this->load->model('lcc_inbox');          
		$this->load->model('lcc_communication'); 
		$this->load->model('student_data','', TRUE); 	 
		$this->load->model('staff','', TRUE); 	  
		$this->load->model('country','', TRUE);
		$this->load->model('job_department','', TRUE);      
		$this->load->model('jobs','', TRUE);  		
		$this->load->model('job_induction','', TRUE); 	
		$this->load->model('semister','', TRUE);	 
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
				    $sesData['induction_student_search']['terms'] = $terms;
				    $this->session->set_userdata($sesData);					
				
        	}else{
				
				
        	}	
        	
        	
		}
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
	    if(!empty($varsessioncheck_id) && ($action==NULL)){
	            
	        $data['bodytitle']       =   "Assign Student's to Induction";
	        $data['faicon']          =   "fa-globe";
	        $data['breadcrumbtitle'] =   "Dashboard > Assign Student's to Induction";            

	        //$data['job_induction_list'] = $this->job_induction->get_all();
	        
	        $data['course_list'] = $this->course->get_all();
	        $data['semester_list'] = $this->semister->get_all();	        
            $data['job_induction'] = $this->job_induction->get_by_ID($id);
	        
	        //var_dump($data['course_list']);
	        $data['ref'] = "";
			$data['ref_id'] = "";	        
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/job_induction_assign_student_body_form');
	        $this->load->view('staff/other_footer'); 

		
		}else if(!empty($varsessioncheck_id) && $action=="search"){       
	           
	        $data['bodytitle']       =   "Job Induction Management";
	        $data['faicon']          =   "fa-globe";
	        $data['breadcrumbtitle'] =   "Dashboard > Job Induction Management";
	        
	        $data['course_list'] = $this->course->get_all();
	        $data['semester_list'] = $this->semister->get_all();
            $data['job_induction'] = $this->job_induction->get_by_ID($id);
			
	        $data['ref'] = "";
			$data['ref_id'] = "";
			
        	 $sesData   		= $this->session->userdata("induction_student_search");
        	 $terms     		= $sesData['terms'];			
			 $data['result']	= $this->student_data->makeStudentListWithpagination($terms,$page,base_url()."index.php/job_induction/job_induction_assign_student/?action=search&id=".$id,"yes");			
			 //var_dump($data['result']);	        

	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/job_induction_assign_student_body_form');
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
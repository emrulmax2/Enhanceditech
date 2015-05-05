<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_induction_processing_management extends CI_Controller {

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
		$this->load->model('job_department','', TRUE);      
		$this->load->model('jobs','', TRUE);  		
		$this->load->model('job_induction','', TRUE);  		
		$this->load->model('job_induction_process','', TRUE); 
		$this->load->model('lcc_inbox','', TRUE); 
		$this->load->model('job_assign','', TRUE); 
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
		if($this->session->userdata('label')=="staff"){

		  	$staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));
		  	if(!empty($staff_access['staff_privileges']['induction_processing_management']) && count($staff_access['staff_privileges']['induction_processing_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['induction_processing_management'];				
		       else{ $priv[0] = "";$priv[1] = "";$priv[2] = "";$priv[3] = ""; }		  		
		  						
		}
        // $priv[0] = List ; $priv[1] = Add ; $priv[2] = Edit ; $priv[3] = Delete ; 	    
	    /////////////////////////////////////////////////////

	    // alert count part
	    
	    $data["alert_count"]                =   0;
	    $data["inbox_alert_count"]          =   0;
	    
	    
	    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
	    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
	    
	    // alert count part end


    
    	$action = $this->input->get('action'); 
    	$id = $this->input->get('id');

 
        
        //if($this->input->post('ref')=="edit" && (!empty($staff_privileges_course_management['course_mng_edit']) || $this->session->userdata('label')=="admin")){
        if($this->input->post('ref')=="edit"  && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){
			
			$id = $this->input->post('ref_id');
			$args['id'] = $id;
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="jobs_list"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
				else if($k=="jobs_list"){ $$k = $v; $args[$k] = serialize($$k); }
			}
			//var_dump($args);
			
			///------------------------ Adding to job assign table
			$induction = $this->job_induction->get_by_ID($args['job_induction_id']);
			
			if(!empty($induction['assigned_students'])){
				
				$std_arr = unserialize($induction['assigned_students']);
				
				foreach($std_arr as $student_data_id){
					
					foreach($jobs_list as $jobs){
						
						$jobassign_row = $this->job_assign->get_by_issued_date_and_job_induction_id_and_student_data_id($induction['date'],$induction['id'],$student_data_id);
						//var_dump($jobassign_row);
						if($jobassign_row==false){ //////---------- if row doesnt exist then add new row
							
							$jobassign_args = array();
							$jobassign_args['issued_date'] = $induction['date'];
							$jobassign_args['jobs_id'] = $jobs;
							$jobassign_args['job_induction_id'] = $induction['id'];
							$jobassign_args['student_data_id'] = $student_data_id;
							$jobassign_args['status'] = "pending";
							
							$this->job_assign->add($jobassign_args);
						}

												
					}
	
				}
			}			
			
			///------------------------ end of Adding to job assign table			
			
			$insertedid=$this->job_induction_process->update($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Job Job induction process has been successfully updated. </div>";	   
	       	   
		   }
			
			
        //}else if($this->input->post('ref')=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
        }else if($this->input->post('ref')=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){
			
			//$id = $this->input->post('ref_id');
			
			foreach($this->input->post() as $k=>$v){
				if($k!="ref" && $k!="ref_id" && $k!="jobs_list"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
				else if($k=="jobs_list"){ $$k = $v; $args[$k] = serialize($$k); }
			}
			//var_dump($args);
			///------------------------ Sending inbox notification to students
			if(!empty($args['students_notified']) && $args['students_notified']=="yes"){
				
				$induction = $this->job_induction->get_by_ID($args['job_induction_id']);
				
				if(!empty($induction['assigned_students'])){
					$std_arr = unserialize($induction['assigned_students']);
					
					foreach($std_arr as $student_data_id){
						$inbox_args = array();
						$inbox_args['communication_id'] = 0;
						$inbox_args['student_data_id'] = $student_data_id;
						$inbox_args['staff_id'] = $this->session->userdata('uid');
						$inbox_args['notification_type'] = "induction";
						$inbox_args['notification_from'] = "staff";
						$inbox_args['notification_to'] = "student";
						$inbox_args['notification_to_staff_id'] = 0;
						$inbox_args['induction_id'] = $args['job_induction_id'];
						$this->lcc_inbox->add($inbox_args);	
					}
				}
				
			}
			///------------------------ END OF Sending inbox notification to students
			///------------------------ Sending inbox notification to Staff
			///------------------------------------------------------------------------------------need to work
			///------------------------ END OF Sending inbox notification to staff
			///------------------------ Adding to job assign table
			$induction = $this->job_induction->get_by_ID($args['job_induction_id']);
			
			if(!empty($induction['assigned_students'])){
				
				$std_arr = unserialize($induction['assigned_students']);
				
				foreach($std_arr as $student_data_id){
					
					foreach($jobs_list as $jobs){
						
						$job_data = $this->jobs->get_by_ID($jobs);
						
						$job_dept = unserialize($job_data['job_department_id']);
						
						if(!empty($job_dept)){
							
							foreach($job_dept as $dept){
								
								$jobassign_args = array();
								$jobassign_args['issued_date'] 			= $induction['date'];
								$jobassign_args['due_date'] 			= date('Y-m-d', strtotime('+'.$job_data['completion_period'].' day', strtotime($induction['date'])));
								$jobassign_args['jobs_id'] 				= $jobs;
								$jobassign_args['job_induction_id'] 	= $induction['id'];
								$jobassign_args['student_data_id'] 		= $student_data_id;
								$jobassign_args['job_department_id'] 	= $dept;
								$jobassign_args['assign_by_staff_id'] 	= $this->session->userdata('uid');
								$jobassign_args['status'] 				= "pending";

								$this->job_assign->add($jobassign_args);								
							}

						}						
					}
	
				}
			}			
			
			///------------------------ end of Adding to job assign table
			
			
			$insertedid=$this->job_induction_process->add($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Job induction process has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
	    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
	            
	        $data['bodytitle']       =   "Induction Processing Management";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > Induction > Induction Processing Management";             

	        $data['job_induction_processing_list'] = $this->job_induction_process->get_all();
	        
	        //var_dump($data['course_list']);
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/job_induction_processing_body_list');
	        $this->load->view('staff/other_footer'); 
	  
	           
		}else if(!empty($varsessioncheck_id) && $action=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){

	        $data['bodytitle']       =   "Induction Processing Management";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > Induction > Induction Processing Management";
		
			$data['job_induction_list'] = $this->job_induction->get_all();
			$data['job_list'] = $this->jobs->get_all_induction_type();
	        $data['ref'] = 'add';
			$data['ref_id'] = "";
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/job_induction_processing_body_form');
	        $this->load->view('staff/other_footer');

		
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){       
	           
	        $data['bodytitle']       =   "Induction Processing Management";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > Induction > Induction Processing Management";
	       
			$data['job_induction_list'] = $this->job_induction->get_all();
			$data['job_list'] = $this->jobs->get_all_induction_type();
	        
	        $data['job_induction_process'] = $this->job_induction_process->get_by_ID($id);
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $data['job_induction_process']['id'];
	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/job_induction_processing_body_form');
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
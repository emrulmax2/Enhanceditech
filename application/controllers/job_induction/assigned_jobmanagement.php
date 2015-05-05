<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assigned_jobmanagement extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login','', TRUE);   
		$this->load->helper('functions');      
		$this->load->helper('form');      
		$this->load->library('session');        
        $this->load->model('student_data');    
        $this->load->model('register');    
		$this->load->model('course');    
		$this->load->model('lcc_inbox');          
		$this->load->model('lcc_communication'); 
		$this->load->model('student_data','', TRUE); 	 
		$this->load->model('staff','', TRUE); 	  
		$this->load->model('job_department','', TRUE);      
		$this->load->model('jobs','', TRUE);  		
		$this->load->model('job_induction','', TRUE);  		
        $this->load->model('job_induction_process','', TRUE); 
		$this->load->model('job_assign','', TRUE); 
		$this->load->model('lcc_inbox','', TRUE); 
		$this->load->model('job_type','', TRUE); 
		$this->load->model('job_applied_student','', TRUE); 
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

                  if(!empty($staff_access['staff_privileges']['assigned_job_management']) && count($staff_access['staff_privileges']['assigned_job_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['assigned_job_management'];                
                else{ $priv[0] = ""; }

                                  
        }	    
	    /////////////////////////////////////////////////////

	    // alert count part
	    
	    $data["alert_count"]                =   0;
	    $data["inbox_alert_count"]          =   0;
	    
	    
	    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
	    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
	    
	    // alert count part end


    
    	$action 				= $this->input->get('action'); 
    	$id 					= $this->input->get('id');
    	$dept_id 				= $this->input->get('dept_id');
        $page                   = $this->input->get('page');
 
        
        //if($this->input->post('ref')=="edit" && (!empty($staff_privileges_course_management['course_mng_edit']) || $this->session->userdata('label')=="admin")){
        if($this->input->post('ref')=="edit"){
			
			$id = $this->input->post('ref_id');
			$args['id'] = $id;
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="jobs_list"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
				else if($k=="jobs_list"){ $$k = $v; $args[$k] = serialize($$k); }
			}
			//var_dump($args);
			$insertedid=$this->job_induction_process->update($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Job department has been successfully updated. </div>";	   
	       	   
		   }
			
			
        //}else if($this->input->post('ref')=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
        }else if($this->input->post('ref')=="add"){
			
			//$id = $this->input->post('ref_id');
			
			foreach($this->input->post() as $k=>$v){
				if($k!="ref" && $k!="ref_id" && $k!="jobs_list"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
				else if($k=="jobs_list"){ $$k = $v; $args[$k] = serialize($$k); }
			}
			//var_dump($args);
			///------------------------ Sending inbox notification to students
			if($args['students_notified']=="yes"){
				
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
			
			$insertedid=$this->job_induction_process->add($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Job department has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
	    if( !empty($varsessioncheck_id) && $action!="archive" && ( !empty($priv[0]) || $this->session->userdata('label')=="admin" ) ){
	            
	        $data['bodytitle']       =   "Assigned Job Lists";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > job management > Assigned Job lists";             

	        //$data['assigned_job_list'] = $this->job_assign->get_all();
	        
	        //---- get departments
	        
	        $all_departmets = $this->job_department->get_all();
	        $assigned_departments = array();
	        foreach($all_departmets as $k=>$v){
	        	if(!empty($v['staff_list'])){
					$staff_list = unserialize($v['staff_list']);
					//var_dump($staff_list);
					foreach($staff_list as $a){
						if($a == $this->session->userdata("uid")){
							$data['assigned_departments'][$v['id']] = $assigned_departments[$v['id']] = $v['name'];
						}
					}
				}	
	        }
	        $job_list = array(); $induction_job_list = array();
	        if(!empty($dept_id)){
				/*$jobs = $this->jobs->get_all();
				foreach($jobs as $k=>$v){
					if(!empty($v['job_department_id'])){
						$departments = unserialize($v['job_department_id']);
						foreach($departments as $dept){
							if($dept==$dept_id){
								$job_list[$v['id']] = $v['name']; 
							}
						} 
					}	
				}
				if(!empty($job_list) && count($job_list)>0){
					
					foreach($job_list as $k=>$v){
						$job_data = $this->jobs->get_by_ID($k);
						if($job_data['job_type']=="common"){
					 		$common_job_list[$job_data['id']] = $job_data['name'];	
						}else if($job_data['job_type']=="induction"){
							$induction_job_list[$job_data['id']] = $job_data['name'];
						}
					}
				    if(!empty($common_job_list) && count($common_job_list)>0) 
				    $data['common_job_list'] 	= $common_job_list;
				    else $data['common_job_list'] = "";
				    if(!empty($induction_job_list) && count($induction_job_list)>0) 
				    $data['induction_job_list'] = $induction_job_list;
				    else $data['induction_job_list'] =""; 
				
				}*/
				//-- if(!empty($job_list) && count($job_list)>0){
				
				$job_type = array();
				$job_type = $this->job_type->get_all();
				$jobs = $this->job_assign->get_by_job_department_id_and_status_pending($dept_id);
				//var_dump($jobs);
				foreach($job_type as $k=>$v){
					
					foreach($jobs as $a=>$b){
						
						$job_data = $this->jobs->get_by_ID($b['jobs_id']);
						if(!empty($job_data)){
							if($job_data['job_type_id'] == $v['id']){
								
								$job_list[$v['name']][] = array("job_data"	=>	$job_data,"job_assign_data"	=>	$b);
							
							}
							/*
                                else if($job_data['job_type_id'] == $v['id'] && $v['name']=="Induction"){
								
								$induction_id = $b['job_induction_id'];
								
								$job_list[$v['name']][] = array(	"job_data"	=>	$job_data,"job_assign_data"	=>	$b);
								
							}*/							
						}
						
						
					}	
					
				}
				
				
               $data['job_list'] = $job_list;

	        }
	        
	        
	        
	        //var_dump($data['course_list']);
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/job_assigned_list');
	        $this->load->view('staff/other_footer'); 
	  

		}else if(!empty($varsessioncheck_id) && $action=="archive" && ( !empty($priv[0]) || $this->session->userdata('label')=="admin" ) ){
	  
	        $data['bodytitle']       =   "Assigned Job Lists";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > job management > Assigned Job lists";


	        $all_departmets = $this->job_department->get_all();
	        $assigned_departments = array();
	        foreach($all_departmets as $k=>$v){
	        	if(!empty($v['staff_list'])){
					$staff_list = unserialize($v['staff_list']);
					//var_dump($staff_list);
					foreach($staff_list as $a){
						if($a == $this->session->userdata("uid")){
							$data['assigned_departments'][$v['id']] = $assigned_departments[$v['id']] = $v['name'];
						}
					}
				}	
	        }


	        if(!empty($dept_id)){

	        	$data['archive']	= $this->job_assign->makeJobAssignListWithpagination(array("job_department_id"=>$dept_id),$page,base_url()."index.php/job_induction/assigned_jobmanagement/?action=archive&dept_id=".$dept_id,"yes");		
	        	

	        }	        
	        
	        
	        
	        
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/job_assigned_list');
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
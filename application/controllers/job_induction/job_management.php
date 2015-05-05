<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_management extends CI_Controller {

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
		$this->load->model('jobs','', TRUE); 
		$this->load->model('job_department','', TRUE); 
		$this->load->model('job_assign','', TRUE); 
		$this->load->model('job_type','', TRUE); 
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

		  		if(!empty($staff_access['staff_privileges']['job_management']) && count($staff_access['staff_privileges']['job_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['job_management'];				
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
        if($this->input->post('ref')=="edit" && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){
			$args = array();
			$id = $this->input->post('ref_id');
			$args['id'] = $id;
			$department_list = "";
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref_id" && $k!="ref" && $k!= "job_department_id" && $k!="job_available"){ 
					$$k = tinymce_encode($v); 
					$args[$k] = $$k; 
				}
				if($k=="job_department_id") {
					$department_list = $v;
					$args[$k] = serialize($v);
				}
				if($k == "job_available") {
					$args[$k] = serialize($v);
				}
				
			}
			if($args['same_day']=="no") {
				$args['cost'] = NULL;
			}
			
			//var_dump($args); die();
			$insertedid = $this->jobs->update($args);


			/*if($this->input->post('job_type') == "common") 
			{
				// var_dump($department_list); die();
				if(!empty($department_list)) 
				{
					foreach ($department_list as $key => $value) 
					{
						$clean_staff_list 		= array();
						$staff_list 			= $this->job_department->get_staff_list_by_id($value);
						$clean_staff_list 		= unserialize($staff_list);
						
						if(!empty($clean_staff_list)) 
						{
							$job_id = $this->input->post('ref_id');
							
							foreach ($clean_staff_list as $x => $y) 
							{
								//$y = staff_id
								//$this->input->post('ref_id') = job_id
								//$value = job_department_id
								$args = array();
								$args['issued_date'] = date("Y-m-d", time());
								$args['jobs_id'] = $job_id;
								$args['staff_id'] = $y;
								$args['job_department_id'] = $value;
								$args['reviewed_by'] = $this->session->userdata('uid');

								$check_job_assign_data = $this->job_assign->get_by_jobs_id_and_staff_id_and_job_department_id($job_id, $y, $value);

								if($check_job_assign_data == false) 
								{
									$this->job_assign->add($args);								
								} 								
							}
						}
					}
				}				
			}*/



	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Job has been successfully updated. </div>";	   
	       	   
		   }
			
			
        //}else if($this->input->post('ref')=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
        }else if($this->input->post('ref')=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){
			
			//$id = $this->input->post('ref_id');

			$args = array();

			$department_list = "";
			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref_id" && $k!="ref" && $k!= "job_department_id" && $k!="job_available"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
				if($k=="job_department_id") {
					$department_list = $v;
					$args[$k] = serialize($v);
				}
				if($k == "job_available") {
					$args[$k] = serialize($v);
				}
			}
			//var_dump($args); die();
			$insertedid=$this->jobs->add($args);
			////////////----------------------------------------

			/*if($this->input->post('job_type') == "common") {
				// var_dump($department_list); die();
				foreach ($department_list as $key => $value) {

					$clean_staff_list 		= array();
					$staff_list 			= $this->job_department->get_staff_list_by_id($value);
					$clean_staff_list 		= unserialize($staff_list);
					// var_dump($clean_staff_list);
					if(!empty($clean_staff_list)) {

						foreach ($clean_staff_list as $x => $y) {

							$args = array();
							$args['issued_date'] = date("Y-m-d", time());
							$args['jobs_id'] = $insertedid;
							$args['staff_id'] = $y;
							$args['job_department_id'] = $value;
							$args['reviewed_by'] = $this->session->userdata('uid');

							$this->job_assign->add($args);
						}
					}

				}
				
			}*/


			
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Job has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
	    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
	            
	        $data['bodytitle']       =   "Job Management";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > Job Management > Jobs";             

	        $data['job_list'] = $this->jobs->get_all();
	        
	        //var_dump($data['course_list']);
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/jobs_body_list');
	        $this->load->view('staff/other_footer'); 
	  
	           
		}else if(!empty($varsessioncheck_id) && $action=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){

	        $data['bodytitle']       =   "Job Management";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > Job Management > Jobs";
		
	        $data['ref'] = 'add';
			$data['ref_id'] = "";

			$data['job_department']  = $this->job_department->get_all();
			$data['job_types']  = $this->job_type->get_all();
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/jobs_body_form');
	        $this->load->view('staff/other_footer');

		
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && $id != NULL && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){       
	           
	        $data['bodytitle']       =   "Job Management";
	        $data['faicon']          =   "fa-info";
	        $data['breadcrumbtitle'] =   "Dashboard > Job Management > Jobs";
	        
	        $data['jobs'] = $this->jobs->get_by_ID($id);
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $data['jobs']['id'];

	        $data['job_department']  = $this->job_department->get_all();
	        $data['job_types']  = $this->job_type->get_all();
	        //var_dump($data['job_department']); die();

	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/job_induction/jobs_body_form');
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
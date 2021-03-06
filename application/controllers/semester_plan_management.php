<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Semester_plan_management extends CI_Controller {

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
		$this->load->model('semester_plan','', TRUE); 
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
        if($this->session->userdata('label')=="staff"){
                  $staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));                  
                  if(!empty($staff_access['staff_privileges']['semester_plan_management']) && count($staff_access['staff_privileges']['semester_plan_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['semester_plan_management'];                
                  else{ $priv[0] = ""; $priv[1] = ""; $priv[2] = ""; $priv[3] = ""; }
        }        
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
        if($this->input->post('ref')=="edit"){
			
			$id = $this->input->post('ref_id');
			$args['id'] = $id;
			foreach($this->input->post() as $k=>$v){
				
				if($k=="start_date" || $k=="end_date" || $k=="teaching_start" || $k=="teaching_end" || $k=="revision_start" || $k=="revision_end"){ $$k = tinymce_encode($v); $args[$k] = date("Y-m-d",strtotime($$k)); }
				else if($k!="ref" && $k!="ref_id"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
			}
			$insertedid=$this->semester_plan->update($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Semester plan has been successfully updated. </div>";	   
	       	   
		   }
			
			
        //}else if($this->input->post('ref')=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
        }else if($this->input->post('ref')=="add"){
			
			//$id = $this->input->post('ref_id');
			
			foreach($this->input->post() as $k=>$v){
				
				if($k=="start_date" || $k=="end_date" || $k=="teaching_start" || $k=="teaching_end" || $k=="revision_start" || $k=="revision_end"){ $$k = tinymce_encode($v); $args[$k] = date("Y-m-d",strtotime($$k)); }
				else if($k!="ref" && $k!="ref_id"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
			}
			//var_dump($args);
			$insertedid=$this->semester_plan->add($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Semester plan has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
	    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
	            
	        $data['bodytitle']       =   "Semester Plan Management";
	        $data['faicon']          =   "fa-tasks";
	        $data['breadcrumbtitle'] =   "Dashboard > Semester Plan Management";             

	        $data['semester_plan_list'] = $this->semester_plan->get_all();
	        
	        //var_dump($data['course_list']);
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/semester_plan_body_list');
	        $this->load->view('staff/other_footer'); 
	  
	           
		}else if(!empty($varsessioncheck_id) && $action=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){

	        $data['bodytitle']       =   "Semester Plan Management";
	        $data['faicon']          =   "fa-tasks";
	        $data['breadcrumbtitle'] =   "Dashboard > Semester Plan Management";
		
			$data['semester_list'] = $this->semister->get_all();
			
	        $data['ref'] = 'add';
			$data['ref_id'] = "";
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/semester_plan_body_form');
	        $this->load->view('staff/other_footer');

		
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){       
	           
	        $data['bodytitle']       =   "Semester Plan Management";
	        $data['faicon']          =   "fa-tasks";
	        $data['breadcrumbtitle'] =   "Dashboard > Semester Plan Management";
	        
	        $data['semester_plan'] = $this->semester_plan->get_by_ID($id);
	        $data['semester_list'] = $this->semister->get_all();
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $data['semester_plan']['id'];
	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/semester_plan_body_form');
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
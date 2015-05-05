<?php
  
class Module_management extends CI_Controller {   
    
   function __construct() {
  
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
      $this->load->model('modules','', TRUE); 	  
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
			//$staff_privileges_course_management = $data['staff_privileges_course_management'] = $this->session->userdata('staff_privileges_course_management');		
		//}	    
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
			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id") $args[$k] = tinymce_encode($v);
			}
			$args['id'] = $id;
			$insertedid=$this->modules->update($args,$id);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Module has been successfully updated. </div>";	   
	       	   
		   }
			
			
        //}else if($this->input->post('ref')=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
        }else if($this->input->post('ref')=="add"){
			

			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
			}

			$insertedid=$this->modules->add($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Module has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
            
        $data['bodytitle']       =   "Module Management";
        $data['faicon']          =   "fa-leaf";
        $data['breadcrumbtitle'] =   "Dashboard > Module Management";             

        $data['module_list'] = $this->modules->get_all();
        

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/module_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	//}else if(!empty($varsessioncheck_id) && $action=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
	}else if(!empty($varsessioncheck_id) && $action=="add"){

        $data['bodytitle']       =   "Module Management";
        $data['faicon']          =   "fa-leaf";
        $data['breadcrumbtitle'] =   "Dashboard > Module Management";
	
        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/module_body_form');
        $this->load->view('staff/other_footer');

	
	//}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($staff_privileges_course_management['course_mng_edit']) || $this->session->userdata('label')=="admin")){       
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL){       
           
        $data['bodytitle']       =   "Module Management";
        $data['faicon']          =   "fa-leaf";
        $data['breadcrumbtitle'] =   "Dashboard > Module Management";
        
        $data['module'] = $this->modules->get_by_ID($id);
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['module']['id'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/module_body_form');
        $this->load->view('staff/other_footer');
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
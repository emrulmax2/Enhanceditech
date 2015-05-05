<?php
  
class Slc_coursecode_management extends CI_Controller {   
    
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
      $this->load->model('slc_coursecode','', TRUE); 	  
      $this->load->model('course_relation','', TRUE); 	  
      $this->load->model('course','', TRUE); 	  
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
			$staff_privileges_course_management = $data['staff_privileges_course_management'] = $this->session->userdata('staff_privileges_course_management');		
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
			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="semester_id" && $k!="course_id") $args[$k] = tinymce_encode($v);
				else $$k=$v;
			}
			$args['id'] = $id;
			$course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semester_id);
			$args['course_relation_id'] = $course_relation_id;			
			
			$insertedid=$this->slc_coursecode->update($args,$id);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> SLC Course Code has been successfully updated. </div>";	   
	       	   
		   }
			
			
        //}else if($this->input->post('ref')=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
        }else if($this->input->post('ref')=="add"){
			

			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="semester_id" && $k!="course_id"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
				else $$k=$v;
			}
			
			$course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semester_id);
			$args['course_relation_id'] = $course_relation_id;

			$insertedid=$this->slc_coursecode->add($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> SLC Course Code has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
            
        $data['bodytitle']       =   "SLC Course Code Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > SLC Course Code Management";             

        $data['slc_coursecode_list'] = $this->slc_coursecode->get_all();
        //var_dump($data['slc_coursecode_list']); die();
        $data['course_list'] = $this->course->get_all();
        $data['semester_list'] = $this->semister->get_all();        

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/slc_coursecode_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	//}else if(!empty($varsessioncheck_id) && $action=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
	}else if(!empty($varsessioncheck_id) && $action=="add"){

        $data['bodytitle']       =   "SLC Course Code Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > SLC Course Code Management";
	
        $data['course_list'] = $this->course->get_all();
        $data['semester_list'] = $this->semister->get_all();

        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/slc_coursecode_body_form');
        $this->load->view('staff/other_footer');

	
	//}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($staff_privileges_course_management['course_mng_edit']) || $this->session->userdata('label')=="admin")){       
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL){       
           
        $data['bodytitle']       =   "SLC Course Code Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > SLC Course Code Management";
        
        $data['slc_coursecode'] = $this->slc_coursecode->get_by_ID($id);
        
        $data['course_list'] = $this->course->get_all();
        $data['semester_list'] = $this->semister->get_all();
        //var_dump( $data['course']); die();
        
        
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['slc_coursecode']['id'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/slc_coursecode_body_form');
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
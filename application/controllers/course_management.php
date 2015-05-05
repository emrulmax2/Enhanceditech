<?php
  
class Course_management extends CI_Controller {   
    
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
      $this->load->model('login','', TRUE);       
      $this->load->model('hesa_courseaim','', TRUE);      
      $this->load->model('hesa_qual','', TRUE);       
      $this->load->model('hesa_regbody','', TRUE);    
      $this->load->model('hesa_ttcid','', TRUE);      
      $this->load->model('hesa_sbjca','', TRUE);      
      $this->load->model('hesa_subject_of_course','', TRUE); 	  
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
                //unserialize($staff_access);
		  		if(!empty($staff_access['staff_privileges']['course_management'])){  $priv = $data['priv'] = $staff_access['staff_privileges']['course_management']; }				
		        else{ $priv[0] = "";$priv[1] = "";$priv[2] = "";$priv[3] = ""; }
                
                //var_dump($priv);
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

 
        
        if($this->input->post('ref')=="edit" && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){
			
			$id = $this->input->post('ref_id');
			
			foreach($this->input->post() as $k=>$v){

				
				if($k!="ref" && $k!="ref_id" && $k!="subject_course_1" && $k!="subject_course_2" && $k!="subject_course_3" && $k!="subject_course_4" && $k!="contribution_percent")
                { 
                    $$k = tinymce_encode($v); $args[$k] = $$k; 

                } 
                elseif($k=="contribution_percent") 
                {
                    $args['contribution_percent'] = serialize($v);
                } 
                elseif($k!="ref" && $k!="ref_id" && $k != "contribution_percent") 
                {
                    $$k = $v; 
                    $args2[$k] = $$k; 
                }

			}

            $checkIfExist = $this->hesa_subject_of_course->get_by_course_id($id);

            if (!empty($checkIfExist) || $checkIfExist != NULL) {
                $args2['course_id'] = $id;
                $this->hesa_subject_of_course->update_by_course_id($args2, $id);
            } else {
                $args2['course_id'] = $id;
                $this->hesa_subject_of_course->add($args2);
            }

			$insertedid=$this->course->update($args,$id);

            


	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Course has been successfully updated. </div>";	   
	       	   
		   }
			
			
        }else if($this->input->post('ref')=="add"  && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){
			

			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="subject_course_1" && $k!="subject_course_2" && $k!="subject_course_3" && $k!="subject_course_4" && $k!="contribution_percent")
                { 
                    $$k = tinymce_encode($v); $args[$k] = $$k; 

                } 
                elseif($k=="contribution_percent") 
                {
                    $args['contribution_percent'] = serialize($v);
                } 
                elseif($k!="ref" && $k!="ref_id" && $k != "contribution_percent") 
                {
                    $$k = $v; 
                    $args2[$k] = $$k; 
                }


			}

            
            $insertedid=$this->course->add($args);

            $args2['course_id'] = $insertedid;
            //var_dump($args2);
			$this->hesa_subject_of_course->add($args2);

	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Course has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
            
        $data['bodytitle']       =   "Course Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > Course Management";             

        $data['course_list'] = $this->course->get_all();
        

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/course_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	}else if(!empty($varsessioncheck_id) && $action=="add"  && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){

        $data['bodytitle']       =   "Course Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > Course Management";
        $data['hesa_courseaim']  = $this->hesa_courseaim->get_all();
        $data['hesa_qual']       = $this->hesa_qual->get_all();
        $data['hesa_regbody']    = $this->hesa_regbody->get_all();
        $data['hesa_ttcid']      = $this->hesa_ttcid->get_all();
        $data['hesa_sbjca']      = $this->hesa_sbjca->get_all();

	
        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/course_body_form');
        $this->load->view('staff/other_footer');

	
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){       
           
        $data['bodytitle']       =   "Course Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > Course Management";
        $data['hesa_courseaim']  = $this->hesa_courseaim->get_all();
        $data['hesa_qual']       = $this->hesa_qual->get_all();
        $data['hesa_regbody']    = $this->hesa_regbody->get_all();
        $data['hesa_ttcid']      = $this->hesa_ttcid->get_all();
        $data['hesa_sbjca']      = $this->hesa_sbjca->get_all();
        
        $data['course'] = $this->course->get_by_id_new($id);
        //var_dump($id);
        $data['hesa_subject_of_course'] = $this->hesa_subject_of_course->get_by_course_id($id);
        //var_dump( $data['hesa_subject_of_course']); //die();
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['course']['id'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/course_body_form');
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_module_relation_management extends CI_Controller {

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
		$this->load->model('course_modules_relation','', TRUE); 	  
		$this->load->model('course_relation','', TRUE);
		$this->load->model('course_level','', TRUE);
		$this->load->model('coursemodule','', TRUE);
		$this->load->model('slc_coursecode','', TRUE);
		$this->load->model('login','', TRUE);
	}

	public function index()
	{
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
		  		if(!empty($staff_access['staff_privileges']['course_module_relation_management']) && count($staff_access['staff_privileges']['course_module_relation_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['course_module_relation_management'];				
		        else{ $priv[0] = "";$priv[1] = "";$priv[2] = "";$priv[3] = ""; }
        }	    
	    ///////////////////////////////////////////////////// 

	    // alert count part
	  
	    $data["alert_count"]          =   0;
	    $data["inbox_alert_count"]    =   0;
	    
	    
	    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
	    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
	    
	    // alert count part end


    
    	$action = $this->input->get('action'); 
    	$id = $this->input->get('id');
    	$course_id = $this->input->get('course_id');

 
        
        //if($this->input->post('ref')=="edit" && (!empty($staff_privileges_course_management['course_mng_edit']) || $this->session->userdata('label')=="admin")){
        if($this->input->post('ref')=="edit" && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){
			
			$course_id = $this->input->post('ref_id');

   			$level_id 					= $this->input->post('level_id');
   			$level_pos 					= ($this->input->post('level_pos')) ? $this->input->post('level_pos') : (int) $this->input->get('l');



        	$level_info 				= $this->course_level->get_by_ID($level_id);
        	

        	$course_id 					= $this->input->get('course_id');

        	$data['level_list'] 	 	=  $this->course_level->get_by_course_ID($course_id);

        	foreach($data['level_list'] as $k => $v) {
        		if($v['id'] == $level_info[0]['id']) {
		        	for ($i=0; $i < $level_info[0]['noofmodule']; $i++) { 
		        		$args = array();
						$args['id'] 				= $this->input->post("module_id_".$i."_".$v['id']);
						$args['course_id'] 			= $course_id;
						$args['modulename'] 		= $this->input->post("module_".$i."_".$v['id']);
						$args['module_code'] 		= $this->input->post("module_code_".$i."_".$v['id']);
						$args['courselevel_id'] 	= $level_id;
						$args['createddate'] 		= date('y-m-d H:i:s');
						$args['modifieddate'] 		= date('y-m-d H:i:s');
						$args['createdby'] 			= $this->session->userdata('uid');
						$args['modifiedby'] 		= $this->session->userdata('uid');

						
						if(!$this->input->post("module_id_".$i."_".$v['id'])) {
							unset($args['id']);
							$insertedid[]=$this->coursemodule->add($args);
						} else {
							$insertedid[]=$this->coursemodule->update_module($args);
						}
						
		        	}
		        }
	        }

			$data['error']=0; 
			if((count($insertedid) == $level_info[0]['noofmodule']) || $update) {

				$this->session->set_flashdata('message', "<div class='alert alert-success'>".$level_info[0]['name']." Module has been successfully updated. </div>");
				redirect('/course_module_relation_management?action=edit&course_id='.$course_id.'&l='.$level_pos);   
				   
			}
			
	      
			
       } else if($this->input->post('ref')=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){
			

			$course_id = $this->input->post('course_id');

			$total_level = $this->input->post('level_number');

			for ($i=1; $i <= $total_level; $i++) {

				$args = array();
				$args['course_id'] 		= $course_id;
				$args['name'] 			= $this->input->post("level_".$i."_name");
				$args['noofmodule'] 	= $this->input->post("level_".$i."_module");
				$args['createddate'] 	= date('y-m-d H:i:s');
				$args['modifieddate'] 	= date('y-m-d H:i:s');
				$args['createdby'] 		= $this->session->userdata('uid');
				$args['modifiedby'] 	= $this->session->userdata('uid');
				$insertedid=$this->course_level->add($args);

			}


	       $data['error']=0; 
	       if($insertedid){
	       		redirect('/course_module_relation_management?action=add_module&course_id='.$course_id.'&l=1');
	       		
		   }			
        }else if($this->input->post('ref')=="level_edit"){
			
        	$id = $this->input->post('ref_id');
			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id") $args[$k] = tinymce_encode($v);
			}
			$insertedid=$this->course_level->update($args,$id);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Level has been successfully updated. </div>";	   
	       	   
		   }
						
        } elseif($this->input->post('ref')=="add_module") {

        	$level_id 					= $this->input->post('level_id');
        	$level_info 				= $this->course_level->get_by_ID($level_id);
        	

        	$course_id 					= $this->input->get('course_id');
        	$l 							= (int) $this->input->get('l') ;


        	$data['level_list'] 	 	=  $this->course_level->get_by_course_ID($course_id);

        	foreach($data['level_list'] as $k => $v) {
        		if($v['id'] == $level_info[0]['id']) {
		        	for ($i=0; $i < $level_info[0]['noofmodule']; $i++) { 
		        		$args = array();
						$args['course_id'] 			= $course_id;
						$args['modulename'] 		= $this->input->post("module_".$i."_".$v['id']);
						$args['module_code'] 		= $this->input->post("module_code_".$i."_".$v['id']);
						$args['courselevel_id'] 	= $level_id;
						$args['createddate'] 		= date('y-m-d H:i:s');
						$args['modifieddate'] 		= date('y-m-d H:i:s');
						$args['createdby'] 			= $this->session->userdata('uid');
						$args['modifiedby'] 		= $this->session->userdata('uid');
						

						$insertedid[]=$this->coursemodule->add($args);
		        	}
		        }
	        }

			$data['error']=0; 
			if(count($insertedid) == $level_info[0]['noofmodule']) {
				// $data['message'] = "<div class='alert alert-success'>".$level_info[0]['name']." Module has been successfully added. </div>";
				redirect('/course_module_relation_management?action=edit&course_id='.$course_id.'&l=1');	   
				   
			}



        }
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
	    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
	            
	        $data['bodytitle']       	=   "Course Modules Relation Management";
	        $data['faicon']          	=   "fa-share-alt";
	        $data['breadcrumbtitle'] 	=   "Dashboard > Course Modules Relation Management";             

			$data['c_level_list'] = $this->course->get_all();

	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/course_module_relation_body_list');
	        $this->load->view('staff/other_footer'); 
	  
	           
		//}else if(!empty($varsessioncheck_id) && $action=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
		}else if(!empty($varsessioncheck_id) && $action=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){

	        $data['bodytitle']       =   "Course Modules Relation Management";
	        $data['faicon']          =   "fa-share-alt";
	        $data['breadcrumbtitle'] =   "Dashboard > Course Modules Relation Management"; 
		
	        $data['ref'] 			 = 'add';
			$data['ref_id'] 		 = "";
			
			$data['course_list'] 	 =  $this->course->get_all();
			foreach ($data['course_list'] as $k => $v) {
				$level_found		 =	$this->course_level->get_by_course_ID($v['id']);
				if(!empty($level_found)) {
					unset($data['course_list'][$k]);
				}
			}
			$data['module_list'] 	 =  $this->modules->get_all();
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/course_module_relation_body_form');
	        $this->load->view('staff/other_footer');

		
		}else if(!empty($varsessioncheck_id) && $action=="level_edit" && $this->input->get('level_id') != NULL){

	        $data['bodytitle']       =   "Course Modules Relation Management";
	        $data['faicon']          =   "fa-share-alt";
	        $data['breadcrumbtitle'] =   "Dashboard > Course Modules Relation Management > Level Edit"; 
		
	        $data['ref'] 			 = 'level_edit';
			$data['ref_id'] 		 = $this->input->get('level_id');

			$level_id 				 = $this->input->get('level_id');
			
			$data['level']			 = $this->course_level->get_by_ID($level_id);

			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/level_body_form');
	        $this->load->view('staff/other_footer');

		
		}else if(!empty($varsessioncheck_id) && $action=="add_module"){

	        $data['bodytitle']       =   "Course Modules Relation Management";
	        $data['faicon']          =   "fa-share-alt";
	        $data['breadcrumbtitle'] =   "Dashboard > Course Modules Relation Management"; 
		
	        $data['ref'] 			 = 'add_module';
			$data['ref_id'] 		 = "";
			$data['l'] 				 = (int) $this->input->get('l');
			
			$data['level_list'] 	 =  $this->course_level->get_by_course_ID($course_id);
			$data['course'] 		 =  $this->course->get_name($course_id);
			//$data['staff']			 = $this->staff->get_all();
			

			$data['module_list'] =  $this->modules->get_all();
			$data['modules'] = "";
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/course_module_creation_form');
	        $this->load->view('staff/other_footer');

		
		//}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($staff_privileges_course_management['course_mng_edit']) || $this->session->userdata('label')=="admin")){       
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $course_id != NULL && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){       
	           
	        $data['bodytitle']       =   "Course Modules Relation Management";
	        $data['faicon']          =   "fa-share-alt";
	        $data['breadcrumbtitle'] =   "Dashboard > Course Modules Relation Management";
	        $data['course'] 		 =    $this->course->get_name($course_id);
	        $data['l'] 				 = 	  (int) $this->input->get('l');
	        
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $course_id;
	        
			$data['level_module'] 	 =  $this->course_level->get_level_module($course_id);
			
			//$data['staff']			 = $this->staff->get_all();
	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/course_module_creation_form_edit');
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
	}

}

/* End of file course_module_relation_management_2.php */
/* Location: ./application/controllers/course_module_relation_management_2.php */
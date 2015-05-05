<?php
  
class Staff_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('semister');
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');            
      $this->load->model('staff');      
      $this->load->model('student_data','', TRUE); 	 
      $this->load->model('staff','', TRUE);       
}

public function index(){

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');  
	    $data['message']        =   "";
        $data['bodytitle']      =   "Add New Staff";
        $data['faicon']         =   "fa-user";
        $data['breadcrumbtitle']=   "Staff Management > Add New Staff";
        
/*	    //////////////////////////////////////////////////////	    
		/// get staff access
		if($this->session->userdata('label')=="staff"){
			$staff_privileges_staff_management = $data['staff_privileges_staff_management'] = $this->session->userdata('staff_privileges_staff_management');		
		}	    
	    /////////////////////////////////////////////////////*/         
        
    // alert count part
    
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;
    
    
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    
    // alert count part end    
    	$action = $this->input->get('action'); 
    	$id = $this->input->get('id');

 
        
        if($this->input->post('ref')=="edit" /*&& (!empty($staff_privileges_staff_management['staff_mng_edit']) || $this->session->userdata('label')=="admin")*/ ){
			
			$pass_change_on 	= FALSE;
			$pass_encrypt 		= "SHA1";			
			$id = $this->input->post('ref_id');
			$args['id'] 		= $id;
			
			
				/*@$std_ad="";
				@$staff_mng="";
				@$agent_mng="";
				@$ses_mng="";
				@$course_mng="";
				@$course_rel_mng="";
				@$report_mng="";
				@$inbox_mng="";
				@$exam_mng="";*/
			    //var_dump($_POST);
			foreach($this->input->post() as $k=>$v){

				 if($k!="privil" && $k!="ref" && $k!="ref_id"  && $k!="repassword"){ $$k=tinymce_encode($v); $args[$k] =$$k; }
				 else if($k=="privil") $args['staff_privileges'] =serialize($v);
				
				/*if($k=="std_ad"){
					$std_ad=$std_ad.'std_ad';				
				}else if($k=="std_ad_view_app"){
					$std_ad=$std_ad.',std_ad_view_app';
				}else if($k=="std_ad_edit_app"){
					$std_ad=$std_ad.',std_ad_edit_app';								
				}else if($k=="std_ad_comm"){
					$std_ad=$std_ad.',std_ad_comm';				
				}else if($k=="std_ad_english"){
					$std_ad=$std_ad.',std_ad_english';				
				}else if($k=="std_ad_interview"){
					$std_ad=$std_ad.',std_ad_interview';				
				}else if($k=="std_ad_status"){
					$std_ad=$std_ad.',std_ad_status';				
				}else if($k=="std_ad_agent"){
					$std_ad=$std_ad.',std_ad_agent';				
				}else if($k=="std_ad_notes"){
					$std_ad=$std_ad.',std_ad_notes';				
				}else if($k=="std_ad_archive"){
					$std_ad=$std_ad.',std_ad_archive';				
				}else if($k=="staff_mng"){
					$staff_mng=$staff_mng.'staff_mng';				
				}else if($k=="staff_mng_add"){
					$staff_mng=$staff_mng.',staff_mng_add';				
				}else if($k=="staff_mng_edit"){
					$staff_mng=$staff_mng.',staff_mng_edit';													
				}else if($k=="agent_mng"){
					$agent_mng=$agent_mng.'agent_mng';				
				}else if($k=="agent_mng_add"){
					$agent_mng=$agent_mng.',agent_mng_add';				
				}else if($k=="agent_mng_edit"){
					$agent_mng=$agent_mng.',agent_mng_edit';				
				}else if($k=="ses_mng"){
					$ses_mng=$ses_mng.'ses_mng';				
				}else if($k=="ses_mng_add"){
					$ses_mng=$ses_mng.',ses_mng_add';				
				}else if($k=="ses_mng_edit"){
					$ses_mng=$ses_mng.',ses_mng_edit';				
				}else if($k=="course_mng"){
					$course_mng=$course_mng.'course_mng';				
				}else if($k=="course_mng_add"){
					$course_mng=$course_mng.',course_mng_add';				
				}else if($k=="course_mng_edit"){
					$course_mng=$course_mng.',course_mng_edit';
				}else if($k=="course_rel_mng"){
					$course_rel_mng=$course_rel_mng.'course_rel_mng';				
				}else if($k=="course_rel_mng_add"){
					$course_rel_mng=$course_rel_mng.',course_rel_mng_add';				
				}else if($k=="course_rel_mng_edit"){
					$course_rel_mng=$course_rel_mng.',course_rel_mng_edit';						
				}else if($k=="report_mng"){
					$report_mng=$report_mng.'report_mng';
				}else if($k=="inbox_mng"){
					$inbox_mng=$inbox_mng.'inbox_mng';
				}else if($k=="exam_mng"){
					$exam_mng=$exam_mng.'exam_mng';															
				
				}else if($k!="ref" && $k!="ref_id"  && $k!="repassword"){
				 $$k=tinymce_encode($v); $args[$k] =$$k;  
				}*/
				
				
				
				
				
			}/// end of foreach($this->input->post() as $k=>$v){
			
			
				/*$args['staff_privileges_student_admission'] 			= $std_ad;	
				$args['staff_privileges_staff_management'] 				= $staff_mng;
				$args['staff_privileges_agent_management'] 				= $agent_mng;
				$args['staff_privileges_semister_management'] 			= $ses_mng;
				$args['staff_privileges_course_management'] 			= $course_mng;
				$args['staff_privileges_course_relation_management'] 	= $course_rel_mng;
				$args['staff_privileges_report_management'] 			= $report_mng;
				$args['staff_privileges_inbox_management'] 				= $inbox_mng;
				$args['staff_privileges_exam_management'] 				= $exam_mng;
				*/
							
			if($args['password']!=""){
				$pass_change_on 	= TRUE;
				$pass_encrypt 		= "MD5";     
				
			}
			//var_dump($args);			
			$insertedid=$this->staff->update($args,$pass_change_on,$pass_encrypt);
		       $data['error']=0; 
		       if($insertedid){
	       			
	       			$data['message'] = "<div class='alert alert-success'> staff has been successfully updated. </div>";	   
	       		   
			   }else{
				   
				    $data['message'] = "<div class='alert alert-warning'> staff can't be updated.</div>";	
			   }
			
			
        }else if($this->input->post('ref')=="add" /*&& (!empty($staff_privileges_staff_management['staff_mng_add']) || $this->session->userdata('label')=="admin")*/  ){
			
				//$id = $this->input->post('ref_id');				
				
				/*@$std_ad="";
				@$staff_mng="";
				@$agent_mng="";
				@$ses_mng="";
				@$course_mng="";
				@$course_rel_mng="";
				@$report_mng="";
				@$inbox_mng="";
				@$exam_mng="";*/
				//var_dump($_POST);			
				foreach($this->input->post() as $k=>$v){
					
					 if($k!="privil" && $k!="ref" && $k!="ref_id"  && $k!="repassword"){ $$k=tinymce_encode($v); $args[$k] =$$k; }
					 else if($k=="privil") $args['staff_privileges'] = serialize($v);	 
					/*if($k=="std_ad"){
						$std_ad=$std_ad.'std_ad';				
					}else if($k=="std_ad_view_app"){
						$std_ad=$std_ad.',std_ad_view_app';
					}else if($k=="std_ad_edit_app"){
						$std_ad=$std_ad.',std_ad_edit_app';								
					}else if($k=="std_ad_comm"){
						$std_ad=$std_ad.',std_ad_comm';				
					}else if($k=="std_ad_english"){
						$std_ad=$std_ad.',std_ad_english';				
					}else if($k=="std_ad_interview"){
						$std_ad=$std_ad.',std_ad_interview';				
					}else if($k=="std_ad_status"){
						$std_ad=$std_ad.',std_ad_status';				
					}else if($k=="std_ad_agent"){
						$std_ad=$std_ad.',std_ad_agent';				
					}else if($k=="std_ad_notes"){
						$std_ad=$std_ad.',std_ad_notes';				
					}else if($k=="std_ad_archive"){
						$std_ad=$std_ad.',std_ad_archive';				
					}else if($k=="staff_mng"){
						$staff_mng=$staff_mng.'staff_mng';				
					}else if($k=="staff_mng_add"){
						$staff_mng=$staff_mng.',staff_mng_add';				
					}else if($k=="staff_mng_edit"){
						$staff_mng=$staff_mng.',staff_mng_edit';				
					}else if($k=="staff_mng_chng_type"){
						$staff_mng=$staff_mng.',staff_mng_chng_type';				
					}else if($k=="staff_mng_chng_pass"){
						$staff_mng=$staff_mng.',staff_mng_chng_pass';				
					}else if($k=="agent_mng"){
						$agent_mng=$agent_mng.'agent_mng';				
					}else if($k=="agent_mng_add"){
						$agent_mng=$agent_mng.',agent_mng_add';				
					}else if($k=="agent_mng_edit"){
						$agent_mng=$agent_mng.',agent_mng_edit';				
					}else if($k=="ses_mng"){
						$ses_mng=$ses_mng.'ses_mng';				
					}else if($k=="ses_mng_add"){
						$ses_mng=$ses_mng.',ses_mng_add';				
					}else if($k=="ses_mng_edit"){
						$ses_mng=$ses_mng.',ses_mng_edit';				
					}else if($k=="course_mng"){
						$course_mng=$course_mng.'course_mng';				
					}else if($k=="course_mng_add"){
						$course_mng=$course_mng.',course_mng_add';				
					}else if($k=="course_mng_edit"){
						$course_mng=$course_mng.',course_mng_edit';
					}else if($k=="course_rel_mng"){
						$course_rel_mng=$course_rel_mng.'course_rel_mng';				
					}else if($k=="course_rel_mng_add"){
						$course_rel_mng=$course_rel_mng.',course_rel_mng_add';				
					}else if($k=="course_rel_mng_edit"){
						$course_rel_mng=$course_rel_mng.',course_rel_mng_edit';					
					}else if($k=="report_mng"){
						$report_mng=$report_mng.'report_mng';
					}else if($k=="inbox_mng"){
						$inbox_mng=$inbox_mng.'inbox_mng';
					}else if($k=="exam_mng"){
						$exam_mng=$exam_mng.'exam_mng';					
					}else if($k!="ref" && $k!="ref_id" && $k!="repassword"){ 
						$$k = tinymce_encode($v); $args[$k] = $$k;
					}*/
					
				}

			
				/*$args['staff_privileges_student_admission'] = $std_ad;	
				$args['staff_privileges_staff_management'] = $staff_mng;
				$args['staff_privileges_agent_management'] = $agent_mng;
				$args['staff_privileges_semister_management'] = $ses_mng;
				$args['staff_privileges_course_management'] = $course_mng;
				$args['staff_privileges_course_relation_management'] = $course_rel_mng;
				$args['staff_privileges_report_management'] = $report_mng;
				$args['staff_privileges_inbox_management'] = $inbox_mng;
				$args['staff_privileges_exam_management'] = $exam_mng;*/			
				/*$args['last_login_datetime'] = "";			
				$args['last_login_ip'] = "";			
				$args['pass_activate'] = "";*/
				$args['last_login_datetime'] = "";			
				$args['last_login_ip'] = "";			
				$args['pass_activate'] = "";							
						
			//var_dump($args);
			$insertedid=$this->staff->add($args,"MD5");
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> staff has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") /*&& (!empty($staff_privileges_staff_management['staff_mng']) || $this->session->userdata('label')=="admin")*/ ){
            
        $data['bodytitle']       =   "Staff Management";
        $data['faicon']          =   "fa-user";
        $data['breadcrumbtitle'] =   "Dashboard > Staff Management";
                             
        $data['staff_list'] = $this->staff->get_all();
        
        //var_dump($data['staff_list']);
            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/staff_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	}else if(!empty($varsessioncheck_id) && $action=="add" /*&& (!empty($staff_privileges_staff_management['staff_mng_add']) || $this->session->userdata('label')=="admin")*/  ){
	
        $data['bodytitle']       =   "Staff Management";
        $data['faicon']          =   "fa-user";
        $data['breadcrumbtitle'] =   "Dashboard > Staff Management";

        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/staff_body_form');
        $this->load->view('staff/other_footer');

	
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL /*&& (!empty($staff_privileges_staff_management['staff_mng_edit']) || $this->session->userdata('label')=="admin")*/ ){       
           
        $data['bodytitle']       =   "Staff Management";
        $data['faicon']          =   "fa-user";
        $data['breadcrumbtitle'] =   "Dashboard > Staff Management";
        
        $data['staff'] = $this->staff->get_by_ID($id);
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['staff']['id'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/staff_body_form');
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
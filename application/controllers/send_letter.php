<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_letter extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login','', TRUE);   
		$this->load->helper('functions');      
		$this->load->helper('form');      
		$this->load->library('session');            
		$this->load->model('lcc_inbox');          
		$this->load->model('lcc_communication'); 
		$this->load->model('student_data','', TRUE); 	 
		$this->load->model('student_data_extend','', TRUE); 	 
		$this->load->model('staff','', TRUE); 	  
		$this->load->model('course','', TRUE); 
		$this->load->model('semister','', TRUE); 
		$this->load->model('course_relation','', TRUE); 
		$this->load->model('class_plan','', TRUE);
		$this->load->model('coursemodule','', TRUE); 
		$this->load->model('semester_plan','', TRUE); 
		$this->load->model('time_plan','', TRUE); 
		$this->load->model('room_plan','', TRUE); 
		$this->load->model('class_lists','', TRUE); 
		$this->load->model('register','', TRUE); 
		$this->load->model('student_assign_class','', TRUE); 
		$this->load->model('attendance','', TRUE); 
		$this->load->model('settings','', TRUE); 
		$this->load->model('letter_set','', TRUE); 
		$this->load->model('signatory_set','', TRUE); 
		$this->load->model('status','', TRUE); 
		$this->load->model('student_information','', TRUE); 
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

                  if(!empty($staff_access['staff_privileges']['send_letter_management']) && count($staff_access['staff_privileges']['send_letter_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['send_letter_management'];                
                  else{ $priv[0] = ""; $priv[1] = ""; $priv[2] = ""; $priv[3] = ""; }

                                  
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
    	$class_plan_id			= $this->input->get('class_plan_id');
    	$page                   = $this->input->get('page');
    	$data['settings']		= $this->settings->get_settings();
    	$data['semester_list']  = $this->semister->get_all_by_des_order();
        $data['course_list']    = $this->course->get_all_by_course_name_asc();
        $data['status_list']    = $this->status->get_all();

        
        if($_POST){
        	
        	
        	
        	if($action=="search"){
								
					$terms = array();
					foreach($this->input->post() as $k=>$v){
						
						if($k!="ref" && $k!="ref_id"){  if(!empty($v)){ $$k=tinymce_encode($v); $terms[$k] = $$k; }  }
					}

					//var_dump($terms);
					$sesData = array();
				    $sesData['send_letter_student_list']['terms'] = $terms;
				    $this->session->set_userdata($sesData);
				    
				    					
				
        	}
        	
         	
        	
		}
        	  
	           
		if(!empty($varsessioncheck_id) && $action==""){

	        $data['bodytitle']       =   "Bulk Communications";
	        $data['faicon']          =   "fa-envelope";
	        $data['breadcrumbtitle'] =   "Dashboard > Bulk Communications"; 
	        $data['print_btn']		 =  "";
	        $data['staff_id']        =   $varsessioncheck_id;
	        
			
	        $data['ref'] = "";
			$data['ref_id'] = "";
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/send_letter_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="search" && ( !empty($priv[0]) || $this->session->userdata('label')=="admin" ) ){

	        $data['bodytitle']       =   "Bulk Communications";
	        $data['faicon']          =   "fa-envelope";
	        $data['breadcrumbtitle'] =   "Dashboard > Bulk Communications";
	        $data['staff_id']        =   $varsessioncheck_id;
			
	        $data['ref']    = "";
			$data['ref_id'] = "";
			
         	$sesData        =   $this->session->userdata("send_letter_student_list");
         	$terms          =   $sesData['terms'];

         	$data['result']=$this->student_information->makeStudentListWithpaginationToSendLetter($terms,$page,base_url()."index.php/send_letter/?action=search","yes");

         	//var_dump($terms); die();

      //    	$student_list = array();

      //    	if( !empty($terms['course_id']) && !empty($terms['semester_id']) && !empty($terms['coursemodule_list']) ) {

	     //     	$course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($terms['course_id'], $terms['semester_id']);

	         	
	         	

      //    		if(isset($terms['group']) && ($terms['group'] != "") ) {

      //    			$class_plan_id_list = $this->class_plan->get_by_course_relation_id_as_object_and_coursemodule_id_and_group_name($course_relation_id, $terms['coursemodule_list'],$terms['group']);

      //    		} else {

      //    			$class_plan_id_list = $this->class_plan->get_id_by_course_relation_id_and_coursemodule_id($course_relation_id, $terms['coursemodule_list']);

      //    		}
	         		
	         	

	     //     	$student_register_id_list = array();

	     //     	if (isset($class_plan_id_list) && (!empty($class_plan_id_list)) ) 
	     //     	{
	     //     		//var_dump($class_plan_id_list); die();
	     //     		foreach ($class_plan_id_list as $key => $value) 
	     //     		{
	     //     			$student_register_id_list[] = $this->student_assign_class->get_register_id_by_class_plan_id($value->id);
	     //     		}
	     //     	}

	     //     	$h = "";
	     //     	//var_dump($student_register_id_list); die();
	     //     	if(!empty($student_register_id_list)) {
		    //      	foreach ($student_register_id_list as $k => $v) {
		    //      		if(empty($v)) {
		    //      			unset($student_register_id_list[$k]);
		    //      		} else {
		    //      			foreach ($v as $x => $y) {
		    //      				$h .= $y['register_id'].",";
		    //      			}
		    //      		}
		    //      	}

	     //     		$student_list = explode(",", $h);
		         	
		    //     }
		    // }



      //    	if(!empty($student_list)) 
      //    	{
      //    		$data['clean_student_list'] = array_unique($student_list);	
      //    	} else {
      //    		$data['clean_student_list'] = array();
      //    	}
         	//var_dump($data['clean_student_list']); die();
         			 			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/send_letter_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="view_student_list"  ){

	        $data['bodytitle']       =   "Feed Attendance";
	        $data['faicon']          =   "fa-check-square-o";
	        $data['breadcrumbtitle'] =   "Dashboard > Print Class Routine > Feed Attendance"; 


	        $data['routine_date']    =   $this->session->userdata("print_routine_search");

	        $data['attendance']		 = $this->attendance->get_attendance_by_date_and_class_plan_id($data['routine_date']['terms']['date_class_list'], $class_plan_id );

	        if(!empty($data['attendance'])) {
	        	$data['attendance']		 = array_reverse($data['attendance']);
	        }

	       //var_dump($class_plan_id);
			if(!empty($class_plan_id)){ 
				$class_plan_data 			=	$this->class_plan->get_by_ID(intval($class_plan_id)); 
				$data['class_plan']			=   $class_plan_data;
				$data['student_data_list']	=	$this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));
				$data['attendance']		 = $this->attendance->get_attendance_by_date_and_class_plan_id($data['routine_date']['terms']['date_class_list'], $class_plan_id );

		        if(!empty($data['attendance'])) {
		        	$data['attendance']		 = array_reverse($data['attendance']);
		        }


			}
			//var_dump(expression)
			
			
	        $data['ref'] 					= "save_to_attendance";
	        $data['ref_id']					= "";			 
			 
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/assign_student_view_list_for_class_routine');
	        $this->load->view('staff/other_footer');	        
	        	        
                                                 
		
		}else if(!empty($varsessioncheck_id) && $action=="send_sms" ){


	       
			if(!empty($class_plan_id)){ 
				$class_plan_data 			=	$this->class_plan->get_by_ID(intval($class_plan_id)); 
				$data['class_plan']			=   $class_plan_data;
				$data['student_data_list']	=	$this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));
				$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($data['class_plan']['course_relation_id']);
				$course_name 	= $this->course->get_name($c_s_data['course_id']);
				$module_name 	= $this->coursemodule->get_name_by_id($data['class_plan']['coursemodule_id']);
				$group_name 	= $data['class_plan']['group_name'];
				$tutor_name 	= $this->staff->get_name($data['class_plan']['tutor_id']);
				$class_time 	= $this->time_plan->get_viewable_from_to_date_by_id($data['class_plan']['time_planid']);

				foreach ($data['student_data_list'] as $k => $v) {
					$notify_all_student_via_sms[] = $this->register->get_student_data_ID_no_by_id( $v['register_id'] );

				}

				if(!empty($notify_all_student_via_sms)) {
					foreach ($notify_all_student_via_sms as $k => $v) {
						$all_student_info_for_sms = $this->student_data->get_student_email_phone_first_last_name_by_ID($v);
						
						$student_full_name = $all_student_info_for_sms->student_first_name." ".$all_student_info_for_sms->student_sur_name;
						 $msg = "Dear $student_full_name. Today you have calss information below here: Course name: $course_name, Module name: $module_name, Group: $group_name, Time : $class_time, Tutor name: $tutor_name";
						send_sms_txt($all_student_info_for_sms->student_mobile_phone, $msg);
					}
				}
				$this->session->set_flashdata('message', "<div class='alert alert-success'> SMS has been successfully sent! </div>");
				
				redirect(base_url()."index.php/print_class_routine_management/?action=search");	 
			}


			
				        
	        	        
                                                 
		
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL){       
	           
	        $data['bodytitle']       =   "Assign Students Management";
	        $data['faicon']          =   "fa-plug";
	        $data['breadcrumbtitle'] =   "Dashboard > Assign Students Management";  
	        
	        $data['time_plan'] = $this->time_plan->get_by_ID($id);
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $data['time_plan']['id'];
	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/assign_student_body_form');
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
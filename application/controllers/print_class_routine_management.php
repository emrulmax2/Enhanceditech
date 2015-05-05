<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_class_routine_management extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login','', TRUE);   
		$this->load->helper('functions');      
		$this->load->helper('form');      
		$this->load->library('session');            
		$this->load->library('php_mailer');           
		$this->load->model('lcc_inbox');          
		$this->load->model('lcc_communication'); 
		$this->load->model('student_data','', TRUE); 	 
		$this->load->model('student_data_extend','', TRUE); 	 
		$this->load->model('staff','', TRUE); 	  
		$this->load->model('course','', TRUE); 
		$this->load->model('semister','', TRUE); 
		$this->load->model('course_relation','', TRUE); 
		$this->load->model('class_plan','', TRUE); 
		$this->load->model('semister','', TRUE); 
		$this->load->model('coursemodule','', TRUE); 
		$this->load->model('semester_plan','', TRUE); 
		$this->load->model('time_plan','', TRUE); 
		$this->load->model('room_plan','', TRUE); 
		$this->load->model('class_lists','', TRUE); 
		$this->load->model('register','', TRUE); 
		$this->load->model('student_assign_class','', TRUE); 
		$this->load->model('attendance','', TRUE); 
		$this->load->model('settings','', TRUE); 
        $this->load->model('student_information','', TRUE); 
        $this->load->model('email_issuing','', TRUE); 
        $this->load->model('sms_issuing','', TRUE); 
		$this->load->model('student_attendance_excuse','', TRUE); 
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
                  if(!empty($staff_access['staff_privileges']['print_class_routine_management']) && count($staff_access['staff_privileges']['print_class_routine_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['print_class_routine_management'];                
                  else{ $priv[0] = ""; $priv[1] = ""; $priv[2] = ""; $priv[3] = ""; $priv[4] = ""; }
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

        
        if($_POST){
        	
        	
        	
        	if($action=="search"){
								
					$terms = array();
					foreach($this->input->post() as $k=>$v){
						
						if($k!="ref" && $k!="ref_id"){  if(!empty($v)){ $$k=tinymce_encode($v); $terms[$k] = $$k; }  }
					}


					$sesData = array();
				    $sesData['print_routine_search']['terms'] = $terms;
				    $this->session->set_userdata($sesData);

				    					
				
        	}else{
                
				if($this->input->post('ref') && $this->input->post('ref') == "save_to_attendance") {
					$data['student_data_list']			=	$this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));
					
					// Start student list removing by attendence indicator
					for ($i=0; $i<count($data['student_data_list']); $i++):
					$registration_hr_no			= $this->register->get_registration_no_by_ID($data['student_data_list'][$i]["register_id"]);
					$Attandencechecked 			= $this->register->check_attendence_flag($registration_hr_no);
						if($Attandencechecked) {
						
						}else {
							unset($data['student_data_list'][$i]);
						}
					endfor;
					// End of student list removing					

					$attendance_date = date("Y-m-d", strtotime($this->input->post("attendance_date")));

					$day_id = $this->class_lists->get_id_by_date_and_class_plan_id($attendance_date, $this->input->post("class_plan_id") );

					$data['attendance']		 			= $this->attendance->get_attendance_by_date_and_class_plan_id($attendance_date, $class_plan_id );

					for ($i=1; $i <= count($data['student_data_list']); $i++) { 
						
						$args = array();
						$args['day_id'] 				= $day_id;
						$args['attendance_date'] 		= $attendance_date;
						$args['class_plan_id'] 			= $this->input->post("class_plan_id");
						$args['register_id'] 			= $this->register->get_id_by_student_registration_no( $this->input->post("registration_no_$i") );
						$args['attendance_type'] 		= ($this->input->post("attendance_type_$i")) ? $this->input->post("attendance_type_$i") : "A";
						$args['notify_email'] 			= ($this->input->post("notify_email_$i")) ? $this->input->post("notify_email_$i") : 0;
						$args['notify_sms'] 			= ($this->input->post("notify_sms_$i")) ? $this->input->post("notify_sms_$i") : 0;
						$args['notofication_date'] 		= date('y-m-d H:i:s');
						$args['notofied_by'] 			= $this->session->userdata('uid');
						$args['attendence_excuse_id'] 	= 0;
                        
                        $check_excuse = $this->student_attendance_excuse->get_by_register_id($args['register_id']);
                        $student_excused_day_list = array();
                        if(!empty($check_excuse)) {
                            foreach($check_excuse as $k=>$v) {
                                $date_list = unserialize($v['day_id']);
                                foreach($date_list as $vv) {
                                    $d = explode("_",$vv);
                                    $student_excused_day_list[] = $d[0];
                                }
                            }
                        }
                        if(in_array($args['day_id'], $student_excused_day_list)) {
                            $args['attendance_type'] = "E";
                        }
						
						if(empty($data['attendance'])) {
							$insertedid[]				=$this->attendance->add($args);
						} else {
							$args['id'] 				= $this->input->post("attendance_id_$i");
							$insertedid[]				=$this->attendance->update($args);
						}



						//Start Storing student attendance to stored_attendance table with calculating attendance.						

                        $calculate_persentage  = 0;
                        
                             
                        $attendance_info = array();

                        $attendance_info[] = $this->attendance->get_attendance_list_by_register_id($args['register_id']);
                        

                        if(!empty($attendance_info)) {

                            
                            foreach($attendance_info as $m=>$n) {

                                if($n!=NULL) {                                    

                                    $total_class = count($n);
                                    $total_present = array();
                                    $total_absent  = array();
                                    $present = "";

                                    if(!empty($n) || $n != NULL) {
                                        foreach ($n as $c => $d) {
                                           
                                            
                                            if($d['attendance_type'] == "P") {
                                              $total_present[] = "p";
                                            }

                                            if($d['attendance_type'] == "A") {
                                              $total_absent[] = "A";
                                            }
                                            
                                        }
                                    
                                    }

                                    $student_id = $this->register->get_student_data_ID_no_by_id($args['register_id']);
                                    

                                    $present = count($total_present);

                                    if($present != 0) {
                                        $calculate_persentage = ($present / $total_class ) * 100;
                                      
                                        $clc = number_format( $calculate_persentage,2);
                                    } elseif($present == 0) {
                                        $clc =  "0.00";
                                    }
                                    
                                    $storing_attendance_percent = array();

                                    $storing_attendance_percent['student_data_id'] = $student_id;
                                    $storing_attendance_percent['registration_id'] = $args['register_id'];
                                    $storing_attendance_percent['attendance_parcent'] = $clc;

                                    
                                    $this->student_information->update_attendance_parcent($storing_attendance_percent);
                                    

                                }
                            }
                        }
                                  
                        //Enbd of Storing student attendance to stored_attendance table with calculating attendance.



						if($this->input->post("notify_email_$i") != "") {
							$notify_via_email[] = $this->register->get_student_data_ID_no_by_registration( $this->input->post("registration_no_$i") );
						}
						if($this->input->post("notify_sms_$i") != "") {
							$notify_via_sms[] = $this->register->get_student_data_ID_no_by_registration( $this->input->post("registration_no_$i") );
						}

					}

					if( count($data['student_data_list']) == count($insertedid) ) {

						if(!empty($notify_via_email)) {
							foreach ($notify_via_email as $key => $value) {
								$student_info = $this->student_data->get_student_email_phone_first_last_name_by_ID($value);
								
								$student_full_name = $student_info->student_first_name." ".$student_info->student_sur_name;
								$to = $student_info->student_email; 

			                    $sub = "Class Absence Notification!";

			                    $msg = "Dear $student_full_name <br /><br /> You missed today's class. More information below here.<br /> <br /> <br /> Course name: ".$this->input->post('course_name')." <br /> Module name: ".$this->input->post('module_name')." <br /> Group: ".$this->input->post('group_name')." <br /> Time : ".$this->input->post('class_time')." <br /> Tutor name: ".$this->input->post('tutor_name')." <br /> <br />";

			                    $from = $data['settings']['company_name']." <".$data['settings']['smtp_user'].">";

			                    makeHtmlEmailExtend($to,$sub,$msg,$from,$data['settings']['smtp_user'],$data['settings']['smtp_pass'],$data['settings']['smtp_host'],$data['settings']['smtp_port'],$data['settings']['smtp_encryption'],$data['settings']['smtp_authentication'],$data['settings']['company_name']);
                                // start email notification database intput
                                /*$email_args=array();
                                $email_args['student_data_id']      = $value; 
                                $email_args['subject']              = $sub; 
                                $email_args['description']          = $msg; 
                                $email_args['issued_by']            = $this->session->userdata('uid'); 
                                $email_args['issued_date']          = date("Y-m-d"); 
                                $this->email_issuing->add($email_args);*/
                                //end email notification database input
							}
						}

						if(!empty($notify_via_sms)) {
							foreach ($notify_via_sms as $k => $v) {
                                
                                $routine    =   $this->session->userdata("print_routine_search");
                                $_date      =   hr_date($routine["terms"]["date_class_list"]);
                                
								$student_info_for_sms = $this->student_data->get_student_email_phone_first_last_name_by_ID($v);
								$student_full_name = $student_info_for_sms->student_first_name." ".$student_info_for_sms->student_sur_name;
								$msg = "Dear $student_full_name. You missed today's class. Date: $_date Module name:".$this->input->post('module_name').",Group:".$this->input->post('group_name').",Time: ".$this->input->post('class_time');

								send_sms_txt($student_info_for_sms->student_mobile_phone, $msg);
                                //start sms notification database input
                                /*$sub = "Class Absence Notification!";
                                $sms_args=array();
                                $sms_args['student_data_id']      = $v; 
                                $sms_args['phone']                = $student_info_for_sms->student_mobile_phone; 
                                $sms_args['subject']              = $sub; 
                                $sms_args['description']          = $msg; 
                                $sms_args['issued_by']            = $this->session->userdata('uid'); 
                                $sms_args['issued_date']          = date("Y-m-d H:i:s"); 
                                $this->sms_issuing->add($sms_args);*/
                                //end sms notification database input
							}
						}

						$data['message'] = "<div class='alert alert-success'> Attendance has been successfully saved! </div>";
					}
				}
				
        	}	
        	
         	
        	
		}
        
        
	         
	  
	           
		if(!empty($varsessioncheck_id) && $action==""){

	        $data['bodytitle']       =   "Class Routine";
	        $data['faicon']          =   "fa-calendar";
	        $data['breadcrumbtitle'] =   "Dashboard > Class Routine"; 
	        $data['print_btn']		 =  "";

			
	        $data['ref'] = "";
			$data['ref_id'] = "";
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/print_class_routine_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="search"){

	        $data['bodytitle']       =   "Print Class Routine";
	        $data['faicon']          =   "fa-print";
	        $data['breadcrumbtitle'] =   "Dashboard > Print Class Routine";

			
	        $data['ref']    = "";
			$data['ref_id'] = "";
			
         	$sesData        =   $this->session->userdata("print_routine_search");
         	$terms          =   $sesData['terms'];

		 	$data['result'] =   $this->class_plan->makePrintClassListWithpagination($terms,$page,base_url()."index.php/print_class_routine_management/?action=search","yes");

		 	$data['print_btn'] = "<a class='btn btn-md btn-warning btn-assign-student' href='".base_url()."index.php/print_class_routine_search_result'><i class=\"fa fa-print\"></i> Print Class</a>";
		 			
			

	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/print_class_routine_body_form');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="view_student_list"){
						
	        $data['bodytitle']       =   "Feed Attendance";
	        $data['faicon']          =   "fa-check-square-o";
	        $data['breadcrumbtitle'] =   "Dashboard > Print Class Routine > Feed Attendance"; 


	        $data['routine_date']    =   $this->session->userdata("print_routine_search");

	        $data['attendance']		 = $this->attendance->get_attendance_by_date_and_class_plan_id($data['routine_date']['terms']['date_class_list'], $class_plan_id );

	        if(!empty($data['attendance'])) {
	        	$data['attendance']		 = array_reverse($data['attendance']);
	        }

			if(!empty($class_plan_id)){ 
				$class_plan_data 			=	$this->class_plan->get_by_ID(intval($class_plan_id)); 
				$data['class_plan']			=   $class_plan_data;
				$data['student_data_list']	=	$this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));
				
				// Start student list removing by attendence indicator
				for ($i=0; $i<count($data['student_data_list']); $i++):
				$registration_hr_no			= $this->register->get_registration_no_by_ID($data['student_data_list'][$i]["register_id"]);
				$Attandencechecked 			= $this->register->check_attendence_flag($registration_hr_no);
					if($Attandencechecked) {
					
					}else {
						unset($data['student_data_list'][$i]);
					}
				endfor;
				// End of student list removing
				
				$data['attendance']		 = $this->attendance->get_attendance_by_date_and_class_plan_id($data['routine_date']['terms']['date_class_list'], $class_plan_id );

		        if(!empty($data['attendance'])) {
		        	$data['attendance']		 = array_reverse($data['attendance']);
		        }

				
			}
			
	        $data['ref'] 					= "save_to_attendance";
	        $data['ref_id']					= "";			 
			 
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/assign_student_view_list_for_class_routine');
	        $this->load->view('staff/other_footer');	        
	        	        
                                                 
		
		}else if(!empty($varsessioncheck_id) && $action=="send_sms"){


	       
			if(!empty($class_plan_id)){ 
				$class_plan_data 			=	$this->class_plan->get_by_ID(intval($class_plan_id)); 
				$data['class_plan']			=   $class_plan_data;
				$data['student_data_list']	=	$this->student_assign_class->get_by_class_plan_id(intval($class_plan_id));
				
				$c_s_data  			= $this->course_relation->get_course_ID_semester_ID_by_ID($data['class_plan']['course_relation_id']);
				$course_name 		= $this->course->get_name($c_s_data['course_id']);
				$module_name 		= $this->coursemodule->get_name_by_id($data['class_plan']['coursemodule_id']);
				$group_name 		= $data['class_plan']['group_name'];
				$tutor_name 		= $this->staff->get_name($data['class_plan']['tutor_id']);
				$class_time 		= $this->time_plan->get_viewable_from_to_date_by_id($data['class_plan']['time_planid']);
				$registration_hr_no = "";
				
				foreach ($data['student_data_list'] as $k => $v) {
					$notify_all_student_via_sms[] 	= 	$this->register->get_student_data_ID_no_by_id( $v['register_id'] );
					$registration_hr_no				=	$this->register->get_registration_no_by_ID($v['register_id']);
				}

				if(!empty($notify_all_student_via_sms)) {
					foreach ($notify_all_student_via_sms as $k => $v) {
					    
					    $routine=$this->session->userdata("print_routine_search");
						$_date = hr_date($routine["terms"]["date_class_list"]);
						
						$all_student_info_for_sms 	= $this->student_data->get_student_email_phone_first_last_name_by_ID($v);
						$student_full_name 			= $all_student_info_for_sms->student_first_name." ".$all_student_info_for_sms->student_sur_name;
						$msg = "Dear $student_full_name . Your class notification below: Date: $_date Module name: $module_name, Group: $group_name, Time : $class_time .";
						$Attandencechecked 			= $this->register->check_attendence_flag($registration_hr_no);
						 if($Attandencechecked) {
							send_sms_txt($all_student_info_for_sms->student_mobile_phone, $msg);
                            
                                //start sms notification database input
                                /*$sub = "Class Notification!";
                                $sms_args=array();
                                $sms_args['student_data_id']      = $v; 
                                $sms_args['phone']                = $all_student_info_for_sms->student_mobile_phone; 
                                $sms_args['subject']              = $sub; 
                                $sms_args['description']          = $msg; 
                                $sms_args['issued_by']            = $this->session->userdata('uid'); 
                                $sms_args['issued_date']          = date("Y-m-d H:i:s"); 
                                $this->sms_issuing->add($sms_args);*/
                                //end sms notification database input
                            
                            
						 }
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

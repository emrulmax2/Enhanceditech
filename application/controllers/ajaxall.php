<?php
class Ajaxall extends CI_Controller {   
    
   function __construct() {
  
      parent::__construct();

  		$this->load->model('login','', TRUE);     
  		$this->load->model('course_relation','', TRUE);     
  		$this->load->model('course','', TRUE);     
      $this->load->model('semister','', TRUE);     
      $this->load->model('student_data','', TRUE);     
      $this->load->model('student_upload','', TRUE);     
      $this->load->model('staff','', TRUE);    
      $this->load->model('notes','', TRUE);     
      $this->load->model('staff_upload','', TRUE);    
  	  $this->load->model('lcc_communication','', TRUE);      
      $this->load->model('lcc_inbox','', TRUE);     
      $this->load->helper('functions');     
  	  $this->load->helper('form');     
      $this->load->library('session');
      $this->load->library('php_mailer');
  	  $this->load->library('pdf');
  	  $this->load->model('archive');
      $this->load->model('letter_issuing');
      $this->load->model('email_issuing');
  	  $this->load->model('sms_issuing');
  	  $this->load->model('letter_set');
      $this->load->model('signatory_set');
      $this->load->model('student_gender');
      $this->load->model('student_title');
      $this->load->model('country');
      $this->load->model('student_others_ethnicity');
      $this->load->model('student_others_disabilities');
  	  $this->load->model('student_marital_status');
      $this->load->model('register');
      $this->load->model('semester_plan');
      $this->load->model('time_plan');
      $this->load->model('room_plan');
      $this->load->model('class_plan');
      $this->load->model('coursemodule');
      $this->load->model('course_level');
      $this->load->model('class_lists');
      $this->load->model('modules');
      $this->load->model('settings');
      $this->load->model('status');
      $this->load->model('student_assign_class');
      $this->load->model('examresult');
      $this->load->model('examresult_archive');
      $this->load->model('student_attendance_excuse');
      $this->load->model('attendance');
      $this->load->model('slc_coursecode','', TRUE);                                   
      $this->load->model('agreement','', TRUE);                                   
      $this->load->model('installment','', TRUE);     
      $this->load->model('attendance_history','', TRUE);      
      $this->load->model('coc_history','', TRUE);     
      $this->load->model('registration_history','', TRUE);  		
      $this->load->model('agreement','', TRUE);  		
      $this->load->model('money_receipt','', TRUE);     
      $this->load->model('student_information','', TRUE);     
      $this->load->model('job_department','', TRUE);      
      $this->load->model('jobs','', TRUE);  		
      $this->load->model('job_induction','', TRUE);  		
      $this->load->model('job_induction_process','', TRUE);  		
      $this->load->model('job_assign','', TRUE);      
      $this->load->model('attendance_notify','', TRUE);     
      $this->load->model('job_type','', TRUE);      
      $this->load->model('job_applied_student','', TRUE);     
      $this->load->model('currency','', TRUE);      
      $this->load->model('awarding_body','', TRUE);          
      $this->load->model('hesa_class','', TRUE);          
      $this->load->model('hesa_courseaim','', TRUE);          
      $this->load->model('hesa_disall','', TRUE);          
      $this->load->model('hesa_exchind','', TRUE);          
      $this->load->model('hesa_genderid','', TRUE);          
      $this->load->model('hesa_heapespop','', TRUE);          
      $this->load->model('hesa_locsdy','', TRUE);          
      $this->load->model('hesa_mode','', TRUE);          
      $this->load->model('hesa_notact','', TRUE);          
      $this->load->model('hesa_priprov','', TRUE);          
      $this->load->model('hesa_qual','', TRUE);          
      $this->load->model('hesa_regbody','', TRUE);          
      $this->load->model('hesa_relblf','', TRUE);          
      $this->load->model('hesa_rsnend','', TRUE);          
      $this->load->model('hesa_sexort','', TRUE);          
      $this->load->model('hesa_sselig','', TRUE);          
      $this->load->model('hesa_ttcid','', TRUE);          
      $this->load->model('hesa_student_information','', TRUE);      
      $this->load->model('campus_info','', TRUE);          
      $this->load->model('coc_upload','', TRUE);          
      $this->load->model('Hesa_unitlgth','', TRUE);     
      $this->load->model('hesa_sbjca','', TRUE);      
      $this->load->model('hesa_subject_of_course','', TRUE);      
      $this->load->model('hesa_previnst','', TRUE);     
      $this->load->model('hesa_qualtype','', TRUE);     
      $this->load->model('hesa_qualsbj','', TRUE);      
      $this->load->model('hesa_qualsit','', TRUE);      
      $this->load->model('hesa_domicile','', TRUE);     
      $this->load->model('hesa_stuload_student_info','', TRUE);     
      $this->load->model('hesa_mstufee','', TRUE);     
      $this->load->model('hesa_qualent3','', TRUE);          
      $this->load->model('exam_result_prev','', TRUE);          
      $this->load->model('attendancearchive','', TRUE);          
      $this->load->model('academicsession','', TRUE);  		


            
      }
      public function index(){
            
   		  $settings			=	$this->settings->get_settings();
		  
		  if($_POST['action']=="forgetpassword") {
		  	  
		  	  $email = $_POST['email'];
		  	  
		  	  $usertype = $this->login->checkUserType($email);
		  	  
              if($usertype!="") {
                  /**
                  *  MAil senting not finishing
                  * 
                  * 
                  */
                //  makeHtmlEmail($to,$sub,$mess,$from);
                
	                $new_pass = makeRandom();
	                $new_pass_md5 = md5($new_pass);
	                
	                if($usertype=="student" || $usertype=="registered"){
	                	
	                	$std_data = $this->student_data->get_by_EMAIL($email);
	                	
	                	
			            $to = $email;
			            $sub = "New password request from ".$settings['company_name']." account.";
			            $msg = "Dear user,\n Recently you have requested to change your password.\n <a href='".base_url()."index.php/password_retrive/?ret=$new_pass_md5'>Click here to reset your password.</a>";
			            $msg .= "\nAvoid this message, if you did not request to reset password.";
			            
			            $from = $settings['company_name']." Staff <".$settings['smtp_user'].">";
			            //makeHtmlEmail($to,$sub,$msg,$from);	                	
	                	
	                	makeHtmlEmailExtend($to,$sub,$msg,$from,$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);
	                	
	                	
	                	//$data['passsword'] = $new_pass;
	                	$data['id'] = $std_data['id'];
	                	$data['pass_activate'] = $new_pass_md5;
	                	
	                	
	                	 //var_dump($data);
	                	
						$this->student_data->update($data);
						
	                }else{
	                	
	                	
	                	$stf_data = $this->staff->get_by_EMAIL($email);
	                	
	                	
			            $to = $email;
			            $sub = "New password request from ".$settings['company_name']." account.";
			            $msg = "Dear user,\n Recently you have requested to change your password.\n <a href='".base_url()."index.php/password_retrive/?ret=$new_pass_md5'>Click here to reset your password.</a>";
			            $msg .= "\nAvoid this message, if you did not request to reset password.";
			            $from = $settings['company_name']." Staff <".$settings['smtp_user'].">";                	
	                	makeHtmlEmailExtend($to,$sub,$msg,$from,$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);
	                	$data['id'] 			= $stf_data['id'];
	                    $data['pass_activate'] 	= $new_pass_md5;
	                	
	                	
	                	
	                	
						$this->staff->update($data);	                	
						
	                }
	                	
                
                
                
                  echo "An email sent to your email account. Please check mail for details.";
                  
              } else {
                  echo "not_found";
              }

			  
			  
		  } else if($_POST['action']=="courselists"){
                
                $semester_ID = $_POST['semester_id'];
                $html = '<div class="form-group clearfix">
                                       <div class="col-sm-4 no-pad-left col-md-offset-1">
                                        <label>Course <small class="red-link">*</small> : </label>
                                        </div>
                                        <div class="col-sm-4 no-pad-right">
                                        <select name="student_course"  class="form-control" required>
                                            <option value="">Please select</option>';
              
                $courselists=$this->course_relation->get_courselistby_semesterid($semester_ID);
              if(isset($courselists) and count($courselists)>0 and is_array($courselists))
              {
              foreach($courselists as $ID => $name):
                                        
                  $html.="<option value=\"$ID\"> $name</option>";
                                                    
                                    
              endforeach;
              
              $html.='</select></div></div>';
              echo $html;
              } else { echo "not_found"; }
              
              
              
          } else if($_POST['action']=="changestate"){
		  	  
                $changestate    	= $_POST['change_state'];
                $args["id"]     	= $_POST['id'];
                $rejected_reason  = $_POST['rej_reason'];
                $student_status_admission_hesa_reason_id 	= $_POST['student_status_admission_hesa_reason_id'];
                
                if(!empty($rejected_reason)) $args["student_admission_status_rejected_reason"] = $rejected_reason;
                
            $args["student_admission_status_review_staff_id"]     = $_POST['staffid']*1;
		  	    

                $html ="";
                $staff_state = $args["student_admission_status_for_staff"] = $changestate;
                 if($staff_state=="Review"){
                      $args["student_admission_status"] = "Review";
                     }else if($staff_state=="Processing"){
                      $args["student_admission_status"] = "Processing";
                     }else if($staff_state=="Refer to academic department"){
                      $args["student_admission_status"] = "Processing";
                     }else if($staff_state=="Accepted"){
                      $args["student_admission_status"] = "Accepted";
					  $args["student_admission_status_rejected_reason"]="";
                     }else if($staff_state=="Rejected for review"){
                      $args["student_admission_status"] = "Processing";
                     }else if($staff_state=="Rejected"){
                      $args["student_admission_status"] = "Rejected";
                     }else if($staff_state=="New"){
                      $args["student_admission_status"] = "Submitted";
                     }else if($staff_state=="Discarded"){
                      $args["student_admission_status"] = "Discarded";
                     }else if($staff_state=="Awaiting Documents"){
                      $args["student_admission_status"] = "Awaiting Documents";
                     }
                
                if(!empty($args["student_admission_status_review_staff_id"]))
                {
                    $args2=array("communication_id"=>0,"student_data_id"=>0,"staff_id"=>0,"notification_type"=>"communication","notification_from"=>"staff","notification_to"=>"student","notification_to_staff_id"=>0,"notification_checked"=>"no","entry_date"=>date("Y-m-d H:i:s",time()),"dt"=>"","is_trash"=>0);
                    $args2["student_data_id"]           = $args["id"];
                    $args2["staff_id"]                  = $this->session->userdata('uid');
                    $args2["notification_type"]         = "review";
                    $args2["notification_from"]         = "staff";
                    $args2["notification_to"]           = "staff";
                    $args2["notification_to_staff_id"]  = $args["student_admission_status_review_staff_id"]*1;
                    $args2["dt"]                        = tohrdatetime(date("Y-m-d H:i:s",time()));
                    $this->lcc_inbox->add($args2);
                    
                }
                $studen_prev_info =array();
                $studen_prev_info = $this->student_data->get_studentdata_for_edit($args["id"]);
        $args["student_status_admission_hesa_reason_id"]     = $student_status_admission_hesa_reason_id;
                
			   
         $affectedrow = $this->student_data->update_app($args);
         //$this->student_data->update_app($args);
        // var_dump($affectedrow);
              
        //$affectedrow = 1;
              if($affectedrow>0){
            //var_dump(); die();   
                      if($changestate == "Offer accepted") 
                      {
                        $status_id_for_new = $this->status->get_id_by_status_NEW();
                        $reg_id            = $this->register->get_id_by_student_data_ID($_POST['id']);
                        // var_dump($reg_id); die();
                        $arr = array();
                        
                        //var_dump($reg_id);

                        if($reg_id != null) {
                          $student_info      = $this->student_information->get_by_student_data_id_and_registration_no($_POST['id'],$reg_id);
                          //var_dump($student_info);
                          if($student_info == NULL ) {
                            $arr['registration_id'] = $reg_id;
                            $arr['student_data_id'] = $_POST['id'];
                            $arr['status']          = $status_id_for_new;
                            $arr['current_year']    = date("Y");

                            $this->student_information->add($arr);
                          }
                        }
                       
                      }
                    
					//$html = '1';
                    $already_has		=	0; 
					$archive_count		=	0;	

                   // var_dump($studen_prev_info);
										if($studen_prev_info["student_admission_status_rejected_reason"]!=""){
											$studen_prev_info["student_admission_status_for_staff"]= " (".$studen_prev_info["student_admission_status_for_staff"].") ".$studen_prev_info["student_admission_status_rejected_reason"];	
										}
			                            $archive_change[$archive_count] = array( 
			                                "student_data_id"              => $args["id"],
			                                "staff_id"                     => $this->session->userdata('uid'),
			                                "archive_field_name"           => "student_admission_status",
			                                "archive_field_value"          => $args["student_admission_status_for_staff"],
			                                "archive_field_previous_value" => $studen_prev_info["student_admission_status_for_staff"],
			                                "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
			                                "entry_date"                   => date("Y-m-d h:i:s",time()),
			                                );
			                            $archive_count++;
                                        
                                        if($args["student_status_admission_hesa_reason_id"] == 0) 
                                        $current_hesa_reason = "none";
                                        else
                                        $current_hesa_reason = $this->hesa_rsnend->get_name_by_id($args["student_status_admission_hesa_reason_id"]);
 
                                       //$studen_prev_info = $this->student_data->get_studentdata_for_edit($args["id"]);
                                       
                                        //var_dump($studen_prev_info);
                                        if($studen_prev_info["student_status_admission_hesa_reason_id"] == 0)
                                        $previous_hesa_reason = "none";
                                        else
                                        $previous_hesa_reason = $this->hesa_rsnend->get_name_by_id($studen_prev_info["student_status_admission_hesa_reason_id"]);
                                        
                                        
                                        $archive_change[$archive_count] = array( 
                                            "student_data_id"              => $args["id"],
                                            "staff_id"                     => $this->session->userdata('uid'),
                                            "archive_field_name"           => "student_admission_status_HESA_reason",
                                            "archive_field_value"          => $current_hesa_reason,
                                            "archive_field_previous_value" => $previous_hesa_reason,
                                            "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
                                            "entry_date"                   => date("Y-m-d h:i:s",time()),
                                            );                                        											
									     $archive_count++; 
							
														
                        
						if($archive_count >0) {
                                foreach($archive_change as $archive_data):
                                //var_dump($archive_data);
                                    $this->archive->add($archive_data);
                                endforeach;
                            } 
                        
                        
                        
					
			  }       
	          
	          //var_dump($archive_change);
	          echo $affectedrow;
			  //echo $html;
			  			  
			  
			  
		  }else if($_POST['action']=="change_student_status"){
          
          $changestate                = $_POST['change_state'];
          $student_status_hesa_reason_id                = $_POST['student_status_hesa_reason_id'];
          $status_change_reason                = tinymce_encode($_POST['status_change_reason']);

          $args["student_data_id"]    = $_POST['id'];
          $args["status"]             = $changestate;
          $args["status_change_reason"]             = $status_change_reason;
          $args["student_status_hesa_reason_id"]             = $student_status_hesa_reason_id;
          $registration_id            = $this->register->get_id_by_student_data_ID($args["student_data_id"]);
          
          $html ="";
                          
          $studen_prev_info =array();
          $studen_prev_info = $this->student_information->get_by_student_data_id($args["student_data_id"]);

          if(!empty($studen_prev_info)) 
          {
            $affectedrow = $this->student_information->update_by_student_data_id($args);
            
          } 
          else 
          {
            $args['registration_id'] = $registration_id;
            $args['current_year']    = date("Y");

            $affectedrow = $this->student_information->add($args);
          }

         
          

          if( $affectedrow > 0 ) {  
    
            $already_has      = 0; 
            $archive_count    = 0;  

              
              $archive_change[$archive_count] = array( 
                  "student_data_id"              => $args["student_data_id"],
                  "staff_id"                     => $this->session->userdata('uid'),
                  "archive_field_name"           => "student_status",
                  "archive_field_value"          => $changestate,
                  "archive_field_previous_value" => !empty($studen_prev_info) ? $studen_prev_info->status : "",
                  "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
                  "entry_date"                   => date("Y-m-d h:i:s",time()),
                  );
              $archive_count++;
              
              $archive_change[$archive_count] = array( 
                  "student_data_id"              => $args["student_data_id"],
                  "staff_id"                     => $this->session->userdata('uid'),
                  "archive_field_name"           => "status_change_reason",
                  "archive_field_value"          => $status_change_reason,
                  "archive_field_previous_value" => !empty($studen_prev_info) ? $studen_prev_info->status_change_reason : "",
                  "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
                  "entry_date"                   => date("Y-m-d h:i:s",time()),
                  );
              $archive_count++;              
              
              
            if($args["student_status_hesa_reason_id"] == 0) 
            $current_hesa_reason = "none";
            else
            $current_hesa_reason = $this->hesa_rsnend->get_name_by_id($args["student_status_hesa_reason_id"]);

            if($studen_prev_info->student_status_hesa_reason_id == 0)
            $previous_hesa_reason = "none";
            else
            $previous_hesa_reason = $this->hesa_rsnend->get_name_by_id($studen_prev_info->student_status_hesa_reason_id);


            $archive_change[$archive_count] = array( 
                "student_data_id"              => $args["student_data_id"],
                "staff_id"                     => $this->session->userdata('uid'),
                "archive_field_name"           => "student_status_hesa_reason",
                "archive_field_value"          => $current_hesa_reason,
                "archive_field_previous_value" => $previous_hesa_reason,
                "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
                "entry_date"                   => date("Y-m-d h:i:s",time()),
                );                                                                                    
             $archive_count++;              
          
                  
              if($archive_count >0) {
                  foreach($archive_change as $archive_data):
                      $this->archive->add($archive_data);
                  endforeach;
              }

              $html = "1";
    
          }
      
      
          echo $html;
        
                
        
        
      } else if($_POST['action']=="uploadstaffstate"){
              $html = "";
              
                  $args["filename"]             = $_POST['filename'];
                  $args["filepath"]             = "uploads/files/".$_POST['documentfile'][0];
                  $args["check_hard_copy_doc"]  = $_POST['checkhardcopy'];
                  $args["reason"]               = $_POST['reason'];
                  $args["filename"]             = $_POST['filename'];
                  $args["student_data_id"]      = $_POST['id'];
                  $args["staff_id"]             = $_POST['staff_id'];
                  $args["datetime"]             = tohrdatetime(date("Y-m-d H:i:s",time()));
                  $args["serial"]               = $this->staff_upload->get_next_serial($args["student_data_id"]);
                  
                  $insertid = $this->staff_upload->add($args);
               
             if($insertid>0)  $html = $insertid ;
              
              echo $html;
                  
              
          } else if($_POST['action']=="update_std_info"){
              $html = "";
              $affectedrow = 0;
              $new_affect = 0;
                  $student_id             = $this->student_data->user_id = $_POST['student_id'];
                  $email                  = $_POST['email'];
                  $md5password            = md5($_POST['cnfpassword']);
                  $sha1password           = sha1($_POST['cnfpassword']);
                  $new_password           = $_POST['password'];
                  //var_dump($new_password);
                  $std_info = $this->student_data->get_all_by_ID($student_id);
            
                  if(($md5password == $std_info['password']) OR ($sha1password == $std_info['password']))
                  {
                    $args = array();
                    $args['id'] = $student_id;
                    $args['student_email'] = $email;
                    $affectedrow = $this->student_data->update_email($args);
                    if($new_password!="" && strlen($new_password) > 0 ) {
                        $new_affect = $this->student_data->update(array("password"=>$new_password),TRUE);
                        
                    }
                  }

             if($affectedrow==1 || $new_affect==1)  {
                $html = '1' ;
              }
              
              echo $html;     
              
          }else if($_POST['action']=="update_awarding_body_ref"){
              $html = "";
              $affectedrow = 0;
              
                  $student_id             = $_POST['student_id'];
                  $awarding_body          = $_POST['awarding_body'];
                  //var_dump($new_password);
            
                  
                    $args = array();
                    $args['student_data_id'] = $student_id;
                    $args['awarding_body_ref'] = $awarding_body;
                    $affectedrow = $this->student_information->update_by_student_data_id($args);
                    
                  

             if($affectedrow==1)  {
                $html = '1' ;
              }
              
              echo $html;     
              
          }else if($_POST['action']=="apply_job"){
            //var_dump("expression"); die();
              $html = "";
              $affectedrow = 0;
              

                  $job_id         = $_POST['job_id'];
                  $issued_date    = $_POST['issued_date'];
                  $price          = $_POST['price'];
                  $files          = serialize($_POST['files']);
                  $student_data_id=$this->session->userdata('uid');

                  

                  
                  

                  //var_dump($job_id); die();

                  if($issued_date=="yes") {
                    $issued_date = $due_date = date("Y-m-d", time());
                  } else {
                    $due_date = date("Y-m-d", strtotime("+".$issued_date." days", time()));
                    $issued_date = date("Y-m-d", time());
                    //var_dump($due_date); die();
                  }

                  $check_already_applied = $this->job_assign->get_id_by_issued_date_and_jobs_id($issued_date,$job_id, $student_data_id);
                  if($check_already_applied == false) {

                  //var_dump($new_password);
                  $dept_id = $this->jobs->get_depertment_by_id($job_id);
                  $clean_dept_id = unserialize($dept_id);

                  

                  foreach ($clean_dept_id as $key => $value) {
                    $args = array();
                    $args['issued_date']          = $issued_date;
                    $args['due_date']             = $due_date;
                    $args['jobs_id']              = $job_id;
                    $args['student_data_id']      = $student_data_id;
                    $args['job_department_id']    = $value;
                    $args['reviewed_by']          = 0;
                    $inserted_id = $this->job_assign->add($args);

                    $arr = array();
                    $arr['job_assign_id'] = $inserted_id;
                    $arr['total_price'] = $price;
                    $arr['documents'] = (!empty($files)) ? $files : " ";
                    $this->job_applied_student->add($arr);
                  }
                  
                   
                    //$affectedrow = $this->student_information->update_by_student_data_id($args);
                    


               if($inserted_id)  {
                  $html = '1' ;
                }
              } else {
                  $html = "";
              }
              
              echo $html;     
              
          }else if($_POST['action']=="excuse_update"){
              $html = "";
              
                  $args["id"]                   = $_POST['id'];
                  $args["status"]               = $_POST['status'];
                  $args["remarks"]              = $_POST['remarks'];
                  
                  
                  
               
            if($this->student_attendance_excuse->update($args))  { 
              $html = "1" ;
            }
                $day_id_class_plan_id = $_POST['clean_day_id_class_plan_id'];
                $clean_day_id_class_plan_id = explode(":", $day_id_class_plan_id);

                foreach ($clean_day_id_class_plan_id as $x => $y) {

                  $arr = array();
                  $day_and_class_plan = explode("_", $y);
                  $arr['day_id']         = $day_and_class_plan[0];
                  $arr['class_plan_id']  = $day_and_class_plan[1];
                  $arr['register_id']    = $_POST['register_id'];
                  $arr['attendance_type']    = ($_POST['status'] == 0) ? "A" : "E";

                  $this->attendance->update_attendance_type($arr);

                }

              
              echo $html;
                  
              
          }else if($_POST['action']=="add_registration"){

              $html = "";
              
                  $args["ssn"]                   = $_POST['ssn_number'];
                  $args["confirmation_date"]     = $_POST['date_of_conf'];
                  $args["status"]                = $_POST['registration_status'];
                  $args["academic_year"]         = $_POST['ac_year'];
                  $args["registration_year"]     = $_POST['reg_year'];
                  $args["note"]                  = $_POST['reg_note'];
                  $args["register_id"]           = $_POST['register_id'];
                  $args["submitted_by"]          = $_POST['submitted_by'];
                  
                  $insertedid = $this->registration_history->add($args);
                  
               
            if($insertedid)
            { 
              $html = $insertedid;
            }

            echo $html;
                  
              
          }else if($_POST['action']=="registration_update"){

              $html = "";
              
                  $args["id"]                    = $_POST['id'];
                  $args["ssn"]                   = $_POST['ssn_number'];
                  $args["confirmation_date"]     = $_POST['date_of_conf'];
                  $args["status"]                = $_POST['registration_status'];
                  $args["academic_year"]         = $_POST['ac_year'];
                  $args["registration_year"]     = $_POST['reg_year'];
                  $args["note"]                  = $_POST['reg_note'];
                  $args["register_id"]           = $_POST['register_id'];
                  $args["submitted_by"]          = $_POST['submitted_by'];
                  
                 
                  
               
            if($this->registration_history->update($args))
            { 
              $html = "1";
            }

            echo $html;
                  
              
          }else if($_POST['action']=="add_attendance"){

              $html = "";
              
                  $args["attendance_year"]       = $_POST['attendance_year'];
                  $args["confirmation_date"]     = $_POST['attendance_date_of_conf'];
                  $args["term"]                  = $_POST['attendance_term'];
                  $args["code"]                  = $_POST['attendance_code'];
                  $args["note"]                  = $_POST['attendance_note'];
                  $args["register_id"]           = $_POST['register_id'];
                  $args["submitted_by"]          = $_POST['submitted_by'];
                  
                  $insertedid = $this->attendance_history->add($args);
                  
               
            if($insertedid)
            { 
              $html = $insertedid;
            }

            echo $html;
                  
              
          }else if($_POST['action']=="attendance_update"){

              $html = "";
              
                  $args["id"]                    = $_POST['id'];
                  $args["attendance_year"]       = $_POST['attendance_year'];
                  $args["confirmation_date"]     = $_POST['attendance_date_of_conf'];
                  $args["term"]                  = $_POST['attendance_term'];
                  $args["code"]                  = $_POST['attendance_code'];
                  $args["note"]                  = $_POST['attendance_note'];
                  $args["register_id"]           = $_POST['register_id'];
                  $args["submitted_by"]          = $_POST['submitted_by'];
                  
                  
                  
               
            if($this->attendance_history->update($args))
            { 
              $html = "1";
            }

            echo $html;
                  
              
          }else if($_POST['action']=="add_coc"){

              $html = "";
              
                  $args["register_id"]           = $_POST['register_id'];
                  $args["confirmation_date"]     = $_POST['coc_date_conf'];
                  $args["coc_type"]              = $_POST['coc_type'];
                  $args["reason"]                = $_POST['coc_reason'];
                  $args["actioned"]              = $_POST['actioned'];
                  $args["submitted_by"]          = $_POST['submitted_by'];
                  $filelist                      = $_POST['filelist'];
                  $filenamelist                  = $_POST['filenamelist'];
                  $student_data_id               = $_POST['student_data_id'];
                  //var_dump($args);
                  $insertedid = $this->coc_history->add($args);
                  
                  if(!empty($filelist) && count($filelist)>0){
                                         
                      foreach($filelist as $k=>$file){
                        $argsCocUpload = array();
                        $argsCocUpload['coc_history_id'] = $insertedid;    
                        $argsCocUpload['filepath'] = $file; 
                        $argsCocUpload['filename'] = $filenamelist[$k]; 
                        $argsCocUpload['student_data_id'] = $student_data_id; 
                        $argsCocUpload['register_id'] = $args["register_id"]; 
                        $argsCocUpload['staff_id'] = $args["submitted_by"]; 
                        
                        $this->coc_upload->add($argsCocUpload);
                         
                      }
                         
                  }
                  
                  
               
            if($insertedid)
            { 
              $html = $insertedid;
            }

            echo $html;
                  
              
          }else if($_POST['action']=="coc_update"){

              $html = ""; $upload=0;
                  $args                          = array();
                  $args["id"]                    = $_POST['id'];
                  $args["register_id"]           = $_POST['register_id'];
                  $args["confirmation_date"]     = $_POST['coc_date_conf'];
                  $args["coc_type"]              = $_POST['coc_type'];
                  $args["reason"]                = $_POST['coc_reason'];
                  $args["actioned"]              = $_POST['actioned'];
                  $args["submitted_by"]          = $_POST['submitted_by'];
                  $filelist                      = $_POST['filelist'];
                  $filenamelist                  = $_POST['filenamelist'];
                  $student_data_id               = $_POST['student_data_id'];                  
                 
                  //var_dump($_POST);
               

            
              if(!empty($filelist) && count($filelist)>0){
                                     
                  foreach($filelist as $k=>$file){
                    $argsCocUpload = array();
                    $argsCocUpload['coc_history_id'] = $args["id"];    
                    $argsCocUpload['filepath'] = $file; 
                    $argsCocUpload['filename'] = $filenamelist[$k]; 
                    $argsCocUpload['student_data_id'] = $student_data_id; 
                    $argsCocUpload['register_id'] = $args["register_id"]; 
                    $argsCocUpload['staff_id'] = $args["submitted_by"]; 
                    
                    $this->coc_upload->add($argsCocUpload);
                    $upload = 1; 
                  }
                     
              } 
              
              if($this->coc_history->update($args))
                { 
                  $html = "1";
                }           

            if($html>"" || $upload>0) echo 1;
                  
              
          }else if($_POST['action']=="do_it_online_doc_upload"){
              $html = "";
              
                  $args["filename"]             = $_POST['filename'];
                  $args["filepath"]             = "uploads/files/".$_POST['documentfile'][0];
                  $args["check_hard_copy_doc"]  = $_POST['checkhardcopy'];
                  $args["reason"]               = $_POST['reason'];
                  $args["filename"]             = $_POST['filename'];
                  $args["student_data_id"]      = $_POST['id'];
                  $args["staff_id"]             = $_POST['staff_id'];
                  $args["datetime"]             = tohrdatetime(date("Y-m-d H:i:s",time()));
                  $args["serial"]               = $this->staff_upload->get_next_serial($args["student_data_id"]);
                  
                  $insertid = $this->staff_upload->add($args);
               
             if($insertid>0)  $html = $insertid ;
              
              echo $html;
                  
              
          }else if($_POST['action']=="uploadstudentstate"){
              $html = "";
              
                  $i =0;
                  
                  // add communication
              $html             =   "";
              $args             =   array();
              $args_inbox       =   array();
              $args_documents   =   array();
              $args_documentsfile   =   array();
                  $args["student_data_id"]      = $id       = $_POST['id'];
                  $args["staff_id"]             = $staffid  = $_POST['staff_id'];
                  $args["serial"]               = $this->lcc_communication->get_next_serial_by($args["student_data_id"]);
                  $args["text"]                 = $_POST['comment'];
                  $args["datetime"]             = tohrdatetime(date("Y-m-d H:i:s",time()));
                  $args["entry_date"]           = $date  = date("Y-m-d H:i:s",time());
                  


                  $communicationid    =   $this->lcc_communication->add($args);
                  
                  // add inbox
                  $args_inbox["communication_id"]         =  $communicationid;
                  $args_inbox["student_data_id"]          =  (int)$id;
                  $args_inbox["staff_id"]                 =  (int)$staffid;
                  $args_inbox["notification_type"]        =  "communication";
                  $args_inbox["notification_from"]        =  "student";
                  $args_inbox["notification_to"]          =  "staff";   
                  $args_inbox["notification_to_staff_id"] =  0;   
                  $args_inbox["notification_checked"]     =  "no";               
                  $args_inbox["entry_date"]               =  date("Y-m-d H:i:s",time());               
                  $args_inbox["dt"]                       =  tohrdatetime(date("Y-m-d H:i:s",time()));               
                  $args_inbox["is_trash"]                 =  0;          
                  
                  $insertid         = $this->lcc_inbox->add($args_inbox);

                  if($insertid>0)  $html = $insertid ;                  
                  
                  
                  //add documents
                  $i =1;
                  if(isset($_POST['documentfile']) && count($_POST['documentfile'])>0)
                  foreach ($_POST['documentfile'] as $document):
                      $args_documents["filepath"]             = "uploads/files/".$document;
                      $args_documents["filename"]             = "Attached file ".$i;
                      $args_documents["student_data_id"]      = $_POST['id'];
                      $args_documents["communication_serial"] = $args["serial"];
                      $args_documents["serial"]               = $this->student_upload->get_next_serial($args["student_data_id"]);
                      
                      $insertid = $this->student_upload->add($args_documents);
                      $i++;
                  endforeach;
               
             if($insertid>0)  $html = $insertid ;
              
              echo $html;
                  
              
          } else if($_POST['action']=="stafflist"){
              $html = "";
              
              $stafflists = $this->staff->get_all();
              if(isset($stafflists) and count($stafflists)>0 and is_array($stafflists))
              {
              foreach($stafflists as $staffinfo):
                                        
                  $html.="<option value=\"{$staffinfo['id']}\"> {$staffinfo['staff_name']}</option>";
                                                    
                                    
              endforeach;
              }
              
              echo $html;
                  
              
          }else if($_POST['action']=="get_letter_data_by_id"){
              $html = "";
              
              $stafflists = $this->staff->get_all();
              if(isset($stafflists) and count($stafflists)>0 and is_array($stafflists))
              {
              foreach($stafflists as $staffinfo):
                                        
                  $html.="<option value=\"{$staffinfo['id']}\"> {$staffinfo['staff_name']}</option>";
                                                    
                                    
              endforeach;
              }
              
              echo $html;
                  
              
          }else if($_POST['action']=="addnotes"){
              
                foreach($_POST as $k=>$v){
                  if($k=="reason") $$k=tinymce_encode($v); else $$k=$v;
                }              
              
              $html = "";
              
                  $args["text"]                     = $reason;
                  $args["student_data_id"]          = $id;
                  $args["staff_id"]                 = $staff_id;
                  $args["datetime"]                 = tohrdatetime(date("Y-m-d H:i:s",time()));
                  $args["entry_date"]               = date("Y-m-d H:i:s",time());
                  
                  if($follow_up=="yes"){
                      $args["follow_up"]                = $follow_up;    
                      $args["follow_up_start_date"]     = date("Y-m-d",strtotime($follow_up_start_date));
                      $args["follow_up_end_date"]       = date("Y-m-d",strtotime($follow_up_end_date));
                      $args["follow_up_staff_id"]       = $follow_up_staff_id;
                      
                          ////---------- insert in inbox
                         $inbox = array(); 
                         $inbox['student_data_id'] = $id; 
                         $inbox['staff_id'] = $this->session->userdata('uid'); 
                         $inbox['notification_type'] = "followup"; 
                         $inbox['notification_from'] = "staff"; 
                         $inbox['notification_to']  = "staff"; 
                         $inbox['notification_to_staff_id']  = $follow_up_staff_id; 
                         $inbox['notification_checked']  = "no"; 
                         $inbox['dt']  = date("F j, Y h:i a",time());
                         
                         $this->lcc_inbox->add($inbox);  
                      
                  }
                  //var_dump($inbox);
                  $insertid = $this->notes->add($args);
               
             if($insertid>0)  $html = $insertid ;
              
              echo $html;
                  
              
          } else if($_POST['action']=="addcomment"){
              $html         =   "";
              $args         =   array();
              $args_inbox   =   array();
                  $args["student_data_id"]      = $id       = $_POST['id'];
                  $args["staff_id"]             = $staffid  = $_POST['staff_id'];
                  $args["serial"]               = $this->lcc_communication->get_next_serial_by($args["student_data_id"]);
                  $args["text"]                 = $_POST['comment'];
                  $args["datetime"]             = tohrdatetime(date("Y-m-d H:i:s",time()));
                  $args["entry_date"]           = $date  = date("Y-m-d H:i:s",time());
                  


                  $communicationid    =   $this->lcc_communication->add($args);
                  
               
                  $args_inbox["communication_id"]         =  $communicationid;
                  $args_inbox["student_data_id"]          =  (int)$id;
                  $args_inbox["staff_id"]                 =  (int)$staffid;
                  $args_inbox["notification_type"]        =  "communication";
                  $args_inbox["notification_from"]        =  $_POST['comm_form'];
                  $args_inbox["notification_to"]          =  $_POST['comm_to'];   
                  $args_inbox["notification_to_staff_id"] =  0;   
                  $args_inbox["notification_checked"]     =  "no";               
                  $args_inbox["entry_date"]               =  date("Y-m-d H:i:s",time());               
                  $args_inbox["dt"]                       =  "";               
                  $args_inbox["is_trash"]                 =  0;          
                  
                  $insertid         = $this->lcc_inbox->add($args_inbox);

             if($insertid>0) {  $html = $insertid; 
/*			 
//send_email
 $student_array= $this->student_data->get_phone_email_byID($id);
 //makeHtmlEmail($student_array['student_email'],"New Communication from London Churchill College","Dear Applicant <br /><br /> You have a new message from London Churchill College. Please login to your account to view. <br /><br /> <a target='_blank' href='http://londonchurchillcollege.co.uk/student_admission/'>CLICK HERE TO LOGIN TO YOUR ACCOUNT</a> <br /><br /> Thank You, <br /><br /> LONDON CHURCHILL COLLEGE","London Churchill College<support@londonchurchillcollege.co.uk>");
 makeHtmlEmailExtend($student_array['student_email'],"New Communication from ".$settings['company_name'],"Dear Applicant <br /><br /> You have a new message from ".$settings['company_name'].". Please login to your account to view. <br /><br /> <a target='_blank' href='".base_url()."'>CLICK HERE TO LOGIN TO YOUR ACCOUNT</a> <br /><br /> Thank You, <br /><br /> ".$settings['company_name'],"".$settings['company_name']."<".$settings['smtp_user'].">",$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);
 
 
 //send sms 
 send_sms_txt($student_array['student_mobile_phone'],"Dear Applicant, You have a new message from ".$settings['company_name'].". Please login to your account to view. Thank You.");
			 
	*/		 
			 
			 }  
              
              //echo $html;
              echo "Working?";
                  
              
          } else if($_POST['action']=="getSemesterRelatedCourses"){
		  	  
		  	  $semester_ID  = $_POST['semester_id'];
		  	  $html         = '<option value="">Please Select</option>';
	          
		  	  $courselists=$this->course_relation->get_courselistby_semesterid($semester_ID);
              if(isset($courselists) and count($courselists)>0 and is_array($courselists))
              {
              foreach($courselists as $ID => $name):
                                        
	          	$html.="<option value=\"$ID\"> $name</option>";
                                                    
	                                
              endforeach;
              
              $html.='';
			  echo $html;
			  } else { echo "not_found"; }			  
			  
		  
		  
		  } else if($_POST['action']=="getCourseRelatedModule"){
          
          $course_id  = $_POST['course_id'];
          $html         = '<option value="">Please Select</option>';
            
          //$courselists=$this->course_relation->get_courselistby_semesterid($semester_ID);

          $moduleList    =  $this->coursemodule->get_by_course_id($course_id);


              if(isset($moduleList) and count($moduleList)>0 and is_array($moduleList))
              {
              foreach($moduleList as $ID => $name):
                
              if(!empty($name['modulename'])) {                       
                $html.="<option value='".$name['id']."'> ".$name['modulename']."</option>";
              }
                                                    
                                  
              endforeach;
              
              $html.='';
        echo $html;
        } else { echo "not_found"; }        
        
      
      
      }else if($_POST['action']=="getGroupByCourseRelatedModule"){
          
          $course_id  = $_POST['course_id'];
          $coursemodule_id  = $_POST['coursemodule_id'];
          $semister_id  = $_POST['semister_id'];
          $html         = '<option value="">Please Select</option>';
            
          $course_relation_id=$this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semister_id);
          //var_dump($course_relation_id); die();

          $group_name = $this->class_plan->get_group_name_by_course_relation_id_and_coursemodule_id($course_relation_id, $coursemodule_id);

          //$moduleList    =  $this->coursemodule->get_by_course_id($course_id);
          //var_dump($group_name); die();

              if(isset($group_name) and count($group_name)>0 and is_array($group_name))
              {
              foreach($group_name as $name):
                                      
              $html.="<option value='".$name->group_name."'> ".$name->group_name."</option>";
                                                    
                                  
              endforeach;
              
              $html.='';
        echo $html;
        } else { echo "not_found"; }        
        
      
      
      }else if($_POST['action']=="RemoveFromList"){
		  	  
		  	  $id = $_POST['id'];
		  	  $model = $_POST['model'];
		  	  
		  	  $this->$model->delete($id);
		  	  
		  	 
		  	 
		  	 
		  }else if($_POST['action']=="RemoveFromCampus"){
          
          $id = $_POST['id'];
          $model = $_POST['model'];
          
          if($this->$model->delete($id)) {
            echo "1";
          } else {
            echo "";
          }
          
         
         
         
      }else if($_POST['action']=="RemoveFromLetterList"){
          
          $id = $_POST['id'];
          $model = $_POST['model'];
          $letter = $this->$model->get_pdf_name($id);

          if($letter != "") {
            unlink("uploads/files/".$letter);            
            $this->$model->delete($id);
            echo "1";          
          } else {
            echo "";
          }
          
         
         
         
      }else if($_POST['action']=="RemoveFromList2"){
          
          $id = $_POST['id'];
          $model = $_POST['model'];
          
          $this->$model->delete($id);

          $dur = $_POST['duration_value'];
          $args             = array();
          $args['duration'] = $dur;
          $this->course_relation->update($args, $_POST['course_rel']);
          
         
         
         
      }else if($_POST['action']=="RemoveModule"){
          
          $id = $_POST['id'];
          $model = $_POST['model'];
          
          $this->$model->delete($id);
          
         
         
         
      }else if($_POST['action']=="createReport"){
		  	  
		  	  $sem_id = $_POST['semester_id'];
		  	  $sem_name = $this->semister->get_name($sem_id);
		  	  $t1=0; $t2=0; $t3=0; $t4=0; $t5=0; $t6=0; $t7=0; $t8=0; $t9=0; $t10=0;
		  	  $course_list = $this->course_relation->get_courselistby_semesterid($sem_id);
		  	   //var_dump($course_list);
		  	 	$output = "<table class='table table-striped'>
								<thead>
									<tr>
										<th>Course Name</th>
										<th>Total Application</th>
										<th>New</th>
										<th>Review</th>
										<th>Processing</th>
										<th>Awaiting Documents</th>
										<th>Refer to Academic Dept</th>
										<th>Rejected for Review</th>
										<th>Accepted</th>
										<th>Rejected</th>
										<th>Discarded</th>
									</tr>
								</thead>
								<tbody>";
		  	  
		  	  if(!empty($course_list)){
				  
				  foreach($course_list as $k=>$v){
				  	  
				  	  $t_app = 								$this->student_data->getToalApplicationByCourseIDAndSemID($k,$sem_id);
				  	  $t_new = 								$this->student_data->get_NEW_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Review = 							$this->student_data->get_Review_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Awaiting_Documents = 				$this->student_data->get_Awaiting_Documents_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Processing = 						$this->student_data->get_Processing_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Refer_to_academic_department = 	$this->student_data->get_Refer_to_academic_department_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Accepted = 						$this->student_data->get_Accepted_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Rejected_for_review = 				$this->student_data->get_Rejected_for_review_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Rejected = 						$this->student_data->get_Rejected_ByCourseIDAndSemID($k,$sem_id);
				  	  $t_Discarded = 						$this->student_data->get_Discarded_ByCourseIDAndSemID($k,$sem_id);  
				  	  
				  	  $output .= "<tr>";
				  	  $output .= "<td>".$v."</td>";
				  	  $output .= "<td align='center'>".$t_app."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_NEW_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Review_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Processing_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Awaiting_Documents_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Refer_to_academic_department_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Rejected_for_review_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Accepted_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Rejected_ByCourseIDAndSemID($k,$sem_id)."</td>";
				  	  $output .= "<td align='center'>".$this->student_data->get_Discarded_ByCourseIDAndSemID($k,$sem_id)."</td>";				  	  
				  	  $output .= "</tr>";
				  	  
					  $t1 += $t_app; $t2 += $t_new; $t3 += $t_Review; $t4+=$t_Awaiting_Documents; $t5+=$t_Processing; $t6+=$t_Refer_to_academic_department; $t7+=$t_Accepted; $t8+=$t_Rejected_for_review; $t9+=$t_Rejected; $t10+=$t_Discarded;
					  
				  }

				  	  $output .= "<tr>";
				  	  $output .= "<td align='center'><strong>Total</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t1."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t2."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t3."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t5."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t4."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t6."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t8."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t7."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t9."</strong></td>";
				  	  $output .= "<td align='center'><strong>".$t10."</strong></td>";				  	  
				  	  $output .= "</tr>";
				  
				  
				  $output .= "</tbody></table>";
				  
				  echo $output;
				  
		  	  }
		  	  
			  
			  
		  }else if($_POST['action']=="submitRegisterPersonal"){
		  	        
		  	  		      $varsessioncheck_id     = $this->session->userdata('uid');
		  			        $output                 = "";
		  	            $studen_prev_info       = array();
                    $app_id                 = $id = $_POST["ref_id"];
                    $studen_prev_info       = $this->student_data->get_studentdata_for_edit($id);
                    $reg_prev_info          = $this->register->get_by_student_ID($app_id);
                    $hesa_prev_info          = $this->hesa_student_information->get_by_student_data_id_and_register_id($app_id,$reg_prev_info['id']);
                    $archive_count          = 0;
                    $archive_change         = array();
                    $disibility             = "";
					          
                              $student_data_arr             = array();
					          $register_arr                 = array(); 
                              $hesa_student_information_arr = array();                                         

		  		    foreach($_POST as $k=>$v){
		  			
		  			           if ($k == "hesa_domicile_id") {

                          $domicile = array(

                            $k=>$v,
                            'id'=>$hesa_prev_info['id']

                            );

                          $inserted_id = $this->hesa_student_information->update($domicile);

                       }

                      
                       if ($k == "hesa_stuload_student_info_id") {
                         $i = 0;
                         foreach ($v as $l => $m) {
                          $arr = array();
                          $arr['student_load'] = $this->input->post('student_load_'.$i);
                          $arr['id'] = $m;
                          
                          $hesa_stuload_student_info_id = $this->hesa_stuload_student_info->update($arr);

                          $i++; 
                         }
                         
                       }
                       
                        
                        if($k=="student_course"                                 || 
                            $k=="student_type"                                  || 
                            $k=="student_nationality"                           || 
                            $k=="student_country_of_birth"                      || 
                            $k=="student_others_ethnicity"                      || 
                            $k=="student_home_phone"                            || 
                            $k=="student_mobile_phone"                          || 
                            $k=="student_address_address_line_1"                || 
                            $k=="student_address_address_line_2"                || 
                            $k=="student_address_state_province_region"         || 
                            $k=="student_address_postal_zip_code"               || 
                            $k=="student_address_city"                          || 
                            $k=="student_address_country"                       || 
                            $k=="student_others_marketing_info_referred_by"     || 
                            $k=="student_others_marketing_info_referred_name"   || 
                            $k=="student_others_marketing_info_referred_phone"  || 
                            $k=="disabilities_allowance"                        || 
                            $k=="agent_id"                                      ||
                            $k=="student_email"
                            
                            ) {
							
                                $student_data_arr[$k] = tinymce_encode($v);	
                        }
                        
                        if($k=="agent_id" && empty($v)) $student_data_arr[$k] = 0; 
                        //if($k=="disabilities_allowance" && empty($v)) $student_data_arr[$k] = "no"; 
                        
                        
                        if(
                            $k=="hesa_exchind_id"       ||
                            $k=="hesa_sselig_id"        ||
                            $k=="uhn_number"            ||
                            $k=="hesa_heapespop_id"     ||
                            $k=="hesa_locsdy_id"        ||
                            $k=="hesa_mode_id"          ||
                            $k=="hesa_notact_id"        ||
                            $k=="hesa_yearstu"          ||
                            $k=="hesa_sexort_id"        ||
                            $k=="hesa_relblf_id"        ||
                            $k=="hesa_genderid_id"      ||
                            $k=="hesa_disall_id"        ||
                            $k=="hesa_qual_id"  
                        
                        ){
                            
                            $hesa_student_information_arr[$k] = tinymce_encode($v);
                            
                        }
                       
                        
                        if($k=="hesa_exchind_id" && empty($v)) $hesa_student_information_arr[$k] = 0;
                         
                        
                        if( $k=="proof_type"            || 
                            $k=="proof_id"              || 
                            $k=="proof_expiredate"      || 
                            $k=="class_startdate"       || 
                            $k=="class_enddate"         ||  
                            $k=="student_type"          || 
                            $k=="ssn"                   || 
                            $k=="kin_name"              || 
                            $k=="student_permanent_postcode"              || 
                            $k=="kin_phone"             || 
                            $k=="kin_email"               || 
                            $k=="kin_address"             || 
                            $k=="passport_no"             || 
                            $k=="kin_relation"           ||
                            $k=="campus_info_id"         ||
                            $k=="student_id_card_no"
                            )   {
							
							if($k=="class_startdate" && !empty($v)){ 
                                $register_arr[$k]   =   date("Y-m-d",strtotime($v)); 
                                $v                  =   date("Y-m-d",strtotime($v)); 
                            }
              if($k=="passport_no" && !empty($v)){ 
                                $register_arr[$k]   = tinymce_encode($v);  
              } elseif($k=="passport_no" && empty($v)) {
                                $register_arr[$k]   = ""; 
              } 
							if($k=="class_enddate" && !empty($v)){ 
                                $register_arr[$k]   =   date("Y-m-d",strtotime($v)); 
                                $v                  =   date("Y-m-d",strtotime($v)); 
                            }
							if($k=="proof_expiredate" && !empty($v)){ 
                                $register_arr[$k]   =   date("Y-m-d",strtotime($v)); 
                                $v                  =   date("Y-m-d",strtotime($v));
                            }
							if($k!="class_startdate" && $k!="class_enddate" && $k!="proof_expiredate") $register_arr[$k] = tinymce_encode($v);		
                            
                        }                        
                        
                        if($k=="student_others_disabilities_on") {
                
                            $disibility       = $v;

                        } 

                        if( $k=="student_others_disabilities" ) {
                            if( $disibility!="no" ) { 
                                if( is_array($v) ) {
                                    // $array_v    =    implode(",",$v);
                                    $array_v = $v = serialize($v); 
                                    // $array_v = $v = @serialize($v); 
                                    //var_dump($array_v);
                                    if(count($v)>0)
                                        $student_data_arr[$k]     =  $array_v;
                                    else{
                                        
                                        $student_data_arr[$k]     =  "0"; 
                                        $v                        =  "0";
                                        $student_data_arr["disabilities_allowance"]   =   "no";
                                    
									                  }
                        
                                } else if(!is_array($v) && strpos($v,",")>0) {
                                    
                                        //$student_data_arr[$k]   =   $v;
                                        $exp                      = explode(",",$v);
                                        // var_dump(serialize($exp));
                                        $student_data_arr[$k]     = serialize($exp); $v = serialize($exp);
                                } else {
                                    
                                        $student_data_arr[$k]   =   "0";
                                        $v                      =   "0";
                                        $student_data_arr["disabilities_allowance"]   =   "no";
                                }
                            } else { 
                                        $student_data_arr[$k]   =   "0";  
                                        $v                      =   "0";
                                        $student_data_arr["disabilities_allowance"]   =   "no";  
                            }
                        }
                        // var_dump($student_data_arr);
                        /* insert data from student data table to archive */
                        $already_has=0;
                        foreach($studen_prev_info as $a=>$b){
                            if($a==$k){
                                if(!empty($b) && !empty($v) && $b!=$v){
                                    foreach($archive_change as $c=>$d){
                                        if($d['archive_field_name']==$k) $already_has=1;    
                                        
                                    }
                                    if($already_has==0){
                                        if(is_array($v) && $k=="student_others_disabilities") $v = implode(",",$v); 
                                        $archive_change[$archive_count] = array( 
                                            "student_data_id"              => $app_id,
                                            "staff_id"                     => $varsessioncheck_id,
                                            "archive_field_name"           => $k,
                                            "archive_field_value"          => $v,
                                            "archive_field_previous_value" => $studen_prev_info[$k],
                                            "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
                                            "entry_date"                   => date("Y-m-d h:i:s",time()),
                                            );
                                        $archive_count++;                                        
                                        
                                    }
                                     
                                }
                            }
                            $already_has=0;
                        }
                        /* insert data from student data table to archive end */
						if(!empty($reg_prev_info) && count($reg_prev_info)>0){                        
	                        $already_has=0;
	                        foreach($reg_prev_info as $a=>$b){
	                            if($a==$k){
	                                if(!empty($b) && !empty($v) && $b!=$v){

	                                    foreach($archive_change as $c=>$d){
	                                        if($d['archive_field_name']==$k) $already_has=1;    
	                                        
                                      
                                      }
                                      
	                                    if($already_has==0){
                                            if(is_array($v) && $k=="student_others_disabilities") $v = implode(",",$v); 
	                                        
                                            if($k=="campus_info_id" && $v==0) $v = "none";
                                            else if($k=="campus_info_id" && $v>0) $v = $this->campus_info->get_name_by_id($v);

                                            if($k=="campus_info_id" && $reg_prev_info[$k]==0) $prev_cam = "none";
                                            else if($k=="campus_info_id" && $reg_prev_info[$k]>0) $prev_cam = $this->campus_info->get_name_by_id($reg_prev_info[$k]);
                                            else $prev_cam = $reg_prev_info[$k];  

/*                                            if($k=="hesa_domicile_id") {
                                              $prev_cam = $hesa_prev_info[$k];
                                            } */                                          
                                              
	                                        $archive_change[$archive_count] = array( 
	                                            "student_data_id"              => $app_id,
	                                            "staff_id"                     => $varsessioncheck_id,
	                                            "archive_field_name"           => $k,
	                                            "archive_field_value"          => tinymce_encode($v),
	                                            "archive_field_previous_value" => $prev_cam,
	                                            "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
	                                            "entry_date"                   => date("Y-m-d h:i:s",time()),
	                                            );
	                                        $archive_count++;                                        
	                                        
	                                    }
	                                     
	                                }
	                            }
	                            $already_has=0;
	                        }
						}
            //var_dump($archive_change); die();

            // if(!empty($reg_prev_info) && count($reg_prev_info)>0){
                        
                        
                        
/*                        if($args["student_admission_status_hesa_reason_id"] == 0) 
                        $current_hesa_reason = "none";
                        else
                        $current_hesa_reason = $this->hesa_rsnend->get_name_by_id($args["student_admission_status_hesa_reason_id"]);

                        if($studen_prev_info["student_admission_status_hesa_reason_id"] == 0)
                        $previous_hesa_reason = "none";
                        else
                        $previous_hesa_reason = $this->hesa_rsnend->get_name_by_id($studen_prev_info["student_admission_status_hesa_reason_id"]);
                        
                        
                        $archive_change[$archive_count] = array( 
                            "student_data_id"              => $args["id"],
                            "staff_id"                     => $this->session->userdata('uid'),
                            "archive_field_name"           => "student_admission_status_HESA_reason",
                            "archive_field_value"          => $current_hesa_reason,
                            "archive_field_previous_value" => $previous_hesa_reason,
                            "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
                            "entry_date"                   => date("Y-m-d h:i:s",time()),
                            );                                                                                    
                         $archive_count++;*/  
                         
                        $hesa_field_table_arr = array("hesa_class_id"=>"hesa_class","hesa_courseaim_id"=>"hesa_courseaim","hesa_disall_id"=>"hesa_disall","hesa_exchind_id"=>"hesa_exchind","hesa_genderid_id"=>"hesa_genderid","hesa_heapespop_id"=>"hesa_heapespop","hesa_locsdy_id"=>"hesa_locsdy","hesa_mode_id"=>"hesa_mode","hesa_priprov_id"=>"hesa_priprov","hesa_qual_id"=>"hesa_qual","hesa_regbody_id"=>"hesa_regbody","hesa_relblf_id"=>"hesa_relblf","hesa_genderid_id"=>"hesa_genderid","hesa_rsnend_id"=>"hesa_rsnend","hesa_sexort_id"=>"hesa_sexort","hesa_sselig_id"=>"hesa_sselig","hesa_ttcid_id"=>"hesa_ttcid","hesa_notact_id"=>"hesa_notact", "hesa_provider_name"=>"hesa_previnst", "hesa_qual_type"=>"hesa_qual", "hesa_qual_sub"=>"hesa_qualsbj", "hesa_qual_sit"=>"hesa_qualsit", "hesa_domicile_id"=>"hesa_domicile");
                        
                         //var_dump($hesa_prev_info); die();
                        if(!empty($hesa_prev_info) && count($hesa_prev_info)>0){                        
                            $already_has=0;
                            foreach($hesa_prev_info as $a=>$b){
                                if($a==$k){
                                    if(!empty($b) && !empty($v) && $b!=$v){
                                        foreach($archive_change as $c=>$d){
                                            if($d['archive_field_name']==$k) $already_has=1;    
                                            
                                        }
                                        if($already_has==0){
                                            
                                                $has_in_array = 0;
                                                foreach($hesa_field_table_arr as $field=>$table){
                                                    if($field==$k){
                                                        if($k=="hesa_domicile_id") $current_val = $this->$table->get_code_by_id($v);
                                                        else $current_val = $this->$table->get_name_by_id($v);
                                                        if($k=="hesa_domicile_id") $previous_val = $this->$table->get_code_by_id($hesa_prev_info[$k]);
                                                        else $previous_val = $this->$table->get_name_by_id($hesa_prev_info[$k]);
                                                        $has_in_array = 1;
                                                    }     
                                                }
                                                if($has_in_array==0){
                                                        $current_val = $v;
                                                        $previous_val = $hesa_prev_info[$k];                                                    
                                                }

                                            
                                            $archive_change[$archive_count] = array( 
                                                "student_data_id"              => $app_id,
                                                "staff_id"                     => $varsessioncheck_id,
                                                "archive_field_name"           => $k,
                                                "archive_field_value"          => $current_val,
                                                "archive_field_previous_value" => $previous_val,
                                                "archive_change_datetime"      => tohrdatetime(date("Y-m-d h:i:s",time())),
                                                "entry_date"                   => date("Y-m-d h:i:s",time()),
                                                );
                                            $archive_count++;                                        
                                            
                                        }
                                         
                                    }
                                }
                                $already_has=0;
                            }
                        }// if(!empty($reg_prev_info) && count($reg_prev_info)>0){                                               

      //$hesa_prev_info
                       
                        
                        
                        			
				
		  	}  // data submit end for archive and data ready for $_POST
		  	
		  	            
            if($app_id!=0){
            
            
            	 
            	if(!empty($student_data_arr['student_mobile_phone']) && !empty($student_data_arr['student_address_address_line_1']) && !empty($student_data_arr['student_address_postal_zip_code']) && !empty($student_data_arr['student_address_city']) && !empty($student_data_arr['student_address_country']) && !empty($student_data_arr['student_nationality']) && !empty($student_data_arr['student_country_of_birth']) && !empty($student_data_arr['student_others_ethnicity']) && !empty($student_data_arr['student_email'])   ){
      //       	     $out = "";
		    //          foreach($student_data_arr as $k=>$v){
						// $out .="$k = $v<br>";	 
		    //          }
		             
		    //          echo $out;
		            
		                
                        $student_data_arr['id']                             = $app_id;
		                
                        if(empty($student_data_arr['disabilities_allowance'])) $student_data_arr['disabilities_allowance'] = "no";
                        
                        
                        if(isset($student_data_arr["student_others_disabilities"]) && $student_data_arr["student_others_disabilities"] == "0") {
                          $student_data_arr['disabilities_allowance'] = "no";                              
                        }
                        if(empty($student_data_arr['student_others_disabilities'])) $student_data_arr['student_others_disabilities'] = "0";
                        
                        
                        //var_dump($student_data_arr);
		                $insertedid                     = $this->student_data->update_app($student_data_arr); 

		                
		                
		                $reg_data = $this->register->get_by_student_ID($app_id);
		                
		                
		                
                        //var_dump($reg_data);
                        
		                if(count($reg_data)>0){
		                    $register_arr['id'] = $reg_data['id'];
                        // var_dump($register_arr); die();
        							$reg = $this->register->update($register_arr);
        							$reg_id = $register_arr['id'];
        							//echo $reg; die();	
        		        }else{

        							$reg_no = $this->register->createRegistrationNo($student_data_arr['student_course'],$studen_prev_info['student_semister']);
        							
        							//$
                        			$register_arr['registration_no'] = $reg_no;
                        			$register_arr['student_data_id'] = $app_id;             	
        							$reg = $this->register->add($register_arr);
                                    $reg_id = $reg;

                            $status_id_for_new = $this->status->get_id_by_status_NEW();

                            $checkIfFoundInStudentInformationTable = $this->student_information->get_by_student_data_id_and_registration_no($app_id, $reg_id);

                            if(empty($checkIfFoundInStudentInformationTable)) {  
                              $student_info_arr = array();
                              $student_info_arr['registration_id'] = $reg_id;
                              $student_info_arr['student_data_id'] = $app_id;
                              $student_info_arr['status']          = $status_id_for_new;
                              $student_info_arr['current_year']    = date("Y");

                              $this->student_information->add($student_info_arr);
                            }
                }
                        
                        ///---------- update information for HESA
                        
                        $reg_data = $this->register->get_by_student_ID($app_id);
                        $hesa_student_information_data = $this->hesa_student_information->get_by_student_data_id_and_register_id($app_id,$reg_data['id']);

                        
                        if(!empty($hesa_student_information_arr['hesa_disall_id']) && $hesa_student_information_arr['hesa_disall_id']>0 && !empty($student_data_arr['disabilities_allowance']) && $student_data_arr['disabilities_allowance']=="yes") $hesa_student_information_arr['hesa_disall_id'] = $hesa_student_information_arr['hesa_disall_id'];
                        else $hesa_student_information_arr['hesa_disall_id'] = 0;
                        
                        
                        if(count($hesa_student_information_data)>0){
                                
                                    $hesa_student_information_arr['id'] = $hesa_student_information_data['id'];
                                    //var_dump();
                                    $hesa_student_information = $this->hesa_student_information->update($hesa_student_information_arr);                                    
                            
                        }else{
                            
                                    $hesa_student_information_arr['student_data_id'] = $app_id;
                                    $hesa_student_information_arr['register_id'] = $reg_data['id'];
                                    $hesa_student_information = $this->hesa_student_information->add($hesa_student_information_arr);
                            
                        }
                        
		                ///---------end of HESA update
                      //var_dump($archive_change); //die();
		                if($archive_count >0) {
		                    foreach($archive_change as $archive_data):
		                        $this->archive->add($archive_data);
		                    endforeach;
		                }
                    
                    
		                if($insertedid || $inserted_id || $hesa_stuload_student_info_id || $reg || $hesa_student_information)
                    {

		                echo '<div class="alert alert-success "><p><span class="glyphicon glyphicon-ok"></span> Application Updated Successfully.</p></div>'; 
                    }

		                else {

		                echo '<div class="alert alert-warning "><p><span class="fa fa-warning"></span> Application could not be updated.</p></div>';		                
                    }

		                
				}else{
					
						echo '<div class="alert alert-warning "><p><span class="fa fa-warning"></span> Please enter required fields.</p></div>'; 	
				}
                

                 
				//}
                
                 
            } 
		  	

		  	  
		  }else if($_POST['action']=="sendemail"){
              $insertid =0;
              $args =array();
              $from_sender                  = $settings['company_name']."<".$settings['smtp_user'].">";
              $args["student_data_id"]      = $id     = $_POST['id'];
              $args["subject"]              = $_POST['subject'];
              $args["description"]          = $_POST['description'];
              $studentEmail                 = $_POST['studentEmail'];
              $args["issued_by"]            = $staffid =  $this->session->userdata('uid');
              $args["issued_date"]          = date("Y-m-d",time());

              $insertid=$this->email_issuing->add($args);    
              if($insertid) {
              	//makeHtmlEmail($studentEmail,$args["subject"],$args["description"],$from_sender);
              	makeHtmlEmailExtend($studentEmail,$args["subject"],$args["description"],$from_sender,$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);
              echo $insertid;
              }
          }else if($_POST['action']=="sendEmailToSelectedStudent"){

              $insertid =0;
              
              $from_sender                  = $settings['company_name']."<".$settings['smtp_user'].">";
              $total                        = array();

              foreach ($_POST['id'] as $key => $value) {

                $args                         =array();
                $student_info                 = "";
                $student_info                 = $this->student_data->get_student_email_phone_first_last_name_by_ID($value);
                
                $args["student_data_id"]      = $value;
                $args["subject"]              = $_POST['email_subject'];
                $args["description"]          = $_POST['letter_content'];
                $studentEmail                 = $student_info->student_email;
                $args["issued_by"]            = $staffid =  $this->session->userdata('uid');
                $args["issued_date"]          = date("Y-m-d",time());

                $insertid                     = $this->email_issuing->add($args);

                //makeHtmlEmailExtend($studentEmail,$args["subject"],$args["description"],$from_sender,$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);

                $total[]                      = $insertid;

              }
              

              if(count($total) == count($_POST['id'])) {
                
                echo "1";

              }

          }else if($_POST['action']=="sendSMSToSelectedStudent"){

              $insertid =0;
              
              $total                        = array();


              foreach ($_POST['id'] as $key => $value) {

                $args                         =array();
                $student_info                 = "";
                $student_info                 = $this->student_data->get_student_email_phone_first_last_name_by_ID($value);
                $args["student_data_id"]      = $value;
                $args["phone"]                = $student_info->student_mobile_phone;
                $args["subject"]              = $_POST['sms_subject'];
                $args["description"]          = $_POST['sms_content'];
                $args["issued_by"]            = $staffid =  $this->session->userdata('uid');
                //$args["issued_date"]          = date("Y-m-d",time());
                //var_dump($args);

                $insertid                     = $this->sms_issuing->add($args);

                //send_sms_txt($student_info->student_mobile_phone,$_POST['sms_content']); 
                $total[]                      = $insertid;

              }
              //die();
              
              if(count($total) == count($_POST['id'])) {
                
                echo "1";

              }

          }else if($_POST['action']=="sendsms"){
              
              $args =array();
              $args["student_data_id"]      = $id     = $_POST['id'];
              $args["subject"]              = $_POST['subject'];
              $args["description"]          = $_POST['description'];
              $args['phone']                = $_POST['phone'];
              $args["issued_by"]            = $staffid = $this->session->userdata('uid');
              //$args["issued_date"]          = date("Y-m-d h:i:s",time());
              
              $insertid=$this->sms_issuing->add($args);   
              if($insertid) {
               send_sms_txt($args['phone'],$args["description"]);    
               echo $insertid;
              }
  
          
          
          }else if($_POST['action']=="sendletter"){


              $pdf_name = $_POST['letterId']."_".time();
              $pin = time();
              $args =array();
              $args["student_data_id"]      = $id = $_POST['id'];
              $args["letter_id"]            = $_POST['letterId'];
              $args["signatory_id"]         = $_POST['signatoryId'];
              $args["pin"]                  = $pin;
              $args["pdf_name"]             = $pdf_name.".pdf";
              $args["issued_by"]            = $staffid = $this->session->userdata('uid');
              $args["issued_date"]          = date("Y-m-d",strtotime($_POST['issuedDate']));
              $insertid=$this->letter_issuing->add($args);



            $std_data                = $this->student_data->get_studentdata_for_edit($_POST['id']);

            $letter_description = $_POST['letter_content'];

            //var_dump($letter_description); die();

            $letter_issuing_info = $this->letter_issuing->get_by_student_data_id_and_letter_id($std_data['id'],$_POST['letterId']);
            // var_dump($letter_issuing_info['signatory_id']); die();

            $data_arr = get_letter_data($letter_description);
            //var_dump($data_arr); die();

            $current_data = strip_slashes($letter_description);
          if(count($data_arr)>0){

            foreach($data_arr as $k=>$v){
            // var_dump($current_data); die();
              
              $table = $v[0];
              $field = $v[1];

             
              // var_dump($field); die();
              //echo $table." ".$field."<br>";
              if($table=="student_data"){
                
                $where_cluse = "id='".$std_data['id']."'";
                // var_dump($where_cluse); die();
              
              }else if($table=="register"){
                
                $where_cluse = "student_data_id='".$std_data['id']."'";
                // var_dump($where_cluse); die();
              }else if($table=="letter_issuing"){
                
                $where_cluse = "id='".$letter_issuing_info['id']."'";
                // var_dump($where_cluse); die();
              }else if($table=="signatory_set"){
                // var_dump("expression");
                $where_cluse = "id='".$letter_issuing_info['signatory_id']."'"; 
                // var_dump($where_cluse); die();
              }else if($table=="student_title"){
                
                $where_cluse = "id='".$std_data['student_title']."'";  
                
              }else if($table=="student_information"){
                
                $where_cluse = "student_data_id='".$std_data['id']."'"; 
                
              }else if($table=="coursemodule"){
                
                $where_cluse = "course_id='".$std_data['student_course']."'";  
                
              }else if($table=="courselevel"){
                
                $where_cluse = "course_id='".$std_data['student_course']."'";  
              
              }else if($table=="course"){
                
                $where_cluse = "id='".$std_data['student_course']."'"; 
                //var_dump($where_cluse); die();
              }else if($table=="semister"){
                
                $where_cluse = "id='".$std_data['student_semister']."'"; 
              
              }else if($table=="settings"){
                
                $where_cluse = "ID='1'";  
              
              }else if($table=="slc_coursecode"){
                
                $c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                
                $where_cluse = "course_relation_id='".$c_r_id."'";
                
              }else if($table=="awarding_body"){
                
                $c_r = $this->course_relation->get_ID_and_awarding_id_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                                
                $where_cluse = "ID='".$c_r['awarding_id']."'";                
                
              }else if($table=="student_gender"){
                
                $where_cluse = "id='".$std_data['student_gender']."'";             
                  
              }else if($table=="student_nationality"){
                                    
                //// -------------- this should be [DATA=student_nationality]country_name[/DATA]
                $table = "countries";
                
                $where_cluse = "id='".$std_data['student_nationality']."'";              
                  
              }else if($table=="student_country_of_birth"){
                                    
                //// -------------- this should be [DATA=student_country_of_birth]country_name[/DATA]
                $table = "countries";
                
                $where_cluse = "id='".$std_data['student_country_of_birth']."'";             
                  
              }else if($table=="student_others_ethnicity"){
                                    
                //// -------------- this should be [DATA=student_others_ethnicity]name[/DATA]
                //$table = "countries";
                
                $where_cluse = "id='".$std_data['student_others_ethnicity']."'";             
                  
              }else if($table=="course_relation" && $field=="fees"){

                  $reg_data = $this->register->get_by_student_ID($id);

                    if(!empty($reg_data['student_type'])){
                    
                    if($reg_data['student_type']=="uk") $field="fees_1";
                    else $field="fees_2";
                    
                    $c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                    //var_dump($c_r_id); die();
                    $where_cluse = "ID='".$c_r_id."'";
                    //var_dump($where_cluse); die();
                    }else{
                      
                      $field="fees_1";
                    $c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                    $where_cluse = "ID='".$c_r_id."'";                    
                    }
              }           

              ////// ---------- for serialize fields
              if($table=="student_others_disabilities"){
              
                //// -------------- this should be [DATA=student_others_disabilities]name[/DATA]
                $disabilities_arr = unserialize($std_data['student_others_disabilities']);
                $disability = "";
                foreach($disabilities_arr as $k=>$v){
                  $disability .= $this->student_others_disabilities->get_name_by_id($v).", ";   
                }
                
                $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",$value,$current_data);
                
              
              ///--------------- non database table
              }else if($table=="today" && $field=="today"){
              
                $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",date("d-m-Y"),$current_data);                    
                        
              }else{
                             
                     //var_dump($std_data['student_title']);
                    $query = $this->db->query("SELECT ".$field." FROM ".$table." WHERE ".$where_cluse." LIMIT 1");
                                      
                    if($query->num_rows()>0){
                      $field = trim($field);
                      $value = $query->row()->$field;
                      //// ----- for date type value
                      if($field=="issued_date" || $field=="class_startdate" || $field=="class_enddate" || $field=="student_date_of_birth") $value = date("d/m/Y",strtotime($value));
                      
                      if($table=="signatory_set")
                      {
                        $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]","<img src='".base_url()."".$value."' class='img-responsive' width='200px' height='50px'>",$current_data);
                      }

                      elseif($table=="course_relation") {
                        $current_data = str_replace("[DATA=".$table."]fees[/DATA]",$value,$current_data);
                      }
                      else{                   
                          $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",$value,$current_data);                                         
                      }
                                    
                    }
                
              }                   
              
              
                    //var_dump($current_data);             
          } //End of foreach
                  //var_dump("expression"); die();  
        }
          //die();

              $pdf_data = tinymce_decode($current_data);

              // var_dump($current_data); die();

              
              $pdfFilePath  = FCPATH."uploads/files/$pdf_name.pdf";

       
              if ( file_exists($pdfFilePath) == FALSE )
              {

                  ini_set('memory_limit','512M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
                  //$html = $this->load->view('user_header'); // render the view into HTML
                  //$html = $this->load->view('pdf_report', $feedbackdata, true); // render the view into HTML
                  //$html. = $this->load->view('admin_footer'); // render the view into HTML
                 
                 //PDF start here  
                  $this->load->library('pdf');
                  $pdf = $this->pdf->load();
                  $pdf->SetFooter('{PAGENO}| Pin - '.$pin); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
                  
                  $pdf->WriteHTML($pdf_data); // write the HTML into the PDF
                  $pdf->Output($pdfFilePath, 'F'); // save to file because we can
                  //pdf end here
                  // var_dump($pdfFilePath); die();
                  //echo FCPATH;
                  if(file_exists($pdfFilePath))
                  {

                    if(isset($_POST['send_email']) && ($_POST['send_email'] != "undefined") ) {
                      
                      $to = $std_data['student_email'];
                      $full_name = $std_data['student_first_name']." ".$std_data['student_sur_name'];
                      $sub = $this->letter_set->get_type_by_id($_POST['letterId']);
                      $msg = $pdf_data;
                      
                      
                      $from = $settings['company_name']." Staff <".$settings['smtp_user'].">";
                      //makeHtmlEmail($to,$sub,$msg,$from);                   
                        
                      makeHtmlEmailExtend($to,$sub,$msg,$from,$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);

                      $args =array();
                      
                      $args["student_data_id"]      = $id     = $_POST['id'];
                      $args["subject"]              = $sub;
                      $args["description"]          = $msg;
                      $args["issued_by"]            = $this->session->userdata('uid');
                      $args["issued_date"]          = date("Y-m-d",time());

                      $this->email_issuing->add($args);


                    }
                    $success = 1;

                  } else {
                    $this->letter_issuing->delete($insertid);
                  }

              }


              // $insertid = 1;   
              if($insertid && ($success == 1)) {
                echo $insertid; 
              } else {
                echo "";
              }
  
          
          
          }else if($_POST['action']=="sendletterToSelectedStudent"){

              //var_dump($_POST['id']); die();
              $total_insertid = array();
              ini_set('memory_limit','512M');
             
             //PDF start here  
              $this->load->library('pdf');
              $pdf = $this->pdf->load();
              $letter_description = $_POST['letter_content'];
              $data_arr = array();
              $data_arr = get_letter_data($letter_description);

              foreach($_POST['id'] as $kk=>$vv) {

              $pdf_name = $_POST['letterId']."_".$vv."_".time();
              $pin      = $vv.time();

              $args =array();
              $args["student_data_id"]      = $id = $vv;
              $args["letter_id"]            = $_POST['letterId'];
              $args["signatory_id"]         = $_POST['signatoryId'];
              $args["pin"]                  = $pin;
              $args["pdf_name"]             = $pdf_name.".pdf";
              $args["issued_by"]            = $staffid = $this->session->userdata('uid');
              $args["issued_date"]          = date("Y-m-d",strtotime($_POST['issuedDate']));
              $insertid=$this->letter_issuing->add($args);
              $total_insertid[] = $insertid;


            $std_data = array();  
            $std_data                = $this->student_data->get_studentdata_for_edit($vv);

            

            //var_dump($letter_description); die();
            $letter_issuing_info = array();
            $letter_issuing_info = $this->letter_issuing->get_by_student_data_id_and_letter_id($std_data['id'],$_POST['letterId']);
            // var_dump($letter_issuing_info['signatory_id']); die();

            //var_dump($data_arr); die();
            $current_data = "";
            $current_data = strip_slashes($letter_description);

          if(count($data_arr)>0){

            foreach($data_arr as $k=>$v){
            // var_dump($current_data); die();
              
              $table = $v[0];
              $field = $v[1];

             
              // var_dump($field); die();
              //echo $table." ".$field."<br>";
              if($table=="student_data"){
                
                $where_cluse = "id='".$std_data['id']."'";
                // var_dump($where_cluse); die();
              
              }else if($table=="register"){
                
                $where_cluse = "student_data_id='".$std_data['id']."'";
                // var_dump($where_cluse); die();
              }else if($table=="letter_issuing"){
                
                $where_cluse = "id='".$letter_issuing_info['id']."'";
                // var_dump($where_cluse); die();
              }else if($table=="signatory_set"){
                // var_dump("expression");
                $where_cluse = "id='".$letter_issuing_info['signatory_id']."'"; 
                // var_dump($where_cluse); die();
              }else if($table=="student_title"){
                
                $where_cluse = "id='".$std_data['student_title']."'";  
                
              }else if($table=="student_information"){
                
                $where_cluse = "student_data_id='".$std_data['id']."'"; 
                
              }else if($table=="coursemodule"){
                
                $where_cluse = "course_id='".$std_data['student_course']."'";  
                
              }else if($table=="courselevel"){
                
                $where_cluse = "course_id='".$std_data['student_course']."'";  
              
              }else if($table=="course"){
                
                $where_cluse = "id='".$std_data['student_course']."'"; 
                //var_dump($where_cluse); die();
              }else if($table=="semister"){
                
                $where_cluse = "id='".$std_data['student_semister']."'"; 
              
              }else if($table=="settings"){
                
                $where_cluse = "ID='1'";  
              
              }else if($table=="slc_coursecode"){
                $c_r_id = "";
                $c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                
                $where_cluse = "course_relation_id='".$c_r_id."'";
                
              }else if($table=="awarding_body"){
                $c_r = "";
                $c_r = $this->course_relation->get_ID_and_awarding_id_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                                
                $where_cluse = "ID='".$c_r['awarding_id']."'";                
                
              }else if($table=="student_gender"){
                
                $where_cluse = "id='".$std_data['student_gender']."'";             
                  
              }else if($table=="student_nationality"){
                                    
                //// -------------- this should be [DATA=student_nationality]country_name[/DATA]
                $table = "countries";
                
                $where_cluse = "id='".$std_data['student_nationality']."'";              
                  
              }else if($table=="student_country_of_birth"){
                                    
                //// -------------- this should be [DATA=student_country_of_birth]country_name[/DATA]
                $table = "countries";
                
                $where_cluse = "id='".$std_data['student_country_of_birth']."'";             
                  
              }else if($table=="student_others_ethnicity"){
                                    
                //// -------------- this should be [DATA=student_others_ethnicity]name[/DATA]
                //$table = "countries";
                
                $where_cluse = "id='".$std_data['student_others_ethnicity']."'";             
                  
              }else if($table=="course_relation" && $field=="fees"){
                  $reg_data = array();
                  $reg_data = $this->register->get_by_student_ID($id);

                    if(!empty($reg_data['student_type'])){
                    
                    if($reg_data['student_type']=="uk") $field="fees_1";
                    else $field="fees_2";
                    $c_r_id = "";
                    $c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                    //var_dump($c_r_id); die();
                    $where_cluse = "ID='".$c_r_id."'";
                    //var_dump($where_cluse); die();
                    }else{
                      
                      $field="fees_1";
                    $c_r_id = "";
                    $c_r_id = $this->course_relation->get_ID_by_course_ID_semester_ID($std_data['student_course'],$std_data['student_semister']);
                    $where_cluse = "ID='".$c_r_id."'";                    
                    }
              }           

              ////// ---------- for serialize fields
              if($table=="student_others_disabilities"){
              
                //// -------------- this should be [DATA=student_others_disabilities]name[/DATA]
                $disabilities_arr = unserialize($std_data['student_others_disabilities']);
                $disability = "";
                foreach($disabilities_arr as $k=>$v){
                  $disability .= $this->student_others_disabilities->get_name_by_id($v).", ";   
                }
                
                $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",$value,$current_data);
                
              
              ///--------------- non database table
              }else if($table=="today" && $field=="today"){
              
                $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",date("d-m-Y"),$current_data);                    
                        
              }else{
                             
                     //var_dump($std_data['student_title']);
                    $query = $this->db->query("SELECT ".$field." FROM ".$table." WHERE ".$where_cluse." LIMIT 1");
                                      
                    if($query->num_rows()>0){
                      $field = trim($field);
                      $value = $query->row()->$field;
                      //// ----- for date type value
                      if($field=="issued_date" || $field=="class_startdate" || $field=="class_enddate" || $field=="student_date_of_birth") $value = date("d/m/Y",strtotime($value));
                      
                      if($table=="signatory_set")
                      {
                        $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]","<img src='".base_url()."".$value."' class='img-responsive' width='200px' height='50px'>",$current_data);
                      }

                      elseif($table=="course_relation") {
                        $current_data = str_replace("[DATA=".$table."]fees[/DATA]",$value,$current_data);
                      }
                      else{                   
                          $current_data = str_replace("[DATA=".$table."]".$field."[/DATA]",$value,$current_data);                                         
                      }
                                    
                    }
                
              }                   
              
              
                    //var_dump($current_data);             
          } //End of foreach
                  //var_dump("expression"); die();  
        }
          //die();
              $pdf_data = "";

              $pdf_data = tinymce_decode($current_data);
              $current_data = "";
              
              //var_dump($pdf_data); die();

              
              $pdfFilePath  = FCPATH."uploads/files/$pdf_name.pdf";
       
              if ( file_exists($pdfFilePath) == FALSE )
              {
                  $pdf = $this->pdf->load();
                  
                  $pdf->SetFooter('{PAGENO}| Pin - '.$pin); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
                  $pdf->WriteHTML($pdf_data); // write the HTML into the PDF
                  $pdf->Output($pdfFilePath, 'F'); // save to file because we can
                  //pdf end here
                  //echo FCPATH;
                  if(file_exists($pdfFilePath))
                  {

                    $success = 1;

                    if(isset($_POST['send_email']) && ($_POST['send_email'] !="undefined" ) ) {

                      $to = $std_data['student_email'];
                      $full_name = $std_data['student_first_name']." ".$std_data['student_sur_name'];
                      $sub = $this->letter_set->get_type_by_id($_POST['letterId']);
                      $msg = $pdf_data;
                      
                      
                      $from = $settings['company_name']." Staff <".$settings['smtp_user'].">";
                      //makeHtmlEmail($to,$sub,$msg,$from);                   
                        
                      makeHtmlEmailExtend($to,$sub,$msg,$from,$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);

                    }

                  } else {
                    $this->letter_issuing->delete($insertid);
                  }

                }
              }

              // $insertid = 1;   
              if((count($total_insertid) == count($_POST['id']) ) && ($success == 1)) {
                echo "1"; 
              } else {
                echo "";
              }
  
            
          
          }else if($_POST['action']=="changedateletter"){
              
              $args =array();
              $args["id"]            = $_POST['letterId'];
              $args["issued_by"]            = $staffid = $this->session->userdata('uid');
              $args["issued_date"]          = date("Y-m-d",strtotime($_POST['issuedDate']));

              $insertid=$this->letter_issuing->update($args);   
              if($insertid) {   echo $insertid; }
             //var_dump($args);
          
          
          }else if($_POST['action']=="uploadProfilePhoto"){
			  
			  
				$id = $_POST['id'];
				$filepath = $_POST['filepath'];
				
				
				$register_arr['student_photo'] = $filepath;
                $reg_data = $this->register->get_by_student_ID($id);
                
                //var_dump($reg_data);
                
                if(count($reg_data)>0){
                    $register_arr['id'] = $reg_data['id'];
                    //var_dump($register_arr);
					$reg = $this->register->update($register_arr);	
                }else{
                	
                	$register_arr['student_data_id'] = $id;                	
					$reg = $this->register->add($register_arr);
				}
				
				echo $filepath;							  
			    
			  
          }elseif($_POST['action']=="getStudentProfilePhoto"){
			  
			   $id = $_POST['id'];
			   
			   $reg_data = $this->register->get_by_student_ID($id);
			   if(count($reg_data)>0 && !empty($reg_data['student_photo']))
			   echo $reg_data['student_photo'];
			  
          }elseif($_POST['action']=="getCourseStartAndEndDate"){
			  
			 @$student_type          = $_POST['student_type'];
			 @$student_course        = $_POST['student_course'];
			 @$student_semister      = $_POST['student_semister'];
			 $output = "<script>";
			 
			 $course_rel_data = $this->course_relation->get_by_course_and_semester($student_course,$student_semister); 
			 //$output .= var_dump($course_rel_data);
			 if($student_type=="uk"){
			 	   
          if(!empty($course_rel_data['class_startdate_1'])) {
			 	   $output .= "$('input[name=class_startdate]').val('".date("d-m-Y",strtotime($course_rel_data['class_startdate_1']))."');"; 
          }
          if(!empty($course_rel_data['class_enddate_1'])) {
			 	   $output .= "$('input[name=class_enddate]').val('".date("d-m-Y",strtotime($course_rel_data['class_enddate_1']))."');"; 
          }
				 
			 }else if($student_type=="overseas"){
			 	 
			 	  if(!empty($course_rel_data['class_startdate_2'])) $output .= "$('input[name=class_startdate]').val('".date("d-m-Y",strtotime($course_rel_data['class_startdate_2']))."');"; else $output .= "$('input[name=class_startdate]').val('').parent().addClass('has-error');"; 
			 	  if(!empty($course_rel_data['class_enddate_2'])) $output .= "$('input[name=class_enddate]').val('".date("d-m-Y",strtotime($course_rel_data['class_enddate_2']))."');"; else $output .= "$('input[name=class_enddate]').val('').parent().addClass('has-error');";			 	 
				 
			 }
			 $output .= "</script>";
			 echo $output;
			  
          }elseif($_POST['action']=="getModulenameByCourseID"){
			  
			   $course_id = intval($_POST['course_id']);
			   
			   $module_list = $this->coursemodule->get_by_course_id($course_id);
               $output = "";
               $output .= "<option value=''>Please Select</option>"; 
			   foreach($module_list as $k=>$v){
					  
					$output .= "<option value='".$v['id']."'>".$v['modulename']."</option>";   
			   }
			   
			   echo $output;
			   
          }elseif($_POST['action']=="getModulenameByCourseIDForClassPlanEdit"){
			  
			   $course_id = intval($_POST['course_id']);
			   $coursemodule_id = intval($_POST['coursemodule_id']);
			   
			   $module_list = $this->coursemodule->get_by_course_id($course_id);
               $output = "";
               $output .= "<option value=''>Please Select</option>"; 
			   foreach($module_list as $k=>$v){
					  
					if($v['id'] == $coursemodule_id)
					$output .= "<option value='".$v['id']."' selected='selected'>".$v['modulename']."</option>";   
					else
					$output .= "<option value='".$v['id']."'>".$v['modulename']."</option>";   
			   }
			   
			   echo $output;			   
			   
		  }else if($_POST['action']=="getGroupFormDataForClassPlan") {

			$course_id = $_POST['course_id'];  
			$semister_id = $_POST['semister_id']; 
			$coursemodule_id = $_POST['coursemodule_id'];

			  
			$num = $_POST['num'];  
			$output = "";  

	        $course_list = $this->course->get_all();
	        $semister_list = $this->semister->get_all();
	        //$semester_plan_list = $this->semester_plan->get_all();
	        $semester_plan_list = $this->semester_plan->get_by_semester_id_final($semister_id);
	        $time_plan_list = $this->time_plan->get_all();
	        $staff_list = $this->staff->get_all();
	        $room_plan_list = $this->room_plan->get_all();			  
			  
			$j=1;  
			for($i=0;$i<$num;$i++){  
			  
				$output .="
												<div class='panel panel-primary group'>
													<div class='panel-heading'>
														<h3 class='panel-title'>Group ".$j."</h3>
													</div>
													<div class='panel-body'>

	                        								<div class='form-group'>
	                        									<div class='col-sm-6 no-pad-left'>
									                            <label>Group Name</label>
									                            <input class='form-control group_name' type='text' name='group_name[".$i."]' required placeholder='Group name should be unique name for each module. ex. A1'>
								                            	</div>
												                <div class='col-sm-6 no-pad-left'>
												                	<label>Group Label</label>
													            	<input class='form-control group_lebel' type='text' name='group_lebel[".$i."]'  required>
												                </div>
											                </div>
								                            
	                        								<div class='form-group'>
									                            <label>Class Days</label>
	                                                            <div class='clearfix'></div>
	                                                            <div class='col-sm-12 no-pad-left'>
										                            <div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][0]' id='checkbox".$i."_1' type='checkbox' class='form-control' value='1'><label for='checkbox".$i."_1'>Mon</label></div></div>
										                            <div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][1]' id='checkbox".$i."_2' type='checkbox' class='form-control' value='2'><label for='checkbox".$i."_2'>Tue</label></div></div>
										                            <div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][2]' id='checkbox".$i."_3' type='checkbox' class='form-control' value='3'><label for='checkbox".$i."_3'>Wed</label></div></div>
										                            <div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][3]' id='checkbox".$i."_4' type='checkbox' class='form-control' value='4'><label for='checkbox".$i."_4'>Thus</label></div></div>
										                            <div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][4]' id='checkbox".$i."_5' type='checkbox' class='form-control' value='5'><label for='checkbox".$i."_5'>Fri</label></div></div>
	                                                            </div>
	                                                            <div class='clearfix'></div>
								                            </div>
								                			<div class='form-group'> <!-- Start Theory-->
	                        									<div class='col-sm-12 no-pad-left'>
												            	<label>Class Types</label><div class='clearfix'></div>";
							
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][0]' id='checkboxType".$i."_1' type='checkbox' class='form-control' value='theory' ";
									
								$output .="><label for='checkboxType".$i."_1'>Theory</label></div></div> ";
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][1]' id='checkboxType".$i."_2' type='checkbox' class='form-control' value='practical' ";	
									
							    $output .="><label for='checkboxType".$i."_2'>Practical</label></div></div> ";
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][2]' id='checkboxType".$i."_3' type='checkbox' class='form-control' value='tutorial' ";
										
								$output .="><label for='checkboxType".$i."_3'>Tutorial</label></div></div> ";
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][3]' id='checkboxType".$i."_4' type='checkbox' class='form-control' value='seminar' ";
																		
								$output .="><label for='checkboxType".$i."_4'>Seminar</label></div></div> ";                                
				            
												                            
							    $output .="					  	</div>
																<div class='clearfix'></div>
															</div> <!-- End of Theory-->
											                                        
								                            
								                            
								                            <div class='col-sm-12 no-pad'>
	                        									<div class='form-group col-sm-6 no-pad-left'>
										                            <label>Select Time Plan</label>
										                            <select class='form-control time_planid' name='time_planid[".$i."]' required>
		                            									<option value=''>Please Select</option>

					";
													
																		foreach($time_plan_list as $k=>$v){
																			$output .="<option value='".$v['id']."'>".$v['start_time']." to ".$v['end_time']."</option>";
																		}		                            		
		                            									
	

					$output .= "
										                            </select>
									                            </div>
	                        									<div class='form-group col-sm-6 no-pad-right'>
										                            <label>Select Semester Plan</label>
										                            <select class='form-control semester_planid' name='semester_planid[".$i."]' required>
		                            									<option value=''>Please Select</option>
					";
																		foreach($semester_plan_list as $k=>$v){
																			$output .="<option value='".$v['id']."'>".$v['name']."</option>";
																		}

					$output .= "
										                            </select>
									                            </div>	
									                         </div> 
											                <div class='form-group semester-plan-data-area'>
											                
							                            		<div class='col-sm-6 no-pad'>
							                            		
							                            			<div class='col-sm-6 no-pad'><label>Start Time: <strong class='start_date'></strong></label></div>
							                            			<div class='col-sm-6 no-pad'><label>End Time: <strong class='end_date'></strong></label></div>
							                            												                            		
							                            		</div>
							                            		
							                            		<div class='col-sm-6 no-pad'>
							                            			<div class='col-sm-6'>
							                            				<label>Teaching week: </label><br>
							                            				<label>Start Date: <strong class='teaching_start_date'></strong></label><br>
							                            				<label>End Date: <strong class='teaching_end_date'></strong></label><br>
							                            			</div>
							                            			<div class='col-sm-6'>
							                            				<label>Revision week: </label><br>
							                            				<label>Start Date: <strong class='revision_start_date'></strong></label><br>
							                            				<label>End Date: <strong class='revision_end_date'></strong></label><br>
							                            			</div>
							                            		</div>
							                            		<div class='clearfix'></div>							                            	

		
															</div>
									                        <div class='form-group'>
								                        		
								                        		<div class='col-sm-4 no-pad-left'>
								                        			<label>Submission date:</label>
								                        		    <input class='form-control date' type='text' name='submission_date[".$i."]' required>
								                        		</div>
									                            <div class='col-sm-4 no-pad-left'>
								                            		<label>Select Tutor:</label>
										                            <select class='form-control tutor_id' name='tutor_id[".$i."]' required>
		                            									<option value=''>Please Select</option>
					";

																		foreach($staff_list as $k=>$v){
																			$output .="<option value='".$v['id']."'>".$v['staff_name']."</option>";
																		} 

					$output .= "
										                            </select>								                            	
									                            </div>
									                            <div class='col-sm-4 no-pad'>
								                            		<label>Select Room:</label>
										                            <select class='form-control room_id' name='room_id[".$i."]' required>
		                            									<option value=''>Please Select</option>
                   ";

																		foreach($room_plan_list as $k=>$v){
																			$output .="<option value='".$v['id']."'>".$v['name']."</option>";
																		}
		           $output .= "                 		
										                            </select>								                            	
									                            </div>
									                            
									                            <div class='clearfix'></div>
									                        </div> 
									                         
									                         
								                         								                           						                            								                            
													</div>
												</div>
					";
				  
			  
			  
			  
			  
			  
			  
			  
					$j++;  
		  		}
                $output .= "<script>showTimeTeachingRevision();$('.date').datepicker({ dateFormat: 'dd-mm-yy' }); $.each($('form .btn-area').find('button.addGroup'),function(){ $(this).remove(); });</script>";
                echo $output;
          
          
		  }else if($_POST['action']=="getCourseRelationIDForClassPlan") {          
          
          		$course_id =  $_POST['course_id'];
          		$semister_id = $_POST['semister_id'];
          	
 				$output = "";
 				
 				$dt = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semister_id);         	
          	  
          	    if($dt!=false){
					echo "<script>$('.course_relation_id').val('".$dt."');</script>";
          	    }else{
					
					echo '<div class="alert alert-warning "><p><span class="fa fa-warning"></span> Course and semester relation dont exist.</p></div>';
          	    }
          	  
          	  
          	  
		  } elseif ($_POST['action']=="cr_new_module") {

           $m_name      = $_POST['name'];
           $module_code = $_POST['module_code'];
           $c_id        = $_POST['c_id'];
           $l_id        = $_POST['l_id'];
           $noofmodule  = $_POST['noofmodule'];

          $args                     = array();
          $args['course_id']        = $c_id;
          $args['modulename']       = $m_name;
          $args['module_code']      = $module_code;
          $args['courselevel_id']   = $l_id;
          $args['createddate']      = date('y-m-d H:i:s');
          $args['modifieddate']     = date('y-m-d H:i:s');
          $args['createdby']        = $this->session->userdata('uid');
          $args['modifiedby']       = $this->session->userdata('uid');

          $insertedid=$this->coursemodule->add($args);
          if(isset($insertedid) && $insertedid>0) {
             
            $data = array();
            $data['noofmodule']     = $noofmodule + 1;
            $this->course_level->update_noofmodule($data, $l_id, $c_id );
            echo $insertedid;
          
          }

      } elseif ($_POST['action']=="create_new_level") {

           $level_name = $_POST['name'];
           $noofmodule = $_POST['noofmodule'];
           $course_id  = $_POST['course_id'];
          

          $args = array();
          $args['course_id']        = $course_id;
          $args['name']             = $level_name;
          $args['noofmodule']       = $noofmodule;
          $args['createddate']      = date('y-m-d H:i:s');
          $args['modifieddate']     = date('y-m-d H:i:s');
          $args['createdby']        = $this->session->userdata('uid');
          $args['modifiedby']       = $this->session->userdata('uid');
         

          $insertedid=$this->course_level->add($args);
          if(isset($insertedid) && $insertedid>0) {
            
            echo $insertedid;
          
          }

      } else if($_POST['action']=="getFirstTimeGroupFormDataForClassPlan"){
			  
			$course_id 			= $_POST['course_id'];  
			$semister_id 		= $_POST['semister_id']; 
			$coursemodule_id 	= $_POST['coursemodule_id'];
			
			$chk_course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semister_id);
			
			if($chk_course_relation_id!=false){
				
				$class_plan_data 	= $this->class_plan->get_by_course_relation_id_and_coursemodule_id($chk_course_relation_id,$coursemodule_id);	
				$num_class_plan 	= count($class_plan_data);
				if($num_class_plan>0){
										
						$output = "";  

				        $course_list 		= $this->course->get_all();
				        $semister_list 		= $this->semister->get_all();
				        $semester_plan_list = $this->semester_plan->get_by_semester_id_final($semister_id);
				        $time_plan_list 	= $this->time_plan->get_all();
				        $staff_list 		= $this->staff->get_all();
				        $room_plan_list 	= $this->room_plan->get_all();			  
						  
						  
						  
						  
						  
						$j=1;  
						for($i=0;$i<$num_class_plan;$i++){
							
							$semester_plan_arr 	= array();
							$semester_plan_arr 	= $this->semester_plan->get_by_ID($class_plan_data[$i]['semester_planid']);
							$time_plan_arr 		= array();
							$time_plan_arr 		= $this->time_plan->get_by_ID($class_plan_data[$i]['time_planid']);							
						    $class_days_arr 	= array();
							$class_days_arr 	= unserialize($class_plan_data[$i]['class_days']);  
							$class_type_data 	= unserialize($class_plan_data[$i]['class_types']);  
							$output 			.="
															<div class='panel panel-primary group'>
																<div class='panel-heading'>
																	<h3 class='panel-title'>Group ".$j."</h3>
																</div>
																<div class='panel-body'>

	                        											<div class='form-group'>
	                        											<div class='col-sm-6 no-pad-left'>
												                            <label>Group Name</label>
												                            <input class='form-control group_name' type='text' name='group_name[".$i."]' value='".$class_plan_data[$i]['group_name']."' required>
											                            </div>
											                            <div class='col-sm-6 no-pad-left'>
											                            <label>Group Label</label>
												                            <input class='form-control group_lebel' type='text' name='group_lebel[".$i."]' value='".$class_plan_data[$i]['group_lebel']."' required>
											                            
											                            </div>
											                            </div>
	                        											<div class='form-group'>
	                        											 <div class='col-sm-12 no-pad-left'>
												                            <label>Class Days</label>
				                                                            <div class='clearfix'></div>
				                                                           
				                       ";                                     
				                            
							if(!empty($class_days_arr[0]) && $class_days_arr[0]=="1") 
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][0]' id='checkbox".$i."_1' type='checkbox' class='form-control' value='1' checked='checked'><label for='checkbox".$i."_1'>Mon</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][0]' id='checkbox".$i."_1' type='checkbox' class='form-control' value='1'><label for='checkbox".$i."_1'>Mon</label></div></div> ";
							if(!empty($class_days_arr[1]) && $class_days_arr[1]=="2")	
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][1]' id='checkbox".$i."_2' type='checkbox' class='form-control' value='2' checked='checked'><label for='checkbox".$i."_2'>Tue</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][1]' id='checkbox".$i."_2' type='checkbox' class='form-control' value='2'><label for='checkbox".$i."_2'>Tue</label></div></div> ";
							if(!empty($class_days_arr[2]) && $class_days_arr[2]=="3")	
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][2]' id='checkbox".$i."_3' type='checkbox' class='form-control' value='3' checked='checked'><label for='checkbox".$i."_3'>Wed</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][2]' id='checkbox".$i."_3' type='checkbox' class='form-control' value='3'><label for='checkbox".$i."_3'>Wed</label></div></div> ";
							if(!empty($class_days_arr[3]) && $class_days_arr[3]=="4")									
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][3]' id='checkbox".$i."_4' type='checkbox' class='form-control' value='4' checked='checked'><label for='checkbox".$i."_4'>Thus</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][3]' id='checkbox".$i."_4' type='checkbox' class='form-control' value='4'><label for='checkbox".$i."_4'>Thus</label></div></div> ";
							if(!empty($class_days_arr[4]) && $class_days_arr[4]=="5")	
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][4]' id='checkbox".$i."_5' type='checkbox' class='form-control' value='5' checked='checked'><label for='checkbox".$i."_5'>Fri</label></div></div> ";
				            else                                                
				                $output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][4]' id='checkbox".$i."_5' type='checkbox' class='form-control' value='5'><label for='checkbox".$i."_5'>Fri</label></div></div> ";
				                                                            
				            $output .="	                                                
				                                                            </div>
				                                                            <div class='clearfix'></div>
											                            </div>
											                            <div class='form-group'> <!-- Start Theory-->
	                        											 <div class='col-sm-12 no-pad-left'>
												                            <label>Class Types</label><div class='clearfix'></div>";
							
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][0]' id='checkboxType".$i."_1' type='checkbox' class='form-control' value='theory' ";
									if(!empty($class_type_data[0]) && $class_type_data[0]=="theory") $output .=" checked='checked' ";
								$output .="><label for='checkboxType".$i."_1'>Theory</label></div></div> ";
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][1]' id='checkboxType".$i."_2' type='checkbox' class='form-control' value='practical' ";	
									if(!empty($class_type_data[1]) && $class_type_data[1]=="practical") $output .=" checked='checked' ";
							    $output .="><label for='checkboxType".$i."_2'>Practical</label></div></div> ";
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][2]' id='checkboxType".$i."_3' type='checkbox' class='form-control' value='tutorial' ";
									if(!empty($class_type_data[2]) && $class_type_data[2]=="tutorial") $output .=" checked='checked' ";	
								$output .="><label for='checkboxType".$i."_3'>Tutorial</label></div></div> ";
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_types[".$i."][3]' id='checkboxType".$i."_4' type='checkbox' class='form-control' value='seminar' ";
									if(!empty($class_type_data[3]) && $class_type_data[3]=="seminar") $output .=" checked='checked' ";									
								$output .="><label for='checkboxType".$i."_4'>Seminar</label></div></div> ";                                
				            
												                            
							$output .="					                 </div>
																		<div class='clearfix'></div>
												                        </div> <!-- End of Theory-->
											                            ";
							$output .="				                            <div class='col-sm-12 no-pad'>
	                        												<div class='form-group col-sm-6 no-pad-left'>
													                            <label>Select Time Plan</label>
													                            <select class='form-control time_planid' name='time_planid[".$i."]' required>
		                            												<option value=''>Please Select</option>
								";
																
																					foreach($time_plan_list as $k=>$v){
																						
																						if($v['id']==$class_plan_data[$i]['time_planid']) $output .="<option value='".$v['id']."' selected='selected'>".$v['start_time']." to ".$v['end_time']."</option>"; 
																						else $output .="<option value='".$v['id']."'>".$v['start_time']." to ".$v['end_time']."</option>";
																					}		                            		
		                            												
				

								$output .= "
													                            </select>
												                            </div>
	                        												<div class='form-group col-sm-6 no-pad-right'>
													                            <label>Select Semester Plan</label>
													                            <select class='form-control semester_planid' name='semester_planid[".$i."]' required>
		                            												<option value=''>Please Select</option>
								";
																					foreach($semester_plan_list as $k=>$v){
																						if($v['id']==$class_plan_data[$i]['semester_planid']) $output .="<option value='".$v['id']."' selected='selected'>".$v['name']."</option>"; 
																						else $output .="<option value='".$v['id']."'>".$v['name']."</option>";
																					}

								$output .= "
													                            </select>
												                            </div>	
												                         </div>
											                         
												                         
												                          
											                            <div class='form-group semester-plan-data-area'>
											                            
							                            					<div class='col-sm-6 no-pad'>
							                            					
							                            						<div class='col-sm-6 no-pad'><label>Start Time: <strong class='start_time'>".$time_plan_arr['start_time']."</strong></label></div>
							                            					    <div class='col-sm-6 no-pad'><label>End Time: <strong class='end_time'>".$time_plan_arr['end_time']."</strong></label></div>
							                            					
							                            					
							                            					</div>
							                            					
							                            					<div class='col-sm-6 no-pad'>
							                            					    <div class='col-sm-6'>
							                            							<label>Teaching week: </label><br>
							                            						    <label>Start Date: <strong class='teaching_start_date'>".date("d-m-Y",strtotime($semester_plan_arr['teaching_start']))."</strong></label><br>
							                            						    <label>End Date: <strong class='teaching_end_date'>".date("d-m-Y",strtotime($semester_plan_arr['teaching_end']))."</strong></label><br>
							                            					    </div>
							                            					    <div class='col-sm-6'>
							                            						    <label>Revision week: </label><br>
							                            						    <label>Start Date: <strong class='revision_start_date'>".date("d-m-Y",strtotime($semester_plan_arr['revision_start']))."</strong></label><br>
							                            						    <label>End Date: <strong class='revision_end_date'>".date("d-m-Y",strtotime($semester_plan_arr['revision_end']))."</strong></label><br>
							                            					    </div>
							                            					</div>
							                            					<div class='clearfix'></div>							                            	

					
																		</div>
																		
																		
																		
												                        <div class='form-group'>
								                        					
								                        					<div class='col-sm-4 no-pad-left'>
								                        						<label>Submission date:</label>
								                        					    <input class='form-control date' type='text' name='submission_date[".$i."]' value='".$class_plan_data[$i]['submission_date']."' required>
								                        					</div>
												                            <div class='col-sm-4 no-pad-left'>
								                            					<label>Select Tutor:</label>
													                            <select class='form-control tutor_id' name='tutor_id[".$i."]' required>
		                            												<option value=''>Please Select</option>
								";

																					foreach($staff_list as $k=>$v){
																						if($v['id']==$class_plan_data[$i]['tutor_id']) $output .="<option value='".$v['id']."' selected='selected'>".$v['staff_name']."</option>";
																						else $output .="<option value='".$v['id']."'>".$v['staff_name']."</option>";
																					} 

								$output .= "
													                            </select>								                            	
												                            </div>
												                            <div class='col-sm-4 no-pad'>
								                            					<label>Select Room:</label>
													                            <select class='form-control room_id' name='room_id[".$i."]' required>
		                            												<option value=''>Please Select</option>
			                   ";

																					foreach($room_plan_list as $k=>$v){
																						if($v['id']==$class_plan_data[$i]['room_id']) $output .="<option value='".$v['id']."' selected='selected'>".$v['name']."</option>";
																						else $output .="<option value='".$v['id']."'>".$v['name']."</option>";
																					}
					           $output .= "                 		
													                            </select>								                            	
												                            </div>
												                            
												                            <div class='clearfix'></div>
												                        </div> 
												                         
												                         
								                         								                           						                            											                            
																</div>
															</div>
								";
							  
						  
						  
						  
						  
						  
						  
						  
								$j++;  
		  					}///for($i=0;$i<$num_class_plan;$i++){
			                $output .= "<script>showTimeTeachingRevision();$('.date').datepicker({ dateFormat: 'dd-mm-yy' }); $('form .number_of_groups').val('".$num_class_plan."'); $.each($('form .btn-area').find('button.addGroup'),function(){ $(this).remove(); }); $('form .btn-area').append('<button type=\"button\" class=\"btn btn-default btn-warning addGroup\" onClick=\"addNewGroup()\">Add New Group</button>')</script>";					
					
				            echo $output;
				}/// if($num_class_plan>0){
				
				if($num_class_plan==0){
					
					$output ="<script>$.each($('form .btn-area').find('button.addGroup'),function(){ $(this).remove(); }); $('form .number_of_groups').val('');</script>";
					echo $output;
				}
				
				 
			}/// if($chk_course_relation_id!=false){
			
			 

                			  
			  
		  }else if($_POST['action']=="getOldAndNewGroupFormDataForClassPlan"){//-----------------}else if($_POST['action']=="getFirstTimeGroupFormDataForClassPlan"){
		  		  
			$course_id = $_POST['course_id'];  
			$semister_id = $_POST['semister_id']; 
			$coursemodule_id = $_POST['coursemodule_id'];
			
			$chk_course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semister_id);
			
			if($chk_course_relation_id!=false){
				
				$class_plan_data = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($chk_course_relation_id,$coursemodule_id);	
				$num_class_plan = count($class_plan_data);
				
				$course_list = $this->course->get_all();
				$semister_list = $this->semister->get_all();
				$semester_plan_list = $this->semester_plan->get_by_semester_id_final($semister_id);
				$time_plan_list = $this->time_plan->get_all();
				$staff_list = $this->staff->get_all();
				$room_plan_list = $this->room_plan->get_all();				
				
				if($num_class_plan>0){
										
						$output = ""; $output1 = "";  
			  
						  						  
						$j=1;  
						for($i=0;$i<$num_class_plan;$i++){
							
							$semester_plan_arr = array();
							$semester_plan_arr = $this->semester_plan->get_by_ID($class_plan_data[$i]['semester_planid']);
							$time_plan_arr = array();
							$time_plan_arr = $this->time_plan->get_by_ID($class_plan_data[$i]['time_planid']);
							
							
						
						    $class_days_arr = array();
							$class_days_arr = unserialize($class_plan_data[$i]['class_days']);  
						  
							$output .="
															<div class='panel panel-primary group'>
																<div class='panel-heading'>
																	<h3 class='panel-title'>Group ".$j."</h3>
																</div>
																<div class='panel-body'>

	                        											<div class='form-group'>
												                            <label>Group Name</label>
												                            <input class='form-control group_name' type='text' name='group_name[".$i."]' value='".$class_plan_data[$i]['group_name']."' required>
											                            </div>
	                        											<div class='form-group'>
												                            <label>Class Days</label>
				                                                            <div class='clearfix'></div>
				                                                            <div class='col-sm-12 no-pad-left'>
				                       ";                                     
							//var_dump($class_days_arr[0]);						                            
							if(!empty($class_days_arr[0]) && $class_days_arr[0]=="1") 
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][0]' id='checkbox".$i."_1' type='checkbox' class='form-control' value='1' checked='checked'><label for='checkbox".$i."_1'>Mon</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][0]' id='checkbox".$i."_1' type='checkbox' class='form-control' value='1'><label for='checkbox".$i."_1'>Mon</label></div></div> ";
							if(!empty($class_days_arr[1]) && $class_days_arr[1]=="2")	
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][1]' id='checkbox".$i."_2' type='checkbox' class='form-control' value='2' checked='checked'><label for='checkbox".$i."_2'>Tue</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][1]' id='checkbox".$i."_2' type='checkbox' class='form-control' value='2'><label for='checkbox".$i."_2'>Tue</label></div></div> ";
							if(!empty($class_days_arr[2]) && $class_days_arr[2]=="3")	
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][2]' id='checkbox".$i."_3' type='checkbox' class='form-control' value='3' checked='checked'><label for='checkbox".$i."_3'>Wed</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][2]' id='checkbox".$i."_3' type='checkbox' class='form-control' value='3'><label for='checkbox".$i."_3'>Wed</label></div></div> ";
							if(!empty($class_days_arr[3]) && $class_days_arr[3]=="4")									
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][3]' id='checkbox".$i."_4' type='checkbox' class='form-control' value='4' checked='checked'><label for='checkbox".$i."_4'>Thus</label></div></div> ";
							else
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][3]' id='checkbox".$i."_4' type='checkbox' class='form-control' value='4'><label for='checkbox".$i."_4'>Thus</label></div></div> ";
							if(!empty($class_days_arr[4]) && $class_days_arr[4]=="5")	
								$output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][4]' id='checkbox".$i."_5' type='checkbox' class='form-control' value='5' checked='checked'><label for='checkbox".$i."_5'>Fri</label></div></div> ";
				            else                                                
				                $output .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$i."][4]' id='checkbox".$i."_5' type='checkbox' class='form-control' value='5'><label for='checkbox".$i."_5'>Fri</label></div></div> ";
				                                                            
				            $output .="	                                                
				                                                            </div>
				                                                            <div class='clearfix'></div>
											                            </div>
											                            <div class='col-sm-12 no-pad'>
	                        												<div class='form-group col-sm-6 no-pad-left'>
													                            <label>Select Time Plan</label>
													                            <select class='form-control time_planid' name='time_planid[".$i."]' required>
		                            												<option value=''>Please Select</option>
								";
																
																					foreach($time_plan_list as $k=>$v){
																						
																						if($v['id']==$class_plan_data[$i]['time_planid']) $output .="<option value='".$v['id']."' selected='selected'>".$v['start_time']." to ".$v['end_time']."</option>"; 
																						else $output .="<option value='".$v['id']."'>".$v['start_time']." to ".$v['end_time']."</option>";
																					}		                            		
		                            												
				

								$output .= "
													                            </select>
												                            </div>
	                        												<div class='form-group col-sm-6 no-pad-right'>
													                            <label>Select Semester Plan</label>
													                            <select class='form-control semester_planid' name='semester_planid[".$i."]' required>
		                            												<option value=''>Please Select</option>
								";
																					foreach($semester_plan_list as $k=>$v){
																						if($v['id']==$class_plan_data[$i]['semester_planid']) $output .="<option value='".$v['id']."' selected='selected'>".$v['name']."</option>"; 
																						else $output .="<option value='".$v['id']."'>".$v['name']."</option>";
																					}

								$output .= "
													                            </select>
												                            </div>	
												                         </div>
												                         
												                         
											                            <div class='form-group semester-plan-data-area'>
											                            
							                            					<div class='col-sm-6 no-pad'>
							                            					
							                            						<div class='col-sm-6 no-pad'><label>Start Time: <strong class='start_time'>".$time_plan_arr['start_time']."</strong></label></div>
							                            					    <div class='col-sm-6 no-pad'><label>End Time: <strong class='end_time'>".$time_plan_arr['end_time']."</strong></label></div>
							                            					
							                            					
							                            					</div>
							                            					
							                            					<div class='col-sm-6 no-pad'>
							                            					    <div class='col-sm-6'>
							                            							<label>Teaching week: </label><br>
							                            						    <label>Start Date: <strong class='teaching_start_date'>".date("d-m-Y",strtotime($semester_plan_arr['teaching_start']))."</strong></label><br>
							                            						    <label>End Date: <strong class='teaching_end_date'>".date("d-m-Y",strtotime($semester_plan_arr['teaching_end']))."</strong></label><br>
							                            					    </div>
							                            					    <div class='col-sm-6'>
							                            						    <label>Revision week: </label><br>
							                            						    <label>Start Date: <strong class='revision_start_date'>".date("d-m-Y",strtotime($semester_plan_arr['revision_start']))."</strong></label><br>
							                            						    <label>End Date: <strong class='revision_end_date'>".date("d-m-Y",strtotime($semester_plan_arr['revision_end']))."</strong></label><br>
							                            					    </div>
							                            					</div>
							                            					<div class='clearfix'></div>							                            	

					
																		</div>												                         
												                          

												                        <div class='form-group'>
								                        					
								                        					<div class='col-sm-4 no-pad-left'>
								                        						<label>Submission date:</label>
								                        					    <input class='form-control date' type='text' name='submission_date[".$i."]' value='".$class_plan_data[$i]['submission_date']."' required>
								                        					</div>
												                            <div class='col-sm-4 no-pad-left'>
								                            					<label>Select Tutor:</label>
													                            <select class='form-control tutor_id' name='tutor_id[".$i."]' required>
		                            												<option value=''>Please Select</option>
								";

																					foreach($staff_list as $k=>$v){
																						if($v['id']==$class_plan_data[$i]['tutor_id']) $output .="<option value='".$v['id']."' selected='selected'>".$v['staff_name']."</option>";
																						else $output .="<option value='".$v['id']."'>".$v['staff_name']."</option>";
																					} 

								$output .= "
													                            </select>								                            	
												                            </div>
												                            <div class='col-sm-4 no-pad'>
								                            					<label>Select Room:</label>
													                            <select class='form-control room_id' name='room_id[".$i."]' required>
		                            												<option value=''>Please Select</option>
			                   ";

																					foreach($room_plan_list as $k=>$v){
																						if($v['id']==$class_plan_data[$i]['room_id']) $output .="<option value='".$v['id']."' selected='selected'>".$v['name']."</option>";
																						else $output .="<option value='".$v['id']."'>".$v['name']."</option>";
																					}
					           $output .= "                 		
													                            </select>								                            	
												                            </div>
												                            
												                            <div class='clearfix'></div>
												                        </div> 
												                         
												                         
								                         								                           						                            											                            
																</div>
															</div>
								";
							  
						  
						  
						  
						  
						  
						  
						  
								$j++;  
		  					}///for($i=0;$i<$num_class_plan;$i++){
			                					
					
				}/// if($num_class_plan>0){

				$new_num = $num_class_plan;
				
				//-------- adding another blank group form
							$output1 .="
															<div class='panel panel-warning group'>
																<div class='panel-heading'>
																	<h3 class='panel-title'>Group ".$j."</h3>
																</div>
																<div class='panel-body'>

	                        											<div class='form-group'>
												                            <label>Group Name</label>
												                            <input class='form-control group_name' type='text' name='group_name[".$new_num."]' required>
											                            </div>
	                        											<div class='form-group'>
												                            <label>Class Days</label>
				                                                            <div class='clearfix'></div>
				                                                            <div class='col-sm-12 no-pad-left'>
				                       ";				
				
							$output1 .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$new_num."][0]' id='checkbox".$new_num."_1' type='checkbox' class='form-control' value='1'><label for='checkbox".$new_num."_1'>Mon</label></div></div> ";
				            $output1 .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$new_num."][1]' id='checkbox".$new_num."_2' type='checkbox' class='form-control' value='2'><label for='checkbox".$new_num."_2'>Tue</label></div></div> ";
				            $output1 .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$new_num."][2]' id='checkbox".$new_num."_3' type='checkbox' class='form-control' value='3'><label for='checkbox".$new_num."_3'>Wed</label></div></div> ";
				            $output1 .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$new_num."][3]' id='checkbox".$new_num."_4' type='checkbox' class='form-control' value='4'><label for='checkbox".$new_num."_4'>Thus</label></div></div> ";
				            $output1 .="<div class='col-sm-1 no-pad-left'><div class='checkbox checkbox-primary'><input name='class_days[".$new_num."][4]' id='checkbox".$new_num."_5' type='checkbox' class='form-control' value='5'><label for='checkbox".$new_num."_5'>Fri</label></div></div> ";
				            
				    				            $output1 .="	                                                
				                                                            </div>
				                                                            <div class='clearfix'></div>
											                            </div>
											                            <div class='col-sm-12 no-pad'>
	                        												<div class='form-group col-sm-6 no-pad-left'>
													                            <label>Select Time Plan</label>
													                            <select class='form-control time_planid' name='time_planid[".$new_num."]' required>
		                            												<option value=''>Please Select</option>
								";        
				    																foreach($time_plan_list as $k=>$v){
															 
																						$output1 .="<option value='".$v['id']."'>".$v['start_time']." to ".$v['end_time']."</option>";
																					}        
								$output1 .= "
													                            </select>
												                            </div>
	                        												<div class='form-group col-sm-6 no-pad-right'>
													                            <label>Select Semester Plan</label>
													                            <select class='form-control semester_planid' name='semester_planid[".$new_num."]' required>
		                            												<option value=''>Please Select</option>
								";				            
																					foreach($semester_plan_list as $k=>$v){ 
																						$output1 .="<option value='".$v['id']."'>".$v['name']."</option>";
																					}				            
								$output1 .= "
													                            </select>
												                            </div>	
												                         </div> 
											                            <div class='form-group semester-plan-data-area'>
											                            
							                            					<div class='col-sm-6 no-pad'>
							                            					
							                            						<div class='col-sm-6 no-pad'><label>Start Time: <strong class='start_time'></strong></label></div>
							                            					    <div class='col-sm-6 no-pad'><label>End Time: <strong class='end_time'></strong></label></div>
							                            												                            					
							                            					</div>
							                            					
							                            					<div class='col-sm-6 no-pad'>
							                            					    <div class='col-sm-6'>
							                            							<label>Teaching week: </label><br>
							                            						    <label>Start Date: <strong class='teaching_start_date'></strong></label><br>
							                            						    <label>End Date: <strong class='teaching_end_date'></strong></label><br>
							                            					    </div>
							                            					    <div class='col-sm-6'>
							                            						    <label>Revision week: </label><br>
							                            						    <label>Start Date: <strong class='revision_start_date'></strong></label><br>
							                            						    <label>End Date: <strong class='revision_end_date'></strong></label><br>
							                            					    </div>
							                            					</div>
							                            					<div class='clearfix'></div>							                            	

					
																		</div>
												                        <div class='form-group'>
								                        					
								                        					<div class='col-sm-4 no-pad-left'>
								                        						<label>Submission date:</label>
								                        					    <input class='form-control date' type='text' name='submission_date[".$new_num."]' required>
								                        					</div>
												                            <div class='col-sm-4 no-pad-left'>
								                            					<label>Select Tutor:</label>
													                            <select class='form-control tutor_id' name='tutor_id[".$new_num."]' required>
		                            												<option value=''>Please Select</option>
								";				            
																					foreach($staff_list as $k=>$v){
																						$output1 .="<option value='".$v['id']."'>".$v['staff_name']."</option>";
																					}				            
								$output1 .= "
													                            </select>								                            	
												                            </div>
												                            <div class='col-sm-4 no-pad'>
								                            					<label>Select Room:</label>
													                            <select class='form-control room_id' name='room_id[".$new_num."]' required>
		                            												<option value=''>Please Select</option>
			                   ";				            
																					foreach($room_plan_list as $k=>$v){
																						$output1 .="<option value='".$v['id']."'>".$v['name']."</option>";
																					}				            
					           $output1 .= "                 		
													                            </select>								                            	
												                            </div>
												                            
												                            <div class='clearfix'></div>
												                        </div> 
												                         
												                         
								                         								                           						                            											                            
																</div>
															</div>
								";				            
				            
				$output1 .= "<script>showTimeTeachingRevision();$('#warningModal').modal('toggle');$('.date').datepicker({ dateFormat: 'dd-mm-yy' }); $('form .number_of_groups').val('".($new_num+1)."'); $.each($('form .btn-area').find('button.addGroup'),function(){ $(this).remove(); }); $('form .btn-area').append('<button type=\"button\" class=\"btn btn-default btn-warning addGroup\" onClick=\"addNewGroup()\">Add New Group</button>')</script>";						
			}/// if($chk_course_relation_id!=false){
			
			echo $output1.$output;		  	
		  		  
		  }else if($_POST['action']=="getTimeAndSemPlan"){
			  
			    $time_plan_arr = array(); $time_plan_arr = $this->time_plan->get_by_ID(intval($_POST['time_planid']));
			    $semester_planid_arr = array(); $semester_planid_arr = $this->semester_plan->get_by_ID(intval($_POST['semester_planid']));
			  
			    if(count($time_plan_arr)>0 && count($semester_planid_arr)>0){
				    
				    echo"							                            					
			    				<div class='col-sm-6 no-pad'>
								
								    <div class='col-sm-6 no-pad'><label>Start Time: <strong class='start_time'>".$time_plan_arr['start_time']."</strong></label></div>
								    <div class='col-sm-6 no-pad'><label>End Time: <strong class='end_time'>".$time_plan_arr['end_time']."</strong></label></div>
							                            													
								</div>
								
								<div class='col-sm-6 no-pad'>
								    <div class='col-sm-6'>
								        <label>Teaching week: </label><br>
								        <label>Start Date: <strong class='teaching_start_date'>".date("d-m-Y",strtotime($semester_planid_arr['teaching_start']))."</strong></label><br>
								        <label>End Date: <strong class='teaching_end_date'>".date("d-m-Y",strtotime($semester_planid_arr['teaching_end']))."</strong></label><br>
								    </div>
								    <div class='col-sm-6'>
								        <label>Revision week: </label><br>
								        <label>Start Date: <strong class='revision_start_date'>".date("d-m-Y",strtotime($semester_planid_arr['revision_start']))."</strong></label><br>
								        <label>End Date: <strong class='revision_end_date'>".date("d-m-Y",strtotime($semester_planid_arr['revision_end']))."</strong></label><br>
								    </div>
								</div>
								<div class='clearfix'></div>
					";
				
				}
			  
			  
		  }else if($_POST['action']=="deleteFromClassList"){
			  
			    //var_dump($_POST);
			    $date_arr = $_POST['date_arr'];
			    if(is_array($date_arr) && count($date_arr)>0){
			    	
					foreach($date_arr as $dates){
							$exp = array();
							$exp = explode("|",$dates);
							$id	= @intval($exp[2]);
							$this->class_lists->delete($id);
					}
					
					echo"<script>location.reload();</script>";
					
						
			    }
			  
		  }else if($_POST['action']=="addToClassList"){
			  
			   //var_dump($_POST);
			   
			   foreach($_POST as $k=>$v){
					
					if($k!="action" && $k!="date"){ $$k=tinymce_encode($v); $args[$k] = $$k; }
					else if($k=="date"){ $$k=tinymce_encode($v); $args[$k] = date("Y-m-d",strtotime($$k)); }
										  
			   }
			   $insid = $this->class_lists->add($args);
			   if($insid) echo"<div class=\"col-sm-12\"><div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> New date has been successfully added.</p></div></div><script>setTimeout(function(){ location.reload(); }, 2000);</script>";
			  
		  
		  }else if($_POST['action']=="assignStudentClassPlanIDList"){
			  
				$class_plan_id_arr = $_POST['class_plan_id_arr'];
				
				if(is_array($class_plan_id_arr) && count($class_plan_id_arr)>0){
				    
				    $data = array();
					$data['class_plan_id_list_for_assign_student'] = $class_plan_id_arr;
					$this->session->set_userdata($data); 	
					
				}
				//echo "1";
				 var_dump($this->session->userdata('class_plan_id_list_for_assign_student'));			  
			  
		  }else if($_POST['action']=="studentListForSendingSMS"){
        
                    $student_list = $_POST['student_list'];
                    //var_dump($student_list); die();
                    if (isset($_POST['start_end_date'])) {
                      $start_end_date = $_POST['start_end_date'];
                    }
                    
                    $absence_type = $_POST['absence_type'];
                    $notify_type = $_POST['notify_type'];
                    $email = 0;
                    $sms = 0;
                    if($notify_type == "Send SMS") {
                      $sms = 1;
                    } else if($notify_type == "Send Email") {
                      $email = 1;
                    } else if($notify_type == "Send Email AND SMS") {
                      $email = 1;
                      $sms = 1;
                    }
                    if(isset($start_end_date)) {
                      $combined = array_combine($student_list,$start_end_date);
                    } else {
                      $combined = $student_list;
                    }
                    
                    //var_dump($combined);
                    foreach ($combined as $key => $value) {
                      
                      $date = array();
                      $args = array();

                      if (isset($_POST['start_end_date'])) {
                        $date = explode("to", $value);
                        $args['start_date'] = $date[0];
                        $args['end_date'] = $date[1];
                        $args['student_data_id'] = $key;
                      } else {
                        $args['start_date'] = "";
                        $args['end_date'] = "";
                        $args['student_data_id'] = $value;
                      }
                      
                      
                      
                      
                      $args['absence_type'] = $absence_type;
                      $args['email_sent'] = $email;
                      $args['sms_sent'] = $sms;
                      $args['archive'] = 1;

                      if (isset($_POST['start_end_date']) && $start_end_date ) 
                      {            
                        $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_start_date_end_date_absence_type_without_archive($key,$date[0],$date[1],$absence_type );
                      } 
                      else 
                      {
                        $absent_sms_email = $this->attendance_notify->get_sms_email_by_student_data_id_absence_type_without_archive($value,$absence_type, 0 );
                        
                      }

                      if(!empty($absent_sms_email)) {
                      //var_dump($absent_sms_email); die();
                        $args['id'] = $absent_sms_email->id;
                        if ( $notify_type == "Send Email" ) {
                          $args['email_sent'] = 1;
                          $args['sms_sent'] = $absent_sms_email->sms_sent;
                        }
                        if ( $notify_type == "Send SMS" ) {
                          $args['sms_sent'] = 1;
                          $args['email_sent'] = $absent_sms_email->email_sent;
                        }
                        if ( $notify_type == "Send Email AND SMS" ) {
                          $args['sms_sent'] = 1;
                          $args['email_sent'] = 1;
/*                          $args['email_sent'] = $absent_sms_email->email_sent;
                          $args['sms_sent'] = $absent_sms_email->sms_sent;*/
                        }                        
                        

                        $this->attendance_notify->update($args);
                      } else {
                        $this->attendance_notify->add($args);
                      }


                    }
                    //var_dump($student_list);

                    
                    if(is_array($student_list) && count($student_list)>0){
                                 
                      $this->session->set_flashdata('student_list', $student_list);
                      // $array['student_list'] = $student_list;
                      
                      // $this->session->set_userdata( $array );
                       
                      echo "1";
                    }
        
           
        
      }else if($_POST['action']=="assignStudentList"){
			  
			     $student_id_list = $_POST['student_id_list'];
			     $class_plan_id_list = $_POST['class_plan_id_list'];
			     
                //var_dump($student_id_list);
                //var_dump($class_plan_id_list);
				// $out = array();
				 foreach($class_plan_id_list as $class_plan_id){
				 	 
				 	 
						 foreach($student_id_list as $stdID){
							
							$reg_id = $this->register->get_id_by_student_data_ID($stdID);
							
							$chk = $this->student_assign_class->checkIfExistByClassPlanIdAndRegisterId($class_plan_id,$reg_id);
							
							if($chk==false){
								
								$args = array();
								$args['class_plan_id']	=	$class_plan_id;	 	
								$args['register_id']	=	$reg_id;
								//$out[] = $args['class_plan_id']."|".$args['register_id'];	 	
								$insid[] = $this->student_assign_class->add($args);
							}
												 
						 }
					 
				 }
				 
				 echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Students successfully assigned.</p></div>";			  
				 //var_dump($insid);			  
			  
		  }else if($_POST['action']=="getClassPlanIDByDate"){
			  
			   $date = date("Y-m-d",strtotime($_POST['date']));
			   
			   $query = $this->db->query("SELECT * FROM ".$this->fixidb->class_lists." WHERE date LIKE '".$date."' ORDER BY id DESC");
			   
			   if($query->num_rows()>0){
				   
				   $course_arr = array();
				   $coursemodule_arr = array();
				   $group_name_arr = array();
				   
				   
				   foreach($query->result() as $rows){
					   
					   $class_planid = $rows->class_planid;
					   $time_planid =  $rows->time_planid;
					   $class_plan_query = $this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE id = '".$class_planid."' LIMIT 1");
					   $time_plan_query = $this->db->query("SELECT * FROM ".$this->fixidb->time_plan." WHERE id = '".$time_planid."' LIMIT 1");
					   
					   
					   if(!in_array($class_plan_query->row()->group_name,$group_name_arr)) $group_name_arr[] =  $class_plan_query->row()->group_name;
					   if(!in_array($class_plan_query->row()->coursemodule_id,$coursemodule_arr)) $coursemodule_arr[] =  $class_plan_query->row()->coursemodule_id;
					   
					   $course_relation_id = $class_plan_query->row()->course_relation_id;
					   $course_relation_query = $this->db->query("SELECT * FROM ".$this->fixidb->course_relation." WHERE id = '".$course_relation_id."' LIMIT 1");
					   
					   if(!in_array($course_relation_query->row()->course_id,$course_arr)) $course_arr[] =  $course_relation_query->row()->course_id;
					   					   						   
					   
				   }
				   
				   //var_dump($course_arr);
				   $output = "<script>";
				   $output .= "$('.course_id').html('');$('.coursemodule_id').html('');$('.group_name').html('');";
				   $output .= "$('.course_id').append(\"";
				   $output.="<option value=''>Please Select</option>";
				   foreach($course_arr as $k=>$v){
				   		
				   		
				   		$output.="<option value='".$v."'>".$this->course->get_name($v)."</option>";
				   		
				   }
				   $output .= "\");";
				   
				   
				   $output .= "$('.coursemodule_id').append(\"";
				   $output.="<option value=''>Please Select</option>";
				   foreach($coursemodule_arr as $k=>$v){
				   		
				   		
				   		$output.="<option value='".$v."'>".$this->coursemodule->get_name_by_id($v)."</option>";
				   		
				   }
				   $output .= "\");";				   

				   $output .= "$('.group_name').append(\"";
				   $output.="<option value=''>Please Select</option>";
				   foreach($group_name_arr as $k=>$v){
				   		
				   		
				   		$output.="<option value='".$v."'>".$v."</option>";
				   		
				   }
				   $output .= "\");";				   
				   $output .= "</script>";
				   
				   echo $output;
				   
			   }else{
				   
			   }
			  
			  
			  
		  }else if($_POST['action']=="getListOFGroupNameForExamResult"){
			  
			
				$course_relation_id = $_POST['course_relation_id'];  
				$coursemodule_id = $_POST['coursemodule_id'];
				$output = "";
				
				$class_plan_list = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id,$coursemodule_id);
				
				
				   $output.="<option value=''>Please Select</option>";
				   foreach($class_plan_list as $k=>$v){
				   		
				   		
				   		$output.="<option value='".$v['group_name']."' class_plan_id='".$v['id']."'>".$v['group_name']."</option>";
				   		
				   }
				   
				   echo $output;				
				
							  
		  }else if($_POST['action']=="examResultPublishDate"){
		  	  
		  	  
		  	  //var_dump($_POST);
		  	  
		  	  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  $args = array();
		  	  if(!empty($examresult_id_arr) && count($examresult_id_arr)>0){
		  		  foreach($examresult_id_arr as $v){
		  	  		  
		  	  		  $args['id'] = $v;
		  	  		  $args['publish_date'] = date("Y-m-d",strtotime($publishdate))." ".date("H:i:s",strtotime($publishtime));
		  	  		  //var_dump($args);
					  $insID = $this->examresult->update($args);
					  //var_dump($insID);  
		  		  }
			  }
		  	  $args = array();
		  	  //var_dump($register_id_arr);
		  	  if(!empty($register_id_arr) && is_array($register_id_arr) && count($register_id_arr)>0){
		  		  foreach($register_id_arr as $k=>$v){
		  	  		  
		  	  		  $group_name = $group_name_arr[$k];
		  	  		  $course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semister_id);
		  	  		  $class_plan      = $this->class_plan->checkIfClassPlanExistByGroupNameAndCourseRelationIDAndCourseModuleID($group_name,$course_relation_id,$coursemodule_id);
		  	  		  
		  	  		  //$args['id'] = $v;
		  	  		  $args['publish_date'] = date("Y-m-d",strtotime($publishdate))." ".date("H:i:s",strtotime($publishtime));
		  	  		  $args['class_plan_id'] = $class_plan;
		  	  		  $args['register_id'] = $v;
		  	  		  $args['staff_id'] = $this->session->userdata('uid');
		  	  		  $args['percentage'] = "";
		  	  		  $args['grade'] = "";
		  	  		  $args['marks'] = "";
		  	  		  $args['PaperID'] = "";
		  	  		  //var_dump($args);
					  $insID = $this->examresult->add($args);
					 // var_dump($insID);  
		  		  }	
			  }  	  
		  	  
		  	  echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Publish Date successfully updated.</p></div>";
		  	  echo"<script>window.location='".$current_url."';</script>";
			  
			  
			  
		  }else if($_POST['action']=="examResultAddResultData"){
			  //var_dump($_POST);
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  $args = array();
		  	  if($examresult_id>""){
		  	  	  
		  	  		  $args['id'] = $examresult_id;
		  	  		  if(!empty($percentage)) 	$args['percentage'] = $percentage;
		  	  		  if(!empty($grade))			$args['grade'] = strtoupper($grade);
		  	  		  if(!empty($marks))			$args['marks'] = $marks;
		  	  		  if(!empty($PaperID))		$args['PaperID'] = $PaperID;
		  	  		  //$args['publish_date'] = date("Y-m-d",strtotime($publishdate))." ".date("H:i:s",strtotime($publishtime));
		  	  		  //var_dump($args);
					  $previous_result_data = $this->examresult->get_by_ID($args['id']);
					  
					  foreach($previous_result_data as $k=>$v){
					  	  //$i=0;
						 if(array_key_exists($k,$args)){
							  if($v!=$args[$k]){
									$archive_arr=array();
									$archive_arr['examresult_id'] = $args['id'];
									$archive_arr['field_name'] = $k;
									$archive_arr['current_value'] = $args[$k];
									$archive_arr['previous_value'] = $v;
									$archive_arr['staff_id'] = $this->session->userdata('uid');
									//var_dump($archive_arr);
									$this->examresult_archive->add($archive_arr);

							  }
						 }   
					  }
					  
					  
					  $insID = $this->examresult->update($args);	
					  

					  			  
		  	  }else{
				  
		  	  		  //$group_name = $group_name_arr[$k];
		  	  		  $course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semister_id);
		  	  		  $class_plan      = $this->class_plan->checkIfClassPlanExistByGroupNameAndCourseRelationIDAndCourseModuleID($group_name,$course_relation_id,$coursemodule_id);
		  	  		  
		  	  		  //$args['id'] = $v;
		  	  		  if(!empty($class_plan))		$args['class_plan_id'] = $class_plan;
		  	  		  if(!empty($register_id))	$args['register_id'] = $register_id;
		  	  		  $args['staff_id'] = $this->session->userdata('uid');
		  	  		  if(!empty($percentage))	$args['percentage'] = $percentage;
		  	  		  if(!empty($grade))			$args['grade'] = strtoupper($grade);
		  	  		  if(!empty($marks))			$args['marks'] = $marks;
		  	  		  if(!empty($PaperID))		$args['PaperID'] = $PaperID;
		  	  		  //var_dump($class_plan);
					  $insID = $this->examresult->add($args);				  				  
		  	  }
		  	  
		  	  
		  	  echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Exam result successfully updated.</p></div>";
		  	  echo"<script>window.location='".base_url()."index.php/exam_result_management/?action=search';</script>";	
		  	  
		  }else if($_POST['action']=="examResultPostAllResult"){
			 // var_dump($_POST);
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  $args = array();
		  	  if($examresult_id>""){
		  	  	  
		  	  		  $args['id'] = $examresult_id;
		  	  		  if(!empty($percentage)) 	$args['percentage'] = $percentage;
		  	  		  if(!empty($grade))			$args['grade'] = strtoupper($grade);
		  	  		  if(!empty($marks))			$args['marks'] = $marks;
		  	  		  if(!empty($PaperID))		$args['PaperID'] = $PaperID;
		  	  		  //$args['publish_date'] = date("Y-m-d",strtotime($publishdate))." ".date("H:i:s",strtotime($publishtime));
		  	  		  //var_dump($args);
					  $previous_result_data = $this->examresult->get_by_ID($args['id']);
					  
					  foreach($previous_result_data as $k=>$v){
					  	  //$i=0;
						 if(array_key_exists($k,$args)){
							  if($v!=$args[$k]){
									$archive_arr=array();
									$archive_arr['examresult_id'] = $args['id'];
									$archive_arr['field_name'] = $k;
									$archive_arr['current_value'] = $args[$k];
									$archive_arr['previous_value'] = $v;
									$archive_arr['staff_id'] = $this->session->userdata('uid');
									//var_dump($archive_arr);
									$this->examresult_archive->add($archive_arr);

							  }
						 }   
					  } 
					  //var_dump($previous_result_data);
					  //var_dump($args['grade']);
					  //$this->examresult_archive->add($archive_arr);		  	  		  
		  	  		  
					  $insID = $this->examresult->update($args);	
					  			  
		  	  }else{
				  
		  	  		  //$group_name = $group_name_arr[$k];
		  	  		  $course_relation_id = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semister_id);
		  	  		  $class_plan      = $this->class_plan->checkIfClassPlanExistByGroupNameAndCourseRelationIDAndCourseModuleID($group_name,$course_relation_id,$coursemodule_id);
		  	  		  
		  	  		  //$args['id'] = $v;
		  	  		  if(!empty($class_plan))		$args['class_plan_id'] = $class_plan;
		  	  		  if(!empty($register_id))	$args['register_id'] = $register_id;
		  	  		  $args['staff_id'] = $this->session->userdata('uid');
		  	  		  if(!empty($percentage))	$args['percentage'] = $percentage;
		  	  		  if(!empty($grade))			$args['grade'] = strtoupper($grade);
		  	  		  if(!empty($marks))			$args['marks'] = $marks;
		  	  		  if(!empty($PaperID))		$args['PaperID'] = $PaperID;
		  	  		  //var_dump($args);
					  $insID = $this->examresult->add($args);				  				  
		  	  }
		  	  
		  	  
		  	  //echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Exam result successfully updated.</p></div>";
		  	  //echo"<script>window.location='".base_url()."index.php/exam_result_management/?action=search';</script>";		  	  	  	  		  
			  
		  }else if($_POST['action']=="examResultfeedbackFilepath"){
			  
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  $args = array();
		  	  $args['id'] = $examresult_id;
		  	  $args['feedback_link'] = $filepath;
		  	  			  
			  $insID = $this->examresult->update($args);
			  
		  	  echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Exam result successfully updated.</p></div>";
		  	  echo"<script>window.location='".base_url()."index.php/exam_result_management/?action=search';</script>";			  
			  
		  }else if($_POST['action']=="examResultGetResultData"){
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  
		  	  $examresult_data = $this->examresult->get_by_ID($examresult_id);
		  	  echo"<script>
		  	  		$('#resultDataModal input.percentage').val('".$examresult_data['percentage']."');
		  	  		$('#resultDataModal input.grade').val('".$examresult_data['grade']."');
		  	  		$('#resultDataModal input.marks').val('".$examresult_data['marks']."');
		  	  		$('#resultDataModal input.PaperID').val('".$examresult_data['PaperID']."');
		  	  		
		  	      </script>";			  
			  
		  }else if($_POST['action']=="studentManagementNewAgreement"){
		  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
				  if($k!="action" && $k!="amount_arr" && $k!="installment_date_arr" && $k!="agreement_date"){
					  $args[$k]=$$k;
				  }
		  	  }
		  	  $args['staff_id'] = $this->session->userdata('uid');
		  	  $args['date'] = date("Y-m-d",strtotime($agreement_date));
		  	  $total_amount=0;
		  	  foreach($amount_arr as $k=>$v){
		  	  	$total_amount+=$v;	  
			  }
			  
			  if($discount==0){
				  $args['total_amount'] = $fees;
				  
			  }else{
				  $args['total_amount'] = $fees - $discount;
			  }
		  	  
		  	  $agreement_id = $this->agreement->add($args);
		  	  $num_success = 0; 
		  	  foreach($amount_arr as $k=>$v){
		  	  	
		  	  		$installment_arr = array();  
		  	  		$installment_arr['installment_date'] = date("Y-m-d",strtotime($installment_date_arr[$k]));				  
		  	  		$installment_arr['agreement_id'] = $agreement_id;				  
		  	  		$installment_arr['amount'] = $v;				  
				    
				    $installment_id = $this->installment->add($installment_arr);
				    if($installment_id) $num_success++; 
		  	  }
		  	  if(count($amount_arr) == $num_success && !empty($agreement_id)){
				 echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> New Agreement successfully added.</p></div>";  
		  	  }else{
					echo"<div class=\"alert alert-danger\"><p><span class=\"fa fa-close\"></span> Error occured.</p></div>";  
		  	  }
		  	  //var_dump($_POST);
		  	  
		  	  
		  	  		  	  
		  
		  }else if($_POST['action']=="studentManagementNewPayment"){
		  

		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
				  if($k!="action"){
					  $args[$k]=$$k;
				  }
		  	  }
               if($args['payment_mode'] == 3) {
                    $args['invoice_no']        =   "R-".$args['invoice_no'];
               }
		  	  $args['payment_date']      =   date("Y-m-d",strtotime($payment_date));
		  	  $args['received_by_staff'] =   $this->session->userdata('uid');

		  	  $insID = $this->money_receipt->add($args);
		  	   echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> New Payment successfully added.</p></div>";		  
		  
		  }else if($_POST['action']=="studentManagementPaymentRefund"){
			
		  	  foreach($_POST as $k=>$v){
				  $$k=tinymce_encode($v);
		  	  }
		  	  
		  	  $money_receipt_data = $this->money_receipt->get_by_ID($money_receipt_id);			 
			  
			  $args = array();
			  $args['register_id'] 				= $money_receipt_data['register_id'];
			  $args['invoice_no'] 				= "R-".$money_receipt_data['invoice_no'];
			  $args['refund_invoice_no'] 		= $money_receipt_data['invoice_no'];
			  $args['payment_mode'] 			= "3";
			  $args['received_by_staff'] 		= $this->session->userdata('uid');
			  $args['payment_date'] 			= date("Y-m-d",strtotime($refund_date));
			  $args['remarks'] 					= $refund_reason;
			  $args['amount'] 					= $money_receipt_data['amount'];
			  $args['agreement_id'] 			= $money_receipt_data['agreement_id'];
			  $args['refund_admin_fee'] 		= $refund_admin_fee;
			  
			  $insID = $this->money_receipt->add($args);
			  
			  echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Refund successfully added.</p></div>";
		  
		  
		  }else if($_POST['action']=="addMultiPaymentFromCSVFile"){
		  	  
		  	  
		  	  $file = $_POST['file'];
		  	  
		  	  //echo $file;
		  	    $csv = array();
				$file = file($file);
				foreach($file as $k)
				$csv[] = explode(',', $k);

				//print_r($csv);
				$not_found_list 	= array(); $found_list = array();
				foreach($csv as $k=>$v){
					
					if($k>0){
						
						$ssn_no 			= tinymce_encode($v[0]);
						$slc_course_code 	= tinymce_encode($v[1]);
						$year 				= tinymce_encode($v[2]);
						$amount             = tinymce_encode($v[3]);
						$payment_date 		= tinymce_encode($v[4]);
						//var_dump($payment_date);
						if($payment_date=='\r\n' || $payment_date=='') $payment_date = date("d-m-Y");  
						
						if(!empty($ssn_no) && !empty($slc_course_code) && !empty($year) && !empty($amount)){
							
							$chkSsn = $this->register->chkIfExistSSNnumber($ssn_no);
							
							if($chkSsn!=false){
								
								$register_id = $chkSsn['register_id'];
								$chkAgreement = $this->agreement->get_by_slc_coursecode_and_year_and_register_id($slc_course_code,$year,$register_id);
								
								if($chkAgreement!=false){
									
									$invoiceNo = $this->money_receipt->getLastInvoiceNoByRegisterIDAndAgreementID($register_id,$chkAgreement['id']);
									
									$args = array();
									$args['register_id'] = $register_id;
									$args['invoice_no'] = $invoiceNo;
									$args['refund_invoice_no'] = 0;
									$args['payment_mode'] = 2;
									$args['received_by_staff'] = $this->session->userdata('uid');					
									$args['payment_date'] = date("Y-m-d",strtotime($payment_date));
									$args['remarks'] = "";
									$args['amount'] = $amount;
									$args['agreement_id'] = $chkAgreement['id'];
									//var_dump($payment_date);
									//$this->money_receipt->add($args);
									$found_list[] = array($ssn_no,$slc_course_code,$year,$amount,$payment_date,$args);
									
									
								}else{
									
									$not_found_list[] = array($ssn_no,$slc_course_code,$year,$amount,$payment_date);
								}
								
								
								
							}else{
																
								$not_found_list[] = array($ssn_no,$slc_course_code,$year,$amount,$payment_date);
							}
							
						}else{
							
							  $not_found_list[] = array($ssn_no,$slc_course_code,$year,$amount,$payment_date);
							
						}
						
						
						
					}/// if($k>0){
					
					
				}
				
				
				$html = ""; $i=1;
				
				if(!empty($found_list) && count($found_list)>0){
					
								$html .= '
								
								<div class="panel panel-primary margin-top-2">
								  <div class="panel-heading">
								  		
								  	<div class="col-xs-12 no-pad">		
								  		<div class="col-xs-6">
								  		Matched Data List
								        </div>
								  		<div class="col-xs-6 text-right">
								  		<button class="btn btn-success btn-sm add-matched-row">Add Payment</button>
								        </div>
								        <div class="clearfix"></div>
								    </div>
								   <div class="clearfix"></div>     								        
								  </div>
								  <div class="panel-body">								
								
									<table class="table table-bordered">						
										<thead>
											<tr>
												<th>#</th>
												<th>SSN NO</th>
												<th>COURSE ID</th>
												<th>YEAR</th>
												<th>AMOUNT</th>
												<th>PAYMENT DATE</th>
												<th>Remove</th>
											</tr>
										</thead>
										<tbody class="matched-row-tbody">';


							foreach($found_list as $k=>$v){
								
								
								$html .= '
											<tr class="matched-row"';
								$args = array(); $args = $v[5];			
								foreach($args as $a=>$b){
									$html .= ' '.$a.'="'.$b.'" ';	
								}			
											
								$html .= '
										>
												<th scope="row">'.$i.'</th>
												<td>'.$v[0].'</td>
												<td>'.$v[1].'</td>
												<td>'.$v[2].'</td>
												<td>'.$v[3].'</td>
												<td>'.$v[4].'</td>
												<td><button class="btn btn-danger btn-sm remove-matched-row"><i class="fa fa-times"></i></button></td>
											</tr>
								
								
								';
								$i++;
								
								
							}										
										
										
							$html .= '							
										</tbody>
									</table>
							      </div>
							      <div class="panel-footer text-right"><button class="btn btn-success btn-sm add-matched-row">Add Payment</button></div>
							    </div>  
							    <script>removeMatchedRow();addMatchedRow();</script>
							    ';															
					
				}
				
				
				
				$i=1;
				if(!empty($not_found_list) && count($not_found_list)>0){				
								$html .= '
								<div class="panel panel-default">
								  <div class="panel-heading">Unmatched Data List</div>
								  <div class="panel-body">								
									<table class="table table-bordered">						
										<thead>
											<tr>
												<th>#</th>
												<th>SSN NO</th>
												<th>COURSE ID</th>
												<th>YEAR</th>
												<th>AMOUNT</th>
												<th>PAYMENT DATE</th>
											</tr>
										</thead>
										<tbody>';				
							
							foreach($not_found_list as $k=>$v){
								
								
								$html .= '
											<tr>
												<th scope="row">'.$i.'</th>
												<td>'.$v[0].'</td>
												<td>'.$v[1].'</td>
												<td>'.$v[2].'</td>
												<td>'.$v[3].'</td>
												<td>'.$v[4].'</td>
											</tr>
								
								
								';
								$i++;
								
								
							}
							
							$html .= '							
										</tbody>
									</table>
							      </div>
							    </div>  ';
									
				}else{
					
								$html .= '<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> All Payment Succesfully Updated.</p></div>';					
					
				}				
				
				echo $html;		  	  
			  
			  
			  
			  
		  }else if($_POST['action']=="addMultiPaymentFromCSVFileConfirm"){
			  
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  
		  	  foreach($agreement_id_arr as $k=>$v){
									
									$args = array();
									$args['register_id'] = $register_id_arr[$k];
									$args['invoice_no'] = $invoice_no_arr[$k];
									$args['refund_invoice_no'] = 0;
									$args['payment_mode'] = 2;
									$args['received_by_staff'] = $this->session->userdata('uid');					
									$args['payment_date'] = $payment_date_arr[$k];
									$args['remarks'] = "";
									$args['amount'] = $amount_arr[$k];
									$args['agreement_id'] = $v;
									$this->money_receipt->add($args);				  
				  
		  	  }			  
			  
			  echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> All Payment Succesfully Updated.</p></div>
			  		<script>$('button.add-matched-row').hide();$('button.remove-matched-row').hide();</script>";
			  
			  
		  }else if($_POST['action']=="getAgreementDataForEdit"){
			  
				$agreement_id = $_POST['agreement_id'];
				
				$agreement_data = $this->agreement->get_by_ID($agreement_id);
				
				echo"<script>
						$('#editAgreement .ea_slc_coursecode').val('".$agreement_data['slc_coursecode']."');
						$('#editAgreement .ea_year').val('".$agreement_data['year']."');
						$('#editAgreement .ea_date').val('".date("d-m-Y",strtotime($agreement_data['date']))."');
						$('#editAgreement .ea_discount').val('".$agreement_data['discount']."');
						$('#editAgreement .ea_fees').val('".$agreement_data['fees']."');
						$('#editAgreement .ea_id').val('".$agreement_data['id']."');
				     </script>";			  
			  
		  }else if($_POST['action']=="updateAgreementOfAccount"){
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  $agreement_data = $this->agreement->get_by_ID($id);
		  	  
		  	  $args = array(); 
		  	  if(!empty($discount) && $discount>0 && $agreement_data['discount']!=$discount){
				  
				   $fees = $agreement_data['fees'];
				   $total = $fees - $discount;
				   $args['total_amount'] = $total;
				   $args['discount'] = $discount;
		  	  }
		  	  if(!empty($date)) $args['date'] = date("Y-m-d",strtotime($date));
		  	  if(!empty($year) && $agreement_data['year']!=$year) $args['year'] = intval($year);
		  	  if(!empty($slc_coursecode) && $agreement_data['slc_coursecode']!=$slc_coursecode) $args['slc_coursecode'] = $slc_coursecode;
		  	  
		  	  $args['staff_id'] = $this->session->userdata('uid');
		  	  $args['id'] = $agreement_data['id'];
		  	  $update_agreement = $this->agreement->update($args);
		  	  
		  	  if($update_agreement) echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Agreement Updated successfully.</p></div>";
		  	  else echo"<div class=\"alert alert-danger\"><p><span class=\"fa fa-times\"></span> Error occured while updating agreement.</p></div>";
		  	  		  
			  
		  }else if($_POST['action']=="getInstallmentDataForEdit"){
			   $agreement_data = $this->agreement->get_by_ID($_POST['agreement_id']);
			   $installment_data = $this->installment->get_by_agreement_id($_POST['agreement_id']);
			   //var_dump($_POST);
			   $html = "";
			   foreach($installment_data as $k=>$v){
				   
				  $html .= '<div class="edit-payment-row"><div class="col-sm-5 no-pad-left"><input type="text" class="edit_payment_date form-control date" name="edit_payment_date[]" value="'.date("d-m-Y",strtotime($v['installment_date'])).'"></div><div class="col-sm-5"><input type="text" class="edit_payment_amount form-control" name="edit_payment_amount[]" value="'.$v['amount'].'"></div><div class="col-sm-2 no-pad-right text-right"><a href="#" class="btn btn-danger edit-payment-del-row"><i class="fa fa-times-circle"></i></a></div><p class="clearfix"></p></div>'; 
				   
			   }
			   
			   $html .= '<script>$(".editPaymentPlan-show-total_amount").html("'.sprintf("%0.2f",$agreement_data['total_amount']).'");$("#editPaymentPlan .editPaymentPlan_total_amount").val("'.$agreement_data['total_amount'].'");$(".date").datepicker({ dateFormat: "dd-mm-yy" }); calculateEditPaymentRemain(); removeEditPaymentRow(); calculate_edit_payment_amount_change();</script>';
			  
			   echo $html; 
			  
		  }else if($_POST['action']=="studentManagementUpdateInstallment"){
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  
		       $del =  $this->installment->delete_by_agreement_id($agreement_id);
		       
		       if($del){
				   
		  			  $num_success = 0; 
		  			  foreach($amount_arr as $k=>$v){
		  	  			
		  	  				$installment_arr = array();  
		  	  				$installment_arr['installment_date'] = date("Y-m-d",strtotime($installment_date_arr[$k]));				  
		  	  				$installment_arr['agreement_id'] = $agreement_id;				  
		  	  				$installment_arr['amount'] = $v;				  
						    
						    $installment_id = $this->installment->add($installment_arr);
						    if($installment_id) $num_success++; 
		  			  }
		  			  if(count($amount_arr) == $num_success){
						 echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Payment plan successfully updated.</p></div>";  
		  			  }else{
							echo"<div class=\"alert alert-danger\"><p><span class=\"fa fa-close\"></span> Error occured.</p></div>";  
		  			  }				   
		       }
			  
		  }else if($_POST['action']=="checkAndRemoveFromRegisterIfExist"){
			  
			  
			  //var_dump($_POST);
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  
		  	  $chk_reg = $this->register->get_by_student_ID($id);
		  	  
		  	  if(!empty($chk_reg) && count($chk_reg)>0){
			  		$this->register->delete($chk_reg['id']); 
		  	  }
		  	  $chk_std_info = $this->student_information->get_by_student_data_id_by_array($id);
		  	  if(!empty($chk_std_info) && count($chk_std_info)>0){
				    $this->student_information->delete($chk_std_info['id']);
            //echo "1";
		  	  }
		  	  /////--------------- NEED TO DELETE ALSO FROM HESA
              $hesa_student_information_data = $this->hesa_student_information->get_by_student_data_id_and_register_id($id,$chk_reg['id']);
              if(!empty($hesa_student_information_data)){
                    $this->hesa_student_information->delete($hesa_student_information_data['id']);   
              }			  
			  
			  //echo $del_id; 
			  
		  }else if($_POST['action']=="studentManagementNewPaymentGenerateInvoice"){
			  
			  
			 $number = (strtotime(date("d-m-Y h:i:s"))); 
			 echo $number; 
			  
		  }else if($_POST['action']=="addStudentIntoInduction"){
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  
		  	  $induction = $this->job_induction->get_by_ID($induction_id);
		  	  
		  	  if(!empty($induction['assigned_students'])){
				  $assigned = array();
				  $assigned = unserialize($induction['assigned_students']);
				  if(!empty($student_id_list) && count($student_id_list)>0){
					foreach($student_id_list as $student_data_id){
						$found=0;
						foreach($assigned as $chkassigned){
							if($chkassigned==$student_data_id) $found = 1;
						}
						if($found==0)$assigned[] = $student_data_id;	
					}  
				  }				  
				  $args['id'] = $induction_id;
				  $args['assigned_students'] = serialize($assigned);
				  //var_dump($args);
				  $this->job_induction->update($args);
				   	
		  	  }else{
				  
                  $assigned = array();
                  
				  if(!empty($student_id_list) && count($student_id_list)>0){
					foreach($student_id_list as $student_data_id){
						$assigned[] = $student_data_id;	
					}  
				  }                  

				  $args['id'] = $induction_id;
				  $args['assigned_students'] = serialize($assigned);
				  //var_dump($args);
				  $this->job_induction->update($args);				  
				  
		  	  }
		  	  
		  	  echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Student successfully added to induction.</p></div>";			  
			  
		  }else if($_POST['action']=="removeStudentFromInduction"){
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }
		  	  
		  	  $induction = $this->job_induction->get_by_ID($induction_id);			  
		  	  if(!empty($induction['assigned_students'])){
				  $assigned = array();
				  $assigned = unserialize($induction['assigned_students']);
				  $assigned = array_merge(array_diff($assigned, array($student_data_id)));
				  $args['id'] = $induction_id;
				  $args['assigned_students'] = serialize($assigned);
				  
				  $this->job_induction->update($args);
				   	
		  	  }			  
			  
		  }else if($_POST['action']=="changeJobAssignStatus"){
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }			  
			  $args['id'] = $job_assign_id;
			  $args['status'] = $thisvalue;
              if(!empty($declined_reason)) $args['declined_reason'] = tinymce_encode($declined_reason); 
			  //var_dump($args); 
			 $this->job_assign->update($args); 
		  
		  }else if($_POST['action']=="setSessionAssignedJobsViewPanel"){
			  
		  	  foreach($_POST as $k=>$v){
				  $$k=$v;
		  	  }	
					$sesData = array();
				    $sesData['setSessionAssignedJobsViewPanel'] = $panelname;
				    $this->session->set_userdata($sesData);		  	  			  
		  
          }else if($_POST['action'] == "updateHesaStudentInformation"){
                $args = array();
                foreach($_POST as $k=>$v){
                  $$k=$v;
                  //$args[$k] = $$k; 
                }
                if(!empty($hesa_student_information_id)){
                    $args['id'] = $hesa_student_information_id;
                    $args['hesa_class_id'] = $hesa_class_id;
                    $this->hesa_student_information->update($args);    
                }else{
                    $reg_data = $this->register->get_by_student_ID($student_data_id);
                    $hesa_student_information_data = $this->hesa_student_information->get_by_student_data_id_and_register_id($student_data_id,$reg_data['id']);
                    if(empty($hesa_student_information_data)){
                        $args['student_data_id']    = $student_data_id;
                        $args['register_id']        = $reg_data['id'];
                        $args['hesa_class_id']      = $hesa_class_id;
                        $this->hesa_student_information->add($args);                        
                    }else{
                        $args['id'] = $hesa_student_information_data['id'];
                        $args['hesa_class_id'] = $hesa_class_id;
                        $this->hesa_student_information->update($args);                        
                    }
                }
 
                
                
                //var_dump($args);                  
                echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Student information updated successfully.</p></div>";
              
          }else if($_POST['action']=="changeStudentAccess"){
              
                 foreach($_POST as $k=>$v){
                  $$k=$v;
                  //$args[$k] = $$k; 
                }
                
                //var_dump($args);
                $query=$this->db->query("SELECT id,student_status FROM ".$this->fixidb->student_data." WHERE id='".$student_data_id."' LIMIT 1");
                if($query->num_rows()>0){
                    $current_status = $query->row()->student_status;
                    if($current_status=="active") { 
                        $this->student_data->update(array("student_status"=>"inactive","id"=>$student_data_id));
                        echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Student account's access has been locked.</p></div>"; 
                    }
                    else if($current_status=="inactive") {
                        $this->student_data->update(array("student_status"=>"active","id"=>$student_data_id));
                        echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Student account's access has been unlocked.</p></div>";                        
                    } 
                }
                //var_dump($current_status);             
              
          }else if($_POST['action']=="deleteFromNote"){
              
                 foreach($_POST as $k=>$v){
                  $$k=$v; 
                }              
              
              $this->notes->delete($id);
              
          }else if($_POST['action']=="updateCertificateStudentInformation"){

                 foreach($_POST as $k=>$v){
                  $$k=tinymce_encode($v);
                  if($k=="date_of_certificate_request" || $k=="date_of_certificate_received" || $k=="date_of_certificate_release"){ if(!empty($$k)) $args[$k] = date("Y-m-d",strtotime($$k)); else $args[$k] = "0000-00-00";  }   
                  else if($k!="action") $args[$k] = $$k;
                 }               
                //var_dump($args);                
                $update = $this->student_information->update($args);
                if($update) echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Student info has been updated successfully.</p></div>";              
                else echo"<div class=\"alert alert-danger\"><p><span class=\"fa fa-times\"></span> Can't update student info.</p></div>";              
              
          }else if($_POST['action']=="remove_coc_upload"){
              
                $id = $_POST['id'];
              
                $this->coc_upload->delete($id);

          }else if($_POST['action']=="getAttemptresult"){
              
                $id = $_POST['id'];
                $coursemodule_id = $_POST['coursemodule_id'];
              
                //$this->coc_upload->delete($id);
                ?>
                <table class="table table-bordered" width="100%">
			              <thead>
			                <th>Module Name</th>
			                <th>Grade</th>
			                <th>Status</th>
			                <th>Paper Id</th>
			                <th>Exam Date</th>
			              </thead>
              					<tbody>
		                        <?php 
		                         
		                           $attempt_info = $this->exam_result_prev->get_student_Moduledata_Byid($id,$coursemodule_id);
		                           if (!empty($attempt_info)) {
		                             foreach ($attempt_info as $key => $value) {
		                               ?>
		                               <tr>
                    					<?php $cm = $this->coursemodule->get_name_by_id($coursemodule_id); ?>
                                		 <td><?php echo $cm; ?></td>
		                                 <td><?php echo !empty($value['grade']) ? $value['grade'] : ""; ?></td>
		                                 <td><?php echo !empty($value['status']) ? $value['status'] : ""; ?></td>
		                                 <td><?php echo ($value['paperID']>0) ? $value['paperID'] : ""; ?></td>
		                                 <td><?php echo $value['exam_date']; ?></td>
		                               </tr>
		                               <?php
		                             }
		                           }
		                         
		                         ?>
		                          </tbody>
                         </table>
                <?php
                

          }else if($_POST['action']=="updaterAttendanceIndicatorOfRegister"){
              
              $reg_arr = array();
              $reg_arr['id'] = $_POST['register_id'];
              $reg_arr['attendance_indicator'] = $_POST['attendance_indicator'];
              $update = $this->register->update($reg_arr);
              
              if($update) echo"<div class=\"alert alert-success\"><p><span class=\"fa fa-check\"></span> Attendence has been updated successfully.</p></div>";
              
          }
		  
		  
		  ///--$arr = array_merge(array_diff($arr, array("yellow", "red")));    
          
          
/////--------------------------------------------------------------------------------------------          
          



















		   
      
      }  
}
?>
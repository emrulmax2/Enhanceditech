<?php
	/// get staff access
	if($this->session->userdata('label')=="staff"){
		// $staff_privileges_student_admission = $this->session->userdata('staff_privileges_student_admission');
		// $staff_privileges_staff_management = $this->session->userdata('staff_privileges_staff_management');
		// $staff_privileges_agent_management = $this->session->userdata('staff_privileges_agent_management');
		// $staff_privileges_semister_management = $this->session->userdata('staff_privileges_semister_management');
		// $staff_privileges_course_management = $this->session->userdata('staff_privileges_course_management');
		// $staff_privileges_course_relation_management = $this->session->userdata('staff_privileges_course_relation_management');
		// $admin_report_management = $this->session->userdata('admin_report_management');
		// $admin_inbox_management = $this->session->userdata('admin_inbox_management');
		// $admin_exam_management = $this->session->userdata('admin_exam_management');
        $staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));
		
	}
	
?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse ">
                
                
                <ul id="emulated"   class="nav navbar-nav side-nav">
                 
                    <li class="<?php if($this->router->class == "admin_dashboard") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/admin_dashboard.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#management"><i class="fa fa-cog"></i> Management <i class="fa fa-fw fa-caret-down"></i></a>
                     <ul id="management" class="collapse"> 
<?php
 if(!empty($staff_access['staff_privileges']['course_management']) || $this->session->userdata('label')=="admin"){                          	
?>                          
	                    <li class="<?php if($this->router->class == "course_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/course_management"><i class="fa fa-fw fa-book"></i> Course</a>
	                    </li>
<?php
 }
 if(!empty($staff_access['staff_privileges']['semester_management']) || $this->session->userdata('label')=="admin"){	                    	
?>	                    
	                    <li class="<?php if($this->router->class == "semester_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/semester_management"><i class="fa fa-fw fa-cubes"></i> Semester</a>
	                    </li>
<?php
 }
 if(!empty($staff_access['staff_privileges']['course_relation_management']) || $this->session->userdata('label')=="admin"){	                    	
?>	                    
	                    <li class="<?php if($this->router->class == "course_relation_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/course_relation_management"><i class="fa fa-share-alt"></i> Course Relation</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['course_module_relation_management']) || $this->session->userdata('label')=="admin"){    
?>
	                    <!-- <li class="<?php if($this->router->class == "module_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/module_management"><i class="fa fa-leaf"></i> Modules</a>
	                    </li> -->
	                    <li class="<?php if($this->router->class == "course_module_relation_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/course_module_relation_management"><i class="fa fa-share-alt"></i> Course Module Relation</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['gender_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "gender_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/gender_management"><i class="fa fa-female"></i> Gender</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['marital_status_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "marital_status_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/marital_status_management"><i class="fa fa-weixin"></i> Marital Status</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['title_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "title_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/title_management"><i class="fa fa-info"></i> Title</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['others_ethnicity_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "others_ethnicity_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/others_ethnicity_management"><i class="fa fa-ils"></i> Ethnicity</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['country_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "country_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/country_management"><i class="fa fa-globe"></i> Country</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['others_disabilities_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "others_disabilities_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/others_disabilities_management"><i class="fa fa-wheelchair"></i> Disabilities Management</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['status_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "status_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/status_management"><i class="fa fa-check-square-o"></i> Status Management</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['currency_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "currency_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/currency_management"><i class="fa fa-usd"></i> Currency Management</a>
	                    </li>
<?php
 }
  if(!empty($staff_access['staff_privileges']['awarding_body_management']) || $this->session->userdata('label')=="admin"){    
?>                        
	                    <li class="<?php if($this->router->class == "awarding_body_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/awarding_body_management"><i class="fa fa-check-square-o"></i> Awarding Body</a>
	                    </li>
	                    <!-- <li class="<?php if($this->router->class == "slc_coursecode_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/slc_coursecode_management"><i class="fa fa-user"></i> Slc Course Code</a>
	                    </li> -->	                    	                    	                    	                    	                    	                    
<?php
 }
  if(!empty($staff_access['staff_privileges']['agent_management']) || $this->session->userdata('label')=="admin"){    
?>		                    
	                    <li class="<?php if($this->router->class == "agent_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/agent_management"><i class="fa fa-fw fa-paw"></i> Agent</a>
	                    </li>
<?php
 }
  if($this->session->userdata('label')=="admin"){    
?>	                    
	                    <li class="<?php if($this->router->class == "staff_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/staff_management"><i class="fa fa-fw fa-user"></i> Staff</a>
	                    </li>
<?php
 } 
?>                   	                    	                    	                    	                    
                    </ul>
                    </li>
<?php

// if(!empty($staff_privileges_student_admission['std_ad']) || $this->session->userdata('label')=="admin"){                          	
?>                    
                    <!-- <li class="<?php if($this->router->class == "student_admission_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/student_admission_management"><i class="fa fa-users"></i> Student Admission</a>
                    </li> -->
<?php
// }

///////////// need to add priviledge                                                           	
?>
                    <!-- <li class="<?php if($this->router->class == "registration_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/registration/registration_management/"><i class="fa fa-users"></i> Registration</a>
                    </li> -->
                    
                    
                    <li>                    
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#student_management"><i class="fa fa-users"></i> Student Management <i class="fa fa-fw fa-caret-down"></i></a>
	                     <ul id="student_management" class="collapse">

<?php
if(!empty($staff_access['staff_privileges']['student_admission_management']) || $this->session->userdata('label')=="admin"){                              
?>                         
	                     <li class="<?php if($this->router->class == "student_admission_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/student_admission_management"><i class="fa fa-users"></i> Admission</a>
	                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['registration_management']) || $this->session->userdata('label')=="admin"){                            
?>                        
	                    <li class="<?php if($this->router->class == "registration_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/registration/registration_management/"><i class="fa fa-users"></i> Registration</a>
	                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['live_student_management']) || $this->session->userdata('label')=="admin"){                             
?>                        
		                <li class="<?php if($this->router->class == "student_management") echo "active"; ?>">
		                    <a href="<?php echo base_url(); ?>index.php/student/student_management/"><i class="fa fa-users fa-5x"></i> Live Student</a>
		                </li>
<?php
}                                                                                  
?>		                    		                                          
	                    </ul>
                    </li>

                    <li>                    
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#job_management"><i class="fa fa-briefcase"></i> Job Management <i class="fa fa-fw fa-caret-down"></i></a>
	                     <ul id="job_management" class="collapse">
<?php
if(!empty($staff_access['staff_privileges']['job_type_management']) || $this->session->userdata('label')=="admin"){                             
?>                          
	                     <li class="<?php if($this->router->class == "job_type_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/job_induction/job_type_management"><i class="fa fa-briefcase"></i> Job Type Management</a>
	                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['job_department_management']) || $this->session->userdata('label')=="admin"){                             
?>                        
	                     <li class="<?php if($this->router->class == "job_department_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/job_induction/job_department_management"><i class="fa fa-sitemap"></i> Job Dept. Management</a>
	                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['job_management']) || $this->session->userdata('label')=="admin"){                             
?>                        
	                    <li class="<?php if($this->router->class == "job_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/job_induction/job_management"><i class="fa fa-briefcase"></i> Jobs Management</a>
	                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['induction_management']) || $this->session->userdata('label')=="admin"){                             
?>                        
	                    <li class="<?php if($this->router->class == "job_induction_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/job_induction/job_induction_management"><i class="fa fa-cog"></i> Induction </a>
	                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['induction_processing_management']) || $this->session->userdata('label')=="admin"){                             
?>                        
                        <li class="<?php if($this->router->class == "job_induction_processing_management") echo "active"; ?>">
                            <a href="<?php echo base_url(); ?>index.php/job_induction/job_induction_processing_management"><i class="fa fa-cogs"></i> Induction Processing</a>
                        </li>
<?php
}
if(!empty($staff_access['staff_privileges']['assigned_job_management']) || $this->session->userdata('label')=="admin"){                             
?>                        
	                    <li class="<?php if($this->router->class == "assigned_jopbmanagement") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/job_induction/assigned_jobmanagement"><i class="fa fa-paperclip"></i> Assigned Jobs</a>
	                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['assign_new_job_management']) || $this->session->userdata('label')=="admin"){                             
?>                        	                    	                    
	                    <li class="<?php if($this->router->class == "assign_new_job_management") echo "active"; ?>">
	                        <a href="<?php echo base_url(); ?>index.php/job_induction/assign_new_job_management"><i class="fa fa-paperclip"></i> Assign New Jobs</a>
	                    </li>
<?php
}                             
?>                        		                    		                                          
	                    </ul>
                    </li>                  
                    
                    
                    <li>                    
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#letter_management"><i class="fa fa-envelope"></i> Letter Management <i class="fa fa-fw fa-caret-down"></i></a>
	                     <ul id="letter_management" class="collapse">
<?php
if(!empty($staff_access['staff_privileges']['letter_management']) || $this->session->userdata('label')=="admin"){                             
?>                                                   
		                    <li class="<?php if($this->router->class == "letter_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/registration/letter_management"><i class="fa fa-envelope"></i>  Letter</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['signatory_management']) || $this->session->userdata('label')=="admin"){                             
?>                                                        
		                    <li class="<?php if($this->router->class == "signatory_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/registration/signatory_management"><i class="fa fa-pencil-square-o"></i>  Signatory</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['send_letter_management']) || $this->session->userdata('label')=="admin"){                             
?>                                                        
		                    <li class="<?php if($this->router->class == "send_letter") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/send_letter"><i class="fa fa-envelope"></i> Bulk Communications</a>
		                    </li>
<?php
}                             
?>                            
                            		                                          
	                    </ul>
                    </li>
                    <li>                    
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendance_management"><i class="fa fa-check-square-o"></i> Attendance<i class="fa fa-fw fa-caret-down"></i></a>
	                     <ul id="attendance_management" class="collapse">
<?php
if(!empty($staff_access['staff_privileges']['attendance_alert_management']) || $this->session->userdata('label')=="admin"){                             
?>                         
	                     	<li class="<?php if($this->router->class == "attendance_alert") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/attendance_alert"><i class="fa fa-exclamation-triangle"></i>  Attendance Alert</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['semester_plan_management']) || $this->session->userdata('label')=="admin"){                             
?>                            
		                    <li class="<?php if($this->router->class == "semester_plan_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/semester_plan_management"><i class="fa fa-tasks"></i>  Semester Plan</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['time_plan_management']) || $this->session->userdata('label')=="admin"){                             
?>                            
		                    <li class="<?php if($this->router->class == "time_plan_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/time_plan_management"><i class="fa fa-clock-o"></i>  Time Plan</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['room_plan_management']) || $this->session->userdata('label')=="admin"){                             
?>                            
		                    <li class="<?php if($this->router->class == "room_plan_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/room_plan_management"><i class="fa fa-building-o"></i>  Room Plan</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['class_plan_management']) || $this->session->userdata('label')=="admin"){                             
?>                            
		                    <li class="<?php if($this->router->class == "class_plan_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/class_plan_management"><i class="fa fa-fw fa-sitemap"></i>  Class Plan</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['print_class_routine_management']) || $this->session->userdata('label')=="admin"){                             
?>                            
		                    <li class="<?php if($this->router->class == "print_class_routine_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/print_class_routine_management"><i class="fa fa-calendar"></i> Class Routine</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['attendance_excuse']) || $this->session->userdata('label')=="admin"){                             
?>                            
		                    <li class="<?php if($this->router->class == "attendance_excuse") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/attendance_excuse"><i class="fa fa-fw fa-comments-o"></i> Attendance Excuse</a>
		                    </li>
<?php
}                            
?>   
                    <li class="<?php if($this->router->class == "attendence_report_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/attendence_report_management"><i class="fa fa-ambulance"></i> Attendence Report</a>
                    </li>                          
		                    <!-- <li class="<?php if($this->router->class == "attendance_list") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/attendance_list"><i class="fa fa-fw fa-check-square-o"></i> Attendance List</a>
		                    </li> -->		                    		                    		                                          
	                    </ul>
                    </li>
                    <li>
                    	<a href="javascript:void(0);" data-toggle="collapse" data-target="#result_management"><i class="fa fa-graduation-cap"></i> Result Management<i class="fa fa-fw fa-caret-down"></i></a>
                    	<ul id="result_management" class="collapse">
<?php
if(!empty($staff_access['staff_privileges']['exam_result_management']) || $this->session->userdata('label')=="admin"){                             
?>                        
		                    <li class="<?php if($this->router->class == "exam_result_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/exam_result_management"><i class="fa fa-fw fa-check-square-o"></i>  All Results</a>
		                    </li>
		                    <li class="<?php if($this->router->class == "previous_exam_result") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/previous_exam_result"><i class="fa fa-fw fa-check-square-o"></i>  Previous Results</a>
		                    </li>
<?php
}
if(!empty($staff_access['staff_privileges']['exam_result_management_extend']) || $this->session->userdata('label')=="admin"){                             
?>                            
		                    <li class="<?php if($this->router->class == "exam_result_management_extend") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/exam_result_management_extend"><i class="fa fa-fw fa-check-square-o"></i>  Add Results</a>
		                    </li>		                    
<?php
}                             
?>		                    	                    		                    		                                          
	                    </ul>
                    </li>

                    <li>                    
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#account"><i class="fa fa-cc-mastercard"></i> Account <i class="fa fa-fw fa-caret-down"></i></a>
	                     <ul id="account" class="collapse">
<?php
if(!empty($staff_access['staff_privileges']['account_payment_upload_management']) || $this->session->userdata('label')=="admin"){                             
?>                         
		                   <li class="<?php if($this->router->class == "account_payment_upload_management") echo "active"; ?>">
		                        <a href="<?php echo base_url(); ?>index.php/account_payment_upload_management"><i class="fa fa-usd"></i>  Payment Upload</a>
		                    </li>
<?php
}                             
?>		                    	                                          
	                    </ul>
                    </li>                                                         
<?php
if(!empty($staff_access['staff_privileges']['masterinbox_management']) || $this->session->userdata('label')=="admin"){                             
?>
                    <li class="<?php if($this->router->class == "masterinbox_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/masterinbox_management"><i class="fa fa-envelope"></i>  Master Inbox</a>
                    </li>
<?php
}     
?>
					<li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports"><i class="fa fa-cc-mastercard"></i> Reports <i class="fa fa-fw fa-caret-down"></i></a>
	                  <ul id="reports" class="collapse">
<?php
if(!empty($staff_access['staff_privileges']['report_management']) || $this->session->userdata('label')=="admin"){                             
?>                                                            
                    <li class="<?php if($this->router->class == "report_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/report_management"><i class="fa fa-file-text"></i> Report</a>
                    </li>
<?php
}                        
?>                    
                    <li class="<?php if($this->router->class == "new_report_management") echo "active"; ?>">
                        <a href="<?php echo base_url(); ?>index.php/new_report_management"><i class="fa fa-file-text"></i> New Report</a>
                    </li>
                       
                   
<?php
// } ?>     
                    </ul>
                    </li>
 
                   

                </ul>
              
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        
        <div id="page-wrapper">

            <div class="container-fluid">        
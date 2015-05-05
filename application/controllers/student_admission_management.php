<?php
  
class Student_admission_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      
      $this->load->model('semister');          
      $this->load->model('settings');          
      $this->load->model('archive');          
      $this->load->model('course');          
      $this->load->model('course_relation');          
      $this->load->model('agent');              
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');        
      $this->load->model('student_data');
      $this->load->model('student_upload');
      $this->load->model('notes');
      $this->load->model('staff','', TRUE);
      $this->load->model('staff_upload','', TRUE);
      $this->load->model('awarding_body','', TRUE);
      $this->load->model('login','', TRUE);                          
      $this->load->model('student_title','', TRUE);                          
      $this->load->model('student_gender','', TRUE);                          
      $this->load->model('country','', TRUE);                          
      $this->load->model('student_marital_status','', TRUE);                          
      $this->load->model('student_others_ethnicity','', TRUE); 
      $this->load->model('student_others_disabilities','', TRUE);                         
      $this->load->model('hesa_rsnend','', TRUE);                         
      $this->load->model('hesa_qual','', TRUE);                         
      $this->load->model('student_information','', TRUE);                         
}

public function index(){

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');
      $id                     = $this->input->get('id');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');   
        $data['settings']       =   $this->settings->get_settings();  
	    $data['message']        =   "";
        $data['bodytitle']      =   "Students Admission";
        $data['breadcrumbtitle']=   "Dashboard > Students Admission";
        $data['faicon']         =   "fa-users"; 

        $data['student_information'] = $this->student_data->get_all_by_ID($id);
        //var_dump($data['student_information']); die();
        
   
	    /////////////////////////////////////////////////////
        //////////////////////////////////////////////////////        
        /// get staff access
        if($this->session->userdata('label')=="staff"){
                  $staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));
                  if(!empty($staff_access['staff_privileges']['student_admission_management']) && count($staff_access['staff_privileges']['student_admission_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['student_admission_management'];       
                  else{ 
                      $priv[0] = ""; //------ search view
                      $priv[1] = ""; //------Application view
                      $priv[2] = "";//------Communication view
                      $priv[3] = ""; //-------Upload Document view 
                      $priv[4] = ""; //------Notes view
                      $priv[5] = ""; //------Archive view
                      $priv[6] = ""; //------Login to Student Panel view
                      $priv[7] = ""; //------Application Change Status
                      $priv[8] = ""; //------Application edit
                      $priv[9] = ""; //------Application print
                      $priv[10] = ""; //------search excel report
                      $priv[11] = ""; //------Upload Document Add
                      $priv[12] = ""; //------Notes Add
                      $priv[13] = ""; //------Notes Delete
                      $priv[14] = ""; //------Notes Follow-up
                      $priv[15] = ""; //------Communication send

                  }
                                
        }

        
        
        // $priv[0] = Search ; $priv[1] = View Application ; $priv[2] = Communication ; $priv[3] = Upload Document ;         
        // $priv[4] = Notes ; $priv[5] = Archive ; $priv[6] = Login to Student Panel ;  $priv[7] = Change Status;        
        /////////////////////////////////////////////////////        
                
        
    /* alert count part */
    
        $data["alert_count"]                =   0;
        $data["inbox_alert_count"]          =   0;
        $data["alert_count"]                = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
        $data["inbox_alert_count"]          = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    
    /* alert count part end*/    
    	$action                 = $this->input->get('action');
    	$page                   = $this->input->get('page'); 
    	$id                     = $this->input->get('id');
        $do 					= $this->input->get('do');
        $export                 = $this->input->get('export');   
        $sortby                 = "";   
        $sortby                 = $this->input->get('sortby');   
        $student_data           = array();
        $data['semester_list']  = $this->semister->get_all_by_des_order();
        $data['course_list']    = $this->course->get_all_by_course_name_asc();
        $data['agent_list']     = $this->agent->get_by_status();
        $data['status_list']    = array("New","Review","Processing","Refer to academic department","Accepted","Rejected for review","Rejected","Discarded");

            
        /* Start Set the applicaton data into session for archive set */
        if($action=="singleview" && $do == "application") {
            $student_data["studen_prev_info"] = $this->student_data->get_studentdata_for_edit($id);
            $this->session->set_userdata($student_data);
        }        
        /* End Set the applicaton data into session for archive set */    
        
        if(!empty($sortby)){
            $sesData = $this->session->userdata("student_admission_search");
            $terms = $sesData['terms'];
            $sesData['student_admission_search']['terms'] = $terms;
            $sesData['student_admission_search']['sortby'] = $sortby;
            $this->session->set_userdata($sesData);            
        }    
        
        if($action=="search" && empty($page) && (!empty($priv[0]) || $this->session->userdata('label')=="admin")){
			
			$terms = array();
			if($_POST){
                foreach($this->input->post() as $k=>$v){
				    
				    if($k!="ref" && $k!="ref_id"){$$k=tinymce_encode($v); $terms[$k] = $$k;}
			    }
            }
			
		    $sesData['student_admission_search']['terms'] = $terms;
		    $this->session->set_userdata($sesData);			
			
			
        }else if($action=="singleview"){
			
            if($do=="application" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")  ){
              
              /* Start of posting data */ 
                if($_POST){
                    
                    $studen_prev_info   = $this->session->userdata("studen_prev_info");
                    $app_id             = $data['ref_id'] = $this->input->post("ref_id");
                    $archive_count      = 0;
                    $archive_change     = array();
					$disibility 		= "";
                    foreach($this->input->post() as $k=>$v){
                    	
						if($k=="student_others_disabilities_on") {
				
						$disibility = $v;
						//var_dump($disibility);
						}                   
            if($k=="student_others_disabilities") {
              if($v != ""){
							if($disibility!="no") {
							 
								if( is_array($v) ) {
									
									// $array_v	=	implode(",",$v); 
										$array_v = $v	=	serialize($v);
									    
									if(count($v)>0) $args[$k] 	= 	$array_v;
									else {
                                        
										$args[$k] 	=  "0";
                    $v          =  "0";
                    $args["disabilities_allowance"]   =   "no";
									}
						
								} else if(!is_array($v) && strpos($v,",")>0) {
									$exp        = explode(",",$v);
									$args[$k] 	= 	serialize($exp); $v = serialize($exp);
								} else {
									$args[$k] 	= 	"0";  
                  $v          =   "0";
                  $args["disabilities_allowance"]   =   "no";
								}
							} else { 
                $args[$k] 	= 	"0";  
                $v =   "0"; 
                $args["disabilities_allowance"]   =   "no";
              }
            } else {
              $args[$k]   =   "0";  
                $v =   "0"; 
                $args["disabilities_allowance"]   =   "no";
            }
            } 
                        $already_has=0;
                        foreach( $studen_prev_info as $a=>$b ){
							if($a==$k){
								if(!empty($b) && !empty($v) && $b!=$v){
                                    $val = $v;
									foreach($archive_change as $c=>$d){
										if($d['archive_field_name']==$k) $already_has=1;	
										
									}
									if($already_has==0){
										if(is_array($val) && $k=="student_others_disabilities"){
										 	//$val = implode(",",$val); 
                      //var_dump($val);
										 	// $exp = explode($val); //$v = 
                      $args[$k] = $val = serialize($val); 
										 	// foreach($exp as $e){
												
										 	// } 
										} 

                                         if($k == 'student_others_ethnicity' && preg_match("/[a-zA-Z]/", $val)==0 ) {
                                             $val = $this->student_others_ethnicity->get_name_by_id($val);
                                             if(preg_match("/[a-zA-Z]/", $studen_prev_info[$k]) ==0 ) $studen_prev_info[$k] = $this->student_others_ethnicity->get_name_by_id($studen_prev_info[$k]);
                                              
                                         } else if($k == 'student_marital_status' && preg_match("/[a-zA-Z]/", $val)==0 ) {
                                             $val = $this->student_marital_status->get_name_by_id($val);
                                             if(preg_match("/[a-zA-Z]/", $studen_prev_info[$k]) ==0 ) $studen_prev_info[$k] = $this->student_marital_status->get_name_by_id($studen_prev_info[$k]); 
                                             
                                         } else if($k == 'student_nationality' && preg_match("/[a-zA-Z]/", $val)==0 ) {
                                             $val = $this->country->get_name_by_id($val);
                                             if(preg_match("/[a-zA-Z]/", $studen_prev_info[$k]) ==0 ) $studen_prev_info[$k] = $this->country->get_name_by_id($studen_prev_info[$k]); 
                                             
                                         } else if($k == 'student_country_of_birth' && preg_match("/[a-zA-Z]/", $val)==0 ) {
                                             $val = $this->country->get_name_by_id($val);
                                             if(preg_match("/[a-zA-Z]/", $studen_prev_info[$k]) ==0 ) $studen_prev_info[$k] = $this->country->get_name_by_id($studen_prev_info[$k]); 
                                             
                                         } else if($k == 'student_gender' && preg_match("/[a-zA-Z]/", $val)==0 ) {
                                             $val = $this->student_gender->get_name_by_id($val);
                                             if(preg_match("/[a-zA-Z]/", $studen_prev_info[$k]) ==0 ) $studen_prev_info[$k] = $this->student_gender->get_name_by_id($studen_prev_info[$k]); 
                                         }


			                            $archive_change[$archive_count] = array( 
			                                "student_data_id"              => $app_id,
			                                "staff_id"                     => $varsessioncheck_id,
			                                "archive_field_name"           => $k,
			                                "archive_field_value"          => $val,
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
                        
                        
                        /* Check gender and change title start */
                        if($k=="student_title") {
                               $args["student_title"] = $v; 
                        }
                        /* Check gender and change title end */
                        if($k!="ref" && $k!="ref_id" && $k!="student_others_disabilities_on"  && $k!="student_others_disabilities"  && $k!="declaration"  && $k!="agent_id") $args[$k] = tinymce_encode($v);                        
                        
                        
                        
                        if($k=="agent_id") {
                            $args[$k] = intval($v);
                        }
                        if($k=="declaration") {
                           $terms_services =1; 
                        }
             
                      $args["student_first_name"]                  = $this->student_data->get_firstname($app_id);  
                      $args["student_sur_name"]                    = $this->student_data->get_lastname($app_id);  
                      //$args["student_admission_status"]            = "Submitted";  
                      //$args["student_admission_status_for_staff"]  = "New";  
                      $args["student_app_submitted_datetime"]      = tohrdatetime(date("Y-m-d H:i:s"));  
                      $args["student_app_submitted_ip"]            = getRealIp();  
                      
                      /* End Finish inserting data into $args array */
                        
                    }
                    
                    	
                    	
                        /* Start check application ID is not empty for validate data */
                        
                        if($data['ref_id']!=0){ 
                            /* Update the student applicaton data here */
                            $args['id']         = $app_id;
                            //var_dump($args);
                            if(empty($args['disabilities_allowance'])) $args['disabilities_allowance'] = "no";
                            if( isset($args["student_others_disabilities"]) && $args["student_others_disabilities"] == "0") {
                              $args['disabilities_allowance'] = "no";                              
                            }
                            if(empty($args['student_others_disabilities'])) $args['student_others_disabilities'] = "0";
                            
                           
                            
                            $insertedid         = $this->student_data->update_app($args); 
                            
                            /* inserting archive table the changed data start */ 
                            if($archive_count >0) {
                                foreach($archive_change as $archive_data):
                                    $this->archive->add($archive_data);
                                endforeach;
                            }
                            /* inserting archive table the changed data end */ 

                            /* after submission the update message for user shown here */
                            if($insertedid)
                            $data["message"]    = set_fixi_notification("<i class='fa fa-check'></i> Aplication Updated Successfully.","success"); 
                            else
                            $data["message"]    = set_fixi_notification("<i class='fa fa-warning'></i> Aplication Can't  Updated successfully.","warning"); 
                             
                        } /* End of application ID checking */
                    
                } /* End of post data */ 
                
            }
		   
		   
		   			
        } /* End of edit action part */
     
             
     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="all" || $action=="search") ) {
            
            

        $data['ref']    = 'search';
		$data['ref_id'] = "";        
      
        if($action=="all" && !$_POST){

			$data['result'] =   $this->student_data->makeStudentListWithpagination($action,$page,base_url()."index.php/student_admission_management/?action=".$action,"yes",!empty($priv[10]));	
			
        }else if( ($action!="all" && $action=="search")  || ($_POST && $this->input->post('ref')=="search") ){
        	 
        	 $sesData   = $this->session->userdata("student_admission_search");
        	 $terms     = $sesData['terms'];
			
			$data['result']=$this->student_data->makeStudentListWithpagination($terms,$page,base_url()."index.php/student_admission_management/?action=search","yes",!empty($priv[10]));
        }

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/student_admission_search_body');
        $this->load->view('staff/other_footer'); 

	}else if(!empty($varsessioncheck_id) && ($action=="singleview")) {		    
	    		
/*        if(!empty($staff_privileges_student_admission['std_ad_view_app']) || 
            !empty($staff_privileges_student_admission['std_ad_edit_app'])|| $this->session->userdata('label')=="admin")
        $data['app_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=application&id=".$id;
        if(!empty($staff_privileges_student_admission['std_ad_comm'])     || $this->session->userdata('label')=="admin")
        $data['comm_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=communication&id=".$id;        
        $data['up_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=upload&id=".$id;
        if(!empty($staff_privileges_student_admission['std_ad_agent'])    || $this->session->userdata('label')=="admin")
        $data['addag_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=addagent&id=".$id;
        if(!empty($staff_privileges_student_admission['std_ad_notes'])    || $this->session->userdata('label')=="admin")
        $data['note_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=note&id=".$id;
        if(!empty($staff_privileges_student_admission['std_ad_archive'])  || $this->session->userdata('label')=="admin")
        $data['arch_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=archive&id=".$id;
        
        $data['login_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=login&id=".$id; 
        //////// ---- need to add priviledge in future*/	
        

        $data['app_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=application&id=".$id;

        $data['comm_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=communication&id=".$id;        
        
        $data['up_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=upload&id=".$id;

        $data['addag_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=addagent&id=".$id;

        $data['note_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=note&id=".$id;

        $data['arch_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=archive&id=".$id;
        
        $data['login_link'] = base_url()."index.php/student_admission_management/?action=singleview&do=login&id=".$id; 
        //////// ---- need to add priviledge in future

        $data['ref_id'] = $id;
        
        $std_data                = $this->student_data->get_studentdata_for_edit($id);

          foreach($std_data as $k=>$v){
            $data['user_data'][$k] = addslashes(tinymce_decode($v));                
          }        

		if($do=="application" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){  // All the part of student application is done by here
            
            
            $data['bodytitle']       =   "Admission Details";
            $data['faicon']          =   "fa-eye";
            $data['breadcrumbtitle'] =   "Dashboard > Students Admission > Admission Details";
            $data['ref']             =   'edit';
            $data['hesa_rsnend']     =  $this->hesa_rsnend->get_all();
            
        	$data["course_lists"]  	 =   $this->course_relation->get_by_current_date();
            $semister_list 			 =   $this->semister->get_all();
            foreach($semister_list as $v){
				$data["semesterlist"][$v['id']] = $v['semister_name'];		
            }
             
            $data["agent_list"]       =   $this->agent->get_all_active();
            
            $data['gender_list']      = $this->student_gender->get_all();
            $data['country_list']     = $this->country->get_all();
            $data['marital_list']     = $this->student_marital_status->get_all();
            $data['ethnicity_list']   = $this->student_others_ethnicity->get_all();
            $data['disability_list'] = $this->student_others_disabilities->get_all();
                      

            
          	$data['admission_status']   = $this->student_data->get_user_admission_status($id);			
        	$data['ref']                = 'edit';
        	//$data['fullname']           = $this->student_title->get_name_by_id($this->student_data->get_title_id($id))." ".$this->student_data->get_first_sur_name($id);
        	$data['fullname']           = $this->student_data->get_fullname_by_ID($id);

	
	        $this->load->view('staff/dashboard_header',$data);
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
            
                        
	        $this->load->view('staff/student_admission_search_body');
            
	        $this->load->view('staff/student_admission_link_body');
	        $this->load->view('staff/student/body_form');
            
            
	        $this->load->view('staff/other_footer');						
		
		
		} else if($do=="archive" && (!empty($priv[5]) || $this->session->userdata('label')=="admin") ) {
            
            $data['bodytitle']       =   "Archive Details";
            $data['faicon']          =   "fa-archive";
            $data['breadcrumbtitle'] =   "Dashboard > Students Admission > Archive Details";
            
            $data['ref']             = 'edit';
            $data['archivelist']     = $this->archive->get_by_applicationID($id);    
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            $this->load->view('staff/student_admission_link_body');
            $this->load->view('staff/student/student_basic_info');            
            $this->load->view('staff/archive_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="note" && (!empty($priv[4]) || $this->session->userdata('label')=="admin")  ) {
        	
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Notes";
            $data['faicon']          =   "fa-pencil-square-o";
            $data['breadcrumbtitle'] =   "Dashboard > Students Admission > Staff notes";
            $data['ref']             =   'edit';
            $data['noteslist']      =   $this->notes->get_by_applicationID($id);
            $data['staff_list']      =  $this->staff->get_all();  
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            $this->load->view('staff/student_admission_link_body');
            $this->load->view('staff/student/student_basic_info');            
            $this->load->view('staff/notes_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="upload"  && (!empty($priv[3]) || $this->session->userdata('label')=="admin")) {
          
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Upload Files";
            $data['faicon']          =   "fa-upload";
            $data['breadcrumbtitle'] =   "Dashboard > Students Admission > Uploaded Student files";
            $data['ref']             =   'edit';
            $data['uploadlist']      =   $this->staff_upload->get_by_applicationID($id);
                
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            $this->load->view('staff/student_admission_link_body');
            $this->load->view('staff/student/student_basic_info');            
            $this->load->view('staff/upload_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="communication" && (!empty($priv[2]) || $this->session->userdata('label')=="admin")  ) {
        	
            $data['staff_id']           =   $varsessioncheck_id;
            $data['bodytitle']          =   "Communications";
            $data['faicon']             =   "fa-comments-o";
            $data['breadcrumbtitle']    =   "Dashboard > Students Admission > Communications";
            $data['ref']                = 'edit';

            $data['inboxlists']         = $this->lcc_inbox->get_by_student_ID($id);
            $data['communicationlist']  = $this->lcc_communication->get_by_student_ID($id);
                
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            $this->load->view('staff/student_admission_link_body');
            $this->load->view('staff/student/student_basic_info');
            $this->load->view('staff/communication_view');
            $this->load->view('staff/other_footer');    
            
        
        } else if($do=="login" && (!empty($priv[6]) || $this->session->userdata('label')=="admin")) {
        	
            $data['staff_id']           =   $varsessioncheck_id;
            $data['bodytitle']          =   "Login to Student Panel";
            $data['faicon']             =   "fa-unlock-alt";
            $data['breadcrumbtitle']    =   "Dashboard > Students Admission > Login to Student Panel";
            $data['ref']                = 	'edit';

            //$data['inboxlists']         = $this->lcc_inbox->get_by_student_ID($id);
            //$data['communicationlist']  = $this->lcc_communication->get_by_student_ID($id);
            
            //$data['new_activate_session_id'] = $this->student_data->change_activate_session_id_by_student_data_id();
            $new_activate_session_id = $this->student_data->change_activate_session_id_by_student_data_id($id);
            if($new_activate_session_id!=false) $data['new_activate_session_id'] = $new_activate_session_id; 
                
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            $this->load->view('staff/student_admission_link_body');
            $this->load->view('staff/student/student_basic_info');            
            $this->load->view('staff/staff_login_to_student_view');
            $this->load->view('staff/other_footer');    
     
        
        } else if($do=="") {
        	
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "";
            $data['faicon']          =   "";
            $data['breadcrumbtitle'] =   "Dashboard > Students Admission > ";
            $data['ref']             =   'edit';        	
        	$data['do']				 =   "";
        	
        	die("Error: No access!");
            
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            $this->load->view('staff/student_admission_link_body');
            $this->load->view('staff/other_footer');        	
        	
            
            
        }
        
         $this->load->view('staff/blank_all_search_field');
		
  
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
<?php
/*
* Special notes-----------
* 1. education qfy posting is on view level
*
*/  
class Registration_management extends CI_Controller {   
    
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
      $this->load->model('letter_issuing');        
      $this->load->model('email_issuing');        
      $this->load->model('sms_issuing');        
      $this->load->model('letter_set');        
      $this->load->model('status');        
      $this->load->model('signatory_set');        
      $this->load->model('student_data');
      $this->load->model('student_upload');
      $this->load->model('notes');
      $this->load->model('staff','', TRUE);
      $this->load->model('staff_upload','', TRUE);
      $this->load->model('awarding_body','', TRUE);
      $this->load->model('login','', TRUE);                          
      $this->load->model('register','', TRUE); 
      $this->load->model('student_gender','', TRUE);                          
      $this->load->model('country','', TRUE);                         
      $this->load->model('student_others_ethnicity','', TRUE);
      $this->load->model('student_others_disabilities','', TRUE);                                   
      $this->load->model('hesa_exchind','', TRUE);                                   
      $this->load->model('hesa_sselig','', TRUE);                                   
      $this->load->model('hesa_heapespop','', TRUE);                                   
      $this->load->model('hesa_locsdy','', TRUE);                                   
      $this->load->model('hesa_mode','', TRUE);                                   
      $this->load->model('hesa_student_information','', TRUE);                                   
      $this->load->model('hesa_rsnend','', TRUE);                                   
      $this->load->model('hesa_disall','', TRUE);                                   
      $this->load->model('hesa_previnst','', TRUE);                                   
      $this->load->model('hesa_qualtype','', TRUE);                                   
      $this->load->model('hesa_qualsbj','', TRUE);                                   
      $this->load->model('hesa_qualsit','', TRUE);                                   
      $this->load->model('hesa_domicile','', TRUE);                                   
      $this->load->model('hesa_qualent3','', TRUE);                                   
}

public function index(){

        $data                   =   array(); 
        $menuleft               =   array();
        $data["statements"]     =   array();
        $varsessioncheck_id     =   $this->session->userdata('uid');
        $data['hesa_rsnend']     =  $this->hesa_rsnend->get_all();  
        $id                     = $this->input->get('id');

        $label                  =   $this->session->userdata('label');        
        $data["fullname"]       =   $this->session->userdata('fullname');   
        $data['settings']       =   $this->settings->get_settings();  
        $data['message']        =   "";
        $data['bodytitle']      =   "Students Registration";
        $data['breadcrumbtitle']=   "Dashboard > Students Registration";
        $data['faicon']         =   "fa-users"; 

        $data['student_information'] = $this->student_data->get_all_by_ID($id);

         
        
        /// get staff access
        if($this->session->userdata('label')=="staff"){
                  $staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));
                  if(!empty($staff_access['staff_privileges']['registration_management']) && count($staff_access['staff_privileges']['registration_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['registration_management'];       
                  else{ 
                      $priv[0] = ""; //------ search View
                      $priv[1] = ""; //------ profile view
                      $priv[2] = ""; //------ Education & Qualification view
                      $priv[3] = ""; //------ Communication view
                      $priv[4] = ""; //------  Upload Document View
                      $priv[5] = ""; //------ Notes view
                      $priv[6] = ""; //------ Archive View
                      $priv[7] = ""; //------ profile change status
                      $priv[8] = ""; //------ search Excel Report
                      $priv[9] = ""; //------ profile update
                      $priv[10] = ""; //------ profile lock/unlock
                      $priv[11] = ""; //------ Education & Qualification edit
                      $priv[12] = ""; //------ Education & Qualification Generate letter
                      $priv[13] = ""; //------ Education & Qualification Send Email
                      $priv[14] = ""; //------ Education & Qualification Send SMS
                      $priv[15] = ""; //------ Education & Qualification Delete
                      $priv[16] = ""; //------ Upload Document Add
                      $priv[17] = ""; //------ Notes Add
                      $priv[18] = ""; //------ Notes Delete
                      $priv[19] = ""; //------ Notes Follow up
                  }
                                
        }
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
        $do                     = $this->input->get('do');
        $export                 = $this->input->get('export');
        $sortby                 = "";   
        $sortby                 = $this->input->get('sortby');           
        $student_data           = array();
        $data['semester_list']  = $this->semister->get_all_by_des_order();
        $data['course_list']    = $this->course->get_all_by_course_name_asc();
        $data['agent_list']     = $this->agent->get_by_status();
        $data['status_list']    = array("Accepted","Offer placed","Offer accepted","Offer Rejected");

            
        /* Start Set the applicaton data into session for archive set */
        if($action=="singleview" && $do == "application") {
            $student_data["studen_prev_info"] = $this->student_data->get_studentdata_for_edit($id);
            $this->session->set_userdata($student_data);
        }        
        /* End Set the applicaton data into session for archive set */    
        
        $studen_prev_info   = $this->session->userdata("studen_prev_info");
 
        if(!empty($sortby)){
            $sesData = $this->session->userdata("student_admission_search");
            $terms = $sesData['terms'];
            $sesData['student_admission_search']['terms'] = $terms;
            $sesData['student_admission_search']['sortby'] = $sortby;
            $this->session->set_userdata($sesData);            
        }
    

        if($action=="search" && empty($page) && $this->input->post()>""){
            
            $terms = array();
            foreach($this->input->post() as $k=>$v){
                
                if($k!="ref" && $k!="ref_id"){$$k=tinymce_encode($v); $terms[$k] = $$k;}
            }
            
            $sesData['student_admission_search']['terms'] = $terms;
            $this->session->set_userdata($sesData);            
            
            
        }else if($action=="singleview"){
            
            if($do=="application"  ){
              
              /* Start of posting data && (!empty($staff_privileges_student_admission['std_ad_edit_app']) || $this->session->userdata('label')=="admin") */ 

                

                




                
                
                
            }
           
           
                       
        } /* End of edit action part */
     
             
     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="all" || $action=="search")) {
            
            

        $data['ref'] = 'search';
        $data['ref_id'] = "";        
      
        if($action=="all" && !$_POST){
   
            $data['result']=$this->student_data->makeStudentListWithpagination($action,$page,base_url()."index.php/registration/registration_management/?action=".$action,"yes",!empty($priv[8]));    
            
        }else if(($action!="all" && $action=="search")  || ($_POST && $this->input->post('ref')=="search")){
             
             $sesData = $this->session->userdata("student_admission_search");
             //var_dump($sesData);
             $terms = $sesData['terms'];

            $data['result']=$this->student_data->makeStudentListWithpagination($terms,$page,base_url()."index.php/registration/registration_management/?action=search","yes",!empty($priv[8]));
        }

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/registration/student_admission_search_body');
        $this->load->view('staff/other_footer'); 

    }else if(!empty($varsessioncheck_id) && ($action=="singleview")) {
                
        // Link data for student admission link body  start        
            
            $data['app_link']   = base_url()."index.php/registration/registration_management/?action=singleview&do=application&id=".$id;


            $data['edu_link']   = base_url()."index.php/registration/registration_management/?action=singleview&do=education&id=".$id;

            
            $data['comm_link']  = base_url()."index.php/registration/registration_management/?action=singleview&do=communication&id=".$id;
            
            $data['up_link']    = base_url()."index.php/registration/registration_management/?action=singleview&do=upload&id=".$id;

            
            $data['addag_link'] = base_url()."index.php/registration/registration_management/?action=singleview&do=addagent&id=".$id;

            
            $data['note_link']  = base_url()."index.php/registration/registration_management/?action=singleview&do=note&id=".$id;

            
            $data['arch_link']  = base_url()."index.php/registration/registration_management/?action=singleview&do=archive&id=".$id;
        
        // Link data for student admission link body end
        
            $data['ref_id']     = $id;
            
            
            
				$reg_data = $this->register->get_by_student_ID($id);
		        
		        if(count($reg_data)>0){
	        		
	        		$reg_data = $this->register->get_by_student_ID($id);
	        		/////------------ need to add as necessary ----- ;)
	        		
	        		foreach($reg_data as $k=>$v){
						if($k=="registrtation_date" || $k=="class_startdate" || $k=="class_enddate" || $k=="proof_expiredate")
							if($v!="0000-00-00") $data['user_data'][$k] = date("d-m-Y",strtotime($v)); else $v = "";	
                        
                        else
						$data['user_data'][$k] = tinymce_decode($v);	
	        		}
	        		
	        		
	        		
					
		        }else if(count($reg_data)==0){
	        		
	        		$std_data                = $this->student_data->get_studentdata_for_edit($id);
	        		
	        		//if(preg_match("/[a-zA-Z]/", $data['user_data']['student_course'])==1)
	        		$course_rel_data = $this->course_relation->get_by_course_and_semester($std_data['student_course'],$std_data['student_semister']);
	        		$data['user_data']['class_startdate'] = date("d-m-Y",strtotime($course_rel_data['class_startdate_1']));
	        		$data['user_data']['class_enddate'] = date("d-m-Y",strtotime($course_rel_data['class_enddate_1']));
					
		        }            
            
        $data['hesa_exchind_list'] = $this->hesa_exchind->get_all();
        $data['hesa_sselig_list'] = $this->hesa_sselig->get_all();
        $data['hesa_heapespop_list'] = $this->hesa_heapespop->get_all();
        $data['hesa_locsdy_list'] = $this->hesa_locsdy->get_all();
        $data['hesa_mode_list'] = $this->hesa_mode->get_all();
        $data['hesa_disall_list'] = $this->hesa_disall->get_all();         
         

        if(!empty($reg_data)) $data['hesa_student_information_data'] = $this->hesa_student_information->get_by_student_data_id_and_register_id($id,$reg_data['id']);           
        
        if(!empty($data['hesa_student_information_data']) && empty($data['hesa_student_information_data']['uhn_number']) ) $data['hesa_student_information_data']['uhn_number'] = $this->hesa_student_information->calculateHusidNumber($reg_data['registration_no']);
        else if(empty($data['hesa_student_information_data']) && !empty($reg_data['registration_no'])) $data['uhn_number'] = $this->hesa_student_information->calculateHusidNumber($reg_data['registration_no']);        
        
        //var_dump($data['uhn_number']);

        if($do=="application" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){  // All the part of student application is done by here
            

            $data['staff_id']        =   $varsessioncheck_id;
             
            
                   
            $data['bodytitle']       =   "Registration Details";
            $data['faicon']          =   "fa-eye";
            $data['breadcrumbtitle'] =   "Dashboard > Registration > Registration Details";
            $data['ref']             =   'edit';
            
            $data["course_lists"]       =   $this->course_relation->get_by_current_date();
            $semister_list              =   $this->semister->get_all();
            foreach($semister_list as $v){
                $data["semesterlist"][$v['id']] = $v['semister_name'];        
            }
             
            $data["agent_list"]    =   $this->agent->get_all_active();

            //$data['gender']      = $this->student_gender->get_by_ID($this->student_data->);

            $data['country_list']     = $this->country->get_all();
            $data['ethnicity_list']   = $this->student_others_ethnicity->get_all();
            $data['disability_list'] = $this->student_others_disabilities->get_all();
                      
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }
              
            // var_dump($data['user_data']); die();
            
            $data['admission_status']   = $this->student_data->get_user_admission_status($id);            
            $data['ref']                = 'edit';
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);
            $data['dont_upload_photo']        = 0;

            $reg_data = $this->register->get_by_student_ID($id);
            if(!empty($reg_data)){
            $data['hesa_domicile_list'] = $this->hesa_domicile->get_all();

            $data['hesa_domicile_info'] = $this->hesa_student_information->get_by_student_data_id_and_register_id($id,$reg_data['id']);
            }
            //var_dump($data['hesa_domicile_info']); die();
    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/registration/student_admission_search_body');
            $this->load->view('staff/registration/student/body_form_top');
            $this->load->view('staff/registration/student_admission_link_body');
            $this->load->view('staff/registration/student/body_form');
            $this->load->view('staff/other_footer');                        
        
        
        }else if($do=="education" && (!empty($priv[2]) || $this->session->userdata('label')=="admin") ){  // All the part of student application is done by here
            
// student data registration part view start
 
// student data registration part view end         

            $data['staff_id']        =   $varsessioncheck_id;   
            $data['bodytitle']       =   "Education Details";
            $data['faicon']          =   "fa-eye";
            $data['breadcrumbtitle'] =   "Dashboard > Registration > Registration Details > Education qualification and work experience";
            $data['ref']             =   'edit';
            
            $data["course_lists"]       =   $this->course_relation->get_by_current_date();
            $semister_list              =   $this->semister->get_all();
            foreach($semister_list as $v){
                $data["semesterlist"][$v['id']] = $v['semister_name'];        
            }
             
            $data["agent_list"]    =   $this->agent->get_all_active();
                      
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }
            
            $data['admission_status']   = $this->student_data->get_user_admission_status($id);            
            $data['ref']                = 'edit';
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);
            $data['dont_upload_photo']        = 0;

            $data['hesa_previnst_list'] = $this->hesa_previnst->get_all(); 
            $data['hesa_qualtype_list'] = $this->hesa_qualtype->get_all(); 
            $data['hesa_qualsbj_list'] = $this->hesa_qualsbj->get_all(); 
            $data['hesa_qualsit_list'] = $this->hesa_qualsit->get_all(); 
            $data['hesa_qualent3_list'] = $this->hesa_qualent3->get_all(); 
            //var_dump( $data['hesa_previnst_list']); die();
    
    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/registration/student_admission_search_body');
            $this->load->view('staff/registration/student/body_form_top');
            $this->load->view('staff/registration/student_admission_link_body');

            $this->load->view('staff/registration/student/body_form_education');
            $this->load->view('staff/other_footer');                        
        
        
        } else if($do=="archive" && (!empty($priv[6]) || $this->session->userdata('label')=="admin") ) {
            
            $data['bodytitle']       =   "Archive Details";
            $data['faicon']          =   "fa-archive";
            $data['breadcrumbtitle'] =   "Dashboard > Registration > Archive Details";
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }            
            $data['ref']             = 'edit';
            $data['archivelist']     = $this->archive->get_by_applicationID($id);    
            $data['dont_upload_photo']        = 0;
            
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/registration/student_admission_search_body');
            $this->load->view('staff/registration/student/body_form_top');
            $this->load->view('staff/registration/student_admission_link_body');

            $this->load->view('staff/archive_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="note" && (!empty($priv[5]) || $this->session->userdata('label')=="admin")  ) {
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Notes";
            $data['faicon']          =   "fa-pencil-square-o";
            $data['breadcrumbtitle'] =   "Dashboard > Registration > Staff notes";
            $data['ref']             =   'edit';
            $data['noteslist']      =   $this->notes->get_by_applicationID($id);
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
            $data['staff_list']      =  $this->staff->get_all(); 
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }                
            $data['dont_upload_photo']        = 0;
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/registration/student_admission_search_body');
            $this->load->view('staff/registration/student/body_form_top');
            $this->load->view('staff/registration/student_admission_link_body');

            $this->load->view('staff/notes_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="upload" && (!empty($priv[4]) || $this->session->userdata('label')=="admin") ) {

            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Upload Files";
            $data['faicon']          =   "fa-upload";
            $data['breadcrumbtitle'] =   "Dashboard > Registration > Uploaded Student files";
            $data['ref']             = 'edit';
            $data['uploadlist']      = $this->staff_upload->get_by_applicationID($id);
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }                
            $data['fullname']        = $this->student_data->get_fullname_by_ID($id);
            $data['dont_upload_photo']        = 1;

            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/registration/student_admission_search_body');
            $this->load->view('staff/registration/student/body_form_top');
            $this->load->view('staff/registration/student_admission_link_body');
            $this->load->view('staff/registration/student/upload_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="communication" && (!empty($priv[3]) || $this->session->userdata('label')=="admin")  ) {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Communication logs";
            $data['faicon']          =   "fa-comments-o";
            $data['breadcrumbtitle'] =   "Dashboard > Registration > Communication logs";
            $data['ref']             = 'edit';
            $data['letterlists']     = $this->letter_issuing->get_by_student_data_id($data['ref_id']);
            $data['emaillists']      = $this->email_issuing->get_by_student_data_id($data['ref_id']);
            $data['smslists']        = $this->sms_issuing->get_by_student_data_id($data['ref_id']);

            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }
            $data['dont_upload_photo']        = 0;                  
            
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            
            $this->load->view('staff/registration/student/body_form_top');
            $this->load->view('staff/registration/student_admission_link_body');
            $this->load->view('staff/registration/student/communication_view');
            
            $this->load->view('staff/other_footer');    
            
        } else if($do=="") {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "";
            $data['faicon']          =   "";
            $data['breadcrumbtitle'] =   "Dashboard > Registration > ";
            $data['ref']             = 'edit';            
            $data['do']                ="";
            $data['dont_upload_photo']        = 0;
            
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/registration/student_admission_search_body');
            $this->load->view('staff/registration/student_admission_link_body');
            $this->load->view('staff/other_footer');            
            
        }
        
    $this->load->view('staff/registration/student/registration_input_disabled');
	$this->load->view('staff/blank_all_search_field');
    
    
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
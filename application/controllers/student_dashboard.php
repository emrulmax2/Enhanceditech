<?php
  
class Student_dashboard extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
      $this->load->model('student_data','', TRUE);     
      $this->load->model('agent','', TRUE);     
      $this->load->model('course_relation','', TRUE);     
      $this->load->model('coursemodule','', TRUE);     
      $this->load->model('course','', TRUE);     
      $this->load->model('semister','', TRUE);     
      $this->load->model('awarding_body','', TRUE);     
      $this->load->model('lcc_inbox','', TRUE);     
      $this->load->model('lcc_communication','', TRUE);     
      $this->load->model('staff','', TRUE);     
      $this->load->model('student_gender','', TRUE);     
      $this->load->model('student_title','', TRUE);     
      $this->load->model('country','', TRUE);     
      $this->load->model('student_marital_status','', TRUE);     
      $this->load->model('student_others_ethnicity','', TRUE);     
      $this->load->model('student_others_disabilities','', TRUE);     
      $this->load->model('register','', TRUE);     
      $this->load->model('student_assign_class','', TRUE);     
      $this->load->model('class_lists','', TRUE);     
      $this->load->model('class_plan','', TRUE);     
      $this->load->model('coursemodule','', TRUE);     
      $this->load->model('time_plan','', TRUE);
      $this->load->model('room_plan');      
      $this->load->model('course_level','', TRUE);     
      $this->load->model('attendance','', TRUE);     
      $this->load->model('examresult','', TRUE);  
      $this->load->model('student_information','', TRUE);  
      $this->load->model('register','', TRUE);  
      $this->load->model('status','', TRUE);  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');                  
      $this->load->library('php_mailer');                  
}

public function index(){

    $data                           =   array(); 
    $menuleft                       =   array();
    $data["statements"]             =   array();
    $data["inbox"]                  =   array();
    $varsessioncheck_id             =   $this->session->userdata('uid');
    $label                          =   $this->session->userdata('label');

    if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
        redirect('/admin_dashboard/'); 
    }else if(!empty($varsessioncheck_id) && $label=="student" ){
      redirect('/user_dashboard/');
    }else if(!empty($varsessioncheck_id) && $label=="registered" ){
      //redirect('/student_dashboard/');  
    
    } else {        
        redirect('/logout/'); 
    }

    $data["fullname"]               =   $this->student_data->get_fullname_by_ID($this->session->userdata('uid'));        
    $data["student_email"]          =   $this->session->userdata('username'); 
    $data['bodytitle']		          =	"Student Dashboard";
    $data['breadcrumbtitle']        =	"Dashboard > Student Dashboard";
    $data['faicon']			            =	"fa-mortar-board";    
    $data['message']                =   "";
    $action 				                =   $this->input->get('action'); 
    $app_id 				                =   $this->input->get('id');      
    $data['settings']		            =   $settings =   $this->settings->get_settings(); 
    $data["summary_data"] 	        =   $this->dashboard->get_all_todays_count();
    $data["agent_list"]             =   $this->agent->get_all();
    $data["course_lists"]           =   $this->course_relation->get_by_current_date();
    $data["alert_count"] 	          =   0;
    $student_data_ids 		          =   $this->student_data->get_student_data_ids($data["student_email"]);

    // alert count part
    $data["alert_count"]            =   0;
    $data["inbox_alert_count"]      =   0;
    $student_data_ids               =   $this->student_data->get_student_data_ids($data["student_email"]);
    
    foreach($student_data_ids as $ids) {
        foreach($ids as $id) {
          $data["alert_count"]       += $this->lcc_inbox->get_alert_of_student($id);  
          $data["inbox_alert_count"] += $this->lcc_inbox->get_communication_alert_of_student($id);  
        }
    }

    
    foreach($student_data_ids as $email => $ids ) {
        foreach($ids as $id) { $data["communication"]   = $this->lcc_communication->get_by_student_id($id); }
  	}
  	foreach($student_data_ids as $email => $ids ) {
  		foreach($ids as $id) {
              $i =0; $count = 0;
              
      		$data["inbox"] = $this->lcc_inbox->get_by_student_ID($id);
              
             
  		
          }
  	}
        // alert count part end
        
    foreach($data["course_lists"]->result() as $courseinfo) {
		
		  $data["semesterlist"][$courseinfo->semester_id] = $this->semister->get_name($courseinfo->semester_id); 
		
    }
    
    $i	= 0; 
    
        if($_POST) {
        $terms_services     =  0;
        if($action =="edit")
        {
          $data['ref_id'] = $app_id;   
        }
        else if($action =="add") {
        
            $app_id             = $data['ref_id'] = $this->student_data->get_application_id($varsessioncheck_id);
            
        
        }
		$disibility ="";
        foreach($this->input->post() as $k=>$v){
        	
        	
            
            if($k!="ref" && $k!="ref_id"  && $k!="student_others_disabilities_on" && $k!="student_others_disabilities"  && $k!="declaration"  && $k!="agent_id") $args[$k] = tinymce_encode($v);
            
			if($k=="student_others_disabilities_on") {
				
    			$disibility = $v;
			//var_dump($disibility);
			}
            if($k=="student_others_disabilities") {
               if($disibility!="no"){ 
				if(is_array($v)){

					// $array_v=implode(",",$v);
          $array_v = $v = serialize($v);

					if(count($v)>0)
					$args[$k] = $array_v;
					else
					$args[$k] = "0";
					
				}else if(!is_array($v) && strpos($v,",")>0){

          $exp = explode(",",$v);

          $args[$k] = $v = serialize($exp);

					
                }else{
					$args[$k] = "0";
                }
				
				} else { $args[$k] = "0";}
				//var_dump($args[$k]);
				
            }
            if($k=="agent_id") {
                $args[$k] = intval($v);
            }
            if($k=="declaration") {
               $terms_services =1; 
            }
 
          $args["student_first_name"]                  = ucwords(strtolower($this->student_data->get_firstname($varsessioncheck_id)));
          $args["student_sur_name"]                    = ucwords(strtolower($this->student_data->get_lastname($varsessioncheck_id)));  
          $args["student_admission_status"]            = "Submitted";  
          $args["student_admission_status_for_staff"]  = "New";  
          $args["student_app_submitted_datetime"]      = tohrdatetime(date("Y-m-d H:i:s"));  
          $args["student_app_submitted_ip"]            = getRealIp();  
            
        }
		$args['student_email'] = $this->session->userdata('username');
        if($data['ref_id']!=0){
            $args['id']         = $app_id;
            $insertedid         = $this->student_data->update_app($args);  
            
            if($insertedid){
            	$data["message"]    = set_fixi_notification("<i class='fa fa-ok'></i> Application Created Successfully","success");
              send_sms_txt($args['student_mobile_phone'],"Thank you for applying at ".$settings['company_name'].". Please find your application reference number ".$this->student_data->get_reference_no_byID($data['ref_id'])." for all future correspondence.");
              //makeHtmlEmail($args['student_email'],"Application confirmation email from London Churchill College","Dear ".$this->student_title->get_name_by_id($this->student_data->get_title_id($this->session->userdata('uid')))." ".$args['student_first_name']." ".$args['student_sur_name'].",<br /><br /> Thank you for applying to study at LONDON CHURCHILL COLLEGE. <br /><br /> Please find your application reference number below. Please use this number for all future correspondence. <br /><br /> <font size='40'><strong>".$this->student_data->get_reference_no_byID($args["id"])."</strong></font> <br /><br /> Thank you, <br /><br /> LONDON CHURCHILL COLLEGE","London Churchill College<noreply@londonchurchillcollege.co.uk>");            	
              makeHtmlEmailExtend($args['student_email'],"Application confirmation email from ".$settings['company_name'],"Dear ".$this->student_title->get_name_by_id($this->student_data->get_title_id($this->session->userdata('uid')))." ".$args['student_first_name']." ".$args['student_sur_name'].",<br /><br /> Thank you for applying to study at ".$settings['company_name'].". <br /><br /> Please find your application reference number below. Please use this number for all future correspondence. <br /><br /> <font size='40'><strong>".$this->student_data->get_reference_no_byID($args["id"])."</strong></font> <br /><br /> Thank you, <br /><br /> ".$settings['company_name'],$settings['company_name']."<".$settings['smtp_user'].">",$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);	
            
            	 
			}else{
            	$data["message"]    = set_fixi_notification("<i class='fa fa-warning'></i> Application Can't created successfully","warning"); 
			} 
        } else
        {

             $args["primary_id"]                         = $varsessioncheck_id;  
             $args["student_application_reference_no"]   = $this->student_data->get_next_reference_no();  
             $insertedid           = $this->student_data->add_app($args);  
              
             if($insertedid){
              
              $data["message"]      = set_fixi_notification("<i class='fa fa-ok'></i> Application Created Successfully","success");
              send_sms_txt($args['student_mobile_phone'],"Thank you for applying at ".$settings['company_name'].". Please find your application reference number ".$args["student_application_reference_no"]." for all future correspondence.");
              //makeHtmlEmail($args['student_email'],"Application confirmation email from London Churchill College","Dear ".$this->student_title->get_name_by_id($this->student_data->get_title_id($this->session->userdata('uid')))." ".$args['student_first_name']." ".$args["student_sur_name"].",<br /><br /> Thank you for applying to study at LONDON CHURCHILL COLLEGE. <br /><br /> Please find your application reference number below. Please use this number for all future correspondence. <br /><br /> <font size='40'><strong>".$args["student_application_reference_no"]."</strong></font> <br /><br /> Thank you, <br /><br /> LONDON CHURCHILL COLLEGE","London Churchill College<noreply@londonchurchillcollege.co.uk>"); 
			  makeHtmlEmailExtend($args['student_email'],"Application confirmation email from ".$settings['company_name'],"Dear ".$this->student_title->get_name_by_id($this->student_data->get_title_id($this->session->userdata('uid')))." ".$args['student_first_name']." ".$args["student_sur_name"].",<br /><br /> Thank you for applying to study at ".$settings['company_name'].". <br /><br /> Please find your application reference number below. Please use this number for all future correspondence. <br /><br /> <font size='40'><strong>".$args["student_application_reference_no"]."</strong></font> <br /><br /> Thank you, <br /><br /> ".$settings['company_name'],$settings['company_name']."<".$settings['smtp_user'].">",$settings['smtp_user'],$settings['smtp_pass'],$settings['smtp_host'],$settings['smtp_port'],$settings['smtp_encryption'],$settings['smtp_authentication'],$settings['company_name']);
			 
			 
			 
			 }else
              $data["message"]      = set_fixi_notification("<i class='fa fa-warning'></i> Application Can't created successfully","warning");  
        }
        

        
        }    
               
                
    if(!empty($varsessioncheck_id) && $label == "registered" && $action==Null){

        //$data['user_data']        = $this->student_data->get_student_app_list_by_ID($varsessioncheck_id);

        $student_id = $student_data_ids[$data["student_email"]][0];
        //var_dump($student_id); die();
        $register_id = $this->register->get_id_by_student_data_ID($student_id);
        
        $data['course_start_end_date'] = $this->register->get_by_student_ID($student_id);
        
        $data['status'] = $this->student_information->get_by_student_data_id_and_registration_no($student_id, $register_id);
        //var_dump($data['status']->status); die();

        $data['student_info'] = $this->student_data->get_studentdata_for_edit($student_id);
        $data['student_id']   = $this->register->get_registration_no_by_student_data_ID($student_id);
        $class_list_ids       = array();

        $today = date('Y-m-d');
        // $today = "2014-12-29"; //

        $class_plan_ids = $this->student_assign_class->get_by_register_id($register_id);
        foreach ($class_plan_ids as $k => $v) {
          $class_list_ids[] = $this->class_lists->get_all_by_date_and_class_plan_id($today , $v['class_plan_id']);
        }
        $list_of_class = array();

        if(!empty($class_list_ids)) 
        {
          foreach ($class_list_ids as $k => $v) {
              $list_of_class[] =   $this->class_plan->get_by_ID($v[0]['class_planid']);
          }          
        }

        $data["class_list_dates"] = array();
        foreach ($class_plan_ids as $k => $v) {
          $data["class_list_dates"][] = $this->class_lists->get_by_class_plan_id_with_class_plan_table_data($v['class_plan_id']);
        }
        
        if(!empty($list_of_class))
        {
          $data['list_of_todays_class'] = $list_of_class;
        }

        $data['course_relation_id'] = $this->course_relation->get_ID_by_course_ID_semester_ID($data['student_info']['student_course'], $data['student_info']['student_semister']);
            
        $data['level_list'] = $this->course_level->get_by_course_ID($data['student_info']['student_course']);

        $data['course_level_list'] = array_reverse($data['level_list']);
        
        
            
        $this->load->view('student/register/student_portal_header', $data);
        $this->load->view('student/register/student_portal_sidebar');
        $this->load->view('student/register/portal');
        $this->load->view('student/register/student_portal_footer');


    }else if(!empty($varsessioncheck_id) && $label == "registered" && $action=="add"){
        
        $data['gender_list'] =  $this->student_gender->get_all();
        $data['country_list'] =  $this->country->get_all();
        $data['marital_list'] = $this->student_marital_status->get_all();
        $data['ethnicity_list'] = $this->student_others_ethnicity->get_all();
        $data['disability_list'] = $this->student_others_disabilities->get_all();
        
        $data['ref'] 		= 'add';
        $data['ref_id']		= "";
        $data['user_data'] 	= "";
                  
        $this->load->view('dashboard_header',$data);    
        $this->load->view('student/dashboard_topmenu');
        $this->load->view('student/dashboard_sidebar');
        $this->load->view('student/body_form');
        $this->load->view('other_footer');
        
    } else if(!empty($varsessioncheck_id) && $label == "registered"  && $action=="edit" && $id != NULL) {
    	
    	$data['gender_list'] =  $this->student_gender->get_all();
    	$data['country_list'] =  $this->country->get_all();
    	$data['marital_list'] = $this->student_marital_status->get_all();
    	$data['ethnicity_list'] = $this->student_others_ethnicity->get_all();
    	$data['disability_list'] = $this->student_others_disabilities->get_all();
           
        $data['user_data']          = $this->student_data->get_studentdata_for_edit($id);
        $data['admission_status']   = $this->student_data->get_user_admission_status($id);  
        $data['ref'] 	            = 'edit';
        $data['ref_id']             = $id;
           
        $this->load->view('dashboard_header',$data);    
        $this->load->view('student/dashboard_topmenu');
        $this->load->view('student/dashboard_sidebar');
        $this->load->view('student/body_form');
        $this->load->view('other_footer');
        
    } else if(!empty($varsessioncheck_id) && $label == "admin"  || $label == "staff" ){
        
        redirect('/admin_dashboard/'); 
    
	}else if(!empty($varsessioncheck_id) && $label=="student" ){
	    redirect('/user_dashboard/');
	
	}else if(!empty($varsessioncheck_id) && $label=="registered" ){
	    redirect('/student_dashboard/'); 
    
    } else {
        
        redirect('/logout/'); 
    }
    
    
       
} // end of index
   
}  
  
?>
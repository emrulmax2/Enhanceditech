<?php
  
class Apply_job extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
      $this->load->model('student_data','', TRUE);     
      $this->load->model('agent','', TRUE);     
      $this->load->model('course_relation','', TRUE);     
      $this->load->model('course','', TRUE);     
      $this->load->model('semister','', TRUE);     
      $this->load->model('awarding_body','', TRUE);     
      $this->load->model('lcc_inbox','', TRUE);     
      $this->load->model('lcc_communication','', TRUE);     
      $this->load->model('staff','', TRUE);     
      $this->load->model('student_gender','', TRUE);     
      $this->load->model('student_title','', TRUE);     
      $this->load->model('country','', TRUE);     
      $this->load->model('currency','', TRUE);     
      $this->load->model('register','', TRUE);
      $this->load->model('attendance','', TRUE);     
      $this->load->model('class_plan','', TRUE);     
      $this->load->model('student_attendance_excuse','', TRUE);     
      $this->load->model('coursemodule','', TRUE);     
      $this->load->model('student_marital_status','', TRUE);     
      $this->load->model('student_others_ethnicity','', TRUE);     
      $this->load->model('student_others_disabilities','', TRUE);    
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');                  
      $this->load->model('jobs');                  
      $this->load->model('job_applied_student');                  
      $this->load->model('job_assign');                  
      $this->load->library('php_mailer');                  
}

public function index(){

    $data                   =   array(); 
    $menuleft               =   array();
    $data["statements"]     =   array();
    $data["inbox"]          =   array();
    $varsessioncheck_id     =   $this->session->userdata('uid');
    $label                  =   $this->session->userdata('label');        
    $data["fullname"]       =   $this->student_data->get_fullname_by_ID($this->session->userdata('uid'));        
    $data["student_email"]  =   $this->session->userdata('username'); 
    $data['bodytitle']		  =	  "Student Application Form";
    $data['breadcrumbtitle']=	  "Dashboard > Application form";
    $data['faicon']			    =	  "fa-mortar-board";    
    $data['message']        =   "";
    $action 				        =   $this->input->get('action'); 
    $app_id 				        =   $this->input->get('id');      
    $data['settings']		    = $settings =   $this->settings->get_settings(); 
    $data["summary_data"] 	=   $this->dashboard->get_all_todays_count();
    $data["agent_list"] 	  =   $this->agent->get_all();
    $data["course_lists"]   =   $this->course_relation->get_by_current_date();
    $data["alert_count"] 	  =   0;
    $student_data_ids 		  =   $this->student_data->get_student_data_ids($data["student_email"]);


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
        
   
               
                
    if(!empty($varsessioncheck_id) && $label == "registered" && $action==Null){

        $data['user_data']        = $this->student_data->get_student_app_list_by_ID($varsessioncheck_id);

        // $student_id = $student_data_ids[$data["student_email"]][0];
        // $register_id = $this->register->get_id_by_student_data_ID($student_id);
        $data['job_list'] = $this->jobs->get_all_non_induction();
        //var_dump($data['job_list']); die();
        
        
        // $this->load->view('dashboard_header',$data);    
        // $this->load->view('student/register/dashboard_topmenu');
        // $this->load->view('student/register/dashboard_sidebar');
        // $this->load->view('student/register/apply_job');
        // $this->load->view('dashboard_footer'); 

        $this->load->view('student/register/student_portal_header', $data);
        
        $this->load->view('student/register/student_portal_sidebar');
        
        
        $this->load->view('student/register/apply_job');
        $this->load->view('student/register/student_portal_footer'); 


      } elseif(!empty($varsessioncheck_id) && $label == "registered" && $action=="applied") {


         $data['user_data']        = $this->student_data->get_student_app_list_by_ID($varsessioncheck_id);

        // $student_id = $student_data_ids[$data["student_email"]][0];
        // $register_id = $this->register->get_id_by_student_data_ID($student_id);
        $data['job_list'] = $this->jobs->get_all_non_induction();
        //var_dump($data['job_list']); die();

        $data['job_applications'] = $this->job_assign->get_all_applied_job_by_student($varsessioncheck_id);
        //var_dump($data['job_applications']);
        $job_assign_array = array();
        $job_assign_date_job_id_chk = array();
        if(!empty($data['job_applications'])) {
          foreach($data['job_applications'] as $k=>$v){
  		
  			   if(!in_array($v['issued_date']."|".$v['due_date']."|".$v['jobs_id'],$job_assign_date_job_id_chk)) $job_assign_date_job_id_chk[] = $v['issued_date']."|".$v['due_date']."|".$v['jobs_id'];
  				
          }
        }
        
        $job_assign_data = array();
        if(!empty($data['job_applications'])) {
            foreach($data['job_applications'] as $k=>$v){
              //var_dump($job_assign_data);
		    
			    foreach($job_assign_date_job_id_chk as $dt){
				    
				    $exp = explode("|",$dt);
				    $issued_date = $exp[0]; $due_date = $exp[1]; $jobs_id = $exp[2];
				    if($issued_date == $v['issued_date'] && $due_date == $v['due_date'] && $jobs_id==$v['jobs_id']){
					    $found = 0; $found_key = 0; $found_dept = ""; $found_done = 0; $found_decline = 0;
              //var_dump($job_assign_data); //die();
					    foreach($job_assign_data as $a=>$b){
						    // var_dump($b);
						    if($b['issued_date']==$issued_date && $b['due_date']==$due_date && $b['jobs_id']==$jobs_id) { 
                                $found = 1; $found_key = $a; $found_dept = $b['job_department_id']; 
                            }
						    
					    }
					    
					    if($found==1){
						    
						    $job_assign_data[$found_key]['job_department_id'] =  $found_dept.",".$v['job_department_id'];
						    if($v['status']=="done" && ($job_assign_data[$found_key]['status']=="pending" || $job_assign_data[$found_key]['status']=="decline"))
							    $job_assign_data[$found_key]['status'] =  "done";						
						    if($v['status']=="decline" && ($job_assign_data[$found_key]['status']!="done"))
							    $job_assign_data[$found_key]['status'] =  "decline";
	    
						    /*else if($found_done==0 && $found_decline==1)
							    $job_assign_data[$found_key]['status'] =  "decline";*/	
					    
					    }else if($found==0){
						    
						    $job_assign_data[] = $v;
					    }	
				    }
				    
				    
			    }
				    
            }
        }        
        //var_dump($job_assign_data);
        $data['job_assign_data'] = $job_assign_data;
        
        //var_dump($data['job_applications']); die();
        
        
        // $this->load->view('dashboard_header',$data);    
        // $this->load->view('student/register/dashboard_topmenu');
        // $this->load->view('student/register/dashboard_sidebar');
        // $this->load->view('student/register/applied_job');
        // $this->load->view('dashboard_footer');

        $this->load->view('student/register/student_portal_header', $data);
        
        $this->load->view('student/register/student_portal_sidebar');
        
        
        $this->load->view('student/register/applied_job');
        $this->load->view('student/register/student_portal_footer'); 




      } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
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
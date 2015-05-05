<?php
  
class Attendence_report_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();
    

      $this->load->helper('download');
      $this->load->helper('functions');     
      $this->load->helper('form');     
      $this->load->library('session');
      $this->load->library('php_mailer');
      $this->load->library('php_excel_class');
      
            
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
      $this->load->model('awarding_body','', TRUE);
      $this->load->model('hesa_class','', TRUE);
      $this->load->model('hesa_exchind','', TRUE);                                   
      $this->load->model('hesa_sselig','', TRUE);                                   
      $this->load->model('hesa_heapespop','', TRUE);                                   
      $this->load->model('hesa_locsdy','', TRUE);                                   
      $this->load->model('hesa_mode','', TRUE);                                   
      $this->load->model('hesa_sexort','', TRUE);                                   
      $this->load->model('hesa_relblf','', TRUE);                                   
      $this->load->model('hesa_student_information','', TRUE);
      $this->load->model('campus_info','', TRUE);
      $this->load->model('hesa_disall','', TRUE);
      $this->load->model('hesa_rsnend','', TRUE);
      $this->load->model('hesa_qual','', TRUE);
      $this->load->model('coc_upload','', TRUE);              
      $this->load->model('hesa_courseaim','', TRUE);              
      $this->load->model('hesa_ttcid','', TRUE);              
      $this->load->model('hesa_subject_of_course','', TRUE);              
      $this->load->model('hesa_sbjca','', TRUE);              
      $this->load->model('hesa_unitlgth','', TRUE);              
      $this->load->model('hesa_domicile','', TRUE);              
      $this->load->model('hesa_genderid','', TRUE);     
      $this->load->model('hesa_sbjca','', TRUE);      
      $this->load->model('hesa_subject_of_course','', TRUE);      
      $this->load->model('hesa_previnst','', TRUE);     
      $this->load->model('hesa_qualtype','', TRUE);     
      $this->load->model('hesa_qualsbj','', TRUE);      
      $this->load->model('hesa_qualsit','', TRUE);      
      $this->load->model('hesa_domicile','', TRUE);     
      $this->load->model('hesa_stuload_student_info','', TRUE);
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
      $this->load->model('hesa_mstufee','', TRUE);                          
      $this->load->model('campus_info','', TRUE);                          
      $this->load->model('student_others_ethnicity','', TRUE);                          
      $this->load->model('country','', TRUE);                          
      $this->load->model('hesa_qualent3','', TRUE);                          
      $this->load->model('attendence_report','', TRUE);                          
}

public function index(){

      // $all_code = $this->hesa_courseaim->get_all_code();
      // var_dump($all_code); die();

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');  
	    $data['message']        =   "";

	    // alert count part
	    
	    $data["alert_count"]                =   0;
	    $data["inbox_alert_count"]          =   0;
	    
	    
	    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
	    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
	    
	    // alert count part end


    
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
        $data['status_list']    = $this->status->get_all();
        $data['staff_id']       = $varsessioncheck_id;
        
        
       if($action=="search" && empty($page) && $this->input->post()>""){
            
            $terms = array();
            foreach($this->input->post() as $k=>$v){
                
                if($k!="ref" && $k!="ref_id"){$$k=tinymce_encode($v); $terms[$k] = $$k;}
            }

            $sesData['report_management_student_search']['terms'] = $terms;

            $this->session->set_userdata($sesData);            
            
            $this->attendence_report->semester_id	=	$terms["semester_id"];
            $this->attendence_report->status_id		=	$terms["student_admission_status_for_staff"];
            $data["attendance_report"] 				= 	$this->attendence_report->get_attendence_list_by_semester();
            
        } 
        
        
        
        
        

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="search") ){

               
      
        if($action=="search"  || ($_POST && $this->input->post('ref')=="search")){
             
            $sesData = $this->session->userdata("report_management_student_search");
            $terms = $sesData['terms'];
            $data['terms'] = $terms;




        }


            
        $data['bodytitle']       =   "Attendence Report Management";
        $data['faicon']          =   "fa-file-text-o";
        $data['breadcrumbtitle'] =   "Dashboard >Attendence Report Management";            

        $data['semester_list']   =   $this->semister->get_all_by_des_order();
        $data['moduleList']      =   $this->coursemodule->get_all();
        $data['group_name']      = 	 $this->class_plan->get_all_group_name();
        $data['level_list']      =	 $this->course_level->get_all_unique_level();
        $data['letter_set']      = 	 $this->letter_set->get_all();
        $data['ref']             =   'search';
        $data['ref_id']          =   ""; 
        
        //var_dump($data['report_list']);
            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');  
        $this->load->view('staff/report/report_attendence_search_body');
        $this->load->view('staff/report/report_attendence_list');
                
        $this->load->view('staff/other_footer');
        
  
        
        
        
        
         

    } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" ) ) {
        redirect('/admin_dashboard/'); 
    } else if(!empty($varsessioncheck_id) && $label=="student" ) {
	    redirect('/user_dashboard/');
    } else if(!empty($varsessioncheck_id) && $label=="registered" ) {
	    redirect('/student_dashboard/');         
    } else{
        redirect('/logout/'); 
    }
    
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       
} // end of index
 
 
}  
  
?>
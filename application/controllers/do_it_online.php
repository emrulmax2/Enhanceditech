<?php
  
class Do_it_online extends CI_Controller {   
    
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
      $this->load->model('register','', TRUE);     
      $this->load->model('attendance','', TRUE);   
      $this->load->model('class_lists','', TRUE);  
      $this->load->model('class_plan','', TRUE);     
      $this->load->model('student_attendance_excuse','', TRUE);     
      $this->load->model('coursemodule','', TRUE);     
      $this->load->model('student_marital_status','', TRUE);     
      $this->load->model('student_others_ethnicity','', TRUE);     
      $this->load->model('student_others_disabilities','', TRUE);
      $this->load->model('student_assign_class','', TRUE);     
      $this->load->model('time_plan','', TRUE);     
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');                  
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
    $data['bodytitle']          =    "Student Application Form";
    $data['breadcrumbtitle']=    "Dashboard > Application form";
    $data['faicon']                =    "fa-mortar-board";    
    $data['message']        =   "";
    $action                         =   $this->input->get('action'); 
    $app_id                         =   $this->input->get('id');      
    $data['settings']            = $settings =   $this->settings->get_settings(); 
    $data["summary_data"]     =   $this->dashboard->get_all_todays_count();
    $data["agent_list"]       =   $this->agent->get_all();
    $data["course_lists"]   =   $this->course_relation->get_by_current_date();
    $data["alert_count"]       =   0;
    $student_data_ids           =   $this->student_data->get_student_data_ids($data["student_email"]);


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
        
        

    
   
        if($_POST) {

            //var_dump($_POST); die();
              $absent_days = serialize( $this->input->post('absent_days') );
              $docs = serialize( $this->input->post('filelist') );
              
             
              
              $student_id = $student_data_ids[$data["student_email"]][0];
              $register_id = $this->register->get_id_by_student_data_ID($student_id);

              $args                     = array();
              $args['register_id']      = $register_id;
              $args['day_id']           = $absent_days;
              $args['reason']           = $this->input->post('reason');
              $args['remarks']          = "";
              $args['doc']              = $docs;
              $args['status']           = 0;
              $args['archived']         = 0;

              $insertedid=$this->student_attendance_excuse->add($args);

              if($insertedid) {
                $data['msg'] = "<div class='alert alert-success'> Do it online has been successfully updated. </div>";
              }
           

        
        }    
               
                
    if(!empty($varsessioncheck_id) && $label == "registered" && $action==Null){

        $data['user_data']        = $this->student_data->get_student_app_list_by_ID($varsessioncheck_id);

        $student_id = $student_data_ids[$data["student_email"]][0];
        $register_id = $this->register->get_id_by_student_data_ID($student_id);
        $attendance_info = $this->attendance->get_attendance_list_by_register_id($register_id);

        if(!empty($attendance_info)) 
        {
          foreach($attendance_info as $k=>$v) {
            
            if($v['attendance_type'] == "A") {

              $module_info = $this->class_plan->get_coursemodule_id_and_by_id($v['class_plan_id']);
              $clean_attendance[$module_info['coursemodule_id']][] = $v['attendance_date']."_".$v['day_id']."_".$v['class_plan_id'];
              

            } 
          } 
        }

        if(!empty($clean_attendance)) {
          $data['clean_attendance'] =  $clean_attendance;
        }
        
        
        //Get class_plan_id list by register_id
        $class_plan_id_list = $this->student_assign_class->get_all_class_plan_id_by_register_id($register_id);

        //Get class_list by class_plan_id
        $class_list = array();
        if (!empty($class_plan_id_list)) {
          foreach ($class_plan_id_list as $k => $v) {
            $module_id  = $this->class_plan->get_coursemodule_id_and_timeplan_id_by_id($v['class_plan_id']);
            $list = $this->class_lists->get_by_class_plan_ID_sorted_by_date($v['class_plan_id']);
            if(!empty($list)) {
                $class_list[$module_id['coursemodule_id']."_".$module_id['time_planid']] = $list;
            }
          }
        }

        //var_dump($class_list); die();
        //Send class_list to view
            
//        usort($array, 'date_compare');
        
        $data['class_list'] = $class_list;
        $data['register_id'] = $register_id;
        
        
        
        
        // $this->load->view('dashboard_header',$data);    
        // $this->load->view('student/register/dashboard_topmenu');
        // $this->load->view('student/register/dashboard_sidebar');
        // $this->load->view('student/register/do_it_online_body');
        // $this->load->view('dashboard_footer'); 

        $this->load->view('student/register/student_portal_header', $data);
        
        $this->load->view('student/register/student_portal_sidebar');
        
        
        $this->load->view('student/register/do_it_online_body');
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
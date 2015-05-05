<?php
  
class Absent_by_four_days extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');
      $this->load->library('php_mailer');       
      $this->load->model('dashboard');          
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');          
      $this->load->model('student_data');          
      $this->load->model('attendance');          
      $this->load->model('register');          
      $this->load->model('student_data');          
      $this->load->model('course');
      $this->load->model('class_plan');
      $this->load->model('coursemodule');
      $this->load->model('sms_issuing');
      $this->load->model('email_issuing');
      $this->load->model('attendance_notify');
      //---------------------------------------- 1s          
      $this->load->model('agreement');          
      $this->load->model('money_receipt');          
      $this->load->model('register');
      $this->load->model('student_data');
      $this->load->model('installment');
      $this->load->model('settings');
      //---------------------------------------- end 1s          
}

public function index(){

    $data                       =   array(); 
    $menuleft                   =   array();
    $data["statements"]         =   array();
    $varsessioncheck_id         =   $this->session->userdata('uid');

    $label                      =   $this->session->userdata('label');
    $action                     =   $this->input->get('action');       
    $data["fullname"]           =   $this->session->userdata('fullname');  
    $data['message']            =   "";
    $data['bodytitle']          =   "Absence List <small>4 Continuous Absence </small>";
    $data['breadcrumbtitle']    =   "Dashboard > 4 Continuous Absence";
    //$data['faicon']           =   "fa-dashboard"; 
    $data['faicon']             =   "fa-dashboard"; 
    
    // alert count part
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;  
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);

    $data['settings']   = $this->settings->get_settings();

    // alert count part end
    
      $data["summary_data"] = $this->dashboard->get_all_todays_count();
      $i                = 0;     

                
    if(!empty($varsessioncheck_id) && $label=="admin" || $label=="staff"){

        $absent_list = $this->attendance->get_attendance_by_attendance_type("A");
        //$absent_list = array_unique($absent_list);
        $clean_absent_list = array();
        if(!empty($absent_list)) 
        {
          foreach ($absent_list as $key => $value) {
            $clean_absent_list[] = $value['register_id']; 
          }
          
        }
        $clean_absent_list = array_unique($clean_absent_list);

        $absent_list_by_four_days = array();
        $absent_list_by_seven_days = array();
        $absent_list_by_ten_days = array();

        if(!empty($clean_absent_list))
        {
          foreach ($clean_absent_list as $k => $v) {

            $absent_list_by_four_days[$v]   = $this->attendance->get_absent_list_by_register_id($v, $limit = 4);
            $absent_list_by_seven_days[$v]  = $this->attendance->get_absent_list_by_register_id($v, $limit = 7);
            $absent_list_by_ten_days[$v]    = $this->attendance->get_absent_list_by_register_id($v, $limit = 10);

            //Get 10 absent days list.
            $ten = count($absent_list_by_ten_days[$v]);
            
            foreach ($absent_list_by_ten_days[$v] as $x => $y) {
              
              if($ten == 10) {

                if($y['attendance_type'] == "P") {
                  unset($absent_list_by_ten_days[$v]);
                }
                
              } else {
                unset($absent_list_by_ten_days[$v]);
              }
              
           
            }


            //Get 7 absent days list.
            $seven = count($absent_list_by_seven_days[$v]);
            foreach ($absent_list_by_seven_days[$v] as $x => $y) {
              if($seven == 7) {

                if($y['attendance_type'] == "P") {
                  unset($absent_list_by_seven_days[$v]);
                }
                
              } else {
                unset($absent_list_by_seven_days[$v]);
              }
              
            }


            //Get 4 absent days list.
            $four = count($absent_list_by_four_days[$v]);
            foreach ($absent_list_by_four_days[$v] as $x => $y) {
              if( $four == 4) {

                if($y['attendance_type'] == "P") {
                  unset($absent_list_by_four_days[$v]);
                }

              } else {
                  unset($absent_list_by_four_days[$v]);              
              }
              
            }


          }
          
        }
        

        foreach ($absent_list_by_ten_days as $key => $value) {
          foreach ($absent_list_by_seven_days as $key7 => $value7) {
            if($key7 == $key) {
              
              unset($absent_list_by_seven_days[$key7]);
            }
            
          }
          foreach ($absent_list_by_four_days as $key4 => $value4) {
            if($key4 == $key) {
              
              unset($absent_list_by_four_days[$key4]);
            }
          }
        }

        foreach ($absent_list_by_seven_days as $key => $value) {
          foreach ($absent_list_by_four_days as $key4 => $value4) {
            if($key4 == $key) {
              
              unset($absent_list_by_four_days[$key4]);
            }
          }
        }


        $data['four_days_absent_list']    = $absent_list_by_four_days;
        
        
        if(isset($_GET['send_sms']) && $_GET['send_sms'] == 1) {

          if($this->session->flashdata('student_list') != "") {
            $total = array();
            foreach ($this->session->flashdata('student_list') as $l => $m) {
              // $student_id = $this->register->get_student_data_ID_no_by_id($l);
              $student_info = $this->student_data->get_all_by_ID($m);
              

              $student_full_name = $student_info['student_first_name']." ".$student_info['student_sur_name'];
               $msg = "Dear $student_full_name. You are absence more than 4 days. Please attend as soon as possible and submit Attendance Excuse.";
              send_sms_txt($student_info['student_mobile_phone'], $msg);

              $args = array();
              $args['student_data_id'] = $m;
              $args['phone'] = $student_info['student_mobile_phone'];
              $args['subject'] = "Alert For More Than 4 Days Absence!";
              $args['description'] = $msg;
              $args['issued_by'] = $this->session->userdata("uid");
              $total[] = $this->sms_issuing->add($args);

            }
            if(count($total) == count($this->session->flashdata('student_list'))) 
            {
              $data['msg'] = "SMS has been sent successfully.";
            }
          }
          
        }

        if(isset($_GET['send_email']) && $_GET['send_email']==1) {
          if($this->session->flashdata('student_list') != "") {
            $total = array();
            foreach ($this->session->flashdata('student_list') as $l => $m) {
              // $student_id = $this->register->get_student_data_ID_no_by_id($l);
              $student_info = $this->student_data->get_all_by_ID($m);
              

              $student_full_name = $student_info['student_first_name']." ".$student_info['student_sur_name'];
              
              $to = $student_info['student_email']; 

              $sub = "Class Absence Notification!";

              $msg = "Dear $student_full_name <br /><br /> You are absence more than 4 days. Which may effect in your attendance percentage. Please attend as soon as possible and submit Attendance Excuse to review your absence reason. <br/><br/>Thank you.";

              $from = $data['settings']['company_name']." <".$data['settings']['smtp_user'].">";

              makeHtmlEmailExtend($to,$sub,$msg,$from,$data['settings']['smtp_user'],$data['settings']['smtp_pass'],$data['settings']['smtp_host'],$data['settings']['smtp_port'],$data['settings']['smtp_encryption'],$data['settings']['smtp_authentication'],$data['settings']['company_name']);

              $args = array();
              $args['student_data_id'] = $m;
              $args['subject'] = "Alert For More Than 4 Days Absence!";
              $args['description'] = $msg;
              $args['issued_by'] = $this->session->userdata("uid");
              $args['issued_date'] = date("Y-m-d", time());
              $total[] = $this->email_issuing->add($args);

            }
            if(count($total) == count($this->session->flashdata('student_list'))) 
            {
              $data['msg'] = "Email has been sent successfully.";
            }
          }

        }
        
        if(isset($_GET['send_both']) && $_GET['send_both']==1) {
          if($this->session->flashdata('student_list') != "") {
            $email_total = array();
            $sms_total = array();
            foreach ($this->session->flashdata('student_list') as $l => $m) {
              // $student_id = $this->register->get_student_data_ID_no_by_id($l);
             
              ///------------------ send email
              $student_info = $this->student_data->get_all_by_ID($m);
              

              $student_full_name = $student_info['student_first_name']." ".$student_info['student_sur_name'];
              
              $to = $student_info['student_email']; 

              $sub = "Class Absence Notification!";

              $msg = "Dear $student_full_name <br /><br /> You are absence more than 4 days. Which may effect in your attendance percentage. Please attend as soon as possible and submit Attendance Excuse to review your absence reason. <br/><br/>Thank you.";

              $from = $data['settings']['company_name']." <".$data['settings']['smtp_user'].">";

              makeHtmlEmailExtend($to,$sub,$msg,$from,$data['settings']['smtp_user'],$data['settings']['smtp_pass'],$data['settings']['smtp_host'],$data['settings']['smtp_port'],$data['settings']['smtp_encryption'],$data['settings']['smtp_authentication'],$data['settings']['company_name']);

              $args = array();
              $args['student_data_id'] = $m;
              $args['subject'] = "Alert For More Than 4 Days Absence!";
              $args['description'] = $msg;
              $args['issued_by'] = $this->session->userdata("uid");
              $args['issued_date'] = date("Y-m-d", time());
              $email_total[] = $this->email_issuing->add($args);
              ///------------------ end send email
              
              
              ///---------------- send sms

               $msg = "Dear $student_full_name. You are absence more than 4 days. Please attend as soon as possible and submit Attendance Excuse.";
              send_sms_txt($student_info['student_mobile_phone'], $msg);

              $args = array();
              $args['student_data_id'] = $m;
              $args['phone'] = $student_info['student_mobile_phone'];
              $args['subject'] = "Alert For More Than 4 Days Absence!";
              $args['description'] = $msg;
              $args['issued_by'] = $this->session->userdata("uid");
              $sms_total[] = $this->sms_issuing->add($args);
              
              ///-------- end send sms              

            }
            if( count($email_total) == count($this->session->flashdata('student_list')) && count($sms_total) == count($this->session->flashdata('student_list')) ) 
            {
              $data['msg'] = "SMS and Email has been sent successfully.";
            }
          }

        }        
        
 
        if($action == "") {
          $dasboard_data=array();    
          $this->load->view('staff/dashboard_header',$data);    
          $this->load->view('staff/dashboard_topmenu');
          $this->load->view('staff/dashboard_sidebar');
          $this->load->view('staff/absent_four_days');
          $this->load->view('staff/dashboard_footer');   
          
        } elseif($action == "archive") {
          $dasboard_data=array();    
          $this->load->view('staff/dashboard_header',$data);    
          $this->load->view('staff/dashboard_topmenu');
          $this->load->view('staff/dashboard_sidebar');
          $this->load->view('staff/absent_four_days_archive');
          $this->load->view('staff/dashboard_footer');   
        }         
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
 /* Latest done*/  
}  
  
?>
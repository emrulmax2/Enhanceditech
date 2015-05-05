<?php
  
class Profile_page extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
      $this->load->model('student_data','', TRUE);     
    
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');  
      $this->load->model('lcc_inbox','', TRUE);     
      $this->load->model('lcc_communication','', TRUE);   
      $this->load->model('staff','', TRUE);               
}

public function index(){

    $data                   =   array(); 
    $menuleft               =   array();
    $data["statements"]     =   array();
    $varsessioncheck_id     =   $this->session->userdata('uid');
    $this->student_data->user_id  =   $varsessioncheck_id;

    $label                  =   $this->session->userdata('label');        
    $data["fullname"]       =   $this->session->userdata('fullname');        
    $data["student_email"]  =   $this->session->userdata('username');
    $data['message']        =   "";
    $data['bodytitle']      =   "Profile Page";
    $data['breadcrumbtitle']=   "Profile page";
    $data['faicon']         =   "fa-user";

      $year                 = date('Y');
      $month                = date('m');
      $date                 = date("d");
      $form_date            = "$year-$month-01";
      $todate_date          = "$year-$month-$date";
      
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
                
                if(count($data["inbox"])>0 && ($data["inbox"][$id][$i]["notification_checked"] == "no" && ($data["inbox"][$id][$i]["notification_type"] == "exam" || $data["inbox"][$id][$i]["notification_type"] == "review"))) { $data["alert_count"] = ++$count; }
            
            }
        }
            
            // alert count part end
                 
        if($_POST)
        {
            
            $email          =   $this->input->post('email');
            $oldpassword    =   $this->input->post('oldpassword');
            $check          =   $this->student_data->check_student_password($oldpassword);
            
            if($check) {
                
                $args=array();
                $password               =   $this->input->post('password');
                $args["student_email"]  =   $email;
                $args["password"]       =   $password;
                
               if($password!="") {
                    $this->student_data->update($args,TRUE);
                    
                } else if($email!="") 
                    $this->student_data->update($args);
                $data['message'] ="Student update successfully.";
            }else{
                $args["student_email"] = $email;
                if($email!="") {
                $this->student_data->update($args);
                $data['message'] ="Student update successfully.";
                }
                
            }
        }            
                
    if(!empty($varsessioncheck_id) && $label == "student" || $label == "registered") {
            
        $dasboard_data=array();  
        $data["user_data"] = $this->student_data->get_by_ID();  
        // $this->load->view('dashboard_header',$data);    
        // $this->load->view('student/dashboard_topmenu');
        // if($label == "student") {
        //   $this->load->view('student/dashboard_sidebar');
        // } else {
        //   $this->load->view('student/register/dashboard_sidebar');
        // }
        // $this->load->view('student/profile_page_body');
        // $this->load->view('other_footer'); 

        $this->load->view('student/register/student_portal_header', $data);
        if($label == "student") {
          $this->load->view('student/dashboard_sidebar');
        } else {
          $this->load->view('student/register/student_portal_sidebar');
        }
        
        $this->load->view('student/register/portal_change_password');
        $this->load->view('student/register/student_portal_footer');

        
      
        
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
<?php
  
class Staffprofile_page extends CI_Controller {   
    
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
     // alert count part
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;  
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    // alert count part end
            
            // alert count part end
                 
        if($_POST)
        {
            

            $oldpassword    =   $this->input->post('oldpassword');
            $password    =   $this->input->post('password');
            $check          =   $this->staff->check_password($oldpassword,$this->session->userdata('uid'));
            
            if($check) {
                
                $args=array();
                $args["id"]  =   $this->session->userdata('uid');
                $args["password"]       =   $password;
                
               if($password!="") {
                    $this->staff->update($args,TRUE,"MD5");
                    $data['message'] ="Password changed successfully."; 
                } 
            }else{

                $data['err'] ="Old Password does not match.";

                
            }
        }            
                
    if(!empty($varsessioncheck_id) && ($label == "staff" || $label == "admin")){
            
        $dasboard_data=array();  
        $data["user_data"] = $this->staff->get_by_ID($this->session->userdata('uid'));  
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/profile_page_body');
        $this->load->view('other_footer'); 

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
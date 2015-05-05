<?php
  
class Agentprofile_page extends CI_Controller {   
    
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
      $this->load->model('agent','', TRUE);               
}

public function index(){

    $data                   =   array(); 
    $menuleft               =   array();
    $data["statements"]     =   array();
    $varsessioncheck_id     =   $this->session->userdata('uid');


    $label                  =   $this->session->userdata('label');        
    $data["fullname"]       =   $this->session->userdata('fullname');        

    $data['message']        =   "";
    $data['bodytitle']      =   "Profile Page";
    $data['breadcrumbtitle']=   "Profile page";
    $data['faicon']         =   "fa-user";

            
            // alert count part end
                 
        if($_POST)
        {
            

            $oldpassword    =   $this->input->post('oldpassword');
            $password    =   $this->input->post('password');
            $check          =   $this->agent->check_password($oldpassword,$this->session->userdata('uid'));
            
            if($check) {
                
                $args=array();
                $args["id"]  =   $this->session->userdata('uid');
                $args["password"]       =   $password;
                
               if($password!="") {
                    $this->agent->update($args,TRUE,"MD5");
                    $data['message'] ="Password changed successfully."; 
                } 
            }else{

                $data['err'] ="Old Password does not match.";

                
            }
        }            
                
    if($label=="agent"){
            
        $dasboard_data=array();  
        $data["user_data"] = $this->agent->get_by_ID($this->session->userdata('uid'));  
        $this->load->view('agent/dashboard_header',$data);    
        $this->load->view('agent/dashboard_topmenu');
        $this->load->view('agent/dashboard_sidebar');
        $this->load->view('agent/profile_page_body');
        $this->load->view('other_footer'); 


    }else{
        redirect('/logout/'); 
    }
    
    
       
} // end of index
   
}  
  
?>
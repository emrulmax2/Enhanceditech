<?php
  
class Password_retrive extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');          
}

public function index(){
    $infolist               =   array();
    $data                   =   array(); 
    $menuleft               =   array();
    $data["statements"]     =   array();
    $varsessioncheck_id     =   $this->session->userdata('uid');

    $label                  =   $this->session->userdata('label');        
    $data["fullname"]       =   $this->session->userdata('fullname');  
    $data['logout']         =   $this->input->get('l');
    $data['settings']       =   $this->settings->get_settings(); 
    $data['retriveid']      =   $this->input->get('ret');
    $data['message']        =   "";
    $data['error']          =   0;
    $year                   =   date('Y');
    $month                  =   date('m');
    $date                   =   date("d");
    $form_date              =   "$year-$month-01";
    $todate_date            =   "$year-$month-$date";
    $i                      =   0; 
    $infolist               =   $this->login->get_email_byRetriveID($data['retriveid']);   

      if($_POST)
      {
          
        $username="";
        $password=$this->input->post('password');  
        if($infolist["type"]=="student"){
            
            $data['message']=$this->login->retrivePassword(array("username"=>$infolist["username"],"password"=>$password),$infolist["type"]);
        
        }else if($infolist["type"]=="admin" || $infolist["type"]=="staff"){
            
            $data['message']=$this->login->retrivePassword(array("username"=>$infolist["username"],"password"=>$password),$infolist["type"]);            
        }
      }
          
                
    if(!empty($varsessioncheck_id) && $label=="admin" || $label=="staff"){
            
        redirect('/admin_dashboard/');      
        
    }else if(!empty($varsessioncheck_id) && $label=="student" ){
        redirect('/user_dashboard/'); 
    }else{
        
        
        if(isset($data['retriveid']) && $infolist!= FALSE) // after complete change to !=
        {
            $this->load->view('login_header',$data);
            $this->load->view('password_retrive_body');
            $this->load->view('login_footer');
        } else
        {
           redirect('/logout/');
        }
                  
    }
    
    
       
} // end of index
   
}  
  
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_to_student_panel extends CI_Controller {
    
     function __construct() {
  
        parent::__construct();
      $this->load->model('login','', TRUE);
      $this->load->model('student_data','', TRUE);
      $this->load->helper('form');
      $this->load->library('session');         

}

    public function index()
    {

        if($this->session->userdata('uid'))
        {
          redirect('/user_dashboard/');  
        }
        $data=array();
        $name ="";
       $data['message']="";
       $data['error']=0;
       $data['logout']=$this->input->get('l');
       $data['settings']=$this->settings->get_settings(); 
       if($data['logout']==1){
           $data['message']="You are successfully logged out";
       }

      if($this->input->get('enc') > "")
      {
	       $lebel="";   

	       $encript_id = tinymce_encode($this->input->get('enc'));
	       

	       $uid = $this->login->get_user_by_activate_session_id($encript_id);
	        if(!empty($uid))
	        {  
	          $name=$this->login->get_fullname($uid['username']);      
	                    
	           $newdata = array(
	                   'uid'        =>  "".$uid['uid']."",
	                   'username'   =>  "".$uid['username']."",
	                   'fullname'   =>  "$name",
	                   'label'      =>  "student",
	                   'logged_in'  =>  TRUE
	               ); 
	          
	          $newdata['label']=$this->login->checkUserType($uid['username']);

	          $this->session->set_userdata($newdata); 
	          
	          $this->student_data->change_activate_session_id_by_student_data_id($uid['uid']);

	           if($newdata['label'] == "student")
	           redirect('/user_dashboard/');
	           else if($newdata['label'] == "registered") {   
	            redirect('/student_dashboard/');
	           } 
           
	           
	        }else{
	            
	           $data['message']="Encryption key is invalid."; 
	           $data['error']=1; 
	        }
     
     }

        $this->load->view('login_header');
        $this->load->view('login_body',$data);
        $this->load->view('login_footer');
    
    }

}
?>
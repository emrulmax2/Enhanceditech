<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_controller extends CI_Controller {
    
     function __construct() {
  
        parent::__construct();
      $this->load->model('login','', TRUE);
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

      if($_POST)
      {
       $lebel="";   
       $username=strtolower($this->input->post('login'));
       $password=$this->input->post('password');
       $is_email= filter_var($username, FILTER_VALIDATE_EMAIL);     
       if($is_email)
        $uid=$this->login->get_user($username,$password);
       else   {
        $uid=$this->login->get_registered_user($username,$password);
        $username=$this->login->get_mail_by_register($username);
       }
        if($uid)
        {  
          $name=$this->login->get_fullname($username);      
                    
           $newdata = array(
                   'uid'        =>  "$uid",
                   'username'   =>  "$username",
                   'fullname'   =>  "$name",
                   'label'      =>  "student",
                   'logged_in'  =>  TRUE
               ); 
          
          $newdata['label']=$this->login->checkUserType($username);
         // var_dump($newdata);
          if($newdata['label']=="staff"){
		  		
		  		$staff_access = $this->login->getStaffAccess($uid);
		  		
		  		$all_access  = $staff_access['staff_privileges'];
		  		
		  		
		  		//var_dump($all_access);
		  		
	            $exp_student_admission = explode(",",$staff_access['staff_privileges_student_admission']);

	            //$err='';
	            foreach($exp_student_admission as $k=>$v){
	                $newdata['staff_privileges_student_admission'][$v] = 'on';
	            }//foreach($exp as $k=>$v){	
	            
	            $exp_staff_management = explode(",",$staff_access['staff_privileges_staff_management']);
	        
	            foreach($exp_staff_management as $k=>$v){
	                $newdata['staff_privileges_staff_management'][$v] = 'on';
	            }//foreach($exp as $k=>$v){
	            
	            $exp_agent_management = explode(",",$staff_access['staff_privileges_agent_management']);
	        
	            foreach($exp_agent_management as $k=>$v){
	                $newdata['staff_privileges_agent_management'][$v] = 'on';
	            }//foreach($exp as $k=>$v){ 
	            
	            $exp_semister_management = explode(",",$staff_access['staff_privileges_semister_management']);
	            
	            foreach($exp_semister_management as $k=>$v){
	                $newdata['staff_privileges_semister_management'][$v] = 'on';
	            }//foreach($exp as $k=>$v){
	            
	            $exp_course_management = explode(",",$staff_access['staff_privileges_course_management']);
	        
	            foreach($exp_course_management as $k=>$v){
	                $newdata['staff_privileges_course_management'][$v] = 'on';
	            }//foreach($exp as $k=>$v){
	            
	            $exp_course_rel_management = explode(",",$staff_access['staff_privileges_course_relation_management']);
	        
	            foreach($exp_course_rel_management as $k=>$v){
	                $newdata['staff_privileges_course_relation_management'][$v] = 'on';
	            }//foreach($exp as $k=>$v){	            
	            
	            $exp_report = explode(",",$staff_access['staff_privileges_report_management']);	            
	            if(count($exp_report) > 1){	                
	                    foreach($exp_report as $k=>$v){
	                        $newdata['admin_report_management'][$v] = 'on';
	                    }	                    
	            }else if(count($exp_report) == 1 && !empty($staff_access['staff_privileges_report_management'])){//if(count($exp_report) > 1){	                
	                $newdata['admin_report_management']['report_mng'] = 'on';	                
	            }// else
	            
	            $exp_report = explode(",",$staff_access['staff_privileges_inbox_management']);
	            if(count($exp_report) > 1){	                
	                    foreach($exp_report as $k=>$v){
	                        $newdata['admin_inbox_management'][$v] = 'on';
	                    }	                    
	            }else if(count($exp_report) == 1 && !empty($staff_access['staff_privileges_inbox_management'])){//if(count($exp_report) > 1){	                
	                $newdata['admin_inbox_management']['inbox_mng'] = 'on';	                
	            }// else
	            
	            $exp_exam = explode(",",$staff_access['staff_privileges_exam_management']);	            
	            if(count($exp_exam) > 1){	                
	                    foreach($exp_exam as $k=>$v){
	                        $newdata['admin_exam_management'][$v] = 'on';
	                    }	                    
	            }else if(count($exp_exam) == 1 && !empty($staff_access['staff_privileges_exam_management'])){//if(count($exp_report) > 1){	                
	                $newdata['admin_exam_management']['exam_mng'] = 'on';	                
	            }// else
	            	            	            	            	            	            	             	            	  			  
	  
          }
          $this->session->set_userdata($newdata); 
           if($newdata['label'] != "student" && $newdata['label'] != "agent" && $newdata['label'] != "registered")
           redirect('/admin_dashboard/');
           else if($newdata['label'] == "student")
           redirect('/user_dashboard/');
           else if($newdata['label'] == "registered") {   
            redirect('/student_dashboard/');
           } 
           else if($newdata['label'] == "agent")
           redirect('/agent_dashboard/');           
           
        }else{
            
           $data['message']="User name or password is invalid."; 
           $data['error']=1; 
        }
     
     }

        $this->load->view('login_header');
        $this->load->view('login_body',$data);
        $this->load->view('login_footer');
    
    }

}
?>
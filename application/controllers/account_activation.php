<?php
  
class Account_activation extends CI_Controller {   
    
    function __construct() {
      
         parent::__construct();
         $this->load->model('login','', TRUE);     
         $this->load->model('student_data','', TRUE);     
         $this->load->helper('functions');      
         $this->load->helper('form');      
         $this->load->library('session');        
             
    }

    public function index(){
        
        $data                   =   array();
        $data['message']        =   "";
        $data['error']          =   0;
        $data['logout']         =   $this->input->get('l');
        $data['settings']       =   $this->settings->get_settings();    
        $name                   =   "";
        $dt                     =   tinymce_decode($this->input->get('dt'));    
        $chk                    =   $this->student_data->checkAndActivateStudent($dt);
        $data['activation_msg'] =   $chk['html'];

     
     
        if ( $this->session->userdata('uid') )
        {
          redirect('/user_dashboard/');  
        }
            
        if ( $data['logout'] == 1 ) {
            
          $data['message']        = "You are successfully logged out";
        }
          
            if($_POST)
            {
              
                $username         =   strtolower($this->input->post('login'));
                $password         =   $this->input->post('password');
                $uid              =   $this->login->get_user($username,$password);
           
              if($uid)
              {
                $name             =   $this->login->get_fullname($username);
                $newdata          =   array(
                                              'uid'        =>  "$uid",
                                              'username'   =>  "$username",
                                              'fullname'   =>  "$name",
                                              'label'      =>  "student",
                                              'logged_in'  =>  TRUE
                                            );                          
                $newdata['label'] = $this->login->checkUserType($username);
                  // Access priviligation start
                  if( $newdata['label'] == "staff" ) {
                          
                    $staff_access          = $this->login->getStaffAccess($uid);
                          
                    $exp_student_admission = explode(",",$staff_access['staff_privileges_student_admission']);

                    foreach( $exp_student_admission as $k => $v ) {
                        
                        $newdata['staff_privileges_student_admission'][$v] = 'on';

                    }                
                    $exp_staff_management   =   explode(",",$staff_access['staff_privileges_staff_management']);
                    
                    foreach( $exp_staff_management as $k => $v ) {
                    
                        $newdata['staff_privileges_staff_management'][$v]  = 'on';
                        
                    }
                        
                        $exp_agent_management   = explode(",",$staff_access['staff_privileges_agent_management']);
                    
                    foreach( $exp_agent_management as $k => $v ) {
                    
                        $newdata['staff_privileges_agent_management'][$v]  = 'on';
                    }
                        
                        $exp_semister_management = explode(",",$staff_access['staff_privileges_semister_management']);
                        
                    foreach( $exp_semister_management as $k => $v ){
                        
                        $newdata['staff_privileges_semister_management'][$v] = 'on';
                        
                    }
                        
                        $exp_course_management   = explode(",",$staff_access['staff_privileges_course_management']);
                    
                    foreach($exp_course_management as $k => $v ) {
                        
                        $newdata['staff_privileges_course_management'][$v] = 'on';
                        
                    }         
                        $exp_course_rel_management = explode(",",$staff_access['staff_privileges_course_relation_management']);
                    
                    foreach($exp_course_rel_management as $k => $v ) {
                        
                        $newdata['staff_privileges_course_relation_management'][$v] = 'on';
                        
                    }               
                        
                    $exp_report = explode(",",$staff_access['staff_privileges_report_management']);                
                    
                    if( count($exp_report) > 1 ) { 
                                       
                        foreach($exp_report as $k => $v ) {
                            
                            $newdata['admin_report_management'][$v] = 'on';
                        
                        }                        
                    } else if(count( $exp_report ) == 1 && !empty($staff_access['staff_privileges_report_management'])) {                   
                            $newdata['admin_report_management']['report_mng'] = 'on';                    
                    }
                        
                    $exp_report = explode(",",$staff_access['staff_privileges_inbox_management']);
                            
                    if( count( $exp_report ) > 1 ) {                    
                            foreach( $exp_report as $k=>$v){
                            
                                    $newdata['admin_inbox_management'][$v] = 'on';
                            
                            }                        
                    } else if(count($exp_report) == 1 && !empty($staff_access['staff_privileges_inbox_management']) ) {                    
                            $newdata['admin_inbox_management']['inbox_mng'] = 'on';                    
                    }
                        
                    $exp_exam = explode(",",$staff_access['staff_privileges_exam_management']);                
                    
                    if(count( $exp_exam ) > 1 ){
                                        
                             foreach( $exp_exam as $k => $v ) {
                                 
                                    $newdata['admin_exam_management'][$v] = 'on';
                             
                             }                        
                    } else if( count( $exp_exam ) == 1 && !empty( $staff_access['staff_privileges_exam_management'] ) ) {
                                        
                             $newdata['admin_exam_management']['exam_mng'] = 'on';                    
                    
                    }                                                                                                                                     
              
                  }
                  // Access priviligation end
                  $this->session->set_userdata($newdata); 
                  
                  if($newdata['label'] != "student")
                    redirect('/admin_dashboard/');
                  else
                    redirect('/user_dashboard/');
                   
              } else {
                
               $data[ 'message' ]   =   "User name or password is invalid."; 
               $data[ 'error'   ]   =   1; 
              }
         
            }

            
        $this->load->view('login_header');
        $this->load->view('login_body',$data);
        $this->load->view('login_footer');
        
        
           
    } // end of index
   
}  
  
?>
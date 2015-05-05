<?php
  
class Student_signup extends CI_Controller {   
    
   function __construct() {
      
            parent::__construct();

         
          $this->load->model('login','', TRUE);     
          $this->load->model('student_data','', TRUE);     
          $this->load->model('student_title','', TRUE);     
          $this->load->model('student_gender','', TRUE);     
          $this->load->model('settings','', TRUE);     
      
          $this->load->helper('functions');      
          $this->load->helper('form');      
          $this->load->library('session');
          $this->load->library('php_mailer');                        
    }

    public function index(){

	        $data                   	=   array(); 
	        $menuleft               	=   array();
	        $data['message']        	=   "";
        
            $data['bodytitle']          =   "Welcome! <small>you are one step closer.</small>";
            $data['breadcrumbtitle']    =   "Sign Up ";
            $data['faicon']             =   "fa-send"; 
			$data['settings']			=	$this->settings->get_settings();
			/*if(!empty($data['settings']['company_name'])) $com_name = $data['settings']['company_name']; else $com_name = ""; 
			if(!empty($data['settings']['email'])) $com_email = $data['settings']['email']; else $com_email = ""; 
			if(!empty($data['settings']['email_user'])) $com_email_user = $data['settings']['email_user']; else $com_email_user = ""; 
			if(!empty($data['settings']['email_pass'])) $com_email_pass = $data['settings']['email_pass']; else $com_email_pass = "";*/ 
      // var_dump($data['settings']);
      // die();                           
/*                    echo "<pre>";
                  var_dump($data['settings']);
                  echo "</pre>";  */
           if($_POST){
               
               // adding data and message apply
               
               foreach($this->input->post() as $k=>$v){
                   $$k=tinymce_encode($v); 
                   if($k!="repassword" && $k!="usertype") $args[$k] = $$k;
               }

               //var_dump($args);
               
               if($this->student_data->checkForExistingEmail($student_email)>0){
                   
                   $data['message'] = '<div class="alert alert-warning ">
                    <p><span class="glyphicon glyphicon-exclamation-sign"></span> This email address already exist in our database, Please try another.</p>
                    <script>$("input[name=student_email]").parent().addClass("has-error");</script>
                </div>';
               
               }else if(preg_match('/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD', $student_email) != 1){
                   
                   $data['message'] = '<div class="alert alert-warning ">
                    <p><span class="glyphicon glyphicon-exclamation-sign"></span> Your provided email address is invalid.</p>
                    <script>$("input[name=student_email]").parent().addClass("has-error");</script>
                </div>';
                   
               }else{
                   
                   $args['student_application_reference_no'] = $this->student_data->get_next_reference_no();
                   $args['activate_session_id'] = $sid = $this->session->userdata('session_id');
                   $args['student_date_of_birth'] = "";
                   $args['student_country_of_birth'] = "";
                   $args['student_nationality'] = "";
                  // var_dump($args);
                   $insertedID = $this->student_data->add($args,"MD5");
                   
                   $student_full_name = $student_title." ".$student_first_name." ".$student_sur_name;
                   
                    $to = $student_email;
                    $sub = "Activation email for ".$data['settings']['company_name']." admission.";
                    $msg = "Dear $student_full_name<br /><br />Thank you for registering with ".$data['settings']['company_name']." .<br /><br />To activate your application account, please click below: <br /><br /> <a target='_blank' href='".base_url()."index.php/account_activation/?dt=$sid'>Click here to activate your account.</a> <br /><br /> If you did not register with ".$data['settings']['company_name'].", please disregard  this email. <br /><br /> Thank you, <br /><br /> ".$data['settings']['company_name']."";
                    $from = $data['settings']['company_name']." <".$data['settings']['smtp_user'].">";
                    makeHtmlEmailExtend($to,$sub,$msg,$from,$data['settings']['smtp_user'],$data['settings']['smtp_pass'],$data['settings']['smtp_host'],$data['settings']['smtp_port'],$data['settings']['smtp_encryption'],$data['settings']['smtp_authentication'],$data['settings']['company_name']);                   
                   
                   
                   
                   $data['message'] = '<div class="alert  alert-success ">
                    <p><span class="glyphicon glyphicon-ok"></span> Your account has been successfully created. 
                    Please check your email for further instruction.</p>
                    </div>
                    <script>$("#userform").hide();</script>';    
                   
               }
               
               
           }
                
            $data['title_list'] = $this->student_title->get_all();    
            $data['gender_list'] = $this->student_gender->get_all();    

                
            $this->load->view('login_header',$data);    
            $this->load->view('signup_body');    
            $this->load->view('login_footer'); 
      
               

        
        
        
        
        
        
    }
   
}  
  
?>
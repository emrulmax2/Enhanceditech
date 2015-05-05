<?php
  class Login extends CI_Model {
     
      public $user_id;

     
     function __construct() {
       
          parent::__construct();
          $this->load->model('fixidb');
          $this->load->model('student_title');
          $this->load->library('session'); 
          $this->load->database();
          $this->user_id    =   $this->session->userdata('uid');     
    }
        
    /**
    * check user is logged in or not
    * 
    * 
    */
    
    function is_logged_in(){
        if( isset( $this->user_id ) && $this->user_id != 0 )
        return TRUE;  
     return FALSE;
    
    }    
    function unset_login(){
        $this->user_id=0;
     return TRUE;
    }
    /**
    * check user inserted a student id or not
    * 
    * @param mixed $username
    * @return TRUE if user is a student Otherwise False.
    */
    function checkUserType($username){
        $this->db->db_select();
        $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->student_data}` WHERE `student_email`=\"{$username}\" LIMIT 1");
        $status="";
        foreach($qcheck->result() as $row):
        $status=$row->student_status;
        endforeach;
        
        if($status=="active")
        $user_type ="student";
        else {
	         $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->staff}` WHERE staff_email=\"{$username}\" LIMIT 1");
	 
	        $status="";
	        foreach($qcheck->result() as $row):
	        $status=$row->staff_status;
	        endforeach;
	     
	         if($status=="active"){  
	         	$user_type =$qcheck->row()->staff_type;
			 }else{ 
				//
				$qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->agent}` WHERE email_address=\"{$username}\" LIMIT 1");
				$status="";
		        foreach($qcheck->result() as $row):
		        $status=$row->agent_status;
		        endforeach;
		        
	         	if($status=="active"){  
	         		$user_type = "agent";
				}else{
					$user_type ="";	
				}
	         	
		        
			 }
               
        }
        
        
        return $user_type;
    }
    
    /**
    * 
    */
    function get_user($username="",$password="")
    {
        
        $username=stripslashes_deep($username);
           
        $password=stripslashes_deep($password); 
        $qcheck="";
      
       /* check the user is a student or not*/

       $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->student_data}` WHERE `student_email`=\"$username\" AND `student_status` = 'active'  ORDER BY `id` ASC LIMIT 1");     // for student


        if (!empty($qcheck) && $qcheck->num_rows() > 0)
        {
            $row = $qcheck->row();    
            $hash_ceck_password=$qcheck->row()->password;
            $ID=$qcheck->row()->id;
            if(strlen($hash_ceck_password)<=32)             
                $hash_password=md5($password);       // for stuff 
            else if(strlen($hash_ceck_password)<=40)
                $hash_password=sha1($password);      // for student  and some stuff also
            else
                $hash_password=crypt($password,$hash_ceck_password);
 
            if($hash_password===$hash_ceck_password){
                $this->user_id = $ID;
             return $this->user_id;
            }else{
             return FALSE;    
            }
        }
        else
        {
            $sql ="SELECT * FROM `{$this->fixidb->staff}` WHERE `staff_email`=\"$username\" AND `staff_status` = 'active'  LIMIT 1";
            $qcheck=$this->db->query($sql);     // for staff 
            if (!empty($qcheck) && $qcheck->num_rows() > 0)
            {
                $row = $qcheck->row();    
                $hash_ceck_password=$qcheck->row()->password;
                $ID=$qcheck->row()->id;
                if(strlen($hash_ceck_password)<=32)             
                    $hash_password=md5($password);       // for stuff 
                else if(strlen($hash_ceck_password)<=40)
                    $hash_password=sha1($password);      // for student  and some stuff also
                else
                    $hash_password=crypt($password,$hash_ceck_password);
     
                if($hash_password===$hash_ceck_password){
                    $this->user_id = $ID;
                 return $this->user_id;
                }else{
                 return FALSE;    
                }
            } else {
            
	            $sql ="SELECT * FROM `{$this->fixidb->agent}` WHERE `email_address`=\"$username\" AND `agent_status` = 'active'  LIMIT 1";
	            $qcheck=$this->db->query($sql);     // for agent             
                //return FALSE;
                
	            if (!empty($qcheck) && $qcheck->num_rows() > 0)
	            {
	                $row = $qcheck->row();    
	                $hash_ceck_password=$qcheck->row()->password;
	                $ID=$qcheck->row()->id;
	                if(strlen($hash_ceck_password)<=32)
	                    $hash_password=md5($password);       // for stuff 
	                else if(strlen($hash_ceck_password)<=40)
	                    $hash_password=sha1($password);      // for student  and some stuff also
	                else
	                    $hash_password=crypt($password,$hash_ceck_password);
	     
	                if($hash_password===$hash_ceck_password){
	                    $this->user_id = $ID;
	                 return $this->user_id;
	                }else{
	                 return FALSE;    
	                }
	            } else {
	             	return false;
				}                
            }
        }
        
    }
    /**
    * update user module table password
    * 
    * @param mixed $args
    */
     function update_student_passowrd($args=array())
    {
        
      $default=array('student_email'=>'','password'=>'');
     
      $args=fixi_parse_args($args,$default);
      $this->db->db_select();
      $this->db->update($this->fixidb->student_data,$args,array('student_email'=>$args['student_email']));
    
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }       
    function update_staff_passowrd($args=array())
    {
      $this->db->db_select();
      $this->db->update($this->fixidb->staff,array("password"=>$args["password"],"pass_activate"=>''),array('staff_email'=>$args['staff_email']));
    
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }  

   /**
   * changed user password.
   * 
   * @param mixed $args
   * @return mixed
   */
    function changePassword($args=array()){
        
      $default=array("oldpassword"=>'',"username"=>'',"newpassword"=>'');       
      $args=fixi_parse_args($args,$default);
                $this->db->db_select();
                $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->student_data}` WHERE `student_email`=\"{$args['username']}\" LIMIT 1");
      
         // exit;
        if (!empty($qcheck) && $qcheck->num_rows() > 0)
        {

            $row = $qcheck->row();  

            $hash_check_password=$qcheck->row()->password;

            if(strlen($hash_check_password)<=32)             
                $hash_password=md5($args["oldpassword"]);       
            else if(strlen($hash_check_password)<=40)
                $hash_password=sha1($args["oldpassword"]);      
            else
                $hash_password=crypt($args["oldpassword"],$hash_check_password);

            if($hash_password===$hash_check_password){

                 
                // update user table password
              $data_stu["username"]=$args["username"];       
              $data_stu["password"]=sha1($args["newpassword"]);       
              $return=$this->update_student_passowrd($data_stu);
             
             if($return) return '<div class="alert  alert-success">
                    <p><span class="glyphicon glyphicon-ok"></span> Password successfully changed</p>
                </div>';
              else return '<div class="alert alert-danger ">
                <p><span class="glyphicon glyphicon-remove"></span> Wrong old password.</p>
              </div>' ; 
            
        }
        else
        {
             return  '<div class="alert alert-warning ">
                    <p><span class="glyphicon glyphicon-exclamation-sign"></span> Password can\'t be changed</p>
                </div>';
        }
        
        } 
        
    
    }
    
    
    function get_fullname($username){
        
              $this->db->db_select();
        $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->student_data}` WHERE `student_email`=\"{$username}\" LIMIT 1");
        $status="";
        foreach($qcheck->result() as $row):
        $status=$row->student_status;
        endforeach;
        if($status=="active")
        $name=$this->student_title->get_name_by_id($qcheck->row()->student_title)." ".$qcheck->row()->student_first_name." ".$qcheck->row()->student_sur_name;
        else {
	         $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->staff}` WHERE `staff_email`=\"{$username}\" LIMIT 1");
	         $status="";
	         if($qcheck->num_rows() > 0){
	         	 
		         $status=$qcheck->row()->staff_status;  
		     }    
		         if($status=="active"){ 
		         $name=$qcheck->row()->staff_name;
				 }else{ 
			 		 
	         		$qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->agent}` WHERE `email_address`=\"{$username}\" LIMIT 1");
	        		$status=$qcheck->row()->agent_status;			 	 
			 		if($status=="active"){
			 			$name=$qcheck->row()->agent_name;
					}else{
						$name ="";	
					} 		 
				 }
				 

		 
         }
        return $name;         
    
    }
    
function retrivePassword($args=array(),$type="student"){
          
      $default  =   array("username"=>'',"password"=>'');       
      $args     =   fixi_parse_args($args,$default);
      
        if($type=="student") {
              $data_stu["student_email"]        =   $args["username"];       
              $data_stu["password"]             =   sha1($args["password"]);       
              $data_stu["pass_activate"]        =   "";       
              $return                           =   $this->update_student_passowrd($data_stu);
        }else if($type=="admin" || $type=="staff" ) {
              $data_stu["staff_email"]          =   $args["username"];       
              $data_stu["password"]             =   sha1($args["password"]);
              $data_stu["pass_activate"]        =   "";         
              $return                           =   $this->update_staff_passowrd($data_stu);
        }
             
        if($return) {

                 
                // update user table password

             
             return '<div class="alert  alert-success">
                    <p><span class="glyphicon glyphicon-ok"></span> Password successfully changed</p>
                </div>';
            
        }
        else
        {
             return  '<div class="alert alert-warning ">
                    <p><span class="glyphicon glyphicon-exclamation-sign"></span> Password can\'t be changed</p>
                </div>';
        }
        
         
        
    
    }
    
    
function getStaffAccess($ID){
	$access = array();
	$qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->staff}` WHERE `id`=\"$ID\"");	
        
        foreach($qcheck->result() as $row):
            $access['staff_privileges_student_admission']=$row->staff_privileges_student_admission;
            $access['staff_privileges_staff_management']=$row->staff_privileges_staff_management;
            $access['staff_privileges_agent_management']=$row->staff_privileges_agent_management;
            $access['staff_privileges_semister_management']=$row->staff_privileges_semister_management;
            $access['staff_privileges_course_management']=$row->staff_privileges_course_management;
            $access['staff_privileges_course_relation_management']=$row->staff_privileges_course_relation_management;
            $access['staff_privileges_report_management']=$row->staff_privileges_report_management;
            $access['staff_privileges_inbox_management']=$row->staff_privileges_inbox_management;
            $access['staff_privileges_exam_management']=$row->staff_privileges_exam_management;
            
        endforeach;
        
        
        return $access;	
	
	
}    
  

function get_email_byRetriveID($ID){
   $this->db->db_select();
   
      $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->student_data}` WHERE `pass_activate`=\"$ID\" AND student_status = 'active'  LIMIT 1");  
        $email="";
        foreach($qcheck->result() as $row):
            $email=$row->student_email;
            
        endforeach;
        
       if($email == ""){
          $sql ="SELECT * FROM `{$this->fixidb->staff}` WHERE `pass_activate`=\"$ID\" AND `staff_status` = 'active'  LIMIT 1";
          $qcheck=$this->db->query($sql);
          $status ="";
          foreach($qcheck->result() as $row):
            $email=$row->staff_email;
            $status=$row->staff_type;
          endforeach;
          if($email!=""){ return array("username"=>$email,"type"=>$status); } else { return False;}
          
       } else {
           return array("username"=>$email,"type"=>"student");
       }
}  
  
}  
?>
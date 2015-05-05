<?php
  
class Student_data extends CI_Model {
     
     public $user_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('semister','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('agent','',TRUE);
        $this->load->model('student_title','',TRUE);
        
        $this->load->library('session');   

    }
        
    /**
    * update user basic information
    * 'ID'=>$this->user_id,
    * 'username'=>'',
    * 'user_email'=>'',
    * 'password'=>'',
    * 'last_login'=>'',
    * 'active'=>1
    * @param ARRAY $args 
    * @return TRUE if succefully update else return False
    */    
    function update($args=array(),$pass_change_on = FALSE, $pass_encrypt = "SHA1")
    {
      if($pass_change_on == TRUE) {
       
      $default  =   array('id'=>$this->user_id,'password'=>'');
      
	      if($pass_encrypt == "SHA1") 
	        $args['password']  =    sha1($args['password']);
	      else if($pass_encrypt == "MD5"){
	        $args['password']  =    md5($args['password']);

		  }
		  $args=fixi_parse_args($args,$default);
          
      } else {
	      unset($args['password']);
	      $default  =   array('id'=>$this->user_id);
	      $args     =   fixi_parse_args($args,$default);
      }

      $this->db->update($this->fixidb->student_data,$args,array('id'=>$args['id']));
      
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }
    
        
    /**
    * update all aplication
    * 
    * @param mixed $args
    */
    function update_app($args=array()){
        //var_dump($args);
       unset($args['password']);
       if(!empty($args['student_email'])){
           $query=$this->db->query("SELECT student_email FROM ".$this->fixidb->student_data." WHERE id !='".$args['id']."' AND student_email='".$args['student_email']."' LIMIT 1");
           
           if($query->num_rows()>0){
              unset($args['student_email']); 
           }
       }   
       //$chkExistEmail = 
       //unset($args['student_email']); 
       $this->db->update($this->fixidb->student_data,$args,array('id'=>$args['id']));
      
      if($this->db->affected_rows()>0) return 1;
    
     return 0;
       
    }

    function update_email($args=array()){
      
       $this->db->update($this->fixidb->student_data,$args,array('id'=>$args['id']));
      
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
       
    }
     
    /**
    * insert user information
    * 
    * @return inserted id else return false
    */
    function add($args=array(),$pass_encrypt="SHA1")
    {
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->get($this->fixidb->student_data);
        $i=0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;

        foreach($fieldlist as $v):
            if($v!="id" && $v!="student_marital_status" && $v!="student_funding_type" && $v!="student_student_loan_applied_for_the_proposed_course" && $v!="student_already_in_receipt_of_funds" && $v!="student_employment_history_current_employment_status" && $v!="student_others_marketing_info_referred_by" && $v!="student_admission_status" && $v!="student_admission_status_for_staff" && $v!="student_admission_status_review_staff_id" && $v!="student_admission_status_review_staff_id" && $v!="student_status" && $v!="send_exam" && $v!="entry_date") $default[$v] = "";      
        endforeach;     

        $args['student_admission_status_review_staff_id'] = 0;
        $args['agent_id'] = 0;
        $args['exam_paper_sets_id'] = 0;
        $args['primary_id'] = 0;
        $args['student_marital_status'] = 0;
        $args['disabilities_allowance'] = 'no';
        $args['student_status_admission_hesa_reason_id'] = 0;

        
         if($pass_encrypt == "SHA1") 
            $args['password']  =    sha1($args['password']);
         else if($pass_encrypt == "MD5")
            $args['password']  =    md5($args['password']);
     
     $args=fixi_parse_args($args,$default); 
     $this->db->insert($this->fixidb->student_data,$args);
     return $this->db->insert_id();
    }    
    
    
    /**
    * student data app
    * 
    * @param mixed $args
    * @param mixed $pass_encrypt
    */
    function add_app($args=array())
    {
        unset($args['password']);
        unset($args['student_email']); 
     $this->db->insert($this->fixidb->student_data,$args);
     
     return $this->db->insert_id();
     
    }
    /**
    * delete user by id
    * 
    * @param mixed $user_id
    * @return user id if data is deleted else return false.
    */
    function delete($user_id){
     
        if(isset($user_id)){
            $user_id        =   (int)$user_id;
            $this->db->delete($this->fixidb->student_data,array('id'    =>  $user_id));
            
            return $user_id;
        }else{
          return FALSE;  
        }
        
    }
    /**
    * get all user
    * 
    * 
    * @return user id if data is deleted else return false.
    */
    function get_all(){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->get($this->fixidb->student_data);
        $i=0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;
        $i=0;
        foreach($query->result() as $row):
             for($count=0; $count < count($fieldlist); $count++) {
                $data[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
             }
         $i++; 
        endforeach; 
          
       return $data; 
        
    }
                 
     function get_by_ID($ID="") {                  
        if(isset($this->user_id) && $ID==""){
           $ID = $this->user_id;
        }
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
         foreach($query->result() as $row){
   
              $user["ID"]           =  $row->id;
              $user["email"]        =  $row->student_email;
              $user["type"]         =  "student";
              $user["status"]       =  $row->student_status;
              
         }
 
        return $user;  
     }

    function get_all_by_ID($ID="") {                               
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
         return $query->row_array();
    }

    function get_course_by_ID($ID="") {                               
         $query=$this->db->query("SELECT student_course, student_type FROM ".$this->fixidb->student_data." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
         if($query->num_rows()>0) return $query->row();
       return False;
    }
    
    function get_course_semester_by_ID($ID="") {                               
         $query=$this->db->query("SELECT student_course, student_semister FROM ".$this->fixidb->student_data." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
         if($query->num_rows()>0) return $query->row();
       return False;
    }    

	 function get_phone_email_byID($ID="") {                  
        if(isset($this->user_id) && $ID==""){
           $ID = $this->user_id;
        }
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$ID."' OR primary_id='".$ID."' ORDER BY `id` ASC LIMIT 1");
         foreach($query->result() as $row){
   
              $user["ID"]           				=  $row->id;
              $user["student_email"]        		=  $row->student_email;
              $user["type"]         				=  "student";
              $user["status"]       			  	=  $row->student_status;
              $user["student_mobile_phone"]       	=  $row->student_mobile_phone;
              
         }
 
        return $user;  
     }


     
     function get_by_EMAIL($email="") {                  

        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE student_email='".$email."' ORDER BY `id` ASC LIMIT 1");
        $i=0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;
        $i=0;
        foreach($query->result() as $row):
             for($count=0; $count < count($fieldlist); $count++) {
                $data[$fieldlist[$count]] = $row->$fieldlist[$count];
             }
         $i++; 
        endforeach; 
          
       return $data;   
     }         
                  
     function get_userinfo_by_ID($ID="") {                  
        if(isset($this->user_id) && $ID==""){
           $ID = $this->user_id;
        }
      
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$ID."' ORDER BY `id` DESC");
         
 
        return $query;  
     } 
              
     function get_studentdata_for_edit($ID="") {                  
        
      
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$ID."' ORDER BY `id` DESC");
          $i=0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;
        $i=0;
        foreach($query->result() as $row):
             for($count=0; $count < count($fieldlist); $count++) {
                $data[$fieldlist[$count]] = $row->$fieldlist[$count];
             }
         $i++; 
        endforeach; 
          
       return $data;  
     } 
 
     function get_student_app_list_by_ID($ID="") {                  
        if(isset($this->user_id) && $ID==""){
           $ID = $this->user_id;
        }
      
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE `id`='".$ID."' OR `primary_id`='".$ID."' ORDER BY `id` DESC");
         
 
        return $query;  
     } 
 
     
     function get_student_data_ids($email="") {
         $data =array();                  
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE student_email='".$email."' ORDER BY `id` DESC");
          $i = 0;
          foreach($query->result() as $row){
          	  
			  $data[$email][$i] =  $row->id;
			  $i++;
          }
 
        return $data;  
     }    
     function get_user_admission_status($ID){
		if(isset($this->user_id) && $ID==""){
           $ID = $this->user_id;
        }
        $has_date ="";
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$ID."' ORDER BY `id` DESC LIMIT 1");
         
         $has_date=$query->row()->student_app_submitted_datetime;
         $status = $query->row()->student_admission_status;
         if($has_date==""){
			 $msg = "no_app";
         } else if($status=="Accepted" || $status =="Rejected" || $status =="Discard"){
			 $msg = "new_app";
         } else {
			 $msg = "open_app";
         }
        return $msg; 
     }
     function check_student_password($password){
       $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$this->user_id."' LIMIT 1");
         foreach($query->result() as $row){
             if($row->password == sha1($password) || $row->password == md5($password) )
             return $row->id;
         }
           
        return FALSE; 
     }
     
     function makeStudentListWithpagination($args,$page,$targetpage,$hasAction,$excel_export){
         
            ///--------sort
                 $sesData = $this->session->userdata("student_admission_search");
                 !empty($sesData['sortby']) ? $sortby = $sesData['sortby'] : $sortby="";            
                //var_dump($sortby);
                if($sortby=="student_application_reference_no_desc")
                   $sortby = "student_application_reference_no DESC"; 
                else if($sortby=="student_application_reference_no_asc")
                    $sortby = "student_application_reference_no ASC";
                    
                else if($sortby=="student_first_name_desc")
                   $sortby = "student_first_name DESC"; 
                else if($sortby=="student_first_name_asc")
                    $sortby = "student_first_name ASC";
                    
                else if($sortby=="student_sur_name_desc")
                   $sortby = "student_sur_name DESC"; 
                else if($sortby=="student_sur_name_asc")
                    $sortby = "student_sur_name ASC";
                    
                else if($sortby=="student_date_of_birth_desc")
                   $sortby = "student_date_of_birth DESC"; 
                else if($sortby=="student_date_of_birth_asc")
                    $sortby = "student_date_of_birth ASC";
                    
                else if($sortby=="student_semister_desc")
                   $sortby = "student_semister DESC"; 
                else if($sortby=="student_semister_asc")
                    $sortby = "student_semister ASC";
                    
                else if($sortby=="student_course_desc")
                   $sortby = "student_course DESC"; 
                else if($sortby=="student_course_asc")
                    $sortby = "student_course ASC";
                    
                else if($sortby=="student_admission_status_for_staff_desc")
                   $sortby = "student_admission_status_for_staff DESC"; 
                else if($sortby=="student_admission_status_for_staff_asc")
                    $sortby = "student_admission_status_for_staff ASC";                                                                                                                        
                
                else
                   $sortby = "";      
            
            ///--------- end of sort
			
			if(!is_array($args) && $args=="all"){
				
				$query="SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none' AND student_admission_status_for_staff!='Offer placed' AND student_admission_status_for_staff!='Offer accepted'";
				
			}else if(!is_array($args) && $args=="all_for_agent"){
				
				$query="SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none' && agent_id='".$this->session->userdata('uid')."'";
								
				
			}else if(is_array($args) && $args!="all"){
				
					foreach($args as $k=>$v){						
						$$k = $v;						
					}
					$query = "";
					if($this->router->class == "student_admission_management"){
				
				       $query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none' AND student_admission_status_for_staff!='Offer placed' AND student_admission_status_for_staff!='Offer accepted'";
				   
					
		   			   $and = " AND ";
		   			   
					   if(!empty($student_application_reference_no)){
						   
						   $query .= $and."student_application_reference_no = '".$student_application_reference_no."'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($student_first_name)){
						   
						   $query .= $and."student_first_name LIKE '%".$student_first_name."%'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($student_sur_name)){
						   
						   $query .= $and."student_sur_name LIKE '%".$student_sur_name."%'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($dob_d) && !empty($dob_m) && !empty($dob_y)){
						   
						   $query .= $and."student_date_of_birth LIKE '%".$dob_d."/".$dob_m."/".$dob_y."%'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($semester_id)){
						   $semester_name = $this->semister->get_name($semester_id);
						   $query .= $and." (student_semister = '".$semester_name."' OR student_semister = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($course_id)){
						   $course_name = $this->course->get_name($course_id);
						   $query .= $and." (`student_course` = '".$course_name."'  OR `student_course` = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   
					   if($this->session->userdata('label')=="agent"){
						   
						   if(!empty($student_admission_status)){
							   $query .= $and."student_admission_status LIKE '%".$student_admission_status."%'"; $and = " AND "; $sql_And = " AND ";
						   }						   
						   
					   }else{
						   
						   if(!empty($student_admission_status_for_staff)){
							   $query .= $and."student_admission_status_for_staff LIKE '%".$student_admission_status_for_staff."%'"; $and = " AND "; $sql_And = " AND ";
						   }						   
						   
					   }
					   

					   if(!empty($agent_id)){
						   $query .= $and."agent_id = '".$agent_id."'"; $and = " AND "; $sql_And = " AND ";
					   }					   					   					   					   					   					   
					   
					   if(!empty($sortby))  $query .= " ORDER BY ".$sortby;
                       else
                       $query .= " ORDER BY id DESC";
					   
					   
					}else if($this->router->class == "registration_management"){//---------- if come from registration and need all ACCEPTED students
						
				       $query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none'";
				   
					
		   			   $and = " AND ";
		   			   
					   if(!empty($student_application_reference_no)){
						   
						   $query .= $and."student_application_reference_no = '".$student_application_reference_no."'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($student_first_name)){
						   
						   $query .= $and."student_first_name LIKE '%".$student_first_name."%'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($student_sur_name)){
						   
						   $query .= $and."student_sur_name LIKE '%".$student_sur_name."%'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($dob_d) && !empty($dob_m) && !empty($dob_y)){
						   
						   $query .= $and."student_date_of_birth LIKE '%".$dob_d."/".$dob_m."/".$dob_y."%'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($semester_id)){
						   $semester_name = $this->semister->get_name($semester_id);
						   $query .= $and." (student_semister = '".$semester_name."' OR student_semister = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($course_id)){
						   $course_name = $this->course->get_name($course_id);
						   $query .= $and." (`student_course` = '".$course_name."'  OR `student_course` = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   
					   if($this->session->userdata('label')=="agent"){
						   
						   if(!empty($student_admission_status)){
							   $query .= $and."student_admission_status LIKE '%".$student_admission_status."%'"; $and = " AND "; $sql_And = " AND ";
						   }						   
						   
					   }else{
						   
						   if(!empty($student_admission_status_for_staff)){
							   $query .= $and."student_admission_status_for_staff = '".$student_admission_status_for_staff."'"; $and = " AND "; $sql_And = " AND ";
						   }						   
						   
					   }
					   

					   if(!empty($agent_id)){
						   $query .= $and."agent_id = '".$agent_id."'"; $and = " AND "; $sql_And = " AND ";
					   }					   					   					   					   					   					   
					   
					   if(empty($student_application_reference_no) && empty($student_first_name) && empty($student_sur_name) && (empty($dob_d) && empty($dob_m) && empty($dob_y)) && empty($semester_id) && empty($course_id) && empty($student_admission_status_for_staff) && empty($agent_id) )
					   $query .= " AND (student_admission_status_for_staff='Accepted' OR student_admission_status_for_staff='Offer placed' OR student_admission_status_for_staff='Offer accepted' OR student_admission_status_for_staff='Offer Rejected')";
					   else if(empty($student_admission_status_for_staff))
					   $query .= " AND (student_admission_status_for_staff='Accepted' OR student_admission_status_for_staff='Offer placed' OR student_admission_status_for_staff='Offer accepted' OR student_admission_status_for_staff='Offer Rejected')";
                       
                       if(!empty($sortby))  $query .= " ORDER BY ".$sortby;
                       else
                       $query .= " ORDER BY id DESC";                       
					   						
					}else if($this->router->class == "student_management"){//---------- if come from Student and need all ACCEPTED students
                        
                       $query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none'";
                   
                    
                          $and = " AND ";
                          
                       if(!empty($student_application_reference_no)){
                           
                           $query .= $and."student_application_reference_no = '".$student_application_reference_no."'"; $and = " AND "; $sql_And = " AND ";
                       }
                       if(!empty($student_first_name)){
                           
                           $query .= $and."student_first_name LIKE '%".$student_first_name."%'"; $and = " AND "; $sql_And = " AND ";
                       }
                       if(!empty($student_sur_name)){
                           
                           $query .= $and."student_sur_name LIKE '%".$student_sur_name."%'"; $and = " AND "; $sql_And = " AND ";
                       }
                       if(!empty($dob_d) && !empty($dob_m) && !empty($dob_y)){
                           
                           $query .= $and."student_date_of_birth LIKE '%".$dob_d."/".$dob_m."/".$dob_y."%'"; $and = " AND "; $sql_And = " AND ";
                       }
                       if(!empty($semester_id)){
                           $semester_name = $this->semister->get_name($semester_id);
                           $query .= $and." (student_semister = '".$semester_name."' OR student_semister = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
                       }
                       if(!empty($course_id)){
                           $course_name = $this->course->get_name($course_id);
                           $query .= $and." (`student_course` = '".$course_name."'  OR `student_course` = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
                       }
                       
                       if($this->session->userdata('label')=="agent"){
                           
                           if(!empty($student_admission_status)){
                               $query .= $and."student_admission_status LIKE '%".$student_admission_status."%'"; $and = " AND "; $sql_And = " AND ";
                           }                           
                           
                       }else{
                           
                           if(!empty($student_admission_status_for_staff)){
                               $query .= $and."student_admission_status_for_staff LIKE '%".$student_admission_status_for_staff."%'"; $and = " AND "; $sql_And = " AND ";
                           }                           
                           
                       }
                       

                       if(!empty($agent_id)){
                           $query .= $and."agent_id = '".$agent_id."'"; $and = " AND "; $sql_And = " AND ";
                       }                                                                                                                                          
                       
                       if(empty($student_application_reference_no) && empty($student_first_name) && empty($student_sur_name) && (empty($dob_d) && empty($dob_m) && empty($dob_y)) && empty($semester_id) && empty($course_id) && empty($student_admission_status_for_staff) && empty($agent_id) )
                        $query .= " AND (student_admission_status_for_staff='Accepted' OR student_admission_status_for_staff='Offer placed' OR student_admission_status_for_staff='Offer accepted')";
                       else if(empty($student_admission_status_for_staff))
                       $query .= " AND (student_admission_status_for_staff='Accepted' OR student_admission_status_for_staff='Offer placed' OR student_admission_status_for_staff='Offer accepted')";
                       
                       if(!empty($sortby))  $query .= " ORDER BY ".$sortby;
                       else
                       $query .= " ORDER BY id DESC";                       
                                               
                    }else if($this->router->class == "job_induction_assign_student"){
				
				       $query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none' AND student_admission_status_for_staff!='Offer placed' AND student_admission_status_for_staff!='Offer accepted'";				   
					
		   			   $and = " AND ";
		   			   
					   if(!empty($student_application_reference_no)){
						   
						   $query .= $and."student_application_reference_no = '".$student_application_reference_no."'"; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($student_semister)){
						   $semester_name = $this->semister->get_name($student_semister);
						   $query .= $and." (student_semister = '".$semester_name."' OR student_semister = '".$student_semister."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($student_course)){
						   $course_name = $this->course->get_name($student_course);
						   $query .= $and." (`student_course` = '".$course_name."'  OR `student_course` = '".$student_course."') "; $and = " AND "; $sql_And = " AND ";
					   }					   					   					   					   					   					   					   
					   
					   $query .= " ORDER BY id DESC";
					   
					   
					}
                    
                    
                    
                    //---------- 
                    //echo $query;  
				
				
			}
			//var_dump($query);
			$output = $this->getPaginationCustom($query,$page,$targetpage,$hasAction);	
            //var_dump($query);
			
			//return $output['row_array'];
			
			if($this->router->class == "registration_management") $htmlOutput = "<table class='table table-hover registration-student-list'>";
			elseif($this->router->class == "student_management") {
                $htmlOutput = "<table class='table table-hover student-management-list'>";
			}elseif($this->router->class == "job_induction_assign_student") {
                $htmlOutput = "<table class='table table-hover induction-student-list-table'>";                
            } else {
                $htmlOutput = "<table class='table table-hover search-student-list'>";
                
            }
			 
			$htmlOutput .= "<thead>";
			if( ($this->router->class == "student_admission_management" && $this->session->userdata('label')=="admin") || ($this->router->class == "registration_management" && $this->session->userdata('label')=="admin") || ( $this->router->class == "registration_management" && !empty($excel_export) && $this->session->userdata('label')=="staff" ) || ($this->router->class == "student_admission_management" && !empty($excel_export) && $this->session->userdata('label')=="staff") ){
            
    			$htmlOutput .= "	<tr>
    									<th colspan='7'><a class='btn btn-warning btn-sm' href='".base_url()."index.php/export_excel/'><i class='fa fa-share-square-o'></i> Export to excel</a></th>
    								</tr>";
    		}
            
			$htmlOutput .= "  	<tr>";
			if($this->router->class == "job_induction_assign_student")
				$htmlOutput .= "    <th colspan='5'>Search Result</th> ";
			else
				$htmlOutput .= "    <th colspan='4'>Search Result</th> ";
					
			$htmlOutput .= "   	 <th colspan='3' class='text-right'>Total Result: ".$output['total_rec']."</th>
			                	</tr>			                	
								<tr>";
			
			if($this->router->class == "job_induction_assign_student"){ 
                $htmlOutput .= '<th><div class="checkbox checkbox-primary induction-student-list-select-all"><input id="induction_student_list_select_all" type="checkbox" class="form-control" name="induction_student_list_select_all"><label for="induction_student_list_select_all">Ref. No</label></div></th>'; 					
                $htmlOutput .= "        <th>First Name(s)</th>
                                        <th>Surname</th>                                        
                                        <th>Date of Birth</th>
                                        <th>Semester</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>";			
			}
            if($this->router->class != "job_induction_assign_student"){
                //var_dump($sortby);
                    
                if($sortby=="student_application_reference_no ASC")
                    $htmlOutput .= "        <th>Ref. No <a href='$targetpage&sortby=student_application_reference_no_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                else if($sortby=="student_application_reference_no DESC")
                    $htmlOutput .= "        <th>Ref. No <a href='$targetpage&sortby=student_application_reference_no_asc'><i class='fa fa-chevron-circle-up'></i></a></th> ";
                else
                    $htmlOutput .= "        <th>Ref. No <a href='$targetpage&sortby=student_application_reference_no_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                
                    
                if($sortby=="student_first_name ASC")
                    $htmlOutput .= "        <th>First Name(s) <a href='$targetpage&sortby=student_first_name_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                else if($sortby=="student_first_name DESC")
                    $htmlOutput .= "        <th>First Name(s) <a href='$targetpage&sortby=student_first_name_asc'><i class='fa fa-chevron-circle-up'></i></a></th> ";
                else
                    $htmlOutput .= "        <th>First Name(s) <a href='$targetpage&sortby=student_first_name_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";    

                    
                if($sortby=="student_sur_name ASC")
                    $htmlOutput .= "        <th>Surname <a href='$targetpage&sortby=student_sur_name_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                else if($sortby=="student_sur_name DESC")
                    $htmlOutput .= "        <th>Surname <a href='$targetpage&sortby=student_sur_name_asc'><i class='fa fa-chevron-circle-up'></i></a></th> ";
                else
                    $htmlOutput .= "        <th>Surname <a href='$targetpage&sortby=student_sur_name_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";     

                    
                if($sortby=="student_date_of_birth ASC")
                    $htmlOutput .= "        <th>Date of Birth <a href='$targetpage&sortby=student_date_of_birth_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                else if($sortby=="student_date_of_birth DESC")
                    $htmlOutput .= "        <th>Date of Birth <a href='$targetpage&sortby=student_date_of_birth_asc'><i class='fa fa-chevron-circle-up'></i></a></th> ";                                                                     
                else
                    $htmlOutput .= "        <th>Date of Birth <a href='$targetpage&sortby=student_date_of_birth_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                    
                    
                if($sortby=="student_semister ASC")
                    $htmlOutput .= "        <th>Semester <a href='$targetpage&sortby=student_semister_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                else if($sortby=="student_semister DESC")
                    $htmlOutput .= "        <th>Semester <a href='$targetpage&sortby=student_semister_asc'><i class='fa fa-chevron-circle-up'></i></a></th> ";
                else
                    $htmlOutput .= "        <th>Semester <a href='$targetpage&sortby=student_semister_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";                                                                         


                if($sortby=="student_course ASC")
                    $htmlOutput .= "        <th>Course <a href='$targetpage&sortby=student_course_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                else if($sortby=="student_course DESC")
                    $htmlOutput .= "        <th>Course <a href='$targetpage&sortby=student_course_asc'><i class='fa fa-chevron-circle-up'></i></a></th> "; 
                else
                    $htmlOutput .= "        <th>Course <a href='$targetpage&sortby=student_course_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                

                    
                if($sortby=="student_admission_status_for_staff ASC")
                    $htmlOutput .= "        <th>Status <a href='$targetpage&sortby=student_admission_status_for_staff_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";
                else if($sortby=="student_admission_status_for_staff DESC")
                    $htmlOutput .= "        <th>Status <a href='$targetpage&sortby=student_admission_status_for_staff_asc'><i class='fa fa-chevron-circle-up'></i></a></th> ";                                        
                else
                    $htmlOutput .= "        <th>Status <a href='$targetpage&sortby=student_admission_status_for_staff_desc'><i class='fa fa-chevron-circle-down'></i></a></th> ";    
                    
                    
                    
                $htmlOutput .= "</tr></thead><tbody>";    
                    
            } 
			
			
			//for($i=0;$i<count($output['row_array']);$i++){
		    //////////////////////////////////////////////////////	    
			/// get staff access
			// if($this->session->userdata('label')=="staff"){
			// 	$staff_privileges_student_admission = $data['staff_privileges_student_admission'] = $this->session->userdata('staff_privileges_student_admission');		
			// }	    
		    ///////////////////////////////////////////////////// 			
			
			if($output['total_rec']>0){
	            // $output['row_array'] = array_reverse($output['row_array']);
                $chkbox=1;
				foreach($output['row_array'] as $k=>$v){
					//if( $this->session->userdata('label')!="agent" && empty($staff_privileges_student_admission['std_ad_view_app']) && empty($staff_privileges_student_admission['std_ad_edit_app']) ) $htmlOutput .= "<tr id=''>"; else if($this->session->userdata('label')=="admin" || ($this->session->userdata('label')=="agent" || ($this->session->userdata('label')=="staff" && !empty($staff_privileges_student_admission['std_ad_view_app']) && !empty($staff_privileges_student_admission['std_ad_edit_app'])) ) ) $htmlOutput .= "<tr id='".$v['id']."'>";  
					//if($this->session->userdata('label')=="staff" && ( ($this->router->class == "registration_management" && empty($priv[1])) || ($this->router->class == "student_admission_management" && empty($priv[1])) ) )////-----------get priviledge  
						//$htmlOutput .= "<tr id=''>"; 
					//else 
						$htmlOutput .= "<tr id='".$v['id']."'>";
						
					if($this->router->class == "job_induction_assign_student") $htmlOutput .= '<td><div class="checkbox checkbox-primary"><input id="checkbox'.$chkbox.'" type="checkbox" class="form-control induction-student-list-chkbox" name="induction_student_list[]" value="'.$v['id'].'"><label for="checkbox'.$chkbox.'">'.$v['student_application_reference_no'].'</label></div></td>';
						  
					if($this->router->class != "job_induction_assign_student") $htmlOutput .= "<td>".$v['student_application_reference_no']."</td>";
					$htmlOutput .= "<td>".ucwords(strtolower($v['student_first_name']))."</td>";
					$htmlOutput .= "<td>".ucwords(strtolower($v['student_sur_name']))."</td>";
					$htmlOutput .= "<td>".$v['student_date_of_birth']."</td>";
                    $htmlOutput .= "<td>";
                    if(is_numeric($v['student_semister'])){
                        $semestername=$this->semister->get_name((int)$v['student_semister']);
                        $htmlOutput .= $semestername;   
                    }else {
                        $htmlOutput .= $v['student_semister'];
                    }
					$htmlOutput .= "</td>";
                    $htmlOutput .= "<td>";
                    if(is_numeric($v['student_course'])){
                        $coursename=$this->course->get_name((int)$v['student_course']);
                     $htmlOutput .= $coursename;   
                    }else {
                    $htmlOutput .= $v['student_course'];
                    }
					$htmlOutput .= "</td>";
					if($this->session->userdata('label')=="agent")
						$htmlOutput .= "<td>".$v['student_admission_status']."</td>";
					else
						$htmlOutput .= "<td>".$v['student_admission_status_for_staff']."</td>";
						
					$htmlOutput .= "</tr>";					
					$chkbox++;
					
				}
 				//----for excel export

                //echo "my_search_sql: ".var_dump($output['search_sql']);
                //echo "current_session_search_sql: ".var_dump($this->session->userdata('search_sql'));

			    $arr = array();
			    $arr['search_sql'] = str_replace("%","PERCENTMASUM888",$output['search_sql']); 
			    

			    			    
				$this->session->set_userdata($arr);
				
				//echo "new_session_search_sql: ".var_dump($this->session->userdata('search_sql'));
				
			//}
			
			
			$htmlOutput .= "</tbody></table><div class='clearfix text-center'>".$output['pagination']."</div>";
			
			}else{
				
				$htmlOutput .= "<tr><td colspan='7'>No matches found.</td></tr></tbody></table>";	
			}
			
		   return $htmlOutput;
     }
     
     
/*     function makeRegisteredStudentListWithpagination($args,$page,$targetpage,$hasAction){
			
			if(is_array($args) && count($args)==0){
				
				$query="SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff=='Offer accepted'";
								
				
			}else if(is_array($args) && count($args)>0){
				
					foreach($args as $k=>$v){						
						$$k = $v;						
					}
					$query = "";
					if(empty($registration_no)){
				
				       $query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff=='Offer accepted'";
				   
					
		   			   $and = " AND ";

					   if(!empty($semester_id)){
						   $semester_name = $this->semister->get_name($semester_id);
						   $query .= $and." (student_semister = '".$semester_name."' OR student_semister = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($course_id)){
						   $course_name = $this->course->get_name($course_id);
						   $query .= $and." (`student_course` = '".$course_name."'  OR `student_course` = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
					   }					   					   					   					   					   					   
					   
					   $query .= " ORDER BY id DESC";
					   
					   
					}else if(!empty($registration_no)){
						
						//$query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff=='Offer accepted'";	
						
						$student_data_id_list = $this->register->get_student_data_id_list_by_registration_no_for_search($registration_no);
						
						$query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff=='Offer accepted'";
						
						//foreach($student_data_id_list as $k=>$v){
							  
							//$query .= "";
							
						//}
						
						
						
					}
					
					   
				
				
			}

			
		   return $query;
     }*/     
     
     
     

	function getPaginationCustom($sql_query,$page,$targetpage,$hasAction){


		if($hasAction=="yes") $pp = "&"; else $pp = "?";
		
		// How many adjacent pages should be shown on each side?
		$adjacents = 3;
		

        
		$query=$this->db->query($sql_query);
        //echo "working query: ".var_dump($sql_query);
		$total_pages = $query->num_rows();
		


		$limit = 20; 								//how many items to show per page
		//$page = $_GET['page'];
		if($page) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		

		$sql=$this->db->query($sql_query." LIMIT $start, $limit");

		

		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
		/* 
			Now we apply our rules and draw the pagination object. 
			We're actually saving the code to a variable in case we want to draw it more than once.
		*/
		$pagination = "";
		if($lastpage > 1)
		{	
			$pagination .= "<ul class=\"pagination\">";
			//previous button
			if ($page > 1) 
				$pagination.= "<li><a href=\"$targetpage".$pp."page=$prev\">previous</a></li>";
			else
				$pagination.= "<li class=\"disabled\"><a href=\"#\" >previous</a></li>";	
			
			//pages	
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
			{
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 2))		
				{
					for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><a href=\"#\">$counter</span></li>";
						else
							$pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";					
					}
					$pagination.= "<li><a href=\"#\">...</a></li>";
					$pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
					$pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";		
				}
				//in middle; hide some front and some back
				elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
				{
					$pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
					$pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
					$pagination.= "<li><a href=\"#\">...</a></li>";
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
						else
							$pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";					
					}
					$pagination.= "<li><a href=\"#\">...</a></li>";
					$pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
					$pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";		
				}
				//close to end; only hide early pages
				else
				{
					$pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
					$pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
					$pagination.= "<li><a href=\"#\">...</a></li>";
					for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page)
							$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
						else
							$pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";					
					}
				}
			}
			
			//next button
			if ($page < $counter - 1) 
				$pagination.= "<li><a href=\"$targetpage".$pp."page=$next\">next</a></li>";
			else
				$pagination.= "<li class=\"disabled\"><a href=\"#\">next</a></li>";
			$pagination.= "</ul>\n";		
		}
            
			$output = array();
			if ($sql->num_rows() > 0)
			{
				$fieldlist = array(); $i=0;
				$field_query=$this->db->get($this->fixidb->student_data);
		        foreach($field_query->list_fields() as $field):
		         $fieldlist[$i] = $field;
		         $i++;
		        endforeach;				
				$i=0; $row_array = array(); 
				foreach($sql->result() as $row){
		          for($count=0; $count < count($fieldlist); $count++) {
		          	$row_array[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
		          }								  

				  $i++;
          		}

				
			   //$row = $sql->row_array();
			   $output['search_sql'] = $sql_query;
               $output['row_array'] = $row_array;
               $output['pagination'] = $pagination;
               $output['total_rec'] = $total_pages;
			}else{
				$output['search_sql'] = $sql_query;	
               $output['row_array'] = "";
               $output['pagination'] = "";
               $output['total_rec'] = 0;				
			} 

			return $output; 


		
	}  
    
    
    function get_application_id($ID){
        
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (primary_id='".$ID."' OR id='".$ID."') AND ( `student_admission_status`='Accepted' || `student_admission_status` ='Rejected' || `student_admission_status`='Discard' || student_admission_status ='none' ) ORDER BY `id` DESC LIMIT 1" );
        //var_dump($query->num_rows());
          if($query->num_rows()>0 && $query->row()->student_admission_status=="none")
          return $query->row()->id;
          else
          return 0;
    }
    
    function get_title_id($ID){
        
        $query=$this->db->query("SELECT student_title FROM ".$this->fixidb->student_data." WHERE id='".$ID."' LIMIT 1" );
        //var_dump($query->num_rows());

          return $query->row()->student_title;

    }    
    
    function get_first_sur_name($ID){
		
              $this->db->db_select();
        $qcheck=$this->db->query("SELECT `student_first_name`, `student_sur_name` FROM `{$this->fixidb->student_data}` WHERE `id`=\"{$ID}\" LIMIT 1");
        
             
       return $qcheck->row()->student_first_name." ".$qcheck->row()->student_sur_name;
       		
    }
    
    function get_firstname($ID){
        
              $this->db->db_select();
        $qcheck=$this->db->query("SELECT `student_first_name` FROM `{$this->fixidb->student_data}` WHERE `id`=\"{$ID}\" LIMIT 1");

        $firstname=$qcheck->row()->student_first_name;
        
             
       return $firstname;
    } 
        
    function get_lastname($ID){
        
              $this->db->db_select();
        $qcheck=$this->db->query("SELECT `student_sur_name` FROM `{$this->fixidb->student_data}` WHERE `id`=\"{$ID}\" LIMIT 1");

        
        $lastname=$qcheck->row()->student_sur_name;
             
       return $lastname;
    }
    
    function get_next_reference_no(){
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." ORDER BY `id` DESC LIMIT 1" );
          if($query->num_rows()>0) {
          return $query->row()->student_application_reference_no*1 + 1;
          } else {
              return 1;
          }
        
    }
    
    function get_reference_no_byID($ID){
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE`id`=\"{$ID}\" LIMIT 1" );
         
          return $query->row()->student_application_reference_no;
        
    }
    
    function get_fullname_by_ID($ID){
        
        $this->db->db_select();
        $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->student_data}` WHERE `id`=\"{$ID}\" LIMIT 1");
        $status="";
        $name="";
        if($qcheck->num_rows()>0) {
        foreach($qcheck->result() as $row):
        $status=$row->student_status;
        endforeach;
        
        //if($status=="active"){
			/*if(preg_match("/[a-zA-Z]/", $qcheck->row()->student_title)==1) $name = "title is text";
			else if(preg_match("/[a-zA-Z]/", $qcheck->row()->student_title)==0) $name = "title is num";*/	
        //}
        
 
	        if($status=="active" && preg_match("/[a-zA-Z]/", $qcheck->row()->student_title)==0) $name= $this->student_title->get_name_by_id($qcheck->row()->student_title)." ".$qcheck->row()->student_first_name." ".$qcheck->row()->student_sur_name;
	        else if($status=="active" && preg_match("/[a-zA-Z]/", $qcheck->row()->student_title)==1) $name= $qcheck->row()->student_title." ".$qcheck->row()->student_first_name." ".$qcheck->row()->student_sur_name;	

        }
        
        return $name;         
    
    }
    
    function get_agent_by_id($ID){
        
        $qcheck=$this->db->query("SELECT `agent_id` FROM `{$this->fixidb->student_data}` WHERE `id`=\"{$ID}\" LIMIT 1");

        $agent_id=$qcheck->row()->agent_id;
        
             
       return $agent_id;		
		
    }

    function get_gender_by_id($ID){
        
        $qcheck=$this->db->query("SELECT `student_gender` FROM `{$this->fixidb->student_data}` WHERE `id`=\"{$ID}\" LIMIT 1");

        $student_gender=$qcheck->row()->student_gender;
        
             
       return $student_gender;        
        
    }
////////////// REPORT SQL    
    function getToalApplicationByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\")" );
		
		return $query->num_rows(); 
		
    }
    
    function get_NEW_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='New'" );
		
		return $query->num_rows(); 
		
    }
    
    function get_Review_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Review'" );
		
		return $query->num_rows(); 
		
    }
    
    function get_Awaiting_Documents_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Awaiting Documents'" );
		
		return $query->num_rows(); 
		
    }
    
    function get_Processing_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Processing'" );
		
		return $query->num_rows(); 
		
    }
    
    function get_Refer_to_academic_department_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Refer to academic department'" );
		
		return $query->num_rows(); 
		
    }            
    function get_Accepted_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Accepted'" );
		
		return $query->num_rows(); 
		
    }
    function get_Rejected_for_review_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Rejected for review'" );
		
		return $query->num_rows(); 
		
    }
    function get_Rejected_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Rejected'" );
		
		return $query->num_rows(); 
		
    }
    function get_Discarded_ByCourseIDAndSemID($c_id,$s_id){
		
		$c_name = $this->course->get_name($c_id);
		$s_name = $this->semister->get_name($s_id);
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE (`student_course`=\"{$c_id}\" OR `student_course`=\"{$c_name}\") AND (`student_semister`=\"{$s_id}\" OR `student_semister`=\"{$s_name}\") AND student_admission_status_for_staff='Discarded'" );
		
		return $query->num_rows(); 
		
    } 
              
////////////// END OF REPORT SQL 


    function checkForExistingEmail($email){
    	
        $qcheck=$this->db->query("SELECT `student_email` FROM `{$this->fixidb->student_data}` WHERE `student_email`=\"{$email}\"");
        
             
       return $qcheck->num_rows();    	
		
    }
    
    function checkAndActivateStudent($sid){
        
       $qcheck=$this->db->query("SELECT * FROM `{$this->fixidb->student_data}` WHERE `activate_session_id`=\"{$sid}\" AND student_status = 'inactive'"); 
       $output = array();
       if($qcheck->num_rows() > 0){

            $id =  $qcheck->row()->id;
            $args['id']=$id;
            $args['student_status']="active";
            $this->update($args);
            
            $output['html'] = '<div class="alert  alert-success ">
                    <p><span class="glyphicon glyphicon-ok"></span> Your account has been successfully activated. Please Signin.</p>
                    </div>'; 
                    
            $output['status']=true;                
       
       }else{
           
           
           $output['html'] = '<div class="alert alert-warning ">
                    <p><span class="glyphicon glyphicon-exclamation-sign"></span> Activation Code is invalid.</p>
                </div>';
           $output['status']=false;     
           
       }
       
       return $output;
        
    }
    
    function getExportExcelData($sql){
        
              $fieldlist=array();
		        $query=$this->db->get($this->fixidb->student_data);
		        $i=0;
		        foreach($query->list_fields() as $field):
		         $fieldlist[$i] = $field;
		         $i++;
		        endforeach;
   	
         		$i=0; $total_row_arr = array(); 
         		$query=$this->db->query($sql);

          		foreach($query->result() as $row){
		          for($count=0; $count < count($fieldlist); $count++) {
		          	$total_row_arr[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
		          }
		          $i++;						
          		}
          		$arr = array(); $t=2;
          		$arr['export_excel_arr'][1] = array('Application Reference No','First Name','Surename','Date Of Birth','Applied Semister','Applied Course','Admission Status','Admission Status Rejected Reason','Home Phone No','Mobile Phone No','Email Address','Address Line 1','Address Line 2','City','State/Province/Region','Postal/Zip Code','Country','Student Referred By','Student Referred Name','Student Referred Person Contact');
				foreach($total_row_arr as $k=>$v){	
						//echo"$t<br>";			
						if($v['student_others_marketing_info_referred_by']=="agent_referred"){
            				$agent_name ="";
            				if($v['agent_id']>"") $agent_name = $this->agent->get_name_by_ID($v['agent_id']);
            				$arr['export_excel_arr'][$t] = array($v['student_application_reference_no'],$v['student_first_name'],$v['student_sur_name'],$v['student_date_of_birth'],$v['student_semister'],$v['student_course'],$v['student_admission_status_for_staff'],$v['student_admission_status_rejected_reason'],$v['student_home_phone'],$v['student_mobile_phone'],$v['student_email'],$v['student_address_address_line_1'],$v['student_address_address_line_2'],$v['student_address_city'],$v['student_address_state_province_region'],$v['student_address_postal_zip_code'],$v['student_address_country'],$v['student_others_marketing_info_referred_by'],$agent_name,"");
						}else{
							$arr['export_excel_arr'][$t] = array($v['student_application_reference_no'],$v['student_first_name'],$v['student_sur_name'],$v['student_date_of_birth'],$v['student_semister'],$v['student_course'],$v['student_admission_status_for_staff'],$v['student_admission_status_rejected_reason'],$v['student_home_phone'],$v['student_mobile_phone'],$v['student_email'],$v['student_address_address_line_1'],$v['student_address_address_line_2'],$v['student_address_city'],$v['student_address_state_province_region'],$v['student_address_postal_zip_code'],$v['student_address_country'],$v['student_others_marketing_info_referred_by'],$v['student_others_marketing_info_referred_name'],$v['student_others_marketing_info_referred_phone']);	
						}
					    $t++;				
				}
				
				return $arr;          						
    }

    function get_student_email_phone_first_last_name_by_ID($id="") {                  

            $query=$this->db->query("SELECT student_email,student_first_name,student_sur_name,student_mobile_phone FROM ".$this->fixidb->student_data." WHERE id='".$id."' LIMIT 1");
   
            if($query->num_rows()>0) return $query->row();
     }
    
    function get_student_course_and_semister_by_ID($id="") {                  

            $query=$this->db->query("SELECT student_course,student_semister FROM ".$this->fixidb->student_data." WHERE id='".$id."' LIMIT 1");
   
            if($query->num_rows()>0) return $query->row();
    }

    function get_list_by_student_course_and_semister($student_course="", $student_semister="") {                  

            $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE student_semister='".$student_semister."' AND student_course='".$student_course."' ORDER BY id DESC;");
   
            if($query->num_rows()>0) return $query->result();
    }
    
    function change_activate_session_id_by_student_data_id($student_data_id=""){
		
		$args['activate_session_id'] = md5($student_data_id.time());
		$this->db->update($this->fixidb->student_data,$args,array('id'=>$student_data_id));
      
      	if($this->db->affected_rows()>0) return $args['activate_session_id'];
    
     	return FALSE;		
		
    }
    
    function get_hesa_exchind_by_student_data_id($student_data_id=""){
        
            $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_data." WHERE id='".$student_data_id."' LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->hesa_exchind_id;
                    
        
    }
     
    
    function get_semester_id($student_data_id) {
		   $query=$this->db->query("SELECT student_semister FROM ".$this->fixidb->student_data." WHERE id='".$student_data_id."' LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->student_semister;
    }                   
     
}
?>
<?php
  
class Register extends CI_Model {
     
     public $register_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('semister','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('agent','',TRUE);
        $this->load->model('student_data','',TRUE);
        $this->load->model('course_relation','',TRUE);
        $this->load->library('session');   

    }
        
        
    function update($args=array())
    {
        foreach($args as $k =>$v) {
            if(empty($v)) {
                unset($args[$k]);
            }
        }
     $this->db->update($this->fixidb->register,$args,array('id'=>$args['id']));
      
     if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }


    
     
    
    function add($args=array())
    {
            foreach($args as $k =>$v) {
            if(empty($v)) {
                unset($args[$k]);
            }
        }
     $default = array(  "student_data_id"       => 0,
                        "registration_no"    	=> "",
                        "registrtation_date"    => date("Y-m-d",time()),
                        "class_startdate"       => date("Y-m-d",time()),
                        "class_enddate"         => date("Y-m-d",time()),
                        "student_type"          => "uk",
                        "ssn"                   => "",
                        "student_photo"         => "",
                        "proof_type"            => "birth",
                        "proof_id"              => "",
                        "proof_expiredate"      => "0000-00-00",
                        "kin_name"              => "",
                        "kin_address"           => "",
                        "kin_phone"             => "",
                        "kin_email"             => "",
                        "kin_relation"          => "",
                        "last_updated_date"     => date("Y-m-d H:i:s",time()),
                        "student_other_qualification" => "",
                        "campus_info_id"        => 0
                         );
                        
     $args    = fixi_parse_args($args,$default);  

     $this->db->insert($this->fixidb->register,$args);
     return $this->db->insert_id();
     
    }    
    

    
    function delete($id){
     
        if(isset($id)){
            $id        =   (int)$id;
            $this->db->delete($this->fixidb->register,array('id'    =>  $id));
            
            return $id;
        }else{
          return FALSE;  
        }
        
    }

    function get_all(){
     
        $fieldlist  =   array();
        $data       =   array();
                        $this->db->db_select();
        $query      =   $this->db->get($this->fixidb->register);
        $i          =   0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;
        
        $i = 0;
        foreach($query->result() as $row):
             for( $count=0; $count < count($fieldlist); $count++ ) {
                $data[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
             }
         $i++; 
        endforeach; 
          
       return $data; 
        
    }
                 
     function get_by_student_ID($student_data_id="") {                  

	        $fieldlist = array();
	        $data =array();
	        $this->db->db_select();
	        $query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE student_data_id='".$student_data_id."' ORDER BY `id` ASC LIMIT 1");
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
     
     function get_by_ID($id="") {                  

	        $fieldlist = array();
	        $data =array();
	        $this->db->db_select();
	        $query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE id='".$id."' ORDER BY `id` ASC");
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
     
     
     function get_registration_no_by_student_data_ID($student_data_id="") {                  

	        $query=$this->db->query("SELECT registration_no FROM ".$this->fixidb->register." WHERE student_data_id='".$student_data_id."' ORDER BY `id` ASC LIMIT 1");
   
   			if($query->num_rows()>0) return $query->row()->registration_no;
       return False;
     }

     function get_registration_no_by_ID($id="") {                  

            $query=$this->db->query("SELECT registration_no FROM ".$this->fixidb->register." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->registration_no;
       return False;
     }

      function get_all_ID($id="") {                  

            $query=$this->db->query("SELECT id FROM ".$this->fixidb->register." ");
   
            if($query->num_rows()>0) return $query->result_array();
     }

     function get_student_data_ID_no_by_registration($registration="") {                  

            $query=$this->db->query("SELECT student_data_id FROM ".$this->fixidb->register." WHERE registration_no='".$registration."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->student_data_id;
     }
     function get_student_data_ID_no_by_register_id($id="") {                  

            $query=$this->db->query("SELECT student_data_id FROM ".$this->fixidb->register." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->student_data_id;
     }
    function get_student_photo_no_by_registration($registration="") {                  

            $query=$this->db->query("SELECT student_photo FROM ".$this->fixidb->register." WHERE registration_no='".$registration."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->student_photo;
     }

     function get_student_data_ID_no_by_ssn($ssn="") {                  

            $query=$this->db->query("SELECT student_data_id FROM ".$this->fixidb->register." WHERE ssn='".$ssn."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->student_data_id;
     }

     function get_student_data_ID_no_by_id($id="") {                  

            $query=$this->db->query("SELECT student_data_id FROM ".$this->fixidb->register." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->student_data_id;
     }
     
     function get_id_by_student_data_ID($student_data_id="") {                  

	        $query=$this->db->query("SELECT id FROM ".$this->fixidb->register." WHERE student_data_id='".$student_data_id."' ORDER BY `id` ASC LIMIT 1");
   
   			if($query->num_rows()>0) return $query->row()->id;
     }

     function get_registration_date_by_student_data_ID($student_data_id="") {                  

            $query=$this->db->query("SELECT registrtation_date FROM ".$this->fixidb->register." WHERE student_data_id='".$student_data_id."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->registrtation_date;
     }

     function get_id_by_student_registration_no($registration_no="") {                  

            $query=$this->db->query("SELECT id FROM ".$this->fixidb->register." WHERE registration_no='".$registration_no."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->id;
     }          
     
     /**
     * registration serial number
     * 
     * @param mixed $domain  should be LCC OR EASTEND
     * @param mixed $course_code
     * @param mixed $student_data_id  only for Eastend studentlist.
     */
     function createRegistrationNumber($domain,$course_code,$student_data_id=0){ // Domains - LCC, EASTEND
		 

		
		
		if($domain=="LCC"){
			
			$current_pattern = $domain.date('Y');
			
			$query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE registration_no LIKE '%".$current_pattern."%' ORDER BY `id` DESC");
			
			$number_of_registration = $query->num_rows();
			
			if($number_of_registration>0){
				
				$current_num_pattern = $current_pattern.sprintf('%04d',($number_of_registration+1));
			
			}else{
				$current_num_pattern = $current_pattern."0001";	
			}
			
			return $current_num_pattern;						
			
		}else if( $domain=="EASTEND" ) {
			$query=$this->db->query("SELECT semester_id,course_id FROM ".$this->fixidb->student_data." WHERE id LIKE '$student_data_id' LIMIT 1");
            
            if($query->num_rows()>0) {
                       $semseterid  = $query->row->semester_id;
                       $courseid    = $query->row->course_id;
            }
			$day = date('d'); 
			$month = date('m');
			$year = date('y'); 
			
			$fixed_date = ($day < 9) ? 1 : 9; // either 1 or 9 
			$course_code = (empty($course_code)) ? "00" : $course_code;
			
			$current_num_pattern = $fixed_date.$month.$year.$course_code; //------- need to be sure...
			
			$query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE registration_no LIKE '%".$current_num_pattern."%' ORDER BY `id` DESC");
			
			$number_of_registration = $query->num_rows();
			
			if($number_of_registration>0){
				
				$current_num_pattern = $current_num_pattern.sprintf('%03d',($number_of_registration+1));
			
			}else{
				$current_num_pattern = $current_num_pattern."001";	
			}
			
			return $current_num_pattern;
		
					
		}
		
		
		
		 
     }
     
     function createRegistrationNo($course,$semester){
		 
		$domain = "LCC";  ///-------------------domain: LCC/EASTEND 
		 
		 
		if($domain == "LCC"){
		 		 
		  $course_relation = $this->course_relation->get_by_course_and_semester($course,$semester);
			
          $admission_enddate_year = date("Y",strtotime($course_relation['admission_enddate_1']));
          
          $temp_regno = "LCC".$admission_enddate_year;
          
          $query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE registration_no LIKE '%".$temp_regno."%' ORDER BY `id` DESC LIMIT 1");
          
          if($query->num_rows()>0){
			  
			  $pre_reg_no = $query->row()->registration_no;
			  //$
			  $num_reg_number = substr($pre_reg_no, -4);
			  $num_reg_number = sprintf("%04d",intval($num_reg_number)+1);
			  $new_regno = $temp_regno.$num_reg_number;
			  
			  
          }else{
			  
			  $new_regno = $temp_regno."0001";
			  
          }
          
          return $new_regno;
          
          
		}else if($domain == "EASTEND"){
			
			$course_relation = $this->course_relation->get_by_course_and_semester($course,$semester);
			$course_data = $this->course->get_by_ID($course);
			$admission_enddate_day = date("d",strtotime($course_relation['class_startdate_1']));
			
			if($admission_enddate_day<10){
				$admission_enddate_day = ltrim($admission_enddate_day,"0");
			}
			
			$expected_date = $admission_enddate_day.date("my",strtotime($course_relation['class_startdate_1']));
			
			$temp_reg = $expected_date.$course_data['course_code'];
			
			$query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE registration_no LIKE '%".$temp_reg."%' ORDER BY `id` DESC LIMIT 1");
			
			
	          if($query->num_rows()>0){
				  
				  $pre_reg_no = $query->row()->registration_no;
				  //$
				  $new_regno = $pre_reg_no+1;
				  
				  
	          }else{
				  
				  $new_regno = $temp_reg."001";
				  
	          }
	          
	          return $new_regno;			
			
			
		}
          
          
          	 
		 
		 
		 
     }
     
     
     /*function createRegistrationNumber_for_lcc(){
		 
		 
		 
     } */
     
     function get_student_data_id_list_by_registration_no_for_search($reg_no){
     	 
     	 $data = array();
     	 $query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE registration_no LIKE '%".$reg_no."%' ORDER BY `id` ASC"); 
		    foreach($query->result() as $row):   
		    	$data[] = $row->student_data_id;		
		    endforeach;		 
		 
		 return $data;
     }
     
     
     function chkIfExistSSNnumber($ssn){
		 
     	 $data = array();
     	 $query=$this->db->query("SELECT * FROM ".$this->fixidb->register." WHERE ssn='".$ssn."' ORDER BY `id` ASC"); 
		 
		 if($query->num_rows()>0){  $data['ssn'] = $query->row()->ssn; $data['register_id'] = $query->row()->id; return $data;  }
		 else return false; 		 
		 
     }
     
     /**
     * check attandence is flaged
     * 
     * @param mixed $register_no
     * @return bolean TRUE|FALSE
     */
     function check_attendence_flag($register_no)
     {
     	 $query=$this->db->query("SELECT `attendance_indicator` FROM ".$this->fixidb->register." WHERE registration_no='".$register_no."' Limit 1");
		 if($query->num_rows()>0 && ($query->row()->attendance_indicator == "yes" || $query->row()->attendance_indicator == ""))
		 {  return TRUE;  }
		 return FALSE;
     }  

    
                   
     function get_ssn($regiser_id){
		 $query=$this->db->query("SELECT `ssn` FROM ".$this->fixidb->register." WHERE id='".$regiser_id."' Limit 1");
		 if($query->num_rows()>0 ) {
			 return $query->row()->ssn ;
		 }                              
	   return NULL;
     }
     
}
?>
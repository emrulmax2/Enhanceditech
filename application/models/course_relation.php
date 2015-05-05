<?php
  
class Course_relation extends CI_Model {
     
     public $course_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('semister','',TRUE);
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
    function update($args=array(),$ID="")
    {
    	if(isset($this->course_id) && $ID=="") {
			$ID = $this->course_id;
    	}
      //$args=fixi_parse_args($args,$default);
      $this->db->update($this->fixidb->course_relation,$args,array('ID'=>$ID));
      
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }
     
    /**
    * insert user information
    * 
    * @return inserted id else return false
    */
    function add($args=array())
    {
     
	 $this->db->insert($this->fixidb->course_relation,$args);
     return $this->db->insert_id();
    }
    
    
    /**
    * delete user by id
    * 
    * @param mixed $user_id
    * @return user id if data is deleted else return false.
    */
    function delete($id){
     
        if(isset($id)){
            $id=(int)$id;
            $this->db->delete($this->fixidb->course_relation,array('ID'=>$id));
            return $id;
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
     
             $i=0;
                $this->db->db_select();
         $query=$this->db->get($this->fixidb->course_relation);
         $course   =   array(); $field_arr = array();
         
		foreach ($query->list_fields() as $field)
		{
		   $field_arr[$i] = $field;
		   $i++;
		}          
          $i=0;
          
         foreach($query->result() as $row){
              
              foreach($field_arr as $v){
				$course[$i][$v] = $row->$v;  
              }
              

              $i++;
         }
         return $course;
          
        
        
    }
    
    
    function get_by_ID($ID){
     
             $i=0;
                $this->db->db_select();
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->course_relation." WHERE id='".$ID."' LIMIT 1");
        
         $course   =   array(); $field_arr = array();
         
		foreach ($query->list_fields() as $field)
		{
		   $field_arr[$i] = $field;
		   $i++;
		}
         
         foreach($query->result() as $row){
              
              foreach($field_arr as $v){
				$course[$v] = $row->$v;  
              }

         }
         return $course;
          
        
        
    }
    
    
    function get_by_course_and_semester($course,$semester){
    	
    	if(preg_match("/[a-zA-Z]/", $course)==1) $course = $this->course->get_ID_by_name($course);
    	if(preg_match("/[a-zA-Z]+ \d+/", $semester)==1) $semester = $this->semister->get_ID_by_name($semester);
     
             $i=0;
                $this->db->db_select();
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->course_relation." WHERE course_id='".$course."' AND semester_id='".$semester."' LIMIT 1");

         $data   =   array(); $field_arr = array();
         
		foreach ($query->list_fields() as $field)
		{
		   $field_arr[$i] = $field;
		   $i++;
		}
         
         foreach($query->result() as $row){
              
              foreach($field_arr as $v){
				$data[$v] = $row->$v;  
              }

         }
         return $data;
          
        
        
    }
    
    
    function get_ID_by_course_ID_semester_ID($course,$semester){
		
    	if(preg_match("/[a-zA-Z]/", $course)==1) $course = $this->course->get_ID_by_name($course);
    	if(preg_match("/[a-zA-Z]+ \d+/", $semester)==1) $semester = $this->semister->get_ID_by_name($semester);

        $this->db->db_select();
        $query=$this->db->query("SELECT ID FROM ".$this->fixidb->course_relation." WHERE course_id='".$course."' AND semester_id='".$semester."' LIMIT 1");
        
        if($query->num_rows() > 0){
			   return $query->row()->ID; 
        }else{
			
			   return false;
        }    	
    	
    			
		
    }

    function get_ID_and_awarding_id_by_course_ID_semester_ID($course,$semester){
    
      if(preg_match("/[a-zA-Z]/", $course)==1) $course = $this->course->get_ID_by_name($course);
      if(preg_match("/[a-zA-Z]+ \d+/", $semester)==1) $semester = $this->semister->get_ID_by_name($semester);

        $this->db->db_select();
        $query=$this->db->query("SELECT ID, awarding_id FROM ".$this->fixidb->course_relation." WHERE course_id='".$course."' AND semester_id='".$semester."' LIMIT 1");
        
        if($query->num_rows() > 0){
      return $query->row_array(); 
        }else{
      
      return false;
        }     
      
          
    
    }
    
    
    function get_course_ID_semester_ID_by_ID($id){
		
        $data = array();
        $this->db->db_select();
        $query=$this->db->query("SELECT course_id, semester_id FROM ".$this->fixidb->course_relation." WHERE ID='".$id."' LIMIT 1");
        
        if($query->num_rows() > 0){
			$data['course_id'] = $query->row()->course_id; 
			$data['semester_id'] = $query->row()->semester_id; 
        }else{
			
			return false;
        }    	
    	
    	return $data;		
		
    }            
    
    
    function get_by_current_date(){
	    $this->db->db_select();
	    $args = array("admission_startdate_1 <=" => date("Y-m-d"),"admission_enddate_1 >=" => date("Y-m-d"),"available" => "uk");
	    $this->db->where($args); 
	    $this->db->or_where(array("available" => "both")); 
        $query=$this->db->get($this->fixidb->course_relation);
        return $query;	
    }
     
    
    function get_courselistby_semesterid($ID){
    	$data =array();
	    $this->db->db_select();
	    $args = array("semester_id" => $ID);
	    $this->db->where($args);                           
        $query=$this->db->get($this->fixidb->course_relation);
        foreach($query->result() as $coursedetails)
        {
			$data[$coursedetails->course_id] = $this->course->get_name($coursedetails->course_id);
        }
        return $data;	
    }
    
    function get_course_id_by_id($id){
		
        $query=$this->db->query("SELECT course_id FROM ".$this->fixidb->course_relation." WHERE ID='".$id."' LIMIT 1");
        
        if($query->num_rows() > 0){
			return $query->row()->course_id; 
        }else{
			
			return false;
        }		
		
    }
    function get_course_relation_ids_by_sem($id){
		
        $query=$this->db->query("SELECT ID FROM ".$this->fixidb->course_relation." WHERE semester_id='".$id."' ");
        
         $data   =   array(); $field_arr = array();  $i =0;
         
         foreach($query->result() as $row){
              
                //var_dump($row);
				$data[$i] = $row->ID;  
				$i++;
              

         }
         return $data;
        		
		
    
	}             
}
?>

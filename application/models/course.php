<?php
  
class Course extends CI_Model {
     
     public $course_id;
     
     function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->library('session');

    }
        
    /**
    * update user basic information
    * @param ARRAY $args 
    * @return TRUE if successfully update else return False
    */    
    function update($args=array(),$ID="")
    {
      
      $this->db->update($this->fixidb->course,$args,array('ID'=>$ID));
      
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
     
	 $this->db->insert($this->fixidb->course,$args);
     return $this->db->insert_id();
    }
    
    
    /**
    * delete id
    * 
    * @param mixed $id
    * @return user id if data is deleted else return false.
    */
    function delete($id){
     
        if(isset($id)){
            $id=(int)$id;
            $this->db->delete($this->fixidb->course,array('ID'=>$id));
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
     

         $i         =   0; 
         $query     =   $this->db->get($this->fixidb->course);
         $course    =   array();
         
         foreach($query->result() as $row){
              $course[$i]["id"]                 =  $row->id;
              $course[$i]["course_name"]        =  $row->course_name;
              $course[$i]["semister"]           =  $row->semister;
              $course[$i]["course_status"]      =  $row->course_status;
              $i++;
             } 
        return $course; 
          
        
        
    }
    
    function get_all_by_course_name_asc(){
     

         $i         =   0; 
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->course." ORDER BY course_name ASC");
         $course    =   array();
         
         foreach($query->result() as $row){
              $course[$i]["id"]                 =  $row->id;
              $course[$i]["course_name"]        =  $row->course_name;
              $course[$i]["semister"]           =  $row->semister;
              $course[$i]["course_status"]      =  $row->course_status;
              $i++;
             } 
        return $course; 
          
        
        
    }
        
    function get_actual_all(){
     

         $i         =   0; 
         $query     =   $this->db->get($this->fixidb->course);
         $course    =   array();
         
         foreach($query->result() as $row){
              $course[$i]["id"]                 =  $row->id;
              $course[$i]["course_name"]        =  $row->course_name;
              $course[$i]["course_code"]        =  $row->course_code;
              $course[$i]["semister"]           =  $row->semister;
              $course[$i]["course_status"]      =  $row->course_status;
              $i++;
             } 
        return $course; 
          
        
        
    }

    function get_all_intotal(){
     
        $query     =   $this->db->get($this->fixidb->course);
        if ($query->num_rows()>0) {
            return $query->result_array();
        }
        else {
            return "";
        }
         
          
        
        
    }

     function get_by_ID($ID="") {
        
		$course = array();
                
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->course." WHERE ID='".$ID."' LIMIT 1");
         foreach($query->result() as $row){
   
              $course["id"]                 =  $row->id;
              $course["course_name"]        =  $row->course_name;
              $course["course_code"]        =  $row->course_code;
              $course["semister"]           =  $row->semister;
              $course["course_status"]      =  $row->course_status;
              
		 }
 
        return $course;        
          
     }

    function get_by_id_new($id="") 
    {                
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->course." WHERE id='".$id."' LIMIT 1");
        if ($query->num_rows()>0) {
            return $query->row_array();
        }else {
            return false;
        }
    }     
     
     function get_name($ID) {
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->course." WHERE id='".$ID."' LIMIT 1");
         if($query->num_rows()>0) return $query->row()->course_name;  
     }
     
     function get_ID_by_name($name){
		 
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->course." WHERE course_name='".$name."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
              $user["name"]  =  $row->id; 
         }
        return @$user["name"];  
     }     
         
                  
}
?>

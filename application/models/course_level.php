<?php
  
class Course_level extends CI_Model {
     
     public $course_id;
     
     function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('coursemodule','',TRUE);
        $this->load->library('session');

    }
        
    /**
    * update user basic information
    * @param ARRAY $args 
    * @return TRUE if successfully update else return False
    */    
    function update($args=array(),$ID="")
    {
      
      $this->db->update($this->fixidb->courselevel,$args,array('ID'=>$ID));
      
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }

    function update_noofmodule($args, $id, $course_id)
    {
      $this->db->where('id', $id);
      $this->db->where('course_id', $course_id);
      $this->db->update($this->fixidb->courselevel, $args);
      
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
     
	 $this->db->insert($this->fixidb->courselevel,$args);
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
            $this->db->delete($this->fixidb->courselevel,array('ID'=>$id));
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
         $query     =   $this->db->get($this->fixidb->courselevel);
         $course   =   array();
         
         foreach($query->result() as $row){
              $course[$i]["id"]                 =  $row->id;
              $course[$i]["course_id"]        =  $row->course_id;
              $course[$i]["name"]        =  $row->name;
              $course[$i]["noofmodule"]           =  $row->noofmodule;
              $i++;
             } 
        return $course; 
          
        
        
    }
                 
     function get_by_ID($ID="") {
        
		$course = array();
                
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->courselevel." WHERE id='".$ID."' LIMIT 1");
         return $query->result_array();
 
        // return $course;        
          
     }

      function get_all_unique_level() {
        
        $course = array();
                
         $query=$this->db->query("SELECT DISTINCT name FROM ".$this->fixidb->courselevel." ORDER BY id ASC");
         return $query->result_array();
 
        // return $course;        
          
     }
    

     function get_by_course_ID($ID="") {
        
        $course = array();
                
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->courselevel." WHERE course_id='".$ID."'");

         return $query->result_array();
 
        // return $course;        
          
     }

     function get_by_course_id_and_level_name($ID="", $level_name = "") {
        
        $course = array();
                
         $query=$this->db->query("SELECT id FROM ".$this->fixidb->courselevel." WHERE course_id='".$ID."' AND name='".$level_name."'");

         return $query->result_array();
 
        // return $course;        
          
     }

      function get_by_course_ID_2($ID="", $c_rel_id) {
        
        $this->db->select('*');
        $this->db->from($this->fixidb->courselevel);
        $this->db->join($this->fixidb->coursemodule, "".$this->fixidb->coursemodule.".course_id = ".$this->fixidb->courselevel.".course_id AND ".$this->fixidb->coursemodule.".courselevel_id = ".$this->fixidb->courselevel.".id");
        $this->db->join($this->fixidb->class_plan, "".$this->fixidb->class_plan.".coursemodule_id = ".$this->fixidb->coursemodule.".id");
        $this->db->where("".$this->fixidb->class_plan.".course_relation_id", $c_rel_id);
        $query = $this->db->get();
        return $query->result_array();

 
        // return $course;        
          
     }
     
     function get_name($ID) {
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->courselevel." WHERE id='".$ID."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
         	 $user["name"]  =  $row->course_name; 
         }
         
         return $user["name"];  
     }
     
     function get_ID_by_name($name){
		 
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->courselevel." WHERE course_name='".$name."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
              $user["name"]  =  $row->id; 
         }
        return @$user["name"];  
     }

    function get_id_list_by_name($name){
         
        $user = array();       
        $query=$this->db->query("SELECT id FROM ".$this->fixidb->courselevel." WHERE name LIKE '".$name."' ORDER BY `id` ASC");
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return "";
        }
    }

     function get_level_module($ID="") {
        
        $course = array();
                
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->courselevel." WHERE course_id='".$ID."'");

         $level = $query->result_array();
         $i = 1;
         foreach ($level as $k => $v) {
             $course[$i][] = $v;
             $course[$i][] = $this->coursemodule->get_by_level_id($v['id']);
        $i++;
         }
 
        return $course;        
          
     }

     

      
         
                  
}
?>

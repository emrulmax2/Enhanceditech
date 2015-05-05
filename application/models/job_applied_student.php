<?php
  
class Job_applied_student extends CI_Model {
     
     
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
      
      $this->db->update($this->fixidb->job_applied_student,$args,array('id'=>$ID));
      
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
     
	 $this->db->insert($this->fixidb->job_applied_student,$args);
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
            $this->db->delete($this->fixidb->job_applied_student,array('ID'=>$id));
            return $id;
        }else{
          return FALSE;  
        }
        
    }


     
     function get_name($ID) {
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->job_applied_student." WHERE id='".$ID."' LIMIT 1");
         if($query->num_rows()>0) return $query->row()->job_applied_student_name;  
     }

     public function get_document_by_job_assign_id($job_assign_id)
     {
          $query=$this->db->query("SELECT documents FROM ".$this->fixidb->job_applied_student." WHERE job_assign_id='".$job_assign_id."' LIMIT 1");
         if($query->num_rows()>0) return $query->row()->documents;  
     }
     
     function get_ID_by_name($name){
		 
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->job_applied_student." WHERE job_applied_student_name='".$name."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
              $user["name"]  =  $row->id; 
         }
        return @$user["name"];  
     }     
         
                  
}
?>

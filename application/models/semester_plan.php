<?php
  
class Semester_plan extends CI_Model {
     
     public $user_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('semister','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('agent','',TRUE);
        $this->load->model('student_data','',TRUE);
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
    function update($args=array())
    {

      $this->db->update($this->fixidb->semester_plan,$args,array('id'=>$args['id']));
      
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

        
     $this->db->insert($this->fixidb->semester_plan,$args);
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
            $this->db->delete($this->fixidb->semester_plan,array('id'    =>  $user_id));
            
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
        $query=$this->db->get($this->fixidb->semester_plan);
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
    
    
    function get_by_ID($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->semester_plan." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
    
    function get_by_semester_id($semester_id){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->semester_plan." WHERE semester_id='".$semester_id."' ORDER BY `id` ASC LIMIT 1");
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
    
    function get_by_semester_id_final($semester_id){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->semester_plan." WHERE semester_id='".$semester_id."' ORDER BY `id` ASC");
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
       
                 
    function get_name_by_id($id){
		
		$query=$this->db->query("SELECT name FROM ".$this->fixidb->semester_plan." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");	
		
		if($query->num_rows()>0){
			return $query->row()->name;	
		}
		
    }
    
    function get_id_by_name($name){
		
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->semester_plan." WHERE name='".$name."' ORDER BY `id` ASC LIMIT 1");	
		
		if($query->num_rows()>0){
			foreach($query->result() as $row):
				return $row->id;
			endforeach;
		}
		
    }
    
    function get_semester_id_by_id($id){
		
		$query=$this->db->query("SELECT semester_id FROM ".$this->fixidb->semester_plan." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");	
		
		if($query->num_rows()>0){

				return $query->row()->semester_id;

		}		
    }
    
    
    
    
    
                   
     
}
?>
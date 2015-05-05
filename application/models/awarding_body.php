<?php
  
class Awarding_body extends CI_Model {
     
     public $awarding_body_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->library('session');

    }
        
    /**
    * update user basic information
    * @param ARRAY $args 
    * @return TRUE if succefully update else return False
    */    
    function update($args=array(),$ID="")
    {
    	if(isset($this->awarding_body_id) && $ID=="") {
			$ID = $this->awarding_body_id;
    	}
      
      $this->db->update($this->fixidb->awarding_body,$args,array('ID'=>$ID));
      
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
     
	 $this->db->insert($this->fixidb->awarding_body,$args);
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
            $user_id=(int)$user_id;
            $this->db->delete($this->fixidb->awarding_body,array('ID'=>$user_id));
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
     
        $data =array();
         $this->db->db_select();
         $query=$this->db->get($this->fixidb->awarding_body);
            $i =0;
         foreach ($query->result() as $row):
            $data[$i] = array("ID"=>$row->ID,"name"=>$row->name);     
            $i++; 
         endforeach;
            
        return $data; 
          
        
        
    }
                 
     function get_by_ID($ID="") {                  
        if(isset($this->semester_id) && $ID==""){
           $ID = $this->semester_id;
        }
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->awarding_body." WHERE ID='".$ID."' LIMIT 1");
         foreach($query->result() as $row) 
         {
              $user["id"]          =  $row->ID;
              $user["name"]        =  $row->name;                   
         }
        return $user;  
     }
     
     function get_name($ID="") {                  

         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->awarding_body." WHERE ID='".$ID."' LIMIT 1");
         
         if($query->num_rows() > 0){
			 
			return $query->row()->name; 
         }
           
     }         
                  
}
?>

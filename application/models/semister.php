<?php
  
class Semister extends CI_Model {
     
     public $semister_id;
     
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
      
      $this->db->update($this->fixidb->semister,$args,array('ID'=>$ID));
      
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
     
	 $this->db->insert($this->fixidb->semister,$args);
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
            $this->db->delete($this->fixidb->semister,array('ID'=>$id));
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
         $query     =   $this->db->get($this->fixidb->semister);
         $semister   =   array();
         
         foreach($query->result() as $row){
              $semister[$i]["id"]                   =  $row->id;
              $semister[$i]["semister_name"]        =  $row->semister_name;
              $semister[$i]["semister_status"]      =  $row->semister_status;
              $i++;
             } 
        return $semister; 
          
        
        
    }
                 
     function get_by_ID($ID="") {
        
		$semister = array();
                
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->semister." WHERE ID='".$ID."' LIMIT 1");
         foreach($query->result() as $row){
   
              $semister["id"]                    =  $row->id;
              $semister["semister_name"]         =  $row->semister_name;
              $semister["semister_status"]       =  $row->semister_status;
              
		 }
 
        return $semister;        
          
     }
     
     
     function get_name($ID){
		 
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->semister." WHERE id='".$ID."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
              $user["name"]  =  $row->semister_name; 
         }
        return @$user["name"];  
     }
     
     function get_ID_by_name($name){
		 
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->semister." WHERE semister_name='".$name."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
              $user["name"]  =  $row->id; 
         }
        return @$user["name"];  
     } 
     
     function get_all_by_des_order(){
         
         $i         =   0; 
         $query     =   $this->db->query("SELECT * FROM ".$this->fixidb->semister." ORDER BY id DESC");
         $semister   =   array();
         
         foreach($query->result() as $row){
              $semister[$i]["id"]                   =  $row->id;
              $semister[$i]["semister_name"]        =  $row->semister_name;
              $semister[$i]["semister_status"]      =  $row->semister_status;
              $i++;
             } 
        return $semister;         
         
     }
     function get_all_by_des_name_order(){
         
         $i         =   0; 
         $query     =   $this->db->query("SELECT * FROM ".$this->fixidb->semister." ORDER BY semister_name DESC");
         $semister   =   array();
         
         foreach($query->result() as $row){
              $semister[$i]["id"]                   =  $row->id;
              $semister[$i]["semister_name"]        =  $row->semister_name;
              $semister[$i]["semister_status"]      =  $row->semister_status;
              $i++;
             } 
        return $semister;         
         
     }       		 
		 

     

         
                  
}
?>

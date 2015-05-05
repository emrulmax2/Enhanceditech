<?php
  
class Agent extends CI_Model {
     
     public $agent_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
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
    function update($args=array(),$pass_change_on = FALSE,$pass_encrypt = "SHA1")
    {
      if($pass_change_on == TRUE) {
       
            if($pass_encrypt == "SHA1") 
	        $args['password']  =    sha1($args['password']);
	      else if($pass_encrypt == "MD5"){
	        $args['password']  =    md5($args['password']);

		  }
		 
      } else {
	      unset($args['password']);
	      
      }

      $this->db->update($this->fixidb->agent,$args,array('id'=>$args['id']));
      
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
     
     if($pass_encrypt == "SHA1") 
     $args['password']  =    sha1($args['password']);
     else if($pass_encrypt == "MD5")
     $args['password']  =    md5($args['password']);    
 
     $this->db->insert($this->fixidb->agent,$args);
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
            $this->db->delete($this->fixidb->agent,array('id'=>$user_id));
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
     

             $i=0;
                $this->db->db_select();
         $query=$this->db->get($this->fixidb->agent);
        //return $query;
         $agent   =   array(); $field_arr = array();
         
		foreach ($query->list_fields() as $field)
		{
		   $field_arr[$i] = $field;
		   $i++;
		}
		
          $i=0;
          
         foreach($query->result() as $row){
              
              foreach($field_arr as $v){
				$agent[$i][$v] = $row->$v;  
              }
              

              $i++;
         }
         return $agent; 
          
        
        
    }
    
    function get_all_active(){
     

             $i=0;
                $this->db->db_select();
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->agent." WHERE agent_status='active'");
        
         $agent   =   array(); $field_arr = array();
         
		foreach ($query->list_fields() as $field)
		{
		   $field_arr[$i] = $field;
		   $i++;
		}
		         
          $i=0;
          
         foreach($query->result() as $row){
              
              foreach($field_arr as $v){
				$agent[$i][$v] = $row->$v;  
              }
              

              $i++;
         }        
        
         return $agent; 
          
        
        
    }    
    
    function get_by_status(){
     
            $i=0; $agent = array();
            $this->db->db_select();
            $this->db->where("agent_status", "active");
            $this->db->order_by("agent_name", "asc");
         	$query=$this->db->get($this->fixidb->agent);
         
	         foreach($query->result() as $row){
	              $agent[$i]["id"]            =  $row->id;
	              $agent[$i]["agent_name"]         =  $row->agent_name;
	              $agent[$i]["agent_nick_name"]          =  $row->agent_nick_name;
	              $agent[$i]["email_address"]          =  $row->email_address;
	              $agent[$i]["agent_mobile_number"]          =  $row->agent_mobile_number;
	              $agent[$i]["password"]          =  $row->password;
	              $agent[$i]["agent_status"]          =  $row->agent_status;
	              $agent[$i]["last_login_datetime"]          =  $row->last_login_datetime;
	              $agent[$i]["last_login_ip"]          =  $row->last_login_ip;
	              $i++;
	         }         
         
         
        return $agent; 
      
    }
                 
     function get_by_ID($ID="") {                  
        if(isset($this->aagent_id) && $ID==""){
           $ID = $this->agent_id;
        }
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->agent." WHERE id='".$ID."' LIMIT 1");
         
             $i=0;

         $agent   =   array(); $field_arr = array();
         
		foreach ($query->list_fields() as $field)
		{
		   $field_arr[$i] = $field;
		   $i++;
		}
          $i=0;
          
         foreach($query->result() as $row){
              
              foreach($field_arr as $v){
				$agent[$v] = $row->$v;  
              }
              

              $i++;
         }        
         return $agent;  
     }
     
     function get_name_by_ID($ID="") {                  
         $user = array();       
         $query=$this->db->query("SELECT agent_name FROM ".$this->fixidb->agent." WHERE id='".$ID."' LIMIT 1");
         if($query->num_rows()>0) return $query->row()->agent_name;  
     }         
                  
      
     function check_agent_password($password,$ID=0){
     	                   
        if(isset($this->aagent_id) && $ID==0 || $ID == ""){
           $ID = $this->agent_id;
        }
       $query=$this->db->query("SELECT * FROM ".$this->fixidb->agent." WHERE id='".$this->agent_id."' LIMIT 1");
         foreach($query->result() as $row){
             if($row->password == sha1($password) || $row->password == md5($password) )
             return $row->id;
         }
           
        return FALSE; 
     }
     
     function check_password($oldpass,$id){
		 
       $query=$this->db->query("SELECT * FROM ".$this->fixidb->agent." WHERE id='".$id."' LIMIT 1");
         foreach($query->result() as $row){
             if($row->password == sha1($oldpass) || $row->password == md5($oldpass) )
             return true;
         }
           
        return FALSE;		 
     }     
}
?>
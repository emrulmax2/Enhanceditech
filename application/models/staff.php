<?php
  
class Staff extends CI_Model {
     
     public $staff_id;
     
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
       //var_dump($args);
      $this->db->update($this->fixidb->staff,$args,array('id'=>$args['id']));
      
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
     
          
	 $this->db->insert($this->fixidb->staff,$args);
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
            $this->db->delete($this->fixidb->staff,array('id'=>$user_id));
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
        $this->db->db_select();
        $this->db->order_by("staff_name");
        $query      =   $this->db->get($this->fixidb->staff);
        $i          =   0;
        $staff      =   array(); 
        $field_arr  =   array();
         
        foreach ( $query->list_fields() as $field ) {   $field_arr[$i] = $field; $i++; }
         $i = 0;
         foreach( $query->result() as $row ) {
            foreach( $field_arr as $v ){  $staff[$i][$v] = $row->$v;  } 
            $i++;
         }        
         return $staff;    

          
        
        
    }
                 
     function get_by_ID($ID="") {                  
        if(isset($this->staff_id) && $ID==""){ $ID = $this->staff_id; }       
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->staff." WHERE id='".$ID."' LIMIT 1");
                            $i          =   0;
                            $staff      =   array(); 
                            $field_arr  =   array();
         
        foreach ( $query->list_fields() as $field ) {   $field_arr[$i] = $field; $i++; }
         $i = 0;
         foreach( $query->result() as $row ) {
            foreach( $field_arr as $v ){  $staff[$v] = $row->$v;  } 
            $i++;
         }        
         return $staff;  
     }
     
     function get_name($ID) {
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->staff." WHERE id='".$ID."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
         	
         	 $user["staff_name"]  =  $row->staff_name; 
         
         }
         
         return $user["staff_name"];  
     }
     
     
     function get_nick_name($ID) {
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->staff." WHERE id='".$ID."' LIMIT 1");
         
         if($query->num_rows()>0) return $query->row()->staff_nick_name;  
     }     
     
     function get_by_EMAIL($email){
		 
			$query=$this->db->query("SELECT * FROM ".$this->fixidb->staff." WHERE staff_email='".$email."' LIMIT 1");
                            $i          =   0;
                            $staff      =   array(); 
                            $field_arr  =   array();
         
        foreach ( $query->list_fields() as $field ) {   $field_arr[$i] = $field; $i++; }
         $i = 0;
         foreach( $query->result() as $row ) {
            foreach( $field_arr as $v ){  $staff[$v] = $row->$v;  } 
            $i++;
         }        
         return $staff;		 
		 
     }
     
     function check_password($oldpass,$id){
		 
       $query=$this->db->query("SELECT * FROM ".$this->fixidb->staff." WHERE id='".$id."' LIMIT 1");
         foreach($query->result() as $row){
             if($row->password == sha1($oldpass) || $row->password == md5($oldpass) )
             return true;
         }
           
        return FALSE;		 
     }
         
                  
}
?>

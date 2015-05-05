<?php
  
class Users extends CI_Model {
     
     public $user_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','tablename',TRUE);
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
    function update($args=array(),$pass_change_on = FALSE, $pass_encrypt = "SHA1")
    {
      if($pass_change_on == TRUE) {
       
      $default  =   array('ID'=>$this->user_id,'username'=>'','email'=>'','password'=>'','usertype' => '');
      
	      if($pass_encrypt == "SHA1") 
	        $args['password']  =    sha1($args['password']);
	      else if($pass_encrypt == "MD5"){
	        $args['password']  =    md5($args['password']);

		  }
		  $args=fixi_parse_args($args,$default);
          //var_dump($args);
      } else {
	      unset($args['password']);
	      $default  =   array('ID'=>$this->user_id,'username'=>'','email'=>'','usertype' => '');
	      $args     =   fixi_parse_args($args,$default);
      }

      $this->db->update($this->tablename->user,$args,array('ID'=>$args['ID']));
      
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
     
     $default=array('username'=>'','email'=>'','password'=>'','usertype' => 'staff');
     
     if($pass_encrypt == "SHA1") 
     $args['password']  =    sha1($args['password']);
     else if($pass_encrypt == "MD5")
     $args['password']  =    md5($args['password']);
     //$args['password']  =    sha1($args['password']);
     $args=fixi_parse_args($args,$default); 
     $this->db->insert($this->tablename->user,$args);
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
            $this->db->delete($this->tablename->user,array('ID'=>$user_id));
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
         $query=$this->db->get($this->tablename->user);
        return $query; 
          
        
        
    }
                 
     function get_by_ID($ID) {                  
        
         $user = array();       
         $query=$this->db->query("SELECT * FROM ".$this->tablename->user." WHERE ID='".$ID."' LIMIT 1");
         foreach($query->result() as $row){
   
              $user["ID"]           =  $row->ID;
              $user["username"]     =  $row->username;
              $user["password"]     =  $row->password;
              $user["email"]        =  $row->email;
              $user["usertype"]     =  $row->usertype;
              
         }
 
        return $user;  
     }    
      
}
?>

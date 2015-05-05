<?php
  
class Lcc_communication extends CI_Model {
     
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
    function update($args=array(),$pass_change_on=FALSE)
    {
       
     
      $this->db->update($this->fixidb->communication,$args,array('id'=>$args['id']));
      
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
     
     $this->db->insert($this->fixidb->communication,$args);
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
            $this->db->delete($this->fixidb->communication,array('id'=>$user_id));
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
        $data = "";     

                $this->db->db_select();
                $this->db->order_by("id", "desc");
         $query=$this->db->get($this->fixidb->communication);
          $i =0;
         foreach($query->result() as $row){
             $data[$row->id] = array('id'=>$row->id,'staff_id'=>$row->staff_id,'text'=>$row->text,'serial'=>$row->serial,'datetime'=>$row->datetime,'entry_date'=>$row->entry_date,'student_data_id'=>$row->student_data_id);
             $i++;
         }
          
      return $data;  
        
    }
                 
     function get_by_ID($ID="") {                  
       
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->communication." WHERE id='".$ID."' LIMIT 1");
         
        return $query;  
     }    
                  
    function get_by_student_ID($ID="", $ORDER ="desc") {                  
          $data=array();
      
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->communication." WHERE student_data_id='".$ID."' ORDER BY id $ORDER");
          $i =0;
         foreach($query->result() as $row){
             $data[$row->id] = array('id'=>$row->id,'staff_id'=>$row->staff_id,'text'=>$row->text,'serial'=>$row->serial,'datetime'=>$row->datetime,'entry_date'=>$row->entry_date,'student_data_id'=>$row->student_data_id);
             $i++;
         }
         
        return $data;  
     }        
     
     function get_by_staff_ID($ID="") {                  
          $data=array();
	  
         $query=$this->db->query("SELECT * FROM ".$this->fixidb->communication." WHERE staff_id='".$ID."' ORDER BY id desc");
        
          $i =0;
         foreach($query->result() as $row){
			 $data[$row->id] = array('id'=>$row->id,'staff_id'=>$row->staff_id,'text'=>$row->text,'serial'=>$row->serial,'datetime'=>$row->datetime,'entry_date'=>$row->entry_date,'student_data_id'=>$row->student_data_id);
			 $i++;
         }
         
        return $data;  
     }
     
     function get_next_serial_by( $ID ) {
         $serial   = 1;        
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->communication." WHERE `student_data_id`='".$ID."' ORDER BY `serial` DESC LIMIT 1");
         if($query->num_rows() > 0 ) $serial =  $query->row()->serial +1;

        return $serial;  
     }        
       
 
}
?>

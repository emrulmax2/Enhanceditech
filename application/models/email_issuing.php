<?php
  
class Email_issuing extends CI_Model {
     
     public $email_id;
     
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


      $this->db->update($this->fixidb->email_issuing,$args,array('id'=>$args['id']));
      
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

      
     $this->db->insert($this->fixidb->email_issuing,$args);
     return $this->db->insert_id();
     
    }    

    /**
    * delete user by id
    * 
    * @param mixed $user_id
    * @return user id if data is deleted else return false.
    */
    function delete($id){
     
        if(isset($id)){
            $id        =   (int)$id;
            $this->db->delete($this->fixidb->email_issuing,array('id'    =>  $id));
            
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
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->get($this->fixidb->email_issuing);
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
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->email_issuing." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
                 
    function get_by_student_data_id($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->email_issuing." WHERE student_data_id='".$ID."' ORDER BY `id` ASC");
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
       
    
    
                   
     
}
?>
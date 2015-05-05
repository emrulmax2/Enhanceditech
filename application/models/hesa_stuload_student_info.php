<?php
  
class Hesa_stuload_student_info extends CI_Model {
     
     public $user_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('semister','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('agent','',TRUE);
        //$this->load->model('student_data','',TRUE);
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
       foreach($args as $k =>$v) {
        if($k!="hesa_grossfee" && $k!="hesa_netfee" && $k!="hesa_periodstart" && $k!="hesa_periodend" && $k!="hesa_yearprg" && $k!="hesa_yearstu" && empty($v)) $args[$k] = 0;
      }
      $this->db->update($this->fixidb->hesa_stuload_student_info,$args,array('id'=>$args['id']));
      
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

        
     $this->db->insert($this->fixidb->hesa_stuload_student_info,$args);
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
            $this->db->delete($this->fixidb->hesa_stuload_student_info,array('id'    =>  $user_id));
            
            return $user_id;
        }else{
          return FALSE;  
        }
        
    }
    /*
    *
    * get all user
    * 
    * 
    * @return user id if data is deleted else return false.
    */
    function get_all(){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->get($this->fixidb->hesa_stuload_student_info);
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

    function get_all_code() {

      $data =array();
      $this->db->db_select();
      $query=$this->db->get($this->fixidb->hesa_stuload_student_info);
      
      foreach ($query->result_array() as $key => $value) {
         
         $data[$value['id']] = $value['code'];

      } 
        
      return $data;

    }
    
    
    function get_by_ID($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->hesa_stuload_student_info." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
    
    function get_name_by_id($id){
		
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->hesa_stuload_student_info." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");	
		//return $id;
  		if($query->num_rows()>0){
  			//return "yes";
  			return $query->row()->name;	
  		} 
  		

		
    }
    
    function get_by_hesa_course_relation_instance_id_student_data_id_register_id($hesa_course_relation_instance_id, $student_data_id, $register_id){
 
 
        $fieldlist = array();
        $data =array();
        $this->db->db_select();        
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->hesa_stuload_student_info." WHERE hesa_course_relation_instance_id='".$hesa_course_relation_instance_id."' AND student_data_id='".$student_data_id."' AND register_id='".$register_id."' ORDER BY `id` ASC LIMIT 1");    
        
        if($query->num_rows()>0){
            
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
        }else{
            return false;
        }
        
        
    }   
                 

    
    
                   
     
}
?>
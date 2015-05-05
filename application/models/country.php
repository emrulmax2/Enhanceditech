<?php
  
class Country extends CI_Model {
     
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

      $this->db->update($this->fixidb->countries,$args,array('id'=>$args['id']));
      
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

        
     $this->db->insert($this->fixidb->countries,$args);
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
            $this->db->delete($this->fixidb->countries,array('id'    =>  $user_id));
            
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
        $query=$this->db->get($this->fixidb->countries);
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
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->countries." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
    
    $query=$this->db->query("SELECT country_name FROM ".$this->fixidb->countries." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");  
    
      if($query->num_rows()>0){
        foreach($query->result() as $row):
          return $row->country_name;
        endforeach;
      }
    
    }

    function get_ID_by_name($name){
    
    $query=$this->db->query("SELECT id FROM ".$this->fixidb->countries." WHERE country_name='".$name."' ORDER BY `id` ASC LIMIT 1");  
    
      if($query->num_rows()>0){
        foreach($query->result() as $row):
          return $row->id;
        endforeach;
      }
    
    }

    function get_iso2_by_id($id){
    
    $query=$this->db->query("SELECT iso_code_2 FROM ".$this->fixidb->countries." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");  
    
      if($query->num_rows()>0){
        foreach($query->result() as $row):
          return $row->name;
        endforeach;
      }
    
    } 

    function get_iso3_by_id($id){
    
    $query=$this->db->query("SELECT iso_code_3 FROM ".$this->fixidb->countries." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");  
    
      if($query->num_rows()>0){
        foreach($query->result() as $row):
          return $row->name;
        endforeach;
      }
    
    }  
                 

    function get_all_iso2() {

      $data =array();
      $this->db->db_select();
      $query=$this->db->get($this->fixidb->countries);
      
      foreach ($query->result_array() as $key => $value) {
         
         $data[$value['id']] = $value['iso_code_2'];

      } 
        
      return $data;

    }    
    
                   
     
}

?>
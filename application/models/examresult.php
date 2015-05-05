<?php
  
class Examresult extends CI_Model {
     
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
    	//$args['percentage'] = "55";  
     	$this->db->update($this->fixidb->examresult,$args,array('id'=>$args['id']));
     //$this->db->update($this->fixidb->examresult,$args,array('id'=>'146445'));
     // var_dump($args);
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

        
     $this->db->insert($this->fixidb->examresult,$args);
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
            $this->db->delete($this->fixidb->examresult,array('id'    =>  $user_id));
            
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
        $query=$this->db->get($this->fixidb->examresult);
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
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
    
    function get_by_register_id($register_id){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE register_id='".$register_id."' ORDER BY `id`");
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
    
    function get_by_class_plan_ID($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE class_plan_id='".$ID."' ORDER BY `id` ASC");
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
    
    
    function get_by_time_plan_ID($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE time_planid='".$ID."' ORDER BY `id` ASC");
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
    
    function checkIfClassListsExistByClassPlanID($class_planid){
		
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE class_planid='".$class_planid."' ORDER BY `id` LIMIT 1");	
		
		if($query->num_rows() > 0)
			return $query->row()->id;
		else
			return false;	
    }
    
    function get_class_list_for_days_list_array_by_class_plan_id($class_planid){

        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE class_planid='".$class_planid."' ORDER BY `id` ASC");
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
        $output_data = array();
        for($i=0;$i<count($data);$i++){
			$output_data[$i] = $data[$i]['date']."|".$data[$i]['type']."|".$data[$i]['id'];	
        }
          
       return $output_data;		
		
    }

    function get_id_by_date_and_class_plan_id($date="", $class_plan_id = "") {                  

            $query=$this->db->query("SELECT id FROM ".$this->fixidb->examresult." WHERE date='".$date."' AND class_planid = '".$class_plan_id."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->id;
     }

     function get_examresult_list_by_register_id_and_class_plan_id($register_id="", $class_plan_id = "") {                  

            $query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE register_id='".$register_id."' AND class_plan_id = '".$class_plan_id."' ORDER BY `id` DESC");
   
            if($query->num_rows()>0) return $query->result_array();
     }

    function get_examresult_by_date($date="")
    {
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->examresult." WHERE attendance_date LIKE '".date("Y-m-d",strtotime($date))."' ORDER BY id DESC");
   
        if($query->num_rows()>0) return $query->result_array();
    } 
    
    
    
    
    
  
    
    
    
                   
     
}
?>
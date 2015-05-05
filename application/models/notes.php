<?php
  
class Notes extends CI_Model {
     
     public $notes_id;
     
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
    	if(isset($this->notes_id) && $ID=="") {
			$ID = $this->notes_id;
    	}
      
      $this->db->update($this->fixidb->notes,$args,array('id'=>$ID));
      
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
     
	 $this->db->insert($this->fixidb->notes,$args);
     return $this->db->insert_id();
    }
    
    
    /**
    * delete user by id
    * 
    * @param mixed $user_id
    * @return user id if data is deleted else return false.
    */
    function delete($ID){
     
        if(isset($ID)){
            $user_id=(int)$ID;
            $this->db->delete($this->fixidb->notes,array('id'=>$user_id));
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
     $query      =   $this->db->get($this->fixidb->notes);
     $i          =   0;
     $data      =   array(); 
     $field_arr  =   array();
         
        foreach ( $query->list_fields() as $field ) {   $field_arr[$i] = $field; $i++; }
         $i = 0;
         foreach( $query->result() as $row ) {
            foreach( $field_arr as $v ){  $data[$i][$v] = $row->$v;  } 
            $i++;
         }        
         return $data;    

          
        
        
    }
                 
     function get_by_ID($ID="") {                  
        if(isset($this->notes_id) && $ID==""){ $ID = $this->notes_id; }
         $data  =   array();       
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->notes." WHERE id='".$ID."' LIMIT 1");
         /*foreach($query->result() as $row) 
         {  
              $data["id"]           	=  $row->id;
              $data["student_data_id"]  =  $row->student_data_id;
              $data["staff_id"]         =  $row->staff_id;
              $data["text"]       	    =  $row->text;
              $data["datetime"]       	=  $row->datetime;
              $data["entry_date"]       =  $row->entry_date;
         }*/
         if($query->num_rows()>0){
            return $query->row_array();    
         }
         return false; 
          
     }
     
     function get_by_applicationID($ID) {
         $data  =   array();       
         $i        =   0;       
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->notes." WHERE `student_data_id`='".$ID."' ORDER BY `id` DESC ");
         /*foreach($query->result() as $row) 
         {  
              $data[$i]["id"]               =  $row->id;
              $data[$i]["student_data_id"]  =  $row->student_data_id;
              $data[$i]["staff_id"]         =  $row->staff_id;
              $data[$i]["text"]             =  $row->text;
              $data[$i]["datetime"]         =  $row->datetime;
              $data[$i]["entry_date"]       =  $row->entry_date;
         $i++;
         }
        return $data;*/
         if($query->num_rows()>0){
            return $query->result_array();    
         } else {
            return false;
         }
            
     }    
                  
}
?>

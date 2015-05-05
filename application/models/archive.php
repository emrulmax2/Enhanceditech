<?php
  
class Archive extends CI_Model {
     
     public $archive_id;
     
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
    	if(isset($this->archive_id) && $ID=="") {
			$ID = $this->archive_id;
    	}
      
      $this->db->update($this->fixidb->archive,$args,array('ID'=>$ID));
      
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
     
	 $this->db->insert($this->fixidb->archive,$args);
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
            $this->db->delete($this->fixidb->archive,array('ID'=>$user_id));
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
     $query      =   $this->db->get($this->fixidb->archive);
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
        if(isset($this->archive_id) && $ID==""){ $ID = $this->archive_id; }
         $archive  =   array();       
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->archive." WHERE id='".$ID."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
              $archive["id"]           	 	            =  $row->id;
              $archive["student_data_id"]         	    =  $row->student_data_id;
              $archive["staff_id"]                      =  $row->staff_id;
              $archive["archive_field_name"]       	    =  $row->archive_field_name;
              $archive["archive_field_value"]       	=  $row->archive_field_value;
              $archive["archive_field_previous_value"]  =  $row->archive_field_previous_value;                  
              $archive["archive_change_datetime"]       =  $row->archive_change_datetime;
              $archive["entry_date"]    		        =  $row->entry_date;
         }
        return $archive;  
     }
     
     function get_by_applicationID($ID) {
         $archive  =   array();       
         $i        =   0;       
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->archive." WHERE `student_data_id`='".$ID."' ORDER BY `id` DESC ");
         foreach($query->result() as $row) 
         {  
              $archive[$i]["id"]                            =  $row->id;
              $archive[$i]["student_data_id"]               =  $row->student_data_id;
              $archive[$i]["staff_id"]                      =  $row->staff_id;
              $archive[$i]["archive_field_name"]            =  $row->archive_field_name;
              $archive[$i]["archive_field_value"]           =  $row->archive_field_value;
              $archive[$i]["archive_field_previous_value"]  =  $row->archive_field_previous_value;                  
              $archive[$i]["archive_change_datetime"]       =  $row->archive_change_datetime;
              $archive[$i]["entry_date"]                    =  $row->entry_date;
         $i++;
         }
        return $archive;    
     }    
                  
}
?>

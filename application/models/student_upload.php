<?php
  
class Student_upload extends CI_Model {
     
     public $upload_id;
     
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
    	if(isset($this->upload_id) && $ID=="") {
			$ID = $this->upload_id;
    	}
      
      $this->db->update($this->fixidb->student_upload,$args,array('id'=>$ID));
      
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
     
	 $this->db->insert($this->fixidb->student_upload,$args);
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
            $this->db->delete($this->fixidb->student_upload,array('id'=>$user_id));
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
     $query      =   $this->db->get($this->fixidb->student_upload);
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
        if(isset($this->upload_id) && $ID==""){ $ID = $this->upload_id; }
         $uploadfile  =   array();       
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->student_upload." WHERE id='".$ID."' LIMIT 1");
         foreach($query->result() as $row) 
         {  
              $uploadfile["serial"]                    =  $row->serial;
              $uploadfile["filepath"]                  =  $row->filepath;
              $uploadfile["filename"]                  =  $row->filename;              
              $uploadfile["student_data_id"]           =  $row->student_data_id;
              $uploadfile["staff_id"]                  =  $row->staff_id;
              $uploadfile["datetime"]                  =  $row->datetime;                  
              $uploadfile["check_hard_copy_doc"]       =  $row->check_hard_copy_doc;
              $uploadfile["reason"]                    =  $row->reason;
         }
        return $uploadfile;  
     }
     
     function get_by_applicationID($ID) {
         $uploadfile  =   array();       
         $i        =   0;       
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->student_upload." WHERE `student_data_id`='".$ID."' ORDER BY `id` ASC ");
         foreach($query->result() as $row) 
         {  
              $uploadfile[$i]["serial"]                    =  $row->serial;
              $uploadfile[$i]["filepath"]                  =  $row->filepath;
              $uploadfile[$i]["filename"]                  =  $row->filename;              
              $uploadfile[$i]["student_data_id"]           =  $row->student_data_id;
              $uploadfile[$i]["staff_id"]                  =  $row->staff_id;
              $uploadfile[$i]["datetime"]                  =  $row->datetime;                  
              $uploadfile[$i]["check_hard_copy_doc"]       =  $row->check_hard_copy_doc;
              $uploadfile[$i]["reason"]                    =  $row->reason;
         $i++;
         }
        return $uploadfile;    
     }    
     function get_next_serial($ID) {
         $serial   = 1;        
         $query =   $this->db->query("SELECT * FROM ".$this->fixidb->student_upload." WHERE `student_data_id`='".$ID."' ORDER BY `serial` DESC LIMIT 1");
         if($query->num_rows() > 0 ) $serial =  $query->row()->serial +1;

        return $serial;    
     }  
     
      function get_student_uploadlistByserial($ID,$communication_serial) {
           $uploadfile  = array();
           $i           = 0;
           $query       = $this->db->query("SELECT * FROM ".$this->fixidb->student_upload." WHERE `student_data_id`='".$ID."'  AND `communication_serial` LIKE '{$communication_serial}' ORDER BY `serial` DESC ");
           
           if($query->num_rows() > 0 ) {
               foreach($query->result() as $row) 
               {
                 $uploadfile[$i]["serial"]                    =  $row->serial;
                 $uploadfile[$i]["filepath"]                  =  $row->filepath;
                 $uploadfile[$i]["filename"]                  =  $row->filename;    
                   
                 $i++;  
               }
           }
         return $uploadfile; 
      }  
                  
}
?>

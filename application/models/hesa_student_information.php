<?php
  
class Hesa_student_information extends CI_Model {
     
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
            
            if($k!="uhn_number" && $k!="hesa_yearstu" && $k!="hesa_comdate" && $k!="hesa_enddate" && empty($v)) $args[$k] = 0;
            
        }
        // var_dump($args); die();
         /*$default = array(  "student_data_id"       => 0,
                            "register_id"           => 0,
                            "hesa_class_id"         => 0,
                            "hesa_courseaim_id"     => 0,
                            "hesa_disall_id"        => 0,
                            "hesa_exchind_id"       => 0,
                            "hesa_genderid_id"      => 0,
                            "hesa_heapespop_id"     => 0,
                            "hesa_locsdy_id"        => 0,
                            "hesa_mode_id"          => 0,
                            "hesa_priprov_id"       => 0,
                            "hesa_qual_id"          => 0,
                            "hesa_regbody_id"       => 0,
                            "hesa_relblf_id"        => 0,
                            "hesa_rsnend_id"        => 0,
                            "hesa_sexort_id"        => 0,
                            "hesa_sselig_id"        => 0,
                            "hesa_ttcid_id"         => 0,
                            "uhn_number"            => ""
                             );
                            
         $args    = fixi_parse_args($args,$default);*/
        //var_dump($args);
      $this->db->update($this->fixidb->hesa_student_information,$args,array('id'=>$args['id']));
      
      if($this->db->affected_rows()>0) return TRUE;
    
        return FALSE;
     
    }

    function update_by_student_data_id($args=array())
    {
         
      $this->db->update($this->fixidb->hesa_student_information,$args,array('student_data_id'=>$args['student_data_id']));
      
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
        
        foreach($args as $k =>$v) {
            
            if($k!="uhn_number" && $k!="hesa_yearstu" && empty($v)) $args[$k] = 0;
            
        }        
         /*$default = array(  "student_data_id"       => 0,
                            "register_id"           => 0,
                            "hesa_class_id"         => 0,
                            "hesa_courseaim_id"     => 0,
                            "hesa_disall_id"        => 0,
                            "hesa_exchind_id"       => 0,
                            "hesa_genderid_id"      => 0,
                            "hesa_heapespop_id"     => 0,
                            "hesa_locsdy_id"        => 0,
                            "hesa_mode_id"          => 0,
                            "hesa_priprov_id"       => 0,
                            "hesa_qual_id"          => 0,
                            "hesa_regbody_id"       => 0,
                            "hesa_relblf_id"        => 0,
                            "hesa_rsnend_id"        => 0,
                            "hesa_sexort_id"        => 0,
                            "hesa_sselig_id"        => 0,
                            "hesa_ttcid_id"         => 0,
                            "uhn_number"            => ""
                             );
                            
         $args    = fixi_parse_args($args,$default);*/
        
     $this->db->insert($this->fixidb->hesa_student_information,$args);
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
            $this->db->delete($this->fixidb->hesa_student_information,array('id'    =>  $user_id));
            
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
        $query=$this->db->get($this->fixidb->hesa_student_information);
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

    // function get_all_code() {

    //   $data =array();
    //   $this->db->db_select();
    //   $query=$this->db->get($this->fixidb->hesa_student_information);
      
    //   foreach ($query->result_array() as $key => $value) {
         
    //      $data[$value['id']] = $value['code'];

    //   } 
        
    //   return $data;

    // }
    
    
    function get_by_ID($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->hesa_student_information." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
    
    function get_by_student_data_id_and_register_id($student_data_id="", $register_id=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->hesa_student_information." WHERE student_data_id='".$student_data_id."' AND register_id='".$register_id."' ORDER BY `id` ASC LIMIT 1");
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
		
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->hesa_student_information." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");	
		//return $id;
  		if($query->num_rows()>0){
  			//return "yes";
  			return $query->row()->name;	
  		} 
  		

		
    }
    
    function calculateHusidNumber($student_reg_no){
        
        $only_number = substr($student_reg_no, 5);
        //$only_number_arr = str_split($only_number);
        
        if(strlen($only_number)==6){
            
            $year_2_digit = substr($only_number,0,2);
            $hesa_coll_id = 250 + 1000;
            
            $main_number = $year_2_digit.$hesa_coll_id.$only_number;
            
            if(strlen($main_number)==12){
                
                ///------- calculate last digit
                $main_number_arr = str_split($main_number);
                //return $main_number_arr;
                $weight_multiplied_arr = array();
                $j=1;
                foreach($main_number_arr as $num){
                    
                    if($j<4){
                        
                        if($j==1){ $val = $num * 1; $weight_multiplied_arr[] = $val; }  
                        if($j==2){ $val = $num * 3; $weight_multiplied_arr[] = $val; }  
                        if($j==3){ $val = $num * 7; $weight_multiplied_arr[] = $val; }  
                          
                        
                        $j++;    
                    
                    }else if($j==4){
                        
                         $val = $num * 9; $weight_multiplied_arr[] = $val;
                        
                       $j=1; 
                    }    
                    
                }
               
                //return $weight_multiplied_arr;
                $total = 0;
                foreach($weight_multiplied_arr as $num){                    
                   $total = $total + $num;                     
                }
                
                $last_num = substr($total, -1);
                
                $final_number = 10 - $last_num;
                
                $main_number = $main_number.$final_number;
                return $main_number;
                 
            }   
        }else{
            
            return false;
        }
            
        
        
    }   
                 

    
    
                   
     
}
?>
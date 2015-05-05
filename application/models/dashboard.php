<?php
   class Dashboard extends CI_Model {
        
     function __construct() {
  
          parent::__construct();
          $this->load->model('fixidb');

          $this->load->database();
                  
    }
    
    function get_all_todays_count() {

            $data =array();
            $sql_1 = "SELECT count(*) as communication FROM ".$this->fixidb->communication." WHERE DATE(`entry_date`)='".date("Y-m-d")."' ";
            $sql_2 = "SELECT count(*) as archive FROM ".$this->fixidb->archive." WHERE  DATE(`entry_date`)='".date("Y-m-d")."' ";
            $sql_3 = "SELECT count(*) as student_data FROM ".$this->fixidb->student_data." WHERE  DATE(`entry_date`)='".date("Y-m-d")."' AND student_admission_status_for_staff='New' ";
            $sql_4 = "SELECT count(*) as notes FROM ".$this->fixidb->notes." WHERE  DATE(`entry_date`)='".date("Y-m-d")."' ";
          // var_dump($sql_1);
           $query_1=$this->db->query($sql_1);
           $query_2=$this->db->query($sql_2);
           $query_3=$this->db->query($sql_3);
           $query_4=$this->db->query($sql_4);

           $data["todays_communication"]     =   $query_1->row()->communication*1;
           $data["todays_archive"]         =   $query_2->row()->archive*1;
           $data["todays_studentdata"]   =   $query_3->row()->student_data*1;
           $data["todays_notes"]      =   $query_4->row()->notes*1;
        


        return $data; 
        
    }




       
 }  // end of class
?>

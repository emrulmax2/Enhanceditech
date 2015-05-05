<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Model {

     public $timezone;
     public $chache_on;
    
    function __construct() {
  
        parent::__construct();
        $this->timezone = 'Europe/London';
        $this->chache_on = FALSE;
        $this->set_timezone();
        $this->header_chache();
	    $this->load->model('fixidb');
	    $this->load->helper('functions');
	    $this->load->database();        
        
    }
     private function header_chache() {
     if($this->chache_on == FALSE) {
                $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
                $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
                $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
                $this->output->set_header('Pragma: no-cache');
             }
      
     }
     
     public function set_timezone() {
         date_default_timezone_set($this->timezone);
     }
     
   /* function add_settings( $args ) {

    	$default['company_name'] = '';
    	$default['address'] = '';
    	$default['phone'] = '';
    	$default['start_date'] = '';
    	$default['end_date'] = '';

    	
        $args=fixi_parse_args($args,$default);
        $this->db->db_select();
        $this->db->insert($this->fixidb->settings, $args);

        return $this->db->insert_id(); 
        
    } */
    
    function update_settings($args=array()){
        
        $ID = 1; 
        $this->db->db_select();
        $this->db->where('ID',$ID);
        $this->db->update($this->fixidb->settings, $args);

        return $this->db->affected_rows();   
     }
     
    function get_settings(){ 
        
        
        $ID = 1;
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->settings." WHERE ID='".$ID."' LIMIT 1");
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
    
    
    
    
    
    
     
     
}
  
?>

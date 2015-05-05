<?php
  class Export_excel extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('course');    
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication'); 
      $this->load->model('student_data','', TRUE); 	 
      $this->load->model('staff','', TRUE);
      $this->load->library('php_excel_class');  	  
  }

public function index(){

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');  
	    $data['message']        =   "";


				
				
				$sql = str_replace("PERCENTMASUM888","%",$this->session->userdata('search_sql'));

				$output = array();
				$output = $this->student_data->getExportExcelData($sql);        		

			    $date = date('F-j-Y');
			    $xls = new Excel_XML('UTF-8', false, 'Student Search Result - '.$date);
			    $xls->addArray($output['export_excel_arr']);
			    $xls->generateXML('student-search-result_'.$date);           		
          		
          		
     
    if(!empty($varsessioncheck_id)){
            

        
    }else{
        redirect('/logout/'); 
    }
    
     
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       
} // end of index
   
}  
  
?>
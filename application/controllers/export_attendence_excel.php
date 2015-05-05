<?php
  class Export_attendence_excel extends CI_Controller {   
    
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
        $this->load->model('fixidb','',TRUE);
        $this->load->model('student_data','',TRUE);
        $this->load->model('register','',TRUE);
        $this->load->model('student_information','',TRUE);
        $this->load->model('student_assign_class','',TRUE);
        $this->load->model('class_plan','',TRUE);
        $this->load->model('course_relation','',TRUE);
        $this->load->model('attendance','',TRUE); 
        $this->load->model('course','',TRUE); 
        $this->load->model('status','',TRUE);                         
      $this->load->model('attendence_report','', TRUE);   	  
  }

public function index(){

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');  
	    $data['message']        =   "";


        //var_dump($this->session->userdata("report_management_student_search"));
        
            $sesData = $this->session->userdata("report_management_student_search");
            $terms = $sesData['terms'];
            $data['terms'] = $terms;        
        
        
        $this->attendence_report->semester_id	=	$terms["semester_id"];
        $this->attendence_report->status_id		=	$terms["student_admission_status_for_staff"];    	

				
				$sql = str_replace("PERCENTMASUM888","%",$this->session->userdata('search_sql'));

				$output = array();
				$output = $this->attendence_report->get_attendence_ExportExcelData();        		
                
			    $date = date('F-j-Y');
			    
			    $xls = new Excel_XML('UTF-8', true, 'Attendence Result - '.$date);
			    $xls->addArray($output['export_excel_arr']);
			    $xls->generateXML('student-attendence-result_'.$date);           		
          		
          		
     
    if(!empty($varsessioncheck_id)){
            

        
    }else{
        redirect('/logout/'); 
    }
    
     
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       
} // end of index
   
}  
  
?>
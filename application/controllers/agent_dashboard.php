<?php
  
class Agent_dashboard extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      
      $this->load->model('semister');          
      $this->load->model('settings');          
      $this->load->model('archive');          
      $this->load->model('course');          
      $this->load->model('course_relation');          
      $this->load->model('agent');              
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');        
      $this->load->model('student_data');
      $this->load->model('student_upload');
      $this->load->model('notes');
      $this->load->model('staff','', TRUE);
      $this->load->model('staff_upload','', TRUE);
      $this->load->model('awarding_body','', TRUE);
      $this->load->model('login','', TRUE);          
         
}

public function index(){

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');   
        $data['settings']       =   $this->settings->get_settings();  
	    $data['message']        =   "";
        $data['bodytitle']      =   "Students Applications";
        $data['breadcrumbtitle']=   "Dashboard > Students Applications";
        $data['faicon']         =   "fa-users"; 

   
    	$action                 = $this->input->get('action');
    	$page                   = $this->input->get('page'); 
    	$id                     = $this->input->get('id');
        $do 					= $this->input->get('do');   
        $student_data           = array();
        $data['semester_list']  = $this->semister->get_all();
        $data['agent_list']     = $this->agent->get_by_status();
        $data['status_list']    = array("Submitted","Review","Awaiting Documents","Processing","Accepted","Rejected","Discarded");

            
        /* Start Set the applicaton data into session for archive set */
        if($action=="singleview" && $do == "application") {
            $student_data["studen_prev_info"] = $this->student_data->get_studentdata_for_edit($id);
            $this->session->set_userdata($student_data);
        }        
        /* End Set the applicaton data into session for archive set */        
        
        if($action=="search" && empty($page)){
			
			$terms = array();
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id"){$$k=tinymce_encode($v); $terms[$k] = $$k;}
			}
			$terms['agent_id'] = $this->session->userdata('uid');

		    $sesData['student_admission_search']['terms'] = $terms;
		    $this->session->set_userdata($sesData);			
			
			
        }else if($action=="singleview"){
			
            if($do=="application"){
              
              /* Start of posting data */ 
                if($_POST){


                    
                } /* End of post data */ 
                
            }
		   
		   
		   			
        } /* End of edit action part */
     
             
     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="all" || $action=="search")) {
            
            

        $data['ref'] = 'search';
		$data['ref_id'] = "";        
      
        if($action=="all" && !$_POST){
		
			$data['result']=$this->student_data->makeStudentListWithpagination("all_for_agent",$page,base_url()."index.php/agent_dashboard/?action=".$action,"yes");	
			
        }else if(($action!="all" && $action=="search")  || ($_POST && $this->input->post('ref')=="search")){
        	 
        	 $sesData = $this->session->userdata("student_admission_search");
        	 $terms = $sesData['terms'];
			
			$data['result']=$this->student_data->makeStudentListWithpagination($terms,$page,base_url()."index.php/agent_dashboard/?action=search","yes");
        }

            
        $this->load->view('agent/dashboard_header',$data);    
        $this->load->view('agent/dashboard_topmenu');
        $this->load->view('agent/dashboard_sidebar');
        $this->load->view('agent/student_admission_search_body');
        $this->load->view('agent/other_footer'); 

	}else if(!empty($varsessioncheck_id) && ($action=="singleview")) {
		

        $data['ref_id'] = $id;
           
            
            $data['bodytitle']       =   "Admission Details";
            $data['faicon']          =   "fa-eye";
            $data['breadcrumbtitle'] =   "Dashboard > Students Admission > Admission Details";
            $data['ref']             =   'edit';
            
        	$data["course_lists"]  =   $this->course_relation->get_by_current_date();
            $semister_list = $this->semister->get_all();
            foreach($semister_list as $v){
				$data["semesterlist"][$v['id']] = $v['semister_name'];		
            }
             
 
                      
        	$std_data                = $this->student_data->get_studentdata_for_edit($id);
  
  			foreach($std_data as $k=>$v){
				$data['user_data'][$k] = addslashes(tinymce_decode($v));				
  			}
            
            $data['admission_status']   = $this->student_data->get_user_admission_status($id);			
        	$data['ref']                = 'edit';
        	$data['fullname']           = $this->student_data->get_fullname_by_ID($id);
	
	        $this->load->view('agent/dashboard_header',$data);    
	        $this->load->view('agent/dashboard_topmenu');
	        $this->load->view('agent/dashboard_sidebar');
	        $this->load->view('agent/student_admission_search_body');
	        $this->load->view('agent/student/body_form');
	        $this->load->view('agent/other_footer');						
		

		
 
           
	}else{
        redirect('/logout/'); 
    }
    
    
       
} // end of index
   
}  
  
?>
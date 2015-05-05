<?php
  
class Signatory_management extends CI_Controller {   
    
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
      $this->load->model('signatory_set','', TRUE); 	  
}

public function index(){

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');  
	    $data['message']        =   "";

        //////////////////////////////////////////////////////        
        /// get staff access
        if($this->session->userdata('label')=="staff"){
                  $staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));

                  if(!empty($staff_access['staff_privileges']['signatory_management']) && count($staff_access['staff_privileges']['signatory_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['signatory_management'];                
                  else{ $priv[0] = ""; $priv[1] = ""; $priv[2] = ""; $priv[3] = ""; }

                                  
        }        
        /////////////////////////////////////////////////////

    // alert count part
    
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;
    
    
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    
    // alert count part end


    
    	$action = $this->input->get('action'); 
    	$id = $this->input->get('id');

 
        
        if($this->input->post('ref')=="edit"){
			
			$id = $this->input->post('ref_id');
			$args['id'] = $id;
			foreach($this->input->post() as $k=>$v){
				
				if($k=="name" || $k=="post" || $k=="sign_url"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
			}
			$insertedid=$this->signatory_set->update($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Signatory has been successfully updated. </div>";	   
	       	   
		   }
			
			
        }else if($this->input->post('ref')=="add"){
			
			
			foreach($this->input->post() as $k=>$v){
				
				if($k=="name" || $k=="post" || $k=="sign_url"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
			}
			$insertedid=$this->signatory_set->add($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Signatory has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
            
        $data['bodytitle']       =   "Signatory Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > Letter Management > Signatory Management";             

        $data['signatory_list'] = $this->signatory_set->get_all();
        
            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/letter_management/signatory_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	}else if(!empty($varsessioncheck_id) && $action=="add" && ( !empty($priv[1]) || $this->session->userdata('label')=="admin" )){

        $data['bodytitle']       =   "Signatory Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > Letter Management > Signatory Management";
	
        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/letter_management/signatory_body_form');
        $this->load->view('staff/other_footer');

	
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && ( !empty($priv[2]) || $this->session->userdata('label')=="admin" )){       
           
        $data['bodytitle']       =   "Signatory Management";
        $data['faicon']          =   "fa-book";
        $data['breadcrumbtitle'] =   "Dashboard > Letter Management > Signatory Management";
        
        $data['signatory'] = $this->signatory_set->get_by_ID($id);
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['signatory']['id'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/letter_management/signatory_body_form');
        $this->load->view('staff/other_footer');
	
	}else if(!empty($varsessioncheck_id) && $label=="student" ){
	    redirect('/user_dashboard/');
	}else if(!empty($varsessioncheck_id) && $label=="registered" ){
	    redirect('/student_dashboard/');        
    }else{
        redirect('/logout/'); 
    }
    
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       
} // end of index
   
}  
  
?>
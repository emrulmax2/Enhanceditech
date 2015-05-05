<?php
  
class Letter_management extends CI_Controller {   
    
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
      $this->load->model('letter_set','', TRUE); 	  
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

                  if(!empty($staff_access['staff_privileges']['letter_management']) && count($staff_access['staff_privileges']['letter_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['letter_management'];                
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
			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id") $args[$k] = $v;//tinymce_encode($v);
			}
      $args['id'] = $id;
      		//$args['description'] = str_replace("\r\n","",$args['description']);
      		$args['description'] = stripcslashes(html_entity_decode(htmlentities($args['description'], ENT_QUOTES, 'UTF-8')));
			$insertedid=$this->letter_set->update($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Letter has been successfully updated. </div>";	   
	       	   
		   }
			
			
         }else if($this->input->post('ref')=="add"){
			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id"){ $$k = tinymce_encode($v); $args[$k] = str_replace("\r\n","",$$k); }
			}
			//$args['description'] = str_replace("\r\n","",$args['description']);
			$args['description'] = stripcslashes(html_entity_decode(htmlentities($args['description'], ENT_QUOTES, 'UTF-8')));
			$insertedid=$this->letter_set->add($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Letter has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
            
        $data['bodytitle']       =   "Letter Management";
        $data['faicon']          =   "fa-envelope-o ";
        $data['breadcrumbtitle'] =   "Dashboard > Letter Management > Letter";             

        $data['letter_list'] = $this->letter_set->get_all();
        
            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/letter_management/letter_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	}else if(!empty($varsessioncheck_id) && $action=="add" && ( !empty($priv[1]) || $this->session->userdata('label')=="admin" )){

        $data['bodytitle']       =   "Letter Management";
        $data['faicon']          =   "fa-envelope-o ";
        $data['breadcrumbtitle'] =   "Dashboard > Letter Management > Letter";
	
        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/letter_management/letter_body_form');
        $this->load->view('staff/other_footer');

	
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL  && ( !empty($priv[2]) || $this->session->userdata('label')=="admin" )){       
           
        $data['bodytitle']       =   "Letter Management";
        $data['faicon']          =   "fa-envelope-o ";
        $data['breadcrumbtitle'] =   "Dashboard > Letter Management > Letter";
        
        $data['letter'] = $this->letter_set->get_by_ID($id);

        //var_dump($data['letter']); die();
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['letter']['id'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/letter_management/letter_body_form');
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
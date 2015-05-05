<?php
  
class Agent_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('course');    
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');        
      $this->load->model('agent'); 
      $this->load->model('student_data','', TRUE); 	 
      $this->load->model('staff','', TRUE); 	  
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
		  		if(!empty($staff_access['staff_privileges']['agent_management']) && count($staff_access['staff_privileges']['agent_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['agent_management'];				
		        else{ $priv[0] = "";$priv[1] = "";$priv[2] = "";$priv[3] = ""; }

		  					
		}
        // $priv[0] = List ; $priv[1] = Add ; $priv[2] = Edit ; $priv[3] = Delete ; 	    
	    /////////////////////////////////////////////////////	    
    
	    
    // alert count part
    
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;
    
    
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    
    // alert count part end


    
    	$action = $this->input->get('action'); 
    	$id = $this->input->get('id');

 
        
        if($this->input->post('ref')=="edit" && (!empty($priv[2]) || $this->session->userdata('label')=="admin") ){
			
			$pass_change_on 	= FALSE;
			$pass_encrypt 		= "SHA1";
			$id 				= $this->input->post('ref_id');
			 $args['id'] 		= $id;
			 
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="repassword") $args[$k] = tinymce_encode($v);
				
			}
			$args['last_login_datetime'] = date("Y-m-d h:i:s", time()); 
			$args['last_login_ip'] = "";   
			
			if($args['password']!=""){
				$pass_change_on 	= TRUE;
				$pass_encrypt 		= "MD5";     
				
			}
			
			$insertedid=$this->agent->update($args,$pass_change_on,$pass_encrypt);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> agent has been successfully updated. </div>";	   
	       	   
		   }
			
			
        }else if($this->input->post('ref')=="add"  && (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){
			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="repassword" ){ $args[$k] = tinymce_encode($v); }
			}
			$args['last_login_datetime'] = date("Y-m-d h:i:s", time());   
			$args['last_login_ip'] = "";   
			$insertedid			=	$this->agent->add($args,"MD5");
	       $data['error']		=	0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Agent has been successfully added. </div>";	   
	       	   
		   }			
        }
     

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") ) {
            
        $data['bodytitle']       =   "Agent Management";
        $data['faicon']          =   "fa-paw";
        $data['breadcrumbtitle'] =   "Dashboard > Agent Management";            

        $data['agent_list'] = $this->agent->get_all();
        
        //var_dump($data['agent_list']);
            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/agent_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	} else if(!empty($varsessioncheck_id) && $action=="add"  && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){


        $data['bodytitle']       =   "Agent Management";
        $data['faicon']          =   "fa-paw";
        $data['breadcrumbtitle'] =   "Dashboard > Agent Management";
	
        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/agent_body_form');
        $this->load->view('staff/other_footer');

	
	} else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($priv[2]) || $this->session->userdata('label')=="admin")){       
           
        $data['bodytitle']       =   "Agent Management";
        $data['faicon']          =   "fa-paw";
        $data['breadcrumbtitle'] =   "Dashboard > Agent Management";
        
        $data['agent'] = $this->agent->get_by_ID($id);
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['agent']['id'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/agent_body_form');
        $this->load->view('staff/other_footer');
 
    } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
        redirect('/admin_dashboard/'); 
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
<?php
  
class Settings_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('settings');     
      $this->load->helper('functions');     
      $this->load->library('session');  
      $this->load->helper('form');   
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication');
      $this->load->model('student_data','', TRUE); 	 
      $this->load->model('staff','', TRUE);         
      $this->load->model('currency','', TRUE);         
      $this->load->model('campus_info','', TRUE);         
	}

public function index(){

    $data=array();
    $varsessioncheck_id=$this->session->userdata('uid');

    $label=$this->session->userdata('label');        
    
    $data['message']="";
    

    // alert count part
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;  
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    // alert count part end

    $data['currency_list']        = $this->currency->get_all();
    
      
    $action = $this->input->get('action'); $id = $this->input->get('id');
      
      if($_POST)
      { 
        if($this->input->post('ref')=="edit"){
			
    			$id = $this->input->post('ref_id');
    			
    			foreach($this->input->post() as $k=>$v){
    				
    				if($k!="ref" && $k!="ref_id" && $k!="campus_name" && $k!="campus_address" && $k!="campus_id") {
              $$k=tinymce_encode($v);$args[$k] = $$k;
            } elseif($k=="campus_name") {
              $campus_name[] = $v;
            } elseif($k=="campus_address") {
              $campus_address[] = $v;
            } elseif($k=="campus_id") {
              $campus_id[] = $v;
            }

    			}
          // var_dump($args);
          // var_dump($campus_name);
          // var_dump($campus_id);
          // die();
          $campus_insert = array();
          if(!empty($campus_name[0])) {
            foreach ($campus_name[0] as $key => $value) {            
                $campusinfo = array();
                $campusinfo['name']     = $value;
                $campusinfo['address']  = $campus_address[0][$key];
                if (isset($campus_id[0][$key]) && ($campus_id[0][$key] != "") ) {
                  $campusinfo['id']       = $campus_id[0][$key];
                  $campus_insert[] = $this->campus_info->update($campusinfo);
                } else {
                  $campus_insert[] = $this->campus_info->add($campusinfo); 
                }
                
            }   
                         
          }
          



    			$args['start_date']     =   date('Y-m-d',strtotime($start_date));
    			$args['end_date']       =   date('Y-m-d',strtotime($end_date));
    			$insertedid             =   $this->settings->update_settings($args,$id);
                
    	       $data['error']=0; 
    	       if($insertedid || ( !empty($campus_name[0]) && count($campus_insert) == count($campus_name[0]) ) ){
    	       		
    	       		$data['message'] = "<div class='alert alert-success'> Settings has been successfully updated. </div>";	   
    	       	   
    		   }
			
			
        }
     
      }
     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")&& $label == "admin" || $label == "staff"){


          
        $data['ref'] = 'edit';
		$data['ref_id'] = "1";    
            
         $data['campus_info'] = $this->campus_info->get_all();
        //var_dump($data['campus_info']); die();
        
        $data['settings'] = $this->settings->get_settings();

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('settings_body_form');
        $this->load->view('staff/other_footer'); 

        
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && $label == "admin"){       
       
        $data['settings'] = $this->settings->get_settings();
        $data['campus_info'] = $this->campus_info->get_all();
        var_dump($data['campus_info']); die();
        $data['ref'] = 'edit';
        $data['ref_id'] = "1";
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('settings_body_form');
        $this->load->view('staff/other_footer');
        
    } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
        redirect('/admin_dashboard/'); 
	}else if(!empty($varsessioncheck_id) && $label=="student" ){
	    redirect('/user_dashboard/');
	}else if(!empty($varsessioncheck_id) && $label=="registered" ){
	    redirect('/student_dashboard/'); 
    } else {
        redirect('/logout/');
    }
    
    
       
} // end of index
   
}  
  
?>
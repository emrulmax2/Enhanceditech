<?php
  
class Masterinbox_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
      $this->load->model('student_data','', TRUE);     
      $this->load->model('agent','', TRUE);     
      $this->load->model('course_relation','', TRUE);     
      $this->load->model('course','', TRUE);     
      $this->load->model('semister','', TRUE);     
      $this->load->model('awarding_body','', TRUE);     
      $this->load->model('lcc_inbox','', TRUE);     
      $this->load->model('lcc_communication','', TRUE);     
      $this->load->model('staff','', TRUE);     
    
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('dashboard');                  
}

public function index(){

    $data                   =   array(); 
    $menuleft               =   array();
    $data["statements"]     =   array();
    $varsessioncheck_id     =   $this->session->userdata('uid');

    $label                  =   $this->session->userdata('label');    
        
    $data["fullname"]       =   $this->session->userdata('fullname');        
    $data["student_email"]  =   $this->session->userdata('username'); 
    $data['bodytitle']        =    "Master Inbox";
    $data['breadcrumbtitle']=    "Dashboard > Master Inbox";
    $data['faicon']            =    "fa-envelope";    
    $data['message']        =   "";
    
    
    $action                 = $this->input->get('action'); 
    $id                     = $this->input->get('id');     
     
    $data['settings']        = $this->settings->get_settings(); 
    $data["agent_list"]     = $this->agent->get_all();
    
    // alert count part
    
    $data["alert_count"]                =   0;
    $data["inbox_alert_count"]          =   0;
    
    
    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    
    // alert count part end
    
    // Start of post part
     if($_POST) {
         
         $inbox_mark    = $this->input->post('inbox_action'); 
         $ids            = $this->input->post('selectAll'); 
         if(!isset($_POST["restore"]))
         {
          if(isset($inbox_mark) && $inbox_mark!="") {
             $is_trash =0;
             
            if($inbox_mark=="mark_read")        $checked    =   "yes";
            else if($inbox_mark=="mark_unread") $checked    =   "no";
            else if($inbox_mark=="mark_trash")  $is_trash    =   1;
            else if($inbox_mark=="mark_restore")  $is_trash    =   0;
            if($is_trash==0 && isset($checked)) {
            foreach($ids as $id):
            
            $args           =   array("id"=>$id,"notification_checked"=>$checked);
            $affectedrow    =   $this->lcc_inbox->update($args); 
            
            if(isset($affectedrow) && $affectedrow ==TRUE) {
                $data['message'] = set_fixi_notification("Inbox updated successfully.","success");
            } else {
                $data['message'] =set_fixi_notification("Inbox can't update successfully.","warning");
            }
            endforeach;
            } else if($inbox_mark=="mark_trash") {
               
             
             foreach($ids as $id):
             $args           =   array("id"=>$id,"is_trash"=>$is_trash);
             $affectedrow    =   $this->lcc_inbox->update($args);   
             
            if(isset($affectedrow) && $affectedrow ==TRUE) {
                
                    $data['message'] = set_fixi_notification("Mail move to trash.","success");
                
                } else {
                
                    $data['message'] =set_fixi_notification("Mail can't move to trash.","warning");
            
                } 
               endforeach;            
                          
            } else if($inbox_mark=="mark_restore") {
               
             
             foreach($ids as $id):
             $args           =   array("id"=>$id,"is_trash"=>$is_trash);
             $affectedrow    =   $this->lcc_inbox->update($args);   
             
            if(isset($affectedrow) && $affectedrow ==TRUE) {
                
                    $data['message'] = set_fixi_notification("Mail move to inbox.","success");
                
                } else {
                
                    $data['message'] =set_fixi_notification("Mail can't move to inbox.","warning");
            
                } 
               endforeach;            
                          
            }
         }
         } else if(isset($_POST["restore"])) {
           $done =0;
                $inbox = $this->lcc_inbox->get_by_staff_ID($varsessioncheck_id);  

                  foreach ($inbox as $inbox_row) {
                        $args       =   array("id"=>$inbox_row["id"],"is_trash"=>0);

                        $del        =   $this->lcc_inbox->update($args); 
                        if($del!=FALSE){
                            $done =1;
                        }
                                    
                  }
                  
                  if(isset($done) && $done !=0) 
                        {                
                            $data['message'] = set_fixi_notification("Trash restore successfully.","success");
                    
                        } else {
                    
                            $data['message'] =set_fixi_notification("Trash can not restore successfully.","warning");
                
                        }    
                
                    
            
         }     
     }
     
     // END of post part  
     
      
    if(!empty($varsessioncheck_id) && ($label == "staff" || $label == "admin") && $action==Null){

  
        $data['user_data'] = $this->student_data->get_userinfo_by_ID($varsessioncheck_id); 

        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/inbox/masterinbox_view');
        $this->load->view('other_footer'); 

          
        
    }else if(!empty($varsessioncheck_id) && ($label == "staff" || $label == "admin") && $action=="trash"){


        $data["inbox"] = $this->lcc_inbox->get_trash_by_staff_ID($varsessioncheck_id);  
        $data["communication"]= $this->lcc_communication->get_by_staff_ID($varsessioncheck_id);              
            
            
        $data['user_data'] = $this->student_data->get_userinfo_by_ID($varsessioncheck_id); 

        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/inbox/trash_view');
        $this->load->view('other_footer'); 

          
        
    }else if(!empty($varsessioncheck_id) && ($label == "staff" || $label == "admin") && $action=="details"){


   
        $data["inbox"] = $this->lcc_inbox->get_by_staff_ID($varsessioncheck_id);  
        $data["communication"]= $this->lcc_communication->get_by_staff_ID($varsessioncheck_id);                  
            
            
        $data['user_data'] = $this->student_data->get_userinfo_by_ID($varsessioncheck_id); 

        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/inbox/inbox_details');
        $this->load->view('other_footer'); 

          
        
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
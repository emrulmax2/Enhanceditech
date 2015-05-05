<?php
  
class Course_relation_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();

     
      $this->load->model('login','', TRUE);     
  
      $this->load->helper('functions');      
      $this->load->helper('form');      
      $this->load->library('session');        
      $this->load->model('semister');
      $this->load->model('course');
      $this->load->model('course_relation');
      $this->load->model('awarding_body');
      $this->load->model('lcc_inbox');          
      $this->load->model('lcc_communication'); 
      $this->load->model('student_data','', TRUE); 	 
      $this->load->model('staff','', TRUE);
      $this->load->model('slc_coursecode','', TRUE);      
      $this->load->model('hesa_unitlgth','', TRUE);      
      $this->load->model('hesa_mstufee','', TRUE);      
      $this->load->model('hesa_course_relation_instance','', TRUE);      
      $this->load->model('hesa_course_relation_unitlgth','', TRUE);	  
      
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
		  		if(!empty($staff_access['staff_privileges']['course_relation_management']) && count($staff_access['staff_privileges']['course_relation_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['course_relation_management'];				
		        else{ $priv[0] = "";$priv[1] = "";$priv[2] = "";$priv[3] = ""; }
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

 
        
        if($this->input->post('ref')=="edit" && (!empty($priv[2]) || $this->session->userdata('label')=="admin") ){
			
			$id = $this->input->post('ref_id');


			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="hesa_unitlgth_id" && $k!="hesa_mstufee_id" && $k!="instance_start_date" && $k!="instance_end_date"){ $$k = tinymce_encode($v); if(!empty($$k)) $args[$k] = $$k; }
                else if($k=="instance_start_date" || $k=="instance_end_date" || $k=="hesa_unitlgth_id" || $k=="hesa_mstufee_id"){
                    $$k = $v;

                }
			}

			if (isset($args['course_id'])) {
				$course_relation_check = $this->course_relation->get_ID_by_course_ID_semester_ID($args['course_id'], $args['semester_id']);
				//var_dump($course_relation_check); die();
			}

			if($course_relation_check == $id) {
                
                if(!empty($instance_start_date) && !empty($instance_end_date)){
                    
                    
                    $this->db->query("DELETE FROM ".$this->fixidb->hesa_course_relation_instance." WHERE course_relation_id='".$id."'");
                    for($i=0;$i<count($instance_start_date);$i++){
                        $hesa_course_relation_instance_arr = array();    
                        $hesa_course_relation_instance_arr['course_relation_id'] = $id;
                        $hesa_course_relation_instance_arr['start_date'] = date("Y-m-d",strtotime($instance_start_date[$i]));
                        $hesa_course_relation_instance_arr['end_date'] = date("Y-m-d",strtotime($instance_end_date[$i]));
                        $this->hesa_course_relation_instance->add($hesa_course_relation_instance_arr);                         
                    }                    
                }
                
                if(!empty($hesa_unitlgth_id)){
                    $this->db->query("DELETE FROM ".$this->fixidb->hesa_course_relation_unitlgth." WHERE course_relation_id='".$id."'");
                    $hesa_course_relation_unitlgth = array();
                    $hesa_course_relation_unitlgth['course_relation_id'] = $id;
                    $hesa_course_relation_unitlgth['hesa_unitlgth_id'] = $hesa_unitlgth_id;
                    $hesa_course_relation_unitlgth['hesa_mstufee_id'] = $hesa_mstufee_id;
                    $this->hesa_course_relation_unitlgth->add($hesa_course_relation_unitlgth);
                }                 
			
				if(!empty($args["admission_startdate_1"])) $args["admission_startdate_1"] = date("Y-m-d",strtotime($args["admission_startdate_1"]));
				if(!empty($args["admission_startdate_2"])) $args["admission_startdate_2"] = date("Y-m-d",strtotime($args["admission_startdate_2"]));
				if(!empty($args["admission_enddate_1"])) $args["admission_enddate_1"] = date("Y-m-d",strtotime($args["admission_enddate_1"]));
				if(!empty($args["admission_enddate_2"]))$args["admission_enddate_2"] = date("Y-m-d",strtotime($args["admission_enddate_2"]));
				if(!empty($args["class_startdate_1"])) $args["class_startdate_1"] = date("Y-m-d",strtotime($args["class_startdate_1"]));
				if(!empty($args["class_startdate_2"])) $args["class_startdate_2"] = date("Y-m-d",strtotime($args["class_startdate_2"]));
				if(!empty($args["class_enddate_1"])) $args["class_enddate_1"] = date("Y-m-d",strtotime($args["class_enddate_1"]));
				if(!empty($args["class_enddate_2"])) $args["class_enddate_2"] = date("Y-m-d",strtotime($args["class_enddate_2"]));
				if(!empty($args["last_joiningdate_1"])) $args["last_joiningdate_1"] = date("Y-m-d",strtotime($args["last_joiningdate_1"]));
				if(!empty($args["last_joiningdate_2"])) $args["last_joiningdate_2"] = date("Y-m-d",strtotime($args["last_joiningdate_2"]));
				if(!empty($args["fees_1"]) && $args["fees_1"]=="") $args["fees_1"]=0; if(!empty($args["reg_fees_1"]) && $args["reg_fees_1"]=="") $args["reg_fees_1"]=0;
				if(!empty($args["fees_2"]) && $args["fees_2"]=="") $args["fees_2"]=0; if(!empty($args["reg_fees_2"]) && $args["reg_fees_2"]=="") $args["reg_fees_2"]=0;
							
		       for ($i=1; $i <= $duration; $i++) {
					unset($args['slc'.$i]);
					unset($args['year'.$i]);
					unset($args['yearid'.$i]);
				}
				$insertedid=$this->course_relation->update($args,$id);
		       $data['error']=0;


		       $duration = $this->input->post('duration');
	            if($available!="overseas"){
					for ($i=1; $i <= $duration; $i++) {

	        			$args2 = array();
						$args2['id'] 					= $this->input->post("yearid".$i);
						$args2['slc_code'] 				= $this->input->post("slc".$i);
						$args2['year'] 					= $this->input->post("year".$i);

						$check = $this->slc_coursecode->get_by_ID($this->input->post("yearid".$i));
						if(!empty($check)) {
							$new_insertedid[]=$this->slc_coursecode->update($args2);
							
						} else {
							unset($args2['id']);
							$args2['course_relation_id'] 	= $id;
							$new_insertedid[]=$this->slc_coursecode->add($args2);
						}
	        		}
				}//----if($available!="overseas"){
		       if($insertedid || !empty($new_insertedid) ){
		       		
		       		
		       		$this->session->set_flashdata('message', "<div class='alert alert-success'> Course relation has been successfully added. </div>");
		       		redirect(base_url()."index.php/course_relation_management/?action=edit&id=".$this->input->get('id'));   
		       	   
			   }
			} else {
				$this->session->set_flashdata('message', "<div class='alert alert-warning'> Course relation already exists. </div>");
		       		redirect(base_url()."index.php/course_relation_management/?action=edit&id=".$this->input->get('id')); 
			}
			
			
        }else if($this->input->post('ref')=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){

			
			foreach($this->input->post() as $k=>$v){
				
				if($k!="ref" && $k!="ref_id" && $k!="hesa_unitlgth_id" && $k!="hesa_mstufee_id" && $k!="instance_start_date" && $k!="instance_end_date")
				{ 
					$$k = tinymce_encode($v); if(!empty($$k)) $args[$k] = $$k;
                     
				}else if($k=="instance_start_date" || $k=="instance_end_date" || $k=="hesa_unitlgth_id" || $k=="hesa_mstufee_id"){
                    
                    $$k = $v;

                }

			}
			//var_dump($args); die();
			if (isset($args['course_id'])) {
				$course_relation_check = $this->course_relation->get_ID_by_course_ID_semester_ID($args['course_id'], $args['semester_id']);
				//var_dump($course_relation_check); die();
			}

			if($course_relation_check==false) {
			
				if(!empty($args["admission_startdate_1"])) $args["admission_startdate_1"] = date("Y-m-d",strtotime($args["admission_startdate_1"]));
				if(!empty($args["admission_startdate_2"])) $args["admission_startdate_2"] = date("Y-m-d",strtotime($args["admission_startdate_2"]));
				if(!empty($args["admission_enddate_1"])) $args["admission_enddate_1"] = date("Y-m-d",strtotime($args["admission_enddate_1"]));
				if(!empty($args["admission_enddate_2"]))$args["admission_enddate_2"] = date("Y-m-d",strtotime($args["admission_enddate_2"]));
				if(!empty($args["class_startdate_1"])) $args["class_startdate_1"] = date("Y-m-d",strtotime($args["class_startdate_1"]));
				if(!empty($args["class_startdate_2"])) $args["class_startdate_2"] = date("Y-m-d",strtotime($args["class_startdate_2"]));
				if(!empty($args["class_enddate_1"])) $args["class_enddate_1"] = date("Y-m-d",strtotime($args["class_enddate_1"]));
				if(!empty($args["class_enddate_2"])) $args["class_enddate_2"] = date("Y-m-d",strtotime($args["class_enddate_2"]));
				if(!empty($args["last_joiningdate_1"])) $args["last_joiningdate_1"] = date("Y-m-d",strtotime($args["last_joiningdate_1"]));
				if(!empty($args["last_joiningdate_2"])) $args["last_joiningdate_2"] = date("Y-m-d",strtotime($args["last_joiningdate_2"]));
				if(!empty($args["fees_1"]) && $args["fees_1"]=="") $args["fees_1"]=0; if(!empty($args["reg_fees_1"]) && $args["reg_fees_1"]=="") $args["reg_fees_1"]=0;
				if(!empty($args["fees_2"]) && $args["fees_2"]=="") $args["fees_2"]=0; if(!empty($args["reg_fees_2"]) && $args["reg_fees_2"]=="") $args["reg_fees_2"]=0;

				for ($i=1; $i <= $duration; $i++) {
					unset($args['slc'.$i]);
					unset($args['year'.$i]);
				}
							

				$insertedid=$this->course_relation->add($args);
                
                /// add to hesa_course_relation_instance
                
                if(!empty($instance_start_date) && !empty($instance_end_date)){
                                        
                    $this->db->query("DELETE FROM ".$this->fixidb->hesa_course_relation_instance." WHERE course_relation_id='".$insertedid."'");
                    
                    for($i=0;$i<count($instance_start_date);$i++){
                        $hesa_course_relation_instance_arr = array();    
                        $hesa_course_relation_instance_arr['course_relation_id'] = $insertedid;
                        $hesa_course_relation_instance_arr['start_date'] = date("Y-m-d",strtotime($instance_start_date[$i]));
                        $hesa_course_relation_instance_arr['end_date'] = date("Y-m-d",strtotime($instance_end_date[$i]));
                        $this->hesa_course_relation_instance->add($hesa_course_relation_instance_arr);                         
                    }                    
                }
                
                if(!empty($hesa_unitlgth_id)){
                    $this->db->query("DELETE FROM ".$this->fixidb->hesa_course_relation_unitlgth." WHERE course_relation_id='".$insertedid."'");
                    $hesa_course_relation_unitlgth = array();
                    $hesa_course_relation_unitlgth['course_relation_id'] = $insertedid;
                    $hesa_course_relation_unitlgth['hesa_unitlgth_id'] = $hesa_unitlgth_id;
                    $hesa_course_relation_unitlgth['hesa_mstufee_id'] = $hesa_mstufee_id;
                    $this->hesa_course_relation_unitlgth->add($hesa_course_relation_unitlgth);
                }                
                
                

				$duration = $this->input->post('duration');

				if($available!="overseas"){
					for ($i=1; $i <= $duration; $i++) {

	        			$args2 = array();
						$args2['course_relation_id'] 	= $insertedid;
						$args2['slc_code'] 				= $this->input->post("slc".$i);
						$args2['year'] 					= $this->input->post("year".$i);

						$new_insertedid[]=$this->slc_coursecode->add($args2);
	        		}
				}



		       $data['error']=0; 
		       if( $insertedid ){
		       		
		       		$data['message'] = "<div class='alert alert-success'> Course relation has been successfully added. </div>";

		       	   
			   }
		    } else {
		    	$data['error']=1;
		    	$data['message'] = "<div class='alert alert-danger'> Course relation already exists. </div>";
		    }			
        }
     

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") ){
            
        $data['bodytitle']       =   "Course Relation Management";
        $data['faicon']          =   "fa-share-alt";
        $data['breadcrumbtitle'] =   "Dashboard > Course Relation Management";            
 
        $data['course_relation_list'] = $this->course_relation->get_all();

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/course_relation_body_list');
        $this->load->view('staff/other_footer'); 
  
           
	}else if(!empty($varsessioncheck_id) && $action=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){


        $data['bodytitle']       =   "Course Relation Management";
        $data['faicon']          =   "fa-share-alt";
        $data['breadcrumbtitle'] =   "Dashboard > Course Relation Management"; 
	
        $data['ref'] = 'add';
		$data['ref_id'] = "";
		
		
        $data['semister_list'] = $this->semister->get_all();
        $data['course_list'] = $this->course->get_all();
        $data['awarding_body_list'] = $this->awarding_body->get_all();        
        $data['hesa_unitlgth_list'] = $this->hesa_unitlgth->get_all();        
        $data['hesa_mstufee_list'] = $this->hesa_mstufee->get_all();        
        //$data['hesa_course_relation_instance_list'] = $this->Hesa_course_relation_instance->get_all();		
		
		
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/course_relation_body_form');
        $this->load->view('staff/other_footer');

	
	}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($priv[2]) || $this->session->userdata('label')=="admin") ){       

        $data['bodytitle']       =   "Course Relation Management";
        $data['faicon']          =   "fa-share-alt";
        $data['breadcrumbtitle'] =   "Dashboard > Course Relation Management"; 
           

        $data['semister_list'] = $this->semister->get_all();
        $data['course_list'] = $this->course->get_all();
        $data['awarding_body_list'] = $this->awarding_body->get_all();	        
        $data['course_relation'] = $this->course_relation->get_by_ID($id);
        $data['scl_code'] 		= $this->slc_coursecode->get_by_course_relation_id($id);
        $data['hesa_unitlgth_list'] = $this->hesa_unitlgth->get_all();
        $data['hesa_mstufee_list'] = $this->hesa_mstufee->get_all();
        $data['hesa_course_relation_instance_list'] = $this->hesa_course_relation_instance->get_by_course_relation_ID($id);
        $data['hesa_course_relation_unitlgth_data'] = $this->hesa_course_relation_unitlgth->get_by_course_relation_ID($id);
        //$data['hesa_unitlgth_list'] = $this->hesa_unitlgth->get_all();
        //var_dump($data['scl_code']); die();

		if(!empty($data['course_relation']["admission_startdate_1"])) $data['course_relation']["admission_startdate_1"] = date("d-m-Y",strtotime($data['course_relation']["admission_startdate_1"]));
		if(!empty($data['course_relation']["admission_startdate_2"])) $data['course_relation']["admission_startdate_2"]= date("d-m-Y",strtotime($data['course_relation']["admission_startdate_2"]));
		if(!empty($data['course_relation']["admission_enddate_1"])) $data['course_relation']["admission_enddate_1"]= date("d-m-Y",strtotime($data['course_relation']["admission_enddate_1"]));
		if(!empty($data['course_relation']["admission_enddate_2"])) $data['course_relation']["admission_enddate_2"]= date("d-m-Y",strtotime($data['course_relation']["admission_enddate_2"]));
		if(!empty($data['course_relation']["class_startdate_1"])) $data['course_relation']["class_startdate_1"]= date("d-m-Y",strtotime($data['course_relation']["class_startdate_1"]));
		if(!empty($data['course_relation']["class_startdate_2"])) $data['course_relation']["class_startdate_2"]= date("d-m-Y",strtotime($data['course_relation']["class_startdate_2"]));
		if(!empty($data['course_relation']["class_enddate_1"])) $data['course_relation']["class_enddate_1"]= date("d-m-Y",strtotime($data['course_relation']["class_enddate_1"]));
		if(!empty($data['course_relation']["class_enddate_2"])) $data['course_relation']["class_enddate_2"]= date("d-m-Y",strtotime($data['course_relation']["class_enddate_2"]));
		if(!empty($data['course_relation']["last_joiningdate_1"])) $data['course_relation']["last_joiningdate_1"]= date("d-m-Y",strtotime($data['course_relation']["last_joiningdate_1"]));
		if(!empty($data['course_relation']["last_joiningdate_2"])) $data['course_relation']["last_joiningdate_2"]= date("d-m-Y",strtotime($data['course_relation']["last_joiningdate_2"]));
        
        $data['ref'] = 'edit';
        $data['ref_id'] = $data['course_relation']['ID'];
           
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/course_relation_body_form');
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
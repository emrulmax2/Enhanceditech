<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Class_plan_management extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login','', TRUE);   
		$this->load->helper('functions');      
		$this->load->helper('form');      
		$this->load->library('session');            
		$this->load->model('lcc_inbox');          
		$this->load->model('lcc_communication'); 
		$this->load->model('student_data','', TRUE); 	 
		$this->load->model('staff','', TRUE); 	  
		$this->load->model('course','', TRUE); 
		$this->load->model('semister','', TRUE); 
		$this->load->model('course_relation','', TRUE); 
		$this->load->model('class_plan','', TRUE); 
		$this->load->model('semister','', TRUE); 
		$this->load->model('coursemodule','', TRUE); 
		$this->load->model('semester_plan','', TRUE); 
		$this->load->model('time_plan','', TRUE); 
		$this->load->model('room_plan','', TRUE); 
		$this->load->model('class_lists','', TRUE); 
		$this->load->model('student_assign_class','', TRUE); 
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
                  $staff_access 	= $this->login->getStaffAccess($this->session->userdata('uid'));                  
                  if(!empty($staff_access['staff_privileges']['class_plan_management']) && count($staff_access['staff_privileges']['class_plan_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['class_plan_management'];                
                  else { 	$priv[0] 	= "";
                  			$priv[1] 	= "";
                  			$priv[2] 	= "";
                  			$priv[3] 	= "";
                  			$priv[4] 	= "";
                  			$priv[5] 	= "";
                  			$priv[6] 	= "";
                  			$priv[7] 	= ""; 
                  }
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
			

        }else if($this->input->post('ref')=="add"){
			
		
			if($action=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){
			   
				foreach($this->input->post() as $k=>$v){


					if($k=="coursemodule_id"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
					else $$k = $v;
					
					
				}
				
				$num_group = count($group_name);
				$j=1; $success = 0;
				for($i=0;$i<$num_group;$i++){
					
					$semester_id 				= $this->semester_plan->get_semester_id_by_id($semester_planid[$i]);
					$course_relation_id 		= $this->course_relation->get_ID_by_course_ID_semester_ID($course_id,$semester_id);
					$args['course_relation_id'] = $course_relation_id;
					$args['group_name'] 		= $group_name[$i];
					$args['group_lebel'] 		= $group_lebel[$i];
					$args['time_planid'] 		= $time_planid[$i];
					$args['semester_planid'] 	= $semester_planid[$i];
					$args['submission_date'] 	= date("Y-m-d",strtotime($submission_date[$i]));
					$args['tutor_id'] 			= $tutor_id[$i];
					$args['room_id'] 			= $room_id[$i];
					$args['class_days']  		= serialize($class_days[$i]);
					if(isset($class_types[$i]))
					$args['class_types']  		= serialize($class_types[$i]);
					else
					$args['class_types']  		= 0;
					
					$args['group_serial']  		= $j;
					
					$chk = $this->class_plan->checkIfClassPlanExistByGroupNameAndCourseRelationIDAndCourseModuleID($group_name[$i],$course_relation_id,$coursemodule_id);
					
					if($chk==false){
						unset($args['id']);
						$insertedid=$this->class_plan->add($args);
						echo $insertedid;
					}else{
						$args['id'] = $chk;
						$insertedid=$this->class_plan->update($args);
						echo $insertedid;
					}
									
					
					 $j++;
				}
				

				$data['message'] = "<div class='alert alert-success'> Class plan has been successfully added. </div>";
	   
			}else if($action=="generate_days" && (!empty($priv[4]) || $this->session->userdata('label')=="admin")){
				
				foreach($this->input->post() as $k=>$v){

					if($k=="class_planid" || $k=="time_planid") { $$k = tinymce_encode($v); $args[$k] = $$k; }
					else  
					$$k = $v;
					
				}
				
				if(is_array($date) && count($date)>0){
						
						foreach($date as $k=>$v){
							$exp = explode("|",$v);
							
							$args['date'] = $exp[0];
							$args['type'] = $exp[1];
							$insertedid=$this->class_lists->add($args);
								
						}
						$data['message'] = "<div class='alert alert-success'> Class Lists has been successfully saved. </div>";
										
				}				
				
				
			}
		   
		   			
        }
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
	    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
	            
	        $data['bodytitle']       =   "Class Plan Management";
	        $data['faicon']          =   "fa-sitemap";
	        $data['breadcrumbtitle'] =   "Dashboard > Class Plan Management";             


	        $data['class_plan_list'] = $this->class_plan->get_all_by_active();
	        
	        
	        //var_dump($data['class_plan_list']); die();
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/class_plan_body_list');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="generate_days" && (!empty($priv[4]) || $this->session->userdata('label')=="admin")){

			if(empty($id))
			{
				redirect(base_url()."index.php/class_plan_management/");
			}
	            
	        $data['bodytitle']       =   "Class Plan Management";
	        $data['faicon']          =   "fa-sitemap";
	        $data['breadcrumbtitle'] =   "Dashboard > Class Plan Management";             


	        $data['class_plan'] = $this->class_plan->get_by_ID($id);

	        $data['ref'] = 'add';
			$data['ref_id'] = "";	        
	        
	        //var_dump($data['course_list']);
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/class_plan_generate_days_form');
	        $this->load->view('staff/other_footer'); 	         
	  
	           
		}else if(!empty($varsessioncheck_id) && $action=="add" && (!empty($priv[1]) || $this->session->userdata('label')=="admin")){

	        $data['bodytitle']       =   "Class Plan Management (Add/Edit)";
	        $data['faicon']          =   "fa-sitemap";
	        $data['breadcrumbtitle'] =   "Dashboard > Class Plan Management (Add/Edit)"; 


            if($id>""){//------------- for edit
				$data['class_plan_id_edit']	= $id;
            }
	        $data['course_list'] = $this->course->get_all();
	        $data['semister_list'] = $this->semister->get_all();
	        $data['semester_plan_list'] = $this->semester_plan->get_all();
	        $data['time_plan_list'] = $this->time_plan->get_all();
	        $data['staff_list'] = $this->staff->get_all();
	        $data['room_plan_list'] = $this->room_plan->get_all();

			
	        $data['ref'] = 'add';
			$data['ref_id'] = "";
			
			
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/class_plan_body_form');
	        $this->load->view('staff/other_footer');

		
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL && (!empty($priv[6]) || $this->session->userdata('label')=="admin")){       
	           
	        $data['bodytitle']       =   "Class Plan Management";
	        $data['faicon']          =   "fa-sitemap";
	        $data['breadcrumbtitle'] =   "Dashboard > Class Plan Management"; 
	        
	        $data['time_plan'] 		 = $this->time_plan->get_by_ID($id);
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $data['time_plan']['id'];
	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/class_plan_body_form');
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

/* End of file gender_management.php */
/* Location: ./application/controllers/registration/gender_management.php */
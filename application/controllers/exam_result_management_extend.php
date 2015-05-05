<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam_result_management_extend extends CI_Controller {

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
		$this->load->model('examresult','', TRUE); 
		$this->load->model('register','', TRUE); 
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
                  if(!empty($staff_access['staff_privileges']['exam_result_management_extend']) && count($staff_access['staff_privileges']['exam_result_management_extend'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['exam_result_management_extend'];                
                  else{ $priv[0] = "";$priv[1] = "";$priv[2] = ""; }
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

 
        
        //if($this->input->post('ref')=="edit" && (!empty($staff_privileges_course_management['course_mng_edit']) || $this->session->userdata('label')=="admin")){
        if($this->input->post('ref')=="edit"){
			
/*			$id = $this->input->post('ref_id');
			$args['id'] = $id;
			foreach($this->input->post() as $k=>$v){
				
				if($k=="start_time" || $k=="end_time"){ $$k = tinymce_encode($v); $args[$k] = date("G:i:s",strtotime($$k)); }
				else if($k!="ref" && $k!="ref_id"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
			}
			$insertedid=$this->time_plan->update($args);
	       $data['error']=0; 
	       if($insertedid){
	       		
	       		$data['message'] = "<div class='alert alert-success'> Time plan has been successfully updated. </div>";	   
	       	   
		   } */
			
			
        //}else if($this->input->post('ref')=="add"  && (!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin")){
        }else if($this->input->post('ref')=="add"){
			
		    /*
			if($action=="add"){
			   
				foreach($this->input->post() as $k=>$v){

					if($k=="course_relation_id" || $k=="coursemodule_id"){ $$k = tinymce_encode($v); $args[$k] = $$k; }
					else $$k = $v;
					
					
				}
				
				$num_group = count($group_name);
				$j=1; $success = 0;
				for($i=0;$i<$num_group;$i++){
					
					$args['group_name'] = $group_name[$i];
					$args['time_planid'] = $time_planid[$i];
					$args['semester_planid'] = $semester_planid[$i];
					$args['submission_date'] = date("Y-m-d",strtotime($submission_date[$i]));
					$args['tutor_id'] = $tutor_id[$i];
					$args['room_id'] = $room_id[$i];
					$args['class_days']  = serialize($class_days[$i]);
					$args['group_serial']  = $j;
					
					$chk = $this->class_plan->checkIfClassPlanExistByGroupNameAndCourseRelationIDAndCourseModuleID($group_name[$i],$course_relation_id,$coursemodule_id);
					//var_dump($chk);
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
	   
			}else if($action=="generate_days"){
				
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
						//var_dump($date);					
				}				
				
				
			}
		    */
		    
		    
		    
		    
		    
		   			
        }
        
        if($action=="search"){
        
        	
        	     if($_POST){
					//var_dump($_POST);			
					$terms = array();
					foreach($this->input->post() as $k=>$v){
						
						if($k!="ref" && $k!="ref_id"){  if(!empty($v)){ $$k=tinymce_encode($v); $terms[$k] = $$k; }  }
					}

					$sesData['exam_result_student_search']['terms']=array();
					$this->session->set_userdata($sesData);
					$sesData = array();
				    $sesData['exam_result_student_search']['terms'] = $terms;
				    $this->session->set_userdata($sesData);					
				
        		}	
        	
        	   $sesData   = $this->session->userdata("exam_result_student_search");
            	$terms     = $sesData['terms'];
        	    //var_dump($terms);
        	
        	
        	
        	
		}
     

     
	    //if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list") && (!empty($staff_privileges_course_management['course_mng']) || $this->session->userdata('label')=="admin")){
/*
	    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="list")){
	            
	        $data['bodytitle']       =   "Exam Result Management";
	        $data['faicon']          =   "fa-trophy";
	        $data['breadcrumbtitle'] =   "Dashboard > Exam Result Management";             


	        $data['class_plan_list'] = $this->class_plan->get_all();
	        
	        
	        //var_dump($data['course_list']);
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/class_plan_body_list');
	        $this->load->view('staff/other_footer');
	        
	        
		}else if(!empty($varsessioncheck_id) && $action=="generate_days"){
	            
	        $data['bodytitle']       =   "Exam Result Management";
	        $data['faicon']          =   "fa-trophy";
	        $data['breadcrumbtitle'] =   "Dashboard > Exam Result Management";            


	        $data['class_plan'] = $this->class_plan->get_by_ID($id);

	        $data['ref'] = 'add';
			$data['ref_id'] = "";	        
	        
	        //var_dump($data['course_list']);
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/class_plan_generate_days_form');
	        $this->load->view('staff/other_footer'); 	         
	  
	           
		}else if(!empty($varsessioncheck_id) && $action=="add"){

	        $data['bodytitle']       =   "Exam Result Management";
	        $data['faicon']          =   "fa-trophy";
	        $data['breadcrumbtitle'] =   "Dashboard > Exam Result Management"; 


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

		
		}else if(!empty($varsessioncheck_id) && $action=="edit" && $id != NULL){       
	           
	        $data['bodytitle']       =   "Exam Result Management";
	        $data['faicon']          =   "fa-trophy";
	        $data['breadcrumbtitle'] =   "Dashboard > Exam Result Management"; 
	        
	        $data['time_plan'] = $this->time_plan->get_by_ID($id);
	        
	        $data['ref'] = 'edit';
	        $data['ref_id'] = $data['time_plan']['id'];
	           
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/class_plan_body_form');
	        $this->load->view('staff/other_footer');

*/

	    if(!empty($varsessioncheck_id) && $action!="search"){
	            
	        $data['bodytitle']       =   "Exam Result Management";
	        $data['faicon']          =   "fa-trophy";
	        $data['breadcrumbtitle'] =   "Dashboard > Exam Result Management";             


	        $data['course_list'] = $this->course->get_all();
	        $data['semister_list'] = $this->semister->get_all();
	        $data['semester_plan_list'] = $this->semester_plan->get_all();
	        $data['time_plan_list'] = $this->time_plan->get_all();
	        $data['staff_list'] = $this->staff->get_all();
	        $data['room_plan_list'] = $this->room_plan->get_all();


			$sesData['exam_result_student_search']['terms']=array();
			$this->session->set_userdata($sesData);
			
	        $data['ref'] = 'add';
			$data['ref_id'] = "";
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/exam_result_extend_body_form.php');
	        $this->load->view('staff/other_footer');
	        
		}else if(!empty($varsessioncheck_id) && $action=="search"){
	            
	        $data['bodytitle']       =   "Exam Result Management";
	        $data['faicon']          =   "fa-trophy";
	        $data['breadcrumbtitle'] =   "Dashboard > Exam Result Management";             	        
	        
            $sesData   = $this->session->userdata("exam_result_student_search");
            $terms     = $sesData['terms'];
            $data['terms'] = $terms;                                               
            if(!empty($terms['group_name'])) $class_plan_list = $this->class_plan->get_by_course_relation_id_and_coursemodule_id_and_group_name($terms['course_relation_id'],$terms['coursemodule_id'],$terms['group_name']);
            else if(empty($terms['group_name'])) $class_plan_list = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($terms['course_relation_id'],$terms['coursemodule_id']);
            $reg_student_list = array();
            foreach($class_plan_list as $cp){
				$student_assign_class_list = $this->student_assign_class->get_by_class_plan_id($cp['id']);
				//if(!in_array(,$reg_student_list))
				//var_dump($student_assign_class_list);
				foreach($student_assign_class_list as $k=>$v){
					if(!in_array($v['register_id'],$reg_student_list)) $reg_student_list[] = $v['register_id'];		
				}	
            }
            //var_dump($reg_student_list);
            $data['reg_student_list'] = $reg_student_list;
            
            //var_dump($terms);			
		    //$data['result']=$this->student_data_extend->makeRegisteredStudentListWithpagination($terms,$page,base_url()."index.php/assign_student_management/?action=search","yes");	        

	        $data['course_list'] = $this->course->get_all();
	        $data['semister_list'] = $this->semister->get_all();
	        $data['semester_plan_list'] = $this->semester_plan->get_all();
	        $data['time_plan_list'] = $this->time_plan->get_all();
	        $data['staff_list'] = $this->staff->get_all();
	        $data['room_plan_list'] = $this->room_plan->get_all();

			
	        $data['ref'] = 'search';
			$data['ref_id'] = "";
	            
	        $this->load->view('staff/dashboard_header',$data);    
	        $this->load->view('staff/dashboard_topmenu');
	        $this->load->view('staff/dashboard_sidebar');
	        $this->load->view('staff/exam_result_extend_body_form.php');
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
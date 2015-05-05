<?php
class Attendence_report extends CI_Model {
     
     public $semester_id;
     public $status_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
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
        $this->load->library('session');

    } 

    protected function student_attendence_list_by_student_dataID($id) {
 	 
            $data =array ();
	        $std_data                = $this->student_data->get_studentdata_for_edit($id);
            $register_id             = $this->register->get_id_by_student_data_ID($this->input->get('id'));

            $student_assing_class_list = $this->student_assign_class->get_by_register_id($register_id);

            $data['module_set'] = array();
            foreach ($student_assing_class_list as $a => $b) {
              
              
              $course_relation_ID   = $this->class_plan->get_course_relation_id_by_id($b['class_plan_id']);
              $relation_array       = $this->course_relation->get_course_ID_semester_ID_by_ID($course_relation_ID);
              
              $course_id            = $relation_array['course_id'];
              $semester_id          = $relation_array['semester_id'];
              $module_id            = $this->class_plan->get_coursemodule_id_by_id($b['class_plan_id']);
              $attandence_array     = $this->attendance->get_attendance_list_by_register_id_and_class_plan_id($b["register_id"],$b["class_plan_id"]);

              
              if($attandence_array != NULL) {
                  foreach ($attandence_array as $attandence_row) {

                          
                          if($std_data['student_course'] == $course_id)
                          $data['module_set'][$semester_id][$module_id][] = array('attendance_date' => $attandence_row["attendance_date"],'attendance_type' =>$attandence_row["attendance_type"]);
                          
                  }         
              
              }

            }
	 return $data; 
	 
    }
    
    function get_attendence_list_by_semester(){
    	$data=array();
    	$course_relation_ids = $this->course_relation->get_course_relation_ids_by_sem($this->semester_id);
    	
    	foreach ($course_relation_ids as $cRid) {
    	 
    	 	$class_pan_ids=$this->class_plan->get_id_by_course_relation_id($cRid);
    	 	foreach ($class_pan_ids as $class_pan_id) {
    	 	
		    $attandence_array     = $this->attendance->get_attendance_by_class_plan_id($class_pan_id["id"]);
		    
		    if($attandence_array != NULL) {
                  foreach ($attandence_array as $attandence_row) {

                          
                          $registration_no			=	$this->register->get_registration_no_by_ID($attandence_row["register_id"]);
                          $sTDid					=	$this->register->get_student_data_ID_no_by_register_id($attandence_row["register_id"]);
                          if($sTDid!=NULL) {
                          $std_data                	= 	$this->student_data->get_studentdata_for_edit($sTDid);
                          $statusID                	= 	$this->student_information->get_status_by_student_data_id($sTDid);
                          if(isset($this->status_id) && $this->status_id!="")
                          {
                          	 if($this->status_id == $statusID) 
							 {
								 if(isset($data[$registration_no][$std_data["student_course"]]['P'])) {
								 if($attandence_row["attendance_type"] =="P")
								  $data[$registration_no][$std_data["student_course"]]['P'] += 1;
							     if($attandence_row["attendance_type"] =="L")
								  $data[$registration_no][$std_data["student_course"]]['L'] +=1;
							     if($attandence_row["attendance_type"] =="A")
								  $data[$registration_no][$std_data["student_course"]]['A'] +=1;
							     if($attandence_row["attendance_type"] =="E")
								  $data[$registration_no][$std_data["student_course"]]['E'] +=1;
							     if($attandence_row["attendance_type"] =="L.E")
								  $data[$registration_no][$std_data["student_course"]]['LE']+=1; 
								 } else {
								 	 if($attandence_row["attendance_type"] =="P")
									  $data[$registration_no][$std_data["student_course"]]['P'] = 1;
									 else
									  $data[$registration_no][$std_data["student_course"]]['P'] = 0;
									  if($attandence_row["attendance_type"] =="L")
								      $data[$registration_no][$std_data["student_course"]]['L'] = 1;
								     else
								      $data[$registration_no][$std_data["student_course"]]['L'] = 0;
								      if($attandence_row["attendance_type"] =="A")
								      $data[$registration_no][$std_data["student_course"]]['A'] = 1;
								     else
								      $data[$registration_no][$std_data["student_course"]]['A'] = 0;
								      if($attandence_row["attendance_type"] =="E")
								      $data[$registration_no][$std_data["student_course"]]['E'] = 1;
								     else
								     $data[$registration_no][$std_data["student_course"]]['E'] = 0;
								      if($attandence_row["attendance_type"] =="L.E")
								      $data[$registration_no][$std_data["student_course"]]['LE']= 1;
								     else
								      $data[$registration_no][$std_data["student_course"]]['LE'] = 0;
								 }
								 $data[$registration_no][$std_data["student_course"]]["semseter"] 	=   $this->semister->get_name($this->student_data->get_semester_id($sTDid));
								 $data[$registration_no][$std_data["student_course"]]["ssn"] 		=   $this->register->get_ssn($attandence_row["register_id"]);
						  		 $data[$registration_no][$std_data["student_course"]]["status"] 	=   $this->status->get_name_by_id($this->student_information->get_status_reg_id($attandence_row["register_id"]));
						     
							 }                          
                          }
                          else {
 								 if(isset($data[$registration_no][$std_data["student_course"]]['P'])) {
								 if($attandence_row["attendance_type"] =="P")
								  $data[$registration_no][$std_data["student_course"]]['P'] += 1;
								  if($attandence_row["attendance_type"] =="L")
							      $data[$registration_no][$std_data["student_course"]]['L'] +=1;
							      if($attandence_row["attendance_type"] =="A")
							      $data[$registration_no][$std_data["student_course"]]['A'] +=1;
							      if($attandence_row["attendance_type"] =="E")
							      $data[$registration_no][$std_data["student_course"]]['E'] +=1;
							      if($attandence_row["attendance_type"] =="L.E")
							      $data[$registration_no][$std_data["student_course"]]['LE']+=1; 
							      
								 } else {
								 	 
								 	 if($attandence_row["attendance_type"] =="P")
									  $data[$registration_no][$std_data["student_course"]]['P'] = 1;
									 else
									  $data[$registration_no][$std_data["student_course"]]['P'] = 0;
									  if($attandence_row["attendance_type"] =="L")
								      $data[$registration_no][$std_data["student_course"]]['L'] = 1;
								     else
								      $data[$registration_no][$std_data["student_course"]]['L'] = 0;
								      if($attandence_row["attendance_type"] =="A")
								      $data[$registration_no][$std_data["student_course"]]['A'] = 1;
								     else
								      $data[$registration_no][$std_data["student_course"]]['A'] = 0;
								      if($attandence_row["attendance_type"] =="E")
								      $data[$registration_no][$std_data["student_course"]]['E'] = 1;
								     else
								     $data[$registration_no][$std_data["student_course"]]['E'] = 0;
								      if($attandence_row["attendance_type"] =="L.E")
								      $data[$registration_no][$std_data["student_course"]]['LE']= 1;
								     else
								      $data[$registration_no][$std_data["student_course"]]['LE'] = 0;   
								 }
								 
						         $data[$registration_no][$std_data["student_course"]]["semseter"] 	=   $this->semister->get_name($this->student_data->get_semester_id($sTDid));
						  
						         $data[$registration_no][$std_data["student_course"]]["ssn"] 		=   $this->register->get_ssn($attandence_row["register_id"]);
						  		 $data[$registration_no][$std_data["student_course"]]["status"] 	=   $this->status->get_name_by_id($this->student_information->get_status_reg_id($attandence_row["register_id"]));
						      
						        }
						  
						  }
                  }         
              
              }
		    
			}

		}
		 ksort($data);
		return  $data;
		
    }  

    
    
    function get_attendence_ExportExcelData(){
    		$attendence_report =array(); 
              $attendence_report=$this->get_attendence_list_by_semester();
          	  $arr = array(); $t=2;
          	  $arr['export_excel_arr'][1] = array('Reg No','Name','semester','Course','SSN','Status','P','A','E','L','LE','Percentage(%)','Percentage W/O Excused(%)');
                 foreach($attendence_report as $register_no => $courseID): 

                            		foreach ($courseID as $CID => $attendence_details): 
                                             $arr['export_excel_arr'][$t][0] = $register_no;
	                                		 $arr['export_excel_arr'][$t][1] = $this->student_data->get_fullname_by_ID($this->register->get_student_data_ID_no_by_registration($register_no));
	                                         $arr['export_excel_arr'][$t][2] = $this->course->get_name($CID);
	                                         $arr['export_excel_arr'][$t][3] = $attendence_details["semseter"];
	                                         $arr['export_excel_arr'][$t][4] = $attendence_details["ssn"];
	                                         $arr['export_excel_arr'][$t][5] = $attendence_details["status"];
	                                         $arr['export_excel_arr'][$t][6] = $attendence_details["P"] ;
	                                         $arr['export_excel_arr'][$t][7] = $attendence_details["A"];
	                                         $arr['export_excel_arr'][$t][8] = $attendence_details["E"];
	                                         $arr['export_excel_arr'][$t][9] = $attendence_details["L"];
	                                         $arr['export_excel_arr'][$t][10] = $attendence_details["LE"];
	                                           
	                                         $C_percentage		 =	0;
	                                		 $C_WO_percentage 	 =	0;
	                                         $totalclass		 =  $attendence_details["P"]+$attendence_details["A"]+$attendence_details["L"]+$attendence_details["E"]+$attendence_details["LE"];
	                                         $C_percentage		 =  round((($attendence_details["P"]+$attendence_details["E"]+$attendence_details["L"]+$attendence_details["LE"])/$totalclass)*100,2);
	                                         $C_WO_percentage	 =  round((($attendence_details["P"]+$attendence_details["LE"]+$attendence_details["L"])/$totalclass)*100,2);
	                                         
	                                         $arr['export_excel_arr'][$t][11] = $C_percentage;
	                                         $arr['export_excel_arr'][$t][12] = $C_WO_percentage;
                                            
                                             $t++;
                                    endforeach;
                                            
                 endforeach;
				
	 return $arr;          						
    }
} 
?>

<?php
  
class New_report_management extends CI_Controller {   
    
   function __construct() {
  
        parent::__construct();
    

      $this->load->helper('download');
      $this->load->helper('functions');     
      $this->load->helper('form');     
      $this->load->library('session');
      $this->load->library('php_mailer');
      $this->load->library('php_excel_class');
      
            
      $this->load->model('login','', TRUE);     
      $this->load->model('course_relation','', TRUE);     
      $this->load->model('course','', TRUE);     
      $this->load->model('semister','', TRUE);     
      $this->load->model('student_data','', TRUE);     
      $this->load->model('student_upload','', TRUE);     
      $this->load->model('staff','', TRUE);    
      $this->load->model('notes','', TRUE);     
      $this->load->model('staff_upload','', TRUE);    
      $this->load->model('lcc_communication','', TRUE);      
      $this->load->model('lcc_inbox','', TRUE);     
  
      $this->load->model('archive');
      $this->load->model('letter_issuing');
      $this->load->model('email_issuing');
      $this->load->model('sms_issuing');
      $this->load->model('letter_set');
      $this->load->model('signatory_set');
      $this->load->model('student_gender');
      $this->load->model('student_title');
      $this->load->model('country');
      $this->load->model('student_others_ethnicity');
      $this->load->model('student_others_disabilities');
      $this->load->model('student_marital_status');
      $this->load->model('register');
      $this->load->model('semester_plan');
      $this->load->model('time_plan');
      $this->load->model('room_plan');
      $this->load->model('class_plan');
      $this->load->model('coursemodule');
      $this->load->model('course_level');
      $this->load->model('class_lists');
      $this->load->model('modules');
      $this->load->model('settings');
      $this->load->model('status');
      $this->load->model('student_assign_class');
      $this->load->model('examresult');
      $this->load->model('examresult_archive');
      $this->load->model('student_attendance_excuse');
      $this->load->model('attendance');
      $this->load->model('slc_coursecode','', TRUE);                                   
      $this->load->model('agreement','', TRUE);                                   
      $this->load->model('installment','', TRUE);     
      $this->load->model('attendance_history','', TRUE);      
      $this->load->model('coc_history','', TRUE);     
      $this->load->model('registration_history','', TRUE);      
      $this->load->model('agreement','', TRUE);     
      $this->load->model('money_receipt','', TRUE);     
      $this->load->model('student_information','', TRUE);
      $this->load->model('awarding_body','', TRUE);
      $this->load->model('hesa_class','', TRUE);
      $this->load->model('hesa_exchind','', TRUE);                                   
      $this->load->model('hesa_sselig','', TRUE);                                   
      $this->load->model('hesa_heapespop','', TRUE);                                   
      $this->load->model('hesa_locsdy','', TRUE);                                   
      $this->load->model('hesa_mode','', TRUE);                                   
      $this->load->model('hesa_sexort','', TRUE);                                   
      $this->load->model('hesa_relblf','', TRUE);                                   
      $this->load->model('hesa_student_information','', TRUE);
      $this->load->model('campus_info','', TRUE);
      $this->load->model('hesa_disall','', TRUE);
      $this->load->model('hesa_rsnend','', TRUE);
      $this->load->model('hesa_qual','', TRUE);
      $this->load->model('coc_upload','', TRUE);              
      $this->load->model('hesa_courseaim','', TRUE);              
      $this->load->model('hesa_ttcid','', TRUE);              
      $this->load->model('hesa_subject_of_course','', TRUE);              
      $this->load->model('hesa_sbjca','', TRUE);              
      $this->load->model('hesa_unitlgth','', TRUE);              
      $this->load->model('hesa_domicile','', TRUE);              
      $this->load->model('hesa_genderid','', TRUE);     
      $this->load->model('hesa_sbjca','', TRUE);      
      $this->load->model('hesa_subject_of_course','', TRUE);      
      $this->load->model('hesa_previnst','', TRUE);     
      $this->load->model('hesa_qualtype','', TRUE);     
      $this->load->model('hesa_qualsbj','', TRUE);      
      $this->load->model('hesa_qualsit','', TRUE);      
      $this->load->model('hesa_domicile','', TRUE);     
      $this->load->model('hesa_stuload_student_info','', TRUE);
      $this->load->model('hesa_class','', TRUE);          
      $this->load->model('hesa_courseaim','', TRUE);          
      $this->load->model('hesa_disall','', TRUE);          
      $this->load->model('hesa_exchind','', TRUE);          
      $this->load->model('hesa_genderid','', TRUE);          
      $this->load->model('hesa_heapespop','', TRUE);          
      $this->load->model('hesa_locsdy','', TRUE);          
      $this->load->model('hesa_mode','', TRUE);          
      $this->load->model('hesa_notact','', TRUE);          
      $this->load->model('hesa_priprov','', TRUE);          
      $this->load->model('hesa_qual','', TRUE);          
      $this->load->model('hesa_regbody','', TRUE);          
      $this->load->model('hesa_relblf','', TRUE);          
      $this->load->model('hesa_rsnend','', TRUE);          
      $this->load->model('hesa_sexort','', TRUE);          
      $this->load->model('hesa_sselig','', TRUE);          
      $this->load->model('hesa_ttcid','', TRUE);                          
      $this->load->model('hesa_mstufee','', TRUE);                          
      $this->load->model('campus_info','', TRUE);                          
      $this->load->model('student_others_ethnicity','', TRUE);                          
      $this->load->model('country','', TRUE);                          
      $this->load->model('hesa_qualent3','', TRUE);                          
}

public function index(){

      // $all_code = $this->hesa_courseaim->get_all_code();
      // var_dump($all_code); die();

	    $data                   =   array(); 
	    $menuleft               =   array();
	    $data["statements"]     =   array();
	    $varsessioncheck_id     =   $this->session->userdata('uid');

	    $label                  =   $this->session->userdata('label');        
	    $data["fullname"]       =   $this->session->userdata('fullname');  
	    $data['message']        =   "";

	    // alert count part
	    
	    $data["alert_count"]                =   0;
	    $data["inbox_alert_count"]          =   0;
	    
	    
	    $data["alert_count"]          = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
	    $data["inbox_alert_count"]    = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
	    
	    // alert count part end


    
        $action                 = $this->input->get('action');
        $page                   = $this->input->get('page'); 
        $id                     = $this->input->get('id');
        $do                     = $this->input->get('do');
        $export                 = $this->input->get('export');
        $sortby                 = "";   
        $sortby                 = $this->input->get('sortby');           
        $student_data           = array();
        $data['semester_list']  = $this->semister->get_all_by_des_order();
        $data['course_list']    = $this->course->get_all();
        $data['agent_list']     = $this->agent->get_by_status();
        $data['status_list']    = $this->status->get_all();
        $data['staff_id']       = $varsessioncheck_id;
        
        
       if($action=="search" && empty($page) && $this->input->post()>""){
            
            $terms = array();
            foreach($this->input->post() as $k=>$v){
                
                if($k!="ref" && $k!="ref_id"){$$k=tinymce_encode($v); $terms[$k] = $$k;}
            }

            $sesData['report_management_student_search']['terms'] = $terms;

            $this->session->set_userdata($sesData);            
            
            
        } 
        
        
        
        
        

     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="search") ){

               
      
        if($action=="search"  || ($_POST && $this->input->post('ref')=="search")){
             
            $sesData = $this->session->userdata("report_management_student_search");
            $terms = $sesData['terms'];
            $data['terms'] = $terms;

            
            $data['result']=$this->student_information->makeReportSearchWithpagination($terms,$page,base_url()."index.php/new_report_management/?action=search","yes");




        }


            
        $data['bodytitle']       =   "Report Management";
        $data['faicon']          =   "fa-file-text-o";
        $data['breadcrumbtitle'] =   "Dashboard > Report Management";            

        $data['semester_list']   = $this->semister->get_all_by_des_order();
        $data['moduleList']      = $this->coursemodule->get_all();
        $data['group_name']      = $this->class_plan->get_all_group_name();
        $data['level_list']      = $this->course_level->get_all_unique_level();
        $data['letter_set']      = $this->letter_set->get_all();
        $data['ref']             = 'search';
        $data['ref_id']          = ""; 
        
        //var_dump($data['report_list']);
            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        //$this->load->view('staff/report_body_form');
        $this->load->view('staff/report/report_search_body');        
        $this->load->view('staff/other_footer');
        
  
        
        
        
        
         

    } else if( !empty($varsessioncheck_id) && $action=="generate") {

      // var_dump($this->session->userdata('report_query'));
      // die();
      if (isset($_POST)) {        
        //var_dump($_POST);
        $sql_column_arr = array();
        foreach ($_POST as $key => $value) {
          $table = $key;
          if (is_array($value)) {
             
            foreach ($value as $k => $v) {
              
              if ($v == "proof_typeANDproof_id") {
                
                $proof = explode("AND", $v);
                foreach ($proof as $p => $q) 
                {
                  $sql_column_arr[] = $table.".".$q; 
                }

              } else {

                $sql_column_arr[] = $table.".".$v;

              }
              
              
            }
            

            
          }

        }
        
        if (!empty($sql_column_arr)) {
          $sql_clm = implode(',', $sql_column_arr);
        }        
        
        //var_dump($sql_column_arr);
        $ar = array(
          'report_search_result_total_page' => ''
        );
        
        $this->session->set_userdata( $ar );

        
          if($_POST) {
            $posted_data = array(
              'posted_data_query' => $sql_clm
            );
            //var_dump($posted_data);
            $this->session->set_userdata( $posted_data );
          }

        

        $extra_query = "
                          LEFT JOIN archive AS arcv ON sd.id = arcv.student_data_id AND arcv.archive_field_name = 'student_status' AND arcv.archive_field_value = si.status  
                          LEFT JOIN semister AS semester ON sd.student_semister = semester.id     
                          LEFT JOIN course_relation AS cr ON sd.student_course = cr.course_id AND sd.student_semister = cr.semester_id     
                          LEFT JOIN awarding_body AS awarding_body ON awarding_body.ID = cr.awarding_id 
                          WHERE 
                                  
        ";
        
        $query1 = $this->session->userdata('report_query');
        
        //var_dump($this->session->userdata('posted_data_query'));
        $query2 = str_replace("si.id, sd.id", $this->session->userdata('posted_data_query'), $query1);
        $query2 = str_replace("WHERE", $extra_query, $query2);
        //var_dump($query2); die();
        //var_dump($query2);
        $targetpage = base_url()."index.php/new_report_management/?action=generate";

        $data['generate_result'] = $this->student_information->get_student_list_for_report($query2,$page,$targetpage,"yes");

        

      }



            
        $data['bodytitle']       =   "Report Management";
        $data['faicon']          =   "fa-file-text-o";
        $data['breadcrumbtitle'] =   "Dashboard > Report Management";            

        $data['semester_list']   = $this->semister->get_all();
        $data['moduleList']      = $this->coursemodule->get_all();
        $data['group_name']      = $this->class_plan->get_all_group_name();
        $data['level_list']      = $this->course_level->get_all_unique_level();
        $data['letter_set']      = $this->letter_set->get_all();
        $data['ref']             = 'search';
        $data['ref_id']          = ""; 
        
        //var_dump($data['report_list']);
            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        //$this->load->view('staff/report_body_form');
        $this->load->view('staff/report/report_search_body');        
        $this->load->view('staff/other_footer');







    } else if( !empty($varsessioncheck_id) && $action=="excel") {

       if (isset($_POST)) {
        
        
        foreach ($_POST as $key => $value) {
          $table = $key;
          if (is_array($value)) {
            
            foreach ($value as $k => $v) {
              
              if ($v == "proof_typeANDproof_id") {
                
                $proof = explode("AND", $v);
                foreach ($proof as $p => $q) 
                {
                  $sql_column_arr[] = $table.".".$q; 
                }

              } else {

                $sql_column_arr[] = $table.".".$v;

              }

              
            }
            if (!empty($sql_column_arr)) {
              $sql_clm = implode(',', $sql_column_arr);
            }
            
          }

        }
        
        
        $extra_query = "
                          LEFT JOIN archive AS arcv ON sd.id = arcv.student_data_id AND arcv.archive_field_name = 'student_status' AND arcv.archive_field_value = si.status  
                          LEFT JOIN semister AS semester ON sd.student_semister = semester.id     
                          LEFT JOIN course_relation AS cr ON sd.student_course = cr.course_id AND sd.student_semister = cr.semester_id     
                          LEFT JOIN awarding_body AS awarding_body ON awarding_body.ID = cr.awarding_id 
                          WHERE 
                                  
        ";
        
        $query1 = $this->session->userdata('report_query');
        $query2 = str_replace("rs.id, si.id, sd.id", $sql_clm, $query1);
        $query2 = str_replace("WHERE", $extra_query, $query2);        
        
        //$query2 = str_replace("rs.id, si.id, sd.id", $sql_clm, $query1);

        // var_dump($query2); die();
        $targetpage = base_url()."index.php/new_report_management/?action=generate";

        $excel_data_array = $this->student_information->get_student_list_for_report_as_array($query2,$page,$targetpage,"no");
        
        // var_dump($excel_data_array); die();

        $date = date('F-j-Y');
        $xls = new Excel_XML('UTF-8', false, 'Report Search Result - '.$date);
        // $xls->addArray($excel_data_array[0]);
        $xls->addArray($excel_data_array['report_result']);
        $xls->generateXML('report_'.$date);
        

      }






    } else if( !empty($varsessioncheck_id) && $action=="xml") {

       $hesa_search_term = $_POST['instance_period'];

       $all_hesa_ttcid                  = $this->hesa_ttcid->get_all_code();
       $all_hesa_unitlgth               = $this->hesa_unitlgth->get_all_code();
       $all_hesa_class                  = $this->hesa_class->get_all_code();
       $all_hesa_courseaim              = $this->hesa_courseaim->get_all_code();
       $all_hesa_disall                 = $this->hesa_disall->get_all_code();
       $all_hesa_domicile               = $this->hesa_domicile->get_all_code();
       $all_hesa_exchind                = $this->hesa_exchind->get_all_code();
       $all_hesa_genderid               = $this->hesa_genderid->get_all_code();
       $all_hesa_heapespop              = $this->hesa_heapespop->get_all_code();
       $all_hesa_locsdy                 = $this->hesa_locsdy->get_all_code();
       $all_hesa_mode                   = $this->hesa_mode->get_all_code();
       $all_hesa_mstufee                = $this->hesa_mstufee->get_all_code();
       $all_hesa_notact                 = $this->hesa_notact->get_all_code();
       $all_hesa_previnst               = $this->hesa_previnst->get_all_code();
       $all_hesa_priprov                = $this->hesa_priprov->get_all_code();
       $all_hesa_qualsbj                = $this->hesa_qualsbj->get_all_code();
       $all_hesa_qual                   = $this->hesa_qual->get_all_code();
       $all_hesa_qualsit                = $this->hesa_qualsit->get_all_code();
       $all_hesa_qualtype               = $this->hesa_qualtype->get_all_code();
       $all_hesa_regbody                = $this->hesa_regbody->get_all_code();
       $all_hesa_relblf                 = $this->hesa_relblf->get_all_code();
       $all_hesa_rsnend                 = $this->hesa_rsnend->get_all_code();
       $all_hesa_sbjca                  = $this->hesa_sbjca->get_all_code();
       $all_hesa_sexort                 = $this->hesa_sexort->get_all_code();
       $all_hesa_sselig                 = $this->hesa_sselig->get_all_code();
       $all_campus_info                 = $this->campus_info->get_all_address();
       $all_student_others_ethnicity    = $this->student_others_ethnicity->get_all_id();
       $all_countries                   = $this->country->get_all_iso2();
       $all_hesa_qualent3               = $this->hesa_qualent3->get_all_code();
       


       //var_dump($hesa_search_term);
       
      //var_dump($this->session->userdata('report_query')); die();
      // if (isset($_POST)) {
        
        
      //   foreach ($_POST as $key => $value) {
      //     $table = $key;
      //     if (is_array($value)) {
            
      //       foreach ($value as $k => $v) {
              
      //         if ($v == "proof_typeANDproof_id") {
                
      //           $proof = explode("AND", $v);
      //           foreach ($proof as $p => $q) 
      //           {
      //             $sql_column_arr[] = $table.".".$q; 
      //           }

      //         } else {

      //           $sql_column_arr[] = $table.".".$v;

      //         }

              
      //       }
      //       if (!empty($sql_column_arr)) {
      //         $sql_clm = implode(',', $sql_column_arr);
      //       }
            
      //     }

      //   }
        
      //   $query1 = $this->session->userdata('report_query');
        
      //   $query2 = str_replace("rs.id, si.id, sd.id", $sql_clm, $query1);

      //   // var_dump($query2); die();
      //   $targetpage = base_url()."index.php/new_report_management/?action=generate";

      //   $excel_data_array = $this->student_information->get_student_list_for_report_as_array($query2,$page,$targetpage,"yes");
        
      //   // var_dump($excel_data_array); die();

      //   $date = date('F-j-Y');
      //   $xls = new Excel_XML('UTF-8', false, 'Report Search Result - '.$date);
      //   $xls->addArray($excel_data_array['report_result']);
      //   $xls->generateXML('report_'.$date);
        

      // }

    // $xml = $this->dbutil->xml_from_result($query, $config);

      $course_list =$this->course->get_all_intotal();
      // var_dump($course_list); die();

      $xml = "<APStudentRecord>
                <Provider>
                  <RECID>14054</RECID>
                  <SUBPURPOSE>1</SUBPURPOSE>
                  <UKPRN>10030391</UKPRN>";

      //Looping through all course.          
      foreach ($course_list as $k => $v) {
        
        $xml .= "<Course>";

          if(!empty($v['course_code'])) {
            $xml .= "<COURSEID>".$v['course_code']."</COURSEID>";
          } else {
            $xml .= "<COURSEID> </COURSEID>";
          }


            $xml .= "<OWNCOURSEID>".$v['id'] ."</OWNCOURSEID>";

              if(!empty($v['hesa_courseaim_id']) && ($v['hesa_courseaim_id']>0)) {
                $xml .= "<COURSEAIM>".$this->hesa_courseaim->get_code_by_id($v['hesa_courseaim_id'])."</COURSEAIM>";
              } else {
                $xml .= "<COURSEAIM> </COURSEAIM>";
              }

              if(!empty($v['course_name'])) {
                $xml .= "<CTITLE>".$v['course_name']."</CTITLE>";
              } else {
                $xml .= "<CTITLE> </CTITLE>";
              }

              if(!empty($v['hesa_ttcid']) && ($v['hesa_ttcid']>0)) {
                $xml .= "<TTCID>".$this->hesa_ttcid->get_code_by_id($v['hesa_ttcid'])."</TTCID>";
              } else {
                $xml .= "<TTCID> </TTCID>";
              }

          $hsbjca = $this->hesa_subject_of_course->get_by_course_id($v['id']);
          $contribution_percent = array();
          if(!empty($v['contribution_percent'])) {
            $contribution_percent = unserialize($v['contribution_percent']);
          }
          if(!empty($hsbjca)) 
          {
            $j = 0;
            foreach ($hsbjca as $x => $y) 
            {

              if( !empty($y) && $y>0 && !empty($contribution_percent[$j]) ) {

                $xml .= "<CourseSubject>";

                  $xml .= "<SBJCA>".$this->hesa_sbjca->get_code_by_id($y)."</SBJCA>";
                  $xml .= "<SBJPCNT>".$contribution_percent[$j]."</SBJPCNT>";
                  
                $xml .= "</CourseSubject>";

              }
              
              $j++;            
            }
          }
          
        $xml .="</Course>";

      }

      $query1 = $this->session->userdata('report_query');
      
      $array['report_query'] = array();
      $this->session->set_userdata($array);
      // var_dump($query1);
      $field_query = $this->db->query($query1);
      $dt = $field_query->result_array();
      //echo"<pre>";
      // var_dump($dt);
  
      if($hesa_search_term == "all"){  
      
          $xml_query = "          
                SELECT rs.id AS register_id, si.id AS student_information_id, sd.id AS student_data_id, rs.registration_no, sd.student_first_name, sd.student_sur_name, sd.student_date_of_birth, rs.ssn, hsi.uhn_number AS husid, hsi.hesa_numhus, c.course_code, hsi.hesa_owninst, hsi.hesa_comdate, hsi.hesa_enddate, hsi.hesa_heapespop_id, rs.campus_info_id, hsi.hesa_rsnend_id, cr.duration AS splength, hcrul.hesa_unitlgth_id AS unitlgth, hsi.id AS hesa_student_information_id, cr.id AS course_relation_id, hcri.id AS hesa_course_relation_instance_id, hstu.id AS hesa_stuload_student_info_id, hstu.year_of_the_course, hsi.hesa_domicile_id, rs.student_permanent_postcode, hstu.student_load, hstu.hesa_disall_id, hstu.hesa_exchind_id, hstu.hesa_grossfee, hstu.hesa_locsdy_id, hstu.hesa_mode_id, hstu.hesa_mstufee_id, hstu.hesa_netfee, hstu.hesa_notact_id, hstu.hesa_periodstart, hstu.hesa_periodend, hstu.hesa_priprov_id, hstu.hesa_sselig_id, hstu.hesa_yearprg, hstu.hesa_yearstu, hsi.hesa_disall_id, sd.student_others_ethnicity, hsi.hesa_genderid_id, sd.student_nationality, hsi.hesa_relblf_id, sd.student_gender, hsi.hesa_sexort_id, hsi.hesa_qualent3_id, hsi.hesa_qual_id, hsi.hesa_class_id      
                FROM register AS rs
                LEFT JOIN student_information AS si ON si.student_data_id = rs.student_data_id
                LEFT JOIN student_data AS sd ON MASUM123 
                LEFT JOIN hesa_student_information AS hsi ON hsi.student_data_id = rs.student_data_id
                AND hsi.register_id = rs.id
                LEFT JOIN course_relation AS cr ON cr.course_id = sd.student_course
                AND cr.semester_id = sd.student_semister
                LEFT JOIN hesa_course_relation_instance AS hcri ON hcri.course_relation_id = cr.ID
                LEFT JOIN hesa_stuload_student_info AS hstu ON hstu.hesa_course_relation_instance_id = hcri.id
                AND hstu.student_data_id = sd.id
                AND hstu.register_id = rs.id
                LEFT JOIN course AS c ON c.id = sd.student_course
                LEFT JOIN hesa_course_relation_unitlgth AS hcrul ON hcrul.course_relation_id = cr.ID 
                ORDER BY cr.ID ASC          
          ";
      
      }else if($hesa_search_term != "all"){
          
          $xml_query = "          
                SELECT rs.id AS register_id, si.id AS student_information_id, sd.id AS student_data_id, rs.registration_no, sd.student_first_name, sd.student_sur_name, sd.student_date_of_birth, rs.ssn, hsi.uhn_number AS husid, hsi.hesa_numhus, c.course_code, hsi.hesa_owninst, hsi.hesa_comdate, hsi.hesa_enddate, hsi.hesa_heapespop_id, rs.campus_info_id, hsi.hesa_rsnend_id, cr.duration AS splength, hcrul.hesa_unitlgth_id AS unitlgth, hsi.id AS hesa_student_information_id, cr.id AS course_relation_id, hcri.id AS hesa_course_relation_instance_id, hstu.id AS hesa_stuload_student_info_id, hstu.year_of_the_course, hsi.hesa_domicile_id, rs.student_permanent_postcode, hstu.student_load, hstu.hesa_disall_id, hstu.hesa_exchind_id, hstu.hesa_grossfee, hstu.hesa_locsdy_id, hstu.hesa_mode_id, hstu.hesa_mstufee_id, hstu.hesa_netfee, hstu.hesa_notact_id, hstu.hesa_periodstart, hstu.hesa_periodend, hstu.hesa_priprov_id, hstu.hesa_sselig_id, hstu.hesa_yearprg, hstu.hesa_yearstu, hsi.hesa_disall_id, sd.student_others_ethnicity, hsi.hesa_genderid_id, sd.student_nationality, hsi.hesa_relblf_id, sd.student_gender, hsi.hesa_sexort_id, hsi.hesa_qualent3_id, hsi.hesa_qual_id, hsi.hesa_class_id        
                FROM register AS rs
                LEFT JOIN student_information AS si ON si.student_data_id = rs.student_data_id
                LEFT JOIN student_data AS sd ON MASUM123 
                LEFT JOIN hesa_student_information AS hsi ON hsi.student_data_id = rs.student_data_id
                AND hsi.register_id = rs.id
                LEFT JOIN course_relation AS cr ON cr.course_id = sd.student_course
                AND cr.semester_id = sd.student_semister
                LEFT JOIN hesa_course_relation_instance AS hcri ON hcri.course_relation_id = cr.ID
                LEFT JOIN hesa_stuload_student_info AS hstu ON hstu.hesa_course_relation_instance_id = hcri.id AND hstu.year_of_the_course = '".$hesa_search_term."'
                AND hstu.student_data_id = sd.id
                AND hstu.register_id = rs.id
                LEFT JOIN course AS c ON c.id = sd.student_course
                LEFT JOIN hesa_course_relation_unitlgth AS hcrul ON hcrul.course_relation_id = cr.ID 
                ORDER BY cr.ID ASC          
          ";          
      }      
      $and = "";
      $student_data_id_arr_imp = "";
      foreach($dt as $k=>$v){
          
          $student_data_id_arr_imp .= $and." sd.id='".$v['id']."'";
          //$course_semester = $this->student_data->get_course_semester_by_ID($student_data_id);
          //var_dump($student_data_id); 
          $and = " OR ";  
  
            
             
      }
      //echo"</pre>";
      $xml_query = str_replace("MASUM123", $student_data_id_arr_imp, $xml_query);
      //var_dump($xml_query);
      
      
      $field_query = $this->db->query($xml_query);
      $data = $field_query->result_array();
      
     // var_dump($dt);
      
      foreach($dt as $num=>$numdt){
          
         foreach($data as $k=>$v){
             
             if($hesa_search_term != "all" && $v['year_of_the_course'] == $hesa_search_term && $numdt['id'] == $v['student_data_id']){
                
                $search_data[$k] = $v;
                    
             }else if( !empty($v['year_of_the_course']) && $numdt['id']==$v['student_data_id']){
                //var_dump($student_data_id);
                //var_dump($v['student_data_id']);
                $search_data[$k] = $v; 
                 
             }
         }      
      }
      
      //var_dump($search_data);
      $register_id_arr = array();
      $student_data_id_arr = array();
      $course_relation_id_arr = array();
      $student_info_arr = array();
      $instance_data_arr = array();
      $last_student_info_arr_count = 0;
      $i=0; $total = 0; 
      foreach($search_data as $k=>$v){          
          
          if(!in_array($v['register_id'],$register_id_arr)){
              
              $register_id_arr[$i] = $v['register_id'];
              if(!in_array($v['course_relation_id'],$course_relation_id_arr))         $course_relation_id_arr[]        =  $v['course_relation_id'];
              
              $student_info_arr[$i]['student_data_id']        =  $v['student_data_id'];
              $student_info_arr[$i]['register_id']        =  $v['register_id'];
              $student_info_arr[$i]['husid']        =  $v['husid'];
              $student_info_arr[$i]['student_date_of_birth']        =  $v['student_date_of_birth'];
              $student_info_arr[$i]['student_first_name']        =  $v['student_first_name'];
              $student_info_arr[$i]['ssn']        =  $v['ssn'];
              $student_info_arr[$i]['student_sur_name']        =  $v['student_sur_name'];
              $student_info_arr[$i]['hesa_numhus']        =  $v['hesa_numhus'];
              $student_info_arr[$i]['hesa_domicile_id']        =  $v['hesa_domicile_id'];
              $student_info_arr[$i]['student_permanent_postcode']        =  $v['student_permanent_postcode'];
              $student_info_arr[$i]['course_code']        =  $v['course_code'];
              $student_info_arr[$i]['hesa_owninst']        =  $v['hesa_owninst'];
              $student_info_arr[$i]['hesa_comdate']        =  $v['hesa_comdate'];
              $student_info_arr[$i]['hesa_enddate']        =  $v['hesa_enddate'];
              $student_info_arr[$i]['hesa_heapespop_id']        =  $v['hesa_heapespop_id'];
              $student_info_arr[$i]['campus_info_id']        =  $v['campus_info_id'];
              $student_info_arr[$i]['splength']        =  $v['splength'];
              $student_info_arr[$i]['unitlgth']        =  $v['unitlgth'];
              $student_info_arr[$i]['hesa_disall_id']        =  $v['hesa_disall_id'];
              $student_info_arr[$i]['student_others_ethnicity']        =  $v['student_others_ethnicity'];
              $student_info_arr[$i]['hesa_genderid_id']        =  $v['hesa_genderid_id'];
              $student_info_arr[$i]['student_nationality']        =  $v['student_nationality'];
              $student_info_arr[$i]['hesa_relblf_id']        =  $v['hesa_relblf_id'];
              $student_info_arr[$i]['student_gender']        =  $v['student_gender'];
              $student_info_arr[$i]['hesa_sexort_id']        =  $v['hesa_sexort_id'];
              $student_info_arr[$i]['course_relation_id']        =  $v['course_relation_id'];
              $student_info_arr[$i]['hesa_qualent3_id']        =  $v['hesa_qualent3_id'];
              $student_info_arr[$i]['hesa_qual_id']        =  $v['hesa_qual_id'];
              $student_info_arr[$i]['hesa_class_id']        =  $v['hesa_class_id'];
             
              $last_student_info_arr_count = $i;  
              $i++;
          }         
          $j=0; 
          if( in_array($v['register_id'],$register_id_arr) ){
             
             if(!empty($v['hesa_course_relation_instance_id']) && !empty($v['hesa_stuload_student_info_id'])){
                 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['register_id'] = $v['register_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['course_relation_id'] = $v['course_relation_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_course_relation_instance_id'] = $v['hesa_course_relation_instance_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_stuload_student_info_id'] = $v['hesa_stuload_student_info_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['student_load'] = $v['student_load']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_disall_id'] = $v['hesa_disall_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_exchind_id'] = $v['hesa_exchind_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_grossfee'] = $v['hesa_grossfee']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_locsdy_id'] = $v['hesa_locsdy_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_mode_id'] = $v['hesa_mode_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_mstufee_id'] = $v['hesa_mstufee_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_netfee'] = $v['hesa_netfee']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_notact_id'] = $v['hesa_notact_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_periodstart'] = $v['hesa_periodstart']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_periodend'] = $v['hesa_periodend']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_priprov_id'] = $v['hesa_priprov_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_sselig_id'] = $v['hesa_sselig_id']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_yearprg'] = $v['hesa_yearprg']; 
                 $instance_data_arr[$total][$last_student_info_arr_count][$j]['hesa_yearstu'] = $v['hesa_yearstu'];  
                  
                 $j++;
                 $total++;                 
             } 
 
          }
          
          
          
      }
      //var_dump($course_relation_id_arr);
      //var_dump($register_id_arr);
      //echo"<pre>";
      //var_dump($register_id_arr);
      //echo"</pre>";
      foreach($register_id_arr as $k=>$register_id){
            
            $hesa_course_relation_instance_id = "";
            

                    //var_dump($student_info_arr[$k]['student_first_name']);
                    if(!empty($student_info_arr[$k]['student_date_of_birth'])) $student_date_of_birth = date("Y-m-d",strtotime(str_replace("/", "-", $student_info_arr[$k]['student_date_of_birth']))); else $student_date_of_birth = "";
                    if(!empty($student_info_arr[$k]['hesa_domicile_id']) && $student_info_arr[$k]['hesa_domicile_id']>0) $hesa_domicile_id = $all_hesa_domicile[$student_info_arr[$k]['hesa_domicile_id']]; else $hesa_domicile_id = "";
                    if(!empty($student_info_arr[$k]['hesa_heapespop_id']) && $student_info_arr[$k]['hesa_heapespop_id']>0) $hesa_heapespop_id = $all_hesa_heapespop[$student_info_arr[$k]['hesa_heapespop_id']]; else $hesa_heapespop_id = ""; 
                    if(!empty($student_info_arr[$k]['campus_info_id']) && $student_info_arr[$k]['campus_info_id']>0) $campus_info_id = $all_campus_info[$student_info_arr[$k]['campus_info_id']]; else $campus_info_id = ""; 
                    if(!empty($student_info_arr[$k]['hesa_disall_id']) && $student_info_arr[$k]['hesa_disall_id']>0) $hesa_disall_id = $all_hesa_disall[$student_info_arr[$k]['hesa_disall_id']]; else $hesa_disall_id = "00";  
                    if(!empty($student_info_arr[$k]['student_others_ethnicity']) && $student_info_arr[$k]['student_others_ethnicity']>0) $student_others_ethnicity = $all_student_others_ethnicity[$student_info_arr[$k]['student_others_ethnicity']]; else $student_others_ethnicity = ""; 
                    if(!empty($student_info_arr[$k]['hesa_genderid_id']) && $student_info_arr[$k]['hesa_genderid_id']>0) $hesa_genderid_id = $all_hesa_genderid[$student_info_arr[$k]['hesa_genderid_id']]; else $hesa_genderid_id = ""; 
                    if(!empty($student_info_arr[$k]['student_nationality']) && $student_info_arr[$k]['student_nationality']>0) $student_nationality = $all_countries[$student_info_arr[$k]['student_nationality']]; else $student_nationality = ""; 
                    if(!empty($student_info_arr[$k]['hesa_relblf_id']) && $student_info_arr[$k]['hesa_relblf_id']>0) $hesa_relblf_id = $all_hesa_relblf[$student_info_arr[$k]['hesa_relblf_id']]; else $hesa_relblf_id = ""; 
                    if(!empty($student_info_arr[$k]['hesa_sexort_id']) && $student_info_arr[$k]['hesa_sexort_id']>0) $hesa_sexort_id = $all_hesa_sexort[$student_info_arr[$k]['hesa_sexort_id']]; else $hesa_sexort_id = ""; 
                    if(!empty($student_info_arr[$k]['hesa_qualent3_id']) && $student_info_arr[$k]['hesa_qualent3_id']>0) $hesa_qualent3_id = $all_hesa_qualent3[$student_info_arr[$k]['hesa_qualent3_id']]; else $hesa_qualent3_id = ""; 
                    if(!empty($student_info_arr[$k]['hesa_qual_id']) && $student_info_arr[$k]['hesa_qual_id']>0) $hesa_qual_id = $all_hesa_qual[$student_info_arr[$k]['hesa_qual_id']]; else $hesa_qual_id = ""; 
                    if(!empty($student_info_arr[$k]['hesa_class_id']) && $student_info_arr[$k]['hesa_class_id']>0) $hesa_class_id = $all_hesa_class[$student_info_arr[$k]['hesa_class_id']]; else $hesa_class_id = ""; 
                    
                    
                    $xml .= "<Student>";
                    //$xml .= "<StudentEquality> <DISABLE>00</DISABLE> <ETHNIC>33</ETHNIC> <GENDERID>01</GENDERID> <NATION>BD</NATION> <RELBLF>12</RELBLF> <SEXID>2</SEXID> <SEXORT>98</SEXORT> </StudentEquality>";
                    $xml .= "<HUSID> ".$student_info_arr[$k]['husid']." </HUSID>";
                    $xml .= "<OWNSTU> </OWNSTU>";
                    $xml .= "<BIRTHDTE> ".$student_date_of_birth." </BIRTHDTE>";
                    $xml .= "<FNAMES> ".$student_info_arr[$k]['student_first_name']." </FNAMES>";
                    $xml .= "<SSN> ".$student_info_arr[$k]['ssn']." </SSN>";
                    $xml .= "<SURNAME> ".$student_info_arr[$k]['student_sur_name']." </SURNAME>";
                    $xml .= "<EntryProfile>";
                    $xml .= "<NUMHUS> ".$student_info_arr[$k]['hesa_numhus']." </NUMHUS>";
                    $xml .= "<DOMICILE> ".$hesa_domicile_id." </DOMICILE>";
                    $xml .= "<POSTCODE> ".$student_info_arr[$k]['student_permanent_postcode']." </POSTCODE>";
                    //$xml .= "<PREVINST>".!empty($all_hesa_domicile[$v['hesa_domicile_id']])."</PREVINST>";
                    $xml .= "<QUALENT3>".$hesa_qualent3_id."</QUALENT3>"; 
                    $xml .= "</EntryProfile>";
                    
                    
                    $xml .= "<Instance>";
                        $xml .= "<NUMHUS> ".$student_info_arr[$k]['hesa_numhus']." </NUMHUS>";
                        $xml .= "<COURSEID> ".$student_info_arr[$k]['course_code']." </COURSEID>";
                        $xml .= "<OWNINST> ".$student_info_arr[$k]['hesa_owninst']." </OWNINST>";
                        $xml .= "<COMDATE> ".$student_info_arr[$k]['hesa_comdate']." </COMDATE>";
                        $xml .= "<ENDDATE> ".$student_info_arr[$k]['hesa_enddate']." </ENDDATE>";
                        $xml .= "<HEAPESPOP> ".$hesa_heapespop_id." </HEAPESPOP>";
                        $xml .= "<LOCATION> ".$campus_info_id." </LOCATION>";
                        $xml .= "<SPLENGTH> ".$student_info_arr[$k]['splength']." </SPLENGTH>";
                        $xml .= "<UNITLGTH> ".$student_info_arr[$k]['unitlgth']." </UNITLGTH>";                        
                        
                        
                        
                        $num_total_instance_period_count = count($instance_data_arr);
                        $num_instance_period_count = count($instance_data_arr[$k]);
                        
                        //var_dump($instance_data_arr);
                        $num_current_instance_period = 0;
                        foreach($instance_data_arr as $num_data=>$instance_data){
                            
                            if(!empty($instance_data[$k][$num_current_instance_period]['register_id']) && $instance_data[$k][$num_current_instance_period]['register_id'] == $student_info_arr[$k]['register_id'] && !empty($instance_data[$k][$num_current_instance_period]['course_relation_id']) && $instance_data[$k][$num_current_instance_period]['course_relation_id'] == $student_info_arr[$k]['course_relation_id']){
                            
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_disall_id'])) $DISALL = $all_hesa_disall[$instance_data[$k][$num_current_instance_period]['hesa_disall_id']]; else $DISALL = "00";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_exchind_id'])) $EXCHIND = $all_hesa_exchind[$instance_data[$k][$num_current_instance_period]['hesa_exchind_id']]; else $EXCHIND = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_grossfee'])) $GROSSFEE = $instance_data[$k][$num_current_instance_period]['hesa_grossfee']; else $GROSSFEE = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_locsdy_id'])) $LOCSDY = $all_hesa_locsdy[$instance_data[$k][$num_current_instance_period]['hesa_locsdy_id']]; else $LOCSDY = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_mode_id'])) $MODE = $all_hesa_mode[$instance_data[$k][$num_current_instance_period]['hesa_mode_id']]; else $MODE = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_mstufee_id'])) $MSTUFEE = $all_hesa_mstufee[$instance_data[$k][$num_current_instance_period]['hesa_mstufee_id']]; else $MSTUFEE = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_netfee'])) $NETFEE = $instance_data[$k][$num_current_instance_period]['hesa_netfee']; else $NETFEE = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_periodend'])) $PERIODEND = $instance_data[$k][$num_current_instance_period]['hesa_periodend']; else $PERIODEND = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_periodstart'])) $PERIODSTART = $instance_data[$k][$num_current_instance_period]['hesa_periodstart']; else $PERIODSTART = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_sselig_id'])) $SSELIG = $all_hesa_sselig[$instance_data[$k][$num_current_instance_period]['hesa_sselig_id']]; else $SSELIG = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['student_load'])) $STULOAD = $instance_data[$k][$num_current_instance_period]['student_load']; else $STULOAD = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_yearprg'])) $YEARPRG = $instance_data[$k][$num_current_instance_period]['hesa_yearprg']; else $YEARPRG = "";
                                if(!empty($instance_data[$k][$num_current_instance_period]['hesa_yearstu'])) $YEARSTU = $instance_data[$k][$num_current_instance_period]['hesa_yearstu']; else $YEARSTU = "";
                                
                                $xml .= "<InstancePeriod>";
                                
                                  $xml .= "<DISALL>".$DISALL."</DISALL> 
                                          <EXCHIND>".$EXCHIND."</EXCHIND> 
                                          <GROSSFEE>".$GROSSFEE."</GROSSFEE> 
                                          <LOCSDY>".$LOCSDY."</LOCSDY> 
                                          <MODE>".$MODE."</MODE> 
                                          <MSTUFEE>".$MSTUFEE."</MSTUFEE> 
                                          <NETFEE>".$NETFEE."</NETFEE> 
                                          <PERIODEND>".$PERIODEND."</PERIODEND> 
                                          <PERIODSTART>".$PERIODSTART."</PERIODSTART> 
                                          <SSELIG>".$SSELIG."</SSELIG> 
                                          <STULOAD>".$STULOAD."</STULOAD> 
                                          <YEARPRG>".$YEARPRG."</YEARPRG> 
                                          <YEARSTU>".$YEARSTU."</YEARSTU>";
                                
                                $xml .= "<QualificationsAwarded>";
                                    $xml .= "<CLASS>".$hesa_class_id."</CLASS><QUAL>".$hesa_qual_id."</QUAL>";                                
                                $xml .= "</QualificationsAwarded>"; 
                                
                                $xml .= "</InstancePeriod>"; 
                            
                            
                            }
                            
                        }
                        
                        
                        
                    
                    $xml .= "</Instance>";
                     //hesa_numhus
                    //$xml .= "<StudentEquality><DISABLE>00</DISABLE><ETHNIC>33</ETHNIC><GENDERID>01</GENDERID><NATION>BD</NATION><RELBLF>12</RELBLF><SEXID>2</SEXID><SEXORT>98</SEXORT></StudentEquality>";
                    $xml .= "<StudentEquality>";
                    
                    $xml .= "<DISABLE> ".$hesa_disall_id." </DISABLE>";
                    $xml .= "<ETHNIC> ".$student_others_ethnicity." </ETHNIC>";
                    $xml .= "<GENDERID> ".$hesa_genderid_id." </GENDERID>";
                    $xml .= "<NATION> ".$student_nationality." </NATION>";
                    $xml .= "<RELBLF> ".$hesa_relblf_id." </RELBLF>";
                    $xml .= "<SEXID> ".$student_info_arr[$k]['student_gender']." </SEXID>";
                    $xml .= "<SEXORT> ".$hesa_sexort_id." </SEXORT>";
                    
                    $xml .= "</StudentEquality>";                   
                    
                    $xml .= "</Student>";
                
                
            
            
                
      }
      
      
      //$query2 = str_replace("rs.id, si.id, sd.id", $sql_clm, $query1);
      
      
      
      $xml .= " </Provider>
              </APStudentRecord>";

      //echo($xml);        
      //die();             
      
      force_download('downfile.xml', $xml);


    } else if(!empty($varsessioncheck_id) && ( $label == "admin"  || $label == "staff" )) {
        redirect('/admin_dashboard/'); 
    } else if(!empty($varsessioncheck_id) && $label=="student" ){
	    redirect('/user_dashboard/');
    } else if(!empty($varsessioncheck_id) && $label=="registered" ){
	    redirect('/student_dashboard/');         
    } else{
        redirect('/logout/'); 
    }
    
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       
} // end of index
   
}  
  
?>
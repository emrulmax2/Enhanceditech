<?php
/*
* Special notes-----------
* 1. education qfy posting is on view level
*
*/  
class Student_management extends CI_Controller {   
    
   function __construct() {
  
      parent::__construct();     
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
      $this->load->helper('functions');     
      $this->load->helper('form');     
      $this->load->library('session');
      $this->load->library('php_mailer');
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
      $this->load->model('hesa_notact','', TRUE);
      $this->load->model('coc_upload','', TRUE);
      $this->load->model('hesa_previnst','', TRUE);
      $this->load->model('hesa_stuload_student_info','', TRUE);
      $this->load->model('hesa_course_relation_instance','', TRUE);                                   
      $this->load->model('hesa_qualtype','', TRUE);                                   
      $this->load->model('hesa_qualsbj','', TRUE);                                   
      $this->load->model('hesa_qualsit','', TRUE);      
      $this->load->model('hesa_domicile','', TRUE);      
      $this->load->model('hesa_course_relation_unitlgth','', TRUE);      
      $this->load->model('hesa_unitlgth','', TRUE);      
      $this->load->model('hesa_mstufee','', TRUE);      
      $this->load->model('hesa_priprov','', TRUE);      
      $this->load->model('hesa_genderid','', TRUE);      
      $this->load->model('exam_result_prev','', TRUE);      
}

public function index(){

        $data                   =   array(); 
        $menuleft               =   array();
        $data["statements"]     =   array();
        $varsessioncheck_id     =   $this->session->userdata('uid');

        $label                  =   $this->session->userdata('label');        
        $data["fullname"]       =   $this->session->userdata('fullname');   
        $data['settings']       =   $this->settings->get_settings();
        $data['hesa_rsnend']    =  $this->hesa_rsnend->get_all();  

        
        $data['message']        =   "";
        $data['bodytitle']      =   "Live Students Management";
        $data['breadcrumbtitle']=   "Dashboard > Live Students Management";
        $data['faicon']         =   "fa-users"; 

        
        /// get staff access
        if($this->session->userdata('label')=="staff"){
                  $staff_access = $this->login->getStaffAccess($this->session->userdata('uid'));
                  if(!empty($staff_access['staff_privileges']['live_student_management']) && count($staff_access['staff_privileges']['live_student_management'])>0) $priv = $data['priv'] = $staff_access['staff_privileges']['live_student_management'];       
                  else{ $priv[0] = ""; $priv[1] = ""; $priv[2] = ""; $priv[3] = ""; $priv[4] = ""; $priv[5] = ""; $priv[6] = ""; $priv[7] = ""; $priv[8] = ""; $priv[9] = ""; $priv[10] = ""; $priv[11] = ""; $priv[12] = ""; $priv[13] = ""; $priv[14] = "";$priv[15] = "";$priv[16] = "";$priv[17] = "";$priv[18] = "";$priv[19] = "";$priv[20] = "";$priv[21] = "";$priv[22] = "";$priv[23] = "";$priv[24] = "";$priv[25] = "";$priv[26] = "";$priv[27] = "";$priv[28] = "";$priv[29] = "";$priv[30] = "";$priv[31] = "";$priv[32] = "";$priv[33] = "";$priv[34] = ""; $priv[35] = "";$priv[36] = "";$priv[37] = "";$priv[38] = "";$priv[39] = "";$priv[40] = "";$priv[41] = "";$priv[42] = "";$priv[43] = "";$priv[44] = "";$priv[45] = "";  }
                  //  $priv[0] = search view;
                  //  $priv[1] = profile view;
                  //  $priv[2] = Course view;
                  //  $priv[3] = Education Qualification view;
                  //  $priv[4] = Documents view;
                  //  $priv[5] = Notes view;
                  //  $priv[6] = Communication view;
                  //  $priv[7] = Accounts view;
                  //  $priv[8] = Archive view;
                  //  $priv[9] = Attendance view;
                  //  $priv[10] = Result view;
                  //  $priv[11] = SLC History view;
                  //  $priv[12] = Login to student panel view;
                  //  $priv[13] = HESA view;
                  //  $priv[14] = profile Change Status;
                  //  $priv[15] = search Excel Report
                  //  $priv[16] = profile Profile lock /Unlock;
                  //  $priv[17] = profile Edit;
                  //  $priv[18] = Course Edit;
                  //  $priv[19] = Documents add;
                  //  $priv[20] = Notes add;
                  //  $priv[21] = Notes Delete;
                  //  $priv[22] = Notes Follow-up;
                  //  $priv[23] = Communication Generate Letter;
                  //  $priv[24] = Communication Send Email;
                  //  $priv[25] = Communication Send SMS;
                  //  $priv[26] = Communication delete;
                  //  $priv[27] = Add Agreement;
                  //  $priv[28] = Add Payment;
                  //  $priv[29] = Edit Adreement;                  
                  //  $priv[30] = Attendance Attendance Flag;
                  //  $priv[31] = Attendance Attendance Detail View;
                  //  $priv[32] = Result Edit;
                  //  $priv[33] = HESA Edit/Update;
                  //  $priv[34] = Edit Payment;
                  //  $priv[35] = SLC History Add Registration;
                  //  $priv[36] = SLC History Add Attendance;
                  //  $priv[37] = SLC History Add COC;
                  //  $priv[38] = Account print payment;
                  //  $priv[39] = SLC History Add Registration View;
                  //  $priv[40] = SLC History Add Registration Edit;
                  //  $priv[41] = SLC History Add Attendance View;
                  //  $priv[42] = SLC History Add Attendance Edit;
                  //  $priv[43] = SLC History Add COC View
                  //  $priv[44] = SLC History Add COC Edit
                  //  $priv[45] = SLC History Add COC Upload Document
                  
                                
        }
        ///////////////////////////////////////////////////////       
        
    /* alert count part */
    
        $data["alert_count"]                =   0;
        $data["inbox_alert_count"]          =   0;
        $data["alert_count"]                = $this->lcc_inbox->get_alert_of_staff($varsessioncheck_id);  
        $data["inbox_alert_count"]          = $this->lcc_inbox->get_communication_alert_of_staff($varsessioncheck_id);  
    
    /* alert count part end*/    
        $action                 = $this->input->get('action');
        $page                   = $this->input->get('page'); 
        $id                     = $this->input->get('id');
        $do                     = $this->input->get('do');
        $export                 = $this->input->get('export');
        $sortby                 = "";   
        $sortby                 = $this->input->get('sortby');           
        $secondary              = $this->input->get('secondary');           
        $student_data           = array();
        $data['semester_list']  = $this->semister->get_all_by_des_order();
        $data['course_list']    = $this->course->get_all_by_course_name_asc();
        $data['agent_list']     = $this->agent->get_by_status();
        $data['status_list']    = $this->status->get_all();
        $data['staff_id']       = $varsessioncheck_id;

        $data['student_information'] = $this->student_information->get_by_student_data_id($id);

        // var_dump($data['student_information']); die();

              
        /* Start Set the applicaton data into session for archive set */
        if($action=="singleview" && $do == "application") {
            $student_data["studen_prev_info"] = $this->student_data->get_studentdata_for_edit($id);
            $this->session->set_userdata($student_data);
        }        
        /* End Set the applicaton data into session for archive set */    
        
        $studen_prev_info   = $this->session->userdata("studen_prev_info"); 
        
        if(!empty($sortby)){
            $sesData = $this->session->userdata("student_admission_search");
            $terms = $sesData['terms'];
            $sesData['student_admission_search']['terms'] = $terms;
            $sesData['student_admission_search']['sortby'] = $sortby;
            $this->session->set_userdata($sesData);            
        }           

        if($action=="search" && empty($page) && $this->input->post()>""){
            
            $terms = array();
            foreach($this->input->post() as $k=>$v){
                
                if($k!="ref" && $k!="ref_id"){$$k=tinymce_encode($v); $terms[$k] = $$k;}
            }

            $sesData['student_admission_search']['terms'] = $terms;

            $this->session->set_userdata($sesData);            
            
            
        }else if($action=="singleview"){
            
            

            if($do=="hesa" && isset($_POST) && count($_POST) > 0){
              //var_dump($_POST);
    

                //
              
                $hesa_student_information_arr = array();
                $hesa_stuload_student_info_arr = array();
                
                //var_dump($_POST);
                foreach($_POST as $k=>$v){
                  $$k=$v;
                    if(
                        ( $k=="hesa_numhus" && !empty($v) && $v != "")     ||
                        ( $k=="hesa_owninst" && !empty($v)  && $v!="")    ||
                        ( $k=="hesa_comdate" && !empty($v)  && $v!="")    ||
                        ( $k=="hesa_enddate" && !empty($v)  && $v!="")    ||
                        ( $k=="hesa_rsnend_id" && !empty($v)  && $v!="") 
                    ){
                        if($k=="hesa_comdate" || $k=="hesa_enddate")    $hesa_student_information_arr[$k] = date("Y-m-d",strtotime($v));
                        else $hesa_student_information_arr[$k] = $v;
                    
                    }else if($k!="hesa_stuload_student_info_id" 
                      && $k!="hesa_numhus"
                      && $k!="hesa_owninst"
                      && $k!="hesa_comdate"
                      && $k!="hesa_enddate"
                      && $k!="hesa_rsnend_id" 
                      && $k!="hesa_student_information_id"){
                        
                        $hesa_stuload_student_info_arr[$k] = $v;                        
                    }
                    
                      
                }
                $hesa_student_information_arr['id'] = $hesa_student_information_id;
                //var_dump($hesa_student_information_arr); die();

                $hesa_student_id = $this->hesa_student_information->update($hesa_student_information_arr);

                if(!empty($hesa_stuload_student_info_id) && count($hesa_stuload_student_info_id)>0){
                    $i=0; 
                    foreach($hesa_stuload_student_info_id as $hesa_stuload_student_id){
                        
                         $hesa_stuload_student_info_data = array();
                         $hesa_stuload_student_info_data['id'] = $hesa_stuload_student_id;
                        //$hesa_stuload_student_info_arr['id'] = $hesa_id;
                         foreach($hesa_stuload_student_info_arr as $k=>$v){
                           $hesa_stuload_student_info_data[$k] = $v[$i];        
                         }
                        //var_dump($hesa_stuload_student_info_data);
                        $hesa_stuload_id = $this->hesa_stuload_student_info->update($hesa_stuload_student_info_data);
                        
                      $i++;  
                    }
                }

                if ( isset($hesa_student_id ) || isset($hesa_stuload_id)) {
                  $data['hesa_msg'] = "<div class='alert alert-success' role='alert'>
  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
  
  Congratulations! Information has been updated!
</div>";
                }
                
                //var_dump($hesa_stuload_student_info_arr);


//die();
                
                
                
            }
           
           
                       
        } /* End of edit action part */
     
            
     
    if(!empty($varsessioncheck_id) && ($action==NULL || $action=="all" || $action=="search")) {
            
            

        $data['ref'] = 'search';
        $data['ref_id'] = "";        
      
        if (isset($_POST) && $this->input->post('ref')=="search") {
          $array = array(
            'live_student_search_query_total_page' => ''
          );
          
          $this->session->set_userdata( $array );
          
        }

        if($action=="all" && !$_POST){

            $data['result']=$this->student_data->makeStudentListWithpagination($action,$page,base_url()."index.php/student/student_management/?action=".$action,"yes");    
            
        }else if(($action!="all" && $action=="search")  || ($_POST && $this->input->post('ref')=="search")){
             
             $sesData = $this->session->userdata("student_admission_search");
             $terms = $sesData['terms'];
            
            $data['result']=$this->student_information->makeStudentListWithpagination($terms,$page,base_url()."index.php/student/student_management/?action=search","yes");
        }
        

        

            
        $this->load->view('staff/dashboard_header',$data);    
        $this->load->view('staff/dashboard_topmenu');
        $this->load->view('staff/dashboard_sidebar');
        $this->load->view('staff/sm/student_admission_search_body');
        $this->load->view('staff/other_footer'); 

    }else if(!empty($varsessioncheck_id) && ($action=="singleview")) {
              
        // Link data for student admission link body  start        
            
            $data['app_link']           = base_url()."index.php/student/student_management/?action=singleview&do=application&id=".$id;
            $data['edu_link']           = base_url()."index.php/student/student_management/?action=singleview&do=education&id=".$id;
            $data['course_link']        = base_url()."index.php/student/student_management/?action=singleview&do=course&id=".$id;
            $data['accounts_link']      = base_url()."index.php/student/student_management/?action=singleview&do=account&id=".$id;            
            $data['comm_link']          = base_url()."index.php/student/student_management/?action=singleview&do=communication&id=".$id;            
            $data['up_link']            = base_url()."index.php/student/student_management/?action=singleview&do=upload&id=".$id;            
            $data['addag_link']         = base_url()."index.php/student/student_management/?action=singleview&do=addagent&id=".$id;            
            $data['note_link']          = base_url()."index.php/student/student_management/?action=singleview&do=note&id=".$id;            
            $data['arch_link']          = base_url()."index.php/student/student_management/?action=singleview&do=archive&id=".$id;            
            $data['attendance_link']    = base_url()."index.php/student/student_management/?action=singleview&do=attendance&id=".$id;            
            $data['result_link']        = base_url()."index.php/student/student_management/?action=singleview&do=result&id=".$id;            
            $data['slc_link']           = base_url()."index.php/student/student_management/?action=singleview&do=slc-history&id=".$id;            
            $data['login_link']         = base_url()."index.php/student/student_management/?action=singleview&do=login&id=".$id; //////// ---- need to add priviledge in future            
            $data['hesa_link']          = base_url()."index.php/student/student_management/?action=singleview&do=hesa&id=".$id; //////// ---- need to add priviledge in future

        // Link data for student admission link body end
        
            $data['ref_id']     = $id;
            
            
            
                $reg_data = $this->register->get_by_student_ID($id);
                
                if(count($reg_data)>0){
                    
                    $reg_data = $this->register->get_by_student_ID($id);
                    /////------------ need to add as necessary ----- ;)
                    
                    foreach($reg_data as $k=>$v){
                        if($k=="registrtation_date" || $k=="class_startdate" || $k=="class_enddate" || $k=="proof_expiredate")
                            if($v!="0000-00-00") $data['user_data'][$k] = date("d-m-Y",strtotime($v)); else $v = "";    
                        
                        else
                        $data['user_data'][$k] = tinymce_decode($v);    
                    }
                    
                    
                    
                    
                }else if(count($reg_data)==0){
                    
                    $std_data                = $this->student_data->get_studentdata_for_edit($id);
                    
                    //if(preg_match("/[a-zA-Z]/", $data['user_data']['student_course'])==1)
                    $course_rel_data = $this->course_relation->get_by_course_and_semester($std_data['student_course'],$std_data['student_semister']);
                    //var_dump($course_rel_data); 
                    $data['user_data']['class_startdate'] = date("d-m-Y",strtotime($course_rel_data['class_startdate_1']));
                    $data['user_data']['class_enddate'] = date("d-m-Y",strtotime($course_rel_data['class_enddate_1']));
                    
                }            
            
            
        $data['campus_info_list'] = $this->campus_info->get_all();
        
        
        
        
        $data['hesa_exchind_list'] = $this->hesa_exchind->get_all();
        $data['hesa_class_list'] = $this->hesa_class->get_all();
        $data['hesa_sselig_list'] = $this->hesa_sselig->get_all();
        $data['hesa_heapespop_list'] = $this->hesa_heapespop->get_all();
        $data['hesa_locsdy_list'] = $this->hesa_locsdy->get_all();
        $data['hesa_mode_list'] = $this->hesa_mode->get_all();        
        $data['hesa_notact_list'] = $this->hesa_notact->get_all();        
        $data['hesa_sexort_list'] = $this->hesa_sexort->get_all();        
        $data['hesa_relblf_list'] = $this->hesa_relblf->get_all();        
        $data['hesa_mstufee_list'] = $this->hesa_mstufee->get_all();        
        $data['hesa_priprov_list'] = $this->hesa_priprov->get_all();        
             
        $data['hesa_disall_list'] = $this->hesa_disall->get_all();        
        $data['hesa_qual_list'] = $this->hesa_qual->get_all();        
        $data['hesa_genderid'] = $this->hesa_genderid->get_all();        
        $data['hesa_rsnend_list'] = $this->hesa_rsnend->get_all();        
        $data['hesa_student_information_data'] = $this->hesa_student_information->get_by_student_data_id_and_register_id($id,$reg_data['id']);

        //var_dump($data['hesa_student_information_data']);

        //var_dump($data['hesa_student_information_data']['hesa_disall_id']); die();
        if(!empty($data['hesa_student_information_data']) && empty($data['hesa_student_information_data']['uhn_number']) ) $data['hesa_student_information_data']['uhn_number'] = $this->hesa_student_information->calculateHusidNumber($reg_data['registration_no']);
        else if(empty($data['hesa_student_information_data'])) $data['uhn_number'] = $this->hesa_student_information->calculateHusidNumber($reg_data['registration_no']); 
        //var_dump($data['hesa_student_information_data']['uhn_number']);
        
        $std_data                = $this->student_data->get_studentdata_for_edit($id);
        $course_rel_data             = $this->course_relation->get_by_course_and_semester($std_data['student_course'],$std_data['student_semister']);
        
        //var_dump($course_rel_data['ID']);
        if(!empty($course_rel_data)){
            $hesa_course_relation_instance_list  = $this->hesa_course_relation_instance->get_by_course_relation_ID($course_rel_data['ID']);
            $course_rel_hesa_data                   = $this->hesa_course_relation_unitlgth->get_by_course_relation_ID($course_rel_data['ID']);
             //var_dump($hesa_course_relation_instance_list);
              if(!empty($hesa_course_relation_instance_list)){
                  $hesa_instance = array(); $i = 1;
                  foreach($hesa_course_relation_instance_list as $k=>$v){
                      
                     if(strtotime($v['end_date']) < time() && strtotime($v['start_date']) < time()){
                         
                         
                        $chk_hesa_stuload_student_info = $this->hesa_stuload_student_info->get_by_hesa_course_relation_instance_id_student_data_id_register_id($v['id'],$id,$reg_data['id']);
                        if($chk_hesa_stuload_student_info==false){
                            $hesa_stuload_student_info_arr = array();
                            $hesa_stuload_student_info_arr['year_of_the_course'] = $i;
                            $hesa_stuload_student_info_arr['student_load'] = 0;
                            $hesa_stuload_student_info_arr['student_data_id'] = $id;
                            $hesa_stuload_student_info_arr['register_id'] = $reg_data['id'];
                            $hesa_stuload_student_info_arr['hesa_disall_id'] = $data['hesa_student_information_data']['hesa_disall_id'];
                            $hesa_stuload_student_info_arr['hesa_exchind_id'] = $data['hesa_student_information_data']['hesa_exchind_id'];
                            //$hesa_stuload_student_info_arr['hesa_grossfee'] = $data['hesa_student_information_data']['hesa_exchind_id'];
                            $hesa_stuload_student_info_arr['hesa_locsdy_id'] = $data['hesa_student_information_data']['hesa_locsdy_id'];
                            $hesa_stuload_student_info_arr['hesa_mode_id'] = $data['hesa_student_information_data']['hesa_mode_id'];
                            empty($course_rel_hesa_data['hesa_mstufee_id']) ? $hesa_stuload_student_info_arr['hesa_mstufee_id'] = 0 : $hesa_stuload_student_info_arr['hesa_mstufee_id'] = $course_rel_hesa_data['hesa_mstufee_id'];
                            $hesa_stuload_student_info_arr['hesa_priprov_id'] = $data['hesa_student_information_data']['hesa_priprov_id'];
                            $hesa_stuload_student_info_arr['hesa_sselig_id'] = $data['hesa_student_information_data']['hesa_sselig_id'];
                            $hesa_stuload_student_info_arr['hesa_course_relation_instance_id'] = $v['id'];
                            $hesa_stuload_student_info_arr['hesa_periodstart'] = $v['start_date'];
                            $hesa_stuload_student_info_arr['hesa_periodend'] = $v['end_date'];
                            $this->hesa_stuload_student_info->add($hesa_stuload_student_info_arr);
                            
                            $hesa_instance[$i]['year_of_the_course'] = $i;
                            $hesa_instance[$i]['student_load'] = 0;
                            $hesa_instance[$i]['id'] = $v['id'];
                            $hesa_instance[$i]['instance_start_date'] = $v['start_date'];
                            $hesa_instance[$i]['instance_end_date'] = $v['end_date'];
                            
                        }else{
                            
/*                            $hesa_instance[$i]['year_of_the_course'] = $chk_hesa_stuload_student_info['year_of_the_course'];
                            $hesa_instance[$i]['student_load'] = $chk_hesa_stuload_student_info['student_load'];
                            $hesa_instance[$i]['student_load'] = $chk_hesa_stuload_student_info['student_load'];
                            $hesa_instance[$i]['id'] = $chk_hesa_stuload_student_info['id']; */
                            
                            foreach($chk_hesa_stuload_student_info as $key=>$val){
                                $hesa_instance[$i][$key] = $val;    
                            }
                            $hesa_instance[$i]['instance_start_date'] = $v['start_date'];                            
                            $hesa_instance[$i]['instance_end_date'] = $v['end_date'];                            
                            
                        }  
                        
                                              
                     }else if(strtotime($v['end_date']) >= time() && strtotime($v['start_date']) < time()){
                         
                         $chk_hesa_stuload_student_info = $this->hesa_stuload_student_info->get_by_hesa_course_relation_instance_id_student_data_id_register_id($v['id'],$id,$reg_data['id']);
                        if($chk_hesa_stuload_student_info==false){
                            $hesa_stuload_student_info_arr = array();
                            $hesa_stuload_student_info_arr['year_of_the_course'] = $i;
                            $hesa_stuload_student_info_arr['student_load'] = 0;
                            $hesa_stuload_student_info_arr['student_data_id'] = $id;
                            $hesa_stuload_student_info_arr['register_id'] = $reg_data['id'];
                            $hesa_stuload_student_info_arr['hesa_disall_id'] = $data['hesa_student_information_data']['hesa_disall_id'];
                            $hesa_stuload_student_info_arr['hesa_exchind_id'] = $data['hesa_student_information_data']['hesa_exchind_id'];
                            //$hesa_stuload_student_info_arr['hesa_grossfee'] = $data['hesa_student_information_data']['hesa_exchind_id'];
                            $hesa_stuload_student_info_arr['hesa_locsdy_id'] = $data['hesa_student_information_data']['hesa_locsdy_id'];
                            $hesa_stuload_student_info_arr['hesa_mode_id'] = $data['hesa_student_information_data']['hesa_mode_id'];
                            empty($course_rel_hesa_data['hesa_mstufee_id']) ? $hesa_stuload_student_info_arr['hesa_mstufee_id'] = 0 : $hesa_stuload_student_info_arr['hesa_mstufee_id'] = $course_rel_hesa_data['hesa_mstufee_id'];
                            $hesa_stuload_student_info_arr['hesa_priprov_id'] = $data['hesa_student_information_data']['hesa_priprov_id'];
                            $hesa_stuload_student_info_arr['hesa_sselig_id'] = $data['hesa_student_information_data']['hesa_sselig_id'];
                            $hesa_stuload_student_info_arr['hesa_course_relation_instance_id'] = $v['id'];
                            $hesa_stuload_student_info_arr['hesa_periodstart'] = $v['start_date'];
                            $hesa_stuload_student_info_arr['hesa_periodend'] = $v['end_date'];                            
                            $this->hesa_stuload_student_info->add($hesa_stuload_student_info_arr);
                            
                            $hesa_instance[$i]['year_of_the_course'] = $i;
                            $hesa_instance[$i]['student_load'] = 0;
                            $hesa_instance[$i]['id'] = $v['id'];
                            $hesa_instance[$i]['instance_start_date'] = $v['start_date'];
                            $hesa_instance[$i]['instance_end_date'] = $v['end_date'];                            
                            
                        }else{
                            
/*                            $hesa_instance[$i]['year_of_the_course'] = $chk_hesa_stuload_student_info['year_of_the_course'];
                            $hesa_instance[$i]['student_load'] = $chk_hesa_stuload_student_info['student_load'];
                            $hesa_instance[$i]['id'] = $chk_hesa_stuload_student_info['id'];*/ 
                            foreach($chk_hesa_stuload_student_info as $key=>$val){
                                $hesa_instance[$i][$key] = $val;    
                            }
                            $hesa_instance[$i]['instance_start_date'] = $v['start_date'];                            
                            $hesa_instance[$i]['instance_end_date'] = $v['end_date'];                                                                                   
                            
                        }
                        break;                         
                         
                     }else{
                         
                        $chk_hesa_stuload_student_info = $this->hesa_stuload_student_info->get_by_hesa_course_relation_instance_id_student_data_id_register_id($v['id'],$id,$reg_data['id']);
                        if($chk_hesa_stuload_student_info!=false){
                            $this->db->query("DELETE FROM ".$this->fixidb->hesa_stuload_student_info." WHERE hesa_course_relation_instance_id='".$v['id']."'");
                        } 
                     }
                     $i++;
                      
                  }
              }
        }  
 
        if(!empty($hesa_instance))$data['hesa_instance'] = $hesa_instance;
        
        //var_dump($hesa_instance);
        //var_dump($priv[1]);
        
        if($do=="application" && (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){  // All the part of student application is done by here
            

            $data['staff_id']        =   $varsessioncheck_id;      
                   
            $data['bodytitle']       =   "Live Student Details";
            $data['faicon']          =   "fa-eye";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Live Student Details";
            $data['ref']             =   'edit';
            
            $data["course_lists"]       =   $this->course_relation->get_by_current_date();
            $semister_list              =   $this->semister->get_all();
            foreach($semister_list as $v){
                $data["semesterlist"][$v['id']] = $v['semister_name'];        
            }
             
            $data["agent_list"]    =   $this->agent->get_all_active();

            //$data['gender']      = $this->student_gender->get_by_ID($this->student_data->);

            $data['country_list']     = $this->country->get_all();
            $data['ethnicity_list']   = $this->student_others_ethnicity->get_all();
            $data['disability_list'] = $this->student_others_disabilities->get_all();
                      
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }
              
            // var_dump($data['user_data']); die();
            
            $data['admission_status']   = $this->student_data->get_user_admission_status($id);            
            $data['ref']                = 'edit';
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);

            $reg_data = $this->register->get_by_student_ID($id);

            $data['hesa_domicile_list'] = $this->hesa_domicile->get_all();

            $data['hesa_domicile_info'] = $this->hesa_student_information->get_by_student_data_id_and_register_id($id,$reg_data['id']);
            
            $data['dont_upload_photo']        = 0;
    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/body_form');
            $this->load->view('staff/other_footer');                        
        
        
        }else if($do=="education" && (!empty($priv[3]) || $this->session->userdata('label')=="admin") ){  // All the part of student application is done by here
            
            // student data registration part view start
             
            // student data registration part view end         

            $data['staff_id']        =   $varsessioncheck_id;   
            $data['bodytitle']       =   "Education Details";
            $data['faicon']          =   "fa-eye";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Live Student Details > Education qualification and work experience";
            $data['ref']             =   'edit';
            
            $data["course_lists"]       =   $this->course_relation->get_by_current_date();
            $semister_list              =   $this->semister->get_all();
            foreach($semister_list as $v){
                $data["semesterlist"][$v['id']] = $v['semister_name'];        
            }
             
            $data["agent_list"]    =   $this->agent->get_all_active();
                      
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }
            
            $data['admission_status']   = $this->student_data->get_user_admission_status($id);            
            $data['ref']                = 'edit';
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);
            
            $data['dont_upload_photo']        = 0;

            
    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/body_form_education');
            $this->load->view('staff/other_footer');                        
        
        
        } else if($do=="archive" && (!empty($priv[8]) || $this->session->userdata('label')=="admin") ) {
            
            $data['bodytitle']       =   "Archive Details";
            $data['faicon']          =   "fa-archive";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Archive Details";
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }            
            $data['ref']             = 'edit';
            $data['archivelist']     = $this->archive->get_by_applicationID($id);
            $data['fullname']        = $this->student_data->get_fullname_by_ID($id); 
            
            $data['dont_upload_photo']        = 0;  
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/archive_view');
            $this->load->view('staff/other_footer');    
            
        }else if($do=="course" && (!empty($priv[2]) || $this->session->userdata('label')=="admin") ) {
            
            $data['bodytitle']       =   "Course Details";
            $data['faicon']          =   "fa-archive";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Course Details";
            

            $data["course_lists"]       =   $this->course_relation->get_by_current_date();
            $semister_list              =   $this->semister->get_all();
            foreach($semister_list as $v){
                $data["semesterlist"][$v['id']] = $v['semister_name'];        
            }
             
            $data["agent_list"]    =   $this->agent->get_all_active();
                      
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }
            
            $data['admission_status']   = $this->student_data->get_user_admission_status($id);            
            $data['ref']                = 'edit';
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);

            $data['awarding_body_ref']  = $this->student_information->get_awarding_body_ref_by_student_data_ID($id);

            //var_dump($data['awarding_body_ref']); die();
            // $register_id                = $this->register->get_id_by_student_data_ID($id);
            // $class_plan_id              = $this->student_assign_class->get_class_plan_id_by_register_id($register_id);
            // $course_relation_id         = $this->class_plan->get_course_relation_id_by_id($class_plan_id);

            $course_and_semister        = $this->student_data->get_student_course_and_semister_by_ID($id);
            $data['course_and_awarding_info']   = $this->course_relation->get_by_course_and_semester($course_and_semister->student_course, $course_and_semister->student_semister);
            $data['admission_date']     = $this->register->get_registration_date_by_student_data_ID($id);
            $data['dont_upload_photo']        = 0;

                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/course_form');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="account" && (!empty($priv[7]) || $this->session->userdata('label')=="admin") ) {
            
            $data['bodytitle']       =   "Account Details";
            $data['faicon']          =   "fa-archive";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Account Details";
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);
            

            $data["course_lists"]       =   $this->course_relation->get_by_current_date();
            $semister_list              =   $this->semister->get_all();
            foreach($semister_list as $v){
                $data["semesterlist"][$v['id']] = $v['semister_name'];        
            }
             
            $data["agent_list"]    =   $this->agent->get_all_active();
                      
            $std_data                	= $this->student_data->get_studentdata_for_edit($id);
            $reg_data 					= $this->register->get_by_student_ID($id);
	        $course_rel_data 			= $this->course_relation->get_by_course_and_semester($std_data['student_course'],$std_data['student_semister']);
	        $slc_coursecode 			= $this->slc_coursecode->get_by_course_relation_id($course_rel_data['ID']);
	          
	          foreach($std_data as $k=>$v){
	            $data['user_data'][$k] = addslashes(tinymce_decode($v));                
	          }
            $data['dont_upload_photo']        = 0;
            //var_dump($data['user_data']);
            $data['agreement_data']['course_relation_id']   = $course_rel_data['ID'];
            $data['agreement_data']['course_id']            = $std_data['student_course'];
            $data['agreement_data']['course_name']          = $this->course->get_name($std_data['student_course']);
            $data['agreement_data']['semister_id']          = $std_data['student_semister'];
            $data['agreement_data']['semister_name']        = $this->semister->get_name($std_data['student_semister']);
            $data['agreement_data']['register_id']          = $reg_data['id'];
            $data['agreement_data']['slc_coursecode_data']  = $slc_coursecode;
            
            if($reg_data['student_type']=="overseas") 
            $data['agreement_data']['fees']     = $course_rel_data['fees_2'];
            else if($reg_data['student_type']=="uk") 
            $data['agreement_data']['fees']     = $course_rel_data['fees_1'];
            
            //var_dump($data['agreement_data']);
            
			$data['prev_agreement_list']    = $this->agreement->get_all_by_register_id($reg_data['id']);
            $data['admission_status']       = $this->student_data->get_user_admission_status($id);            
            $data['ref']                    = 'edit';
            $data['fullname']               = $this->student_data->get_fullname_by_ID($id);   
            $data['payment_data']           = $this->money_receipt->get_all_by_register_id($reg_data['id']);
                        
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/account_form');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="note"  && (!empty($priv[5]) || $this->session->userdata('label')=="admin")  ) {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Notes";
            $data['faicon']          =   "fa-pencil-square-o";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Staff notes";
            $data['ref']             =   'edit';
            $data['noteslist']       =   $this->notes->get_by_applicationID($id);
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);
            $data['staff_list']      =  $this->staff->get_all(); 
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }                
            $data['dont_upload_photo']        = 0;
            
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/notes_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="upload" && (!empty($priv[4]) || $this->session->userdata('label')=="admin") ) {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Upload Files";
            $data['faicon']          =   "fa-upload";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Uploaded Student files";
            $data['ref']             = 'edit';
            $data['uploadlist']      = $this->staff_upload->get_by_applicationID($id);
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }                
            $data['dont_upload_photo']        = 1;
            
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/upload_view');
            $this->load->view('staff/other_footer');    
            
        } else if($do=="communication" && (!empty($priv[6]) || $this->session->userdata('label')=="admin")  ) {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Communication logs";
            $data['faicon']          =   "fa-comments-o";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Communication logs";
            $data['ref']             =   'edit';
            $data['letterlists']     =  $this->letter_issuing->get_by_student_data_id($data['ref_id']);
            $data['letterlists']     =  array_reverse($data['letterlists']);
            $data['fullname']        =  $this->student_data->get_fullname_by_ID($id);

            $data['emaillists']      = $this->email_issuing->get_by_student_data_id($data['ref_id']);
            $data['smslists']        = $this->sms_issuing->get_by_student_data_id($data['ref_id']);

            $data['emaillists']      = array_reverse($data['emaillists']);
            $data['smslists']        = array_reverse($data['smslists']);

            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
              foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
              }
            $reg_data = $data['reg_data'] = $this->register->get_by_student_ID($id);  
              
            //var_dump($data['user_data']);   
            //var_dump($reg_data);   
            $data['dont_upload_photo']= 0;
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/communication_view');
            
            $this->load->view('staff/other_footer');    
            
        }else if($do=="attendance"  && (!empty($priv[9]) || $this->session->userdata('label')=="admin")  ) {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Attendance List";
            $data['faicon']          =   "fa-fw fa-check-square-o";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Attendance List";
            $data['ref']             =   'edit';
            $data['fullname']           = $this->student_data->get_fullname_by_ID($id);
            $total                   =  array();

            $std_data                = $this->student_data->get_studentdata_for_edit($id);
            $register_id             = $this->register->get_id_by_student_data_ID($this->input->get('id'));

            $student_assing_class_list = $this->student_assign_class->get_by_register_id($register_id);

            foreach ($student_assing_class_list as $a => $b) {
              $total[] =  $this->attendance->get_attendance_by_register_id_and_class_plan_id($b['register_id'], $b['class_plan_id']);
            }
            if(!empty($total)) {
              $data['total_class_passed'] = count($total);
              
            } else {
              $data['total_class_passed'] = 1;
            }
            
  
            foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
            }
           

            foreach($data['user_data'] as $k=>$v){
                if($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==1){

                    $course_id = $this->course->get_ID_by_name($v);
                    
                }elseif($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==0){

                    $course_id = $v;

                }
                if($k=="student_semister" && preg_match("/[a-zA-Z]/", $v)==1){

                    $semister_id = $this->semister->get_ID_by_name($v);
                    
                }elseif($k=="student_semister" && preg_match("/[a-zA-Z]/", $v)==0){

                    $semister_id = $v;

                }
            }

            $data['course_relation_id'] = $this->course_relation->get_ID_by_course_ID_semester_ID($course_id, $semister_id);
            
            $data['course_level_list'] = $this->course_level->get_by_course_ID($course_id);

            $data['course_level_list'] = array_reverse($data['course_level_list']);
            
            $data['dont_upload_photo']        = 0;
                
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/attendance_view');
            
            $this->load->view('staff/other_footer');    
            
        } else if($do=="result" && (!empty($priv[10]) || $this->session->userdata('label')=="admin")  ) {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Result List";
            $data['faicon']          =   "fa-list";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Result List";
            $data['ref']             =   'edit';
            $data['fullname']        = $this->student_data->get_fullname_by_ID($id);

            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
            foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
            }
           

            foreach($data['user_data'] as $k=>$v){
                if($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==1){

                    $course_id = $this->course->get_ID_by_name($v);
                    
                }elseif($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==0){

                    $course_id = $v;

                }
                if($k=="student_semister" && preg_match("/[a-zA-Z]/", $v)==1){

                    $semister_id = $this->semister->get_ID_by_name($v);
                    
                }elseif($k=="student_semister" && preg_match("/[a-zA-Z]/", $v)==0){

                    $semister_id = $v;

                }
            }

            
            
            
            $data['course_relation_id_awarding_id'] = $this->course_relation->get_ID_and_awarding_id_by_course_ID_semester_ID($course_id, $semister_id);
            //var_dump($data['course_relation_id_awarding_id']); die();
            $data['course_level_list'] = $this->course_level->get_by_course_ID($course_id);

            $data['course_level_list'] = array_reverse($data['course_level_list']);
            
            $data['dont_upload_photo']        = 0;


            //Previous result
            // var_dump($id);
            $data['prev_result'] = $this->exam_result_prev->get_by_student_data_id($id);
            // var_dump($data['prev_result']); die();
                
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/result_view');
            
            $this->load->view('staff/other_footer');    
            
        } else if($do=="slc-history" && (!empty($priv[11]) || $this->session->userdata('label')=="admin")  ) {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "Result List";
            $data['faicon']          =   "fa-list";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > Result List";
            $data['ref']             =   'edit';
            $data['fullname']        = $this->student_data->get_fullname_by_ID($id);
            $data['register_id']     = $this->register->get_id_by_student_data_ID($this->input->get('id'));

            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
            foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
            }
           // var_dump($data['user_data']); die();

            $data['add_registration_info']  = $this->registration_history->get_by_register_id($data['register_id']);
            $data['attendance_history']     = $this->attendance_history->get_by_register_id($data['register_id']);
            $data['coc_history']            = $this->coc_history->get_by_register_id($data['register_id']);
            $data['coc_upload']            = $this->coc_upload->get_by_register_id($data['register_id']);
            //var_dump($data['attendance_history']); die();
            $data['dont_upload_photo']        = 1;
            
                
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/slc_history_view');
            
            $this->load->view('staff/other_footer');
            
            
        } else if($do=="login"  && (!empty($priv[12]) || $this->session->userdata('label')=="admin") ) {
        	
            $data['staff_id']           =   $varsessioncheck_id;
            $data['bodytitle']          =   "Login to Student Panel";
            $data['faicon']             =   "fa-unlock-alt";
            $data['breadcrumbtitle']    =   "Dashboard > Live Student > Login to Student Panel";
            $data['ref']                = 	'edit';

            $data['fullname']        = $this->student_data->get_fullname_by_ID($id);
            $data['register_id']     = $this->register->get_id_by_student_data_ID($this->input->get('id'));

            $std_data                = $this->student_data->get_studentdata_for_edit($id);
  
            foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
            }            
            $data['dont_upload_photo']        = 0;

            $new_activate_session_id = $this->student_data->change_activate_session_id_by_student_data_id($id);
            if($new_activate_session_id!=false) $data['new_activate_session_id'] = $new_activate_session_id; 
                
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/staff_login_to_student_view');
            
            $this->load->view('staff/other_footer');
            
            
            
        } else if($do=="hesa"  && (!empty($priv[13]) || $this->session->userdata('label')=="admin")) {
            $id                         =   $this->input->get('id');
            

            $data['staff_id']           =   $varsessioncheck_id;
            $data['bodytitle']          =   "Hesa Information";
            $data['faicon']             =   "fa-unlock-alt";
            $data['breadcrumbtitle']    =   "Dashboard > Live Student > Hesa Information";
            $data['ref']                =     'edit';

            $data['fullname']        = $this->student_data->get_fullname_by_ID($id);
            $data['register_id']     = $this->register->get_id_by_student_data_ID($this->input->get('id'));
            $std_data                = $this->student_data->get_studentdata_for_edit($id);
            //var_dump($std_data); die();

            $data['course_rel_data']      = $this->course_relation->get_by_course_and_semester($std_data['student_course'],$std_data['student_semister']);

            $data['hesa_course_relation_unitlgth'] = $this->hesa_course_relation_unitlgth->get_by_course_relation_ID($data['course_rel_data']['ID']);
  
            foreach($std_data as $k=>$v){
                $data['user_data'][$k] = addslashes(tinymce_decode($v));                
            }            
            $data['dont_upload_photo']        = 0;

            $new_activate_session_id = $this->student_data->change_activate_session_id_by_student_data_id($id);
            if($new_activate_session_id!=false) $data['new_activate_session_id'] = $new_activate_session_id;
 
                
                    
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/student_admission_search_body');
            
            $this->load->view('staff/sm/student/body_form_top');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/sm/student/hesa_info.php');
            
            $this->load->view('staff/other_footer');                        
            
            
                
            
        } else if($do=="") {
            
            $data['staff_id']        =   $varsessioncheck_id;
            $data['bodytitle']       =   "";
            $data['faicon']          =   "";
            $data['breadcrumbtitle'] =   "Dashboard > Live Student > ";
            $data['ref']             = 'edit';            
            $data['do']                ="";
            $data['dont_upload_photo']        = 0;
            
            $this->load->view('staff/dashboard_header',$data);    
            $this->load->view('staff/dashboard_topmenu');
            $this->load->view('staff/dashboard_sidebar');
            $this->load->view('staff/sm/student_admission_search_body');
            $this->load->view('staff/sm/student_admission_link_body');
            $this->load->view('staff/other_footer');            
            
        }
        
    $this->load->view('staff/sm/student/registration_input_disabled');
	
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
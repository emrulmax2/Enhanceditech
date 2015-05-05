<?php
  
class Student_information extends CI_Model {
     
     public $user_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('semister','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('agent','',TRUE);
        $this->load->model('student_data','',TRUE);
        $this->load->model('register','',TRUE);
        $this->load->model('status','',TRUE);
        //$this->load->model('student_data','',TRUE);
        $this->load->library('session');   

    }
        
    /**
    * update user basic information
    * 'ID'=>$this->user_id,
    * 'username'=>'',
    * 'user_email'=>'',
    * 'password'=>'',
    * 'last_login'=>'',
    * 'active'=>1
    * @param ARRAY $args 
    * @return TRUE if succefully update else return False
    */    
    function update($args=array())
    {

      $this->db->update($this->fixidb->student_information,$args,array('id'=>$args['id']));
      
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }

    function update_by_student_data_id($args=array())
    {

      $this->db->update($this->fixidb->student_information,$args,array('student_data_id'=>$args['student_data_id']));
      
      if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }

    function update_attendance_parcent($args=array())
    {
        foreach($args as $k =>$v) {
            if(empty($v)) {
                unset($args[$k]);
            }
        }
     $this->db->update($this->fixidb->student_information,$args,array('student_data_id'=>$args['student_data_id'], 'registration_id'=>$args['registration_id']));
      
     if($this->db->affected_rows()>0) return TRUE;
    
     return FALSE;
     
    }     
    /**
    * insert user information
    * 
    * @return inserted id else return false
    */
    function add($args=array())
    {

        
     $this->db->insert($this->fixidb->student_information,$args);
     return $this->db->insert_id();
     
    }    

    /**
    * delete user by id
    * 
    * @param mixed $user_id
    * @return user id if data is deleted else return false.
    */
    function delete($user_id){
     
        if(isset($user_id)){
            $user_id        =   (int)$user_id;
            $this->db->delete($this->fixidb->student_information,array('id'    =>  $user_id));
            
            return $user_id;
        }else{
          return FALSE;  
        }
        
    }
    /*
    *
    * get all user
    * 
    * 
    * @return user id if data is deleted else return false.
    */
    function get_all(){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->get($this->fixidb->student_information);
        $i=0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;
        $i=0;
        foreach($query->result() as $row):
             for($count=0; $count < count($fieldlist); $count++) {
                $data[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
             }
         $i++; 
        endforeach; 
          
       return $data; 
        
    }
    
    
    function get_by_ID($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_information." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
        $i=0;
        foreach($query->list_fields() as $field):
         $fieldlist[$i] = $field;
         $i++;
        endforeach;
        $i=0;
        foreach($query->result() as $row):
             for($count=0; $count < count($fieldlist); $count++) {
                $data[$fieldlist[$count]] = $row->$fieldlist[$count];
             }
         $i++; 
        endforeach; 
          
       return $data; 
        
    }
    
    function get_name_by_id($id){
		
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->student_information." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");	
		//return $id;
  		if($query->num_rows()>0){
  			//return "yes";
  			return $query->row()->name;	
  		} 		
    }

    function get_by_student_data_id($id){
    
    $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_information." WHERE student_data_id='".$id."' LIMIT 1"); 
    //return $id;
      if($query->num_rows()>0){
        //return "yes";
        return $query->row(); 
      }     
    }
  function get_by_student_data_id_and_registration_no($student_data_id, $registration_id){
    
    $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_information." WHERE student_data_id='".$student_data_id."' AND registration_id='".$registration_id."' LIMIT 1"); 
    //return $id;
      if($query->num_rows()>0){
        //return "yes";
        return $query->row(); 
      }     
    }
    
    function get_by_student_data_id_by_array($id){
    
	    $query=$this->db->query("SELECT * FROM ".$this->fixidb->student_information." WHERE student_data_id='".$id."' LIMIT 1"); 
	    //return $id;
	      if($query->num_rows()>0){
	        //return "yes";
	        return $query->row_array(); 
	      }     
    }    
    

     function get_student_data_ID_no_by_status($status="") {                  

            $query=$this->db->query("SELECT student_data_id FROM ".$this->fixidb->student_information." WHERE status='".$status."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->student_data_id;
     }
     
     function get_awarding_body_ref_by_student_data_ID($student_data_id="") {                  

            $query=$this->db->query("SELECT awarding_body_ref FROM ".$this->fixidb->student_information." WHERE student_data_id='".$student_data_id."' ORDER BY `id` ASC LIMIT 1");
   
            if($query->num_rows()>0) return $query->row()->awarding_body_ref;
     }

    function makeStudentListWithpagination($args,$page,$targetpage,$hasAction){
        
                      $si  = $this->fixidb->student_information;
                      $sd  = $this->fixidb->student_data;
                      $reg = $this->fixidb->register;        
        
            ///--------sort
                 $sesData = $this->session->userdata("student_admission_search");
                 !empty($sesData['sortby']) ? $sortby = $sesData['sortby'] : $sortby="";            
                //var_dump($sortby);
                if($sortby=="registration_no_desc")
                   $sortby = "rs.registration_no DESC"; 
                else if($sortby=="registration_no_asc")
                    $sortby = "rs.registration_no ASC";
                    
                else if($sortby=="student_first_name_desc")
                   $sortby = "sd.student_first_name DESC"; 
                else if($sortby=="student_first_name_asc")
                    $sortby = "sd.student_first_name ASC";
                    
                else if($sortby=="student_sur_name_desc")
                   $sortby = "sd.student_sur_name DESC"; 
                else if($sortby=="student_sur_name_asc")
                    $sortby = "sd.student_sur_name ASC";
                    
                else if($sortby=="student_date_of_birth_desc")
                   $sortby = "sd.student_date_of_birth DESC"; 
                else if($sortby=="student_date_of_birth_asc")
                    $sortby = "sd.student_date_of_birth ASC";

                    
                else if($sortby=="student_course_desc")
                   $sortby = "sd.student_course DESC"; 
                else if($sortby=="student_course_asc")
                    $sortby = "sd.student_course ASC";
                    
                else if($sortby=="student_nationality_desc")
                   $sortby = "sd.student_nationality DESC"; 
                else if($sortby=="student_nationality_asc")
                    $sortby = "sd.student_nationality ASC";                    
                    
                else if($sortby=="status_desc")
                   $sortby = "si.status DESC"; 
                else if($sortby=="status_asc")
                    $sortby = "si.status ASC";                                                                                                                        
                
                else
                   $sortby = "";      
            
            ///--------- end of sort        
      
      if(!is_array($args) && $args=="all"){
        
        $query="SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none' AND student_admission_status_for_staff!='Offer placed' AND student_admission_status_for_staff!='Offer accepted'";
        
      }else if(!is_array($args) && $args=="all_for_agent"){
        
        $query="SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff!='none' && agent_id='".$this->session->userdata('uid')."'";
                
        
      }else if(is_array($args) && $args!="all"){
          
          
          
        
          foreach($args as $k=>$v){           
            $$k = $v;           
          }
          $query = "";
          if($this->router->class == "student_management"){//---------- if come from Student and need all ACCEPTED students
                      
                    

                      $si  = $this->fixidb->student_information;
                      $sd  = $this->fixidb->student_data;
                      $reg = $this->fixidb->register;
                      $and = " AND ";

                      if(!empty($student_admission_status_for_staff)){
                        //$query .= "SELECT  ".$reg.".*, ".$si.".*, ".$sd.".* FROM ".$sd." INNER JOIN ".$si." ON ".$si.".student_data_id=".$sd.".id INNER JOIN ".$reg." ON ".$sd.".id=".$reg.".student_data_id WHERE ".$si.".status = ".$student_admission_status_for_staff."";

                        $query = "SELECT rs.*, si.*, sd.* From ".$reg." AS rs LEFT JOIN ".$si." AS si ON si.student_data_id = rs.student_data_id LEFT JOIN ".$sd." AS sd ON sd.id = rs.student_data_id  WHERE si.status = ".$student_admission_status_for_staff."";

                        // $this->db->select('*');
                        // $this->db->from($sd);
                        // $this->db->join($si, "$si.student_data_id = $sd.id");
                        // $this->db->join($reg, "$reg.student_data_id = $sd.id");
                        // $this->db->where("$si.status", $student_admission_status_for_staff);

                        // $query12 = $this->db->get();
                        // var_dump($query); die();
                        
                      } else {
                        //$query .= "SELECT  ".$reg.".*, ".$si.".*, ".$sd.".* FROM ".$sd." INNER JOIN ".$si." ON ".$si.".student_data_id=".$sd.".id INNER JOIN ".$reg." ON ".$sd.".id=".$reg.".student_data_id WHERE 1=1";
                        $query .= "SELECT rs.*, si.*, sd.* From ".$reg." AS rs LEFT JOIN ".$si." AS si ON si.student_data_id = rs.student_data_id LEFT JOIN ".$sd." AS sd ON sd.id = rs.student_data_id WHERE 1=1";
                      }



                        if(!empty($registration_no)){
                          $query .= $and."rs.registration_no = '".$registration_no."'"; $and = " AND "; $sql_And = " AND ";
                        }
                        if(!empty($student_application_reference_no)){
                             
                             $query .= $and."sd.student_application_reference_no = '".$student_application_reference_no."'"; $and = " AND "; $sql_And = " AND ";
                         }
                         
                         if(!empty($ssn)){
                             $query .= $and."rs.ssn = '".$ssn."'"; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($student_first_name)){
                             
                             $query .= $and."sd.student_first_name LIKE '%".$student_first_name."%'"; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($student_sur_name)){
                             
                             $query .= $and."sd.student_sur_name LIKE '%".$student_sur_name."%'"; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($dob_d) && !empty($dob_m) && !empty($dob_y)){
                             
                             $query .= $and."sd.student_date_of_birth LIKE '%".$dob_d."/".$dob_m."/".$dob_y."%'"; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($semester_id)){
                             $semester_name = $this->semister->get_name($semester_id);
                             $query .= $and." (sd.student_semister = '".$semester_name."' OR sd.student_semister = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($course_id)){
                             $course_name = $this->course->get_name($course_id);
                             $query .= $and." (sd.student_course = '".$course_name."'  OR sd.student_course = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($student_type)){
                             $query .= $and."sd.student_type = '".$student_type."'"; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($awarding_body_ref)){
                             $query .= $and."si.awarding_body_ref = '".$awarding_body_ref."'"; $and = " AND "; $sql_And = " AND ";
                         }                         

                       if(!empty($sortby))  $query .= " ORDER BY ".$sortby;
                       else
                       $query .= " ORDER BY rs.id DESC";

                    
                                               
          }//----------   
        
        
      }
      //echo $query;
      // var_dump($query);
      $output = $this->getPaginationCustom($query,$page,$targetpage,$hasAction);  
      //var_dump($sortby);
      //return $output['row_array'];
      
      if($this->router->class == "student_management") {
        $htmlOutput = "<table class='table table-hover student-management-list'>";
      } else {
        $htmlOutput = "<table class='table table-hover search-student-list'>";
          
      }
       
      $htmlOutput .= "<thead>
                
                        <tr>
                         <th colspan='4'>Search Result</th>
                         <th colspan='3' class='text-right'>Total Result: ".$output['total_rec']."</th>
                        </tr>                       
                <tr>";
      
      if($sortby=="rs.registration_no DESC") $htmlOutput .="<th>Student ID<a href='$targetpage&sortby=registration_no_asc'><i class='fa fa-chevron-circle-up'></i></a></th>"; else $htmlOutput .="<th>Student ID<a href='$targetpage&sortby=registration_no_desc'><i class='fa fa-chevron-circle-down'></i></a></th>"; 
      if($sortby=="sd.student_first_name DESC") $htmlOutput .="<th>First Name<a href='$targetpage&sortby=student_first_name_asc'><i class='fa fa-chevron-circle-up'></i></a></th>"; else $htmlOutput .="<th>First Name<a href='$targetpage&sortby=student_first_name_desc'><i class='fa fa-chevron-circle-down'></i></a></th>";                    
      if($sortby=="sd.student_sur_name DESC") $htmlOutput .="<th>Surname<a href='$targetpage&sortby=student_sur_name_asc'><i class='fa fa-chevron-circle-up'></i></a></th>"; else $htmlOutput .="<th>Surname<a href='$targetpage&sortby=student_sur_name_desc'><i class='fa fa-chevron-circle-down'></i></a></th>";                    
      if($sortby=="sd.student_date_of_birth DESC") $htmlOutput .="<th>Date of Birth<a href='$targetpage&sortby=student_date_of_birth_asc'><i class='fa fa-chevron-circle-up'></i></a></th>"; else $htmlOutput .="<th>Date of Birth<a href='$targetpage&sortby=student_date_of_birth_desc'><i class='fa fa-chevron-circle-down'></i></a></th>"; 
      if($sortby=="sd.student_course DESC") $htmlOutput .="<th>Course<a href='$targetpage&sortby=student_course_asc'><i class='fa fa-chevron-circle-up'></i></a></th>"; else $htmlOutput .="<th>Course<a href='$targetpage&sortby=student_course_desc'><i class='fa fa-chevron-circle-down'></i></a></th>";
      if($sortby=="sd.student_nationality DESC") $htmlOutput .="<th>Nationality<a href='$targetpage&sortby=student_nationality_asc'><i class='fa fa-chevron-circle-up'></i></a></th>"; else $htmlOutput .="<th>Nationality<a href='$targetpage&sortby=student_nationality_desc'><i class='fa fa-chevron-circle-down'></i></a></th>";
      if($sortby=="si.status DESC") $htmlOutput .="<th>Status<a href='$targetpage&sortby=status_asc'><i class='fa fa-chevron-circle-up'></i></a></th>"; else $htmlOutput .="<th>Status<a href='$targetpage&sortby=status_desc'><i class='fa fa-chevron-circle-down'></i></a></th>";
      
      $htmlOutput .= "</tr>
              </thead>
              <tbody>";

//<a href='$targetpage&sortby=student_application_reference_no_desc'><i class='fa fa-chevron-circle-down'></i></a>
//                  <th>Student ID".$sortby=="rs.registration_no DESC" ? "<a href='$targetpage&sortby=registration_no_asc'><i class='fa fa-chevron-circle-up'></i></a>" : "<a href='$targetpage&sortby=registration_no_desc'><i class='fa fa-chevron-circle-down'></i></a>" ."</th>      
      
      //for($i=0;$i<count($output['row_array']);$i++){
        //////////////////////////////////////////////////////      
      /// get staff access
      if($this->session->userdata('label')=="staff"){
        $staff_privileges_student_admission = $data['staff_privileges_student_admission'] = $this->session->userdata('staff_privileges_student_admission');   
      }     
        /////////////////////////////////////////////////////       
      
      if($output['total_rec']>0){

        //$output['row_array'] = array_reverse($output['row_array']);
  
          //var_dump($output['row_array']); die();
        foreach($output['row_array'] as $k=>$v){
          //if( $this->session->userdata('label')!="agent" && empty($staff_privileges_student_admission['std_ad_view_app']) && empty($staff_privileges_student_admission['std_ad_edit_app']) ) $htmlOutput .= "<tr id=''>"; else if($this->session->userdata('label')=="admin" || ($this->session->userdata('label')=="agent" || ($this->session->userdata('label')=="staff" && !empty($staff_privileges_student_admission['std_ad_view_app']) && !empty($staff_privileges_student_admission['std_ad_edit_app'])) ) ) $htmlOutput .= "<tr id='".$v['id']."'>";  
          if($this->session->userdata('label')=="staff" && empty($staff_privileges_student_admission['std_ad_view_app']) && empty($staff_privileges_student_admission['std_ad_edit_app']))  $htmlOutput .= "<tr id=''>";

          else
          $htmlOutput .= "<tr id='".$v['id']."'>"; 
          $htmlOutput .= "<td>".$v['registration_no']."</td>";
          $htmlOutput .= "<td>".ucwords(strtolower($v['student_first_name']))."</td>";
          $htmlOutput .= "<td>".ucwords(strtolower($v['student_sur_name']))."</td>";
          $htmlOutput .= "<td>".$v['student_date_of_birth']."</td>";
          
        
          $htmlOutput .= "</td>";
                    $htmlOutput .= "<td>";
                    if(is_numeric($v['student_course'])){
                        $coursename=$this->course->get_name((int)$v['student_course']);
                     $htmlOutput .= $coursename;   
                    }else {
                    $htmlOutput .= $v['student_course'];
                    }
          $htmlOutput .= "</td>";
            if(is_numeric($v['student_nationality'])) {
              $htmlOutput .= "<td>".$this->country->get_name_by_id($v['student_nationality'])."</td>";
            } else {              
            $htmlOutput .= "<td>".$v['student_nationality']."</td>";
            }
          $htmlOutput .= "<td>".$this->status->get_name_by_id($v['status'])."</td>";        
            
          $htmlOutput .= "</tr>";
          
          
          
        }
        //----for excel export

                //echo "my_search_sql: ".var_dump($output['search_sql']);
                //echo "current_session_search_sql: ".var_dump($this->session->userdata('search_sql'));

          $arr = array();
          $arr['search_sql'] = str_replace("%","PERCENTMASUM888",$output['search_sql']); 
          

                    
        $this->session->set_userdata($arr);
        
        //echo "new_session_search_sql: ".var_dump($this->session->userdata('search_sql'));
        
      //}
      
      
      $htmlOutput .= "</tbody></table><div class='clearfix text-center'>".$output['pagination']."</div>";
      
      }else{
        
        $htmlOutput .= "<tr><td colspan='7'>No matches found.</td></tr></tbody></table>"; 
      }
      
       return $htmlOutput;
     }  
                 

      function getPaginationCustom($sql_query,$page,$targetpage,$hasAction){


    if($hasAction=="yes") $pp = "&"; else $pp = "?";
    
    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
    

        
    $query=$this->db->query($sql_query);
        //echo "working query: ".var_dump($sql_query);
    $total_pages = $query->num_rows();
    


    $limit = 20;                //how many items to show per page
    //$page = $_GET['page'];
    if($page) 
      $start = ($page - 1) * $limit;      //first item to display on this page
    else
      $start = 0;               //if no page var is given, set start to 0
    

    $sql=$this->db->query($sql_query." LIMIT $start, $limit");

    

    if ($page == 0) $page = 1;          //if no page var is given, default to 1.
    $prev = $page - 1;              //previous page is page - 1
    $next = $page + 1;              //next page is page + 1
    $lastpage = ceil($total_pages/$limit);    //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;            //last page minus 1
    
    /* 
      Now we apply our rules and draw the pagination object. 
      We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = "";
    if($lastpage > 1)
    { 
      $pagination .= "<ul class=\"pagination\">";
      //previous button
      if ($page > 1) 
        $pagination.= "<li><a href=\"$targetpage".$pp."page=$prev\">previous</a></li>";
      else
        $pagination.= "<li class=\"disabled\"><a href=\"#\" >previous</a></li>";  
      
      //pages 
      if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
      { 
        for ($counter = 1; $counter <= $lastpage; $counter++)
        {
          if ($counter == $page)
            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
          else
            $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
        }
      }
      elseif($lastpage > 5 + ($adjacents * 2))  //enough pages to hide some
      {
        //close to beginning; only hide later pages
        if($page < 1 + ($adjacents * 2))    
        {
          for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
          {
            if ($counter == $page)
              $pagination.= "<li class=\"active\"><a href=\"#\">$counter</span></li>";
            else
              $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
          }
          $pagination.= "<li><a href=\"#\">...</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";    
        }
        //in middle; hide some front and some back
        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
        {
          $pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
          $pagination.= "<li><a href=\"#\">...</a></li>";
          for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
          {
            if ($counter == $page)
              $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
            else
              $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
          }
          $pagination.= "<li><a href=\"#\">...</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";    
        }
        //close to end; only hide early pages
        else
        {
          $pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
          $pagination.= "<li><a href=\"#\">...</a></li>";
          for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
          {
            if ($counter == $page)
              $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
            else
              $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
          }
        }
      }
      
      //next button
      if ($page < $counter - 1) 
        $pagination.= "<li><a href=\"$targetpage".$pp."page=$next\">next</a></li>";
      else
        $pagination.= "<li class=\"disabled\"><a href=\"#\">next</a></li>";
      $pagination.= "</ul>\n";    
    }
            
      $output = array();
      if ($sql->num_rows() > 0)
      {
        $fieldlist = array(); $i=0;

            $si  = $this->fixidb->student_information;
            $sd  = $this->fixidb->student_data;
            $reg = $this->fixidb->register;
            if(isset($_POST['student_admission_status_for_staff'])) {

              $this->db->select('*');
              $this->db->from($reg);
              $this->db->join($si, "$si.student_data_id = $reg.student_data_id", 'right');
              $this->db->join($sd, "$reg.student_data_id = $sd.id", 'left');
              $this->db->where("$si.status", $_POST['student_admission_status_for_staff']);
              $field_query = $this->db->get();

            } else {
              //$query = "SELECT sd.*, si.*, rs.* From ".$reg." AS rs INNER JOIN ".$si." AS si ON si.student_data_id = rs.student_data_id INNER JOIN ".$sd." AS sd ON sd.id = rs.student_data_id WHERE 1=1";
              $this->db->select('*');
              $this->db->from($reg);
              $this->db->join($si, "$si.student_data_id = $reg.student_data_id", 'right');
              $this->db->join($sd, "$reg.student_data_id = $sd.id", 'left');
              $field_query = $this->db->get();
            }

            

            foreach($field_query->list_fields() as $field):
             $fieldlist[$i] = $field;
             $i++;
            endforeach;       
        $i=0; $row_array = array(); 
        foreach($sql->result() as $row){
              for($count=0; $count < count($fieldlist); $count++) {
                $row_array[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
              }                 

          $i++;
              }

        
         //$row = $sql->row_array();
         $output['search_sql'] = $sql_query;
               $output['row_array'] = $row_array;
               $output['pagination'] = $pagination;
               $output['total_rec'] = $total_pages;
      }else{
        $output['search_sql'] = $sql_query; 
               $output['row_array'] = "";
               $output['pagination'] = "";
               $output['total_rec'] = 0;        
      } 

      return $output; 


    
  }








function makeReportSearchWithpagination($args,$page,$targetpage,$hasAction){
        
    $si  = $this->fixidb->student_information;
    $sd  = $this->fixidb->student_data;
    $reg = $this->fixidb->register;        
        
    $sesData = $this->session->userdata("report_management_student_search");
                     
            
                  
      
    if(is_array($args) && !empty($args)){
          
          
          
        
          foreach($args as $k=>$v){           
            $$k = $v;           
          }
          $query = "";
          if($this->router->class == "new_report_management"){//---------- if come from new_report_management
                      
                    

                      $si  = $this->fixidb->student_information;
                      $sd  = $this->fixidb->student_data;
                      $reg = $this->fixidb->register;
                      $sac = $this->fixidb->student_assign_class;
                      $and = " AND ";

                      if(!empty($student_admission_status_for_staff)){                        

                        $query = "SELECT rs.id, si.id, sd.id From ".$reg." AS rs LEFT JOIN ".$si." AS si ON si.student_data_id = rs.student_data_id LEFT JOIN ".$sd." AS sd ON sd.id = rs.student_data_id  WHERE si.status = ".$student_admission_status_for_staff."";                        
                        
                      } else {
                        
                        $query .= "SELECT rs.id, si.id, sd.id From ".$reg." AS rs LEFT JOIN ".$si." AS si ON si.student_data_id = rs.student_data_id LEFT JOIN ".$sd." AS sd ON sd.id = rs.student_data_id WHERE 1=1";
                      }



                       
                         if(!empty($semester_id)){
                             $semester_name = $this->semister->get_name($semester_id);
                             $query .= $and." (sd.student_semister = '".$semester_name."' OR sd.student_semister = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
                         }
                         if(!empty($course_id) && empty($level_name)){
                             $course_name = $this->course->get_name($course_id);
                             $query .= $and." (sd.student_course = '".$course_name."'  OR sd.student_course = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
                         }

                         if(!empty($level_name)){

                            if (!empty($course_id)) {

                              $level_id_list = $this->course_level->get_by_course_id_and_level_name($course_id, $level_name);
                              //var_dump($level_id_list); die();

                            } else {

                              $level_id_list = $this->course_level->get_id_list_by_name($level_name);
                              
                            }

                            //var_dump($level_id_list); die();

                            $student_list = array();
                            
                            if (!empty($level_id_list)) {
                              foreach ($level_id_list as $x => $y) {

                                if(!empty($module_id)) {
                                  $moduleIdList = array(0=>array('id'=>$module_id));
                                } else {
                                  $moduleIdList = $this->coursemodule->get_by_level_id($y['id']);
                                }

                                

                                if (!empty($moduleIdList)) {
                                  //var_dump($moduleIdList); //die();



                                  foreach ($moduleIdList as $key => $value) {

                                    if (!empty($group_name)) 
                                    {
                                      $class_plan_list = $this->class_plan->get_id_by_course_module_id_and_group($value['id'], $group_name);
                                      
                                    } else {

                                      $class_plan_list = $this->class_plan->get_id_by_course_module_id($value['id']);
                                    }



                                    if (!empty($class_plan_list)) {
                                      // var_dump($class_plan_list); die();
                                      foreach ($class_plan_list as $l => $m) {
                                        $student_list = $this->student_assign_class->get_register_id_by_class_plan_id($m['id']);

                                         // var_dump($student_list);

                                        if (!empty($student_list)) {
                                          //array_unique($student_list);
                                          foreach ($student_list as $o => $p) {
                                            //var_dump($p);
                                            $std_id = $this->register->get_student_data_ID_no_by_register_id($p['register_id']);
                                            //var_dump($std_id);

                                            $check_status = $this->student_information->get_by_student_data_id_and_registration_no($std_id, $p['register_id']);

                                            if (!empty($student_admission_status_for_staff)) {
                                              if ( !empty($check_status) && $check_status->status != $student_admission_status_for_staff) {
                                                continue;
                                              }
                                            }

                                            if (!empty($student_type) ) {
                                              if ( !empty($std_course) && $std_course->student_type != $student_type) {
                                                continue;
                                              }
                                            }



                                            if (!empty($student_attendance) ) {
                                              if ( !empty($check_status) && $check_status->attendance_parcent >= $student_attendance) {
                                                continue;
                                              }
                                            }

                                            if (!empty($course_id)) {
                                              $std_course = $this->student_data->get_course_by_ID($std_id);
                                              if ($std_course->student_course == $course_id) {

                                                $query .= $and." sd.id = '".$std_id."' "; $and = " OR "; $sql_And = " AND ";

                                              }
                                            } else {
                                              $query .= $and." sd.id = '".$std_id."' "; $and = " OR "; $sql_And = " AND ";
                                            }                                            
                                          }
                                        }
                                      } //die();
                                    } else {
                                      $query .= " AND 1=0 ";
                                    }
                                  }
                                } 
                              }
                            } else {
                              $query .= " AND 1=0 ";
                            }                           
                         }

                         


                         if(!empty($module_id) && empty($level_name)) {
                            $moduleIdList = array(0=>array('id'=>$module_id));
                           
                            // var_dump($moduleIdList);
 
                          if (!empty($moduleIdList)) {
                            // var_dump($moduleIdList); die();



                            foreach ($moduleIdList as $key => $value) {

                              if (!empty($group_name)) 
                              {
                                $class_plan_list = $this->class_plan->get_id_by_course_module_id_and_group($value['id'], $group_name);
                                
                              } else {

                                $class_plan_list = $this->class_plan->get_id_by_course_module_id($value['id']);
                              }

                            // var_dump($class_plan_list); die();

                              if (!empty($class_plan_list)) {
                                //var_dump($class_plan_list); 
                                foreach ($class_plan_list as $l => $m) {
                                  $student_list = $this->student_assign_class->get_register_id_by_class_plan_id($m['id']);

                                  // var_dump($student_list); 

                                  if (!empty($student_list)) {
                                    //array_unique($student_list);
                                    foreach ($student_list as $o => $p) {
                                      //var_dump($p);
                                      $std_id = $this->register->get_student_data_ID_no_by_register_id($p['register_id']);

                                      $std_course = $this->student_data->get_course_by_ID($std_id);

                                      $check_status = $this->student_information->get_by_student_data_id_and_registration_no($std_id, $p['register_id']);

                                      if (!empty($student_admission_status_for_staff)) {
                                        if ( !empty($check_status) && $check_status->status != $student_admission_status_for_staff) {
                                          continue;
                                        }
                                      }

                                      if (!empty($student_type) ) {
                                        if ( !empty($std_course) && $std_course->student_type != $student_type) {
                                          continue;
                                        }
                                      }

                                      if (!empty($student_attendance) ) {
                                        if ( !empty($check_status) && $check_status->attendance_parcent >= $student_attendance) {
                                          continue;
                                        }
                                      }

                                      if (!empty($course_id)) {
                                        if ($std_course->student_course == $course_id) {

                                          $query .= $and." sd.id = '".$std_id."' "; $and = " OR "; $sql_And = " AND ";

                                        }
                                      } else {
                                        $query .= $and." sd.id = '".$std_id."' "; $and = " OR "; $sql_And = " AND ";
                                      }                                      
                                    }
                                  }
                                } //die();
                              } else {

                                $query .= " AND 1=0 ";

                              }
                            }
                          }
                        }
                        // var_dump($query); die();

                        if (!empty($group_name) && empty($module_id) && empty($level_name)) 
                        {
                          $class_plan_list = $this->class_plan->get_id_by_group_name($group_name);
                          
                        


                          if (!empty($class_plan_list)) {
                            //var_dump($class_plan_list); 
                            foreach ($class_plan_list as $l => $m) {
                              $student_list = $this->student_assign_class->get_register_id_by_class_plan_id($m['id']);

                              // var_dump($student_list); 

                              if (!empty($student_list)) {
                                //array_unique($student_list);
                                foreach ($student_list as $o => $p) {
                                  //var_dump($p);
                                  $std_id = $this->register->get_student_data_ID_no_by_register_id($p['register_id']);

                                  $std_course = $this->student_data->get_course_by_ID($std_id);
                                  
                                  $check_status = $this->student_information->get_by_student_data_id_and_registration_no($std_id, $p['register_id']);

                                  if (!empty($student_admission_status_for_staff)) {
                                    if ( !empty($check_status) && $check_status->status != $student_admission_status_for_staff) {
                                      continue;
                                    }
                                  }

                                  if (!empty($student_type) ) {
                                    if ( !empty($std_course) && $std_course->student_type != $student_type) {
                                      continue;
                                    }
                                  }

                                  if (!empty($student_attendance) ) {
                                    if ( !empty($check_status) && $check_status->attendance_parcent >= $student_attendance) {
                                      continue;
                                    }
                                  }

                                  if (!empty($course_id)) {
                                    if ($std_course->student_course == $course_id) {

                                      $query .= $and." sd.id = '".$std_id."' "; $and = " OR "; $sql_And = " AND ";

                                    }
                                  } else {
                                    $query .= $and." sd.id = '".$std_id."' "; $and = " OR "; $sql_And = " AND ";
                                  }                                  
                                }
                              }
                            }
                          } else {

                            $query .= " AND 1=0 ";

                          }
                        }

                         // var_dump($query); die();
                        $and = " AND ";
                         if(!empty($student_type) && empty($level_name) && empty($module_id) &&  empty($group_name) ){
                             $query .= $and."sd.student_type = '".$student_type."'"; $and = " AND "; $sql_And = " AND ";
                         }

                         if(!empty($student_attendance) && empty($level_name) && empty($module_id) &&  empty($group_name) &&  empty($student_type) ){
                             $query .= $and."si.attendance_parcent <= ".$student_attendance.""; $and = " AND "; $sql_And = " AND ";
                         }
                                                 

                       
                       $query .= " ORDER BY rs.id DESC";

                       // var_dump($query); die();

                    $result=$this->db->query($query);
                        //echo "working query: ".var_dump($sql_query);
                    $total_student = $result->num_rows();

                    // var_dump($total_pages); die();
                    $report_query = array(
                      'report_query' => $query
                    );
                    
                    $this->session->set_userdata( $report_query );

                    //var_dump( $this->session->userdata('report_query') );
                    return $total_student;
                                               
          } 
        
        
      }
      
      
     }


    function get_student_list_for_report($query,$page,$targetpage,$hasAction)
    {
      

      $output = $this->getPaginationCustomForReport($query,$page,$targetpage,$hasAction);  
      // var_dump($output['search_sql']); 
      // var_dump($output['table_fields']);

      $htmlOutput = "";
       
      $htmlOutput .= "<div class='col-md-6' style='font-weight:bold;padding-left:0;margin:15px 0px;'>Search Result</div>";
      $htmlOutput .= "<div class='col-md-6' style='font-weight:bold;text-align:right;margin:15px 0px;'>Total Result: ".$output['total_rec']."</div>";
      
      $htmlOutput .= "<table class='table table-hover search-student-list'>";
      
      $htmlOutput .= "<thead>";

      if (!empty($output['table_fields'])) {
        foreach ($output['table_fields'] as $tbl_key => $tbl_field) {
          $htmlOutput .="<th>".$tbl_field."</th>"; 
        }
      }



      
      $htmlOutput .= "</thead>
              <tbody>";

          // return $htmlOutput;


        //////////////////////////////////////////////////////      
      /// get staff access
      if($this->session->userdata('label')=="staff"){
        $staff_privileges_student_admission = $data['staff_privileges_student_admission'] = $this->session->userdata('staff_privileges_student_admission');   
      }     
        /////////////////////////////////////////////////////       
      
      if($output['total_rec']>0){

        
        foreach($output['row_array'] as $k=>$v){
          

          if($this->session->userdata('label')=="staff" && empty($staff_privileges_student_admission['std_ad_view_app']) && empty($staff_privileges_student_admission['std_ad_edit_app']))  $htmlOutput .= "<tr id=''>";

          else
          // $htmlOutput .= "<tr id='".$v['id']."'>"; 
          // $htmlOutput .= "<td>".$v['registration_no']."</td>";
          // $htmlOutput .= "<td>".ucwords(strtolower($v['student_first_name']))."</td>";
          // $htmlOutput .= "<td>".ucwords(strtolower($v['student_sur_name']))."</td>";
          // $htmlOutput .= "<td>".$v['student_date_of_birth']."</td>";

          $htmlOutput .= "<tr>"; 
          if (!empty($output['table_fields'])) {
            foreach ($output['table_fields'] as $tbl_key => $tbl_field) {
              $htmlOutput .= "<td>".$v[$tbl_field]."</td>";
            }
          }
          
        
          // $htmlOutput .= "</td>";
          //           $htmlOutput .= "<td>";
          //           if(is_numeric($v['student_course'])){
          //               $coursename=$this->course->get_name((int)$v['student_course']);
          //            $htmlOutput .= $coursename;   
          //           }else {
          //           $htmlOutput .= $v['student_course'];
          //           }
          // $htmlOutput .= "</td>";
          //   if(is_numeric($v['student_nationality'])) {
          //     $htmlOutput .= "<td>".$this->country->get_name_by_id($v['student_nationality'])."</td>";
          //   } else {              
          //   $htmlOutput .= "<td>".$v['student_nationality']."</td>";
          //   }

          // if ( isset($list_of_parcent) && $list_of_parcent == 1) {
          //   $htmlOutput .="<td>".$v['attendance_parcent']." %</td>";
          // }

          // $htmlOutput .= "<td>".$this->status->get_name_by_id($v['status'])."</td>";        
            
          $htmlOutput .= "</tr>";
          
          
          
        }
        

          $arr = array();
          $arr['search_sql'] = str_replace("%","PERCENTMASUM888",$output['search_sql']); 
          

                    
        $this->session->set_userdata($arr);

      
      
      $htmlOutput .= "</tbody></table><div class='clearfix text-center'>".$output['pagination']."</div>";
      
      }else{
        
        $htmlOutput .= "<tr><td colspan='7'>No matches found.</td></tr></tbody></table>"; 
      }
      
       return $htmlOutput;

    } 
                 

    function getPaginationCustomForReport($sql_query,$page,$targetpage,$hasAction){


    if($hasAction=="yes") $pp = "&"; else $pp = "?";
    
    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
    

        
    $query=$this->db->query($sql_query);
        //echo "working query: ".var_dump($sql_query);
    $total_pages = $query->num_rows();
    


    $limit = 20;                //how many items to show per page
    //$page = $_GET['page'];
    if($page) 
      $start = ($page - 1) * $limit;      //first item to display on this page
    else
      $start = 0;               //if no page var is given, set start to 0
    

    $sql=$this->db->query($sql_query." LIMIT $start, $limit");

    

    if ($page == 0) $page = 1;          //if no page var is given, default to 1.
    $prev = $page - 1;              //previous page is page - 1
    $next = $page + 1;              //next page is page + 1
    $lastpage = ceil($total_pages/$limit);    //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;            //last page minus 1
    
    /* 
      Now we apply our rules and draw the pagination object. 
      We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = "";
    if($lastpage > 1)
    { 
      $pagination .= "<ul class=\"pagination\">";
      //previous button
      if ($page > 1) 
        $pagination.= "<li><a href=\"$targetpage".$pp."page=$prev\">previous</a></li>";
      else
        $pagination.= "<li class=\"disabled\"><a href=\"#\" >previous</a></li>";  
      
      //pages 
      if ($lastpage < 7 + ($adjacents * 2)) //not enough pages to bother breaking it up
      { 
        for ($counter = 1; $counter <= $lastpage; $counter++)
        {
          if ($counter == $page)
            $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
          else
            $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
        }
      }
      elseif($lastpage > 5 + ($adjacents * 2))  //enough pages to hide some
      {
        //close to beginning; only hide later pages
        if($page < 1 + ($adjacents * 2))    
        {
          for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
          {
            if ($counter == $page)
              $pagination.= "<li class=\"active\"><a href=\"#\">$counter</span></li>";
            else
              $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
          }
          $pagination.= "<li><a href=\"#\">...</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";    
        }
        //in middle; hide some front and some back
        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
        {
          $pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
          $pagination.= "<li><a href=\"#\">...</a></li>";
          for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
          {
            if ($counter == $page)
              $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
            else
              $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
          }
          $pagination.= "<li><a href=\"#\">...</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lpm1\">$lpm1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=$lastpage\">$lastpage</a></li>";    
        }
        //close to end; only hide early pages
        else
        {
          $pagination.= "<li><a href=\"$targetpage".$pp."page=1\">1</a></li>";
          $pagination.= "<li><a href=\"$targetpage".$pp."page=2\">2</a></li>";
          $pagination.= "<li><a href=\"#\">...</a></li>";
          for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
          {
            if ($counter == $page)
              $pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
            else
              $pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";          
          }
        }
      }
      
      //next button
      if ($page < $counter - 1) 
        $pagination.= "<li><a href=\"$targetpage".$pp."page=$next\">next</a></li>";
      else
        $pagination.= "<li class=\"disabled\"><a href=\"#\">next</a></li>";
      $pagination.= "</ul>\n";    
    }
            
      $output = array();
      if ($sql->num_rows() > 0)
      {
        $fieldlist = array(); $i=0;

            $si  = $this->fixidb->student_information;
            $sd  = $this->fixidb->student_data;
            $reg = $this->fixidb->register;
            
            $field_query = $this->db->query($sql_query);
            


            foreach($field_query->list_fields() as $field):
             $fieldlist[$i] = $field;
             $i++;
            endforeach;       
        $i=0; $row_array = array(); 
        foreach($sql->result() as $row){
              for($count=0; $count < count($fieldlist); $count++) {
                $row_array[$i][$fieldlist[$count]] = $row->$fieldlist[$count];
              }                 

          $i++;
              }

        
         //$row = $sql->row_array();
         $output['search_sql'] = $sql_query;
         $output['table_fields'] = $fieldlist;
               $output['row_array'] = $row_array;
               $output['pagination'] = $pagination;
               $output['total_rec'] = $total_pages;
      }else{
        // $output['search_sql'] = $sql_query; 
               $output['row_array'] = "";
               $output['table_fields'] = "";
               $output['pagination'] = "";
               $output['total_rec'] = 0;        
      } 

      return $output; 


    
  }







    
                   
     
}
?>
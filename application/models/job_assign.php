<?php
  
class Job_assign extends CI_Model {
     
     public $id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);     
        $this->load->model('jobs','',TRUE);     
        $this->load->model('job_type','',TRUE);     
        $this->load->model('job_department','',TRUE);     
        $this->load->model('job_induction','',TRUE);     
        $this->load->model('job_induction_process','',TRUE);     
        $this->load->model('jobs','',TRUE);     
        $this->load->model('job_applied_student','',TRUE);     
        $this->load->model('staff','',TRUE);     
        $this->load->model('register','',TRUE);     
        $this->load->model('student_data','',TRUE);     
        $this->load->library('session');   

    }
        
    /**
    * update job information
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
	    $default    =   array(  
	                            "reviewed_by"       			=>  $this->session->userdata("uid")
	                            
	                            );
	     $args = fixi_parse_args($args,$default);
      $this->db->update($this->fixidb->job_assign,$args,array('id'=>$args['id']));
      
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

    $default    =   array(  "job_induction_id"      		=>  0,
                            "jobs_id"       				=>  0,
                            "student_data_id"   			=>  0,
                            "status"            			=>  "pending",
                            "reviewed_by"       			=>  $this->session->userdata("uid"),
                            "issued_date"       			=>  date("Y-m-d"),
                            "job_department_id"    			=>  0,
                            "due_date"						=>  "",
                            "assigned_by_department_id"		=>  0,
                            "assign_by_staff_id"			=>  0,
                            "remarks"						=>  ""
                            
                            );
     $args = fixi_parse_args($args,$default);    
     $this->db->insert($this->fixidb->job_assign,$args);
     return $this->db->insert_id();
     
    }    

    /**
    * delete user by id
    * 
    * @param mixed $user_id
    * @return user id if data is deleted else return false.
    */
    function delete($id){
     
        if(isset($id)){
            $id        =   (int)$id;
            $this->db->delete($this->fixidb->job_assign,array('id'    =>  $id));
            
            return $id;
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
        $query=$this->db->get($this->fixidb->job_assign);
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
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->job_assign." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
		
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->job_assign." WHERE id='".$id."' ORDER BY `id` ASC LIMIT 1");	
		//return $id;
  		if($query->num_rows()>0){
  			//return "yes";
  			return $query->row()->name;	
  		} 
  		

		
    }

    function get_id_by_student_data_id_and_jobs_id($student_data_id, $jobs_id){
    
    $query=$this->db->query("SELECT id FROM ".$this->fixidb->job_assign." WHERE student_data_id='".$student_data_id."' AND jobs_id='".$jobs_id."' AND status='pending' ORDER BY `id` ASC LIMIT 1");  
    //return $id;
      if($query->num_rows()>0){
        //return "yes";
        return $query->row()->id; 
      } else {
        return false;
      } 
          
    }

    function get_id_by_issued_date_and_jobs_id($issued_date, $jobs_id, $student_data_id){
    
    $query=$this->db->query("SELECT id FROM ".$this->fixidb->job_assign." WHERE issued_date='".$issued_date."' AND jobs_id='".$jobs_id."' AND student_data_id='".$student_data_id."' AND job_induction_id=0  ORDER BY `id` ASC LIMIT 1");  
    //return $id;
      if($query->num_rows()>0){
        //return "yes";
        return $query->row()->id; 
      } else {
        return false;
      } 
          
    }   

    public function get_all_applied_job_by_student($student_data_id)
    {
      $this->db->select('*');
      $this->db->from($this->fixidb->job_assign);
      $this->db->where('job_induction_id', 0);
      //$this->db->join($this->fixidb->job_applied_student, "".$this->fixidb->job_assign."'.id'" = ".$this->fixidb->job_applied_student".'.id"');

      //$this->db->join($this->fixidb->job_applied_student, "$this->fixidb->job_assign".".id = $this->fixidb->job_applied_student".".job_assign_id");
      $this->db->join($this->fixidb->job_applied_student, 'job_assign.id = job_applied_student.job_assign_id');

      $query = $this->db->get();
      if($query->num_rows>0) {
        return $query->result_array();
      }

    }
    
    function get_by_issued_date_and_job_induction_id_and_student_data_id($issued_date,$job_induction_id,$student_data_id){
		
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->job_assign." WHERE issued_date='".$issued_date."' AND job_induction_id='".$job_induction_id."' AND student_data_id='".$student_data_id."' ORDER BY `id` ASC LIMIT 1");	
  		if($query->num_rows()>0){
  			//return "yes";
  			return true;	
  		}else return false; 		
    }
    
    function get_by_jobs_id_and_staff_id_and_job_department_id($jobs_id,$staff_id,$job_department_id){

		$query=$this->db->query("SELECT * FROM ".$this->fixidb->job_assign." WHERE jobs_id='".$jobs_id."' AND staff_id='".$staff_id."' AND job_department_id='".$job_department_id."' ORDER BY `id` ASC LIMIT 1");	
  		if($query->num_rows()>0){
  			//return "yes";
  			return $query->row_array();	
  		}else return false;		
		
    }
    
    function get_by_jobs_id_and_job_induction_id($jobs_id,$job_induction_id){
		

        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->job_assign." WHERE jobs_id='".$jobs_id."' AND job_induction_id='".$job_induction_id."' ORDER BY `id`");
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
    
    
    function get_by_assigned_by_department_id_and_job_induction_id_zero($dept_id){
		
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->job_assign." WHERE assigned_by_department_id='".$dept_id."' AND job_induction_id='0' ORDER BY `due_date` DESC");
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
    
    function get_by_job_department_id_and_status_pending($dept_id){

        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->job_assign." WHERE job_department_id='".$dept_id."' AND status='pending' ORDER BY `due_date` DESC");
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
    
    
     function makeJobAssignListWithpagination($args,$page,$targetpage,$hasAction){
			
				
	       foreach($args as $k=>$v){						
				$$k = $v;						
	       }
	       $query = "";
		
		   $query .= "SELECT * FROM ".$this->fixidb->job_assign." WHERE status!='pending'";
	   
		
		   $and = " AND ";
		   
		   if(!empty($job_department_id)){
			   
			   $query .= $and."job_department_id = '".$job_department_id."'"; $and = " AND "; $sql_And = " AND ";
		   }
				   					   					   					   					   					   
		   
		   $query .= " ORDER BY modified_date DESC";

					   
					   
			$output = $this->getPaginationCustom($query,$page,$targetpage,$hasAction);	
			//var_dump($output);
			//return $output['row_array'];

            $htmlOutput = "<table class='table table-hover job-archive-list'>";
                

			 
			$htmlOutput .= "<thead>
			                	<tr>
			                	 <th colspan='5'>Job Records</th>
			                	 <th colspan='5' class='text-right'>Total Record: ".$output['total_rec']."</th>
			                	</tr>			                	
								<tr>
									<th>Job Name</th>
									<th>Job Type</th>
									<th>Request From</th>										
									<th>Assigned By Department</th>
									<th>Reviewed By</th>
									<th>Remarks</th>
									<th>Issued Date</th>
									<th>Due Date</th>
									<th>Modified Date</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>";
	    
		    ///////////////////////////////////////////////////// 			
			
			if($output['total_rec']>0){
	            // $output['row_array'] = array_reverse($output['row_array']);
                
				foreach($output['row_array'] as $k=>$v){
 
 					$job_info = $this->jobs->get_by_ID($v['jobs_id']);
 					$job_type = $this->job_type->get_name_by_id($job_info['job_type_id']);
 					
          $get_documents = $this->job_applied_student->get_document_by_job_assign_id($v['id']);

            if(!empty($get_documents)) {
              $doc = unserialize($get_documents);
            }
 					
					$htmlOutput .= "<tr id=''>"; 
          if(!empty($doc)) {
            $htmlOutput .= "<td><a href='".$doc[0]."'>".$job_info['name']."</a></td>";
          } else {
  					$htmlOutput .= "<td>".$job_info['name']."</td>";
          }
					$htmlOutput .= "<td>".$job_type."</td>";
					
					if($v['assigned_by_department_id']>0){
						$htmlOutput .= '<td> Staff: '.$this->staff->get_nick_name($v['assign_by_staff_id']).' ( '.$this->job_department->get_name_by_id($v['assigned_by_department_id']).' )</td>';	
					}else if($v['student_data_id']>0 && $job_type!="Induction"){
						
						$std_id = $this->register->get_registration_no_by_student_data_ID($v['student_data_id']);
						if(empty($std_id)) $std_id = $this->student_data->get_reference_no_byID($v['student_data_id']);
																						
						$htmlOutput .= '<td> Student ( '.$std_id.' )</td>';
						
					}else{
						
						$htmlOutput .= '<td> N/A </td>';
					}
					
					if($v['assigned_by_department_id']>0){
						$htmlOutput .= '<td>'.$this->job_department->get_name_by_id($v['assigned_by_department_id']).'</td>';	
					}else{
						$htmlOutput .= '<td> N/A </td>';	
					}
					$htmlOutput .= '<td> '.$this->staff->get_nick_name($v['reviewed_by']).' </td>';
					$htmlOutput .= '<td> '.tinymce_decode($v['remarks']).' </td>';
					$htmlOutput .= '<td> '.date("d-m-Y",strtotime($v['issued_date'])).' </td>';
					$htmlOutput .= '<td> '.date("d-m-Y",strtotime($v['due_date'])).' </td>';
					$htmlOutput .= '<td> '.date("d-m-Y",strtotime($v['modified_date'])).' </td>';
		            
		            if($v["status"]=="pending") 	$htmlOutput .=  "<td style='background-color:#f2dede'>".ucwords($v["status"])."</td>";
		            if($v["status"]=="done") 		$htmlOutput .=  "<td style='background-color:#dff0d8'>".ucwords($v["status"])."</td>";
		            if($v["status"]=="decline") 	$htmlOutput .=  "<td style='background-color:#fcf8e3'>".ucwords($v["status"]."<br>Reason: ".tinymce_decode($v["declined_reason"])."")."</td>";

/*					$htmlOutput .= "<td>".ucwords(strtolower($v['student_first_name']))."</td>";
					$htmlOutput .= "<td>".ucwords(strtolower($v['student_sur_name']))."</td>";
					$htmlOutput .= "<td>".$v['student_date_of_birth']."</td>";
                    $htmlOutput .= "<td>";
                     if(is_numeric($v['student_semister'])){
                        $semestername=$this->semister->get_name((int)$v['student_semister']);
                     $htmlOutput .= $semestername;   
                    }else {
                    $htmlOutput .= $v['student_semister'];
                    }
					$htmlOutput .= "</td>";
                    $htmlOutput .= "<td>";
                    if(is_numeric($v['student_course'])){
                        $coursename=$this->course->get_name((int)$v['student_course']);
                     $htmlOutput .= $coursename;   
                    }else {
                    $htmlOutput .= $v['student_course'];
                    }
					$htmlOutput .= "</td>";
					if($this->session->userdata('label')=="agent")
						$htmlOutput .= "<td>".$v['student_admission_status']."</td>";
					else
						$htmlOutput .= "<td>".$v['student_admission_status_for_staff']."</td>"; */
						
					$htmlOutput .= "</tr>";					
					
					
				}

			
			
				$htmlOutput .= "</tbody></table><div class='clearfix text-center'>".$output['pagination']."</div>";
			
			}else{
				
				$htmlOutput .= "<tr><td colspan='10'>No record found.</td></tr></tbody></table>";	
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
		


		$limit = 20; 								//how many items to show per page
		//$page = $_GET['page'];
		if($page) 
			$start = ($page - 1) * $limit; 			//first item to display on this page
		else
			$start = 0;								//if no page var is given, set start to 0
		

		$sql=$this->db->query($sql_query." LIMIT $start, $limit");

		

		if ($page == 0) $page = 1;					//if no page var is given, default to 1.
		$prev = $page - 1;							//previous page is page - 1
		$next = $page + 1;							//next page is page + 1
		$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
		$lpm1 = $lastpage - 1;						//last page minus 1
		
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
			if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$targetpage".$pp."page=$counter\">$counter</a></li>";					
				}
			}
			elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
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
				$field_query=$this->db->get($this->fixidb->job_assign);
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


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       
                 

    
    
                   
     
}
?>
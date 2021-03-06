<?php
  
class Student_data_extend extends CI_Model {
     
     public $user_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('semister','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('agent','',TRUE);
        $this->load->model('student_title','',TRUE);
        
        $this->load->library('session');
        $this->load->model('register');   

    }
        
     
     
     function makeRegisteredStudentListWithpagination($args,$page,$targetpage,$hasAction){
			
			$query = "";
				
			if(is_array($args) && count($args)==0){
				
				$query="SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff='Offer accepted'";
								
				
			}else if(is_array($args) && count($args)>0){
				
					foreach($args as $k=>$v){						
						$$k = $v;						
					}
					$query = "";
                    
/*


SELECT student_data.student_first_name, register.registration_no, status.name, semister.semister_name, course.course_name, register.section  
FROM register, student_data, student_information, status, semister, course 
WHERE student_data.id = register.student_data_id 
and register.id = student_information.registration_id
 
and student_data.student_semister = '98' 
and student_data.student_course = '6'
and student_information.status = status.id and status.id = '14'
and register.section = 'A'

and student_data.student_semister = semister.id
and student_data.student_course = course.id





SELECT student_data.student_first_name, register.registration_no, status.name, student_information.status, student_data.student_semister, student_data.student_course
FROM  `register` , student_data, student_information, 
STATUS 
WHERE student_data.id = register.student_data_id
AND register.id = student_information.registration_id
AND student_information.status = status.id
AND student_data.student_semister =99
AND student_data.student_course =6
LIMIT 0 , 30








                                SELECT rs.registration_no, sd.student_first_name, sd.student_sur_name, sd.student_semister, sd.student_course, st.name AS status          
                                FROM register AS rs ON rs.student_data_id = sd.id ".(!empty($section)) ? "AND rs.section = '".$section."' " : "" ."  
                                LEFT JOIN student_data AS sd ON rs.student_data_id = sd.id ".(!empty($semester_id)) ? "AND sd.student_semister = '".$semester_id."' " : "" ." ".(!empty($course_id)) ? "AND sd.student_course = '".$course_id."' " : "" ." 
                                LEFT JOIN status AS st ON st.id = si.status  
                                LEFT JOIN student_information AS si ON si.student_data_id = sd.id AND si.registration_id = rs.id ".(!empty($status_id)) ? "AND si.status = '".$status_id."' " : "" ."

*/                    
                    
                        $query .= " SELECT student_data.id, register.registration_no, student_data.student_first_name, student_data.student_sur_name, semister.semister_name, course.course_name, status.name as status, register.section
						            FROM 	student_data, register, student_information, semister, course, status
									WHERE 	student_data.id 					= register.student_data_id
									AND 	student_information.registration_id = register.id
									AND  	student_information.student_data_id = student_data.id
									AND 	student_information.student_data_id = student_data.id
									AND 	student_information.status 			= status.id
									AND 	student_data.student_course 		= course.id
									AND 	student_data.student_semister 		= semister.id  
									AND 	student_data.student_course 		= '".$course_id."'                        
                        ";
                                
                    if(!empty($section)) $query 		.= " AND register.section 				= '".$section."' ";                           
                    if(!empty($semester_id)) $query 	.= " AND student_data.student_semister 	= '".$semester_id."' ";                     
                    if(!empty($status_id)) $query 		.= " AND student_information.status 	= '".$status_id."' ";
                    if(!empty($registration_no)) $query .= " AND register.registration_no 		= '".$registration_no."' ";
                    
                        $query .= " ORDER BY register.registration_no ASC";                 
                                
                    //return $query;
/*                    
					if(empty($registration_no)){
				
				       $query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff='Offer accepted'";
				   
					
		   			   $and = " AND ";

					   if(!empty($semester_id)){
						   $semester_name = $this->semister->get_name($semester_id);
						   $query .= $and." (student_semister = '".$semester_name."' OR student_semister = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($course_id)){
						   $course_name = $this->course->get_name($course_id);
						   $query .= $and." (`student_course` = '".$course_name."'  OR `student_course` = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
					   }					   					   					   					   					   					   
					   
					   $query .= " ORDER BY id DESC";
					   
					   
					}else if(!empty($registration_no)){
						
						//$query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff=='Offer accepted'";	
						
						$student_data_id_list = $this->register->get_student_data_id_list_by_registration_no_for_search($registration_no);
						
						$num_student_data_id = count($student_data_id_list);
						
						$query .= "SELECT * FROM ".$this->fixidb->student_data." WHERE student_admission_status_for_staff='Offer accepted'";
						
						//$and = " AND ";
						$query .= " AND ( "; $i=1;						
						foreach($student_data_id_list as $k=>$v){
							
							$or = " OR ";  
							if($num_student_data_id == $i) $query .= "id='".$v."'"; else $query .= "id='".$v."'".$or;
							$i++;
						}
						$query .= " )";

		   			   $and = " AND ";

					   if(!empty($semester_id)){
						   $semester_name = $this->semister->get_name($semester_id);
						   $query .= $and." (`student_semister` = '".$semester_name."' OR `student_semister` = '".$semester_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   if(!empty($course_id)){
						   $course_name = $this->course->get_name($course_id);
						   $query .= $and." (`student_course` = '".$course_name."'  OR `student_course` = '".$course_id."') "; $and = " AND "; $sql_And = " AND ";
					   }
					   
					   $query .= " ORDER BY id DESC";						
						
				   }//}else if(!empty($registration_no)){
                   
 */                  				
									
			}

		   $output = $this->getPaginationCustom($query,$page,$targetpage,$hasAction);
		   
		   
		   
			$htmlOutput = "<table class='table table-hover search-student-list'>";
	 
			$htmlOutput .= "<thead>
			                	<tr>
			                	 <th colspan='4'>Search Result</th>
			                	 <th colspan='3' class='text-right'>Total Result: ".$output['total_rec']."</th>
			                	</tr>			                	
								<tr>
								    <th>Sl.</th>
									<th><div class='checkbox checkbox-primary'><input id='checkbox99999999999' type='checkbox' class='form-control'><label for='checkbox99999999999'>Registration No</label></div></th>
									
									<th>Name</th>
									<th>Semester</th>
									<th>Course</th>
                                    <th>Status</th>
									<th>Section</th>
								</tr>
							</thead>
							<tbody class='reg-student-list'>";				   
			
			if($output['total_rec']>0){
	            $Icount=0;
				foreach($output['row_array'] as $k=>$v){
					$Icount++;
					//if( $this->session->userdata('label')!="agent" && empty($staff_privileges_student_admission['std_ad_view_app']) && empty($staff_privileges_student_admission['std_ad_edit_app']) ) $htmlOutput .= "<tr id=''>"; else if($this->session->userdata('label')=="admin" || ($this->session->userdata('label')=="agent" || ($this->session->userdata('label')=="staff" && !empty($staff_privileges_student_admission['std_ad_view_app']) && !empty($staff_privileges_student_admission['std_ad_edit_app'])) ) ) $htmlOutput .= "<tr id='".$v['id']."'>";  
					$htmlOutput .= "<tr>";
					$htmlOutput .= "<td><SPAN>$Icount</SPAN></td>";
					  
					$htmlOutput .= "<td><div class='checkbox checkbox-primary'><input name='student_data_id[]' id='checkbox".$v["id"]."' type='checkbox' class='form-control student-data-id' value='".$v["id"]."'><label for='checkbox".$v["id"]."'>".$v["registration_no"]."</label> </div></div></td>";
					$htmlOutput .= "<td>".ucwords(strtolower($v['student_first_name']))." ".ucwords(strtolower($v['student_sur_name']))."</td>";
		            $htmlOutput .= "<td>";
		            
                    $htmlOutput .= $v['semister_name'];
                    
					$htmlOutput .= "</td>";
		            $htmlOutput .= "<td>";
		            
                    $htmlOutput .= $v['course_name'];
                    
					$htmlOutput .= "</td>";
                    $htmlOutput .= "<td>".$v['status']."</td>";
					$htmlOutput .= "<td>".$v['section']."</td>";
						
					$htmlOutput .= "</tr>";					
					
					
				}
			
			
                //$htmlOutput .= "</tbody></table><div class='clearfix text-center'>".$output['pagination']."</div><script>regStudentSelectAll();</script>";
				$htmlOutput .= "</tbody></table><script>regStudentSelectAll();</script>";
			
			}else{
				
				$htmlOutput .= "<tr><td colspan='7'>No Matches Found.</td></tr></tbody></table>";	
			}
			
		   return $htmlOutput;				
			
		   //return $query;
     }     
     
     
     

	function getPaginationCustom($sql_query,$page,$targetpage,$hasAction){


		if($hasAction=="yes") $pp = "&"; else $pp = "?";
		
		// How many adjacent pages should be shown on each side?
		$adjacents = 3;
		

        
		$query=$this->db->query($sql_query);
        //echo "working query: ".var_dump($sql_query);
		$total_pages = $query->num_rows();
		


		$limit = 250; 								//how many items to show per page
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
<?php
  
class Class_plan extends CI_Model {
     
     public $user_id;
     
     function __construct() {
  
        parent::__construct();
        $this->load->database();
        $this->load->model('fixidb','',TRUE);
        $this->load->model('semister','',TRUE);
        $this->load->model('course','',TRUE);
        $this->load->model('agent','',TRUE);
        $this->load->model('student_data','',TRUE);
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

      $this->db->update($this->fixidb->class_plan,$args,array('id'=>$args['id']));
      
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

        
     $this->db->insert($this->fixidb->class_plan,$args);
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
            $this->db->delete($this->fixidb->class_plan,array('id'    =>  $user_id));
            
            return $user_id;
        }else{
          return FALSE;  
        }
        
    }
    /**
    * get all user
    * 
    * 
    * @return user id if data is deleted else return false.
    */
    function get_all(){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->get($this->fixidb->class_plan);
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
    
    function get_all_by_active(){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE active='1'");    
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

    function get_all_group_name(){
		$query=$this->db->query("SELECT DISTINCT group_name FROM ".$this->fixidb->class_plan." ORDER BY `id` ASC");	
		
		if($query->num_rows()>0) 
		{			
			return $query->result_array();		
		} 
    }
    
    
    function get_by_ID($ID=""){
     
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");
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
    
    function get_room_id_by_id($ID=""){
	
		$query=$this->db->query("SELECT room_id FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");	
		
		if($query->num_rows()>0) return $query->row()->room_id;
		
    }


    
    function get_coursemodule_id_by_id($ID){
		$query=$this->db->query("SELECT coursemodule_id FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' LIMIT 1");	
		
		if($query->num_rows()>0) return $query->row()->coursemodule_id;		
    }
    
    function get_coursemodule_id_and_timeplan_id_by_id($ID){
        $query=$this->db->query("SELECT coursemodule_id,time_planid FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' LIMIT 1");    
        
        if($query->num_rows()>0) return $query->row_array();        
    }    


    function get_coursemodule_id_and_by_id($ID){
		$query=$this->db->query("SELECT coursemodule_id, id FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' LIMIT 1");	
		
		if($query->num_rows()>0) return $query->row_array();		
    }
    
    function get_group_name_by_id($ID){
		$query=$this->db->query("SELECT group_name FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' LIMIT 1");	
		
		if($query->num_rows()>0) return $query->row()->group_name;		
    }

    function get_submission_date_by_id($ID=""){
	
		$query=$this->db->query("SELECT submission_date FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");	
		
		if($query->num_rows()>0) return hr_date($query->row()->submission_date);
		
    }

    function get_course_relation_id_by_id($ID=""){
	
		$query=$this->db->query("SELECT course_relation_id FROM ".$this->fixidb->class_plan." WHERE id='".$ID."' ORDER BY `id` ASC LIMIT 1");	
		
		if($query->num_rows()>0) return $query->row()->course_relation_id;
		
    }

    function get_id_by_course_relation_id($course_relation_id=""){
	
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result_array();
		
    }

    function get_id_by_group_name($group_name=""){
	
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->class_plan." WHERE group_name='".$group_name."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result_array();
		
    }


    function get_id_by_course_module_id($course_module_id=""){
	
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->class_plan." WHERE coursemodule_id='".$course_module_id."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result_array();
		
    }

    function get_id_by_course_module_id_and_group($course_module_id="", $group_name=""){
	
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->class_plan." WHERE coursemodule_id='".$course_module_id."' AND group_name='".$group_name."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result_array();
		
    }

    function get_id_by_course_relation_id_as_object($course_relation_id=""){
	
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result();
		
    }
    function get_id_by_course_relation_id_as_array($course_relation_id=""){
	
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result_array();
		
    }
    function get_id_by_course_relation_id_and_coursemodule_id($course_relation_id="",$coursemodule_id=""){
	
		$query=$this->db->query("SELECT id FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' AND coursemodule_id='".$coursemodule_id."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result();
		
    }
    
    function get_id_coursemodule_id_by_course_relation_id($course_relation_id=""){
    
        $query=$this->db->query("SELECT id,coursemodule_id FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' ORDER BY `id`");    
        
        if($query->num_rows()>0) return $query->result_array();
        
    }

    function get_group_name_by_course_relation_id_and_coursemodule_id($course_relation_id="",$coursemodule_id=""){
	
		$query=$this->db->query("SELECT group_name FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' AND coursemodule_id='".$coursemodule_id."' ORDER BY `id`");	
		
		if($query->num_rows()>0) return $query->result();
		
    }
      
    function get_by_course_relation_id_and_coursemodule_id($course_relation_id,$coursemodule_id){
					
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' AND coursemodule_id='".$coursemodule_id."' ORDER BY `group_serial` ASC");
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

    
    function get_by_course_relation_id_and_coursemodule_id_and_group_name($course_relation_id,$coursemodule_id,$group_name){
					
        $fieldlist = array();
        $data =array();
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' AND coursemodule_id='".$coursemodule_id."' AND group_name='".$group_name."' ORDER BY `group_serial` ASC");
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

    function get_by_course_relation_id_as_object_and_coursemodule_id_and_group_name($course_relation_id,$coursemodule_id,$group_name){
					
        $this->db->db_select();
        $query=$this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE course_relation_id='".$course_relation_id."' AND coursemodule_id='".$coursemodule_id."' AND group_name='".$group_name."' ORDER BY `group_serial` ASC");
        if($query->num_rows()>0) {
        	return $query->result();
        }		
		
    }   
    
    function checkIfClassPlanExistByGroupNameAndCourseRelationIDAndCourseModuleID($group_name,$course_relation_id,$coursemodule_id){
		
		$query=$this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE group_name='".$group_name."' AND course_relation_id='".$course_relation_id."' AND coursemodule_id='".$coursemodule_id."' ORDER BY `group_serial` ASC");	
		
		if($query->num_rows() > 0)
			return $query->row()->id;
		else
			return false;	
    }
    
    
     function makePrintClassListWithpagination($args,$page,$targetpage,$hasAction){
			
              //var_dump($args);
				
			if(is_array($args) && count($args)>0){
				
					foreach($args as $k=>$v){						
						$$k = $v;						
					}
					$sql = "";
					
					   
				   if(!empty($date_class_list)){
				       
                       $query = $this->db->query("SELECT * FROM ".$this->fixidb->class_lists." WHERE date LIKE '%".date("Y-m-d",strtotime($date_class_list))."%' ORDER BY id DESC");
                          
							   if($query->num_rows()>0){
                                   
                                   $sql = "SELECT * FROM ".$this->fixidb->class_plan." WHERE 1 "; $and="AND (";
                                   $i =0;
								   foreach($query->result() as $rows){
									   
									   $class_planid = $rows->class_planid;
									   $time_planid =  $rows->time_planid;         
									   
									   $class_plan_query = $this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE id = '".$class_planid."' LIMIT 1");
									   	
									   
									   $time_plan_query = $this->db->query("SELECT * FROM ".$this->fixidb->time_plan." WHERE id = '".$time_planid."' LIMIT 1");

									   $course_relation_id          = $class_plan_query->row()->course_relation_id;
									   $course_module_id            = $class_plan_query->row()->coursemodule_id;
									   $classPlanID                 = $class_plan_query->row()->id;
									   $groupname                   = $class_plan_query->row()->group_name;
									   $course_relation_query       = $this->db->query("SELECT * FROM ".$this->fixidb->course_relation." WHERE id = '".$course_relation_id."' LIMIT 1");
									   $module_relation_query       = $this->db->query("SELECT * FROM ".$this->fixidb->coursemodule." WHERE id = '".$course_module_id."' LIMIT 1");
									   $course_relation_course_id   = ($course_relation_query->num_rows()>0) ? $course_relation_query->row()->course_id : "";
									   $module_relation_module_id   = ( $module_relation_query->num_rows()>0) ? $module_relation_query->row()->id : "";
									   
									   
									    if(!empty($course_id)){
									   		
									   		if($course_relation_course_id != $course_id){
												continue;
									   		}
										   										   
									    }
									    if(!empty($coursemodule_id)){
									   		
									   		if($module_relation_module_id != $coursemodule_id ){
									   			
												continue;
									   		}
										   										   
									    }
									    if(!empty($group_name)){    
									   		       
									   		if($groupname != $group_name){
									   			
												continue;
									   		}
										   										   
									    }    
									   
										   
					   					$sql .= $and."id='".$class_planid."'";	   										   
										$and = " OR ";
									   										   
									  
									   
                                     $i=1;

								   }
                                   if($i==0) { $sql .=$and."1 AND 0"; }
                                   $sql .= ") ORDER BY id DESC";
								   
							   }				   	   
				   
				   }				   
				   				
									
			}
			if($sql == "") {
				$output['total_rec'] = 0;
			} else {
			
			   $output = $this->getPaginationCustom($sql,$page,$targetpage,$hasAction);
			}
		   
		   
		   
			$htmlOutput = "<table class='table table-hover search-class-list print_table'>";
	 
			$htmlOutput .= "<thead>
			                	<tr>
			                	 <th colspan='4'>Search Result</th>
			                	 <th colspan='4' class='text-right'>Total Result: ".$output['total_rec']."</th>
			                	</tr>			                	
								<tr>
									<th class='remove_from_print'><div class='checkbox checkbox-primary'><input id='checkbox99999999999' type='checkbox' class='form-control'><label for='checkbox99999999999'>Serial No</label></div></th>
									<th>Semester</th>
									<th>Course</th>
									<th>Module</th>
									<th>Group</th>
									<th>Tutor</th>
									<th>Time</th>
									<th>Room</th>
								</tr>
							</thead>
							<tbody class='class-list'>";				   
			
			if($output['total_rec']>0){
	            $i=1;
				foreach($output['row_array'] as $k=>$v){
					$c_s_id = $this->course_relation->get_course_ID_semester_ID_by_ID($v["course_relation_id"]);
					
					$htmlOutput .= "<tr>";
					  
					$htmlOutput .= "<td class='remove_from_print'><div class='checkbox checkbox-primary'><input name='class_plan_id[]' id='checkbox".$v["id"]."' type='checkbox' class='form-control class-plan-id' value='".$v["id"]."'><label for='checkbox".$v["id"]."'>".$i."</label></div></div></td>";

					$htmlOutput .= "<td>".$this->semister->get_name($c_s_id['semester_id'])."</td>";
					$htmlOutput .= "<td>".$this->course->get_name($c_s_id['course_id'])."</td>";
					$htmlOutput .= "<td>".$this->coursemodule->get_name_by_id($v['coursemodule_id'])."</td>";
					$htmlOutput .= "<td>".$v['group_name']."</td>";
					$htmlOutput .= "<td>".$this->staff->get_name($v['tutor_id'])."</td>";
					$htmlOutput .= "<td>".$this->time_plan->get_viewable_from_to_date_by_id($v['time_planid'])."</td>";
					$htmlOutput .= "<td>".$this->room_plan->get_name_by_id($v['room_id'])."</td>";
						
					$htmlOutput .= "</tr>";					
					
					$i++;
				}
			
			
				$htmlOutput .= "</tbody></table><div class='clearfix text-center'>".$output['pagination']."</div><script>classPlanSelectAll();</script>";
			
			}else{
				
				$htmlOutput .= "<tr><td colspan='8'>No Matches Found.</td></tr></tbody></table>";	
			}
			
		   return $htmlOutput;
		   				
			
			
     }

     


     function makePrintClassListWithpaginationForPrint($args,$page,$targetpage,$hasAction){
			
              // var_dump($args);
				
			if(is_array($args) && count($args)>0){
				
					foreach($args as $k=>$v){						
						$$k = $v;						
					}
					$sql = "";
					
					   
				   if(!empty($date_class_list)){
				       
                       $query = $this->db->query("SELECT * FROM ".$this->fixidb->class_lists." WHERE date LIKE '".date("Y-m-d",strtotime($date_class_list))."' ORDER BY id DESC");	   
							   if($query->num_rows()>0){
                                   
                                   $sql = "SELECT * FROM ".$this->fixidb->class_plan." WHERE 1 "; $and="AND (";
                                   $i =0;
								   foreach($query->result() as $rows){
									   
									   $class_planid = $rows->class_planid;
									   $time_planid =  $rows->time_planid;         
									   
									   $class_plan_query = $this->db->query("SELECT * FROM ".$this->fixidb->class_plan." WHERE id = '".$class_planid."' LIMIT 1");
									   	
									   
									   $time_plan_query = $this->db->query("SELECT * FROM ".$this->fixidb->time_plan." WHERE id = '".$time_planid."' LIMIT 1");

									   $course_relation_id          = $class_plan_query->row()->course_relation_id;
									   $course_module_id            = $class_plan_query->row()->coursemodule_id;
									   $classPlanID                 = $class_plan_query->row()->id;
									   $groupname                   = $class_plan_query->row()->group_name;
									   $course_relation_query       = $this->db->query("SELECT * FROM ".$this->fixidb->course_relation." WHERE id = '".$course_relation_id."' LIMIT 1");
									   $module_relation_query       = $this->db->query("SELECT * FROM ".$this->fixidb->coursemodule." WHERE id = '".$course_module_id."' LIMIT 1");

									   $course_relation_course_id   = ($course_relation_query->num_rows>0) ? $course_relation_query->row()->course_id : "";
									   $module_relation_module_id   = ($module_relation_query->num_rows>0) ? $module_relation_query->row()->id : "" ;
									   
									   
									    if(!empty($course_id)){
									   		
									   		if($course_relation_course_id != $course_id){
												continue;
									   		}
										   										   
									    }
									    if(!empty($coursemodule_id)){
									   		
									   		if($module_relation_module_id != $coursemodule_id ){
									   			
												continue;
									   		}
										   										   
									    }
									    if(!empty($group_name)){    
									   		       
									   		if($groupname != $group_name){
									   			
												continue;
									   		}
										   										   
									    }    
									   
										   
					   					$sql .= $and."id='".$class_planid."'";	   										   
										$and = " OR ";
									   										   
									  
									   
                                     $i=1;

								   }
                                   if($i==0) { $sql .=$and."1 AND 0"; }
                                   $sql .= ") ORDER BY id DESC";
								   
							   }				   	   
				   
				   }				   
				   				
									
			}
			if($sql == "") {
				$output['total_rec'] = 0;
			} else {
			
			   $output = $this->getPaginationCustom($sql,$page,$targetpage,$hasAction);
			}
		   
		   
		   
			$htmlOutput = "<table class='table table-hover search-class-list' border='1' style='border-collapse: collapse;'>";
	 
			$htmlOutput .= "<thead>
			                	<tr>
			                	 <th colspan='4'>".hr_date($args['date_class_list'])."</th>
			                	 <th colspan='4' class='text-right'>Total Result: ".$output['total_rec']."</th>
			                	</tr>			                	
								<tr id='list_thead'>
									
									<th>Semester</th>
									<th>Course</th>
									<th>Module</th>
									<th>Group</th>
									<th>Tutor</th>
									<th>Time</th>
									<th>Room</th>
								</tr>
							</thead>
							<tbody class='class-list'>";				   
			
			if($output['total_rec']>0){
	            $i=1;
				foreach($output['row_array'] as $k=>$v){
					$c_s_id = $this->course_relation->get_course_ID_semester_ID_by_ID($v["course_relation_id"]);
					
					$htmlOutput .= "<tr>";
					  
					

					$htmlOutput .= "<td valign='top' class='course_name'>".$this->semister->get_name($c_s_id['semester_id'])."</td>";
					$htmlOutput .= "<td valign='top'>".$this->course->get_name($c_s_id['course_id'])."</td>";
					$htmlOutput .= "<td valign='top' class='module_name'>".$this->coursemodule->get_name_by_id($v['coursemodule_id'])."</td>";
					$htmlOutput .= "<td valign='top'>".$v['group_name']."</td>";
					$htmlOutput .= "<td valign='top'>".$this->staff->get_name($v['tutor_id'])."</td>";
					$htmlOutput .= "<td valign='top'>".$this->time_plan->get_viewable_from_to_date_by_id($v['time_planid'])."</td>";
					$htmlOutput .= "<td>".$this->room_plan->get_name_by_id($v['room_id'])."</td>";
						
					$htmlOutput .= "</tr>";					
					
					$i++;
				}
			
			
				$htmlOutput .= "</tbody></table>";
			
			}else{
				
				$htmlOutput .= "<tr><td colspan='8'>No Matches Found.</td></tr></tbody></table>";	
			}
			
		   return $htmlOutput;
		   				
			
			
     }     
     
     
     

	function getPaginationCustom($sql_query,$page,$targetpage,$hasAction){


		if($hasAction=="yes") $pp = "&"; else $pp = "?";
		
		// How many adjacent pages should be shown on each side?
		$adjacents = 3;
		

        
		$query=$this->db->query($sql_query);
		//var_dump($query);
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
				$field_query=$this->db->get($this->fixidb->class_plan);
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
<script type="text/javascript">

$(document).ready(function(){


function print_form(cls){


    var matchedElements = document.getElementsByClassName(cls);
    var str = '';

    for (var i = 0; i < matchedElements.length; i++) {
        var str = str + matchedElements[i].innerHTML;
    }
    var h = document.getElementsByClassName(cls).offsetHeight;
    var newwin = window.open('', 'printwin', 'left=100,top=100,width=780,height='+h);

    newwin.document.write('<HTML>\n<HEAD>\n');
    newwin.document.write('<STYLE media=\'print\'>\n');
    newwin.document.write('.search-class-list tbody.class-list tr td{ font-size: 90%; padding-top:1%;padding-bottom:1%;}\n');
    newwin.document.write('.search-class-list thead tr#list_thead{ text-align: left; }\n');
    newwin.document.write('.search-class-list tbody.class-list tr td.course_name{ width:13%; }\n');
    newwin.document.write('.search-class-list tbody.class-list tr td.module_name{ font-size: 80%; }\n');
    newwin.document.write('.print_feed_attendance table.table { border: 1px solid black; border-collapse: collapse;}\n');
    newwin.document.write('.div_print_table{ font-size: 50%; }\n');
    newwin.document.write('.text-large{ font-size: 110%; }\n');
    newwin.document.write('.bold{ font-weight:bold; }\n');
    newwin.document.write('.right{ text-align: right; width:100%; }\n');
    newwin.document.write('.center{ text-align: center; }\n');
    newwin.document.write('.blocked_header{ background-color: \'Gray\'; padding: 8px; font-weight:bold; font-size: 90%; }\n');
    newwin.document.write('.field_header{ font-size: 80%; padding:8px; font-weight:bold; }\n');
    newwin.document.write('.field_text{ font-size: 80%; text-transform: capitalize; padding:8px; }\n');
    newwin.document.write('</STYLE>\n');
    newwin.document.write('<TITLE>Print Application</TITLE>\n');
    newwin.document.write('<script>\n');
    newwin.document.write('function chkstate(){\n');
    newwin.document.write('if(document.readyState=="complete"){\n');
    newwin.document.write('window.close();\n');//window.close()
    newwin.document.write('}\n');
    newwin.document.write('else{\n');
    newwin.document.write('setTimeout("chkstate()",2000)\n');
    newwin.document.write('}\n');
    newwin.document.write('}\n');
    newwin.document.write('function print_win(){\n');
    newwin.document.write('window.print();\n');
    newwin.document.write('chkstate();\n');
    newwin.document.write('}\n');
    newwin.document.write('<\/script>\n');
    newwin.document.write('</HEAD>\n');
    newwin.document.write('<BODY onload="print_win()">\n');
    newwin.document.write(str);
    newwin.document.write('</BODY>\n');
    newwin.document.write('</HTML>\n');
    newwin.document.close();


}
print_form('print_feed_attendance');  
  // window.print();
    
});

</script>

<style media='print'>
.print_feed_attendance{width:100%; font-size: 50%;} .text-mid{ font-size: 150%; } .text-large{ font-size: 200%;} .bold{font-weight:bold;} .right{ text-align: right; width:100%;} .center{text-align: center;} .blocked_header{background-color: #ddd;padding: 8px;font-weight:bold;font-size: 130%;} .clear{clear:both;} .field_header{font-size: 110%;padding:8px;font-weight:bold;} .field_text{font-size: 110%;text-transform: capitalize;padding:8px;} .border-top{border-top: 1px solid #ddd;} .print_table tr td{width:50%;}
.print_feed_attendance table.table { border: 1px solid black; border-collapse: collapse;}


</style>


                
                <div class="row">
	                <div class="col-lg-12" style="margin-bottom:10px;">
<?php
//if(!empty($staff_privileges_letter_management['letter_mng_add']) || $this->session->userdata('label')=="admin"){	                	
?>	                

<?php
//}	                	
?>

<?php




?>
                		
                			<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/print_class_routine_management/?action=view_student_list&class_plan_id=<?php echo (int) $this->input->get('class_plan_id') ?>"><i class="fa fa-arrow-left"></i> Back to Class Routine</a>
						
                		
							
						
	                </div>
	                
                </div>
                
                               

                <div class="row">
                    
                    
		                <div class="col-lg-12">
		                	
			                
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7">
			                			 <h4><i class="fa fa-file-text "></i> Assigned Students List </h4>
			                		</div>
			                		
			                	</div>
			                

	                        
	                        <div class="row">
		                        <div class="col-sm-12 print_feed_attendance" >
		                        
		                        	<h3 style="text-align:center">Feed Attendance List</h3>
									<table class="table table-bordered" width="100%" border="1" style="border-collapse: collapse;text-align:center">
										<thead>
											<tr>
												<th>Class Plan ID</th>												
												<th>Semester Name</th>
												<th>Course Name</th>
												<th>Module Name</th>
												<th>Group</th>
												
											</tr>
										</thead>
										<tbody>

<?php

											$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan['course_relation_id']);
											//var_dump($c_s_data);
											echo"<tr>";
												echo"<td>".$class_plan['id']."<input type='hidden' name='class_plan_id' value='".$class_plan['id']."'></td>";
												echo"<td>".$this->semister->get_name($c_s_data['semester_id'])."</td>";
												echo"<td>".$this->course->get_name($c_s_data['course_id'])."<input type='hidden' name='course_name' value='".$this->course->get_name($c_s_data['course_id'])."'></td>";
												echo"<td>".$this->coursemodule->get_name_by_id($class_plan['coursemodule_id'])."<input type='hidden' name='module_name' value='".$this->coursemodule->get_name_by_id($class_plan['coursemodule_id'])."'></td>";
												echo"<td>".$class_plan['group_name']."<input type='hidden' name='group_name' value='".$class_plan['group_name']."'></td>";
												
											echo"</tr>";
											
											
?>										
										</tbody>
									</table>

									<table class="table table-bordered" width="100%" border="1" style="border-collapse: collapse;margin-top:10px;text-align:center">
										<thead>
											<tr>
												<th>Tutor name</th>
												<th>Time</th>
												<th>Room</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php 

												echo"<td>".$this->staff->get_name($class_plan['tutor_id'])."<input type='hidden' name='tutor_name' value='".$this->staff->get_name($class_plan['tutor_id'])."'></td>";
												echo"<td>".$this->time_plan->get_viewable_from_to_date_by_id($class_plan['time_planid'])."<input type='hidden' name='class_time' value='".$this->time_plan->get_viewable_from_to_date_by_id($class_plan['time_planid'])."'></td>";
												echo"<td>".$this->room_plan->get_name_by_id($class_plan['room_id'])."</td>";
												echo"<td>".hr_date($routine_date['terms']['date_class_list'])."<input type='hidden' name='attendance_date' value='".$routine_date['terms']['date_class_list']."'></td>";


												 ?>
											</tr>
										</tbody>
									<tbody>

									
									
									<table class="table table-bordered" width="100%" border="1" style="border-collapse: collapse; margin-top:20px;text-align:center">
										<thead>
											<tr>
												<th>Registration No</th>												
												<th>Student Name</th>
												<th>Attendance</th>
												<!-- <th>Send Notification</th> -->
											</tr>
										</thead>
										<tbody>									
										<?php 
											$i = 1; $j = 20000; $l = 40000; $m = 6000; $n = 8000;
											foreach($student_data_list as $k=>$v){
												
												$reg_data = $this->register->get_by_ID($v['register_id']);
												if(!empty($reg_data)) {
												$student_name = $this->student_data->get_first_sur_name($reg_data['student_data_id']);
												if(!empty($attendance)) {
													foreach($attendance as $x=>$y) {
														if($y['register_id'] == $v['register_id']) {

														echo"<tr class='gradeA'>";
															echo"<td width='20%'>".$reg_data['registration_no']."<input type='hidden' name='registration_no_".$i."' value='".$reg_data['registration_no']."'><input type='hidden' name='attendance_id_".$i."' value='".$y['id']."'></td>";
															echo"<td width='20%'>".$student_name."</td>";
															echo"
															<td width='20%'>

																";
															if ($y['attendance_type'] == 'P') {
															echo	"<p>Present</p>";
															} elseif($y['attendance_type'] == 'L.E') {
															echo	"<p>Left early</p>";
															} elseif($y['attendance_type'] == 'A') {
															echo	"<p>Absence</p>";
															} elseif($y['attendance_type'] == 'L') {		
															echo	"<p>Late</p>";
															} elseif($y['attendance_type'] == 'E') {
															echo	"<p>Excuse</p>";
															}
															echo "</td>
															";
															
															
														echo"</tr>";
														}
													}
												}
												}
												$i++; $j++; $l++; $m++; $n++;

											}										
											?>										
										</tbody>
									</table>										
		                        

			                            	                            	                            	                            	                            	                            	                            	                            	                            
		                        </div><!--<div class="col-sm-12 no-pad">-->
	                            <div class="clearfix"></div>
	                        </div>
	                        
	                        <div class="clearfix reg-student-list">
	                        

            
						        <?php if(!empty($result)){ ?>
            						<?php echo $result; ?>            
						        <?php } ?>

	                        
	                        
	                        </div>
	                        
	                        <div class="clearfix"></div>
							
			                

		           		</div>

		           		
                        

            </div>
            
            
            
            
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm delete</h4>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger confirm-btn">Yes</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->              

           
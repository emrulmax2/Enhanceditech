<script type="text/javascript">

$(document).ready(function(){
          
	$('#checkbox99999999999').click(function(){
		
		if(this.checked==true){
			$.each($('.send-notofication').find('.notify-via-email'),function(){
				var checkeed = $(this).parents(".gradeA").find('.check_absence').attr('checked');

				if(checkeed == "checked") {
					this.checked=true;	
				} else {
					this.checked=false;	
				}
				
				
			});
			
		}else{
			$.each($('.send-notofication').find('.notify-via-email'),function(){
			
				this.checked=false;	
				
			});			
		}
		
	});

	$('#checkbox9999999999912').click(function(){
		
		if(this.checked==true){
			$.each($('.send-notofication').find('.notify-via-sms'),function(){
			
				var checkeed = $(this).parents(".gradeA").find('.check_absence').attr('checked');

				if(checkeed == "checked") {
					this.checked=true;	
				} else {
					this.checked=false;	
				}	
				
			});
			
		}else{
			$.each($('.send-notofication').find('.notify-via-sms'),function(){
			
				this.checked=false;	
				
			});			
		}
		
	});
		
	
		
     $('.remove-btn').click(function(){
            
        var id = $(this).attr('id'); //alert(id);
        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList(\''+id+'\',\'student_assign_class\')');
        $('#myModal').css({'top':'30%'});
        $('#myModal').modal('hide');
        $('#myModal').modal('toggle');
         //alert('yes');
        
    });

     $(".attendance-column").find('.class-plan-id').click(function() {

     	if(this.checked == true) {
     		$(this).parent('.radio').siblings('.radio').find('input').removeAttr('checked');
     		$(this).attr('checked', 'checked');
     	} 
     });
    
    
       
});

function recallRemove(){
   
}

function regStudentSelectAll(){
	
	
	
	$('#checkbox99999999999').click(function(){
		
		if(this.checked==true){
			$.each($('.reg-student-list').find('.student-data-id'),function(){
			
				this.checked=true;	
				
			});
			
		}else{
			$.each($('.reg-student-list').find('.student-data-id'),function(){
			
				this.checked=false;	
				
			});			
		}
		
	});	
	
	
	
}


</script>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
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
                		
                			<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/print_class_routine_management/?action=search"><i class="fa fa-arrow-left"></i> Back to Class Routine</a>
						
                		
							<a class="btn btn-md btn-warning btn-assign-student" href="<?php echo base_url() ?>index.php/print_feed_attendance/?class_plan_id=<?php if(!empty($class_plan)) { echo $class_plan['id']; } ?>"><i class="fa fa-print"></i> Print</a>
						
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
		                <div class="col-lg-12">
		                	<form action="" method="post">
			                
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7">
			                			 <h4><i class="fa fa-file-text "></i> Assigned Students List </h4>
			                		</div>
			                		
			                	</div>
			                

	                        
	                        <div class="row">
		                        <div class="col-sm-12">
		                        
		                        
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Class Plan ID</th>												
												<th>Semester Name</th>
												<th>Course Name</th>
												<th>Module Name</th>
												<th>Group</th>
												<th>Tutor name</th>
												<th>Time</th>
												<th>Room</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>

<?php
											if(!empty($class_plan)) {


											$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan['course_relation_id']);
											//var_dump($c_s_data);
											echo"<tr>";
												echo"<td>".$class_plan['id']."<input type='hidden' name='class_plan_id' value='".$class_plan['id']."'></td>";
												echo"<td>".$this->semister->get_name($c_s_data['semester_id'])."</td>";
												echo"<td>".$this->course->get_name($c_s_data['course_id'])."<input type='hidden' name='course_name' value='".$this->course->get_name($c_s_data['course_id'])."'></td>";
												echo"<td>".$this->coursemodule->get_name_by_id($class_plan['coursemodule_id'])."<input type='hidden' name='module_name' value='".$this->coursemodule->get_name_by_id($class_plan['coursemodule_id'])."'></td>";
												echo"<td>".$class_plan['group_name']."<input type='hidden' name='group_name' value='".$class_plan['group_name']."'></td>";
												echo"<td>".$this->staff->get_name($class_plan['tutor_id'])."<input type='hidden' name='tutor_name' value='".$this->staff->get_name($class_plan['tutor_id'])."'></td>";
												echo"<td>".$this->time_plan->get_viewable_from_to_date_by_id($class_plan['time_planid'])."<input type='hidden' name='class_time' value='".$this->time_plan->get_viewable_from_to_date_by_id($class_plan['time_planid'])."'></td>";
												echo"<td>".$this->room_plan->get_name_by_id($class_plan['room_id'])."</td>";
												echo"<td>".hr_date($routine_date['terms']['date_class_list'])."<input type='hidden' name='attendance_date' value='".$routine_date['terms']['date_class_list']."'></td>";
											echo"</tr>";
											
											}
?>										
										</tbody>
									</table>

									
									
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Registration No</th>												
												<th>Student Name</th>
												<th>Attendance</th>

												<th><div class='checkbox checkbox-primary notify-email'><input id='checkbox99999999999' type='checkbox' class='form-control'><label for='checkbox99999999999'>Notify by Email</label></div></th>

												<th><div class='checkbox checkbox-primary'><input id='checkbox9999999999912' type='checkbox' class='form-control'><label for='checkbox9999999999912'>Notify by SMS</label></div></th>
											</tr>
										</thead>
										<tbody class="send-notofication">									
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
															echo"<td width='13%'>".$reg_data['registration_no']."<input type='hidden' name='registration_no_".$i."' value='".$reg_data['registration_no']."'><input type='hidden' name='attendance_id_".$i."' value='".$y['id']."'></td>";
															echo"<td width='15%'>".$student_name."</td>";
															echo"
															<td width='40%' class='attendance-column'>
															
																<div class='radio radio-info radio-inline'>
																    <input";
															if ($y['attendance_type'] == 'P') {
																echo " checked='checked'";
															
															}
															echo	" name='attendance_type_".$i."' id='radio".$i."' type='radio' class='form-control class-plan-id' value='P'>
																    <label for='radio".$i."'>Present</label>
																</div>
																<div class='radio radio-info radio-inline'>
																    <input";
															if ($y['attendance_type'] == 'L.E') {
																echo " checked='checked'";
															
															}
															echo	 " name='attendance_type_".$i."' id='radio".$j."' type='radio' class='form-control class-plan-id' value='L.E'>
																    <label for='radio".$j."'>Left early</label>
																</div>
															
																<div class='radio radio-info radio-inline'>
																    <input";
															if ($y['attendance_type'] == 'A') {
																echo " checked='checked'";
															
															}	    
															echo    " name='attendance_type_".$i."' id='radio".$l."' type='radio' class='form-control class-plan-id check_absence' value='A'>
																    <label for='radio".$l."'>Absence</label>
																</div>
																<div class='radio radio-info radio-inline'>
																    <input";
															if ($y['attendance_type'] == 'L') {
																echo " checked = 'checked'";
															
															}	    
															echo    " name='attendance_type_".$i."' id='radio".$m."' type='radio' class='form-control class-plan-id' value='L'>
																    <label for='radio".$m."'>Late</label>
																</div>
															
																<div class='radio radio-info radio-inline' style=\"margin-left: 0\">
																    <input";
															if ($y['attendance_type'] == 'E') {
																echo " checked='checked'";
															
															}
															echo    " name='attendance_type_".$i."' id='radio".$n."' type='radio' class='form-control class-plan-id' value='E'>
																    <label for='radio".$n."'>Excuse</label>
																</div>
															
															</td>
															";
															echo" <td align='center' width='16%'>";

																echo "<div class='checkbox checkbox-primary'>
																	<input";

																if ($y['notify_email'] == 1) {
																	echo " checked='checked'";
																
																}
																echo	" name='notify_email_".$i."' id='checkbox".$i."' type='checkbox' class='form-control notify-via-email' value='1'>
																	<label for='checkbox".$i."'></label>
																</div>";
															
															echo "</td>";

															echo "<td align='center' width='17%'>";
																echo "<div class='checkbox checkbox-primary'>
																	<input";
																if ($y['notify_sms'] == 1) {
																	echo " checked='checked'";
																
																}
																echo	" name='notify_sms_".$i."' id='checkbox".$j."' type='checkbox' class='form-control notify-via-sms' value='1'>
																	<label for='checkbox".$j."'></label>
																</div>";
															echo "</td>";

														echo"</tr>";
														}
													}
												} else {
													echo"<tr class='gradeA'>";
														echo"<td width='13%'>".$reg_data['registration_no']."<input type='hidden' name='registration_no_".$i."' value='".$reg_data['registration_no']."'></td>";
														echo"<td width='15%'>".$student_name."</td>";
														echo"
														<td width='40%' class='attendance-column'>
															
																<div class='radio radio-info radio-inline'>
																    <input name='attendance_type_".$i."' id='radio".$i."' type='radio' class='form-control class-plan-id' value='P'>
																    <label for='radio".$i."'>Present</label>
																</div>
																<div class='radio radio-info radio-inline'>
																    <input name='attendance_type_".$i."' id='radio".$j."' type='radio' class='form-control class-plan-id' value='L.E'>
																    <label for='radio".$j."'>Left early</label>
																</div>
															
																<div class='radio radio-info radio-inline'>
																    <input checked name='attendance_type_".$i."' id='radio".$l."' type='radio' class='form-control class-plan-id check_absence' value='A'>
																    <label for='radio".$l."'>Absence</label>
																</div>
																<div class='radio radio-info radio-inline'>
																    <input name='attendance_type_".$i."' id='radio".$m."' type='radio' class='form-control class-plan-id' value='L'>
																    <label for='radio".$m."'>Late</label>
																</div>
															
																<div class='radio radio-info radio-inline' style=\"margin-left: 0\">
																    <input name='attendance_type_".$i."' id='radio".$n."' type='radio' class='form-control class-plan-id' value='E'>
																    <label for='radio".$n."'>Excuse</label>
																</div>
															
														</td>
														";
														echo"<td align='center' width='16%'>";
														//if($i ==1) {
																echo "<div class='checkbox checkbox-primary'>
																	<input name='notify_email_".$i."' id='checkbox".$i."' type='checkbox' class='form-control notify-via-email' value='1'>
																	<label for='checkbox".$i."'></label>
																</div>
															</td>

															<td align='center' width='17%'>

																<div class='checkbox checkbox-primary'>
																	<input name='notify_sms_".$i."' id='checkbox".$j."' type='checkbox' class='form-control notify-via-sms' value='1'>
																	<label for='checkbox".$j."'></label>
																</div>";
														//}
														echo "</td>";
														
													echo"</tr>";
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
	                        <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
	                        
	                        <div class="clearfix"></div>
							<div class="text-right">
								<button class="btn btn-info" type="submit">Save</button>
							</div>
							</form>
			                

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

           
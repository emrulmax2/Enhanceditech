
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if(!empty($semester_plan) && is_array($semester_plan)){
			foreach($semester_plan as $k=>$v){
				
				$$k=tinymce_decode($v);
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if($k=="start_date" || $k=="end_date" || $k=="teaching_start" || $k=="teaching_end" || $k=="revision_start" || $k=="revision_end"){
					echo "$('input[name=$k]').val('".date("d-m-Y",strtotime(tinymce_decode($v)))."');";
					//echo "$('.imgpreview img').attr('src','".tinymce_decode($v)."');";
				}else
				if($k=="semester_id"){
					echo "$('select[name=$k]').val('".tinymce_decode($v)."');";	
				}else	
				echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
			}
		}
		

	
		/*if(!empty($terms) && is_array($terms)){
			foreach($terms as $k=>$v){
				
				$$k=tinymce_decode($v);

					echo "$('select[name=$k]').val('".tinymce_decode($v)."');";	
	
			}
		}*/	
	
		
		
		
		if(!empty($class_plan_id_edit)){
			
			//var_dump($class_plan_id_edit);
			$class_plan_data = $this->class_plan->get_by_ID($class_plan_id_edit);
			
			$c_s_id = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan_data['course_relation_id']);
			$course_id = $c_s_id['course_id'];
			$semister_id = $c_s_id['semester_id'];
			$coursemodule_id = $class_plan_data['coursemodule_id'];
			
?>

           
			var course_id 		= 	'<?php echo $course_id; ?>';
			var semister_id 	= 	'<?php echo $semister_id; ?>';
			var coursemodule_id	=	'<?php echo $coursemodule_id; ?>';

		  	url = getURL()+'/index.php/ajaxall/';
		  	$.post(url, {action: 'getModulenameByCourseIDForClassPlanEdit', course_id: course_id, coursemodule_id: coursemodule_id  },
			function(msg){ 

			    $('form .coursemodule_id').html(msg);

			} );			
			
           $('form .course_id').val('<?php echo $course_id; ?>');
           $('form .semister_id').val('<?php echo $semister_id; ?>');
           $('form .course_relation_id').val('<?php echo $class_plan_data['course_relation_id']; ?>');
           //$('form .coursemodule_id').val(coursemodule_id);
           //$('.coursemodule_id option[value="' + coursemodule_id + '"]').prop('selected', true);
           //alert($('select[name=coursemodule_id]').val());			           
           $('form input.number_of_groups').attr('readonly',true);
           
           $('form .group-loading').show();
           
		   url = getURL()+'/index.php/ajaxall/';
		   $.post(url, {action: 'getFirstTimeGroupFormDataForClassPlan', course_id: course_id, semister_id: semister_id, coursemodule_id: coursemodule_id  },
		   function(msg){ 

				$('form .group_area').hide().html(msg).fadeIn(2000);
				$('form .group-loading').hide();

		   } );           

<?php			
			
		}
		
		    	
	?>    



	
	
		if($('form .course_id').val()>""){
			
			var course_id = $('form .course_id').val();
			  url = getURL()+'/index.php/ajaxall/';
			  $.post(url, {action: 'getModulenameByCourseID', course_id: course_id  },
		        function(msg){ 

		            $('form .coursemodule_id').html(msg);

		        } );			
				
		}	
	
	
	
	
	

	$('form .course_id').bind("change",function(){
		
		 
		if($('form .course_id').val()>""){
			
			var course_id = $('form .course_id').val();
			  url = getURL()+'/index.php/ajaxall/';
			  $.post(url, {action: 'getModulenameByCourseID', course_id: course_id  },
		        function(msg){ 

		            $('form .coursemodule_id').html(msg);

		        } );			
				
		}
		
	});
	
	
	$('form .course_id, form .semister_id').bind("change",function(){
		
		 
		if($('form .course_id').val()>"" && $('form .semister_id').val()>""){
			
			var course_id = $('form .course_id').val();
			var semister_id = $('form .semister_id').val();
			
			  url = getURL()+'/index.php/ajaxall/';
			  $.post(url, {action: 'getCourseRelationIDForClassPlan', course_id: course_id, semister_id: semister_id  },
		        function(msg){ 

		            $('.message').html(msg);

		        } );			
				
		}
		
	});	
	 
	
	/*$('form .number_of_groups').bind("change",function(){
				 
		var num_grp = parseInt($('form .number_of_groups').val());
		
		  url = getURL()+'/index.php/ajaxall/'; $('form .group-loading').show();
		  $.post(url, {action: 'getGroupFormDataForClassPlan', num: num_grp  },
			function(msg){ 

			    $('form .group_area').hide().html(msg).fadeIn(2000);
			    $('form .group-loading').hide();

			} );
		
		
		
	});*/
	
	
	
	$('form .course_id, form .semister_id, form .coursemodule_id').bind("change keyup",function(){
	
		if($('form .course_id').val()>"" && $('form .semister_id').val()>"" && $('form .coursemodule_id').val()>""){
			

			var coursemodule_id	=	$('form .coursemodule_id').val();
			var course_relation_id	=	$('input.course_relation_id').val();
			
			$('form .group-loading').show();
			
			
			  url = getURL()+'/index.php/ajaxall/';
			  $.post(url, {action: 'getListOFGroupNameForExamResult', course_relation_id: course_relation_id, coursemodule_id: coursemodule_id  },
			    function(msg){
			     
                    $('form .group-loading').hide();
				    $('select.group_name').html(msg);

			    });			
				
		}

	});
	
	
	$('.publish-date-btn').click(function(){
					
			$('#publishdateModal').modal('show');
		
	});
	
	$('.submit-publish-date-btn').click(function(){
		//alert('hi');
		var semister_id = $('input:hidden[name=semister_id]').val();
		var course_id = $('input:hidden[name=course_id]').val();
		var coursemodule_id = $('input:hidden[name=coursemodule_id]').val();

		var publishdate = $('.publish-date-input').val();
		var publishtime = $('.publish-time-input').val();
		var examresult_id_arr = []; var register_id_arr = []; var group_name_arr = [];
		
		   // alert(publishdate+" "+publishtime);
			
			if(publishdate>"" && publishtime>""){

				$.each($('tbody.reg-std-row').find('tr'),function(){
				
					var examresult_id = $(this).attr('examresult_id');
					var register_id = $(this).attr('register_id');			
					var group_name = $(this).attr('group_name');
					
					
					if(examresult_id>""){
						examresult_id_arr.push(examresult_id);		
					}else{
						register_id_arr.push(register_id);
						group_name_arr.push(group_name);
					}
				
				
				});
				//alert("yes");
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "examResultPublishDate", current_url:"<?php echo current_url(); ?>",semister_id:semister_id, course_id:course_id, coursemodule_id:coursemodule_id, group_name_arr:group_name_arr, publishdate:publishdate, examresult_id_arr:examresult_id_arr, register_id_arr:register_id_arr, publishtime:publishtime  },
				   url: url,
				   success: function(msg){
				       //alert(msg);
				       //$('#publishdateModal').modal('hide');
				       $('.message').html(msg);				     
				   }
				});					
				
			}// if(publishdate>""){
    
	});

    $('.add-result-data-btn').click(function(){
		
		
		
		//alert($(this).closest('tr').attr('examresult_id'));
		$('#resultDataModal .examresult_id').val($(this).closest('tr').attr('examresult_id'));
		$('#resultDataModal .register_id').val($(this).closest('tr').attr('register_id'));
		$('#resultDataModal .group_name').val($(this).closest('tr').attr('group_name'));
		
		var examresult_id = $(this).closest('tr').attr('examresult_id');
		
		if(examresult_id>""){
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "examResultGetResultData", examresult_id:examresult_id  },
				   url: url,
				   success: function(msg){
				     $('.message').html(msg);
				     //alert(msg);
				     //window.location = getURL()+'/index.php/assign_student_management/';
				   }
				});				
		}
		
		$('#resultDataModal').modal('show');
											
    });

    $('.add-single-result-data').click(function(){
		var semister_id = $('input:hidden[name=semister_id]').val();
		var course_id = $('input:hidden[name=course_id]').val();
		var coursemodule_id = $('input:hidden[name=coursemodule_id]').val();
				
		var percentage = $('#resultDataModal .percentage').val();
		var grade = $('#resultDataModal .grade').val();
		var marks = $('#resultDataModal .marks').val();
		var PaperID = $('#resultDataModal .PaperID').val();
		var examresult_id = $('#resultDataModal .examresult_id').val();
		var register_id = $('#resultDataModal .register_id').val();
		var group_name = $('#resultDataModal .group_name').val();
		
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "examResultAddResultData", semister_id:semister_id, course_id:course_id, coursemodule_id:coursemodule_id, percentage:percentage, grade:grade, marks:marks, PaperID:PaperID, examresult_id:examresult_id, register_id:register_id, group_name:group_name  },
				   url: url,
				   success: function(data){
				   	   //$('#publishdateModal').modal('hide');
				     $('.message').html(data);
				   /*  if(data=="") {
                                    

                           $(".msg").html("<i class='fa fa-warning'></i> Module can't create. Please refresh your application."); 

                           $(".msg").fadeIn();

                           if($(".msg").hasClass('alert-success'))

                           $(".msg").removeClass("alert alert-success");

                           $(".msg").addClass("alert alert-warning");                

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000);}); 

                    } else {
                                    

                           $(".msg").fadeIn();

                           $(".msg").html("<i class='fa fa-warning'></i> Module successfully created. Please click to close");

                           if($(".msg").hasClass('alert-warning'))

                           $(".msg").removeClass("alert alert-warning");

                           $(".msg").addClass("alert alert-success");  

                           $(".loading").fadeOut(1000,function(){ $(".msg").fadeOut(1000 ,function(){  location.reload(); });});

                    }   */
				   }
				});		
											
    });
    
    $('.upload-feedback-btn').click(function(){
		
		var examresult_id = $(this).closest('tr').attr('examresult_id');
		if(examresult_id>""){
			
			$('#myUploadDoc input.examresult_id').val(examresult_id);
			$('#myUploadDoc').modal('show');
			
		}else{
			
			$('#warningModal div.modal-body').html('Please Add result First.');
			$('#warningModal').modal('show');
			
		}
		
			
    });
    
    $('button#changebuttonstate[name=uploadSignatoryDoc]').click(function(){
		
		var filename = $('#myUploadDoc input.documentfile').val();
		var examresult_id = $('#myUploadDoc input.examresult_id').val();
		var filepath = "uploads/files/"+filename;
		
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {action: "examResultfeedbackFilepath", filepath:filepath, examresult_id:examresult_id  },
				   url: url,
				   success: function(msg){
				     $('.message').html(msg);
				     //alert(msg);
				     //window.location = getURL()+'/index.php/assign_student_management/';
				   }
				});		
		
    });	
    
    
    $('.print-btn').click(function(){
	
		print_report("print-data-div","Print Exam Result","td.ft { border-left: 1px solid #ddd;border-right: 1px solid #ddd;border-top: 1px solid #ddd;font-size:11px;} td.mt { border-right: 1px solid #ddd;border-top: 1px solid #ddd;font-size:11px;}");		
		
    });

	
	
});	
	
	
function addNewGroup(){
	
		if($('form .course_id').val()>"" && $('form .semister_id').val()>"" && $('form .coursemodule_id').val()>"" && $('form .number_of_groups').val()>""){
			
			var course_id 		= 	$('form .course_id').val();
			var semister_id 	= 	$('form .semister_id').val();
			var coursemodule_id	=	$('form .coursemodule_id').val();
			var number_of_groups =  parseInt($('form .number_of_groups'));
			$('form .group-loading').show();
			
			
			  url = getURL()+'/index.php/ajaxall/';
			  $.post(url, {action: 'getOldAndNewGroupFormDataForClassPlan', course_id: course_id, semister_id: semister_id, coursemodule_id: coursemodule_id, number_of_groups: number_of_groups  },
			    function(msg){ 

				    $('form .group_area').hide().html(msg).fadeIn(2000);
				    $('form .group-loading').hide();

			    } );			
				
		}			
	
}



function recallRemove(){
   
}

function showTimeTeachingRevision(){
	
	
	$('form .time_planid, form .semester_planid').change(function(){
		
		    var ref = $(this);
		    var time_planid = parseInt($(this).closest('.group').find('.time_planid').val());
		    var semester_planid = parseInt($(this).closest('.group').find('.semester_planid').val());
		    
		    if(time_planid>0 && semester_planid>0){
				  url = getURL()+'/index.php/ajaxall/';
				  $.post(url, {action: 'getTimeAndSemPlan', time_planid: time_planid, semester_planid: semester_planid  },
				    function(msg){ 

					    //$('form .group_area').hide().html(msg).fadeIn(2000);
                        //alert(msg);
                        $(ref).closest('.group').find('.semester-plan-data-area').html(msg);
				    } );
			}     		    
		    //alert(time_planid); 
				
		
		
	});
}


</script>





                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
//if(!empty($staff_privileges_letter_management['letter_mng_add']) || $this->session->userdata('label')=="admin"){	                	
?>	                
                		
<?php
//}	                	
?>                		
                		<!--<a class="btn btn-md btn-info" href="<?php //echo base_url(); ?>index.php/class_plan_management/?action=list"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    
                    
		                <div class="col-lg-12">
			                
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7">
			                			 <h4><i class="fa fa-file-text "></i> Exam Result </h4>
			                		</div>
			                		<!--<div class="col-lg-5 col-md-5 col-sm-5">
										<div class="text-right btn-area">

										</div>

			                		</div>-->
			                		<div class="clearfix"></div>
			                	</div>
			                
		                        <div class="row">
		                        
		                        	<div class="col-xs-12">
		                        		<form role="form" method="post" action="<?php echo base_url(); ?>index.php/exam_result_management/?action=search">
													<div class="panel panel-primary">
													<div class="panel-heading">
														<div class="col-sm-6"><h3 class="panel-title">Exam Result Search Form</h3></div>
														<div class="col-sm-6 text-right">
				                							<button type="submit" class="btn btn-default btn-success btn-sm">Search</button>
				                							<button type="reset" class="btn btn-default btn-danger btn-sm">Cancel</button>														
														</div>
														<div class="clearfix"></div>
													</div>
													<div class="panel-body">
													 
									                        <div class="form-group">
				                        						<input class="form-control course_relation_id" type="hidden" name="course_relation_id">
	                        									<div class="col-sm-3">
										                            <label>Select Semester</label>
										                            <select class="form-control semister_id" name="semister_id" required>
		                            									<option value="">Please Select</option>
								<?php
																			foreach($semister_list as $k=>$v){
																				echo"<option value='".$v['id']."'>".$v['semister_name']."</option>";
																			}		                            		
		                            										
								?>		                            	
										                            </select>
									                            </div>
	                        									<div class="col-sm-3">
										                            <label>Select Course</label>
										                            <select class="form-control course_id" name="course_id" required>
		                            									<option value="">Please Select</option>
								<?php
																			foreach($course_list as $k=>$v){
																				echo"<option value='".$v['id']."'>".$v['course_name']."</option>";
																			}		                            		
		                            										
								?>		                            	
										                            </select>
									                            </div>
									                            
	                        									<div class="col-sm-3">
										                            <label>Select Modules</label>
										                            <select class="form-control coursemodule_id" name="coursemodule_id" required>

	                            						
										                            </select>
									                            </div>
	                        									<div class="col-sm-3">
										                            <label>Group Name <img src="<?php echo base_url(); ?>images/loading.gif" class="loading group-loading"></label>
										                            <select class="form-control group_name" name="group_name">

	                            						
										                            </select>
									                            </div>
									                            <div class="clearfix"></div>	                            	                            	                            
									                        </div>										
													</div>
													</div>
													<div class="clearfix"></div>
													<input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                						<input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
										   </form>
										   <div class="clearfix"></div>
										</div>		                         

				                        
				                        <div class="reg-student-list-area col-sm-12">
				                        
<?php
	
										if(!empty($reg_student_list) && count($reg_student_list)>0){
											
?>



												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Semester</th>
															<th>Course</th>
															<th>Module</th>
															<?php if(!empty($terms['group_name'])) echo "<th>Group</th>"; ?>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php echo $this->semister->get_name($terms['semister_id']); ?><input type="hidden" name="semister_id" value="<?php echo $terms['semister_id']; ?>"></td>
															<td><?php echo $this->course->get_name($terms['course_id']); ?><input type="hidden" name="course_id" value="<?php echo $terms['course_id']; ?>"></td>
															<td><?php echo $this->coursemodule->get_name_by_id($terms['coursemodule_id']); ?><input type="hidden" name="coursemodule_id" value="<?php echo $terms['coursemodule_id']; ?>"></td>
															<?php if(!empty($terms['group_name'])) echo '<td>'.$terms['group_name'].'<input type="hidden" name="group_name" value="'.$terms['group_name'].'"></td>'; ?>
														</tr>
													</tbody>
												</table>
<?php


													
?>												
			                					<div class="row clearfix">

			                						<div class="col-sm-12 ">
														<div class="text-left current-publish-date col-sm-6 no-pad-left">
                                                        
														</div>			                						
														<div class="text-right btn-area col-sm-6 no-pad-right">
														
														
				                							<?php if( (!empty($priv[0]) || $this->session->userdata('label')=="admin") ){ ?><button type="button" class="btn btn-default btn-success publish-date-btn"><i class="fa fa-calendar"></i> Publish Date</button><?php } ?>
				                							<?php if( (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){ ?><button type="button" class="btn btn-default btn-primary print-btn"><i class="fa fa-print"></i> Print</button><?php } ?>
				                							
														
														</div>
                                                        <div class="clearfix"></div>

			                						</div>
			                						<div class="clearfix"></div>
			                					</div>												
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Student ID</th>
															<th>Name</th>															
															<?php if(empty($terms['group_name'])) echo"<th>Group</th>"; ?>															
															<th>Grade</th>
															<th>Percentage</th>
															<th>Paper ID</th>
															<th>Marks</th>
															<th>Feedback</th>
															<th class='text-right'>Action</th>
														</tr>
													</thead>
													<tbody class="reg-std-row">
<?php
														////// ----------------------- Gather printing data
														$print_output  = "";

														$print_output.="
															<h3>Print Exam Result</h3>
															<table class='print-table-data' style='width:100%'>
																<tr>
																	<td>
																		<table style='width:100%; border-bottom:1px solid #ddd;'>
																			<tr>
																				<td class='ft'><h4>Semester</h4></td>
																				<td class='mt' align='center'><h4>Course</h4></td>
																				<td class='mt' align='center'><h4>Module</h4></td>";
																if(!empty($terms['group_name'])) $print_output.="<td class='mt' align='right'><h4>Group</h4></td>";
																$print_output.="
																			</tr>
																			<tr>
																				<td class='ft'>".$this->semister->get_name($terms['semister_id'])."</td>
																				<td class='mt' align='center'>".$this->course->get_name($terms['course_id'])."</td>
																				<td class='mt' align='center'>".$this->coursemodule->get_name_by_id($terms['coursemodule_id'])."</td>";
																				
																if(!empty($terms['group_name'])) $print_output.="<td class='mt' align='right'>".$terms['group_name']."</td>";
																$print_output.="
																			</tr>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td style='height:30px; border-right:none;'></td>
																</tr>
																<tr>
																	<td>
																		<table style='width:100%; border-bottom:1px solid #ddd;'>
																			<tr>																				
																				<td class='ft'><h4>Student ID</h4></td>
																				<td class='mt'><h4>Name</h4></td>";															
																if(empty($terms['group_name'])) $print_output.="<td class='mt'><h4>Group</h4></td>";															
																$print_output.="
																				<td class='mt'><h4>Grade</h4></td>
																				<td class='mt'><h4>Percentage</h4></td>
																				<td class='mt'><h4>Paper ID</h4></td>
																				<td class='mt' align='right'><h4>Marks</h4></td>
																			</tr>
																			";
																			
													////// ----------------------- End Of Gather printing data						
																			
																				
													$published_date = array();
													foreach($reg_student_list as $register_id){
														//var_dump($register_id);
														$std_data = $this->examresult->get_by_register_id($register_id);
														//var_dump($std_data);
														$student_data_id = $this->register->get_student_data_ID_no_by_id($register_id);
														$register_no = $this->register->get_registration_no_by_student_data_ID($student_data_id);
														$name = $this->student_data->get_fullname_by_ID($student_data_id);
														
														$class_plan_list = $this->student_assign_class->get_by_register_id($register_id);
														foreach($class_plan_list as $k=>$v){
															 $coursemodule_id = $this->class_plan->get_coursemodule_id_by_id($v['class_plan_id']);
															 if($coursemodule_id==$terms['coursemodule_id']){
																 $group_name = $this->class_plan->get_group_name_by_id($v['class_plan_id']);
															 }
															//check	
														}
														
														echo"														
															<tr ";
															
														if(!empty($std_data['id'])) echo"examresult_id='".$std_data['id']."' "; else echo"examresult_id='' "; 	
														echo"register_id='$register_id' "; 	
													    echo"group_name='$group_name' ";	
														echo"	>														
																<td>$register_no</td>
																<td>$name</td>";
														 		
														//if(!empty($std_data['grade'])) echo"<td>".$std_data['grade']."</td>"; else 
														if(empty($terms['group_name'])) echo"<td>$group_name</td>";
														if(!empty($std_data['grade'])) echo"<td>".$std_data['grade']."</td>"; else echo"<td></td>"; 		
														if(!empty($std_data['percentage'])) echo"<td>".$std_data['percentage']."</td>"; else echo"<td></td>"; 		
														if(!empty($std_data['PaperID'])) echo"<td>".$std_data['PaperID']."</td>"; else echo"<td></td>"; 		
														if(!empty($std_data['marks'])) echo"<td>".$std_data['marks']."</td>"; else echo"<td></td>"; 		
                                                        if(!empty($std_data['publish_date'])){
															if(!in_array($std_data['publish_date'],$published_date)) $published_date[] = $std_data['publish_date']; 
                                                        } 
														echo"
																<td>";
                                                                
                                                        if( (!empty($priv[2]) || $this->session->userdata('label')=="admin") ){      
																
                                                                if( !empty($std_data['feedback_link']) ) echo " <a href='".base_url().$std_data['feedback_link']."' class='btn btn-default btn-primary view-feedback-btn'><i class='fa fa-download'></i></a>";
																else if( empty($std_data['feedback_link']) ) echo " <a href='#' class='btn btn-default btn-warning view-feedback-btn'><i class='fa fa-warning'></i></a>";
														}
                                                        
                                                        echo"		</td>
																";
																
														echo"		
																<td class='text-right'>";
																if( (!empty($priv[4]) || $this->session->userdata('label')=="admin") )	echo"<button type='button' class='btn btn-default btn-success add-result-data-btn'> Add result data</button>";
																if( (!empty($priv[3]) || $this->session->userdata('label')=="admin") )	echo"<button type='button' class='btn btn-default btn-warning upload-feedback-btn'> Upload Feedback</button>";
																	
														echo"			
																</td>
															</tr>														
														
														";
														
														////// ----------------------- Gather printing data
														
														
																$print_output.="
																			<tr>
																				<td class='ft'>$register_no</td>
																				<td class='mt'>$name</td>";
																if(empty($terms['group_name'])) $print_output.="<td class='mt'>$group_name</td>";
																if(!empty($std_data['grade'])) $print_output.="<td class='mt'>".$std_data['grade']."</td>"; else $print_output.="<td class='mt'>&nbsp;</td>";																								
													            if(!empty($std_data['percentage'])) $print_output.="<td class='mt'>".$std_data['percentage']."</td>"; else $print_output.="<td class='mt'>&nbsp;</td>";
													            if(!empty($std_data['PaperID'])) $print_output.="<td class='mt'>".$std_data['PaperID']."</td>"; else $print_output.="<td class='mt'>&nbsp;</td>";
													            if(!empty($std_data['marks'])) $print_output.="<td class='mt' align='right'>".$std_data['marks']."</td>"; else $print_output.="<td class='mt'>&nbsp;</td>";
																$print_output.="				
																			</tr>";

													            
														////// ----------------------- END OF Gather printing data
																												
													}/// foreach($reg_student_list as $register_id){
													
														////// ----------------------- Gather printing data
																$print_output.="																						
																		</table>
																	</td>																																	
																</tr>	
															</table>
															";														
														////// ----------------------- END OF Gather printing data
																											
													if(count($published_date)>0){
														echo"<script>$(document).ready(function(){";
														foreach($published_date as $dt){
															echo"$('#publishdateModal .publisheddatelist').append('<p>Found published date - ".tohrdatetime($dt)."</p>');"; ///////----------------------------- Assign publish date for publish date modal		
															echo"$('.print-data-div h3').append(' published date - ".tohrdatetime($dt)."');";///////----------------------------- Assign publish date for print		
															echo"$('.current-publish-date').html('Published date - <strong>".tohrdatetime($dt)."</strong>');";///////----------------------------- Assign publish date for current page														
														}
														echo"});</script>";
														//echo "<script>alert('".count($published_date)."');</script>";
													}
													
													
													
													
													
?>


													

													</tbody>
												</table>
												<div class="print-data-div" style="display: none;"><?php echo $print_output; ?></div>
<?php											

												
											
											
										}else{
	
											if($this->input->get('action')>""){
	
?>


												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Semester</th>
															<th>Course</th>
															<th>Module</th>
															<?php if(!empty($terms['group_name'])) echo "<th>Group</th>"; ?>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td><?php echo $this->semister->get_name($terms['semister_id']); ?><input type="hidden" name="semister_id" value="<?php echo $terms['semister_id']; ?>"></td>
															<td><?php echo $this->course->get_name($terms['course_id']); ?><input type="hidden" name="course_id" value="<?php echo $terms['course_id']; ?>"></td>
															<td><?php echo $this->coursemodule->get_name_by_id($terms['coursemodule_id']); ?><input type="hidden" name="coursemodule_id" value="<?php echo $terms['coursemodule_id']; ?>"></td>
															<?php if(!empty($terms['group_name'])) echo '<td>'.$terms['group_name'].'<input type="hidden" name="group_name" value="'.$terms['group_name'].'"></td>'; ?>
														</tr>
													</tbody>
												</table>

			                					<div class="clearfix">

			                						<div class="alert alert-warning col-xs-12" role="alert"><i class="fa fa-exclamation-triangle"></i> No student found!</div>

			                					</div>

<?php
											}
										}
?>
											
											
																					
											
											
											
											
											
											
											
											
											
											
											
											
											
				                        
				                        
				                        </div><!--<div class="group_area col-sm-12">-->
				                        
				                        	                                
                        	                        
	                		    </div>
	                		    
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7"></div>
			                		<div class="col-lg-5 col-md-5 col-sm-5">
			                			<div class="text-right btn-area">
				                			<!--<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>-->
										</div>
			                		</div>
			                		
			                	</div>
			                

		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		

               
               
               
               

            </div>

                 <!-- Modal -->
                <div class="modal fade" id="publishdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add Publish Date</h4>
                      </div>
                      <div class="modal-body">
                      
							<div class="publisheddatelist"></div>
							
                        <div class='form-group'>
	                        <label>Date</label>
	                        <input type="text" class="form-control date publish-date-input" name="publish_date">
                        </div>
                        <div class='form-group'>
	                        <label>Time</label>
	                        <input type="text" class="form-control time publish-time-input" name="publish_time">
                        </div>                        
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-primary submit-publish-date-btn" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
                 <!-- Modal -->
                <div class="modal fade" id="resultDataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add Result Data</h4>
                      </div>
                      <div class="modal-body">
                      	<input type="hidden" class="examresult_id" name='examresult_id'>
                      	<input type="hidden" class="register_id" name='register_id'>
                      	<input type="hidden" class="group_name" name='group_name'>
                        <div class='form-group'>
	                        <label>Percentage (%)</label>
	                        <input type="text" class="form-control percentage" name="percentage">
                        </div>
                        <div class='form-group'>
	                        <label>Grade</label>
	                        <input type="text" class="form-control grade" name="grade">
                        </div>
                        <div class='form-group'>
	                        <label>Marks</label>
	                        <input type="text" class="form-control marks" name="marks">
                        </div>
                        <div class='form-group'>
	                        <label>Paper ID</label>
	                        <input type="text" class="form-control PaperID" name="PaperID">
                        </div>                                                                        
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-primary add-single-result-data" data-dismiss="modal">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                
                           
            
            
                 <!-- Modal -->
                <div class="modal fade" id="myUploadDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Documents</h4>
                      </div>
                      <div class="modal-body">
                      		<input type="hidden" class="examresult_id" name='examresult_id'>
	                      <div class="msg"></div>
	                       <div class="form-group">
	                      <label class="margin-top-2">Upload Document (<i class="alert-warning">file size no more than 10mb</i>) </label><br/>
	                          <span class="btn btn-primary fileinput-button">
	                            <i class="fa fa-plus"></i>
	                            <span>Add file</span>
	                            <!-- The file input field used as target for the file upload widget -->
	                            <input id="fileupload" type="file" name="files[]">
	                            
	                            </span>
	                            <br>
	                            <br>
	                            <!-- The global progress bar -->
	                            <div id="progress" class="progress">
	                                <div class="progress-bar progress-bar-success"></div>
	                            </div>
	                            <!-- The container for the uploaded files -->
	                            <div id="files" class="files">
	                            </div>
	                            <!-- The container for the uploaded files -->     

	                        
	                        </div>

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="uploadSignatoryDoc" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Done</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->             
                
                

                <!-- Modal -->
                <div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Warning!</h4>
                      </div>
                      <div class="modal-body">
                        Please submit before adding another new group.
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
                 


                                

<script type="text/javascript">

$(document).ready(function(){

	$('.moduleAttempt').click(function(){
        $(".loading").fadeIn(); 
        $('.modal-body').html("");
        var student_id = $(this).data('student');
        var module_id = $(this).data('module');  
              //alert(module_id);
            url = getURL()+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: {action: "getAttemptresult", id: student_id, coursemodule_id: module_id },
               url: url,
               success: function(msg){
                   //alert(msg);
                   //$('.message').html(msg).fadeOut( 3000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
                   $('.modal-body').html(msg);
                   $(".loading").fadeOut(); 

               }
            });                        
        
        //alert(certificate_requested); 
        
    });

      
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
	
	
	// $('form .course_id, form .semister_id').bind("change",function(){
		
		 
	// 	if($('form .course_id').val()>"" && $('form .semister_id').val()>""){
			
	// 		var course_id = $('form .course_id').val();
	// 		var semister_id = $('form .semister_id').val();
			
	// 		  url = getURL()+'/index.php/ajaxall/';
	// 		  $.post(url, {action: 'getCourseRelationIDForClassPlan', course_id: course_id, semister_id: semister_id  },
	// 	        function(msg){ 

	// 	            $('.message').html(msg);

	// 	        } );			
				
	// 	}
		
	// });	
	 
	
	/*$('form .number_of_groups').bind("change",function(){
				 
		var num_grp = parseInt($('form .number_of_groups').val());
		
		  url = getURL()+'/index.php/ajaxall/'; $('form .group-loading').show();
		  $.post(url, {action: 'getGroupFormDataForClassPlan', num: num_grp  },
			function(msg){ 

			    $('form .group_area').hide().html(msg).fadeIn(2000);
			    $('form .group-loading').hide();

			} );
		
		
		
	});*/
	
	
	
	// $('form .course_id, form .semister_id, form .coursemodule_id').bind("change keyup",function(){
	
	// 	if($('form .course_id').val()>"" && $('form .semister_id').val()>"" && $('form .coursemodule_id').val()>""){
			

	// 		var coursemodule_id	=	$('form .coursemodule_id').val();
	// 		var course_relation_id	=	$('input.course_relation_id').val();
			
	// 		$('form .group-loading').show();
			
			
	// 		  url = getURL()+'/index.php/ajaxall/';
	// 		  $.post(url, {action: 'getListOFGroupNameForExamResult', course_relation_id: course_relation_id, coursemodule_id: coursemodule_id  },
	// 		    function(msg){
			     
 //                    $('form .group-loading').hide();
	// 			    $('select.group_name').html(msg);

	// 		    });			
				
	// 	}

	// });
	
	
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
			                			 <h4><i class="fa fa-file-text "></i> Previous Exam Result </h4>
			                		</div>
			                		<!--<div class="col-lg-5 col-md-5 col-sm-5">
										<div class="text-right btn-area">

										</div>

			                		</div>-->
			                		<div class="clearfix"></div>
			                	</div>
			                
		                        <div class="row">
		                        
		                        	<div class="col-xs-12">
		                        		<form role="form" method="post" action="<?php echo base_url(); ?>index.php/previous_exam_result/?action=search">
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

									                        	<div class="col-sm-3">
										                            <label>Student ID</label>
										                            
										                            <input type="text" name="registration_no" id="" class="form-control registration_no">

									                            </div>

				                        						<input class="form-control course_relation_id" type="hidden" name="course_relation_id">
	                        									<div class="col-sm-3">
										                            <label>Select Semester</label>
										                            <select class="form-control semister_id" name="semester_id">
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
										                            <select class="form-control course_id" name="course_id">
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
										                            <select class="form-control coursemodule_id" name="coursemodule_id">

	                            						
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
	
										if(!empty($prev_exam_result) && count($prev_exam_result)>0){
											
?>



												<?php if(empty($terms['registration_no'])) {?>
												<table class="table table-bordered">
													<thead>
														<tr>
															<?php if(!empty($terms['semester_id'])) {?>
															<th>Semester</th>
															<?php } ?>
															<?php if(!empty($terms['course_id'])) {?>
															<th>Course</th>
															<?php } ?>
															<?php if(!empty($terms['coursemodule_id'])) {?>
															<th>Module</th>
															<?php } ?>
															
														</tr>
													</thead>
													<tbody>
														<tr>
															<?php if(!empty($terms['semester_id'])) {?>
															<td><?php echo $this->semister->get_name($terms['semester_id']); ?><input type="hidden" name="semester_id" value="<?php echo $terms['semester_id']; ?>"></td>
															<?php } ?>

															<?php if(!empty($terms['course_id'])) {?>
															<td><?php echo $this->course->get_name($terms['course_id']); ?><input type="hidden" name="course_id" value="<?php echo $terms['course_id']; ?>"></td>
															<?php } ?>

															<?php if(!empty($terms['coursemodule_id'])) {?>
															<td><?php echo $this->coursemodule->get_name_by_id($terms['coursemodule_id']); ?><input type="hidden" name="coursemodule_id" value="<?php echo $terms['coursemodule_id']; ?>"></td>
															<?php } ?>

															
														</tr>
													</tbody>
												</table>

												<?php } ?>
<?php


													
?>												
			                					<div class="row clearfix">

			                						<div class="col-sm-12 ">
														<!-- <div class="text-left current-publish-date col-sm-6 no-pad-left">
                                                        
														</div> -->			                						
														<div class="text-right btn-area col-sm-12 no-pad-right">
														
														
				                							
				                							<?php if( (!empty($priv[1]) || $this->session->userdata('label')=="admin") ){ ?><button type="button" class="btn btn-default btn-primary print-btn"><i class="fa fa-print"></i> Print</button><?php } ?>
				                							
														
														</div>
                                                        <div class="clearfix"></div>

			                						</div>
			                						<div class="clearfix"></div>
			                					</div>												
												
												
												<?php 


												$print_output  = "";

														$print_output.="
															<h3>Previous Exam Result</h3>
															<table border='1' class='print-table-data' style='width:100%;border-collapse: collapse;'><thead>
														<tr>
															<th>Student ID</th>
															<th>Name</th>";

															if(empty($terms['semester_id']) && empty($terms['course_id']) && empty($terms['coursemodule_id'])) {
																$print_output.="<th>Semester</th>
															<th>Course</th>
															<th>Module</th>";
															
															 }
															 if(!empty($terms['semester_id']) && empty($terms['course_id']) && empty($terms['coursemodule_id'])) {
																$print_output.="<th>Course</th>
															<th>Module</th>";
															
															 }

															  if(!empty($terms['course_id']) && empty($terms['coursemodule_id'])) {
																$print_output.="<th>Module</th>";
															
															 }
															

														$print_output.="<th>Grade</th>
															<th>Status</th>
															<th>Attempt</th>
															<th>Paper ID</th>
															<th>Module No</th>
															<th>Awarding Body</th>
															<th>Exam Date</th>
														</tr>
													</thead>
													<tbody class='reg-std-row'>";

												 ?>
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Student ID</th>
															<th>Name</th>
															<?php if(empty($terms['semester_id']) && empty($terms['course_id']) && empty($terms['coursemodule_id'])) {?>
															<th>Semester</th>
															<th>Course</th>
															<th>Module</th>
															<?php } ?>

															<?php if(!empty($terms['semester_id']) && empty($terms['course_id']) && empty($terms['coursemodule_id'])) {?>
															<th>Course</th>
															<th>Module</th>

															<?php } ?>

															<?php if(!empty($terms['course_id']) && empty($terms['coursemodule_id'])) {?>
													
															<th>Module</th>

															<?php } ?>

															<th>Grade</th>
															<th>Status</th>
															<th>Attempt</th>
															<th>Paper ID</th>
															<th>Module No</th>
															<th>Awarding Body</th>
															<th>Exam Date</th>
															<!-- <th>Feedback</th> -->
															<!-- <th class='text-right'>Action</th> -->
														</tr>
													</thead>
													<tbody class="reg-std-row">
														<?php if(!empty($prev_exam_result) && count($prev_exam_result)>0){
														// var_dump($prev_exam_result); die(); 
															$check_multiple = array();
															foreach($prev_exam_result as $k=>$v) {
																$val = $v['student_data_id']."_".$v['coursemodule_id'];
																if(in_array($val, $check_multiple)) {
																	continue;
																} else {
																	$check_multiple[] = $v['student_data_id']."_".$v['coursemodule_id'];
																}
																
														?>

														
															<tr>
																<?php

																$print_output .= "<tr>";

																$student_id = $this->register->get_registration_no_by_student_data_ID( $v['student_data_id']);
																$name = $this->student_data->get_fullname_by_ID($v['student_data_id']);
																$awarding_body = $this->awarding_body->get_name($v['awarding_body_id']);
																 ?>
																<td><?php echo !empty($student_id) ? $student_id : "" ?></td>
																<?php $print_output .= "<td>$student_id</td>"; ?>
																<td><?php echo !empty($name) ? $name : "" ; ?></td>
																<?php $print_output .= "<td>$name</td>"; ?>

																<?php if(empty($terms['semester_id']) && empty($terms['course_id']) && empty($terms['coursemodule_id'])) {?>

																<?php $sm = $this->semister->get_name($v['semester_id']); ?>
																<td><?php echo $sm ?></td>
																<?php $print_output .= "<td>$sm</td>"; ?>

																<?php $cs = $this->course->get_name($v['course_id']); ?>
																<td><?php echo $cs; ?></td>
																<?php $print_output .= "<td>$cs</td>"; ?>

																<?php $cm = $this->coursemodule->get_name_by_id($v['coursemodule_id']); ?>
																<td><?php echo $cm; ?></td>
																<?php $print_output .= "<td>$cm</td>"; ?>


																<?php } ?>

																<?php if(!empty($terms['semester_id']) && empty($terms['course_id']) && empty($terms['coursemodule_id'])) {?>
																	<?php $cs = $this->course->get_name($v['course_id']); ?>
																	<td><?php echo $cs; ?></td>
																	<?php $print_output .= "<td>$cs</td>"; ?>

																	<?php $cm = $this->coursemodule->get_name_by_id($v['coursemodule_id']); ?>
																	<td><?php echo $cm; ?></td>
																	<?php $print_output .= "<td>$cm</td>"; ?>

																<?php } ?>

																<?php if(!empty($terms['course_id']) && empty($terms['coursemodule_id'])) {?>
																	
																	<?php $cm = $this->coursemodule->get_name_by_id($v['coursemodule_id']); ?>
																	<td><?php echo $cm; ?></td>
																	<?php $print_output .= "<td>$cm</td>"; ?>

																<?php } ?>

																<td><?php echo $v['grade']; ?></td>
																<?php $print_output .= "<td>".$v['grade']."</td>"; ?>
																<td><?php echo $v['status']; ?></td>
																<?php $print_output .= "<td>".$v['status']."</td>"; ?>
																<?php $attempt = $this->exam_result_prev->get_total_attempt($v['student_data_id'], $v['course_id'], $v['semester_id'], $v['coursemodule_id']); ?>

					

																<td> 
																<?php if($attempt>1) {?> 
																<a class="moduleAttempt" style="cursor:pointer;" data-toggle="modal" data-target='#prev_exam_result' data-module="<?php echo $v['coursemodule_id']; ?>" data-student="<?php echo $v['student_data_id']?>"> <?php echo $attempt ?> </a> <?php } else { echo $attempt; } ?>
																	</td>



																<?php $print_output .= "<td>$attempt</td>"; ?>
																<td><?php echo ($v['paperID']>0) ? $v['paperID'] : ""; ?></td>
																<?php $print_output .= "<td>".$v['paperID']."</td>"; ?>
																<td><?php echo $v['module_no']; ?></td>
																<?php $print_output .= "<td>".$v['module_no']."</td>"; ?>
																<td><?php echo !empty($awarding_body) ? $awarding_body : ""; ?></td>
																<?php $print_output .= "<td>$awarding_body</td>"; ?>
																<td><?php echo $v['exam_date']; ?></td>
																<?php $print_output .= "<td>".$v['exam_date']."</td>"; ?>
																




															</tr>
															<?php $print_output .= "</tr>"; ?>







															<?php } ?>
														<?php } ?>
													</tbody>
												</table>
												<?php $print_output .= "</tbody></table>"; ?>
												<div class="print-data-div" style="display: none;"><?php echo $print_output; ?></div>
<?php											

												
											
											
										}else{
	
											if($this->input->get('action')>""){
	
?>
						
												<?php if(empty($terms['registration_no'])) {?>
												<table class="table table-bordered">
													<thead>
														<tr>
															<?php if(!empty($terms['semester_id'])) {?>
															<th>Semester</th>
															<?php } ?>
															<?php if(!empty($terms['course_id'])) {?>
															<th>Course</th>
															<?php } ?>
															<?php if(!empty($terms['coursemodule_id'])) {?>
															<th>Module</th>
															<?php } ?>
															
														</tr>
													</thead>
													<tbody>
														<tr>
															<?php if(!empty($terms['semester_id'])) {?>
															<td><?php echo $this->semister->get_name($terms['semester_id']); ?><input type="hidden" name="semester_id" value="<?php echo $terms['semester_id']; ?>"></td>
															<?php } ?>

															<?php if(!empty($terms['course_id'])) {?>
															<td><?php echo $this->course->get_name($terms['course_id']); ?><input type="hidden" name="course_id" value="<?php echo $terms['course_id']; ?>"></td>
															<?php } ?>

															<?php if(!empty($terms['coursemodule_id'])) {?>
															<td><?php echo $this->coursemodule->get_name_by_id($terms['coursemodule_id']); ?><input type="hidden" name="coursemodule_id" value="<?php echo $terms['coursemodule_id']; ?>"></td>
															<?php } ?>

															
														</tr>
													</tbody>
												</table>

												<?php } ?>

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
				
                <div class="modal fade" id="prev_exam_result" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Student Attempt <img class="loading" src=" <?php echo base_url(); ?>/images/loading.gif" style="display:none;"</h4>
                      </div>
                      <div class="modal-body">
                      	
                      </div>
                      
                    </div>
                  </div>
                </div>
				
                <!-- /.modal --> 

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
		
		if(!empty($class_plan_id_edit)){
			
			//var_dump($class_plan_id_edit);
			$class_plan_data = $this->class_plan->get_by_ID($class_plan_id_edit);
			
			$c_s_id = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan_data['course_relation_id']);
			$course_id 			= $c_s_id['course_id'];
			$semister_id 		= $c_s_id['semester_id'];
			$coursemodule_id 	= $class_plan_data['coursemodule_id'];
			
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
	
	
	$('form .course_id,form .semister_id').bind("change",function(){
		
		 
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
	 
	
	$('form .number_of_groups').bind("change",function(){
				 
		var num_grp = parseInt($('form .number_of_groups').val());
			var course_id 		= 	$('form .course_id').val();
			var semister_id 	= 	$('form .semister_id').val();
			var coursemodule_id	=	$('form .coursemodule_id').val();
					
		  url = getURL()+'/index.php/ajaxall/'; $('form .group-loading').show();
		  $.post(url, {action: 'getGroupFormDataForClassPlan', num: num_grp, course_id:course_id, semister_id:semister_id, coursemodule_id:coursemodule_id  },
			function(msg){ 

			    $('form .group_area').hide().html(msg).fadeIn(2000);
			    $('form .group-loading').hide();

			} );
		
		
		
	});
	
	
	
	$('form .course_id, form .semister_id, form .coursemodule_id').bind("change keyup",function(){
	
		if($('form .course_id').val()>"" && $('form .semister_id').val()>"" && $('form .coursemodule_id').val()>""){
			
			var course_id 		= 	$('form .course_id').val();
			var semister_id 	= 	$('form .semister_id').val();
			var coursemodule_id	=	$('form .coursemodule_id').val();
			
			$('form .group-loading').show();
			
			  //alert("semister_id"+semister_id);
			  url = getURL()+'/index.php/ajaxall/';
			  $.post(url, {action: 'getFirstTimeGroupFormDataForClassPlan', course_id: course_id, semister_id: semister_id, coursemodule_id: coursemodule_id  },
			    function(msg){ 

				    $('form .group_area').hide().html(msg).fadeIn(2000);
				    $('form .group-loading').hide();

			    } );			
				
		}

	});







    
});


function addNewGroup(){
	
		if($('form .course_id').val()>"" && $('form .semister_id').val()>"" && $('form .coursemodule_id').val()>"" && $('form .number_of_groups').val()>""){
			
			var course_id 		= 	$('form .course_id').val();
			var semister_id 	= 	$('form .semister_id').val();
			var coursemodule_id	=	$('form .coursemodule_id').val();
			var number_of_groups =  parseInt($('form .number_of_groups'));
			$('form .group-loading').show();
			
			  //alert("semister_id"+semister_id);
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
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/class_plan_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post">
                    
		                <div class="col-lg-12">
			                
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7">
			                			 <h4><i class="fa fa-file-text "></i> Class Plan Form </h4>
			                		</div>
			                		<div class="col-lg-5 col-md-5 col-sm-5">
										<div class="text-right btn-area">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		                        <div class="row"> 
				                        <div class="form-group">
				                        	<input class="form-control course_relation_id" type="hidden" name="course_relation_id">
				                        	
	                        				<div class="col-sm-3">
					                            <label>Select Semester</label>
					                            <select class="form-control semister_id" name="" required>
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
					                            <label>No Of Groups <img src="<?php echo base_url(); ?>images/loading.gif" class="loading group-loading"></label>
					                            <input class="form-control number_of_groups" type="number" name="" required>
				                            </div>
				                            <div class="clearfix"></div>	                            	                            	                            
				                        </div>
				                        
				                        <div class="group_area col-sm-12">

											
										<!-- Get the group lists here -->	
											
				                        
				                        </div> <!--end of .group_area -->
				                        
				                        	                                
                        	                        
	                		    </div>
	                		    
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7"></div>
			                		<div class="col-lg-5 col-md-5 col-sm-5">
			                			<div class="text-right btn-area">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>
			                		</div>
			                		
			                	</div>
			                

		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<!-- <button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
		           			<div class="col-xs-2"></div>
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> -->
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>

            
            
            
                 <!-- Modal -->
                <div class="modal fade" id="myUploadDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Documents</h4>
                      </div>
                      <div class="modal-body">
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
                        <button type="button" name="uploadSignatoryDoc" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button>
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


                
<div class="group-html-data" style="display: none;">


											<div class="panel panel-primary group">
												<div class="panel-heading">
													<h3 class="panel-title">Group</h3>
												</div>
												<div class="panel-body">

	                        							<div class="form-group">
								                            <label>Group Name</label>
								                            <input class="form-control group_name" type="text" name="group_name" required>
							                            </div>
	                        							<div class="form-group">
								                            <label>Class Days</label>
                                                            <div class="clearfix"></div>
                                                            <div class="col-sm-12 no-pad-left">
									                            <div class="col-sm-1 no-pad-left"><div class="checkbox checkbox-primary"><input name="class_days[]" id="checkbox1_1" type="checkbox" class="form-control"><label for="checkbox1_1">Mon</label></div></div>
									                            <div class="col-sm-1 no-pad-left"><div class="checkbox checkbox-primary"><input name="class_days[]" id="checkbox1_2" type="checkbox" class="form-control"><label for="checkbox1_2">Tue</label></div></div>
									                            <div class="col-sm-1 no-pad-left"><div class="checkbox checkbox-primary"><input name="class_days[]" id="checkbox1_3" type="checkbox" class="form-control"><label for="checkbox1_3">Wed</label></div></div>
									                            <div class="col-sm-1 no-pad-left"><div class="checkbox checkbox-primary"><input name="class_days[]" id="checkbox1_4" type="checkbox" class="form-control"><label for="checkbox1_4">Thus</label></div></div>
									                            <div class="col-sm-1 no-pad-left"><div class="checkbox checkbox-primary"><input name="class_days[]" id="checkbox1_5" type="checkbox" class="form-control"><label for="checkbox1_5">Fri</label></div></div>
                                                            </div>
                                                            <div class="clearfix"></div>
							                            </div>
							                            <div class="col-sm-12 no-pad">
	                        								<div class="form-group col-sm-6 no-pad-left">
									                            <label>Select Time Plan</label>
									                            <select class="form-control time_planid" name="time_planid" required>
		                            								<option value="">Please Select</option>
	<?php
																		foreach($time_plan_list as $k=>$v){
																			echo"<option value='".$v['id']."'>".$v['start_time']." to ".$v['end_time']."</option>";
																		}		                            		
		                            									
	?>		                            	
									                            </select>
								                            </div>
	                        								<div class="form-group col-sm-6 no-pad-right">
									                            <label>Select Semester Plan</label>
									                            <select class="form-control semester_planid" name="semester_planid" required>
		                            								<option value="">Please Select</option>
	<?php
																		foreach($semester_plan_list as $k=>$v){
																			echo"<option value='".$v['id']."'>".$v['name']."</option>";
																		}		                            		
		                            									
	?>		                            	
									                            </select>
								                            </div>	
								                         </div> 
							                            <div class="form-group">
							                            
							                            	<div class="col-sm-6 no-pad">
							                            	
							                            		<div class="col-sm-6 no-pad"><label>Start Time: </label></div>
							                            	    <div class="col-sm-6 no-pad"><label>End Time: </label></div>
							                            	
							                            	
							                            	</div>
							                            	
							                            	<div class="col-sm-6 no-pad">
							                            	    <div class="col-sm-6">
							                            			<label>Teaching week: </label><br>
							                            		    <label>Start Date: </label><br>
							                            		    <label>End Date: </label><br>
							                            	    </div>
							                            	    <div class="col-sm-6">
							                            		    <label>Revision week: </label><br>
							                            		    <label>Start Date: </label><br>
							                            		    <label>End Date: </label><br>
							                            	    </div>
							                            	</div>
							                            	<div class="clearfix"></div>							                            	

	
														</div>
								                        <div class="form-group">
								                        	
								                        	<div class="col-sm-4 no-pad-left">
								                        		<label>Submission date:</label>
								                        	    <input class="form-control date" type="text" name="submission_date" required>
								                        	</div>
								                            <div class="col-sm-4 no-pad-left">
								                            	<label>Select Tutor:</label>
									                            <select class="form-control tutor_id" name="tutor_id" required>
		                            								<option value="">Please Select</option>
	<?php
																		foreach($staff_list as $k=>$v){
																			echo"<option value='".$v['id']."'>".$v['staff_name']."</option>";
																		}		                            		
		                            									
	?>		                            	
									                            </select>								                            	
								                            </div>
								                            <div class="col-sm-4 no-pad">
								                            	<label>Select Room:</label>
									                            <select class="form-control room_id" name="room_id" required>
		                            								<option value="">Please Select</option>
	<?php
																		foreach($room_plan_list as $k=>$v){
																			echo"<option value='".$v['id']."'>".$v['name']."</option>";
																		}		                            		
		                            									
	?>		                            	
									                            </select>								                            	
								                            </div>
								                            
								                            <div class="clearfix"></div>
								                        </div> 
								                         
								                         
								                         								                           						                            							                            
												</div>
											</div>

</div>                
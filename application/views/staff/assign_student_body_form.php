<script type="text/javascript">

$(document).ready(function(){
          

		/*$("select.semester_id").change(function(){

			var semester_id = $(this).val();
            //alert(semester_id);
			if($(this).val()!=""){

					url = getURL()+'/index.php/ajaxall/';

					$.post(url, {action: 'getSemesterRelatedCourses', semester_id: semester_id },

				                function(data){ 

				                    if(data!="not_found") {

				                          $("select.course_id").html(data);                 

				                    }

				                } );

		                

			  }else{

					$("select.course_id").html("");  

			  }		
              //alert('hi');
			

		});*/
		
		
		$('.assign-class-save-btn').click(function(){
			 var student_id_list = []; var class_plan_id_list = [];
			//alert('ok');
				$.each($('.reg-student-list').find('.student-data-id'),function(){
				     var student_id = $(this).attr('value');
					 if(this.checked==true){
						student_id_list.push(student_id);	 
					 }
					 	
					
				});
				$.each($('.class-plan-id-list'),function(){
				     var class_plan_id = $(this).attr('value');

						class_plan_id_list.push(class_plan_id);
					 	
					
				});				
				 
				
				if(student_id_list.length>0){
					
					url = getURL()+'/index.php/ajaxall/';
					$.ajax({
					   type: "POST",
					   data: {student_id_list: student_id_list, class_plan_id_list: class_plan_id_list, action: "assignStudentList" },
					   url: url,
					   success: function(msg){
					     $('.message').html(msg);
					     //alert(msg);
					     //window.location = getURL()+'/index.php/assign_student_management/';
					   }
					});				
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
		//alert("yes");
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

<?php




?>
                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/class_plan_management/?action=list"><i class="fa fa-list"></i> Back to Class Plan List</a>
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
			                			 <h4><i class="fa fa-file-text "></i> Assign Students Form </h4>
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
											</tr>
										</thead>
										<tbody>

										<?php
										$i=1;
										foreach($class_plan as $k=>$v){
											$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($v['course_relation_id']);
											//var_dump($c_s_data);
											echo"<tr>";
												echo"<td>".$v['id']."<input type='hidden' name='class_plan_id[]' class='class-plan-id-list' value='".$v['id']."'></td>";
												echo"<td>".$this->semister->get_name($c_s_data['semester_id'])."</td>";
												echo"<td>".$this->course->get_name($c_s_data['course_id'])."</td>";
												echo"<td>".$this->coursemodule->get_name_by_id($v['coursemodule_id'])."</td>";
												echo"<td>".$v['group_name']."</td>";
											echo"</tr>";
											$i++;											
										}											
											
										?>										
										</tbody>
									</table>


		                            <form method="post" class="search_reg_student" role="form" action="<?php echo base_url(); ?>index.php/assign_student_management/?action=search">
									<div class="panel panel-primary">
										
											<div class="panel-heading">
												<div class="col-xs-6 no-pad">
													<div class="panel-title">Search Registered Student</div>
												</div>
												<div class="col-xs-6 text-right">
													<button type="submit" class="btn btn-default btn-sm btn-success">Search</button>
												</div>
												<div class="clearfix"></div>												
											</div>
											<div class="panel-body">

						                            <div class="col-sm-4 no-pad-left">
														<label>Select Semester</label>
														<select class="form-control semester_id" name="semester_id">
														  <option value="">Please Select</option>
			<?php
															foreach($semester_list as $k=>$v){											  	
			?>											  
											  					<option value="<?php echo $v['id']; ?>"><?php echo $v['semister_name']; ?></option>
			<?php
															}
			?>												  
														</select>	                            
						                            </div>
						                            <div class="col-sm-4">
														<label>Select Course</label>
														<select class="form-control course_id" name="course_id">
														  <!-- <option value="">Please Select</option> -->
			<?php
															foreach($course_list as $k=>$v){											  	
			?>											  
											  					<option value="<?php echo $v; ?>"><?php echo $this->course->get_name($v); ?></option>
			<?php
															}
			?>												  
														</select>															                            
						                            </div>
						                            <div class="col-sm-4">
														<label>Student ID</label>
	                            						<input class="form-control registration_no" type="text" name="registration_no">	                            
						                            </div>			                            

						                            <div class="clearfix"></div>											
                                                    
                                                    <div class="col-sm-4 no-pad-left">
                                                        <label>Section</label>
                                                        <input class="form-control section" type="text" name="section">                                
                                                    </div>                                        
                                                    <div class="col-sm-4">
                                                        <label>Select Status</label>
                                                        <select class="form-control status_id" name="status_id">
                                                          <option value="">Please Select</option>
            <?php
                                                            foreach($status_list as $k=>$v){                                                  
            ?>                                              
                                                                  <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
            <?php
                                                            }
            ?>                                                  
                                                        </select>                                                                                        
                                                    </div>
                                                    <div class="clearfix"></div>											
											</div>
											
									</div>
									</form>		                        

			                            	                            	                            	                            	                            	                            	                            	                            	                            
		                        </div><!--<div class="col-sm-12 no-pad">-->
	                            <div class="clearfix"></div>
	                        </div>
	                        
	                        <div class="clearfix reg-student-list">
	                        

            
						        <?php if(!empty($result)){ ?>
            						<?php echo $result; ?>            
						        <?php } ?>

	                        
	                        
	                        </div>
	                        
	                        
	                        <div class="clearfix"></div>
	                		
			                	<div class="clearfix">
			                		<div class="col-lg-7 col-md-7 col-sm-7"></div>
			                		<div class="col-lg-5 col-md-5 col-sm-5">
			                			<div class="text-right">
											<button type="button" class="btn btn-default btn-success assign-class-save-btn">Save</button>
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

            </div>

           
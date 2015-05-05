<script type="text/javascript">

$(document).ready(function(){
          
<?php
									if(!empty($job_induction['assigned_students'])){
										
										$assigned_arr = unserialize($job_induction['assigned_students']);
 
										echo "$.each($('.induction-student-list-table').find('input.induction-student-list-chkbox'),function(){";
										foreach($assigned_arr as $v){
											
											
											echo "if($(this).val()=='".$v."') this.checked=true;";
											
												
										}
										echo "});";	
										
											
									}									
?>
		
	var i=0;
	$.each($('.induction-student-list-table').find('input.induction-student-list-chkbox'),function(){
		 
		 if(this.checked==true) i++;
					 			
	});
	
	if(i>0){
		$(".induction-confirm-btn").show();	
	}else{
		$(".induction-confirm-btn").hide();
	}
		
    $(".induction-student-list-table tbody").find("tr").css("cursor","pointer");
    //if($(".non-reg-student-list a").hasClass("btn-warning")) $(this).hide();
    $.each($(".non-reg-student-list a"),function(){
		if($(this).hasClass("btn-warning")) $(this).hide();	
    });
	$(".induction-student-list-table input.induction-student-list-chkbox").click(function(){
		    //alert("hi");
	        //var id = $(this).val();
            //alert(id);
	        /*if(id>""){

	        	var match_found = 0;
	        	$.each($('.already-assigned-std-area').find('tr'),function(){
					
						var assigned_id = $(this).attr('id');
						if(id==assigned_id) match_found = 1; 
	        	});
	        	if(match_found==0){
	        		$('#myModal .induction-confirm-btn').attr('student_data_id',id);
	        		$('#myModal').modal('show');					
					
	        	}else{
					
	        		$('#warningModal .modal-body').html("This student has already been assigned. Please try another one.");
	        		$('#warningModal').modal('show');					
	        	}	
	

			 }*/
			 	var i=0;
				$.each($('.induction-student-list-table').find('input.induction-student-list-chkbox'),function(){
				     
					 if(this.checked==true) i++;
					 						
				});
				
				if(i>0){
					$(".induction-confirm-btn").show();	
				}else{
					$(".induction-confirm-btn").hide();
				}
			 	

	});
	
	$('.induction-confirm-btn').click(function(){
		$('#myModal').modal('show');	
	});
	
	$('.induction-confirm-btn-go').click(function(){
			
			    var student_id_list = [];
				var induction_id = '<?php echo $job_induction['id']; ?>';
			
				$.each($('.induction-student-list-table').find('input.induction-student-list-chkbox'),function(){
				     
				     var student_id = $(this).attr('value');
					 if(this.checked==true){
						student_id_list.push(student_id);	 
					 }
					 						
				});
				
				if(student_id_list.length>0){
				
					url = getURL()+'/index.php/ajaxall/';
					$.ajax({
					   type: "POST",
					   data: {induction_id: induction_id, student_id_list: student_id_list, action: "addStudentIntoInduction" },
					   url: url,
					   success: function(msg){
					       //alert(msg);
					       $('#myModal .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php echo current_url(); ?>'; });
					       //window.location = '<?php //echo current_url(); ?>';
					     //alert(msg);
					   }
					});				
				}			
		
	});
	
	$('#induction_student_list_select_all').click(function(){
		
		if(this.checked==true){
			$.each($('.induction-student-list-table').find("input.induction-student-list-chkbox"),function(){

				this.checked = true;

			});
		} else {
			$.each($('.induction-student-list-table').find("input.induction-student-list-chkbox"),function(){

				this.checked = false;

			});
		}
		
		
	});



		
		/*$('.assign-class-save-btn').click(function(){
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
			
		});*/		
		
    
});

function recallRemove(){
   
};

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

function initializeRemoveAssignedStudents(){
	
	//alert('hi');
	$('.assign-std-remove-btn').click(function(){
		
		 var student_data_id = $(this).closest("tr").attr("id");
		 var induction_id = '<?php echo $job_induction['id']; ?>'; 

			url = getURL()+'/index.php/ajaxall/';
			$.ajax({
			   type: "POST",
			   data: {induction_id: induction_id, student_data_id:student_data_id, action: "removeStudentFromInduction" },
			   url: url,
			   success: function(msg){
			     
			       window.location = '<?php echo current_url(); ?>';
			     //alert(msg);
			   }
			});
		
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
                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/job_induction/job_induction_management/?action=list"><i class="fa fa-list"></i> Back to Induction List</a>
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
			                			 <h4><i class="fa fa-file-text "></i> Induction Information </h4>
			                		</div>
			                		
			                	</div>
			                

	                        
	                        <div class="row">
		                        <div class="col-sm-12">
		                        
		                        
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Induction Name</th>												
												<th>Induction Date</th>
											</tr>
										</thead>
										<tbody>

											<tr>
												<td><?php echo $job_induction['name']; ?></td>
												<td><?php echo date("d-m-Y",strtotime($job_induction['date'])); ?></td>
											</tr>										
										</tbody>
									</table>

									
<?php
									if(!empty($job_induction['assigned_students'])){
										
										$assigned_arr = unserialize($job_induction['assigned_students']);
										
										
										echo'
										<div class="panel panel-success">
										<div class="panel-heading">
										<h3 class="panel-title panel-colapsible">Already Assigned Students</h3>
										</div>
										<div class="panel-body">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Ref No.</th>
													<th>First Name</th>
													<th>Surname</th>
													<th>Date of Birth</th>
													<th>Semester</th>
													<th>Course</th>
													<th>Status</th>
													<th>Remove</th>
												</tr>
											</thead>
										<tbody class="already-assigned-std-area">										
										';
										$j=1; 
										foreach($assigned_arr as $v){
											$std_data = array();
											$std_data = $this->student_data->get_all_by_ID($v);
											echo"
												<tr id='".$std_data['id']."'>
													<td>$j</td>	
													<td>".$std_data['student_application_reference_no']."</td>
													<td>".ucwords(strtolower($std_data['student_first_name']))."</td>
													<td>".ucwords(strtolower($std_data['student_sur_name']))."</th>
													<td>".$std_data['student_date_of_birth']."</td>";
											if(is_numeric($std_data['student_semister'])){
						                        	$semestername=$this->semister->get_name((int)$std_data['student_semister']);
								                    echo"<td>".$semestername."</td>";    
						                    }else {
						                    		echo"<td>".$std_data['student_semister']."</td>";
						                    }
											if(is_numeric($std_data['student_course'])){
						                        	$coursename=$this->course->get_name((int)$std_data['student_course']);
								                    echo"<td>".$coursename."</td>";    
						                    }else {
						                    		echo"<td>".$std_data['student_course']."</td>";
						                    }						                    
											echo'	<td>'.$std_data['student_admission_status_for_staff'].'</td>
													<td><a href="javascript:void(0);" class="btn btn-sm btn-danger assign-std-remove-btn" id="'.$std_data["id"].'"><i class="fa fa-times"></i></a></td>
												</tr>
											';
											$j++;												
										}
										echo'
											       
										</tbody>
										</table>
										</div>
										</div>
										<script>initializeRemoveAssignedStudents();</script>';											
										
											
									}									
?>								
									

		                            <form method="post" class="search_non_reg_student" role="form" action="<?php echo base_url(); ?>index.php/job_induction/job_induction_assign_student/?action=search&id=<?php echo $job_induction['id']; ?>">
									<div class="panel panel-primary">
										
											<div class="panel-heading">
												<div class="col-xs-6 no-pad">
													<div class="panel-title">Search Non Registered Students</div>
												</div>
												<div class="col-xs-6 text-right">
													<button type="submit" class="btn btn-default btn-sm btn-success">Search</button>
												</div>
												<div class="clearfix"></div>												
											</div>
											<div class="panel-body">

						                            <div class="col-sm-4 no-pad-left">
														<label>Select Semester</label>
														<select class="form-control student_semister" name="student_semister">
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
														<select class="form-control student_course" name="student_course">
														  <option value="">Please Select</option>
			<?php
															foreach($course_list as $k=>$v){											  	
			?>											  
											  					<option value="<?php echo $v['id']; ?>"><?php echo $v['course_name']; ?></option>
			<?php
															}
			?>											  
														</select>															                            
						                            </div>
						                            <div class="col-sm-4">
														<label>Application Reference Number</label>
	                            						<input class="form-control student_application_reference_no" type="text" name="student_application_reference_no">	                            
						                            </div>			                            

						                            <div class="clearfix"></div>											
											
											</div>
											
									</div>
									</form>		                        

			                            	                            	                            	                            	                            	                            	                            	                            	                            
		                        </div><!--<div class="col-sm-12 no-pad">-->
	                            <div class="clearfix"></div>
	                        </div>
	                        
	                        <div class="clearfix non-reg-student-list">
	                        	
	                        	<div class="col-sm-12 no-pad"><a href="javascript:void(0);" type="button" class="btn btn-danger induction-confirm-btn">Add Selected</a></div>

            
						        <?php if(!empty($result)){ ?>
            						<?php echo $result; ?>            
						        <?php } ?>

	                        
	                        
	                        </div>
	                        
	                        
	                        <div class="clearfix"></div>
	                		
			                	<!--<div class="clearfix">
			                		<div class="col-lg-7 col-md-7 col-sm-7"></div>
			                		<div class="col-lg-5 col-md-5 col-sm-5">
			                			<div class="text-right">
											<button type="button" class="btn btn-default btn-success induction-assign-student-save-btn">Save</button>
										</div>
			                		</div>
			                		
			                	</div>-->
			                

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
            
            
            
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Assign confirmation</h4>
                      </div>
                      <div class="modal-body">
                      		<div class="output"></div>
                        Are you sure you want to add this student into induction?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger induction-confirm-btn-go">Yes</a>
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
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                
                
                              
            
            
            
            
            
            
            
            
            
            
            
            

           
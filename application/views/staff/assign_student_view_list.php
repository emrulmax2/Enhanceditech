<script type="text/javascript">

$(document).ready(function(){
          

		
		
		
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
		
     $('.remove-btn').click(function(){
            
        var id = $(this).attr('id'); //alert(id);
        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList(\''+id+'\',\'student_assign_class\')');
        $('#myModal').css({'top':'30%'});
        $('#myModal').modal('hide');
        $('#myModal').modal('toggle');
         //alert('yes');
        
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
											</tr>
										</thead>
										<tbody>

<?php

											$c_s_data  = $this->course_relation->get_course_ID_semester_ID_by_ID($class_plan['course_relation_id']);
											//var_dump($c_s_data);
											echo"<tr>";
												echo"<td>".$class_plan['id']."<input type='hidden' name='class_plan_id[]' class='class-plan-id-list' value='".$class_plan['id']."'></td>";
												echo"<td>".$this->semister->get_name($c_s_data['semester_id'])."</td>";
												echo"<td>".$this->course->get_name($c_s_data['course_id'])."</td>";
												echo"<td>".$this->coursemodule->get_name_by_id($class_plan['coursemodule_id'])."</td>";
												echo"<td>".$class_plan['group_name']."</td>";
											echo"</tr>";
											
											
?>										
										</tbody>
									</table>

									
									
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Registration No</th>												
												<th>Student Name</th>
												<th>Remove</th>
											</tr>
										</thead>
										<tbody>									
<?php
											foreach($student_data_list as $k=>$v){
												
												$reg_data = $this->register->get_by_ID($v['register_id']);
												$student_name = $this->student_data->get_first_sur_name($reg_data['student_data_id']);
												echo"<tr class='gradeA'>";
													echo"<td>".$reg_data['registration_no']."</td>";
													echo"<td>".$student_name."</td>";
													echo"<td><a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id='".$v["id"]."'><i class='fa fa-times'></i></a></td>";
												echo"</tr>";												
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

           
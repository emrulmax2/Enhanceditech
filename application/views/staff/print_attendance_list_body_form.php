
<script type="text/javascript">

$(document).ready(function(){

	$('.date_class_list').change(function(){
		
		//alert($(this).val());

		if($(this).val()>""){
			
			var date = $(this).val();
			
			  url = getURL()+'/index.php/ajaxall/';
			  $.post(url, {action: 'getClassPlanIDByDate', date: date  },
		        function(msg){ 

		            $('.message').html(msg);

		        } );			
				
		}		
		
		
		
	});





});
function recallRemove(){
   
}

$(document).ready(function(){
      
	$('#checkbox99999999999').click(function(){
		
		if(this.checked==true){
			$.each($('.class-list').find('.class-plan-id'),function(){
			
				this.checked=true;	
				
			});
			
		}else{
			$.each($('.class-list').find('.class-plan-id'),function(){
			
				this.checked=false;	
				
			});			
		}
		//alert("yes");
	});
	
	$('tbody.class-list td .class-plan-id').click(function(){
		//alert('yes');
		var i =0;
		var id = [];
		$.each($('.class-list').find('.class-plan-id'),function(){
			
			if(this.checked==true) {
				id.push($(this).val());
				i++;
			} 
		});
		if(i==1){
			$('.vew-feed-attendance').find('.btn-assign-student').remove(); 
			$('.vew-feed-attendance').append("<a class='btn btn-md btn-warning btn-assign-student' href='?action=view_student_list&class_plan_id="+id+"'><i class=\"fa fa-eye\"></i> Feed attendance</a>");
			
		}else{
			$('.vew-feed-attendance').find('.btn-assign-student').remove();
		}
		
	});
	
    
});



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
                		<!--<a class="btn btn-md btn-info" href="<?php //echo base_url(); ?>index.php/print_class_routine_management/?action=search"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post" action="<?php echo base_url(); ?>index.php/attendance_list/?action=search">
                    
		                <div class="col-lg-12">
			                <div class="panel panel-info">
								<div class="panel-heading">
				                	<div class="row">
				                		<div class="col-lg-7 col-md-7 col-sm-7">
				                			 <h4><i class="fa fa-calendar"></i> Class Routine 2</h4>
				                		</div>
				                		<div class="col-lg-5 col-md-5 col-sm-5">
											<div class="text-right btn-area">
					                			<button type="submit" class="btn btn-default btn-success">Search</button>
											</div>

				                		</div>
				                		
				                	</div>
			                	</div>
			                	<div class="panel-body"> 
			                        <div class="row"> 
					                        <div class="form-group">
		                        				<div class="col-sm-3">
						                            <label>Date</label>
						                            <input type="text" class="form-control date date_class_list" name="date_class_list" required >
					                            </div>
		                        				<div class="col-sm-3">
						                            <label>Select Course</label>
						                            <select class="form-control course_id" name="course_id" required>

		                            	
						                            </select>
					                            </div>
					                            
		                        				<div class="col-sm-3">
						                            <label>Select Modules</label>
						                            <select class="form-control coursemodule_id" name="coursemodule_id" required>

		                            	
						                            </select>
					                            </div>
		                        				<div class="col-sm-3">
						                            <label>Select Group</label>
						                            <select class="form-control group_name" name="group_name" required>

		                            	
						                            </select>
					                            </div>
					                            <div class="clearfix"></div>	                            	                            	                            
					                        </div>
					                        
					                        <div class="group_area col-sm-12">
					                        
					                        
					                        
					                        </div><!--<div class="group_area col-sm-12">-->
					                        
					                        	                                
	                        	                        
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
			<div class="row">
				<div class="col-lg-6">
					<div class="text-left">
						<?php echo $print_btn; ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="text-right vew-feed-attendance" style="height:36px;"></div>
				</div>
				
	            
			</div>

            <div class="row"><?php if(!empty($result)) echo $result; ?></div>

            
            
            
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
                

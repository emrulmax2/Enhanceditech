
<script type="text/javascript">

$(document).ready(function(){

 	$(".cost_show").hide();  
	$("#same_day_yes").on("click", function() {
		$(".cost_show").fadeIn();
	});
	$("#same_day_no").on("click", function() {
		$(".cost_show").fadeOut();
	});

	<?php
		if(!empty($jobs) && is_array($jobs)){
			foreach($jobs as $k=>$v){
				
				$$k=tinymce_decode($v);
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if($k=="sign_url"){
					echo "$('input[name=$k]').val('".tinymce_decode($v)."');";
					//echo "$('.imgpreview img').attr('src','".tinymce_decode($v)."');";
				}elseif($k=="same_day") {
					echo "$('input:radio[name=$k][value=$v]').attr('checked',true);";
					
				}elseif($k=="job_department_id") {
					$job_dep = unserialize($v);
					foreach ($job_dep as $key => $value) { ?>
						var i=0;
                        $.each($(".job_dept").find('input:checkbox'),function(){
                            if($(this).val() == "<?php echo $value; ?>") {
                                //this.checked = true;
                                i++;
                                $(this).attr("checked","checked");
                            }
                            
                        });
                       
                       <?php    
					}
				}elseif($k=="job_available") {
					$job_available = unserialize($v);
					foreach ($job_available as $key => $value) { ?>
						var i=0;
                        $.each($(".job_available").find('input:checkbox'),function(){
                            if($(this).val() == "<?php echo $value; ?>") {
                                //this.checked = true;
                                i++;
                                $(this).attr("checked","checked");
                            }
                            
                        });
                       
                       <?php    
					}
				}elseif($k=="job_type") {
					echo "$('select[name=$k]').val('$v');";					
				}else
				echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
			}

			
		}    	
	?>
	var same_day_serv = $("#same_day_yes").attr('checked');
	
	if(same_day_serv=="checked") {
		$(".cost_show").show();
	}
	


 
});

function recallRemove(){
   
}


</script>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
    if( ( !empty($priv[1]) || $this->session->userdata('label')=="admin" ) ){	                	
?>	                
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>index.php/job_induction/assign_new_job_management/?action=add"><i class="fa fa-plus"></i> Assign New Job</a>
<?php
    }	                	
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/job_induction/assign_new_job_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post">
                    
		                <div class="col-lg-12">
			                
			                	<div class="row">
			                		<div class="col-lg-9 col-md-9 col-sm-9">
			                			 <h4><i class="fa fa-file-text "></i> Assign New Job Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		               
                                
	                        <div class="form-group">
	                            <label><b>Select Job</b></label>
	                            <select name="jobs_id" class="form-control jobs_id" required>
	                            	<option value="">Please Select</option>
<?php                                       $i=0;
											if(!empty($job_list) && count($job_list)>0){
												foreach($job_list as $k=>$v){
													echo"<option value='".$v['id']."'>".$v['name']."</option>";
													//echo'<div class="checkbox checkbox-primary notify-department"><input id="checkbox'.$i.'" type="checkbox" class="form-control" name="jobs_list[]" value="'.$v['id'].'"><label for="checkbox'.$i.'">'.$v['name'].'</label></div>';
													$i++;
												}
											}		                            		
		                            		
?>	                            
	                            </select>
	                        </div>
	                        <div class="form-group">
	                            <label><b>Issued Date</b></label>
	                            <input class="form-control date issued_date" type="text" name="issued_date" required>
	                        </div>
	                        <div class="form-group">
	                            <label><b>Due Date</b></label>
	                            <input class="form-control date due_date" type="text" name="due_date" required>
	                        </div>	                        	                                                                                
	                        <div class="form-group">
	                            <label><b>Remarks</b></label>
	                            <!--<input class="form-control remarks" type="text" name="remarks" maxlength="50">-->
	                            <textarea name="remarks" class="form-control remarks"></textarea>
	                        </div>
	                        <div class="form-group">
	                            <label><b>Select Assign From Department</b></label>
	                            <select name="assigned_by_department_id" class="form-control assigned_by_department_id" required>
	                            	<option value="">Please Select</option>
<?php                                       
											if(!empty($job_departments) && count($job_departments)>0){
												foreach($job_departments as $k=>$v){
													echo"<option value='".$v['id']."'>".$v['name']."</option>";
												}
											}		                            		
		                            		
?>	                            	                            
	                            </select>

	                        </div>	                        


	                		
			                	<div class="row">
			                		<div class="col-lg-9 col-md-9 col-sm-9"></div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
			                			<div class="text-right">
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
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button>-->			                
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

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
	?>    
    
});

function recallRemove(){
   
}
</script>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){                	
?>	                
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>index.php/semester_plan_management/?action=add"><i class="fa fa-plus"></i> Add New Semester Plan</a>
<?php
}	                	
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/semester_plan_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
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
			                			 <h4><i class="fa fa-file-text "></i> Semester Plan Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		               
                                
	                        <div class="form-group">
	                            <label>Semester Plan name</label>
	                            <input class="form-control" type="text" name="name" required>
	                        </div>
	                        <div class="form-group">
	                            <label>Select Semester</label>
		                            <select class="form-control" name="semester_id" required>
		                            	<option value="">Please Select</option>
<?php
											foreach($semester_list as $k=>$v){
												echo"<option value='".$v['id']."'>".$v['semister_name']."</option>";
											}		                            		
		                            		
?>		                            	
		                            </select>
	                        </div>
	                        <div class="form-group">
	                            <label>Start Date</label>
	                            <input class="form-control date" type="text" name="start_date" required>
	                        </div>	                        
	                        <div class="form-group">
	                            <label>End Date</label>
	                            <input class="form-control date" type="text" name="end_date" required>
	                        </div>	                        
	                        <div class="form-group">
	                            <label>Teaching Start Date</label>
	                            <input class="form-control date" type="text" name="teaching_start" required>
	                        </div>		                        
	                        <div class="form-group">
	                            <label>Teaching End Date</label>
	                            <input class="form-control date" type="text" name="teaching_end" required>
	                        </div>
	                        <div class="form-group">
	                            <label>Revision Start Date</label>
	                            <input class="form-control date" type="text" name="revision_start" required>
	                        </div>
	                        <div class="form-group">
	                            <label>Revision End Date</label>
	                            <input class="form-control date" type="text" name="revision_end" required>
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
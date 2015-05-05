
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		$disable_notify = 0;
		if(!empty($job_induction_process) && is_array($job_induction_process)){
			foreach($job_induction_process as $k=>$v){
				
				$$k=tinymce_decode($v);
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if($k=="job_induction_id"){
					echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
				}else if($k=="jobs_list"){
					$jobs_list = unserialize($v);
					foreach($jobs_list as $job) echo"$('input:checkbox[value=".$job."]').attr('checked',true);"; 
					//echo "$('select[name=$k]').val('".tinymce_decode($v)."');";					
				}else if($k=="students_notified"){
					if($v=="yes") $disable_notify = 1;
				}	
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
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>index.php/job_induction/job_induction_processing_management/?action=add"><i class="fa fa-plus"></i> Add New Job Induction Process</a>
<?php
}	                	
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/job_induction/job_induction_processing_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
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
			                			 <h4><i class="fa fa-file-text "></i> Job Induction Process Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		               
                                
	
	                        	<div class="form-group">
					                <label>Select Induction</label>
					                <select class="form-control job_induction_id" name="job_induction_id" required>
		                            	<option value="">Please Select</option>
<?php
											foreach($job_induction_list as $k=>$v){
												echo"<option value='".$v['id']."'>".$v['name']." | Date: ".date("d-m-Y",strtotime($v['date']))."</option>";
											}		                            		
		                            		
?>		                            	
					                </select>
				                </div>	
	                        	<div class="form-group">
					                <label>Select Job</label>

<?php                                       $i=0;
											foreach($job_list as $k=>$v){
												//echo"<option value='".$v['id']."'>".$v['name']."</option>";
												echo'<div class="checkbox checkbox-primary notify-department"><input id="checkbox'.$i.'" type="checkbox" class="form-control" name="jobs_list[]" value="'.$v['id'].'"><label for="checkbox'.$i.'">'.$v['name'].'</label></div>';
												$i++;
											}		                            		
		                            		
?>	
				                </div>
				                
	                        	<div class="form-group">
					                <label>Notify Students Regarding Induction ?</label>

<?php                                       $i++;
                                            
                                            if($disable_notify==1)	echo'<div class="checkbox checkbox-primary notify-students"><input id="checkbox'.$i.'" type="checkbox" class="form-control" name="students_notified" value="yes" checked="checked" disabled="disabled"><label for="checkbox'.$i.'">yes</label></div>';
                                            else	echo'<div class="checkbox checkbox-primary notify-students"><input id="checkbox'.$i.'" type="checkbox" class="form-control" name="students_notified" value="yes"><label for="checkbox'.$i.'">yes</label></div>';
												
		                            		
		                            		
?>	
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

            
           
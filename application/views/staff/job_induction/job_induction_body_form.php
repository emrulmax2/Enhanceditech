
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if(!empty($job_induction) && is_array($job_induction)){
			foreach($job_induction as $k=>$v){
				
				$$k=tinymce_decode($v);
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if(($k=="notify_job_department") && (!empty($v)) ){
					$dept_list = unserialize($v);
					foreach($dept_list as $dept) echo"$('input:checkbox[value=".$dept."]').attr('checked',true);"; 
					//echo "$('select[name=$k]').val('".tinymce_decode($v)."');";					
				}else if($k=="date"){
					echo "$('input[name=$k]').val('".date("d-m-Y",strtotime($v))."');";
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
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>index.php/job_induction/job_induction_management/?action=add"><i class="fa fa-plus"></i> Add New Job Induction</a>
<?php
}	                	
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/job_induction/job_induction_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
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
			                			 <h4><i class="fa fa-file-text "></i> Job Induction Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		               
                                
	                        	<div class="form-group">
		                            <label>Induction Name</label>
		                            <input class="form-control" type="text" name="name" required>
		                        </div>
	                        	<div class="form-group">
		                            <label>Induction Date</label>
		                            <input class="form-control date" type="text" name="date" required>
		                        </div>	
	                        	<!-- <div class="form-group">
					                <label>Select Semester</label>
					                <select class="form-control semister_id" name="" required>
		                            	<option value="">Please Select</option>
<?php
											foreach($semister_list as $k=>$v){
												echo"<option value='".$v['id']."'>".$v['semister_name']."</option>";
											}		                            		
		                            		
?>		                            	
					                </select>
				                </div> -->	
	                        	<!-- <div class="form-group">
					                <label>Select Course</label>
					                <select class="form-control course_id" name="" required>
		                            	<option value="">Please Select</option>
<?php
											foreach($course_list as $k=>$v){
												echo"<option value='".$v['id']."'>".$v['course_name']."</option>";
											}		                            		
		                            		
?>		                            	
					                </select>
				                </div> -->
	                        	<div class="form-group">
		                            <label>Total Seat (Number Only)</label>
		                            <input class="form-control total_seat" type="number" name="total_seat" required>
		                        </div>
	                        	<div class="form-group">
		                            <label>Organizer</label>
		                            <input class="form-control organizer" type="text" name="organizer">
		                        </div>
	                        	<div class="form-group">
					                <label>Notify Department</label>

<?php                                       $i=0;
											foreach($job_department_list as $k=>$v){
												//echo"<option value='".$v['id']."'>".$v['name']."</option>";
												echo'<div class="checkbox checkbox-primary notify-department"><input id="checkbox'.$i.'" type="checkbox" class="form-control" name="dept_list[]" value="'.$v['id'].'"><label for="checkbox'.$i.'">'.$v['name'].'</label></div>';
												$i++;
											}		                            		
		                            		
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

            
           
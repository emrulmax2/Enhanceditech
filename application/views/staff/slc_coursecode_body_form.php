
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if($slc_coursecode && is_array($slc_coursecode)){
			foreach($slc_coursecode as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if($k=="course_relation_id"){
					$c_s_id = $this->course_relation->get_course_ID_semester_ID_by_ID($v);
				 	echo "$('select[name=course_id]').val('".tinymce_decode($c_s_id['course_id'])."');";	
				 	echo "$('select[name=semester_id]').val('".tinymce_decode($c_s_id['semester_id'])."');";	
				}else echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
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
//if(!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin"){	                	
?>	                
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>/index.php/slc_coursecode_management/?action=add"><i class="fa fa-plus"></i> Add SLC Course Code</a>
<?php
//}	                	
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>/index.php/slc_coursecode_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
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
			                			 <h4><i class="fa fa-file-text "></i> Slc Course Code Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		               
                                
	                        <div class="form-group">
	                            <label>Course</label>
	                            <select name="course_id" class="form-control" required>
	                            	<option value="">Please Select</option>
<?php
										foreach($course_list as $c){
											
											echo'<option value="'.$c['id'].'">'.$c['course_name'].'</option>';
											
										}	                            		
?>	                            	
	                            </select>
	                        </div>
	                        <div class="form-group">
	                            <label>Semester</label>
	                            <select name="semester_id" class="form-control" required>
	                            	<option value="">Please Select</option>
<?php
										foreach($semester_list as $c){
											
											echo'<option value="'.$c['id'].'">'.$c['semister_name'].'</option>';
											
										}	                            		
?>	                            	
	                            </select>
	                        </div>
	                        <div class="form-group">
	                            <label>Slc Code</label>
	                            <input class="form-control" type="text" name="slc_code" required>
	                        </div>
	                        <div class="form-group">
	                            <label>Year</label>
	                            <input class="form-control" type="text" name="year" required>
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


<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		/*if(!empty($course_module) && is_array($course_module)){
			foreach($course_module as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				echo "$('select[name=$k]').val('".tinymce_decode($v)."');";	
			}
		}*/  
		if(!empty($course_module) && count($course_module)>0){
			echo "$('select[name=course_id]').val('".tinymce_decode($course_module['course_id'])."');"; 
			
			if(is_array($course_module['module']) && count($course_module['module'])>0){
					
					foreach($course_module['module'] as $k=>$v){
						//echo"alert('$k = $v');";
						echo "$('input:checkbox[value=".$v."]').attr('checked',true);";
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
                		<!-- <a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>/index.php/course_module_relation_management/?action=add"><i class="fa fa-plus"></i> Add Course Module Relation</a> -->
<?php
}	                	
?>                		
                		<!-- <a class="btn btn-md btn-info" href="<?php echo base_url(); ?>/index.php/course_module_relation_management/?action=list"><i class="fa fa-list"></i> Back to List</a> -->
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12">
						<?php if(!empty($message)) {?>
	                	<?php echo $message; ?>
	                	<?php } ?>

	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post">
                    
		                <div class="col-lg-12">
		                
		                	<a class=""  href="<?php echo base_url(); ?>index.php/course_module_relation_management/?action=list"><i class="fa fa-arrow-circle-left"></i> Back to List</a>
		                	<div class="row">
		                		<div class="col-lg-9 col-md-9 col-sm-9">
		                			 <h4><i class="fa fa-file-text "></i> Course Module Relation Form </h4>
		                		</div>
		                		<div class="col-lg-3 col-md-3 col-sm-3">
									<div class="text-right">
			                			<button type="submit" class="btn btn-default btn-success">Next</button>
			                			<!-- <button type="reset" class="btn btn-default btn-danger">Cancel</button> -->
									</div>

		                		</div>
		                		
		                	</div>
		                	<div class="clearfix"></div>
		                	<p class="divider"></p>
		                </div>

		                <div class="col-lg-4">
                                
		                        <div class="form-group">
		                            <div class="panel panel-primary">
					                    <div class="panel-heading"><i class="fa fa-sitemap"></i> Select Course </div>
					                    <div class="panel-body">
		                           
			                            <?php
			                            if(!empty($course_list)) {
				                            foreach ($course_list as $k => $v) {
				                            	echo "<div class='radio radio-info'>";
				                             	echo "<input id='sl_level_".$v['id']."' type='radio' value='".$v['id']."' name='course_id' />" ;
				                             	echo "<label for='sl_level_".$v['id']."'>".$v['course_name']."</label> <br />";
				                             	echo "</div>";
				                             }
			                             } 

			                             ?>
			                             </div> 
		                             </div>
		                        </div>
		                </div>

		                <div class="col-lg-8">
		                	<div class="panel panel-info">
				                <div class="panel-heading"><i class="fa fa-sitemap"></i> Number of Level </div>
				                    <div class="panel-body">

									<div class="form-group" id="lvl_num">
										
										<input required class="form-control level_count" type="number" name="level_number" />
									</div>
									<div class="level_show">
										<!-- This div to show level field from jquery -->
									</div>
								</div>
							</div>

		                </div>
		               <div class="clearfix"></div>

						
						
						<div class="col-lg-12 col-md-12 col-sm-12">
							<p class="divider"></p>
							<div class="text-right">
								<button type="submit" class="btn btn-default btn-success">Next</button>
								<!-- <button type="reset" class="btn btn-default btn-danger">Cancel</button> -->
							</div>
						</div>
							
		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<!-- <button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button> -->
		           			<!-- <div class="col-xs-2"></div> -->
			                <!-- <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> -->
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               
               
               

            </div>
               </form>
<script>
	$(document).ready(function() {
		var events = ['click', 'keyup'];
		$.each(events, function(index, val) {
			$('.level_count').on(val, function() {
				var total_level = [],
					level = parseInt( $(this).val() );

				for (var i = level; i >= 1; i--) {
					
					total_level.push(
						"<div class='row'><div class='col-lg-6'><div class='form-group'><label>Level Name</label><input class='form-control' required type='text' name='level_"+i+"_name' /></div></div><div class='col-lg-6'><div class='form-group'><label>Number of Module</label><input class='form-control' type='number' required name='level_"+i+"_module' /></div></div></div>"
					);

				};
				
				$('.level_show').html(total_level);
				
			})
		});
	});
</script>
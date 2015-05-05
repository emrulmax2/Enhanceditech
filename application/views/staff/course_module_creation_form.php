
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

	<?php 
	if(isset($l)) {
		echo "$('#level_id_".$l."').attr('checked',true);";
		echo " var l_select = $('#level_id_".$l."').val();";
		?>
     		var level_module = $(".col-lg-6.level_module_"+l_select);
 			level_module.removeClass('deactive');
 			level_module.find('input.m_name').attr('required', 'required');
        
		<?php
	}

	 ?>   
    
});

function recallRemove(){
   
}



</script>
<style>
	.deactive {
		display: none;
	}
</style>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
//if(!empty($staff_privileges_course_management['course_mng_add']) || $this->session->userdata('label')=="admin"){	                	
?>	                
                		<!-- <a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>/index.php/course_module_relation_management/?action=add"><i class="fa fa-plus"></i> Add Course Module Relation</a> -->
<?php
//}	                	
?>                		
                		<!-- <a class="btn btn-md btn-info" href="<?php echo base_url(); ?>/index.php/course_module_relation_management/?action=list"><i class="fa fa-list"></i> Back to List</a> -->
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
		                
		                
		                	<a class=""  href="<?php echo base_url(); ?>index.php/course_module_relation_management/?action=list"><i class="fa fa-arrow-circle-left"></i> Back to List</a>
		                	<div class="row">

		                		<div class="col-lg-9 col-md-9 col-sm-9">
		                			 <h4><i class="fa fa-file-text "></i> Course Name : <?php echo $course ?></h4>
		                		</div>
		                		<div class="col-lg-3 col-md-3 col-sm-3">
									<div class="text-right">
			                			<button type="submit" class="btn btn-default btn-success">Save</button>
			                			<button type="reset" class="btn btn-default btn-danger">Reset</button>
									</div>

		                		</div>
		                		
		                	</div>
		                	<div class="clearfix"></div>
		                	<p class="divider"></p>
		                </div>

		                <div class="col-lg-3">
                                
		                        <div class="form-group">
		                        	<div class="panel panel-primary">
					                    <div class="panel-heading"><i class="fa fa-sitemap"></i> Select Level </div>
					                    <div class="panel-body">
				                           
				                            <?php
				                            $j = 1;
				                            foreach ($level_list as $k => $v) {
				                            	echo "<div class='radio radio-info'>";
				                             	echo "<input type='radio' id='level_id_".$j."' value='".$v['id']."' name='level_id' />" ;
				                             	echo "<label for='level_id_".$j."'>".$v['name']."</label> <br />";
				                             	echo "</div>";
				                             ?>
					                            <script>
					                             jQuery(document).ready(function($) {
						                             $('#level_id_<?=$j?>').on('click', function() {
						                             	
					                             			$('#show_from_ajax').find('.col-lg-6').addClass('deactive');
					                             			$('#show_from_ajax').find('.col-lg-6 input.m_name').removeAttr('required');
						                             		var m_id = $(this).val();
						                             		var level_module = $(".col-lg-6.level_module_"+m_id);
					                             			level_module.removeClass('deactive');
					                             			level_module.find('input.m_name').attr('required', 'required');
					                             			
						                             });
												});
					                             </script>
					                             	
					                             	
				                             <?php
				                             $j++;
				                             } 
				                             ?>
				                        </div>
				                    </div>
				                </div>
		                </div>

		                <div class="col-lg-9">

							<div class="row">
								<div  id="show_from_ajax">
								<?php foreach($level_list as $k => $v) {?>
									<?php for ($i=0; $i < $v['noofmodule']; $i++) { ?>

										
										<div class="col-lg-6 level_module_<?=$v['id']?> deactive">

											<div class="panel panel-info">
												<div class="panel-heading"> <h3 class="panel-title"><?php echo $v['name']; ?> Module</h3> </div>
												<div class="panel-body">
												
							                        <div class="form-group">
							                            <label>Module Name</label>
							                            <input class="form-control m_name" type="text" name="module_<?=$i."_".$v['id']?>" value="">
							                            
							                        </div>	
							                        
							                        <div class="form-group m_type">
							                            <label>Module Code</label> <br />
														<input class="form-control" type="text" name="module_code_<?=$i."_".$v['id']?>" value="">
														
							                        </div>
							                        
							                        								
												</div>
											</div>
											
										</div>
										
										
									<?php } ?>

								<?php } ?>
								</div>
							</div>


		                </div>
		                <div class="clearfix"></div>

						
							
							<div class="col-lg-12 col-md-12 col-sm-12">
							<p class="divider"></p>
								<div class="text-right">
									<button type="submit" class="btn btn-default btn-success">Save</button>
									<button type="reset" class="btn btn-default btn-danger">Reset</button>
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
		$('.level_count').on('keyup', function() {
			var total_level = [],
				level = parseInt( $(this).val() );

			for (var i = level; i >= 1; i--) {
				
				total_level.push(
					"<div class='row'><div class='col-lg-6'><div class='form-group'><label>Level Name</label><input class='form-control' type='text' name='level_"+i+"_name' /></div></div><div class='col-lg-6'><div class='form-group'><label>Number of Module</label><input class='form-control' type='text' name='level_"+i+"_module' /></div></div></div>"
				);

			};
			
			$('.level_show').html(total_level);
			
		});

		$('div.m_type .checkbox').find('input').on('click', function() {
			$(this).parent('.checkbox').find('select').removeAttr('disabled');
		});


	});
</script>
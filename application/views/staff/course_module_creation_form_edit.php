
<script type="text/javascript">

$(document).ready(function(){

	
	    $('.remove-btn').click(function(e){
	         e.preventDefault();   
	        var id = $(this).attr('id'); //alert(id);
	        $('#myModal').find('.confirm-btn').attr('onclick','RemoveModule(\''+id+'\',\'coursemodule\')');
	        $('#myModal').css({'top':'30%'});
	        $('#myModal').modal('hide');
	        $('#myModal').modal('toggle');
	    });

	    $('.level_remove').click(function(e){
	         e.preventDefault();   
	        var id = $(this).attr('id'); //alert(id);
	        $('#myModal').find('.confirm-btn').attr('onclick','RemoveModule(\''+id+'\',\'course_level\')');
	        $('#myModal').css({'top':'30%'});
	        $('#myModal').modal('hide');
	        $('#myModal').modal('toggle');
	    });   
	
      
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




</script>
<style>
	.deactive {
		display: none;
	}
	.rmv_level_pos {
		display: inline;
	}
	.panel-danger {
		min-height: 221px !important;
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
	                	<?php 
	                	if($this->session->flashdata('message')) {
	                		echo $this->session->flashdata('message');
	                	}

	                	 ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post">
                    
		                <div class="col-lg-12">
		                
		                
		                	<a href="<?php echo base_url(); ?>index.php/course_module_relation_management/?action=list"><i class="fa fa-arrow-circle-left"></i> Back to List</a>
		                	


							


		                	
		                	<div class="row">

		                		<div class="col-lg-6 col-md-6 col-sm-6">
		                			 <h4><i class="fa fa-file-text "></i> Course Name : <?php echo $course ?></h4>
		                		</div>
		                		<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="text-right">
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_new_level">
										 <i class="fa fa-plus"></i> Add new Level
										</button>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal12">
										 <i class="fa fa-plus"></i> Add new Module
										</button>
			                			<button type="submit" class="btn btn-default btn-success">Save</button>
			                			<button type="reset" class="btn btn-default btn-danger">Reset</button>
									</div>

		                		</div>
		                		
		                	</div>
		                <div class="clearfix"></div>
						<p class="divider"></p>
		                </div>

		                <div class="col-lg-4">
                                
		                        <div class="form-group">
		                         	<div class="panel panel-primary">
					                    <div class="panel-heading"><i class="fa fa-sitemap"></i> Select Level </div>
					                    <div class="panel-body">

				                            
				                           
				                            <?php
				                            $j = 1;
				                            foreach ($level_module as $k => $v) {
				                            	echo "<div class='radio radio-info'>";
				                             	echo "<input type='radio' id='level_id_".$j."' value='".$v[0]['id']."' name='level_id' />" ;
				                             	echo "<label for='level_id_".$j."'>".$v[0]['name']."</label>";
				                             	echo "<a class='lvl_edit' href='".base_url()."index.php/course_module_relation_management/?action=level_edit&level_id=".$v[0]['id']."&l=".$j."'>Edit</a>";
				                             	echo "<a class='lvl_edit level_remove' id='".$v[0]['id']."' href=''>Delete</a>";
				                             	echo "</div>";
				                             ?>
					                             <script>
					                             jQuery(document).ready(function($) {
						                             $('#level_id_<?=$j?>').on('click', function() {
						                             	$('div.rmv_level_pos').html("");
						                             	$( "<div class='rmv_level_pos'><input type='hidden' name='level_pos' value='<?=$j?>' /></div>" ).insertAfter( $(this).next() );
						                             	
				                             			$('#show_from_ajax').find('.col-lg-6').addClass('deactive');
				                             			$('#show_from_ajax').find('.col-lg-6').find('input.m_name').removeAttr('required');
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
		                <!-- </div> -->

		                <div class="col-lg-8">
		                

							<div class="row">
									<div  id="show_from_ajax">
										
									

								<?php foreach($level_module as $k => $v) {?>
									<?php for ($i=0; $i < $v[0]['noofmodule']; $i++) { ?>
										
										<?php //foreach($modules as $m=>$d) { ?>
										
										<div class="col-lg-6 level_module_<?=$v[0]['id']?> deactive">

											<div class="panel <?php if(empty($v[1][$i]['modulename'])) { echo "panel-danger";} else { echo "panel-info"; } ?> ">

												<div style="overflow: hidden;" class="panel-heading"> 
													<h3 style="float:left; width:95%;" class="panel-title"><?php echo $v[0]['name']; ?> Module </h3>
													<?php if(!empty($v[1][$i]['modulename'])) { ?>
														<a class="remove-btn" style="float:left; width:5%;" href='' id='<?php echo $v[1][$i]['id']; ?>'><i class='fa fa-times'></i></a>

													<?php } ?>

												</div>

												<div class="panel-body">
												
							                        <div class="form-group">
							                            <label>Module Name</label>
							                            <input class="form-control m_name" type="text" name="module_<?php echo $i."_".$v[0]['id']?>" value="<?php if(!empty($v[1][$i]['modulename'])) echo $v[1][$i]['modulename'] ?>">
							                            <input type="hidden" name="module_id_<?=$i."_".$v[0]['id']?>" value="<?php if(!empty($v[1][$i]['id'])) echo $v[1][$i]['id']; ?>">
							                            
							                        </div>	
							                        
							                        <div class="form-group m_type">
							                            <label>Module Code</label> <br />
														<input class="form-control" type="text" name="module_code_<?php echo $i."_".$v[0]['id']?>" value="<?php if(!empty($v[1][$i]['module_code'])) echo $v[1][$i]['module_code'] ?>">
														
														    

							                        </div>
							                        
							                        								
												</div>
											</div>
											
										</div>
										
										<?php //} ?>
										
									<?php } ?>

								<?php } ?>
								</div>
							</div>


						
		                </div>
		                <div class="clearfix"></div>
						
							
							<div class="col-lg-12 col-md-12 col-sm-12">
							<p class="divider"></p>
								<div class="text-right">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_new_level">
										 <i class="fa fa-plus"></i> Add new Level
										</button>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal12">
										 <i class="fa fa-plus"></i> Add new Module
										</button>
									<button type="submit" class="btn btn-default btn-success" name="update_module">Save</button>
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


<!-- Modal -->
<div class="modal fade" id="myModal12" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">New Module <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
      		<div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-sitemap"></i> Select Level </div>
                    <div class="panel-body">

                  <?php
                        $j = 100;
                        foreach ($level_module as $k => $v) {
                            echo "<div class='radio radio-info'>";
                            echo "<input type='radio' id='level_id_".$j."' value='".$v[0]['id']."' name='level_idnew' />" ;
                            echo "<label for='level_id_".$j."'>".$v[0]['name']."</label> <br />";
                            echo "<input type='hidden' name='noofmodule' value='".$v[0]['noofmodule']."'  />";
                            
                            echo "</div>";
                 
                        $j++;
                        } 
                 ?>
                    </div>
                </div>

      		</div>
      		<div class="col-lg-8">
	        	<div class="panel panel-warning">
					<div class="panel-heading"> <h3 class="panel-title">Create Module</h3> </div>
					<div class="panel-body">
					
	                    <div class="form-group">
	                        <label>Module Name</label>
	                        <input class="form-control" type="text" name="new_module_name" value="">
	                        <input type="hidden" name="new_module_course" value="<?php echo $this->input->get('course_id') ?>">
	                        
	                    </div>	
	                    
	                    <div class="form-group">
	                        <label>Module Code</label> <br />
							<input class="form-control" type="text" name="new_module_code" value="">
							
	                    </div>
	                    
	                    								
					</div>
				</div>
			</div>
      </div>

      <div class="modal-footer">
            <button type="button" name="cr_new_module" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-check"></i> Save changes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add_new_level" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">New Level <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></h4>
      </div>
      <div class="modal-body" style="overflow: hidden;">
      <div class="msg"></div>
      		
      		<div class="col-lg-12">
	        	<div class="panel panel-warning">
					<div class="panel-heading"> <h3 class="panel-title">Create Level</h3> </div>
					<div class="panel-body">
					
	                    <div class="form-group">
	                        <label>Level Name</label>
	                        <input class="form-control" type="text" name="new_level_name" value="">
	                    </div>
	                    <div class="form-group">
	                        <label>No of Module</label>
	                        <input class="form-control" type="number" name="new_level_noofmodule" value="">
	                    </div>	
	                    
	                   
	                    
	                    								
					</div>
				</div>
			</div>
      </div>

      <div class="modal-footer">
            <button type="button" name="new_level" class="btn btn-success" id="new_level" ><i class="fa fa-check"></i> Save changes</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
      </div>
    </div>
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
        <a href="" class="btn btn-danger confirm-btn">Yes</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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

		// if($(".col-lg-6").hasClass('deactive') == true) {
		// 	$(this).hide();
		// }

	});
</script>

<script type="text/javascript">

$(document).ready(function(){

	<?php
		if(!empty($course) && is_array($course)){
			foreach($course as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if($k=="course_name" || $k=="semister" || $k=="course_status" || $k=="course_code" ) 
				{
					echo "$('input[name=$k]').val('".tinymce_decode($v)."');";
				} 
				elseif($k=="hesa_courseaim_id" || $k=="hesa_ttcid" || $k=="hesa_regbody_id") 
				{
					echo "$('select[name=$k]').val('".tinymce_decode($v)."').attr('selected', 'selected');";
				}
				elseif($k=="contribution_subject" && !empty($v))
				{ 
					$contribution_subject = unserialize($v);
					foreach ($contribution_subject as $key => $value) {
						echo "$('input.contribution_subject_".$key."').val('".tinymce_decode($value)."');";
					}
				}
				elseif($k=="contribution_percent" && !empty($v))
				{ 
					$contribution_percent = unserialize($v);
					foreach ($contribution_percent as $key => $value) {
						echo "$('input.contribution_percent_".$key."').val('".tinymce_decode($value)."');";
					}
				}


			}
		} 

		if(!empty($hesa_subject_of_course)) {

			foreach ($hesa_subject_of_course as $k => $v) {
				if($k=="subject_course_1" || $k=="subject_course_2" || $k=="subject_course_3" || $k=="subject_course_4" ) 
				{
					if(!empty($v)) {
						echo "$('select[name=$k]').val('".$v."').attr('selected', 'selected');";
					}
				} 
			}


		}   	
	?>

	// $(".contribution_subject_0").change(function() {
	// 	if ($(this).val() != "") {
	// 		$(".contribution_percent_0").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_0").attr('required', false);
	// 	}
	// });
	// $(".contribution_subject_1").change(function() {
	// 	if ($(this).val() != "") {
	// 		$(".contribution_percent_1").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_1").attr('required', false);
	// 	}
	// });
	// $(".contribution_subject_2").change(function() {
	// 	if ($(this).val() != "") {
	// 		$(".contribution_percent_2").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_2").attr('required', false);
	// 	}
	// });
	// $(".contribution_subject_3").change(function() {
	// 	if ($(this).val() != "") {
	// 		$(".contribution_percent_3").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_3").attr('required', false);
	// 	}
	// });

      

	// $.each($(".contribution_subject_0"), function() {		
	// 	 if ($(this).val() != "") {
	// 		$(".contribution_percent_0").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_0").attr('required', false);
	// 	}
	// });

	// $.each($(".contribution_subject_1"), function() {
	// 	 if ($(this).val() != "") {
	// 		$(".contribution_percent_1").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_1").attr('required', false);
	// 	}
	// });

	// $.each($(".contribution_subject_2"), function() {
	// 	 if ($(this).val() != "") {
	// 		$(".contribution_percent_2").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_2").attr('required', false);
	// 	}
	// });

	// $.each($(".contribution_subject_3"), function() {
	// 	 if ($(this).val() != "") {
	// 		$(".contribution_percent_3").attr('required', true);
	// 	}else {
	// 		$(".contribution_percent_3").attr('required', false);
	// 	}
	// });    
    
});

function recallRemove(){
   
}
</script>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
                
<?php //var_dump($priv);  ?>                
                
	                <div class="col-lg-12">
<?php
if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){	                	
?>	                
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>/index.php/course_management/?action=add"><i class="fa fa-plus"></i> Add course</a>
<?php
}	                	
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>/index.php/course_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
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
			                			 <h4><i class="fa fa-file-text "></i> Course Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		               
                                
	                        <div class="form-group">
	                            <label>Course name</label>
	                            <input class="form-control" type="text" name="course_name" required>
	                        </div>
	                        <div class="form-group">
	                            <label>Course Code</label>
	                            <input class="form-control" type="text" name="course_code" required>
	                        </div>
	                        <div class="form-group">
	                            <label>Aim Of The Course </label>
	                            <select name="hesa_courseaim_id" id="" class="form-control">
	                            	<option value="">Please select</option>
	                            	<?php if(!empty($hesa_courseaim)) {?>
	                            	<?php foreach($hesa_courseaim as $k=>$v) {?>
	                            		<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
	                            	<?php } ?>
	                            	<?php } ?>
	                            	
	                            </select>
	                        </div>
	                        

	                        <div class="form-group">
	                            <label>Regularity Body</label>
	                            <select name="hesa_regbody_id" id="" class="form-control">
	                            	<option value="">Please select</option>
	                            	<?php if(!empty($hesa_regbody)) {?>
	                            	<?php foreach($hesa_regbody as $k=>$v) {?>
	                            		<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
	                            	<?php } ?>
	                            	<?php } ?>
	                            </select>
	                        </div>
							<div class="form-group">
	                            <label>Teacher Training Course</label>
	                            <select name="hesa_ttcid" id="" class="form-control">
	                            	<option value="">Please select</option>
	                            	<?php if(!empty($hesa_ttcid)) {?>
	                            	<?php foreach($hesa_ttcid as $k=>$v) {?>
	                            		<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
	                            	<?php } ?>
	                            	<?php } ?>
	                            </select>
	                        </div>
							<div class="form-group">
								
								<table class="table">
									<tr>
										<td>Subject of course</td>
										<td>
										
										<select name="subject_course_1" class="form-control" id="">
											<option value="">Please select</option>
											<?php if(!empty($hesa_sbjca)) {?>
												<?php foreach($hesa_sbjca as $k=>$v) {?>
													<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
												<?php } ?>
											<?php } ?>
											
										</select>
										</td>
										<td>
										<select name="subject_course_2" class="form-control" id="">
											<option value="">Please select</option>
											<?php if(!empty($hesa_sbjca)) {?>
												<?php foreach($hesa_sbjca as $k=>$v) {?>
													<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
												<?php } ?>
											<?php } ?>
											
										</select>
										</td>
										<td>
										<select name="subject_course_3" class="form-control" id="">
											<option value="">Please select</option>
											<?php if(!empty($hesa_sbjca)) {?>
												<?php foreach($hesa_sbjca as $k=>$v) {?>
													<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
												<?php } ?>
											<?php } ?>
											
										</select>
										</td>
										<td>
										<select name="subject_course_4" class="form-control" id="">
											<option value="">Please select</option>
											<?php if(!empty($hesa_sbjca)) {?>
												<?php foreach($hesa_sbjca as $k=>$v) {?>
													<option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
												<?php } ?>
											<?php } ?>
										</select>
										</td>
									</tr>
									<tr>
										<td>Contribution  Percentage(%)</td>
										<td><input type="text" class="form-control contribution_percent_0" name="contribution_percent[0]" id=""></td>
										<td><input type="text" class="form-control contribution_percent_1" name="contribution_percent[1]" id=""></td>
										<td><input type="text" class="form-control contribution_percent_2" name="contribution_percent[2]" id=""></td>
										<td><input type="text" class="form-control contribution_percent_3" name="contribution_percent[3]" id=""></td>
									</tr>
								</table>

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

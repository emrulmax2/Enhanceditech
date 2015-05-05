<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if(isset($terms) && is_array($terms)){

			foreach($terms as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				
				if ($k == "list_of_parcent") {
					echo "$('input[name=$k]').val('".tinymce_decode($v)."').attr('checked', 'checked');";
				} else{
					echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
				}
			}
		}    	
	?>    
    
});

function recallRemove(){
   
};
</script>


                <!-- Page Heading -->
                
                
                
                <!-- /.row -->
                
                <div class="clearfix">
	                
	                <div class="">                
	                	<?php if(!empty($message))echo $message; ?>
	                </div>
	                
                </div>                

			   <div class="clearfix">
               <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>     
                    
                    <form class="search_student_form" role="form" method="post" action="?action=search">
                    
                    
						<div class="panel panel-info">
							<div class="panel-heading">
                              <div class="row">
                                <div class="col-sm-4">
                               
								<h4><i class="fa fa-file-text "></i> Search Student </h4>
                               </div>
                                <div class="col-sm-8 text-right">
                                    <button type="submit" class="btn btn-md btn-success"><i class="fa fa-search"></i> Search</button>
                                    <button type="reset" class="btn btn-md btn-danger "><i class="fa fa-refresh"></i> Reset</button>
                                </div>
                              </div>
							</div>
							<div class="panel-body"> 
							    <?php $i=0; ?>
				                <div class="col-lg-12">
				             		                                
				                        <!-- <div class="form-group col-lg-3 col-xs-12 checkbox checkbox-primary">

				                            <input name="search_all" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="form-control"><label for="<?php echo"checkbox".$i; ?>">All Student</label>
				                        </div> -->
				                        
				                        <div class="form-group col-lg-4 col-xs-12  no-pad-left">
                                            <label>Attendance Semester</label>
                                            <select class="form-control" name="semester_id">
                                              <option value="">Please Select</option>
<?php
                                                foreach($semester_list as $k=>$v){                                                  
?>                                              
                                                      <option value="<?php echo $v['id']; ?>"><?php echo $v['semister_name']; ?></option>
<?php
                                                }
?>                                                  
                                            </select>
				                        </div>	
				                        
				                        <div class="form-group col-lg-4 col-xs-12  no-pad-left">
                                            <label>Course</label>
                                            <select class="form-control" name="course_id">
                                                <option value="">Please Select</option>
                                              
<?php
                                                foreach($course_list as $k=>$v){                                                  
?>                                              
                                                      <option value="<?php echo $v['id']; ?>"><?php echo $v['course_name']; ?></option>
<?php
                                                }
?>                                              
                                              
                                            </select>
				                        </div>	
				                        
				                        <div class="form-group col-lg-4 col-xs-12  no-pad-left no-pad-right">
                                            <label>Status</label>
                                            <select class="form-control" name="student_admission_status_for_staff">
                                              <option value="">Please Select</option>
<?php
                                                foreach($status_list as $k=>$v){                                                  
?>                                                  
                                                      <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
<?php
                                                }
?>                                              
                                            </select>
				                        </div>		                        	                        	                        		                        		                        		                        
				                        <div class="clearfix"></div>
		           				</div>
		           				
				                <div class="col-lg-12">	

		                                <div class="form-group col-lg-3 col-xs-12 no-pad-left">
				                            <label>Level</label>
											<select class="form-control" name="level_name">
											  <option value="">Please Select</option>
											  <?php if(!empty($level_list)) { ?>
											  <?php foreach($level_list as $k=>$v) { ?>
											  	<option value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
											  <?php } ?>
											  <?php } ?>
											</select>
				                        </div>

				                        <div class="form-group col-lg-3 col-xs-12 no-pad-left">
				                            <label>Module</label>
											<select class="form-control" name="module_id">
											  <option value="">Please Select</option>
											  <?php if(!empty($moduleList)) { ?>
											  <?php foreach($moduleList as $k=>$v) { ?>
											  	<option value="<?php echo $v['id']; ?>"><?php echo $v['modulename']; ?></option>
											  <?php } ?>
											  <?php } ?>
											</select> 
				                        </div>
				                        
				                        <div class="form-group col-lg-3 col-xs-12 no-pad-left">
				                        	<label>Group</label>
											<select class="form-control" name="group_name">
											  <option value="">Please Select</option>
											  <?php if(!empty($group_name)) { ?>
											  <?php foreach($group_name as $k=>$v) { ?>
											  	<option value="<?php echo $v['group_name']; ?>"><?php echo $v['group_name']; ?></option>
											  <?php } ?>
											  <?php } ?>
											</select>
				                        </div>	
				                        

				                        
				                       
				                        <div class="form-group col-lg-3 col-xs-12 no-pad-left">
				                            <label>Student Type</label>
				                            <select class="form-control" name="student_type" id="">
				                            	<option value="">Please Select</option>
				                            	<option value="uk">UK-EU</option>
				                            	<option value="overseas">Overseas</option>
				                            </select>
				                        </div>
				                        
				                        		                        	                        	                        		                        		                        		                        
				                    
		           				</div>
		           				
								<!-- <div class="clearfix"></div>
		           				<p class="divider" style="height:2px;background-color:#C5C5C5;"></p>	
		           				<div class="vsap" style="height:10px;"></div> -->	           		
                                <div class="col-lg-12 no-pad">
                                        <div class="form-group col-lg-6 col-xs-12">
                                            <label>Student Attendance</label>
                                            <select class="form-control" name="student_attendance" id="">
				                            	<option value="">Please Select</option>
				                            	<?php for ($i=10; $i < 101; $i+=10) { ?>
				                            		<option value="<?php echo $i.".00" ?>"><?php echo $i ?>%</option>
				                            	<?php } ?>
				                            </select>
                                        </div>

                                        <div class="form-group col-lg-6 col-xs-12">
                                            <!-- <label>Date Wise</label>
                                            <input type="text" class="form-control date"> -->
                                            
											<label for="std_letter_list">Issue Letters</label>
											<select name="letter_id" class="form-control" id="std_letter_list">
												<option value="">Please select</option>
												<?php if(!empty($letter_set)) {?>
													<?php foreach($letter_set as $k=>$v) {?>
														<option value="<?php echo $v['id'] ?>"><?php echo $v['letter_title'] ?></option>
													<?php } ?>
												<?php } ?>
												
												
											</select>
							
                                        </div> 
                                        
                                    	
                                                                       
                                </div>                                
                                
		           				
		           				<div class="clearfix"></div>
		           				
		           				<div class="col-lg-12">
		           				

					                
					                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
					                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                				            
		                        </div>
                        							
							</div><!--<div class="panel-body">-->
						</div><!--<div class="panel panel-info">--> 


				<div class="col-lg-12 no-pad">
					<div id="error-msg"></div>
				</div>

				</form>
               
				</div>
            

           
            <!-- /.container-fluid -->
			<div class="clearfix"></div>

            
            

            
<script>
	$(function() {

		var btn = $('a.report_result_show');
		var form = $('form#report_result');

		//"Generate", "Result in Excel", "Result in XML" button click event handler.
		btn.click(function(e) {

			e.preventDefault();
			var checked = [];

			var form_fields = form.find('input');
			$.each(form_fields, function(index, val) {
				
				if (this.checked == true) {
					checked.push(1);
				}
			});
			
			if(checked.length>0) 
			{
				$("#error-msg").html("");
				var action = $(this).data('action');
				form.attr('action', '?action='+action);

				form.submit();
			} else {
				$("#error-msg").html('<div class="alert alert-danger" role="alert"><b>Error! No Item Was Checked.</b></div>');
				return false;
			}

		});



		var btn = $('a.hesa_report_result');
		var form2 = $('form#hesa_search');

		//"Generate", "Result in Excel", "Result in XML" button click event handler.
		btn.click(function(e) {

			e.preventDefault();
			// var checked2 = [];

			// var form_fields2 = form2.find('input');
			// $.each(form_fields2, function(index, val) {
				
			// 	if (this.checked == true) {
			// 		checked2.push(1);
			// 	}
			// });
			
			// if(checked2.length>0) 
			// {
				$("#error-msg2").html("");
				var action2 = $(this).data('action');
				form2.attr('action', '?action='+action2);

				form2.submit();
			// } else {
			// 	$("#error-msg2").html('<div class="alert alert-danger" role="alert"><b>Error! No Item Was Checked.</b></div>');
			// 	return false;
			// }

		});

	});
</script>            

            

    
    

            

  
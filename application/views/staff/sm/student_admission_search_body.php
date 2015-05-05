<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if(isset($terms) && is_array($terms)){
			foreach($terms as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				if($k=="semester_id" || $k=="course_id" || $k=="student_admission_status_for_staff" || $k=="agent_id") echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
				else echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
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
                                <?php if(!empty($priv[0]) || $this->session->userdata('label')=="admin") {?>                               
                                <div class="col-sm-8 text-right">
                                <button type="submit" class="btn btn-md btn-success"><i class="fa fa-search"></i> Search</button>
                                <button type="reset" class="btn btn-md btn-danger "><i class="fa fa-refresh"></i> Reset</button>
                                </div>
                                <?php } ?>                                 
                              </div>
							</div>
							<div class="panel-body"> 
							
				                <div class="col-lg-12">
				             		                                
				                        <div class="form-group col-lg-3 col-xs-12 no-pad-left">
				                            <label>Student ID</label>
				                            <input class="form-control" type="text" name="registration_no">
				                        </div>
				                        
				                        <div class="form-group col-lg-3 col-xs-12  no-pad-left">
				                            <label>First Name(s)</label>
				                            <input class="form-control" type="text" name="student_first_name">
				                        </div>	
				                        
				                        <div class="form-group col-lg-3 col-xs-12  no-pad-left">
				                            <label>Surname</label>
				                            <input class="form-control" type="text" name="student_sur_name">
				                        </div>	
				                        
				                        <div class="form-group col-lg-3 col-xs-12  no-pad-left no-pad-right">
				                            <label>Date of Birth</label>
				                            <div class="col-xs-12 no-pad">
					                            <div class="col-xs-4 no-pad-left"><input class="form-control" class="col-xs-1 no-pad-left" type="text" name="dob_d" placeholder="DD" pattern="[0-9]{2,}" maxlength="2"></div>
					                            <div class="col-xs-4 no-pad-left"><input class="form-control" class="col-xs-1" type="text" name="dob_m" placeholder="MM" pattern="[0-9]{2,}" maxlength="2"></div>
					                            <div class="col-xs-4 no-pad"><input class="form-control" class="col-xs-1 no-pad-right" type="text" name="dob_y" placeholder="YYYY" pattern="[0-9]{4,}" maxlength="4"></div>
				                            </div>
				                        </div>		                        	                        	                        		                        		                        		                        
				                        <div class="clearfix"></div>
		           				</div>
		           				
				                <div class="col-lg-12 no-pad">				                
		                                
				                        <div class="form-group col-lg-2 col-xs-12">
				                            <label>Semester</label>
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
				                        
				                        <div class="form-group col-lg-2 col-xs-12">
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
				                        
				                        <div class="form-group col-lg-2 col-xs-12">
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
				                        <div class="form-group col-lg-2 col-xs-12">
				                            <label>SSN No</label>
				                            <input class="form-control" type="text" name="ssn">
				                        </div>
				                        <div class="form-group col-lg-2 col-xs-12">
				                            <label>App Ref. No</label>
				                            <input class="form-control" type="text" name="student_application_reference_no">
				                        </div>
				                        <div class="form-group col-lg-2 col-xs-12">
				                            <label>Student Type</label>
				                            <select class="form-control" name="student_type" id="">
				                            	<option value="">Please Select</option>
				                            	<option value="uk">UK-EU</option>
				                            	<option value="overseas">Overseas</option>
				                            </select>
				                        </div>
				                        
				                        		                        	                        	                        		                        		                        		                        
				                    
		           				</div>		           		

                                <div class="col-lg-12 no-pad">
                                        <div class="form-group col-lg-6 col-xs-12">
                                            <label>Awarding Body reference number</label>
                                            <input class="form-control" type="text" name="awarding_body_ref">
                                        </div>                                
                                </div>                                
                                
		           				
		           				<div class="clearfix"></div>
		           				
		           				<div class="col-lg-12">
		           				

					                
					                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
					                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                				            
		                        </div>
                        							
							</div><!--<div class="panel-body">-->
						</div><!--<div class="panel panel-info">-->                    		                

               </form>
               
               
               

            </div>
            <!-- /.container-fluid -->
            
            
            <div class="clearfix">
            
            <?php if(!empty($result)){ ?>
            	<?php echo $result; ?>            
            <?php } ?>
            </div>
            
            

            

    
    

            

  
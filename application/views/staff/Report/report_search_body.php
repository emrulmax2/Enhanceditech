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
					
					<?php if (!empty($result)) { ?>
					<div class="alert alert-success" role="alert">
						<p style="font-size:15px;font-weight:bold"> <?php echo ($result>1) ? $result." Students" : $result." Student" ; ?>  Found!</p>
					</div>
					<?php } ?>

				</div>

				<div class="col-lg-12 no-pad">
					<div id="error-msg"></div>
				</div>

				</form>
               
				<form id="report_result" method="post">
				
	            <div class="col-lg-12" style="margin-bottom:10px;">
	            	<div class="text-right">
	        			<a data-action="generate" class="report_result_show btn btn-default btn-success">Generate</a>        			
        				<a data-action="excel" class="report_result_show btn btn-default btn-primary">Result in Excel</a>
        				<!-- <a data-action="xml" class="report_result_show btn btn-default btn-danger">Result in XML</a> -->
					</div>
	            </div>
	            <div class="clearfix"></div>
				

				<div class="panel panel-info">
					<div class="panel-heading">
                      <div class="row">
                        <div class="col-sm-4">
                       
						<h4><i class="fa fa-file-text "></i> Personal Info </h4>
                       </div>
                        
                      </div>
					</div>
					<div class="panel-body"> 
					   
		                <div class="col-lg-12">
							

							<div class="col-md-3">
								<p>Current Info</p>
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_email_current" name="sd[]" type="checkbox" class="form-control" value="student_email as email"><label for="std_email_current">E-mail</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_phone_current" name="sd[]" value="student_home_phone as telephone" type="checkbox" class="form-control"><label for="std_phone_current">Telephone</label>
		                        </div>

								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_mobile_current" name="sd[]" value="student_mobile_phone as mobile" type="checkbox" class="form-control"><label for="std_mobile_current">Mobile</label>
		                        </div>
		                        
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_address_current" name="sd[]" value="student_address_address_line_1 as address" type="checkbox" class="form-control"><label for="std_address_current">Address</label>
		                        </div>
							</div>

							<div class="col-md-3">
								<p>Permanent Info</p>
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_postcode" name="rs[]" value="student_permanent_postcode as postcode" type="checkbox" class="form-control"><label for="std_postcode">Postcode</label>
		                        </div>
		                        <!-- <div class="form-group checkbox checkbox-primary">

		                            <input id="std_phone_permanent" type="checkbox" class="form-control"><label for="std_phone_permanent">Telephone</label>
		                        </div>

								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_mobile_permanent" type="checkbox" class="form-control"><label for="std_mobile_permanent">Mobile</label>
		                        </div>
		                        
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_address_permanent" type="checkbox" class="form-control"><label for="std_address_permanent">Address</label>
		                        </div> -->
								
							</div>

							<div class="col-md-3">
								<p>Next To Kin</p>

								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_mobile_kin" name="rs[]" value="kin_name" type="checkbox" class="form-control"><label for="std_mobile_kin">Name</label>
		                        </div>

								<div class="form-group checkbox checkbox-primary">

		                            <input name="rs[]" value="kin_email" id="std_email_kin" type="checkbox" class="form-control"><label for="std_email_kin">E-mail</label>
		                        </div>
								
		                        <div class="form-group checkbox checkbox-primary">

		                            <input name="rs[]" value="kin_phone" id="std_phone_kin" type="checkbox" class="form-control"><label for="std_phone_kin">Telephone</label>
		                        </div>
		                        
								<div class="form-group checkbox checkbox-primary">

		                            <input name="rs[]" value="kin_address" id="std_address_kin" type="checkbox" class="form-control"><label for="std_address_kin">Address</label>
		                        </div>
							</div>

							<div class="col-md-3">
								<p>Agent Info</p>
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_agent" type="checkbox" name="ag[]" value="agent_name" class="form-control"><label for="std_agent">Agent Name</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_agent_phone" name="ag[]" value="agent_mobile_number as agent_phone" type="checkbox" class="form-control"><label for="std_agent_phone">Phone No</label>
		                        </div>

								<!-- <div class="form-group checkbox checkbox-primary">

		                            <input id="std_agent_commission" type="checkbox" class="form-control"><label for="std_agent_commission">Commission paid</label>
		                        </div> -->
		                        
							</div>

							<div class="clearfix"></div>
		           			<p class="divider" style="height:2px;background-color:#C5C5C5;"></p>
		           			<div class="vsap" style="height:10px;"></div>

		           			<div class="col-md-3">
								
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_passport" type="checkbox" name="rs[]"  value="proof_typeANDproof_id"  class="form-control"><label for="std_passport">Passport Number</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_visa_expiry" type="checkbox" class="form-control"><label for="std_visa_expiry">Visa Expiry Date</label>
		                        </div>

								<div class="form-group checkbox checkbox-primary">

		                            <input name="sd[]" value="student_others_disabilities as disabilities" id="std_disability" type="checkbox" class="form-control"><label for="std_disability">Disability</label>
		                        </div>
		                        
								<div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_ukba_1" type="checkbox" class="form-control"><label for="std_ukba_1">UKBA CAS No.</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_section" type="checkbox" class="form-control"><label for="std_section">Section</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_visa_type" type="checkbox" class="form-control"><label for="std_visa_type">Visa Type</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input name="coun[]" value="country_name as country" id="std_birth_country" type="checkbox" class="form-control"><label for="std_birth_country">Birth Country</label>
		                        </div>
							</div>

							<div class="col-md-3">
								
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_passport_expire_date" name="rs[]" value="proof_expiredate as passport_expire_date" type="checkbox" class="form-control"><label for="std_passport_expire_date">Passport Expiry Date</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input name="coun[]" value="country_name as nationality" id="std_nationality" type="checkbox" class="form-control"><label for="std_nationality">Nationality</label>
		                        </div>

								<div class="form-group checkbox checkbox-primary">

		                            <input name="sd[]" value="student_date_of_birth as date_of_birth" id="std_dob" type="checkbox" class="form-control"><label for="std_dob">Date Of Birth</label>
		                        </div>
		                        
								<div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_ukba_2" type="checkbox" class="form-control"><label for="std_ukba_2">UKBA CAS Date</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_special_note" type="checkbox" class="form-control"><label for="std_special_note">Special Note</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input name="sd[]" value="agent_id" id="std_agent_id" type="checkbox" class="form-control"><label for="std_agent_id">Agent ID</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input name="sd[]" value="student_application_reference_no as student_application_no" id="std_application" type="checkbox" class="form-control"><label for="std_application">Student Application No.</label>
		                        </div>
								
							</div>

							<div class="col-md-3">
								
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_batch_name" type="checkbox" name="semester[]" value="semister_name as batch_name" class="form-control"><label for="std_batch_name">Batch Name</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_course_name" name="crs[]" value="course_name as course" type="checkbox" class="form-control"><label for="std_course_name">Course Name</label>
		                        </div>

								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_csd" type="checkbox" name="rs[]" value="class_startdate as class_start_date" class="form-control"><label for="std_csd">Class Start Date</label>
		                        </div>
		                        
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_gender" type="checkbox" name="gen[]" value="name as gender" class="form-control"><label for="std_gender">Gender</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_scr" type="checkbox" name="si[]" value="status_change_reason as status_changed_reason" class="form-control"><label for="std_scr">Status Change Reason</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_ssn" type="checkbox" name="rs[]" value="ssn" class="form-control"><label for="std_ssn">SSN</label>
		                        </div>
		                        
							</div>

							<div class="col-md-3">
								
								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_awarding_body" name="awarding_body[]" value="name as awarding_body" type="checkbox" class="form-control"><label for="std_awarding_body">Awarding Body</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_arn" type="checkbox" name="si[]" value="awarding_body_ref as awarding_reference_no" class="form-control"><label for="std_arn">Awarding Reference No</label>
		                        </div>

								<div class="form-group checkbox checkbox-primary">

		                            <input id="std_ced" type="checkbox" name="rs[]" value="class_enddate as class_end_date" class="form-control"><label for="std_ced">Class End Date</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_cas_status" type="checkbox" class="form-control"><label for="std_cas_status">CAS Status</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_status_bottom" name="st[]" value="name as status" type="checkbox" class="form-control"><label for="std_status_bottom">Status</label>
		                        </div>
		                        <div class="form-group checkbox checkbox-primary">

		                            <input id="std_statuscd" name="arcv[]" value="entry_date as status_change_date" type="checkbox" class="form-control"><label for="std_statuscd">Status Change Date</label>
		                        </div>
		                        
							</div>

							<div class="clearfix"></div>
		           			<p class="divider" style="height:2px;background-color:#C5C5C5;"></p>
		           			<div class="vsap" style="height:10px;"></div>

							<div class="form-group col-lg-6 col-xs-12 checkbox checkbox-primary">

	                            <input name="si[]" value="attendance_parcent as parcent" id="list_attendance" type="checkbox" class="form-control"><label for="list_attendance">List for % of student's attendance.</label>
	                        </div>


		                </div>
		            </div>
		        </div>                   		                
               
                <div class="panel panel-info">
					<div class="panel-heading">
                      <div class="row">
                        <div class="col-sm-4">
                       
						<h4><i class="fa fa-file-text "></i> Passport &amp; Visa Info </h4>
                       </div>
                        
                      </div>
					</div>
					<div class="panel-body"> 
					   
		                <div class="col-lg-12">
							
							<div class="col-md-6">
								<div class="form-group checkbox checkbox-primary">

		                            <input disabled id="std_visa_expiry_30" type="checkbox" class="form-control"><label for="std_visa_expiry_30">List of students who's VISA expiring or already expired from current date + 30 day in advance.</label>
		                        </div>
							</div>

							<div class="col-md-6">
								<div class="form-group checkbox checkbox-primary">

		                            <input name="rs[]" value="proof_expiredate as passport_already_expired" id="std_passport_expiry_30" type="checkbox" class="form-control"><label for="std_passport_expiry_30">List of students who's PASSPORT expiring or already expired from current date + 30 day in advance.</label>
		                        </div>
							</div>


		                </div>
		            </div>
		        </div>

		        

		        

		        
				

            </div>
            <div class="col-lg-12">
            	<div class="text-right">
        			
        			<a data-action="generate" class="report_result_show btn btn-default btn-success">Generate</a>        			
        			<a data-action="excel" class="report_result_show btn btn-default btn-primary">Result in Excel</a>
        			
        			
				</div>
            </div>

            </form>
            <!-- /.container-fluid -->
			<div class="clearfix"></div>
			<!-- Hesa section for report -->

			<div class="col-lg-12 no-pad">
				<div id="error-msg2"></div>
			</div>
	        <form action="" method="post" id="hesa_search">
				<div class="col-lg-12 no-pad" style="margin-top:20px;">
	            	
					<div class="panel panel-info">
						<div class="panel-heading">
	                      <div class="row">
	                        <div class="col-sm-4">
	                       
							<h4><i class="fa fa-file-text "></i> Hesa Info </h4>
	                       </div>
	                        
	                      </div>
						</div>
						<div class="panel-body"> 
						   
			                <div class="col-lg-12">
								
								<!-- <div class="col-md-3">
									<div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_class_id" type="checkbox" class="form-control"><label for="hesa_class_id">Class</label>
			                            
			                        </div>
									<div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_courseaim_id" type="checkbox" class="form-control"><label for="hesa_courseaim_id">Courseaim</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_disall_id" type="checkbox" class="form-control"><label for="hesa_disall_id">Disall</label>
			                            
			                        </div>

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_exchind_id" type="checkbox" class="form-control"><label for="hesa_exchind_id">Exchind</label>
			                            
			                        </div>

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_genderid_id" type="checkbox" class="form-control"><label for="hesa_genderid_id">Genderid</label>
			                            
			                        </div>

			                       

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_heapespop_id" type="checkbox" class="form-control"><label for="hesa_heapespop_id">Heapespop</label>
			                            
			                        </div>

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_locsdy_id" type="checkbox" class="form-control"><label for="hesa_locsdy_id">Locsdy</label>
			                            
			                        </div>
								</div>

								<div class="col-md-3">
									
									
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_mode_id" type="checkbox" class="form-control"><label for="hesa_mode_id">Mode</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_priprov_id" type="checkbox" class="form-control"><label for="hesa_priprov_id">Priprov</label>
			                            
			                        </div>

									

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_qual_id" type="checkbox" class="form-control"><label for="hesa_qual_id">Qual</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_regbody_id" type="checkbox" class="form-control"><label for="hesa_regbody_id">Regbody</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_relblf_id" type="checkbox" class="form-control"><label for="hesa_relblf_id">Relblf</label>
			                            
			                        </div>

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_rsnend_id" type="checkbox" class="form-control"><label for="hesa_rsnend_id">Rsnend</label>
			                            
			                        </div>
									<div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_sexort_id" type="checkbox" class="form-control"><label for="hesa_sexort_id">Sexort</label>
			                            
			                        </div>
								</div>


								<div class="col-md-3">

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_sselig_id" type="checkbox" class="form-control"><label for="hesa_sselig_id">Sselig</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_ttcid_id" type="checkbox" class="form-control"><label for="hesa_ttcid_id">Ttcid</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="uhn_number" type="checkbox" class="form-control"><label for="uhn_number">Uhn number</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_yearstu" type="checkbox" class="form-control"><label for="hesa_yearstu">Yearstu</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_notact_id" type="checkbox" class="form-control"><label for="hesa_notact_id">Notact</label>
			                            
			                        </div>
									<div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_provider_name" type="checkbox" class="form-control"><label for="hesa_provider_name">Provider name</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_qual_type" type="checkbox" class="form-control"><label for="hesa_qual_type">Qual type</label>
			                            
			                        </div>
								</div>

								<div class="col-md-3">
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_qual_sub" type="checkbox" class="form-control"><label for="hesa_qual_sub">Qual sub</label>
			                            
			                        </div>

			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_qual_sit" type="checkbox" class="form-control"><label for="hesa_qual_sit">Qual sit</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_domicile_id" type="checkbox" class="form-control"><label for="hesa_domicile_id">Domicile</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_numhus" type="checkbox" class="form-control"><label for="hesa_numhus">Numhus</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_owninst" type="checkbox" class="form-control"><label for="hesa_owninst">Owninst</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_comdate" type="checkbox" class="form-control"><label for="hesa_comdate">Comdate</label>
			                            
			                        </div>
			                        <div class="form-group checkbox checkbox-primary">
										
										<input id="hesa_enddate" type="checkbox" class="form-control"><label for="hesa_enddate">Enddate</label>
			                            
			                        </div>
								</div> -->

								<div class="col-md-6">
									<div class="form-group">
										<label>Select Instance Period</label>
										<select name="instance_period" id="" class="form-control">
											<option value="all">All</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
										</select>
									</div>	
								</div>


			                </div>
			            </div>
			        </div>


            	</div>
            	<div class="col-lg-12">
	            	<div class="text-right">
	        			
	        			<!-- <button type="submit" class="btn btn-primary">Hesa Search</button> -->
	        			<a data-action="xml" class="hesa_report_result btn btn-default btn-danger">Result in XML</a>
					</div>
	            </div>
            </form>

            <!-- End of Hesa section for report -->
            
            
            <div class="clearfix">
            
            <?php if(!empty($generate_result)){ ?>
            	<?php echo $generate_result; ?>            
            <?php } ?>
            </div> 
            
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

            

    
    

            

  
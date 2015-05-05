<?php $student_admission_status = ""; $student_application_reference_no=""; $student_app_submitted_datetime=""; ?>
<script type="text/javascript">

$(document).ready(function(){

	$(".rejected-reason-list").hide();
    $(".student_email_duplicate_chk_loading").hide();  
   

		
  var funding = $('select[name=student_funding_type]').val();
  if(funding == "Student Loan" ) {
  	  
      $("#fundingoption").fadeIn();
      
      $('#fundingoption3').fadeOut();
      $('input[name=student_funding_type_other]').val("");
      
  }else if(funding == "Other" ){
      
       $('#fundingoption3').fadeIn();
       $("#fundingoption").fadeOut();
       $("#fundingoption2").fadeOut(); 
       $('select[name=student_student_loan_applied_for_the_proposed_course]').val("no"); 
       $('select[name=student_already_in_receipt_of_funds]').val("no");   
  }else {
      $("#fundingoption").fadeOut();$("#fundingoption2").fadeOut();
      $('#fundingoption3').fadeOut();
      $('select[name=student_student_loan_applied_for_the_proposed_course]').val("no");
      $('input[name=student_funding_type_other]').val("");
  }


/*  $(".student_email_duplicate_chk").bind("change blur",function(){
      
        $(".student_email_duplicate_chk_loading").show();        
  });*/
  
  

<?php
        if(!empty($hesa_student_information_data)){
            
            if(!empty($hesa_student_information_data['hesa_sexort_id']) && $hesa_student_information_data['hesa_sexort_id']>0) echo "$('select[name=hesa_sexort_id]').val('".$hesa_student_information_data['hesa_sexort_id']."');";            
            if(!empty($hesa_student_information_data['hesa_relblf_id']) && $hesa_student_information_data['hesa_relblf_id']>0) echo "$('select[name=hesa_relblf_id]').val('".$hesa_student_information_data['hesa_relblf_id']."');";            
           
        }        
?>	
	


    
});



</script>


                
                <!--<div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
	                	 //echo $message;

                     } ?>
	                </div>
	                
                </div> -->               

                <div id="formbox" class="clearfix">
                    
                    
                    <form role="form" id="registerinfo"  class='formsreg'  method="post" action="?action=singleview&do=application&id=<?php echo $ref_id; ?>">
                    
		                <div class="col-lg-12">
			                <div class="row">
                            
				                <div class="col-sm-12 text-right">
				                	<img src="<?php echo base_url(); ?>images/loading.gif" class="loading">
                                     <!--<a href="<?php //echo base_url(); ?>index.php/print_student_app/?id=<?php //echo $user_data['id']; ?>" class="btn btn-sm btn-primary "><i class="fa fa-print"></i> Print</a>-->

                         			<?php if(!empty($priv[17]) || $this->session->userdata('label')=="admin"){ ?><button type="button" class="btn btn-sm btn-success register-personal-info-submit"><i class="fa fa-save"></i> Update </button><?php } ?>
					             </div>	   
				             </div> 
                             <div class="msg"></div>
                             <div class="divider"></div>  
				             <div class="form-group">
				               <h4><i class="fa fa-user "></i> Personal Details </h4>
				               <p class="divider"></p>
				             </div>       		                        
                                <div class="form-group clearfix">  
                                	<div class="col-sm-2 ">
		                            <label>Nationality <small class="red-link">*</small> : </label>
		                            </div>
		                            <div class="col-sm-2 no-pad-left">
		                            <select name="student_nationality"  class="form-control" required>
		                           <!--This part will came from database--> 
              								   	<option selected="" value="">Please Select</option>
                                  <?php foreach($country_list as $k=>$v) {?>
                                    <option value="<?=$v['id']?>"><?=$v['country_name']?></option>
                                  <?php } ?>
                     
		                           <!--End of this nationality part--> 
		                            </select>
		                            </div>
                                	<div class="col-sm-2  ">
                                     <label>Country of Birth <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-2 no-pad-left">
		                            <select name="student_country_of_birth"  class="form-control" required>
                                     <!--This part will came from database--> 
              								   	 <option selected="" value="">Please Select</option>
                                   <?php foreach($country_list as $k=>$v) {?>
                                    <option value="<?=$v['id']?>"><?=$v['country_name']?></option>
                                  <?php } ?>
                        
		                             <!--End of this nationality part--> 
		                            </select><!-- end of country selection -->
		                            </div>

                                    <div class="col-sm-2 ">
                                        <label>Ethnicity <small class="red-link">*</small> : </label>
                                        </div>
                                    <div class="col-sm-2 no-pad-left">
                                        <select name="student_others_ethnicity"  class="form-control" required>
                                            <option value="">Please select</option>
                                            <?php foreach($ethnicity_list as $k=>$v) {?>
                                              <option value="<?=$v['id']?>"><?=$v['name']?></option>
                                            <?php } ?>
                                           
                                        </select>
                                        </div>
                                 </div>
                                <div class="form-group clearfix">  
                                	<div class="col-sm-2 ">
		                            <label>Proof of Id Type : </label>
		                            </div>
		                            <div class="col-sm-2 no-pad-left">
		                            <select name="proof_type"  class="form-control" required>
		                           <!--This part will came from database--> 
								   	<option selected="" value="">Please Select</option>
								   	<option value="passport">Passport</option>
								   	<option value="birth">Birth Certificate</option>
								   	<option value="driving">Driving</option>
								   	
		                           <!--End of this nationality part--> 
		                            </select>
		                            </div>
                                	<div class="col-sm-2  ">
                                     <label>ID no : </label>
                                    </div>
                                    <div class="col-sm-2 no-pad-left">
		                            <input type="text" class="form-control" name="proof_id" required value="" placeholder="Enter proof id" />
		                            </div>

                                    <div class="col-sm-2 ">
                                        <label>Expiry date : </label>
                                        </div>
                                    <div class="col-sm-2 no-pad-left">
                                        <input type="text" class="form-control date" name="proof_expiredate" required value="" placeholder="Enter proof expire date" />
                                        </div>
                                    </div> 
										<div style="clear:both; height:20px;"></div>
	                                    <div class="form-group">
	                                    	<div class="col-sm-3">
	                                        	<label>Permanent country of code : </label>
		                                    </div>
		                                    <div class="col-sm-4 no-pad-left">
		                                        <select class="form-control" name="hesa_domicile_id" id="">
		                                        	<option value="">Please select</option>
		                                        	<?php if(!empty($hesa_domicile_list)) {?>
														<?php foreach($hesa_domicile_list as $k=>$v) {?>
															<option value="<?php echo $v['id']; ?>"><?php echo $v['name']." (".$v['code'].")"; ?></option>
														<?php } ?>
		                                        	<?php } ?>
		                                        </select>
		                                    </div>
	                                    </div>
                                    </div>
                                    <div class="clearfix"></div>                            
                                <div class="form-group">
				               		<p class="divider"></p>
				               		<h4><i class="fa fa-envelope "></i> Contact Details </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="form-group clearfix">
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Home Phone : </label>
                                    </div>
                                    <div class="col-sm-3 no-pad-right">
                                     <input type="text" class="form-control" name="student_home_phone" value="" placeholder="home phone ex. +440121212..." />
                                    </div>
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Mobile Phone <small class="red-link">*</small> : </label>  
                                    </div>
                                    <div class="col-sm-3 no-pad-right">
                                     <input type="text" class="form-control" name="student_mobile_phone" required value="" placeholder="mobile phone  ex. +440777..." />
                                    </div>
                                </div> 
                               <!--<div class="form-group clearfix">
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Address <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-3  no-pad-right">
                                      <input type="button" class="form-control btn btn-info" name="manaul_poscode" value="Click To Enter Address" /> 
                                  
                                    </div><div class="col-sm-2 no-pad-right">
                                        <input type="button" class="form-control btn btn-warning" name="temp_post_code" value="Find postcode" />
                                  
                                    </div>
                                </div> -->
                                <div class="address-details">
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Address 1 <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_address_line_1" value="" placeholder="Enter Address 1" />
	                                    </div>
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Address 2 : </label>
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                      <input type="text" class="form-control" name="student_address_address_line_2" value="" placeholder="Enter Address 2" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>State/County : </label>
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                      <input type="text" class="form-control" name="student_address_state_province_region" value="" placeholder="Enter State or County " />
	                                    </div>
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Postal code <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_postal_zip_code" value="" placeholder="Enter Post Code" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>City <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_city" value="" placeholder="Enter City" />
	                                    </div>
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Country <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_country" value="" placeholder="Enter Country" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                            <label>Email Address <small class="red-link">*</small> : <img src="<?php echo base_url(); ?>images/loading.gif" class="student_email_duplicate_chk_loading"></label> 
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                        <input type="text" class="form-control student_email_duplicate_chk" required name="student_email" value="" />   
	                                    </div>
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Permanent postcode <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-3 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_permanent_postcode" value="" placeholder="Enter Permanent postcode" />
	                                    </div>
	                                </div>
                                </div> 
				             	 <!--this part came from the database --> 
				             	<div class="others">
				             	<div class="form-group">
				             	    <p class="divider"></p>
				               		<h4><i class="fa fa-cubes "></i> Next of Kin  </h4>
				               		<p class="divider"></p>
				             	</div>	
				             	<div class="form-group clearfix">
				             		<div class="col-sm-6 no-pad">
	                                   <div class="form-group clearfix">
	                                       <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                        <label>Name : </label>
	                                        </div>
	                                        <div class="col-sm-6 no-pad-right">
	                                          <input type="text" class="form-control" required name="kin_name" value="" placeholder="Kin Name" />
	                                        </div>
                                        </div>
                                        <div class="form-group clearfix">
	                                        <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                        <label>Address : </label>
	                                        </div>
	                                        <div class="col-sm-6 no-pad-right">
	                                          <textarea required class="form-control" placeholder="Kin Address" name="kin_address"></textarea>
	                                        </div>	                                    				             		
				             		    </div>
                                                                               
                                        
				             		</div>
				             	    <div class="col-sm-6 no-pad">
				             	       <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                    <label>Phone : </label>
	                                    </div>
	                                    <div class="col-sm-6 no-pad-right">
	                                        <input type="text" class="form-control" required name="kin_phone" value="" placeholder="Kin Phone" />
	                                    </div>
	                                    </div>
                                        <div class="form-group clearfix">
	                                    <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                        <label>Email : </label>
	                                    </div>
	                                    <div class="col-sm-6 no-pad-right">
	                                      <input type="text" class="form-control" required name="kin_email" value="" placeholder="Kin Email" />
	                                    </div>
                                        </div>
                                        <div class="form-group clearfix">
	                                        <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                        <label>Relation : </label>
	                                        </div>
	                                        <div class="col-sm-6 no-pad-right">
	                                          <input type="text" class="form-control" required name="kin_relation" value="" placeholder="Kin Relation" />
	                                        </div>
	                                    </div>
                                                                               	                                    
	                                    			             	    
				             	    </div>
				             	</div>
				             	<div class="form-group clearfix">
				             	    <p class="divider"></p>
				               		<h4><i class="fa fa-info"></i> Other Personal Info  </h4>
				               		<p class="divider"></p>
				             	</div>
								<div class="col-sm-6">
			             	 		<div class="form-group clearfix">
	                                    <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                    <label>Sexual Orientation : </label>
	                                    </div>
	                                    <div class="col-sm-6 no-pad-right">
	                                        <select name="hesa_sexort_id"  class="form-control" required>
	                                            <option value="">Please Select</option>

											<?php
	                                            if(!empty($hesa_sexort_list)){   
	                                               foreach($hesa_sexort_list as $k=>$v){
	                                                    echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
	                                               }
	                                            }                                                        
											?>                                                    
	                                            
	                                        </select> 
	                                    </div>                                                                             
	                                </div>
								</div>
								<div class="col-sm-6">
	                        		<div class="form-group clearfix">
	                                    <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                    <label>Religion or Belief : </label>
	                                    </div>
	                                    <div class="col-sm-6 no-pad-right">
	                                        <select name="hesa_relblf_id"  class="form-control" required>
	                                            <option value="">Please Select</option>

												<?php
	                                             if(!empty($hesa_relblf_list)){  
	                                               foreach($hesa_relblf_list as $k=>$v){
	                                                    echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
	                                               }
	                                             }                                                        
												?>                                                    
	                                            
	                                        </select>
	                                    </div>
	                                </div> 
								</div>

								<div class="col-sm-6">
	                        		<div class="form-group clearfix">
	                                    <div class="col-sm-4 no-pad-left col-md-offset-2">
	                                    <label>Hesa Gender : </label>
	                                    </div>
	                                    <div class="col-sm-6 no-pad-right">
	                                        <select name="hesa_genderid_id"  class="form-control" required>
	                                            <option value="">Please Select</option>

												<?php
	                                             if(!empty($hesa_genderid)){  
	                                               foreach($hesa_genderid as $k=>$v){
	                                                    echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
	                                               }
	                                             }                                                        
												?>                                                    
	                                            
	                                        </select>
	                                    </div>
	                                </div> 
								</div>


				             	<div class="form-group clearfix" style="clear: both;">
				             	    <p class="divider"></p>
				               		<h4><i class="fa fa-wheelchair"></i> Disabilities  </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad  col-md-offset-1">
                                    <label>Do you have any disabilities that require arrangements from the college or special needs that applies to you? <small class="red-link">*</small> </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select  class="form-control student_others_disabilities_on" name="student_others_disabilities_on" required>
                                    	<option value="">Please select</option>
                                    	<option value="yes">Yes</option>
										<option value="no">No</option>
                                    </select>
                                    </div>
                                </div>
				             	 <div class="disabilities-info"> 
	                                <div class="form-group clearfix all-disabilities">
	                                    
	                                    <div class="col-sm-5">
	                                    </div>

	                                    <div class="col-sm-6">
                                            <div class="row">
										<?php
											$j=1;
											foreach($disability_list as $k=>$v){
												
												
													echo'<div class="checkbox checkbox-primary">';
													echo'<input type="checkbox" id="disicheckbox'.$j.'" value="'.$v['id'].'" name="student_others_disabilities[]">';
													echo'<label for="disicheckbox'.$j.'">'.$v['name'].'</label>';								
													echo'</div>';	
												
												$j++;
												
											}											                                             	
										?> 
                                            </div>
											
	                                    </div>

	                                </div>

	                                <div class="form-group clearfix claim-disabilities">
                                        <div class="col-sm-4 no-pad  col-md-offset-1">Do You Claim Disabilities Allowance?</div>
                                        <div class="col-sm-7">
                                            <div class="checkbox checkbox-primary">

                                                <input type="checkbox" class="check-disibilities" id="disicheckbox_claim" value="yes" name="disabilities_allowance">
                                                <label for="disicheckbox_claim">Yes</label>                              
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group clearfix disabled-allowance">
                                        <div class="col-sm-4 no-pad  col-md-offset-1">Disabled Students Allowance</div>
                                        <div class="col-sm-7">
                                                <select name="hesa_disall_id"  class="form-control" required>
                                                    <option value="">Please Select</option>

<?php
                                                    if(!empty($hesa_disall_list)){
                                                       foreach($hesa_disall_list as $k=>$v){
                                                            echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
                                                       } 
                                                    }                                                          
?>                                                    
                                                    
                                                </select>
                                        </div>
                                    </div>                                    

	                             </div> <!--End of .disabilities-info-->
	                             </div> 
                                 <div class="form-group">
                                     <p class="divider"></p>
                                       <h4><i class="fa fa-suitcase "></i> How student came to college </h4>
                                       <p class="divider"></p>
                                 </div>
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>How did you know about the college? <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="student_others_marketing_info_referred_by"  class="form-control" required>
                                    	<option value="n/a">Please select</option>
                                    	<option value="student_own">I came to the college on my own.</option>
										<option value="student_referred">Somebody referred me.</option>
										<option value="agent_referred">From agent.</option>
                                    	</select>
                                    	</div>
	                             </div>
	                             <div class="reffered-claim">
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Name : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right ">
	                                    <input type="text" class="form-control " name="student_others_marketing_info_referred_name" value="" placeholder=" Name " />
	                                    </div>
	                             </div>
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Phone no : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <input type="text" class="form-control " name="student_others_marketing_info_referred_phone" value="" placeholder=" Phone no " />
	                                    </div>
	                             </div>
	                             </div>
	                             <div class="agent-claim">
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Agent name : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="agent_id"  class="form-control" >
                                    	<option value="">Please select</option>
                                    	
											<?php foreach($agent_list as $agent): ?>
											<option value="<?php echo $agent["id"]; ?>"><?php echo $agent["agent_name"];?></option>
										    <?php endforeach;?>
                                    	</select>
                                    	</div>
	                             </div>
	                             
	                             </div>

	                             
				             	</div> <!--End of .others-->                   
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		<div class="col-lg-12">
		           		    <p class="divider"></p>
		           			<div class="col-sm-4">
                				
	                		</div>
			                <div  class="col-sm-8 no-pad text-right">
                                     <!--<a href="<?php //echo base_url(); ?>index.php/print_student_app/?id=<?php //echo $user_data['id']; ?>" class="btn btn-sm btn-primary "><i class="fa fa-print"></i> Print</a>-->
                                     <?php if(!empty($priv[17]) || $this->session->userdata('label')=="admin"){ ?>
                                     <button type="button" class="btn btn-sm btn-success register-personal-info-submit"><i class="fa fa-save"></i> Update </button><?php } ?>
					        </div>	 
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			            </div>    		            
                        <div class="clearfix"></div>
               </form>
           
               

            </div> <!--End of #formbox-->
            
    

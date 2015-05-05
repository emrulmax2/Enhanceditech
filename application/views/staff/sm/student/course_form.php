<?php $student_admission_status = ""; $student_application_reference_no=""; $student_app_submitted_datetime=""; ?>
<script type="text/javascript">

$(document).ready(function(){

	$(".rejected-reason-list").hide();
      
   

		
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




	
	


    
});



</script>


                <div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">

                    <div class="msg">
                      
                    </div>
	                </div>
	                
                </div>              

                <div id="formbox" class="clearfix">
                    
                    <form action="">
                    
                    
		                <div class="col-lg-12">
				             <div class="form-group">
				               <h4><i class="fa fa-user "></i> Course Details </h4>
				               <p class="divider"></p>
				             </div>       		                        
                                
                                  
		                        <div class="form-group clearfix">    
		                            <div class="col-sm-2  ">
                                    	<label>Awarding Body : </label>
                                    </div>
                                    <div class="col-sm-8 ">
		                            	<input type="text" class="form-control" name="" required value="<?php echo $this->awarding_body->get_name( $course_and_awarding_info['awarding_id']) ?>" disabled />
		                            </div>
                            </div>
                                <div class="form-group clearfix">
                                   <div class="col-sm-2">
                                    <label>Awarding Body Ref : </label>
                                    </div>
                                    <div class="col-sm-3">
                                     <input type="text" class="form-control" name="awarding_body" value="<?php echo (!empty($awarding_body_ref)) ? $awarding_body_ref : "";  ?>"  />
                                    </div>
                                   
                                </div>
                                 
                                <div class="form-group clearfix">
                                   <div class="col-sm-2">
                                    <label> Date of Admission : </label>
                                    </div>
                                    <div class="col-sm-3">
                                     <input type="text" class="form-control" name="" value="<?php echo $admission_date; ?>" disabled />
                                    </div>
                                   <div class="col-sm-2">
                                    <label>Duration of Course : </label>  
                                    </div>
                                    <div class="col-sm-3">
                                     <input type="text" class="form-control" name="" required value="<?php echo $course_and_awarding_info['duration'] ?> Years" disabled  />
                                    </div>
                                </div>
                                 <div class="form-group clearfix">
                                   <div class="col-sm-2">
                                    
                                    </div>
                                    <div class="col-sm-3">
                                    <?php if(!empty($priv[18]) || $this->session->userdata('label')=="admin"){ ?>
                                     <button name="awarding_body_ref_submit" type="button" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Update </button>
                                    <?php } ?>
                                    </div>
                                   
                                </div>

                                
                               
				             	                  
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		<div class="col-lg-12">
		           		    <p class="divider"></p>
		           			
			                	 
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			            </div>    		            
                        <div class="clearfix"></div>
              
                  </form>
               

            </div> <!--End of #formbox-->
            
    

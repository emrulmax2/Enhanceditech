<link rel="stylesheet" type="text/css" href="http://services.postcodeanywhere.co.uk/css/captureplus-2.20.min.css?key=gy26-rh34-cf82-wd85" /><script type="text/javascript" src="http://services.postcodeanywhere.co.uk/js/captureplus-2.20.min.js?key=gy26-rh34-cf82-wd85"></script>
<?php $student_admission_status = ""; $student_application_reference_no=""; $student_app_submitted_datetime=""; ?>
<script type="text/javascript">

$(document).ready(function(){

    

	$(".rejected-reason-list").hide();
      
    <?php
        if($user_data && is_array($user_data)){
            foreach($user_data as $k=>$v){
            if($k=="student_admission_status_for_staff") {
                $student_admission_status_for_staff = $v;
                 if($student_admission_status_for_staff=="Review"){
                      $student_admission_status = "Review";
                     }else if($student_admission_status_for_staff=="Processing"){
                      $student_admission_status = "Processing";
                     }else if($student_admission_status_for_staff=="Refer to academic department"){
                      $student_admission_status = "Processing";
                     }else if($student_admission_status_for_staff=="Accepted"){
                      $student_admission_status = "Accepted";
                     }else if($student_admission_status_for_staff=="Rejected for review"){
                      $student_admission_status = "Processing";
                     }else if($student_admission_status_for_staff=="Rejected"){
                      $student_admission_status = "Rejected";
                     }else if($student_admission_status_for_staff=="New"){
                      $student_admission_status = "Submitted";
                     }else if($student_admission_status_for_staff=="Discarded"){
                      $student_admission_status = "Discarded";
                     }else if($student_admission_status_for_staff=="Awaiting Documents"){
                      $student_admission_status = "Awaiting Documents";
                     }
                
                } else if($k=="student_application_reference_no") {
                   $student_application_reference_no =$v;
                } else if($k=="student_app_submitted_datetime") {
                   $student_app_submitted_datetime =$v;
                } else if($k=="student_others_disabilities") {
                    /*echo"alert('".$v."');";
                    if($v=="no"){
						echo "$('.student_others_disabilities_on').val('no');";	
                    }*/
                   	/*$disibilities =explode(',',$v);
                   if($disibilities[0]=="no") {
                     echo "$('.student_others_disabilities_on').val('no');";  
                   } */
                }
                
                

                if($k=="student_address_address_line_1" && $v!="")
                echo "$('.address-details').fadeIn();";
                if($k=="student_educational_qualification_highest_academic_qualification" && $v!="") {
                echo "$('.qualification-details').fadeIn();"; 
                echo "$('.student_formal_education').val('yes');";
                
                } else if($k=="student_educational_qualification_highest_academic_qualification" && $v=="") { echo "$('.student_formal_education').val('no');";}
                if($k=="student_funding_type" && $v=="Student Loan")
                echo "$('#fundingoption').fadeIn();";
                if($k=="student_student_loan_applied_for_the_proposed_course" && $v=="yes")
                echo "$('#fundingoption2').fadeIn();";
                
                if($k=="student_employment_history_current_employment_status"  && ($v =="Part Time" || $v=="Fixed Term" || $v=="Zero Hour" || $v=="Seasonal" || $v == "Agency or Temp" || $v=="Volunteer") )
                echo "$('.employment-info').fadeIn();";
                if($k=="student_others_disabilities" && ($v=="0" || $v == 'no' || empty($v) )) {
                    echo "$('.disabilities-info').hide();";   
                    echo "$('.student_others_disabilities_on').val('no');";
                } else {
                    //echo "$('.disabilities-info').show();";   
                    //echo "$('.student_others_disabilities_on').val('yes');";

                }
/*                if($k=="student_title"){
					
					$student_title = $this->student_title->get_name_by_id($v);
                }*/
                
                if($k=="student_others_marketing_info_referred_by" && $v=="agent_referred") {
                 echo "$('.agent-claim').fadeIn();";   
                
                }
                if($k=="student_others_marketing_info_referred_by" && $v=="student_referred") {
                 echo "$('.reffered-claim').fadeIn();";   
                
                }
                if($k=="student_admission_status_rejected_reason" && !empty($v)){
                	$student_admission_status_rejected_reason = $v;
					
                }if($k=="student_admission_status_for_staff" && $v=="Rejected"){
                	echo "$('.rejected-reason-list').show();";	
					
                }
                if($k=="student_marital_status"){
					echo "$('input:radio[value=$v]').attr('checked',true);";
                }
                
                if($k!="student_course" && $k!="student_semister" && $k!="student_marital_status" && $k!="disabilities_allowance")   echo "$('input[name=$k]').val('".tinymce_decode($v)."');";
                
                
                
                
                
            }
            $disibilites =array();
            foreach($user_data as $k=>$v){
                if($k=="student_others_disabilities" && $v!="0" && $v != 'no' && $v != "") {
                    echo"$('select.student_others_disabilities_on').val('yes');";
                  echo"$('.disabilities-info').show();"; 
                    if(strpos($v,",")>0) {
                        $disibilites = explode(',',$v);
                    } else {                     
                         if(is_serialized($v))
                        $disibilites=unserialize(stripslashes_deep($v));         
                        
                    }


                $total_dis=count($disibilites);
                
                foreach ($disibilites as $disibility): ?>
                var i=0;
                $.each($(".disabilities-info").find('input:checkbox'),function(){
                    if($(this).val() == "<?php echo $disibility; ?>") {
                        //this.checked = true;
                        i++;
                        $(this).attr("checked",true);
                    }
                    
                });

                 if(i < <?php echo $total_dis; ?>) {
                 $('.othertext').val("<?php echo $disibility; ?>");
                 }
               <?php
                endforeach;
               
                }else
                if($k=="student_others_disabilities" && ($v=="0" || $v == 'no' || $v == "") ){
                  //echo"alert('".$v."');";
                  echo"$('select.student_others_disabilities_on').val('no');";
                  echo"$('.disabilities-info').hide();";            
                }else
                if($k=="disabilities_allowance" && $v == 'yes' ){

                  echo "$('input[name=disabilities_allowance]').attr('checked', true);"; 

                }else
                if($k=="student_semister" && preg_match("/[a-zA-Z]+ \d+/", $v)==1){

                	$semister_id = $this->semister->get_ID_by_name($v);
                	//$student_admission_status_rejected_reason = $v;
					echo "$('select[name=student_semister]').val('".$semister_id."');";	
				}else
                if($k=="student_semister" && preg_match("/[a-zA-Z]+ \d+/", $v)==0){
                
                	echo "$('select[name=student_semister]').val('".$v."');";                
                	
                }else
                if($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==1){
                	//echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                	$course_id = $this->course->get_ID_by_name($v);
                	//$student_admission_status_rejected_reason = $v;
					echo "$('select[name=student_course]').val('".$course_id."');";	
                
                }else
                if($k=="student_course" && preg_match("/[a-zA-Z]/", $v)==0){

					echo "$('select[name=student_course]').val('".$v."');";	
                
                }else
                if($k=="student_others_ethnicity" && preg_match("/[a-zA-Z]/", $v)==1){
                    //echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                    $ethnicity_id = $this->student_others_ethnicity->get_ID_by_name($v);
                    //$student_admission_status_rejected_reason = $v;
                    echo "$('select[name=student_others_ethnicity]').val('".$ethnicity_id."');"; 
                
                }else
                if($k=="student_others_ethnicity" && preg_match("/[a-zA-Z]/", $v)==0){

                    echo "$('select[name=student_others_ethnicity]').val('".$v."');"; 
                
                } else
                if($k=="student_nationality" && preg_match("/[a-zA-Z]/", $v)==1){
                    //echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                    $nationality_id = $this->country->get_ID_by_name($v);
                    //$student_admission_status_rejected_reason = $v;
                    echo "$('select[name=student_nationality]').val('".$nationality_id."');"; 
                
                }else
                if($k=="student_nationality" && preg_match("/[a-zA-Z]/", $v)==0){

                    echo "$('select[name=student_nationality]').val('".$v."');"; 
                
                } else
                if($k=="student_country_of_birth" && preg_match("/[a-zA-Z]/", $v)==1){
                    //echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                    $country_id = $this->country->get_ID_by_name($v);
                    //$student_admission_status_rejected_reason = $v;
                    echo "$('select[name=student_country_of_birth]').val('".$country_id."');"; 
                
                }else
                if($k=="student_country_of_birth" && preg_match("/[a-zA-Z]/", $v)==0){

                    echo "$('select[name=student_country_of_birth]').val('".$v."');"; 
                
                }               
                else echo "$('select[name=$k]').val('".$v."');";    


            }
        }
        

        
        
        
                
    ?>    

		
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


 $('.student_formal_education').change(function(){
	 
	 if($(this).val()=="yes"){
		 //alert("yes");
		 $('input[name=student_educational_qualification_highest_academic_qualification]').attr('required',true);
	 }else 
	 if($(this).val()=="no"){
		 //alert("yes");
		 $('input[name=student_educational_qualification_highest_academic_qualification]').attr('required',false);
	 }
	 
 });


    var disabilities = $(".all-disabilities").find('input');

    var total = new Array();

    $.each(disabilities, function() {
        if (this.checked) {
            total.push($(this).val()); 
        };
    });

    disabilities.on('click', function() {
        
        if (this.checked) {
            total.push($(this).val());       
        }else {
            total.pop($(this).val()); 
        }

        if (total.length>0) {
            $(".claim-disabilities").fadeIn();

        }else if(total.length<1) {
            $('input[name=disabilities_allowance]').attr('checked', false);
            $(".claim-disabilities").fadeOut();
        }

    });

    var total_dis_checked = 0;
    
    $.each(disabilities, function() {
        if (this.checked) {
           total_dis_checked++;
        };
    });
    
    if(total_dis_checked>0){
        $('.claim-disabilities').show();
    }else{
        $('.claim-disabilities').hide();    
    }

  


    
});
</script>


                
                <!--<div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
	                	 //echo $message;

                     } ?>
	                </div>
	                
                </div> -->               

                <div id="formbox" class="row">
                    
                    
                    <form role="form"  method="post" action="?action=singleview&do=application&id=<?php echo $ref_id; ?>">
                    
		                <div class="col-lg-12">
			                <div class="row">
                            
				                <div class="col-sm-12 text-right">

                                     <?php if(!empty($priv[7]) || $this->session->userdata('label')=="admin"){ ?><button type="button" name="changestatusbutton" class="btn btn-md btn-warning changestatusbutton"><i class="fa fa-check"></i> Change status</button><?php } ?>

                                     <?php if(!empty($priv[9]) || $this->session->userdata('label')=="admin"){ ?><a href="<?php echo base_url(); ?>index.php/print_student_app/?id=<?php echo $user_data['id']; ?>" class="btn btn-md btn-primary "><i class="fa fa-print"></i> Print</a><?php } ?>
                         			<?php if(!empty($priv[8]) || $this->session->userdata('label')=="admin"){ ?><button type="submit" class="btn btn-md btn-success "><i class="fa fa-save"></i> Update </button><?php } ?>
					             </div>	   
				             </div> 
                             <!--Start admission status information -->
                             <div class="divider"></div>  
                             <div class="form-group">
                               <h4><i class="fa fa-eye "></i> Admission Details </h4>
                               <p class="divider"></p>
                             </div> 
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Application No : </label>
                                </div>
                                    <div class="col-sm-4 ">
                                        <?php echo $student_application_reference_no; ?>
                                    </div>
                             </div>				             
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Admission Status : </label>
                                </div>
                                <div class="col-sm-4 ">
                                        <?php echo $student_admission_status_for_staff; ?>
                                </div>
                             </div>
                             <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_for_staff=="Rejected"){   ?>
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Rejected Reason : </label>
                                </div>
                                <div class="col-sm-4 " style="color:#f00;font-weight:bold;">
                                        <?php echo $student_admission_status_rejected_reason; ?>
                                </div>
                             </div>                             
                             <?php } ?>
                             <div class="form-group clearfix">
                                <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Submission date : </label>
                                </div>
                                <div class="col-sm-4 ">
                                        <?php echo $student_app_submitted_datetime; ?>
                                </div>
                             </div>
                             <!--end admission status information-->
                             <div class="divider"></div>  
				             <div class="form-group">
				               <h4><i class="fa fa-user "></i> Personal Details </h4>
				               <p class="divider"></p>
				             </div>    
		                        <div class="form-group clearfix">
		                            
		                            <div class="col-sm-2 no-pad-left col-md-offset-1">
		                            	<label>Name : </label>
		                        	</div>
		                        	<div class="col-sm-4 ">
		                        		<?php echo ucwords(strtolower($fullname)); ?>
		                        	</div>
		                        	
		                        </div>
                                <div class="form-group clearfix">
                                    
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                        <label>Email : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                    <input type="text" name="student_email" class="form-control" readonly="readonly" />
                                    </div>
                                    
                                </div>
                                <div class="form-group clearfix">  
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Date Of Birth : </label>
                                    </div> 

                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control birth-date" name="student_date_of_birth" value="" placeholder="dd/mm/yyyy" />
	                                </div>
                                </div>      
                                <div class="form-group clearfix"> 
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Gender <small class="red-link">*</small> : </label>
                                    </div>
                                   
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_gender"  class="form-control" required>
                                    	<option value="">Please select</option>
                                        <?php 
                                            foreach($gender_list as $g => $g_value) { ?>
                                            
                                        	   <option value="<?=$g_value['id']?>"><?=$g_value['name']?></option>
                                            
                                         <?php  } ?>
                                    </select>
                                    </div>
                                </div>    		                        
                                <div class="form-group clearfix">  
                                	<div class="col-sm-2 no-pad-left col-md-offset-1">
		                            <label>Nationality <small class="red-link">*</small> : </label>
		                            </div>
                                    
		                            <div class="col-sm-4 no-pad-right">
		                            <select name="student_nationality"  class="form-control" required>
		                           <!--This part will came from database--> 
								   	<option selected="" value="">Please Select</option>
                                    <?php foreach($country_list as $c => $country) {?>
                                        <option value="<?=$country['id']?>"><?=$country['country_name']?></option>
                                    <?php } ?>

                                      
		                           <!--End of this nationality part--> 
		                            </select>
		                            </div>
		                        </div><!-- end of Nationality selection -->	

                                <div class="form-group clearfix"> 
                                	<div class="col-sm-2 no-pad-left col-md-offset-1">
                                     <label>Country of Birth <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
		                            <select name="student_country_of_birth"  class="form-control" required>
                                     <!--This part will came from database--> 
								   	 <option selected="" value="">Please Select</option>
                                     <?php foreach($country_list as $c => $country) {?>
                                        <option value="<?=$country['id']?>"><?=$country['country_name']?></option>
                                    <?php } ?>
                                       
		                             <!--End of this nationality part--> 
		                            </select><!-- end of country selection -->
		                            </div>
                                </div>

                                <div class="form-group clearfix"> 
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Marital Status <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-5 no-pad-right">
 
                                        <?php
                                        $i=0;
                                        foreach($marital_list as $k=>$v){
                                            if($i==0){ $checked = "checked='checked'"; }else{ $checked = ""; }
                                            echo'
                                                    <div class="radio  radio-info  radio-inline">
                                                    <input id="RadioGroup1_'.$i.'" type="radio" required '.$checked.' value="'.$v['id'].'" name="student_marital_status"> <label for="RadioGroup1_'.$i.'"> '.$v['name'].' </label> 
                                                    </div>                                          
                                            ';
                                            $i++;
                                        }
                                        ?>                                        

                                    </div>
                                </div>
                                <div class="form-group">
				               		<p class="divider"></p>
				               		<h4><i class="fa fa-envelope "></i> Contact Details </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="form-group clearfix">
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Home Phone : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <input type="text" class="form-control" name="student_home_phone" value="" placeholder="home phone ex. +440121212..." />
                                    </div>
                                </div>  
                                <div class="form-group clearfix">
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Mobile Phone <small class="red-link">*</small> : </label>  
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
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
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_address_line_1" value="" placeholder="Address 1" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Address 2 : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" name="student_address_address_line_2" value="" placeholder="Address 2" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>State/County : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" name="student_address_state_province_region" value="" placeholder="State or County " />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Postal code <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_postal_zip_code" value="" placeholder="post code" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>City <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_city" value="" placeholder="City" />
	                                    </div>
	                                </div>  
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                    <label>Country <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_country" value="" placeholder="Country" />
	                                    </div>
	                                </div> 
                                </div> 
                                <div class="course-info">   
                                <div class="form-group">
                                	<p class="divider"></p>
				               		<h4><i class="fa fa-book "></i> Proposed Course </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="msg"></div>

				             	<div class="form-group clearfix">
                                
	                                   <div class="col-sm-4 col-xs-3 no-pad col-md-offset-1">
	                                    <label>Semester<small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4  col-xs-7 no-pad-right">   
	                                     <select name="student_semister"  class="form-control" required>
                                    	<option value="">Please select</option>
                                    	<?php foreach ($semesterlist as $semester_id => $name): ?>
                                    	<option  value="<?php echo $semester_id; ?>"><?php echo $name; ?></option>
                                    	<?php endforeach;?>
                                    	</select>       
	                                    </div>
	                                    <div class="col-sm-1   col-xs-1">
	                                    	<img class="loading" src="<?php echo base_url();?>images/loading.png" alt="">
	                                    </div>
	                                </div>
	                               <div class="course-box">
                                           <div class="form-group clearfix">
                                        
                                               <div class="col-sm-4 col-xs-3 no-pad col-md-offset-1">
                                                <label>Course <small class="red-link">*</small> : </label>
                                                </div>
                                                <div class="col-sm-4  col-xs-7 no-pad-right">   
                                                 <select name="student_course"  class="form-control" required>
                                                <option value="">Please select</option>
                                                <?php $courselist=$this->course->get_all();?>
                                                <?php foreach ($courselist as $course): ?>
                                                <option  value="<?php echo $course['id']; ?>"><?php echo $course['course_name']; ?></option>
                                                <?php endforeach;?>
                                                </select>       
                                                </div>
                                                <div class="col-sm-1   col-xs-1">
                                                    <img class="loading" src="<?php echo base_url();?>images/loading.png" alt="">
                                                </div>
                                            </div>
	                               </div> <!--end of course box ajax wrapper-->
                                 <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>How are you funding your education at London Churchill College? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_funding_type"  class="form-control" >
                                          <option value="n/a">Please select</option>
                                          <option value="Private">Independently/Private</option>
                                          <option value="Funding Body">Funding Body</option>
                                          <option value="Sponsor">Sponsor</option>
                                          <option value="Student Loan">Student Loan</option>
                                          <option value="Other">Other</option>  
                
                                    </select>
                                    </div>
                                </div> 
                                <div id="fundingoption">
                                <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>If your funding is through Student Finance England, please choose from the following. Have you applied for the proposed course? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_student_loan_applied_for_the_proposed_course"  class="form-control" >
                                          <option value="n/a">Please select</option>
                                          <option value="no">No</option>
                                          <option value="yes">Yes</option>
                                    </select>
                                    </div>
                                </div>  
                                </div>
                                <div id="fundingoption2">
                                <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>Are you already in receipt of funds? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_already_in_receipt_of_funds"  class="form-control" >
                                          <option value="no">No</option>
                                          <option value="yes">Yes</option>
                                    </select>
                                    </div>
                                </div>
                                </div>
                                <div id="fundingoption3">
                                <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>Please type other fundings <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <input type="text" name="student_funding_type_other"  class="form-control" >
                                    </div>
                                </div>
                                </div>                                     
				             	</div>
				             	 <!--this part came from the database -->
				             	<div class="education-qulification"> 
				             	<div class="form-group">
				             		<p class="divider"></p>
				               		<h4><i class="fa fa-mortar-board "></i> Education Qualification </h4>
				               		<p class="divider"></p>
				             	</div>
				             	
				             	<div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>Do you have any formal academic qualification? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name=""  class="form-control student_formal_education" required>
                                    	<option value="">Please select</option>
                                    	<option value="yes">Yes</option>
                                    	<option value="no">No</option>
                                    </select>
                                    </div>
                                </div> 
	                                <div class="qualification-details">
				             		<div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Highest Academic Qualification : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_highest_academic_qualification" value="" placeholder="Qualification" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Awarding Body : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_awarding_body" value="" placeholder="Awarding Body" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Subjects : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_subjects" value="" placeholder="subjects" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Results : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_educational_qualification_results" value="" placeholder="results" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                    <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Date Of Award : </label>
	                                    </div> 
	                                    
	                                    <div class="col-sm-4 no-pad-right">
                                        <input type="text" class="form-control  employment-date" name="student_educational_qualification_award_date" value="" placeholder="mm/yyyy" />
	                                    </div>
	                                    
	                                </div>                                
	                                </div><!--End of .qualification-details-->
				             	</div> <!--End of education qualification-->    
				             	<div class="employment-history"> 
				             	<div class="form-group">
				             		<p class="divider"></p>
				               		<h4><i class="fa fa-briefcase "></i> Employment History </h4>
				               		<p class="divider"></p>
				             	</div>
				             	<div class="form-group clearfix">
                                    <div class="col-sm-4 no-pad col-md-offset-1 ">
                                     <label>What is your current employment status? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_employment_history_current_employment_status"  class="form-control" required>
                                    	<option value="n/a">Please select</option>
                                    	<option value="Part Time">Part Time</option>
										<option value="Fixed Term">Fixed Term</option>
										<option value="Contractor">Contractor</option>
										<option value="Zero Hour">Zero Hour</option>
										<option value="Seasonal">Seasonal</option>
										<option value="Agency or Temp">Agency or Temp</option>
										<option value="Consultant">Consultant</option>
										<option value="Office Holder">Office Holder</option>
										<option value="Volunteer">Volunteer</option>
										<option value="Unemployed">Unemployed</option>
                                    </select>
                                    </div>
                                </div>
	                                <div class="employment-info">
	                                <div class="col-md-offset-1"><p style="color: #4d4d4d;"> <small class="red-link">*</small> If you have been employed in any way, in the past one year, please fill the field below.</p></div>
	                                <div class="clearfix"></div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Company Name, Address & Phone No : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_employment_history_company" value="" placeholder="Company Name, Address & Phone No" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Position : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_employment_history_position" value="" placeholder="Position" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Start Date : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control employment-date" name="student_employment_history_start_date" value="" placeholder="mm/yyyy" />
	                                    </div>
	                                </div>            
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>End Date : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control employment-date" name="student_employment_history_end_date" value="" placeholder="mm/yyyy" />
	                                    </div>
	                                </div> 
	                                <div class="form-group clearfix">
	                                    <label>Reference : </label>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Contact Name : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_job_reference_contact_name" value="" placeholder="Contact Name" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Position : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control" name="student_job_reference_position" value="" placeholder="Position" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Phone : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control " name="student_job_reference_phone" value="" placeholder="Phone" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Email : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control " name="student_job_reference_email" value="" placeholder="Email" />
	                                    </div>
	                                </div>
	                                <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Company Name & Address : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control " name="student_job_reference_company_name_address" value="" placeholder="Company Name & Address" />
	                                    </div>
	                                </div>
	                                </div> <!--End of .employment-info-->  
				             	</div> <!--End of .employment-history-->  
				             	<div class="others"> 
				             	<div class="form-group">
				             	    <p class="divider"></p>
				               		<h4><i class="fa fa-cubes "></i> Others </h4>
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
	                                <div class="form-group clearfix">
	                                    
	                                    <div class="col-sm-5">
	                                    </div>

	                                    <div class="col-sm-7 all-disabilities">
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

                                    </div><!--End of .disabilities-info-->

	                             </div> 

	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Ethnicity <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="student_others_ethnicity"  class="form-control" required>
                                    	<option value="">Please select</option>
                                    	<?php 
                                            foreach($ethnicity_list as $k=>$v) {
                                                echo '<option value="'.$v['id'].'">'.$v['name'].'</option>';
                                            }
                                        ?>
											<!-- <option value="White British">White British</option>
											<option value="White (other)">White (other)</option>
											<option value="Indian">Indian</option>
											<option value="Pakistani">Pakistani</option>
											<option value="Bangladeshi">Bangladeshi</option>
											<option value="White Irish">White Irish</option>
											<option value="Mixed Race">Mixed Race</option>
											<option value="Black Caribbean">Black Caribbean</option>
											<option value="Black African">Black African</option>
											<option value="Chinese">Chinese</option>
											<option value="Other Asian (Non-Chinese)">Other Asian (Non-Chinese)</option>
											<option value="Black Others">Black Others</option>
											<option value="Other">Other</option> -->
                                    	</select>
                                    	</div>
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
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad col-md-offset-1">
	                                    <label>Declaration <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-7 no-pad-right">
                                         <div class="checkbox text-justify checkbox-success"><input id="checkbox1d" type="checkbox" checked="checked" required name="declaration"><label for="checkbox1d"> I confirm that the information in this form is Correct and Factual to the best of my knowledge. I am responsible to keep abreast of the <a href="<?php echo $settings["college_terms"];?>" target="_blank"> Terms & Conditions </a> and the College policies and agree to abide by them. I've read the College's <a href="<?php echo $settings["college_terms"];?>" target="_blank"> Terms and Conditions</a> and other Legal Policies and agree to follow them during my entire course of study.</label>
                                         </div>          
                                    	</div>
	                             </div>
	                             
				             	</div> <!--End of .others-->                   
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		    <p class="divider"></p>
		           			<div class="col-sm-4">
                				
	                		</div>
			                <div  class="col-sm-8 text-right">
                                     <?php if(!empty($priv[7]) || $this->session->userdata('label')=="admin"){ ?><button type="button" name="changestatusbutton" class="btn btn-md btn-warning changestatusbutton"><i class="fa fa-check"></i> Change status</button><?php } ?>
                                     <?php if(!empty($priv[9]) || $this->session->userdata('label')=="admin"){ ?><a href="<?php echo base_url(); ?>index.php/print_student_app/?id=<?php echo $user_data['id']; ?>" class="btn btn-md btn-primary "><i class="fa fa-print"></i> Print</a><?php } ?>
                                     <?php if(!empty($priv[8]) || $this->session->userdata('label')=="admin"){ ?><button type="submit" class="btn btn-md btn-success "><i class="fa fa-save"></i> Update </button><?php } ?>
					        </div>	 
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        <div class="clearfix"></div>
               </form>
           
               

            </div> <!--End of #formbox-->
            
                <!-- Modal -->
                <div class="modal fade" id="myApplicationStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Change Application Status</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group statuschangeslabel">
                       <label for="formstatus "> Change aplication current status : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="changestatus" class="formstatus form-control" >
                            <option <?php if($student_admission_status_for_staff=="New") echo "selected=selected "?> value="New">New</option>
                            <option <?php if($student_admission_status_for_staff=="Review") echo "selected=selected "?> value="Review">Review</option>
                            <option <?php if($student_admission_status_for_staff=="Awaiting Documents") echo "selected=selected "?> value="Awaiting Documents">Awaiting Documents</option>
                            <option <?php if($student_admission_status_for_staff=="Processing") echo "selected=selected "?> value="Processing">Processing</option>
                            <option <?php if($student_admission_status_for_staff=="Refer to academic department") echo "selected=selected "?> value="Refer to academic department">Refer to academic department</option>
                            <option <?php if($student_admission_status_for_staff=="Accepted") echo "selected=selected "?> value="Accepted">Accepted</option>
                            <option <?php if($student_admission_status_for_staff=="Rejected for review") echo "selected=selected "?> value="Rejected for review">Rejected for review</option>
                            <option <?php if($student_admission_status_for_staff=="Rejected") echo "selected=selected "?> value="Rejected">Rejected</option>
                            <option <?php if($student_admission_status_for_staff=="Discarded") echo "selected=selected "?> value="Discarded">Discarded</option>
                        </select>
                        </div>
                        <div class="form-group stafflist">
                       <label for="formstatus"> Staff name : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="staffview" name="student_admission_status_review_staff_id" class="formstatus form-control" >
                            <option value="">Please select a staff</option>
                        </select>
                        </div>
						
                        <div class="form-group rejected-reason-list">
                       <label for="reasonList"> Rejected Reason : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="reasonList" name="student_admission_status_rejected_reason" class="reasonList form-control" >
                            <option value="">Please select a reason</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Failed Interview") echo "selected=selected "?> value="Failed Interview">Failed Interview</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Shortage of Document") echo "selected=selected "?> value="Shortage of Document">Shortage of Document</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Wrong Information") echo "selected=selected "?>  value="Wrong Information">Wrong Information</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Lack of Qualification") echo "selected=selected "?>  value="Lack of Qualification">Lack of Qualification</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Unavailable for Communication") echo "selected=selected "?>  value="Unavailable for Communication">Unavailable for Communication</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Failure in English Test") echo "selected=selected "?>  value="Failure in English Test">Failure in English Test</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Previous Bad Records") echo "selected=selected "?>  value="Previous Bad Records">Previous Bad Records</option>                            
                        </select>
                        </div> 
												<div class="form-group">
                          <label for="hesa_reason">Hesa Reason</label>
                          <select name="student_status_admission_hesa_reason_id" class="form-control" required>
                            <option value="">Please Select</option>
                            <?php if(!empty($hesa_rsnend)) {?>
                            <?php foreach($hesa_rsnend as $k=>$v) {?>
                              <option <?php echo ( !empty($student_information) && ($student_information["student_status_admission_hesa_reason_id"] == $v['id'])) ? "selected" : "" ?> value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php } ?>
                            <?php } ?>
                            
                            
                          </select>            
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" name="changebuttonstate" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-check"></i> Change</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     

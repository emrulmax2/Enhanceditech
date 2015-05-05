 <link rel="stylesheet" type="text/css" href="http://services.postcodeanywhere.co.uk/css/captureplus-2.20.min.css?key=gy26-rh34-cf82-wd85" /><script type="text/javascript" src="http://services.postcodeanywhere.co.uk/js/captureplus-2.20.min.js?key=gy26-rh34-cf82-wd85"></script>
<script type="text/javascript">

$(document).ready(function(){

    var disabilities = $(".all-disabilities").find('input');
    $(".claim-disabilities").hide();
    var total = new Array();
    disabilities.on('click', function() {
        // console.log($(this).val());
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

    <?php
    	$formal_academic_qfy = 0;
        if($user_data && is_array($user_data)){
            foreach($user_data as $k=>$v){
            
                if($k!="student_marital_status") echo "$('input[name=$k]').val('".tinymce_decode($v)."');";    

                if($k=="student_address_address_line_1" && $v!="")
                echo "$('.address-details').fadeIn();";
                if($k=="student_educational_qualification_highest_academic_qualification" && $v!="") {
                echo "$('.qualification-details').fadeIn();"; 
                echo "$('.student_formal_education').val('yes');";
                
                }else if($k=="student_educational_qualification_highest_academic_qualification" && $v=="") { echo "$('.student_formal_education').val('no');";}
                if($k=="student_funding_type" && $v=="Student Loan")
                echo "$('#fundingoption').fadeIn();";
                if($k=="student_student_loan_applied_for_the_proposed_course" && $v=="yes")
                echo "$('#fundingoption2').fadeIn();";
                
                if($k=="student_employment_history_current_employment_status"  && ($v =="Part Time" || $v=="Fixed Term" || $v=="Zero Hour" || $v=="Seasonal" || $v == "Agency or Temp" || $v=="Volunteer") )
                echo "$('.employment-info').fadeIn();";
                if($k=="student_others_disabilities" && $v!="no") {
                 echo "$('.disabilities-info').fadeIn();";   
                echo "$('.student_others_disabilities_on').val('yes');";
                }
                if($k=="student_others_marketing_info_referred_by" && $v=="agent_referred") {
                 echo "$('.agent-claim').fadeIn();";   
                
                }
                if($k=="student_others_marketing_info_referred_by" && $v=="student_referred") {
                 echo "$('.reffered-claim').fadeIn();";   
                
                }
                if($k=="student_marital_status"){
					echo "$('input:radio[name=$k][value=$v]').attr('checked',true);";
                }
                
                                                                 
                
            }
            foreach($user_data as $k=>$v){
            
                if($k=="student_others_disabilities" && $v!="0" && $v != 'no' && $v != "") {
                    //var_dump("dfdf"); die();
                    
                    if(strpos($v,",")>0) {
                      $disibilites = explode(',',$v);
                    } else {
                      $disibilites = unserialize(stripslashes_deep($v));
                    }

                    $total_dis=count($disibilites);
                
                        foreach ($disibilites as $disibility): ?>
                        var i=0;
                        $.each($(".disabilities-info").find('input:checkbox'),function(){
                            if($(this).val() == "<?php echo $disibility; ?>") {
                                //this.checked = true;
                                i++;
                                $(this).attr("checked","checked");
                            }
                            
                        });
                         if(i < <?php echo $total_dis; ?>) {
                         $('.othertext').val("<?php echo $disibility; ?>");
                         }
                       <?php    
                    endforeach;
                
                 
                }else 
                if($k=="student_others_disabilities" && ($v == 'no' || $v == '0' || $v == "") ){
                    //var_dump("expression"); die();

                    echo "$('.student_others_disabilities_on').val('no');";
                    echo"$('.disabilities-info').hide();";

                }else 
                if($k=="disabilities_allowance" && $v == 'yes'){

                	echo "$(\".claim-disabilities\").show();";
					echo "$('input[name=disabilities_allowance]').attr('checked', true);";	
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
                else echo "$('select[name=$k]').val('".tinymce_decode($v)."');";    

				echo"$('input:checkbox[name=declaration]').attr('checked',true);";
            }
            echo "$('input').attr('disabled', 'disabled');";    
            echo "$('select').attr('disabled', 'disabled');"; 
        }        
    ?>
    

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

 $('select[name="student_others_marketing_info_referred_by"]').change(function(){
     
     if($(this).val()=="agent_referred"){
         //alert("yes");
         $('select[name=agent_id]').attr('required',true);
     }else 
     if($(this).val()=="student_referred"){
         //alert("yes");
         $('input[name=student_others_marketing_info_referred_name]').attr('required',true);
     } else {
        $('select[name=agent_id]').attr('required',false);
        $('input[name=student_others_marketing_info_referred_name]').attr('required',false);
     }
     
 }); 

$('#userform').submit(function(e) {

    var disabilities_check = $('select[name="student_others_disabilities_on"]').val();

    if(disabilities_check == "yes") {
        var disabilitiesArray = new Array();    
         $('.check-disibilities').each(function() {
                if($(this).is(":checked"))
                disabilitiesArray.push($(this).val());

        });
        
        if(disabilitiesArray.length <1){
            $("p#show-disability-error").show().text("Please select atleast 1 disabilities!");
           return false;
        } else if(disabilitiesArray.length >= 1) {
            $("p#show-disability-error").hide();
        }
    }
     

    var declaration = $('#checkbox1d').is(":checked");
    if(declaration == false) {
        $("p#show-dec-error").show().text("Please check Declaration field");
        return false;
    } else {
        $("p#show-dec-error").hide();
    }
    
    
});




  
    
});
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
                		
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
	                	 echo $message;

                     } ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" id="userform" method="post">
                    
		                <div class="col-lg-12">
			                <div class="row">
				                <div class="col-sm-6">
		                			<a class="" href="<?php echo base_url(); ?>index.php/user_dashboard.html"><i class="fa fa-arrow-left"></i> Back to List</a>
				                </div>
								<?php if($ref!="edit") { ?>
				                <div class="col-sm-6 text-right">
                         			<button type="submit" class="btn btn-md btn-success "><i class="fa fa-database"></i> Save Application</button>
		           		 			<button type="reset" class="btn btn-md btn-danger "><i class="fa fa-refresh"></i> Reset</button>
					             </div>	
								<?php } ?>								 
				             </div> 
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
                                        <?php echo $fullname;?>
                                    </div>
                                    
                                </div>		                        

                                <div class="form-group clearfix">  
                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Date Of Birth : </label>
                                    </div> 

                                    <div class="col-sm-4 no-pad-right">
	                                     <input type="text" class="form-control birth-date" name="student_date_of_birth" value="" placeholder="dd/mm/yyyy" required readonly/>
	                                </div>
                                </div>      
                                <div class="form-group clearfix"> 
                                   <div class="col-sm-2 no-pad-left col-md-offset-1">
                                    <label>Gender <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                    
                                    <?php echo $this->student_gender->get_name_by_id($gender)?>
                                    <input type="hidden" name="student_gender" value="<?php echo $gender; ?>">
                                    

                                     
                                    </div>
                                </div>    		                        
                                <div class="form-group clearfix">  
                                	<div class="col-sm-2 no-pad-left col-md-offset-1">
		                            <label>Nationality <small class="red-link">*</small> : </label>
		                            </div>
		                            <div class="col-sm-4 no-pad-right">
		                            <select name="student_nationality"  class="form-control" required>
                                        <option value="">Please select</option>
		                                <!--This part is comming from database--> 
                                        <?php
										foreach($country_list as $k=>$v){
											echo "<option value='".$v['id']."'>".$v['country_name']."</option>";	
										}	
                                        ?>
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
                                        <option value="">Please select</option>
                                     <!--This part comming from database--> 
                                        <?php
										foreach($country_list as $k=>$v){
											echo "<option value='".$v['id']."'>".$v['country_name']."</option>";	
										}	
                                        ?>
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

                                
	                                <div class="form-group clearfix">
	                                    <div class="col-sm-2 no-pad-left col-md-offset-1">
	                                      <label>Address 1 <small class="red-link">*</small> : </label>
	                                    </div>                                    
										<div class="col-sm-4 no-pad-right">
	                                      <input type="text" class="form-control" required name="student_address_address_line_1" value="" placeholder="Address 1" />
	                                    </div>
								<?php if($ref!="edit") { ?>
                                
                                    <!--<div class="col-sm-2  no-pad-right">
                                      <input type="button" class="form-control btn btn-primary" name="manaul_poscode" value="View Address" />
                                  
                                    </div> -->
							  
								<?php } ?>		                                    
	                                </div>
	                                <div class="address-details"> 
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
                                    	<option value="<?php echo $semester_id; ?>"><?php echo $name; ?></option>
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
	                               </div>
                                 <div class="form-group clearfix">
                                   <div class="col-sm-4 no-pad col-md-offset-1">
                                    <label>How are you funding your education at London Churchill College? <small class="red-link">*</small> : </label>
                                    </div>
                                    <div class="col-sm-4 no-pad-right">
                                     <select name="student_funding_type"  class="form-control" required>
                                          <option value="">Please select</option>
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
                                          <option value="">Please select</option>
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
                                    	<option value="">Please select</option>
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
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-7">
	                                    <p id="show-disability-error"></p>
                                        
                                    </div>
                                    <div class="form-group clearfix">
	                                    <div class="col-sm-5">
	                                    </div>
                                        <div class="col-sm-7 all-disabilities">
                                            
                                        


                                             
                                        <?php
											$j=1;
											foreach($disability_list as $k=>$v){

												echo'<div class="checkbox checkbox-primary">';
												echo'<input type="checkbox" class="check-disibilities" id="disicheckbox'.$j.'" value="'.$v['id'].'" name="student_others_disabilities[]">';
												echo'<label for="disicheckbox'.$j.'">'.$v['name'].'</label>';								
												echo'</div>';	
										
												
												$j++;
													
											}											                                             	
                                        ?>                                             
                                             
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
                                </div>
	                             </div> <!--End of .disabilities-info-->  
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>Ethnicity <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="student_others_ethnicity"  class="form-control" required>
                                    	<option value="">Please select</option>
<?php
										foreach($ethnicity_list as $k=>$v){
											echo "<option value='".$v['id']."'>".$v['name']."</option>";	
										}	
?>
                                    	</select>
                                    	</div>
	                             </div>
	                             <div class="form-group clearfix">
	                                   <div class="col-sm-4 no-pad  col-md-offset-1">
	                                    <label>How did you know about the college? <small class="red-link">*</small> : </label>
	                                    </div>
	                                    <div class="col-sm-4 no-pad-right">
	                                    <select name="student_others_marketing_info_referred_by"  class="form-control" required>
                                    	<option value="">Please select</option>
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
                                            <p id="show-dec-error"></p>
                                        <div class="checkbox text-justify checkbox-success">
                                            <input id="checkbox1d" type="checkbox"  name="declaration"><label for="checkbox1d"> I confirm that the information in this form is Correct and Factual to the best of my knowledge. I am responsible to keep abreast of the <a href="<?php echo $settings["college_terms"];?>" target="_blank"> Terms & Conditions </a> and the College policies and agree to abide by them. I've read the College's <a href="<?php echo $settings["college_terms"];?>" target="_blank"> Terms and Conditions</a> and other Legal Policies and agree to follow them during my entire course of study.</label>
                                         </div>          
                                        </div>
	                             </div>
	                             
				             	</div> <!--End of .others-->                   
		           		
		           		
		           				<div class="clearfix"></div>
		           				
		           				    <p class="divider"></p>
		           					<div class="col-sm-4">
                						<a class="" href="<?php echo base_url(); ?>index.php/user_dashboard.html"><i class="fa fa-arrow-left"></i> Back to List</a>
	                				</div>
									<?php if($ref!="edit") { ?>
					                <div  class="col-sm-8 text-right">
                         					<button type="submit" class="btn btn-md btn-success "><i class="fa fa-database"></i> Save Application</button>
		           		 					<button type="reset" class="btn btn-md btn-danger "><i class="fa fa-refresh"></i> Reset</button>
							        </div>	
									<?php }?>							
					                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
					                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                				            
		                        <div class="clearfix"></div>		           		
		           		
		           		
		           		
		           		    </form>
		           		
		           		</div>

		           		

               
               
                 <div class="row">

	                
                </div>              
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
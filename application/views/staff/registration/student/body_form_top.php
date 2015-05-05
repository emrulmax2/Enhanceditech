<link rel="stylesheet" type="text/css" href="http://services.postcodeanywhere.co.uk/css/captureplus-2.20.min.css?key=gy26-rh34-cf82-wd85" /><script type="text/javascript" src="http://services.postcodeanywhere.co.uk/js/captureplus-2.20.min.js?key=gy26-rh34-cf82-wd85"></script>
<?php $student_admission_status = ""; $student_application_reference_no=""; $student_app_submitted_datetime=""; ?>
<script type="text/javascript">

$(document).ready(function(){
 // $(".claim-disabilities").hide();
  $('.disabled-allowance').hide(); 
 <?php
 //var_dump($user_data); 
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
                     }else if($student_admission_status_for_staff=="Offer placed"){
                      $student_admission_status = "Offer placed";
                     }else if($student_admission_status_for_staff=="Offer accepted"){
                      $student_admission_status = "Offer accepted";
                     }
                
                } else if($k=="student_application_reference_no") {
                   $student_application_reference_no =$v;
                } else if($k=="student_app_submitted_datetime") {
                   $student_app_submitted_datetime =$v;
                } else if($k=="student_others_disabilities") {
                    // echo"alert('".$v."');";
                    // if($v=="no"){
                    //     echo "$('.student_others_disabilities_on').val('no');";    
                    // }
                       // $disibilities =explode(',',$v);
                   //     $disibilities =unserialize($v);
                   //     echo $disibilities;
                   // if($disibilities[0]=="no") {
                   //   echo "$('.student_others_disabilities_on').val('no');";  
                   // } 
                }
                
                
                
                
                
            }

        }
        




?> 

	$(document).on('click','button[name=btnUpload]',function(e){
		
		e.preventDefault();
	    var orginalfilename     = new Array();
		$(".documentfile").each(function() {
		        orginalfilename.push($(this).val());
		});
		
		var url = getURL()+'/index.php/ajaxall/';
		var linkUrl = getURL();
		var data="";

		  $.post(url, {action: 'uploadProfilePhoto', id: '<?php echo $_GET['id']; ?>', filepath: 'uploads/files/'+orginalfilename[0]  },

		    function(msg){ 

		        
					$('img.profileimage').attr('src', linkUrl+'/'+msg);
					
					$("#uploadstudentphoto").modal('toggle');
					//alert(linkUrl+'/'+msg);

		    });	    	
		
	});
	
	
	
	//// GETTING PROFILE PHOTO IF EXIST
	  var url = getURL()+'/index.php/ajaxall/'; var linkUrl = getURL();
	  $.post(url, {action: 'getStudentProfilePhoto', id: '<?php echo $_GET['id']; ?>' },

		function(msg){
				//alert(msg); 
		       if(msg.length>0)
				$('img.profileimage').attr('src', linkUrl+'/'+msg);

		});	
	 
 
 
 
 
 
    <?php
        if($user_data && is_array($user_data)){
            foreach($user_data as $k=>$v){

                if($k=="student_address_address_line_1" && $v!="")
                echo "$('.address-details').fadeIn();";
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
                if($k=="student_admission_status_rejected_reason" && !empty($v)){
                	$student_admission_status_rejected_reason = $v;
					
                }if($k=="student_admission_status_for_staff" && $v=="Rejected"){
                	echo "$('.rejected-reason-list').show();";	
					
                }
                if($k=="student_marital_status"){
					       echo "$('input:radio[value=$v]').attr('checked',true);";
                }
                if($k=="kin_address"){
                 echo "$('textarea[name=kin_address]').val('".tinymce_decode($v)."');";
                }
                
                if($k!="student_course" && $k!="kin_address" && $k!="student_semister" && $k!="student_marital_status" && $k!="disabilities_allowance")   echo "$('input[name=$k]').val('".tinymce_decode($v)."');";
                
                
                
                
                
            }
            foreach($user_data as $k=>$v){
                if($k=="student_others_disabilities" && $v!="0" && $v != 'no' && $v !="") {
                  // var_dump($v);
                // $disibilites = explode(',',$v);
                // $disibilites = unserialize(base64_decode($v));
                if(strpos($v,",")>0) {
                      $disibilites = explode(',',$v);
                  } else {
                      $disibilites = unserialize(stripslashes_deep($v));
                  }
                // $disibilites = @unserialize($v);
                // echo "string";
                // var_dump($disibilites);

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
                if( $k=="student_others_disabilities" && ($v=="0" || $v == 'no' || $v == "") ) {
                  // echo"alert('".$v."');";
                  echo"$('select.student_others_disabilities_on').val('no');";
                  echo"$('.disabilities-info').hide();";            
                }else
                if($k=="disabilities_allowance" && $v == 'yes' ){

                  echo "$('input[name=disabilities_allowance]').attr('checked', true);"; 
                  echo "$('.disabled-allowance').show();";
                  
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
                if($k=="student_nationality" && preg_match("/[a-zA-Z]/", $v)==1){
                    //echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                    $nationality_id = $this->country->get_ID_by_name($v);
                    //$student_admission_status_rejected_reason = $v;
                    echo "$('select[name=student_nationality]').val('".$nationality_id."');"; 
                
                }else
                if($k=="student_nationality" && preg_match("/[a-zA-Z]/", $v)==0){

                    echo "$('select[name=student_nationality]').val('".$v."');"; 
                
                }else
                if($k=="student_country_of_birth" && preg_match("/[a-zA-Z]/", $v)==1){
                    //echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                    $country_of_birth_id = $this->country->get_ID_by_name($v);
                    //$student_admission_status_rejected_reason = $v;
                    echo "$('select[name=student_country_of_birth]').val('".$country_of_birth_id."');"; 
                
                }else
                if($k=="student_country_of_birth" && preg_match("/[a-zA-Z]/", $v)==0){

                    echo "$('select[name=student_country_of_birth]').val('".$v."');"; 
                
                } else
                if($k=="student_others_ethnicity" && preg_match("/[a-zA-Z]/", $v)==1){
                    //echo"alert('".preg_match("/[a-zA-Z]/", $v)."');";
                    $ethnicity_id = $this->student_others_ethnicity->get_ID_by_name($v);
                    //$student_admission_status_rejected_reason = $v;
                    echo "$('select[name=student_others_ethnicity]').val('".$ethnicity_id."');"; 
                
                }else
                if($k=="student_others_ethnicity" && preg_match("/[a-zA-Z]/", $v)==0){

                    echo "$('select[name=student_others_ethnicity]').val('".$v."');"; 
                
                }                 
                else echo "$('select[name=$k]').val('".$v."');";    


            }
        }

        if(!empty($hesa_domicile_info)) {
          if(!empty($hesa_domicile_info['hesa_domicile_id'])) {
            echo "$('select[name=hesa_domicile_id]').val('".$hesa_domicile_info['hesa_domicile_id']."').attr('selected', 'selected');";  
          }
        }
        
        //if(!empty($hesa_exchind_id)){
            //echo "alert('".$hesa_exchind_id."');";

        //}
        
        if(!empty($hesa_student_information_data)){
            
            if($hesa_student_information_data['hesa_exchind_id']==0) echo "$('select[name=hesa_exchind_id]').val('');";
            else if($hesa_student_information_data['hesa_exchind_id']!=0) echo "$('select[name=hesa_exchind_id]').val('".$hesa_student_information_data['hesa_exchind_id']."');";
            
            if(!empty($hesa_student_information_data['hesa_mode_id']) && $hesa_student_information_data['hesa_mode_id']>0) echo "$('select[name=hesa_mode_id]').val('".$hesa_student_information_data['hesa_mode_id']."');";            
            if(!empty($hesa_student_information_data['hesa_exchind_id']) && $hesa_student_information_data['hesa_exchind_id']>0) echo "$('select[name=hesa_exchind_id]').val('".$hesa_student_information_data['hesa_exchind_id']."');";            
            if(!empty($hesa_student_information_data['hesa_sselig_id']) && $hesa_student_information_data['hesa_sselig_id']>0) echo "$('select[name=hesa_sselig_id]').val('".$hesa_student_information_data['hesa_sselig_id']."');";            
            if(!empty($hesa_student_information_data['uhn_number'])) echo "$('input[name=uhn_number]').val('".$hesa_student_information_data['uhn_number']."');";            
            else if(!empty($uhn_number)) echo "$('input[name=uhn_number]').val('".$uhn_number."');";
            if(!empty($hesa_student_information_data['hesa_heapespop_id']) && $hesa_student_information_data['hesa_heapespop_id']>0) echo "$('select[name=hesa_heapespop_id]').val('".$hesa_student_information_data['hesa_heapespop_id']."');";            
            if(!empty($hesa_student_information_data['hesa_disall_id']) && $hesa_student_information_data['hesa_disall_id']>0) echo "$('select[name=hesa_disall_id]').val('".$hesa_student_information_data['hesa_disall_id']."');";            
            if(!empty($hesa_student_information_data['hesa_locsdy_id']) && $hesa_student_information_data['hesa_locsdy_id']>0) echo "$('select[name=hesa_locsdy_id]').val('".$hesa_student_information_data['hesa_locsdy_id']."');";            
        } 
        

                
    ?>  
 
 
 
 
	createNotification();
    $('input,textarea,select').bind("keyup, blur",function(){
		
		//alert('yes');
		createNotification();	
		
    }); 
 
 
    $('form.search_student_form div.panel-body').toggle();
    $('form.search_student_form div.panel-heading').find("button:submit,button:reset,a").toggle();


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
    
    $('input:checkbox[name=disabilities_allowance]').click(function(){
        
        if($(this).val()=="yes" && $(this).is(':checked')==true) $('.disabled-allowance').show(); 
        else $('.disabled-allowance').hide(); 
        
    });
    
    $('.lockstatusbutton').click(function(){
        
        $('#warningForStudentAccount').modal('show');
        
    });
<?php //var_dump($user_data); ?>   
    $('.student-account-access-confirm-btn').click(function(){
        
            url = getURL()+'/index.php/ajaxall/';
            $.ajax({
               type: "POST",
               data: {student_data_id:'<?php echo $user_data['id']; ?>', action: "changeStudentAccess" },
               url: url,
               success: function(msg){

                 $('#warningForStudentAccount .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php echo current_url(); ?>'; });

                 //alert(msg);
               }
            });         
    });    
 
});


function navigateToinput(name,tag){
	$(tag+'[name='+name+']').focus().parent().addClass('has-error');
	$("html, body").animate({ scrollTop: $(tag+'[name='+name+']').offset().top - 70 }, 1000);
	//createNotification();
}
function createNotification(){
	$('.notification-body').html('');
	$.each($('form#registerglobalinfo, form#registerinfo').find('input,select,textarea'), function(){   
		
		//i++;
		if($(this).attr('name')!="student_others_disabilities[]" && $(this).attr('name')!="student_others_marketing_info_referred_name" && $(this).attr('name')!="student_others_marketing_info_referred_phone" && $(this).attr('name')!="agent_id" && $(this).attr('name')!="student_address_address_line_2" && $(this).attr('name')!="student_address_state_province_region"){
				
			//if($(this).name  $('select[name=student_others_marketing_info_referred_by]').val()=="student_referred" && $(this).attr('name')=="student_others_marketing_info_referred_by"){		
					if($(this).val() == ""){
						var name = $(this).attr('name').toUpperCase().replace(/[_\s]/g, ' ');
						
						$('.notification-body').append("<li class='' ><a href='javascript:void(0)' onclick='navigateToinput(\""+$(this).attr('name')+"\",\""+$(this).prop('tagName')+"\")'><i class='fa fa-exclamation-triangle'></i> "+name+" is empty.</a></li>");
						 
					}

		}
		
		
					/*if($(this).val().length == 0){
						var name = $(this).attr('name').toUpperCase().replace(/[_\s]/g, ' ');
						
						$('.notification-body').append("<li class='' ><a href='#'><i class='fa fa-exclamation-triangle'></i> "+name+" is empty.</a></li>");
						 
					}*/		
		
		
		if(($(this).attr('name')=="student_others_marketing_info_referred_name" || $(this).attr('name')=="student_others_marketing_info_referred_phone") && $('select[name=student_others_marketing_info_referred_by]').val()=="student_referred"){
			
					if($(this).val().length == 0){
						var name = $(this).attr('name').toUpperCase().replace(/[_\s]/g, ' ');
						
						$('.notification-body').append("<li class='' ><a href='javascript:void(0)' onclick='navigateToinput(\""+$(this).attr('name')+"\",\""+$(this).prop('tagName')+"\")'><i class='fa fa-exclamation-triangle'></i> "+name+" is empty.</a></li>");
						 
					}			
		}
		
		
		if(($(this).attr('name')=="agent_id") && $('select[name=student_others_marketing_info_referred_by]').val()=="agent_referred"){
			
					if($(this).val().length == 0){
						var name = $(this).attr('name').toUpperCase().replace(/[_\s]/g, ' ');
						
						$('.notification-body').append("<li class='' ><a href='javascript:void(0)' onclick='navigateToinput(\""+$(this).attr('name')+"\",\""+$(this).prop('tagName')+"\")'><i class='fa fa-exclamation-triangle'></i> "+name+" is empty.</a></li>");
						 
					}			
		}		
		
		
	});
	
}
</script>
<?php

$clean_date = explode("/", $user_data['student_date_of_birth']);

$new_clean_date = $clean_date[0]."-".$clean_date[1]."-".$clean_date[2]; 

?>

                <div id="formbox" class="row">
			     <div class="col-sm-12 no-pad">		                		            
                        <div class="clearfix"></div>

                        <form id="registerglobalinfo" method="post" action="" class='formsreg'>
		                <div class="col-lg-12">
		                                           
					                <div class="text-right">
	                                     <?php if(!empty($priv[7]) || $this->session->userdata('label')=="admin"){ ?><button type="button" name="changestatusbutton" class="btn btn-md btn-warning changestatusbutton"><i class="fa fa-check"></i> Change status</button><?php } ?>
                                         <?php if(!empty($priv[10]) || $this->session->userdata('label')=="admin"){ ?>
                                             <?php if($user_data['student_status']=="active"){ ?><button type="button" data-toggle="tooltip" data-placement="top" title="Student's account is currently unlocked." name="lockstatusbutton" class="btn btn-md btn-success lockstatusbutton"><i class="fa fa-1x fa-unlock"></i></button>
                                             <?php }else if($user_data['student_status']=="inactive"){ ?><button type="button" data-toggle="tooltip" data-placement="top" title="Student's account is currently locked." name="lockstatusbutton" class="btn btn-md btn-danger lockstatusbutton"><i class="fa  fa-1x fa-lock"></i></button>                                        
                                             <?php } ?>
                                         <?php } ?>    
						             </div>	   
					              
					             <div class="clearfix"></div>
	                             <!--Start admission status information -->
	                             <div class="divider"></div>		                
		                

                        		<div class="col-sm-9 no-pad-left">
	                                 <div class="form-group clearfix">
                               			<h4><i class="fa fa-eye "></i> Registration Details </h4>
                               			<p class="divider"></p>
                             		 </div>                                 
                             		 <div class="form-group clearfix">
		                                <div class="col-sm-3">
		                                        <label>Application Ref: </label>
		                                </div>
		                                <div class="col-sm-3 ">
		                                        <?php echo $user_data['student_application_reference_no']; ?>
		                                </div>
		                                <div class="col-sm-2">
		                                        <label>Date of Birth: </label>
		                                </div>
		                                <div class="col-sm-4 ">
		                                        <?php echo $new_clean_date; ?>
		                                </div>	                                    
                             		 </div>
	                                 <div class="divider"></div>
                             		 <div class="form-group clearfix">
		                                <div class="col-sm-3">
                                                <label>Student Name: </label>
                                        </div>
                                        <div class="col-sm-3 ">
                                                <?php echo ucwords(strtolower($fullname)); ?>
                                        </div>    
                                        <div class="col-sm-1">
		                                        <label>Email: </label>
		                                </div>
		                                <div class="col-sm-5">
		                                        <input type="hidden" name="student_email" value="<?php echo $user_data['student_email'];  ?>"><?php echo $user_data['student_email'];  ?>
		                                </div>	                                    
                             		 </div>
                                     <!--Start admission status information -->
                                         <div class="divider"></div>  
                                     
                                         <div class="form-group clearfix">
                                            <div class="col-sm-3">
                                                    <label>Registration Status : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                    <p><b><?php echo $student_admission_status_for_staff;?></b></p>
                                            </div>
                                            <div class="col-sm-3">
                                                    <label>Gender : </label>
                                            </div>
                                            <div class="col-sm-3">
                                                    <p><b><?php echo $this->student_gender->get_name_by_id($user_data['student_gender']);?></b></p>
                                            </div>
                                         </div>
                                     <!--end admission status information-->
	                                 <div class="divider"></div>
                             		 <div class="form-group clearfix">
		                                <div class="col-sm-3">
		                                        <label>Course Name: </label>
		                                </div>
		                                <div class="col-sm-9 ">
	                                                 <select name="student_course"  class="form-control" required>
	                                                <option value="">Please select</option>
	                                                <?php $courselist=$this->course->get_all();?>
	                                                <?php foreach ($courselist as $course): ?>
	                                                <option  value="<?php echo $course['id']; ?>"><?php echo $course['course_name']; ?></option>
	                                                <?php endforeach;?>
	                                                </select>
	                                                
	                                                <input type="hidden" name="student_semister" value="<?php echo $user_data['student_semister']; ?>">
		                                </div>
		                                    
                             		 </div>
                             		 <div class="divider"></div>
                             		 <div class="form-group clearfix">
		                                <div class="col-sm-3">
		                                        <label>Start Date: </label>
		                                </div>
		                                <div class="col-sm-3 ">
		                                        <input type="text" class="form-control date" required name="class_startdate" value="" placeholder="Start Date" />
		                                </div>
		                                <div class="col-sm-3">
		                                        <label>Expected End Date: </label>
		                                </div>
		                                <div class="col-sm-3 ">
		                                        <input type="text" class="form-control date" required name="class_enddate" value="" placeholder="End Date" />
		                                </div>	
                             		 </div>                             	                              	                              	                     	
                             		 <div class="divider"></div>
                             		 <div class="form-group clearfix">
		                                <div class="col-sm-3">
		                                        <label>Date of Application: </label>
		                                </div>
		                                <div class="col-sm-3 ">
		                                        <?php echo $user_data['student_app_submitted_datetime']; ?>
		                                </div>
		                                <div class="col-sm-3">
		                                        <label>Mode: </label>
		                                </div>
		                                <div class="col-sm-3 ">
	                                            <select name="hesa_mode_id"  class="form-control" required>
		                                            <option value="">Please Select</option>
<?php
                                                    if(!empty($hesa_mode_list)){
                                                       foreach($hesa_mode_list as $k=>$v){
                                                            echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
                                                       }
                                                    }                                                        
?>
	                                            </select>										
		                                </div>	
                             		 </div>
                             		 <div class="divider"></div>
                             		 <div class="form-group clearfix">
		                                <div class="col-sm-3">
		                                        <label>Student Type: </label>
		                                </div>
		                                <div class="col-sm-3 ">
	                                            <select name="student_type"  class="form-control" required>
		                                            <option value="">Please Select</option>
		                                            <option value="uk">UK-EU</option>
		                                            <option  value="overseas">Overseas</option>
	                                            </select>	                                
		                                        
		                                </div>
		                                <div class="col-sm-3">
		                                        <label>SSN: </label>
		                                </div>
		                                <div class="col-sm-3 ">
	                                            <input type="text" class="form-control" name="ssn" value="" placeholder="Enter SSN" />										
		                                </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-6" id="check_student_type" style="margin-top:10px;border-radious:4px;"></div>  
                                    <div class="col-sm-6"></div>	
                             		</div>
<!-- Newly Added -->


                                    <div class="divider"></div>
                                    <div class="form-group clearfix">
                                        <div class="col-sm-3">
                                                <label>Exchange Student Type: </label>
                                        </div>
                                        <div class="col-sm-3 ">
                                                <select name="hesa_exchind_id"  class="form-control" required>
                                                    <option value="">Please Select</option>

<?php
                                                    if(!empty($hesa_exchind_list)){
                                                       foreach($hesa_exchind_list as $k=>$v){
                                                            echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
                                                       }
                                                    }                                                        
?>                                                    
                                                    
                                                </select>                                    
                                                
                                        </div>
                                        <div class="col-sm-3">
                                                <label>Student Support eligibility: </label>
                                        </div>
                                        <div class="col-sm-3 ">
                                                <select name="hesa_sselig_id"  class="form-control" required>
                                                    <option value="">Please Select</option>

<?php
                                                    if(!empty($hesa_sselig_list)){   
                                                       foreach($hesa_sselig_list as $k=>$v){
                                                            echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
                                                       } 
                                                    }                                                       
?>                                                    
                                                    
                                                </select>                                    
                                                
                                        </div>
                                    <div class="clearfix"></div>
   
                                    </div> 


                                    <div class="divider"></div>
                                    <div class="form-group clearfix">
                                        <div class="col-sm-3">
                                                <label>UHN Number: </label>
                                        </div>
                                        <div class="col-sm-3 ">
                                            
                                            <input type="text" class="form-control" name="uhn_number" value="" />                                    
                                                
                                        </div>
                                        <div class="col-sm-3">
                                                <label>HEAPES Population: </label>
                                        </div>
                                        <div class="col-sm-3 ">
                                                <select name="hesa_heapespop_id"  class="form-control" required>
                                                    <option value="">Please Select</option>

<?php
                                                    if(!empty($hesa_heapespop_list)){   
                                                       foreach($hesa_heapespop_list as $k=>$v){
                                                            echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
                                                       } 
                                                    }                                                       
?>                                                    
                                                    
                                                </select>                                    
                                                
                                        </div>
                                    <div class="clearfix"></div>
   
                                    </div>
                                    
                                    
                                    <div class="divider"></div>
                                    <div class="form-group clearfix">
                                        <div class="col-sm-3">
                                                <label>Location of Study: </label>
                                        </div>
                                        <div class="col-sm-9">
                                                <select name="hesa_locsdy_id"  class="form-control" required>
                                                    <option value="">Please Select</option>

<?php
                                                    if(!empty($hesa_locsdy_list)){
                                                       foreach($hesa_locsdy_list as $k=>$v){
                                                            echo'<option value="'.$v['id'].'">'.$v['name'].'</option>';    
                                                       }
                                                    }                                                        
?>                                                    
                                                    
                                                </select>                                               
                                        </div>

                                    <div class="clearfix"></div>
   
                                    </div>                                                                        
                                                                       
                                    
                                    
<!-- Newly Added -->                                    
		           						<div class="clearfix"></div>
                            </div>
                            
                            <div class="col-sm-3 no-pad">
                                <div class="image-container margin-bottom-5 ">
                                <a href="#">
                                <?php if($user_data['student_gender']=="1"){  ?>
                                <img width="100%" class="profileimage" src="<?php echo base_url();?>images/user_avatar_default.png">
                                <?php }else{  ?>
                                <img width="100%" class="profileimage" src="<?php echo base_url();?>images/female_avatar_default.png">
                                <?php }  ?>
                                </a>
                                <div class="after">
                                    <div class="centerbox">
                                    <?php if(!empty($staff_privileges_student_admission['std_ad_status']) || $this->session->userdata('label')=="admin"){ ?><button type="button" name="uploadphotobutton" class="btn btn-sm btn-info "  data-toggle="modal" data-target="#uploadstudentphoto"><i class="fa fa-upload"></i> Upload Photo</button><?php } ?>
                                    </div>
                                </div>
                                </div>
                                <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Notifications</h3>
                                </div>
                                    <div class="panel-body">  
                                        <ol class="list-unstyled notification-body">

                                        </ol>                                    
                                        
                                        
                                                                            
                                    </div>
                                </div>                            
                            </div>   
                        </div>
                        </form>
                 </div> <!--End of #formbox-->
                

<?php
				if($dont_upload_photo==0){                	
?>                
                
                <!-- Modal Photo Upload -->
                <div class="modal fade" id="uploadstudentphoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Student Picture</h4>
                      </div>
                      <div class="modal-body">
                          <div class="msg"></div>
                           <div class="form-group">
                          <label class="margin-top-2">Upload Image (<i class="alert-warning">file size no more than 10mb</i>) </label><br/>
                          <label class="margin-top-2">(ex: .jpg,.jpeg and .png) </label><br/>
                              <span class="btn btn-primary fileinput-button">
                                <i class="fa fa-plus"></i>
                                <span>Add Image </span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input id="fileupload" type="file" name="files[]">
                                
                                </span>
                                <br>
                                <br>
                                <!-- The global progress bar -->
                                <div id="progress" class="progress">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <!-- The container for the uploaded files -->
                                <div id="files" class="files">
                                </div>
                                <!-- The container for the uploaded files -->     

                            
                            </div>

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="btnUpload" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->         
                
<?php                
				}// if($dont_upload_photo==0){                
?>                
                <!-- Modal -->
                <div class="modal fade" id="myApplicationStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Change Student Status</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group statuschangeslabel">
                       <label for="formstatus "> Change application current status : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="changestatus" class="formstatus form-control" >
                            <option <?php if($student_admission_status_for_staff=="Accepted") echo "selected=selected ";?> value="Accepted">Accepted</option>
                            <option <?php if($student_admission_status_for_staff=="Offer placed") echo "selected=selected ";?> value="Offer placed">Offer placed</option>
                            <option <?php if($student_admission_status_for_staff=="Offer accepted") echo "selected=selected ";?> value="Offer accepted">Offer accepted</option>
                            <option <?php if($student_admission_status_for_staff=="Offer Rejected") echo "selected=selected ";?> value="Offer Rejected">Offer Rejected</option>
                        </select>
                        </div>
 
												<div class="form-group">
                          <label for="hesa_reason">Hesa Reason</label>
                          <select required name="student_status_admission_hesa_reason_id" class="form-control"  >
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



                <div class="modal fade" id="check_student_type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        
                        <h4 class="modal-title" id="myModalLabel">Error!</h4>
                      </div>
                      <div class="modal-body">
                      
                      Please Select Student Type!
                        
                      </div>
                      
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
                <!-- Modal -->
                <div class="modal fade" id="warningForStudentAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Student Account's Access Confirmation</h4>
                      </div>
                      <div class="modal-body">
                              <div class="output"></div>
                        Are you sure you want to change student account's access?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger student-account-access-confirm-btn">Yes</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                                
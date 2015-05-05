
<script type="text/javascript">

$(document).ready(function(){

		

		//$('.select_all').click(function(){
		
		// if(this.checked==true){
		// 	$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
		// 		this.checked=true;	
				
		// 	});
			
		// }else{
		// 	$.each($('.class-plan-list-body').find('.class-plan-id'),function(){
			
		// 		this.checked=false;	
				
		// 	});			
		// }
		//alert("yes");
	//});

	
	
		var all_std_ad_checked = 0;
		$.each($('.std_ad').find('input:checkbox'), function(){

			if($(this).attr('checked')==true) all_std_ad_checked = all_std_ad_checked+1;
			

		});	

		if(all_std_ad_checked==0) {
			
		$.each($('.std_ad').find('input:checkbox'), function(){

			$(this).attr('disabled', true);
			

		});	
			
		}

		var all_staff_mng_checked = 0;
		$.each($('.staff_mng').find('input:checkbox'), function(){

			if($(this).attr('checked')==true) all_staff_mng_checked = all_staff_mng_checked+1;
			

		});	

		if(all_staff_mng_checked==0) {
			
		$.each($('.staff_mng').find('input:checkbox'), function(){

			$(this).attr('disabled', true);
			

		});	
			
		}

		var all_ses_mng_checked = 0;
		$.each($('.ses_mng').find('input:checkbox'), function(){

			if($(this).attr('checked')==true) all_ses_mng_checked = all_ses_mng_checked+1;
			

		});	

		if(all_ses_mng_checked==0) {
			
		$.each($('.ses_mng').find('input:checkbox'), function(){

			$(this).attr('disabled', true);
			

		});	
			
		}

		var all_course_mng_checked = 0;
		$.each($('.course_mng').find('input:checkbox'), function(){

			if($(this).attr('checked')==true) all_course_mng_checked = all_course_mng_checked+1;
			

		});			

		if(all_course_mng_checked==0) {
			
		$.each($('.course_mng').find('input:checkbox'), function(){

			$(this).attr('disabled', true);
			

		});	
			
		}
		
		var all_course_rel_mng_checked = 0;
		$.each($('.course_rel_mng').find('input:checkbox'), function(){

			if($(this).attr('checked')==true) all_course_rel_mng_checked = all_course_rel_mng_checked+1;
			

		});
		
		if(all_course_rel_mng_checked==0) {
			
		$.each($('.course_rel_mng').find('input:checkbox'), function(){
            
			$(this).prop("disabled", true);
			 ///alert($(this).attr('disabled'));

		});	
			
		}				
		
		


		var all_agent_mng_checked = 0;
		$.each($('.agent_mng').find('input:checkbox'), function(){

			if($(this).attr('checked')==true) all_agent_mng_checked = all_agent_mng_checked+1;
			

		});	

		if(all_agent_mng_checked==0) {
			
		$.each($('.agent_mng').find('input:checkbox'), function(){

			$(this).attr('disabled', true);
			

		});	
			
		}	
	
	
	
	
	
      
	<?php
		if(!empty($staff) && is_array($staff)){
			foreach($staff as $k=>$v){
				if($k=="staff_type" || $k=="staff_status") echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
				
				/*else if($k=="staff_privileges_student_admission"){
					
					
					$exp_std_ad = explode(",",$v);
					$enable_all_std_ad=0;
					if(count($exp_std_ad)>0){$enable_all_std_ad=1;}
					
					
					foreach($exp_std_ad as $a){
						if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
					}
					
				}else if($k=="staff_privileges_staff_management"){
					
					
					$exp_staff_mng = explode(",",$v);
					$enable_all_staff_mng=0;
					if(count($exp_staff_mng)>0){$enable_all_staff_mng=1;}
					
					
					foreach($exp_staff_mng as $a){
						if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
					}
					
				}else if($k=="staff_privileges_agent_management"){
					
					
					$exp_agent_mng = explode(",",$v);
					$enable_all_agent_mng=0;
					if(count($exp_agent_mng)>0){$enable_all_agent_mng=1;}
					
					
					foreach($exp_agent_mng as $a){
						if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
					}
					
				}else if($k=="staff_privileges_semister_management"){
					
					
					$exp_ses_mng = explode(",",$v);
					$enable_all_ses_mng=0;
					if(count($exp_ses_mng)>0){$enable_all_ses_mng=1;}
					
					
					foreach($exp_ses_mng as $a){
						if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
					}
					
					
				}else if($k=="staff_privileges_course_management"){
					
					
					$exp_course_mng = explode(",",$v);
					$enable_all_course_mng=0;
					if(count($exp_course_mng)>0){$enable_all_course_mng=1;}
					
					
					foreach($exp_course_mng as $a){
						if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
					}
					
				}else if($k=="staff_privileges_course_relation_management"){
					
					
					$exp_course_rel_mng = explode(",",$v);
					$enable_all_course_rel_mng=0;
					if(count($exp_course_rel_mng)>0){$enable_all_course_rel_mng=1;}
					
					
					foreach($exp_course_rel_mng as $a){
						if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
					}					
					
					
				}else if($k=="staff_privileges_report_management"){
					
					
					$exp_report_mng = explode(",",$v);
					$enable_all_report_mng=0;
					if(count($exp_report_mng)>0){$enable_all_report_mng=1;}
					
					
					if(count($exp_report_mng)>1){
						foreach($exp_report_mng as $a){
							if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
						}
					}else{
						
						echo"$('input:checkbox[name=$v]').attr('checked','checked');";
					}
					
					
				}else if($k=="staff_privileges_inbox_management"){
					
					
					$exp_inbox_mng = explode(",",$v);
					$enable_all_inbox_mng=0;
					if(count($exp_inbox_mng)>0){$enable_all_inbox_mng=1;}
					
					
					if(count($exp_inbox_mng)>1){
						foreach($exp_inbox_mng as $a){
							if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
						}
					}else{
						
						echo"$('input:checkbox[name=$v]').attr('checked','checked');";
					}
					
					
				}else if($k=="staff_privileges_exam_management"){
					
					
					$exp_exam_mng = explode(",",$v);
					$enable_all_exam_mng=0;
					if(count($exp_exam_mng)>0){$enable_all_exam_mng=1;}
					
					
					if(count($exp_exam_mng)>1){
						foreach($exp_exam_mng as $a){
							if($a > "")echo"$('input:checkbox[name=$a]').attr('checked','checked');";
						}
					}else{
						
						echo"$('input:checkbox[name=$v]').attr('checked','checked');";
					}
					
					
					*/
				else if($k=="staff_privileges" && !empty($v)){ 
				
				    

				    $staff_privileges = unserialize($v);
				     
				     foreach($staff_privileges as $a=>$b){
						 
						 foreach($b as $c=>$d){
							 if($d=="on"){
								 echo"$('.privil_".str_replace("'", "", $a)."_".$c."').attr('checked',true);";
							 }
						 }
				     }
				     
				     
				}   																														
					
				else if($k=="staff_status") echo "$('select[name=$k]').val('".tinymce_decode($v)."');";										
				
				else if($k!="password") echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
			
			
			}// end of foreach
			
/*			if($enable_all_std_ad==1) echo"$.each($('.std_ad').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";	
			if($enable_all_staff_mng==1) echo"$.each($('.staff_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";
			if($enable_all_agent_mng==1) echo"$.each($('.agent_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";
			if($enable_all_ses_mng==1) echo"$.each($('.ses_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";
			if($enable_all_course_mng==1) echo"$.each($('.course_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";
			if($enable_all_course_rel_mng==1) echo"$.each($('.course_rel_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";
			if($enable_all_report_mng==1) echo"$.each($('.report_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";
			if($enable_all_inbox_mng==1) echo"$.each($('.inbox_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";
			if($enable_all_exam_mng==1) echo"$.each($('.exam_mng').find('input:checkbox'), function(){ $(this).attr('disabled', false); });";*/			
			
		}
		
		
		    	
	?>    


<?php
		
		if($ref=="add"){		
?>	
	


		
<?php
		
		}//if($ref=="add"){		
?>

	

	$.each($(".select_area"),function(){
				
		// var total_check_box = $(this).find(".select_area_check_box input:checkbox");
		// var total_check_box_checked = $(this).find(".select_area_check_box input:checkbox").attr('checked');
		// alert(total_check_box.length);
		// alert(total_check_box_checked.length);
		// // if(total_check_box == total_check_box_checked) {
		// // 	$(this).find('input.select_all').attr('checked', true);
		// // }

		var num_check_box = 0;
		$.each($(this).find(".select_area_check_box input:checkbox"),function(){
			
			num_check_box++;
		});
		var num_checked = 0;
		$.each($(this).find(".select_area_check_box input:checkbox"),function(){
			
			if(this.checked==true) num_checked++; 
		});
		
		if(num_check_box==num_checked){
			$(this).find("input.select_all").attr("checked",true);
		}		
		
	});

	$('input.select_all').click(function(){

		if(this.checked==true){
			
			$.each($(this).closest('.select_area').find(".select_area_check_box input:checkbox"),function(){
				
				this.checked = true;
				
			});
			
		} 
		else {
			
			$.each($(this).closest('.select_area').find(".select_area_check_box input:checkbox"),function(){
				
				this.checked = false;
				
			});			
		}
		
		
	});
	
	initializePanelColapsible();
	
	$('select[name=staff_type]').change(function(){
		
		if($(this).val()=="tutor"){
			 //alert("yes");
			$('.select_area input:checkbox').attr('disabled',true);
			/*$.each($('.select_area_check_box').find('input:checkbox'),function(){
				
				$(this).attr('disabled',true);
			});	*/
			$('.report_management').find('input:checkbox').attr('disabled',true);
			$('.masterinbox_management').find('input:checkbox').attr('disabled',true);
			$('.account_payment_upload_management').find('input:checkbox').attr('disabled',true);
			$('.class_routine_area input:checkbox').attr('disabled',false);
			$('.result_management_area input:checkbox').attr('disabled',false);
			$('.management-panel-body').slideUp();	
			$('.student-admission-panel-body').slideUp();		
			$('.registration-panel-body').slideUp();		
			$('.registration-panel-body').slideUp();		
			$('.students-management-panel-body').slideUp();		
			$('.letter-management-panel-body').slideUp();		
			$('.report-management-panel-body').slideUp();		
			$('.master-inbox-management-panel-body').slideUp();		
			
		}else{
			
			$('.select_area input:checkbox').attr('disabled',false);
			/*$.each($('.select_area_check_box').find('input:checkbox'),function(){
				
				$(this).attr('disabled',true);
			});	*/
			$('.report_management').find('input:checkbox').attr('disabled',false);
			$('.masterinbox_management').find('input:checkbox').attr('disabled',false);
			$('.account_payment_upload_management').find('input:checkbox').attr('disabled',false);
/*			$('.class_routine_area input:checkbox').attr('disabled',false);
			$('.result_management_area input:checkbox').attr('disabled',false);*/
			$('.management-panel-body').slideDown();	
			$('.student-admission-panel-body').slideDown();		
			$('.registration-panel-body').slideDown();		
			$('.registration-panel-body').slideDown();		
			$('.students-management-panel-body').slideDown();		
			$('.letter-management-panel-body').slideDown();		
			$('.report-management-panel-body').slideDown();		
			$('.master-inbox-management-panel-body').slideDown();			
		}
		
		
	});
	
	
		if($('select[name=staff_type]').val()=="tutor"){
			 //alert("yes");
			$('.select_area input:checkbox').attr('disabled',true);
			/*$.each($('.select_area_check_box').find('input:checkbox'),function(){
				
				$(this).attr('disabled',true);
			});	*/
			$('.report_management').find('input:checkbox').attr('disabled',true);
			$('.masterinbox_management').find('input:checkbox').attr('disabled',true);
			$('.account_payment_upload_management').find('input:checkbox').attr('disabled',true);
			$('.class_routine_area input:checkbox').attr('disabled',false);
			$('.result_management_area input:checkbox').attr('disabled',false);
			$('.management-panel-body').slideUp();	
			$('.student-admission-panel-body').slideUp();		
			$('.registration-panel-body').slideUp();		
			$('.registration-panel-body').slideUp();		
			$('.students-management-panel-body').slideUp();		
			$('.letter-management-panel-body').slideUp();		
			$('.report-management-panel-body').slideUp();		
			$('.master-inbox-management-panel-body').slideUp();		
			
		}else{
			
			$('.select_area input:checkbox').attr('disabled',false);
			/*$.each($('.select_area_check_box').find('input:checkbox'),function(){
				
				$(this).attr('disabled',true);
			});	*/
			$('.report_management').find('input:checkbox').attr('disabled',false);
			$('.masterinbox_management').find('input:checkbox').attr('disabled',false);
			$('.account_payment_upload_management').find('input:checkbox').attr('disabled',false);
/*			$('.class_routine_area input:checkbox').attr('disabled',false);
			$('.result_management_area input:checkbox').attr('disabled',false);*/
			$('.management-panel-body').slideDown();	
			$('.student-admission-panel-body').slideDown();		
			$('.registration-panel-body').slideDown();		
			$('.registration-panel-body').slideDown();		
			$('.students-management-panel-body').slideDown();		
			$('.letter-management-panel-body').slideDown();		
			$('.report-management-panel-body').slideDown();		
			$('.master-inbox-management-panel-body').slideDown();			
		}	
	
	

    
});



function initializePanelColapsible(){
    
    $.each($('.panel-colapsible'),function(){

        var head = $(this).html();
        $(this).html('<div class="col-xs-6">'+head+'</div><div class="col-xs-6 text-right"><a href="javascript:void(0);" class="panel-colapsible-toggle"><i class="fa fa-chevron-up"></i></a></div><div class="clearfix"></div>');
                
    });
    
    $('.panel-colapsible-toggle').click(function(){        
        $(this).closest('.panel').find('.panel-body').slideToggle(function(){
            
            if($(this).is(":hidden")==true){
                //alert("yes");
                $(this).closest('.panel').find('.panel-colapsible-toggle').html('<i class="fa fa-chevron-down"></i>');
            }else{
                $(this).closest('.panel').find('.panel-colapsible-toggle').html('<i class="fa fa-chevron-up"></i>');
            }
        });
        
    });    
    
}

</script>


                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
                		
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post" id="agentaddform">

                    
		                <div class="col-lg-12">
                        <div class="row">
		                <div class="col-sm-6">
		                <h4><i class="fa fa-file-text "></i> Staff Form </h4>
                        </div>
                        <div class="col-sm-6 text-right">

                        <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>/index.php/staff_management/?action=list"><i class="fa fa-arrow-circle-left"></i> Back to List</a>
                               <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                               
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                          </div>
                          <div class="divider"></div>
                                <div class="row  margin-bottom-2">                               
                                <div class="form-group col-sm-offset-1">
                                    <div class="col-md-2">
                                    <label>Staff name <small class="red-link">*</small> :</label>
                                    </div>
                                    <div class="col-md-4">
                                    <input class="form-control" type="text" placeholder="Enter Staff Name"  name="staff_name" required>
                                    </div>
                                </div>
                                </div>
                                <div class="row  margin-bottom-2">                              
		                            <div class="form-group col-sm-offset-1 ">
		                                <div class="col-md-2">
                                            <label>Nick name:</label>
                                        </div>
                                        <div class="col-md-4">
		                                    <input class="form-control" type="text" name="staff_nick_name"  placeholder="Enter Staff Nick Name"  >
		                                </div>
                                    </div>
                                </div>
		                        <div class="row  margin-bottom-2">                               
                                    <div class="form-group col-sm-offset-1 ">
                                        <div class="col-md-2">
		                                    <label>Type of staff <small class="red-link">*</small> :</label>
                                        </div>
                                        <div class="col-md-4">
		                                    <select name="staff_type" class="form-control" required>
		                            	        <option value="">Please Select</option>
		                            	        <option value="staff">staff</option>
		                            	        <option value="admin">admin</option>		                            
		                            	        <option value="tutor">tutor</option>		                            
		                                    </select>
		                                </div>
                                    </div>
                                </div>		                        
                                
                                <div class="divider"></div>
                                <h4><i class="fa fa-lock"></i> Add New Password</h4>
                                <div class="divider"></div>
                                
                                <div class="row  margin-bottom-2">                              
                                    <div class="form-group col-sm-offset-1 ">
                                        <div class="col-md-2">
                                            <label>Password <small class="red-link">*</small> :</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control password" type="password" name="password">
                                        </div>
                                    </div>
                                </div>   		                        
                                <div class="row  margin-bottom-2">                              
                                    <div class="form-group col-sm-offset-1 ">
                                        <div class="col-md-2">
                                            <label>Repassword:</label>
                                            <label class="retypepassword"></label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="password" class="form-control repassword" name="repassword" >
                                        </div>
                                    </div>
                                </div>                                
                                <div class="divider"></div>	                        		                        		                        		                        		                                     <div class="row  margin-bottom-2">                              
                                    <div class="form-group col-sm-offset-1 ">
                                        <div class="col-md-2">
                                            <label>Staff email <small class="red-link">*</small> :</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control " name="staff_email"  placeholder="Please enter your email" required >
                                        </div>
                                    </div>
                                </div>                        
                                 <div class="row  margin-bottom-2"> 
                                    <div class="form-group col-sm-offset-1 ">
                                        <div class="col-md-2">
		                                    <label>Status :</label>
                                        </div>
                                        <div class="col-md-4">
		                                    <select class="form-control" name="staff_status">
		                            	        <option value="">Please Select</option>
		                            	        <option value="active">active</option>
		                            	        <option value="inactive">inactive</option>		                            
		                                    </select>		                            
                                        </div>
                                    </div>
                                </div>      
		                        <!--<div class="form-group">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<h3 class="panel-title">Staff Privileges</h3>
										</div>
											<div class="panel-body">
											
													<div class="panel panel-default">
													  <div class="panel-heading"><div class="checkbox checkbox-primary"><input name="std_ad" id="checkbox100" type="checkbox" class="form-control" onclick="makeAllStdAdEnable(this.checked, 'std_ad')"><label for="checkbox100">Student Admission</label></div></div>
													  <div class="panel-body std_ad">
														    <div class="well">
														    	<div class="col-sm-4">Student Application</div>														    	
														    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o"><input name="std_ad_view_app" id="checkbox1" type="checkbox" class="form-control"><label for="checkbox1">View</label><input name="std_ad_edit_app" id="checkbox2" type="checkbox" class="form-control"><label for="checkbox2">Edit</label></div>														    	
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	
														    	<div class="col-sm-6">Communication</div>														    	
														    	<div class="col-sm-6 checkbox checkbox-primary margin-top-bottom-o"><input name="std_ad_comm" id="checkbox3" type="checkbox" class="form-control"><label for="checkbox3">On</label></div>														    	
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	
														    	<div class="col-sm-6">English Test Result</div>														    	
														    	<div class="col-sm-6 checkbox checkbox-primary margin-top-bottom-o"><input name="std_ad_english" id="checkbox4" type="checkbox" class="form-control"><label for="checkbox4">On</label></div>														    	
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	
														    	<div class="col-sm-6">Interview Result</div>														    	
														    	<div class="col-sm-6 checkbox checkbox-primary margin-top-bottom-o"><input name="std_ad_interview" id="checkbox5" type="checkbox" class="form-control"><label for="checkbox5">On</label></div>														    	
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	
														    	<div class="col-sm-6">Change Status</div>														    	
														    	<div class="col-sm-6 checkbox checkbox-primary margin-top-bottom-o"><input name="std_ad_status" id="checkbox6" type="checkbox" class="form-control"><label for="checkbox6">On</label></div>													    	
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	 	
														    	<div class="col-sm-6">Notes</div>														    	
														    	<div class="col-sm-6 checkbox checkbox-primary margin-top-bottom-o"><input name="std_ad_notes" id="checkbox7" type="checkbox" class="form-control"><label for="checkbox7">On</label></div>														    	
														    	<div class="clearfix"></div>														    	 	
														    </div>
														    <div class="well">
														    
														    	<div class="col-sm-6">Archive</div>														    	
														    	<div class="col-sm-6 checkbox checkbox-primary margin-top-bottom-o"><input name="std_ad_archive" id="checkbox8" type="checkbox" class="form-control"><label for="checkbox8">On</label></div>														    	
														    	<div class="clearfix"></div>														    
														    </div>														    														    														    														    														    														    
													  </div>
													</div>
													
													<div class="panel panel-default">
													  <div class="panel-heading"><div class="checkbox checkbox-primary"><input name="staff_mng" id="checkbox99" type="checkbox" class="form-control" onclick="makeAllStdAdEnable(this.checked, 'staff_mng')"><label for="checkbox99">Staff Management</label></div></div>
													  <div class="panel-body staff_mng">
														    	
														    	<div class="col-sm-12 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o">
														    	<input name="staff_mng_add" id="checkbox9" type="checkbox" class="form-control"><label for="checkbox9">Add</label>
														    	<input name="staff_mng_edit" id="checkbox10" type="checkbox" class="form-control"><label for="checkbox10">Edit</label>
														    	</div>
														    														    														    														    														    														    
													  </div>
													</div>
													
													<div class="panel panel-default">
													  <div class="panel-heading"><div class="checkbox checkbox-primary"><input name="agent_mng" id="checkbox98" type="checkbox" class="form-control" onclick="makeAllStdAdEnable(this.checked, 'agent_mng')"><label for="checkbox98">Agent Management</label></div></div>
													  <div class="panel-body agent_mng">
														    	
														    	<div class="col-sm-12 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o">
														    	<input name="agent_mng_add" id="checkbox11" type="checkbox" class="form-control"><label for="checkbox11">Add</label>
														    	<input name="agent_mng_edit" id="checkbox12" type="checkbox" class="form-control"><label for="checkbox12">Edit</label>
														    	</div>
														    														    														    														    														    														    
													  </div>
													</div>																																						

													<div class="panel panel-default">
													  <div class="panel-heading"><div class="checkbox checkbox-primary"><input  name="ses_mng" id="checkbox97" type="checkbox" class="form-control" onclick="makeAllStdAdEnable(this.checked, 'ses_mng')"><label for="checkbox97">Semester Management</label></div></div>
													  <div class="panel-body ses_mng">
														    	
														    	<div class="col-sm-12 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o">
														    	<input name="ses_mng_add" id="checkbox13" type="checkbox" class="form-control"><label for="checkbox13">Add</label>
														    	<input name="ses_mng_edit" id="checkbox14" type="checkbox" class="form-control"><label for="checkbox14">Edit</label>
														    	</div>
														    														    														    														    														    														    
													  </div>
													</div>	

													
													<div class="panel panel-default">
													  <div class="panel-heading"><div class="checkbox checkbox-primary"><input name="course_mng" id="checkbox96" type="checkbox" class="form-control"  onclick="makeAllStdAdEnable(this.checked, 'course_mng')"><label for="checkbox96">Course Management</label></div></div>
													  <div class="panel-body course_mng">
														    	
														    	<div class="col-sm-12 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o">
														    	<input name="course_mng_add" id="checkbox15" type="checkbox" class="form-control"><label for="checkbox15">Add</label>
														    	<input name="course_mng_edit" id="checkbox16" type="checkbox" class="form-control"><label for="checkbox16">Edit</label>
														    	</div>
														    														    														    														    														    														    
													  </div>
													</div>	
													
													<div class="panel panel-default">
													  <div class="panel-heading"><div class="checkbox checkbox-primary"><input name="course_rel_mng" id="checkbox95" type="checkbox" class="form-control"  onclick="makeAllStdAdEnable(this.checked, 'course_rel_mng')"><label for="checkbox95">Course Relation Management</label></div></div>
													  <div class="panel-body course_rel_mng">
														    	
														    	<div class="col-sm-12 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o">
														    	<input name="course_rel_mng_add" id="checkbox20" type="checkbox" class="form-control"><label for="checkbox20">Add</label>
														    	<input name="course_rel_mng_edit" id="checkbox21" type="checkbox" class="form-control"><label for="checkbox21">Edit</label>
														    	</div>
														    														    														    														    														    														    
													  </div>
													</div>													
													
													<div class="panel panel-default">
													  <div class="panel-heading">Report</div>
													  <div class="panel-body report_mng">
														    	
														  <div class="col-sm-12 checkbox checkbox-primary margin-top-bottom-o">
														  <input name="report_mng" id="checkbox17" type="checkbox" class="form-control"><label for="checkbox17">On</label>
														  </div>
														    														    														    														    														    														    
													  </div>
													</div>																									

													
													<div class="panel panel-default">
													  <div class="panel-heading">  Master Inbox</div>
													  <div class="panel-body inbox_mng">
														    	
														  <div class="col-sm-12 checkbox checkbox-primary margin-top-bottom-o">
														  <input name="inbox_mng" id="checkbox18" type="checkbox" class="form-control"><label for="checkbox18">On</label>
														  </div>
														    														    														    														    														    														    
													  </div>
													</div>
													
													<div class="panel panel-default">
													  <div class="panel-heading">  Exam Paper</div>
													  <div class="panel-body exam_mng">
														    	
														  <div class="col-sm-12 checkbox checkbox-primary margin-top-bottom-o">
														  <input name="exam_mng" id="checkbox19" type="checkbox" class="form-control"><label for="checkbox19">On</label>
														  </div>
														    														    														    														    														    														    
													  </div>
													</div>																										
											
											
											</div>
									</div>	                            
		                        </div>-->	
		                        
		                        
		                        
		                        
<!----------------------------------------     --------------------------------------------->

<?php
	
	$i=1;
?>

		                        <div class="form-group">
									<div class="panel panel-primary">
										<div class="panel-heading">
											<h3 class="panel-title">Staff Privileges</h3>
										</div>
											<div class="panel-body">
											
													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">
													  		Management		
													  </div>
													  <div class="panel-body management-panel-body">
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
																		
															    			<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

															    			<label for="<?php echo"checkbox".$i; ?>">Course</label>
																		
														    		</div>														    	
														    		<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o course_management select_area_check_box">
														    				<input name="privil[course_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
														    				<input name="privil[course_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
														    				<input name="privil[course_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
														    				<input name="privil[course_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
														    		</div>														    	
														    		<div class="clearfix"></div>
														    	</div>															    	
														    </div>
														    
														    <div class="well">
																<div class="select_area">
															    	<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Semester</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o select_area_check_box semester_management">
															    			<input name="privil[semester_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[semester_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[semester_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[semester_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
														    	</div>														    	
														    	<div class="clearfix"></div>														    	
														    </div>
														    
														    <div class="well">
																<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Course Relation</label>
															    	</div>
														    															    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o course_relation_management select_area_check_box">
															    			<input name="privil[course_relation_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_relation_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[course_relation_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_relation_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[course_relation_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_relation_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[course_relation_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_relation_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Course Module Relation</label>
															    	</div>

															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o course_module_relation_management select_area_check_box">
															    			<input name="privil[course_module_relation_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_module_relation_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[course_module_relation_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_module_relation_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[course_module_relation_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_module_relation_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[course_module_relation_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_course_module_relation_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
																<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Gender</label>
															    	</div>

														    															    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o gender_management select_area_check_box">
															    			<input name="privil[gender_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_gender_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[gender_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_gender_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[gender_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_gender_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[gender_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_gender_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>    	
														    	<div class="clearfix"></div>														    	
														    </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Marital Status</label>
                                                                    </div>

                                                                                                                                
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o marital_status_management select_area_check_box">
                                                                            <input name="privil[marital_status_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_marital_status_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
                                                                            <input name="privil[marital_status_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_marital_status_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
                                                                            <input name="privil[marital_status_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_marital_status_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
                                                                            <input name="privil[marital_status_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_marital_status_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
                                                                    </div>
                                                                </div>        
                                                                <div class="clearfix"></div>                                                                
                                                            </div>                                                            
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Title</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o title_management select_area_check_box">
															    			<input name="privil[title_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_title_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[title_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_title_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[title_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_title_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[title_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_title_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
																<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Ethnicity</label>
															    	</div>

															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o others_ethnicity_management select_area_check_box">
															    			<input name="privil[others_ethnicity_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_ethnicity_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[others_ethnicity_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_ethnicity_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[others_ethnicity_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_ethnicity_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[others_ethnicity_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_ethnicity_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Country</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o country_management select_area_check_box">
															    			<input name="privil[country_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_country_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[country_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_country_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[country_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_country_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[country_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_country_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Disabilities Management</label>
															    	</div>
														    										    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o others_disabilities_management select_area_check_box">
															    			<input name="privil[others_disabilities_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_disabilities_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[others_disabilities_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_disabilities_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[others_disabilities_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_disabilities_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[others_disabilities_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_others_disabilities_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Status Management</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o status_management select_area_check_box">
															    			<input name="privil[status_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_status_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[status_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_status_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[status_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_status_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[status_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_status_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Currency Management</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o currency_management select_area_check_box">
															    			<input name="privil[currency_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_currency_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[currency_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_currency_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[currency_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_currency_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[currency_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_currency_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Awarding Body</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o awarding_body_management select_area_check_box">
															    			<input name="privil[awarding_body_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_awarding_body_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[awarding_body_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_awarding_body_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[awarding_body_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_awarding_body_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[awarding_body_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_awarding_body_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    														    
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Agent</label>
															    	</div>
														    												    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o agent_management select_area_check_box">
															    			<input name="privil[agent_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_agent_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[agent_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_agent_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[agent_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_agent_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[agent_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_agent_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    														    													    														    
													    														    													    														    														    														    														    
														    														    														    														    														    														    														    
													  </div>
													</div>
													
<!--													<div class="panel panel-default">
														  	<div class="panel-heading panel-colapsible">
														  		

																	<label for="<?php //echo"checkbox".$i; ?>">Student Admission</label>
														  		
														  	</div>
													  		<div class="panel-body admission_mng student-admission-panel-body">

															<div class="select_area">


														    	<div class="col-sm-4 checkbox checkbox-primary">
															  		<input id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																	<label for="<?php //echo"checkbox".$i; ?>">Select All</label>
														  		</div>

														    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o student_admission_management select_area_check_box">
														    			<input name="privil[student_admission_management][0]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_0 form-control"><label for="<?php //echo"checkbox".$i; ?>">Search</label>
														    			<input name="privil[student_admission_management][1]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_1 form-control"><label for="<?php //echo"checkbox".$i; ?>">View Application/Print/Update</label>
														    			<input name="privil[student_admission_management][2]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_2 form-control"><label for="<?php //echo"checkbox".$i; ?>">Communication</label>
														    			<input name="privil[student_admission_management][3]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_3 form-control"><label for="<?php //echo"checkbox".$i; ?>">Upload Document</label>
														    			<input name="privil[student_admission_management][4]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_4 form-control"><label for="<?php //echo"checkbox".$i; ?>">Notes</label>
														    			<input name="privil[student_admission_management][5]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_5 form-control"><label for="<?php //echo"checkbox".$i; ?>">Archive</label>
                                                                        <input name="privil[student_admission_management][6]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_6 form-control"><label for="<?php //echo"checkbox".$i; ?>">Login to Student Panel</label>
														    			<input name="privil[student_admission_management][7]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_7 form-control"><label for="<?php //echo"checkbox".$i; ?>">Change Status</label>
														    	</div>
														    </div>
														    														    														    														    														    														    
													  	</div>

													</div>-->
                                                    
                                                    <div class="panel panel-default">
                                                      <div class="panel-heading panel-colapsible">Student Admission</div>
                                                      <div class="panel-body letter-management-panel-body">
                                                                
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Search</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[student_admission_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                       
                                                                            <input name="privil[student_admission_management][10]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_10 form-control"><label for="<?php echo"checkbox".$i; ?>">Excel Report</label>                                                                       
                                                                                                                                                   
                                                                                                                                                                                            
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>

                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Application</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[student_admission_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                                                                                                                                                                                                                   
                                                                            <input name="privil[student_admission_management][7]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_7 form-control"><label for="<?php echo"checkbox".$i; ?>">Change Status</label>
                                                                            <input name="privil[student_admission_management][8]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_8 form-control"><label for="<?php echo"checkbox".$i; ?>">Update</label>
                                                                            <input name="privil[student_admission_management][9]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_9 form-control"><label for="<?php echo"checkbox".$i; ?>">Print</label>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>                                                            

                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Communication</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[student_admission_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                                                                                                                                                                                                                   
                                                                            <input name="privil[student_admission_management][15]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_15 form-control"><label for="<?php echo"checkbox".$i; ?>">Send Message</label>                                                                                                                                                                                                                                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>                                                           
                                                            
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Upload Document</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[student_admission_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                                                                                                                                                                                                                   
                                                                            <input name="privil[student_admission_management][11]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_11 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>                                                                                                                                                                                                                                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Notes</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[student_admission_management][4]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_4 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                                                                                                                                                                                                                   
                                                                            <input name="privil[student_admission_management][12]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_12 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>                                                                                                                                                                                                                                                                   
                                                                            <input name="privil[student_admission_management][13]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_13 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>                                                                                                                                                                                                                                                                   
                                                                            <input name="privil[student_admission_management][14]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_14 form-control"><label for="<?php echo"checkbox".$i; ?>">Follow-up</label>                                                                                                                                                                                                                                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>

                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Archive</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[student_admission_management][5]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_5 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                                                                                                                                                                                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div> 

                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Login to Student Panel</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[student_admission_management][6]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_student_admission_management_6 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                                                                                                                                                                                                                   
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>                                                            

                                                            

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                                      </div>
                                                    </div>                                                    
                                                    
                                                    
                                                    
													
<!--													<div class="panel panel-default">
														
														  	<div class="panel-heading panel-colapsible" >
														  		<label for="<?php //echo"checkbox".$i; ?>">Registration</label>
														  	</div>
													  
													  		<div class="panel-body registration_mng registration-panel-body">

													  		<div class="select_area">

													  			<div class="col-sm-4 checkbox checkbox-primary">
															  		<input id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																	<label for="<?php //echo"checkbox".$i; ?>">Select All</label>
														  		</div>
														    	
														    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o registration_management select_area_check_box">
														    			<input name="privil[registration_management][0]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_0 form-control"><label for="<?php //echo"checkbox".$i; ?>">Search</label>
														    			<input name="privil[registration_management][1]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_1 form-control"><label for="<?php //echo"checkbox".$i; ?>">Personal Information/View/Update/Print</label>
														    			<input name="privil[registration_management][2]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_2 form-control"><label for="<?php //echo"checkbox".$i; ?>">Education & Qualification</label>
														    			<input name="privil[registration_management][3]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_3 form-control"><label for="<?php //echo"checkbox".$i; ?>">Communication</label>
														    			<input name="privil[registration_management][4]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_4 form-control"><label for="<?php //echo"checkbox".$i; ?>">Upload Document</label>
														    			<input name="privil[registration_management][5]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_5 form-control"><label for="<?php //echo"checkbox".$i; ?>">Notes</label>
                                                                        <input name="privil[registration_management][6]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_6 form-control"><label for="<?php //echo"checkbox".$i; ?>">Archive</label>
														    			<input name="privil[registration_management][7]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_7 form-control"><label for="<?php //echo"checkbox".$i; ?>">Change Status</label>

														    	</div>
														    </div>
														    														    														    														    														    														    
													  </div>
													</div>-->
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    <div class="panel panel-default">
                                                      <div class="panel-heading panel-colapsible">Registration</div>
                                                      <div class="panel-body letter-management-panel-body">
                                                                
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Search</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
                                                                            <input name="privil[registration_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>                                                                       
                                                                            <input name="privil[registration_management][8]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_8 form-control"><label for="<?php echo"checkbox".$i; ?>">Excel Report</label>                                                                       
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Profile</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o signatory_management select_area_check_box">
                                                                        <input name="privil[registration_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[registration_management][7]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_7 form-control"><label for="<?php echo"checkbox".$i; ?>">Change Status</label>
                                                                        <input name="privil[registration_management][9]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_9 form-control"><label for="<?php echo"checkbox".$i; ?>">Update</label>
                                                                        <input name="privil[registration_management][10]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_10 form-control"><label for="<?php echo"checkbox".$i; ?>">Profile Lock/Unlock</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>                                                                                                                            
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Education Qualification</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                            <input name="privil[registration_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                            <input name="privil[registration_management][11]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_11 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
                                                                            

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Communication</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                            <input name="privil[registration_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                            <input name="privil[registration_management][12]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_12 form-control"><label for="<?php echo"checkbox".$i; ?>">Generate letter</label>
                                                                            <input name="privil[registration_management][13]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_13 form-control"><label for="<?php echo"checkbox".$i; ?>">Send Email</label>
                                                                            <input name="privil[registration_management][14]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_14 form-control"><label for="<?php echo"checkbox".$i; ?>">Send SMS</label>
                                                                            <input name="privil[registration_management][15]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_15 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
                                                                            

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Upload Document</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                            <input name="privil[registration_management][4]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_4 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                            <input name="privil[registration_management][16]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_16 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
                                                                            

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Notes</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                            <input name="privil[registration_management][5]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_5 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                            <input name="privil[registration_management][17]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_17 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
                                                                            <input name="privil[registration_management][18]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_18 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
                                                                            <input name="privil[registration_management][19]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_19 form-control"><label for="<?php echo"checkbox".$i; ?>">Follow-up</label>
                                                                            

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Archive</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                            <input name="privil[registration_management][6]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_registration_management_6 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                            

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>                                                            
 



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                                                      </div>
                                                    </div>                                                                                                                                                                                                        
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
													
													
<!--													<div class="panel panel-default">
														
														  	<div class="panel-heading panel-colapsible" >
														  		<label for="<?php //echo"checkbox".$i; ?>">Live Student</label>
														  	</div>
													  
													  		<div class="panel-body live_student_mng live-student-panel-body">

													  		<div class="select_area">

													  			<div class="col-sm-4 checkbox checkbox-primary">
															  		<input id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																	<label for="<?php //echo"checkbox".$i; ?>">Select All</label>
														  		</div>
														    	
														    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o live_student_management select_area_check_box">
														    			<input name="privil[live_student_management][0]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_0 form-control"><label for="<?php //echo"checkbox".$i; ?>">Search</label>														    			
														    			<input name="privil[live_student_management][1]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_1 form-control"><label for="<?php //echo"checkbox".$i; ?>">Personal Info/Update</label>
														    			<input name="privil[live_student_management][2]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_2 form-control"><label for="<?php //echo"checkbox".$i; ?>">Course</label>
														    			<input name="privil[live_student_management][3]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_3 form-control"><label for="<?php //echo"checkbox".$i; ?>">Education & Qualification</label>
														    			<input name="privil[live_student_management][4]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_4 form-control"><label for="<?php //echo"checkbox".$i; ?>">Documents</label>
														    			<input name="privil[live_student_management][5]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_5 form-control"><label for="<?php //echo"checkbox".$i; ?>">Notes</label>
														    			<input name="privil[live_student_management][6]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_6 form-control"><label for="<?php //echo"checkbox".$i; ?>">Communication</label>
														    			<input name="privil[live_student_management][7]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_7 form-control"><label for="<?php //echo"checkbox".$i; ?>">Accounts</label>
														    			<input name="privil[live_student_management][8]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_8 form-control"><label for="<?php //echo"checkbox".$i; ?>">Archive</label>
														    			<input name="privil[live_student_management][9]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_9 form-control"><label for="<?php //echo"checkbox".$i; ?>">Attendance</label>
														    			<input name="privil[live_student_management][10]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_10 form-control"><label for="<?php //echo"checkbox".$i; ?>">Result</label>
														    			<input name="privil[live_student_management][11]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_11 form-control"><label for="<?php //echo"checkbox".$i; ?>">SLC History</label>
                                                                        <input name="privil[live_student_management][12]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_12 form-control"><label for="<?php //echo"checkbox".$i; ?>">Login To Student Panel</label>
                                                                        <input name="privil[live_student_management][13]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_13 form-control"><label for="<?php //echo"checkbox".$i; ?>">HESA</label>
														    			<input name="privil[live_student_management][14]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_14 form-control"><label for="<?php //echo"checkbox".$i; ?>">Change Status</label>

														    	</div>
														    </div>
														    														    														    														    														    														    
													  </div>
													</div>-->

													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Live Student</div>
													  <div class="panel-body letter-management-panel-body">
														    	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Search</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
															    			<input name="privil[live_student_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>														    			
															    			<!--<input name="privil[live_student_management][15]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_15 form-control"><label for="<?php //echo"checkbox".$i; ?>">Excel Report</label>-->														    			

															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Profile</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o signatory_management select_area_check_box">
															    		<input name="privil[live_student_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
															    		<input name="privil[live_student_management][17]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_17 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
														    			<input name="privil[live_student_management][14]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_14 form-control"><label for="<?php echo"checkbox".$i; ?>">Change Status</label>
														    			<input name="privil[live_student_management][16]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_16 form-control"><label for="<?php echo"checkbox".$i; ?>">Profile lock /Unlock</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Course</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
															    			<input name="privil[live_student_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
															    			<input name="privil[live_student_management][18]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_18 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>

															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    														    	
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Education Qualification</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                            <input name="privil[live_student_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Documents</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                        <input name="privil[live_student_management][4]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_4 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[live_student_management][19]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_19 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Notes</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                        <input name="privil[live_student_management][5]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_5 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[live_student_management][20]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_20 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
                                                                        <input name="privil[live_student_management][21]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_21 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
                                                                        <input name="privil[live_student_management][22]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_22 form-control"><label for="<?php echo"checkbox".$i; ?>">Follow-up</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Archive</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                        <input name="privil[live_student_management][8]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_8 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Communication</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                        <input name="privil[live_student_management][6]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_6 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[live_student_management][23]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_23 form-control"><label for="<?php echo"checkbox".$i; ?>">Generate Letter</label>
                                                                        <input name="privil[live_student_management][24]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_24 form-control"><label for="<?php echo"checkbox".$i; ?>">Send Email</label>
                                                                        <input name="privil[live_student_management][25]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_25 form-control"><label for="<?php echo"checkbox".$i; ?>">Send SMS</label>
                                                                        <input name="privil[live_student_management][26]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_26 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Accounts</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                        <input name="privil[live_student_management][7]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_7 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[live_student_management][27]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_27 form-control"><label for="<?php echo"checkbox".$i; ?>">Add New Agreement</label>
                                                                        <input name="privil[live_student_management][28]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_28 form-control"><label for="<?php echo"checkbox".$i; ?>">Add New Payment</label>
                                                                        <input name="privil[live_student_management][29]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_29 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit Adreement</label>
                                                                        <input name="privil[live_student_management][29]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_29 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit Payment</label>
                                                                        <input name="privil[live_student_management][38]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_38 form-control"><label for="<?php echo"checkbox".$i; ?>">Print Payment</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Attendance</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                    
                                                                        <input name="privil[live_student_management][9]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_9 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <!--<input name="privil[live_student_management][30]" id="<?php //$i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_30 form-control"><label for="<?php //echo"checkbox".$i; ?>">Attendance Flag</label>-->
                                                                        <input name="privil[live_student_management][31]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_31 form-control"><label for="<?php echo"checkbox".$i; ?>">Attendance Detail View</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Result</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">

                                                                        <input name="privil[live_student_management][10]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_10 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[live_student_management][32]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_32 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>

                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">SLC History</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                        <input name="privil[live_student_management][11]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_11 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[live_student_management][35]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_35 form-control"><label for="<?php echo"checkbox".$i; ?>">Add Registration</label>
                                                                        <input name="privil[live_student_management][39]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_39 form-control"><label for="<?php echo"checkbox".$i; ?>">Add Registration View</label>
                                                                        <input name="privil[live_student_management][40]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_40 form-control"><label for="<?php echo"checkbox".$i; ?>">Add Registration Edit</label>
                                                                        <input name="privil[live_student_management][36]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_36 form-control"><label for="<?php echo"checkbox".$i; ?>">Add Attendance</label>
                                                                        <input name="privil[live_student_management][41]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_41 form-control"><label for="<?php echo"checkbox".$i; ?>">Add Attendance View</label>
                                                                        <input name="privil[live_student_management][42]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_42 form-control"><label for="<?php echo"checkbox".$i; ?>">Add Attendance Edit</label>
                                                                        <input name="privil[live_student_management][37]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_37 form-control"><label for="<?php echo"checkbox".$i; ?>">Add COC</label>
                                                                        <input name="privil[live_student_management][43]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_43 form-control"><label for="<?php echo"checkbox".$i; ?>">Add COC View</label>
                                                                        <input name="privil[live_student_management][44]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_44 form-control"><label for="<?php echo"checkbox".$i; ?>">Add COC Edit</label>
                                                                        <input name="privil[live_student_management][45]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_45 form-control"><label for="<?php echo"checkbox".$i; ?>">Add COC Edit Upload Document</label>


                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">Login to student panel</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                        <input name="privil[live_student_management][12]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_12 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>


                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>
                                                            <div class="well">
                                                                <div class="select_area">
                                                                    <div class="col-sm-4 checkbox checkbox-primary">
                                                                        <input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

                                                                        <label for="<?php echo"checkbox".$i; ?>">HESA</label>
                                                                    </div>
                                                                                                                            
                                                                    <div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
                                                                    
                                                                        <input name="privil[live_student_management][13]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_13 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
                                                                        <input name="privil[live_student_management][33]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_live_student_management_33 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit/Update</label>


                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>                                                                
                                                            </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            														    														    														    														    														    														    
													  </div>
													</div>																																																		

												
													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Job Management</div>
													  <div class="panel-body job-management-panel-body">
														    	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Job Type Management</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o job_type_management select_area_check_box">
															    			<input name="privil[job_type_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_type_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[job_type_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_type_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[job_type_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_type_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[job_type_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_type_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Job Department Management</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o job_department_management select_area_check_box">
															    			<input name="privil[job_department_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_department_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[job_department_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_department_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[job_department_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_department_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[job_department_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_department_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Jobs Management</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o job_management select_area_check_box">
															    			<input name="privil[job_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[job_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[job_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[job_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_job_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Induction Management</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o induction_management select_area_check_box">
															    			<input name="privil[induction_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[induction_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[induction_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[induction_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    			<input name="privil[induction_management][4]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_management_4 form-control"><label for="<?php echo"checkbox".$i; ?>">Assign Student</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    														    													    	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Induction Processing Management</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o induction_processing_management select_area_check_box">
															    			<input name="privil[induction_processing_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_processing_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[induction_processing_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_processing_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[induction_processing_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_processing_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[induction_processing_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_induction_processing_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Assigned Jobs</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o assigned_job_management select_area_check_box">
															    			<input name="privil[assigned_job_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_assigned_job_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Assign New Jobs</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o assign_new_job_management select_area_check_box">
															    			<input name="privil[assign_new_job_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_assign_new_job_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[assign_new_job_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_assign_new_job_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    													    
														    														    														    														    														    														    														    
													  </div>
													</div>													
													
													
													
													
													
													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Letter Management</div>
													  <div class="panel-body letter-management-panel-body">
														    	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Letter</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o letter_management select_area_check_box">
															    			<input name="privil[letter_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_letter_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[letter_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_letter_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[letter_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_letter_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[letter_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_letter_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Signatory</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o signatory_management select_area_check_box">
															    			<input name="privil[signatory_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_signatory_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[signatory_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_signatory_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[signatory_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_signatory_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[signatory_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_signatory_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Send Letter</label>
															    	</div>
														    														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o send_letter_management select_area_check_box">
															    			<input name="privil[send_letter_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_send_letter_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">Search</label>
															    			<input name="privil[send_letter_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_send_letter_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Send Email</label>
															    			<input name="privil[send_letter_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_send_letter_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Send SMS</label>
															    			<input name="privil[send_letter_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_send_letter_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Generate New Letter</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    														    	
														    														    														    														    														    														    
													  </div>
													</div>	
													
													
													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Attendance</div>
													  <div class="panel-body attendance-management-panel-body">
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Attendance Alert</label>
															    	</div>
														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o attendance_alert_management select_area_check_box">
															    			<input name="privil[attendance_alert_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_attendance_alert_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">View</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>													  
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Semester Plan</label>
															    	</div>
														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o semester_plan_management select_area_check_box">
															    			<input name="privil[semester_plan_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_plan_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[semester_plan_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_plan_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[semester_plan_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_plan_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[semester_plan_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_semester_plan_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Time Plan</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o time_plan_management select_area_check_box">
															    			<input name="privil[time_plan_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_time_plan_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[time_plan_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_time_plan_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[time_plan_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_time_plan_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[time_plan_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_time_plan_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Room Plan</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o room_plan_management select_area_check_box">
															    			<input name="privil[room_plan_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_room_plan_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[room_plan_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_room_plan_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[room_plan_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_room_plan_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit</label>
															    			<input name="privil[room_plan_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_room_plan_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Class Plan</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o class_plan_management select_area_check_box">
															    			<input name="privil[class_plan_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[class_plan_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Add</label>
															    			<input name="privil[class_plan_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">View Days</label>
															    			<input name="privil[class_plan_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">View Assigned Students</label>
															    			<input name="privil[class_plan_management][4]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_4 form-control"><label for="<?php echo"checkbox".$i; ?>">Generate Days</label>

															    			<input name="privil[class_plan_management][5]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_5 form-control"><label for="<?php echo"checkbox".$i; ?>">Delete</label>

															    			<input name="privil[class_plan_management][6]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_6 form-control"><label for="<?php echo"checkbox".$i; ?>">Edit Class Plan</label>

															    			<input name="privil[class_plan_management][7]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_class_plan_management_7 form-control"><label for="<?php echo"checkbox".$i; ?>">Assign Student</label>

															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area class_routine_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Class Routine</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o print_class_routine_management select_area_check_box class_routine_area_check_box">
															    			<input name="privil[print_class_routine_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_print_class_routine_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[print_class_routine_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_print_class_routine_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Print Class Routine</label>
															    			<input name="privil[print_class_routine_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_print_class_routine_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Send SMS</label>
															    			<input name="privil[print_class_routine_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_print_class_routine_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Print Student</label>
															    			<input name="privil[print_class_routine_management][4]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_print_class_routine_management_4 form-control"><label for="<?php echo"checkbox".$i; ?>">Feed Attendance</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Attendance Excuse</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o attendance_excuse select_area_check_box">
															    			<input name="privil[attendance_excuse][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_attendance_excuse_0 form-control"><label for="<?php echo"checkbox".$i; ?>">List</label>
															    			<input name="privil[attendance_excuse][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_attendance_excuse_1 form-control"><label for="<?php echo"checkbox".$i; ?>">View Archived</label>
															    			<input name="privil[attendance_excuse][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_attendance_excuse_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Add To Archived</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    														    														    														    														    														    														    														    														    
													  </div>
													</div>																										
													
													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Result Management</div>
													  <div class="panel-body result_management_area">
														    	
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">All Results</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o exam_result_management select_area_check_box">
															    			<input name="privil[exam_result_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">Publish Date</label>
															    			<input name="privil[exam_result_management][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Print</label>
															    			<input name="privil[exam_result_management][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Download Feedback</label>
															    			<input name="privil[exam_result_management][3]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_3 form-control"><label for="<?php echo"checkbox".$i; ?>">Upload Feedback</label>
															    			<input name="privil[exam_result_management][4]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_4 form-control"><label for="<?php echo"checkbox".$i; ?>">Add indivisual result</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>
														    <div class="well">
														    	<div class="select_area">
														    		<div class="col-sm-4 checkbox checkbox-primary">
															    		<input id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="select_all form-control">

																    	<label for="<?php echo"checkbox".$i; ?>">Add Results</label>
															    	</div>														    	
															    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o exam_result_management_extend select_area_check_box">
															    			<input name="privil[exam_result_management_extend][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_extend_0 form-control"><label for="<?php echo"checkbox".$i; ?>">Update/Add All Result</label>
															    			<input name="privil[exam_result_management_extend][1]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_extend_1 form-control"><label for="<?php echo"checkbox".$i; ?>">Publish Date</label>
															    			<input name="privil[exam_result_management_extend][2]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_exam_result_management_extend_2 form-control"><label for="<?php echo"checkbox".$i; ?>">Print</label>
															    	</div>
															    </div>
														    	<div class="clearfix"></div>														    	
														    </div>														    															    														    														    														    														    														    														    														    														    
													  </div>
													</div>


													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Account</div>
													  <div class="panel-body registration_mng account-management-panel-body">

														    <div class="well">
														    	<div class="col-sm-4">Payment Upload</div>														    	
														    	<div class="col-sm-8 checkbox checkbox-primary checkbox-margin-right margin-top-bottom-o account_payment_upload_management">
														    			<input name="privil[account_payment_upload_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_account_payment_upload_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">Upload</label>
														    	</div>														    	
														    	<div class="clearfix"></div>														    	
														    </div>														    	
														    														    														    														    														    														    
													  </div>
													</div>
													
													
													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Report</div>
													  <div class="panel-body report-management-panel-body">
														    	
														  <div class="col-sm-12 checkbox checkbox-primary margin-top-bottom-o report_management">
														  <input name="privil[report_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_report_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">On</label>
														  </div>
														    														    														    														    														    														    
													  </div>
													</div>																									

													
													<div class="panel panel-default">
													  <div class="panel-heading panel-colapsible">Master Inbox</div>
													  <div class="panel-body master-inbox-management-panel-body">
														    	
														  <div class="col-sm-12 checkbox checkbox-primary margin-top-bottom-o masterinbox_management">
														  <input name="privil[masterinbox_management][0]" id="<?php $i++; echo"checkbox".$i; ?>" type="checkbox" class="privil_masterinbox_management_0 form-control"><label for="<?php echo"checkbox".$i; ?>">On</label>
														  </div>
														    														    														    														    														    														    
													  </div>
													</div>
																									
											
											
											</div>
									</div>	                            
		                        </div>




<!---------------------------------------     ---------------------------------------------->		                        
		                        
		                        
		                        
		                        	                        		                        	                    
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="clearfix margin-bottom-2">
		           		<div class="col-xs-3">                        
                        <a class="btn btn-sm btn-info" href="<?php echo base_url(); ?>/index.php/staff_management/?action=list"><i class="fa fa-arrow-circle-left"></i> Back to List</a>
                        </div>
                        <div class="col-xs-9 text-right">


                               <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button>
                               
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>
<script>
/*jQuery(document).ready(function($) {
	$(".select_all").click(function() {
		//alert("Working");
		if(this.checked==true){
			//alert("check");
			//$(this).closest(".select_area").find('input:checkbox').attr('checked', true);	
			$.each($(this).closest(".select_area").find('input:checkbox'),function(){
				
				/*if(!$(this).hasClass("select_area")){
					$(this).attr('checked',true);
				}*/
				//if($(this).attr('checked')==false) $(this).attr('checked',true);
				//alert($(this).attr('checked')); 
				
			//});		
		//}else if(this.checked==false){
			//alert("uncheck");
			//$(this).closest(".select_area").find('input:checkbox').attr('checked', false);
			//$.each($(this).closest(".select_area").find('input:checkbox'),function(){
				
				/*if(!$(this).hasClass("select_area")){
					$(this).attr('checked',false);
				}*/
				//if($(this).attr('checked')==true) $(this).attr('checked',false);
				//alert($(this).attr('checked')); 
			//});			
		//}

	//});
//});*/
</script>
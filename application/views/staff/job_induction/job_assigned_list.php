<script language="javascript" type="text/javascript">
$(document).ready(function(){
      
    
	initializePanelColapsible();
	
	$('.job-assign-status').click(function(){
		
		var job_assign_id = $(this).attr('job_assign_id');
		var thisvalue = $(this).attr('value');
		//alert(job_assign_id+' '+thisvalue);
        
        if(thisvalue=="decline"){
            $('#declineReasonModal .job_assign_id').val('');
            $('#declineReasonModal').modal("show");
            $('#declineReasonModal .job_assign_id').val(job_assign_id);    
        }else{
        
				url = getURL()+'/index.php/ajaxall/';
				$.ajax({
				   type: "POST",
				   data: {
				   	   action: "changeJobAssignStatus", 
				   	   job_assign_id:job_assign_id, 
				   	   thisvalue:thisvalue
				   	   
				   },
				   url: url,
				   success: function(msg){
				       //alert(msg);
				      window.location = '<?php echo current_url(); ?>';
				      //location.reload();
				     
				   }
				});
        }
        
	});
    
    $('.decline-reason-confirm-btn').click(function(){
        
        var job_assign_id = $('#declineReasonModal .job_assign_id').val();
        var thisvalue = "decline";
        var declined_reason = $('#declineReasonModal .declined_reason').val();
        //alert(job_assign_id+' '+thisvalue);

        
                url = getURL()+'/index.php/ajaxall/';
                $.ajax({
                   type: "POST",
                   data: {
                          action: "changeJobAssignStatus", 
                          job_assign_id:job_assign_id, 
                          thisvalue:thisvalue,
                          declined_reason:declined_reason
                   },
                   url: url,
                   success: function(msg){
                       //alert(msg);
                      window.location = '<?php echo current_url(); ?>';
                      //location.reload();                     
                   }
                });

        
    });    
    
	
	$('.job-type-list a').click(function(){
		
		var panelname = $(this).attr('panelname');
		
		$.each($('.job-data-list .type-panel'),function(){
			
			  $(this).hide();
		});
		
		$('.job-data-list .'+panelname).show();
		$.each($('.job-type-list a'),function(){
			$(this).removeClass('active');	
		});
		$(this).addClass('active');
		
		url = getURL()+'/index.php/ajaxall/';
		$.ajax({
		   type: "POST",
		   data: {
			   action: "setSessionAssignedJobsViewPanel", 
			   panelname:panelname			   
		   },
		   url: url,
		   success: function(msg){
						 
		   }
		});		
		
		
		
	});
	
	
	var currentSessionAssignedJobsViewPanel = "<?php echo $this->session->userdata("setSessionAssignedJobsViewPanel"); ?>";
	if(currentSessionAssignedJobsViewPanel>""){
		
		$.each($('.job-data-list .type-panel'),function(){
			
			  $(this).hide();
		});
		
		$('.job-data-list .'+currentSessionAssignedJobsViewPanel).show();
		
		$.each($('.job-type-list a'),function(){
			$(this).removeClass('active');	
		});
		//alert(currentSessionAssignedJobsViewPanel);
		$('.job-type-list a[panelname='+currentSessionAssignedJobsViewPanel+']').addClass('active');		
				
	}
	
	

    
});
function recallRemove(){
    $('.remove-btn').click(function(){
            
        var id = $(this).attr('id'); //alert(id);
        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList(\''+id+'\',\'job_induction\')');
        $('#myModal').css({'top':'30%'});
        $('#myModal').modal('hide');
        $('#myModal').modal('toggle');
        
        
    });   
}
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
                		
               		
                		
                		<!--<a class="btn btn-md btn-info" type="button"><i class="fa fa-list"></i> Back to List</a>-->
	                </div>
                </div>

                <div class="row">
                              	
               
               <div class="col-lg-12">
               
 
	                
	                <h4><i class="fa fa-list"></i> Choose Department </h4>
	                <p class="divider"></p>
					<table class="table" style="width: auto;" cellpadding="10px">
					<tr>
<?php
					if(!empty($assigned_departments) && count($assigned_departments)>0){
						foreach($assigned_departments as $k => $v){						
?>					
							<td style="border-top: none;"><a class="btn btn-danger btn-block" href="<?php echo base_url(); ?>index.php/job_induction/assigned_jobmanagement/?dept_id=<?php echo $k; ?>"><?php echo $v; ?></a></td>
<?php
						}
					}else{						
?>
                           <td>You are not assigned into any job department.</td>
<?php
					}						
?>					
					</tr>
					</table>

					
<?php
					if( $this->input->get("action")!="archive" && $this->input->get('dept_id')>0 ){
?>
						<p class="divider"></p>						
						<div class="col-sm-12 no-pad">
							<div class="col-sm-6 no-pad">
							<h4><i class="fa fa-list"></i> Department : <?php echo $this->job_department->get_name_by_id($this->input->get('dept_id')); ?></h4>
						    </div>
						    <div class="col-sm-6 no-pad text-right">
						    	<a href="<?php echo base_url(); ?>index.php/job_induction/assigned_jobmanagement/?action=archive&dept_id=<?php echo $this->input->get('dept_id'); ?>" class="btn btn-toolbar"> View Archive <i class="fa fa-history fa-2x"></i></a>
						    </div>
						    <div class="clearfix"></div>
						</div>
<?php
					}							
?>						
<?php
					
					//if( (!empty($common_job_list) && count($common_job_list)>0) || (!empty($induction_job_list) && count($induction_job_list)>0) ){
					if(!empty($job_list)){
						$row_id = 1; $chkbox=1;
?>						        
						<div class="col-sm-12 no-pad">
						
							<div class="col-sm-2 no-pad-left">
								
								<div class="list-group job-type-list">
								    
								    <?php
								    	$i=0;

								    		foreach($job_list as $k=>$v){
								    			$k = str_replace(array("'"," ","\""),"_",$k);
												if($i==0) echo '<a href="javascript:void(0);" class="list-group-item active" panelname="'.$k.'-panel"> '.str_replace("_"," ",ucwords($k)).' </a>';
												else echo '<a href="javascript:void(0);" class="list-group-item" panelname="'.$k.'-panel"> '.str_replace("_"," ",ucwords($k)).' </a>';
												$i++;	
								    		}
  	
								    ?>
								  
								</div>															
							</div>
							<div class="col-sm-10 no-pad-right job-data-list">

								    <?php
								    	$i=0;	$induction_job_arr = array();

								    		foreach($job_list as $k=>$v){
								    			
								    			if($k!="Induction"){
								    				
								    					$k = str_replace(array("'"," ","\""),"_",$k);
								    					if($i==0) echo'<div class="'.$k.'-panel type-panel">';
								    					else echo'<div class="'.$k.'-panel type-panel" style="display:none;">';
								    					
														echo'
																<div class="panel panel-info">
																<div class="panel-heading">
																	<h3 class="panel-title">'.str_replace("_"," ",ucwords($k)).' Jobs</h3>
																</div>
																	<div class="panel-body">
														';
														

														echo'
																			<div class="panel panel-danger">
																			<div class="panel-heading">
																				<h3 class="panel-title panel-colapsible">Pending <span class="badge">'.count($v).'</span></h3>
																			</div>
																			<div class="panel-body">
																			<table class="table table-hover">
																				
																				<thead>
																					<tr>
																						<th>Job Name</th>
																						<th>Issue Date</th>
																						<th>Due Date</th>
																						<th>Request From</th>
																						<th>Remarks</th>
																						<th>Status</th>
																					</tr>
																				</thead>
																				<tbody>																													
														';

														foreach($v as $a=>$data){
															
															$job_data = $data['job_data'];
															$job_assign_data = $data['job_assign_data'];
															$job_type = $this->job_type->get_name_by_id($job_data['job_type_id']);

															$get_documents = $this->job_applied_student->get_document_by_job_assign_id($job_assign_data['id']);

															if(!empty($get_documents)) {
																$doc = unserialize($get_documents);
															}

															echo'<tr>';
															if(!empty($doc)) {

																echo'<td><a href="'.$doc[0].'">'.$job_data['name'].'</a></td>';
															} else {
																
																echo'<td>'.$job_data['name'].'</td>';
															}
															echo'<td>'.date("d-m-Y",strtotime($job_assign_data['issued_date'])).'</td>';
															echo'<td>'.date("d-m-Y",strtotime($job_assign_data['due_date'])).'</td>';
															if($job_assign_data['assigned_by_department_id']>0){
																echo'<td> Staff: '.$this->staff->get_nick_name($job_assign_data['assign_by_staff_id']).' ( '.$this->job_department->get_name_by_id($job_assign_data['assigned_by_department_id']).' )</td>';	
															}else if($job_assign_data['student_data_id']>0 && $job_type!="Induction"){
																
																$std_id = $this->register->get_registration_no_by_student_data_ID($job_assign_data['student_data_id']);
																if(empty($std_id)) $std_id = $this->student_data->get_reference_no_byID($job_assign_data['student_data_id']); 
																
																echo'<td> Student ( '.$std_id.' )</td>';
																
															}else{
																echo'<td> N/A </td>';
															}
															echo'<td> '.tinymce_decode($job_assign_data['remarks']).' </td>';
															echo'<td>';
															echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$job_assign_data['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
															echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$job_assign_data['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
															echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$job_assign_data['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
															echo'</td>';													
															echo'</tr>';
															
															$row_id++;
														}
														
														
														echo'
																				</tbody>	
																			</table>																
																					
																			</div>
																			</div>												
														';

														
														echo'
																	</div>
																</div>												
														';								    			
								    					
								    					echo'</div>';								    			

												
												}else if($k=="Induction"){
																										    
								    					$all_induction_list = $this->job_induction->get_all();
								    					
								    					foreach($all_induction_list as $ind=>$induction){
															//$v['name'];
															foreach($v as $a=>$data){
																
																$job_data = $data['job_data'];
																$job_assign_data = $data['job_assign_data'];
																
																if($job_assign_data['job_induction_id'] == $induction['id']){
																	
																	$job_induction_data = $this->job_induction->get_by_ID($job_assign_data['job_induction_id']);
																	
																	$induction_job_arr[$induction['id']][] = array("job_data"=>$job_data,"job_assign_data"=>$job_assign_data);	
																	
																}																
																
															}		
															
								    					}																										
													
												}
												
												$i++;	
								    		}/// foreach($job_list as $k=>$v){
								    		
								    		
								    		////--------print all listed induction data
								    		if(!empty($induction_job_arr) && count($induction_job_arr)>0){
												
								    					//if($i==0) echo'<div class="Induction-panel type-panel">';
								    					//else echo'<div class="Induction-panel type-panel" style="display:none;">';
								    					echo'<div class="Induction-panel type-panel">';
														echo'
																<div class="panel panel-info">
																<div class="panel-heading">
																	<h3 class="panel-title">Induction Jobs</h3>
																</div>
																	<div class="panel-body">
																	 
														';

                                                         //var_dump($induction_job_arr);
														foreach($induction_job_arr as $k=>$v){
															
															$induction_data = $this->job_induction->get_by_ID($k);
															
															echo'
																		<div class="panel panel-danger" >
																		<div class="panel-heading">
																			<h3 class="panel-title panel-colapsible">'.ucwords($induction_data['name']).' > Date: '.date("d-m-Y",strtotime($induction_data['date'])).'</h3>
																		</div>
																			<div class="panel-body">
																			<table class="table table-hover">
																				
																				<thead>
																					<tr>
																						<th>Job Name</th>
																						<th>App. Ref. No</th>
																						<th>Name</th>
																						<th>Issue Date</th>
																						<th>Due Date</th>
																						<th>Status</th>
																					</tr>
																				</thead>
																				<tbody>																																		
															';
															
															
																			foreach($v as $a=>$data){
																				
																				$job_data = $data['job_data'];
																				$job_assign_data = $data['job_assign_data'];
																				
																				$std_data = $this->student_data->get_studentdata_for_edit($job_assign_data['student_data_id']);
																				
																				echo'<tr>';
																				echo'<td>'.$job_data['name'].'</td>';
																				echo'<td>'.$std_data['student_application_reference_no'].'</td>';
																				echo'<td>'.$std_data['student_first_name']." ".$std_data['student_sur_name'].'</td>';
																				echo'<td>'.date("d-m-Y",strtotime($job_assign_data['issued_date'])).'</td>';
																				echo'<td>'.date("d-m-Y",strtotime($job_assign_data['due_date'])).'</td>';
																				echo'<td>';
																				echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$job_assign_data['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																				echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$job_assign_data['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																				echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$job_assign_data['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																				echo'</td>';													
																				echo'</tr>';
																				
																				$row_id++;
																			}	
															
															
															echo'
																				</tbody>	
																			</table>															
																			</div>
																		</div>															
															';	
															
														}														
														
														
														echo'	    
																	</div>
																</div>												
														';								    			
								    					
								    					echo'</div>';																						    					
								    																	
												
												$i++;
								    		}
  	
								    ?>									

						    </div><!-- <div class="col-sm-10 no-pad-right job-data-list"> -->
						    
						</div>	
												
					
<?php						
					}/// if(!empty($job_list)){
					///------------------------------------print archive result if found.
					if(!empty($archive)){
?>						

						<p class="divider"></p>						
						<div class="col-sm-12 no-pad">
							<div class="col-sm-6 no-pad">
							<h4><i class="fa fa-list"></i> Department : <?php echo $this->job_department->get_name_by_id($this->input->get('dept_id')); ?></h4>
						    </div>
						    <div class="col-sm-6 no-pad text-right">
						    	<a href="<?php echo base_url(); ?>index.php/job_induction/assigned_jobmanagement/?dept_id=<?php echo $this->input->get('dept_id'); ?>" class="btn btn-toolbar"><i class="fa fa-arrow-circle-o-left"></i> Back to assigned job list</a>
						    </div>
						    <div class="clearfix"></div>
						</div>

<?php						
						echo $archive;
					}					            	
?>					            
               
               </div>
               
               

            </div>

    
    
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm Change Status</h4>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to change status?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger confirm-btn">Yes</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     
                
                
                <!-- Modal -->
                <div class="modal fade" id="declineReasonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Reason of Decline</h4>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" class="job_assign_id">
                          <div class="msg"></div>
                           <div class="form-group">
                                <label>Reason:  </label><br/>
                                <input type="text" class="form-control declined_reason" name="declined_reason" maxlength="350">
                           
                            </div>
                                                    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger decline-reason-confirm-btn">Ok</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                 
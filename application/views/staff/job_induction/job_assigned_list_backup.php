<script language="javascript" type="text/javascript">
$(document).ready(function(){
      
    
	initializePanelColapsible();
	
	$('.job-assign-status').click(function(){
		
		var job_assign_id = $(this).attr('job_assign_id');
		var thisvalue = $(this).attr('value');
		//alert(job_assign_id+' '+thisvalue);
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
				      //$('#addNewPayment .output').html(msg).fadeOut( 2000 ,function(){ window.location = '<?php // echo current_url(); ?>'; });
				      window.location = '<?php echo current_url(); ?>';
				      //location.reload();
				     
				   }
				});
		
	});
	
	

    
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
                    
<!--                    <form role="form">
                    
		                <div class="col-lg-12">

		                        <div class="form-group">
		                            <label>Company Name</label>
		                            <input class="form-control" type="text" name="company_name">
		                        </div>

		                        <div class="form-group">
		                            <label>Address</label>
		                            <input class="form-control" type="text" name="address">
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Contact Person</label>
		                            <input class="form-control" type="text" name="contact_person">
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Phone</label>
		                            <input class="form-control" type="text" name="phone">
		                        </div>		                        		                        	                        

		                        <div class="form-group">
		                            <label>Bank Name</label>
		                            <input class="form-control" type="text" name="bank_name">
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Branch Name</label>
		                            <input class="form-control" type="text" name="branch_name">
		                        </div>
		                        
		                        <div class="form-group">
		                            <label>Account Number</label>
		                            <input class="form-control" type="text" name="account_number">
		                        </div>		                        		                        
		                    
		           		</div>

		            
		            
		                <div class="col-lg-6">



		                    
		           		</div>
		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
		           			<div class="col-xs-2"></div>
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button>
			                		            
                        </div>
               </form> -->
               
               
               	
               
               <div class="col-lg-12">
               
               
	                <!--<h4><i class="fa fa-list"></i> Assigned Job List </h4>
	                <table class="dTable display">
	                    <thead>
	                        <tr>
                                <th>Serial</th>
	                            <th>Job type</th>
	                            <th>Issued Date</th>
	                            <th>Induction name</th>
	                            <th>Appicant/Student ID</th>	                            
	                            <th>Assigned to</th>
                                <th>Status</th>      
                                <th>Last updated by</th>      
	                            <th>Last updated date</th>      
	                        </tr>
	                    </thead>
	                    <tbody>
	                        <?php
	                           
	                             /*
                                  $i=1;
                                
	                            foreach($assigned_job_list as $k => $v){
	                                  $status = $v["status"];
                                      if(( $student_id   =   $this->register->get_registration_no_by_student_data_ID($v["student_data_id"])) ==   false) {
                                           $student_id   =   $this->student_data->get_reference_no_byID($v["student_data_id"]);  
                                      }
	                                echo "<tr  class='gradeA'>";                 
                                    echo "<td>".$i."</td>";
	                                echo "<td>".$this->jobs->get_name_by_id($v["jobs_type_id"])."</td>";
	                                echo "<td>".tohrdatetime($v["issued_date"])."</td>";
	                                echo "<td>".$this->job_induction->namedate($v["induction_id"])."</td>";
                                    echo "<td>".$student_id."</td>";
                                    echo "<td>".$this->staff->get_name($v["staff_id"])."</td>";
                                    echo "<td ";
                                    if($status=="done") {
                                        echo "class=\"success\" style=\"background: #548c39; color:#fff !important; font-weight: bold; border-bottom-color: #548c39;\"";
                                    } else if($status=="pending") {
                                        echo "class=\"warning\" style=\"background: #FCA600; color:#fff !important; font-weight: bold; border-bottom-color: #FCA600;\"";
                                    } else {
                                        echo "class=\"red\" style=\"background:#bf1f1f; color:#fff !important; font-weight: bold; border-bottom-color: #bf1f1f;\"";
                                    } 
                                    echo " >".$status."</td>";
                                    echo "<td>".$this->staff->get_name($v["reviewed_by"])."</td>";
	                                echo "<td>".tohrdatetime($v["modified_date"])."</td>"; 
	                                echo "</tr>";
                                  $i++;
	                            } 
	                                                    
	                            */        
	                        ?>    
	                    </tbody>
	                </table> --> 
	                
	                <h4><i class="fa fa-list"></i> Choose Department </h4>
					<table class="table table-condensed" style="width: 100%;" cellpadding="10px">
					<tr>
<?php
					if(!empty($assigned_departments) && count($assigned_departments)>0){
						foreach($assigned_departments as $k => $v){						
?>					
							<td><a class="btn btn-danger btn-block" href="<?php echo base_url(); ?>index.php/job_induction/assigned_jobmanagement/?dept_id=<?php echo $k; ?>"><?php echo $v; ?></a></td>
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
					<pre>
					<?php var_dump($job_list); ?>
					</pre>
					
<?php
					
					//if( (!empty($common_job_list) && count($common_job_list)>0) || (!empty($induction_job_list) && count($induction_job_list)>0) ){
					if(!empty($job_list)){
						$row_id = 1;
?>						
						<p class="divider"></p>
						<h4><i class="fa fa-list"></i> Department : <?php echo $this->job_department->get_name_by_id($this->input->get('dept_id')); ?></h4>
						<div class="col-sm-12 no-pad">
						
							<div class="col-sm-2 no-pad-left">
								
								<div class="list-group job-type-list">
								  
								    <?php //if( (!empty($common_job_list) && count($common_job_list)>0) && empty($induction_job_list) ){ ?> <!--<a href="javascript:void(0);" class="list-group-item active common-job-list"> Common </a>--> 
								    <?php //}else if(empty($common_job_list) && (!empty($induction_job_list) && count($induction_job_list)>0) ){ ?> <!--<a href="javascript:void(0);" class="list-group-item active induction-job-list"> Induction </a>--> 
								    <?php //}else if( (!empty($common_job_list) && count($common_job_list)>0) && (!empty($induction_job_list) && count($induction_job_list)>0) ){ ?> <!--<a href="javascript:void(0);" class="list-group-item active common-job-list"> Common </a> <a href="javascript:void(0);" class="list-group-item induction-job-list"> Induction </a>--> <?php //} ?>
								    
								    <?php
								    	$i=0;

								    		foreach($job_list as $k=>$v){
												if($i==0) echo '<a href="javascript:void(0);" class="list-group-item active"> '.$k.' </a>';
												else echo '<a href="javascript:void(0);" class="list-group-item"> '.$k.' </a>';
												$i++;	
								    		}
  	
								    ?>
								  
								</div>															
							</div>
							<div class="col-sm-10 no-pad-right job-data-list">

									
									<?php //var_dump($induction_job_list); ?>
									 <?php //var_dump($common_job_list); ?>
									
								    <?php if( (!empty($common_job_list) && count($common_job_list)>0) && empty($induction_job_list) ){ ?> 
											
											<div class="common-panel">
														



                                                      <?php //var_dump($common_job_list); ?>
														
														
														
														<!------- ONLY FOR COMMON JOB -------->			
														<div class="panel panel-info">
														<div class="panel-heading">
															<h3 class="panel-title">Common Jobs</h3>
														</div>
															<div class="panel-body">
			<?php
																		//var_dump($common_job_list);
																		$pending = array(); $done = array(); $decline = array();
																		$pi = 0;
																		$di = 0;
																		$dci = 0;
																		foreach($common_job_list as $k=>$v){
																			
																			$job_data = $this->jobs->get_by_ID($k);
																			$job_assign_data = $this->job_assign->get_by_jobs_id_and_staff_id_and_job_department_id($job_data['id'],$this->session->userdata('uid'),$this->input->get('dept_id'));
																			
																			if($job_assign_data['status']=="pending"){
																				
																				$pending[$pi]['job_data'] 		=  $job_data;
																				$pending[$pi]['job_assign_data'] =  $job_assign_data;
																				$pi++;
																			}
																			
																			if($job_assign_data['status']=="done"){
																				
																				$done[$di]['job_data'] 		=  $job_data;
																				$done[$di]['job_assign_data'] =  $job_assign_data;
																				$di++;																	
																			}
																			
																			if($job_assign_data['status']=="decline"){
																				
																				$decline[$dci]['job_data'] 		=  $job_data;
																				$decline[$dci]['job_assign_data'] =  $job_assign_data;
																				$dci++;																	
																			}																
																			
																			
																			
																			
																		}
																		

																		
																		
																		
																		
																		//var_dump($pending);
																		$chkbox=1;																
			?>												
															        <?php if(count($pending)>0){ ?>
																    <!--Pending JOBS List-->
																	<div class="panel panel-danger">
																	<div class="panel-heading">
																		<h3 class="panel-title panel-colapsible">Pending <span class="badge"><?php echo count($pending); ?></span></h3>
																	</div>
																	<div class="panel-body"> 
																		
																	<table class="table table-hover">
																		
																		<thead>
																			<tr>
																				<th>Job Name</th>
																				<th>Issue Date</th>
																				<th>Status</th>
																			</tr>
																		</thead>
																		<tbody>
																			
																			
			<?php                                                               
																				foreach($pending as $k=>$v){
																					echo"<tr>";
																					echo"<td>".$v['job_data']['name']."</td>";	
																					echo"<td>".$v['job_assign_data']['issued_date']."</td>";	
																					echo"<td>";
																					
																					//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																					echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																					echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																					echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																					
																					//".$v['job_assign_data']['status']."
																					
																					echo"</td>";	
																					echo"</tr>";
																					$row_id++;	
																				}																																		
			?>
																																		
																		</tbody>	
																	</table>																
																			
																	</div>
																	</div>
																	<?php } ?>	
																	<!--END OF Pending JOBS List-->
													
															</div>
														</div>														
														<!------- END OF ONLY FOR COMMON JOB -------->			
														

	
											</div>							    	
								    <?php }else if( (empty($common_job_list)) && (!empty($induction_job_list) && count($induction_job_list)>0) ){ ?> 
											<div class="induction-panel">
												<div class="panel panel-info">
												<div class="panel-heading">
													<h3 class="panel-title">Induction Jobs</h3>
												</div>
													<div class="panel-body"> 
													
													
													<!--------ONLY FOR INDUCTION JOB------->
													
													
<?php
															//var_dump($induction_job_list);
															$induction_arr = array();
															$ipi = 0;
															$idi = 0;
															$idci = 0;
															$ipending = array(); $idone = array(); $idecline = array();															
															foreach($induction_job_list as $k=>$v){
																
																$job_data = $this->jobs->get_by_ID($k);
																
																$induction_process_list = $this->job_induction_process->get_all();
																foreach($induction_process_list as $a=>$b){
																	
																	if(!empty($b['jobs_list'])){
																		
																		 $jobs_list = unserialize($b['jobs_list']);
																		 foreach($jobs_list as $c=>$d){
																			 
																			 if($k==$d){
																				if(!in_array($b['job_induction_id'],$induction_arr))$induction_arr[] = $b['job_induction_id']; 
																			 }
																			 
																		 }
																		
																	}
																	
																	
																}

																
															}
															
															
															foreach($induction_arr as $induction_id){
																
																$job_induction_data = $this->job_induction->get_by_ID($induction_id);
																
															$ipi = 0;
															$idi = 0;
															$idci = 0;
															$ipending = array(); $idone = array(); $idecline = array();																
																
																
?>
                                                                        
																		<div class="panel panel-info" >
																		<div class="panel-heading">
																			<h3 class="panel-title">Induction Job - <?php echo $job_induction_data['name']; ?> - Date: <?php echo date("F j, Y",strtotime($job_induction_data['date'])); ?></h3>
																		</div>
																			<div class="panel-body">


				<?php																
																				
																				     //var_dump($induction_job_list);
																					 foreach($induction_job_list as $k=>$v){
																					         
																     						$job_data = $this->jobs->get_by_ID($k);
																							//var_dump($job_data); 	
																							 $job_assign_data = $this->job_assign->get_by_jobs_id_and_job_induction_id($job_data['id'],$induction_id);
																							 //var_dump($job_assign_data); 
																							 
																							 foreach($job_assign_data as $g=>$h){
																			 					 
																								if($h['status']=="pending"){
																									
																									$ipending[$ipi]['job_data'] 		=  $job_data;
																									$ipending[$ipi]['job_assign_data'] =  $h;
																									$ipending[$ipi]['job_induction_data'] =  $job_induction_data;
																									$ipi++;
																								}
																								
																								if($h['status']=="done"){
																									
																									$idone[$idi]['job_data'] 		=  $job_data;
																									$idone[$idi]['job_assign_data'] =  $h;
																									$idone[$idi]['job_induction_data'] =  $job_induction_data;
																									$idi++;																	
																								}
																								
																								if($h['status']=="decline"){
																									
																									$idecline[$idci]['job_data'] 		=  $job_data;
																									$idecline[$idci]['job_assign_data'] =  $h;
																									$idecline[$idci]['job_induction_data'] =  $job_induction_data;
																									$idci++;																	
																								}
																							 }																					
																								
																					 }
																					 
				?>																



																				        <?php if(count($ipending)>0){ ?>
																					    <!--Pending JOBS List-->
																						<div class="panel panel-danger">
																						<div class="panel-heading">
																							<h3 class="panel-title panel-colapsible">Pending <span class="badge"><?php echo count($ipending); ?></span></h3>
																						</div>
																						<div class="panel-body"> 
																							
																						<table class="table table-hover">
																							
																							<thead>
																								<tr>
																									<th>Job Name</th>
																									<th>Issue Date</th>
																									<th>App. Ref. No</th>
																									<th>Name</th>
																									<th>Status</th>
																								</tr>
																							</thead>
																							<tbody>
																								
																								
								<?php                                                               
																									//var_dump($ipending);
																									foreach($ipending as $x=>$y){
																										
																										$std_data = $this->student_data->get_studentdata_for_edit($y['job_assign_data']['student_data_id']);
																										//var_dump($std_data);
																										echo"<tr>";
																										echo"<td>".$y['job_data']['name']."</td>";	
																										echo"<td>".$y['job_assign_data']['issued_date']."</td>";	
																										echo"<td>".$std_data['student_application_reference_no']."</td>";	
																										echo"<td>".$std_data['student_first_name']." ".$std_data['student_sur_name']."</td>";	
																										echo"<td>";
																										
																										//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																										echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																										echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																										echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																										
																										//".$v['job_assign_data']['status']."
																										
																										echo"</td>";	
																										echo"</tr>";
																										$row_id++;	
																									}																																		
								?>
																																							
																							</tbody>	
																						</table>																
																								
																						</div>
																						</div>
																						<?php } ?>
																			
																			
																							</div>
																						</div>															
																			
				<?php															
																			}																												
				?>														
													
													
													<!--------END OF ONLY FOR INDUCTION JOB------->
													
													
													
													</div>
												</div>
											</div>								    
								    <?php }else if( (!empty($common_job_list) && count($common_job_list)>0) && (!empty($induction_job_list) && count($induction_job_list)>0) ){ ?> 
											<div class="common-panel">
											<div class="panel panel-info">
											<div class="panel-heading">
												<h3 class="panel-title">Common Jobs</h3>
											</div>
												<div class="panel-body">
<?php
															//var_dump($common_job_list);
															$pending = array(); $done = array(); $decline = array();
															$pi = 0;
															$di = 0;
															$dci = 0;
															foreach($common_job_list as $k=>$v){
																
																$job_data = $this->jobs->get_by_ID($k);
																$job_assign_data = $this->job_assign->get_by_jobs_id_and_staff_id_and_job_department_id($job_data['id'],$this->session->userdata('uid'),$this->input->get('dept_id'));
																
																if($job_assign_data['status']=="pending"){
																	
																	$pending[$pi]['job_data'] 		=  $job_data;
																	$pending[$pi]['job_assign_data'] =  $job_assign_data;
																	$pi++;
																}
																
																if($job_assign_data['status']=="done"){
																	
																	$done[$di]['job_data'] 		=  $job_data;
																	$done[$di]['job_assign_data'] =  $job_assign_data;
																	$di++;																	
																}
																
																if($job_assign_data['status']=="decline"){
																	
																	$decline[$dci]['job_data'] 		=  $job_data;
																	$decline[$dci]['job_assign_data'] =  $job_assign_data;
																	$dci++;																	
																}																
																
																
																
																
															}
															

															
															
															
															
															//var_dump($pending);
															$chkbox=1;																
?>												
												        <?php if(count($pending)>0){ ?>
													    <!--Pending JOBS List-->
														<div class="panel panel-danger">
														<div class="panel-heading">
															<h3 class="panel-title panel-colapsible">Pending <span class="badge"><?php echo count($pending); ?></span></h3>
														</div>
														<div class="panel-body"> 
															
														<table class="table table-hover">
															
															<thead>
																<tr>
																	<th>Job Name</th>
																	<th>Issue Date</th>
																	<th>Status</th>
																</tr>
															</thead>
															<tbody>
																
																
<?php                                                               
																	foreach($pending as $k=>$v){
																		echo"<tr>";
																		echo"<td>".$v['job_data']['name']."</td>";	
																		echo"<td>".$v['job_assign_data']['issued_date']."</td>";	
																		echo"<td>";
																		
																		//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																		
																		//".$v['job_assign_data']['status']."
																		
																		echo"</td>";	
																		echo"</tr>";
																		$row_id++;	
																	}																																		
?>
																															
															</tbody>	
														</table>																
																
														</div>
														</div>
														<?php } ?>	
														<!--END OF Pending JOBS List-->
														<!--done JOBS List-->
														<?php if(count($done)>0){ ?>
														<div class="panel panel-success">
														<div class="panel-heading">
															<h3 class="panel-title panel-colapsible">Done <span class="badge"><?php echo count($done); ?></span></h3>
														</div>
														<div class="panel-body"> 
															
														<table class="table table-hover">
															
															<thead>
																<tr>
																	<th>Job Name</th>
																	<th>Issue Date</th>
																	<th>Status</th>
																</tr>
															</thead>
															<tbody>
																
																
<?php                                                               
																	foreach($done as $k=>$v){
																		echo"<tr>";
																		echo"<td>".$v['job_data']['name']."</td>";	
																		echo"<td>".$v['job_assign_data']['issued_date']."</td>";	
																		echo"<td>";
																		
																		//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																		
																		//".$v['job_assign_data']['status']."
																		
																		echo"</td>";	
																		echo"</tr>";
																		$row_id++;	
																	}																																		
?>
																															
															</tbody>	
														</table>																
																
														</div>
														</div>
														<?php } ?>														
														<!--END OF done JOBS List-->
														<!--decline JOBS List-->
														<?php if(count($decline)>0){ ?>
														<div class="panel panel-warning">
														<div class="panel-heading">
															<h3 class="panel-title panel-colapsible">Decline <span class="badge"><?php echo count($decline); ?></span></h3>
														</div>
														<div class="panel-body"> 
															
																	<table class="table table-hover">
																		
																		<thead>
																			<tr>
																				<th>Job Name</th>
																				<th>Issue Date</th>
																				<th>Status</th>
																			</tr>
																		</thead>
																		<tbody>																
<?php                                                               
																	foreach($decline as $k=>$v){
																		echo"<tr>";
																		echo"<td>".$v['job_data']['name']."</td>";	
																		echo"<td>".$v['job_assign_data']['issued_date']."</td>";	
																		echo"<td>";
																		
																		//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																		echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$v['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																		
																		//".$v['job_assign_data']['status']."
																		
																		echo"</td>";	
																		echo"</tr>";
																		$row_id++;	
																	}																																		
?>
															</tbody>	
														</table>																
														</div>
														</div>
														<?php } ?> 
														<!--END OF decline JOBS List-->														
												</div>
											</div>
											</div>
											
											
											<div class="induction-panel" style="display: none;">
 
												
<?php
															//var_dump($induction_job_list);
															$induction_arr = array();
															$ipi = 0;
															$idi = 0;
															$idci = 0;
															$ipending = array(); $idone = array(); $idecline = array();															
															foreach($induction_job_list as $k=>$v){
																
																$job_data = $this->jobs->get_by_ID($k);
																
																$induction_process_list = $this->job_induction_process->get_all();
																foreach($induction_process_list as $a=>$b){
																	
																	if(!empty($b['jobs_list'])){
																		
																		 $jobs_list = unserialize($b['jobs_list']);
																		 foreach($jobs_list as $c=>$d){
																			 
																			 if($k==$d){
																				if(!in_array($b['job_induction_id'],$induction_arr))$induction_arr[] = $b['job_induction_id']; 
																			 }
																			 
																		 }
																		
																	}
																	
																	
																}

																
															}
															
															
															foreach($induction_arr as $induction_id){
																
																$job_induction_data = $this->job_induction->get_by_ID($induction_id);
																
															$ipi = 0;
															$idi = 0;
															$idci = 0;
															$ipending = array(); $idone = array(); $idecline = array();																
																
																
?>
                                                                        
																		<div class="panel panel-info" >
																		<div class="panel-heading">
																			<h3 class="panel-title">Induction Job - <?php echo $job_induction_data['name']; ?> - Date: <?php echo date("F j, Y",strtotime($job_induction_data['date'])); ?></h3>
																		</div>
																			<div class="panel-body">


<?php																
																
																     //var_dump($induction_job_list);
																	 foreach($induction_job_list as $k=>$v){
																	         
																     		$job_data = $this->jobs->get_by_ID($k);
																			//var_dump($job_data); 	
																			 $job_assign_data = $this->job_assign->get_by_jobs_id_and_job_induction_id($job_data['id'],$induction_id);
																			 //var_dump($job_assign_data); 
																			 
																			 foreach($job_assign_data as $g=>$h){
																			 	 
																				if($h['status']=="pending"){
																					
																					$ipending[$ipi]['job_data'] 		=  $job_data;
																					$ipending[$ipi]['job_assign_data'] =  $h;
																					$ipending[$ipi]['job_induction_data'] =  $job_induction_data;
																					$ipi++;
																				}
																				
																				if($h['status']=="done"){
																					
																					$idone[$idi]['job_data'] 		=  $job_data;
																					$idone[$idi]['job_assign_data'] =  $h;
																					$idone[$idi]['job_induction_data'] =  $job_induction_data;
																					$idi++;																	
																				}
																				
																				if($h['status']=="decline"){
																					
																					$idecline[$idci]['job_data'] 		=  $job_data;
																					$idecline[$idci]['job_assign_data'] =  $h;
																					$idecline[$idci]['job_induction_data'] =  $job_induction_data;
																					$idci++;																	
																				}
																			 }																					
																				
																	 }
																	 
?>																



																        <?php if(count($ipending)>0){ ?>
																	    <!--Pending JOBS List-->
																		<div class="panel panel-danger">
																		<div class="panel-heading">
																			<h3 class="panel-title panel-colapsible">Pending <span class="badge"><?php echo count($ipending); ?></span></h3>
																		</div>
																		<div class="panel-body"> 
																			
																		<table class="table table-hover">
																			
																			<thead>
																				<tr>
																					<th>Job Name</th>
																					<th>Issue Date</th>
																					<th>App. Ref. No</th>
																					<th>Name</th>
																					<th>Status</th>
																				</tr>
																			</thead>
																			<tbody>
																				
																				
				<?php                                                               
																					//var_dump($ipending);
																					foreach($ipending as $x=>$y){
																						
																						$std_data = $this->student_data->get_studentdata_for_edit($y['job_assign_data']['student_data_id']);
																						//var_dump($std_data);
																						echo"<tr>";
																						echo"<td>".$y['job_data']['name']."</td>";	
																						echo"<td>".$y['job_assign_data']['issued_date']."</td>";	
																						echo"<td>".$std_data['student_application_reference_no']."</td>";	
																						echo"<td>".$std_data['student_first_name']." ".$std_data['student_sur_name']."</td>";	
																						echo"<td>";
																						
																						//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																						
																						//".$v['job_assign_data']['status']."
																						
																						echo"</td>";	
																						echo"</tr>";
																						$row_id++;	
																					}																																		
				?>
																																			
																			</tbody>	
																		</table>																
																				
																		</div>
																		</div>
																		<?php } ?>


																        <?php if(count($idone)>0){ ?>
																	    <!--Done JOBS List-->
																		<div class="panel panel-success">
																		<div class="panel-heading">
																			<h3 class="panel-title panel-colapsible">Done <span class="badge"><?php echo count($idone); ?></span></h3>
																		</div>
																		<div class="panel-body"> 
																			
																		<table class="table table-hover">
																			
																			<thead>
																				<tr>
																					<th>Job Name</th>
																					<th>Issue Date</th>
																					<th>App. Ref. No</th>
																					<th>Name</th>
																					<th>Status</th>
																				</tr>
																			</thead>
																			<tbody>
																				
																				
				<?php                                                               
																					//var_dump($ipending);
																					foreach($idone as $x=>$y){
																						
																						$std_data = $this->student_data->get_studentdata_for_edit($y['job_assign_data']['student_data_id']);
																						//var_dump($std_data);
																						echo"<tr>";
																						echo"<td>".$y['job_data']['name']."</td>";	
																						echo"<td>".$y['job_assign_data']['issued_date']."</td>";	
																						echo"<td>".$std_data['student_application_reference_no']."</td>";	
																						echo"<td>".$std_data['student_first_name']." ".$std_data['student_sur_name']."</td>";	
																						echo"<td>";
																						
																						//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																						
																						//".$v['job_assign_data']['status']."
																						
																						echo"</td>";	
																						echo"</tr>";
																						$row_id++;	
																					}																																		
				?>
																																			
																			</tbody>	
																		</table>																
																				
																		</div>
																		</div>
																		<?php } ?>


																        <?php if(count($idecline)>0){ ?>
																	    <!--Done JOBS List-->
																		<div class="panel panel-warning">
																		<div class="panel-heading">
																			<h3 class="panel-title panel-colapsible">Declined <span class="badge"><?php echo count($idecline); ?></span></h3>
																		</div>
																		<div class="panel-body"> 
																			
																		<table class="table table-hover">
																			
																			<thead>
																				<tr>
																					<th>Job Name</th>
																					<th>Issue Date</th>
																					<th>App. Ref. No</th>
																					<th>Name</th>
																					<th>Status</th>
																				</tr>
																			</thead>
																			<tbody>
																				
																				
				<?php                                                               
																					//var_dump($ipending);
																					foreach($idecline as $x=>$y){
																						
																						$std_data = $this->student_data->get_studentdata_for_edit($y['job_assign_data']['student_data_id']);
																						//var_dump($std_data);
																						echo"<tr>";
																						echo"<td>".$y['job_data']['name']."</td>";	
																						echo"<td>".$y['job_assign_data']['issued_date']."</td>";	
																						echo"<td>".$std_data['student_application_reference_no']."</td>";	
																						echo"<td>".$std_data['student_first_name']." ".$std_data['student_sur_name']."</td>";	
																						echo"<td>";
																						
																						//echo'<div class="checkbox checkbox-primary"><input name="job_assign_id['.$v['job_assign_data']['id'].']" id="job_'.$chkbox.'" type="checkbox" class="form-control job-assign-status" value="pending"><label for="job_'.$chkbox.'">Pending</label></div>';
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="pending">Pending</label>'; $chkbox++;
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" id="inlineRadio_'.$chkbox.'" value="done">Done</label>'; $chkbox++;
																						echo'<label class="radio-inline"><input type="radio" name="row_'.$row_id.'" job_assign_id="'.$y['job_assign_data']['id'].'" class="job-assign-status" checked="checked" id="inlineRadio_'.$chkbox.'" value="decline">Decline</label>'; $chkbox++;
																						
																						//".$v['job_assign_data']['status']."
																						
																						echo"</td>";	
																						echo"</tr>";
																						$row_id++;	
																					}																																		
				?>
																																			
																			</tbody>	
																		</table>																
																				
																		</div>
																		</div>
																		<?php } ?>


																		
																		
																		
																		
																		
															
															
																			</div>
																		</div>															
															
<?php															
															}																												
?>												
												
												
													    
								    <?php } ?>							
							
							</div>
						    </div>
						</div>	
												
					
<?php						
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
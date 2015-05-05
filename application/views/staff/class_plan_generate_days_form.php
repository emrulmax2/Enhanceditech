<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if(!empty($class_plan) && is_array($class_plan)){
			foreach($class_plan as $k=>$v){
				
				$$k=tinymce_decode($v);

				if($k=="id") { echo"$('.class_planid').val('$v');"; $room_name = $this->room_plan->get_name_by_id($this->class_plan->get_room_id_by_id($v)); }
				if($k=="group_name") echo"$('.group').val('$v');"; 
				if($k=="semester_planid") echo"$('.semester').val('".$this->semester_plan->get_name_by_id($v)."');"; 
				if($k=="coursemodule_id") echo"$('.module').val('".$this->coursemodule->get_name_by_id($v)."');"; 
				if($k=="time_planid") echo"$('.time_planid').val('".$v."');"; 
				if($k=="course_relation_id"){
					$c_id = $this->course_relation->get_course_id_by_id($v);
					$c_name = $this->course->get_name($c_id);
					echo"$('.course').val('".$c_name."');";
				}  
				
			}
			
			
			
		}    	
	?>    

	$('.del-selected-day').click(function(){
		var date_arr = []; var i=0;
		$.each($('input.date-list'),function(){
			
			if(this.checked==true){
				date_arr[i] = $(this).val();	
			}
			i++;
		});
		
		if(date_arr.length>0){
			url = getURL()+'/index.php/ajaxall/';
			$.ajax({
			   type: "POST",
			   data: {date_arr: date_arr, action: "deleteFromClassList" },
			   url: url,
			   success: function(msg){
			     $('.message').html(msg);
			     //alert(msg);
			   }
			});
		}		 
		//alert('yes');
		
	});
	
	
	$('.add-new-day').click(function(){
		
		$('#addNewDate').modal('toggle');
		
	});
	
	
	$('.addDateBtn').click(function(){
		
		if($('#addNewDate').find('input.time_planid').val()>"" && $('#addNewDate').find('input.class_planid').val()>"" && $('#addNewDate').find('input.date').val()>""  && $('#addNewDate').find('select.type').val()>""){
			
			var  date = $('#addNewDate').find('input.date').val();
			var  class_planid = $('#addNewDate').find('input.class_planid').val();
			var  time_planid = $('#addNewDate').find('input.time_planid').val();
			var  type = $('#addNewDate').find('select.type').val();
			
			url = getURL()+'/index.php/ajaxall/';
			$.ajax({
			   type: "POST",
			   data: {action: "addToClassList",date: date,class_planid: class_planid,time_planid: time_planid,type: type },
			   url: url,
			   success: function(msg){
			     $('#addNewDate .output').html(msg);
			     //alert(msg);
			   }
			});	
			
			//alert($('#addNewDate').find('select.type').val());		
			
		}
		
		
	});

	$('#checkbox99999999999').click(function(){
		
		if(this.checked==true){
			$.each($('.date-list-body').find('.date-list'),function(){
			
				this.checked=true;	
				
			});
			
		}else{
			$.each($('.date-list-body').find('.date-list'),function(){
			
				this.checked=false;	
				
			});			
		}
		//alert("yes");
	});
    
});

function recallRemove(){
   
}
</script>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
//if(!empty($staff_privileges_letter_management['letter_mng_add']) || $this->session->userdata('label')=="admin"){	                	
?>	                

<?php
//}	                	
?>

<?php
	                        $can_del = 0; $can_add = 0; $can_submit = 1; $can_cancel = 1;
	                        $days_list = array();
							$semester_plan_arr = array();
							$semester_plan_arr = $this->semester_plan->get_by_ID($semester_planid);
							$time_plan_arr = array();
							$time_plan_arr = $this->time_plan->get_by_ID($time_planid);
							$class_days = unserialize($class_days);
							
							$chk = $this->class_lists->checkIfClassListsExistByClassPlanID($id);
							
							if(!$chk){

								$days_list = GetDatesOfRangefull($semester_plan_arr['start_date'],$semester_plan_arr['end_date'],$class_days,$semester_plan_arr['teaching_start'],$semester_plan_arr['teaching_end'],$semester_plan_arr['revision_start'],$semester_plan_arr['revision_end'],$submission_date);	                        	
                            	$days_list = array_unique($days_list);
                            	asort($days_list);
                            	
							}else{
                            		$days_list = $this->class_lists->get_class_list_for_days_list_array_by_class_plan_id($id);
                            		$can_del = 1;
                            		$can_add = 1;
                            		$can_submit = 0;
                            		$can_cancel = 0;
							    }	
								
							//var_dump($days_list); die();
?>
                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/class_plan_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post" id="generateDates">
                    
		                <div class="col-lg-12">
			                
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7">
			                			 <h4><i class="fa fa-file-text "></i> Generate Days Form </h4>
			                		</div>
			                		<div class="col-lg-5 col-md-5 col-sm-5">
										<div class="text-right">
<?php
											if($can_add==1){
												echo'<button type="button" class="btn btn-default btn-info add-new-day">Add New Day</button>';	
											}
											if($can_del==1){
												echo'&nbsp;<button type="button" class="btn btn-default btn-danger del-selected-day">Delete</button>';	
											}
											if($can_submit==1){																						
?>										
				                				<button type="submit" class="btn btn-default btn-success">Save</button>
<?php				                			
											}
											if($can_cancel==1){			                			
?>
				                				<button type="reset" class="btn btn-default btn-danger">Cancel</button>
<?php				                			
											}				                			
?>				                			
										</div>

			                		</div>
			                		
			                	</div>
			                

	                        
	                        <div class="form-group">
		                        <div class="col-sm-12 no-pad">
			                            <div class="col-sm-2 no-pad-left">
											<label>Class ID</label>
	                            			<input class="form-control class_planid" type="text" name="class_planid" readonly="readonly">	                            
			                            </div>
			                            <div class="col-sm-2">
											<label>Semester</label>
	                            			<input class="form-control semester" type="text">	                            
			                            </div>
			                            <div class="col-sm-2">
											<label>Course name</label>
	                            			<input class="form-control course" type="text">	                            
			                            </div>
			                            <div class="col-sm-4">
											<label>Module name</label>
	                            			<input class="form-control module" type="text">	                            
			                            </div>
			                            <div class="col-sm-2 no-pad-right">
											<label>Group Name</label>
	                            			<input class="form-control group" type="text">                            
			                            </div>			                            
			                            
			                            
			                            <input type="hidden" class="time_planid" name="time_planid">	                            	                            	                            	                            	                            	                            	                            	                            
			                            <input type="hidden" class="class_planid" name="class_planid">
			                            <div class="clearfix"></div>
			                            	                            	                            	                            	                            	                            	                            	                            	                            
		                        </div>
	                            <div class="clearfix"></div>
	                        </div>
	                        
	                        <div class="form-group days-list" style="margin-top:50px;">
	                        

							<table class="table table-hover">
							<!-- <table class="dTable display"> -->
								<thead>
									<tr>

										
										<th><div class='checkbox checkbox-primary'><input id='checkbox99999999999' type='checkbox' class='form-control select-all-class-plan-list'><label for='checkbox99999999999'>Select Date</label></div></th>
										<th class="text-center">Type</th>
										<th class="text-center">Room No</th>
                                        <th class="text-center">Serial</th>
									</tr>
								</thead>
								<tbody class="date-list-body">

<?php
							$j=1;							
							foreach($days_list as $k=>$v){
								
								$exp = explode("|",$v);
								//var_dump($exp);
								echo"<tr>";
								    if(!empty($exp[2]))
								    	echo"<td><div class='checkbox checkbox-primary'><input name='date[]' id='checkbox".$j."' type='checkbox' class='form-control date-list' value='".$exp[0]."|".$exp[1]."|".$exp[2]."'><label for='checkbox".$j."'>&nbsp;&nbsp;&nbsp;&nbsp;".date("d-m-Y",strtotime($exp[0]))."</label></div></td>";
								    else
								    	echo"<td><div class='checkbox checkbox-primary'><input name='date[]' id='checkbox".$j."' type='checkbox' class='form-control date-list' value='".$exp[0]."|".$exp[1]."'><label for='checkbox".$j."'>&nbsp;&nbsp;&nbsp;&nbsp;".date("d-m-Y",strtotime($exp[0]))."</label></div></td>";
                                    echo "<td align='center'>".$exp[1]."</td>";
                                    echo "<td align='center'>".$room_name."</td>";
                                    echo "<td align='center'>".$j."</td>";
								
								echo"</tr>";
								
									
								$j++;
							}
							
	                        	
?>	                        


								</tbody>
							</table>	                        
	                        
	                        </div>
	                        
	                        
	                        <div class="clearfix"></div>
	                		
			                	<div class="row">
			                		<div class="col-lg-7 col-md-7 col-sm-7"></div>
			                		<div class="col-lg-5 col-md-5 col-sm-5">
			                			<div class="text-right">
<?php
											if($can_add==1){
												echo'<button type="button" class="btn btn-default btn-info add-new-day">Add New Day</button>';	
											}
											if($can_del==1){
												echo'&nbsp;<button type="button" class="btn btn-default btn-danger del-selected-day">Delete</button>';	
											}
																						
											if($can_submit==1){																						
?>										
				                				<button type="submit" class="btn btn-default btn-success">Save</button>
<?php				                			
											}
											if($can_cancel==1){			                			
?>
				                				<button type="reset" class="btn btn-default btn-danger">Cancel</button>
<?php				                			
											}				                			
?>
										</div>
			                		</div>
			                		
			                	</div>
			                

		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<!-- <button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
		           			<div class="col-xs-2"></div>
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> -->
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>

            
            
            
                 <!-- Modal -->
                
                <div class="modal fade" id="addNewDate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Add New Date</h4>
                      </div>
                      <div class="modal-body">
                            
                            <div class="row output"></div>
                            
                            <input type="hidden" class="time_planid" name="time_planid">                                                                                                                                                                                                                                                                
                            <input type="hidden" class="class_planid" name="class_planid">
                              <div class="clearfix"></div>
                              
                              <div class="row">
                                  <div class="col-sm-6"><label>Date:</label><input type="text" class="form-control date" name="date"></div>
                                  <div class="col-sm-6">
                                      <label>Type:</label>
                                      <select name="type" class="form-control type">
                                      <option value="">Please Select</option>
                                      <option value="Revision">Revision</option>
                                      <option value="Teaching">Teaching</option>
                                      <option value="Submit">Submit</option>
                                      </select>
                                  </div>
                                  
                                  
                                  
                                  
                              
                              
                              
                              </div>
                              
                              
                              
                              

                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" name="addDateBtn" class="btn btn-success addDateBtn" id="addDateBtn" ><i class="fa fa-plus"></i> Add Date</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- /.modal -->             
            
            
            
                 <!-- Modal -->
                <div class="modal fade myErorrStatus" id="myErorrStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Warning</h4>
                      </div>
                      <div class="modal-body">
                      <div class="alert alert-warning">      
                      <p>Please select days first.</p>		
                      </div>
                      </div>
                      <div class="modal-footer">
                         <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->             
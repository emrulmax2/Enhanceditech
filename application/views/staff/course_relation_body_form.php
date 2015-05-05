<script type="text/javascript">

$(document).ready(function(){
     


	<?php
		if(!empty($course_relation) && is_array($course_relation)){
			foreach($course_relation as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');"; 
				if($k=="semester_id" || $k=="course_id" || $k=="awarding_id" || $k=="available") echo "$('select[name=$k]').val('".tinymce_decode($v)."');";	
				else echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
			}
		}    	
	?>    
		
        addNewTerm();
        
        
		$('.uk_area').hide();	
		$('.overseas_area').hide();

		$('select[name=available]').change(function(){
			
			if($(this).val()=="uk"){

				$('.overseas_area').hide();
				$('.uk_area').fadeIn('slow');
				

			}else if($(this).val()=="overseas"){
				$('.overseas_area').fadeIn('slow');
				$('.uk_area').hide();		
				
			}else if($(this).val()=="both"){
				$('.uk_area').fadeIn('slow');
				$('.overseas_area').fadeIn('slow');
			} else {
				$('.uk_area').fadeOut();	
				$('.overseas_area').fadeOut();
			}
			
		});
		var available = $('select[name=available]').val();

		if(available == "uk")
		{
			$('.uk_area').show();
		} 
		else if (available == "overseas")
		{
			$('.overseas_area').show();
		}
		else if(available == "both")
		{
			$('.uk_area').show();
			$('.overseas_area').show();		
		}


    if($('select[name=available]').val()!="overseas"){
		
		$(".slc-create-panel").show();
		$(".slc-create-panel").find('input').attr("required",true);
    }else{
		$(".slc-create-panel").hide();
		
		$(".slc-create-panel").find('input').removeAttr("required");
    }
    
    $('select[name=available]').change(function(){
		
		    if($(this).val()!="overseas"){
				
				$(".slc-create-panel").show();
				$(".slc-create-panel").find('input').attr("required",true);
		    }else{
				$(".slc-create-panel").hide();
				
				$(".slc-create-panel").find('input').removeAttr("required");
		    }		
    });
    
    var count=1;
    $.each($('.instance-area').find('.instance-row'),function(){
        count++;
    }); 
 
    $(".add-new-instance").click(function(){
        
        //var row_data ='<div class="installment-row"><div class="col-sm-5 no-pad-left"><input type="text" id="form-input-dt'+count+'" class="installment_date form-control date" name="installment_date[]"></div><div class="col-sm-5"><input type="text" class="amount form-control" name="amount[]"></div><div class="col-sm-2 no-pad-right text-right"><a href="#" class="btn btn-danger del-row"><i class="fa fa-times-circle"></i></a></div><p class="clearfix"></p></div>';   
        var row_data ='<div class="instance-row margin-height"><div class="col-sm-2 no-pad-left">Instance Period '+count+':</div><div class="col-sm-4"><input id="form-input-dt-l-'+count+'" type="text" class="form-control instance_start_date" name="instance_start_date[]"></div><div class="col-sm-4"><input type="text" id="form-input-dt-r-'+count+'" class="form-control instance_end_date" name="instance_end_date[]"></div><div class="col-sm-2 no-pad-right text-right"> <button type="button" class="btn btn-primary add-new-term"><i class="fa fa-plus"></i>Add Term</button> <button type="button" class="remove-instance-row btn btn-danger"><i class="fa fa-times"></i></div><div class="clearfix"></div><div class="term-area margin-height"></div></div>';   

        $('.instance-area').append(row_data);
        $("#form-input-dt-l-"+count).datepicker({ dateFormat: "dd-mm-yy" });
        $("#form-input-dt-r-"+count).datepicker({ dateFormat: "dd-mm-yy" });
        //del_row_function(); getDateFormat(); calculateRemaining();
        removeInstanceRow();
        addNewTerm();
        
        count++;                                                
                                                
                                                
                                                    
    });


    

			    
	function recallRemove(){
	    $('.remove-btn').click(function(){

	    	var duration = $('input[name=duration]').val();
	    	var course_relation = $('input[name=ref_id]').val();
	            
	        var id = $(this).attr('id'); //alert(id);
	        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromList2(\''+id+'\',\'slc_coursecode\',\''+duration+'\',\''+course_relation+'\')');
	        $('#myModal').css({'top':'30%'});
	        $('#myModal').modal('hide');
	        $('#myModal').modal('toggle');
	        
	    });   
	        //
	}
	recallRemove();
});

function removeInstanceRow(){

    $(".remove-instance-row").click(function(){
        
        $(this).closest(".instance-row").remove();
/*        var i = 0;
        $.each($('.instance-area').find('.instance-row'),function(){
            
             i++;
            
        });
        if(i==0){
           count = 1; 
        }*/
        
    });    
    
}

function addNewTerm(){

    
    $(".add-new-term").click(function() {
    var calc=1;
    $.each($('.term-area').find('.term-row'),function(){
        calc++;
    });
        
        var appened_text = "<div class='col-md-12 no-pad-right term-row'><div class='col-md-2'></div><div class='col-md-3' style='padding-left: 5px;'><div class='form-group'><label>Term Name</label><input class='form-control' type='text' name='fees_1'></div></div><div class='col-md-2'><div class='form-group'><label>Start date</label><input id='date_calender_f_"+calc+"' class='form-control' type='text' name='fees_1'></div></div><div class='col-md-2'><div class='form-group'><label>End date</label><input id='date_calender_l_"+calc+"' class='form-control' type='text' name='fees_1'></div></div><div class='col-md-2 no-pad-right'><div class='form-group'><label>Total Teaching Week</label><input class='form-control' type='text' name='fees_1'></div></div><div class='col-md-1 no-pad teaching-week'><button type='button' class='remove-term-row btn btn-danger'><i class='fa fa-times'></i></button></div></div>";
        $(this).parent().siblings('.term-area').append(appened_text);

        $("#date_calender_f_"+calc).datepicker({ dateFormat: "dd-mm-yy" });
        $("#date_calender_l_"+calc).datepicker({ dateFormat: "dd-mm-yy" });
        
        delete_term();

    });    
}

function delete_term() {
	$(".remove-term-row").click(function() {

		$(this).parents('.term-row').remove();
	});
}



</script>

<style>
	.remove-term-row {
		margin-top: 25px;
	}
	.teaching-week {
		text-align: right;
	}
</style>


                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){	                	
?>		                
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>/index.php/course_relation_management/?action=add"><i class="fa fa-plus"></i> Add Course Relation</a>
<?php
}	                	
?>                 		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>/index.php/course_relation_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12">                
	                	<?php echo $message; ?>
	                	<?php 
	                	if($this->session->flashdata('message')) {
	                	 echo $this->session->flashdata('message');
	                	}
	                	?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post">
                    
		                <div class="col-lg-12">
		                
		                		<div class="row">
			                		<div class="col-lg-9 col-md-9 col-sm-9">
			                			 <h4><i class="fa fa-file-text "></i> Course Relation Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
                                
				                        <div class="form-group">
				                            <label>Semester</label>
											<select class="form-control" name="semester_id" required>
											  <option value="">Please Select</option>
<?php
												foreach($semister_list as $k=>$v){											  	
?>											  
											  		<option value="<?php echo $v['id']; ?>"><?php echo $v['semister_name']; ?></option>
<?php
												}
?>												  
											</select>
				                        </div>
				                        
				                        <div class="form-group">
				                            <label>Course</label>
											<select class="form-control" name="course_id" required>
											  
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
				                        
				                        
				                        <div class="form-group">
				                            <label>Awarding Body</label>
											<select class="form-control" name="awarding_id">
											  <option value="">Please Select</option>
<?php
												foreach($awarding_body_list as $k=>$v){											  	
?>											  
											  		<option value="<?php echo $v['ID']; ?>"><?php echo $v['name']; ?></option>
<?php
												}
?>												  
											</select>
				                        </div>
				                        
				                        
				                        <div class="form-group">
				                            <label>Duration</label>
				                            <input required class="form-control level_count" type="number" min="1" name="duration">
				                        </div>
                                        
                                        <div class="form-group">
                                            <label>UNITLGTH</label>
                                            <select class="form-control" name="hesa_unitlgth_id">
                                              <option value="">Please Select</option>
<?php
                                                foreach($hesa_unitlgth_list as $k=>$v){
                                                    
                                                    if($v['id'] == $hesa_course_relation_unitlgth_data['hesa_unitlgth_id']){                                                  
?>                                              
                                                      <option selected="selected" value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
<?php
                                                    }else{
?> 
                                                      <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>                                                       
<?php                                                        
                                                    }
                                                }
?>                                                  
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Major source of tuition fees</label>
                                            <select class="form-control" name="hesa_mstufee_id">
                                              <option value="">Please Select</option>
<?php
                                                foreach($hesa_mstufee_list as $k=>$v){                                                    
?> 
                                                      <option <?php if(!empty($hesa_course_relation_unitlgth_data['hesa_mstufee_id']) && $v['id'] == $hesa_course_relation_unitlgth_data['hesa_mstufee_id']) echo "selected='selected'" ?> value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>                                                       
<?php                                                                                                            
                                                }
?>                                                  
                                            </select>
                                        </div>                                                                                

                                        <div class="form-group text-right">
                                            <button type="button" class="btn btn-primary add-new-instance"><i class="fa fa-plus"></i> Add instance</button>
                                        </div>
                                        
                                        <div class="form-group instance-area">
                                        
                                            <div class="">
                                                <div class="col-sm-2 no-pad-left"><label>Instance Period</label></div>
                                                <div class="col-sm-4"><label>Instance Start Date</label></div>
                                                <div class="col-sm-4"><label>Instance End Date</label></div>
                                                <div class="col-sm-2 no-pad-right text-right"><label>Remove</label></div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <!--<div class="instance-row">
                                                <div class="col-sm-6 no-pad-left"><input type="text" class="form-control instance_start_date" name="instance_start_date[]"></div>
                                                <div class="col-sm-6 no-pad-right"><input type="text" class="form-control instance_start_date" name="instance_end_date[]"></div>
                                                <div class="clearfix"></div>
                                            </div>-->
<?php                                            
                                        if(!empty($hesa_course_relation_instance_list)){
                                            $i=1;                                            
                                            foreach($hesa_course_relation_instance_list as $k=>$v){
                                                
                                             echo'<div class="instance-row margin-height"><div class="col-sm-2 no-pad-left">Instance Period '.$i.':</div><div class="col-sm-4"><input id="form-input-dt-l-'.$i.'" type="text" class="form-control instance_start_date date" name="instance_start_date[]" value="'.date("d-m-Y",strtotime($v['start_date'])).'"></div><div class="col-sm-4"><input type="text" id="form-input-dt-r-'.$i.'" class="form-control instance_end_date date" name="instance_end_date[]" value="'.date("d-m-Y",strtotime($v['end_date'])).'"></div><div class="col-sm-2 no-pad-right text-right"> <button type="button" class="btn btn-primary add-new-term"><i class="fa fa-plus"></i>Add Term</button> <button type="button" class="remove-instance-row btn btn-danger"><i class="fa fa-times"></i></div><div class="clearfix"></div><div class="term-area margin-height"></div></div>';   
                                             $i++;   
                                            }
                                            echo"<script>removeInstanceRow();</script>";
                                        }
                                                                                    
                                            
?>                                        
                                        </div>
				                        
				                        <div class="form-group">
				                            <label>Degree Offered</label>
				                            <input class="form-control" type="text" name="degree_offered">
				                        </div>
				                        
				                        <div class="form-group">
				                            <label>Pre Qualification</label>
				                            <input class="form-control" type="text" name="pre_qualification">
				                        </div>	
				                        
				                        <div class="form-group">
				                            <label>Available</label>
											<select class="form-control" name="available" required>
											  <option value="">Please Select</option>											  
											  <option value="overseas">overseas</option>											  
											  <option value="uk">uk</option>											  
											  <option value="both">both</option>											  
											</select>
				                        </div>
				                   <div class="clearfix"></div>     	
				                   <div class="uk_area col-sm-6 no-pad-left" >     
				                        <div class="form-group">
				                            <label>Admission Startdate (UK)</label>
				                            <input class="form-control date" type="text" name="admission_startdate_1">
				                        </div>				                        			                        					                        			                        				                        				                        

				                        <div class="form-group">
				                            <label>Admission Enddate (UK)</label>
				                            <input class="form-control date" type="text" name="admission_enddate_1">
				                        </div>

				                        <div class="form-group">
				                            <label>Fees (UK)</label>
				                            <input class="form-control" type="number" name="fees_1">
				                        </div>
				                        
				                        <div class="form-group">
				                            <label>Reg Fees (UK)</label>
				                            <input class="form-control" type="number" name="reg_fees_1">
				                        </div>
				                        
				                        <div class="form-group">
				                            <label>Class Startdate (UK)</label>
				                            <input class="form-control date" type="text" name="class_startdate_1">
				                        </div>	
				                        
				                        <div class="form-group">
				                            <label>Class Enddate (UK)</label>
				                            <input class="form-control date" type="text" name="class_enddate_1">
				                        </div>	
				                        
				                        <div class="form-group">
				                            <label>Last Joiningdate (UK)</label>
				                            <input class="form-control date" type="text" name="last_joiningdate_1">
				                        </div>
				                    </div>    
				                    <div class="overseas_area col-sm-6 no-pad-right no-pad-left">    
				                        <div class="form-group">
				                            <label>Admission Startdate (Overseas)</label>
				                            <input class="form-control date" type="text" name="admission_startdate_2">
				                        </div>	
				                        
				                        <div class="form-group">
				                            <label>Admission Enddate (Overseas)</label>
				                            <input class="form-control date" type="text" name="admission_enddate_2">
				                        </div>	
				                        
				                        <div class="form-group">
				                            <label>Fees (Overseas)</label>
				                            <input class="form-control" type="number" name="fees_2">
				                        </div>	
				                        
				                        <div class="form-group">
				                            <label>Reg Fees (Overseas)</label>
				                            <input class="form-control" type="number" name="reg_fees_2">
				                        </div>	
				                        
				                        <div class="form-group">
				                            <label>Class Startdate (Overseas)</label>
				                            <input class="form-control date" type="text" name="class_startdate_2">
				                        </div>
				                        
				                        <div class="form-group">
				                            <label>Class Enddate (Overseas)</label>
				                            <input class="form-control date" type="text" name="class_enddate_2">
				                        </div>
				                        
				                        <div class="form-group">
				                            <label>Last Joiningdate (Overseas)</label>
				                            <input class="form-control date" type="text" name="last_joiningdate_2">
				                        </div>
				                        
				                        


				                    </div>

		                        	<div class="clearfix"></div>

									<div class="panel panel-info slc-create-panel">
						                <div class="panel-heading"><i class="fa fa-sitemap"></i> SLC Year and Code </div>
						                <div class="panel-body">
											<div class="level_show">
												<!-- This div to show level field from jquery -->
												<?php if(!empty($scl_code)) {?>
												<?php $x=1; foreach($scl_code as $k=>$v) {?>
													<div class='row'>
														<div class='col-lg-5'>
															<div class='form-group'>
															<label>Year</label>
															<input type="hidden" name="yearid<?php echo $x ?>" value="<?php echo $v['id'] ?>">
															<input class='form-control' required type='text' name="year<?php echo $x ?>" value="<?php echo $v['year'] ?>" readonly />
															</div>
														</div>
														<div class='col-lg-5'>
															<div class='form-group'>
															<label>Slc Code</label>
															<input class='form-control' type='text' required name="slc<?php echo $x ?>" value="<?php echo $v['slc_code'] ?>" />
															</div>
														</div>
														<div class="col-lg-2" style="margin-top: 25px;">
															<a href='javascript:void(0);' class='btn btn-sm btn-danger remove-btn' id="<?php echo $v['id'] ?>"><i class='fa fa-times'></i> Delete</a>
														</div>
													</div>
												<?php $x++; } ?>
												<?php } ?>
											</div>
											<div class="level_show2">
												
											</div>
										</div>
									</div>
									

			                        <div class="row">
				                		<div class="col-lg-9 col-md-9 col-sm-9"></div>
				                		<div class="col-lg-3 col-md-3 col-sm-3">
				                			<div class="text-right">
					                			<button type="submit" class="btn btn-default btn-success">Submit</button>
					                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
											</div>
				                		</div>
				                	</div>	
		                           <div class="clearfix"></div>
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
<script>
	$(document).ready(function() {
		
		//if($('.level_count')){
				var events = ['click', 'keyup'];
				var total_level = [];
				var ll = $('.level_count').val();
				//alert(ll);
				var found = $('.level_show').find('.row .col-lg-5');
				
				var new_ll = Math.floor(found.length/2);
				

				if(new_ll<ll)
				{
					for (var i = new_ll+1; i <= ll; i++) {
								
						total_level.push(
							"<div class='row'><div class='col-lg-5'><div class='form-group'><label>Year</label><input class='form-control' type='text' name='year"+i+"' value='"+i+"' readonly /></div></div><div class='col-lg-5'><div class='form-group'><label>Slc Code</label><input class='form-control' type='text' name='slc"+i+"' /></div></div></div>"
						);

					};
					
					$('.level_show').append(total_level);
				}
				

				$.each(events, function(index, val) {
					$('.level_count').on(val, function() {
						var total_level = [],
							level = parseInt( $(this).val() );
							//var new_level = level - ll;
						if(ll<1) {
							ll = 0;
						}
						for (var i = ll; i < level; i++) {
							var n = parseInt(i)+1;

							total_level.push(
								"<div class='row'><div class='col-lg-5'><div class='form-group'><label>Year</label><input class='form-control' required type='text' name='year"+n+"' value='"+n+"' readonly /></div></div><div class='col-lg-5'><div class='form-group'><label>Slc Code</label><input class='form-control' type='text' required name='slc"+n+"' /></div></div></div>"
							);

						};
						
						$('.level_show2').html(total_level).slideDown(1000);
						
					})
				});
		
		//}
	});
</script>

<!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm delete</h4>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger confirm-btn">Yes</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
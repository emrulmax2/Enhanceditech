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

/*	$('.del-selected-day').click(function(){
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
	});*/
	
	$('.upload-file-btn').click(function(){
		
		//alert('ok');
		$('#uploadCSV').modal('show');
		
		
	});	
	
	$('.upload-csv-btn').click(function(){
		
		$('.message').html('');	
		var i=0;
		var filename="";
		var filepath = "";		
		$.each($('#uploadCSV').find('input.documentfile'),function(){
			//alert($(this).val());
			if(i==0){
				filename=$(this).val();
				filepath = "uploads/files/"+filename;
			}	
			//var url = '<?php //echo base_url(); ?>'+filepath;
			i++;				
			
		});
		//alert(filepath);
		$(".loading").show();
		
		
			url = getURL()+'/index.php/ajaxall/';
			$.ajax({
			   type: "POST",
			   data: {action: "addMultiPaymentFromCSVFile",file: filepath },
			   url: url,
			   success: function(msg){
			   	 $(".loading").hide();  
			     $('.message').html(msg);
			     //alert(msg);
			   }
			});		
		
				
		
	});
	
	
	$('#excuse_document .upload-file-btn').click(function(){
		
		//alert('hi');
		$('file-list-group').html('');
		$.each($('#excuse_document').find('input.documentfile'),function(){
			
			var filename=$(this).val();
			var filepath = "uploads/files/"+filename;
			var url = '<?php echo base_url(); ?>'+filepath;
			$('.file-list-group').append("<a target='_blank' href='"+url+"' class='list-group-item' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"'></a>");
				
			
		});
		
	});	
	
	
	
	
    
});

function recallRemove(){
   
}
function addMatchedRow(){
	
	  $('button.add-matched-row').click(function(){
	  	  
	  	  
	  	  var agreement_id_arr = [];
	  	  var amount_arr = [];
	  	  //var remarks_arr = [];
	  	  var payment_date_arr = [];
	  	  //var received_by_staff_arr = [];
	  	  //var payment_mode_arr = [];
	  	 // var refund_invoice_no 
		  var invoice_no_arr = [];
		  var register_id_arr = [];
		  
		  $.each($('.matched-row-tbody').find('tr.matched-row'),function(){
			  
			  agreement_id_arr.push($(this).attr("agreement_id"));
			  amount_arr.push($(this).attr("amount"));
			  payment_date_arr.push($(this).attr("payment_date"));
			  invoice_no_arr.push($(this).attr("invoice_no"));
			  register_id_arr.push($(this).attr("register_id"));

					url = getURL()+'/index.php/ajaxall/';
					$.ajax({
					   type: "POST",
					   data: {action: "addMultiPaymentFromCSVFileConfirm",agreement_id_arr: agreement_id_arr, amount_arr:amount_arr, payment_date_arr:payment_date_arr, invoice_no_arr:invoice_no_arr, register_id_arr:register_id_arr },
					   url: url,
					   success: function(msg){
			   			 //$(".loading").hide();  
					     $('.message').prepend(msg);
					     //alert(msg);
					   }
					});
			  
		  });
		  
		  
	  });
	
	
}
function removeMatchedRow(){
	
		$('.remove-matched-row').click(function(){
			
			$(this).closest("tr").remove();
			chkForBlankMatchedRow();
		});	
	
}
function chkForBlankMatchedRow(){
    var i=0;
	$.each($("tr.matched-row"),function(){
		
		i++;
		
	});
	
	if(i==0){
		//alert("YESSSSSSSSSSSSS");
		$('tbody.matched-row-tbody').html("<tr><td colspan='7'>No data row found.</td></tr>");
		$('button.add-matched-row').hide();
	}else{
		//alert("NOOOOOOOOOO");
		$('button.add-matched-row').show();
	}	
	
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

                		
                	<?php if(!empty($priv[0]) || $this->session->userdata('label')=="admin"){ ?>	<a class="btn btn-md btn-info upload-file-btn" href="javascript:void(0)"><i class="fa fa-cloud-upload"></i> Upload Payment File (csv)</a> <?php } ?>
                		 <img class="loading" src="<?php echo base_url(); ?>/images/loading.gif" alt="">
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12 message">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

            
            
            
         <!-- Modal -->
                <div class="modal fade" id="uploadCSV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Documents</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group">
                      <label class="margin-top-2">Upload Document (<i class="alert-warning">file size no more than 10mb</i>) </label><br/>
                          <span class="btn btn-primary fileinput-button">
                            <i class="fa fa-plus"></i>
                            <span>Add file</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="files[]" multiple>
                            
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
                        <!-- <button type="button" name="uploadDoc_do_it_online" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button> -->
                        <button type="button" class="btn btn-info upload-csv-btn" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                        <!--<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>-->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->   
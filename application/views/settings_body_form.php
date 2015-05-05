<style>
	.btn-minus,.btn-minus-first {
		cursor: pointer;
		margin-top: 27px;
		color: red;
	}
</style>
<script type="text/javascript">

$(document).ready(function(){

	<?php
        if($settings && is_array($settings)){
            foreach($settings as $k=>$v){
                //$val=tinymce_encode($v);
                  // var_dump($val);
                //if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
                if($k == "address")
                echo "$('textarea[name=$k]').val('".tinymce_decode($v)."');";    
                else if($k == "smtp_encryption" || $k == "smtp_authentication" || $k == "currency_id")
                echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
                else
                echo "$('input[name=$k]').val('".tinymce_decode($v)."');";    
            }
        }        
    ?>
    
    $("#add-campus").on('click', function(e) {
    	//e.preventDefault();
    	
        var how_much = 1;
        $.each($(".campus-area").find('.single-campus'),function()
        {    
            how_much++;    
        });
        
        
    	if(how_much == 1) {
    		$(".campus-area").append('<div class="single-campus"><div class="col-lg-2" style="margin-top: 27px;">Campus <i class="how-much">'+how_much+'</i></div><div class="col-lg-4"><div class="form-group"><label>Name</label><input class="form-control" required type="text" name="campus_name[]"></div></div><div class="col-lg-5"><div class="form-group"><label>Address</label><input class="form-control" type="text" required name="campus_address[]"></div></div><div class="col-lg-1"><div id="" class="form-group btn-minus-first"><label></label><i class="fa fa-2x fa-minus-circle"></i></div></div></div>');
    		<?php 
    		echo '
			
			$(".btn-minus-first").hide();
			
    		$(".btn-minus-first").on(\'click\', function() {
				if($(this).attr(\'id\') == "" ) {
					$(this).closest(\'.single-campus\').remove();
				}				
			});';

    		 ?>
    	} else {
    		$(".campus-area").append('<div class="single-campus"><div class="col-lg-2">Campus <i class="how-much">'+how_much+'</i></div><div class="col-lg-4"><div class="form-group"><label></label><input class="form-control" type="text" required name="campus_name[]"></div></div><div class="col-lg-5"><div class="form-group"><label></label><input class="form-control" type="text" required name="campus_address[]"></div></div><div class="col-lg-1"><div id="" class="form-group btn-minus" style="margin-top:5px;margin-left: 5px;"><label></label><i class="fa fa-2x fa-minus-circle"></i></div></div></div>');
    		<?php 
    		echo '

    		var cam = $(".single-campus");
			if(cam.length>1) {
				$(".btn-minus-first").hide();
			}

    		$(".btn-minus").on(\'click\', function() {
				if($(this).attr(\'id\') == "" ) {

					$(this).closest(\'.single-campus\').remove();
	                
					var l=1;
					$.each($(".single-campus").find(".how-much"), function() {
						 $(this).html(l);
						l++;
					});
					
					var cam = $(".single-campus");
					
					if(cam.length==1) {
						$(".btn-minus-first").show();
					}
				}

				
			});';

    		 ?>
    	}
    	
    });

	$(".btn-minus").on('click', function() {
		var id = $(this).attr('id');
		if( id != "" ) {

	        $('#myModal').find('.confirm-btn').attr('onclick','RemoveFromCampus(\''+id+'\',\'campus_info\')');
		    $('#myModal').css({'top':'30%'});

		    

	        $('#myModal').modal('hide');
	        $('#myModal').modal('toggle');
			
		}


	});	

    
});

</script>


                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <i class="fa fa-fw fa-gear"></i> Settings Management
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-gear"></i> Settings
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
	                <div class="col-lg-12">

	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12">                
	                	<?php if(!empty($message))echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post">
                    
		                <div class="col-lg-12">
		                
		                <h4><i class="fa fa-file-text "></i> Settings Form </h4>
                                
		                        <div class="form-group">
		                            <label>Company Name</label>
		                            <input class="form-control" type="text" name="company_name" required>
		                        </div>

		                        <div class="form-group">
		                            <label>Address</label>
		                            <textarea rows="3" class="form-control" name="address" required></textarea>
		                        </div>	
		                        		                        
		                        <div class="form-group">
		                            <label>Phone</label>
		                            <input class="form-control" type="text" name="phone">
		                        </div>		                        		                        	                        

		                        <div class="form-group">
		                            <label>Start Date</label>
		                            <input class="form-control date" type="text" name="start_date">
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>End Date</label>
		                            <input class="form-control date" type="text" name="end_date">
		                        </div>		                        		                        		                        
		                    
                                <div class="form-group">
                                    <label>College's Terms and condition Link</label>
                                    <input class="form-control" type="text" name="college_terms" placeholder="http://www.example.com/terms">
                                </div>                                                                                                
		                        <div class="form-group">
		                            <label>Logo Url: </label>
		                            <input class="form-control" type="text" name="logo_url" placeholder="http://www.example.com/images/logo.png" required>
		                        </div>	
								<div class="form-group">
		                            <label>Print Logo Url: </label>
		                            <input class="form-control" type="text" name="print_logourl" placeholder="http://www.example.com/images/printlogo.png" required>
		                        </div>
		                        <div class="form-group">
		                            <label>Select Currency: </label>
		                            <select class="form-control" name="currency_id" id="">
		                            	<option value="">Please Select</option>
		                            <?php foreach($currency_list as $k=>$v) {?>
		                            	<option value="<?php echo $v['id'] ?>"><?php echo $v['currency_name'] ?></option>
		                            <?php } ?>
		                            </select>
		                        </div>

		                        <div class="form-group">
		                            <label>HESA College Unique Code Identifier: </label>
		                            <input class="form-control" type="text" name="hcuci">
		                        </div>

		                        <div class="form-gruop">
		                        	<button type="button" style="margin-bottom:20px;" id="add-campus" class="btn btn-success"><i class="fa fa-plus"></i> Add New Campus</button>
		                        </div>

		                        <div class="campus-area">
		                        	<?php if (!empty($campus_info)) { ?>
		                        		<?php $i=1; ?>
		                        		<?php foreach($campus_info as $k=>$v) {?>
											<div class="single-campus">
												<div class="col-lg-2" <?php if($i==1) {?>style="margin-top: 27px;" <?php } else{ ?>style="" <?php } ?> >
													Campus <i class="how-much"><?php echo $i; ?></i>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<?php if($i==1) {?>
															<label>Name</label>
														<?php } ?>
														<input class="form-control" type="text" name="campus_name[]" value="<?php echo $v['name'] ?>">
														<input type="hidden" name="campus_id[]" value="<?php echo $v['id'] ?>">
													</div>
												</div>
												<div class="col-lg-5">
													<div class="form-group">
														<?php if($i==1) {?>
															<label>Address</label>
														<?php } ?>
														<input class="form-control" type="text" name="campus_address[]" value="<?php echo $v['address'] ?>">
													</div>
												</div>
												<div class="col-lg-1">
													<div id="<?php echo $v['id'] ?>" class="form-group btn-minus" <?php if($i==1) {?>style="margin-top: 27px;" <?php } else{ ?>style="margin-top: 0px;" <?php } ?>>
														<label></label>
														<i class="fa fa-2x fa-minus-circle"></i>
													</div>
												</div>
											</div>
										<?php $i++; } ?>

		                        	 <?php } ?>
		                        </div>

		                        <div class="clearfix"></div>
		                        <p class="divider"></p>

								<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">Setting Up SMTP</h3>
									</div>
									<div class="panel-body">
									 
				                        <div class="form-group">
				                            <label>SMTP Email Address / Username [Username to use for SMTP authentication]</label>
				                            <input class="form-control" type="text" name="smtp_user" required>
				                        </div>				                        
				                        <div class="form-group">
				                            <label>SMTP Email Address's password [Password to use for SMTP authentication]</label>
				                            <input class="form-control" type="text" name="smtp_pass" required>
				                        </div>				                        
				                        <div class="form-group">
				                            <label>SMTP Host [Set the hostname of the mail server]</label>
				                            <input class="form-control" type="text" name="smtp_host" required>
				                        </div>				                        
				                        <div class="form-group">
				                            <label>SMTP Port [Set the SMTP port number - 25 ]</label>
				                            <input class="form-control" type="text" name="smtp_port" required>
				                        </div>
				                        <div class="form-group">
				                            <label>SMTP Encryption System [Set the encryption system to use - ssl (deprecated) or tls]</label>
				                            <select class="form-control" name="smtp_encryption" >
				                            	<option value="">Please Select</option>
				                            	<option value="ssl">SSL</option>
                                                <option value="tls">TLS</option>
                                                <option value="">none</option>
				                            </select>
				                        </div>
				                        <div class="form-group">
				                            <label>SMTP Authentication [Whether to use SMTP authentication]</label>
				                            <select class="form-control" name="smtp_authentication" required>
				                            	<option value="">Please Select</option>
				                            	<option value="true">True</option>
				                            	<option value="false">False</option>
				                            </select>
				                        </div>				                        				                        
				                        
									</div>
								</div>		                        		                        		                        		                        
		                    
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<button type="submit" class="btn btn-default btn-success col-xs-5">Update</button>
		           			<div class="col-xs-2"></div>
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button>
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>
            <!-- /.container-fluid -->

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Confirm delete</h4>
                      </div>
                      <div class="modal-body">
                      	<div class="msg"></div>
                        Are you sure you want to delete?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-danger confirm-btn">Yes</a>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
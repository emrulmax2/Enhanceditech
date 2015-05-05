
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if($user_data && is_array($user_data)){
			foreach($user_data as $k=>$v){
                if($k!="password" && $k != "usertype")
				echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
                else if($k == "usertype")
                echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
			}
		}    	
	?>    
    
});

function recallRemove(){
   
}

    $('#userProfileform').submit(function(){
        
        $('#update_student_info').modal('show');
        
            
    });
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                
                
                <div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {  ?>              
	                	 
                         <div class="alert alert-success ">
                        <p><span class="glyphicon glyphicon-ok"></span> <?php echo $message; ?></p>
                    </div>  

                     <?php } ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" id="userProfileform" method="post">
                    
		                <div class="col-lg-12">
		                
		                <h4><i class="fa fa-file-text "></i> Profile Information Form </h4>
                        
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" placeholder="example@example.com">
                                </div>
                                                       		                                    
                        <div class="form-group">
            			<div class="divider"></div> 
                        <h4><i class="fa fa-file-text "></i> Change password information </h4>
                                    <label>Old password</label>
                                    <input required class="form-control" type="password" name="oldpassword" placeholder="" >
                                </div>              
                                <div class="form-group">
                                    <label>Password</label>
                                    <input required class="form-control password" type="password" name="password">
                                </div>      
                                <div class="form-group">
                                    <label>Retype Password</label><label class="retypepassword"></label>
                                    <input required class="form-control repassword" type="password" name="repassword">
                                </div>    		                        
                                	
                                	                    
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
                        
		           			<button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
                            
		           			<div class="col-xs-2"></div>
                            
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> 	        
                                
                        </div>
               </form>
               
               
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>


    <!-- Modal -->
                <div class="modal fade" id="update_student_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Warning!</h4>
                      </div>
                        
                      <div class="modal-body">
                            <div class="msg"></div>
                             <div class="form-group">
                                <input type="hidden" name="student_id" value="<?php echo $this->session->userdata('uid'); ?>">
                                <h4><i class="fa fa-file-text "></i> Enter current password </h4>
                                <label>Password</label>
                                <input class="form-control" type="password" name="cnfpassword" placeholder="" >
                            </div> 
                      </div>
                      <div class="modal-footer"><img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <button type="button" class="btn btn-primary" name="update_student_info">Update</button>
                      </div>
                       
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
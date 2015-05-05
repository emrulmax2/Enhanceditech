
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
			

			 <form role="form" id="userProfileform" method="post">
			 	<?php if(!empty($message)) {?>
			 	<div class="col-lg-10">
                             
	                	 
                         <div class="alert alert-success ">
                        <p><span class="glyphicon glyphicon-ok"></span> <?php echo $message; ?></p>
                    </div>  

                     
                </div>
                <?php } ?>
                    
		                <div class="col-lg-10">
		                
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

		           		
		           		
		           		
		           		<div class="col-lg-10">
		           		
                        
		           			<button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
                            
		           			<div class="col-xs-2"></div>
                            
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> 	        
                                
                        </div>
               </form>
		
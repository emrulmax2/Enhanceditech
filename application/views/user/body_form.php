
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
</script>

        <div id="page-wrapper">

            <div class="container-fluid">

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
                		<a class="btn btn-md btn-info" href="<?php echo current_url(); ?>/?action=list"><i class="fa fa-list"></i> Back to List</a>
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if($message!="") {                
	                	 echo $message;

                     } ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" id="userform" method="post">
                    
		                <div class="col-lg-12">
		                
		                <h4><i class="fa fa-file-text "></i> User Add Form </h4>
                                
		                        <div class="form-group">
		                            <label>User Name</label>
		                            <input class="form-control username" type="text" name="username">
		                        </div>	                        		                                                    
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control password" type="password" name="password">
                                </div>      
                                <div class="form-group">
                                    <label>Retype Password</label><label class="retypepassword"></label>
                                    <input class="form-control repassword" type="password" name="repassword">
                                </div>    		                        
                                <div class="form-group">
		                            <label>Email</label>
		                            <input class="form-control" type="email" name="email" placeholder="example@example.com">
		                        </div>	
                                <div class="form-group">
                                    <label>User type</label>
                                    <select class="form-control" name="usertype">
                                    <option value="user"> User</option>
                                    <option value="manager"> Manager</option>
                                    <option value="admin"> Admin</option>
                                            
                                        
                                    </select>
                                </div>	                    
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
		           			<button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
		           			<div class="col-xs-2"></div>
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button>
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
<?php //var_dump($user_data); ?>
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if($user_data && is_array($user_data)){
			foreach($user_data as $k=>$v){
                //if($k!="password" && $k != "usertype")
				//echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
                //else if($k == "usertype")
                //echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
                if($k=="staff_email"){
					echo"$('input[name=staff_email]').val('".tinymce_decode($v)."');";	
					echo"$('input[name=staff_email]').attr('readonly',true);";	
                }
			}
		} 
		
		   	
	?>    
    
});

function recallRemove(){
   
}
</script>



            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                
                
                <div class="row">
	                
	                <div class="col-lg-12" style="padding-top: 10px;">
                    <?php if(!empty($message)) {  ?>              
	                	 
                         <div class="alert alert-success ">
                        <p><span class="glyphicon glyphicon-ok"></span> <?php echo $message; ?></p>
                    </div>  

                     <?php } ?>
                    <?php if(!empty($err)) {  ?>              
	                	 
                         <div class="alert alert-warning ">
                        <p><span class="glyphicon glyphicon-remove"></span> <?php echo $err; ?></p>
                    </div>  

                     <?php } ?>                     
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" id="userform" method="post">
                    
		                <div class="col-lg-12">
		                
		                        
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                         <h4><i class="fa fa-file-text "></i> Profile Information Form </h4>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-default btn-success">Submit</button>
                                            <button type="reset" class="btn btn-default btn-danger">Cancel</button>
                                        </div>

                                    </div>
                                    
                                </div>

                        
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="staff_email" placeholder="example@example.com">
                                </div>
                                                       		                                    
                                <div class="form-group">
                    			<div class="divider"></div> 
                                <h4><i class="fa fa-file-text "></i> Change password information </h4>
                                    <label>Old password</label>
                                    <input class="form-control" type="password" name="oldpassword" placeholder="" >
                                </div>              
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control password" type="password" name="password">
                                </div>      
                                <div class="form-group">
                                    <label>Retype Password</label><label class="retypepassword"></label>
                                    <input class="form-control repassword" type="password" name="repassword">
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
                                	
                                	                    
		           		</div>

		           		
		           		<div class="clearfix"></div>
		           		
		           		<div class="col-lg-12">
		           		
                        
		           			<!-- <button type="submit" class="btn btn-default btn-success col-xs-5">Submit</button>
                            
		           			<div class="col-xs-2"></div>
                            
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button>  -->	        
                                
                        </div>
               </form>
               

    </div>
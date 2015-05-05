
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if(!empty($agent) && is_array($agent)){
			foreach($agent as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if($k=="agent_status" ) echo "$('select[name=$k]').val('".tinymce_decode($v)."');";
				else if($k!="password") echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
			}
		}    	
	?>    
    
});

function recallRemove(){
   
}
</script>



                <!-- Page Heading -->
                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?> 
                <!-- /.row -->
                
                <div class="row">
	                <div class="col-lg-12">
<?php
if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){	                	
?>	                
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>/index.php/agent_management/?action=add"><i class="fa fa-plus"></i> Add agent</a>
<?php
}                			
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>/index.php/agent_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post" id="agentaddform">

		           		<div class="col-lg-12">
			                
			                	<div class="row">
			                		<div class="col-lg-9 col-md-9 col-sm-9">
			                			 <h4><i class="fa fa-file-text "></i> Agent Form </h4>
			                		</div>
			                		<div class="col-lg-3 col-md-3 col-sm-3">
										<div class="text-right">
				                			<button type="submit" class="btn btn-default btn-success">Submit</button>
				                			<button type="reset" class="btn btn-default btn-danger">Cancel</button>
										</div>

			                		</div>
			                		
			                	</div>
			                
		               
                                
	                        	<div class="form-group">
		                            <label>Agent name</label>
		                            <input class="form-control" type="text" name="agent_name" required>
		                        </div>		                        		                        		                        

		                        <div class="form-group">
		                            <label>Agent nick name</label>
		                            <input class="form-control" type="text" name="agent_nick_name" required>
		                        </div>
		                        
		                        <div class="form-group">
		                            <label>Email address</label>
		                            <input class="form-control" type="text" name="email_address" required>
		                        </div>
		                        
		                        <div class="form-group">
		                            <label>Agent mobile number</label>
		                            <input class="form-control" type="text" name="agent_mobile_number" required>
		                        </div>
		                        <div class="form-group">
                                    <label>Agent status</label>
                                    <select name="agent_status" class="form-control" required>
                                        <option value="">Please Select</option>                                    
                                        <option value="active">active</option>                                    
                                        <option value="inactive">inactive</option>                                    
                                    </select>
                                </div>                                                                                                                                
                                <div class="divider"></div>
                                <h4><i class="fa fa-lock"></i> Add New Password</h4>
                                <div class="divider"></div>
		                        <div class="form-group">
		                            <label>password</label>
		                            <input required class="form-control password" type="password" name="password" placeholder="Enter Password">
		                        </div>
		                        <div class="form-group" >
                                <label class="">Repassword</label>
                                <label class="retypepassword"></label>
                                <input required type="password" class="form-control repassword" name="repassword" placeholder="Re type Password" >
                                </div>
                                <div class="divider"></div>	

	                		
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
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> -->
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>

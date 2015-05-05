
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		if(!empty($agent) && $agent>0){

				echo "$('select[name=agent_id]').val('".$agent."');";	

		}    	
	?>    
    
});

function recallRemove(){
   
}
</script>

				<?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                
	                <div class="col-lg-12">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post" action="?action=singleview&do=addagent&id=<?php echo $ref_id; ?>">
                    
		                <div class="col-lg-12">
		                
		                <h4><i class="fa fa-file-text "></i> Add Agent </h4>
                                
		                        <div class="form-group">
		                            <label>Select Agent</label>
		                            <select class="form-control" name="agent_id">
											  <option value="">Please Select</option>
<?php
												foreach($agent_list as $k=>$v){											  	
?>												  
											  		<option value="<?php echo $v['id']; ?>"><?php echo $v['agent_nick_name']; ?></option>
<?php
												}
?>											  
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

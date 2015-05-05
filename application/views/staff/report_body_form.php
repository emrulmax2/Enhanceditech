
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
		/*if($semester && is_array($semester)){
			foreach($semester as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
			}
		}*/    	
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
                    
                    
                    <form role="form" class="form form-inline" method="post">
                    <h4><i class="fa fa-file-text "></i> Create Report <img class="loading" src="<?php echo base_url();?>/images/loading.png" /></h4>
		                <div class="col-sm-6">
		                        <div class="form-group no-pad-left">
                                    <label class="sr-only">Select Semester</label>
                                    <select name="semester_id" class="form-control">
                                        <option value="">Please Select Semester</option>
<?php
                                            foreach($semester_list as $k=>$v){
                                                echo "<option value=\"".$v['id']."\">".$v['semister_name']."</option>";    
                                            }                                            
?>                                        
                                    </select>
                                </div>    
                                <div class="form-group ">
		                            <label class="sr-only">Submit</label>
                                    <input type="button" class="form-control btn-md btn-success report-button" value="Submit">

                            
                            <input name="ref" type="hidden" value="<?php echo $ref; ?>">                    
                            <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
		                        </div>		                        		                        		                        
		                    
		           		</div>
		           		
                        <div class="clearfix"></div>
               </form>
               
               
               

            </div>
            
            <div class="row">
            
            	<div class="col-lg-12 report-data">
            	            		
            	</div>
            
            </div>

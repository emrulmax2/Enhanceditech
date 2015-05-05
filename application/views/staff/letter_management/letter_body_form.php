
<script type="text/javascript">

$(document).ready(function(){
      
	<?php
    $letterdetails ="";
		if($letter && is_array($letter)){
			foreach($letter as $k=>$v){
				//$val=tinymce_encode($v);
				  // var_dump($val);
				//if($k=="addressbook") echo "$('textarea[name=$k]').val('$v');"; else echo "$('input[name=$k]').val('$v');";
				if($k=="description")
                $letterdetails = tinymce_decode($letter[$k]);
				//echo "$('textarea[name=$k]').val('".tinymce_decode($v)."');";
				else
				echo "$('input[name=$k]').val('".tinymce_decode($v)."');";	
			}
		}    	
	?>    
    
});

function recallRemove(){
   
}
</script>



                <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>
                
                <div class="row">
	                <div class="col-lg-12">
<?php
if( ( !empty($priv[1]) || $this->session->userdata('label')=="admin" ) ){	                	
?>	                
                		<a class="btn btn-md btn-primary" href="<?php echo base_url(); ?>index.php/registration/letter_management/?action=add"><i class="fa fa-plus"></i> Add New Letter</a>
<?php
}	                	
?>                		
                		<a class="btn btn-md btn-info" href="<?php echo base_url(); ?>index.php/registration/letter_management/?action=list"><i class="fa fa-list"></i> Back to List</a>
	                </div>
	                
                </div>
                
                <div class="row">
	                
	                <div class="col-lg-12">                
	                	<?php echo $message; ?>
	                </div>
	                
                </div>                

                <div class="row">
                    
                    
                    <form role="form" method="post">
                    
		                <div class="col-lg-12">

		                		<div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                         <h4><i class="fa fa-file-text "></i> Letter Form </h4>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-default btn-success">Submit</button>
                                            <button type="reset" class="btn btn-default btn-danger">Cancel</button>
                                        </div>

                                    </div>
                                    
                                </div>

                                
		                        <div class="form-group">
		                            <label>Letter type</label>
		                            <input class="form-control" type="text" name="letter_type" required>
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Letter title</label>
		                            <input class="form-control" type="text" name="letter_title" required>
		                        </div>	
		                        
		                        <div class="form-group">
		                            <label>Description</label>
                                    
		                            <textarea required class="form-control tinymce" rows="30" name="description"><?php echo $letterdetails; ?></textarea>
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
			                <button type="reset" class="btn btn-default btn-danger col-xs-5">Cancel</button> -->
			                
			                <input name="ref" type="hidden" value="<?php echo $ref; ?>">		            
			                <input name="ref_id" type="hidden" value="<?php echo $ref_id; ?>">
			                		            
                        </div>
               </form>
               
               
               

            </div>

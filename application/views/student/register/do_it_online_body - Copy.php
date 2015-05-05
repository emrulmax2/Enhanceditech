<script type="text/javascript">
$(document).ready(function(){

	$('#excuse_document .upload-file-btn').click(function(){
		
		//alert('hi');
		$('.file-list-group').html("");
		$.each($('#excuse_document').find('input.documentfile'),function(){
			
			var filename=$(this).val();
			var filepath = "uploads/files/"+filename;
			var url = '<?php echo base_url(); ?>'+filepath;
			$('.file-list-group').append("<a target='_blank' href='"+url+"' class='list-group-item' fn=''>"+filename+"<input type='hidden' name='filelist[]' value='"+filepath+"'></a>");
				
			
		});
		
	});	
	
});	
</script>
<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome! <small><?php echo $fullname; ?> </small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Home > Do It Online
                            </li>
                        </ol>
                        

                    </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <?php 
                    if(!empty($msg)) {
                      echo $msg;
                    } 

                    ?>
                  </div>
                </div>
               
              <div class="row">
                 <div class="col-lg-12">
                    
                    <div class="divider"></div>  
                     <div class="form-group">
                       <h4><i class="fa fa-user "></i> Do It Online </h4>
                       <p class="divider"></p>
                     </div>

                      <div class="form-group clearfix">
                        <div class="col-md-3 col-sm-3 col-xs-5"></div>
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <button <?php echo (empty($clean_attendance)) ? "disabled" : "" ; ?> class="btn btn-md btn-warning" data-toggle="modal" data-target="#excuse_document"><i class="fa fa-plus"></i> Add Document</button>
                          <p><b>Upload File (max file size will no more than 5MB and file types are docx,doc,pdf,jpg,png)</b></p>
                          <p class="divider"></p>
                          
                        </div>

                        <form action="" method="post"> 
                        <div class="col-md-3 col-sm-3 col-xs-5" style="position: relative;top: -97px;">
                          <p><b><i class="fa fa-fw fa-list"></i> List Of Absent Days</b></p>
                          <?php if(!empty($clean_attendance)) { ?>
                          <?php foreach($clean_attendance as $k=>$v) {?>
                          
                          <?php 
                          $dat_module_info = explode("_", $k);
                          ?>
                          <p><?php echo $this->coursemodule->get_name_by_id($dat_module_info[0]); ?></p> 
                         
                          <?php foreach($v as $x=>$y) {?>
                          <?php $yy = explode("_", $y) ?>
                          
                          <div class="checkbox checkbox-primary">
                            <input name="absent_days[]" id="checkbox_<?php echo $x."_".$dat_module_info[0] ?>" type="checkbox" class="form-control" value="<?php echo $yy[1]."_".$dat_module_info[0]."_".$yy[2] ?>">
                            <label for="checkbox_<?php echo $x."_".$dat_module_info[0] ?>"><?php echo hr_date($yy[0]) ?></label>
                          </div>

                         <?php } } }?>

                        </div>
                       
                        <div class="col-md-7 col-sm-7 col-xs-7">
                          <label>Reason <small class="red-link">*</small> : </label>
                          
                          <textarea name="reason" style="height:200px;margin-bottom:15px;resize:none;" required class="form-control" placeholder="" name=""></textarea>
                          
                          
                          <div class="clearfix"></div>
                          <!-- <button class="btn btn-md btn-warning" data-toggle="modal" data-target="#excuse_document"><i class="fa fa-plus"></i> Add Document</button> -->
                          <!-- <div class="clearfix" style="margin-bottom:10px;"></div> -->


            							<div class="list-group file-list-group">
            							  <!--<a href="#" class="list-group-item" fn=''>Dapibus ac facilisis in<input type="hidden" name="filelist[]" value=""></a>-->
            							</div>
                          
                          
                          
                          <button <?php echo (empty($clean_attendance)) ? "disabled" : "" ; ?> class="btn btn-info" type="submit" name="do_it_online">Submit</button>
                          
                        </div>
                        </form>
                        <!-- <button <?php echo (empty($clean_attendance)) ? "disabled" : "" ; ?> class="btn btn-md btn-warning" data-toggle="modal" data-target="#excuse_document"><i class="fa fa-plus"></i> Add Document</button> -->
                        <div class="col-sm-3"></div>

                        
                      </div>






                 </div>
         

              </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

         <!-- Modal -->
                <div class="modal fade" id="excuse_document" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                      <!-- <div class="form-group">
                       <label for="formstatus"> File name : </label>
                        <input type="text" class="form-control" name="filename"  />
                       </div>                        
                        
                       <div class="form-group">
                       <label for="formstatus"> Check Hard copy : </label>
                       <div class="radio radio-success">
                        <input type="radio" name="check_hard_copy_doc" id="checkhardcopy1"  value="yes"><label for="checkhardcopy1"> Yes</label>
                        </div>
                        <div class="radio  radio-danger">
                        <input type="radio" name="check_hard_copy_doc"  id="checkhardcopy2"  value="no" checked ="checked" > <label for="checkhardcopy2"> No </label>
                        </div>
                        </div>
                       <div class="form-group reason">
                       <label for="formstatus"> Reason : </label>
                       <textarea class="form-control" name="reason" cols="" rows="3"></textarea>

                       </div> -->
                      </div>
                      <div class="modal-footer">
                      <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt="">
                        <!-- <button type="button" name="uploadDoc_do_it_online" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-upload"></i> Upload</button> -->
                        <button type="button" class="btn btn-info upload-file-btn" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                        <!--<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>-->
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->   
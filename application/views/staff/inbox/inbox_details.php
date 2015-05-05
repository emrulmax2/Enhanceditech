<?php
  
?>

                <!-- Page Heading -->
<?php $bodytitle="Details";$faicon="fa-folder-open";?>
            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>     
            <form id="inbox_set" method="post" action="" class="form-inline">
            <div class="row">
            <div class="col-sm-4"><a class="" href="<?php echo current_url(); ?>"><i class="fa fa-arrow-circle-left"></i> Back to Inbox</a></div>
            <div class="col-sm-8 text-right">
              <div class="form-group">
                <button type="submit" name="reply" id="reply" class="btn btn-success btn-sm"><i class="fa fa-reply "></i> Reply</button>
              </div>
            </div> 
            </div>
            <?php echo $message; ?>            
               <div class="row">
               <div class="col-lg-12">
                    <h5> From :  </h5>                    
                    <div class="divider"></div>
                    <h5> To :  </h5>  
                    <div class="divider"></div>
                    <h5>Subject :  </h5>  
                   <div class="divider"></div>                   
               </div>
               </div><!--End of row-->
               <div class="row">
                <div class="col-lg-12 details">
                    <h5><i class="fa fa-file"></i> Description:  </h5> 
                    <div class="divider"></div>                 
               </div>
               </div><!--End of row-->
            
            </form>

 

                <!-- Modal -->
                <div class="modal fade" id="myInbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Warning !</h4>
                      </div>
                      <div class="modal-body">
                        <p class="alert alert-warning"> <i class="fa fa-warning"></i> Please select a mail form the list.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->     
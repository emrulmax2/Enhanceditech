<?php
  
?>


                <!-- Page Heading -->
<?php $bodytitle="Trash Inbox";$faicon="fa-trash";?>
            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>     
            <form id="inbox_set" method="post" action="" class="form-inline">
            <div class="row">
            <div class="col-sm-4"><a class="" href="<?php echo base_url('index.php/inbox_staff.html'); ?>"><i class="fa fa-arrow-circle-left"></i> Back to Inbox</a></div>
            <div class="col-sm-8 text-right">
             <div class="form-group">
              <img class="loading" src="<?php echo base_url();?>/images/loading.png" alt="">
                  <select class="form-control" name="inbox_action">
                    <option value="">Please select</option>
                    <option value="mark_restore">Restore trash</option>
                  </select>
              </div>
              <div class="form-group">
                <button type="submit" name="restore" id="restore" class="btn btn-success btn-sm"><i class="fa fa-undo "></i> Restore All</button>
              </div>
            </div> 
            </div>
            <?php echo $message; ?>  
               <div class="row">
               <div class="col-lg-12">
                    <h4><i class="fa fa-trash"></i> Trash </h4> 

               
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectbyall" name="selectbyall" /></th>
                                        <th>From</th>
                                        <th>Message</th>
                                        <th>Received</th>
                                    </tr>
                                </thead>
                                <tbody>

 				   		<?php foreach($inbox as $inbox_row):?>
						  <?php if($inbox_row["notification_type"]== "communication" && $inbox_row["notification_from"]=="student") { ?>
  						  
  						            <tr class="<?php if($inbox_row["notification_checked"] == "no"): ?> not-reviewd <?php else: ?> reviewd <?php endif; ?>">
                                    	<td><input  class="checkbox1" type="checkbox" value="<?php echo $inbox_row['id'];?>" name="selectAll[]" /></td>
                                        
                                        <td>
                                        <?php echo $this->student_data->get_fullname_by_ID($inbox_row["student_data_id"]); ?> 
                                            (<?php echo $communication[$inbox_row["communication_id"]]["student_data_id"]; ?>)
                                        </td>
                                        <td>
                                            <a class="inbox" id="" href="<?php echo current_url()?>?action=details&id=<?php echo $inbox_row['id'];?>">
                                            <?php echo substr(html_entity_decode($communication[$inbox_row["communication_id"]]["text"]),0,50);?>...
                                            </a>
                                        </td>
                                        <td>
                                            <?php if($communication[$inbox_row["communication_id"]]["entry_date"]!="0000-00-00 00:00:00") 
                                                        echo tohrdatetime($communication[$inbox_row["communication_id"]]["entry_date"]); 
                                                    else 
                                                        echo $communication[$inbox_row["communication_id"]]["datetime"];?>
                                        </td>
                                    </tr>
  						      
                          <?php } else if(($inbox_row["notification_type"]== "exam" || $inbox_row["notification_type"]== "review") && $inbox_row["notification_from"]=="staff" ) { ?>
                          
                                      <tr class="<?php if($inbox_row["notification_checked"] == "no"): ?> not-reviewd <?php else: ?> reviewd <?php endif; ?>">
                                        <td><input  class="checkbox1" type="checkbox" value="<?php echo $inbox_row['id'];?>" name="selectAll[]" /></td>
                                        <td>
                                        <?php echo $staffname=$this->staff->get_name($inbox_row["staff_id"]); ?> 
                                        </td>
                                        <td>
                                            <a class="inbox" id="" href="<?php echo current_url()?>?action=details&id=<?php echo $inbox_row['id'];?>">
                                            
                                            <?php if($inbox_row["notification_type"]=="review"): ?>
                                            <?php echo "A review from {$staffname}.";?>
<?php else: ?>
                                            <?php echo "An exam respnse from ref.{$inbox_row['id']}.";?>                         
<?php endif; ?>     
                                            </a>
                                        </td>
                                        <td>
                                            <?php if(isset($inbox_row["entry_date"]) && $inbox_row["entry_date"]!="0000-00-00 00:00:00") 
                                                        echo tohrdatetime($inbox_row["entry_date"]); 
                                                    else 
                                                        echo $inbox_row["dt"];?>
                                        </td>
                                    </tr>       
                                                       
                          <?php } ?>  
						<?php endforeach;?>
                                    
                                </tbody>
                            </table>
                        
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
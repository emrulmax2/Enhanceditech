
                <!-- Page Heading -->

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>     
            <form id="inbox_set" method="post" action="" class="form-inline">
            <div class="text-right">
              <!--<div class="form-group">
              <img class="loading" src="<?php echo base_url();?>/images/loading.png" alt="">
                  <select class="form-control" name="inbox_action">
                    <option value="">Please select</option>
                    <option value="mark_read">Mark as read</option>
                    <option value="mark_unread">Mark as Unread</option>
                  </select>
              </div>
              <div class="form-group hidden">
                <button type="button" name="delete" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-eraser "></i> Empty Trash</button>
              </div>
              <div class="form-group">
                <a href="<?php echo current_url();?>?action=trash" name="delete" class="btn btn-info btn-sm"><i class="fa  fa-trash-o "></i> View Trash</a>
              </div>-->
            </div> 
            <?php echo $message; ?>  
               <div class="row">
               <div class="col-lg-12">
                    <h4><i class="fa fa-envelope"></i> Inbox </h4> 

               
                            <!--<table class="dTable display">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectbyall" name="selectAll" /></th>
                                        <th>From</th>
                                        <th>Message</th>
                                        <th  class="text-right">Received</th>
                                    </tr>
                                </thead>
                                <tbody>

 				   		<?php foreach($inbox as $inbox_row):?>

						  <?php if($inbox_row["notification_type"]== "communication" && $inbox_row["notification_from"]=="staff" && $inbox_row["is_trash"]==0 ) { ?>
                            
                                      <tr class=" <?php if($inbox_row["notification_checked"] == "no"): ?> not-reviewd <?php else: ?> reviewd <?php endif; ?>">
                                        <td><input class="checkbox1" type="checkbox" value="<?php echo $inbox_row['id'];?>" name="selectAll[]" /></td>
                                        
                                        <td>
                                        <?php echo $this->staff->get_name($inbox_row["staff_id"]); ?> 
                                            (<?php echo $communication[$inbox_row["communication_id"]]["student_data_id"]; ?>)
                                        </td>
                                        <td>
                                            <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/student_admission_management/?action=singleview&do=communication&id=<?php echo $inbox_row['student_data_id'];?>">
                                            <?php echo substr(html_entity_decode($communication[$inbox_row["communication_id"]]["text"]),0,50);?>...
                                            </a>
                                        </td>
                                        <td  class="text-right">
                                            <?php if($communication[$inbox_row["communication_id"]]["entry_date"]!="0000-00-00 00:00:00") 
                                                        echo tohrdatetime($communication[$inbox_row["communication_id"]]["entry_date"]); 
                                                    else 
                                                        echo $communication[$inbox_row["communication_id"]]["datetime"];?>
                                        </td>
                                    </tr>
                                
                          <?php }if($inbox_row["notification_type"]== "communication" && $inbox_row["notification_from"]=="student" && $inbox_row["is_trash"]==0 ) { ?>
  						  
  						            <tr class=" <?php if($inbox_row["notification_checked"] == "no"): ?> not-reviewd <?php else: ?> reviewd <?php endif; ?>">
                                    	<td><input class="checkbox1" type="checkbox" value="<?php echo $inbox_row['id'];?>" name="selectAll[]" /></td>
                                        
                                        <td>
                                        <?php echo $this->student_data->get_fullname_by_ID($inbox_row["student_data_id"]); ?> 
                                            (<?php echo $communication[$inbox_row["communication_id"]]["student_data_id"]; ?>)
                                        </td>
                                        <td>
                                            <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/student_admission_management/?action=singleview&do=communication&id=<?php echo $inbox_row['student_data_id'];?>">
                                            <?php echo substr(html_entity_decode($communication[$inbox_row["communication_id"]]["text"]),0,50)."...";?>
                                            </a>
                                        </td>
                                        <td  class="text-right">
                                            <?php if($communication[$inbox_row["communication_id"]]["entry_date"]!="0000-00-00 00:00:00") 
                                                        echo tohrdatetime($communication[$inbox_row["communication_id"]]["entry_date"]); 
                                                    else 
                                                        echo $communication[$inbox_row["communication_id"]]["datetime"];?>
                                        </td>
                                    </tr>
  						      
                          <?php } else if(($inbox_row["notification_type"]== "exam" || $inbox_row["notification_type"]== "review") && $inbox_row["notification_from"]=="staff" && $inbox_row["is_trash"]==0 ) { ?>
                          
                                      <tr class="<?php if($inbox_row["notification_checked"] == "no"): ?> not-reviewd <?php else: ?> reviewd <?php endif; ?>">
                                        <td><input class="checkbox1" type="checkbox" value="<?php echo $inbox_row['id'];?>" name="selectAll[]" /></td>
                                        <td>
                                        <?php echo $staffname=$this->staff->get_name($inbox_row["staff_id"]); ?> 
                                        </td>
                                        <td>
                                            <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/student_admission_management/?action=singleview&do=application&id=<?php echo $inbox_row['student_data_id'];?>">
                                            
                                            <?php if($inbox_row["notification_type"]=="review"): ?>
                                            <?php echo "A review from {$staffname}.";?>
<?php else: ?>
                                            <?php echo "An exam respnse from ref.{$inbox_row['id']}.";?>                         
<?php endif; ?>                                            
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <?php if(isset($inbox_row["entry_date"]) && $inbox_row["entry_date"]!="0000-00-00 00:00:00") 
                                                        echo tohrdatetime($inbox_row["entry_date"]); 
                                                    else 
                                                        echo $inbox_row["dt"];?>
                                        </td>
                                    </tr>       
                                                       
                          <?php } ?>

						<?php endforeach;?>
                                    
                                </tbody>
                            </table>-->
                   <?php   
                   if(isset($_GET["page"])){ $page=$_GET["page"]; if($page!=1) $i=(($page-1)*20)+1; else $i=$page; } else {$page=1; $i=$page; };
                   
                   echo $this->lcc_inbox->getMasterInboxlistWithPagination("",$page,"","no",$i); ?>  
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
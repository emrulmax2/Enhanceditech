
                <!-- Page Heading -->

            <?php the_page_heading($bodytitle,$breadcrumbtitle,$faicon); ?>     
            <form id="inbox_set" method="post" action="" class="form-inline">
            <div class="text-right">
              <div class="form-group">
              <img class="loading" src="<?php echo base_url();?>/images/loading.png" alt="">
                  <select class="form-control" name="inbox_action">
                    <option value="">Please select</option>
                    <option value="mark_read">Mark as read</option>
                    <option value="mark_unread">Mark as Unread</option>
                    <option value="mark_trash">Move to trash</option>
                  </select>
              </div>
              <div class="form-group hidden">
                <button type="button" name="delete" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-eraser "></i> Empty Trash</button>
              </div>
              <div class="form-group">
                <a href="<?php echo current_url();?>?action=trash" name="delete" class="btn btn-info btn-sm"><i class="fa  fa-trash-o "></i> View Trash</a>
              </div>
            </div> 
            <?php echo $message; ?>  
               <div class="row">
               <div class="col-lg-12">
                    <?php //var_dump($inbox); ?>
                    <h4><i class="fa fa-envelope"></i> Inbox </h4> 

               
                            <table class="dTable display">
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

						  <?php if($inbox_row["notification_type"]== "communication" && $inbox_row["notification_from"]=="student" && $inbox_row["is_trash"]==0 ) { ?>
  						  
  						            <tr class=" <?php if($inbox_row["notification_checked"] == "no"): ?> not-reviewd <?php else: ?> reviewd <?php endif; ?>">
                                    	<td><input class="checkbox1" type="checkbox" value="<?php echo $inbox_row['id'];?>" name="selectAll[]" /></td>
                                        
                                        <td>
                                        <?php echo $this->student_data->get_fullname_by_ID($inbox_row["student_data_id"]); ?> 
                                            (<?php echo $communication[$inbox_row["communication_id"]]["student_data_id"]; ?>)
                                        </td>
                                        <td>
                                           <div class="col-xs-11 no-pad">
                                        
                                                <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/student_admission_management/?action=singleview&do=communication&id=<?php echo $inbox_row['student_data_id'];?>">
                                                <?php echo substr(strip_tags($communication[$inbox_row["communication_id"]]["text"]),0,50);?>...
                                                </a>
                                                

                                           
                                           </div>
                                           
                                           <div class="col-xs-1 no-pad text-center" style=" background: #677F65; color: #fff;" ><i class="fa fa-1x fa-arrow-circle-down" title="Received Item"></i></div>                                            

                                           <div class="clearfix"></div>
                                            
                                        </td>
                                        <td  class="text-right">
                                            <?php if($communication[$inbox_row["communication_id"]]["entry_date"]!="0000-00-00 00:00:00") 
                                                        echo tohrdatetime($communication[$inbox_row["communication_id"]]["entry_date"]); 
                                                    else 
                                                        echo $communication[$inbox_row["communication_id"]]["datetime"];?>
                                        </td>
                                    </tr>
  						      
                          <?php //} else if(($inbox_row["notification_type"]== "exam" || $inbox_row["notification_type"]== "review" || $inbox_row["notification_type"]== "induction" || $inbox_row["notification_type"]== "job" || $inbox_row["notification_type"]== "followup") && $inbox_row["notification_to_staff_id"]==$this->session->userdata('uid') && $inbox_row["notification_from"]=="staff" && $inbox_row["is_trash"]==0 ) { ?>
                          <?php } else if(($inbox_row["notification_type"]== "exam" || $inbox_row["notification_type"]== "review" || $inbox_row["notification_type"]== "induction" || $inbox_row["notification_type"]== "job" || $inbox_row["notification_type"]== "followup") && $inbox_row["notification_from"]=="staff" && $inbox_row["is_trash"]==0 ) { //----  will be generated all inbox and outbox  ?>
                          
                                      <tr class="<?php if($inbox_row["notification_checked"] == "no"): ?> not-reviewd <?php else: ?> reviewd <?php endif; ?>">
                                        <td><input class="checkbox1" type="checkbox" value="<?php echo $inbox_row['id'];?>" name="selectAll[]" /></td>
                                        <td>
                                        <?php echo $staffname=$this->staff->get_name($inbox_row["staff_id"]); ?> 
                                        </td>
                                        <td>
                                            
                                            <div class="col-xs-11 no-pad">
                                            <?php if($inbox_row["notification_type"]=="review"){ ?>
                                            
                                            <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/student_admission_management/?action=singleview&do=application&id=<?php echo $inbox_row['student_data_id'];?>">
                                            <?php echo "A review from {$staffname}."; ?>
                                            
                                            <?php }else if($inbox_row["notification_type"]=="exam"){ ?>
                                            
                                            <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/student_admission_management/?action=singleview&do=application&id=<?php echo $inbox_row['student_data_id'];?>">
                                            <?php echo "An exam response from ref.{$inbox_row['id']}.";?>
                                            
                                            <?php }else if($inbox_row["notification_type"]=="followup"){ 
                                                        
                                                        $registered = $this->register->get_registration_no_by_student_data_ID($inbox_row["student_data_id"]);
                                                        if(!empty($registered)){    
                                            ?>
                                                            <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/registration/registration_management/?action=singleview&do=note&id=<?php echo $inbox_row['student_data_id'];?>">
                                            <?php
                                                        }else{                                                                                          
                                            ?>
                                                            <a class="inbox" id="" href="<?php echo base_url(); ?>index.php/student_admission_management/?action=singleview&do=note&id=<?php echo $inbox_row['student_data_id'];?>">
                                            <?php
                                                        }                                                                                          
                                            ?>                                                                      
                                            <?php echo "A follow-up request from {$staffname}";?>
                                            <?php } ?>
                                            </a>
                                            </div>
                                            <?php if( $inbox_row["notification_to_staff_id"]==$this->session->userdata('uid') ){ ?><div class="col-xs-1  no-pad text-center" style=" background: #677F65; color: #fff; cursor: default;" ><i class="fa fa-1x fa-arrow-circle-down" title="Received Item"></i></div>
                                            <?php }else if( $inbox_row["notification_to_staff_id"]!=$this->session->userdata('uid') && $inbox_row["staff_id"]==$this->session->userdata('uid') ){  ?><div class="col-xs-1  no-pad text-center" style=" background: #65687F; color: #fff; cursor: default;" ><i class="fa fa-1x fa-arrow-circle-up" title="Send Item"></i></div><?php } ?>
                                            <div class="clearfix"></div>
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
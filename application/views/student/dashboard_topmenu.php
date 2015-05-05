        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php $settings=$this->settings->get_settings(); ?>
                <a class="navbar-brand logo" href="<?php echo base_url(); ?>/user_dashboard.html"><img style="width:32px; height:32px;" src="<?php echo $settings["logo_url"]; ?>" class="top-logo" /> <?php   echo $settings["company_name"]; ?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <?php if($inbox_alert_count >0 ){ ?><span class="badge alert-badge  red"><?php echo $inbox_alert_count;?></span><?php } ?> <b class="caret"></b> </a>
                    <ul class="dropdown-menu message-dropdown">
                        <?php foreach($inbox as $student_data => $lists):?>
						  <?php foreach($lists as $inbox_row): ?> 
						  <?php if($inbox_row["notification_type"]== "communication" && $inbox_row["notification_from"]=="staff" &&  $inbox_row["notification_checked"]=="no" ) { ?>
  						  <li class="message-preview" >
                            <a href="<?php echo base_url()."index.php/communication_student/?action=details&id=".$inbox_row["student_data_id"]; ?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="" alt="">
                                    </span>
                                    <div class="media-body">
                                        <?php //if($communication[$inbox_row["communication_id"]]) ?>
                                        <h5 class="media-heading"><strong><?php echo $this->staff->get_name($inbox_row["staff_id"]); ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $communication[$inbox_row["communication_id"]]["datetime"];?></p>
                                        <p><?php echo substr(html_entity_decode($communication[$inbox_row["communication_id"]]["text"]),0,100);?>...</p>
                                    </div>
                                </div>
                            </a>
                        </li> 
                          <?php } ?>
						  <?php endforeach; ?>  
						<?php endforeach;?>
                                  
                        <li class="message-footer">
                            <a href="<?php echo base_url();?>index.php/inbox_management">Read All <i class="fa fa-arrow-circle-o-right"></i></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i><?php if($alert_count >0 ){ ?><span class="badge alert-badge  red"><?php echo $alert_count;?></span><?php } ?><b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                       <?php foreach($inbox as $student_data => $lists):?>
                          <?php foreach($lists as $inbox_row): ?> 
                          <?php if(($inbox_row["notification_type"]== "exam" || $inbox_row["notification_type"]== "review") &&  $inbox_row["notification_checked"]=="no" ) { ?>
                       <?php if($inbox_row["notification_type"]== "review"){ ?>
                        <li >
                            <a href="<?php echo base_url();?>index.php/user_dashboard/?action=edit&id=<?php echo $inbox_row["student_data_id"]; ?>"> Your application <?php echo "(".$this->student_data->get_reference_no_byID($inbox_row["student_data_id"]).")";?> is on process. <span class="label label-warning"><?php echo $inbox_row["dt"] ?></span></a>
                        </li>
                        <?php } ?>
                        <?php if($inbox_row["notification_type"]== "exam" && $inbox_row["notification_to"]== "student"){ ?>
                        <li >
                            <a href="#"> There is an exam <?php echo "(".$this->student_data->get_reference_no_byID($inbox_row["student_data_id"]).")";?> waiting for you. <span class="label label-warning"><?php echo $inbox_row["dt"] ?></span></a>
                        </li>
                        <?php } ?>
                        <li class="divider"></li>
                          <?php } ?>
                          <?php endforeach; ?>  
                        <?php endforeach;?>
                        <li>
                            <a href="#">View All <i class="fa fa-arrow-circle-o-right"></i></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ucfirst($this->session->userdata('username'));?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/profile_page.html"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/inbox_management"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url();?>index.php/logout/"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

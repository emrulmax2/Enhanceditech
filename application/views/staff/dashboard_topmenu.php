<?php 
  $inbox            = $this->lcc_inbox->get_by_staff_ID($this->session->userdata('uid'));  
  //$communication    = $this->lcc_communication->get_by_staff_ID($this->session->userdata('uid'));   
  $communication    = $this->lcc_communication->get_all(); 
  //var_dump($alert_count);
  ?>   

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
                <li class="dropdown first-dropdown-data">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <?php if($inbox_alert_count >0 ){ ?><span class="badge alert-badge  red"><?php echo $inbox_alert_count;?></span><?php } ?><b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">

                          <?php foreach($inbox as $inbox_row): ?> 
                          <?php if($inbox_row["notification_type"]== "communication" && $inbox_row["notification_from"]=="student" &&  $inbox_row["notification_checked"]=="no" ) { ?>
                            <li class="message-preview" >
                            <a href="<?php echo base_url();?>index.php/student_admission_management/?action=singleview&do=communication&id=<?php echo $inbox_row["student_data_id"];?>">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="" alt="">
                                    </span>
                                    <div class="media-body">
                                        <?php //if($communication[$inbox_row["communication_id"]]) ?>
                                        <h5 class="media-heading"><strong><?php echo $this->student_data->get_fullname_by_ID($inbox_row["student_data_id"]); ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> <?php echo $communication[$inbox_row["communication_id"]]["datetime"];?></p>
                                        <p><?php echo substr(html_entity_decode($communication[$inbox_row["communication_id"]]["text"]),0,50)."...";?></p>
                                    </div>
                                </div>
                            </a>
                        </li> 
                          <?php } ?>
                          <?php endforeach; ?>  

                                  
                        <li class="message-footer">
                            <a href="<?php echo base_url()."index.php/inbox_staff"; ?>">Read All <i class="fa fa-arrow-circle-o-right"></i></a>
                        </li>
                    </ul>
                </li>
                
                <li class="dropdown second-dropdown-data">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <?php if($alert_count >0 ){ ?><span class="badge alert-badge  red"><?php echo $alert_count;?></span><?php } ?><b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                          <?php foreach($inbox as $inbox_row): ?> 
                          <?php if( ($inbox_row["notification_type"]== "exam" || $inbox_row["notification_type"]== "review" || $inbox_row["notification_type"]== "induction" || $inbox_row["notification_type"]== "job" || $inbox_row["notification_type"]== "followup" ) && $inbox_row["notification_from"]=="staff" && $inbox_row["notification_to_staff_id"]==$this->session->userdata('uid') &&  $inbox_row["notification_checked"]=="no" ) { ?>
                        <li >
                            <?php if($inbox_row["notification_type"]== "review"){ ?><a href="<?php echo base_url()."index.php/student_admission_management/?action=singleview&do=application&id=".$inbox_row["student_data_id"]; ?>"><?php echo $inbox_row["notification_type"]; ?> set alert <span class="label label-warning"><?php echo $inbox_row["dt"] ?></span></a>
                            <?php }else if($inbox_row["notification_type"]== "followup"){
                                          
                                        $registered = $this->register->get_registration_no_by_student_data_ID($inbox_row["student_data_id"]); 
                                        if(!empty($registered)){
                            ?>
                                                <a href="<?php echo base_url()."index.php/registration/registration_management/?action=singleview&do=note&id=".$inbox_row["student_data_id"]; ?>">Follow-up alert <span class="label label-warning"><?php echo $inbox_row["dt"] ?></span></a>                
                            <?php       }else{  ?>
                                            
                                                <a href="<?php echo base_url()."index.php/student_admission_management/?action=singleview&do=note&id=".$inbox_row["student_data_id"]; ?>">Follow-up alert <span class="label label-warning"><?php echo $inbox_row["dt"] ?></span></a> 
                                                
                            <?php       }       ?>     
                            
                            <?php } ?>
                        </li>
                        <li class="divider"></li>
                          <?php } ?>
                          <?php endforeach; ?> 
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url()."index.php/inbox_staff"; ?>">View All <i class="fa fa-arrow-circle-o-right"></i></a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown third-dropdown-data">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ucfirst($this->session->userdata('username'));?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/staffprofile_page"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/inbox_staff"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
<?php if($this->session->userdata('label')=="admin"){   ?>                        
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/settings_management"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
<?php }  ?>                        
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url();?>index.php/logout/"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

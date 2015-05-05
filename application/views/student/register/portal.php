
    <style>
    .email-small {
        font-size: 12px;
          text-transform: lowercase;
    }
    </style>        

            <div class="col-lg-4 col-md-8 info-section">
                <div class="info-area">
                    <div class="profile-pic">
                        <?php 
                        $student_pic =  $this->register->get_student_photo_no_by_registration($student_id);
                        if($student_pic) { 
                        ?>
                        <img src="<?php echo base_url().$student_pic ?>" alt="<?php echo $fullname; ?>">
                        <?php } else { ?>
                        <img src="<?php echo base_url()."images/user_avatar_default.png" ?>" alt="<?php echo $fullname; ?>">
                        <?php } ?>

                    </div>
                    <div class="profile-info">
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Student Id :</div>
                            <div class="col-sm-7 col-xs-7"><?php echo strtoupper($student_id); ?></div>
                        </div>
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Name : </div>
                            <div class="col-sm-7 col-xs-7"><?php echo $fullname; ?></div>
                        </div>
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Date Of Birth :</div>
                            <?php
                                $clean_date = explode("/", $student_info['student_date_of_birth']);

                                $new_clean_date = $clean_date[0]."-".$clean_date[1]."-".$clean_date[2];
                               
                                
                            ?>
                            <div class="col-sm-7 col-xs-7"><?php echo hr_date($new_clean_date); ; ?></div>
                        </div>
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Current Address :</div>
                            <div class="col-sm-7 col-xs-7"><?php echo $student_info['student_address_address_line_1'].", ".$student_info['student_address_address_line_2'].", ".$student_info['student_address_city'].", ".$student_info['student_address_postal_zip_code'].", ".$student_info['student_address_country']; ?></div>
                        </div>
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Phone(Home) :</div>
                            <div class="col-sm-7 col-xs-7"><?php echo $student_info['student_mobile_phone']; ?></div>
                        </div>
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Email : </div>
                            <div class="col-sm-7 col-xs-7 email-small"><?php echo $student_info['student_email']; ?></div>
                        </div>
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Current Course :</div>
                            <div class="col-sm-7 col-xs-7"><?php echo $this->course->get_name( $student_info['student_course'] ); ?></div>
                        </div>
                        
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Course Start :</div>
                            <div class="col-sm-7 col-xs-7"><?php echo hr_date($course_start_end_date['class_startdate'])?></div>
                        </div>
                        <div class="info-detail">
                            <div class="col-sm-5 col-xs-5">Course End :</div>
                            <div class="col-sm-7 col-xs-7"><?php echo hr_date($course_start_end_date['class_enddate'])?></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 no-pad-left no-pad-right-sm">
                <div class="notice-area">
                    <li> 
                    <?php 
                        // var_dump($list_of_todays_class);
                        if(!empty($list_of_todays_class)) 
                        {
                            foreach ($list_of_todays_class as $x => $y) {
                                if(empty($y))
                                {
                                    unset($list_of_todays_class[$x]);
                                }
                            
                            }
                          
                        }

                           
                    ?>                  
                        <a id="notice-main-a" href="javascript:void(0);" data-toggle="collapse" data-target="#todays-class"><i class="fa fa-users"></i> Today's Class <i class="fa fa-angle-down icon-right"></i></a>
                        <ul id="todays-class" class="collapse in">
                            <p class="text-right">Total Class: <?php echo (!empty($list_of_todays_class)) ? count($list_of_todays_class) : "0" ?></p>
                            
                            <?php if(!empty($list_of_todays_class)) { ?>
                            <?php //var_dump($list_of_todays_class); ?>
                            <?php foreach($list_of_todays_class as $kk=>$vv) {?>
                            <li class="class-info">
                                <p><?php echo $this->coursemodule->get_name_by_id( $vv['coursemodule_id'] ); ?></p>
                                <p>Time: <?php echo $this->time_plan->get_viewable_from_to_date_by_id( $vv['time_planid']); ?></p>
                            </li>
                            <?php } ?>
                            <?php } else {?>
                                <p>You have no class today.</p>
                            <?php } ?>
                                                                              
                        </ul>
                    </li>
                </div>
                <div class="notice-area">
                    <li>                    
                        <a id="notice-main-a" href="javascript:void(0);" data-toggle="collapse" data-target="#notice-board"><i class="fa fa-users"></i> Notice Board <i class="fa fa-angle-down icon-right"></i></a>
                        <ul id="notice-board" class="collapse">

                            <p>Notice Board Area</p>
                            
                            <!-- <li class="notification-area">
                                <h5>Human Resource Management</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                            </li>
                            <li class="notification-area">
                                <h5>Human Resource Management</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                            </li> -->
                            
                                                                              
                        </ul>
                    </li>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 no-pad-left no-pad-right-sm">
                <div class="notice-area">
                    <li>                    
                        <a id="notice-main-a" href="javascript:void(0);"><i class="fa fa-users"></i> Actions</a>
                        <ul>

                            <li class="action-info">
                                <h4>Status</h4>
                                <p><?php echo strtoupper($this->status->get_name_by_id($status->status)); ?></p>
                            </li>
                            <li class="action-info">
                                <h4 id="module-exam">Module Exam Result</h4>
                                <!-- <div class="module-exame-result"> -->
                                  <!-- <h4 id="exame-result-list"><i class="fa fa-graduation-cap"></i> Module Exam Result</h4> -->
                                  <p class="divider"></p>
                                  <?php foreach($course_level_list as $k=>$v) { ?>
                                  <?php 
                                  $module_list = array();
                                  $module_list[] = $this->coursemodule->get_by_course_level_id($v['id'], $v['course_id']);
                                  if(!empty($module_list[0])) {
                                    $module_id = array();
                                    foreach($module_list[0] as $x=>$y) {

                                  $class_plan_id = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id, $y['id']);


                                    if(!empty($class_plan_id)) {

                                      
                                      $register_id = $this->register->get_id_by_student_data_ID($student_info['id']);
                                      
                                      foreach($class_plan_id as $c=>$l) {

                                        

                                        $result_info = $this->examresult->get_examresult_list_by_register_id_and_class_plan_id($register_id ,$l['id']);

                                     
                                        if( !empty($result_info) || ($result_info != NULL) ) {
                                          $module_id[] = $this->class_plan->get_coursemodule_id_by_id($l['id']);
                                        }
                                      }
                                    }
                                  }
                                  if(!empty($module_id)) {
                                        //var_dump($module_id);

                                   ?>
                                  <!-- <h5> <b>Level : </b> <?php echo $v['name']; ?></h5> -->
                                  <table width="100%" id="student_exm_result">
                                    <thead>
                                      <tr>
                                        <th>Module Name</th>
                                        <th>Grade</th>
                                        <th>Percentage</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                  
                                  foreach($module_id as $x=>$y) {

                                  $class_plan_id = $this->class_plan->get_by_course_relation_id_and_coursemodule_id($course_relation_id, $y);


                                  if(!empty($class_plan_id)) {

                                    
                                    $register_id = $this->register->get_id_by_student_data_ID($student_info['id']);

                                    foreach($class_plan_id as $c=>$l) {


                                      $result_info = $this->examresult->get_examresult_list_by_register_id_and_class_plan_id($register_id ,$l['id']);

                                     
                                        if( !empty($result_info) || ($result_info != NULL) ) {

                                          if($result_info[0]['grade'] == "F") {

                                     
                                          ?>

                                      <tr style="color:red;">
                                        <td><?php echo $this->coursemodule->get_name_by_id($y); ?></td>
                                        <td> <p style="border:1px solid red; padding:3px; text-align:center;margin-right:5px;"> <?php echo $result_info[0]['grade'] ?></p></td>
                                        <td> <p style="border:1px solid red; padding:3px; text-align:center;margin-right:5px;"><?php echo $result_info[0]['percentage'] ?>%</p> </td>
                                      <?php } else { ?>
                                      <tr style="color:green;">
                                        <td><?php echo $this->coursemodule->get_name_by_id($y); ?></td>
                                        <td> <p style="border:1px solid green; padding:3px; text-align:center;margin-right:5px;"> <?php echo $result_info[0]['grade'] ?></p></td>
                                        <td> <p style="border:1px solid green; padding:3px; text-align:center;margin-right:5px;"><?php echo $result_info[0]['percentage'] ?>%</p> </td>
                                      <?php }?>

                                      </tr>
                                      <?php

                                        } 
                                      } 
                                    }
                                  }
                                 
                                ?>
                                      
                                    </tbody>
                                  </table>
                                  <?php } } }?>    
                                  
                                <!-- </div> -->
                            </li>
                            <li class="action-info">
                                <h4><i class="fa fa-calendar"></i> Class Calendar</h4>
                                <div class="kalendar"></div>
                                <script>
                                $(document).ready(function() {
                                  $('.kalendar').kalendar({ 
                                      events: [            
                                        <?php  if(count($class_list_dates)>0){ ?>
                                        <?php foreach( $class_list_dates as $key => $days_lists ):?>
                                        <?php   
                                                  foreach ($days_lists as $days_list):
                                                             
                                                        $timeplan=$this->time_plan->get_by_ID($days_list["time_planid"]);
                                                        //var_dump($timeplan);
                                                        $dat = date("Ymd",strtotime($days_list["date"]));
                                                        $module_tutor = $this->staff->get_name(($days_list["tutor_id"]));
                                                        $room_no = $this->room_plan->get_name_by_id(($days_list["room_id"]));
                                                        $pre = $days_list["type"]; 
                                        ?>
                                                      {
                                                        title:"<?php echo $this->coursemodule->get_name_by_id($days_list["coursemodule_id"]); ?>",
                                                        url: "",
                                                        start: {
                                                            date: "<?php echo $dat; ?>",
                                                            time: "<?php echo hr_time($timeplan['start_time']); ?>"
                                                        },
                                                        end: {
                                                            date: "<?php echo $dat; ?>",
                                                            time: "<?php echo hr_time($timeplan['end_time']); ?>"
                                                        },
                                                        location: "<?php if(!empty($pre)) echo $pre." day<br />"."Section: {$days_list["group_name"]}<br />Tutor: {$module_tutor}<br />Room: {$room_no}";  
                                                                        else echo "Section: {$days_list["group_name"]}<br />Tutor: {$module_tutor}<br />Room: {$room_no}";
                                                                    ?>",
                                                        color:"<?php if($pre == "Revision") echo "blue";  else if($pre == "Teaching") echo "yellow"; else if($pre == "Submit") echo "green"; else echo "red"; ?>"
                                                    },
                                         <?php     endforeach; ?>
                                         <?php endforeach; ?>
                                         <?php }?>

                                        {
                                            title:"New Year Eve",
                                            start: {
                                                date: "<?php echo date("Y");?>1231",
                                                time: "11.00"
                                            },
                                            end: {
                                                date: "<?php echo date("Y");?>1231",
                                                time: "11.59"
                                            },
                                            location: "Earth",
                                            color: "green"

                                        }
                                    ],
                                    color: '#efefef',
                                    firstDayOfWeek: "Monday",
                                    eventcolors: {
                                        yellow: {
                                            background: "#FC0",
                                            text: "#000",
                                            link: "#000"
                                        },
                                        blue: {
                                            background: "#6180FC",
                                            text: "#FFF",
                                            link: "#FFF"
                                        },
                                        green: {
                                            background: "#16a085",
                                            text: "#FFF",
                                            link: "#FFF"
                                        },
                                        red: {
                                            background: "#CE070F",
                                            text: "#FFF",
                                            link: "#FFF"
                                        }
                                    }
                                });

                                });
                                </script>                                 
                                <!-- <p class="cal-area">
                                    
                                </p> -->                                
                            </li>
                                                                              
                        </ul>
                    </li>
                </div>
            </div>
        
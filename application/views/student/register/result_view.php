<script>
$(document).ready(function() {

});
</script>

                <!-- Page Heading -->
                <!-- <div class="row"> -->
                    <div class="col-lg-10">
                        
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa <?php echo $faicon; ?>"></i> <?php echo $breadcrumbtitle; ?>
                            </li>
                        </ol>
                        

                    </div>
                <!-- </div> -->
                <!-- <div class="row"> -->
                  <div class="col-lg-10">
                    <?php 
                    if(!empty($msg)) {
                      echo $msg;
                    } 

                    ?>
                  </div>
                <!-- </div> -->
               
              <!-- <div class="row"> -->
                 <div class="col-lg-10 content-area">
                    

                      <div class="divider"></div>
                      <h4><i class="fa fa-file-text"></i> Previous Result</h4>
                      <div class="divider"></div>
                      <table class="table table-hover">
                        <thead>
                        <tr>
                          <th>Module</th>
                          <th>Attempt</th>
                          <th>Paper ID</th>
                          <th>Module No</th>   
                          <th>Exam Date</th>
                          <th>Grade</th>
                          <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(!empty($prev_result)) {?>
                         
                         <?php
                         $check_multi = array();
                         foreach($prev_result as $k=>$v) {
                          $val = $v['coursemodule_id'];
                          if(!empty($val)) {
                            if(in_array($val, $check_multi)) {
                              continue;
                            } else {
                              $check_multi[] = $val;
                            }
                          }


                        $awarding_body     = $this->awarding_body->get_name($v['awarding_body_id']);

                          ?>
                          
                          <tr>

                            <?php $cm = $this->coursemodule->get_name_by_id($v['coursemodule_id']); ?>
                                        <td><?php echo $cm; ?></td>

                            <?php $attempt = $this->exam_result_prev->get_total_attempt($v['student_data_id'], $v['course_id'], $v['semester_id'], $v['coursemodule_id']); ?>
                            <td><?php if($attempt > 1) { ?><a class="moduleAttempt" style="cursor:pointer" data-toggle="modal" data-target='#myModal_prev_result' data-module="<?php echo $v['coursemodule_id']; ?>" data-student="<?php echo $v['student_data_id']?>"  > <?php echo $attempt ?> </a> <?php } else {?> <?php echo $attempt; } ?></td>
                            <td><?php echo ($v['paperID']>0) ? $v['paperID'] : ""; ?></td>
                            <td><?php echo !empty($v['module_no']) ? $v['module_no'] : ""; ?></td> 
                            <td><?php echo !empty($v['exam_date']) ? $v['exam_date'] : ""; ?></td>
                            <td><?php echo !empty($v['grade']) ? $v['grade'] : ""; ?></td>
                            <td><?php echo !empty($v['status']) ? $v['status'] : ""; ?></td>
                          </tr>
                         
                          <?php } } ?>
                        </tbody>
                      </table>
                    
                    

                </div>

                <div class="clearfix"></div>

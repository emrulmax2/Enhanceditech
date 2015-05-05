                
                <div class="col-xs-12 no-pad">
                    <div class="divider"></div>
                    <h4><i class="fa fa-info"></i> Student's Basic Information</h4>                    
                    <div class="divider"></div>
                    <div class="col-sm-2">Name: </div>
                    <div class="col-sm-4"><?php echo ucwords(strtolower($this->student_title->get_name_by_id($user_data['student_title'])." ".$user_data['student_first_name']." ".$user_data['student_sur_name'])); ?></div>
                    <div class="col-sm-2">App. Ref. No: </div>
                    <div class="col-sm-4"><?php echo !empty($user_data['student_application_reference_no']) ? $user_data['student_application_reference_no'] : "" ;  ?></div>
                    <div class="clearfix"></div>
                    <div class="col-sm-2">Course: </div>
                    <div class="col-sm-4"><?php echo !empty($user_data['student_course']) ? $this->course->get_name($user_data['student_course']) : "" ; ?></div>
                    <div class="col-sm-2">Date Of Birth: </div>
                    <div class="col-sm-4"><?php echo !empty($user_data['student_date_of_birth']) ? $user_data['student_date_of_birth'] : "" ; ?></div>
                    <div class="clearfix"></div>                    
                    <div class="divider"></div>
                </div>               


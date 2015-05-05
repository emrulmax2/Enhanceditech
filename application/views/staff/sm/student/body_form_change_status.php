                <!-- Modal -->
                <div class="modal fade" id="myApplicationStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Change Application Status</h4>
                      </div>
                      <div class="modal-body">
                      <div class="msg"></div>
                       <div class="form-group statuschangeslabel">
                       <label for="formstatus "> Change aplication current status : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="changestatus" class="formstatus form-control" >
                            <option <?php if($student_admission_status_for_staff=="New") echo "selected=selected "?> value="New">New</option>
                            <option <?php if($student_admission_status_for_staff=="Review") echo "selected=selected "?> value="Review">Review</option>
                            <option <?php if($student_admission_status_for_staff=="Awaiting Documents") echo "selected=selected "?> value="Awaiting Documents">Awaiting Documents</option>
                            <option <?php if($student_admission_status_for_staff=="Processing") echo "selected=selected "?> value="Processing">Processing</option>
                            <option <?php if($student_admission_status_for_staff=="Refer to academic department") echo "selected=selected "?> value="Refer to academic department">Refer to academic department</option>
                            <option <?php if($student_admission_status_for_staff=="Accepted") echo "selected=selected "?> value="Accepted">Accepted</option>
                            <option <?php if($student_admission_status_for_staff=="Rejected for review") echo "selected=selected "?> value="Rejected for review">Rejected for review</option>
                            <option <?php if($student_admission_status_for_staff=="Rejected") echo "selected=selected "?> value="Rejected">Rejected</option>
                            <option <?php if($student_admission_status_for_staff=="Discarded") echo "selected=selected "?> value="Discarded">Discarded</option>
                        </select>
                        </div>
                        <div class="form-group stafflist">
                       <label for="formstatus"> Staff name : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="staffview" name="student_admission_status_review_staff_id" class="formstatus form-control" >
                            <option value="">Please select a staff</option>
                        </select>
                        </div>
						
                        <div class="form-group rejected-reason-list">
                       <label for="reasonList"> Rejected Reason : <img class="loading" src="<?php echo base_url(); ?>/images/loading.png" alt=""></label>
                        <select id="reasonList" name="student_admission_status_rejected_reason" class="reasonList form-control" >
                            <option value="">Please select a reason</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Failed Interview") echo "selected=selected "?> value="Failed Interview">Failed Interview</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Shortage of Document") echo "selected=selected "?> value="Shortage of Document">Shortage of Document</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Wrong Information") echo "selected=selected "?>  value="Wrong Information">Wrong Information</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Lack of Qualification") echo "selected=selected "?>  value="Lack of Qualification">Lack of Qualification</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Unavailable for Communication") echo "selected=selected "?>  value="Unavailable for Communication">Unavailable for Communication</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Failure in English Test") echo "selected=selected "?>  value="Failure in English Test">Failure in English Test</option>
							<option <?php if(!empty($student_admission_status_rejected_reason) && $student_admission_status_rejected_reason=="Previous Bad Records") echo "selected=selected "?>  value="Previous Bad Records">Previous Bad Records</option>                            
                        </select>
                        </div> 
												
                      </div>
                      <div class="modal-footer">
                        <button type="button" name="changebuttonstate" class="btn btn-success" id="changebuttonstate" ><i class="fa fa-check"></i> Change</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal --> 
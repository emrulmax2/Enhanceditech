
            	
            	<div class="col-lg-12">
                <div class="divider"></div>
					<ul class="nav nav-pills">
					  <?php if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="application") echo"class='active'"; ?>><a href="<?php echo $app_link; ?>">Personal Info</a></li><?php } ?>
					  <?php if(!empty($priv[2]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="course") echo"class='active'"; ?>><a href="<?php echo $course_link; ?>">Course</a></li><?php } ?>
                      <?php if(!empty($priv[3]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="education") echo"class='active'"; ?>><a href="<?php echo $edu_link; ?>">Education &amp; Qualification</a></li><?php } ?>

					  <!-- <?php if(!empty($staff_privileges_student_admission['std_ad_comm']) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="communication") echo"class='active'"; ?>><a href="<?php echo $comm_link; ?>">Communication</a></li><?php } ?> -->
					  <?php if(!empty($priv[4]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="upload") echo"class='active'"; ?>><a href="<?php echo $up_link; ?>">Documents</a></li><?php } ?>

					  <?php if(!empty($priv[5]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="note") echo"class='active'"; ?>><a href="<?php echo $note_link; ?>">Notes</a></li><?php } ?>

					  <?php if(!empty($priv[6]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="communication") echo"class='active'"; ?>><a href="<?php echo $comm_link; ?>">Communication</a></li><?php } ?>

					  <?php if(!empty($priv[7]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="account") echo"class='active'"; ?>><a href="<?php echo $accounts_link; ?>">Accounts</a></li><?php } ?>

					  <?php if(!empty($priv[8]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="archive") echo"class='active'"; ?>><a href="<?php echo $arch_link; ?>">Archive</a></li><?php } ?>
					  <?php if(!empty($priv[9]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="attendance") echo"class='active'"; ?>><a href="<?php echo $attendance_link; ?>">Attendance</a></li><?php } ?>
					  <?php if(!empty($priv[10]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="result") echo"class='active'"; ?>><a href="<?php echo $result_link; ?>">Result</a></li><?php } ?>

					<?php if($user_data['student_type'] == "uk")  {?>
					  <?php if(!empty($priv[11]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="slc-history") echo"class='active'"; ?>><a href="<?php echo $slc_link; ?>">SLC History</a></li><?php } ?>
					<?php } ?>

					
                     <?php if(!empty($priv[12]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="login") echo"class='active'"; ?>><a href="<?php echo $login_link; ?>">Login to student panel</a></li><?php } ?> 					 
                     <?php if(!empty($priv[13]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="hesa") echo"class='active'"; ?>><a href="<?php echo $hesa_link; ?>">Hesa</a></li> <!-- need to add priviledge in future --><?php } ?>	

					</ul>
                    <div class="divider"></div>            		
            	</div>
 <div class="clearfix"></div>
            

            

    
    

            

  
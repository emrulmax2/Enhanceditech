
            	
            	<div class="clearfix">
                <div class="divider"></div>
					<ul class="nav nav-pills">
					
					  <?php if(!empty($priv[1]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="application") echo"class='active'"; ?>><a href="<?php echo $app_link; ?>">View Application</a></li><?php } ?>

					  <?php if(!empty($priv[2]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="communication") echo"class='active'"; ?>><a href="<?php echo $comm_link; ?>">Communication</a></li><?php } ?>
					
					  <?php if(!empty($priv[3])) {?>
					  <li <?php if(!empty($_GET['do']) && $_GET['do']=="upload") echo"class='active'"; ?>><a href="<?php echo $up_link; ?>">Upload Document</a></li>
					  <?php } ?>

					  <?php if(!empty($priv[4]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="note") echo"class='active'"; ?>><a href="<?php echo $note_link; ?>">Notes</a></li><?php } ?>

					  <?php if(!empty($priv[5]) || $this->session->userdata('label')=="admin"){ ?><li <?php if(!empty($_GET['do']) && $_GET['do']=="archive") echo"class='active'"; ?>><a href="<?php echo $arch_link; ?>">Archive</a></li><?php } ?>
					  <?php if(!empty($priv[6])) {?>
					  <li <?php if(!empty($_GET['do']) && $_GET['do']=="login") echo"class='active'"; ?>><a href="<?php echo $login_link; ?>">Login to student panel</a></li>
					  <?php } ?>
					
					</ul>
                    <div class="divider"></div>            		
            	</div>
 
            

            

    
    

            

  
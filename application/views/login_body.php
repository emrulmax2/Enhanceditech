<header></header>
<div class="row">
    <div class="col-md-6">
        <div class="img-left">
        <img src="<?php echo $settings["logo_url"];?>">
        </div><div class="company-info">
        <h2> <?php echo $settings["company_name"];?></h2>
        <p><i class="fa fa-envelope"></i> <?php echo nl2br($settings["address"]); ?></p>
        <p><i class="fa fa-phone"></i> <?php echo $settings["phone"]; ?></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-md-6">
         <form class="form-signin" id="form-signin" role="form" method="post">
            <?php if(!empty($message) && $error): ?>
                  <div class="alert alert-danger ">
                    <p><span class="glyphicon glyphicon-remove"></span> <?php echo $message; ?></p>
                  </div>
                <?php elseif($logout): ?>          
                    <div class="alert alert-warning ">
                        <p><span class="glyphicon glyphicon-info-sign"></span> <?php echo $message; ?></p>
                    </div>
                <?php elseif(!empty($activation_msg)): ?>     
                    <?php echo $activation_msg; ?>    
                <?php endif;?>

	            <h2 class="form-signin-heading"><i class="fa fa-user"></i> Please sign in</h2>
                <div class="form-group" >
	                <input type="text" class="form-control" name="login" placeholder="Email address" required autofocus>
                </div>
                <div class="form-group" >
	                <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group" >
	            <label class="checkbox col-md-5">
	                <input type="checkbox" value="remember-me">Remember me
	            </label>
                <label for="forgetpassword" class="col-md-7">
                    <a href="#" data-toggle="modal" data-target="#stdForgetPass">Forget password.</a>   </label>
                </div>
                
                <button class="btn btn-md btn-dark btn-block" type="submit"><i class="fa fa-sign-in"></i> Sign in</button>
	            <!--<a href="<?php echo base_url();?>index.php/student_signup/" class="btn btn-md btn-danger btn-block" ><i class="fa fa-plus"></i> Sign Up</a>
                -->
              </form>
    </div>
</div>

    
    
    <div class="modal fade" id="stdForgetPass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header cofirm-delete-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title warning" id="myModalLabel">Forget Password <img class="loading" src="<?php echo base_url();?>images/loading.png" /></h4>
                      </div>
                      <form method="post" id="frgtID" action="">
                      <div class="modal-body">
                      <div class="msg"></div>
           
                        <input type="email" class="form-control" placeholder="Please Enter email address. ex. mail@address.com" required autofocus  name="emForg"   id="email"  />
          
                    </div>

        
                      <div class="modal-footer">
          <div class="button_block_decoration_48px">
      
         <input type="submit" class="btn btn-md btn-success" value="Get password"/>
             
         <input type="button" name="" id="cancelSubmit" data-dismiss="modal" class="btn btn-md btn-danger" value="Cancel"/>
          </div>

                      </div>
</form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                
                
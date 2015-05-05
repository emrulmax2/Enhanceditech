<header></header>
<div class="row">
    <div class="col-md-6">
        <div class="img-left">
        <a href="<?php echo base_url();?> "><img src="<?php echo base_url();?>images/logo-main.png"></a>
        </div><div class="company-info">
        <h2> <?php echo $settings["company_name"];?></h2>
        <p><i class="fa fa-envelope"></i> <?php echo nl2br($settings["address"],false); ?></p>
        <p><i class="fa fa-phone"></i> <?php echo $settings["phone"]; ?></p>
        </div>
        <div class="clearfix"></div>
        <p class="retypepassword"></p>
    </div>
    <div class="col-md-6">
         <form class="form-signin" id="form-passwordchanged" role="form" method="post">
            <?php if(!empty($message) && $error): ?>
                  <div class="alert alert-danger ">
                    <p><span class="glyphicon glyphicon-remove"></span> <?php echo $message; ?></p>
                  </div>
                <?php elseif($logout): ?>          
                    <div class="alert alert-warning ">
                        <p><span class="glyphicon glyphicon-info-sign"></span> <?php echo $message; ?></p>
                    </div>                
                    <?php elseif(!empty($message)): ?>          
                        <?php echo $message; ?>

                <?php endif;?>

	            <h2 class="form-signin-heading"><i class="fa fa-lock"></i>Change Password</h2>
                <div class="form-group" >
	                <input type="password" class="form-control password" name="password" placeholder="Password" required autofocus>
                </div>
                <div class="form-group" >
	                <input type="password" class="form-control repassword" name="repassword" placeholder="Re type Password" required>
                </div>
                
                <button class="btn btn-md btn-success btn-block" type="submit">Change</button>
	            <button class="btn btn-md btn-danger btn-block" type="reset">Reset</button>
  <a class="margin-height" href="<?php echo base_url();?> "><i class="fa fa-backward"></i> Go back login page</a>
                     
              </form>
    </div>
</div>

    
    
    
                
                
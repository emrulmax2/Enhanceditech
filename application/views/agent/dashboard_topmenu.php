
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ucfirst($this->session->userdata('username'));?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url();?>index.php/agentprofile_page/"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>                        
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url();?>index.php/logout/"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

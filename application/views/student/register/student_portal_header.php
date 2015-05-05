<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome To LCC</title>

	<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/plugins/morris.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/datatables.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/tabelizer.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/jquery.fileupload.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/build.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/jquery.timepicker.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>css/kalendar.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/student_portal_style.css">

	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.11.0.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.10.0.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/load-image.all.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/canvas-to-blob.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/datatables.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/nod.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tabelizer.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mousewheel.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fileupload-process.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fileupload-image.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fileupload-audio.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.fileupload-validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tinymce/jquery.tinymce.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/plugins/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.timepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/kalendar.js"></script>
	<script src="<?php echo base_url(); ?>js/custom.js"></script>
	
	
	
</head>
<body>
	<div class="header">
		<div class="container">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5">
				<div class="logo">
					<a href="#"><img src="<?php echo base_url(); ?>images/logo.png" alt=""></a>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 padding-0-sm">
				<div class="header-text">
					<h1>Students Portal</h1>  
					<p></p>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-7 padding-right-0-sm">
				<table width="100%" id="header-right">
					<tr class="rm-sx">
						<td class="move-right-sm">Welcome <?php echo $fullname; ?></td>
						<td><img src="<?php echo base_url(); ?>images/ico-3.png" alt=""></td>
					</tr>
					<tr>
						<td><a href="<?php echo base_url();?>index.php/logout">Log Out</a></td>
						<td><img src="<?php echo base_url(); ?>images/ico-2.png" alt=""></td>
					</tr>
					<tr>
						<td><a href="<?php echo base_url(); ?>index.php/profile_page.html">Change Password</a></td>
						<td><img src="<?php echo base_url(); ?>images/ico-1.png" alt=""></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="bread-camp">
		<div class="container">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<p><a href="<?php echo base_url(); ?>index.php/student_dashboard.html">Dashboard</a> | <a href="<?php echo base_url(); ?>index.php/profile_page.html"><?php echo $fullname; ?></a></p>
			</div>
		</div>
	</div>

	<div class="main-body">
		<div class="container">
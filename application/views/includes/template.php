<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset-utf-8" />

	<title>Exam Invigilator Web Tool</title>

	<?php //echo "<link rel='stylesheet' href='" . base_url() . "/css/style.css' type='text/css' media='screen' />"; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />

	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js" ></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js" ></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate-rules.js" ></script>

</head>

<body>

	<div class="body_header">
		<div class="body_header_banner_logo"></div>
		<div class="body_header_banner"></div>
	</div>

	<div class="wrap">

		<div class="header">
			<?php $this->load->view('includes/header'); ?>
		</div>


		<div class="main_content">
			<?php $this->load->view($main); ?>
		</div>


		<div class="footer">
			<?php $this->load->view('includes/footer'); ?>
		</div>

	</div>

</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>

	<title>Exam Invigilator Web Tool</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/style.css" />
	

	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js" ></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js" ></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate-rules.js" ></script>

</head>


<body>
	
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>

	<title>Exam Invigilator Web Tool</title>

	<!--
	<script type="text/javascript">document.cookie = 'hasJS=true';</script>

	<script type="text/javascript">
	function tellIfJSIsEnabled()
	{
		alert('onload this page?');

		var xmlhttp;
		// code for IE7+, Firefox, Chrome, Opera, Safari
		if (window.XMLHttpRequest) {
			xmlhttp=new XMLHttpRequest();
		}
		else { // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		xmlhttp.open("POST", "photoUploader/index.php", true);
		xmlhttp.send("hasJS=true");
	}
	</script>
	-->

	
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
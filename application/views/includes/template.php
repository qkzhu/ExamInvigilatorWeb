<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset-utf-8" />

	<title>Exam Invigilator Web Tool</title>

	<?php echo "<link rel='stylesheet' href='" . base_url() . "/css/style.css' type='text/css' media='screen' />"; ?>

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
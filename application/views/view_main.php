<? //08P245A41 ?>
<div class="form">

	<?php //echo $error['error']; ?>

	<?php echo form_open_multipart('photoUploader/do_upload', 'id="the_only_form"');?>

	<div class="field">
		<?php echo form_label('Student Number:', 'std_num'); ?>
		<?php echo form_input('std_num', '', 'class="required"'); ?>
	</div>

	<div class="field">
		<?php echo form_label('Your photo:', 'photo'); ?>
		<input type="file" name="userfile" size="20" 'class="btn"' />
	</div>

	<?php echo form_submit('upload', 'Upload', 'class="btn"'); ?>

	<?php echo form_close(); ?>

</div>
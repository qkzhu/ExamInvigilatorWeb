<div class="form">

	<?php echo form_open_multipart('photoUploader/do_upload', 'id="the_only_form"');?>


	<div class="field">
		<?php echo form_label('Student Number:', 'std_num'); ?>
		<?php echo form_input('std_num', isset($std_num) ? $std_num : '', 'class="required"'); ?>
		<?php echo form_error('std_num'); ?>
	</div>


	<div class="field">
		<?php echo form_label('Student Name:', 'std_name'); ?>
		<?php echo form_input('std_name', isset($std_name) ? $std_name : '', 'class="required"'); ?>
		<?php echo form_error('std_name'); ?>
	</div>


	<div class="field">
		<?php echo form_label('NRIC/Passport:', 'std_ic'); ?>
		<?php echo form_input('std_ic', isset($std_ic) ? $std_ic : '', 'class="required"'); ?>
		<?php echo form_error('std_ic'); ?>
	</div>


	<div class="field">
		<?php echo form_label('Gender:', 'gender'); ?>
		<?php echo form_radio('gender', 'Male', isset($gender) ? $gender == 'Male' : FALSE, 'class="required"'); ?>Male
		<?php echo form_radio('gender', 'Female', isset($gender) ? $gender == 'Female' : FALSE, 'class="required"'); ?>Female
		<?php echo form_error('gender'); ?>
	</div>


	<div class="field">
		<?php echo form_label('Department:', 'dep'); ?>
		<?php echo form_dropdown('dep', $dep_arr, isset($dep) ? $dep : 0); ?>
		<?php echo form_error('dep'); ?>
	</div>	


	<div class="field">
		<?php echo form_label('Year of Enrolment:', 'year'); ?>
		<?php echo form_dropdown('year', $year_arr, isset($year) ? $year : 0); ?>
		<?php echo form_error('year'); ?>
	</div>	


	<div class="field">
		<?php echo form_label('Registered Module:', 'selected_module'); ?>

		<?php // echo form_dropdown('module', $module_arr, isset($module) ? $module : 0); ?>
		<?php // echo form_submit('submit', 'Add', 'class="btn"'); ?>
		<?php // echo form_error('module'); ?>

		<?php echo form_multiselect( 'selected_module[]', $module_arr, isset( $std_module ) ? $std_module : array() ); ?>
		<?php //echo form_submit('submit', 'Remove', 'class="btn"'); ?>
		<?php echo form_error('module'); ?>
	</div>


	<div class="field">
		<?php echo form_label('Photo:', 'photo'); ?>
		<input type="file" name="userfile" size="20" 'class="btn"' />
		<?php echo form_error('userfile'); ?>
		<?php echo isset($error['error']) ? $error['error'] : '';?>
	</div>


	<?php echo form_submit('submit', 'Submit', 'class="btn"'); ?>

	<?php echo form_close(); ?>

</div>
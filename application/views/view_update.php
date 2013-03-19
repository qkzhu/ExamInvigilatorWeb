<div class="form">

	<div id="search_form">
		<?php echo form_open_multipart('infoUpdate/stdSearch', 'id="search_form"');?>

		<div class="field">
			<?php echo form_label( 'SelectStudent Number:', 'select_std_id' ); ?>
			<?php echo form_dropdown( 'select_std_id', $std_list, isset($selected_sid) ? $selected_sid : -1 ); ?>
			<?php echo form_error( 'std_num' ); ?>
		</div>

		<?php echo form_submit('submit', 'Search', 'class="btn"'); ?>

		<?php echo form_close(); ?>
	</div>


	<?php if ( isset($selected_sid) ): ?>

	<div id="update_form">
		<?php 
		echo form_open_multipart('infoUpdate/do_update', 'id="the_only_form"');
		echo form_hidden( 'select_std_id', isset($selected_sid) ? $selected_sid : -1 );
		?>

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
			<div id="gender_group">
			<?php echo form_radio('gender', 'Male', isset($gender) ? $gender == 'Male' : FALSE, 'class="required"'); ?> Male
			<?php echo form_radio('gender', 'Female', isset($gender) ? $gender == 'Female' : FALSE, 'class="required"'); ?> Female
			</div>
			<?php echo form_error('gender'); ?>
		</div>


		<div class="field">
			<?php echo form_label('Department:', 'dep'); ?>
			<div class="dropdown">
			<?php echo form_dropdown('dep', $dep_arr, isset($dep) ? $dep : 0); ?>
			</div>
			<?php echo form_error('dep'); ?>
		</div>	


		<div class="field">
			<?php echo form_label('Year of Enrolment:', 'year'); ?>
			<div class="dropdown">
			<?php echo form_dropdown('year', $year_arr, isset($year) ? $year : 0); ?>
			</div>
			<?php echo form_error('year'); ?>
		</div>	


		<div class="field" id="multi_box_field">
			<?php echo form_label('Registered Module:', 'selected_module'); ?>
			<?php echo form_multiselect( 'selected_module[]', $module_arr, isset( $std_module ) ? $std_module : array(), 'id="multi_box"' ); ?>
			<?php echo form_error('module'); ?>
		</div>


		<!--
		<div class="field">
			<?php echo form_label('Photo:', 'photo'); ?>
			<input type="file" name="userfile" size="20" 'class="btn"' />
			<?php echo form_error('userfile'); ?>
			<?php echo isset($error['error']) ? $error['error'] : '';?>
		</div>
		-->

		<div class="field">
		<?php echo form_submit('submit', 'Update', 'class="btn"'); ?>
		</div>

		<?php echo form_close(); ?>
	</div>

	<?php endif;?>

</div>
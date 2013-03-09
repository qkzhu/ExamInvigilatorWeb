<div class="form">

	<?php echo $error; ?>

	<?php echo form_open_multipart('photoUploader/do_upload');?>

		<table border="1">
			<tr>
				<td><?php echo form_label('Student Number:', 'std_num'); ?></td>
				<td><?php echo form_input('std_num', 'Your Student Number'); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Your photo:', 'photo'); ?></td>
				<td>
					<input type="file" name="userfile" size="20" />
					<?php echo form_submit('upload', 'Upload'); ?>
				</td>
			</tr>

		</table>

	<?php echo form_close(); ?>

</div>
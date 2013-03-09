<div class="form">

	<?php echo $error; ?>

	<?php echo form_open_multipart('photoUploader/do_upload');?>

		<table border="1">
			<tr>
				<td><?php echo form_label('Student Number:', 'std_num'); ?></td>
				<td><?php echo form_input('std_num', 'Your Student Number'); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Select your photo', 'file'); ?></td>
				<td>
					<input type="file" name="userfile" size="20" />
					<input type="submit" value="upload" />
				</td>
			</tr>

		</table>

	</form>


</div>
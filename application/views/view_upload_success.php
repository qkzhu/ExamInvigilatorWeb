<h3>Your file was successfully uploaded!</h3>

<ul>
<?php foreach ($upload_data as $item => $value):?>
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; ?>
<li><?php echo $std_num; ?></li>
</ul>

<p><?php echo anchor('', 'Upload Another File!'); ?></p>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->load->view('admin_interface/head');?>
	<?php $this->load->view('admin_interface/fckeditor');?>
</head>
<body>
<?php $this->load->view('admin_interface/header');?>
<div class="container_16">
	<div class="grid_12">
		<div class="back">
		<?php if($this->uri->segment(4)!='contact'):?>
			<?=anchor($this->uri->segment(4),'Вернуться назад');?>
		<?php else: ?>
			<?=anchor('','Вернуться на главную');?>
		<?php endif; ?>
		</div>
		<div class="box-content services">
			<?php $this->load->view('admin_interface/formedittext');?>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php $this->load->view('admin_interface/footer');?>
</body>
</html>
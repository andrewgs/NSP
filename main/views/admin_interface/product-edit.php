<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->load->view('admin_interface\head');?>
	<?php $this->load->view('admin_interface\fckeditor');?>
</head>
<body>
<?php $this->load->view('admin_interface\header');?>
<div class="container_16">
	<div class="grid_12">
		<div class="back">
			<?=anchor($this->uri->segment(2).'/'.$this->uri->segment(3),'Вернуться назад');?>
		</div>
		<div class="box-content services">
			<?php $this->load->view('admin_interface\formproductedit');?>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php $this->load->view('admin_interface\footer');?>
</body>
</html>
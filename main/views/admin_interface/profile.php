<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->load->view('admin_interface/head');?>
</head>
<body>
<?php $this->load->view('admin_interface/header');?>
<div class="container_16">
	<div class="grid_12">
		<div class="box-content services">
			<?php $this->load->view('admin_interface/formprofile');?>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php $this->load->view('admin_interface/footer');?>
</body>
</html>
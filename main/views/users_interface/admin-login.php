<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface/head');?>
<body>
<?php $this->load->view('users_interface/header');?>
<div class="container_16">
	<div class="grid_12">
		<div class="box-content services">
			<?php $this->load->view('users_interface/formlogin');?>
		</div>
	</div>
</div>
<div class="clear"></div>
<?php $this->load->view('users_interface/footer');?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface/head');?>
<body>
<?php $this->load->view('users_interface/header');?>
<div class="container_16">
	<div class="grid_11 sepline">
		<div class="box-content">
			<iframe src="http://player.vimeo.com/video/25341282?title=0&amp;byline=0&amp;portrait=0" width="601" height="338" frameborder="0"></iframe>
			<!-- <iframe src="http://player.vimeo.com/video/15628637?title=0&amp;byline=0&amp;color=c4dc1e" width="601" height="338" frameborder="0"></iframe> -->
		</div>
		<div class="box-content services">
		<?php if($content['imgexist']):?>
			<img src="<?=$baseurl;?>text/viewimage/<?=$content['id'];?>"class="floated" alt=""/>
		<?php endif; ?>
			<?=$content['text'];?>
			<?php if($userinfo['status']):?>
				<div class="admin-link"><?=anchor('admin/text-edit/'.$content['id'],'Изменить контент');?></div>
			<?php endif;?>
		</div>
	</div>
	<div class="grid_5">
		<?php $this->load->view('users_interface/contacts');?>
		<?php $this->load->view('users_interface/rightside');?>
	</div>
</div>
<div class="clear"></div>
<?php $this->load->view('users_interface/footer');?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface/head');?>
<body>
<?php $this->load->view('users_interface/header');?>
<div class="container_16">
	<div class="grid_11 sepline">
		<div class="box-content services">
			<div class="news" style="margin-top:10px;">
				<div class="news-date"><?=$content['bdate'];?></div>
			<?php if($content['imgexist']):?>
				<img src="<?=$baseurl;?>news/viewimage/<?=$content['id'];?>"class="floated" alt=""/>
			<?php endif; ?>
				<div class="news-title"><?=$content['title'];?></div>
				<div class="news-content"><?=$content['text'];?></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="grid_5">
		<?php $this->load->view('users_interface/rightside');?>
	</div>
</div>
<div class="clear"></div>
<?php $this->load->view('users_interface/footer');?>
</body>
</html>
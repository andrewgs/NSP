<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface\head');?>
<body>
<?php $this->load->view('users_interface\header');?>
<div class="container_16">
	<div class="grid_11 sepline">
		<div class="box-content services">
		<?php if($userinfo['status']):?>
			<div class="admin-link"><?=anchor('admin/news-add','Добавить новость');?></div>
		<?php endif;?>
		<?php for($i=0;$i<count($content);$i++):?>
			<div class="news" style="margin-top:10px;">
				<div class="news-date"><?=$content[$i]['bdate'];?></div>
			<?php if($content[$i]['imgexist']):?>
				<img src="<?=$baseurl;?>news/viewimage/<?=$content[$i]['id'];?>"class="floated" alt=""/>
			<?php endif; ?>
				<div class="news-title"><?=anchor('news/'.$content[$i]['id'],$content[$i]['title']);?></div>
				<div class="news-content"><?=$content[$i]['text'];?></div>
			</div>
			<div class="clear"></div>
			<?php if($userinfo['status']):?>
				<div class="admin-link"><?=anchor('admin/news-edit/'.$content[$i]['id'],'Изменить');?></div>
				<div class="admin-link"><?=anchor('admin/news-delete/'.$content[$i]['id'],'Удалить');?></div>
			<?php endif;?>
			<div class="clear"></div>
		<?php endfor;?>
		</div>
	</div>
	<div class="grid_5">
		<?php $this->load->view('users_interface\rightside');?>
	</div>
</div>
<div class="clear"></div>
<?php $this->load->view('users_interface\footer');?>
</body>
</html>
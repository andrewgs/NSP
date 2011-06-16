<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface/head');?>
<body>
<?php $this->load->view('users_interface/header');?>
<div class="container_16">
	<div class="grid_11 sepline">
		<div class="box-content services">
		<?php if($content['imgexist']):?>
			<img src="<?=$baseurl;?>text/viewimage/<?=$content['id'];?>"class="floated" alt=""/>
		<?php endif; ?>
			<?=$content['text'];?>
		<?php if($userinfo['status']):?>
			<div class="admin-link"><?=anchor('admin/text-edit/'.$content['id'].'/products','Изменить контент');?></div>
		<?php endif;?>
			<div class="clear"></div>
		<?php if($userinfo['status']):?>
			<div class="admin-link"><?=anchor('admin/organs-add','Добавить орган');?></div>
		<?php endif;?>
		<?php for($i=0;$i<count($organs);$i++):?>
			<div class="grid_3">
				<div class="organs">
					<img src="<?=$baseurl;?>sorgans/viewimage/<?=$organs[$i]['id'];?>"class="floated" alt=""/>
					<div class="organs-title"><?=anchor('organ/'.$organs[$i]['id'],$organs[$i]['title']);?></div>
					<div class="organs-content"><?=$organs[$i]['text'];?></div>
				</div>
			<?php if($userinfo['status']):?>
				<div class="admin-link"><?=anchor('admin/organs-edit/'.$organs[$i]['id'],'Изменить');?></div>
				<div class="admin-link"><?=anchor('admin/organs-delete/'.$organs[$i]['id'],'Удалить');?></div>
			<?php endif;?>
			</div>
			<?php if($i>0 and ($i+1)%3==0):?>
				<div class="clear"></div>
			<?php endif;?>
		<?php endfor;?>
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
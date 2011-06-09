<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface\head');?>
<body>
<?php $this->load->view('users_interface\header');?>
<div class="container_16">
	<div class="grid_11 sepline">
		<div class="box-content services">
			<?=$content['text'];?>
			<div class="clear"></div>
		<?php if($userinfo['status']):?>
			<div class="admin-link"><?=anchor('admin/certificates-add/','Добавить');?></div>
		<?php endif;?>
		<?php for($i=0;$i<count($certificates);$i++):?>
			<div class="grid_5">
				<div class="certificates">
					<img src="<?=$baseurl;?>certificates/viewimage/<?=$certificates[$i]['id'];?>"class="floated" alt=""/>
					<div class="cert-title"><?=$certificates[$i]['title'];?></div>
					<div class="cert-content"><?=$certificates[$i]['text'];?></div>
				</div>
			<?php if($userinfo['status']):?>
				<div class="admin-link"><?=anchor('admin/certificates-edit/'.$certificates[$i]['id'],'Изменить');?></div>
				<div class="admin-link"><?=anchor('admin/certificates-delete/'.$certificates[$i]['id'],'Удалить');?></div>
			<?php endif;?>
			</div>
			<?php if($i>0 and ($i+1)%2==0):?>
				<div class="clear"></div>
			<?php endif;?>
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
<div class="box-content contact">
	<?php if($contacts['imgexist']):?>
		<img src="<?=$baseurl;?>text/viewimage/<?=$contacts['id'];?>"class="floated" alt=""/>
	<?php endif; ?>
	<?=$contacts['text'];?>
	<?php if($userinfo['status']):?>
		<div class="admin-link"><?=anchor('admin/text-edit/'.$contacts['id'].'/contact','Изменить контакты');?></div>
	<?php endif;?>
</div>
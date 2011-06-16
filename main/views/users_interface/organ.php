<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface/head');?>
<body>
<?php $this->load->view('users_interface/header');?>
<div class="container_16">
	<div class="grid_11 sepline">
		<div class="box-content services">
			<div class="back">
				<?=anchor('products','Вернуться к списку огранов');?>
			</div>
			<div class="organ">
				<img src="<?=$baseurl;?>organs/viewimage/<?=$organ['id'];?>"class="floated" alt=""/>
				<div class="organ-title"><?=$organ['title'];?></div>
				<div class="organ-content"><?=$organ['text'];?></div>
			</div>
			<div class="clear"></div>
			<hr size="2"/>
		<?php if($userinfo['status']):?>
			<div class="admin-link"><?=anchor('admin/'.$this->uri->uri_string().'/product-add','Добавить продукт');?></div>
		<?php endif;?>
		<?php for($i=0;$i<count($products);$i++):?>
			<div class="products">
				<img src="<?=$baseurl;?>sproduct/viewimage/<?=$products[$i]['id'];?>"class="floated" alt=""/>
				<div class="products-title"><?=anchor('organ/'.$organ['id'].'/product/'.$products[$i]['id'],$products[$i]['title']);?></div>
				<div class="products-content"><?=$products[$i]['text'];?></div>
			</div>
			<?php if($userinfo['status']):?>
				<div class="admin-link"><?=anchor('admin/'.$this->uri->uri_string().'/product-edit/'.$products[$i]['id'],'Изменить');?></div>
				<div class="admin-link"><?=anchor('admin/'.$this->uri->uri_string().'/product-delete/'.$products[$i]['id'],'Удалить');?></div>
			<?php endif;?>
			<div class="clear"></div>
		<?php endfor;?>
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->load->view('users_interface/head');?>
<body>
<?php $this->load->view('users_interface/header');?>
<div class="container_16">
	<div class="grid_11 sepline">
		<div class="box-content services">
			<?php $link = 'organ/'.$this->uri->segment(2);?>
			<div class="back">
				<?=anchor($link,'Вернуться к списку товаров');?>
			</div>
			<div class="product">
				<img src="<?=$baseurl;?>product/viewimage/<?=$product['id'];?>"class="floated" alt=""/>
				<div class="product-title"><?=$product['title'];?></div>
				<div class="product-price"><?=$product['price'].' '.$product['currency'];?></div>
				<div class="product-content"><?=$product['text'];?></div>
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
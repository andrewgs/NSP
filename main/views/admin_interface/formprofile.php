<?= form_open($this->uri->uri_string(),array('id'=>'formauth','class'=>'formular')); ?>
	<h2>Введите новые данные</h2>
	<?=validation_errors();?>
	<?php if($status):?>
		<div class="valid_success">Данные изменены</div>
	<?endif;?>
	<div class="form-login">
		<b>Имя:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="text" name="name" value="<?=$userinfo['uname'];?>" />
		<div class="clear"></div>
		<b>E-mail:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="text" name="email" value="<?=$userinfo['uemail'];?>" />
		<div class="clear"></div>
		<b>Новый пароль:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="password" name="newpass" value="" />
		<div class="clear"></div>
		<b>Подтвердите пароль:</b><br/>
		<input class="text-form-input" type="password" name="confpass" value="" />
		<div class="clear"></div><br/>
		<input type="submit" class="lnk-submit" name="submit" value="Cохранить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>
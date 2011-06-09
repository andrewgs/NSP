<?= form_open($this->uri->uri_string(),array('id'=>'formauth','class'=>'formular')); ?>
	<h2>Введите логин и пароль</h2>
	<?=validation_errors();?>
	<?php if($error):?>
		<div class="fvalid_error">Не верный логин или пароль</div>
	<?endif;?>
	<div class="form-login">
		<b>Логин:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="text" name="login-name" value="" />
		<div class="clear"></div>
		<b>Пароль:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="password" name="login-pass" value="" />
		<div class="clear"></div><br/>
		<input type="submit" class="lnk-submit" name="submit" value="Авторизоваться"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>
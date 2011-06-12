<?= form_open($this->uri->uri_string(),array('id'=>'formauth','class'=>'formular')); ?>
	<h2>Форма обратной связи</h2>
	<?=validation_errors();?>
	<?php if($status):?>
		<div class="valid_success">Ваше сообщение отправлено</div>
	<?endif;?>
	<div class="form-login">
		<b>Ваше полное имя:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="text" name="name" value="<?=set_value('name');?>" />
		<div class="clear"></div>
		<b>Ваш E-mail:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="text" name="email" value="<?=set_value('email');?>" />
		<div class="clear"></div>
		<b>Тема:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<input class="text-form-input" type="text" name="subject" value="<?=set_value('subject');?>" />
		<div class="clear"></div>
		<b>Сообщение:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
		<textarea class="text-form-textarea" name="note" id="note" cols="100" rows="8"><?=set_value('note');?></textarea>
		<div class="clear"></div><br/>
		<input type="submit" class="lnk-submit" name="submit" value="Отправить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>
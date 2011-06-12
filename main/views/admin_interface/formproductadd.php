<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formauth','class'=>'formular')); ?>
	<?=form_hidden('organ',$this->uri->segment(3));?>
	<h2>Добавление товара</h2>
	<?=validation_errors();?>
	<div class="form-edit-text">
		<b>Рисунок:</b><br/>
		<?= form_error('userfile'); ?>
		<input class="text-form-input" type="file" name="userfile">
		<div class="clear"></div>
		<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG</div>
		<div class="clear"></div>
		<b>Название:</b><br/>
		<input class="text-form-input" type="text" name="title" maxlength="50" value="<?=set_value('title');?>">
		<div class="clear"></div>
		<b>Описание:</b><br/>
		<textarea class="text-form-textarea" name="text" id="note" cols="50" rows="8"><?=set_value('text');?></textarea>
		<div class="clear"></div>
		<b>Цена:</b><br/>
		<input class="text-form-input" type="text" name="price" maxlength="50" value="<?=set_value('price');?>">
		<input class="small-text-form-input" type="text" name="currency" maxlength="50" value="руб.">
		<div class="clear"></div>
		<input type="submit" class="lnk-submit" name="submit" value="Cохранить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>
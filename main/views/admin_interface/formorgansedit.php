<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formauth','class'=>'formular')); ?>
	<h2>Редактирование органа</h2>
	<?=form_hidden('id',$this->uri->segment(3));?>
	<?=validation_errors();?>
	<div class="form-edit-text">
		<b>Новый рисунок:</b><br/>
		<?= form_error('userfile'); ?>
		<input class="text-form-input" type="file" name="userfile">
		<div class="clear"></div>
		<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG</div>
		<div class="clear"></div>
		<div class="deletePhoto">
			<input type="checkbox" name="delete" value="1"> Удалить фото
		</div>
		<div class="clear"></div>
		<b>Название:</b><br/>
		<input class="text-form-input" type="text" name="title" maxlength="50" value="<?=$content['title'];?>">
		<div class="clear"></div>
		<b>Содержание:</b><br/>
		<textarea class="text-form-textarea" name="text" id="note" cols="50" rows="8"><?=$content['text'];?></textarea>
		<div class="clear"></div>
		<input type="submit" class="lnk-submit" name="submit" value="Cохранить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>
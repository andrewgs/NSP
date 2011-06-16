<div class="box-content">
	<div class="back">
		<?=anchor('news','Все новости');?>
	</div>
	<?php for($i=0;$i<count($news);$i++):?>
		<div class="news" style="margin-top:10px;">
		<?php if($news[$i]['imgexist']):?>
			<img src="<?=$baseurl;?>news/viewimage/<?=$news[$i]['id'];?>"class="floated" alt=""/>
		<?php endif; ?>
			<div class="news-title"><?=$news[$i]['title'];?></div>
			<div class="news-date"><?=$news[$i]['bdate'];?></div>
			<div class="news-content">	
				<?=$news[$i]['text'];?>
				<?=anchor('news/'.$news[$i]['id'],'<nobr>Читать полностью</nobr>');?>
			</div>
		</div>
	<?php endfor;?>
</div>
<div class="subbg">
	<div class="subheader">
		<div class="container_16">
			<div class="grid_5">
				<img src="<?=$baseurl;?>images/logo.png" alt="DesignPlus" class="pngfix logo"/>
			</div>
			<div class="grid_11">
				<div class="top-menu pngfix">
					<ul class="sf-menu">
						<li><?=anchor('','Главная');?></li>
						<li><?=anchor('about-me','Обо мне');?></li>
						<li><a href="javascript:void(0)">О компании</a>
							<ul>
								<li><?=anchor('about-company','Информация');?></li>
								<li><?=anchor('certificates-company','Сертификаты');?></li>
							</ul>
						</li>
						<li><?=anchor('products','Продукция');?></li>
					<?php if($userinfo['status']):?>
						<li><a href="javascript:void(0)">Администратор</a>
							<ul>
								<li><?=anchor('profile','Профиль');?></li>
								<li><?=anchor('shutdown','Выход');?></li>
							</ul>
						</li>
					<?php endif;?>
					</ul>
					<span class="rightcorner pngfix"></span>
				</div>
			</div>
			<div class="grid_16">
				<div class="subtitle">
					<h1><b>Администрирование</b></h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clear">&nbsp;</div>
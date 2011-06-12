<link rel="stylesheet" href="<?=$baseurl;?>css/datepicker/jquery.ui.all.css" type="text/css" />
<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.bgiframe-2.1.1.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker-ru.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>javascript/datepicker/jquery.ui.widget.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".input-date").datepicker($.datepicker.regional['ru']);
	});
</script>
<script type="text/javascript" src="<?=$baseurl;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?=$baseurl;?>ckfinder/ckfinder.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var config = {
			skin : 'v2',
			removePlugins : 'scayt',
			resize_enabled: false,
			height: '300px',
			toolbar:
			[
				['Source','-','Preview','-','Templates'],
				['Cut','Copy','Paste','PasteText'],
				['Undo','Redo','-','SelectAll','RemoveFormat'],
				'/',
				['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
				['NumberedList','BulletedList','-','Outdent','Indent'],
				['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Link','Unlink'],
				'/',
				['Format','-'],
				['Image','Table','HorizontalRule','SpecialChar','-'],
				['Maximize', 'ShowBlocks']
			]
		};
		$('#note').ckeditor(config);
		var editor = $('#note').ckeditorGet();
		CKFinder.setupCKEditor(editor,"<?=$baseurl.'ckfinder/'; ?>") ;
	});
</script>
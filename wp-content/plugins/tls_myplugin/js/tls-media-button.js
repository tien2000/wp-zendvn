(function($){
	
	$.fn.tlsBtnMedia = function(inputID){
		var backupSendToEditor = window.send_to_editor;
		this.click(function(){
			tb_show('','media-upload.php?type=image&amp;TB_iframe=true');		
			window.send_to_editor = function(html){
				//imgUrl = $('img',html).attr('src');
				imgUrl = $(html + ' img').attr('src');
				$('#' + inputID).val(imgUrl);
				tb_remove();
				window.send_to_editor = backupSendToEditor;
			}
			return false;
		});
	};
	
}(jQuery));

//$('#button_id').tlsBtnMedia('#input_id');
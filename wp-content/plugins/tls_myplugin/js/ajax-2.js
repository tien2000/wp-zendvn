(function($){
	$.fn.checkInput = function(phpFunc, buttonID){
		$(this).blur(function(e){
			var dataObj = {
					"action": phpFunc,
					"value": $(this).val(),
					"inputID": $(this).attr("id"),
				};
			console.log(dataObj);

			var inputID = "#" + dataObj.inputID;
			var btnID = "#" + buttonID;
			
			$.ajax({
				url		: ajaxurl,		//hoặc admin-ajax.php?action=tls_check_form_2
				type	: "POST",
				data	: dataObj,
				dataType: "json",
				beforeSend: function(){
					$(inputID).next('span').remove();
					$(inputID).after('<span>Checking ...</span>');
				},
				success : function(data, status, jsXHR){
								console.log(data);
								$(inputID).next('span').remove();
								if(data.status == false){
									$(btnID).attr('disabled','disabled');
									$(inputID)
										.after('<span>' + data.errors.errorMes + '</span>');
								}else{
									$(btnID).removeAttr('disabled');
									$(inputID)
									.after('<span>OK</span>');
								}
							}
			});
		});
	};
}(jQuery));

jQuery(document).ready(function($){
	$("#tls_mp_st_ajax_2_title").checkInput("tls_check_form_2", "btn-saveChange");
	$("#tls_mp_st_ajax_2_email").checkInput("tls_check_form_2", "btn-saveChange");
	$("#tls_mp_st_ajax_2_logo").checkInput("tls_check_form_2", "btn-saveChange");
});
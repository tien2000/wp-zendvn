jQuery(document).ready(function($){
	$("#tls_mp_st_ajax_title").blur(function(e){		
		var dataObj = {
				"action": "tls_check_form",
				"value": $(this).val()
			};
		console.log(dataObj);
		
		$.ajax({
			url		: ajaxurl,		//hoặc admin-ajax.php?action=tls_check_form
			type	: "POST",
			data	: dataObj,
			dataType: "json",
			success : function(data, status, jsXHR){
						console.log(data);
						$("#tls_mp_st_ajax_title").next().remove();
						if(data.status == false){
							$("#btn-saveChange").attr('disabled','disabled');
							$("#tls_mp_st_ajax_title")
								.after('<span>' + data.errors.tls_mp_st_ajax_title + '</span>');
						}else{
							$("#btn-saveChange").removeAttr('disabled');
							$("#tls_mp_st_ajax_title")
							.after('<span>OK</span>');
						}
					}
		});
	});
});
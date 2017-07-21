jQuery(document).ready(function($){
	var hash = window.location.hash;
	
	if(hash == ''){
		hash = "#tab1";
	}
	//console.log(hash);
	load_content(hash);
	
	$("#tls-mp-tabs a").click(function(e){
		hash = $(this).attr('href');
		//console.log(hash);
		load_content(hash);
	});
	
	function load_content(tab_name){
		var dataObj = {
				"action": "tls_load_content",
				"tab": tab_name
			};
		console.log(dataObj);
		
		$.ajax({
			url		: ajaxurl,		//hoặc admin-ajax.php?action=tls_check_form
			type	: "POST",
			data	: dataObj,
			dataType: "html",
			beforeSend: function(){
				$("#tls-mp-info").html("Content loading...");
			},
			success : function(data, status, jsXHR){
						$("#tls-mp-info").html(data);
					}
		});
	}	
});
(function($){
	//#topbar-date
	wp.customize('tls_theme_general[date-time]', function( value ){
		//console.log('tls_theme_general[date-time]');
		//console.log(value);
		value.bind(function( newValue ){
			console.log(newValue);
			if(newValue == 'yes'){
				$('#topbar-date').show();
			}else{
				$('#topbar-date').hide();
			}
				
		});
	});
	
	//topbar-search
	wp.customize('tls_theme_general[search]', function( value ){
		value.bind(function( newValue ){
			console.log(newValue);
			if(newValue == 'yes'){
				$('#topbar-search').show();
			}else{
				$('#topbar-search').hide();
			}
				
		});
	});	
	
	//site-text-logo
	wp.customize('tls_theme_general[site-logo]', function(value){		
		value.bind(function(newValue){
			console.log(newValue);
			$('.site-text-logo').html(newValue);
		});
	});
	
	//tls_theme_general[site-description]
	//blog-description
	wp.customize('tls_theme_general[site-description]', function(value){		
		value.bind(function(newValue){
			console.log(newValue);
			$('#blog-description').html(newValue);
		});
	});
	
	//tls_theme_general[site-description-color]	
	wp.customize('tls_theme_general[site-description-color]', function(value){		
		value.bind(function(newValue){
			$('#blog-description').css('color',newValue);
		});
	});
	
	//copyright
	wp.customize('tls_theme_general[site-copyright]', function(value){		
		value.bind(function(newValue){
			console.log(newValue);
			$('#copyright').html(newValue);
		});
	});
}(jQuery));








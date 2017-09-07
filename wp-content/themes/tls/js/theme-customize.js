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
	
	
	/*=====================================
	 * Ads Section
	 *====================================
	 */
	
	//top-banner
	wp.customize('tls_theme_ads[top-banner]', function(value){		
		value.bind(function(newValue){
			$('.header-ad img').attr('src',newValue);
		});
	});
	
	//top-banner-link
	wp.customize('tls_theme_ads[top-banner-link]', function(value){
		value.bind(function(newValue){			
			var imgTag;			
			console.log($(newValue));
			
			if($(newValue).length == 1){
				if($('.header-ad a').length == 1){
					imgTag = $('.header-ad a').html();
					$('.header-ad a').remove();
					$('.header-ad').html(newValue);
					$('.header-ad a').html(imgTag);
				}else{
					imgTag = $('.header-ad').html();
					$('.header-ad').html(newValue);
					$('.header-ad a').html(imgTag);
				}
			}else{
				if($('.header-ad a').length == 1){
					imgTag = $('.header-ad a').html();
					$('.header-ad a').remove();					
					$('.header-ad').html(imgTag);
				}
			}
		});
	});	
	
	//home-bottom-ad
	//content-banner
	wp.customize('tls_theme_ads[content-banner]', function(value){		
		value.bind(function(newValue){
			$('.home-bottom-ad img').attr('src',newValue);
		});
	});
	
	//content-banner
	wp.customize('tls_theme_ads[content-banner-link]', function(value){
		value.bind(function(newValue){			
			var imgTag;			
			console.log($(newValue));
			
			if($(newValue).length == 1){
				if($('.home-bottom-ad a').length == 1){
					imgTag = $('.home-bottom-ad a').html();
					$('.home-bottom-ad a').remove();
					$('.home-bottom-ad').html(newValue);
					$('.home-bottom-ad a').html(imgTag);
				}else{
					imgTag = $('.home-bottom-ad').html();
					$('.home-bottom-ad').html(newValue);
					$('.home-bottom-ad a').html(imgTag);
				}
			}else{
				if($('.home-bottom-ad a').length == 1){
					imgTag = $('.home-bottom-ad a').html();
					$('.home-bottom-ad a').remove();					
					$('.home-bottom-ad').html(imgTag);
				}
			}
		});
	});	
}(jQuery));








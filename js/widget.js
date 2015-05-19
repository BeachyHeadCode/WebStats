$(document).ready(function(){
	// This function is executed once the document is loaded
	
	// Caching the jQuery selectors:
	var panel = $('.onlineWidget .panel');
	var timeout;
	
	$('.onlineWidget').hover(
		function(){
			// Setting a custom 'open' event on the sliding panel:
			
			clearTimeout(timeout);
			timeout = setTimeout(function(){panel.trigger('open');},500);
		},
		function(){
			// Custom 'close' event:
			
			clearTimeout(timeout);
			timeout = setTimeout(function(){panel.trigger('close');},500);
		}
	);
	
	var loaded=false;	// A flag which prevents multiple ajax calls to geodata.php;
	
	// Binding functions to custom events:
	
	panel.bind('open',function(){
		panel.slideDown(function(){
			if(!loaded)
			{
				// Loading the countries and the flags once the sliding panel is shown:
				panel.load('include/geodata.php');
				loaded=true;
			}
		});
	}).bind('close',function(){
		panel.slideUp();
	});
	
});
$(document).ready(function(){
	//highlight current / active link
	$('ul#main-menu li a').each(function(){
		if($($(this))[0].href==String(window.location))
			$(this).parent().addClass('active');
	});
	
	//establish history variables
	var
		History = window.History, // Note: We are using a capital H instead of a lower h
		State = History.getState(),
		$log = $('#log');
	// Check to see if History.js is enabled for our Browser
	if ( !History.enabled ) {
		return false;
	}

	// Bind to State Change
	History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
		// Log the State
		var State = History.getState(); // Note: We are using History.getState() instead of event.state
		
		History.log('statechange:', State.data, State.title, State.url);
		console.log('fire Ajax call');

		$('#modules').fadeOut().parent().append('<div id="loading" class="center"></div>');

		History.pushState(null, null, this.href);
		$('ul#main-menu li.active').removeClass('active');
		$('ul#main-menu li a').each(function(){
			if($($(this))[0].href==String(window.location))
				$(this).parent().addClass('active');
		});

		$.ajax({
			url: State.url,
			success:function(msg){
				$('#modules').html($(msg).find('#modules').html());
				$('#loading').remove();
				$('#modules').fadeIn();
				var newTitle = $(msg).filter('title').text();
				$('title').text(newTitle);
				return false;
			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log(xhr.status);
				console.log(xhr.statusText);
				console.log(xhr.responseText);
				if(xhr.status == '404'){
					alert('Page was not found [404], redirecting to dashboard.');
					window.location.href = "index.php";
				}
			}
		});
		docReady();
	});
	// user document.on so that content loaded via Ajax also gets the "Ajax click" behaviour
	$(document).on('click', 'a.ajax-link', function(e) {
		console.log('fire Ajax call');
		if($.browser.msie) e.which=1;
		if(e.which!=1){ alert('no'); return; }

		e.preventDefault();
		e.stopPropagation();

		History.pushState(null, null, this.href);
		$('ul#main-menu li.active').removeClass('active');
		$('ul#main-menu li a').each(function(){
			if($($(this))[0].href==String(window.location))
				$(this).parent().addClass('active');
		});

		return true;
	});
	
	//animating menus on hover
	$('ul#main-menu li:not(.nav-header)').hover(function(){
		$(this).animate({'margin-left':'+=5'},300);
	},
	function(){
		$(this).animate({'margin-left':'-=5'},300);
	});
	
	//other things to do on document ready, seperated for ajax calls
	docReady();
});

function docReady() {
	$('#pic').fadeOut().parent().append('<div id="loading" class="center"></div>');
	$('#ip').fadeOut().parent().append('<div id="loading-ip" class="center"></div>');
	//Sever pic creation request.
	$.ajax({
		url : 'include/pic.php', 
		processData : false,
		success:function(msg){
				$("#pic").attr("src", "include/pic.php");
				$('#loading').remove();
				$('#pic').fadeIn();
				logInfo( "Pic Loaded!" );
				return false;
			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log(xhr.status);
				console.log(xhr.statusText);
				console.log(xhr.responseText);
				if(xhr.status == '404'){
					alert('Page was not found [404], redirecting to dashboard.');
					window.location.href = "index.php";
				}
			}
	});
	//MCSTATS.ORG update request.
	$.ajax({
		url : 'include/mcstats.php', 
		processData : false
	})
	.fail(function() {
		logError( "mstats error" );
	})
	.always(function(){
		logInfo('mstats updated!');
	});
	console.log('everything loaded');
	//IP request
	$.ajax({
		url : 'include/ip.php',
		success:function(msg){
				$('#ip').html(msg);
				$('#loading-ip').remove();
				$('#ip').fadeIn();
				logInfo( "IP Tracker Loaded!" );
				return false;
			},
			error:function (xhr, ajaxOptions, thrownError){
				console.log(xhr.status);
				console.log(xhr.statusText);
				console.log(xhr.responseText);
				if(xhr.status == '404'){
					alert('Page was not found [404], redirecting to dashboard.');
					window.location.href = "index.php";
				}
			}
	})
	// This function is executed once the document is loaded
	
	// Caching the jQuery selectors:
	//var count = $('.onlineWidget .count');
	var panel = $('.live_panel');
	var timeout;

	// Loading the number of users online into the count div:
	//count.load('who-is-online/online.php');
	$(document).on('mouseenter','.onlineWidget',function(){
   			// Setting a custom 'open' event on the sliding panel:
			clearTimeout(timeout);
			timeout = setTimeout(function(){$('.live_panel').trigger('open');},500);
	});
	$(document).on('mouseleave','.onlineWidget',function(){
			// Custom 'close' event:
			clearTimeout(timeout);
			timeout = setTimeout(function(){$('.live_panel').trigger('close');},500);
	});
	var loaded=false;	// A flag which prevents multiple ajax calls to geodata.php;

	// Binding functions to custom events:

	$(document).on('open',function(){
		$('.live_panel').slideDown("slow",function(){
			if(!loaded)
			{
				// Loading the countries and the flags once the sliding panel is shown:
				$('.live_panel').load('include/geodata.php');
				loaded=true;
			}
		});
	}).on('close',function(){
		$('.live_panel').slideUp();
	});
}
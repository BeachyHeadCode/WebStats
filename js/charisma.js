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
	// user document.on so that content loaded via Ajax also gets the "Ajax click" behaviour
	$(document).on('click', 'a.ajax-link', function(e) {
		console.log('fire Ajax call');
		if($.browser.msie) e.which=1;
		if(e.which!=1){ alert('no'); return; }

		e.preventDefault();
		e.stopPropagation();

		$('#modules').fadeOut().parent().append('<div id="loading" class="center">Loading...<div class="center"></div></div>');

		History.pushState(null, null, this.href);
		$('ul#main-menu li.active').removeClass('active');
		$('ul#main-menu li a').each(function(){
			if($($(this))[0].href==String(window.location))
				$(this).parent().addClass('active');
		});

		$.ajax({
			url: this.href,
			success:function(msg){
				$('#modules').html($(msg).find('#modules').html());
				$('#loading').remove();
				$('#modules').fadeIn();
				docReady();
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
	//Sever pic creation request.
	$.ajax({
		url : 'include/pic.php', 
		processData : false
	})
	.always(function(){
		$("#pic").attr("src", "include/pic.php");
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
	})
	console.log('everything loaded');
}

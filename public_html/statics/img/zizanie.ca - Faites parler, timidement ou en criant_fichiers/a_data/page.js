// JavaScript Document

window.fbAsyncInit = function() {
	FB.init({appId:'180117185373629', status:true, cookie:true, xfbml:true});
	FB.Event.subscribe('edge.create', function(href, widget) {
		console.log(href);
	});
	FB.Event.subscribe('edge.remove', function(href, widget) {
		console.log(href);
	});
	FB.Event.subscribe('comment.create', function(response) {
		console.log(arguments);
	});
};

$(window).load(function() {
	$('#loading').hide();
	$('#comments').fadeIn('fast');
});




$(function() {
	
	if($('.opinion').length) {
	
		$('.opinion .tweet textarea').bind('keyup',function() {
			var tweet = 'Richard Martineau est contre ' + $(this).val();
			$('.opinion form input[name=text]').val(tweet);
			$(this).val($(this).val().slice(0, 90));
		}).bind('change',function() {
			$(this).val($(this).val().slice(0, 90));
		});
		$('textarea').hint();
		$('textarea').hint('show');
		
		$('.opinion form').submit(function() {
			_gaq.push(['_trackEvent','Tweet','Submit',$('.opinion .tweet textarea').val()]);
		});
	
	}
});
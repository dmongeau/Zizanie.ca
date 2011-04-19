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
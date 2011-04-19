// JavaScript Document

$(function() {
	
	
	$('input.color').each(function(){
		var $input = $(this);
		$(this).ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#' + hex);
				$(el).ColorPickerHide();
			},
			onChange: function (hsb, hex, rgb, el) {
				$input.val('#' + hex);
				$input.next('span.color').css('backgroundColor', '#' + hex);
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
	
		if($(this).val().length) {
			$(this).next('span.color').css('backgroundColor', $(this).val());
		}
	});
	
	$('a.advanced').click(function(e) {
		e.preventDefault();
		$('div.advanced').slideToggle('fast',function() {
			if($(this).is(':visible')) {
				$('a.advanced').addClass('arrow-down');
			} else {
				$('a.advanced').removeClass('arrow-down');
			}
		});
	});
	
	$('a.customize').click(function(e) {
		e.preventDefault();
		$('div.customize').slideToggle('fast',function() {
			if($(this).is(':visible')) {
				$('a.customize').addClass('arrow-down');
			} else {
				$('a.customize').removeClass('arrow-down');
			}
		});
	});
	
});
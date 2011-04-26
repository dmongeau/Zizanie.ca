// JavaScript Document

$(function() {
	
	function updatePreview(reload) {
		var params = {};
		params['title'] = $('input[name=title]').val();
		params['type'] = $('input[name=type]:checked').val();
		$('div.customize select, div.customize input').each(function() {
			params[$(this).attr('name')] = $(this).val();
		});
		console.log(params);
		if(!$('#preview iframe').is('.loaded') || reload === true) {
			$('#preview iframe').attr('src','/apercu/?'+jQuery.param(params));
			$('#preview iframe').addClass('loaded');
		} else {
			var $iframe = $('#preview iframe').contents();
			$iframe.find('#content h1').css({
				'fontFamily' : $('div.customize select[name=fontFamily] option:selected').attr('rel'),
				'color' : params['titleColor'],
				'fontSize' : params['titleSize']+'px',
				'textAlign' : params['titleAlign']
			}).text(params['title']);
			
			$iframe.find('#content h2').css({
				'fontFamily' : $('div.customize select[name=fontFamily] option:selected').attr('rel'),
				'color' : params['titleColor']
			});
			
			$iframe.find('body').css({
				'fontFamily' : $('div.customize select[name=fontFamily] option:selected').attr('rel'),
				'background' : params['backgroundColor']
			});
		}
	}
	
	$('select[name=titleAlign], select[name=fontSize], input[type=text]',$('div.customize')).change(updatePreview);
	$('div.customize select[name=fontFamily]').change(function() {
		if(jQuery.inArray($(this).val(),['verdana','arial','georgia']) == -1) {
			updatePreview(true);
		} else {
			updatePreview();
		}
	});
	$('div.customize select[name=colorScheme]').change(function() {
		updatePreview(true);
	});
	$('input[name=title]').blur(function() {
		updatePreview(true);
	});
	$('input[name=type]').click(function() {
		if(($(this).val() == 'comments' || $(this).val() == 'battle') && $(this).is(':checked')) {
			$('.field.comments').show();
			$('.field.tweet').hide();
		} else if($(this).val() == 'tweet' && $(this).is(':checked')) {
			$('.field.tweet').show();
			$('.field.comments').hide();
		} else {
			$('.field.tweet').hide();
			$('.field.comments').hide();
		}
		$('.type .input.type-selected').removeClass('type-selected');
		$(this).parents('.input').addClass('type-selected');
		updatePreview(true);
	});
	$('input[name=type]').trigger('click');
	
	$('input.color').each(function(){
		var $input = $(this);
		$(this).ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val('#' + hex);
				$input.next('span.color').css('backgroundColor', '#' + hex);
				$(el).ColorPickerHide();
				updatePreview();
			},
			onHide: function() {
				updatePreview();
			},
			onChange: function (hsb, hex, rgb, el) {
				$input.val('#' + hex);
				$input.next('span.color').css('backgroundColor', '#' + hex);
				updatePreview();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
	
		if($(this).val().length) {
			$(this).next('span.color').css('backgroundColor', $(this).val());
		}
	});
	
	$('.sizeSlider').slider({
		'min' : 12,
		'max' : 200,
		'value' : $('input[name=titleSize]').val(),
		'step' : 1,
		'slide' : function(event, ui) {
			$('.titleSize').text(ui.value+'px');
			$('input[name=titleSize]').val(ui.value);
			updatePreview();
		},
		'change' : function(event, ui) {
			$('.titleSize').text(ui.value+'px');
			$('input[name=titleSize]').val(ui.value);
			updatePreview();
		}
	});
	$('.titleSize').text($('input[name=titleSize]').val()+'px');
	
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
	
	$('input[type=file]').uploadInput({
		
		'inputName' : 'photo',
		'uploadURL' : '/upload/',
		'progressURL' : '/upload/progress/',
		
		'onStart' : function(uploadKey){
			
			console.log(uploadKey);
			
		},
		'onComplete' : function(uploadKey, file, data){
			
			console.log(data);
			
		},
		'onError' : function(uploadKey, error, data){
			
			console.log(data);
			
		},
		'onProgress' : function(uploadKey, percent, data){
			
			console.log(data);	
			
		}
		
	});

	
	
	$('a.facebookLogin').click(function(e) {
		e.preventDefault();
		FB.login(function(response) {
			if (response.session) {
				if (response.perms) {
				// user is logged in and granted some permissions.
				// perms is a comma separated list of granted permissions
				} else {
				// user is logged in, but did not grant any permissions
				}
			} else {
			// user is not logged in
			}
		}, {perms:'read_stream,publish_stream,offline_access'});

	});
	
});
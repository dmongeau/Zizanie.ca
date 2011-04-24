// JavaScript Document

jQuery.fn.uploadInput = function(opts) {
	
	/*
	 *
	 * Javascript UUID
	 *
	 */
	function UUID() {
		var S4 = function() {return (((1+Math.random())*0x10000)|0).toString(16).substring(1);};
		return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
	}
	
	var $el = $(this);
	
	opts = jQuery.extend({
		
		'inputName' : 'file',
		'uploadURL' : '/upload/',
		'progressURL' : '/upload/progress/',
		
		'onStart' : function(uploadKey, percent, data){},
		'onComplete' : function(uploadKey, file, data){},
		'onError' : function(uploadKey, error, data){},
		'onProgress' : function(uploadKey, percent, data){}
		
	},opts);
	
	
	
	/*
	 *
	 * Prepare photo upload field
	 *
	 */
	var $parent = $(this).parents('form');
	$parent.css('position','relative')
	var $placeholder = $('<div id="upload_placeholder"></div');
	var contentOffset = $parent.offset();
	var offset = $(this).offset();
	var outerWidth = $(this).outerWidth();
	var outerHeight = $(this).outerHeight();
	$placeholder.css({
		'width' : $(this).outerWidth(),
		'height' : $(this).outerHeight()
	});
	$(this).after($placeholder);
	$(this).remove();
	
	
	function uploadPosition() {
		contentOffset = $parent.offset();
		offset = $('#upload_placeholder').offset();
		$('.fileUpload').css({
			'position':'absolute',
			'top' : offset.top-contentOffset.top,
			'left' : offset.left-contentOffset.left
		});
	}
	
	
	function prepareUpload() {
		
		var uploadKey = UUID();
		
		var $upload = $('<div id="upload_'+uploadKey+'" class="fileUpload"></div>');
		var $iframe = $('<iframe frameborder="0" width="1" height="1" name="frame_'+uploadKey+'" id="frame_'+uploadKey+'"></iframe>');
		var $input = $('<input type="'+opts.inputName+'" name="photo" />');
		var $form = $('<form action="'+opts.uploadURL+'" method="post" enctype="multipart/form-data" target="frame_'+uploadKey+'"></form>');
		$form.append('<input type="hidden" name="UPLOAD_IDENTIFIER" value="'+uploadKey+'" />');
		$form.append($input);
		$upload.append($form);
		$upload.append($iframe);
		$parent.append($upload);
		
		uploadPosition();
		
		$input.change(function() {
			opts.onStart.call($el,uploadKey);
			$form.submit();
			$(this).parents('.fileUpload').eq(0).hide();
			$(this).parents('.fileUpload').addClass('fileUploading').removeClass('fileUpload');
			progressTimeout[uploadKey] = setTimeout(function() {
				updateProgress(uploadKey);
			}, 500);
			
		});
	}
	
		
	/*
	 *
	 * Uploaded file callback
	 *
	 */
	window.uploadedInput_file = function(data) {
		
		var uploadKey = data.uploadKey;
		
		if(progressTimeout[uploadKey]) {
			clearTimeout(progressTimeout[uploadKey]);
			progressTimeout[uploadKey] = null;
		}
		
		if($('#upload_'+uploadKey).length) {
			$('#upload_'+uploadKey).remove();
		}
		
		if(data.success && !data.error) {
			opts.onComplete.call($el,uploadKey,data.file,data);
		} else {
			opts.onError.call($el,uploadKey,data.error,data);
		}
			
		uploadPosition();
		
	};
	
	
	/*
	 *
	 * Progress bar
	 *
	 */
	var progressTimeout = {};
	function updateProgress(uploadKey) {
		$.getJSON(opts.progressURL+"?uploadKey=" + uploadKey, function(data) {
			
			var uploaded = false;
			
			if(data) {
				
				if(parseInt(data.files_uploaded) == 1) {
					uploaded = true;
					opts.onProgress.call($el,uploadKey,100,data);
				} else {
					var percent = Math.floor(100 * parseInt(data['bytes_uploaded']) / parseInt(data['bytes_total']));
					opts.onProgress.call($el,uploadKey,percent,data);
				}
				
			}
			
			if(!uploaded) {
				progressTimeout[uploadKey] = setTimeout(function() {
					updateProgress(uploadKey);
				}, 500);
			}
			
		});
	}
	
	
	prepareUpload();
	
	
	$(window).load(uploadPosition);
	$(window).resize(uploadPosition);
	
};
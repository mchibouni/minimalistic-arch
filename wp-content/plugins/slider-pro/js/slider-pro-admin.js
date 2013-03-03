(function($) {
	
	// this will contain the segments used for sorting the slides
	var slidesOrderContainer,
	
		// flag for AJAX requests
		ajaxRequestInProgress = false,
		
		// media loader lightbox
		mediaContainer,
		
		// the total height of images that are loaded in the media loader
		mediaLoaderImagesHeight,
		
		// hold a reference to the slide for which the media loader is opened
		mediaLoaderClickedButton,
		
		// reference to the help tooltip timer
		helpTooltipTimer,
		
		// indicates whether a help tooltip is currently displayed
		isHelpTooltip,
		
		// array that holds the paths of all images that need to be loaded in the slides
		selectedImages = [],
		
		// contains the post types and taxonomies
		postsData = $.parseJSON(sp_js_vars.posts_data);
	
	
	$(document).ready(function() {		
		
		// remove the stylesheet added by WordPress for the Jquery UI Dialog
		$('link[id="wp-jquery-ui-dialog-css"]').attr('disabled', 'disabled');
		$('link[id="wp-jquery-ui-dialog-css"]').remove();
		
		// get the container of the slide tabs from the 'Slides Order' panel
		slidesOrderContainer = $(document).find('.slides-order-container');
		
		
		// get all the existing slide panels and prepare them
		$('.slider-pro .slidebox').each(function(index){
			prepareSlide($(this));
		});
		
		
		// make the slide panels sortable
		$('.slider-pro .ui-sortable').sortable({
				placeholder: 'sortable-placeholder',
				items: '.postbox',
				handle: '.hndle',
				cursor: 'move',
				distance: 2,
				tolerance: 'pointer',
				forcePlaceholderSize: true,
				helper: 'clone',
				opacity: 0.7,
				
				start: function(event, ui) {
					$('body').css({
						WebkitUserSelect: 'none',
						KhtmlUserSelect: 'none'
					});
					
					// remove the tinyMCE editor when a panel is being moved
					if (sp_js_vars.rich_editing)
						ui.item.find('.sp-editor').each(function() {
							var id = $(this).attr('id');
							tinyMCE.execCommand('mceRemoveControl', false, id);
						});
				},
				
				stop: function(event, ui) {
					ui.item.parent().removeClass('temp-border');
					$('body').css({
						WebkitUserSelect: '',
						KhtmlUserSelect: ''
					});
					
					// change the value of the 'position' class based on the current position of the slide
					ui.item.parent().find('.slidebox').each(function(index){
						$(this).find('.position').val(index + 1);
					});
					
					// add the tinyMCE editor after a panel has stopped moving
					if (sp_js_vars.rich_editing)
						ui.item.find('.sp-editor').each(function() {
							var id = $(this).attr('id');						
							tinyMCE.execCommand('mceAddControl', false, id);
						});
				}
		});
		
		
		$('.slider-pro .inner-sidebar .postbox select.settings-multiselect').each(function() {
			var selectBox = $(this);						
			
			selectBox.multiselect({
					  	noneSelectedText: 'See all the available options',
						selectedText: 'See all the available options',
						header: 'Select options you want to customize',
						classes: 'slider-pro slider-settings',
						minWidth: 300
					 })
					 .multiselectfilter();
		});		
		
		
		$('.ui-multiselect-menu.slider-settings ul li label').each(function() {
			var label = $(this),
				title = label.find('input').val();
			
			label.attr('title', title);
		});
		
		
		$('.ui-multiselect-menu.slider-settings ul li label').each(function() {
			addHelpTooltip($(this));
		});
			
			
		$('.slider-pro .inner-sidebar .postbox .show').each(function() {
			addSettingRefresh($(this));
		});
		
		
		// make the slide segments from the sidebar sortable
		slidesOrderContainer.sortable({
			placeholder: 'sortable-placeholder',
			cursor: 'move',
			tolerance: 'pointer',
			forcePlaceholderSize: true,
			helper: 'clone',
			opacity: 0.7,
			
			start: function(event, ui) {
				$('body').css({
					WebkitUserSelect: 'none',
					KhtmlUserSelect: 'none'
				});
			},
			
			stop: function(event, ui) {
				ui.item.parent().removeClass('temp-border');
				$('body').css({
					WebkitUserSelect: '',
					KhtmlUserSelect: ''
				});
				
				slidesOrderContainer.find('.slide-symbol').each(function(index){
					var counter = $(this).data('counter'),
						newPosition = index + 1;
					
					// change the value of the 'position' class based on the new position of the segment	
					$('.slider-pro .ui-sortable .slidebox').each(function() {
						if ($(this).find('.counter').val() == counter) {
							$(this).find('.position').val(newPosition);
						}
					});
				});
			}
		});
		
		
		// add new slide panel(s)
		$('.slider-pro #add-new-slides').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;	
				
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				position = parseInt($('.slider-pro .slidebox').length) + 1,
				counter = 0,
				quantity = parseInt($('.slider-pro #add-slides-quantity').val());
			
			// find the index of the new panel	
			$('.slider-pro .slidebox').each(function(index) {
				counter = Math.max(counter, parseInt($(this).find('.counter').val()));									 
			});
			
			counter++;
			
			if (isNaN(quantity) || quantity < 1) {
				ajaxRequestInProgress = false;
				return;
			}
			
			showProcessingIndicator();
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action, counter: counter, quantity: quantity},
				complete: function(data) {
					hideProcessingIndicator();
					
					var slides = $(data.responseText).appendTo($('.slideboxes'));
					
					slides.each(function(index) {
						var slide = $(this);	
						slide.find('.position').val(position + index);
						prepareSlide(slide);
						slide.hide().fadeIn();
					});
					
					ajaxRequestInProgress = false;
				}
			});
				
		});
		
		
		$('.slider-pro #add-image-slides').click(function(event) {
			event.preventDefault();
			openMediaLoader($(this));
		});
		
		
		$('.slider-pro #apply-bulk-actions').click(function(event) {
			event.preventDefault();
			
			action = $('#bulk-actions-select').val();
			
			if (action == 'Mark All') {	
						
				var slideboxes = $('.slidebox').not('.marked');
				
				slideboxes.addClass('marked');
				slideboxes.find('.selectiondiv').removeClass('unmarkeddiv')
												.addClass('markeddiv')
												.attr('title', 'Unmark the slide');
														  
			} else if (action == 'Unmark All') {
								
				var slideboxes = $('.slidebox.marked');
				
				slideboxes.removeClass('marked');
				slideboxes.find('.selectiondiv').removeClass('markeddiv')
												.addClass('unmarkeddiv')
												.attr('title', 'Mark the slide');
														  
			} else if (action == 'Reverse marking') {
								
				var markedSlideboxes = $('.slidebox.marked'),
					unmarkedSlideboxes = $('.slidebox').not('.marked');
				
				markedSlideboxes.removeClass('marked');
				unmarkedSlideboxes.removeClass('unmarked').addClass('marked');
				
				markedSlideboxes.find('.selectiondiv').removeClass('markeddiv')
													  .addClass('unmarkeddiv')
													  .attr('title', 'Mark the slide');
												
				unmarkedSlideboxes.find('.selectiondiv').removeClass('unmarkeddiv')
														.addClass('markeddiv')
														.attr('title', 'Unmark the slide');
														  
			} else if (action == 'Enable Slides') {
								
				var slideboxes = $('.slidebox.marked');
				
				slideboxes.find('.visibility').val('enabled');				
				slideboxes.find('.visibilitydiv').removeClass('disableddiv')
											     .addClass('enableddiv')
											     .attr('title', 'Disable the slide');
														  
			}  else if (action == 'Disable Slides') {
								
				var slideboxes = $('.slidebox.marked');
				
				slideboxes.find('.visibility').val('disabled');				
				slideboxes.find('.visibilitydiv').removeClass('enableddiv')
											     .addClass('disableddiv')
											     .attr('title', 'Enable the slide');
														  
			} else if (action == 'Delete Slides' ) {
								
				var slideboxes = $('.slideboxes'),
					selectedSlideboxes = slideboxes.find('.slidebox.marked'),
					dialogBox = $('<div><img class="delete-dialog-icon"/><p>' + sp_js_vars.delete_slides + '</p></div>'),
					buttons = {},
					selectedCounters = [],
					counter = 0;
				
				if (!selectedSlideboxes.length)
					return;
					
				buttons[sp_js_vars.yes] = function() {
					dialogBox.remove();
					
					selectedSlideboxes.animate({'opacity': 0}, function() {
						$(this).slideUp(200, function() {
							$(this).remove();
							
							counter++;
							
							if (counter == selectedSlideboxes.length) {
								slideboxes.find('.slidebox').each(function(index){
									$(this).find('.position').val(index + 1);
								});
							}
						});
					});						
					
					
					selectedSlideboxes.find('.counter').each(function() {
						selectedCounters.push($(this).val());	
					});
					
					
					slidesOrderContainer.find('.slide-symbol').each(function(){
						if ($.inArray($(this).data('counter'), selectedCounters) != -1) {
							$(this).remove();
						}
					});
				}
											
				buttons[sp_js_vars.cancel] = function() { 
					dialogBox.remove(); 
				};
					
				dialogBox.dialog({
							resizable:false,
							modal:true,
							width:270,
							buttons: buttons});
				
				$('.ui-dialog-titlebar').remove();
				$('.ui-dialog').addClass('slider-pro-delete-dialog');	
				$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');		
						
			} else if (action == 'Refresh Images') {
				
				$('.slidebox.marked .main-image-buttons a.preview-button').trigger('click');
				
			} else if (action == 'Refresh Thumbs') {
				
				$('.slidebox.marked .thumbnail-buttons a.preview-button').trigger('click');				
			}
		});
		
			
		// preview the slider
		$('.slider-pro .preview-slider').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
				
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				id = url.param('id'),
				name = url.param('name'),
				paramWidth = url.param('width'),
				paramHeight = url.param('height'),
				fluidWidth = paramWidth.indexOf('pc') != -1,
				fluidHeight = paramHeight.indexOf('pc') != -1,
				width = fluidWidth ? 700 : paramWidth,
				height = fluidHeight ? 500 : paramHeight,
				modalWindow,
				previewContainer = $('<div id="preview-container"></div>').appendTo($('body')),
				sizeContainer,
				sliderElement,
				slider;
			
			
			previewContainer.dialog({
				resizable: true,
				modal: true,
				width: width,
				height:height,
				title: name + ' - ' + sp_js_vars.preview,
				create: function() {
					modalWindow = $('.ui-dialog').addClass('slider-pro-preview-dialog');
				},
				close: function() {
					slider.destroy();
					previewContainer.dialog('destroy');
					previewContainer.remove();	
				}
			});
			
			
			sizeContainer = $('<div id="size-container"></div>').appendTo(previewContainer);
			
			sizeContainer.html('<span class="size-text">Slider Size: </span>' + 
							   '<input class="size-input" id="slider-width-input" type="text" value=""/>' + 
							   '<span class="size-text"> X </span>' + 
							   '<input class="size-input" id="slider-height-input" type="text" value=""/>' + 									   
							   '<a class="button" id="preview-size-button" href="#">Preview Size</a>' +
							   '<a class="button" id="copy-values-button" href="#">Copy Values</a>' +
							   '<br/>' +
							   '<span class="size-text">Slide' + '&nbsp;&nbsp;' + 'Size: </span> ' + 
							   '<input class="size-input" id="slide-width-input" type="text" value=""/>' + 
							   '<span class="size-text"> X </span>' + 
							   '<input class="size-input" id="slide-height-input" type="text" value=""/>');					
			
			
			var sliderWidthInput = sizeContainer.find('#slider-width-input'),
				sliderHeightInput = sizeContainer.find('#slider-height-input'),
				slideWidthInput = sizeContainer.find('#slide-width-input'),
				slideHeightInput = sizeContainer.find('#slide-height-input'),
				previewSizeButton = sizeContainer.find('#preview-size-button'),
				copyValuesButton = sizeContainer.find('#copy-values-button');
			
			
			previewSizeButton.click(function(event) {
				event.preventDefault();
				
				if (!fluidWidth)
					sliderElement.css('width', sliderWidthInput.val());
				
				if (!fluidHeight)
					sliderElement.css('height', sliderHeightInput.val());
				
				slider.doSliderLayout();
				
				if (fluidWidth && !fluidHeight)
					previewContainer.dialog('option', 'height', 'auto');
				else if (fluidHeight && !fluidWidth)
					previewContainer.dialog('option', 'width', 'auto');
				else if (!fluidWidth && !fluidHeight)
					previewContainer.dialog('option', {'width': 'auto', 'height': 'auto'});							
			});
			
			
			copyValuesButton.click(function(event) {
				event.preventDefault();
				
				$('.slider-pro .inner-sidebar input[name="slider_settings[width]"]').val(sliderWidthInput.val());
				$('.slider-pro .inner-sidebar input[name="slider_settings[height]"]').val(sliderHeightInput.val());
			});
			
			
			if (fluidWidth) {
				sliderWidthInput.addClass('disabled')
								.attr('readonly', 'readonly');
				
				slideWidthInput.addClass('disabled')
							   .attr('readonly', 'readonly');
			}
			
			if (fluidHeight) {
				sliderHeightInput.addClass('disabled')
								 .attr('readonly', 'readonly');
				
				slideHeightInput.addClass('disabled')
								.attr('readonly', 'readonly');
			}
			
			
			function sizeLiveUpdate() {		
				var widthDiff = parseInt(sliderWidthInput.val()) - parseInt(slideWidthInput.val()),
					heightDiff = parseInt(sliderHeightInput.val()) - parseInt(slideHeightInput.val());
					
				
				sliderWidthInput.bind('propertychange input keyup paste', function(event) {
					slideWidthInput.val(parseInt($(this).val()) - widthDiff);
				});
				
					
				slideWidthInput.bind('propertychange input keyup paste', function(event) {
					sliderWidthInput.val(parseInt($(this).val()) + widthDiff);
				});
				
				
				sliderHeightInput.bind('propertychange input keyup paste', function(event) {
					slideHeightInput.val(parseInt($(this).val()) - heightDiff);
				});
				
				
				slideHeightInput.bind('propertychange input keyup paste', function(event) {
					sliderHeightInput.val(parseInt($(this).val()) + heightDiff);
				});
			}
			
			
			$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay')
								   .click(function() {
										slider.destroy();
										previewContainer.dialog('destroy');
										previewContainer.remove();												
									});
			
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, id: id},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					$(data.responseText).appendTo(previewContainer);					
					sliderElement = previewContainer.find('.advanced-slider');
					slider = sliderElement.advancedSlider();					
					
					previewContainer.dialog('option', 'width', slider.getSize().sliderWidth + 80);					
					previewContainer.dialog('option', 'height', slider.getSize().sliderHeight + 170);						
					
					modalWindow.css({'left': ($(window).width() - modalWindow.width()) / 2, 'top': ($(window).height() - modalWindow.height()) / 2});
					
					slider.settings.doSliderLayout = function() {
						$('.slider-pro-preview-dialog #preview-container').css('background-image', 'none');
						
						sliderWidthInput.val(slider.getSize().sliderWidth);
						sliderHeightInput.val(slider.getSize().sliderHeight);
						slideWidthInput.val(slider.getSize().slideWidth);
						slideHeightInput.val(slider.getSize().slideHeight);
						
						sizeLiveUpdate();
					};
					
					slider.doSliderLayout();
				}
			});
			
		});
		
		
		
		// delete the slider
		$('.slider-pro .delete-slider').click(function(event) {
			event.preventDefault();
			
			var link = $(this),
				dialogBox = $('<div><div class="delete-dialog-icon"></div><p>' + sp_js_vars.delete_slider + '</p></div>'),
				buttons = {};
			
			buttons[sp_js_vars.yes] = function() { $(this).remove(); window.location = $(link).prop('href'); };
			buttons[sp_js_vars.cancel] = function() { $(this).remove(); };
			
			dialogBox.dialog({
				resizable: false,
				modal: true,
				width: 270,
				buttons: buttons
			});
			
			$('.ui-dialog-titlebar').remove();
			$('.ui-dialog').addClass('slider-pro-delete-dialog');
			$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
		});		
		
		
		// import a slider
		$('.slider-pro #import-slider').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;				
			
			ajaxRequestInProgress = true;
			
			var url = $.url($(this).prop('href')),
				action = url.param('action');
				
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					var importContainer = $('<div id="import-container"></div>').appendTo($('body'));
					$(data.responseText).appendTo(importContainer);
					
					importContainer.dialog({
						resizable: false,
						modal: true,
						width: 'auto',
						height: 100,
						title: sp_js_vars.import_slider,
						close: function() {
							importContainer.remove();	
						}});
					
					$('.ui-dialog').addClass('slider-pro-import-dialog');					
					$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
				}
			});
		});		
		
		
		// replicate skin
		$('.slider-pro #replicate-skin').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				skin = url.param('skin');
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, skin: skin},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					var replicateSkinContainer = $('<div id="replicate-skin-container"></div>').appendTo($('body'));
					$(data.responseText).appendTo(replicateSkinContainer);
					
					replicateSkinContainer.dialog({
						resizable: false,
						modal: true,
						width: 'auto',
						height: 'auto',
						title: sp_js_vars.replicate_skin,
						close: function() {
							replicateSkinContainer.remove();	
					}});
					
					
					replicateSkinContainer.find('input[type="text"]').each(function() {
						var field = $(this),
							fieldText = $(this).val();
							
						field.blur();
						
						field.focusin(function() {
							if ($(this).val() == fieldText)
								$(this).val('');
						});
						
						field.focusout(function() {
							if ($(this).val() == '')
								$(this).val(fieldText);
						});
					})
					
					
					$('.ui-dialog').addClass('slider-pro-replicate-skin-dialog');					
					$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
				}
			});
		});
		
		
		// refresh all skins
		$('.slider-pro #refresh-all-skins').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			showAjaxPreloader();
			
			var url = $.url($(this).prop('href')),
				action = url.param('action');
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					window.location = data.responseText;
				}
			});
		});
		
		
		// create window for custom JS/CSS code edit
		$('.slider-pro #edit-custom-js, .slider-pro #edit-custom-css').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			showAjaxPreloader();
			
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				id = url.param('id'),
				type = $(this).attr('id'),
				title = type == 'edit-custom-js' ? sp_js_vars.custom_js_title : sp_js_vars.custom_css_title;
				
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action, type: type, id: id},
				complete: function(data) {
					ajaxRequestInProgress = false;
					hideAjaxPreloader();
					
					var editorContainer = $('<div id="editor-container"></div>').appendTo($('body'));
					$(data.responseText).appendTo(editorContainer);
					
					var editorTextarea = editorContainer.find('.custom-js-css-content');
					editorTextarea.css({width: 700, height: $(window).height() - 300});
					
					
					editorContainer.dialog({
						resizable: false,
						modal: true,
						width: 'auto',
						height: 'auto',
						title: title,
						close: function() {
							editorContainer.remove();
						}
					});
					
					
					$('.ui-dialog').addClass('slider-pro-custom-js-css-dialog');
					$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
					
					
					// save the edits using AJAX
					editorContainer.find('.save-button').click(function(event) {
						event.preventDefault();
						
						if (ajaxRequestInProgress)
							return;
						
						ajaxRequestInProgress = true;
						
						var saveButton = $(this);
							url = $.url(saveButton.prop('href')),
							action = url.param('action'),
							id = url.param('id'),
							type = url.param('type'),
							nonce = url.param('_wpnonce'),
							contentArea = editorContainer.find('.custom-js-css-content'),
							content = contentArea.val();						
						
						saveButton.text('Saving...');
						contentArea.attr('disabled', 'disabled');
						
						$.ajax({
							url: sp_js_vars.ajaxurl,
							type: 'post',
							data: {action: action, type: type, id: id, content: content, _wpnonce: nonce},
							complete: function(data) {
								ajaxRequestInProgress = false;
								
								saveButton.text('Save');
								contentArea.removeAttr('disabled');
							}
						});
						
					});
					
				}
			});
		});
		
		
		
		$('.slider-pro .inner-sidebar .handlediv').each(function() {
			addPanelSliding($(this));			
		});
		
		
		$('.slider-pro .inner-sidebar .postbox').each(function() {
			setPanelState($(this));
		});
		
		
		$('.slider-pro .inner-sidebar .sp-color-picker').each(function(){
			addColorPicker($(this));
		});
		
		
		$('.slider-pro .inner-sidebar label').each(function(){
			addHelpTooltip($(this));
		});
		
	});
	
	
	
	function prepareSlide(slide) {
		
		// set the panel to opened or closed
		setPanelState(slide);
		
		// create the tabs
		slide.find('.slide-tabs').tabs({
			select: function(event, ui) {
				slide.find('.selected-tab').val(ui.index);
			},
			
			create: function() {
				$(this).tabs('select', parseInt(slide.find('.selected-tab').val()));
			}
		});
		
		// add the option to hide the panel
		addPanelSliding(slide.find('.handlediv'));
		
		// open the large image when the preview box is clicked
		slide.find('.preview-box .image').each(function() {
			addImagePreviewBox($(this));
		});
		
		
		// create a new slide segment
		var slideSymbol = $('<div class="slide-symbol"></div>').appendTo(slidesOrderContainer);
		$('<p>' + slide.find('.name').val() + '</p>').appendTo(slideSymbol);
		slideSymbol.data('counter', slide.find('.counter').val());
		
		
		// make it possible to change the name of the slide on double click on the panel's handler
		slide.find('.hndle').dblclick(function() {
			var handle = $(this);
			
			if (!handle.data('isEditing')) {
				handle.data('isEditing', true);
				
				var currentTitle = $(this).html();
				
				$(this).html('|');
				
				var	input = $('<input/>')
					.addClass('title-input')
					.attr('type', 'text')
					.val(currentTitle)
					.click(function(event) {
						event.stopPropagation();   
					})
					.keypress(function(event) {
						if (event.which == 13) {
							handle.data('isEditing', false);				
							var editedTitle = $(this).val();																							
							$(this).remove();
							handle.html(editedTitle);
																		
							var nameField = handle.parent().find('.name');
							nameField.val(editedTitle);
																		
							slideSymbol.find('p').html(editedTitle);
						}
					})
					.appendTo(handle);
			}
		});
		
		
		slide.find('.hndle').click(function() {													  
			if ($(this).data('isEditing')) {
				$(this).data('isEditing', false);
				
				var input = $(this).parent().find('.title-input'),
					editedTitle = input.val();
					
				input.remove();
				$(this).html(editedTitle);
				
				var nameField = $(this).parent().find('.name');
				nameField.val(editedTitle);
				
				slideSymbol.find('p').html(editedTitle);
			}
		});
		
		
		// delete the slide panel
		slide.find('.closediv').click(function() {
			var slidebox = $(this).parent(),
				dialogBox = $('<div><img class="delete-dialog-icon"/><p>' + sp_js_vars.delete_slide + '</p></div>'),
				slideboxes = slidebox.parent(),
				buttons = {};
			
			buttons[sp_js_vars.yes] = function() {
				dialogBox.remove();
				
				slidebox.animate({'opacity': 0}, function() {
					$(this).slideUp(200, function() {
						$(this).remove();
						slideboxes.find('.slidebox').each(function(index){
							$(this).find('.position').val(index + 1);
						});
					})
				});
				
				slidesOrderContainer.find('.slide-symbol').each(function(){
					if($(this).data('counter') == slide.find('.counter').val()) {
						$(this).remove();		
					}
				});
			}
										
			buttons[sp_js_vars.cancel] = function() { 
				dialogBox.remove(); 
			};
				
			dialogBox.dialog({
						resizable:false,
						modal:true,
						width:270,
						buttons: buttons});
			
			$('.ui-dialog-titlebar').remove();
			$('.ui-dialog').addClass('slider-pro-delete-dialog');	
			$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay');
		});
		
		
		// duplicate the slide
		slide.find('.duplicatediv').click(function() {
			if (ajaxRequestInProgress)
				return;
				
			ajaxRequestInProgress = true;
				
			var action = 'sliderpro_duplicate_slide',
				id = parseInt(slide.find('.id').val()),
				position = parseInt($('.slider-pro .slidebox').length) + 1,
				counter = 0;
			
			// find the index of the new panel	
			$('.slider-pro .slidebox').each(function(index) {
				counter = Math.max(counter, parseInt($(this).find('.counter').val()));									 
			});
			
			counter++;
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: {action: action, counter: counter, id: id},
				complete: function(data) {
					var slide = $(data.responseText).appendTo($('.slideboxes'));		
					slide.find('.position').val(position);
					prepareSlide(slide);
					ajaxRequestInProgress = false;
					slide.hide().fadeIn();
				}
			});
		});
		
		
		// enable/disable the slide
		slide.find('.visibilitydiv').click(function() {
			var isEnabled = $(this).hasClass('enableddiv');
			
			if (isEnabled) {
				$(this).removeClass('enableddiv')
					   .addClass('disableddiv')
					   .attr('title', 'Enable the slide');
					   
				slide.find('.visibility').val('disabled');
			} else {
				$(this).removeClass('disableddiv')
					   .addClass('enableddiv')
					   .attr('title', 'Disable the slide');
					   
				slide.find('.visibility').val('enabled');
			}
		});
		
		
		// mark/unmark the slide
		slide.find('.selectiondiv').click(function() {
			var isMarked = $(this).hasClass('markeddiv');
			
			if (isMarked) {
				$(this).removeClass('markeddiv')
					   .addClass('unmarkeddiv')
					   .attr('title', 'Mark the slide');
				
				if (slide.hasClass('marked'))
					slide.removeClass('marked');
					
				slide.addClass('unmarked');
			} else {
				$(this).removeClass('unmarkeddiv')
					   .addClass('markeddiv')
					   .attr('title', 'Unmark the slide');
				
				if (slide.hasClass('unmarked'))
					slide.removeClass('unmarked');
						   
				slide.addClass('marked');
			}
		});
		
		
		// create the tinyMCE editor
		if (sp_js_vars.rich_editing) {
			slide.find('.sp-editor').each(function() {
				$(this).tinymce({
					script_url : sp_js_vars.url + '/slider-pro/js/tinymce/tiny_mce.js',
					theme : "advanced",
					skin: "wp_theme", 
					width: "100%", 
					theme_advanced_toolbar_location: "top",
					theme_advanced_toolbar_align: "left",
					theme_advanced_statusbar_location: "bottom",
					theme_advanced_resizing: true,
					theme_advanced_resize_horizontal: false,
					plugins: "inlinepopups,spellchecker,paste,wordpress,fullscreen,wpeditimage,wpgallery,tabfocus",
					dialog_type: "modal",
					theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,bullist,numlist,blockquote,|,removeformat,|,link,unlink,|,image,charmap,|,undo,redo,|,wp_adv,code",
					theme_advanced_buttons2: "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,pastetext,pasteword,outdent,indent",
					theme_advanced_buttons3: "",
					valid_elements: "*[*]",
					apply_source_formatting: true,					
					verify_html: false,
					cleanup: false,
					entity_encoding: "raw",
					convert_urls: false,
					relative_urls: false,
					remove_script_host: false,
					forced_root_block: false,
					force_p_newlines: false,
					force_br_newlines: true
				});
			});
		}
		
		
		// show the preview image
		slide.find('a.preview-button').click(function(event) {
			event.preventDefault();
			
			var imagePath = $(this).parents('.info-input').find('.path').val();
			
			if (imagePath.indexOf('[') != -1)
				return;
			
			var	box = $(this).parents('.info-input').siblings('.preview-box'),
				w = parseInt(box.css('width')),
				h = parseInt(box.css('height'));
				
				
			var fullPath = sp_js_vars.enable_timthumb == true ? (sp_js_vars.timthumb + '?src=' + imagePath + '&w=' + w + '&h=' + h + '&q=95') : imagePath;
			
			box.find('.image').remove();
			
			if (box.hasClass('no-image'))
				box.removeClass('no-image');
				
			if (box.hasClass('image-not-found'))
				box.removeClass('image-not-found');
				
			box.addClass('image-preload');
			
			$('<img class="image"/>').load(function() {
										box.removeClass('image-preload');
										$(this).hide().fadeIn().appendTo(box);
										
										addImagePreviewBox($(this));
									 })
									 .error(function() {
										box.removeClass('image-preload')
										   .addClass('image-not-found');
									 })
									 .attr('src', fullPath);
		});
				
		
		// open the lightbox for inserting image(s)
		slide.find('a.open-media-loader').click(function(event) {
			event.preventDefault();
			openMediaLoader($(this));
		});
		
		
		// when a label is clicked make it bold
		// a bold label will indicate that the slide setting will override the global setting
		slide.find('.slide-tabs-settings label').each(function() {
			var label = $(this),
				override = label.find('.override'),
				currentValue = parseInt(override.val());
			
			if (currentValue == 1)
				label.addClass('override-label');
			
			label.click(function(event) {
				event.preventDefault();
				
				currentValue = parseInt(override.val());
				
				if (currentValue == 0) {
					override.val(1);
					label.addClass('override-label');
				} else {
					override.val(0);
					label.removeClass('override-label');
				}
			});
		});
		
		
		slide.find('select.settings-multiselect').each(function() {
			var selectBox = $(this);
			
			selectBox.multiselect({
					  	noneSelectedText: 'Select options to override',
						selectedText: 'Select options to override',
						header: 'Select options to override',
						classes: 'slider-pro slide-settings',
						minWidth: 320
					 })
					 .multiselectfilter();
		});
		
		
		slide.find('.show-selected-settings').each(function(){
			addSettingRefresh($(this));
		});
		
		
		// add the help functionality
		slide.find('label').each(function(){
			addHelpTooltip($(this));
		});
		
		
		slide.find('.posts-data-fields').each(function(){
			setPostsDataSelectors($(this));
		});
		
		
		slide.find('.slide-type').change(function(event){
			if (ajaxRequestInProgress) {
				event.preventDefault();
				return;
			}
			
			
			var selectedSlideType = $(this).val(),
				counter = slide.find('.counter').val(),
				dynamicControlFieldsContainer = slide.find('.dynamic-control-fields-container'),
				loadingIndicator = slide.find('p.loading-controls-indicator'),
				dynamicFields = dynamicControlFieldsContainer.find('.dynamic-fields');
								
				
			if (selectedSlideType != 'static') {
				ajaxRequestInProgress = true;
				loadingIndicator.removeClass('hide').addClass('show');
				
				if (dynamicFields.length)
					dynamicFields.remove();
					
				$.ajax({
					url: sp_js_vars.ajaxurl,
					type: 'get',
					data: {action: 'sliderpro_add_dynamic_fields', counter: counter, slide_type: selectedSlideType},
					complete: function(data) {
						loadingIndicator.removeClass('show').addClass('hide');
											
						$(data.responseText).appendTo(dynamicControlFieldsContainer);
						dynamicFields = dynamicControlFieldsContainer.find('.dynamic-fields');
						
						if (selectedSlideType == 'posts')
							setPostsDataSelectors(dynamicFields);
						
						dynamicFields.find('label').each(function() {
							addHelpTooltip($(this));
						});
						
						ajaxRequestInProgress = false;
					}
				});
			} else if (dynamicFields.length) {
				dynamicFields.remove();
			}
		});
	}
	
	
	function setPostsDataSelectors(target) {
		var postTypesSelectBox,
			postTaxonomiesSelectBox,
			selectedPostTypes = [],
			selectedTerms = [],
			attachedTaxonomies = [];
		
		
		function refreshAttachedTaxonomies() {
			attachedTaxonomies = [];
			
			// get all taxonomies that need to be loaded based on the currently selected post types
			$.each(selectedPostTypes, function(index, postName) {
				var taxonomies = postsData['post_types'][postName]['post_taxonomies'];
				$.each(taxonomies, function(index, taxonomy) {
					if ($.inArray(taxonomy, attachedTaxonomies) == -1)
						attachedTaxonomies.push(taxonomy);
				});
			});
			
			// clear the selectbox
			postTaxonomiesSelectBox.empty();
			
			// display the taxonomies and terms for the selected post types
			$.each(attachedTaxonomies, function(index, taxonomyName) {
				var taxonomy = postsData['taxonomies'][taxonomyName];
				
				// check if the taxonomy contains terms
				if (!$.isEmptyObject(taxonomy['taxonomy_terms'])) {
					// create the select group
					var	taxonomyGroup = $('<optgroup label="' + taxonomy['taxonomy_label'] + '"></optgroup>').appendTo(postTaxonomiesSelectBox),
						selected;
						
					$.each(taxonomy['taxonomy_terms'], function(index, term) {
						// check if the option should be selected
						selected = $.inArray(term['term_complete'], selectedTerms) != -1 ? ' selected="selected"' : '';
						
						// create the option
						$('<option' + selected + ' value="' + term['term_complete'] + '">' + term['term_name'] + '</option>').appendTo(taxonomyGroup);
					});
				}
			});
						
			postTaxonomiesSelectBox.multiselect('refresh');
		}
		
		
		target.find('select.post-types-multiselect').each(function() {
			postTypesSelectBox = $(this);
			
			// get the initial post types
			if (postTypesSelectBox.val())
				selectedPostTypes = postTypesSelectBox.val();
				
			postTypesSelectBox.multiselect({
									header: 'Post Types',
									noneSelectedText: 'Post Types',
									classes: 'slider-pro post-types',
									height: 'auto',
									minWidth: 156,
									selectedList: 2,
									click: function(event, ui) {
										var index = $.inArray(ui.value, selectedPostTypes);
										
										if (ui.checked && index == -1)
											selectedPostTypes.push(ui.value);
										else if (!ui.checked && index != -1)
											selectedPostTypes.splice(index, 1);
										
										// get the new taxonomies for the selected posts	
										refreshAttachedTaxonomies();
									}
							  })
							  .multiselectfilter();
		});
		
		
		target.find('select.post-taxonomies-multiselect').each(function() {
			postTaxonomiesSelectBox = $(this);
			
			// get the initial taxonomy terms
			if (postTaxonomiesSelectBox.val())
				selectedTerms = postTaxonomiesSelectBox.val();
				
			postTaxonomiesSelectBox.multiselect({
										header: 'Post Taxonomies',
										noneSelectedText: 'Post Taxonomies',
										classes: 'slider-pro post-taxonomies',
										minWidth: 200,
										selectedList: 2,
										click: function(event, ui) {
											var index = $.inArray(ui.value, selectedTerms);
											
											if (ui.checked && index == -1)
												selectedTerms.push(ui.value);
											else if (!ui.checked && index != -1)
												selectedTerms.splice(index, 1);
										}
									})
									.multiselectfilter();
		});
		
		
		target.find('select.relation-multiselect').each(function() {
			$(this).multiselect({
						header: 'Relation',
						classes: 'slider-pro',
						minWidth: 94,
						height: 'auto',
						multiple: false,
						selectedList: 1
					});
		});
		
		
		target.find('select.orderby-multiselect').each(function() {
			$(this).multiselect({
						header: 'Order By',
						classes: 'slider-pro',
						minWidth: 100,
						height: 'auto',
						multiple: false,
						selectedList: 1
					});
		});
		
		
		target.find('select.order-multiselect').each(function() {
			$(this).multiselect({
						classes: 'slider-pro',
						header: 'Order',
						minWidth: 80,
						height: 'auto',
						multiple: false,
						selectedList: 1
					});
		});
	}
	
	
	// close/open the panel
	function setPanelState(target) {
		if (target.find('.panel-state').val() == 'closed')
			target.find('.inside').hide();
	}
	
	
	// make the panel slideabled 
	function addPanelSliding(target) {
		target.click(function() {
			var panel = target.parent(),
				panelsState = panel.find('.panel-state');
					
			if (panelsState.val() == 'closed')
				panelsState.val('opened');
			else
				panelsState.val('closed');
				
			panel.find('.inside').slideToggle();
		});
	}
	
	
	function addSettingRefresh(target) {
		target.click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			
			var target = $(this),
				url = $.url($(this).prop('href')),
				action = url.param('action'),
				counter = url.param('counter'),
				selectBox = target.siblings('select.settings-multiselect'),
				selectedSettings = selectBox.val(),
				selectedSettingsRef = [],
				settingsContainer = target.parents('.postbox').find('.settings-container');
				
			if (selectedSettings) {
				selectedSettingsRef = selectedSettings.slice(0);
				
				$.each(selectedSettingsRef, function(index, value) {
					if (settingsContainer.find('#' + value).length ) {
						var idx = $.inArray(value, selectedSettings);
						selectedSettings.splice(idx, 1);
					}
				});
				
				settingsContainer.find('.setting-field').each(function() {
					if ($.inArray($(this).attr('id'), selectedSettingsRef) == -1)
						$(this).remove();
				});
				
				if (!selectedSettings.length) {
					ajaxRequestInProgress = false;
					return;
				}
			} else {
				settingsContainer.empty();
				ajaxRequestInProgress = false;
				return;
			}
			
			
			var data = {action: action, settings: selectedSettings.join('|')};
			
			if (counter)
				data['counter'] = counter;
				
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				data: data,
				complete: function(data) {			
					var newFields = $(data.responseText).appendTo(settingsContainer);
					
					newFields.find('.sp-color-picker').each(function() {
						addColorPicker($(this));
					});
					
					newFields.find('label').each(function() {
						addHelpTooltip($(this));
					});
					
					ajaxRequestInProgress = false;
				}
			});
		});
	}
	
	
	// open the image
	function addImagePreviewBox(target) {
		var url = $.url(target.prop('src')),
			imagePath = url.param('src') || target.attr('src');
			
		target.css('cursor', 'pointer')
			  .click(function() {
				  	showAjaxPreloader();
					
					$('<img/>').load(function() {
						var dialog = $(this).dialog({
							resizable: false,
							modal: true,
							width: 'auto',
							create: function() {
								hideAjaxPreloader();
							}
						});
						
						$('.ui-dialog').addClass('slider-pro-image-dialog');														
						$('.ui-dialog-titlebar').remove();
						$('.ui-dialog-content').css({'padding': 0});
						$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay')
											   .click(function() {
													dialog.dialog('close');
												});
						
						dialog.click(function() {
							dialog.remove();
						});
					})
			.attr('src', imagePath);
		});
	}
	
	
	// open the media loader
	function openMediaLoader(target) {
		if (ajaxRequestInProgress)
			return;
		
		ajaxRequestInProgress = true;
		
		showAjaxPreloader();
		
		var url = $.url(target.prop('href')),
			action = url.param('action'),
			showPage = url.param('show_page'),
			showDate = url.param('show_date'),
			allow = url.param('allow'),
			containerHeight = $(window).height() - 200;
			
		mediaLoaderImagesHeight = containerHeight - 150;
		
		mediaLoaderClickedButton = target;
		
		selectedImages = [];
		
		$.ajax({
			url: sp_js_vars.ajaxurl,
			type: 'get',
			dataType:'html',
			data: {action: action, images_total_height: mediaLoaderImagesHeight, show_page: showPage, show_date: showDate, allow: allow},
			complete: function(data) {						
				ajaxRequestInProgress = false;
					
				mediaContainer = $('<div id="media-container"></div>');
				$(data.responseText).appendTo(mediaContainer);
				
				mediaContainer.dialog({
					resizable: false,
					modal: true,
					width: 'auto',
					height: containerHeight,
					title: sp_js_vars.media_loader,
					create: function() {
						hideAjaxPreloader();
					},
					close:function() {
						mediaContainer.dialog('destroy');
						mediaContainer.remove();
					}
				});
					
				mediaLoaderProcessContent(allow);				
				
				$('.ui-dialog').addClass('slider-pro-media-dialog');
				
				$('.ui-widget-overlay').addClass('slider-pro-dialog-overlay')
									   .click(function() {
											mediaContainer.dialog('destroy');
											mediaContainer.remove();
										});
			}
		});
	}
	
	
	function mediaLoaderProcessContent(allow) {
		mediaContainer.find('#show-interval').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
			
			ajaxRequestInProgress = true;
			
			var url = $.url($(this).prop('href')),
				action = url.param('action'),
				showPage = mediaContainer.find('#selection-categories #page-select').val(),
				showDate = mediaContainer.find('#selection-categories #date-select').val();
				
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, images_total_height: mediaLoaderImagesHeight, show_page: showPage, show_date: showDate, allow: allow},
				complete: function(data) {						
					ajaxRequestInProgress = false;
					
					// reload the conent	
					mediaContainer.empty();
					$(data.responseText).appendTo(mediaContainer);
					
					mediaLoaderProcessContent(allow);
				}
			});
		});
		
		
		mediaContainer.find('a.insert-image').click(function(event) {
			event.preventDefault();
			
			// add the image url into the 'Path' field
			mediaLoaderClickedButton.parents('.info-input').find('.path').val($(this).prop('href'));			
			
			// trigger the click event in order to display the iamge
			mediaLoaderClickedButton.siblings('a.preview-button').trigger('click');			
			
			// remove the lightbox
			mediaContainer.dialog('destroy');
			mediaContainer.remove();
		});
		
		
		mediaContainer.find('.thumb-image').hover(
			function() {
				var imagePath = sp_js_vars.enable_timthumb == true ? ($(this).attr('src')).split('src=')[1] : $(this).attr('src'),
					fullPath = sp_js_vars.enable_timthumb == true ? (sp_js_vars.timthumb + '?src=' + imagePath + '&w=150&h=100&q=95') : imagePath,
					imageContainer = $('<div class="media-loader-image"></div').appendTo(mediaContainer),
					positionTop = $(this).position().top - (imageContainer.outerHeight(true) - $(this).outerHeight(true))/2,
					positionLeft = $(this).position().left + $(this).outerWidth(true) + 10; 
				
				imageContainer.css({'opacity': 0, 'top': positionTop, 'left': positionLeft})
							  .animate({'opacity':1}, 500)
				
				$('<img/>').load(function() {
									imageContainer.css('background-image', 'url(' + fullPath + ')');
								 })
						   .attr('src', fullPath);
			},
			
			function() {
				var imageContainer = mediaContainer.find('.media-loader-image');
				imageContainer.animate({'opacity':0}, 300, function() {imageContainer.remove()});
			}
		);
		
		
		mediaContainer.find('#insert-selected').click(function(event) {
			event.preventDefault();
			
			if (ajaxRequestInProgress)
				return;
				
			ajaxRequestInProgress = true;
			
			var action = 'sliderpro_add_new_slides',
				position = parseInt($('.slider-pro .slidebox').length) + 1,
				counter = 0,
				quantity = selectedImages.length;
			
			// find the index of the new panel	
			$('.slider-pro .slidebox').each(function(index) {
				counter = Math.max(counter, parseInt($(this).find('.counter').val()));									 
			});
			
			counter++;
			
			if (isNaN(quantity) || quantity < 1) {
				ajaxRequestInProgress = false;
				return;
			}
			
			showProcessingIndicator();
			
			$.ajax({
				url: sp_js_vars.ajaxurl,
				type: 'get',
				dataType: 'html',
				data: {action: action, counter: counter, quantity: quantity},
				complete: function(data) {
					hideProcessingIndicator();
					
					var slides = $(data.responseText).appendTo($('.slideboxes'));
						
					slides.each(function(index) {
						var slide = $(this);	
						slide.find('.position').val(position + index);
						prepareSlide(slide);
						slide.hide().fadeIn();
						
						slide.find('.path').first().val(selectedImages[index]);
						
						// trigger the click event in order to display the iamge
						slide.find('.main-image-buttons a.preview-button').trigger('click');
					});
					
					selectedImages = [];
										
					ajaxRequestInProgress = false;
				}
			});
			
			// remove the lightbox
			mediaContainer.dialog('destroy');
			mediaContainer.remove();

		});
		
		
		mediaContainer.find('.disabled').click(function(event) {
			event.preventDefault();	
		});
		
		
		if (allow == 'multiple') {
			var selected,
				selectedIndex;
			
			$('#sp-media-loader tbody tr').each(function() {
				selected = $(this).find('a.button').prop('href');
				selectedIndex = $.inArray(selected, selectedImages);
				
				if(selectedIndex != -1)
					$(this).addClass('media-loader-selected-row');
			});
			
			$('#sp-media-loader tbody tr').mousedown(function() {
				selected = $(this).find('a.button').prop('href');
				selectedIndex = $.inArray(selected, selectedImages);
				
				if(selectedIndex == -1) {
					selectedImages.push(selected);
					$(this).addClass('media-loader-selected-row');
				} else {
					selectedImages.splice(selectedIndex, 1);
					$(this).removeClass('media-loader-selected-row');
				}
			});
		}
		
	}
	
	
	/*
	* Create the help tooltip that will contain some description of the property
	*/
	function addHelpTooltip(element) {
		var hoverObject;
			
		if (element.find('span').length)
			hoverObject = element.find('span');
		else
			hoverObject = element;
		
		if (element.attr('title') != '') {
			// get the name of the setting from the title attribute
			var titleValue = element.attr('title');				
			
			hoverObject.hover(				
				function() {
					
					helpTooltipTimer = setTimeout(function() {
						isHelpTooltip = true;
						
						element.attr('title', '');
						
						// create the tooltip, add some temporary text and fade it in
						var tooltip = $('<div id="help-tooltip"> loading... </div>').hide()
																					.css('z-index', 15000)
																					.appendTo($('body'));
						
						// set the initial position of the tooltip
						var top = element.offset().top - tooltip.outerHeight(true) - 10,
							left = element.offset().left + (element.outerWidth(true) - tooltip.outerWidth(true)) / 2;
							
						if (left + tooltip.outerWidth(true) > $('body').outerWidth(true))
							left = $('body').outerWidth(true) -  tooltip.outerWidth(true);
						else if (left  < $('.slider-pro').offset().left)
							left = $('.slider-pro').offset().left;					
															
						tooltip.css({'top': top, 'left': left}).fadeIn();
						
						// load the description of the settings
						$.ajax({
							url: sp_js_vars.ajaxurl,
							type: 'get',
							data: {action: 'sliderpro_get_help_text', title: titleValue},
							complete: function(data) {
								tooltip.html(data.responseText);
								
								top = element.offset().top - tooltip.outerHeight(true) - 10;
								
								if (top < 0)
									top = element.offset().top + 30;
							
								// reset the position of the tooltip
								tooltip.css('top', top);
							}
						});
					}, 300);
				},
				function() {
					clearTimeout(helpTooltipTimer);
					
					if (isHelpTooltip) {
						element.attr('title', titleValue);
						$('body').find('#help-tooltip').remove();
					}
				});
		}
	}
	
	
	function showAjaxPreloader() {
		if (!sp_js_vars.progress_animation)
			return;
			
		var preloaderOverlay = $('<div id="ajax-preloader-overlay"></div>').appendTo($('body')),
			preloaderContainer = $('<div id="preloader-container"></div>').appendTo($('body'));
			
		preloaderOverlay.css('width', $(document).width());
		preloaderOverlay.css('height', $(document).height());
		
		var topPosition = $(document).scrollTop() + ($(window).height() - preloaderContainer.outerHeight(true)) / 2,
			leftPosition = ($(document).width() - preloaderContainer.outerWidth(true)) / 2;
			
		preloaderContainer.css({top: topPosition, left: leftPosition});
	}
	
	
	function hideAjaxPreloader() {
		if (!sp_js_vars.progress_animation)
			return;
			
		$('body').find('#ajax-preloader-overlay').remove();	
		$('body').find('#preloader-container').remove();
	}
	
	
	function showProcessingIndicator() {
		$('.slider-pro #processing-indicator').attr('class', 'show');
	}
	
	
	function hideProcessingIndicator() {
		$('.slider-pro #processing-indicator').attr('class', 'hide');
	}
	
	
	/*
	* Create the color picker
	*/
	function addColorPicker(target) {
		var instance = target,
			colorInput = instance.prev(),
			color = rgb2hex(colorInput.val());
			
		instance.css('background-color', color);
		
		instance.ColorPicker({
			color: color,
	
			onShow: function (instance) {
				$(instance).fadeIn(300);
			},
			
			onHide: function (instance) {
				$(instance).fadeOut(300);
			},
			
			onChange: function (hsb, hex, rgb) {
				instance.css('background-color', '#' + hex);
				colorInput.val('#' + hex);
			}
		});
	}
	
	
	/*
	* Transforms an RGB value to a HEX value
	*/
	function rgb2hex(rgb) {
		 if (rgb.search("rgb") == -1) {
			  return rgb;
		 } else {
			  rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
			  function hex(x) {
				   return ("0" + parseInt(x).toString(16)).slice(-2);
			  }
			  return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]); 
		 }
	}
	
		
})(jQuery)
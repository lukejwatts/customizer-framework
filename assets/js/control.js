(function($) {

	jQuery( document ).ready(function() {


		/**
		 * Size Control.
		 *
		 * @since 1.0.0
		 */
		$('.customizer-framework--size-mirror').focusout( function( e ) {
			let me 			= $(this),
				id 			= me.attr('id'),
				value 		= me.val(),
				units 		= me.data('units'),
				value_unit  = customizer-framework-_get_unit( value ),
				real 		= $( '#' + id.replace( "-mirror", '', "" ) );
			let final_value = '0px';

			if( value != "" ) {

				if( units != "" ) {
					units = units.split(',');
				}else {
					units = [ 'px', 'em', 'ex', 'ch', 'rem', 'vw', 'vh', 'vmin', 'vmax', '%' ];
				}

				if( value_unit != '' ) {
					if( $.inArray( value_unit, units ) != -1 ) {
						final_value = value;
					}
				}
			}
			me.val( final_value );
			real.val( final_value );
			real.trigger('change');
		});

		function customizer-framework-_get_unit( value ) {
			let separator, splitted, unit;

			if( value != "" && customizer-framework-_has_number( value ) == true ) {
				separator = value.match(/\d+/);
				splitted  = value.split( separator );
				unit 	  = splitted.join('');
				return unit;
			}else{
				return false;
			}
		}


		/**
		 * Numeric Control.
		 *
		 * @since 1.0.0
		 */
		$('.customizer-framework--numeric').keyup( function( e ) {
			let me   		= $(this),
				id   		= me.attr('id'),
				min  		= parseFloat( me.data('min') ),
				max  		= parseFloat( me.data('max') ),
				input_real 	= $( '#' + id.replace( "-mirror", '', "" ) );

			if( /\D/g.test( this.value ) ) {
				this.value = this.value.replace( /\D/g, '' );
				customizer-framework-_numeric_validation( me, min, max, this.value );
				input_real.val( this.value );
				input_real.trigger('change');
			}else{
				if( this.value != '' ) {
					customizer-framework-_numeric_validation( me, min, max, this.value );
					input_real.val( this.value );
					input_real.trigger('change');
				}
			}
		});

		$('.customizer-framework--numeric').focusout(function(){
			let me 			= $(this),
				id  		= me.attr('id')
				min 		= me.data('min'),
				input_real 	= $( '#' + id.replace( "-mirror", '', "" ) );

			if( me.val() == '' ) {
				me.val( min );
				input_real.val( min );
				input_real.trigger('change');
			}

		});

		$('.customizer-framework--numeric-btn').click(function(){
			let me 			= $(this),
				input 		= $( '#' + me.data('target_id') + '-mirror' ),
				input_real  = $( '#' + me.data('target_id') ),
				min 		= parseFloat( input.data('min') ),
				max 		= parseFloat( input.data('max') ),
				step 		= parseFloat( input.data('step') ),
				value   	= parseFloat( input.val() ),
				role    	= me.data('role'),
				result;

			if( input.val() == '' ) {
				value = 0;
			}

			if( role == 'minus' ) {
				if( value > min ){
					result = value - step;
					input.val( result );
					input_real.val( result );
					input_real.trigger('change');
				}
			}else if( role == 'plus' ) {
				if( value < max ){
					result = value + step;
					input.val( result );
					input_real.val( result );
					input_real.trigger('change');
				}
			}
		});


		/**
		 * Tagging Control
		 *
		 * @since 1.0.0
		 */
		$(".customizer-framework--tagging-control").each(function() {

			let args = {
				maxItems: $(this).data('maxitem'),
			}

			$(this).selectize({
				plugins: ['remove_button', 'drag_drop'],
				maxItems: args.maxItems,
				delimiter: ',',
				persist: false,
				create: function(input) {
				    return {
				        value: input,
				        text: input
				    }
				},
				onChange: function() {
				   	$(this).trigger('change');
				}
			});
		});


		/**
		 * Tagging Select Control.
		 *
		 * @since 1.0.0
		 */
		$(".customizer-framework--tagging-select-control").each(function() {

			let args = {
				maxItems: $(this).data('maxitem'),
			}

			$(this).selectize({
				plugins: ['remove_button', 'drag_drop'],
				maxItems: args.maxItems,
				delimiter: ',',
				persist: false,
				create: function(input) {
				    return {
				        value: input,
				        text: input
				    }
				},
				onChange: function() {
				   	$(this).trigger('change');
				}
			});
		});


		/**
		 * Range Slider Stepper.
		 *
		 * @since 1.0.0
		 */
		$(".customizer-framework--range").each(function(){
			let id = $(this).attr('id');
			rangejs( document.getElementById( id ), {
				css: true,
				change: function( event, ui, data ) {
					$('#' + id).trigger('change');
				}
			});
		});


		/**
		 * Accordion.
		 *
		 * @since 1.0.0
		 */
		 $('.customizer-framework--accordion-head').click( function() {
		 	let me = $(this),
		 		state = me.attr('data-state'),
		 		body  = me.next('.customizer-framework--accordion-body');

		 	if( state == 'close' ) {
		 		body.slideDown();
		 		me.removeClass( 'close' );
		 		me.addClass( 'open' );
		 		me.attr( 'data-state', 'open' );
		 	}else {
		 		body.slideUp();
		 		me.removeClass( 'open' );
		 		me.addClass( 'close' );
		 		me.attr( 'data-state', 'close' );
		 	}

		 });


		/**
		 * Color Palette Material.
		 *
		 * @since 1.0.0
		 */
		 $('.customizer-framework--color-set-colors-container').click( function() {
		 	let me 				= $(this),
		 		color 			= me.data('color'),
		 		target_class 	= me.data('target_id') + '-container',
		 		target_id 		= $( '#' + me.data('target_id') ),
		 		current_color 	= target_id.val(),
		 		color_preview 	= $( '#' + me.data('target_id') + '-color-preview' ),
		 		color_label 	= $( '#' + me.data('target_id') + '-color-label' );

		 		if( current_color != color ) {
		 			$( '.' + target_class ).removeClass('selected');
		 			me.addClass('selected');
		 			color_label.text( color );
		 			color_preview.css( 'background-color', color );
		 			target_id.val( color );
		 			target_id.trigger('change');
		 		}

		 });

		 $('.customizer-framework--color-set-btn-default').click( function( e ) {

		 	e.preventDefault();

		 	let me 				= $(this),
		 		id 				= me.data('target_id'),
		 		default_value 	= me.data('default_value'),
		 		input  		    = $( '#' + id ),
		 		color_preview 	= $( '#' + id + '-color-preview' ),
		 		color_label 	= $( '#' + id + '-color-label' ),
		 		target_class    = id + '-container';

		 	if( input.val() != default_value ) {
		 		$( '.' + target_class ).removeClass('selected');
		 		color_preview.css( 'background-color', default_value );
		 		color_label.text( default_value );
		 		input.val( default_value );
		 		input.trigger('change');
		 	}

		 });


		 /**
		  * Color Picker.
		  *
		  * @since 1.0.0
		  */

		//Initialize color picker target by class
		$('.customizer-framework--color-picker').each( function( index ) {
			let me 		 		= $(this),
				element  		= '#' + me.attr('id'),
				id 				= me.data('id'),
				opacity 		= me.data('opacity'),
				default_value   = me.data('default'),
				parent 			= '#customizer-framework--color-picker-parent-' + id
				app_class 		= 'customizer-framework--color-picker-prc-app customizer-framework--color-picker-prc-app-' + id;


			let color_picker = Pickr.create({
				el: element,
				theme: 'classic',
				default: default_value,
				container: parent,
				appClass: app_class,
				inline: true,
				autoReposition: false,
				useAsButton: true,
				swatches: [
			        '#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#03a9f4',
			        '#00bcd4', '#009688', '#4caf50', '#8bc34a', '#cddc39', '#ffeb3b', '#ffc107',
			        '#ff9800', '#ff5722', '#795548', '#9e9e9e', '#607d8b', '#000000'
			    ],
			    components: {

			        // Main components
			        preview: true,
			        opacity: customizer-framework-_boolean( opacity ),
			        hue: true,

			        // Interactions Components
			        interaction:  {
			        	hex: false,
			        	rgba: false,
			        	hsla: false,
			        	hsva: false,
			        	cmyk: false,
			        	save: true,
			        	cancel: true
			        }
			    }
			}).on( 'save', ( color, instance ) =>  {

				let color_result;
				if( customizer-framework-_in_array( $(this).data('format'), ['hex', 'HEX'] ) ) {
					color_result = color.toHEXA().toString(3);
				}else if( customizer-framework-_in_array( $(this).data('format'), ['rgba', 'RGBA'] ) ) {
					color_result = color.toRGBA().toString(3);
				}

				$( '#customizer-framework--color-picker-selector-color-' + $(this).data('id') ).css( 'background', color_result );
				$( '#customizer-framework--color-picker-input-' + $(this).data('id') ).val( color_result ).trigger('change');
			});
		});

		// Open color picker
		$('.customizer-framework--color-picker-selector').click( function( e ) {
			e.preventDefault();
			let id 			 = $(this).data('id'),
			    color_picker = '.customizer-framework--color-picker-prc-app-' + id;

			$( color_picker ).toggleClass('visible');
			$( color_picker ).toggleClass('show');
		});


		/**
		 * Checkbox Multiple.
		 *
		 * @since 1.0.0
		 */
		$('.customizer-framework--checkbox-multiple').on( 'change', function() {
			customizer-framework-_get_checkbox_multiple_value( $(this).parent().parent() );
		});

		function customizer-framework-_get_checkbox_multiple_value( element ) {
			var array_value = element.find('.customizer-framework--checkbox-multiple').map( function() {
			    if( $(this).is(':checked') ) {
			      return $(this).val();
			    }
			}).toArray();
			element.find('.customizer-framework--checkbox-multiple-input').val(array_value).trigger('change');
		}


		/**
		 * Checkbox Pill.
		 *
		 * @since 1.0.0
		 */
		$('.customizer-framework--checbox-pill-list').each( function( index ) {
			$('.customizer-framework--checkbox-pill').on( 'change', function() {
			 	customizer-framework-_get_checkbox_pill_value( $(this).parent().parent().parent() );
			 });
		});


		 function customizer-framework-_get_checkbox_pill_value( element ) {
		 	var array_value = element.find('.customizer-framework--checkbox-pill').map( function() {
			    if( $(this).is(':checked') ) {
			      return $(this).val();
			    }
			}).toArray();
			element.find('.customizer-framework--checkbox-pill-input').val(array_value).trigger('change');
		 }


		/**
		 * Date Picker.
		 *
		 * @since 1.0.0
		 */
		$('.customizer-framework--date-picker-input').each( function( index ) {
			let attr_id 		= $(this).attr('id'),
			    mode			= $(this).data('mode'),
			    id 				= $(this).data('id'),
			    selected_dates  = $(this).data('value'),
			    enable_time 	= customizer-framework-_boolean( $(this).data('enable_time') );

			let config = customizer-framework-_date_picker_configurations({
				enableTime: enable_time,
				defaultDate: selected_dates
			});

			$( '#' + attr_id ).flatpickr({
				inline: true,
				mode: mode,
				altInput: true,
    			altFormat: "F j, Y",
    			dateFormat: "Y-m-d",
    			enableTime: enable_time,
    			time_24hr: true,
    			defaultDate: config.set_default_date(),
				onChange: function( selectedDates, dateStr, instance ) {
					if( mode == 'range' ) {
						if( selectedDates[0] != undefined && selectedDates[1] != undefined ) {
							$( '#customizer-framework--date-picker-input-main-' + id ).val( selectedDates ).trigger('change');
						}
					}else {
						$( '#customizer-framework--date-picker-input-main-' + id ).val( selectedDates ).trigger('change');
					}
				},
			});
		});

		// Click event when clicking input
		$('.customizer-framework--date-picker-input').click( function( e ) {

			e.stopPropagation();
			let parent  = $(this).parent().parent();
			customizer-framework-_date_picker_display_state( parent );
		});

		// Click event when clicking open button
		$('.customizer-framework--date-picker-btn-open').click( function( e ) {

			e.stopPropagation();
			e.preventDefault();
			let id 		= $(this).data('id'),
			    parent  = $(this).parent().parent();
			customizer-framework-_date_picker_display_state( parent );
		});

		$('.customizer-framework--date-picker-btn-clear').click( function( e ) {

			e.preventDefault();
			let id 			= $(this).data('id'),
				input 		= $(this).prev().prev().prev(),
				input_main 	= $( '#customizer-framework--date-picker-input-main-' + id );

			input.val('');
			input_main.val('').trigger('change');
		});

		// For adding class and removing class in main parent
		function customizer-framework-_date_picker_display_state( parent_obj ) {
			if( parent_obj.hasClass('show') === true ) {
				parent_obj.removeClass('show');
			}else {
				parent_obj.addClass('show');
			}
		}

		/**
		 * Return the configuration for datepicker
		 * @param  {[ object ]} config [the set of options]
		 * @return {[ object ]}
		 */
		function customizer-framework-_date_picker_configurations( config ) {

			let configurations = {

				/**
				 * Return the correct format with time or no time
				 * @require boolean  enableTime
				 * @return string 	the final format for alt
				 */
				set_alt_format: function() {

					let format;
					if( config.enableTime == true ) {
						format = 'F j, Y H:i';
					}else{
						format = 'F j, Y';
					}
					return format;
				},
				/**
				 * Return the default dates with single and range mode
				 * @required  string    default dates
				 * @return array    serries of default dates
				 */
			 	set_default_date: function() {
					if( ! customizer-framework-_is_empty( config.defaultDate ) ) {
						let final_date = [];
						let	dates = config.defaultDate.split(',');
						dates.forEach( function( date ) {
							let new_date = new Date( date );
							let	full_date = [ new_date.getFullYear(), new_date.getMonth() + 1, new_date.getDate() ];
							final_date.push( full_date.join('-') );
						});
						return final_date;
					}else {
						return 'today';
					}
				}
			}

			return configurations;
		}


		/**
		 * Time Picker
		 */
		$('.customizer-framework--time-picker-input').each( function( index ) {
			let attr_id 		= $(this).attr('id'),
				id 				= $(this).data('id'),
				value 			= $(this).data('value'),
				military_format = $(this).data('military_format');

				if( customizer-framework-_is_empty( military_format ) ) {
					military_format = false;
				}else{
					military_format = true;
				}

				$( '#' + attr_id ).flatpickr({
					inline: true,
	    			dateFormat: 'H:i',
	    			noCalendar: true,
	    			enableTime: true,
	    			time_24hr: military_format,
	    			defaultDate: value,
					onChange: function( timeSelected, timeStr, instance ) {
						if( ! customizer-framework-_is_empty( timeSelected ) ) {
							let time = new Date( timeSelected );
							let full_time = ('0' + time.getHours()).slice(-2) + ':' + ('0' + time.getMinutes()).slice(-2);
							$( '#customizer-framework--time-picker-input-main-' + id ).val( full_time ).trigger('change');
						}
					}
				});
		});

		// Click event when clicking input
		$('.customizer-framework--time-picker-input').click( function( e ) {

			e.stopPropagation();
			let parent  = $(this).parent().parent();
			customizer-framework-_time_picker_display_state( parent );
		});

		// Click event when clicking open button
		$('.customizer-framework--time-picker-btn-open').click( function( e ) {

			e.stopPropagation();
			e.preventDefault();
			let id 		= $(this).data('id'),
			    parent  = $(this).parent().parent();
			customizer-framework-_time_picker_display_state( parent );
		});

		$('.customizer-framework--time-picker-btn-clear').click( function( e ) {

			e.preventDefault();
			let id 			= $(this).data('id'),
				input 		= $(this).prev().prev().prev(),
				input_main 	= $( '#customizer-framework--time-picker-input-main-' + id );

			input.val('');
			input_main.val('').trigger('change');
		});


		// For adding class and removing class in main parent
		function customizer-framework-_time_picker_display_state( parent_obj ) {
			if( parent_obj.hasClass('show') === true ) {
				parent_obj.removeClass('show');
			}else {
				parent_obj.addClass('show');
			}
		}


		/**
		 * Sortable
		 */
		$('.customizer-framework--sortable-list').each( function( index ) {

			let element = document.getElementById( $(this).attr('id') ),
				handle = $(this).data('handle');

			let get_handle = ( handler ) => {
				if( handle == true ) {
					return '.customizer-framework--sortable-handle';
				}
				return '';
			}

			let sortable = Sortable.create( element, {
				animation: 150,
				easing: "cubic-bezier(1, 0, 0, 1)",
				handle: get_handle( handle ),
				chosenClass: 'customizer-framework--sortable-choosen',
				draggable: ".enable",
				onChange: function( event ) {
					let parent_element = $( '#' + event.to.id ),
						id 			   = parent_element.data('id');
						main_input 	   = $( '#customizer-framework--sortable-input-' + id );
					customizer-framework-_sortable_update_value( parent_element, main_input );
				}
			});
		});

		// Click event in state
		$('.customizer-framework--sortable-state').click( function() {
			let list 			= $(this).parent(),
				parent_element  = list.parent(),
				id 				= parent_element.data('id'),
				main_input 		= $( '#customizer-framework--sortable-input-' + id );

			if( list.hasClass('enable') == true ) {
				list.removeClass('enable').addClass('disabled');
				$(this).find('.dashicons').removeClass('dashicons-hidden').addClass('dashicons-visibility');
			}else{
				list.removeClass('disabled').addClass('enable');
				$(this).find('.dashicons').removeClass('dashicons-visibility').addClass('dashicons-hidden');
			}
			customizer-framework-_sortable_update_value( parent_element, main_input );

		});

		// Get the value of list depending on the child item and store in array
		// Also set the value of main_input and trigger changes
		function customizer-framework-_sortable_update_value( parent_element, main_input ) {
			setTimeout( function() {
				let ordered_values = parent_element.find('.enable').map( function() {
					return $(this).data('id');
				}).toArray();
				main_input.val( JSON.stringify( ordered_values ) ).trigger('change');
			}, 500 );
		}


		/**
		 * Image Checkbox
		 */
		 $('.customizer-framework--image-checkbox-input').on( 'change', function() {
		 	let id  = $(this).data('id'),
		 		parent_element = $( '#customizer-framework--image-checkbox-ul-' + id );
		 	customizer-framework-_get_image_checkbox_value( parent_element, id );
		 });

		 function customizer-framework-_get_image_checkbox_value	( element, id ) {
		 	var array_value = element.find('.customizer-framework--image-checkbox-input').map( function() {
			    if( $(this).is(':checked') ) {
			      return $(this).val();
			    }
			}).toArray();
			$( '#customizer-framework--image-checkbox-main-input-' + id ).val( JSON.stringify( array_value ) ).trigger('change');
		 }


		/**
		 * Code Editor
		 */
		$('.customizer-framework--code-editor-textarea').each( function( index ) {
			let id 			= $(this).data('id'),
				language 	= $(this).data('language'),
				textarea 	= document.getElementById( 'customizer-framework--code-editor-textarea-' + id ),
				main_input 	= $( '#customizer-framework--code-editor-input-' + id );

			// validate language and set default
			let get_mode = ( language ) => {
				if( customizer-framework-_is_empty( language ) ) {
					return 'htmlmixed';
				}else{
					if( language == 'html' ) {
						return 'htmlmixed';
					}
				}
				return language;
			};

			// initialize CodeMirror
			let editor = CodeMirror.fromTextArea( textarea, {
				lineNumbers: true,
		    	matchBrackets: true,
		    	lineWrapping: true,
			    styleActiveLine: true,
			    styleActiveSelected: true,
		   	 	mode: get_mode( language ),
			});

			// setting value of code editor
			editor.setValue( main_input.val() );

			// pass code editor value into main input and trigger change
			editor.on( 'blur', function() {
				main_input.val( editor.getValue() ).trigger('change');
			})
		});


		/**
		 * Content Editor
		 */
  		$('.customizer-framework--content-editor-textarea').each( function() {
  			// setting and validating toolbars
  			let get_toolbars = () => {
  				const toolbars = $(this).data('toolbars');
  				if( customizer-framework-_is_empty( toolbars ) ) {
  					return 'bold italic bullist numlist alignleft aligncenter alignright link unlink wp_more spellchecker underline alignjustify forecolor formatselect';
  				}else{
  					return toolbars;
  				}
  			};
  			// validating and sanitizing uploader boolean
  			let get_upload = () => {
  				const upload = $(this).data('uploader');
  				if( customizer-framework-_is_empty( upload ) || upload == false ) {
  					return false;
  				}else{
  					return true;
  				}
  			};
  			// initialize editor
  			wp.editor.initialize( $(this).attr('id'), {
				tinymce: {
					wpautop: true,
					toolbar1: get_toolbars(),
					toolbar2: ''
				},
				quicktags: true,
				mediaButtons: get_upload(),
			});
  		});
  		// trigger change on load
  		$(document).on( 'tinymce-editor-init', function( event, editor ) {
			editor.on('change', function(e) {
				tinyMCE.triggerSave();
				$( '#'+editor.id ).trigger('change');
			});
		});


		/**
		 * Attachment
		 */
		$('.customizer-framework--attachment-btn-open').on( 'click', function( e ) {
			e.preventDefault();
			let media_uploader,
				id 				= $(this).data('id'),
				type 			= $(this).data('type'),
				extensions  	= $(this).data('extensions'),
				frame 			= $( '#customizer-framework--attachment-frame-' + id  ),
				thumbnail 		= $( '#customizer-framework--attachment-thumbnail-' + id ),
				open_button 	= $( '#customizer-framework--attachment-btn-open-' + id ),
				main_input  	= $( '#customizer-framework--attachment-main-input-' + id ),
				error_message	= $( '#customizer-framework--attachment-error-' + id ),
				not_found_btn   = $( '#customizer-framework--attachment-btn-not-found-' + id ),
				current_value 	= main_input.val();

			// return the title with type
			let get_title = ( type ) => {
				return 'Select ' + type.charAt(0).toUpperCase() + type.slice(1);
			}

			// return all mimes depending on extensions
			let get_mimes = ( extensions, type ) => {
				let mime;
				if( extensions.length > 0 ) {
					mime = extensions;
				}else{
					switch( type ) {
						case 'image':
							mime = [ 'image/jpeg', 'image/png', 'image/gif', 'image/x-icon' ];
							break;
						case 'video':
							mime = [ 'video/mp4', 'video/x-m4v', 'video/quicktime', 'video/x-ms-wmv', 'video/avi',
									  'video/mpeg', 'video/ogg', 'video/3gpp', 'video/3gpp2', 'video/mpeg', 'video/webm', 'video/x-matroska' ];
							break;
						case 'audio':
							mime = [ 'audio/mpeg3', 'audio/m4a', 'audio/ogg', 'audio/wav', 'audio/mpeg',  ];
							break;
						case 'application':
							mime = [ 'application/pdf', 'application/msword', 'application/mspowerpoint', 'application/powerpoint',
									 'application/vnd.ms-powerpoint', 'application/x-mspowerpoint', 'application/octet-stream',
									 'application/excel', 'application/vnd.ms-excel', 'application/x-excel', 'application/x-msexcel',
									 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text',
									 'application/mspowerpoint', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
									 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
									 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ];
							break;
					}
 				}
				return mime;
			}
			let mimes = get_mimes( extensions, type );

			// check media_uploader if initialize then open
		 	if( media_uploader ) {
		 		media_uploader.open();
		 		return;
		 	}

		 	// initialize media uploader
		 	media_uploader = wp.media.frames.file_frame = wp.media({
		 		title: get_title( type ),
		 		button: {
		 			text: 'Select'
		 		},
		 		library: {
		 			type: mimes,
		 		},
		 		multiple: false
		 	}).on( 'open', function() {
		 		// setting media uploader default selected
		 		if( current_value !== '' ) {
		 			let selection = media_uploader.state().get('selection'),
		 				attachment = wp.media.attachment( current_value );
		 			attachment.fetch();
      				selection.add( attachment ? [attachment] : [] );
		 		}

		 	}).on( 'select', function( e ) {
		 		// get selected attachment
		 		let attachment = media_uploader.state().get('selection').first().toJSON();
		 		if( customizer-framework-_is_empty( attachment ) == false && attachment.id !== current_value ) {

		 			if( attachment.type == type ) {
		 				if( mimes.indexOf( attachment.mime ) !== -1 ) {
		 					if( type == 'image' ) {
				 				thumbnail.find('img').attr( 'src', attachment.url );
				 			}else{
				 				console.log( attachment );
				 				thumbnail.find('img').attr( 'src', attachment.icon );
				 				thumbnail.find('p').text( attachment.filename ).attr( 'title', attachment.filename );
				 			}

				 			frame.show();
				 			open_button.hide();
				 			thumbnail.show();
				 			not_found_btn.hide();
				 			main_input.val( attachment.id ).trigger('change');
		 				}else{
		 					customizer-framework-_alert_error({
					 			element: error_message,
					 			message: `${ attachment.mime } extension is not allowed.`
					 		});
		 				}
			 		}else{
			 			customizer-framework-_alert_error({
			 				element: error_message,
			 				message: `Format ${ attachment.type } is not allowed. Please select ${ type } format only`
			 			});
			 		}
		 		}
		 	});

		 	// re-open the media uploader
		 	media_uploader.open();
		});

		// removing all attachment
		$('.customizer-framework--attachment-btn-remove').on( 'click', function ( e ) {
			e.preventDefault();
			let id 				= $(this).data('id'),
				frame 			= $( '#customizer-framework--attachment-frame-' + id  ),
				open_button 	= $( '#customizer-framework--attachment-btn-open-' + id ),
				main_input  	= $( '#customizer-framework--attachment-main-input-' + id );
			frame.hide();
			open_button.show();
			main_input.val('').trigger('change');
		});





  		/**
  		 * ------------------------
  		 * 		FUNCTIONS
  		 * ------------------------
  		 */

		 // getting attachment list data in array
		 function customizer-framework-_get_attachment_list_data( parent_element ) {
		 	let id = parent_element.data('id'),
		 		main_input = $( '#customizer-framework--image-uploader-multiple-input-' + id );

		 	setTimeout( function() {
				let list_data = parent_element.find('li').map( function() {
					return $(this).data('attachment_id');
				}).toArray();
				console.log( list_data );
				main_input.val( JSON.stringify( list_data ) ).trigger('change');
			}, 500 );
		 }

		// Numeric validation
		function customizer-framework-_numeric_validation( input, min, max, value ) {
			if( value < min ) {
				input.val( min );
			}else if( value > max ) {
				input.val( max );
			}
		}

		// Checks if the string has a number
		function customizer-framework-_has_number( value ) {
			return /\d/.test( value );
		}

		// Checks if value exists in array
		function customizer-framework-_in_array( $needle, $hystack ) {
			if( $hystack.indexOf( $needle ) == -1 ) {
				return false;
			}
			return true;
		}

		// Convert number to boolean 1 | 0
		function customizer-framework-_boolean( $number ) {

			let output;

			if( $number == 1 ) {
				output = true;
			}else{
				output = false;
			}
			return output;
		}

		// checks if the variable is empty
		function customizer-framework-_is_empty( data ) {
			return ( !data || data.length === 0 );
		}

		// displaying error message
		function customizer-framework-_alert_error( obj ) {
			obj.element.find('p').text( obj.message );
			obj.element.show().delay(5000).fadeOut();
		}
	});

}(jQuery));

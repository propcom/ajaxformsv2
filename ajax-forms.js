
/*
	ajaxform: Anthony Armstrong
		version: 2.0.0
		last modified: 2013-01-04
*/

(function($) {

	// static controller, I guess...
	$.fn.ajaxform = function(method) {

		// create new instance
		var ajax_form = new Form();

		// has a method been passed in?
		if (ajax_form[method]) {

			// call the given method with any arguments that may have been passed in
			return ajax_form[method].apply(this, Array.prototype.slice.call(arguments, 1));

		// if an object has been passed in or no method...
		} else if (typeof method === 'object' || !method) {

			// call the init method
			return ajax_form.init.apply(this, arguments);

		} else {

			// throw an exception
			$.error('Method ' + method + ' does not exist on jQuery.ajaxform');
		}

	};

	// form controller (static)
	var FormController = function() {
		this.response   = null;
		this.srv_field = null;
		this.val_res   = {};
	}

	FormController.prototype = {

		check_text : function(field) {

			if (field.attr('id').indexOf('email') != -1 && this.response === true) {
				this.val_res[field.attr('id')] = "E-mail supplied is invalid";
			} else {
				if (field.val() == "") {
					this.val_res[field.attr('id')] = "Please enter a value";
				} else {
					if (field.val().length < 2) {
						this.val_res[field.attr('id')] = "Minimum of three characters required";
					} 
				}
			}

		},

		check_select : function(field) {

			if(field.children(':selected').val() == "Day" || field.children(':selected').val() == "Month" || field.children(':selected').val() == "Year" || field.children(':selected').val() == "Hour" || field.children(':selected').val() == "Minute" || field.children(':selected').val().length() <= 0){   
				this.val_res[field.attr('id')] = "Please select an option";
			}

		},

		// pass in form handle
		validate : function(form_instance, fields, callback) {

			// clear any exisiting validation results
			this.val_res = {};

			for (var i in fields) {

				// Check type
				var field = form_instance.handle.parent().find(fields[i]);
				var field_type = field[0].type;

				// All the same for now, we might need to add to this later...
				switch(field_type) {

					case 'text' :
						this.check_text(field);
					break;

					case 'select-one' :
						this.check_select(field);
					break;

					case 'textarea' :
						this.check_text(field);
					break;

				}

			}

			// Get count of errors and add to JSON
			var error_count = 0;
			for (var i in this.val_res) {
				error_count++;
			}

			this.val_res['error_count'] = error_count;
			
			// callback if there are no errors
			if (this.val_res.error_count == 0) {
				callback();
			} else {

				// do some voodoo to show errors
				this.error_handler(form_instance);
			}

		},

		error_handler : function(form_instance) {

			console.log(this.val_res);

			switch(form_instance.settings.error_location) {

				case 'input' :

					// for each input
					for (var input_name in this.val_res) {

						// if input_name is the error_count
						if (input_name == 'error_count') {
							continue;
						}

						// get handle on input
						var input = form_instance.handle.find('#' + input_name);

						input.addClass('error');

					}

				break;

				case 'label' :

					// for each label
					for (var label_name in this.val_res) {

						// if input_name is the error_count
						if (label_name == 'error_count') {
							continue;
						}

						// input
						var input = form_instance.handle.find('#' + label_name);

						// get handle on label
						var label = form_instance.handle.find('label[for="' + label_name + '"]');

 						// only show once once for a select group
						if (input.data('group')) {
							label_name = input.data('group');
							label = form_instance.handle.find('label[for="' + label_name + '"]');
							label.addClass('error');
							continue;
 						} 
	 					
 						label.addClass('error');

					}

				break;

				case 'tooltip' :

					// for each label
					for (var input_name in this.val_res) {

						// if input_name is the error_count
						if (input_name == 'error_count') {
							continue;
						}

						// store input for value
						var input_value = input_name;

						// get handle on this input
						var input = form_instance.handle.find('#' + input_name);

						// only show once once for a select group
						if (input.data('group')) {
							input_name = input.data('group');	
 						} 

 						// if this label already exists....
						if ($('#lbl-' + input_name + '-error').size() > 0) {
							continue;
						}

						// create 'caption' div
						var tooltip_label = $('<label></label>');
						tooltip_label.addClass('error-tooltip');

						// set id if position needs to be overridden
						tooltip_label.attr('id', 'lbl-' + input_name + '-error');

						// add error class for custom styling
						tooltip_label.addClass('tooltip-error');

						// add content
						tooltip_label.html(this.val_res[input_value]);

						// add to DOM
						tooltip_label.insertAfter(input);
							
						
					}

				break;

			}

			if (form_instance.settings.show_alert === true) {
				alert('You have not filled in all required fields correctly, please check the form and try again.');
			}

		},

		send_request : function(form_instance) {

			console.log(this);

			var instance = this;

			// define srv_field
			instance.srv_field = [];

			var serialized = form_instance.handle.serialize();
			serialized += '&submitted=Send';

			$.ajax({
				url: window.location.href,
				dataType: 'html',
				data: serialized,
				type: 'POST',
			  	success: function(data) {

			  		var form_handle = $('#' + form_instance.handle.attr('id'));

			  		// set reponse global
			  		instance.response = true;

			  		var welcomeText = form_handle.parent().find('p.welcomeText');
			  		var success_text = $(data).find('p.successText');
			  		var error_text = $(data).find('p.errorText');
			  		var form_class = form_handle.parent().attr('class');

			  		// all good server side
			  		if (success_text.size() > 0) {

			  			// hide the form show returned form
			  			form_handle.fadeTo(300, 0, function() {

			  				// show the success text
			  				form_handle.parents('div.' + form_class).html(success_text.fadeTo(300, 1));
			  				form_handle.remove();

			  				if (form_instance.settings.form_success != null) {
			  					form_instance.settings.form_success.call(undefined);
			  				}
			  				
			  			});

			  		} 

			  		// error on server side
			  		if (error_text.size() > 0) {

			  			// hide the form show returned form
			  			form_handle.fadeTo(300, 0, function() {

			  				// unbind submit from old form
			  				form_handle.unbind('submit');

			  				// get handle on new returned html
			  				var error_form = $(data).find('#' + form_instance.handle.attr('id'));

			  				// show the returned form
							form_handle.parents('div.' + form_class).html(error_form.parent().fadeTo(300, 1));
							form_handle.remove();

							// update the form handle property
							form_instance.handle = error_form;

							// find all fields with errors
							var bad_fields = error_form.find('div.error input');

							// build list of errornous fields
							bad_fields.each(function() {

								instance.srv_field.push($(this));

							});

							// validate (again)
							instance.validate(form_instance, instance.srv_field);

							// bind events
							form_instance.handle.bind('submit.ajaxforms', function(e) {
								e.preventDefault();
								instance.register_events(form_instance);
							});

							// call fail callback
							if (form_instance.settings.form_failure != null) {
			  					form_instance.settings.form_failure.call(undefined);
			  				}

			  			});

			  		}

			  	}
			});

		},

		register_events : function(form_instance) {

			var instance = this;

			// reset response
			instance.response = false;

			// clear validation results
			instance.val_res = {};

			// validate
			instance.validate(form_instance, form_instance.required, function() { // validate success callback...

				// disable submit button
				form_instance.handle.find('submit').attr('disabled', 'disabled');

				// start ajax request
				instance.send_request(form_instance);

			});

		}

	}

	// form constructor
	var Form = function() {
		this.settings  = null;
		this.required  = null;
		this.handle    = null;
	}

	Form.prototype = {

		init : function(options) {

			var instance = this;

			// define required
			instance.required = [];
			
			// create some defaults, extending them with any options that were provided
		    instance.settings = $.extend({
		    	error_location   : 'input',
		    	show_alert       : false,
		    	form_success     : function() {},
		    	form_failure     : function() {}
		    }, options);

		    // get handle on form
		    instance.handle = $(this[0]);

		    // set mandatory styles on form wrapper
		    instance.handle.parent().css({
		    	'position' : 'relative'
		    });

		    // build up json of required fields and their id's
			instance.handle.find('*[data-required="1"]').each(function() {

				instance.required.push('#' + $(this).attr('id')); 

				// input keyup handler
				$(this).bind('keyup.ajaxforms, change.ajaxforms', function(e) {

					// get field type
					var field_type = e.target.nodeName;

					if ((field_type == 'INPUT' || field_type == 'TEXTAREA') && $(this).val().length > 2 || field_type =='SELECT' && $(this).val() != "") {

						// get the id
						var input_id = $(this).attr('id');
						
						// depending on error location...
						switch(instance.settings.error_location) {

							case 'input' :

								// remove error class
								$(this).removeClass('error');

							break;

							case 'label' :

								// get handle on label
								var label = $(this).parents('div.field-wrap').find('label.error');

								// remove error class from label
								label.removeClass('error');

							break;

							case 'tooltip' :

								//var error_location_id = 'lbl-' + input_id + '-error';

								// is there an error element?
								var error_element = $(this).parents('div.field-wrap').find('label.error-tooltip');
								if (error_element.size() > 0) {

									// remove it
									error_element.remove();
								}

							break;
						}

					}

				});

			});
			
			// bind events
			instance.handle.bind('submit.ajaxforms', function(e) {
				e.preventDefault();
				FormController.prototype.register_events(instance);
			});

		}

	}

})(jQuery);
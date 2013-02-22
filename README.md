ajaxforms (v2.0.3)
================

jQuery Plugin designed to encapsulate the Propeller form code in an AJAX request.

**NOTE:** The PHP form is slightly different, see index.php for an example

What this plugin does
---------------------

- Posts Propeller form code as an AJAX request
- Provides some basic client side validation
- Provides callbacks

Features
--------

- Easy implementation
- Works with globe select styles
- It works...


Usage
-----

- You can initialize ajaxforms with default settings like so;

<pre>
  $('form#test').ajaxform();
</pre>

- Or you can set some options and callbacks like so (these are defaults);

<pre>
  $('form#test').ajaxform({
    'error_location' : 'input',
  	'show_alert'     : false,
    form_success     : function() {},
    form_failure     : function() {}
  });
</pre>

Options
-----------------------

  - **error_location** : *string* | where the class of 'error' is to be added, 'input', 'label' or 'tooltip' 
  - **show_alert**     : *bool* | show errors as an alert as well as the error location
 
Callbacks
-----------------------
 
  - **form_success** : fires when the server response contains the 'successText'
  - **form_failure** : fires when the server response contains the 'errorText' 
  
  - **Note:** You must not remove the paragraph elements with the classes 'successText' or 'errorText' from the form markup, the plugin uses these for validation and will fail if you do. You *can* empty them of content if required.

Demo
-----------------------

http://ajaxforms.anthony.local/

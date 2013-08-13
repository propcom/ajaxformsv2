AjaxForms (v2.0.9)
================

jQuery Plugin designed to encapsulate the Propeller form code in an AJAX request.

What this plugin does
---------------------

- Posts Propeller form code as an AJAX request
- Provides some basic client side validation
- Provides callbacks

Features
--------

- Easy implementation
- Works with **'Globe Select'** styles
- Works with my **Placeholder Plugin** (https://github.com/propcom/placeholder)


Usage
-----

See;-

https://github.com/propcom/ajaxformsv2/blob/master/index.php for the PHP form code
https://github.com/propcom/ajaxformsv2/blob/master/ajax-forms.js for the source
https://github.com/propcom/ajaxformsv2/blob/master/script.js for the JS implementation

**NOTE:** The PHP code for the form is *different*, you must **not** remove the classes and attributes that have been inserted into the markup as the plugin uses them as JavaScript hooks. This includes the welcomeText, errorText and successText. Failure to comply with these requirements will result in death. 

- You can initialize ajaxforms with default settings like so;

<pre>
  $('form#test').ajaxform();
</pre>

- Or you can set some options and callbacks like so (these are defaults);

<pre>
  $('form#test').ajaxform({
    'error_location'   : 'input',
  	'show_alert'       : false,
  	'single_page_site' : false,
    form_success       : function() {},
    form_failure       : function() {}
  });
</pre>

Options
-----------------------

  - **error_location**   : *string* | where the class of 'error' is to be added, 'input', 'label' or 'tooltip' 
  - **show_alert**       : *bool* | show errors as an alert as well as the error location
  - **single_page_site** : *bool* | set to true if building a single paged site (e.g. http://www.whitehartdrurylane.co.uk/)
 
Callbacks
-----------------------
 
  - **form_success** : fires when the server response contains the 'successText'
  - **form_failure** : fires when the server response contains the 'errorText' 

Demo
-----------------------

http://ajaxforms.anthony.local/

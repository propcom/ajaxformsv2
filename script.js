/* Author:
	Anthony Armstrong
*/


$(document).ready(function() {

	// ajax forms
	$('#frm-test').ajaxform({
    	error_location   : 'input', // input, label or tooltip
    	show_alert       : false,
        callback         : function() {
            alert("This is a callback for when the form submits successfully!");
        }
    });

    $('#frm-test2').ajaxform({
    	'error_location' : 'label', // input, label or tooltip
    	'show_alert'     : true
    });

    $('#frm-test3').ajaxform({
    	'error_location' : 'tooltip', // input, label or tooltip
    	'show_alert'     : false
    });


});

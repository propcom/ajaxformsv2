/* Author:
    Anthony Armstrong
*/

$(document).ready(function() {

    // ajax forms
    $('#frm-test').ajaxform({
        error_location   : 'input', // input, label or tooltip
        show_alert       : false,
        single_page_site : false,
        form_success     : function() {
            alert("This is a callback for when the form passes server validation successfully!");
        },
        form_failure     : function() {
            alert("This is a callback for when the form fails server validation!");
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

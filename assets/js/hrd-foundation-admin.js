$(document).ready(function() {
    'use strict';
	
    /**
     * Dropdown
     */
    // $('div.dropdown-menu').on('focusin', function() {
        // $(this).transition({
            // height: 'auto',
            // duration: 150,
            // width: 'auto'
        // });
    // });

    // $('div.dropdown-menu').on('focusout', function() {
        // $(this).transition({
            // height: 0,
            // duration: 250,
            // width: 0
        // });
    // });
    
    /**
     * Bootstrap select
     */
    // $('#companySelector').selectpicker({
        // size:10,
    // });

    /**
     * Input Group
     */
    $('.input-group .form-control').on('focus', function() {
        $(this).closest('.input-group').find('.input-group-addon').addClass('active');
    }).on('blur', function() {
        $(this).closest('.input-group').find('.input-group-addon').removeClass('active');
    });
	
$(document).ajaxStart(function() { Pace.restart(); });
    
});

$(document).ready(function() {
    'use strict';

    $('.input-group .form-control').on('focus', function() {
        $(this).closest('.input-group').find('.input-group-addon').addClass('active');
    }).on('blur', function() {
        $(this).closest('.input-group').find('.input-group-addon').removeClass('active');
    });
	
$(document).ajaxStart(function() { Pace.restart(); });
   $(document).on("keyup",function(){
	$("a[target=_blank]").each(function(){
		if($(this).html() == "Unlicensed Froala Editor"){
			$(this).parent().remove();
		}
	});   
   }); 
});

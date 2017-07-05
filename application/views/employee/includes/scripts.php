<script type="text/javascript" src="/assets/libraries/jquery-transit/jquery.transit.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap/assets/javascripts/bootstrap/transition.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap/assets/javascripts/bootstrap/dropdown.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap/assets/javascripts/bootstrap/collapse.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="/assets/libraries/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/libraries/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="/assets/libraries/autosize/jquery.autosize.js"></script>
<script type="text/javascript" src="/assets/libraries/isotope/dist/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="/assets/libraries/OwlCarousel/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="/assets/libraries/jquery.scrollTo/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="/assets/libraries/nvd3/lib/d3.v3.js"></script>
<script type="text/javascript" src="/assets/libraries/nvd3/nv.d3.min.js"></script>
<script type="text/javascript" src="/assets/libraries/nvd3/examples/stream_layers.js"></script>
<script type="text/javascript" src="/assets/libraries/jquery-confirm/jquery-confirm.min.js"></script>
<script type="text/javascript" src="/assets/libraries/pace/pace.min.js"></script>
<script type="text/javascript" src="/assets/js/hrd-foundation-admin.js"></script>
<script type="text/javascript" src="/assets/js/notify.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.form.min.js"></script>
<script type="text/javascript" src="/assets/js/employee/employee.js"></script>
<script>
jQuery(document).bind("contextmenu cut copy selectstart",function(e){
    e.preventDefault(); return false;
});

$("#glossaryTable").DataTable();
</script>

<!-- Update User Profile -->
<script>
$("#editProfile").on("click",function(){
	$("#updatePasswordBox").hide();
	$("#editProfileBox").show();
});
$("#updatePassword").on("click",function(){
	$("#editProfileBox").hide();
	$("#updatePasswordBox").show();
});
$(".closeUpdatePasswordBox").click(function(){
	$("#updatePasswordBox").hide();
});
$(".closeEditProfileBox").click(function(){
	$("#editProfileBox").hide();
});
$("#updatePasswordForm").ajaxForm({
	success: function(response){
		response = JSON.parse(response);
		if(response.status){
			$.alert({
				icon : "fa fa-check",
				title: "Success!",
				content: response.message,
				type: "blue",
				buttons:{
					ok: {
						text: 'OK',
						btnClass: 'btn-secondary',
						keys: ['enter'],
						action: function(){
							window.location.reload();
						}
					}
				}
			});
		}else{
			$.alert({
				icon : "fa fa-exclamation-triangle",
				title: "Sorry!",
				content: response.message,
				type: "blue",
				buttons:{
					ok: {
						text: 'OK',
						btnClass: 'btn-secondary',
						keys: ['enter'],
						action: function(){}
					}
				}
			});
		}
	}
});
$("#updateProfileForm").ajaxForm({
	success: function(response){
		response = JSON.parse(response);
		if(response.status){
			$.alert({
				icon : "fa fa-check",
				title: "Success!",
				content: response.message,
				type: "blue",
				buttons:{
					ok: {
						text: 'OK',
						btnClass: 'btn-secondary',
						keys: ['enter'],
						action: function(){
							window.location.reload();
						}
					}
				}
			});
		}else{
			$.alert({
				icon : "fa fa-exclamation-triangle",
				title: "Sorry!",
				content: response.message,
				type: "red",
				buttons:{
					ok: {
						text: 'OK',
						btnClass: 'btn-secondary',
						keys: ['enter'],
						action: function(){}
					}
				}
			});
		}
	}
});
</script>

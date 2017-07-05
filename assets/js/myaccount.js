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
	async: true,
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
	async: true,
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
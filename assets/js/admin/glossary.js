$("#glossaryTable").DataTable();
$("#addNewGlossary").click(function(){
	$("#add_new_glossary").modal("show");
});

var deleteGlossary = function(glossaryID){
	var request = "&action=delete&glossaryID="+glossaryID;
	$.ajax({
		url: "/admin/ajax/glossaryAction",
		data: request,
		type: "POST",
		async: true,
		processData: false,
		dataType: 'json',
		success: function(response){
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
};

$(".deleteGlossary").on("click",function(){
	var glossaryID = $(this).data("id");
	$.confirm({
		icon: "fa fa-question-circle",
		title: 'Confirmation!',
		content: 'Are you sure want to delete',
		type: "blue",
		buttons: {
			ok: {
				text: 'Proceed',
				btnClass: 'btn-secondary',
				action: function () {
					deleteGlossary(glossaryID);
				}
			},
			cancel: {
				text: 'Cancel',
				btnClass: 'btn',
				action: function () {
					//close
				},
				
			}
		},
	});
	
});

$("#newGlossaryForm").ajaxForm({
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
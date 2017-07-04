$("#importantQuestionTable").DataTable();
$("#addNewQuestion").click(function(){
	$("#add_new_question").modal("show");
});

var deleteQuestion = function(questionID){
	var request = "&action=delete&questionID="+questionID;
	$.ajax({
		url: "/admin/ajax/impQuesAction",
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

$(".deleteQuestion").on("click",function(){
	var questionID = $(this).data("id");
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
					deleteQuestion(questionID);
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

$("#newQuestionForm").ajaxForm({
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
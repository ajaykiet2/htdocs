
$(document).ready(function(){

$.chepter = function(){
	$self = this;
	this.actionMode = '';
	
	this.add = function(){
		var request = $("#addChepterForm").serialize();
		request += "&action="+$self.actionMode;
		$.ajax({
			url: "/admin/ajax/chepterAction",
			data: request,
			type: "POST",
			async: true,
			processData: false,
			dataType: 'json',
			success: function(response){
				if(response.status){
					$.alert({
						icon : "fa fa-check",
						title: "Success",
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
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){}
							}
						}
					});
				}
			}
		});
	};
	
	this.update = function(chepterID){
		var request = "&action="+$self.actionMode+"&chepterID="+chepterID;
		
		$.ajax({
			url: "/admin/ajax/chepterAction",
			data: request,
			type: "POST",
			async: true,
			processData: false,
			dataType: 'json',
			success: function(response){
				if(response.status){
					var chepter = response.chepter;
					$("#addChepterForm input[name=chepterID]").val(chepter.chepterID);
					$("#addChepterForm input[name=courseID]").val(chepter.courseID);
					$("#addChepterForm input[name=title]").val(chepter.title);
					$("#addChepterForm textarea[name=description]").val(chepter.description);
					$('#add_new_chepter .modal-title').html('Update Chapter');
					$('#add_new_chepter').modal('show');
						
					$self.actionMode = "update";
				}else{
					$.alert({
						icon : "fa fa-exclamation-triangle",
						title: "Sorry!",
						content: response.message,
						type: "red",
						buttons:{
							ok: {
								text: 'OK',
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){}
							}
						}
					});
				}
			}
		});
	};
	
	this.delete = function(chepterID){
		var request = "&action="+$self.actionMode+"&chepterID="+chepterID;
		
		$.ajax({
			url: "/admin/ajax/chepterAction",
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
								btnClass: 'btn',
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
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){}
							}
						}
					});
				}
			}
		});
	};
	this.deleteSlide = function(slideID){
		$self.actionMode = 'deleteSlide';
		var request = "&action="+$self.actionMode+"&slideID="+slideID;
		$.ajax({
			url: "/admin/ajax/chepterAction",
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
								btnClass: 'btn',
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
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){}
							}
						}
					});
				}
			}
		});
	};
	
	this.loadQuestion = function(questionID, action){
		var request = "&action=loadQuestion&chepterquestionID="+questionID;
		$.ajax({
			url: "/admin/ajax/chepterAction",
			data: request,
			type: "POST",
			async: true,
			processData: false,
			dataType: 'json',
			success: function(response){
				if(response.status){
					var question = response.question;
					if(action === 'updateQuestion'){
						//Filling the update form.
						$("#updateQuestionForm input[name=chepterquestionID]").val(question.chepterquestionID);
						$("#updateQuestionForm textarea[name=question]").val(question.question);
						
						$("#updateQuestionForm input.option_1").val(question.option_1);
						$("#updateQuestionForm input[name=option_1]").val(question.option_1);
						
						$("#updateQuestionForm input.option_2").val(question.option_2);
						$("#updateQuestionForm input[name=option_2]").val(question.option_2);
						
						$("#updateQuestionForm input.option_3").val(question.option_3);
						$("#updateQuestionForm input[name=option_3]").val(question.option_3);
						
						$("#updateQuestionForm input.option_4").val(question.option_4);
						$("#updateQuestionForm input[name=option_4]").val(question.option_4);
						
						$("#updateQuestionForm textarea[name=explanation]").val(question.explanation);
						
						$("#updateQuestionForm input[name=answer]").each(function(){
							if($(this).val() === question.answer){
								$(this).prop('checked',true);
							}
						});
						$self.actionMode = 'updateQuestion';
						$("#update_Question").modal("show");
					}else{
						$("#view_Question .question span").html(question.question);
						$("#view_Question .option_1 span").html(question.option_1);
						$("#view_Question .option_2 span").html(question.option_2);
						$("#view_Question .option_3 span").html(question.option_3);
						$("#view_Question .option_4 span").html(question.option_4);
						$("#view_Question .explanation span").html(question.explanation);
						
						$("#view_Question .options").each(function(){
							if($(this).find('span').html() === question.answer){
								$(this).find('i').removeClass("fa-times");
								$(this).find('i').addClass("fa-check");
							}else{
								$(this).find('i').removeClass("fa-check");
								$(this).find('i').addClass("fa-times");
							}
						});
						$("#view_Question").modal("show");
					}
				}
				
			}
		});
		
	};
	
	this.deleteQuestion = function(questionID){
		$self.actionMode = 'deleteQuestion';
		var request = "&action="+$self.actionMode+"&chepterquestionID="+questionID;
		$.ajax({
			url: "/admin/ajax/chepterAction",
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
								btnClass: 'btn',
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
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){}
							}
						}
					});
				}
			}
		});
	};
	
	this.updateQuestion = function(){
		$("#updateQuestionForm input[name=answer]").each(function(){
			if($(this).prop('checked')){
				var selector = $(this).attr('class');
				var updatedValue = $("#updateQuestionForm input[name="+selector+"]").val();
				$(this).val(updatedValue);
			}
		});
		$self.actionMode = 'updateQuestion';
		var request = $("#updateQuestionForm").serialize();
		request += "&action="+$self.actionMode;
		$.ajax({
			url: "/admin/ajax/chepterAction",
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
								btnClass: 'btn',
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
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){}
							}
						}
					});
				}
			}
		});
	};
	this.init = function(){
		$("#questionTable .editQuestion").click(function(){
			var questionID = $(this).data("id");
			$self.loadQuestion(questionID, 'updateQuestion');
		});
		
		$("#questionTable .viewQuestion").click(function(){
			var questionID = $(this).data("id");
			$self.loadQuestion(questionID, 'viewQuestion');
		});
		
		$(".deleteQuestion").click(function(){
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
							$self.deleteQuestion(questionID);
						}
					},
					cancel: {
						text: 'Cancel',
						btnClass: 'btn',
						action: function () {},
					}
				},
			});
		});
		
		$("#updateQuestionBtn").click(function(){
			$self.updateQuestion();
		});
		
		$("#createChepter").click(function(){
			$self.actionMode = 'add';
			$('#add_new_chepter').modal('show');
		});
		
		$(".editChepter").click(function(){
			$self.actionMode = 'get';
			var chepterID = $(this).data("id");
  			$self.update(chepterID);
		});
		
		$(".deleteChepter").click(function(){
			$self.actionMode = 'delete';
			var chepterID = $(this).data("id");
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
							$self.delete(chepterID);
						}
					},
					cancel: {
						text: 'Cancel',
						btnClass: 'btn',
						action: function () {},
					}
				},
			});
		});
		$("#uploadQuestion").click(function(){
			$("#upload_questions").modal("show");
		});
		
		$('#question-upload-file').fileinput({
			uploadUrl: "/admin/upload/chepterQuestion",
			uploadAsync: true,
			uploadExtraData: function() {
				return {
					courseID: $("#questionUploadform input[name=courseID]").val(),
					chepterID: $("#questionUploadform input[name=chepterID]").val(),
					action: $("#questionUploadform input[name=action]").val(),
				};
			},
			allowedFileExtensions: ["csv","xlsx", "xls"],
		}).on('fileuploaded',function(event, data, previewId, index){
				if(data.response.uploaded){
					$.alert({
						icon : "fa fa-check",
						title: "Success!",
						content: data.response.message,
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
				}
		}).on('fileuploaderror', function(event, data, msg) {
			$.alert({
				icon : "fa fa-exclamation-triangle",
				title: "Invalid File!",
				content: "Please select .CSV, .XLS, .XSLX file only.",
				type: "red",
				buttons:{
					ok: {
						text: 'OK',
						btnClass: 'btn',
						keys: ['enter'],
						action: function(){
							$('#question-upload-file').fileinput('clear');
						}
					}
				}
			});
		});
		
		$("#addChepterBtn").click(function(){
			$self.add();
		});
		
		$("#slideTable .deleteSlideBtn").click(function(){
			var slideID = $(this).data("id");
			$.confirm({
				icon: "fa fa-question-circle",
				title: 'Confirmation!',
				content: 'Are you sure want to delete slide',
				type: "blue",
				buttons: {
					ok: {
						text: 'Proceed',
						btnClass: 'btn-secondary',
						action: function () {
							$self.deleteSlide(slideID);
						}
					},
					cancel: {
						text: 'Cancel',
						btnClass: 'btn',
						action: function () {},
					}
				},
			});
		});
	};
};
new $.chepter().init();
});
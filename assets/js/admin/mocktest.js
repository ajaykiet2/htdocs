$(document).ready(function(){
	
	$.mocktest = function(){
		$self = this;
		this.actionMode = '';
		this.url = '/admin/ajax/mocktestAction';
		
		this.add = function(request){
			request += "&action="+$self.actionMode;
			
			$.ajax({
				url: $self.url,
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
				},				
			});
		};
		
		
		
		this.delete = function(name){
			var request = "&action="+$self.actionMode+"&name="+name;
			$.ajax({
				url: $self.url,
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
				},				
			});
		};
		
		this.loadQuestion = function(questionID, action){
			var request = "&action=loadQuestion&id="+questionID;
			$.ajax({
				url: $self.url,
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
							$("#updateQuestionForm input[name=id]").val(question.id);
							$("#updateQuestionForm textarea[name=question]").val(question.question);
							
							$("#updateQuestionForm input.option_1").val(question.option_1);
							$("#updateQuestionForm input[name=option_1]").val(question.option_1);
							
							$("#updateQuestionForm input.option_2").val(question.option_2);
							$("#updateQuestionForm input[name=option_2]").val(question.option_2);
							
							$("#updateQuestionForm input.option_3").val(question.option_3);
							$("#updateQuestionForm input[name=option_3]").val(question.option_3);
							
							$("#updateQuestionForm input.option_4").val(question.option_4);
							$("#updateQuestionForm input[name=option_4]").val(question.option_4);
													
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
				url: $self.url,
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
			$("#updateQuestionBtn").click(function(){
				$self.updateQuestion();
			});
			
			$(".deleteMocktest").click(function(){
				var name = $(this).data("name");
				$.confirm({
					icon: "fa fa-question-circle",
					title: 'Confirmation!',
					content: 'Are you sure want to delete',
					type: "red",
					buttons: {
						ok: {
							text: 'Proceed',
							btnClass: 'btn-secondary',
							action: function () {
								$self.actionMode = 'delete';
								$self.delete(name);
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
			
			
			$("#addNewMocktest").click(function(){
				$("#upload_questions").modal("show");
			});
			
			$('#question-upload-file').fileinput({
				uploadUrl: "/admin/upload/mocktestQuestion",
				uploadAsync: true,
				uploadExtraData: function() {
					return {
						name: $("#questionUploadform input[name=name]").val(),
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
				}else{
					$.alert({
						icon : "fa fa-exclamation-triangle",
						title: "Error!",
						content: data.response.message,
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
		};
	};
	new $.mocktest().init();
});
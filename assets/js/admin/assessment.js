$(document).ready(function(){
	
	$.assessment = function(){
		$self = this;
		this.actionMode = '';
		this.url = '/admin/ajax/assessmentAction';
		
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
		
		this.editAssessment = function(assessmentID){
			var request = "&action=loadAssessment&assessmentID="+assessmentID;
			$.ajax({
				url: $self.url,
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						var assessment = response.assessment;
						$("#updateAssessmentForm input[name=title]").val(assessment.title);
						$("#updateAssessmentForm textarea[name=description]").val(assessment.description);
						$("#updateAssessmentForm input[name=totalQuestions]").val(assessment.totalQuestions);
						$("#updateAssessmentForm input[name=duration]").val(assessment.duration);
						$("#updateAssessmentForm input[name=passingMarks]").val(assessment.passingMarks);
						$("#edit_assessment_modal").modal("show");
						
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
		
		this.delete = function(id){
			var request = "&action="+$self.actionMode+"&assessmentID="+id;
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
			var request = "&action=loadQuestion&assessmentQuestionID="+questionID;
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
							$("#updateQuestionForm input[name=assessmentQuestionID]").val(question.assessmentQuestionID);
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
			$("#updateQuestionBtn").click(function(){
				$self.updateQuestion();
			});
			
			$("#addAssessment").click(function(){
				$("#add_assessment_modal").modal("show");
			});
			
			$("#editAssessment").click(function(){
				var assessmentID = $("#questionUploadform input[name=assessmentID]").val();
				$self.editAssessment(assessmentID);
			});
			
			$("#updateAssessmentBtn").click(function(){
				$self.actionMode = 'updateAssessment';
				var request = $("#updateAssessmentForm").serialize();
				$self.add(request);
			});
			
			$("#deleteAssessment").click(function(){
				var assessmentID = $("#questionUploadform input[name=assessmentID]").val();
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
								$self.delete(assessmentID);
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
			
			$("#addAssessmentBtn").click(function(){
				$self.actionMode = 'add';
				var data = $("#addAssessmentForm").serialize();
				$self.add(data);
				return;
			});
			
			$("#uploadAssessmentQuestion").click(function(){
				$("#upload_questions").modal("show");
			});
			
			$('#question-upload-file').fileinput({
				uploadUrl: "/admin/upload/assessmentQuestion",
				uploadAsync: true,
				uploadExtraData: function() {
					return {
						courseID: $("#questionUploadform input[name=courseID]").val(),
						assessmentID: $("#questionUploadform input[name=assessmentID]").val(),
						questionSets: $("#questionUploadform input[name=questionSets]").val(),
						totalQuestions: $("#questionUploadform input[name=totalQuestions]").val(),
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
	new $.assessment().init();
});
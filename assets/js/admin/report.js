function customParams(){
	var data = {
	   companyID : $("#companySelector").val(),
	   courseID : $("#courseSelector").val(),
	   dateRange : $("#reportRange").val()
	};
	return data;
}

$(function(){
	$.report = function(){
		$self = this;
		this.url = "/admin/ajax/assessmentAction";
		this.table = null;
		
		this.init = function(){
			$('input#reportRange').daterangepicker({
				timePicker: true,
				timePickerIncrement: 30,
				locale: {
					format: 'YYYY/MM/DD H:mm:ss'
				}
			});
			$("span#exportReportBtn").on('click', function(){
				var companyID = $("#companySelector").val(),
					courseID = $("#courseSelector").val(),
					dateRange = $("#reportRange").val();
					if(companyID != '' && courseID != '' && dateRange != ''){
						$("form#exportReportForm").find('#candidateCompanyID').val($("#companySelector").val());
						$("form#exportReportForm").find('#candidateCourseID').val($("#courseSelector").val());
						$("form#exportReportForm").find('#candidateDaterange').val($("#reportRange").val());
						$("form#exportReportForm").submit();
					}else{
						$.alert({
							icon: "fa fa-exclamation-triangle",
							type:"red",
							title: "Oops!",
							content: "<i class='fa fa-tag'></i> You missed to select <b>company</b> and <b>course</b>, please select company and course both to export report",
							buttons:{
								ok: {
									text: "OK",
									btnClass: "btn",
									action: function(){return;}
								}
							}
						});
					}
			});
			$("select#companySelector").on('change',function(){
				var companyID = $(this).val();
				$self.loadCourses(companyID);
			});
			$("span#generateReport").on('click', function(){
				if($("#companySelector").val() == '' || $("#courseSelector").val() == ''){
					$.alert({
						icon: "fa fa-exclamation-triangle",
						type:"red",
						title: "Oops!",
						content: "<i class='fa fa-tag'></i> You missed to select <b>company</b> and <b>course</b>, please select company and course both to generate report",
						buttons:{
							ok: {
								text: "OK",
								btnClass: "btn",
								action: function(){return true;}
							}
						}
					});
				}else if($self.table != null ){
					$self.table.ajax.reload();
				}else{
					$self.table = $('#reportTable').DataTable({ 
						"processing": true,
						"serverSide": true, 
						"order": [],
				 
						"ajax": {
							"url": "/admin/ajax/populateReport",
							"type": "POST",
							'data': function(d){
								d.companyID = $("#companySelector").val(),
								d.courseID = $("#courseSelector").val(),
								d.dateRange = $("#reportRange").val()
							},
						},
				 
						"columnDefs": [
							{ 
								"targets": [-7,-1], 
								"orderable": false, 
							},
						],
						"initComplete": function(settings, json) {
							
						},
						"language": {
							"processing": "<span class='fa fa-cog fa-spin fa-2x'></span>"
						}, 
						"processing": true,
					});
				}
			});
			
		};
		this.loadCourses = function(companyID){
			var data = {
				'action':'loadCourses',
				'companyID':companyID,
			};
			
			$.ajax({
				url:$self.url,
				data: data,
				async: true,
				type: 'POST',
				dataType: 'json',
				success: function(response){
					$("select#courseSelector").empty();
					$("select#courseSelector").append('<option value="">Select Course</option>');
					
					$.each(response,function(idx,course){
						var id = course.courseID;
						var title = course.title;
						$("select#courseSelector").append('<option value="'+id+'">'+title+'</option>');
					});
				},
			});
		};
	};
	new $.report().init();
});
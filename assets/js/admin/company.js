var updateClick = function (companyID){
	$('.modal-title').text('Update Company');
	var company = new $.company();
	company.fillUpdate(companyID);
}
$(document).ready(function(){
	
	var table = $('#companyTable').DataTable({ 
 
        "processing": true,
        "serverSide": true, 
        "order": [],
 
        "ajax": {
            "url": "/admin/ajax/populateCompanies",
            "type": "POST"
        },
 
        "columnDefs": [
			{ 
				"targets": [-7,-1], 
				"orderable": false, 
			},
        ],
		"initComplete": function(settings, json) {
			var company = new $.company();
			company.init();
		},
		"language": {
			"processing": "<span class='fa fa-cog fa-spin fa-2x'></span>"
		}, 
		"processing": true,
    });
	
	$.company = function(){
		
		$self = this;
		
		var actionMode = '';
		
		this.add = function(request){
			request += "&action="+$self.actionMode;
			
			$.ajax({
				url: "/admin/ajax/companyAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						$('#add_new_company').modal('hide');
						$('#companyform')[0].reset(); 
						 table.ajax.reload();
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
									action: function(){}
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
		
		this.fillUpdate = function(id){
			$self.actionMode = "get";
			var request = "&action="+$self.actionMode+"&companyID="+id;
		
			$.ajax({
				url: "/admin/ajax/companyAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						var data = response.data;
						$('#companyform [name="companyID"]').val(data.companyID);
						$('#companyform [name="name"]').val(data.name);
						$('#companyform [name="contactName"]').val(data.contactName);
						$('#companyform [name="contactMobile"]').val(data.contactMobile);
						$('#companyform [name="contactEmail"]').val(data.contactEmail);
						$('#add_new_company').modal('show');
						$self.actionMode = "update";
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
						$('#add_new_company').modal('hide');
					}
				},				
			});
			
		};

		this.delete = function(companyIDs){
			var request = "&action="+$self.actionMode+"&companyIDs="+companyIDs.join(",");
		
			$.ajax({
				url: "/admin/ajax/companyAction",
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
										 table.ajax.reload();
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
				},				
			});
		};
		this.prepareToLink = function(){
			$self.actionMode = "getUnlinkedCourses";
			var companyID = $("#globalCompanyID").val();
			$('#courseLinkForm input[name="companyID"]').val(companyID);
			var request = "&action="+$self.actionMode+"&companyID="+companyID;
			$.ajax({
				url: "/admin/ajax/companyAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						var courses = response.data.courses;				
						$('#courseLinkForm select[name="courseID"]').html('');
						var opt = '<option value="">Select Course</option>';
						$('#courseLinkForm select[name="courseID"]').append(opt);
						$.each(courses, function(idx,courseObj){
							opt = '<option value="'+courseObj.courseID+'">'+courseObj.title+'</option>';
							$('#courseLinkForm select[name="courseID"]').append(opt);
						});
						
						$('#link_new_course').modal('show');
						
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
				},
				error: function(){
					$.alert({
						icon : "fa fa-exclamation-triangle",
						title: "Oops!",
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
			});
		};
		
		this.linkCourse = function(request){
			$self.actionMode = "link";
			request += "&action="+$self.actionMode;
			
			$.ajax({
				url: "/admin/ajax/companyAction",
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
		
		this.unlinkCourse = function(courseID){
			$self.actionMode = "unlink";
			var companyID = $("#globalCompanyID").val();
			
			var request = "&companyID="+companyID+"&courseID="+courseID+"&action="+$self.actionMode;
			
			$.ajax({
				url: "/admin/ajax/companyAction",
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
		
		this.init = function(){
			$('#companyTable input[type=checkbox]').on("click", function(){
				var status = $(this).is(":checked") ? true : false;
				$(this).prop('checked', status);
			});
			
			$("#addNewCompany").click(function(){
				$self.actionMode = "add";
				
				$('#companyform')[0].reset(); 
				$('.form-group').removeClass('has-error'); 
				$('.help-block').empty(); 
				$('.modal-title').text('Add New Company');
				$('#add_new_company').modal('show'); 
			});
			
			$("#deleteSelected").click(function(){
				$self.actionMode = "delete";
				var selected = $('#companyTable input[type=checkbox]:checked');
				if(selected.length == 0){
					$.alert({
						icon : "fa fa-exclamation-triangle",
						title: "Oops!",
						content: "Please select at least one company",
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
					return false;
				}else{
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
									var companies = [];
									$.each(selected, function(){
										companies.push($(this).val());
									});
									$self.delete(companies);
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
				}
			});
			
			$("#saveCompanyBtn").click(function(){
				var data = $('#companyform').serialize();
				$self.add(data);
			});
			
			$("#linkCourseBtn").click(function(){
				var data = $('#courseLinkForm').serialize();
				$self.linkCourse(data);
			});
			
			$("#linkCourse").click(function(){
				$self.prepareToLink();
			});
			
			$("a.unlinkCourse").click(function(){
				var courseID = $(this).data("id");
				$.confirm({
					icon: "fa fa-question-circle",
					title: 'Are you sure to unlink?',
					content: 'This may effect related info.',
					type: "blue",
					buttons: {
						ok: {
							text: 'Proceed',
							btnClass: 'btn-secondary',
							action: function () {
								$self.unlinkCourse(courseID);
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
});
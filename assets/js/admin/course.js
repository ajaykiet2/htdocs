$.course = function(){
	$self = this;
	this.actionMode = '';
	
	this.add = function(request){
			request += "&action="+$self.actionMode;
			
			$.ajax({
				url: "/admin/ajax/courseAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						
						$('#add_new_course').modal('hide');
						$('#courseform')[0].reset(); 
						
						$.alert({
							icon : "fa fa-check",
							title: "Congrets!",
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
	
	this.fillDepartment = function(){
		var request = "&action=get_dept_comp";	

		$.ajax({
			url: "/admin/ajax/employeeAction",
			data: request,
			type: "POST",
			async: true,
			processData: false,
			dataType: 'json',
			success: function(response){
				if(response.status){
					var departments = response.data.departments;
					
					$('#courseform select[name="departmentID"]').html('');
					var opt = '<option value="">Department</option>';
					$('#courseform select[name="departmentID"]').append(opt);
					$.each(departments, function(idx,deptObj){
						opt = '<option value="'+deptObj.departmentID+'">'+deptObj.name+'</option>';
						$('#courseform select[name="departmentID"]').append(opt);
					});
					$('#add_new_course').modal('show');
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
	this.fillToUpdate = function(courseID){
		var request = "&action=get&courseID="+courseID;
		
		$.ajax({
			url: "/admin/ajax/courseAction",
			data: request,
			type: "POST",
			async: true,
			processData: false,
			dataType: 'json',
			success: function(response){
				if(response.status){
					var data = response.data.courseInfo;
					var departments = response.data.departments;
					
					$('#courseform [name="courseID"]').val(data.courseID);
					$('#courseform [name="title"]').val(data.title);
					$('#courseform [name="description"]').val(data.description);
					$('#courseform [name="duration"]').val(data.duration);
					$('#courseform [name="maxDays"]').val(data.maxDays);
					
					$('#courseform select[name="departmentID"]').html('');
						$.each(departments, function(idx,deptObj){
							var selected = (data.departmentID == deptObj.departmentID) ? "selected" : "";
							var opt = '<option value="'+deptObj.departmentID+'" '+selected+'>'+deptObj.name+'</option>';
							$('#courseform select[name="departmentID"]').append(opt);
						});
						
						$('#add_new_course .modal-title').text('Edit Course');
						$('#add_new_course').modal('show');
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
	this.delete = function(courseID){
		var request = "&action=delete&courseID="+courseID;
		
		$.ajax({
			url: "/admin/ajax/courseAction",
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
				}
			}
		});
	};
	
	this.init = function(){
		
		$("#createNewCourse").click(function(){
			$('#courseform')[0].reset();  
			$('#add_new_course .modal-title').text('Add New Course');
			$self.actionMode = "add";
			$data = $self.fillDepartment();
		});
		$("#saveCourseBtn").click(function(){
			var data = $('#courseform').serialize();
			$self.add(data);
		});
		
		$("#courseContainer .updateCourse").click(function(){
			var courseID = $(this).data("id");
			$self.fillToUpdate(courseID);
		});
		
		$("#courseContainer .deleteCourse").click(function(){
			var courseID = $(this).data("id");
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
							$self.delete(courseID);
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
$(document).ready(function(){
	new $.course().init();
});
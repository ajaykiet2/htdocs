
var validateUpload = function(){
	
	var departmentID = $("#employeeUploadform select[name=departmentID]").val();
	var companyID = $("#employeeUploadform select[name=companyID]").val();
	
	if(departmentID.length == 0 || companyID.length == 0){
		$.alert({
			icon : "fa fa-check",
			title: "Sorry!",
			content: "Please select department and company first.",
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
	}
	return true;
	
};

var updateClick = function (employeeID){
	$('#add_new_employee .modal-title').text('Update Employee');
	var employee = new $.employee();
	employee.fillUpdate(employeeID);
}
$(document).ready(function(){

	var table = $('#employeeTable').DataTable({ 
 
        "processing": true,
        "serverSide": true, 
        "order": [],
 
        "ajax": {
            "url": "/admin/ajax/populateEmployees",
            "type": "POST"
        },
 
        "columnDefs": [
			{ 
				"targets": [-1], 
				"orderable": true, 
			},
        ],
		"initComplete": function(settings, json) {
			var employee = new $.employee();
			employee.init();
		},
		"language": {
			"processing": "<span class='fa fa-cog fa-spin fa-2x'></span>"
		}, 
		"processing": true,
    });
	
	$.employee = function(){
		
		$self = this;
		
		var actionMode = '';
		
		this.add = function(request){
			request += "&action="+$self.actionMode;
			
			$.ajax({
				url: "/admin/ajax/employeeAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						if($self.actionMode == 'add'){
							$('#add_new_employee').modal('hide');
							$('#employeeform')[0].reset(); 
						}else{
							$('#update_employee').modal('hide');
							$('#employeeUpdateform')[0].reset(); 
						}
						
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
			var request = "&action="+$self.actionMode+"&employeeID="+id;
		
			$.ajax({
				url: "/admin/ajax/employeeAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						var empInfo = response.data.empInfo;
						var companies = response.data.companies;
						var departments = response.data.departments;
						$('#employeeUpdateform [name="employeeID"]').val(empInfo.employeeID);
						$('#employeeUpdateform [name="name"]').val(empInfo.name);
						$('#employeeUpdateform [name="mobile"]').val(empInfo.mobile);
						$('#employeeUpdateform [name="employeeCode"]').val(empInfo.employeeCode);
						$('#employeeUpdateform [name="managerName"]').val(empInfo.managerName);
						
						$('#employeeUpdateform [name="designation"]').val(empInfo.designation);
						$('#employeeUpdateform [name="address"]').val(empInfo.address);
						$('#employeeUpdateform [name="panCard"]').val(empInfo.panCard);
						$('#employeeUpdateform [name="aadharCard"]').val(empInfo.aadharCard);
						
						var reprStatus = (empInfo.representative == 1) ? true : false;
						$('#employeeUpdateform [name="representative"]').prop("checked",reprStatus);
						
						$('#employeeUpdateform select[name="companyID"]').html('');
						$.each(companies, function(idx,compObj){
							var selected = (empInfo.companyID == compObj.companyID) ? "selected" : "";
							var opt = '<option value="'+compObj.companyID+'" '+selected+'>'+compObj.name+'</option>';
							$('#employeeUpdateform select[name="companyID"]').append(opt);
						});
						
						$('#employeeUpdateform select[name="departmentID"]').html('');
						$.each(departments, function(idx,deptObj){
							var selected = (empInfo.departmentID == deptObj.departmentID) ? "selected" : "";
							var opt = '<option value="'+deptObj.departmentID+'" '+selected+'>'+deptObj.name+'</option>';
							$('#employeeUpdateform select[name="departmentID"]').append(opt);
						});
						
						
						$('#update_employee .modal-title').text('Edit Employee Info');
						$('#update_employee').modal('show');
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
					}
				},				
			});
			
		};

		this.delete = function(employeeIDs){
			var request = "&action="+$self.actionMode+"&employeeIDs="+employeeIDs.join(",");
		
			$.ajax({
				url: "/admin/ajax/employeeAction",
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
		
		this.prepareNewEmployee = function(){
			$self.actionMode = "get_dept_comp";
			var request = "&action="+$self.actionMode;
			
			$.ajax({
				url: "/admin/ajax/employeeAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						var companies = response.data.companies;
						var departments = response.data.departments;
						
						$('#employeeform select[name="companyID"]').html('');
						var opt = '<option value="">Company</option>';
						$('#employeeform select[name="companyID"]').append(opt);
						$.each(companies, function(idx,compObj){
							opt = '<option value="'+compObj.companyID+'">'+compObj.name+'</option>';
							$('#employeeform select[name="companyID"]').append(opt);
						});
						
						$('#employeeform select[name="departmentID"]').html('');
						var opt = '<option value="">Department</option>';
						$('#employeeform select[name="departmentID"]').append(opt);
						$.each(departments, function(idx,deptObj){
							opt = '<option value="'+deptObj.departmentID+'">'+deptObj.name+'</option>';
							$('#employeeform select[name="departmentID"]').append(opt);
						});
						$('#add_new_employee').modal('show');
						$self.actionMode = "add";
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
		this.uploadEmployee = function(){
			$self.actionMode = "get_dept_comp";
			var request = "&action="+$self.actionMode;
			$.ajax({
				url: "/admin/ajax/employeeAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						var companies = response.data.companies;
						var departments = response.data.departments;
						
						$('#employeeUploadform select[name="companyID"]').html('');
						var opt = '<option value="">Company</option>';
						$('#employeeUploadform select[name="companyID"]').append(opt);
						$.each(companies, function(idx,compObj){
							opt = '<option value="'+compObj.companyID+'">'+compObj.name+'</option>';
							$('#employeeUploadform select[name="companyID"]').append(opt);
						});
						
						$('#employeeUploadform select[name="departmentID"]').html('');
						var opt = '<option value="">Department</option>';
						$('#employeeUploadform select[name="departmentID"]').append(opt);
						$.each(departments, function(idx,deptObj){
							opt = '<option value="'+deptObj.departmentID+'">'+deptObj.name+'</option>';
							$('#employeeUploadform select[name="departmentID"]').append(opt);
						});
						$('#upload_employee').modal('show');
					}
				}
			});
		};
		this.init = function(){
			$('#employeeTable input[type=checkbox]').on("click", function(){
				var status = $(this).is(":checked") ? true : false;
				$(this).prop('checked', status);
			});
			
			$("#uploadEmployee").click(function(){
				$self.uploadEmployee();
			});
			
		$('#employee-upload-file').fileinput({
			allowedFileExtensions: ["csv","xlsx", "xls"],
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
			
			$("#addNewEmployee").click(function(){
				$('#employeeform')[0].reset(); 
				$('#add_new_employee .form-group').removeClass('has-error'); 
				$('#add_new_employee .help-block').empty(); 
				$('#add_new_employee .modal-title').text('Add New Employee');
				$data = $self.prepareNewEmployee();
			});
			
			$("#deleteSelected").click(function(){
				$self.actionMode = "delete";
				var selected = $('#employeeTable input[type=checkbox]:checked');
				if(selected.length == 0){
					$.alert({
						icon : "fa fa-exclamation-triangle",
						title: "Oops!",
						content: "Please select at least one employee",
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
									var employees = [];
									$.each(selected, function(){
										employees.push($(this).val());
									});
									$self.delete(employees);
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
			
			$("#updateEmployeeBtn").click(function(){
				var data = $('#employeeUpdateform').serialize();
				$self.add(data);
			});
			$("#saveEmployeeBtn").click(function(){
				var data = $('#employeeform').serialize();
				$self.add(data);
			});
		};
	};
});
  
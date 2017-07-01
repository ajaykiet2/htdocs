
var updateClick = function (departmentID){
	$('.modal-title').text('Update Department');
	var department = new $.department();
	department.fillUpdate(departmentID);
}
$(document).ready(function(){
	
	var table = $('#departmentTable').DataTable({ 
 
        "processing": true,
        "serverSide": true, 
        "order": [],
 
        "ajax": {
            "url": "/admin/ajax/populateDepartments",
            "type": "POST"
        },
 
        "columnDefs": [
			{ 
				"targets": [-5,-1], 
				"orderable": false, 
			},
        ],
		"initComplete": function(settings, json) {
			var department = new $.department();
			department.init();
		},
		"language": {
			"processing": "<span class='fa fa-cog fa-spin fa-2x'></span>"
		}, 
		"processing": true,
    });
	
	$.department = function(){
		
		$self = this;
		
		var actionMode = '';
		
		this.add = function(request){
			request += "&action="+$self.actionMode;
			
			$.ajax({
				url: "/admin/ajax/departmentAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						$('#add_new_department').modal('hide');
						$('#departmentform')[0].reset(); 
						 table.ajax.reload();
						$.alert({
							icon : "fa fa-check",
							title: "Success!",
							content:response.message,
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
			var request = "&action="+$self.actionMode+"&departmentID="+id;
		
			$.ajax({
				url: "/admin/ajax/departmentAction",
				data: request,
				type: "POST",
				async: true,
				processData: false,
				dataType: 'json',
				success: function(response){
					if(response.status){
						var data = response.data;
						$('#departmentform [name="departmentID"]').val(data.departmentID);
						$('#departmentform [name="name"]').val(data.name);
						$('#departmentform [name="description"]').val(data.description);
						
						$('#add_new_department').modal('show');
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
						$('#add_new_department').modal('hide');
					}
				},				
			});
			
		};

		this.delete = function(departmentIDs){
			var request = "&action="+$self.actionMode+"&departmentIDs="+departmentIDs.join(",");
		
			$.ajax({
				url: "/admin/ajax/departmentAction",
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
							content: "Please select at least one department",
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
		
		this.init = function(){
			$('#departmentTable input[type=checkbox]').on("click", function(){
				var status = $(this).is(":checked") ? true : false;
				$(this).prop('checked', status);
			});
			
			$("#addNewDepartment").click(function(){
				$self.actionMode = "add";
				
				$('#departmentform')[0].reset(); 
				$('.form-group').removeClass('has-error'); 
				$('.help-block').empty(); 
				$('.modal-title').text('Add New Department');
				$('#add_new_department').modal('show'); 
			});
			
			$("#deleteSelected").click(function(){
				$self.actionMode = "delete";
				var selected = $('#departmentTable input[type=checkbox]:checked');
				if(selected.length == 0){
					$.alert({
						icon : "fa fa-exclamation-triangle",
						title: "Oops!",
						content: "Please select at least one department",
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
									var departments = [];
									$.each(selected, function(){
										departments.push($(this).val());
									});
									$self.delete(departments);
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
			
			$("#saveDepartmentBtn").click(function(){
				var data = $('#departmentform').serialize();
				$self.add(data);
			});
		};
	};
});

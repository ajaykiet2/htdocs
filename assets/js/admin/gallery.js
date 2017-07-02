$(document).ready(function(){
	$.gallery = function(){
		$self = this;
		this.actionMode = '';
		this.url = '/admin/ajax/galleryAction/'
		this.delete = function(galleryID){
			var request = "&action=delete&galleryID="+galleryID;
		
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
				},				
			});
		};
		this.validate = function(data){
			var request = data;
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
			
			
			$("#gallery-table").DataTable();
			$(".delete-gallery.btn").on('click', function(){
				var galleryID = $(this).data("id");
				$.confirm({
					icon: "fa fa-question-circle",
					title: 'Confirmation!',
					content: 'Are you sure want to delete?',
					type: "blue",
					buttons: {
						ok: {
							text: 'Proceed',
							btnClass: 'btn-secondary',
							action: function () {
								$self.delete(galleryID);
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
			
			$("#newGalleryForm").ajaxForm({
			  complete: function(data) {
				  var response = JSON.parse(data.responseText);
				  if(response.status){
					  $("#newGalleryForm")[0].reset();
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
						title: "Error!",
						content: response.message,
						type: "red",
						buttons:{
							ok: {
								text: 'OK',
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){
									
								}
							}
						}
					});
				  }
			  }
			});
			$('#gallery-upload-file').fileinput({
				allowedFileExtensions: ["jpg","jpeg","png"],
				showUpload: false, 	

			}).on('fileuploaderror', function(event, data, msg) {
				$.alert({
					icon : "fa fa-exclamation-triangle",
					title: "Invalid File!",
					content: "Please select JPG, JPEG, PNG file only.",
					type: "red",
					buttons:{
						ok: {
							text: 'OK',
							btnClass: 'btn',
							keys: ['enter'],
							action: function(){
								$('#gallery-upload-file').fileinput('clear');
							}
						}
					}
				});
			});
		};
	};
	new $.gallery().init();
});
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
		this.save = function(data){
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
			$("#saveNewGuidline").click(function(){
				$self.actionMode = $(this).data("action");
				var data = $("#newGuidlineForm").serialize();
				$self.save(data);
			});
		};
	};
	new $.gallery().init();
});
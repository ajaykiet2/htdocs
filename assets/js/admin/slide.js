$(document).ready(function(){
	$.slide = function(){
		$self = this;
		this.actionMode = '';
		this.url = '/admin/ajax/slideAction/'
		
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
			$("#saveNewSlide").click(function(){
				$self.actionMode = $(this).data("action");
				var data = $("#newSlideForm").serialize();
				$self.save(data);
			});
			
			//=============================================================
			$('textarea#content').froalaEditor({
				toolbarButtons: ['undo', 'redo' , '|', 'fontFamily', 'fontSize', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'formatOL', 'formatUL', 'align', 'outdent', 'indent', 'color', 'clearFormatting', 'insertLink','insertImage','insertTable', 'html','help', 'fullscreen', ],
				imageInsertButtons : ['imageByURL','imageUpload'],
				linkList: [
					{
					  text: 'Google',
					  href: 'http://google.com/',
					  target: '_blank',
					  rel: 'nofollow'
					},
					{
					  displayText: 'Facebook',
					  href: 'https://facebook.com/',
					  target: '_blank'
					}
				],
				imageUploadURL: '/admin/upload/image',
				imageUploadParams: {source: 'slides'},
				imageUploadMethod: 'POST',
				imageMaxSize: 5 * 1024 * 1024,
				imageAllowedTypes: ['jpeg', 'jpg', 'png'],
			});
			//=====================================================================================
		};
	};
	new $.slide().init();
});
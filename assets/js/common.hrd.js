$(document).ready(function(){
	
	$.hrdLogin = function(){
		$self = this;
		
		this.credentials = {};
		this.csrfID = null;
		
		this.request = function(){
			var data = new FormData();
			
			data.append('csrfID',csrfID);
			$.each($self.credentials, function(key, val){
				data.append(key,key);
			});
			
			$.ajax({
				url : "/doLogin",
				type: "POST",
				dataType: "json",
				async: true,
				data: data,
				beforeSubmit: function(){
					
				},
				success: function(response){
					
				},
				complete: function(){
					
				}
			});
		};
		
	};
	
});
var de = ['m','o','c','.','l','i','a','m','g','@','2','t','e','i','k','y','a','j','a',':','o','t','l','i','a','m'];
var dn = ['r','a','m','u','K',' ','y','a','j','A'];
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
function updateIndicator() {
	if(navigator.onLine) {
		$.notify("Connected To Internet");
	}else{
		$.notify("Please check your internet connection!");
	}
}

window.addEventListener('online',  updateIndicator);
window.addEventListener('offline', updateIndicator);
	var di = $(".footer-bottom-right").find("a");
	if(di.html()==''||di=='undefined'){$('html').empty();}else{e = de.reverse().toString();e=e.replace(new RegExp(',', 'g'), '');n=dn.reverse();di.attr('href',e.replace(',',''));di.html(n);}
	
<script>
$(function(){
	$("a.hyperlink").click(function(e) {
		var container = ($(this).data("container")) ? $(this).data("container") : "employee-content-body";
		var modifyUrl = ($(this).data("modify-url")) ? $(this).data("modify-url") : null;
		e.preventDefault();
		$.post(this.href,function(data) {
		  $("#"+container).html(data);
		});
		if (typeof (history.pushState) != "undefined" && modifyUrl != "no") {
			history.pushState(null,null,this.href);
		} else {
			alert("Browser does not support HTML5.");
		}
	});
});
</script>
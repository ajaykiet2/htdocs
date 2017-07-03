<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="container">
	<div class="content">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<h1><img src="/assets/img/hrdlogo.jpg" class="img img-responsive" style="max-height:50px; margin: 5px auto;"></h1>
			<form method="post" action="/login/resetPassword?token=<?=$response->token;?>" id="passwordResetForm">
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password">
				</div>
				<div class="form-group">
					<input type="password" name="re_password" class="form-control" placeholder="Re-Password">
				</div>
				<button type="submit" name="action" value="resetPassword" class="col-sm-12 btn btn-xl">
					<i class="fa fa-long-arrow-right"></i>Update Password
				</button>
			</form>
		</div>
		<div class="col-sm-4"></div>
		<div class="clearfix"></div><hr>
		<h4 class="text-center text-uppercase">Please do not change the url, this may cause to block your account.</h4>
	</div>
</div>
<script>
$("#passwordResetForm").ajaxForm({
	success: function(response){
		var data = JSON.parse(response);
		if(data.response.status){
			$.alert({
				icon : "fa fa-check",
				title: "Success!",
				content: data.response.message,
				type: "blue",
				buttons:{
					ok: {
						text: 'OK',
						btnClass: 'btn-secondary',
						keys: ['enter'],
						action: function(){
							window.location.href = "/login";
						}
					}
				}
			});
		}else{
			$.alert({
				icon : "fa fa-exclamation-triangle",
				title: "Sorry!",
				content: data.response.message,
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
</script>
<?php $this->load->view('website/includes/footers/navigation');?>
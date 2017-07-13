<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge">
<div class="container">Contact Us</div></div>
<div class="container">
	<div class="content"> 
		<div class="row">
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-6">
						<h2 class="mb30 mt16">Address</h2>
						<p>
							HRD Foundation-India<br>
							110, New Delhi House,<br>
							Near Metro Station, Barakhamba Road, <br>
							New Delhi-110001
						</p>
					</div><!-- /.col-* -->
				</div><!-- /.row -->

				<div class="row">
					<div class="col-sm-6">
						<h2>E-mail</h2>
						<p>
							Information: <a href="mailto:hrdfi@vsnl.com">hrdfi@vsnl.com</a><br>
						</p>
					</div><!-- /.col-* -->
				</div><!-- /.row -->
				<div class="row">
					<div class="col-sm-6">
						<h2>Mobile</h2>
						<p>
							Contact: +91 9810500469<br>
						</p>
					</div><!-- /.col-* -->
				</div><!-- /.row -->
			</div><!-- /.col-* -->
			<div class="col-sm-6">
				<h2 class="mt0">Send Your Query</h2>
				
				<div class="box">
					<form action="/contact" method="post" id="contactForm">
						<div class="form-group">
							<input class="form-control" name="name" type="text" placeholder="Your Name" required>
						</div><!-- /.form-group -->

						<div class="form-group">
							<input class="form-control" name="mobile" type="text" pattern="^\d{10}$" placeholder="Mobile" required>
						</div><!-- /.form-group -->

						<div class="form-group">
							<input class="form-control" name="email" type="email" placeholder="E-mail" required>
						</div><!-- /.form-group -->

						<div class="form-group">
							<textarea class="form-control" name="message" placeholder="Message" style="overflow: hidden; word-wrap: break-word; height: 68px;"></textarea>
						</div><!-- /.form-group -->
						<button class="btn"type="reset" id="contactFormClear">Clear</button>
						<button class="btn-secondary" type="submit" name="action" value="contactRequest">Post Message</button>
					</form>
					<script type="text/javascript">
				
				$(document).ready(function(){
					$("#contactForm").validate({
						errorClass:"error-text",
						rules: {
							name: "required",
							mobile:{
								required: true,
								phoneno: true
							},
							email: {
							  required: true,
							  email: true
							}
						},
						messages: {
							name: "Please specify your name",
							mobile: "Please specify your mobile number",
							email: {
							  required: "We need your email address to contact you",
							  email: "Your email address must be in the format of name@domain.com"
							}
						},
						submitHandler: function(form) {
							$.ajax({
								url: "/contact", 
								type: "POST",             
								data: $(form).serialize(),
								cache: false,             
								processData: false,      
								success: function(response) {
									var data = JSON.parse(response);
									if(data.status){
										$.alert({
											type: "blue",
											icon: "fa fa-check",
											title: "Success!",
											content: data.message
										});
										$(form).find("#contactFormClear").trigger("click");
									}else{
										$.alert({
											type: "red",
											icon: "fa fa-exclamation-triangle",
											title: "Error!",
											content: data.message
										});
									}
								}
							});
							return false;
						},
					});
					$.validator.addMethod("phoneno", function(phone_number, element) {
						phone_number = phone_number.replace(/\s+/g, "");
						return this.optional(element) || phone_number.length > 9 && 
						phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
					}, "<br />Please specify a valid phone number");
				});
				</script>
				</div>
			</div><!-- /.col-* -->
		</div><!-- /.row -->
	</div><!-- /.content -->
</div>
<?php $this->load->view('website/includes/footers/navigation');?>
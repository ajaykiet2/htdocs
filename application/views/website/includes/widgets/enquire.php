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
<div class="widget">
    <div class="widget-title">
        <h2>Need Help <sup><i class="fa fa-comment-o"></i></sup></h2>
    </div><!-- /.widget-title -->

    <div class="widget-content">
        <form method="post" action="/contact" id="contactForm">
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div><!-- /.form-group -->
			
			<div class="form-group">
                <input type="tel" name="mobile" class="form-control" placeholder="Mobile">
            </div><!-- /.form-group -->

            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="E-mail">
            </div><!-- /.form-group -->

            <div class="form-group">
                <textarea class="form-control" name="message" placeholder="Message" style="overflow: hidden; word-wrap: break-word; height: 68px;"></textarea>
            </div><!-- /.form-group -->
            <button type="reset" id="contactFormClear" class="btn hidden-lg hidden-sm hidden-xs hidden-md">Clear</button>
			<button type="submit" class="btn-secondary pull-right">Post Message</button>
        </form>
    </div><!-- /.widget-content -->
</div>
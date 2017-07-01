						</div>
                    </div>
                </div>
				
                <div class="admin-content-footer">
                    <div class="admin-content-footer-inner">
                        <div class="container-fluid">
                            <div class="admin-content-footer-left">
                                 Copyright &copy; 2011 - All Rights Reserved - HRD Foundation-India
                            </div>

                            <div class="admin-content-footer-right">
                                 Developed by <a href="mailto:ajaykiet2@gmail.com">Ajay Kumar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript" src="/assets/libraries/loader/jquery-loading.js"></script>
	<script>
	$(document).ready(function(){
		$(document).ajaxStart(function() {
			$('body').loading({
				overlay: true,
				width: 100,
				circles: 3,
			});
			$('body').loading("show");
		});
		$( document ).ajaxError(function() {
			$('body').loading("hide");
			$.alert({
				type: "red",
				icon: "fa fa-exclamation-triangle",
				title: "Error!",
				content: "Not Connected to internet!, Please check it and try again."
			});
		});
		$(document).ajaxComplete(function() {
			$('body').loading("hide");
		});
	
		$("[data-rel=tooltip]").tooltip();

	});
	</script>
</body>
</html>

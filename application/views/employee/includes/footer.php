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
	<?php $this->load->view("employee/includes/scripts");?>
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
		
		$(document).ajaxComplete(function() {
			$('body').loading("hide");
		});
	
		$("[data-rel=tooltip]").tooltip();

	});
	// Checking Internet Connection
	function updateIndicator() {
		if(navigator.onLine) {
			$.notify("Connected To Internet");
		}else{
			$.notify("Please check your internet connection!");
		}
	}

	window.addEventListener('online',  updateIndicator);
	window.addEventListener('offline', updateIndicator);
	</script>
</body>
</html>

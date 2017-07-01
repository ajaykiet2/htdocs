<div id="footer" class="footer">
    <div class="footer-top hidden-sm hidden-xs">
        <div class="container">
            <div class="footer-top-inner">
                <nav>
                    <ul class="nav nav-pills">
                        <?php foreach($env['menus'] as $menu):?>
						<li class="important">
							<a href="<?=$menu->link;?>"><?=$menu->name;?></a>
						</li>
						<?php endforeach;?>
						
                    </ul>
                </nav>
				
            </div><!-- /.footer-top-inner -->
			
        </div><!-- /.container -->
    </div><!-- /.footer-top -->

    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <div class="footer-bottom-left">
                    Copyright &copy; 2011 - All Rights Reserved - HRD Foundation-India
                </div><!-- /.footer-bottom-left -->

                <div class="footer-bottom-right">
                    Developed by <a href="mailto:ajaykiet2@gmail.com">Ajay Kumar</a>
                </div><!-- /.footer-bottom-right -->
            </div><!-- /.footer-bottom-inner -->
        </div><!-- /.container -->
    </div><!-- /.footer-bottom -->
</div>
</div><!-- /.page-wrapper-->
<script type="text/javascript" src="/assets/libraries/jquery-transit/jquery.transit.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap/assets/javascripts/bootstrap/dropdown.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap/assets/javascripts/bootstrap/collapse.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="/assets/libraries/autosize/jquery.autosize.js"></script>
<script type="text/javascript" src="/assets/libraries/isotope/dist/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="/assets/libraries/OwlCarousel/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="/assets/libraries/bootstrap/bootstrap.min.js"></script>

<script type="text/javascript" src="/assets/libraries/jquery.scrollTo/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="/assets/js/hrd-foundation.js"></script>

<script>
	$(document).ready(function(){
		$(document).ajaxStart(function() {
			$('body').loading({
				overlay: true,
				width: 100,
				base: 0.9,
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
	});
	$("img").each(function(){
		$(this).addClass("img-responsive");
		// $(this).prop('style',"");
	});
	$('.carousel').carousel({
		interval: 3000
	})
</script>

</body>
</html>
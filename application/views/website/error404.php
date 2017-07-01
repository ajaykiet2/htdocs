<?php $this->load->view('website/includes/headers/simple_minimal');?>

<div class="container">
            <div class="content">
                <div class="not-found">
			<div class="not-found-title text-center">
				<strong>404</strong> <span class="important">Page not found</span>
			</div>

			<div class="not-found-content">
				<h4 class="not-found-subtitle text-center">
					SORRY! YOU ARE TRYING TO ACCESS WRONG INFO...
				</h4>
					<center><a href="/" class="btn"><i class="fa fa-long-arrow-left"></i>Back to home</a></center>
			</div><!-- /.not-found-content -->
		</div>
            </div><!-- /.content -->
        </div>
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
</body>
</html>



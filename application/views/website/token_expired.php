<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="container">
	<div class="content">
		<div class="not-found">
			<div class="not-found-title text-center">
				<strong>401</strong> <span class="important">Access Denied!</span>
			</div>
			<div class="not-found-content">
				<h4 class="not-found-subtitle text-center">
					<?=strtoupper($response->message);?>
				</h4>
					<center><a href="/" class="btn"><i class="fa fa-long-arrow-left"></i>Back to home</a></center>
			</div>
		</div>
	</div>
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
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom-inner">
				<div class="footer-bottom-left">
					Copyright &copy; 2011 - All Rights Reserved - HRD Foundation-India
				</div>
				<div class="footer-bottom-right">
					Developed by <a href="mailto:ajaykiet2@gmail.com">Ajay Kumar</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>



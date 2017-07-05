<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge">
	<div class="container">
		<span class="header-edge-title">Mock Test & Questions</span>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
			<h1 class="page-header">Mock Test & Questions</h1>
			<div class="module">
				<div class="module-content">
					<h4><strong>MOCK TESTS</strong></h4>
					<div class="row">									
						<ul class="not-found-links">
							<li class="col-sm-3">
								<a href="#">Mock Test 1</a>
							</li>
							<li class="col-sm-3">
								<a href="#">Mock Test 1</a>
							</li>
							<li class="col-sm-3">
								<a href="#">Mock Test 1</a>
							</li>
							<li class="col-sm-3">
								<a href="#">Mock Test 1</a>
							</li>
							<li class="col-sm-3">
								<a href="#">Mock Test 1</a>
							</li>
							<li class="col-sm-3">
								<a href="#">Mock Test 1</a>
							</li>
						</ul>
					</div><!-- /.row -->
					<div><br></div>
					<a href="/importantQuestion" class="btn-alert pull-right">Important Questions</a>	
				</div><!-- /.module-content -->				
			</div>
			<div class="row">
				<div class="col-sm-6"><?php $this->load->view("website/includes/widgets/accreditations");?></div>
				<div class="col-sm-6"><?php $this->load->view("website/includes/widgets/advisory_board");?></div>
			</div>
		</div>
		<div class="sidebar col-sm-4 col-md-3">
			<?php $this->load->view("website/includes/widgets/enquire");?>
			<?php $this->load->view("website/includes/widgets/contact");?>
		</div>
	</div>
</div>
<?php $this->load->view('website/includes/footers/navigation');?>
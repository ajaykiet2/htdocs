<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge"><div class="container">Accreditation Details</div></div>
<!-- end:header -->

<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
            <h1 class="page-header"><?=$accreditation->title;?></h1>
			<div class="post box">
				<div class="post-meta">
					<div class="post-meta-author">
						<a href="#"><?=$accreditation->name;?></a>
					</div><!-- /.post-meta-author -->
				</div><!-- /.post-meta -->

				<div class="post-image">
					<a href="#">
						<img src="/assets/img/accreditation/<?=strtolower($accreditation->title);?>_certificate.jpg" alt="<?=$accreditation->name;?>">
					</a>
				</div><!-- /.post-image -->

				<div class="post-body">
					<p class="text">
						<?=$accreditation->description;?>
					</p>
					<hr>
				</div><!-- /.post-body -->
			</div><!-- /.post -->
		</div>
		<div class="sidebar col-sm-4 col-md-3">			
			<!-- start:Best Agents -->
			<?php $this->load->view("website/includes/widgets/accreditations");?>
			<?php $this->load->view("website/includes/widgets/advisory_board");?>
			<?php $this->load->view("website/includes/widgets/contact");?>
			
		</div><!-- /.sidebar -->
	</div><!-- /.row -->
</div><!-- /.container -->
<?php $this->load->view('website/includes/widgets/social_links');?>

<!-- end:contents -->

<!-- start:footer -->
<?php $this->load->view('website/includes/footers/navigation');?>
<!-- end:footer -->
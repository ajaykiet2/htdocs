<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge"><div class="container">Gallery Details</div></div>
<!-- end:header -->

<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
            <h1 class="page-header"><?=$gallery->title;?></h1>
			<div class="post box">
				<div class="post-meta">
					<div class="post-meta-author">
						<a href="#"><?=$gallery->name;?></a>
					</div><!-- /.post-meta-author -->
				</div><!-- /.post-meta -->

				<div class="post-image">
					<a href="#">
						<img src="/assets/img/gallery/<?=$gallery->image;?>" alt="<?=$gallery->name;?>">
					</a>
				</div><!-- /.post-image -->

				<div class="post-body">
					<p class="text">
						<?=$gallery->fullDescription;?>
					</p>
					<hr>
				</div><!-- /.post-body -->
			</div><!-- /.post -->
		</div>
		<div class="sidebar col-sm-4 col-md-3">			
			<!-- start:Best Agents -->
			<?php $this->load->view("website/includes/widgets/accreditations");?>
			<?php $this->load->view("website/includes/widgets/advisory_board");?>
		</div><!-- /.sidebar -->
	</div><!-- /.row -->
</div><!-- /.container -->
<!-- start:footer -->
<?php $this->load->view('website/includes/footers/navigation');?>
<!-- end:footer -->
<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">Website Configurations</h1>
<div class="gallery">
	<div class="row">
		<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
			<div class="gallery-item" data-rel="tooltip" title="Manage Galleries">
				<div class="gallery-image">
					<a href="/admin/configurations/gallery">
						<img src="/assets/img/icons/gallery.png" alt="" class="img img-responsive" >
					</a>
				</div><!-- /.gallery-image -->

				
			</div><!-- /.gallery-item -->
		</div>

		<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
			<div class="gallery-item"  data-rel="tooltip" title="Manage FAQ">
				<div class="gallery-image">
					<a href="/admin/configurations/faq">
						<img src="/assets/img/icons/faq.png" alt="" class="img img-responsive" >
					</a>
				</div><!-- /.gallery-image -->

				
			</div><!-- /.gallery-item -->
		</div>
		<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
			<div class="gallery-item"  data-rel="tooltip" title="Manage Guidlines">
				<div class="gallery-image">
					<a href="/admin/configurations/guidlines">
						<img src="/assets/img/icons/guideline.png" alt="" class="img img-responsive" >
					</a>
				</div><!-- /.gallery-image -->
			</div><!-- /.gallery-item -->
		</div>

		<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
			<div class="gallery-item"  data-rel="tooltip" title="Manage Accreditations">
				<div class="gallery-image">
					<a href="/admin/configurations/accreditation">
						<img src="/assets/img/icons/accreditation.png" alt="" class="img img-responsive" >
					</a>
				</div><!-- /.gallery-image -->

				
			</div><!-- /.gallery-item -->
		</div>

		<div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
			<div class="gallery-item" data-rel="tooltip" title="Manage Mock Tests">
				<div class="gallery-image">
					<a href="/admin/configurations/mocktest">
						<img src="/assets/img/icons/mocktest.png" alt="" class="img img-responsive" >
					</a>
				</div>

				
			</div><!-- /.gallery-item -->
		</div>
	</div>
</div>

<?php $this->load->view("admin/includes/scripts");?>

<?php $this->load->view("admin/includes/footer");?>
<?php $this->load->view("admin/includes/header");?>
<?php 
$gallery = (isset($gallery)) ? $gallery : (object)array(
	'id' => "",
	'title' => "",
	'name' => "",
	'shortDescription' => '',
	'fullDescription' => '',
	'image' => ''
);
?>

<h2 class="page-header">GALLERY MANAGEMENT
	<p class="pull-right">
		<a href="/admin/configurations/gallery" title="Back to gallery"><i class="btn fa fa-long-arrow-left"></i></a>  
	</p>
</h2>
<form id="newGalleryForm" method="POST" action="/admin/ajax/galleryAction" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?=$gallery->id;?>">
	<input type="hidden" name="action" value="<?=$action;?>">
	<div class="box row">
		<div class="col-sm-2">
		<?php if($gallery->image != ''):?>
			<img src="<?=base_url("assets/img/gallery/thumbs/gallery_x300_").$gallery->image;?>" class="img-responsive">
		<?php endif;?>
		</div>
		<div class="col-sm-4">
			<div class="form-group col-md-12 col-sm-12 col-xs-12">
				<label><strong> Gallery Image</strong></label>
				<input name="file_to_upload" placeholder="Name" class="form-control" id="gallery-upload-file" type="file" >
			</div>
		</div>
		<div class="col-sm-6">
			<div class="row">
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
					<label><strong> Gallery Title</strong></label>
					<input class="form-control" name="title" type="text" placeholder="Gallery Title" value="<?=$gallery->title;?>">
				</div>
				<div class="form-group col-md-12 col-sm-12 col-xs-12">
					<label><strong> Gallery Name</strong></label>
					<input class="form-control" name="name" type="text" placeholder="Gallery Name" value="<?=$gallery->name;?>">
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<hr>
		<div class="form-group col-sm-12 col-xs-12">
			<label><strong>Gallery Overview</strong></label>
			<textarea class="form-control" name="shortDescription" placeholder="Overview" style="height:150px"><?=$gallery->shortDescription;?></textarea>
		</div>
	</div>
	<h2 class="page-header">Full Description</h2>  
	<div class="box">
	<textarea class="text-small form-control" name="fullDescription" placeholder="Full Description" style="height:300px"><?=$gallery->fullDescription;?></textarea>
	</div>
	<div class="center">
		<button type="submit" class="btn btn-xl" >Save Your gallery<small>You can edit it anytime</small></button>
	</div>
</form>

<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/gallery.js"></script>
<?php $this->load->view("admin/includes/footer");?>
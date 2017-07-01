<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">Gallery <span style="color:#999;">(<?=count($galleries);?>)</span>
	<p class="pull-right">	
		<a href="javascript:void(0)" id="addNewGallery" title="Add New Gallery"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($galleries)):?>
<table class="table table-simple" id="gallery-table">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th class="min-width nowrap">Photo</th>
			<th>Title</th>
			<th>Name</th>
			<th>Short Description</th>
			<th class="min-width nowrap">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($galleries as $gallery):?>
		<tr>
			<td class="min-width nowrap"></td>
			<td>
				<img src="/assets/img/gallery/<?=$gallery->id;?>.jpg" width="40" alt="">
			</td>
			<td>
				<a href="#"><?=$gallery->title;?></a>
			</td>
			<td><?=$gallery->name;?></td>
			<td><?=$gallery->shortDescription;?></td>
			<td class="min-width nowrap"><a href="#" class="btn-alert">delete</a></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php else:?>
<div class="col-sm-12 activity">
	<ul>
		<li>
			<div class="icon red">
				<i class="fa fa-warning"></i>
			</div><!-- /.icon -->
			<div class="content">
				NO GALLERY AVAILABLE </span>.
			</div><!-- /.content -->
		</li>
	</ul>
</div>
<?php endif;?>
<?php $this->load->view("admin/includes/scripts");?>
<script>
$("#gallery-table").DataTable();
</script>
<?php $this->load->view("admin/includes/footer");?>
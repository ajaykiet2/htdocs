<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">Accreditation <span style="color:#999;">(<?=count($accreditations);?>)</span>
	<p class="pull-right">	
		<a href="javascript:void(0)" id="addNewAccreditation" title="Add New Accreditation"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($accreditations)):?>
<table class="table table-simple">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th class="min-width nowrap">Photo</th>
			<th>Title</th>
			<th>Name</th>
			<th>Tagline</th>
			<th>Description</th>
			<th class="min-width nowrap">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($accreditations as $accreditation):?>
		<tr>
			<td class="min-width nowrap"></td>
			<td>
				<img src="/assets/img/accreditation/<?=strtolower($accreditation->title);?>.jpg" width="40" alt="">
			</td>
			<td>
				<a href="#"><?=$accreditation->title;?></a>
			</td>
			<td><?=$accreditation->name;?></td>
			<td><?=$accreditation->tagline;?></td>
			<td><?=$accreditation->description;?></td>
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

<?php $this->load->view("admin/includes/footer");?>
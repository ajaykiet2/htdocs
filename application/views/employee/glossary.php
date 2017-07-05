<h1 class="page-header">GLOSSARY <span style="color:#999;">(<?=count($glossary);?>)</span></h1>
<?php if(!empty($glossary)):?>
<table class="table table-simple" id="glossaryTable">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th>ID</th>
			<th>Title</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
	<?php $i = 1;
		foreach($glossary as $glsry):	
	?>
		<tr>
			<td class="min-width nowrap"></td>
			<td><a href="#"><?=$i;?></a></td>
			<td><a href="#"><?=$glsry->title;?></a></td>
			<td><?=$glsry->description;?></td>
		</tr>
		<?php $i++; endforeach;?>
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
				NO GLOSSARY AVAILABLE </span>.
			</div><!-- /.content -->
		</li>
	</ul>
</div>
<?php endif;?>

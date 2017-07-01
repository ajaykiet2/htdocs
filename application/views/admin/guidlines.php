<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">GUIDLINES <span style="color:#999;">(<?=count($guidlines);?>)</span>
	<p class="pull-right">	
		<a href="/admin/configurations/guidlines/new" title="Add New Guidline"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($guidlines)):?>
<table class="table table-simple" id="guidline-table">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th>ID</th>
			<th>Guidline Title</th>
			<th>Added Date</th>
			<th class="min-width nowrap">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($guidlines as $guidline):?>
		<tr>
			<td class="min-width nowrap"></td>
			<td>
				<a href="#"><?=$guidline->guidlineID;?></a>
			</td>
			<td>
				<a href="/admin/configurations/guidlines/view/<?=$this->encrypt->encode($guidline->guidlineID);?>"><?=$guidline->title;?></a>
			</td>
			<td><?=dateTimeToString($guidline->timeStamp);?></td>
			
			<td class="min-width nowrap">
				<a class="btn-xs btn-secondary fa fa-edit" href="/admin/configurations/guidlines/edit/<?=$this->encrypt->encode($guidline->guidlineID);?>" title="Edit Guidline"></a>
				<a class="btn-secondary btn-xs fa fa-eye" href="/admin/configurations/guidlines/view/<?=$this->encrypt->encode($guidline->guidlineID);?>" title="View Guidline"></a>
				<span class="btn btn-xs fa fa-trash delete-guidline" data-id="<?=$guidline->guidlineID;?>" title="Delete Guidline"></span>
			</td>
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
				NO GUIDLINE AVAILABLE </span>.
			</div><!-- /.content -->
		</li>
	</ul>
</div>
<?php endif;?>
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/guidline.js"></script>
<script>
$("#guidline-table").DataTable();
$(".delete-guidline").on('click',function(){
	var guidline = new $.guidline();
	var guidlineID = $(this).data('id');
	$.confirm({
		icon: "fa fa-question-circle",
		title: 'Confirmation!',
		content: 'Are you sure want to delete',
		type: "blue",
		buttons: {
			ok: {
				text: 'Proceed',
				btnClass: 'btn-secondary',
				action: function () {
					guidline.delete(guidlineID );
				}
			},
			cancel: {
				text: 'Cancel',
				btnClass: 'btn',
				action: function () {
					//close
				},
				
			}
		},
	});
});
</script>

<?php $this->load->view("admin/includes/footer");?>
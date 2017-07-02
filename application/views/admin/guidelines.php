<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">GUIDELINES <span style="color:#999;">(<?=count($guidelines);?>)</span>
	<p class="pull-right">	
		<a href="/admin/configurations/guidelines/new" title="Add New Guidline"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($guidelines)):?>
<table class="table table-simple" id="guidline-table">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th>ID</th>
			<th>Guideline Title</th>
			<th>Added Date</th>
			<th class="min-width nowrap">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($guidelines as $guideline):?>
		<tr>
			<td class="min-width nowrap"></td>
			<td>
				<a href="#"><?=$guideline->guidlineID;?></a>
			</td>
			<td>
				<a href="/admin/configurations/guidelines/view/<?=$this->encrypt->encode($guideline->guidlineID);?>"><?=$guideline->title;?></a>
			</td>
			<td><?=dateTimeToString($guideline->timeStamp);?></td>
			
			<td class="min-width nowrap">
				<a class="btn-xs btn-secondary fa fa-edit" href="/admin/configurations/guidelines/edit/<?=$this->encrypt->encode($guideline->guidlineID);?>" title="Edit Guideline"></a>
				<a class="btn-secondary btn-xs fa fa-eye" href="/admin/configurations/guidelines/view/<?=$this->encrypt->encode($guideline->guidlineID);?>" title="View Guideline"></a>
				<span class="btn btn-xs fa fa-trash delete-guidline" data-id="<?=$guideline->guidlineID;?>" title="Delete Guideline"></span>
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
				NO GUIDELINE AVAILABLE </span>.
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
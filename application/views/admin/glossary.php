<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">GLOSSARY <span style="color:#999;">(<?=count($glossary);?>)</span>
	<p class="pull-right">	
		<a href="javascript:void(0)" id="addNewGlossary" title="Add New Glossary"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($glossary)):?>
<table class="table table-simple" id="glossaryTable">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th>ID</th>
			<th>Title</th>
			<th>Description</th>
			<th class="min-width nowrap">Action</th>
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
			<td class="min-width nowrap"><span class="fa fa-trash btn btn-xs deleteGlossary" data-id="<?=$glsry->glossaryID;?>" title="Delete this glossary item"></span></td>
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
<div class="modal fade" id="add_new_glossary" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="/admin/ajax/glossaryAction" id="newGlossaryForm" method="POST" class="form-horizontal">
				<input type="hidden" name="action" value="addNew">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Add New Glossary Item</h3>
				</div>
				<div class="modal-body form">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-12">
                               <input type="text" name="title" placeholder="Title" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea name="description" placeholder="Description" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div> 
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn-secondary">Save</button>
					<button class="btn" data-dismiss="modal">Cancel</button>
				</div>
			 </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/glossary.js"></script>
<?php $this->load->view("admin/includes/footer");?>
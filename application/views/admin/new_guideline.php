<?php $this->load->view("admin/includes/header");?>
<?php 
$guideline = (isset($guideline)) ? $guideline : (object)array(
	'guidlineID' => "",
	'title' => "",
	'content' => '',
);
?>

<h2 class="page-header">GUIDELINE MANAGEMENT
	<p class="pull-right">
		<a href="/admin/configurations/guidelines" title="Back to guidelines"><i class="btn fa fa-long-arrow-left"></i></a>  
	</p>
</h2>
<form id="newGuidlineForm">
	<input type="hidden" name="guidlineID" value="<?=$guideline->guidlineID;?>">
	<div class="box row">
		<div class="form-group col-sm-12 col-xs-12">
			<label> Guideline Title</label>
			<input class="form-control" name="title" type="text" placeholder="Guideline Title" value="<?=$guideline->title;?>">
		</div>
		
	</div>
	<h2 class="page-header">CONTENTS</h2>  
	<textarea class="text-small" name="content" id="content"><?=$guideline->content;?></textarea><hr>
	<div class="center">
		<span class="btn btn-xl" id="saveNewGuidline" data-action="<?=$action;?>">Save Your Guideline<small>You can edit it anytime</small></span>
	</div>
</form>

<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/guidline.js"></script>
<?php $this->load->view("admin/includes/footer");?>
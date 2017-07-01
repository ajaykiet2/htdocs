<?php $this->load->view("admin/includes/header");?>
<?php 
$guidline = (isset($guidline)) ? $guidline : (object)array(
	'guidlineID' => "",
	'title' => "",
	'content' => '',
);
?>

<h2 class="page-header">GUIDLINE MANAGEMENT
	<p class="pull-right">
		<a href="/admin/configurations/guidlines" title="Back to guidlines"><i class="btn fa fa-long-arrow-left"></i></a>  
	</p>
</h2>
<form id="newGuidlineForm">
	<input type="hidden" name="guidlineID" value="<?=$guidline->guidlineID;?>">
	<div class="box row">
		<div class="form-group col-sm-12 col-xs-12">
			<label> Guidline Title</label>
			<input class="form-control" name="title" type="text" placeholder="Guidline Title" value="<?=$guidline->title;?>">
		</div>
		
	</div>
	<h2 class="page-header">CONTENTS</h2>  
	<textarea class="text-small" name="content" id="content"><?=$guidline->content;?></textarea><hr>
	<div class="center">
		<span class="btn btn-xl" id="saveNewGuidline" data-action="<?=$action;?>">Save Your Guidline<small>You can edit it anytime</small></span>
	</div>
</form>

<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/guidline.js"></script>
<?php $this->load->view("admin/includes/footer");?>
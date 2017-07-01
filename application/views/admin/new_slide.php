<?php $this->load->view("admin/includes/header");?>
<?php 
$slideData = (isset($slideInfo)) ? $slideInfo : (object)array(
	'slideID' => "",
	'title' => "",
	'sequence' => "",
	'content' => '',
);
?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12">
		<div class="module">
			<div class="text-center module-content vertical-align">
				<h4>SLIDE FOR "<?=strtoupper($chepterInfo->title);?>"</h4>
			</div><!-- /.module-content -->
		</div><!--- /.module -->
	</div>
</div>

<h2 class="page-header">SLIDE INFORMATION
	<p class="pull-right">
		<a href="/admin/courses/<?=$this->encrypt->encode($chepterInfo->courseID);?>/chepter/<?=$this->encrypt->encode($chepterInfo->chepterID);?>" title="Back to chepter detail"><i class="btn fa fa-long-arrow-left"></i></a>  
	</p>
</h2>
<form id="newSlideForm">
	<input type="hidden" name="courseID" value="<?=$chepterInfo->courseID;?>">
	<input type="hidden" name="chepterID" value="<?=$chepterInfo->chepterID;?>">
	<input type="hidden" name="slideID" value="<?=$slideData->slideID;?>">
	<div class="box row">
		<div class="form-group col-sm-6 col-xs-12">
			<input class="form-control" name="title" type="text" placeholder="Slide Title" value="<?=$slideData->title;?>">
		</div>
		<div class="form-group col-sm-6 col-xs-12">
			<input class="form-control" name="sequence" type="number" min="0" max="500" placeholder="Slide Sequence" value="<?=$slideData->sequence;?>">
		</div>
	</div>
	<h2 class="page-header">CONTENTS</h2>  
	<textarea class="text-small" name="content" id="content"><?=$slideData->content;?></textarea><hr>
	<div class="center">
		<span class="btn btn-xl" id="saveNewSlide" data-action="<?=$action;?>">Save Your Slide<small>You can edit it anytime</small></span>
	</div>
</form>

<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/slide.js"></script>
<?php $this->load->view("admin/includes/footer");?>
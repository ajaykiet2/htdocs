<?php $this->load->view("admin/includes/header");?>
<h2 class="page-header">MODULE INFORMATION
	<p class="pull-right">
		<a href="/admin/courses/<?=$this->encrypt->encode($chepterInfo->courseID);?>/chepter/<?=$this->encrypt->encode($chepterInfo->chepterID);?>" title="Back to chepter detail"><i class="btn fa fa-long-arrow-left"></i></a>  
		<a href="/admin/courses/<?=$this->encrypt->encode($chepterInfo->courseID);?>/chepter/<?=$this->encrypt->encode($chepterInfo->chepterID);?>/slide/edit/<?=$this->encrypt->encode($slideInfo->slideID);?>" title="Edit This Slide"><i class="btn-secondary fa fa-pencil"></i></a>  
	</p>
</h2>
<div class="row">
	<div class="col-sm-4 col-md-4 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Chepter
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($chepterInfo->title);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-4 col-md-4 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
               Module Title
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($slideInfo->title);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-4 col-md-4 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Sequence
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($slideInfo->sequence);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
</div>

<div class="box fr-view" id="slide-content">
	<?=$slideInfo->content;?>
</div>

<?php $this->load->view("admin/includes/scripts");?>
<?php $this->load->view("admin/includes/footer");?>
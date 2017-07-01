<?php $this->load->view("admin/includes/header");?>
<h2 class="page-header">GUIDLINE DETAIL
	<p class="pull-right">
		<a href="/admin/configurations/guidlines" title="Back To Guidline Listing"><i class="btn fa fa-long-arrow-left"></i></a>  
		<a href="/admin/configurations/guidlines/edit/<?=$this->encrypt->encode($guidline->guidlineID);?>" title="Update This Guidline"><i class="btn-secondary fa fa-pencil"></i></a>  
	</p>
</h2>
<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Title: 
            </div>
            <div class="module-content vertical-align">
                <span><?=strtoupper($guidline->title);?></span>
            </div>
        </div>
    </div>
</div>

<div class="box fr-view" id="slide-content">
	<?=$guidline->content;?>
</div>

<?php $this->load->view("admin/includes/scripts");?>
<?php $this->load->view("admin/includes/footer");?>
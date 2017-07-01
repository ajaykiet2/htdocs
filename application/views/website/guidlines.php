<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge">
	<div class="container">
		<span class="header-edge-title">Guidlines to follow</span>
		<!--<ol class="breadcrumb pull-right">
			<?php foreach($env['breadcrumb'] as $bradcrumb):?>
			<li class="<?=$bradcrumb->class;?>"><a href="<?=$bradcrumb->link;?>"><?=$bradcrumb->name;?></a></li>
			<?php endforeach;?>
		</ol>-->
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9 fr-view">
			<h1 class="page-header">Guidlines</h1>
			<?php if(!empty($guidlines)):?>
			<div class="panel-group" id="guidlines">
			<?php 
				$i = 0;
				foreach($guidlines as $guidline):				
					$collapse = ($i == 0) ? 'in' : '';
			?>
			<div class="panel" style="border-top:3px solid #EC407A;border-radius:0;">
				<div class="panel-heading accordion-toggle" data-toggle="collapse" data-parent="#guidlines" data-target="#guidline_<?=$guidline->guidlineID;?>" area-expanded="true">
					 <h2 class="panel-title"><?=$guidline->title;?></h2>
				</div>
				<div id="guidline_<?=$guidline->guidlineID;?>" class="panel-collapse collapse <?=$collapse;?>">
					<div class="panel-body"><?=$guidline->content;?></div>
				</div>
			</div>
			<?php $i++; endforeach;?>
			</div>
			<?php else: ?>
			<div class="row">
				<div class="col-sm-12 activity">
					<ul>
						<li>
							<div class="icon red">
								<i class="fa fa-warning"></i>
							</div>
							<div class="content">
								<b>NO GUIDLINES AVAILABLE. THIS FACILITY WILL BE AVAILABLE SOON!</b>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<?php endif;?>
		</div>
		<div class="sidebar col-sm-4 col-md-3">
			<?php $this->load->view("website/includes/widgets/enquire");?>
			<?php $this->load->view("website/includes/widgets/accreditations");?>
			<script>
			
			</script>
		</div>
	</div>
</div>
<?php $this->load->view('website/includes/footers/navigation');?>
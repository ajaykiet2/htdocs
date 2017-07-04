<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge">
	<div class="container">
		<span class="header-edge-title">Guidelines to follow</span>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9 fr-view">
			<h1 class="page-header">Guidelines</h1>
			<?php if(!empty($guidelines)):?>
			<div class="panel-group" id="guidelines">
			<?php 
				$i = 0;
				foreach($guidelines as $guideline):				
					$collapse = ($i == 0) ? 'in' : '';
			?>
			<div class="panel" style="border-top:3px solid #EC407A;border-radius:0;">
				<div class="panel-heading accordion-toggle" data-toggle="collapse" data-parent="#guidelines" data-target="#guideline_<?=$guideline->guidlineID;?>" area-expanded="true">
					 <h2 class="panel-title"><?=$guideline->title;?></h2>
				</div>
				<div id="guideline_<?=$guideline->guidlineID;?>" class="panel-collapse collapse <?=$collapse;?>">
					<div class="panel-body"><?=$guideline->content;?></div>
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
								<b>NO GUIDELINE AVAILABLE. THIS FACILITY WILL BE AVAILABLE SOON!</b>
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
		</div>
	</div>
</div>
<?php $this->load->view('website/includes/footers/navigation');?>
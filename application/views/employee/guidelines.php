<h1 class="page-header">Guidelines</h1>
<?php if(!empty($guidelines)):?>
<div class="panel-group" id="guidlines">
<?php 
	$i = 0;
	foreach($guidelines as $guideline):				
		$collapse = ($i == 0) ? 'in' : '';
?>
<div class="panel fr-view" style="border-top:3px solid #EC407A;border-radius:0;">
	<div class="panel-heading accordion-toggle" data-toggle="collapse" data-parent="#guidlines" data-target="#guidline_<?=$guideline->guidlineID;?>" area-expanded="true">
		 <h2 class="panel-title" style="cursor:pointer" title="Click to open/close"><?=$guideline->title;?></h2>
	</div>
	<div id="guidline_<?=$guideline->guidlineID;?>" class="panel-collapse collapse <?=$collapse;?>">
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
					<b>NO GUIDELINES AVAILABLE. THIS FACILITY WILL BE AVAILABLE SOON!</b>
				</div>
			</li>
		</ul>
	</div>
</div>
<?php endif;?>

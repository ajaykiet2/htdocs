<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge"><div class="container">Our Courses</div></div>
<!-- end:header -->
<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
			<h1 class="page-header">Course Listing</h1>
			<?php if(is_array($courses)):?>
			<div class="row">
			<?php foreach($courses as $course):?>
				<div class="col-sm-6 col-xs-6 col-md-4">
					<div class="agent-medium">
						<div class="agent-medium-content">
							<h5 class="agent-medium-title"><i class="fa fa-book"></i> <?=$course->title;?></h5>
							<hr>
							<ul>
								<li><i class="fa fa-tags"></i> <?=getPart($course->description, 130);?></li>
							</ul>
						</div><!-- /.agent-medium-content -->
					</div><!-- /.agent-medium -->
				</div>
			<?php endforeach; ?>
			</div><!-- /.row -->
			<div class="center">
				<ul class="pagination">
					<?php $pages = ceil($pagination->total/$pagination->limit);	?>
					<?php if($pagination->pageNum <= 1):?>
					<li class="disabled"><a><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
					<?php else:?>
					<li><a href="/courses/page/<?=($pagination->pageNum-1);?>"><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
					<?php endif;?>
					
					<?php for($i=1;$i <= $pages; $i++): ?>
						<?php if($i == $pagination->pageNum):?>
						<li class="active"><a><?=$i;?></a></li>
						<?php else: ?>
						<li><a href="/courses/page/<?=$i;?>"><?=$i;?></a></li>
						<?php endif;?>
					<?php endfor;?>	
					
					<?php if($pages == $pagination->pageNum):?>
					<li class="disabled"><a><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
					<?php else:?>
					<li><a href="/courses/page/<?=($pagination->pageNum+1)?>"><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
					<?php endif;?>
				</ul>
			</div><!-- /.center -->
			<?php else: ?>
				<div class="faq" id="faq-container">
					<div class="faq-item-question">
						<h2 class="text-center">NO COURSE AVAILABLE</h2>
					</div><!-- /.faq-item-question -->
				</div><!-- /.faq Container -->
			<?php endif; ?>
			<div class="row">
				<div class="col-sm-6"><?php $this->load->view("website/includes/widgets/accreditations");?></div>
				<div class="col-sm-6"><?php $this->load->view("website/includes/widgets/advisory_board");?></div>
			</div>
			
        </div>
		<div class="sidebar col-sm-4 col-md-3">			
			<!-- start:Best Agents -->
			<?php $this->load->view("website/includes/widgets/enquire");?>
			<?php $this->load->view("website/includes/widgets/contact");?>
		</div><!-- /.sidebar -->
	</div><!-- /.row -->
</div><!-- /.container -->

<!-- start:footer -->
<?php $this->load->view('website/includes/footers/navigation');?>
<!-- end:footer -->
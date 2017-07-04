<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge"><div class="container">Important Questions</div></div>
<!-- end:header -->

<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
			<h1 class="page-header">Important Questions</h1>
			<?php if(is_array($qadata)):?>
			<div class="faq" id="faq-container">
				<?php foreach($qadata as $faq):?>
				<div class="faq-item">
					<div class="faq-item-question">
						<h2><?=$faq->question;?></h2>
					</div>
					<div class="faq-item-answer">
						<p><?=$faq->answer;?></p>
					</div><!-- /.faq-item-answer -->
				</div><!-- /.faq-item -->
				<?php endforeach;?>
			</div>
			<div class="center">
				<ul class="pagination">
					<?php $pages = ceil($pagination->total/$pagination->limit);	?>
					<?php if($pagination->pageNum <= 1):?>
					<li class="disabled"><a><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
					<?php else:?>
					<li><a href="/importantQuestion/<?=($pagination->pageNum-1);?>"><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
					<?php endif;?>
					
					<?php for($i=1;$i <= $pages; $i++): ?>
						<?php if($i == $pagination->pageNum):?>
						<li class="active"><a><?=$i;?></a></li>
						<?php else: ?>
						<li><a href="/importantQuestion/<?=$i;?>"><?=$i;?></a></li>
						<?php endif;?>
					<?php endfor;?>	
					
					<?php if($pages == $pagination->pageNum):?>
					<li class="disabled"><a><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
					<?php else:?>
					<li><a href="/importantQuestion/<?=($pagination->pageNum+1)?>"><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
					<?php endif;?>
				</ul>
			</div><!-- /.center -->
			<?php else:?>
			<div class="faq" id="faq-container">
				<div class="faq-item-question">
					<h2 class="text-center">NO QUESTIONS AVAILABLE</h2>
				</div><!-- /.faq-item-question -->
			</div><!-- /.faq Container -->
			<?php endif;?>
        </div>

		<div class="sidebar col-sm-4 col-md-3">			
			<!-- start:Best Agents -->
			<?php $this->load->view("website/includes/widgets/accreditations");?>
			
			<!-- start:Recent Property -->	
			<?php $this->load->view("website/includes/widgets/advisory_board");?>
			
				</div><!-- /.sidebar -->
			</div><!-- /.row -->
		</div><!-- /.container -->

<?php $this->load->view('website/includes/widgets/social_links');?>

<!-- end:contents -->

<!-- start:footer -->
<?php $this->load->view('website/includes/footers/navigation');?>
<!-- end:footer -->
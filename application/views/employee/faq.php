<h1 class="page-header">FAQ</h1>
	<?php if(is_array($qadata)):?>
	<div class="faq" id="faq-container">
		<?php foreach($qadata as $faq):?>
		<div class="faq-item">
			<div class="faq-item-question">
				<h4><?=$faq->question;?></h4>
			</div><!-- /.faq-item-question -->
			<div class="faq-item-answer">
				<p><?=$faq->answer;?></p>
			</div><!-- /.faq-item-answer -->
			<div class="faq-item-meta">
				Was this answer helpful?
				<span class="rate">
					<a href="#">Yes</a><span class="separator">/</span><a href="#">No</a>
				</span><!-- /.rate -->
			</div><!-- /.faq-item-meta -->
		</div><!-- /.faq-item -->
		<?php endforeach;?>
	</div><!-- /.faq Container -->

	<div class="center">
		<ul class="pagination">
			<?php $pages = ceil($pagination->total/$pagination->limit);	?>
			<?php if($pagination->pageNum <= 1):?>
			<li class="disabled"><a><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
			<?php else:?>
			<li><a class="hyperlink" href="/employee/faq/<?=($pagination->pageNum-1);?>"><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
			<?php endif;?>
			
			<?php for($i=1;$i <= $pages; $i++): ?>
				<?php if($i == $pagination->pageNum):?>
				<li class="active"><a><?=$i;?></a></li>
				<?php else: ?>
				<li><a class="hyperlink" href="/employee/faq/<?=$i;?>"><?=$i;?></a></li>
				<?php endif;?>
			<?php endfor;?>				
			<?php if($pages == $pagination->pageNum):?>
			<li class="disabled"><a><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
			<?php else:?>
			<li><a class="hyperlink" href="/employee/faq/<?=($pagination->pageNum+1)?>"><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
			<?php endif;?>
		</ul>
	</div><!-- /.center -->
	<?php else:?>
	<div class="faq" id="faq-container">
		<div class="faq-item-question">
			<h2 class="text-center">NO FAQ AVAILABLE FOR THIS INDEX</h2>
		</div><!-- /.faq-item-question -->
	</div><!-- /.faq Container -->
	<?php endif;?>
</div>

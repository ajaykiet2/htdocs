<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge"><div class="container">Gallery</div></div>
<!-- end:header -->

<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
			<h1 class="page-header">Our Gallery</h1>
			<?php if(is_array($galleries)):?>
				<div class="row">
					<?php foreach($galleries as $gallery):?>
						<div class="col-sm-6 col-md-4 col-lg-3">
							<div class="promo blue">
								<a href="/gallery/<?=$gallery->id;?>">
								<div class="promo-content"><span class="promo-subtitle"><?=$gallery->name;?></span></div>
									<span class="promo-image">
										<span class="promo-image-inner">
											<img class="img-responsive" src="/assets/img/gallery/thumbs/gallery_x300_<?=$gallery->image;?>" alt="<?=$gallery->name?>">
										</span>
									</span><!-- /.promo-image -->
								</a>
							</div><!-- /.promo -->
						</div>
					<?php endforeach;?>
				</div><!-- /.row -->
				<div class="center">
					<ul class="pagination">
						<?php $pages = ceil($pagination->total/$pagination->limit);	?>
						<?php if($pagination->pageNum <= 1):?>
						<li class="disabled"><a><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
						<?php else:?>
						<li><a href="/gallery/page/<?=($pagination->pageNum-1);?>"><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
						<?php endif;?>
						
						<?php for($i=1;$i <= $pages; $i++): ?>
							<?php if($i == $pagination->pageNum):?>
							<li class="active"><a><?=$i;?></a></li>
							<?php else: ?>
							<li><a href="/gallery/page/<?=$i;?>"><?=$i;?></a></li>
							<?php endif;?>
						<?php endfor;?>	
						
						<?php if($pages == $pagination->pageNum):?>
						<li class="disabled"><a><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
						<?php else:?>
						<li><a href="/gallery/page/<?=($pagination->pageNum+1)?>"><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
						<?php endif;?>
					</ul>
				</div><!-- /.center -->
			<?php else: ?>
				<div class="faq" id="faq-container">
					<div class="faq-item-question">
						<h2 class="text-center">NO GALLERY AVAILABLE FOR THIS INDEX</h2>
					</div><!-- /.faq-item-question -->
				</div><!-- /.faq Container -->
			<?php endif; ?>
		</div>
		<div class="sidebar col-sm-4 col-md-3">			
			<!-- start:Best Agents -->
			<?php $this->load->view("website/includes/widgets/accreditations");?>
			<?php $this->load->view("website/includes/widgets/advisory_board");?>
		</div><!-- /.sidebar -->
	</div><!-- /.row -->
</div><!-- /.container -->
<!-- start:footer -->
<?php $this->load->view('website/includes/footers/navigation');?>
<!-- end:footer -->
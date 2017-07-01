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
						<div class="col-sm-6 col-md-4">
							<div class="property-box">
								<div class="property-box-content">
									<div class="property-box-meta">
										<div class="property-box-meta-item">
											<span><?=$gallery->name?></span>
										</div>
									</div>
								</div>
								<div class="property-box-image">
									<a href="/gallery/<?=$gallery->id;?>">
										<img src="/assets/img/gallery/<?=$gallery->id;?>.jpg" alt="<?=$gallery->name?>">
										<span class="property-box-excerpt">
											<?=$gallery->shortDescription;?>
										</span>
									</a>
								</div>
								<div class="property-box-bottom">
									<div class="property-box-price">
										<?=$gallery->title;?>
									</div>

									<a href="/gallery/<?=$gallery->id;?>" class="property-box-view">
										View Detail
									</a>
								</div>
							</div>
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
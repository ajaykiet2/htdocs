<?php $this->load->view('website/includes/headers/simple_minimal');?>
<div class="header-edge"><div class="container">Our Accreditations</div></div>
<!-- end:header -->

<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
			<h1 class="page-header">Our Accreditations</h1>
			<?php if(is_array($accreditations)):?>
				<div class="row">
					<?php foreach($accreditations as $accreditation):?>
						<div class="col-sm-6 col-md-4">
							<div class="property-box">
								<div class="property-box-content">
									<div class="property-box-meta">
										<div class="property-box-meta-item">
											<span><?=$accreditation->title;?></span>
										</div><!-- /.property-box-meta-item -->
									</div><!-- /.property-box-meta -->
								</div><!-- /.property-box-content -->
								<div class="property-box-image">
									<a href="/accreditation/<?=$accreditation->id;?>">
										<img src="/assets/img/accreditation/<?=strtolower($accreditation->title);?>.jpg" alt="<?=$accreditation->title;?>">
										<span class="property-box-excerpt"></span>
									</a>
								</div><!-- /.property-image -->
								<div class="property-box-bottom">
									<div class="property-box-price">
										<span><?=$accreditation->tagline?></span>
									</div><!-- /.property-box-price -->
								</div><!-- /.property-box-bottom -->
							</div><!-- /.property-box -->
						</div>
					<?php endforeach;?>
				</div><!-- /.row -->
				<div class="center">
					<ul class="pagination">
						<?php $pages = ceil($pagination->total/$pagination->limit);	?>
						<?php if($pagination->pageNum <= 1):?>
						<li class="disabled"><a><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
						<?php else:?>
						<li><a href="/accreditations/<?=($pagination->pageNum-1);?>"><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
						<?php endif;?>
						
						<?php for($i=1;$i <= $pages; $i++): ?>
							<?php if($i == $pagination->pageNum):?>
							<li class="active"><a><?=$i;?></a></li>
							<?php else: ?>
							<li><a href="/accreditations/<?=$i;?>"><?=$i;?></a></li>
							<?php endif;?>
						<?php endfor;?>	
						
						<?php if($pages == $pagination->pageNum):?>
						<li class="disabled"><a><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
						<?php else:?>
						<li><a href="/accreditations/<?=($pagination->pageNum+1)?>"><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
						<?php endif;?>
					</ul>
				</div><!-- /.center -->
			<?php else: ?>
				<div class="faq" id="faq-container">
					<div class="faq-item-question">
						<h2 class="text-center">NO ACCREDITATION AVAILABLE</h2>
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
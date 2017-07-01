<?php $this->load->view('website/includes/headers/simple_minimal');?>
<?php $this->load->view('website/includes/headers/slider');?>
<!-- end:header -->

<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="content col-sm-8 col-md-9">
			<h1 class="page-header">About Us</h1>
			<p class="text mb30">
				HRD Foundation – India was set up in Delhi as early as 1998 to cater to the training needs of the Banking, Financial Services and Insurance (BFSI) Industries.
				<br>
				We have served Life Insurance Corporation of India, National Insurance Company Ltd., Oriental Insurance Company Ltd., Oriental Bank of Commerce, Punjab National Bank, J&K Bank and a host of other financial institutions.
				<br>
				It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. 
				The Foundation is a non-profit body registered as a TRUST.
			</p>
			
			<h1 class="page-header">Accreditations</h1>	
			<?php foreach($env['accreditations'] as $accreditation):?>
			<div class="row">
				<div class="feature col-sm-12">
						<a href="/accreditation/<?=$accreditation->id;?>">
							<img src="assets/img/accreditation/<?=$accreditation->image;?>" alt="" class="pull-left img img-rounded img-thumbnail img-responsive" style="height:100px;margin:0px 10px 15px 0px">
						</a>
					
					<h3><?=$accreditation->name;?></h3>

					<p><?=$accreditation->description;?></p>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<?php endforeach;?>
		</div>

		<div class="sidebar col-sm-4 col-md-3">			
			<!-- start:Best Agents -->
			<?php $this->load->view("website/includes/widgets/enquire");?>
			
			<!-- start:Recent Property -->	
			<?php $this->load->view("website/includes/widgets/advisory_board");?>
			
			<!-- start:Recent Property -->	
			<?php $this->load->view("website/includes/widgets/contact");?>
			
				</div><!-- /.sidebar -->
			</div><!-- /.row -->
		</div><!-- /.container -->
<?php $this->load->view('website/includes/widgets/social_links');?>

<!-- end:contents -->

<!-- start:footer -->
<?php $this->load->view('website/includes/footers/navigation');?>
<!-- end:footer -->
<?php $this->load->view('website/includes/headers/simple_minimal');?>
<?php $this->load->view('website/includes/headers/slider');?>
<!-- end:header -->
<!-- start:contents -->
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<center><img src="/assets/img/icons/aboutus.png" class="img-responsive" width="200px"></center>
			<h1 class="text-center">About Us</h1>
			<p class="text-center mb30">
				HRD Foundation – India was set up in Delhi as early as 1998 to cater to the training needs of the Banking, Financial Services and Insurance (BFSI) Industries.
			
				We have served Life Insurance Corporation of India, National Insurance Company Ltd., Oriental Insurance Company Ltd., Oriental Bank of Commerce, Punjab National Bank, J&K Bank and a host of other financial institutions.
				
				It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. 
				The Foundation is a non-profit body registered as a TRUST.
			</p>
		</div>
		<div class="content col-sm-12 col-md-12">
			<?php foreach($env['accreditations'] as $accreditation):?>
				<div class="feature col-sm-4">
					<a href="/accreditation/<?=$accreditation->id;?>">
						<img src="assets/img/accreditation/<?=$accreditation->image;?>" alt="" class="pull-left img img-rounded img-thumbnail img-responsive" style="height:100px;margin:0px 10px 15px 0px">
					</a>
					<h3><?=$accreditation->name;?></h3>
					<p><?=$accreditation->description;?></p>
				</div>			
			<?php endforeach;?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-md-4">	
			<?php $this->load->view("website/includes/widgets/enquire");?>
		</div>
		<div class="col-sm-4 col-md-4">
			<?php $this->load->view("website/includes/widgets/advisory_board");?>
		</div>
		<div class="col-sm-4 col-md-4">
			<?php $this->load->view("website/includes/widgets/contact");?>
		</div>
	</div><!-- /.row -->
</div><!-- /.container -->
<?php $this->load->view('website/includes/widgets/social_links');?>

<!-- end:contents -->

<!-- start:footer -->
<?php $this->load->view('website/includes/footers/navigation');?>
<!-- end:footer -->
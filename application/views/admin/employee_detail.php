<?php $this->load->view("admin/includes/header");?>
<h3 class="page-header">CANDIDATE DETAIL</h3>
<div class="row">
	<div class="col-sm-12">
        <div class="property-valuation">
            <div class="row">
                <div class="col-sm-4 col-xs-6">
                    <ul class="property-valuation-keys text-right">
                        <li>Name</li>
                        <li>Email</li>
                        <li>Mobile</li>
                        <li>Address</li>
                        <li>PAN Card</li>
                        <li>Aadhaar Card</li>
                        <li>Company</li>
                    </ul>
                </div>
				<div class="col-sm-8 col-xs-6">
                    <ul class="property-valuation-keys">
                        <li><?=$employee->name;?></li>
                        <li><?=$employee->email;?></li>
                        <li><?=$employee->mobile;?></li>
                        <li><?=$employee->address;?></li>
                        <li><?=$employee->panCard;?></li>
                        <li><?=$employee->aadharCard;?></li>
                        <li><?=$employee->companyName;?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<h3 class="page-header"><?=strtoupper($employee->name);?> 
	<span style="color:#999;">COURSES</span>
	<p class="pull-right">
		<a href="/admin/employee" title="Back to listing"><i class="btn fa fa-long-arrow-left"></i></a> 
	</p>
</h3>
<div class="row">
	<?php if(!empty($courses)):
		foreach($courses as $course):?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<div class="man">
					<div class="man-content">
						<div class="man-title">
							<div class="row">
								<h3 class="col-xs-9 text-left"><?=strtoupper($course->title);?></h3>
								<h3 class="col-xs-3 text-right"><?=$course->maxDays;?>(Days)</h3>
							</div>
							<small><?=$course->departmentName;?></small>
						</div>
						<ul>
							<li>Time Spent: <a href="#"><?=$course->timeSpent;?></a></li>
							<li>Status: <a href="#"><?=ucfirst($course->status);?></a></li>
							<li>Duration: <a href="#"><?=timeToDecimal($course->duration);?> Hours</a></li>
						</ul>
					</div>
					<center>
						<a href="/admin/courses/detail/<?=$this->encrypt->encode($course->courseID);?>" title="View Course"><i class="btn btn-xs fa fa-long-arrow-right"></i></a>
					</center>
					
				</div>
			</div><!-- /.col-* -->
		<?php endforeach;
	else:?>
	<div class="col-sm-12 activity">
		<ul>
			<li>
				<div class="icon red">
					<i class="fa fa-warning"></i>
				</div><!-- /.icon -->
				<div class="content">
					NO COURSE AVAILABLE FOR <span style="color:#999;"><?=strtoupper($employee->name);?></span>.
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
	<?php endif;?>
</div>
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/company.js"></script>

<?php $this->load->view("admin/includes/footer");?>
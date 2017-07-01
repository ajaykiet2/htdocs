<?php $this->load->view("admin/includes/header");?>
<input type="hidden" id="globalCompanyID" value="<?=$companyInfo->companyID;?>">
<input type="hidden" id="globalCompanyName" value="<?=$companyInfo->name;?>">
<h3 class="page-header">COMPANY DETAIL</span></h3>
<div class="row">
	<div class="col-sm-6 col-md-6 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Name
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($companyInfo->name);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
    <div class="col-sm-6 col-md-6 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Contact Name
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($companyInfo->contactName);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-6 col-md-6 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Contact Mobile
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($companyInfo->contactMobile);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-6 col-md-6 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Contact Email
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($companyInfo->contactEmail);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
</div>
<h3 class="page-header"><?=strtoupper($companyInfo->name);?> 
	<span style="color:#999;">COURSES</span>
	<p class="pull-right">
		<a href="/admin/company" title="Back to listing"><i class="btn fa fa-long-arrow-left"></i></a>  
		<a href="javascript:void(0)" id="linkCourse" title="Link Other Course"><i class="btn-secondary fa fa-link"></i></a> 
	</p>
</h3>
<div class="row">
	<?php if(!empty($courses)):
		foreach($courses as $course):?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<div class="man">
					<div class="man-content">
						<div class="man-title">
							<h3><?=strtoupper($course->title);?></h3>
							<small><?=$course->departmentName;?></small>
						</div>
						<ul>
							<li>Duration: <a href="#"><?=timeToDecimal($course->duration);?> Hours</a></li>
							<li>Max Days: <?=$course->maxDays;?> Days</li>
						</ul>
					</div>
					
					<span class="pull-right">
						<a href="javascript:void(0)"class="unlinkCourse" data-id="<?=$course->courseID;?>" title="Unlink Course"><i class="btn btn-xs fa fa-unlink"></i></a> 
						<a href="/admin/courses/detail/<?=$this->encrypt->encode($course->courseID);?>" title="View Detail"><i class="btn-secondary btn-xs fa fa-long-arrow-right"></i></a>
					</span>
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
					NO COURSE AVAILABLE FOR <span style="color:#999;"><?=strtoupper($companyInfo->name);?></span>.
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
	<?php endif;?>
</div>
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/company.js"></script>
<script>
$(document).ready(function(){
	var company = new $.company();
	company.init();
});

</script>

<!-- Bootstrap modal -->

<div class="modal fade" id="link_new_course" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Link Existing Course</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="courseLinkForm" class="form-horizontal">
                    <input type="hidden" value="" name="companyID"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <h5 class="control-label col-md-3">Select Course</h5>
                            <div class="col-md-9">
                                <select name="courseID" class="form-control">
									<option value="">courses</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="linkCourseBtn" class="btn-secondary">Link</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view("admin/includes/footer");?>
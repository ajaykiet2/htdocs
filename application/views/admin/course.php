<?php $this->load->view("admin/includes/header");?>
<?php 	$totleCourses = isset($pagination) ? $pagination->total : 0; ?>
<h1 class="page-header">Courses <span style="color:#999;">(<?=$totleCourses;?>)</span>
	<p class="pull-right">	
		<a href="javascript:void(0)" id="createNewCourse" title="Create New Course"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<div class="row" id="courseContainer">
<?php if(!empty($courses)): foreach($courses as $course):?>
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<div class="man">
			<div class="man-content">
				<div class="man-title">
					<h3><?=strtoupper($course->title);?></h3>
					<small><?=$course->departmentName;?></small>
				</div>
				<ul>
					<li>Duration: <a href="javascript:void(0)"><?=timeToDecimal($course->duration);?> Hours.</a></li>
					<li>Max Days: <?=$course->maxDays;?> Days</li>
				</ul>
			</div>
			<span class="pull-right">
				<a href="javascript:void(0)" class="updateCourse" data-id="<?=$course->courseID;?>" title="Update Course"><i class="btn-secondary btn-xs fa fa-edit"></i></a>
				<a href="javascript:void(0)"class="deleteCourse" data-id="<?=$course->courseID;?>" title="Delete Course"><i class="btn btn-xs fa fa-trash"></i></a> 
				<a href="/admin/courses/detail/<?=$this->encrypt->encode($course->courseID);?>"class="viewCourse" data-id="<?=$course->courseID;?>" title="View Detail"><i class="btn-secondary btn-xs fa fa-long-arrow-right"></i></a> 
			</span>
		</div>
	</div><!-- /.col-* -->
<?php endforeach;else:?>
	<div class="col-sm-12 activity">
		<ul>
			<li>
				<div class="icon red">
					<i class="fa fa-warning"></i>
				</div><!-- /.icon -->
				<div class="content">
					NO COURSE AVAILABLE </span>.
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
	<?php endif;?>
</div>
<?php if(!empty($courses)):
		if(isset($pagination)):?>
<div class="center">
	<ul class="pagination">
		<?php $pages = ceil($pagination->total/$pagination->limit);	?>
		<?php if($pagination->pageNum <= 1):?>
		<li class="disabled"><a><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
		<?php else:?>
		<li><a href="/admin/courses/<?=($pagination->pageNum-1);?>"><span class="fa fa-angle-double-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a></li>
		<?php endif;?>
		
		<?php for($i=1;$i <= $pages; $i++): ?>
			<?php if($i == $pagination->pageNum):?>
			<li class="active"><a><?=$i;?></a></li>
			<?php else: ?>
			<li><a href="/admin/courses/<?=$i;?>"><?=$i;?></a></li>
			<?php endif;?>
		<?php endfor;?>	
		
		<?php if($pages == $pagination->pageNum):?>
		<li class="disabled"><a><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
		<?php else:?>
		<li><a href="/admin/courses/<?=($pagination->pageNum+1)?>"><span class="fa fa-angle-double-right" aria-hidden="true"></span><span class="sr-only">Next</span></a></li>
		<?php endif;?>
	</ul>
</div><!-- /.center -->
<?php endif;?> 
<?php endif;?> 
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/course.js"></script>
<div class="modal fade" id="add_new_course" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
				<form action="#" id="courseform" class="form-horizontal">
				<input type="hidden" name="courseID">
				   <div class="row">
					<div class="col-sm-12">
						<div class="form-group">
                            <h4 class="control-label col-md-4">Title</h4>
                            <div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-book"></i></span>
									<input class="form-control" name="title" type="text" placeholder="Title">
								</div><!-- /.form-group -->
							</div>
						</div>
						<div class="form-group">
                            <h4 class="control-label col-md-4">Department</h4>
                            <div class="col-md-8">
								<div class="form-group">
									<select name="departmentID" class="form-control">
										<option>Department</option>
									</select>
								</div><!-- /.form-group -->
							</div>
						</div>
						<div class="form-group">
                            <h4 class="control-label col-md-4">Description</h4>
                            <div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-tags"></i></span>
									<textarea class="form-control" name="description"  placeholder="Description"></textarea>
								</div><!-- /.form-group -->
							</div>
						</div>
						<div class="form-group">
                            <h4 class="control-label col-md-4">Duration(in hrs.)</h4>
                            <div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
									<input class="form-control" name="duration" type="number" min="0" max="500" placeholder="Duration(in hrs.)">
								</div><!-- /.form-group -->
							</div>
						</div>
						<div class="form-group">
                            <h4 class="control-label col-md-4">Max Days Allowed</h4>
                            <div class="col-md-8">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-bar-chart"></i></span>
									<input class="form-control" name="maxDays" type="number" min="0" max="60" placeholder="Max Days Allowed">
								</div><!-- /.form-group -->
							</div>
						</div>
					</div><!-- /.col-* -->
				</div>
				</form>
			</div>
            <div class="modal-footer">
                <button type="button" id="saveCourseBtn" class="btn-secondary">Save</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view("admin/includes/footer");?>
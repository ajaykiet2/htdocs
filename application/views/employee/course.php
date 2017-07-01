<?php $totleCourses = isset($courses) ? count($courses) : 0; ?>
<h1 class="page-header">Courses <span style="color:#999;">(<?=$totleCourses;?>)</span></h1>
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
					<li>Duration: <a href="javascript:void(0)"><?=timeToDecimal($course->duration);?> Hours</a></li>
					<li>Time Spent: <a href="javascript:void(0)"><?=$course->timeSpent;?></a></li>
				</ul>
			</div>
			<span class="pull-right">
				<?php if($course->eligiblity === 'yes' && $course->isAvailable):?>
					<a href="/employee/assessment/<?=$this->encrypt->encode($course->courseID);?>" title="Start Examination">
						<i class="btn btn-xs fa fa-paper-plane"></i>
					</a>
				<?php else:?>
					<a href="javascript:void(0)" class="viewCourse" title="Not Eligible For Examination">
						<i class="btn btn-xs fa fa-times-circle"></i>
					</a>
				<?php endif;
					if($course->isAvailable):
				?>
				<a href="/employee/course/<?=$this->encrypt->encode($course->courseID);?>" class="viewCourse" title="Open This Course">
					<i class="btn-secondary btn-xs fa fa-long-arrow-right"></i>
				</a> 
				<?php else:?>
				<a href="javascript:void(0)" class="viewCourse" title="This course is expired for your account">
					<i class="btn-secondary btn-xs fa fa-times-circle"></i>
				</a>
				<?php endif;?>
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
					<span>NO COURSE ASSIGNED</span>
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
	<?php endif;?>
</div>



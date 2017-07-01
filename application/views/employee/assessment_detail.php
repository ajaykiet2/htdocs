<div class="row">
	<div class="col-sm-12">
        <div class="property-valuation">
            <div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<h5 class="page-header">CANDIDATE DETAIL</h5>
					<div class="row">
						<div class="col-sm-12">
							<ul class="property-valuation-keys">
								<li class="col-md-4 col-xs-6 text-right">NAME</li>
								<li class="col-md-8 col-xs-6"><?=$employeeInfo->name;?></li>
								<div class="clearfix"></div>
								<li class="col-md-4 col-xs-6 text-right">AADHAAR NO</li>
								<li class="col-md-8 col-xs-6"><?=$employeeInfo->aadharCard;?></li>
								<div class="clearfix"></div>
								<li class="col-md-4 col-xs-6 text-right">COMPANY</li>
								<li class="col-md-8 col-xs-6"><?=$employeeInfo->companyName;?></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
					<h5 class="page-header">EXAMINATION DETAIL 
						<p class="pull-right">
							<a href="/employee/dashboard" title="Back to course listing"><i class="btn btn-xs fa fa-long-arrow-left"></i></a> 							
						</p>
					</h5>
					<div class="row">
						<div class="col-md-4">
							<ul class="property-valuation-keys">
								<li class="col-md-8 col-xs-8 text-right">TOTAL QUESTION</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->totalQuestions;?></li>
								<div class="clearfix"></div>
								<li class="col-md-8 col-xs-8 text-right">DURATION(IN MIN)</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->duration;?></li>
								<div class="clearfix"></div>
								<li class="col-md-8 col-xs-8 text-right">PASSING MARKS</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->passingMarks;?></li>
								<div class="clearfix"></div>
								<li class="col-md-8 col-xs-8 text-right">QUESTION SET</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->questionSets;?></li>
							</ul>
						</div>
						<div class="col-md-8">
							<ul class="property-valuation-keys">
								<li class="col-sm-4 col-xs-6 text-right">TITLE</li>
								<li class="col-sm-8 col-xs-6"><?=$assessment->title;?></li>
								<div class="clearfix"></div>
								<li class="col-sm-4 col-xs-6 text-right">DESCRIPTION</li>
								<li class="col-sm-8 col-xs-6"><?=$assessment->description;?></li>
							</ul>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<h3 class="page-header">
	ATTEMPTS
	<p class="pull-right">
		<a href="/employee/assessment/start/<?=$this->encrypt->encode($assessment->assessmentID);?>" title="New Attempt" class="btn-secondary"><i class="fa fa-paper-plane"></i> New Attempt</a> 							
	</p>
</h3>

<?php if(!empty($attempts)):?>
<table class="table table-simple" id="attemptsTable">
	<thead>
		<tr>
			<th>Question Set</th>
			<th>Attempted on</th>
			<th>Marks Obtained</th>
			<th>Minutes Taken</th>
			<th>Result</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($attempts as $attempt):?>
		<tr>
			<td><a href="javascript:void(0)"><?=$attempt->questionSet;?></a></td>
			<td><a href="javascript:void(0)"><?=dateTimeToString($attempt->timeStamp);?></a></td>
			<td><a href="javascript:void(0)"><?=$attempt->markObtained;?></a></td>
			<td><a href="javascript:void(0)"><?=$attempt->minuteTaken;?></a></td>
			<td><a href="javascript:void(0)"><?=ucfirst($attempt->result);?></a></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php endif;?>




<?php $this->load->view("admin/includes/header");?>
<?php if(!empty($assessment)):?>
<div class="row">
	<div class="col-sm-12">
        <div class="property-valuation">
            <div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<h5 class="page-header">COURSE DETAIL</h5>
					<div class="row">
						<div class="col-sm-12">
							<ul class="property-valuation-keys">
								<li class="col-md-4 col-xs-6 text-right">TITLE</li>
								<li class="col-md-8 col-xs-6"><?=$course->title;?></li>
								<li class="col-md-4 col-xs-6 text-right">DESCRIPTION</li>
								<li class="col-md-8 col-xs-6"><?=$course->description;?></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
					<h5 class="page-header">EXAMINATION DETAIL
						<p class="pull-right"> 
							<a href="javascript:void(0)" id="editAssessment" title="Edit Assessment"><i class="btn-secondary btn-xs fa fa-pencil"></i></a> 
							<a href="javascript:void(0)" id="deleteAssessment" title="Delete Assessment"><i class="btn btn-xs fa fa-trash"></i></a> 
						</p>
					</h5>
					<div class="row">
						<div class="col-md-4">
							<ul class="property-valuation-keys">
								<li class="col-md-8 col-xs-8 text-right">CODE</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->code;?></li>
								<li class="col-md-8 col-xs-8 text-right">TOTAL QUESTION</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->totalQuestions;?></li>
								<li class="col-md-8 col-xs-8 text-right">DURATION(IN MIN)</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->duration;?></li>
								<li class="col-md-8 col-xs-8 text-right">PASSING MARKS</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->passingMarks;?></li>
								<li class="col-md-8 col-xs-8 text-right">QUESTION SETS</li>
								<li class="col-md-4 col-xs-4"><?=$assessment->questionSets;?></li>
							</ul>
						</div>
						<div class="col-md-8">
							<ul class="property-valuation-keys">
								<li class="col-sm-4 col-xs-6 text-right">TITLE</li>
								<li class="col-sm-8 col-xs-6"><?=$assessment->title;?></li>
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
	<hr>
	<h3 class="page-header"><span style="color:#999;">EXAMINATION QUESTIONS FOR </span>"<?=strtoupper($course->title);?>" 
		<p class="pull-right">
			<a href="javascript:void(0)" id="uploadAssessmentQuestion" title="Upload question sets for this course">
				<i class="btn-secondary fa fa-cloud-upload"></i>
			</a> 
		</p>
	</h3>
	<?php if(!empty($questionSets)):?>
	<div class="panel-group" id="examination">
	<?php foreach($questionSets as $setNum => $questions):?>
	<?php if(!empty($questions)): ?>
	  <div class="panel" style="border-top:3px solid #EC407A;border-radius:0;">
		<div class="panel-heading" data-toggle="collapse" data-parent="#examination" data-target="#collapse<?=$setNum;?>" area-expanded="true">
		  <h4 class="panel-title">
			QUESTION SET # <?=$setNum;?>
		  </h4>
		</div>
		<div id="collapse<?=$setNum;?>" class="panel-collapse collapse">
		  <table class="table table-simple" id="questionTable">
			<thead>
				<tr>
					<th class="min-width nowrap"></th>
					<th>Question</th>
					<th>Answer</th>
					<th class="min-width nowrap">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $qn = 1; foreach($questions as $question):?>
				<tr>
					<td class="min-width nowrap"><?=$qn;?>.</td>
					<td><a href="javascript:void(0)"><?=$question->question;?></a></td>
					<td><a href="javascript:void(0)"><?=$question->answer;?></a></td>
					<td class="min-width nowrap">
						<p>
							<span class="btn-xs btn-secondary fa fa-edit editQuestion" title="Edit Question" data-id="<?=$question->assessmentQuestionID;?>"></span> 
							<span class="btn btn-xs fa fa-eye viewQuestion" title="View Question" data-id="<?=$question->assessmentQuestionID;?>"></span>
						</p>
					</td>
				</tr>
				<?php $qn++; endforeach;?>
			</tbody>
		</table>
		</div>
	  </div>
	
	<?php endif; ?>
	<?php endforeach;?>
	</div>
	<?php else:?>
	<div class="row">
		<div class="col-sm-12 activity">
			<ul>
				<li>
					<div class="icon red">
						<i class="fa fa-warning"></i>
					</div><!-- /.icon -->
					<div class="content">
						NO EXAMINATION QUESTION AVAILABLE FOR <span style="color:#999;"><?=strtoupper($course->title);?></span>.
					</div><!-- /.content -->
				</li>
			</ul>
		</div>
	</div>
	<?php endif;?>
<?php else:?>
<h3 class="page-header">
	
	<span style="color:#999;">EXAMINATION DETAIL</span>
	<p class="pull-right">
		<a href="/admin/assessment" title="Go Back"><i class="btn fa fa-long-arrow-left"></i></a>  
		<a href="javascript:void(0)" id="addAssessment" title="Add New Assessment"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h3>

<div class="activity">
	<ul>
		<li>
			<div class="icon red">
				<i class="fa fa-warning"></i>
			</div>
			<div class="content">
				NO EXAMINATION AVAILABLE FOR COURSE :  
				<span style="color:#999;"><?=strtoupper($course->title);?></span>
			</div>
		</li>
	</ul>
</div>
	
<?php endif;?>
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/assessment.js"></script>

<div class="modal fade" id="add_assessment_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">ADD EXAMINATION</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="addAssessmentForm" class="form-horizontal">
					<input type="hidden" value="<?=$assessmentInfo->companyID;?>" name="companyID"/> 
					<input type="hidden" value="<?=$assessmentInfo->courseID;?>" name="courseID"/> 
					<div class="form-body">
						<div class="form-group">
							<h5 class="control-label col-md-3">Code</h5>
							<div class="col-md-9">
							   <input type="number" name="code" min="1" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Title</h5>
							<div class="col-md-9">
							   <input type="text" name="title" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Short Description</h5>
							<div class="col-md-9">
							   <textarea name="description" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Total Questions</h5>
							<div class="col-md-9">
							   <input type="number" min="1" name="totalQuestions" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Duration(Minutes)</h5>
							<div class="col-md-9">
							   <input type="number" min="1" name="duration" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Passing Marks</h5>
							<div class="col-md-9">
							   <input type="number" min="1" name="passingMarks" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Question Sets</h5>
							<div class="col-md-9">
							   <input type="number" min="1" name="questionSets" class="form-control">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="addAssessmentBtn" class="btn-secondary">Save</button>
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
<?php if(!empty($assessment)):?>
<div class="modal fade" id="edit_assessment_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">EDIT EXAMINATION</h3>
			</div>
			<div class="modal-body form">
				<form action="#" id="updateAssessmentForm" class="form-horizontal">
					<input type="hidden" value="<?=$assessment->assessmentID;?>" name="assessmentID"/> 
					<div class="form-body">
						<div class="form-group">
							<h5 class="control-label col-md-3">Title</h5>
							<div class="col-md-9">
							   <input type="text" name="title" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Short Description</h5>
							<div class="col-md-9">
							   <textarea name="description" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Total Questions</h5>
							<div class="col-md-9">
							   <input type="number" min="1" name="totalQuestions" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Duration(Minutes)</h5>
							<div class="col-md-9">
							   <input type="number" min="1" name="duration" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<h5 class="control-label col-md-3">Passing Marks</h5>
							<div class="col-md-9">
							   <input type="number" min="1" name="passingMarks" class="form-control">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" id="updateAssessmentBtn" class="btn-secondary">Save</button>
				<button type="button" class="btn" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="upload_questions" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Upload Examination Questions</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="questionUploadform" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="courseID" value="<?=$course->courseID;?>">
                    <input type="hidden" name="questionSets" value="<?=$assessment->questionSets;?>">
                    <input type="hidden" name="assessmentID" value="<?=$assessment->assessmentID;?>">
                    <input type="hidden" name="totalQuestions" value="<?=$assessment->totalQuestions;?>">
					<div class="form-body">		
						<div class="form-group">
                            <div class="col-md-12">
                                <input name="file_to_upload" placeholder="Name" class="form-control" id="question-upload-file" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<div class="modal fade" id="update_Question" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Question</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="updateQuestionForm" class="form-horizontal">
                    <input type="hidden" value="" name="assessmentQuestionID"/> 
                    <div class="row form-body">
						
						<div class="col-sm-12">
							<div class="module">
								<div class="module-info center vertical-align min-width">
									<i class="fa fa-question-circle fa-2x"></i>
								</div>
								<div class="module-content vertical-align">
									<textarea class="form-control" name="question" type="text" placeholder="Question"></textarea>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="module">
								<div class="module-info center vertical-align min-width">
									<input type="radio" class="option_1" name="answer" value="">
								</div><!-- /.module-info -->
								<div class="module-content vertical-align">
									<input class="form-control" name="option_1" type="text" placeholder="Option 1">
								</div><!-- /.module-content -->
							</div><!--- /.module -->
						</div>
						<div class="col-sm-6">
							<div class="module">
								<div class="module-info center vertical-align min-width">
									<input type="radio" class="option_2" name="answer" value="">
								</div><!-- /.module-info -->
								<div class="module-content vertical-align">
									<input class="form-control" name="option_2" type="text" placeholder="Option 2">
								</div><!-- /.module-content -->
							</div><!--- /.module -->
						</div>
						<div class="col-sm-6">
							<div class="module">
								<div class="module-info center vertical-align min-width">
									<input type="radio" class="option_3" name="answer" value="">
								</div><!-- /.module-info -->
								<div class="module-content vertical-align">
									<input class="form-control" name="option_3" type="text" placeholder="Option 3">
								</div><!-- /.module-content -->
							</div><!--- /.module -->
						</div>
						<div class="col-sm-6">
							<div class="module">
								<div class="module-info center vertical-align min-width">
									<input type="radio" class="option_4" name="answer" value="">
								</div><!-- /.module-info -->
								<div class="module-content vertical-align">
									<input class="form-control" name="option_4" type="text" placeholder="Option 4">
								</div><!-- /.module-content -->
							</div><!--- /.module -->
						</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="updateQuestionBtn" class="btn-secondary">Update</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="view_Question" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Question Detail</h3>
            </div>
            <div class="modal-body">
               <div class="row">
					<div class="col-sm-12">
						<div class="module question">
							<div class="module-info center vertical-align min-width">
								<i class="fa fa-question-circle fa-2x"></i>
							</div><!-- /.module-info -->
							<div class="module-content vertical-align">
								<span></span>
							</div><!-- /.module-content -->
						</div><!--- /.module -->
					</div>

					<div class="col-sm-12 col-md-6">
						<div class="module options option_1">
							<div class="module-info center vertical-align min-width">
								<i class="fa"></i>
							</div><!-- /.module-info -->
							<div class="module-content vertical-align">
								<span class="value"></span>
							</div><!-- /.module-content -->
						</div><!--- /.module -->
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="module options option_2">
							<div class="module-info center vertical-align min-width">
								<i class="fa"></i>
							</div><!-- /.module-info -->

							<div class="module-content vertical-align">
								<span></span>
							</div><!-- /.module-content -->
						</div><!--- /.module -->
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="module options option_3">
							<div class="module-info center vertical-align min-width">
								<i class="fa"></i>
							</div><!-- /.module-info -->

							<div class="module-content vertical-align">
								<span></span>
							</div><!-- /.module-content -->
						</div><!--- /.module -->
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="module options option_4">
							<div class="module-info center vertical-align min-width">
								<i class="fa"></i>
							</div><!-- /.module-info -->

							<div class="module-content vertical-align">
								<span></span>
							</div><!-- /.module-content -->
						</div><!--- /.module -->
					</div>
				</div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view("admin/includes/footer");?>
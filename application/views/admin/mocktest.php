<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">Mock Tests
	<p class="pull-right">	
		<a href="javascript:void(0)" id="addNewMocktest" title="Add New Mocktest"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($mocktests)):?>
	<div class="panel-group" id="examination">
	<?php $count = 1; foreach($mocktests as $name => $questions):?>
	<?php if(!empty($questions)): ?>
	  <div class="panel" style="border-top:3px solid #EC407A;border-radius:0;">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a href="#" class="btn-alert" data-toggle="collapse" data-parent="#examination" data-target="#collapse<?=$count;?>" area-expanded="true"><?=$name;?></a><span class="deleteMocktest pull-right btn btn-xs fa fa-trash" data-name="<?=$name;?>"></span>
		  </h4>
		</div>
		<div id="collapse<?=$count;?>" class="panel-collapse collapse">
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
							<span class="btn-xs btn-secondary fa fa-edit editQuestion" title="Edit Question" data-id="<?=$question->id;?>"></span> 
							<span class="btn btn-xs fa fa-eye viewQuestion" title="View Question" data-id="<?=$question->id;?>"></span>
						</p>
					</td>
				</tr>
				<?php $qn++; endforeach;?>
			</tbody>
		</table>
		</div>
	  </div>
	<?php endif; ?>
	
	<?php $count++; endforeach;?>
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
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/mocktest.js"></script>
<div class="modal fade" id="upload_questions" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Upload Mocktest Questions</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="questionUploadform" method="post" class="form-horizontal" enctype="multipart/form-data">
					<div class="form-body">	
						<div class="form-group">
                            <div class="col-md-12">
                                <input type="text" name="name" placeholder="Name" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </div>					
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
<div class="modal fade" id="update_Question" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Question</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="updateQuestionForm" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
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
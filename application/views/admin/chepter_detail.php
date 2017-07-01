<?php $this->load->view("admin/includes/header");?>
<input type="hidden" id="globalChepterID" value="<?=$chepterInfo->chepterID;?>">
<h3 class="page-header">
	CHAPTER DETAIL
	<p class="pull-right">
		<a href="/admin/courses/detail/<?=$this->encrypt->encode($chepterInfo->courseID);?>" title="Back to chepter listing"><i class="btn fa fa-long-arrow-left"></i></a>  
	</p>
</h3>
<div class="row">
	<div class="col-sm-5 col-md-4 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Title
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($chepterInfo->title);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-7 col-md-8 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Description
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($chepterInfo->description);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
</div>
<h3 class="page-header"><span style="color:#999;">SLIDES FOR </span>"<?=strtoupper($chepterInfo->title);?>" 
	
	<p class="pull-right"> 
		<a href="/admin/courses/<?=$this->encrypt->encode($chepterInfo->courseID);?>/chepter/<?=$this->encrypt->encode($chepterInfo->chepterID);?>/slide/new" title="Add New Slide"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h3>

<?php if(!empty($slides)): ?>
<table class="table table-simple" id="slideTable">
    <thead>
        <tr>
			<th class="min-width nowrap"></th>
            <th>Title</th>
            <th>Sequence</th>
            <th class="min-width nowrap">Actions</th>
        </tr>
    </thead>
    <tbody>
		<?php foreach($slides as $slide):?>
		<tr>
			<td class="min-width nowrap"></td>
			<td><a href="/admin/courses/<?=$this->encrypt->encode($chepterInfo->courseID);?>/chepter/<?=$this->encrypt->encode($slide->chepterID);?>/slide/view/<?=$this->encrypt->encode($slide->slideID);?>"><?=$slide->title;?></a></td>
			<td><?=$slide->sequence;?></td>
			<td class="min-width nowrap">
				<p>
					<a href="/admin/courses/<?=$this->encrypt->encode($chepterInfo->courseID);?>/chepter/<?=$this->encrypt->encode($slide->chepterID);?>/slide/edit/<?=$this->encrypt->encode($slide->slideID);?>" class="btn-xs btn-secondary fa fa-edit" title="Edit Slide"></a> 
					<span class="deleteSlideBtn btn-xs btn fa fa-trash" title="Delete Slide" data-id="<?=$slide->slideID;?>"></span> 
					<a href="/admin/courses/<?=$this->encrypt->encode($chepterInfo->courseID);?>/chepter/<?=$this->encrypt->encode($slide->chepterID);?>/slide/view/<?=$this->encrypt->encode($slide->slideID);?>" class="btn-secondary btn-xs fa fa-eye" title="View Slide"></a>
				</p>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php else: ?>
<div class="row">
	<div class="col-sm-12 activity">
		<ul>
			<li>
				<div class="icon red">
					<i class="fa fa-warning"></i>
				</div><!-- /.icon -->
				<div class="content">
					NO SLIDE AVAILABLE FOR <span style="color:#999;"><?=strtoupper($chepterInfo->title);?></span>.
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
</div>
<?php endif;?>
<hr>
<h3 class="page-header"><span style="color:#999;">QUESTIONS FOR </span>"<?=strtoupper($chepterInfo->title);?>" 
	
	<p class="pull-right">
		<a href="javascript:void(0)" id="uploadQuestion" title="Upload questions for this chepter">
			<i class="btn-secondary fa fa-cloud-upload"></i>
		</a> 
	</p>
</h3>
<?php if(!empty($questions)): ?>
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
		<?php foreach($questions as $question):?>
		<tr>
			<td class="min-width nowrap"></td>
			<td><a href="javascript:void(0)"><?=$question->question;?></a></td>
			<td><a href="javascript:void(0)"><?=$question->answer;?></a></td>
			<td class="min-width nowrap">
				<p>
					<span class="btn-xs btn-secondary fa fa-edit editQuestion" title="Edit Question" data-id="<?=$question->chepterquestionID;?>"></span> 
					<span class="btn-xs btn fa fa-trash deleteQuestion" title="Delete Question" data-id="<?=$question->chepterquestionID;?>"></span> 
					<span class="btn-secondary btn-xs fa fa-eye viewQuestion" title="View Question" data-id="<?=$question->chepterquestionID;?>"></span>
				</p>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php else: ?>
<div class="row">
	<div class="col-sm-12 activity">
		<ul>
			<li>
				<div class="icon red">
					<i class="fa fa-warning"></i>
				</div><!-- /.icon -->
				<div class="content">
					NO QUESTION AVAILABLE FOR <span style="color:#999;"><?=strtoupper($chepterInfo->title);?></span>.
				</div><!-- /.content -->
			</li>
		</ul>
	</div>
</div>
<?php endif;?>

<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/chepter.js"></script>

<div class="modal fade" id="add_new_chepter" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add New Chapter</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="addChepterForm" class="form-horizontal">
                    <input type="hidden" value="" name="chepterID"/> 
                    <input type="hidden" value="<?=$chepterInfo->chepterID;?>" name="courseID"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <h5 class="control-label col-md-3">Enter Title</h5>
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
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="addChepterBtn" class="btn-secondary">Save</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="upload_questions" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Upload Questions</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="questionUploadform" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="courseID" value="<?=$chepterInfo->courseID;?>">
                     <input type="hidden" name="chepterID" value="<?=$chepterInfo->chepterID;?>">
                    <input type="hidden" name="action" value="uploadQuestion">
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="update_Question" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Question</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="updateQuestionForm" class="form-horizontal">
                    <input type="hidden" value="" name="chepterquestionID"/> 
                    <div class="row form-body">
						
						<div class="col-sm-12">
							<div class="module">
								<div class="module-info center vertical-align min-width">
									<i class="fa fa-question-circle fa-2x"></i>
								</div><!-- /.module-info -->
								<div class="module-content vertical-align">
									<textarea class="form-control" name="question" type="text" placeholder="Question"></textarea>
								</div><!-- /.module-content -->
							</div><!--- /.module -->
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
						<div class="col-sm-12">
							<div class="module">
								<div class="module-info center vertical-align min-width">
									<i class="fa fa-tags fa-2x"></i>
								</div><!-- /.module-info -->
								<div class="module-content vertical-align">
									<textarea class="form-control " name="explanation" type="text" placeholder="Explanation"></textarea>
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
					<div class="col-sm-12">
						<div class="module explanation">
							<div class="module-info center vertical-align min-width">
								<i class="fa fa-tags"></i>
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
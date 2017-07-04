<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">IMPORTANT QUESTIONS <span style="color:#999;">(<?=count($faqs);?>)</span>
	<p class="pull-right">	
		<a href="javascript:void(0)" id="addNewQuestion" title="Add New Question"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($faqs)):?>
<table class="table table-simple" id="importantQuestionTable">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th>ID</th>
			<th>Question</th>
			<th>Answer</th>
			<th class="min-width nowrap">Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $i = 1;
	foreach($faqs as $faq):	
	?>
		<tr>
			<td class="min-width nowrap"></td>
			<td><a href="#"><?=$i;?></a></td>
			<td><a href="#"><?=$faq->question;?></a></td>
			<td><?=$faq->answer;?></td>
			<td class="min-width nowrap"><span class="fa fa-trash btn btn-xs deleteQuestion" data-id="<?=$faq->faqID;?>" title="Delete this question"></span></td>
		</tr>
		<?php $i++; endforeach;?>
	</tbody>
</table>
<?php else:?>
<div class="col-sm-12 activity">
	<ul>
		<li>
			<div class="icon red">
				<i class="fa fa-warning"></i>
			</div><!-- /.icon -->
			<div class="content">
				NO QUESTIONS AVAILABLE </span>.
			</div><!-- /.content -->
		</li>
	</ul>
</div>
<?php endif;?>
<div class="modal fade" id="add_new_question" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
			<form action="/admin/ajax/impQuesAction" id="newQuestionForm" method="POST" class="form-horizontal">
				<input type="hidden" name="action" value="addNew">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Add New Question</h3>
				</div>
				<div class="modal-body form">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-md-12">
                               <textarea name="question" placeholder="Question" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea name="answer" placeholder="Answer" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div> 
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn-secondary">Save</button>
					<button class="btn" data-dismiss="modal">Cancel</button>
				</div>
			 </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/importantQuestions.js"></script>
<?php $this->load->view("admin/includes/footer");?>
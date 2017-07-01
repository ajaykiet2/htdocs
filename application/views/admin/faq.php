<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">FAQ <span style="color:#999;">(<?=count($faqs);?>)</span>
	<p class="pull-right">	
		<a href="javascript:void(0)" id="addNewFaq" title="Add New FAQ"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h1>
<?php if(!empty($faqs)):?>
<table class="table table-simple">
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
	<?php foreach($faqs as $faq):?>
		<tr>
			<td class="min-width nowrap"></td>
			<td>
				<a href="#"><?=$faq->faqID;?></a>
			</td>
			<td>
				<a href="#"><?=$faq->question;?></a>
			</td>
			<td><?=$faq->answer;?></td>
			
			<td class="min-width nowrap"><a href="#" class="btn-alert">delete</a></td>
		</tr>
		<?php endforeach;?>
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
				NO FAQ AVAILABLE </span>.
			</div><!-- /.content -->
		</li>
	</ul>
</div>
<?php endif;?>

<?php $this->load->view("admin/includes/footer");?>
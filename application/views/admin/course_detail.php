<?php $this->load->view("admin/includes/header");?>
<input type="hidden" id="globalCompanyID" value="<?=$courseInfo->courseID;?>">
<h3 class="page-header">COURSE DETAIL</span></h3>
<div class="row">
	<div class="col-sm-6 col-md-6 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Title
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($courseInfo->title);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
    <div class="col-sm-6 col-md-6 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Department
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($courseInfo->departmentName);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-6 col-md-6 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Description
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($courseInfo->description);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-6 col-md-3 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Duration 
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=timeToDecimal($courseInfo->duration);?> Hours</span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-6 col-md-3 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
                Max Days Allowed 
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($courseInfo->maxDays);?> Days</span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
</div>
<h3 class="page-header"><span style="color:#999;">SYLLABUS
	<p class="pull-right">
		<a href="/admin/courses" title="Back to course listing"><i class="btn fa fa-long-arrow-left"></i></a>  
		<a href="#" id="createChepter" title="Add New Chepter"><i class="btn-secondary fa fa-plus"></i></a> 
	</p>
</h3>
<?php if(!empty($chepters)): ?>
<div class="chepters">
	<table id="departmentTable" class="table table-simple">
		<thead>
			<tr>
				<th class="min-width nowrap">S.N.</th>
				<th class="nowrap">TITLE</th>
				<th>DESCRIPTION</th>
				<th class="min-width nowrap">ACTION</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$count = 1;
		foreach($chepters as $chepter):?>
			<tr>
				<td class="min-width nowrap"><?=$count;?>. </td>
				<td class="semi-bold"><?=ucfirst($chepter->title);?></td>
				<td><?=$chepter->description;?></td>
				<td class="min-width nowrap"><span class="pull-right">
						<a href="javascript:void(0)" class="editChepter" data-id="<?=$chepter->chepterID;?>" title="Edit Chepter"><i class="btn-secondary btn-xs fa fa-edit"></i></a> 
						<a href="javascript:void(0)" class="deleteChepter" data-id="<?=$chepter->chepterID;?>" title="Delete Chepter"><i class="btn btn-xs fa fa-trash"></i></a> 
						<a href="/admin/courses/<?=$this->encrypt->encode($courseInfo->courseID);?>/chepter/<?=$this->encrypt->encode($chepter->chepterID);?>" title="View Detail"><i class="btn-secondary btn-xs fa fa-long-arrow-right"></i></a>
					</span></td>
			</tr>
			<?php $count++; endforeach;?>
		</tbody>
	</table>
</div>
<?php else:?>
<div class="activity">
	<ul>
		<li>
			<div class="icon red">
				<i class="fa fa-warning"></i>
			</div><!-- /.icon -->
			<div class="content">
				NO SYLLABUS AVAILABLE FOR <span style="color:#999;"><?=strtoupper($courseInfo->title);?></span>.
			</div><!-- /.content -->
		</li>
	</ul>
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
                    <input type="hidden" value="<?=$courseInfo->courseID;?>" name="courseID"/> 
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
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view("admin/includes/footer");?>
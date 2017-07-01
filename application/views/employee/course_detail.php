<h3 class="page-header">COURSE DETAIL</span>
	<p class="pull-right">
		<a href="/employee/" title="Back to course listing"><i class="btn fa fa-long-arrow-left"></i></a> 		
	</p>
</h3>
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
                Duration / Day 
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=timeToDecimal($courseInfo->duration);?> Hours</span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
	<div class="col-sm-6 col-md-3 col-xs-12">
        <div class="module">
            <div class="module-info center vertical-align">
               Remaining Days 
            </div><!-- /.module-info -->

            <div class="module-content vertical-align">
                <span><?=strtoupper($courseInfo->remainingDays);?></span>
            </div><!-- /.module-content -->
        </div><!--- /.module -->
    </div>
</div>
<h3 class="page-header">SYLLABUS</h3>
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
				<td class="min-width nowrap"><a href="/employee/chepter/<?=$this->encrypt->encode($courseInfo->courseID);?>/<?=$this->encrypt->encode($chepter->chepterID);?>" title="Read Chepter"><i class="btn-secondary btn-xs fa fa-book"> Read</i></a></td>
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
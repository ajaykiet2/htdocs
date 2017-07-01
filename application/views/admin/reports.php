<?php $this->load->view("admin/includes/header");?>
<h1 class="page-header">Generate Reports</h1>
<div class="box">
	<div class="row">
		<div class="form-group col-md-3 col-sm-6">
			<label>Select Company</label>
			<select name="companyID" id="companySelector" class="form-control">
				<option value="">Select Company</option>
				<?php foreach($companies as $company):?>
				<option value="<?=$company->companyID;?>"><?=$company->name;?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div class="form-group col-md-3 col-sm-6">
			<label>Select Course</label>
			<select name="courseID" id="courseSelector" class="form-control">
				<option value="">Course</option>
			</select>
		</div>
		<div class="form-group col-md-4 col-sm-6">
			<label>Date Range</label>
			<input type="text" name="daterange" id="reportRange" class="form-control">
		</div>
		<div class="form-group col-md-2 col-sm-6">
			<label>&nbsp;</label>
			<form method="POST" action="/admin/reports/exportCandidate" id="exportReportForm">
				<input type="hidden" name="companyID" id="candidateCompanyID">
				<input type="hidden" name="courseID" id="candidateCourseID">
				<input type="hidden" name="dateRange" id="candidateDaterange">
			</form>
			<span class="btn-secondary btn-lg fa fa-cogs" id="generateReport" title="Generate Report"></span>
			<span class="btn btn-lg fa fa-file-excel-o" id="exportReportBtn" title="Export Report"></span>
		</div>
	</div>
</div>
<table id="reportTable" class="table table-simple table-responsive">
	<thead>
		<tr>
			<th class="min-width nowrap"></th>
			<th>Name</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Question Set</th>
			<th>Total Questions</th>
			<th>Duration</th>
			<th>Passing Marks</th>
			<th>Max Score</th>
			<th>Time Taken</th>
			<th>Result</th>
			<th>Attempt Date</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="12">No matching records found</td>
		</tr>
    </tbody>
</table>

<?php $this->load->view("admin/includes/scripts");?>
<script type="text/javascript" src="/assets/libraries/daterangepicker/moment.js"></script>
<script type="text/javascript" src="/assets/libraries/daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/admin/report.js"></script>
<?php $this->load->view("admin/includes/footer");?>
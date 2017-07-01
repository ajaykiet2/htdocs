<?php $this->load->view("admin/includes/header");?>
<div class="row">
	<div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
		<h1 class="page-header">Candidates 
			<p class="pull-right">
				<a href="#" id="addNewEmployee" title="Add New Candidate"><i class="btn-secondary fa fa-user-plus"></i></a> 
				<a href="#" id="deleteSelected" title="Delete Selected Candidate"><i class="btn fa fa-trash"></i></a>
				<a href="#" id="uploadEmployee" title="Upload Candidates"><i class="btn fa fa-cloud-upload"></i></a> 
			</p>
		</h1>

		<table id="employeeTable" class="table table-simple table-responsive">
			<thead>
				<tr>
					<th class="min-width nowrap"><span class="fa fa-check"></span></th>
					<th class="min-width nowrap">ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Code</th>
					<th>Manager</th>
					<th>Department</th>
					<th>Company</th>
					<th>Designation</th>
					<th>Address</th>
					<th>PAN Card</th>
					<th>Aadhaar Card</th>
					<th class="nowrap">&nbsp; Actions &nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="min-width nowrap"><input type="checkbox"></td>
					<td class="semi-bold">#ID</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td>Loading</td>
					<td class="nowrap">Loading</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/employee.js"></script>

<!-- Add new Emp modal -->
<div class="modal fade" id="add_new_employee" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
				<form action="#" id="employeeform">
				   <div class="row">
					<div class="col-sm-6">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input class="form-control" name="name" type="text" placeholder="Name">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input class="form-control" name="email" type="text" placeholder="Email">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input class="form-control" name="password" type="password" placeholder="Password">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input class="form-control" name="confirm_password" type="password" placeholder="Confirm Password">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input class="form-control" name="mobile" type="text" placeholder="mobile">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
							<input class="form-control" name="employeeCode" type="text" placeholder="Employee Code">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input class="form-control" name="managerName" type="text" placeholder="Manager Name">
						</div><!-- /.form-group -->
					</div><!-- /.col-* -->

					<div class="col-sm-6">
						<div class="form-group">
							<select name="companyID" class="form-control">
								<option>Company</option>
								
							</select>
						</div><!-- /.form-group -->
						<div class="form-group">
							<select name="departmentID" class="form-control">
								<option>Department</option>
								
							</select>
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
							<input class="form-control" name="designation" type="text" placeholder="Designation">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
							<input class="form-control" name="address" type="text" placeholder="Address">
						</div><!-- /.form-group -->
						
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
							<input class="form-control" name="panCard" type="text" placeholder="Pancard">
						</div><!-- /.form-group -->
						
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
							<input class="form-control" name="aadharCard" type="text" placeholder="Aadhaar Card">
						</div><!-- /.form-group -->
						
						<div class="form-group">
							<h4 class="control-label col-md-8">Representative? </h4>
							<input class="form-control col-md-8" name="representative" type="checkbox">
						</div><!-- /.form-group -->
					</div><!-- /.col-* -->
				</div>
				</form>
			</div>
            <div class="modal-footer">
                <button type="button" id="saveEmployeeBtn" class="btn-secondary">Save</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Add new Emp modal -->
<div class="modal fade" id="update_employee" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
				<form action="#" id="employeeUpdateform">
					<input type="hidden" name="employeeID">
				   <div class="row">
					<div class="col-sm-6">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input class="form-control" name="name" type="text" placeholder="Name">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							<input class="form-control" name="mobile" type="text" placeholder="mobile">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
							<input class="form-control" name="employeeCode" type="text" placeholder="Employee Code">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input class="form-control" name="managerName" type="text" placeholder="Manager Name">
						</div><!-- /.form-group -->
						<div class="form-group">
							<select name="departmentID" class="form-control departments">
								<option>Department</option>
							</select>
						</div><!-- /.form-group -->
					</div><!-- /.col-* -->

					<div class="col-sm-6">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
							<input class="form-control" name="designation" type="text" placeholder="Designation">
						</div><!-- /.form-group -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
							<input class="form-control" name="address" type="text" placeholder="Address">
						</div><!-- /.form-group -->
						
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
							<input class="form-control" name="panCard" type="text" placeholder="Pancard">
						</div><!-- /.form-group -->
						
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
							<input class="form-control" name="aadharCard" type="text" placeholder="Aadhaar Card">
						</div><!-- /.form-group -->
						
						<div class="form-group">
							<select name="companyID" class="form-control">
								<option>Company</option>
							</select>
						</div><!-- /.form-group -->
						<div class="form-group">
							<h4 class="control-label col-md-8">Representative? </h4>
							<input class="form-control col-md-8" name="representative" type="checkbox">
						</div><!-- /.form-group -->
					</div><!-- /.col-* -->
				</div>
				</form>
			</div>
            <div class="modal-footer">
                <button type="button" id="updateEmployeeBtn" class="btn-secondary" >Update</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="upload_employee" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Upload Candidate</h3>
            </div>
            <div class="modal-body form">
                <form action="/admin/employee" id="employeeUploadform" method="post" onsubmit="return validateUpload();" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="uploadEmployee">
					<div class="form-body">
                        <div class="form-group">
                            <h5 class="control-label col-md-3">Company</h5>
                            <div class="col-md-9">
                                <select name="companyID" class="form-control">
									<option value="">Company</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <h5 class="control-label col-md-3">Department</h5>
                            <div class="col-md-9">
                                <select name="departmentID" class="form-control">
									<option value="">Department</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div> 						
						<div class="form-group">
                            <h5 class="control-label col-md-3">Choose File</h5>
                            <div class="col-md-9">
                                <input name="file_to_upload" placeholder="Name" class="form-control" id="employee-upload-file" type="file">
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
<?php $this->load->view("admin/includes/footer");?>
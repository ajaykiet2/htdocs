<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		<div class="module">
			<div class="module-content">
				<h4><strong>Personal Information</strong></h4>
				<div class="row">									
					<ul class="not-found-links">
						<div class="col-sm-6">
							<li>
								<strong>Name</strong> : <span><?=$employee->name;?></span>
							</li>
							<li>
								<strong>Email</strong> : <span><?=$employee->email;?></span>
							</li>
							<li>
								<strong>Mobile</strong> : <span><?=$employee->mobile;?></span>
							</li>
							
						</div>
						<div class="col-sm-6">
							<li>
								<strong>Pan Card</strong> : <span><?=$employee->panCard;?></span>
							</li>
							<li>
								<strong>Aadhaar Card</strong> : <span><?=$employee->aadharCard;?></span>
							</li>
							<li>
								<strong>Company</strong> : <span><?php echo ($employee->role != 'admin') ? $employee->companyName: "NO COMPANY FOR ADMIN";?></span>
							</li>
						</div>
						<li class="col-sm-12">
							<strong>address</strong> : <span><?=$employee->address;?></span>
						</li>
					</ul>
				</div><!-- /.row -->
				<div><br></div>
				<span id="editProfile" class="btn btn-xs fa fa-user  pull-right"> Edit Profile</span>	
				<span id="updatePassword" class="btn-secondary btn-xs fa fa-edit pull-right"> Update Password</span>	
			</div><!-- /.module-content -->				
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8" style="display:none;" id="editProfileBox">
		<div class="module">
			<div class="module-content">
				<h4 class="pull-left" ><strong>Update Information</strong></h4>
				<button type="button" class="close pull-right closeEditProfileBox"><span>&times;</span></button>
				<form action="/employee/portal/employeeAction" id="updateProfileForm" method="POST" class="form-horizontal">
					<input type="hidden" name="action" value="updateProfile">
					<div class="form">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-12">
								   <input type="text" name="name" placeholder="Name" class="form-control" value="<?=$employee->name;?>">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
								   <input type="text" name="mobile" placeholder="Mobile" class="form-control" value="<?=$employee->mobile;?>">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
								   <textarea name="address" placeholder="Address" class="form-control"><?=$employee->address;?></textarea>
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
								   <input type="text" name="panCard" placeholder="Pan Card" class="form-control" value="<?=$employee->panCard;?>">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
								   <input type="text" name="aadharCard" placeholder="Aadhaar Card" class="form-control" value="<?=$employee->aadharCard;?>">
									<span class="help-block"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="pull-right">
						<button type="submit" class="btn-xs btn-secondary"><b>Update</b></button>
						<span class="btn-xs btn closeEditProfileBox">Cancel</span>
					</div>
				 </form>
			</div><!-- /.module-content -->				
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
<div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-8" style="display:none;" id="updatePasswordBox">
		<div class="module">
			<div class="module-content">
				<h4 class="pull-left" ><strong>Update Password</strong></h4>
				<button type="button" class="close pull-right closeUpdatePasswordBox" ><span>&times;</span></button>
				<form action="/employee/portal/employeeAction" id="updatePasswordForm" method="POST" class="form-horizontal">
					<input type="hidden" name="action" value="updatePassword">
					<div class="form">
						<div class="form-body">
							<div class="form-group">
								<div class="col-md-12">
								   <input type="password" name="password" placeholder="Old Password" class="form-control">
									<span class="help-block"></span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<input type="password" name="new_password" placeholder="New Password" class="form-control">
									<span class="help-block"></span>
								</div>
							</div> 
							<div class="form-group">
								<div class="col-md-12">
									<input type="password" name="re_password" placeholder="Repeat Password" class="form-control">
									<span class="help-block"></span>
								</div>
							</div> 
						</div>
					</div>
					<div class="pull-right">
						<button type="submit" class="btn-xs btn-secondary"><b>Update</b></button>
						<span class="btn-xs btn closeUpdatePasswordBox">Cancel</span>
					</div>
				 </form>
			</div><!-- /.module-content -->				
		</div>
	</div>
	<div class="col-sm-2"></div>
</div>
</div>
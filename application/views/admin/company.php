<?php $this->load->view("admin/includes/header");?>

<h1 class="page-header">Companies 
	<p class="pull-right">
		<a href="#" id="addNewCompany"><i class="btn-secondary fa fa-plus"></i></a> 
		<a href="#" id="deleteSelected"><i class="btn fa fa-trash"></i></a>
	</p>
</h1>

<table id="companyTable" class="table table-simple">
	<thead>
		<tr>
			<th class="min-width nowrap"><span class="fa fa-check"></span></th>
			<th class="min-width nowrap">ID</th>
			<th>Company Name</th>
			<th>Contact Name</th>
			<th>Contact Mobile</th>
			<th>Contact Email</th>
			<th class="nowrap">Actions</th>
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
			<td class="min-width nowrap">Loading</td>
		</tr>
    </tbody>
</table>

<?php $this->load->view("admin/includes/scripts");?>
<script src="/assets/js/admin/company.js"></script>

<div class="modal fade" id="add_new_company" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="companyform" class="form-horizontal">
                    <input type="hidden" value="" name="companyID"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <h4 class="control-label col-md-4">Name</h4>
                            <div class="col-md-8">
                                <input name="name" placeholder="Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="control-label col-md-4">Contact Name</h4>
                            <div class="col-md-8">
                                <input name="contactName" placeholder="Contact Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div> 
						<div class="form-group">
                            <h4 class="control-label col-md-4">Contact Mobile</h4>
                            <div class="col-md-8">
                                <input name="contactMobile" placeholder="Contact Mobile" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <h4 class="control-label col-md-4">Contact Email</h4>
                            <div class="col-md-8">
                                <textarea name="contactEmail" placeholder="Contact Email" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveCompanyBtn" class="btn-secondary">Save</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->load->view("admin/includes/footer");?>
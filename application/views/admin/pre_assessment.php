<?php $this->load->view("admin/includes/header");?>
<h2 class="page-header">MANAGE EXAMINATIONS</h2>
<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
<div class="col-lg-4 col-md-6 col-sm-8">
	<div class="box">
		<h3 class="text-center page-header">SELECT COMPANY & COURSE</h3>
		<form class="from" id="preAssessmentForm" action="/admin/assessment/detail" method="POST">
			<div class="form-group">
				<select name="companyID" id="companySelector" class="form-control">
					<option value="">SELECT COMPANY</option>
					<?php foreach($companies as $company):?>
					<option value="<?=$company->companyID;?>"><?=$company->name;?></option>
					<?php endforeach;?>
					
				</select>
			</div>
			<div class="form-group">
				<select name="courseID" id="courseSelector" class="form-control">
					<option value="">SELECT COURSE</option>
				</select>
			</div>
			<div class="form-group">
				<center>
					<span class="btn" id="proceedBtn"><i class="fa fa-long-arrow-right"></i> Proceed</span>
				</center>
			</div>
		</form>
	</div>
</div>
<div class="col-lg-4 col-md-3 col-sm-2 hidden-xs"></div>
<?php $this->load->view("admin/includes/scripts");?>
<script>
$(function(){
	$.assessment = function(){
		$self = this;
		this.url = "/admin/ajax/assessmentAction";
		
		this.init = function(){
			$("select#companySelector").on('change',function(){
				var companyID = $(this).val();
				$self.loadCourses(companyID);
			});
			
			$("#proceedBtn").click(function(){
				var company = $("select#companySelector").val();
				var course = $("select#courseSelector").val();
				if(company == '' || course == ''){
					$.alert({
						icon : "fa fa-exclamation-triangle",
						title: "Validation Error!",
						content: "Please select company and course both to proceed!",
						type: "red",
						buttons:{
							ok: {
								text: 'OK',
								btnClass: 'btn',
								keys: ['enter'],
								action: function(){}
							}
						}
					});
					return false;
				}else{
					$("#preAssessmentForm").submit();
				}
			});
		};
		this.loadCourses = function(companyID){
			var data = {
				'action':'loadCourses',
				'companyID':companyID,
			};
			
			$.ajax({
				url:$self.url,
				data: data,
				async: true,
				type: 'POST',
				dataType: 'json',
				success: function(response){
					$("select#courseSelector").empty();
					$("select#courseSelector").append('<option value="">SELECT COURSE</option>');
					
					$.each(response,function(idx,course){
						var id = course.courseID;
						var title = course.title;
						$("select#courseSelector").append('<option value="'+id+'">'+title+'</option>');
					});
				},
			});
		};
	};
	new $.assessment().init();
});
</script>
<?php $this->load->view("admin/includes/footer");?>
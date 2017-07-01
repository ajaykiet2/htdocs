<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title>Login | Admin | User</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,300,500,700&amp;subset=latin,latin-ext">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/Font-Awesome/css/font-awesome.min.css">
    <script src="/assets/js/jquery.js"> </script>
    <link rel="stylesheet" type="text/css" href="/assets/css/hrd-foundation-admin.css"> 
</head>

<body class="">
<input type="hidden" id="csrfID" name="csrf_ID" value="<?=$this->security->get_csrf_hash();?>" />
<div class="admin-landing-image-source"></div>
<div class="admin-landing-image-cover"></div>

<div class="admin-wrapper">
	<div class="admin-navigation">
		<div class="admin-navigation-inner">
			<nav>
				<ul class="menu">
					<li class="avatar">
						<a href="#">
							<img src="/assets/img/tmp/agents/avatar.png" alt="">
							<span class="avatar-content">
								<span class="avatar-title">User Name</span>
								<span class="avatar-subtitle">Sub Title</span>
							</span>
						</a>
					</li>

					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					<li class="">
						<a href=""><strong><i class="fa fa-lock"></i></strong></a>
					</li>
					
				</ul>
			</nav>
		   
			<div class="layer"></div>
		</div>
	</div>

	<div class="admin-content">
		<div class="admin-content-image-text">
			<h2>Copyright &copy; 2011 - All Rights Reserved - HRD Foundation-India.</h2>
		</div>

		<div class="admin-content-image-call-to-action">
			<i class="fa fa-long-arrow-left"></i>
			<br>
			<span>Please login to access our portal.</span>
		</div>

		<div class="admin-content-inner">
			<div class="admin-content-header">
				<div class="admin-content-header-inner">
					<div class="container-fluid">
						<div class="admin-content-header-logo">
							<img src="/assets/img/hrdlogo.jpg" class="img img-responsive" style="height:40px"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="admin-sidebar-secondary" id="login-container">
		<div class="admin-sidebar-secondary-inner">
			<div class="admin-sidebar-secondary-inner-top">
				<h1><img src="/assets/img/hrdlogo.jpg" class="img img-responsive" style="max-height:50px; margin: 5px auto;"></h1>
				<form method="post" action="/login">
					<div class="form-group">
						<input type="email" name="emailID" class="form-control" placeholder="E-mail">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<?php if(isset($response->status)):
						if(!$response->status):
					?>
					<div class="alert alert-danger">
						<small class="text-uppercase"><?=$response->message;?></small>
					</div>
					<?php endif; endif;?>
					<button type="submit" name="action" value="login" class="btn btn-xl pull-right">
						<i class="fa fa-long-arrow-right"></i>Login
					</button>
				</form>
			</div>
			
			<div class="admin-sidebar-secondary-inner-bottom">
				<div class="admin-sidebar-footer">
					<div class="admin-sidebar-info">
						<strong>Additional Actions</strong>
						<ul>
							<li><a href="/">Back To Website</a></li>
							<li><a href="javascript:void(0)" id="forgot-password">Forgot Password</a></li>
						</ul>
					</div>
					<p>Developed By: <a href="mailto:ajaykiet2@gmail.com">Ajay Kumar</a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="admin-sidebar-secondary" id="forgot-container">
		<div class="admin-sidebar-secondary-inner">
			<div class="admin-sidebar-secondary-inner-top">
				<h1><img src="/assets/img/hrdlogo.jpg" class="img img-responsive" style="max-height:50px; margin: 5px auto;"></h1>
				
				<form method="post" action="/login/forgot">
					<div class="form-group">
						<input type="email" name="emailID" class="form-control" placeholder="E-mail">
					</div>

					<?php if(isset($response->status)):
						if(!$response->status):
					?>
					<div class="alert alert-danger">
						<small class="text-uppercase"><?=$response->message;?></small> 
					</div>
					<?php else:?>
					<div class="alert alert-success">
						<small class="text-uppercase"><?=$response->message;?></small> 
					</div>
					<?php endif;endif;?>
					<center><button type="submit" class="btn btn-xl btn-block">
						<i class="fa fa-long-arrow-right"></i>Request New Password
					</button></center>
				</form>
				
			</div>
			
			<div class="admin-sidebar-secondary-inner-bottom">
				<div class="admin-sidebar-footer">
					<div class="admin-sidebar-info">
						<strong>Additional Actions</strong>
						<ul>
							<li><a href="/">Back To Website</a></li>
							<li><a href="javascript:void(0)" id="back-login">Back To Login</a></li>
						</ul>
					</div>
					<p>Developed By: <a href="mailto:ajaykiet2@gmail.com">Ajay Kumar</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $source = isset($response->source) ? $response->source : "login"; ?>
<script>
$(document).ready(function(){
	$("#login-container").hide();
	$("#forgot-container").hide();
	var source = '<?=$source;?>';
	
	if(source === 'login'){
		$("#login-container").show();
		$("#forgot-container").hide();
	}else if(source === 'forgotPassword'){
		$("#login-container").hide();
		$("#forgot-container").show();
	}
	
	$("#forgot-password").click(function(){
		$("form .alert").remove();
		$("#login-container").hide();
		$("#forgot-container").show();
	});
	
	$("#back-login").click(function(){
		$("form .alert").remove();
		$("#login-container").show();
		$("#forgot-container").hide();
	});
});
</script>
</body>
</html>

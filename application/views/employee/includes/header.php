<?php $loggedInEmployee = $env['loggedInEmployee'];?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Employee Portal | HRD Foundation - India</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,300,500,700&amp;subset=latin,latin-ext">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-fileinput/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/nvd3/nv.d3.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/OwlCarousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/jquery-confirm/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/hrd-foundation-admin.css">
	<link rel="stylesheet" type="text/css" href="/assets/libraries/pace/pace.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/libraries/loader/jquery-loading.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/my_styling.css"/>

	<script type="text/javascript" src="/assets/js/jquery-2.0.3.js"></script>

	<link rel="stylesheet" src="/assets/css/jquery.countdownTimer.min.css"></script>
</head>

<body class="open hide-secondary-sidebar">
    <div class="admin-wrapper">
		<div class="admin-navigation">
			<div class="admin-navigation-inner">
				<nav>
					<ul class="menu">
						<li class="avatar">
							<a href="#">
								<img src="/assets/img/tmp/agents/avatar.png" alt="">
								<span class="avatar-content">
									<span class="avatar-title"><?=$loggedInEmployee->username;?></span>
									<span class="avatar-subtitle"><?=$loggedInEmployee->role;?></span>
								</span>
							</a>
						</li>
						<li class="">
							<a href="/employee/dashboard"><strong><i class="fa fa-dashboard"></i></strong> <span>Dashboard</span></a>
						</li>
						<li class="">
							<a href="/employee/glossary"><strong><i class="fa fa-th-list"></i></strong> <span>Glossary</span></a>
						</li>
						<li class="">
							<a href="/employee/account"><strong><i class="fa fa-lock"></i></strong> <span>Account</span></a>
						</li>
						<li>
							<a href="/employee/logout"><strong><i class="fa fa-sign-out"></i></strong> <span>Logout</span></a>
						</li>
					</ul>
				</nav>
			   
				<div class="layer"></div>
			</div>
		</div>
        <div class="admin-content">
            <div class="admin-content-inner">
                <div class="admin-content-header">
                    <div class="admin-content-header-inner">
                        <div class="container-fluid">
                            <div class="admin-content-header-logo">
								<img src="/assets/img/hrdlogo.jpg" class="img img-responsive" style="height:40px"/>
							</div>
                            <div class="admin-content-header-menu">
                                <ul class="admin-content-header-menu-inner collapse">
                                    <li><a href="/employee/guidelines">Guidelines</a></li>
                                    <li><a href="/employee/logout">Logout</a></li>
                                </ul>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".admin-content-header-menu-inner">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin-content-main">
                    <div class="admin-content-main-inner">
                        <div class="container-fluid" id="employee-content-body">
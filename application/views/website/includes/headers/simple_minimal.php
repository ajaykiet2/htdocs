<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<title>HRD Foundation-India</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Roboto:400,300,500,700&amp;subset=latin,latin-ext">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/Font-Awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-fileinput/css/fileinput.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/jquery-confirm/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/nvd3/nv.d3.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libraries/OwlCarousel/owl-carousel/owl.carousel.css">
	<link href="/assets/libraries/froala_editor/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/hrd-foundation.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/website.extra.css">
	<script type="text/javascript" src="/assets/js/jquery.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="/assets/js/jquery.form.min.js"></script>
	<link rel="stylesheet" href="/assets/libraries/loader/jquery-loading.min.css"/>
	<script type="text/javascript" src="/assets/libraries/loader/jquery-loading.js"></script>
	<script type="text/javascript" src="/assets/libraries/jquery-confirm/jquery-confirm.min.js"></script>
</head>
<body>
<input type="hidden" id="csrfID" name="csrf_ID" value="<?=$this->security->get_csrf_hash();?>" />
<div class="page-wrapper">
	<div class="header-topbar">
       <div class="container">
           <div class="header-topbar-right hidden-xs">
              <strong><i class="fa fa-phone"></i> +91 <?=PORTAL_MOBILE;?></strong> | 
              <strong><i class="fa fa-envelope"></i> <?=PORTAL_EMAIL;?></strong>
           </div><!-- /.header-topbar-left -->

           <div class="header-topbar-left hidden-sm hidden-xs">
               <ul class="breadcrumb">
                   <li class="active">Professionally Managed Institute- since 1998</li>
               </ul><!-- /.header-topbar-social -->
           </div><!-- /.header-topbar-right -->
       </div><!-- /.container -->
   </div>
	<div class="header header-minimal">
		<div class="header-wrapper">
			<div class="container">
				<div class="header-inner">
					<div class="header-main">
						<div class="header-title">
							<a href="/">
								<img src="/assets/img/hrdlogo.png" alt="HRD Foundation - India">
								<strong class="hidden-xs">HRD FOUNDATION - INDIA<sup><small>&reg;</small></sup></strong>
							</a>
						</div><!-- /.header-title -->

						<div class="header-navigation">
							<div class="nav-main-wrapper">
								<div class="nav-main-title visible-xs">
									<a href="/">
										<img src="/assets/img/hrdlogo.png" alt="HRD Foundation - India">
										HRD
									</a>
								</div><!-- /.nav-main-title -->

								<div class="nav-main-inner">
									<nav>
										<ul id="nav-main" class="nav nav-pills">
											<?php foreach($env['menus'] as $menu):?>
												<li class="important <?=$menu->class;?>">
													<a href="<?=$menu->link;?>"><?=$menu->name;?></a>
												</li>
											<?php endforeach;?>
										</ul><!-- /.nav -->
									</nav>
								</div><!-- /.nav-main-inner -->
							</div><!-- /.nav-main-wrapper -->

							<button type="button" class="navbar-toggle">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div><!-- /.header-navigation -->
					</div><!-- /.header-main -->
				</div><!-- /.header-inner -->
			</div><!-- /.container -->
		</div><!-- /.header-wrapper -->
	</div>
	
	
	
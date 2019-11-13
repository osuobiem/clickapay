<!DOCTYPE html>
<html>

<head>

	<!-- Basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	

	<title><?=$title?></title>
	<!-- Favicon -->
	<link rel="icon" href="<?=base_url()?>assets/img/favicon.png" type="image/png">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">

	<!-- <?=base_url()?>main-assets/vendor CSS -->
	<link rel="stylesheet" href="<?=base_url()?>main-assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>main-assets/vendor/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="<?=base_url()?>main-assets/vendor/animate/animate.min.css">

	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?=base_url()?>main-assets/css/theme.css">
	<link rel="stylesheet" href="<?=base_url()?>main-assets/css/theme-elements.css">

	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-4360578137382445",
			enable_page_level_ads: true
		});
	</script>

	<!-- Demo CSS -->


	<!-- Skin CSS -->
	<link rel="stylesheet" href="<?=base_url()?>main-assets/css/skins/skin-corporate-9.css">

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="<?=base_url()?>main-assets/css/custom.css">

	<!-- Head Libs -->
	<script src="<?=base_url()?>main-assets/vendor/jquery/jquery.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148177933-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-148177933-1');
	</script>

</head>

<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay
	data-plugin-options="{'hideDelay': 500}">
	<div class="loading-overlay">
		<div class="bounce-loader">
			<div style="background: #558b2fd9;" class="bounce1"></div>
			<div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
			<div style="background: #558b2fd9;" class="bounce3"></div>
		</div>
	</div>

	<div class="body" id="bod">
		<header id="header" class="header-effect-shrink"
			data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
			<div class="header-body border-top-0">
				<div class="header-container container-fluid px-lg-5">
					<div class="header-row">
						<div class="header-column header-column-border-right flex-grow-0">
							<div class="header-row pr-4">
								<div class="header-logo">
									<a id="account" href="<?=base_url()?>">
										<img alt="Clickapay.ng" width="auto" height="48" data-sticky-width="auto" data-sticky-height="40"
											src="<?=base_url()?>assets/img/cp-logo-full.png">
									</a>
								</div>
							</div>
						</div>
						<div class="header-column">
							<div class="header-row">
								<div class="header-nav header-nav-links justify-content-center">
									<div
										class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
										<nav class="collapse header-mobile-border-top">
											<ul class="nav nav-pills" id="mainNav">
												<li> <a href="<?=base_url('about-us')?>"
														class="<?=$_SESSION['page'] == 'about' ? 'active': ''?>"> About Us</a>
												</li>
												<li> <a class="<?=$_SESSION['page'] == 'home' ? 'active': ''?>" href="<?=base_url()?>"> Home
													</a>
												</li>
												<li> <a href="<?=base_url('faq')?>" class="<?=$_SESSION['page'] == 'faq' ? 'active': ''?>"> FAQ
													</a>
												</li>
												<? if(isset($_SESSION['user'])) {?>
												<li class="d-block d-sm-none"> <a href="<?=base_url('user/logout')?>"> Logout </a>
												</li>
												<? } ?>
											</ul>
										</nav>
									</div>
								</div>
							</div>
						</div>
						<div class="d-none d-sm-block">
							<div class="header-column header-column-border-right flex-grow-0">
								<div class="header-row pr-4 justify-content-end">
									<ul class="header-social-icons social-icons d-none d-sm-block social-icons-clean m-0">
										<?php if(array_key_exists('user', $_SESSION)): ?>
										<li><span id="mon" title="My Balance"><strong><i class="fa fa-coins"></i>&nbsp;&nbsp;₦
													<?=$bal?></span></strong></li>
										<?php else: ?>
										<li><a id="cp-primary" href="#loginModal" data-toggle="modal" title="Login"><i
													class="fa fa-sign-in-alt"></i>&nbsp;&nbsp;<span>Login</span></a></li>
										<?php endif ?>
									</ul>
								</div>
							</div>
						</div>

						<div class="header-column header-column-border-left flex-grow-0 justify-content-center">
							<div class="header-row pl-4 justify-content-end" style="padding-left: 0 !important;">
								<ul class="header-social-icons social-icons social-icons-clean m-0 d-none d-sm-block">
									<?php if(array_key_exists('user', $_SESSION)): ?>
									<li class="dropdown"><a id="cp-primary2" class="dropdown-toggle" data-toggle="dropdown"
											style="margin-left: 1.5rem;" href="#" title="My Account"><i
												class="fa fa-user"></i>&nbsp;&nbsp;<span>My Account</span></a>
										<ul id="menu-h" class="dropdown-menu">
											<li id="menu-li"><a href="<?=base_url('user/dashboard')?>"><i
														class="fa fa-home"></i>&nbsp;&nbsp;Dashboard</a></li>
											<li id="menu-li"><a href="<?=base_url('user/profile')?>"><i class="fa fa-user"></i>&nbsp;&nbsp;My
													Profile</a></li>
											<li id="menu-li"><a href="<?=base_url('user/bank')?>"><i
														class="fa fa-university"></i>&nbsp;&nbsp;Bank Details</a></li>
											<li id="menu-li"><a href="<?=base_url('user/withdraw')?>"><i
														class="fa fa-coins"></i>&nbsp;&nbsp;Withdraw</a></li>
											<hr id="menu-hr">
											<li id="menu-li"><a href="<?=base_url('user/logout')?>"><i
														class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;Logout</a>
											</li>
										</ul>
									</li>
									<?php else: ?>
									<li style="margin-left: 1.5rem;"><a id="cp-primary" href="#regModal" data-toggle="modal"
											title="Register"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;<span>Register</span></a></li>
									<?php endif ?>
								</ul>
								<?php if(array_key_exists('user', $_SESSION)): ?>
								<a class="d-block d-sm-none" id="mob-a" href="<?=base_url('user/dashboard')?>" title="My Account"><i
										class="fa fa-user-circle"></i></a>
								<?php else: ?>
								<a class="d-block d-sm-none" id="mob-a" href="#loginModal" data-toggle="modal" title="Login"><i
										class="fa fa-user-circle"></i></a>
								<?php endif ?>

								<button class="btn header-btn-collapse-nav ml-0 ml-sm-3" style="background: #558b2fd9;"
									data-toggle="collapse" data-target=".header-nav-main nav">
									<i class="fas fa-bars"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
		</header>
		<div class="alert alert-success" id="message" <?=isset($_SESSION['success']) ? 'style="display: block"' : 'style="display: none"'?>>
			<?=isset($_SESSION['success']) ? $_SESSION['success'] : ''?>
		</div>
		<div class="alert alert-danger" id="error" <?=isset($_SESSION['error']) ? 'style="display: block"' : 'style="display: none"'?>>
			<?=isset($_SESSION['error']) ? $_SESSION['error'] : ''?>
		</div>
		<!-- Bidvertiser2009826 -->
		<!-- <script data-cfasync='false' type='text/javascript' src='//p367765.clksite.com/adServe/banners?tid=367765_721145_0'></script> -->
		<!-- <div class="shareaholic-canvas" data-app="recommendations" data-app-id="28349500"></div> -->
<footer id="footer" class="mt-0">
	<div class="footer-copyright footer-copyright-style-2">
		<div class="col text-center">
			<span id="color">Follow Us on</span>
			<ul
				class="footer-social-icons social-icons social-icons-clean social-icons-big social-icons-opacity-light social-icons-icon-light mt-1">
				<li class="social-icons-facebook"><a href="https://web.facebook.com/clickapay/"
						target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
				<li class="social-icons-instagram"><a href="https://www.instagram.com/clickapay.ng/"
						target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
				<li class="social-icons-twitter"><a href="https://twitter.com/clickapay"
						target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
			</ul>
		</div>
		<div class="container-fluid px-lg-5">
			<div class="row py-4">
				<div class="col-lg-8 text-center text-lg-left mb-2 mb-lg-0">
					<p>
						<span class="pr-0 pr-md-3 d-block d-md-inline-block"><i
								class="fa fa-phone text-color-primary top-1 p-relative" id="color"></i><a href="tel:+234 705 697 6282"
								class="text-color-light opacity-7 pl-1"> +234 705 697 6282</a></span>
						<span class="pr-0 pr-md-3 d-block d-md-inline-block"><i
								class="far fa-envelope text-color-primary top-1 p-relative" id="color"></i><a
								href="mailto:support@clickapay.com.ng" class="text-color-light opacity-7 pl-1">support@clickapay.com.ng</a></span>
					</p>
				</div>
				<div
					class="col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-end mb-4 mb-lg-0 pt-4 pt-lg-0">
					<p><a href="<?=base_url()?>">Clickapay</a> © <?=date('Y')?></p>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="_ta4ka2na" value="<?=$_token?>" />
	<input type="hidden" id="5rala" value="<?=base_url()?>" />
</footer>
</div>

<!-- Modals -->

<!-- Login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
	style="display: none;" aria-hidden="true">
	<div class="modal-dialog" style="margin-top: 1.5rem;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="formModalLabel">Welcome back</h4>
				<button type="button" class="close" id="logClose" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" style="padding-bottom: 0;">
				<form id="loginForm" method="post" style="padding: 5px;" class="needs-validation" novalidate="novalidate">
					<div class="alert alert-danger alert-dismissible" id="loginError" style="display: none">
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label class="font-weight-bold text-dark text-2">Email or Phone</label>
							<input type="text" id="email-phone" style="font-size: 1rem;" value="" class="form-control form-control-lg"
								required="" placeholder="Email or Phone number">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col">
							<a class="float-right" href="#fpModal" onclick="$('#logClose').click()" data-toggle="modal">Did you forget your password?</a>
							<label class="font-weight-bold text-dark text-2">Password</label>
							<input type="password" id="lpassword" placeholder="Password" style="font-size: 1rem;" value=""
								class="form-control form-control-lg" required="">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-lg-6">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" checked class="custom-control-input" id="rememberMe">
								<label class="custom-control-label text-2" for="rememberMe">Remember Me</label>
							</div>
						</div>
						<div class="form-group col-lg-6">
							<input type="submit" id="loginButton" value="Login"
								class="btn btn-primary btn-modern float-right" data-loading-text="Loading...">
						</div>
					</div>
				</form>
				<div class="bounce-loader" style="display: none" id="loginLoader">
					<div style="background: #558b2fd9;" class="bounce1"></div>
					<div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
					<div style="background: #558b2fd9;" class="bounce3"></div>
				</div>
			</div>
			<div class="modal-footer" style="padding: 0 20px;">
				<p>Don't have an account? <a href="#regModal" onclick="$('#logClose').click()" data-toggle="modal">Register</a>
				</p>
			</div>
		</div>
	</div>
</div>

<input type="text" hidden id="action"
	value="<?=array_key_exists('action', $_SESSION) ? $_SESSION['action'] : 'No Action'?>" />
<?php $_SESSION['action'] = 'No Action'; ?>

<!-- Register -->
<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
	style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" style="margin-top: 1.5rem;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="formModalLabel">Register and start earning</h4>
				<button type="button" id="regClose" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" style="padding-left: 5px; padding-right: 5px; padding-bottom: 0;">
				<form id="regForm" method="post" style="padding: 5px;" class="needs-validation" novalidate="novalidate">
					<div class="alert alert-danger alert alert-dismissible" id="regError" style="display: none">
					</div>
					<div class="form-row">
						<div class="form-group col" style="padding: 0;">
							<div class="col-sm-6" style="float: left;">
								<label class="font-weight-bold text-dark text-2">Firstname <span style="color: #ff0000">*</span></label>
								<input type="text" id="fname" style="font-size: 1rem;" value="" class="form-control form-control-lg"
									required="" placeholder="Your first name">
							</div>
							<div class="col-sm-6" style="float: left;">
								<label class="font-weight-bold text-dark text-2">Lastname <span style="color: #ff0000">*</span></label>
								<input type="text" id="lname" style="font-size: 1rem;" value="" class="form-control form-control-lg"
									required="" placeholder="Your last name">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col" style="padding: 0;">
							<div class="col-sm-6" style="float: left;">
								<label class="font-weight-bold text-dark text-2">Email <span style="color: #ff0000">*</span></label>
								<input type="email" id="email" style="font-size: 1rem;" value="" class="form-control form-control-lg"
									required="" placeholder="mail@example.com">
							</div>
							<div class="col-sm-6" style="float: left;">
								<label class="font-weight-bold text-dark text-2">Phone <span style="color: #ff0000">*</span></label>
								<input type="tel" size="11" minlength="11" maxlength="11" pattern="[0-9]{11}" id="phone"
									style="font-size: 1rem;" value="" class="form-control form-control-lg" required=""
									placeholder="08012345678">
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col" style="padding: 15px; padding-top: 0; margin-bottom: 0;">
							<label class="font-weight-bold text-dark text-2">Password <span style="color: #ff0000">*</span></label>
							<div class="input-group">
								<input type="password" id="rpassword" placeholder="Password" style="font-size: 1rem;" value=""
									class="form-control form-control-lg" required="">
								<span class="input-group-append">
									<span class="input-group-text" id="showPass"
										style="background: inherit; border-left: 0; border-color: #e9e9e9;">
										<i id="passEye" class="fas fa-eye-slash" style="font-size: 12px;"></i>
									</span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-row" style="justify-content: flex-end; padding: 0 15px;">
						<div class="form-group">
							<input type="submit" id="regButton" value="Register"
								class="btn btn-primary btn-modern float-right" data-loading-text="Loading...">
						</div>
					</div>
				</form>
				<div class="bounce-loader" style="display: none" id="regLoader">
					<div style="background: #558b2fd9;" class="bounce1"></div>
					<div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
					<div style="background: #558b2fd9;" class="bounce3"></div>
				</div>
			</div>
			<div class="modal-footer" style="padding: 0 20px;">
				<p>Already have an account? <a href="#loginModal" onclick="$('#regClose').click()" data-toggle="modal">Login</a>
				</p>
			</div>
		</div>
	</div>
</div>

<!-- Forgot Password -->
<div class="modal fade" id="fpModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
	style="display: none;" aria-hidden="true">
	<div class="modal-dialog" style="margin-top: 1.5rem;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="formModalLabel">Password Reset</h4>
				<button type="button" class="close" id="logClose" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" style="padding-bottom: 0;">
				<form id="fpForm" method="post" style="padding: 5px;" class="needs-validation" novalidate="novalidate">
					<div class="alert alert-danger alert-dismissible" id="fpError" style="display: none">
					</div>
					<div class="form-row">
						<div class="form-group col">
							<label class="font-weight-bold text-dark text-2">Email</label>
							<input type="text" id="fpemail" style="font-size: 1rem;" value="" class="form-control form-control-lg"
								required="" placeholder="Your registered email address">
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-lg-12">
							<input type="submit" id="fpButton" value="Continue"
								class="btn btn-primary btn-modern float-right" data-loading-text="Loading...">
						</div>
					</div>
				</form>
				<div class="bounce-loader" style="display: none;" id="fpLoader">
					<div style="background: #558b2fd9;" class="bounce1"></div>
					<div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
					<div style="background: #558b2fd9;" class="bounce3"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Vendor -->
<script src="<?=base_url()?>main-assets/vendor/popper/umd/popper.min.js"></script>
<script src="<?=base_url()?>main-assets/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?=base_url()?>main-assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?=base_url()?>main-assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>main-assets/vendor/common/common.min.js"></script>
<script src="<?=base_url()?>main-assets/vendor/jquery.validation/jquery.validate.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?=base_url()?>main-assets/js/theme.js"></script>

<!-- Theme Custom -->
<? if(!isset($_SESSION['active'])) {?>
<script src="<?=base_url()?>main-assets/js/custom.js"></script>
<? } ?>

<!-- Theme Initialization Files -->
<script src="<?=base_url()?>main-assets/js/theme.init.js"></script>
</body>

</html>
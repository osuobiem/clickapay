<div role="main" class="main">
  <section class="page-header page-header-classic"
    style="background: url('<?=base_url()?>main-assets/img/image10.png'); background-position-y: -515px; padding: 0; margin-bottom: 10px;">
    <div style="background: #00000054; padding: 15px 0;">
      <div class="container-fluid px-lg-5">
        <div class="row">
          <div class="col p-static">
            <h1 style="font-size: 24px;" data-title-border>My Account</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container-fluid px-lg-5">

    <div class="col-sm-12" style="padding: 0;">
      <div class="col-lg-8 col-sm-12" id="main-half">
        <div class="overflow-hidden mb-1">
          <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">Reset</strong> Password</h2>
        </div>
        <form method="POST">
          <div class="form-row">
            <div class="form-group col" style="padding: 15px; padding-top: 0; margin-bottom: 0;">
              <label class="font-weight-bold text-dark text-2">New Password</label>
              <div class="input-group">
                <input type="password" name="password" id="pro-password" placeholder="Your new password"
                  style="font-size: 1rem;" value="" class="form-control form-control-lg">
                <span class="input-group-append">
                  <span class="input-group-text" id="showProPass"
                    style="background: #fff; border: solid .5px #dadbd9; border-left: 0;">
                    <i id="proEye" class="fas fa-eye-slash" style="font-size: 12px;"></i>
                  </span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-row" style="justify-content: flex-end; padding: 0 15px;">
            <div class="form-group">
              <input type="submit" value="Reset Password" class="btn btn-primary btn-modern float-right"
                data-loading-text="Loading...">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="col-sm-4" style="float: left; margin-bottom: 10px;">
      <div style="border: solid 1px; text-align: center; border-radius: 3px;">
        <p>Sponsored Content</p>
      </div>
    </div>

  </div>
</div>
<input type="hidden" id="old-photo" />
<form method="POST" enctype="multipart/form-data" id="photo-form">
  <input hidden="" type="file" id="user-photo-file" class="profile-image-input" accept="image/*">
</form>
<div class="bounce-loader" id="loader" style="display: none;">
  <div style="background: #558b2fd9;" class="bounce1"></div>
  <div style="border: solid 0.5px #040404d9; background: #ffffff;" class="bounce2"></div>
  <div style="background: #558b2fd9;" class="bounce3"></div>
</div>
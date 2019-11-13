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

    <div class="col-sm-10" style="padding: 0;">
      <div class="col-lg-2 col-sm-3" id="full-side">
        <div class=" d-flex justify-content-center mb-1">
          <div class="profile-image-outer-container" style="text-align: -webkit-center" id=" photo-frame">
            <h4>
              <?=$_SESSION['user']->firstname.' '.$_SESSION['user']->lastname?>
            </h4>
          </div>
        </div>

        <aside class="sidebar mt-1" id="sidebar">
          <ul class="nav nav-list flex-column mb-1">
            <li class="nav-item<?=$_SESSION['active']=='dashboard'?'-active':''?>"
              onclick="loadView('<?=base_url('view/dashboard')?>')" id="dashboard"><a class="nav-link"
                href="#">Dashboard</a></li>
            <li class="nav-item<?=$_SESSION['active']=='profile'?'-active':''?>" id="profile"
              onclick="loadView('<?=base_url('view/profile')?>')"><a class="nav-link" href="#">My Profile</a></li>
            <li class="nav-item<?=$_SESSION['active']=='bank'?'-active':''?>" id="bank"
              onclick="loadView('<?=base_url('view/bank')?>')"><a class="nav-link" href="#">Bank Details</a></li>
            <li class="nav-item<?=$_SESSION['active']=='withdraw'?'-active':''?>" id="withdraw"
              onclick="loadView('<?=base_url('view/withdraw')?>')"><a class="nav-link" href="#">Withdraw</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=base_url('user/logout')?>">Logout</a></li>
          </ul>
        </aside>

      </div>
      <div class="col-lg-10 col-sm-9" id="main-half">
        <?=$content?>
      </div>
    </div>
    <div class="col-sm-2" style="float: left; margin-bottom: 10px;">
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

<input type="hidden" id="current" value="<?=$_SESSION['active']?>" />
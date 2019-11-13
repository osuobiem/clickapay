<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$title?></title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link rel="icon" href="favicon.png" type="image/png">
  <link rel="stylesheet"
    href="../../../../fonts.googleapis.com/css66e6.css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/perfect-scrollbar.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/morris.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-jvectormap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/horizontal-timeline.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/dropzone.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/ion.rangeSlider.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/ion.rangeSlider.skinFlat.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/datatables.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/fullcalendar.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
</head>

<body>
  <div class="wrapper">
    <div class="m-account-w" data-bg-img="<?=base_url()?>assets/img/account/wrapper-bg.jpg">
      <div class="m-account">
        <div class="row no-gutters" style="justify-content: center;">
          <div class="col-md-6">
            <div class="m-account--form-w">
              <div class="m-account--form">
                <div class="logo"> <img src="<?=base_url()?>assets/img/cp-logo-full-white.png" style="max-width: 65%;" alt=""> </div>
                <form method="post"> <label class="m-account--title">Admin Login</label>
                  <div class="form-group">

                    <?php if($this->session->flashdata()): ?>
                      <span class="text-danger">
                        <p style="text-align: center;"><?php echo $this->session->flashdata('error'); ?></p>
                      </span>
                    <?php endif ?>
                    
                    <div class="input-group">
                      <div class="input-group-prepend"> <i class="fas fa-user"></i> </div><input type="text"
                        name="username" placeholder="Username" class="form-control" autocomplete="off" required>
                    </div>
                    <span class="text-danger"><?=form_error('username')?></span>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend"> <i class="fas fa-key"></i> </div><input type="password"
                        name="password" placeholder="Password" class="form-control" autocomplete="off" required>
                    </div>
                    <span class="text-danger"><?=form_error('password')?></span>
                  </div>
                  <div class="m-account--actions"><button
                      type="submit" class="btn btn-rounded btn-info" style="width: 100%;">Login</button> </div>
                  <div class="m-account--alt">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>
  <script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>assets/js/perfect-scrollbar.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.sparkline.min.js"></script>
  <script src="<?=base_url()?>assets/js/raphael.min.js"></script>
  <script src="<?=base_url()?>assets/js/morris.min.js"></script>
  <script src="<?=base_url()?>assets/js/select2.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery-jvectormap.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery-jvectormap-world-mill.min.js"></script>
  <script src="<?=base_url()?>assets/js/horizontal-timeline.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery.steps.min.js"></script>
  <script src="<?=base_url()?>assets/js/dropzone.min.js"></script>
  <script src="<?=base_url()?>assets/js/ion.rangeSlider.min.js"></script>
  <script src="<?=base_url()?>assets/js/datatables.min.js"></script>
  <script src="<?=base_url()?>assets/js/main.js"></script>
</body>

</html>
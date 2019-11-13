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

  <link rel="icon" href="<?=base_url()?>assets/img/favicon.png" type="image/png">

  <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <header class="navbar navbar-fixed">
      <div class="navbar--header"> <div class="logo"> <img src="<?=base_url()?>assets/img/cp-logo-full-white.png" style="height: 100%; margin-left: 12%;" alt=""> </div> <a
          href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar"> <i class="fa fa-bars"></i> </a>
      </div><a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar"> <i class="fa fa-bars"></i>
      </a>
      <div class="navbar--nav ml-auto">
        <ul class="nav">
          <!-- <li class="nav-item"> <a href="mailbox_inbox.html" class="nav-link"> <i class="fa fa-envelope"></i> <span
                class="badge text-white bg-blue">4</span> </a> </li> -->
          <li class="nav-item dropdown nav--user"> <a href="#" class="nav-link" data-toggle="dropdown"> <span><?=$_SESSION['admin']->name?></span> <i
                class="fa fa-angle-down"></i> </a>
            <ul class="dropdown-menu">
              <!-- <li class="dropdown-divider"></li> -->
              <li><a href="<?=base_url()?>1dama3na/logout"><i class="fa fa-power-off"></i>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </header>
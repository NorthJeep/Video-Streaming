<?php

if(!defined('ADMIN_VIEW')){
  die("<strong>403:</strong> Direct Access Forbidden!");
}

if (isset($_GET['logout'])){

    session_start();
    session_unset();
    session_destroy();
}

?>

<?php 
include 'connection.php';

session_start();
if(empty($_SESSION['sa_user']) && $_SESSION['role'] != 'SUPERADMIN'){
  header('Location: /ibc/login');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="img/ibc_logo.ico">

    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <!-- Custom styles for this template -->

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
          <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
          </div>
          <!--logo start-->
          <a href="#" class="logo" > <img src="img/ibc_logo.png" style="height: 30px; width: 30px; margin-right: 5px; margin-left: 10px;"></a>
          <!--logo end-->
          </div>
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <i class="icon-user" style="margin-right: 5px;"></i>
                          <span class="username"><?php echo $_SESSION['sa_user']; ?></span>
                          <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu extended">
                          <div class="log-arrow-up"></div>
                          <li><a href="#chnge_pass" data-toggle="modal"><i class=" icon-suitcase" style="margin-right: 10px;"></i> Change Password</a></li>
                          <li><a href="" id="logout_opt"><i class="icon-key" style="margin-right: 10px;"></i> Logout</a></li>
                      </ul>
                  </li>
                  <!-- user login dropdown end -->
              </ul>
          </div>
      </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="a_logs.php">
                          <i class="icon-file-text"></i>
                          <span>Logs</span>
                      </a>
                  </li>
                  <li>
                      <a href="a_adduser.php">
                          <i class="icon-user"></i>
                          <span>Add User</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
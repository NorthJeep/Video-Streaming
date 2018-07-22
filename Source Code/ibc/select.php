<?php


if (isset($_GET['logout'])){

    session_start();
    session_unset();
    session_destroy();

}

include 'connection.php';

include 'get_ips.php';

if(authenticateIP($connect) == 'unregistered'){
  die('<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="Mosaddek">
            <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
            <link rel="shortcut icon" href="img/favicon.png">

            <title>401</title>

            <!-- Bootstrap core CSS -->
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/bootstrap-reset.css" rel="stylesheet">
            <!--external css-->
            <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
            <!-- Custom styles for this template -->
            <link href="css/style.css" rel="stylesheet">
            <link href="css/style-responsive.css" rel="stylesheet" />
        </head>

          <body class="body-404" style="background-color: #D32F2F;">

            <div class="container">

              <section class="error-wrapper" style="margin-top: 70px;">
                  <i class="icon-404"></i>
                  <h1 style="margin-top: 20px;">401</h1>
                  <h2>Access denied.</h2>
                  <p>You do not have the permission to access the page. Please contact your administrator.</p>
                  <br/>
                  <center><img src="img/ibc_logo.png" style="height: 50px;"></center>
              </section>

            </div>


          </body>
        </html>');
  exit;
}

define('SELECT_VIEW', true);

session_start();
if (empty($_SESSION['user'])){
 
  header("Location:  login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="img/ibc_logo.ico">

    <title>Select Template - Engage</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->

    <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/jquery-multi-select/css/multi-select.css" />

    <link href="assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/gallery.css" />

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="full-width">
      <!--header start-->
      <header class="header white-bg">
          <!-- <div class="sidebar-toggle-box">
              <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
          </div> -->
          <!--logo start-->
          <a href="#" class="logo" > <img src="img/ibc_logo.png" style="height: 30px; width: 30px; margin-right: 5px; margin-left: 10px;"></a>
          <!--logo end-->
          <!-- <div class="nav notify-row" id="top_menu">
          </div> -->
          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
                  <!-- <li>
                      <input type="text" class="form-control search" placeholder="Search">
                  </li> -->
                  <!-- user login dropdown start-->
                  <li class="dropdown">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                          <i class="icon-user" style="margin-right: 5px;"></i>
                          <span class="username"><?php echo $_SESSION['user']; ?></span>
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

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                      <strong>Select your desired template.</strong>
                  </header>
                  <div class="panel-body">
                      <ul class="grid cs-style-3">
                          <li>
                              <figure>
								<form method="post" action="/ibc/edit">
                                  <img src="img/gallery/1.png" alt="img04">
                                  <figcaption>
                                      <h3>Three Sections</h3>
                                      <span>2 video areas, 1 slider</span>
									  <input type="hidden" id="edit" name="edit" value="1">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
								</form>
                              </figure>
                          </li>
						  <li>
                              <figure>
								<form method="post" action="/ibc/edit">
                                  <img src="img/gallery/2.png" alt="img04">
                                  <figcaption>
                                      <h3>Three Sections - Inverted</h3>
                                      <span>2 video areas, 1 slider</span>
                                      <input type="hidden" id="edit" name="edit" value="2">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
								</form>
                              </figure>
                          </li>
						  <li>
                              <figure>
								<form method="post" action="/ibc/edit">
                                  <img src="img/gallery/4.png" alt="img04">
                                  <figcaption>
                                      <h3>Three Sections</h3>
                                      <span>Main slider, 2 video areas</span>
                                      <input type="hidden" id="edit" name="edit" value="3">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
								</form>
                              </figure>
                          </li>
						  <li>
                              <figure>
								<form method="post" action="/ibc/edit">
                                  <img src="img/gallery/3.png" alt="img04">
                                  <figcaption>
                                      <h3>Two Sections</h3>
                                      <span>2 Main video areas</span>
                                      <input type="hidden" id="edit" name="edit" value="4">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
								</form>
                              </figure>
                          </li>
						  <li>
                              <figure>
								<form method="post" action="/ibc/edit">
                                  <img src="img/gallery/5.png" alt="img04">
                                  <figcaption>
                                      <h3>Two Sections - No header</h3>
                                      <span>2 Main video areas</span>
                                      <input type="hidden" id="edit" name="edit" value="5">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
								</form>
                              </figure>
                          </li>
                          <li>
                              <figure>
								<form method="post" action="/ibc/edit">
                                  <img src="img/gallery/6.png" alt="img01">
                                  <figcaption>
                                      <h3>Four Sections</h3>
                                      <span>2 video areas, 2 sliders</span>
                                      <input type="hidden" id="edit" name="edit" value="6">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
                              </figure>
							</form>
                          </li>
                          <li>
                              <figure>
                <form method="post" action="/ibc/edit">
                                  <img src="img/gallery/7.png" alt="img01">
                                  <figcaption>
                                      <h3>One Section</h3>
                                      <span>1 whole video section</span>
                                      <input type="hidden" id="edit" name="edit" value="7">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
                              </figure>
              </form>
                          </li>
                           <li>
                              <figure>
                <form method="post" action="/ibc/edit">
                                  <img src="img/gallery/8.png" alt="img04">
                                  <figcaption>
                                      <h3>Two Sections - No header, No Scroller</h3>
                                      <span>Main Video - Left, Main Slider - Right</span>
                                      <input type="hidden" id="edit" name="edit" value="8">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
                </form>
                              </figure>
                          </li>
              <li>
                              <figure>
                <form method="post" action="/ibc/edit">
                                  <img src="img/gallery/9.png" alt="img04">
                                  <figcaption>
                                      <h3>Two Sections - No header, No Scroller</h3>
                                      <span>2 Main Slider areas</span>
                                      <input type="hidden" id="edit" name="edit" value="9">
                                      <button type="submit" class="btn btn-sm btn-danger pull-right">Select Template</button>
                                  </figcaption>
                </form>
                              </figure>
                          </li>
                      </ul>

                  </div>
              </section>
              <!-- page end-->
          </section>
      </section>

      <?php include 'include_changepass.php'; ?>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <span>2016 &copy; by Internetworking and Broadband Consulting Co., Ltd. Philippines.</span>
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/fancybox/source/jquery.fancybox.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="js/respond.min.js" ></script>

    <script src="js/modernizr.custom.js"></script>
    <script src="js/toucheffects.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>


  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

      $("form").submit(function () {
        $.ajax({
              url: "refresh.php",
              type: "POST",
              data: {'rf': '1'}
          });
      });

    $('#logout_opt').click(function (){
      $.ajax({
          url: '/ibc/edit.php?logout=yes'
      })
    });

  </script>


  </body>
</html>

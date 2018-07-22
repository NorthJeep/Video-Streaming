<!-- Internetworking and Broadband Consulting Co., Ltd. Philippines. -->

<!-- Project "Engage" Version Alpha 1 -->
<!--  - Originally developed by: -->
<!-- John Darren Comador -->
<!-- John Daniel Camontoy -->

<?php

if (isset($_GET['logout'])){

    session_start();
    session_unset();
    session_destroy();

}


include 'connection.php';

define('EDIT_VIEW', true);

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

session_start();
if (empty($_SESSION['user'])){
 
  header("Location:  /ibc/login");
}

  $query = "select * from template where status = 1";
  $exec = mysqli_query($connect, $query);
  if(mysqli_num_rows($exec) > 0){
    $row = mysqli_fetch_array($exec);
    $template_num = $row['id'];
  } else {
    header ("Location: select.php");
  }

if(empty($_POST['edit'])){
	$query = "select * from template where status = 1";
	$exec = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($exec);
	$template_num = $row['id'];
}
else {
	$template_num = $_POST['edit'];
	$query = "select * from template where status = 1";
	$exec = mysqli_query($connect, $query);
	if(mysqli_num_rows($exec) == 0){
		$active = mysqli_query($connect, "update template set status = 1 where id = '$template_num'");
	}
	else {
		$row = mysqli_fetch_array($exec);
		$id = $row['id'];
		$inactive = mysqli_query($connect, "update template set status = 0 where id = '$id'");
		$active = mysqli_query($connect, "update template set status = 1 where id = '$template_num'");
	}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="img/ibc_logo.ico">

    <title>Edit Template <?php echo $template_num ?> - IBC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->

    <link rel="stylesheet" type="text/css" href="assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />

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

          <a href="#" class="logo" > <img src="img/ibc_logo.png" style="height: 30px; width: 30px; margin-right: 5px; margin-left: 10px;"></a>

          <div class="top-nav ">
              <ul class="nav pull-right top-menu">
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
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="#bg-settings" data-toggle="modal">
                          <i class="icon-tint" style="margin-right: 5px;"></i>
                          <span>Background</span>
                      </a>
                  </li>
                  <li>
                      <a href="/ibc">
                          <i class="icon-eye-open" style="margin-right: 5px;"></i>
                          <span>View</span>
                      </a>
                  </li>
                  <li>
                      <a href="/ibc/select">
                          <i class="icon-share-alt" style="margin-right: 5px;"></i>
                          <span>Select Template</span>
                      </a>
                  </li>
                  <li>
                      <a href="" id="reloadDisp">
                          <i class="icon-refresh" style="margin-right: 5px;"></i>
                          <span>Refresh Display</span>
                      </a>
                  </li>
                  <li>
                      <a href="#auto_refresh" data-toggle="modal">
                          <i class="icon-bolt" style="margin-right: 5px;"></i>
                          <span>Set Automatic Refresh</span>
                      </a>
                  </li>
                  <li>
                      <a href="#emer-msg" data-toggle="modal">
                          <i class="icon-warning-sign" style="margin-right: 5px;"></i>
                          <span>Emergency Message</span>
                      </a>
                  </li>
                  <li>
                      <a href="#delete-vid" data-toggle="modal">
                          <i class="icon-trash" style="margin-right: 5px;"></i>
                          <span>Delete Uploaded Files</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
		<?php
			if($template_num == 1){
				include '1.php';
			}
			else if($template_num == 2){
				include '2.php';
			}
			else if($template_num == 3){
				include '3.php';
			}
			else if($template_num == 4){
				include '4.php';
			}
			else if($template_num == 5){
				include '5.php';
			}
			else if($template_num == 6){
				include '6.php';
			}
      else if($template_num == 7){
        include '7.php';
      }
      else if($template_num == 8){
        include '8.php';
      }
      else if($template_num == 9){
        include '9.php';
      }
      
      include 'include_changepass.php';
		?>
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              <span>2016 &copy; Internetworking and Broadband Consulting Co., Ltd. Philippines.</span>
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

  <!--Delete Modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="delete-vid" class="modal fade">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Delete Uploaded Files</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Currently Uploaded Files</label>
                <div class="col-lg-10" style="max-height: 400px; overflow-y: scroll;">
                  <table class="table">
                    <thead style="font-weight: bold; font-style: italic;">
                      <td align="left" width="15%"><input id="selectall" type="checkbox"></td>
                      <td align="left" width="50%">File Name</td>
                      <td align="left" width="30%">File Type</td>
                      <td align="right">Status</td>
                      <td align="right">Template No.</td>
                    </thead>
                    <tbody>
                      <?php
                        $format = ''; $stat = ''; $span_cl = '';

                        $query = mysqli_query($connect, "select * from upload");
                        if ($query->num_rows > 0){
                          while($row = mysqli_fetch_array($query)){
                            $vid_formats = array('mp4', 'MP4', 'avi', 'AVI', 'mkv', 'MKV', 'flv', 'FLV', 'mov', 'MOV');
                            $img_formats = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF', 'mov', 'MOV');

                            if(in_array($row['type'], $vid_formats)){
                              $format = 'Video';
                            } else if (in_array($row['type'], $img_formats)){
                              $format = 'Image';
                            }

                            if($row['status'] == 1){
                              $stat = 'Active'; $span_cl = 'success';
                            } else if($row['status'] == 0){
                              $stat = 'Inactive'; $span_cl = 'default';
                            }
                          echo '
                            <tr>
                              <td width="15%">
                              <input type="hidden" id="edit" name="edit" value="'.$row['template_id'].'">
                              <input type="hidden" name="vid-id" value="'.$row['id'].'"/>
                              <input name="checkbox[]" type="checkbox" value="'.$row['id'].'">
                              </td>
                              <td width="50%">'.$row['name'].'</td>
                              <td width="30%"><input type="hidden" id="type" name="type[]" value="'.strtolower($format.'s').'">'.$format.'</td>
                              <td align="right"><span class="label label-'.$span_cl.'">'.$stat.'</span></td>
                              <td align="right">'.$row['template_id'].'</td>
                            </tr>
                          ';
                          }
                        }
                        else {
                          echo '
                          <tr>
                            <td colspan="3"><span>No videos uploaded.</span></td>
                          </tr>
                          ';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <span style="padding-right: 10px;"><em id="count_sel">No file selected.</em></span>
              <button name="remove-vid" title="Remove Video" class="btn btn-danger"><i class="icon-trash"></i> Delete Selected</button>
            </div>
          </div>
        </div>
      </form>
    </div>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

    <script src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="js/respond.min.js" ></script>


  <!--custom switch-->
  <script src="js/bootstrap-switch.js"></script>

  <!--custom tagsinput-->
  <script src="js/jquery.tagsinput.js"></script>

  <!--custom checkbox & radio-->
  <script type="text/javascript" src="js/ga.js"></script>

  <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  
  <script type="text/javascript" src="assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>

  <!--common script for all pages-->
  <script src="js/common-scripts.js"></script>

  <!--script for this page only-->
  <script src="js/form-component.js"></script>
  <script src="js/advanced-form-components.js"></script>

  <script src="js/form-validation-script.js"></script>
  
  <!--script for refresh, changes in the -->
  <script src="styles/script.js"></script>

  <script src="js/validpass.js"></script>

  <script type="text/javascript">

    $('#logout_opt').click(function (){
      $.ajax({
          url: '/ibc/edit.php?logout=yes'
      })
    });

  </script>

  </body>
</html>

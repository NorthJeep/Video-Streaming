<?php 
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

session_start();
if (!empty($_SESSION['user']))
{
  header("Location:  edit.php");
}
else if (!empty($_SESSION['sa_user']))
{
  header("Location:  a_logs.php");
}
else if (!empty($_SESSION['ibc_user']))
{
  header("Location:  sa_ip.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="img/ibc_logo.ico">

    <title>Login - IBC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
  <body class="login-body">

    <div class="container">

	  <?php

      if(isset($_POST['submit_login'])){
        if(!empty($_POST['admin_username']) && !empty($_POST['admin_password'])){

			$uname = mysqli_real_escape_string($connect, $_POST['admin_username']);
			$pass = mysqli_real_escape_string($connect, $_POST['admin_password']);
		  
			$query = mysqli_query($connect,  "SELECT * from login where username = '$uname'");
			if($query->num_rows == 0) {
			  echo '<div class="col-lg-12">
				<div class="alert alert-block alert-danger fade in">
				  <button data-dismiss="alert" class="close close-sm" type="button">
					<i class="icon-remove"></i>
				  </button>
				  <strong>Oh snap!</strong> Seems like you entered does not exist. Please try again.
				</div>
			  </div>';
			} else {
				$user_row = mysqli_fetch_array($query);
				$decrypt = password_verify($pass, $user_row['password']); // decrypting
				if($decrypt == 1){
					$query = mysqli_query($connect, "SELECT * FROM `login` WHERE `username` = '$uname'");
					if($query->num_rows > 0){
						$row = mysqli_fetch_array($query);
						if($row['role'] == 'SUPERADMIN'){
						session_start();
							$_SESSION['sa_user'] = $row['name'];
							$_SESSION['u_id'] = $row['id'];
							$_SESSION['role'] = $row['role'];
							header("Location:  a_logs.php");
						} else if($row['role'] == 'IBC'){
						session_start();
							$_SESSION['ibc_user'] = $row['name'];
							$_SESSION['u_id'] = $row['id'];
							$_SESSION['role'] = $row['role'];
							header("Location:  sa_ip.php");
						} else if($row['role'] == 'ADMIN'){
						session_start();
							$_SESSION['user'] = $row['name'];
							$_SESSION['u_id'] = $row['id'];
							$_SESSION['role'] = $row['role'];
							header("Location:  edit.php");
						} else {
							echo '
							  <div class="alert alert-block alert-danger fade in">
								<button data-dismiss="alert" class="close close-sm" type="button">
								  <i class="icon-remove"></i>
								</button>
								<strong>Oh snap!</strong> Seems like you entered the wrong credentials. Please try again.
							  </div>
							';
						}
					}
				} else {
					echo '
					  <div class="alert alert-block alert-danger fade in">
						<button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
						</button>
						<strong>Oh snap!</strong> Seems like you entered the wrong credentials. Please try again.
					  </div>
					';
				}
			}
        } else {
          echo '
              <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                  <i class="icon-remove"></i>
                </button>
                <strong>Oh snap!</strong> Seems like you forgot to fill the fields. Try again.
              </div>
            ';
        }
      }


      ?>

      <form class="form-signin" method="post">
        <!-- <h2 class="form-signin-heading"><img src="img/ibc_logo.png" style="height: 40px; width: 40px; margin-right: 5px;"> AdManager<sup class="sup-white">Alpha</sup></h2> -->
        <h2 class="form-signin-heading"><img src="img/ibc_logo.png" style="height: 40px; width: 40px; margin-right: 5px;"></h2>
        <div class="login-wrap">
            <input name="admin_username" type="text" class="form-control" placeholder="Username" autofocus>
            <input name="admin_password" type="password" class="form-control" placeholder="Password">
            <!-- <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>
                </span>
            </label> -->
            <button class="btn btn-lg btn-info btn-block" name="submit_login" type="submit">Sign in</button>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>


  </body>
</html>

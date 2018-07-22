 <?php

define('ADMIN_VIEW', true);

include 'a_header.php'; 

?>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <?php

              function addUser($conn, $name, $uname, $pass){
                $query = mysqli_query($conn, "SELECT * from login where username = '$uname'");
                if(mysqli_num_rows($query) > 0) {
                  echo '<div class="col-lg-12">
                    <div class="alert alert-block alert-info fade in">
                      <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                      </button>
                      <strong>Oops!</strong> Looks like the username you entered is already taken. Please enter a new one.
                    </div>
                  </div>';
                } else {
				  $encrypt = password_hash($pass, PASSWORD_DEFAULT); //encrypting
                  $disp = mysqli_query($conn, "INSERT INTO `login` (`username`, `password`, `name`,  `date_add`, `role`) VALUES ('$uname', '$encrypt', '$name', NOW(), 'ADMIN')");
                  if($disp == true){
                  echo '
                      <div class="col-lg-12">
                      <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                          <i class="icon-remove"></i>
                        </button>
                        <strong>Well done!</strong> You successfully added a user.
                      </div>
                    </div>
                    ';
                } else echo '
                  <div class="col-lg-12">
                    <div class="alert alert-block alert-danger fade in">
                      <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                      </button>
                      <strong>Oh snap!</strong> An error occured.
                    </div>
                  </div>
                  ';
                }
              }

              function editUser($conn, $name, $uname, $pass, $uid){
				$encrypt = password_hash($pass, PASSWORD_DEFAULT); //encrypting
                $disp = mysqli_query($conn, "UPDATE `login` SET `username` = '$uname', `password` = '$encrypt', `name` = '$name' WHERE `id` = '$uid'");
                if($disp == true){
                  echo '
                      <div class="col-lg-12">
                      <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                          <i class="icon-remove"></i>
                        </button>
                        <strong>Well done!</strong> You successfully edited a user.
                      </div>
                    </div>
                    ';
                } else echo '
                  <div class="col-lg-12">
                    <div class="alert alert-block alert-danger fade in">
                      <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                      </button>
                      <strong>Oh snap!</strong> An error occured.
                    </div>
                  </div>
                  ';
              }

              function delUser($conn, $id){
                $qry_delu = mysqli_query($conn, "DELETE FROM `login` WHERE `id` = '$id'");
                if($qry_delu == true){
                  echo '
                      <div class="col-lg-12">
                      <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                          <i class="icon-remove"></i>
                        </button>
                        <strong>Well done!</strong> You successfully deleted a user.
                      </div>
                    </div>
                    ';
                } else echo '
                  <div class="col-lg-12">
                    <div class="alert alert-block alert-danger fade in">
                      <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                      </button>
                      <strong>Oh snap!</strong> An error occured.
                    </div>
                  </div>
                  ';
              }

              if(isset($_POST['submit_user'])){
                addUser($connect, $_POST['user_pname'], $_POST['user_name'], $_POST['user_pass']);
              }

              if(isset($_POST['btn_deluser'])){
                delUser($connect, $_POST['del_userid']);
              }

              if(isset($_POST['submit_newpass'])){
				$new_pass = $_POST['chng_pass'];
				$in_currpass = $_POST['curr_pass'];
				$id_u = $_SESSION['u_id'];
				$div = '';

				$qry_check = mysqli_query($connect, "SELECT * FROM `login` WHERE `id` = '$id_u'");
				if($qry_check->num_rows > 0){
					while($row_chk = mysqli_fetch_array($qry_check)){
						$decrypt = password_verify($in_currpass, $row_chk['password']); // decrypting
						$decrypt2 = password_verify($new_pass, $row_chk['password']); // decrypting
						if($decrypt == 0){
							$div = "
								<div class='col-lg-12'>
								<div class='alert alert-info fade in'>
								  <button data-dismiss='alert' class='close close-sm' type='button'>
									<i class='icon-remove'></i>
								  </button>
								  <strong>Sorry.</strong> Your current password didn't match to what you entered.
								</div>
							  </div>
							  ";
						}
						else if($decrypt2 == 1){
							$div = '
								<div class="col-lg-12">
								<div class="alert alert-info fade in">
								  <button data-dismiss="alert" class="close close-sm" type="button">
									<i class="icon-remove"></i>
								  </button>
								  <strong>Sorry.</strong> Your new password cannot be your old password.
								</div>
							  </div>
							  ';
						} else if ($decrypt2 == 0) {
							$encrypt = password_hash($new_pass, PASSWORD_DEFAULT); //encrypting
							$qry_chngpass = mysqli_query($connect, "UPDATE `login` SET `password` = '$encrypt' WHERE `id` = '$id_u'");
							if ($qry_chngpass == true){
								$div = '
									<div class="col-lg-12">
									<div class="alert alert-success fade in">
									  <button data-dismiss="alert" class="close close-sm" type="button">
										<i class="icon-remove"></i>
									  </button>
									  <strong>Well done!</strong> You successfully changed your password.
									</div>
								  </div>
								  ';
							  } else $div = '
								<div class="col-lg-12">
								  <div class="alert alert-block alert-danger fade in">
									<button data-dismiss="alert" class="close close-sm" type="button">
									  <i class="icon-remove"></i>
									</button>
									<strong>Oh snap!</strong> An error occured.
								  </div>
								</div>
								';
						}

					}
				}
				echo $div;
			}

              if(isset($_POST['submit_edtuser'])){
                editUser($connect, $_POST['user_edpname'], $_POST['user_edname'], $_POST['user_edpass'], $_POST['user_eduid']);
              }

              ?>
              <section class="panel">
              <header class="panel-heading">
                  Manage Users
                  <button type="button" class="btn btn-sm btn-round btn-primary pull-right" href="#ip_modal" data-toggle="modal"><i class="icon-plus"></i>  Add Users</button>
              </header>
              <table class="table table-hover">
                  <thead>
                  <tr>
                      <th>User Proper Name</th>
                      <th>User Name</th>
                      <th>Date and Time Added</th>
                      <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php

                  $qry_user = mysqli_query($connect, "SELECT * FROM `login` WHERE `role` = 'ADMIN'");
                  if($qry_user->num_rows > 0){
                    while ($row_user = mysqli_fetch_array($qry_user)) {
                      echo '
                        <tr>
                          <td>'.$row_user['name'].'</td>
                          <td>'.$row_user['username'].'</td>
                          <td>'.date('l, F d, Y g:i:s a', strtotime($row_user['date_add'])).'</td>
                          <td>
                            <form method="POST">
                              <input type="hidden" name="edt_userid" value="'.$row_user['id'].'"/>
                              <button type="submit" name="btn_edtuser" class="btn btn-primary btn-xs"><i class="icon-edit" value=""></i></button>
                              <input type="hidden" name="del_userid" value="'.$row_user['id'].'"/>
                              <button type="submit" name="btn_deluser" class="btn btn-danger btn-xs"><i class="icon-trash" value=""></i></button>
                            </form>
                          </td>
                      </tr>
                      ';
                    }
                  } else echo '<tr><td colspan="5">No users found.</td></tr>';

                  ?>
                  </tbody>
              </table>
            </section>
              <!-- page end-->
          </section>
      </section>

    <!--Add User Modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ip_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Add User</h4>
          </div>
          
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="post">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">User Full Name</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="user_pname" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Username</label>
                <div class="col-lg-10" id="div_uname">
                  <input type="text" class="form-control" name="user_name"  id="user_name" pattern="^(?=.*[a-z])(?=.*[A-Z])(?!.*\W)(?!.*\s).+$" required>
                  <p class="help-block" id="uname_msg">The username must contain at lease one lowercase letter, one uppercase letter, and be at least 8 characters long.</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Password</label>
                <div class="col-lg-10" id="div_pass2">
                  <div class="input-group m-bot15">
                    <input type="password" name="user_pass" id="new_pass" class="form-control" pattern="^(?=.*[a-z])(?=.*[0-9])(?!.*[A-Z])(?!.*\W)(?!.*\s).+$"  required>
                    <span class="input-group-addon" onmousedown="showPassU()" onmouseup="hidePassU()"><i class="icon-eye-open" id="icon_new"></i></span>
                  </div>
                  <p class="help-block" id="pass_msg2">The password must contain at lease one lowercase letter, one number, and be at least 6 characters long.</p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" name="submit_user" id="submit_user" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>

            </div>

          </div>
        </div>
      </div>

    <!--Edit User Modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edtuser_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Edit User</h4>
          </div>
          <?php

          if(isset($_POST['btn_edtuser'])){
            $get_uid = $_POST['edt_userid'];
            $qry_getu = mysqli_query($connect, "SELECT * FROM `login` WHERE `id` = '$get_uid'");
            $row_u = mysqli_fetch_array($qry_getu);

            $get_uid = $row_u['id'];
            $get_pname = $row_u['name'];
            $get_uname = $row_u['username'];
            $get_pswrd = $row_u['password'];

          }

          ?>
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="post">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">User Full Name</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="user_edpname" value="<?php echo $get_pname; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Username</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="user_edname" value="<?php echo $get_uname; ?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?!.*\W)(?!.*\s).+$" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Password</label>
                <div class="col-lg-10">
                  <div class="input-group m-bot15">
                    <input type="password" name="user_edpass" id="new_pass2" class="form-control" pattern="^(?=.*[a-z])(?=.*[0-9])(?!.*[A-Z])(?!.*\W)(?!.*\s).+$"  required>
                    <span class="input-group-addon" onmousedown="showPassU2()" onmouseup="hidePassU2()"><i class="icon-eye-open" id="icon_pass2"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <input type="hidden" name="user_eduid"  value="<?php echo $get_uid; ?>">
                  <button type="submit" name="submit_edtuser" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>

            </div>

          </div>
        </div>
      </div>

      <?php include 'include_changepass.php'; ?>

      <!--main content end-->
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
    <script src="js/advanced-form-components.js"></script>

    <script src="js/validpass.js"></script>

    <script src="js/validuser.js"></script>

  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

      $(document).prop('title', 'Add User - IBC');

      <?php

      if(isset($_POST['btn_edtuser'])){
        echo "$('#edtuser_modal').modal('show')";
      }

      ?>

      $('#logout_opt').click(function (){
        $.ajax({
            url: '/ibc/edit.php?logout=yes'
        })
      });

  </script>


  </body>
</html>

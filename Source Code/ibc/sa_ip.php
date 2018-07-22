<?php

define('SADMIN_VIEW', true);

include 'sa_header.php'; 

?>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <?php

              function addIP($conn, $ip, $name){
				$encrypt_IP = password_hash($ip, PASSWORD_DEFAULT); //encrypting
                $disp = mysqli_query($conn, "INSERT INTO `devices` (`ip_address`, `ip_name`, `date_added`) VALUES ('$encrypt_IP',  '$name', NOW())");
                if($disp == true){
                  echo '
                      <div class="col-lg-12">
                      <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                          <i class="icon-remove"></i>
                        </button>
                        <strong>Well done!</strong> You successfully registered a device.
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

              function editIP($conn, $ip, $name, $id){
				$encrypt_IP = password_hash($ip, PASSWORD_DEFAULT); //encrypting
                $disp = mysqli_query($conn, "UPDATE `devices` SET `ip_address` = '$encrypt_IP', `ip_name` = '$name',`last_updated` = NOW() WHERE `id` = '$id'");
                if($disp == true){
                  echo '
                      <div class="col-lg-12">
                      <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                          <i class="icon-remove"></i>
                        </button>
                        <strong>Well done!</strong> You successfully edited a device.
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

              function delIP($conn, $id){
                $qry_delip = mysqli_query($conn, "DELETE FROM `devices` WHERE `id` = '$id'");
                if($qry_delip == true){
                  echo '
                      <div class="col-lg-12">
                      <div class="alert alert-success fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                          <i class="icon-remove"></i>
                        </button>
                        <strong>Well done!</strong> You successfully deleted a device.
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

              if(isset($_POST['submit_ip'])){
                addIP($connect, $_POST['ip_add'], $_POST['ip_name']);
              }

              if(isset($_POST['btn_delip'])){
                delIP($connect, $_POST['del_ipid']);
              }

              if(isset($_POST['submit_editip'])){
                editIP($connect, $_POST['eip_add'], $_POST['eip_name'], $_POST['ip_id']);
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

              ?>
              <section class="panel">
              <header class="panel-heading">
                  Manage Devices
                  <button type="button" class="btn btn-sm btn-round btn-primary pull-right" href="#ip_modal" data-toggle="modal"><i class="icon-plus"></i>  Add Device</button>
              </header>
              <table class="table table-hover">
                  <thead>
                  <tr>
                      <th>Device Name</th>
                      <th>Date and Time Added</th>
                      <th>Last Date Updated</th>
                      <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php

                  $disp_upd = '---';

                  $qry_ip = mysqli_query($connect, "SELECT * FROM `devices`");
                  if($qry_ip->num_rows > 0){
                    while ($row_ip = mysqli_fetch_array($qry_ip)){

                      if($row_ip['last_updated'] != ''){
                        $disp_upd = date('l, F d, Y g:i:s a', strtotime($row_ip['last_updated']));
                      }
                      echo '
                        <tr>
                          <td>'.$row_ip['ip_name'].'</td>
                          <td>'.date('l, F d, Y g:i:s a', strtotime($row_ip['date_added'])).'</td>
                          <td>'.$disp_upd.'</td>
                          <td>
                            <form method="POST">
                              <input type="hidden" name="edit_ipid" value="'.$row_ip['id'].'"/>
                              <button type="submit" name="btn_editip" class="btn btn-primary btn-xs"><i class="icon-edit" value=""></i></button>

                              <input type="hidden" name="del_ipid" value="'.$row_ip['id'].'"/>
                              <button type="submit" name="btn_delip" class="btn btn-danger btn-xs"><i class="icon-trash" value=""></i></button>
                            </form>
                          </td>
                      </tr>
                      ';
                    }
                  } else echo '<tr><td colspan="5"><center>No users found.</center></td></tr>';

                  ?>
                  </tbody>
              </table>
            </section>
              <!-- page end-->
          </section>
      </section>

    <!--Add IP Setting-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="ip_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Add Device</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="post">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">IP Address</label>
                <div class="col-lg-10">
                  <input type="text" placeholder="" data-mask="999.999.999.9999" class="form-control" name="ip_add">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Device Name</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="ip_name">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" name="submit_ip" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>

            </div>

          </div>
        </div>
      </div>

  <!--Edit IP Setting-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editip_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Edit Device</h4>
          </div>
          
          <?php

          if(isset($_POST['btn_editip'])){
            $e_id = $_POST['edit_ipid'];
            $qry_eip = mysqli_query($connect, "SELECT * FROM `devices` WHERE `id` = '$e_id'");
            $row_eip = mysqli_fetch_array($qry_eip);

            $get_ipad = $row_eip['ip_address'];
            $get_ipname = $row_eip['ip_name'];
            $get_ipid = $row_eip['id'];

          }

          ?>
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="post">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">IP Address</label>
                <div class="col-lg-10">
                  <input type="text" placeholder="" data-mask="999.999.999.9999" class="form-control" name="eip_add">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Device Name</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="eip_name" value="<?php echo $get_ipname; ?>">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <input type="hidden" name="ip_id" value="<?php echo $get_ipid; ?>">
                  <button type="submit" name="submit_editip" class="btn btn-primary">Submit</button>
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

  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

      $(document).prop('title', 'Manage Devices - IBC');

      <?php

      if(isset($_POST['btn_editip'])){
        echo "$('#editip_modal').modal('show')";
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

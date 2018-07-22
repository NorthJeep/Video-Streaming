<?php 

define('ADMIN_VIEW', true);

include 'a_header.php'; 

?>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <?php

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
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading tab-bg-dark-navy-blue tab-right ">
                      <ul class="nav nav-tabs pull-right">
                          <li class="active">
                              <a data-toggle="tab" href="#home-3">
                                  Insert
                              </a>
                          </li>
                          <li class="">
                              <a data-toggle="tab" href="#about-3">
                                  Update
                              </a>
                          </li>
                          <li class="">
                              <a data-toggle="tab" href="#contact-3">
                                  Delete
                              </a>
                          </li>
                      </ul>
                      <span class="hidden-sm wht-color">Logs</span>
                  </header>
                  <div class="panel-body">
                      <div class="tab-content">
                          <div id="home-3" class="tab-pane active">
                              <div class="form-group col-md-5">
                                <label for="date_range">Date Range</label>
                                <div id="date_range" class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                  <input type="text" class="form-control dpd1" id="ins_from">
                                  <span class="input-group-addon">To</span>
                                  <input type="text" class="form-control dpd2" id="ins_to">
                                </div>
                              </div>
                              <div class="form-group col-lg-3">
                                <label for="log_type">Log Type</label>
                                <select class="form-control m-bot15" id="log_type_ins">
                                  <option value="ALL">All</option>
                                  <option value="IMAGE">Image</option>
                                  <option value="VIDEO">Video</option>
                                  <option value="VOLUME">Volume</option>
                                  <option value="TEXT">Text</option>
                                  <option value="FONT COLOR">Font Color</option>
                                  <option value="FONT TYPE">Font Type</option>
                                  <option value="SPEED">Speed</option>
                                  <option value="COLOR">Background Color</option>
                                </select>
                              </div>
                              <div class="form-group col-md-1">
                                <label for="filter_logs" style="color: #ffffff;">------</label>
                                <button type="button" class="btn btn-info" id="ins_filter" style="width: 90px;"><i class="icon-filter" style="margin-right: 5px;"></i>  Filter</button>
                              </div>
                              <div class="form-group col-lg-1 pull-right">
                                <label for="filter_logs" style="color: #ffffff;">------</label>
                                <button type="button" class="btn btn-round btn-primary pull-right" id="ins_print" style="width: 130px;"><i class="icon-print" style="margin-right: 5px;"></i>  Print Logs</button>
                              </div>
                              <br/>
                              <div class="adv-table">                        
                                <table class="display table table-bordered table-striped" id="ins_table">
                                  <thead>
                                  <tr>
                                      <th>Date</th>
                                      <th>Time</th>
                                      <th>Username</th>
                                      <th>Template Number</th>
                                      <th>Section</th>
                                      <th>File Name</th>
                                      <th>Type</th>
                                  </tr>
                                  </thead>
                                  <tbody id="ins_table_tb">
                                  
                                  <?php

                                  $qry_logs = mysqli_query($connect, "SELECT * FROM `logs` WHERE `action` = 'INSERT'");
                                  if($qry_logs->num_rows > 0){
                                    while ($row = mysqli_fetch_array($qry_logs)) {

                                      $date = date('l, F d, Y', strtotime($row['date_time']));
                                      $time = date('g:i:s a', strtotime($row['date_time']));

                                      echo '
                                        <tr>
                                          <td>'.$date.'</td>
                                          <td>'.$time.'</td>
                                          <td>'.$row['user_name'].'</td>
                                          <td>Template #'.$row['template_id'].'</td>
                                          <td>'.$row['section'].'</td>
                                          <td>'.$row['new_value'].'</td>
                                          <td>'.$row['type'].'</td>
                                        </tr>
                                        ';
                                    }
                                  }

                                  ?>

                                  </tbody>
                              </table>
                              </div>
                          </div>
                          <div id="about-3" class="tab-pane">
                            <div class="form-group col-md-5">
                                <label for="date_range">Date Range</label>
                                <div id="date_range" class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                  <input type="text" class="form-control dpd1" id="upd_from">
                                  <span class="input-group-addon">To</span>
                                  <input type="text" class="form-control dpd2" id="upd_to">
                                </div>
                              </div>
                              <div class="form-group col-lg-3">
                                <label for="log_type">Log Type</label>
                                <select class="form-control m-bot15" id="log_type_upd">
                                  <option value="ALL">All</option>
                                  <option value="IMAGE">Image</option>
                                  <option value="VIDEO">Video</option>
                                  <option value="VOLUME">Volume</option>
                                  <option value="TEXT">Text</option>
                                  <option value="FONT COLOR">Font Color</option>
                                  <option value="FONT TYPE">Font Type</option>
                                  <option value="SPEED">Speed</option>
                                  <option value="COLOR">Background Color</option>
                                </select>
                              </div>
                              <div class="form-group col-md-1">
                                <label for="filter_logs" style="color: #ffffff;">------</label>
                                  <button type="button" class="btn btn-info" id="upd_filter" style="width: 90px;"><i class="icon-filter" style="margin-right: 5px;"></i>  Filter</button>
                              </div>
                              <div class="form-group col-lg-1 pull-right">
                                <label for="filter_logs" style="color: #ffffff;">------</label>
                                <button type="button" class="btn btn-round btn-primary pull-right" id="upd_print" style="width: 130px;"><i class="icon-print" style="margin-right: 5px;"></i>  Print Logs</button>
                              </div>
                              <br/>
                              <div class="adv-table">
                                  <table class="display table table-bordered table-striped" id="upd_table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Username</th>
                                        <th>Template Number</th>
                                        <th>Section</th>
                                        <th>Previous Value</th>
                                        <th>New Value</th>
                                        <th>Type</th>
                                    </tr>
                                    </thead>
                                    <tbody id="upd_table_tb">
                                    <?php

                                    $qry_logs = mysqli_query($connect, "SELECT * FROM `logs` WHERE `action` = 'UPDATE'");
                                    if($qry_logs->num_rows > 0){
                                      while ($row = mysqli_fetch_array($qry_logs)) {

                                        $date = date('l, F d, Y', strtotime($row['date_time']));
                                        $time = date('g:i:s a', strtotime($row['date_time']));

                                        echo '
                                          <tr>
                                            <td>'.$date.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$row['user_name'].'</td>
                                            <td>Template #'.$row['template_id'].'</td>
                                            <td>'.$row['section'].'</td>
                                            <td>'.$row['old_value'].'</td>
                                            <td>'.$row['new_value'].'</td>
                                            <td>'.$row['type'].'</td>
                                          </tr>
                                          ';
                                      }
                                    }

                                    ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                          <div id="contact-3" class="tab-pane">
                            <div class="form-group col-lg-5">
                                <label for="date_range">Date Range</label>
                                <div id="date_range" class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                  <input type="text" class="form-control dpd1" id="del_from">
                                  <span class="input-group-addon">To</span>
                                  <input type="text" class="form-control dpd2" id="del_to">
                                </div>
                              </div>
                              <div class="form-group col-lg-3">
                                <label for="log_type">Log Type</label>
                                <select class="form-control m-bot15" id="log_type_del">
                                  <option value="ALL">All</option>
                                  <option value="IMAGE">Image</option>
                                  <option value="VIDEO">Video</option>
                                  <option value="VOLUME">Volume</option>
                                  <option value="TEXT">Text</option>
                                  <option value="FONT COLOR">Font Color</option>
                                  <option value="FONT TYPE">Font Type</option>
                                  <option value="SPEED">Speed</option>
                                  <option value="COLOR">Background Color</option>
                                </select>
                              </div>
                              <div class="form-group col-lg-1 pull-left">
                                <label for="filter_logs" style="color: #ffffff;">------</label>
                                <button type="button" class="btn btn-info" id="del_filter" style="width: 90px;"><i class="icon-filter" style="margin-right: 5px;"></i>  Filter</button>
                              </div>
                              <div class="form-group col-lg-1 pull-right">
                                <label for="filter_logs" style="color: #ffffff;">------</label>
                                <button type="button" class="btn btn-round btn-primary pull-right" id="del_print" style="width: 130px;"><i class="icon-print" style="margin-right: 5px;"></i>  Print Logs</button>
                              </div>
                              <br/>
                              <div class="adv-table">
                                <table class="display table table-bordered table-striped" id="del_table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Username</th>
                                        <th>Template Number</th>
                                        <th>Section</th>
                                        <th>File Name</th>
                                        <th>Type</th>
                                    </tr>
                                    </thead>
                                    <tbody id="del_table_tb">
                                    <?php

                                    $qry_logs = mysqli_query($connect, "SELECT * FROM `logs` WHERE `action` = 'DELETE'");
                                    if($qry_logs->num_rows > 0){
                                      while ($row = mysqli_fetch_array($qry_logs)) {

                                        $date = date('l, F d, Y', strtotime($row['date_time']));
                                        $time = date('g:i:s a', strtotime($row['date_time']));

                                        echo '
                                          <tr>
                                            <td>'.$date.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$row['user_name'].'</td>
                                            <td>Template #'.$row['template_id'].'</td>
                                            <td>'.$row['section'].'</td>
                                            <td>'.$row['new_value'].'</td>
                                            <td>'.$row['type'].'</td>
                                          </tr>
                                          ';
                                      }
                                    }

                                    ?>
                                    </tbody>
                                </table>
                              </div>
                          </div>
                      </div>
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
              <span>2016 &copy; Internetworking and Broadband Consulting Co., Ltd. Philippines.</span>
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- <script src="js/jquery.js"></script> -->
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/fancybox/source/jquery.fancybox.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script src="js/respond.min.js" ></script>

    <script src="js/modernizr.custom.js"></script>
    <script src="js/toucheffects.js"></script>

    <script type="text/javascript" src="assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!--common script for all pages-->
    <script src="js/common-scripts.js"></script>
    <script src="js/advanced-form-components.js"></script>

    <script src="js/validpass.js"></script>

    <script src="js/prinlogs.js"></script>

  <script>

      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

      $(document).prop('title', 'Logs - IBC');

      $('#logout_opt').click(function (){
        $.ajax({
            url: '/ibc/edit.php?logout=yes'
        })
      });

      $(document).ready(function() {
              $('#ins_table, #upd_table, #del_table').dataTable( {
                  "aaSorting": [[ 4, "desc" ]],
                  "oLanguage": {
                        "sEmptyTable":     "No logs found."
                    }
              } );
          });

  </script>


  </body>
</html>

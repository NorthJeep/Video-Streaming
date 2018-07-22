<?php
if(!defined('EDIT_VIEW')){
	die("<strong>403:</strong> Direct Access Forbidden!");
}

define('SUBEDIT_VIEW', true);


?>

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
				<?php
					include 'function.php';

					//Header Caller
					if(isset($_POST['submit_left'])){
					$noti = updateHeader($_FILES['imgleft'], 'header-left', $connect, $_POST['edit']);
					echo $noti;
					}

					if(isset($_POST['submit_mid'])){
					$noti = updateHeader($_FILES['imgmid'], 'header-mid', $connect, $_POST['edit']);
					echo $noti;
					}

					if(isset($_POST['submit_right'])){
					$noti = updateHeader($_FILES['imgright'], 'header-right', $connect, $_POST['edit']);
					echo $noti;
					}
					//end Header Caller

					//Videos Caller
					if(isset($_POST['submit_topleft'])){
						if($_FILES['topleft']['name'][0] != ''){
							$noti = updateAdVideos($_FILES['topleft'], 'top-left', $connect, $_POST['edit']);
							echo $noti;
						}
						$id_tem = $_POST['edit'];
						$qry_currvol = mysqli_query($connect, "SELECT * FROM `mute` WHERE `location` = 'top-left' AND `template_id` = '$id_tem'");
						$row_cvol = mysqli_fetch_array($qry_currvol);

						if($row_cvol['volume'] != $_POST['sec_vlme']){
							updateVolume($_POST['sec_vlme'], 'top-left', $connect, $_POST['edit']);
						}

						if(isset($_POST['vid_id'])){
							updateSched($connect, $_POST['vid_id'], $_POST['show_from'], $_POST['show_to'], 'top-left', $_POST['edit']);
						}

						if(isset($_POST['inacvid_id'])){
							updateSched($connect, $_POST['inacvid_id'], $_POST['inacshow_from'], $_POST['inacshow_to'], 'top-left', $_POST['edit']);
						}
					}

					if(isset($_POST['submit_bottomright'])){

						if($_FILES['bottomright']['name'][0] != ''){
							$noti = updateAdVideos($_FILES['bottomright'], 'bottom-right', $connect, $_POST['edit']);
							echo $noti;
						}

						$id_tem = $_POST['edit'];
						$qry_currvol = mysqli_query($connect, "SELECT * FROM `mute` WHERE `location` = 'bottom-right' AND `template_id` = '$id_tem'");
						$row_cvol = mysqli_fetch_array($qry_currvol);

						if($row_cvol['volume'] != $_POST['sec_vlme2']){
							updateVolume($_POST['sec_vlme2'], 'bottom-right', $connect, $_POST['edit']);
						}

						if(isset($_POST['vid_id3'])){
							updateSched($connect, $_POST['vid_id3'], $_POST['show_from3'], $_POST['show_to3'], 'bottom-right', $_POST['edit']);
						}

						if(isset($_POST['inacvid_id3'])){
							updateSched($connect, $_POST['inacvid_id3'], $_POST['inacshow_from3'], $_POST['inacshow_to3'], 'bottom-right', $_POST['edit']);
						}
					}
					//end Videos Caller

					//Slider Caller
					if(isset($_POST['submit_bottomleft'])){
						$noti = updateSlider($_FILES['bottomleft'], 'bottom-left', $connect, $_POST['edit']);
						echo $noti;

						if(isset($_POST['vid_id4'])){
							updateSched($connect, $_POST['vid_id4'], $_POST['show_from4'], $_POST['show_to4'], 'bottom-left', $_POST['edit']);
						}

						if(isset($_POST['inacvid_id4'])){
							updateSched($connect, $_POST['inacvid_id4'], $_POST['inacshow_from4'], $_POST['inacshow_to4'], 'bottom-left', $_POST['edit']);
						}
					}
					if(isset($_POST['submit_topright'])){
						$noti = updateSlider($_FILES['topright'], 'top-right', $connect, $_POST['edit']);
						echo $noti;

						if(isset($_POST['vid_id2'])){
							updateSched($connect, $_POST['vid_id2'], $_POST['show_from2'], $_POST['show_to2'], 'top-right', $_POST['edit']);
						}

						if(isset($_POST['inacvid_id2'])){
							updateSched($connect, $_POST['inacvid_id2'], $_POST['inacshow_from2'], $_POST['inacshow_to2'], 'top-right', $_POST['edit']);
						}
					}
					//end Slider Caller
				?>
			  </div>
              <div class="row">
                <div class="col-lg-4">
                  <section class="panel">
                    <div class="panel-body">
                      <p class="text-center" style="font-weight: bold;">Header - Left<br>
                      <?php $get_btn = knowActionHeader('header-left', $connect, 6); echo $get_btn[3]; ?>
                      </p>
                      <p class="text-center">
                        <button class="<?php echo $get_btn[0]; ?>" href="#header-image-left" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                      </p>
                    </div>
                  </section>
                </div>
                <div class="col-lg-4">
                  <section class="panel">
                    <div class="panel-body">
                      <p class="text-center" style="font-weight: bold;">Header - Middle<br>
                      <?php $get_btn = knowActionHeader('header-mid', $connect, 6); echo $get_btn[3]; ?>
                      </p>
                      <p class="text-center">
                         <button class="<?php echo $get_btn[0]; ?>" href="#header-image-middle" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                      </p>
                    </div>
                  </section>
                </div>
                <div class="col-lg-4">
                  <section class="panel">
                    <div class="panel-body">
                      <p class="text-center" style="font-weight: bold;">Header - Right<br>
                      <?php $get_btn = knowActionHeader('header-right', $connect, 6); echo $get_btn[3]; ?>
                      </p>
                      <p class="text-center">
                        <button class="<?php echo $get_btn[0]; ?>" href="#header-image-right" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                      </p>
                    </div>
                  </section>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <section class="panel" style="height: 300px;">
                    <div class="panel-body">
                      <p class="text-center" style="font-weight: bold;">Top - Left<br>
                      <?php $get_btn = knowActionMain('top-left', $connect, 6, 'video(s)'); echo $get_btn[3]; ?>
                      </p>
                      <p class="text-center">
                        <button class="<?php echo $get_btn[0]; ?>" href="#top-left" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                      </p>
                    </div>
                  </section>
                </div>
                <div class="col-lg-6">
                  <section class="panel" style="height: 300px;">
                    <div class="panel-body">
                    <p class="text-center" style="font-weight: bold;">Top - Right<br>
                      <?php $get_btn = knowActionMain('top-right', $connect, 6, 'image(s)'); echo $get_btn[3]; ?>
                    </p>
                    <p class="text-center">
                      <button class="<?php echo $get_btn[0]; ?>" href="#top-right" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                    </p>
                    </div>
                  </section>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <section class="panel" style="height: 300px;">
                    <div class="panel-body">
                    <p class="text-center" style="font-weight: bold;">Bottom - Left<br>
                      <?php $get_btn = knowActionMain('bottom-left', $connect, 6, 'image(s)'); echo $get_btn[3]; ?>
                    </p>
                    <p class="text-center">
                      <button class="<?php echo $get_btn[0]; ?>" href="#bottom-left" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                    </p>
                    </div>
                  </section>
                </div>
                <div class="col-lg-6">
                  <section class="panel" style="height: 300px;">
                    <div class="panel-body">
                    <p class="text-center" style="font-weight: bold;">Bottom - Right<br>
                      <?php $get_btn = knowActionMain('bottom-right', $connect, 6, 'video(s)'); echo $get_btn[3]; ?>
                    </p>
                    <p class="text-center">
                      <button class="<?php echo $get_btn[0]; ?>" href="#bottom-right" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                    </p>
                    </div>
                  </section>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <section class="panel">
                    <div class="panel-body">
                      <p class="text-center" style="font-weight: bold;">Scroller<br>
                      <?php $get_btn = knowActionScroller($connect, 6); echo $get_btn[3]; ?>
                      </p>
                      <p class="text-center">
                        <button class="<?php echo $get_btn[0]; ?>" href="#scroller-settings" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                      </p>
                    </div>
                  </section>
                </div>
              </div>
              <!-- page end-->
        </section>
    </section>

<!--Modal-->
	<!--Image Left-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="header-image-left" class="modal fade">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h4 class="modal-title">Header - Left</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Image</label>
								<div class="col-lg-10">

							  <?php
							  $get_input = knowActionHeader('header-left', $connect, 6);
							  if($get_input[2] == 'Add'){
								$input_class = 'new';
								$img_prev = '';
							  }
							  else if($get_input[2] == 'Edit'){
								$input_class = 'exists';
								$img_prev = '<img src="upload/template_6/images/'.$get_input[4].'" alt="" />';
							  }
							  ?>

							  <div class="fileupload fileupload-<?php echo $input_class; ?>" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
								  <img src="img/no_img.png" alt="" />
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"><?php echo $img_prev; ?></div>
								<div>
								 <span class="btn btn-white btn-file">
								 <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
								 <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
								 <input type="file" class="default" name="imgleft" accept=".png,.jpeg,.jpg,.gif"/>
								 </span>
								 <form method="POST">
								  <input type="hidden" id="edit" name="edit" value="6">
								  <input type="hidden" name="hd_id" value="<?php echo $get_input[5]; ?>"/>
								  <button type="submit" name="del_head" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</button>
								 </form>
								</div>
							  </div>
								  
								  <span>An image with a resolution of 000 x 00 is recommended.</span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<input type="hidden" id="edit" name="edit" value="6">
									<input type="submit" name="submit_left" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
	<!--Image Middle-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="header-image-middle" class="modal fade">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h4 class="modal-title">Header - Middle</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Image</label>
								<div class="col-lg-10">

							  <?php
							  $get_input = knowActionHeader('header-mid', $connect, 6);
							  if($get_input[2] == 'Add'){
								$input_class = 'new';
								$img_prev = '';
							  }
							  else if($get_input[2] == 'Edit'){
								$input_class = 'exists';
								$img_prev = '<img src="upload/template_6/images/'.$get_input[4].'" alt="" />';
							  }
							  ?>

							  <div class="fileupload fileupload-<?php echo $input_class; ?>" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
								  <img src="img/no_img.png" alt="" />
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"><?php echo $img_prev; ?></div>
								<div>
								 <span class="btn btn-white btn-file">
								 <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
								 <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
								 <input type="file" class="default" name="imgmid" accept=".png,.jpeg,.jpg,.gif"/>
								 </span>
								 <form method="POST">
								  <input type="hidden" id="edit" name="edit" value="6">
								  <input type="hidden" name="hd_id" value="<?php echo $get_input[5]; ?>"/>
								  <button type="submit" name="del_head" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</button>
								 </form>
								</div>
							  </div>

							  <span>An image with a resolution of 000 x 00 is recommended.</span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<input type="hidden" id="edit" name="edit" value="6">
									<input type="submit" name="submit_mid" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	<!--Image Right-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="header-image-right" class="modal fade">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h4 class="modal-title">Header - Right</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Image</label>
								<div class="col-lg-10">

							  <?php
							  $get_input = knowActionHeader('header-right', $connect, 6);
							  if($get_input[2] == 'Add'){
								$input_class = 'new';
								$img_prev = '';
							  }
							  else if($get_input[2] == 'Edit'){
								$input_class = 'exists';
								$img_prev = '<img src="upload/template_6/images/'.$get_input[4].'" alt="" />';
							  }
							  ?>

							  <div class="fileupload fileupload-<?php echo $input_class; ?>" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
								  <img src="img/no_img.png" alt="" />
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"><?php echo $img_prev; ?></div>
								<div>
								 <span class="btn btn-white btn-file">
								 <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
								 <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
								 <input type="file" class="default" name="imgright" accept=".png,.jpeg,.jpg,.gif"/>
								 </span>
								 <form method="POST">
								  <input type="hidden" name="hd_id" value="<?php echo $get_input[5]; ?>"/>
								  <button type="submit" name="del_head" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</button>
								 </form>
								</div>
							  </div>

								  <span>An image with a resolution of 000 x 00 is recommended.</span>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<input type="hidden" id="edit" name="edit" value="6">
									<input type="submit" name="submit_right" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	<!--Top Left Video Main-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="top-left" class="modal fade">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h4 class="modal-title">Top Left Videos</h4>
						</div>
						<div class="modal-body">
							<?php

							  $query_volume = mysqli_query($connect, "SELECT * FROM `mute` WHERE `location` = 'top-left' AND `template_id` = 6");
							  $row_vlme = mysqli_fetch_array($query_volume);

							  $get_vlme = $row_vlme['volume'];

							  ?>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Video(s)</label>
								<div class="col-lg-10">
									<div class="fileupload fileupload-new" data-provides="fileupload">
									  <span class="btn btn-white btn-file">
									  <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
									  <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
									  <input type="file" class="default" name="topleft[]" multiple="multiple" accept=".mp4,.avi,.mkv,.flv,.mov"/>
									  </span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
									<!-- <span>A video with a resolution of 000 x 00 is recommended.</span> -->
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Volume</label>
								<div class="col-lg-3">
								  <select class="form-control m-bot15" name="sec_vlme">
									<option value="1.0" <?php if ($get_vlme == "1.0") echo 'selected'; ?>>10</option>
									<option value="0.9" <?php if ($get_vlme == "0.9") echo 'selected'; ?>>9</option>
									<option value="0.8" <?php if ($get_vlme == "0.8") echo 'selected'; ?>>8</option>
									<option value="0.7" <?php if ($get_vlme == "0.7") echo 'selected'; ?>>7</option>
									<option value="0.6" <?php if ($get_vlme == "0.6") echo 'selected'; ?>>6</option>
									<option value="0.5" <?php if ($get_vlme == "0.5") echo 'selected'; ?>>5</option>
									<option value="0.4" <?php if ($get_vlme == "0.4") echo 'selected'; ?>>4</option>
									<option value="0.3" <?php if ($get_vlme == "0.3") echo 'selected'; ?>>3</option>
									<option value="0.2" <?php if ($get_vlme == "0.2") echo 'selected'; ?>>2</option>
									<option value="0.1" <?php if ($get_vlme == "0.1") echo 'selected'; ?>>1</option>
									<option value="0" <?php if ($get_vlme == "0") echo 'selected'; ?>>Mute</option>
								  </select>
								</div>
							  </div>
							<!-- <div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
								<div class="col-lg-10">
								  <table class="table">
									<tbody>
									<?php
 
									$query = mysqli_query($connect, "select * from upload where location = 'top-left' AND `template_id` = 6");
									if ($query->num_rows > 0){
									  while($row = mysqli_fetch_array($query)){
										echo '
										  <tr>
											  <td>
												<img src="" style="height: 20px; width: 37px;">
											  </td>
											  <td>'.$row['name'].'</td>
											  <td>
												<form method="POST">
												<input type="hidden" id="edit" name="edit" value="6">
												<input type="hidden" name="vid-id" value="'.$row['id'].'"/>
												<button name="remove-vid" title="Remove Video" class="btn btn-danger btn-xs"><i class="icon-trash" value="'.$row['id'].'"></i></button>
												</form>
											  </td>
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
							</div> -->
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
								<div class="col-lg-10">
								  <table class="table">
									<tbody>
									<?php

									$date1 = ''; $date2 = '';

									$query = mysqli_query($connect, "select * from upload where location = 'top-left' and template_id = 6 and status = 1");
									if ($query->num_rows > 0){
									  while($row = mysqli_fetch_array($query)){
									  	$date = new DateTime();
									  	$now = new DateTime($row['show_to']);

									  	if($row['show_from'] != ''){
									  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
									  	}
									  	if($row['show_to'] != ''){
									  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
									  	}

										echo '
										  <tr id="main_td">
											  <td>'.$row['name'].'</td>
											  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>remaining</em>").'</td>
											  <td>
											  	<input type="hidden" name="inac_id" value="'.$row['id'].'"/>
												<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
												<button type="submit" name="deac-vid" title="Deactivate" class="btn btn-default btn-xs pull-right"><i class="icon-minus-sign"></i></button>
											  </td>
										  </tr>
										  <tr>
										  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
										  		<input type="hidden" name="vid_id[]" value="'.$row['id'].'"/>
											  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control in-from" name="show_from[]" style="font-size: 11px;" '.$date1.'></div>
											  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control in-to" name="show_to[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
											</td>
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
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Inactive Videos</label>
								<div class="col-lg-10">
								  <table class="table">
									<tbody>
									<?php

									$date1 = ''; $date2 = '';

									$query = mysqli_query($connect, "select * from upload where location = 'top-left' and template_id = 6 and status = 0");
									if ($query->num_rows > 0){
									  while($row = mysqli_fetch_array($query)){

										$date = new DateTime();
										$now = new DateTime($row['date_ended']);

									  	if($row['show_from'] != ''){
									  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
									  	}
									  	if($row['show_to'] != ''){
									  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
									  	}

										echo '
										  <tr id="main_td">
											  <td>'.$row['name'].'</td>
											  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>since deac.</em>").'</td>
											  <td>
												<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
											  </td>
										  </tr>
										  <tr>
										  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
										  		<input type="hidden" name="inacvid_id[]" value="'.$row['id'].'"/>
											  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control" name="inacshow_from[]" style="font-size: 11px;" '.$date1.'></div>
											  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control" name="inacshow_to[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
											</td>
										  </tr>
										';
									  }
									}
									else {
									  echo '
										<tr>
										  <td colspan="3"><span>No inactive videos.</span></td>
										</tr>
									  ';
									}

									?>
									</tbody>
								</table>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<input type="hidden" id="edit" name="edit" value="6">
									<input type="submit" name="submit_topleft" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
	<!--Top Right Slider-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="top-right" class="modal fade">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h4 class="modal-title">Top Right Slider Images</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Image(s)</label>
								<div class="col-lg-10">
									<div class="fileupload fileupload-new" data-provides="fileupload">
									  <span class="btn btn-white btn-file">
									  <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
									  <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
									  <input type="file" class="default" name="topright[]" multiple="multiple" accept=".png,.jpeg,.jpg,.gif"/>
									  </span>
										<span class="fileupload-preview" style="margin-left:5px;"></span>
										<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
									</div>
									<span>A video with a resolution of 000 x 00 is recommended.</span>
								</div>
							</div>
							<!-- <div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
								<div class="col-lg-10">
								  <table class="table">

									<tbody>
									<?php

									$query = mysqli_query($connect, "select * from upload where location = 'top-right' AND `template_id` = 6");
									if ($query->num_rows > 0){
									  while($row = mysqli_fetch_array($query)){
										echo '
										  <tr>
											  <td>
												<img src="" style="height: 20px; width: 37px;">
											  </td>
											  <td>'.$row['name'].'</td>
											  <td>
												<form method="POST">
												  <input type="hidden" id="edit" name="edit" value="6">
												  <input type="hidden" name="sl-id" value="'.$row['id'].'"/>
												  <button name="remove-sl" title="Remove Image" class="btn btn-danger btn-xs"><i class="icon-trash" value="'.$row['id'].'"></i></button>
												</form>
											  </td>
										  </tr>
										';
									  }
									}
									else {
									  echo '
										<tr>
										  <td colspan="3"><span>No images uploaded.</span></td>
										</tr>
									  ';
									}

									?>
									</tbody>
								</table>
								</div>
							</div> -->
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
								<div class="col-lg-10">
								  <table class="table">
									<tbody>
									<?php

									$date1 = ''; $date2 = '';

									$query = mysqli_query($connect, "select * from upload where location = 'top-right' and template_id = 6 and status = 1");
									if ($query->num_rows > 0){
									  while($row = mysqli_fetch_array($query)){
									  	$date = new DateTime();
									  	$now = new DateTime($row['show_to']);

									  	if($row['show_from'] != ''){
									  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
									  	}
									  	if($row['show_to'] != ''){
									  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
									  	}

										echo '
										  <tr id="main_td">
											  <td>'.$row['name'].'</td>
											  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>remaining</em>").'</td>
											  <td>
											  	<input type="hidden" name="inac_id" value="'.$row['id'].'"/>
												<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
												<button type="submit" name="deac-vid" title="Deactivate" class="btn btn-default btn-xs pull-right"><i class="icon-minus-sign"></i></button>
											  </td>
										  </tr>
										  <tr>
										  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
										  		<input type="hidden" name="vid_id2[]" value="'.$row['id'].'"/>
											  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control in-from" name="show_from2[]" style="font-size: 11px;" '.$date1.'></div>
											  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control in-to" name="show_to2[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
											</td>
										  </tr>
										';
									  }
									}
									else {
									  echo '
										<tr>
										  <td colspan="3"><span>No image uploaded.</span></td>
										</tr>
									  ';
									}

									?>
									</tbody>
								</table>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Inactive Images</label>
								<div class="col-lg-10">
								  <table class="table">
									<tbody>
									<?php

									$date1 = ''; $date2 = '';

									$query = mysqli_query($connect, "select * from upload where location = 'top-right' and template_id = 6 and status = 0");
									if ($query->num_rows > 0){
									  while($row = mysqli_fetch_array($query)){

										$date = new DateTime();
										$now = new DateTime($row['date_ended']);

									  	if($row['show_from'] != ''){
									  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
									  	}
									  	if($row['show_to'] != ''){
									  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
									  	}

										echo '
										  <tr id="main_td">
											  <td>'.$row['name'].'</td>
											  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>since deac.</em>").'</td>
											  <td>
												<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
											  </td>
										  </tr>
										  <tr>
										  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
										  		<input type="hidden" name="inacvid_id2[]" value="'.$row['id'].'"/>
											  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control" name="inacshow_from2[]" style="font-size: 11px;" '.$date1.'></div>
											  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control" name="inacshow_to2[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
											</td>
										  </tr>
										';
									  }
									}
									else {
									  echo '
										<tr>
										  <td colspan="3"><span>No inactive image.</span></td>
										</tr>
									  ';
									}

									?>
									</tbody>
								</table>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<input type="hidden" id="edit" name="edit" value="6">
									<input type="submit" name="submit_topright" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

  <!--Bottom Right Video Main-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="bottom-right" class="modal fade">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Bottom Right Videos</h4>
            </div>
            <div class="modal-body">
              <?php

			  $query_volume2 = mysqli_query($connect, "SELECT * FROM `mute` WHERE `location` = 'bottom-right' AND `template_id` = 6");
			  $row_vlme2 = mysqli_fetch_array($query_volume2);

			  $get_vlme2 = $row_vlme2['volume'];

			  ?>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Video(s)</label>
                <div class="col-lg-10">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <span class="btn btn-white btn-file">
                    <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
                    <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                    <input type="file" class="default" name="bottomright[]" multiple="multiple" accept=".mp4,.avi,.mkv,.flv,.mov"/>
                    </span>
                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                  </div>
                  <span>A video with a resolution of 000 x 00 is recommended.</span>
                </div>
              </div>
              <div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label">Volume</label>
				<div class="col-lg-3">
				  <select class="form-control m-bot15" name="sec_vlme2">
					<option value="1.0" <?php if ($get_vlme2 == "1.0") echo 'selected'; ?>>10</option>
					<option value="0.9" <?php if ($get_vlme2 == "0.9") echo 'selected'; ?>>9</option>
					<option value="0.8" <?php if ($get_vlme2 == "0.8") echo 'selected'; ?>>8</option>
					<option value="0.7" <?php if ($get_vlme2 == "0.7") echo 'selected'; ?>>7</option>
					<option value="0.6" <?php if ($get_vlme2 == "0.6") echo 'selected'; ?>>6</option>
					<option value="0.5" <?php if ($get_vlme2 == "0.5") echo 'selected'; ?>>5</option>
					<option value="0.4" <?php if ($get_vlme2 == "0.4") echo 'selected'; ?>>4</option>
					<option value="0.3" <?php if ($get_vlme2 == "0.3") echo 'selected'; ?>>3</option>
					<option value="0.2" <?php if ($get_vlme2 == "0.2") echo 'selected'; ?>>2</option>
					<option value="0.1" <?php if ($get_vlme2 == "0.1") echo 'selected'; ?>>1</option>
					<option value="0" <?php if ($get_vlme2 == "0") echo 'selected'; ?>>Mute</option>
				  </select>
				</div>
			  </div>
              <!-- <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
                <div class="col-lg-10">
                  <table class="table">
                  <tbody>
                  <?php

                  $query = mysqli_query($connect, "select * from upload where location = 'bottom-right' AND `template_id` = 6");
                  if ($query->num_rows > 0){
                    while($row = mysqli_fetch_array($query)){
                    echo '
                      <tr>
                        <td>
                        <img src="" style="height: 20px; width: 37px;">
                        </td>
                        <td>'.$row['name'].'</td>
                        <td>
                        <form method="POST">
                        <input type="hidden" id="edit" name="edit" value="6">
                        <input type="hidden" name="vid-id" value="'.$row['id'].'"/>
                        <button name="remove-vid" title="Remove Video" class="btn btn-danger btn-xs"><i class="icon-trash" value="'.$row['id'].'"></i></button>
                        </form>
                        </td>
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
              </div> -->
              <div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
				<div class="col-lg-10">
				  <table class="table">
					<tbody>
					<?php

					$date1 = ''; $date2 = '';

					$query = mysqli_query($connect, "select * from upload where location = 'bottom-right' and template_id = 6 and status = 1");
					if ($query->num_rows > 0){
					  while($row = mysqli_fetch_array($query)){
					  	$date = new DateTime();
					  	$now = new DateTime($row['show_to']);

					  	if($row['show_from'] != ''){
					  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
					  	}
					  	if($row['show_to'] != ''){
					  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
					  	}

						echo '
						  <tr id="main_td">
							  <td>'.$row['name'].'</td>
							  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>remaining</em>").'</td>
							  <td>
							  	<input type="hidden" name="inac_id" value="'.$row['id'].'"/>
								<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
								<button type="submit" name="deac-vid" title="Deactivate" class="btn btn-default btn-xs pull-right"><i class="icon-minus-sign"></i></button>
							  </td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
						  		<input type="hidden" name="vid_id3[]" value="'.$row['id'].'"/>
							  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control in-from" name="show_from3[]" style="font-size: 11px;" '.$date1.'></div>
							  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control in-to" name="show_to3[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
							</td>
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
			<div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label">Inactive Videos</label>
				<div class="col-lg-10">
				  <table class="table">
					<tbody>
					<?php

					$date1 = ''; $date2 = '';

					$query = mysqli_query($connect, "select * from upload where location = 'bottom-right' and template_id = 6 and status = 0");
					if ($query->num_rows > 0){
					  while($row = mysqli_fetch_array($query)){

						$date = new DateTime();
						$now = new DateTime($row['date_ended']);

					  	if($row['show_from'] != ''){
					  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
					  	}
					  	if($row['show_to'] != ''){
					  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
					  	}

						echo '
						  <tr id="main_td">
							  <td>'.$row['name'].'</td>
							  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>since deac.</em>").'</td>
							  <td>
								<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
							  </td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
						  		<input type="hidden" name="inacvid_id3[]" value="'.$row['id'].'"/>
							  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control" name="inacshow_from3[]" style="font-size: 11px;" '.$date1.'></div>
							  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control" name="inacshow_to3[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
							</td>
						  </tr>
						';
					  }
					}
					else {
					  echo '
						<tr>
						  <td colspan="3"><span>No inactive videos.</span></td>
						</tr>
					  ';
					}

					?>
					</tbody>
				</table>
				</div>
			</div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
				  <input type="hidden" id="edit" name="edit" value="6">
                  <input type="submit" name="submit_bottomright" value="Submit" class="btn btn-primary">
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    
  <!--Bottom Left Slider-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="bottom-left" class="modal fade">
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
              <h4 class="modal-title">Bottom Left Slider Images</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Image(s)</label>
                <div class="col-lg-10">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <span class="btn btn-white btn-file">
                    <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
                    <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                    <input type="file" class="default" name="bottomleft[]" multiple="multiple" accept=".png,.jpeg,.jpg,.gif"/>
                    </span>
                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                  </div>
                  <span>A image with a resolution of 000 x 00 is recommended.</span>
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
                <div class="col-lg-10">
                  <table class="table">

                  <tbody>
                  <?php

                  $query = mysqli_query($connect, "select * from upload where location = 'bottom-left' AND `template_id` = 6");
                  if ($query->num_rows > 0){
                    while($row = mysqli_fetch_array($query)){
                    echo '
                      <tr>
                        <td>
                        <img src="" style="height: 20px; width: 37px;">
                        </td>
                        <td>'.$row['name'].'</td>
                        <td>
                        <form method="POST">
						  <input type="hidden" id="edit" name="edit" value="6">
                          <input type="hidden" name="sl-id" value="'.$row['id'].'"/>
                          <button name="remove-sl" title="Remove Image" class="btn btn-danger btn-xs"><i class="icon-trash" value="'.$row['id'].'"></i></button>
                        </form>
                        </td>
                      </tr>
                    ';
                    }
                  }
                  else {
                    echo '
                    <tr>
                      <td colspan="3"><span>No images uploaded.</span></td>
                    </tr>
                    ';
                  }

                  ?>
                  </tbody>
                </table>
                </div>
              </div> -->
              <div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label">Currently Uploaded</label>
				<div class="col-lg-10">
				  <table class="table">
					<tbody>
					<?php

					$date1 = ''; $date2 = '';

					$query = mysqli_query($connect, "select * from upload where location = 'bottom-left' and template_id = 6 and status = 1");
					if ($query->num_rows > 0){
					  while($row = mysqli_fetch_array($query)){
					  	$date = new DateTime();
					  	$now = new DateTime($row['show_to']);

					  	if($row['show_from'] != ''){
					  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
					  	}
					  	if($row['show_to'] != ''){
					  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
					  	}

						echo '
						  <tr id="main_td">
							  <td>'.$row['name'].'</td>
							  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>remaining</em>").'</td>
							  <td>
							  	<input type="hidden" name="inac_id" value="'.$row['id'].'"/>
								<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
								<button type="submit" name="deac-vid" title="Deactivate" class="btn btn-default btn-xs pull-right"><i class="icon-minus-sign"></i></button>
							  </td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
						  		<input type="hidden" name="vid_id4[]" value="'.$row['id'].'"/>
							  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control in-from" name="show_from4[]" style="font-size: 11px;" '.$date1.'></div>
							  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control in-to" name="show_to4[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
							</td>
						  </tr>
						';
					  }
					}
					else {
					  echo '
						<tr>
						  <td colspan="3"><span>No image uploaded.</span></td>
						</tr>
					  ';
					}

					?>
					</tbody>
				</table>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 col-sm-2 control-label">Inactive Images</label>
				<div class="col-lg-10">
				  <table class="table">
					<tbody>
					<?php

					$date1 = ''; $date2 = '';

					$query = mysqli_query($connect, "select * from upload where location = 'bottom-left' and template_id = 6 and status = 0");
					if ($query->num_rows > 0){
					  while($row = mysqli_fetch_array($query)){

						$date = new DateTime();
						$now = new DateTime($row['date_ended']);

					  	if($row['show_from'] != ''){
					  		$date1 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_from'])).'"';
					  	}
					  	if($row['show_to'] != ''){
					  		$date2 = 'value="'.strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['show_to'])).'"';
					  	}

						echo '
						  <tr id="main_td">
							  <td>'.$row['name'].'</td>
							  <td>'.$date->diff($now)->format("%d days, %h hrs. and %i mins. <em>since deac.</em>").'</td>
							  <td>
								<a name="set-vid" title="Set Time" class="btn btn-info btn-xs shet pull-right"><i class="icon-time"></i></a>
							  </td>
						  </tr>
						  <tr>
						  	<td colspan="3" style="padding: 0px 0px 7px 0px; border: none;">
						  		<input type="hidden" name="inacvid_id4[]" value="'.$row['id'].'"/>
							  	<div class="col-xs-6"><span class="text-muted" style="font-size: 12px;">from</span> <input type="datetime-local" class="form-control" name="inacshow_from4[]" style="font-size: 11px;" '.$date1.'></div>
							  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control" name="inacshow_to4[]" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
							</td>
						  </tr>
						';
					  }
					}
					else {
					  echo '
						<tr>
						  <td colspan="3"><span>No inactive image.</span></td>
						</tr>
					  ';
					}

					?>
					</tbody>
				</table>
				</div>
			</div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
				  <input type="hidden" id="edit" name="edit" value="6">
                  <input type="submit" name="submit_bottomleft" value="Submit" class="btn btn-primary">
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>


  <!--Text Scroller-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="scroller-settings" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
				  <?php

				  $query_getscroll = mysqli_query($connect, "SELECT `marquee_text`, `font_type`, `font_color`, `font_size`, `scroll_speed` FROM `marquee` where `template_id` = 6");
				  $row = mysqli_fetch_array($query_getscroll);

				  $get_text = $row['marquee_text'];
				  $get_type = $row['font_type'];
				  $get_color = $row['font_color'];
				  $get_size = $row['font_size'];
				  $get_speed = $row['scroll_speed'];

				  ?>
					<div class="modal-header">
						<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
						<h4 class="modal-title">Scroller Settings</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal tasi-form" role="form" method="POST">
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Scroll Text</label>
								<div class="col-lg-10">
									<textarea class="form-control" name="mrq_text"><?php echo $get_text; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Font Family</label>
								<div class="col-lg-10">
									<select class="form-control m-bot15" name="mrq_font_fam">
										<option value="Arial" <?php if ($get_type == "Arial") echo 'selected'; ?>>Arial</option>
										<option value="Arial Black" <?php if ($get_type == "Arial Black") echo 'selected'; ?>>Arial Black</option>
										<option value="Courier" <?php if ($get_type == "Courier") echo 'selected'; ?>>Courier</option>
										<option value="Times New Roman" <?php if ($get_type == "Times New Roman") echo 'selected'; ?>>Times New Roman</option>
										<option value="Verdana" <?php if ($get_type == "Verdana") echo 'selected'; ?>>Verdana</option>
										<option value="Comic Sans MS" <?php if ($get_type == "Comic Sans MS") echo 'selected'; ?>>Comic Sans MS</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Font Color</label>
								<div class="col-lg-10">
								  <div class="input-group m-bot15">
									  <span class="input-group-addon"><i id="prev_color" class="icon-circle" style="color: <?php echo $get_color; ?>"></i></span>
									  <select class="form-control m-bot15" name="mrq_color" onchange="changeColor(this);">
										<option value="#F44336" <?php if ($get_color == "#F44336") echo 'selected'; ?>>Red</option>
										<option value="#FF4081" <?php if ($get_color == "#FF4081") echo 'selected'; ?>>Pink</option>
										<option value="#9C27B0" <?php if ($get_color == "#9C27B0") echo 'selected'; ?>>Purple</option>
										<option value="#2196F3" <?php if ($get_color == "#2196F3") echo 'selected'; ?>>Blue</option>
										<option value="#009688" <?php if ($get_color == "#009688") echo 'selected'; ?>>Teal</option>
										<option value="#4CAF50" <?php if ($get_color == "#4CAF50") echo 'selected'; ?>>Green</option>
										<option value="#CDDC39" <?php if ($get_color == "#CDDC39") echo 'selected'; ?>>Lime</option>
										<option value="#FFEB3B" <?php if ($get_color == "#FFEB3B") echo 'selected'; ?>>Yellow</option>
										<option value="#FF9800" <?php if ($get_color == "#FF9800") echo 'selected'; ?>>Orange</option>
										<option value="#795548" <?php if ($get_color == "#795548") echo 'selected'; ?>>Brown</option>
										<option value="#9E9E9E" <?php if ($get_color == "#9E9E9E") echo 'selected'; ?>>Gray</option>
										<option value="#607D8B" <?php if ($get_color == "#607D8B") echo 'selected'; ?>>Blue Gray</option>
										<option value="#000000" <?php if ($get_color == "#000000") echo 'selected'; ?>>Black</option>
										<option value="#FFFFFF" <?php if ($get_color == "#FFFFFF") echo 'selected'; ?>>White</option>
									  </select>
								  </div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Font Size</label>
								<div class="col-lg-3">
								  <select class="form-control m-bot15" name="mrq_size">
									<option value="80" <?php if ($get_size == "80") echo 'selected'; ?>>80</option>
									<option value="75" <?php if ($get_size == "75") echo 'selected'; ?>>75</option>
									<option value="70" <?php if ($get_size == "70") echo 'selected'; ?>>70</option>
									<option value="65" <?php if ($get_size == "65") echo 'selected'; ?>>65</option>
									<option value="60" <?php if ($get_size == "60") echo 'selected'; ?>>60</option>
									<option value="55" <?php if ($get_size == "55") echo 'selected'; ?>>55</option>
									<option value="50" <?php if ($get_size == "50") echo 'selected'; ?>>50</option>
									<option value="45" <?php if ($get_size == "45") echo 'selected'; ?>>45</option>
									<option value="40" <?php if ($get_size == "40") echo 'selected'; ?>>40</option>
									<option value="35" <?php if ($get_size == "35") echo 'selected'; ?>>35</option>
									<option value="30" <?php if ($get_size == "30") echo 'selected'; ?>>30</option>
									<option value="25" <?php if ($get_size == "25") echo 'selected'; ?>>25</option>
									<option value="20" <?php if ($get_size == "20") echo 'selected'; ?>>20</option>
									<option value="15" <?php if ($get_size == "15") echo 'selected'; ?>>15</option>
									<option value="10" <?php if ($get_size == "10") echo 'selected'; ?>>10</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Scroller Speed</label>
								<div class="col-lg-10">
								  <select class="form-control m-bot15" name="mrq_speed">
									  <option value="30" <?php if ($get_speed == "30") echo 'selected'; ?>>Very Fast</option>
									  <option value="25" <?php if ($get_speed == "25") echo 'selected'; ?>>Fast</option>
									  <option value="20" <?php if ($get_speed == "20") echo 'selected'; ?>>Moderately Fast</option>
									  <option value="15" <?php if ($get_speed == "15") echo 'selected'; ?>>Normal</option>
									  <option value="10" <?php if ($get_speed == "10") echo 'selected'; ?>>Moderately Slow</option>
									  <option value="5" <?php if ($get_speed == "5") echo 'selected'; ?>>Slow</option>
									  <option value="1" <?php if ($get_speed == "1") echo 'selected'; ?>>Very Slow</option>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<input type="hidden" id="edit" name="edit" value="6">
									<button type="submit" name="submit_scroller" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>
					  </div>
				  </div>
			  </div>
		  </div>

  <!--Background Setting-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="bg-settings" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <?php

          $query_bg = mysqli_query($connect, "SELECT `bg_color` FROM `background` where `template_id` = 6");
          $row = mysqli_fetch_array($query_bg);

          $get_bg = $row['bg_color'];

          ?>
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Background Color</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="post">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Background Color</label>
                <div class="col-lg-10">
                  <div class="input-group m-bot15">
                    <span class="input-group-addon"><i id="prev_bg" class="icon-circle" style="color: <?php echo $get_bg; ?>;"></i></span>
                      <select class="form-control m-bot15" name="select_bg" onchange="changeBg(this);">
                        <option value="#F44336" <?php if ($get_bg == "#F44336") echo 'selected'; ?>>Red</option>
                        <option value="#FF4081" <?php if ($get_bg == "#FF4081") echo 'selected'; ?>>Pink</option>
                        <option value="#9C27B0" <?php if ($get_bg == "#9C27B0") echo 'selected'; ?>>Purple</option>
                        <option value="#2196F3" <?php if ($get_bg == "#2196F3") echo 'selected'; ?>>Blue</option>
                        <option value="#009688" <?php if ($get_bg == "#009688") echo 'selected'; ?>>Teal</option>
                        <option value="#4CAF50" <?php if ($get_bg == "#4CAF50") echo 'selected'; ?>>Green</option>
                        <option value="#CDDC39" <?php if ($get_bg == "#CDDC39") echo 'selected'; ?>>Lime</option>
                        <option value="#FFEB3B" <?php if ($get_bg == "#FFEB3B") echo 'selected'; ?>>Yellow</option>
                        <option value="#FF9800" <?php if ($get_bg == "#FF9800") echo 'selected'; ?>>Orange</option>
                        <option value="#795548" <?php if ($get_bg == "#795548") echo 'selected'; ?>>Brown</option>
                        <option value="#9E9E9E" <?php if ($get_bg == "#9E9E9E") echo 'selected'; ?>>Gray</option>
                        <option value="#607D8B" <?php if ($get_bg == "#607D8B") echo 'selected'; ?>>Blue Gray</option>
                        <option value="#000000" <?php if ($get_bg == "#000000") echo 'selected'; ?>>Black</option>
                        <option value="#FFFFFF" <?php if ($get_bg == "#FFFFFF") echo 'selected'; ?>>White</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
				  <input type="hidden" id="edit" name="edit" value="6">
                  <button type="submit" name="submit_bg" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>

            </div>

          </div>
        </div>
      </div>

  <!--Emergency Message Setting-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="emer-msg" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            <h4 class="modal-title">Emergency Message</h4>
          </div>
          <?php

          $get_last_emer = mysqli_query($connect, "SELECT * FROM `emergency` LIMIT 1");
          $row_emer = mysqli_fetch_array($get_last_emer);

          $e_title = $row_emer['title'];
          $e_tcolor = $row_emer['title_color'];
          $e_msg = $row_emer['message'];
          $e_dura = $row_emer['duration'];

          ?>
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Emergency Title</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" name="emer_name" value="<?php echo $e_title; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Title Font Color</label>
                <div class="col-lg-10">
                  <div class="input-group m-bot15">
                      <span class="input-group-addon"><i id="prev_emt" class="icon-circle" style="color: <?php echo $e_tcolor; ?>"></i></span>
                      <select class="form-control m-bot15" name="emer_titlecolor" onchange="changeEmT(this);">
                        <option value="#F44336" <?php if ($e_tcolor == "#F44336") echo 'selected'; ?>>Red</option>
                        <option value="#FF4081" <?php if ($e_tcolor == "#FF4081") echo 'selected'; ?>>Pink</option>
                        <option value="#9C27B0" <?php if ($e_tcolor == "#9C27B0") echo 'selected'; ?>>Purple</option>
                        <option value="#2196F3" <?php if ($e_tcolor == "#2196F3") echo 'selected'; ?>>Blue</option>
                        <option value="#009688" <?php if ($e_tcolor == "#009688") echo 'selected'; ?>>Teal</option>
                        <option value="#4CAF50" <?php if ($e_tcolor == "#4CAF50") echo 'selected'; ?>>Green</option>
                        <option value="#CDDC39" <?php if ($e_tcolor == "#CDDC39") echo 'selected'; ?>>Lime</option>
                        <option value="#FFEB3B" <?php if ($e_tcolor == "#FFEB3B") echo 'selected'; ?>>Yellow</option>
                        <option value="#FF9800" <?php if ($e_tcolor == "#FF9800") echo 'selected'; ?>>Orange</option>
                        <option value="#9E9E9E" <?php if ($e_tcolor == "#9E9E9E") echo 'selected'; ?>>Gray</option>
                        <option value="#607D8B" <?php if ($e_tcolor == "#607D8B") echo 'selected'; ?>>Blue Gray</option>
                        <option value="#FFFFFF" <?php if ($e_tcolor == "#FFFFFF") echo 'selected'; ?>>White</option>
                      </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Emergency Message</label>
                <div class="col-lg-10">
                  <textarea class="form-control" name="emer_msg"><?php echo $e_msg; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-2 col-sm-2 control-label">Display Duration</label>
                <div class="col-lg-4">
                  <select class="form-control m-bot15" name="emer_secs">
                    <option value="1500000" <?php if ($e_dura == "1500000") echo 'selected'; ?>>15 minutes</option>
                    <option value="1000000" <?php if ($e_dura == "1000000") echo 'selected'; ?>>10 minutes</option>
                    <option value="500000" <?php if ($e_dura == "500000") echo 'selected'; ?>>5 minutes</option>
                    <option value="300000" <?php if ($e_dura == "300000") echo 'selected'; ?>>3 minutes</option>
                    <option value="100000" <?php if ($e_dura == "100000") echo 'selected'; ?>>1 minute</option>
                    <option value="30000" <?php if ($e_dura == "30000") echo 'selected'; ?>>30 seconds</option>
                    <option value="20000" <?php if ($e_dura == "20000") echo 'selected'; ?>>20 seconds</option>
                    <option value="15000" <?php if ($e_dura == "15000") echo 'selected'; ?>>15 seconds</option>
                    <option value="10000" <?php if ($e_dura == "10000") echo 'selected'; ?>>10 seconds</option>
                    <option value="7000" <?php if ($e_dura == "7000") echo 'selected'; ?>>7 seconds</option>
                    <option value="5000" <?php if ($e_dura == "5000") echo 'selected'; ?>>5 seconds</option>
                  </select>
                </div>
              </div>
				<div class="form-group">
					<label class="col-lg-2 col-sm-2 control-label">Image</label>
					<div class="col-lg-10">

			  <div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
				  <img src="img/no_img.png" alt="" />
				</div>
				<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
				<div>
				 <span class="btn btn-white btn-file">
				 <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
				 <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
				 <input type="file" class="default" name="imgemer" accept=".png,.jpeg,.jpg,.gif"/>
				 </span>
				  <button type="submit" id="del_emerimg" name="del_emerimg" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</button>
				</div>
			  </div>
					 <span>An image with a resolution of 000 x 00 is recommended.</span>
					</div>
				</div>
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" name="submit_emer" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>

            </div>

          </div>
        </div>
      </div>

      <?php include 'include_autorefresh.php'; ?>

      <!--main content end-->
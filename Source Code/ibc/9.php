
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

					//Slider Caller
					if(isset($_POST['submit_left'])){
						$noti = updateSlider($_FILES['mainleft'], 'main-left', $connect, $_POST['edit']);
						echo $noti;

						if(isset($_POST['vid_id'])){
							updateSched($connect, $_POST['vid_id'], $_POST['show_from'], $_POST['show_to'], 'main-left', $_POST['edit']);
						}

						if(isset($_POST['inacvid_id'])){
							updateSched($connect, $_POST['inacvid_id'], $_POST['inacshow_from'], $_POST['inacshow_to'], 'main-left', $_POST['edit']);
						}
					}
					
					if(isset($_POST['submit_right'])){
						$noti = updateSlider($_FILES['mainright'], 'main-right', $connect, $_POST['edit']);
						echo $noti;

						if(isset($_POST['vid_id2'])){
							updateSched($connect, $_POST['vid_id2'], $_POST['show_from2'], $_POST['show_to2'], 'main-right', $_POST['edit']);
						}

						if(isset($_POST['inacvid_id2'])){
							updateSched($connect, $_POST['inacvid_id2'], $_POST['inacshow_from2'], $_POST['inacshow_to2'], 'main-right', $_POST['edit']);
						}
					}
					//end Slide Caller
				?>
			  </div>
			  <div class="row">
				<div class="col-lg-6">
				  <section class="panel" style="height: 700px;">
					<div class="panel-body">
					  <p class="text-center" style="font-weight: bold;">Main - Left<br>
					  <?php $get_btn = knowActionMain('main-left', $connect, 9, 'image(s)'); echo $get_btn[3]; ?>
					  </p>
					  <p class="text-center">
						<button class="<?php echo $get_btn[0]; ?>" href="#main-left" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
					  </p>
					</div>
				  </section>
				</div>
                <div class="col-lg-6">
                  <section class="panel" style="height: 700px;">
                    <div class="panel-body">
                      <p class="text-center" style="font-weight: bold;">Main - Right<br>
                      <?php $get_btn = knowActionMain('main-right', $connect, 9, 'image(s)'); echo $get_btn[3]; ?>
                      </p>
                      <p class="text-center">
                        <button class="<?php echo $get_btn[0]; ?>" href="#main-right" data-toggle="modal"><i class="<?php echo $get_btn[1]; ?>"></i> <?php echo $get_btn[2]; ?></button>
                      </p>
                    </div>
                  </section>
                </div>
              </div>
              <!-- page end-->
        </section>
    </section>

<!--Modal-->
	<!--Main Slider Left-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="main-left" class="modal fade">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h4 class="modal-title">Main Slider Left</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Image(s)</label>
								<div class="col-lg-10">
									<div class="fileupload fileupload-new" data-provides="fileupload">
									  <span class="btn btn-white btn-file">
									  <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
									  <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
									  <input type="file" class="default" name="mainleft[]" multiple="multiple" accept=".png,.jpeg,.jpg,.gif"/>
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

									$query = mysqli_query($connect, "select * from upload where location = 'main-left' AND `template_id` = 9");
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
												  <input type="hidden" id="edit" name="edit" value="9">
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

				                  $query = mysqli_query($connect, "select * from upload where location = 'main-left' and template_id = 9 and status = 1");
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
				                <label class="col-lg-2 col-sm-2 control-label">Inactive Image</label>
				                <div class="col-lg-10">
				                  <table class="table">
				                  <tbody>
				                  <?php

				                  $date1 = ''; $date2 = '';

				                  $query = mysqli_query($connect, "select * from upload where location = 'main-left' and template_id = 9 and status = 0");
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
									<input type="hidden" id="edit" name="edit" value="9">
									<input type="submit" name="submit_left" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	<!--Main Slider Right-->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="main-right" class="modal fade">
			<form class="form-horizontal" method="post" enctype="multipart/form-data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
							<h4 class="modal-title">Main Slider Right</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="col-lg-2 col-sm-2 control-label">Image(s)</label>
								<div class="col-lg-10">
									<div class="fileupload fileupload-new" data-provides="fileupload">
									  <span class="btn btn-white btn-file">
									  <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
									  <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
									  <input type="file" class="default" name="mainright[]" multiple="multiple" accept=".png,.jpeg,.jpg,.gif"/>
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

									$query = mysqli_query($connect, "select * from upload where location = 'main-right' AND `template_id` = 9");
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
												  <input type="hidden" id="edit" name="edit" value="9">
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

									$query = mysqli_query($connect, "select * from upload where location = 'main-right' and template_id = 9 and status = 1");
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

									$query = mysqli_query($connect, "select * from upload where location = 'main-right' and template_id = 9 and status = 0");
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
											  	<div class="col-xs-6"> <span class="text-muted" style="font-size: 12px;">to</span> <input type="datetime-local" class="form-control" name="inacshow_to2 []" style="font-size: 11px;" '.$date2.' min="'.date('Y-m-d').'T00:00:00"></div>
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
									<input type="hidden" id="edit" name="edit" value="9">
									<input type="submit" name="submit_right" value="Submit" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		
  <!--Background Setting-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="bg-settings" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <?php

          $query_bg = mysqli_query($connect, "SELECT `bg_color` FROM `background` WHERE `template_id` = 9");
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
				  <input type="hidden" id="edit" name="edit" value="9">
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
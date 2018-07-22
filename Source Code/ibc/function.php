<?php

if(!defined('EDIT_VIEW')){
  die("<strong>403:</strong> Direct Access Forbidden!");
}

//Header Functions
function updateHeader($files, $section, $conn, $temp_num){

	$target_dir = "upload/template_".$temp_num."/images/";
	$name = $files['name'];
	$tmpname = $files['tmp_name'];
	$string = str_replace(" ", "-", $name);
	$target_file = $target_dir . basename($string);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$file_name = pathinfo($name, PATHINFO_FILENAME);

	if($tmpname != ""){
		if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif")
		{
			$disp = '
			<div class="col-lg-12">
			  <div class="alert alert-block alert-danger fade in">
				  <button data-dismiss="alert" class="close close-sm" type="button">
					  <i class="icon-remove"></i>
				  </button>
				  <strong>Oh snap!</strong> Seems like you uploaded an unsupported file type.
			  </div>
			</div>
			';
		}
		else if(file_exists($target_dir.$string)){
			$count = "Select COUNT(name) as name from upload where name like '%{$file_name}%'";
			$query = mysqli_query($conn, $count);
			$rows = mysqli_fetch_array($query);
			$num_file = $rows['name'];
			$new_name = "$file_name"."("."$num_file".")."."$imageFileType";
			copy("$target_file", "$target_dir"."$new_name");

			$check_head = mysqli_query($conn, "SELECT * FROM `upload` WHERE `location` = '$section' AND `template_id` = '$temp_num'");
			$row_h = mysqli_fetch_array($check_head);

			if($check_head->num_rows > 0){
				$old_name = $row_h['name'];
				unlink('upload/template_'.$temp_num.'/images/'.$old_name);
				move_uploaded_file($tmpname, $target_file);
				mysqli_query($conn, "UPDATE `upload` SET `name` = '$new_name', `type` = '$imageFileType', `template_id` = '$temp_num' WHERE `location` = '$section'");

				logUpdate('UPDATE', $section, $row_h['name'], $new_name, $conn, $_SESSION['user'], 'IMAGE', $temp_num);

				$disp =  '
				<div class="col-lg-12">
				  <div class="alert alert-success fade in">
					  <button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
					  </button>
					  <strong>Well done!</strong> You successfully updated the image to the display.
				  </div>
				</div>
				';
			} else {
				move_uploaded_file($tmpname, $target_file);
				mysqli_query($conn, "Insert into upload(name, type, location, template_id) values('$new_name', '$imageFileType', '$section', '$temp_num')");

				logInsertDel('INSERT', $section, $new_name, $conn, $_SESSION['user'], 'IMAGE', $temp_num);

				$disp =  '
				<div class="col-lg-12">
				  <div class="alert alert-success fade in">
					  <button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
					  </button>
					  <strong>Well done!</strong> You successfully uploaded the image to the display.
				  </div>
				</div>
				';
			}
		}
		else
		{
			$check_head = mysqli_query($conn, "SELECT * FROM `upload` WHERE `location` = '$section' AND `template_id` = '$temp_num'");
			$row_h = mysqli_fetch_array($check_head);

			if($check_head->num_rows > 0){
				$old_name = $row_h['name'];
				unlink('upload/template_'.$temp_num.'/images/'.$old_name);
				move_uploaded_file($tmpname, $target_file);
				mysqli_query($conn, "UPDATE `upload` SET `name` = '$string', `type` = '$imageFileType', `template_id` = '$temp_num' WHERE `location` = '$section'");

				logUpdate('UPDATE', $section, $row_h['name'], $string, $conn, $_SESSION['user'], 'IMAGE', $temp_num);

				$disp =  '
				<div class="col-lg-12">
				  <div class="alert alert-success fade in">
					  <button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
					  </button>
					  <strong>Well done!</strong> You successfully updated the image to the display.
				  </div>
				</div>
				';
			} else {
				move_uploaded_file($tmpname, $target_file);
				mysqli_query($conn, "Insert into upload(name, type, location, template_id) values('$string', '$imageFileType', '$section', '$temp_num')");

				logInsertDel('INSERT', $section, $string, $conn, $_SESSION['user'], 'IMAGE', $temp_num);

				$disp =  '
				<div class="col-lg-12">
				  <div class="alert alert-success fade in">
					  <button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
					  </button>
					  <strong>Well done!</strong> You successfully uploaded the image to the display.
				  </div>
				</div>
				';
			}
		}
	}
	else{
		$disp = '
			<div class="col-lg-12">
			  <div class="alert alert-block alert-danger fade in">
				  <button data-dismiss="alert" class="close close-sm" type="button">
					  <i class="icon-remove"></i>
				  </button>
				  <strong>Oh snap!</strong> You uploaded nothing. Please try again.
			  </div>
			</div>
			';
	}

	return $disp;
}
//end Header Functions


//Videos Function
function updateAdVideos($files, $location, $conn, $temp_num){
	$upload_num = count($files['name']);
	if($upload_num > 0){
		for($i = 0; $i < $upload_num; $i++){
		  $target_dir = "upload/template_".$temp_num."/videos/";
		  $name = $files['name'][$i];
		  $tmpname = $files['tmp_name'][$i];
		  $string = str_replace(" ", "-", $name);
		  $target_file = $target_dir . basename($string);
		  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		  $file_name = pathinfo($name, PATHINFO_FILENAME);
		  //$size = $_FILES['mainad']['size'][$i]; 
		  if($tmpname != ""){
			if($imageFileType != "mp4" && $imageFileType != "MP4" && $imageFileType != "avi" && $imageFileType != "AVI"&& $imageFileType != "MKV" && $imageFileType != "mkv")
			{
			  $disp = '
					<div class="col-lg-12">
					  <div class="alert alert-block alert-danger fade in">
						  <button data-dismiss="alert" class="close close-sm" type="button">
							  <i class="icon-remove"></i>
						  </button>
						  <strong>Oh snap!</strong> Seems like you uploaded an unsupported file type.
					  </div>
					</div>
					';
			}
			/*else if ($size > 41943040){
			  echo "File Size Exceeds 40MB";
			}*/
			else if(file_exists($target_dir.$string)){
				$count = "Select COUNT(name) as name from upload where name like '%{$file_name}%'";
				$query = mysqli_query($conn, $count);
				$rows = mysqli_fetch_array($query);
				$num_file = $rows['name'];
				$new_name = "$file_name"."("."$num_file".")."."$imageFileType";
				copy("$target_file", "$target_dir"."$new_name");
				mysqli_query($conn, "Insert into upload(name, type, location, template_id) values('$new_name', '$imageFileType', '$location', '$temp_num')");

				logInsertDel('INSERT', $location, $new_name, $conn, $_SESSION['user'], 'VIDEO', $temp_num);
				
				$disp = '
				<div class="col-lg-12">
				  <div class="alert alert-success fade in">
					  <button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
					  </button>
					  <strong>Well done!</strong> You successfully uploaded video(s) to the display.
				  </div>
				</div>
				';
			}
			else
			{
			  move_uploaded_file($tmpname ,$target_file);
			  mysqli_query($conn, "Insert into upload(name, type, location, template_id) values('$string', '$imageFileType', '$location', '$temp_num')");

			  logInsertDel('INSERT', $location, $string, $conn, $_SESSION['user'], 'VIDEO', $temp_num);

			  $disp = '
				<div class="col-lg-12">
				  <div class="alert alert-success fade in">
					  <button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
					  </button>
					  <strong>Well done!</strong> You successfully uploaded video(s) to the display.
				  </div>
				</div>
				';
			}
		  }
		  else {
				$disp = '
					<div class="col-lg-12">
					  <div class="alert alert-block alert-danger fade in">
						  <button data-dismiss="alert" class="close close-sm" type="button">
							  <i class="icon-remove"></i>
						  </button>
						  <strong>Oh snap!</strong> You uploaded nothing. Please try again.
					  </div>
					</div>
					';
			}
		}
	}
	return $disp;
}
//end Videos Function

//Volume Function
function updateVolume($vol, $location, $conn, $temp_num){

  $qry_getvol = mysqli_query($conn, "SELECT `volume` FROM `mute` WHERE `location` = '$location' AND `template_id` = '$temp_num'");
  $row_vol = mysqli_fetch_array($qry_getvol);

  $disp = mysqli_query($conn, "UPDATE `mute` SET `volume` = '$vol' WHERE `location` = '$location' AND `template_id` = '$temp_num'");

  logUpdate('UPDATE', $location, $row_vol['volume'], $vol, $conn, $_SESSION['user'], 'VOLUME', $temp_num);

  if($disp = true){
	echo '
		<div class="col-lg-12">
		<div class="alert alert-success fade in">
		  <button data-dismiss="alert" class="close close-sm" type="button">
			<i class="icon-remove"></i>
		  </button>
		  <strong>Well done!</strong> You successfully changed the volume.
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
//end Volume Function

		 
//Slider Function
function updateSlider($files, $location, $conn, $temp_num){
	$disp = "";
	$upload_num = count($files['name']);
	if($upload_num > 0){
	  for($i = 0; $i < $upload_num; $i++){
		$target_dir = "upload/template_".$temp_num."/images/";
		$name = $files['name'][$i];
		$tmpname = $files['tmp_name'][$i];
		$string = str_replace(" ", "-", $name);
		$target_file = $target_dir . basename($string);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$file_name = pathinfo($name, PATHINFO_FILENAME);
		//$size = $_FILES['mainad']['size'][$i]; 
		if($tmpname != ""){
		  if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "gif" && $imageFileType != "GIF")
		  {
			$disp = '
			<div class="col-lg-12">
			  <div class="alert alert-block alert-danger fade in">
				  <button data-dismiss="alert" class="close close-sm" type="button">
					  <i class="icon-remove"></i>
				  </button>
				  <strong>Oh snap!</strong> Seems like you uploaded an unsupported file type.
			  </div>
			</div>
			';
		  }
		  /*else if ($size > 41943040){
			echo "File Size Exceeds 40MB";
		  }*/
		  else if(file_exists($target_dir.$string)){
				$count = "Select COUNT(name) as name from upload where name like '%{$file_name}%'";
				$query = mysqli_query($conn, $count);
				$rows = mysqli_fetch_array($query);
				$num_file = $rows['name'];
				$new_name = "$file_name"."("."$num_file".")."."$imageFileType";
				copy("$target_file", "$target_dir"."$new_name");
				mysqli_query($conn, "Insert into upload(name, type, location, template_id) values('$new_name', '$imageFileType', '$location', '$temp_num')");

				logInsertDel('INSERT', $location, $new_name, $conn, $_SESSION['user'], 'IMAGE', $temp_num);
				
				$disp = '
				<div class="col-lg-12">
				  <div class="alert alert-success fade in">
					  <button data-dismiss="alert" class="close close-sm" type="button">
						  <i class="icon-remove"></i>
					  </button>
					  <strong>Well done!</strong> You successfully uploaded image(s) to the display.
				  </div>
				</div>
				';
			}
		  else 
		  {
		  	move_uploaded_file($tmpname ,$target_file);
			mysqli_query($conn, "Insert into upload(name, type, location, template_id) values('$string', '$imageFileType', '$location', '$temp_num')");

			logInsertDel('INSERT', $location, $string, $conn, $_SESSION['user'], 'IMAGE', $temp_num);

			$disp = '
			<div class="col-lg-12">
					  <div class="alert alert-success fade in">
						  <button data-dismiss="alert" class="close close-sm" type="button">
							  <i class="icon-remove"></i>
						  </button>
						  <strong>Well done!</strong> You successfully uploaded images(s) to the display.
					  </div>
			</div>
			';
		  }
		}
		
	  }
	}
	return $disp;
}
//End Slider Function


//Delete Function
function del_upload($id, $conn, $type, $location, $temp_num){
	$query = mysqli_query($conn, "select * FROM upload WHERE id = '$id'");
	$row = mysqli_fetch_array($query);
	$file_name = $row['name'];

	if(unlink('upload/template_'.$temp_num.'/'.$type.'/'.$file_name) && mysqli_query($conn, "DELETE FROM upload WHERE id = '$id'")){

		logInsertDel('DELETE', $location, $file_name, $conn, $_SESSION['user'], strtoupper(substr($type, 0, 5)), $temp_num);

		$div = '
		<div class="col-lg-12">
			<div class="alert alert-success fade in">
				<button data-dismiss="alert" class="close close-sm" type="button">
					<i class="icon-remove"></i>
				</button>
				<strong>Well done!</strong> You successfully deleted a '.substr($type, 0, 5).' to the display.
			</div>
		</div>
	  ';
	} else {
		$div = '
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
	return $div;
}
//end Delete Function


//Delete Caller
if(isset($_POST['remove-vid'])){
	$id_rem = $_POST['checkbox'];
	for($i = 0; $i < count($id_rem); $i++){
		$id = $id_rem[$i];
		$type = $_POST['type'][$i];
		$qry_getloc = mysqli_query($connect, "SELECT * FROM `upload` WHERE `id` = '$id'");
		$row_getloc = mysqli_fetch_array($qry_getloc);
		$noti = del_upload($id, $connect, $type, $row_getloc['location'], $_POST['edit']);
	}
	echo $noti;
}

if(isset($_POST['remove-sl'])){
	$id_sl = $_POST['sl-id'];
	$qry_getloc = mysqli_query($connect, "SELECT * FROM `upload` WHERE `id` = '$id_sl'");
	$row_getloc = mysqli_fetch_array($qry_getloc);

	$noti = del_upload($_POST['sl-id'], $connect, 'images', $row_getloc['location'], $_POST['edit']);
	echo $noti;            
}

if(isset($_POST['del_head'])){
	$id_hd = $_POST['hd_id'];
	$qry_getloc = mysqli_query($connect, "SELECT * FROM `upload` WHERE `id` = '$id_hd'");
	$row_getloc = mysqli_fetch_array($qry_getloc);

	$noti = del_upload($_POST['hd_id'], $connect, 'images', $row_getloc['location'], $_POST['edit']);
	echo $noti;
}
//end Delete Caller

// Update Background Color function
function updateBG($conn, $bg, $temp_num){
  $qry_bg = mysqli_query($conn, "SELECT * FROM `background` WHERE `template_id` = '$temp_num'");
  $row_bg = mysqli_fetch_array($qry_bg);

  $query = mysqli_query($conn, "UPDATE `background` SET `bg_color` = '$bg' WHERE `template_id` = '$temp_num'");
  if ($query == true){

  	logUpdate('UPDATE', 'background', $row_bg['bg_color'], $bg, $conn, $_SESSION['user'], 'COLOR', $temp_num);

	echo '
		<div class="col-lg-12">
		<div class="alert alert-success fade in">
		  <button data-dismiss="alert" class="close close-sm" type="button">
			<i class="icon-remove"></i>
		  </button>
		  <strong>Well done!</strong> You successfully set the background color.
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
// end Update Background Color function

//Background Color caller
if(isset($_POST['submit_bg'])){
  updateBG($connect, $_POST['select_bg'], $_POST['edit']);
}
//end Background Color caller


//Scroller Text
if(isset($_POST['submit_scroller'])){
	$mr_text = mysql_real_escape_string($_POST['mrq_text']);
	$mr_ffam = $_POST['mrq_font_fam'];
	$mr_color = $_POST['mrq_color'];
	$mr_fsize = $_POST['mrq_size'];
	$mr_speed = $_POST['mrq_speed'];

	$get_tempid = $_POST['edit'];

	$qry_allscroll = mysqli_query($connect, "SELECT * FROM  `marquee` WHERE `template_id` = '$get_tempid'");
	$row_qry = mysqli_fetch_array($qry_allscroll);

	$check = mysqli_query($connect, "UPDATE `marquee` SET `marquee_text` = '$mr_text', `font_type` = '$mr_ffam', `font_color` = '$mr_color', `font_size` = '$mr_fsize', `scroll_speed` = '$mr_speed' WHERE `template_id` = '$get_tempid'");

	// $get_allscroll = array('text'=>$mr_text, 'font_family'=>$mr_ffam, 'color'=>$mr_color, 'size'=>$mr_fsize, 'speed'=>$mr_speed);

	if($mr_text != $row_qry['marquee_text']){
		logUpdate('UPDATE', 'scroller', $row_qry['marquee_text'], $mr_text, $connect, $_SESSION['user'], 'TEXT', $_POST['edit']);
	}
	if($mr_ffam != $row_qry['font_type']){
		logUpdate('UPDATE', 'scrollrer', $row_qry['font_type'], $mr_ffam, $connect, $_SESSION['user'], 'FONT TYPE', $_POST['edit']);
	}
	if($mr_color != $row_qry['font_color']){
		logUpdate('UPDATE', 'scroller', $row_qry['font_color'], $mr_color, $connect, $_SESSION['user'], 'FONT COLOR', $_POST['edit']);
	}
	if($mr_fsize != $row_qry['font_size']){
		logUpdate('UPDATE', 'scroller', $row_qry['font_size'], $mr_fsize, $connect, $_SESSION['user'], 'FONT TYPE', $_POST['edit']);
	}
	if($mr_speed != $row_qry['scroll_speed']){
		logUpdate('UPDATE', 'scroller', $row_qry['scroll_speed'], $mr_speed, $connect, $_SESSION['user'], 'SPEED', $_POST['edit']);
	}

	if ($check == true){
		echo '
			<div class="col-lg-12">
			<div class="alert alert-success fade in">
			  <button data-dismiss="alert" class="close close-sm" type="button">
				<i class="icon-remove"></i>
			  </button>
			  <strong>Well done!</strong> You successfully set the settings for the scroller.
			</div>
		  </div>
		  ';
	} else 
		echo '
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
//end Scroller Text


//Action Function
function knowActionHeader($location, $conn, $temp_num){
  $query = mysqli_query($conn, "select * from upload where location = '$location' and `template_id` = '$temp_num'");
  if($query->num_rows > 0){
	while ($row = mysqli_fetch_array($query)) {
	  $prevw = '<font class="text-muted" style="font-weight: 200;">'.$row['name'].'</font>';
	  $btn_class = "btn btn-primary btn-sm";
	  $btn_i = "icon-edit";
	  $btn_act = "Edit";
	  $file = $row['name'];
	  $img_id = $row['id'];
	}
  }
  else {
	$btn_class = "btn btn-success btn-sm";
	$btn_i = "icon-plus";
	$btn_act = "Add";
	$prevw = '<font class="text-muted" style="font-weight: 200; font-style: italic;">Empty</font>';
	$file = '';
	$img_id = '';
  }

  $return = array($btn_class, $btn_i, $btn_act, $prevw, $file, $img_id);

  return $return;
}

function knowActionMain($location, $conn, $temp_num, $type){

  $query = mysqli_query($conn, "select * from upload where location = '$location' and template_id = '$temp_num'");
  if($query->num_rows > 0){
	while ($row = mysqli_fetch_array($query)) {
	  $num = $query->num_rows;
	  $prevw = '<font class="text-muted" style="font-weight: 200;">'.$num.' '.$type.'</font>';
	  $btn_class = "btn btn-primary btn-sm";
	  $btn_i = "icon-edit";
	  $btn_act = "Edit";
	}
  }
  else {
	$btn_class = "btn btn-success btn-sm";
	$btn_i = "icon-plus";
	$btn_act = "Add";
	$prevw = '<font class="text-muted" style="font-weight: 200; font-style: italic;">No '.substr($type, 0, 5).' uploaded.</font>';
  }

  $return = array($btn_class, $btn_i, $btn_act, $prevw);

  return $return;
}

function knowActionScroller($conn, $temp_num){
  $query = mysqli_query($conn, "select `marquee_text` from marquee where `template_id` = '$temp_num'");

  while ($row = mysqli_fetch_array($query)) {
	  if($row['marquee_text'] != ''){
		$prevw = '<font class="text-muted" style="font-weight: 200;">'.substr($row['marquee_text'], 0, 40).'...</font>';
		$btn_class = "btn btn-primary btn-sm";
		$btn_i = "icon-edit";
		$btn_act = "Edit";
	  }
	  else {
		$btn_class = "btn btn-success btn-sm";
		$btn_i = "icon-plus";
		$btn_act = "Add";
		$prevw = '<font class="text-muted" style="font-weight: 200; font-style: italic;">Empty</font>';
	  }
	}

  $return = array($btn_class, $btn_i, $btn_act, $prevw);

  return $return;
}
//end Action Function


//Emergency Function
function updateEmer($title, $color, $msg, $duration, $files, $conn){

	$check_eimg = mysqli_query($conn, "SELECT `image` FROM `emergency` WHERE `id` = 1");
	$row_h = mysqli_fetch_array($check_eimg);

	$target_dir = "upload/";
	$name = $files['name'];
	$tmpname = $files['tmp_name'];
	$string = str_replace(" ", "-", $name);
	$target_file = $target_dir . basename($string);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$file_name = pathinfo($name, PATHINFO_FILENAME);

	if($tmpname != ""){
		if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif")
		{
			$div = '
			<div class="col-lg-12">
			  <div class="alert alert-block alert-danger fade in">
				  <button data-dismiss="alert" class="close close-sm" type="button">
					  <i class="icon-remove"></i>
				  </button>
				  <strong>Oh snap!</strong> Seems like you uploaded an unsupported file type.
			  </div>
			</div>
			';
		}
		else
		{
			if($row_h['image'] != ''){
				$old_name = $row_h['image'];
				unlink('upload/'.$old_name);
				move_uploaded_file($tmpname, $target_file);

				$check = mysqli_query($conn, "UPDATE `emergency` SET `title` = '$title', `title_color` = '$color', `message` = '$msg', `duration` = '$duration', `status` = 1, `image` = '$name' WHERE `id` = 1;");

				  if ($check == true){
					$div = '
						<div class="col-lg-12">
						<div class="alert alert-success fade in">
						  <button data-dismiss="alert" class="close close-sm" type="button">
							<i class="icon-remove"></i>
						  </button>
						  <strong>Well done!</strong> You successfully displayed an emergency message. To end, click <i class="icon-refresh" style="margin-left: 2px; margin-right: 2px;"></i> Refresh Display
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

			} else {
				move_uploaded_file($tmpname, $target_file);

				$check = mysqli_query($conn, "UPDATE `emergency` SET `title` = '$title', `title_color` = '$color', `message` = '$msg', `duration` = '$duration', `status` = 1, `image` = '$name' WHERE `id` = 1;");

				  if ($check == true){
					$div = '
						<div class="col-lg-12">
						<div class="alert alert-success fade in">
						  <button data-dismiss="alert" class="close close-sm" type="button">
							<i class="icon-remove"></i>
						  </button>
						  <strong>Well done!</strong> You successfully displayed an emergency message. To end, click <i class="icon-refresh" style="margin-left: 2px; margin-right: 2px;"></i> Refresh Display
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
	else {
		if($row_h['image'] != ''){
			unlink('upload/'.$row_h['image']);
		}

		$check = mysqli_query($conn, "UPDATE `emergency` SET `title` = '$title', `title_color` = '$color', `message` = '$msg', `duration` = '$duration', `status` = 1, `image` = '' WHERE `id` = 1;");

		  if ($check == true){
			$div = '
				<div class="col-lg-12">
				<div class="alert alert-success fade in">
				  <button data-dismiss="alert" class="close close-sm" type="button">
					<i class="icon-remove"></i>
				  </button>
				  <strong>Well done!</strong> You successfully displayed an emergency message. To end, click <i class="icon-refresh" style="margin-left: 2px; margin-right: 2px;"></i> Refresh Display
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

	return $div;
}
//end Emergency Function


//Emergency Caller
if(isset($_POST['submit_emer'])){
  $disp = updateEmer($_POST['emer_name'], $_POST['emer_titlecolor'], $_POST['emer_msg'], $_POST['emer_secs'], $_FILES['imgemer'], $connect);
  echo $disp;
}
//end Emergency Caller

//Logs Functions
//Log Function for INSERT and DELETE actions
function logInsertDel($action, $section, $value, $conn, $user, $type, $temp_num){
  $user = $_SESSION['user'];
  mysqli_query($conn, "INSERT INTO `logs` (`date_time`, `user_name`, `action`, `section`, `new_value`, `type`, `template_id`) VALUES (NOW(),  '$user', '$action',  '$section', '$value', '$type', '$temp_num')");
}

//Log Function for UPDATE actions
function logUpdate($action, $section, $old_value, $new_value, $conn, $user, $type, $temp_num){
  $user = $_SESSION['user'];
  mysqli_query($conn, "INSERT INTO `logs` (`date_time`, `user_name`, `action`, `section`, `old_value`, `new_value`, `type`, `template_id`) VALUES (NOW(),  '$user', '$action',  '$section', '$old_value', '$new_value', '$type', '$temp_num')");
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

if(isset($_POST['submit_autor'])){
	$new_ar = $_POST['ar_secs'];
	$qry_ar = mysqli_query($connect, "UPDATE `refresh` SET `refresh` = '$new_ar' WHERE `id` = 2");

	if ($qry_ar == true){
		echo '
			<div class="col-lg-12">
			<div class="alert alert-success fade in">
			  <button data-dismiss="alert" class="close close-sm" type="button">
				<i class="icon-remove"></i>
			  </button>
			  <strong>Well done!</strong> You successfully set automatic refresh.
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

function updateShowRange($conn, $id, $from, $to, $stat){
	$qry_rnge = mysqli_query($conn, "UPDATE `upload` SET `show_from` = '$from', `show_to` = '$to', `status` = $stat WHERE `id` = '$id'");
	if($qry_rnge == true){
		$div = '
			<div class="col-lg-12">
			<div class="alert alert-success fade in">
			  <button data-dismiss="alert" class="close close-sm" type="button">
				<i class="icon-remove"></i>
			  </button>
			  <strong>Well done!</strong> You successfully updated ranges.
			</div>
		  </div>
		  ';
	} else {
		$div = '
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

	return $div;
}

function updateSched($conn, $id, $from, $to, $location, $temp_id){
	if(count($id > 0)){
		for($i = 0; $i < count($id); $i++){
			$rvid = $id[$i];
			$qry_curvid = mysqli_query($conn, "SELECT * FROM `upload` WHERE `location` = '$location' AND `template_id` = '$temp_id' AND `id` = '$rvid'");
			$row_cvid = mysqli_fetch_array($qry_curvid);

			if(!empty($from[$i]) || !empty($to[$i])){

				if($row_cvid['show_from'] != date('Y-m-d H:i:s', strtotime($from[$i])) || $row_cvid['show_to'] != date('Y-m-d H:i:s', strtotime($to[$i]))){

					if(date('Y-m-d H:i:s', strtotime($from[$i])) > date('Y-m-d H:i:s') ){
						$disp = updateShowRange($conn, $id[$i], date('Y-m-d H:i:s', strtotime($from[$i])), date('Y-m-d H:i:s', strtotime($to[$i])), 0);
						echo $disp;
					} 

					else if((date('Y-m-d H:i', strtotime($from[$i])) == date('Y-m-d H:i')) || (date('Y-m-d H:i:s', strtotime($from[$i])) < date('Y-m-d H:i:s'))) {
						$disp = updateShowRange($conn, $id[$i], date('Y-m-d H:i:s', strtotime($from[$i])), date('Y-m-d H:i:s', strtotime($to[$i])), 1);
						echo $disp;
					}
				}
			}
		}
	}
}

if(isset($_POST['deac-vid'])){
	$vid_id = $_POST['inac_id'];
	$datenow = date('Y-m-d H:i:s');
	mysqli_query($connect, "UPDATE upload SET status = 0, show_from = NULL, show_to = NULL, date_ended = '$datenow' WHERE id = '$vid_id'");
	echo '
	<div class="col-lg-12">
	  <div class="alert alert-success fade in">
		  <button data-dismiss="alert" class="close close-sm" type="button">
			  <i class="icon-remove"></i>
		  </button>
		  <strong>Well done!</strong> You successfully deactivated a video from the display.
	  </div>
	</div>
	';
}




?>
<?php 

if(!defined('INDEX_VIEW')){
  die("<strong>403:</strong> Direct Access Forbidden!");
}

	$query = mysqli_query($connect, "SELECT `bg_color` FROM `background` where template_id = 6");
	$row = mysqli_fetch_array($query);
	$back_g = $row['bg_color'];
?>
<body bgcolor="<?php echo $back_g; ?>">

<?php

$img_left = "";
$img_middle = "";
$img_right = "";

$query = mysqli_query($connect, "select * from upload where template_id = 6");
while ($row = mysqli_fetch_row($query)){
	if($row[3] == 'header-left'){
		$img_left = '<img src="upload/template_6/images/'.$row[1].'" style="max-width:100%; max-height:100%;">';
	}
	else if($row[3] == 'header-mid'){
		$img_middle = '<img src="upload/template_6/images/'.$row[1].'" style="max-width:100%; max-height:100%;">';
	}
	else if($row[3] == 'header-right'){
		$img_right = '<img src="upload/template_6/images/'.$row[1].'" style="max-width:100%; max-height:100%;">';
	}
}


?>

<div class="header-container">
	<div class="header-left">
		<?php echo $img_left; ?>
	</div>
	<div class="header-middle">
		<?php echo $img_middle; ?>
	</div>
	<div class="header-right">
		<?php echo $img_right; ?>
	</div>
</div>

<div class="main-container">
	<div class="main-first">
		<div class="main-firsttop">
			<?php
				$name = array();
				$query = mysqli_query($connect, "select * from upload where location = 'top-left' and template_id = 6 and status = 1");
				$video_count = 0;
				while($row = mysqli_fetch_array($query)){
					$name[] = array("video" => $video_count,"id" => $row['id'], "name" => $row['name']);
					$video_count++;
				}
				$jsonName = json_encode($name);

				$stat_m = getVolume('top-left', $connect, 6);

				if(!empty($name)){
					echo "
						<video class='videoInsert' id='main_left' width='100%' height='100%' autoplay muted preload>
						<source src='upload/template_6/videos/".$name[0]['name']."'>
						</video>

						<video id='main_left2' width='100%' height='100%' autoplay preload>
						<source src='upload/template_6/videos/".$name[0]['name']."'>
						</video>";
				} else {
					echo "";
				}
			?>
			<script type='text/javascript'>
			<?php
				echo "var list = $jsonName \n";
			?>
				var count = list.length;
				var videoPlayer = document.getElementById("main_left");
				var videoPlayer2 = document.getElementById("main_left2");
				var video_count = 0;

				videoPlayer2.volume = <?php echo $stat_m; ?>

				videoPlayer2.onended = function run(){
					video_count++;
					if (video_count == count) {
						video_count = 0;
					}
					var nextVideo = "upload/template_6/videos/"+list[video_count].name;
					videoPlayer.src = nextVideo;
					videoPlayer2.src = nextVideo;
					videoPlayer.play();
					videoPlayer2.play();
				};
			</script>
		</div>
		<div class="main-firstbottom">
			<div id="wrapper">
				<div id="container">
					<div id="slider">
						<?php
							$query = mysqli_query($connect, "select * from upload where location = 'bottom-left' and template_id = 6 and status = 1");
							while($row = mysqli_fetch_array($query)){
								echo "<img src='upload/template_6/images/".$row['name']."'>";
							}
								
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main-second">
		<div class="main-secondtop">
			<div id="wrapper">
				<div id="container">
					<div id="slider2">
						<?php
							$query = mysqli_query($connect, "select * from upload where location = 'top-right' and template_id = 6 and status = 1");
							while($row = mysqli_fetch_array($query)){
								echo "<img src='upload/template_6/images/".$row['name']."'>";
							}
								
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="main-secondbottom">
			<?php
				$name = array();
				$query = mysqli_query($connect, "select * from upload where location = 'bottom-right' and template_id = 6 and status = 1");
				$video_count = 0;
				while($row = mysqli_fetch_array($query)){
					$name[] = array("video" => $video_count,"id" => $row['id'], "name" => $row['name']);
					$video_count++;
				}
				$jsonName = json_encode($name);

				$stat_m2 = getVolume('bottom-right', $connect, 6);

				if(!empty($name)){
					echo "
					<video class='videoInsert' id='second_bot' width='100%' height='100%' autoplay muted preload>
					<source src='upload/template_6/videos/".$name[0]['name']."'>
					</video>

					<video id='second_bot2' width='100%' height='100%' autoplay preload>
					<source src='upload/template_6/videos/".$name[0]['name']."'>
					</video>";
				} else {
					echo "";
				}
			?>
			<script type='text/javascript'>
			<?php
				echo "var list2 = $jsonName \n";
			?>
				var count2 = list2.length;
				var videoPlayer3 = document.getElementById("second_bot");
				var videoPlayer4 = document.getElementById("second_bot2");
				var video_count2 = 0;

				videoPlayer4.volume = <?php echo $stat_m2; ?>

				videoPlayer4.onended = function run(){
					video_count2++;
					if (video_count2 == count2) {
						video_count2 = 0;
					}
					var nextVideo = "upload/template_6/videos/"+list2[video_count2].name;
					videoPlayer3.src = nextVideo;
					videoPlayer4.src = nextVideo;
					videoPlayer3.play();
					videoPlayer4.play();
				};
			</script>
		</div>
	</div>
</div>

<div class="footer-container">
	<?php

	$query_marquee = mysqli_query($connect, "SELECT * FROM marquee WHERE template_id = 6");
	$row_marquee = mysqli_fetch_array($query_marquee);
	$speed = $row_marquee['scroll_speed'];
	$type = $row_marquee['font_type'];
	$color = $row_marquee['font_color'];
	$size = $row_marquee['font_size'];
	$text = $row_marquee['marquee_text'];

	echo '
		<marquee behavior="scroll" direction="left" scrollamount='.$speed.'><p style="font-family: '."'".$type."'".'; color: '.$color.'; font-size: '.$size.'px; margin-top: 10px;">
		'.$text.'</p></marquee>
	';

	?>
</div>
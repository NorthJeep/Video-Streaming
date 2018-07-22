<?php

if(!defined('INDEX_VIEW')){
  die("<strong>403:</strong> Direct Access Forbidden!");
}

	$query = mysqli_query($connect, "SELECT `bg_color` FROM `background` where template_id = 1");
	$row = mysqli_fetch_array($query);
	$back_g = $row['bg_color'];
?>
<body bgcolor="<?php echo $back_g; ?>">

<?php

$img_left = "";
$img_middle = "";
$img_right = "";

$query = mysqli_query($connect, "select * from upload where template_id = 1");
while ($row = mysqli_fetch_row($query)){
	if($row[3] == 'header-left'){
		$img_left = '<img src="upload/template_1/images/'.$row[1].'" style="max-width:100%; max-height:100%;">';
	}
	else if($row[3] == 'header-mid'){
		$img_middle = '<img src="upload/template_1/images/'.$row[1].'" style="max-width:100%; max-height:100%;">';
	}
	else if($row[3] == 'header-right'){
		$img_right = '<img src="upload/template_1/images/'.$row[1].'" style="max-width:100%; max-height:100%;">';
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
	<div class="main-mainad">
		<?php
			//$id = $_POST['upload'];
			$name = array();
			$query = mysqli_query($connect, "select * from upload where location = 'main-ad' and template_id = 1 and status = 1");
			$video_count = 0;
			while($row = mysqli_fetch_array($query)){
				$name[] = array("video" => $video_count,"id" => $row['id'], "name" => $row['name']);
				$video_count++;
			}
			$jsonName = json_encode($name);

			$stat_m = getVolume('main-ad', $connect, 1);

			if(!empty($name)){
				echo "
					<video class='videoInsert' id='main_ad' width='100%' height='100%' autoplay muted preload>
					<source src='upload/template_1/videos/".$name[0]['name']."'>
					</video>

					<video id='main_ad2' width='100%' height='100%' autoplay preload>
					<source src='upload/template_1/videos/".$name[0]['name']."'>
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
			var videoPlayer = document.getElementById("main_ad");
			var videoPlayer2 = document.getElementById("main_ad2");
			var video_count = 0;

			videoPlayer2.volume = <?php echo $stat_m; ?>

			videoPlayer2.onended = function run(){
				video_count++;
				if (video_count == count) {
					video_count = 0;
				}
				var nextVideo = "upload/template_1/videos/"+list[video_count].name;
				videoPlayer.src = nextVideo;
				videoPlayer2.src = nextVideo;
				videoPlayer.play();
				videoPlayer2.play();
			};
		</script>
	</div>
	<div class="main-second">
		<div class="main-secondtop">
			<?php
				//$id = $_POST['upload'];
				$name = array();
				$query = mysqli_query($connect, "select * from upload where location = 'second-top' and template_id = 1 and status = 1");
				$video_count = 0;
				while($row = mysqli_fetch_array($query)){
					$name[] = array("video" => $video_count,"id" => $row['id'], "name" => $row['name']);
					$video_count++;
				}
				$jsonName = json_encode($name);

				$stat_m2 = getVolume('second-top', $connect, 1);

				if(!empty($name)){
					echo "
					<video class='videoInsert' id='second_top' width='100%' height='100%' autoplay muted preload>
					<source src='upload/template_1/videos/".$name[0]['name']."'>
					</video>

					<video id='second_top2' width='100%' height='100%' autoplay preload>
					<source src='upload/template_1/videos/".$name[0]['name']."'>
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
				var videoPlayer3 = document.getElementById("second_top");
				var videoPlayer4 = document.getElementById("second_top2");
				var video_count2 = 0;

				videoPlayer4.volume = <?php echo $stat_m2; ?>

				videoPlayer4.onended = function run(){
					video_count2++;
					if (video_count2 == count2) {
						video_count2 = 0;
					}
					var nextVideo = "upload/template_1/videos/"+list2[video_count2].name;
					videoPlayer3.src = nextVideo;
					videoPlayer4.src = nextVideo;
					videoPlayer3.play();
					videoPlayer4.play();
				};
			</script>
		</div>
		<div class="main-secondbottom">
			<div id="wrapper">
				<div id="container">
					<div id='slider'>
						<?php
							$query = mysqli_query($connect, "select * from upload where location = 'second-bot' and template_id = 1 and status = 1");
							while($row = mysqli_fetch_array($query)){
								echo "<img src='upload/template_1/images/".$row['name']."'>";
							}
								
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="footer-container">
	<?php

	$query_marquee = mysqli_query($connect, "SELECT * FROM marquee WHERE `template_id` = 1");
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
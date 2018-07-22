<?php 

if(!defined('INDEX_VIEW')){
  die("<strong>403:</strong> Direct Access Forbidden!");
}

	$query = mysqli_query($connect, "SELECT `bg_color` FROM `background` where template_id = 8");
	$row = mysqli_fetch_array($query);
	$back_g = $row['bg_color'];
?>
<body bgcolor="<?php echo $back_g; ?>">

<div class="main-container">
	<div class="main-left">
		<?php
			$name = array();
			$query = mysqli_query($connect, "select * from upload where location = 'main-left' and template_id = 8 and status = 1");
			$video_count = 0;
			while($row = mysqli_fetch_array($query)){
				$name[] = array("video" => $video_count,"id" => $row['id'], "name" => $row['name']);
				$video_count++;
			}
			$jsonName = json_encode($name);

			$stat_m = getVolume('main-left', $connect, 5);

			if(!empty($name)){
				echo "
					<video class='videoInsert' id='main_left' width='100%' height='100%' autoplay muted preload>
					<source src='upload/template_8/videos/".$name[0]['name']."'>
					</video>

					<video id='main_left2' width='100%' height='100%' autoplay preload>
					<source src='upload/template_8/videos/".$name[0]['name']."'>
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
				var nextVideo = "upload/template_8/videos/"+list[video_count].name;
				videoPlayer.src = nextVideo;
				videoPlayer2.src = nextVideo;
				videoPlayer.play();
				videoPlayer2.play();
			};
		</script>
	</div>
	<div class="main-right">
		<div id="wrapper">
			<div id="container">
				<div id='slider'>
					<?php
						$query = mysqli_query($connect, "select * from upload where location = 'main-right' and template_id = 8 and status = 1");
						while($row = mysqli_fetch_array($query)){
							echo "<img src='upload/template_8/images/".$row['name']."'>";
						}
							
					?>
				</div>
			</div>
		</div>
	</div>
</div>
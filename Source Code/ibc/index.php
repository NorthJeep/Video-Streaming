<?php 

include 'connection.php'; 

define('INDEX_VIEW', true);

include 'get_ips.php';

if(authenticateIP($connect) == 'unregistered'){
  header('Location: 401.php');
  exit;
}

$query = "select * from template where status = 1";
$exec = mysqli_query($connect, $query);
$row = mysqli_fetch_array($exec);
$template_num = $row['id'];

$query_ar = mysqli_query($connect, "SELECT * FROM `refresh` WHERE `id` = 2");
$row_ar = mysqli_fetch_array($query_ar);

$get_arfsh = $row_ar['refresh'];
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Template <?php echo $template_num?> - Project Engage Alpha 0.1</title>
	<link rel="shortcut icon" href="img/ibc_logo.ico">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/template<?php echo $template_num?>.css">
	<link rel="stylesheet" type="text/css" href="styles/slider.css">
	<script type="text/javascript" src="styles/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="styles/jquery.cycle.all.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#slider').cycle({
				fx: 'scrollHorz' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			});
		});
		$(document).ready(function() {
			$('#slider2').cycle({
				fx: 'scrollHorz' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
			});
		});
	</script>
	<meta http-equiv="refresh" content="<?php echo $get_arfsh; ?>">
</head>

<?php
	function getVolume($locate, $conn, $temp_num){
		$m_stat = '';
		$query_m = mysqli_query($conn, "select * from mute where location = '$locate' and template_id = '$temp_num'");
	      if ($query_m->num_rows > 0){
	        while($row = mysqli_fetch_array($query_m)){
	          $vol = $row['volume'];
	        }
	      }
	      return $vol;
		}
?>

<?php
	if($template_num == 1){
		include 'temp1.php';
	}
	else if($template_num == 2){
		include 'temp2.php';
	}
	else if($template_num == 3){
		include 'temp3.php';
	}
	else if($template_num == 4){
		include 'temp4.php';
	}
	else if($template_num == 5){
		include 'temp5.php';
	}
	else if($template_num == 6){
		include 'temp6.php';
	}
	else if($template_num == 7){
		include 'temp7.php';
	}
	else if($template_num == 8){
		include 'temp8.php';
	}
	else if($template_num == 9){
		include 'temp9.php';
	}
?>


<?php
$query_emer = mysqli_query($connect, "SELECT * FROM emergency LIMIT 1");
$row_emer = mysqli_fetch_array($query_emer);
if($row_emer['status'] == 1){
	echo '
		<div class="emergency" id="emer_meg">
			<table style="table-layout: fixed;">
				<tr><td colspan="2">
			<h1 style="color: '.$row_emer['title_color'].';">'.$row_emer['title'].'</h1>
			</td></tr>
				<tr>';
	if($row_emer['image'] == null){
		
		echo '<td style="word-wrap:break-word">
			<center><p style="color: #FFFFFF;">'.$row_emer['message'].'</p></center>
		</td>';
	}
	

	else if($row_emer['image'] != null){
		echo '<td style="word-wrap:break-word; width: 70%;">
			<center><p style="color: #FFFFFF; font-size: 60px;">'.$row_emer['message'].'</p></center>
		</td>
		<td><center><img style="display:block; width:100%; height:auto;" src="upload/'.$row_emer['image'].'"></center></td>';
	}

	echo '
	</tr>
	</table>
	</div>
	<audio id="audio" src="styles/Announcement-sound-effect.mp3" autoplay>

	<script>
   	var audio = document.getElementsByTagName("audio")[0];

	jQuery("#emer_meg").delay('.$row_emer['duration'].').fadeOut("slow", function(){
		audio.pause();
	});

	</script>
	';
	mysqli_query($connect, "UPDATE `emergency` SET `status` = 0 WHERE `id` = 1;");
} else echo '';

?>

<script type="text/javascript">
	$(document).ready(function(){
	    setInterval(function(){
	        $.ajax({
	            url: 'refresh2.php',
	            success: function(data) {
	                if (data == '1'){
	                	$.ajax({
				            url: "refresh.php",
				            type: "POST",
				            data: {'rf': '0'}
				        });
	                	location.reload();
	                }
	            }
	        });
	    }, 1000);
	});

</script>

</body>
</html>
<?php 

if(!defined('INDEX_VIEW')){
  die("<strong>403:</strong> Direct Access Forbidden!");
}

	$query = mysqli_query($connect, "SELECT `bg_color` FROM `background` where template_id = 9");
	$row = mysqli_fetch_array($query);
	$back_g = $row['bg_color'];
?>
<body bgcolor="<?php echo $back_g; ?>">

<div class="main-container">
	<div class="main-left">
		<div id="wrapper">
			<div id="container">
				<div id='slider'>
					<?php
						$query = mysqli_query($connect, "select * from upload where location = 'main-left' and template_id = 9 and status = 1");
						while($row = mysqli_fetch_array($query)){
							echo "<img src='upload/template_9/images/".$row['name']."'>";
						}
							
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="main-right">
		<div id="wrapper">
			<div id="container">
				<div id='slider2'>
					<?php
						$query = mysqli_query($connect, "select * from upload where location = 'main-right' and template_id = 9 and status = 1");
						while($row = mysqli_fetch_array($query)){
							echo "<img src='upload/template_9/images/".$row['name']."'>";
						}
							
					?>
				</div>
			</div>
		</div>
	</div>
</div>
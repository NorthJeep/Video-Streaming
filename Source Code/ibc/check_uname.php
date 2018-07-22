<?php

include 'connection.php';

if(isset($_POST['uname'])){
	$s_uname = $_POST['uname'];
	$qry_uname = mysqli_query($connect, "SELECT `username` FROM `login` WHERE `username` = '$s_uname'");
	if($qry_uname->num_rows > 0){
		echo '1';
	} else {
		echo '0';
	}
}

?>
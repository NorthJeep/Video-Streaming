<?php

include 'connection.php';

if(isset($_POST['rf'])){
	$ref = $_POST['rf'];
	mysqli_query($connect, "UPDATE refresh SET refresh = '$ref' WHERE id = 1");
}

?>
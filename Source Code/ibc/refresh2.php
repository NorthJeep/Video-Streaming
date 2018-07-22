<?php

include 'connection.php';

$datetime_now = date('Y-m-d H:i:s');

$qry_cv = mysqli_query($connect, "SELECT * FROM `upload`");
if ($qry_cv->num_rows > 0){
	while($row_cv = mysqli_fetch_array($qry_cv)){
		if($row_cv['show_to'] <= $datetime_now && $row_cv['show_to'] != null && $row_cv['status'] == 1){
			$vid_id = $row_cv['id'];
			mysqli_query($connect, "UPDATE upload SET status = 0, show_from = NULL, show_to = NULL, date_ended = '$datetime_now' WHERE id = '$vid_id'");
			mysqli_query($connect, "UPDATE refresh SET refresh = '1' WHERE id = 1");
		}

		if($row_cv['show_from'] <= $datetime_now && $row_cv['show_from'] != null && $row_cv['status'] == 0){
			$vid_id = $row_cv['id'];
			mysqli_query($connect, "UPDATE upload SET status = 1 WHERE id = '$vid_id'");
			mysqli_query($connect, "UPDATE refresh SET refresh = '1' WHERE id = 1");
		}
	}
}

$query_r = mysqli_query($connect, "SELECT * FROM `refresh`");
$row_r = mysqli_fetch_array($query_r);

$get_rfsh = $row_r['refresh'];

echo $get_rfsh;


?>
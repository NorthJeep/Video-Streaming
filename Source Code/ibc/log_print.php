<!DOCTYPE html>
<html>
<head>
	<title>Print Logs</title>
	<style type="text/css">
		body{
    		font-family: arial, sans-serif;
		}

		h2{
			font-size: 25px;
			margin: 5px;
		}

		p{
			font-size: 18px;
			margin: 3px;
		}

		table {
		    border-collapse: collapse;
		    width: 100%;
		    margin: 5px;
		}

		td{
		    border: 1px solid #dddddd;
		    padding: 9px;
		    text-align: left;
		}

		th {
		    border: 1px solid #dddddd;
		    padding: 8px;
		    text-align: center;
		    font-style: bold;
		}
	</style>
</head>
<body>

<center>

<?php

include 'connection.php';

if(isset($_POST['date_from']) && isset($_POST['date_to']) && isset($_POST['type']) && isset($_POST['log_type'])){
  
  echo '	
  	<img src="img/NEW-IBC-LOGO.png" style="height: 85px;">
	<h2>Logs for '.$_POST['type'].' Action</h2>';

  if($_POST['date_from'] == '' || $_POST['date_to'] == ''){
  	echo 'All logs for the log type: '.$_POST['log_type'].'</p><br/>';
  } else if($_POST['date_from'] == $_POST['date_to']){
  	echo 'All logs for '.date('F d, Y', strtotime($_POST['date_from'])).' for the log type: '.$_POST['log_type'].'</p><br/>';
  } else {
  	echo '<p>All logs from '.date('F d, Y', strtotime($_POST['date_from'])).' to '.date('F d, Y', strtotime($_POST['date_to'])).' for the log type: '.$_POST['log_type'].'</p><br/>';
  }

  $get_dfrom = date('Y-m-d', strtotime($_POST['date_from']));
  $get_dto = date('Y-m-d', strtotime($_POST['date_to']));

  $type = $_POST['type'];
  $log_type = $_POST['log_type'];

  echo '<table style=>
			<tr>
	            <th>Date</th>
	            <th>Time</th>
	            <th>Username</th>
	            <th>Template Number</th>
	            <th>Section</th>';
	            
  if($type == 'UPDATE'){
  	echo '<th>Old Value</th>
  		  <th>New Value</th>';
  } else {
  	echo '<th>File Name</th>';
  }

echo '<th>Type</th>
	</tr>';
if($_POST['date_from'] == '' || $_POST['date_to'] == ''){
	$qry_logs = mysqli_query($connect, "SELECT * FROM `logs` WHERE `action` = '$type'");
} else {
	$qry_logs = mysqli_query($connect, "SELECT * FROM `logs` WHERE `action` = '$type' AND (DATE(`date_time`) >= '$get_dfrom' AND DATE(`date_time`) <= '$get_dto')");
}
  if($qry_logs->num_rows > 0){
    while ($row = mysqli_fetch_array($qry_logs)) {
      if($row['action'] == 'INSERT' || $row['action'] == 'DELETE'){
      	if($row['type'] == $log_type){
	        echo '
		        <tr>
		          <td>'.date('l, F d, Y', strtotime($row['date_time'])).'</td>
		          <td>'.date('g:i:s a', strtotime($row['date_time'])).'</td>
		          <td>'.$row['user_name'].'</td>
		          <td>Template #'.$row['template_id'].'</td>
		          <td>'.$row['section'].'</td>
		          <td>'.$row['new_value'].'</td>
		          <td>'.$row['type'].'</td>
		        </tr>
	        ';
      	} else if($log_type == 'ALL'){
      		echo '
		        <tr>
		          <td>'.date('l, F d, Y', strtotime($row['date_time'])).'</td>
		          <td>'.date('g:i:s a', strtotime($row['date_time'])).'</td>
		          <td>'.$row['user_name'].'</td>
		          <td>Template #'.$row['template_id'].'</td>
		          <td>'.$row['section'].'</td>
		          <td>'.$row['new_value'].'</td>
		          <td>'.$row['type'].'</td>
		        </tr>
	        ';
      	}
      } else if($row['action'] == 'UPDATE'){
      	if($row['type'] == $log_type){
	        echo '
		        <tr>
		          <td>'.date('l, F d, Y', strtotime($row['date_time'])).'</td>
		          <td>'.date('g:i:s a', strtotime($row['date_time'])).'</td>
		          <td>'.$row['user_name'].'</td>
		          <td>Template #'.$row['template_id'].'</td>
		          <td>'.$row['section'].'</td>
		          <td>'.$row['old_value'].'</td>
		          <td>'.$row['new_value'].'</td>
		          <td>'.$row['type'].'</td>
		        </tr>
	        ';
      	} else if($log_type == 'ALL'){
      		echo '
		        <tr>
		          <td>'.date('l, F d, Y', strtotime($row['date_time'])).'</td>
		          <td>'.date('g:i:s a', strtotime($row['date_time'])).'</td>
		          <td>'.$row['user_name'].'</td>
		          <td>Template #'.$row['template_id'].'</td>
		          <td>'.$row['section'].'</td>
		          <td>'.$row['old_value'].'</td>
		          <td>'.$row['new_value'].'</td>
		          <td>'.$row['type'].'</td>
		        </tr>
	        ';
      	}
      }
    } echo '<tr><td colspan="100%" style="text-align: center;"><em>--- Nothing follows. ---</em></td></tr>';
    } else echo '<tr><td colspan="100%" style="text-align: center;">No logs found</td></tr>';

   echo '</table>';

}
?>
</center>

</body>
</html>
<?php

include 'connection.php';

if(isset($_POST['date_from']) && isset($_POST['date_to']) && isset($_POST['type']) && isset($_POST['log_type'])){

  $get_dfrom = date('Y-m-d', strtotime($_POST['date_from']));
  $get_dto = date('Y-m-d', strtotime($_POST['date_to']));

  $type = $_POST['type'];
  $log_type = $_POST['log_type'];

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

  }

?>
<?php

  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "video";
  $connect = mysqli_connect($dbhost,$dbuser,$dbpass, $dbname) or die('Cannot connect to the server.');

  date_default_timezone_set('Singapore');
  
?>
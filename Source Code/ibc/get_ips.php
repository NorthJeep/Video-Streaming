<?php

function authenticateIP($conn){

	$ip = $_SERVER['REMOTE_ADDR'];
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        $ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
    }
	
	$qry_ip = mysqli_query($conn, "SELECT `id`, `ip_address`, `ip_name`, `date_added`, `last_updated` FROM `devices`");
	
	if($qry_ip->num_rows > 0){
		while($row = mysqli_fetch_array($qry_ip)){
			$decrypt = password_verify($ip, $row['ip_address']); // decrypting
			if($decrypt == 1 || $ip == '::1' || $ip == '127.0.0.1'){
				return 'registered';
				break;
			} else if ($decrypt == 0 || $decrypt == null){
				return 'unregistered';
			}
		}
	} else {
		return 'unregistered';
	}
}

?>
<?php
//execute from command line, with email to send an errors.
//for ex php ~/site_checker.php some@email.ru
$handle = @fopen("sites.txt", "r");
$wait = 1; //wait tome out in seconds
if ($handle) {
	while (($string = fgets($handle)) !== false) {
		$data = explode(' ',$string);
		$host = array_shift($data);
		$email = array_pop($data);
		$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i"; //email pattern
		if(!preg_match($pattern, $email)){
			die('Email is invalid');
		}
		$ports = $data;
		$ch = curl_init($host);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_TIMEOUT,10);
		@curl_setopt($ch, CURLOPT_HEADER  , true);  // we want headers
		@curl_setopt($ch, CURLOPT_NOBODY  , true);  // we don't need body
		$output = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpcode != 200 && $httpcode != 301) {
			$to = $email;
			$subject = "$host is unavailable by GET";
			$text = $host." is unavailable by GET";
			if(!mail($to, $subject, $text)){
				echo "Mail sending error";
			}
		}

		foreach ($ports as $key => $port) {
			$host = trim($host);
			$fp = @fsockopen($host, $port, $errCode, $errStr, $wait);
//			echo "Ping $host:$port ($key) ==> ";
			if ($fp) {
				fclose($fp);
//				echo 'SUCCESS';
			} else {
				//echo "ERROR: $errCode - $errStr\n\r";
				$to = $email;
				$subject = "$host is unavailable on port $port";
				$text = $host." is unavailable on port $port \n\r ERROR: $errCode - $errStr";
				if(!mail($to, $subject, $text)){
					echo "Mail sending error";
				}
			}
//			echo "\n\r";
		}
	}
	if (!feof($handle)) {
		echo "Error: fgets() is crashed\n";
	}
	fclose($handle);
}
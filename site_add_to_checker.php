<?php
//execute from command line, with host and ports to check
//for ex php ~/site_add_to_checker.php somedomain.ru 80 443 21 22
if($argv){// from command line
	array_shift($argv);//removing script path
	$email = array_pop($argv);
	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i"; //email pattern
	if(!preg_match($pattern, $email)){
		die('Email is invalid');
	}
	$string = implode(' ', $argv);
	if(file_put_contents('sites.txt', "\n".$string, FILE_APPEND)){
		echo 'Site added';
	} else{
		echo 'Something wrong, site is not added';
	}
}
<?php
//execute from command line, with host and ports to check
//for ex php ~/site_add_to_checker.php somedomain.ru 80 443 21 22
if($argv){// from command line
	array_shift($argv);
	$string = implode(' ', $argv);
	if(file_put_contents('sites.txt', "\n".$string, FILE_APPEND)){
		echo 'Site added';
	} else{
		echo 'Something wrong, site is not added';
	}
}
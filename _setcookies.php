<?php

if(isset($_GET["zip"])){
	setcookie('zip', $_GET["zip"], time()+(60*60*24*365));
}

if(isset($_GET["search_string"])){
	setcookie('search_string', $_GET["search_string"], time()+(60*60*24*365));
}

/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
header("Location: http://$host$uri/$extra");

?>
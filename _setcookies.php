<?php

if(isset($_GET["zip"])){
	setcookie('zip', $_GET["zip"], time()+(60*60*24*365));
}

if(isset($_GET["search_string"])){
	setcookie('search_string', $_GET["search_string"], time()+(60*60*24*365));
}

if(isset($_GET["search_autofocus"])){
	setcookie('search_autofocus', $_GET["search_autofocus"], time()+(60*60*24*365));
} else {
	setcookie('search_autofocus', "off", time()+(60*60*24*365));
}

if(isset($_GET["show_news"])){
	setcookie('show_news', $_GET["show_news"], time()+(60*60*24*365));
} else {
	setcookie('show_news', "off", time()+(60*60*24*365));
}

if(isset($_GET["show_news"])){
	setcookie('show_news', $_GET["show_news"], time()+(60*60*24*365));
} else {
	setcookie('show_news', "off", time()+(60*60*24*365));
}

if(isset($_GET["show_web_fonts"])){
	setcookie('show_web_fonts', $_GET["show_web_fonts"], time()+(60*60*24*365));
} else {
	setcookie('show_web_fonts', "off", time()+(60*60*24*365));
}


/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
header("Location: http://$host$uri/$extra");

?>
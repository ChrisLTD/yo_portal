<?php

require('_config.php');

// Load settings from cookies
if(isset($_COOKIE['zip'])){
	$portal_zip_code = $_COOKIE['zip'];
}

if(isset($_COOKIE['search_string'])){
	$portal_search_string = $_COOKIE['search_string'];
}
  
?><!doctype html>  
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <title><?=strip_tags($portal_site_title);?></title>
 
  <meta name="viewport" content="width=device-width">
  
  <link rel="icon" href="favicon.ico" type="image/ico">
  
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

	<script type="text/javascript" src="//use.typekit.net/doh5xwg.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	<link rel="stylesheet" href="css/normalize.css">  
  <link rel="stylesheet" href="css/styles.css">

</head>

<body>

  <div id="wrapper">
    <header>
    	<div class="container">
    		
    		<h1 class="logo"><?=$portal_site_title;?></h1>
    		
				<form action="<?=$portal_search_string;?>" method="GET" class="search">
					<input type="search" name="query" autofocus>
					<input type="submit" value="Search">
				</form>

    	</div><!--/.container-->
    </header>

    <div role="main" class="clearfix">
    	<div class="container">
					
				<div class="column">
					<h2>Links</h2>
						<ul class="links">
							<li><a href="http://www.msnbc.com"><strong>MSNBC</strong> &ndash; News</a></li>
							<li><a href="http://www.espn.com"><strong>ESPN</strong> &ndash; Sports</a></li>
							<li><a href="http://news.ycombinator.com/"><strong>Hacker News</strong> &ndash; Nerd news</a></li>
							<li><a href="http://www.dodtracker.com"><strong>DOD Tracker</strong> &ndash; Deals</a></li>
							<li><a href="http://www.netflix.com"><strong>Netflix</strong> &ndash; Movies at home</a></li>
							<li><a href="http://instantwatcher.com"><strong>Instant Watcher</strong> &ndash; New on Netflix</a></li>
						</ul>
						
						
					<h2>Apps</h2>
						<ul class="links">
							<li><a href="http://www.gmail.com"><strong>GMail</strong> &ndash; E-mail</a></li>
							<li><a href="http://my.yahoo.com"><strong>My Yahoo</strong> &ndash; Portal</a></a></li>
							<li><a href="http://www.google.com/calendar"><strong>Google Calendar</strong> &ndash; Plan ahead</a></li>
							<li><a href="http://www.google.com/maps"><strong>Google Maps</strong> &ndash; Find stuff</a></li>
							<li><a href="http://drive.google.com/"><strong>Google Drive</strong> &ndash; Online Office</a></li>
							<li><a href="http://www.facebook.com"><strong>Facebook</strong> &ndash; Social network</a></li>
							<li><a href="http://www.twitter.com"><strong>Twitter</strong> &ndash; Social IMing</a></li>
							<li><a href="http://www.flickr.com"><strong>Flickr</strong> &ndash; Photos</a></li>
							<li><a href="http://www.picmonkey.com/"><strong>Picmonkey</strong> &ndash; Image Editor</a></li>
						</ul>
				</div><!--/.column-->


    	</div><!--/.container-->
    </div><!-- /#main -->

    <footer>
    	<div class="container">

				<div class="copyright">&copy;<?=date("Y");?> <a href="http://www.yoeyo.com">Yoeyo, Ltd.</a></div>

				<div class="settings">
					<a href="#" data-open-toggle data-target=".settings form" data-toggle-type="fade" title="Settings"><img src="img/gear.png" width="32" height="32"> Settings</a>
					<form action="_setcookies.php" method="GET" class="arrow_box">
						<label>ZIP Code</label>
						<input type="number" name="zip" size="40" value="<?=$portal_zip_code;?>" pattern="[0-9]*" maxlength="5" min="0">
						<div class="hr"></div>
						<label>Search String</label>
						<input type="url" name="search_string" size="40" value="<?=$portal_search_string;?>" pattern="https?://.+">
						<div class="hr"></div>
						<input type="submit" value="Save" class="floatright"><small><a href="_destroycookies.php">Reset settings</a></small>
					</form>
				</div><!--/.settings-->
				
    	</div><!--/.container-->
    </footer>
 
  </div> <!-- /#wrapper -->

	
	<script>
	if ('__proto__' in {}) {
    // IS NOT IE
		document.write('<script src="js/zepto.min.js"><\/script>');
		document.write('<script src="js/zepto.fx_methods.js"><\/script>');
  } else {
    // IS IE
		document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"><\/script>');
  }
  </script>
	
  <script>
  $(function(){
  
  // Call in the feeds
	$.ajax({
		url: "_fetchfeeds.php?zip=<?=urlencode($portal_zip_code);?>",
		cache: false,
		success: function(html){
			$('[role="main"] > .container').prepend( html );
			$('[role="main"]').fadeIn();
		}
	});

	
	// Open and close toggle
  $("[data-open-toggle]").click(function(event) {
		event.preventDefault();
		toggleTarget = $(this).data('target');
		toggleType = $(this).data('toggle-type');
		$(this).toggleClass("toggled");
		switch(toggleType){
			case "slide":
				$(toggleTarget).slideToggle('fast');
				break;
			case "fade":
				$(toggleTarget).fadeToggle('fast');
				break;
			default:
				$(toggleTarget).toggle();
		}
  });
	
  
	});
  </script>

</body>
</html>
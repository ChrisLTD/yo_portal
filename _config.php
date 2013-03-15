<?php

error_reporting(0); // 0 = off, -1 = on

$portal_site_title = "My P<b>o</b>rtal";

$portal_cache_location = '/Users/chrisltd/Dropbox/work/MAMP/htdocs/portal/cache'; // Absolute url to writable cache directory on your server

$portal_cache_duration = 1800;

$portal_zip_code = '27713';

$portal_search_string = 'http://www.google.com/search?q=';

$portal_search_autofocus = "off"; // "on" or "off"

$portal_show_news = "on"; // "on" or "off"

$portal_show_web_fonts = "on"; // "on" or "off"

$portal_tracking_code = "<script type='text/javascript'>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'XXXXXXXX']);
  _gaq.push(['_setDomainName', 'XXXXXXXXXX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>";

$portal_web_font_code ="<link href='http://fonts.googleapis.com/css?family=Galindo' rel='stylesheet' type='text/css'>";

?>
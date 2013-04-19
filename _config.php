<?php

error_reporting(0); // 0 = off, -1 = on
// If you turn error reporting on, you will get an include error if you don't have a _local_config.php file, you can supress this with a blank file

$portal_assets_version = "5"; // used to cache bust css and js files

$portal_site_title = "My P<b>o</b>rtal";

$portal_cache_location = '/your/absolute/server/path/here'; // Absolute url to writable cache directory on your server

$portal_cache_duration = 1800;

$portal_forecastio_api_key = '<your_api_key>'; // Forecast.io weather API key from https://developer.forecast.io

$portal_latitude = '35.9940';

$portal_longitude = '-78.8986';

$portal_geonames_username = '<yourusername>'; // Username for Geonames account http://www.geonames.org

$portal_search_string = 'http://www.google.com/search';

$portal_stock_symbols = array(
  "^GSPC" => "S&P 500",
  "AAPL" => "Apple",
  "GOOG" => "Google"
);

$portal_links = array(
  "MSNBC" => array(
    "url" => "http://www.msnbc.com",
    "description" => "News"),
  "ESPN" => array(
    "url" => "http://www.espn.com",
    "description" => "Sports"),
  "Reddit" => array(
    "url" => "http://reddit.com",
    "description" => "Waste your day"),
  "Hacker News" => array(
    "url" => "http://news.ycombinator.com",
    "description" => "Nerd news"),
  "Kottke" => array(
    "url" => "http://kottke.org",
    "description" => "Interesting links"),
  "DOD Tracker" => array(
    "url" => "http://www.dodtracker.com",
    "description" => "Daily deals"),
  "Devour" => array(
    "url" => "http://devour.com",
    "description" => "Awesome videos"),
  "Instant Watcher" => array(
    "url" => "http://instantwatcher.com",
    "description" => "New on Netflix")
);

$portal_apps = array(
  "GMail" =>  array(
    "url" => "http://www.gmail.com",
    "description" => "E-mail"),
  "My Yahoo" =>  array(
    "url" => "http://my.yahoo.com",
    "description" => "Portal"),
  "Google Calendar "=>  array(
    "url" => "http://www.google.com/calendar",
    "description" => "Plan ahead"),
  "Google Maps" =>  array(
    "url" => "http://www.google.com/maps",
    "description" => "Find stuff"),
  "Google Drive" => array(
    "url" => "http://drive.google.com/",
    "description" => "Online Office&trade;"),
  "Facebook" =>  array(
    "url" => "http://www.facebook.com",
    "description" => "Social network"),
  "Twitter" =>  array(
    "url" => "http://www.twitter.com",
    "description" => "Social blurbs"),
  "Flickr" => array(
    "url" => "http://www.flickr.com",
    "description" => "Photos"),
  "YouTube" => array(
    "url" => "http://www.youtube.com",
    "description" => "Videos"),
  "Picmonkey" => array(
    "url" => "http://www.picmonkey.com/",
    "description" => "Image Editor")
);

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

include "_config_local.php"; // Local environment overrides

?>
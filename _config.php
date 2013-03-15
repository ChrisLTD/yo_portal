<?php
// Config

// Error reporting 0 = off, -1 = on
error_reporting(0);
// error_reporting(-1);

$portal_site_title = "yo<b>e</b>yo <b>portal</b>";

$portal_cache_location = '/Users/chrisltd/Dropbox/work/MAMP/htdocs/portal/cache';
// $portal_cache_location = '/home/yoeyo/webapps/htdocs/portal/cache';

$portal_cache_duration = 1800;

$portal_zip_code = '27713';

$portal_search_string = 'http://www.google.com/search?q=';

$portal_search_autofocus = "off"; // "on" or "off"

$portal_show_news = "on"; // "on" or "off"

$portal_show_web_fonts = "on"; // "on" or "off"

$portal_tracking_code = "<script type='text/javascript'>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9779773-3']);
  _gaq.push(['_setDomainName', 'yoeyo.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>";

$portal_web_font_code ='<script type="text/javascript" src="//use.typekit.net/doh5xwg.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>';

?>
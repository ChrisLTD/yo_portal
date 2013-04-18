<?php
// Yo Portal 
// By Chris Johnson http://chrisltd.com | https://github.com/ChrisLTD/yo_portal

require('_config.php');

// Load settings from cookies

if(isset($_COOKIE['search_string'])){
  $portal_search_string = $_COOKIE['search_string'];
}

if(isset($_COOKIE['search_autofocus'])){
  $portal_search_autofocus = $_COOKIE['search_autofocus'];
}

if(isset($_COOKIE['show_news'])){
  $portal_show_news = $_COOKIE['show_news'];
}

if(isset($_COOKIE['show_web_fonts'])){
  $portal_show_web_fonts = $_COOKIE['show_web_fonts'];
}

if(isset($_COOKIE['latitude'])){
  $portal_latitude = $_COOKIE['latitude'];
}

if(isset($_COOKIE['longitude'])){
  $portal_longitude = $_COOKIE['longitude'];
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
  
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
  <?php 
  if($portal_show_web_fonts != "off"){
    echo $portal_web_font_code;
  }
  ?>
  

<link rel="stylesheet" href="css/normalize.css?v=<?php echo $portal_assets_version; ?>">  
<link rel="stylesheet" href="css/styles.css?v=<?php echo $portal_assets_version; ?>">

  <?=$portal_tracking_code;?>

</head>

<body class="<?php if($portal_show_news!="off"){ echo "news_on"; } ;?>">

  <div id="wrapper">
    <header>
      <div class="container">
        
        <h1 class="logo"><?=$portal_site_title;?></h1>
        
        <form action="<?=$portal_search_string;?>" method="GET" class="search">
          <input type="text" name="q" <?php if($portal_search_autofocus=="on"){ echo "autofocus"; } ;?>>
          <input type="submit" value="Search">
        </form>

      </div><!--/.container-->
    </header>

    <div role="main" class="clearfix">
      <div class="container">
          
        <div class="column">

          <?php if(isset($portal_links)): ?>
          <h2>Links</h2>
            <ul class="links">
              <?php foreach ( $portal_links as $key => $value ): ?>
                <li><a href="<?=$value["url"]; ?>"><b><?=$key; ?></b> – <?=$value["description"]; ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
            
          <?php if(isset($portal_apps)): ?>
          <h2>Apps</h2>
            <ul class="links">
              <?php foreach ( $portal_apps as $key => $value ): ?>
                <li><a href="<?=$value["url"]; ?>"><b><?=$key; ?></b> – <?=$value["description"]; ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>


        </div><!--/.column-->


      </div><!--/.container-->
    </div><!-- /#main -->

    <footer>
      <div class="container">

        <div class="copyright">By <a href="http://chrisltd.com">Chris Johnson</a></div>

        <div class="settings">
          <a href="#" data-open-toggle data-target=".settings form" data-toggle-type="fade" title="Settings"><img src="img/gear.png" width="32" height="32"> Settings</a>
          <form action="_setcookies.php" method="GET" class="arrow_box">
          	
          	<label>Weather</label>
          	
          	<a href="#" id="get_current_location"><img src="img/compass.png" width="16" height="16"> Get Current Location</a>
          	
          	<br><br>
          	         	
            <label title="Put in your latitude for personalized weather" for="settings_latitude">Latitude</label>
            <input type="text" name="latitude" id="settings_latitude" size="40" value="<?=$portal_latitude;?>">
            
            <br><br>
            
            <label title="Put in your longitude for personalized weather" for="settings_longitude">Longitude</label>
            <input type="text" name="longitude" id="settings_longitude" size="40" value="<?=$portal_longitude;?>">
            
          	<div class="hr"></div>
          	
            <label title="Use this to change the search engine" for="settings_search_string">Search String</label>
            <input type="url" name="search_string" id="settings_search_string" size="40" value="<?=$portal_search_string;?>" pattern="https?://.+">
            
            <div class="hr"></div>
            
            <label title="Should the cursor enter the search box when the page loads?" for="settings_search_autofocus">Search Autofocus</label>
            <input type="checkbox" name="search_autofocus" id="settings_search_autofocus" value="on" <?php if($portal_search_autofocus=="on"){ echo "checked"; } ;?>>
            
            <div class="hr"></div>
            
            <label title="Turn off to only show search box" for="settings_show_news">Load News & Links</label>
            <input type="checkbox" name="show_news" id="settings_show_news" value="on" <?php if($portal_show_news=="on"){ echo "checked"; } ;?>>
            
            <div class="hr"></div>
            
            <label title="Turn off to speed up page load by disabling web fonts" for="settings_show_web_fonts">Load Web Fonts</label>
            <input type="checkbox" name="show_web_fonts" id="settings_show_web_fonts" value="on" <?php if($portal_show_web_fonts=="on"){ echo "checked"; } ;?>>
            
            <div class="hr"></div>
            
            <input type="submit" value="Save" class="floatright"><small><a href="_destroycookies.php">Reset settings</a></small>
            <a href="#" class="close" data-open-toggle data-target=".settings form" data-toggle-type="fade" title="Close">&times;</a>
          </form>
        </div><!--/.settings-->
        
      </div><!--/.container-->
    </footer>
 
  </div> <!-- /#wrapper -->

  
  <script>
  if ('__proto__' in {}) {
    // IS NOT IE
    document.write('<script src="js/zepto.min.js?v=<?php echo $portal_assets_version; ?>"><\/script>');
    document.write('<script src="js/zepto.fx_methods.js?v=<?php echo $portal_assets_version; ?>"><\/script>');
  } else {
    // IS IE
    document.write('<script src="js/jquery.min.js?v=<?php echo $portal_assets_version; ?>"><\/script>');
  }
  </script>
  
  <?php if($portal_show_news != "off"): ?>
  <script src="forecastio/skycons.js?v=<?php echo $portal_assets_version; ?>"></script>
  <script src="js/fetchfeeds.js?v=<?php echo $portal_assets_version; ?>"></script>
  <?php endif; ?>
  
	<script src="js/script.js?v=<?php echo $portal_assets_version; ?>"></script>
  
</body>
</html>
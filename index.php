<?php
// Yo Portal 
// By Chris Johnson http://chrisltd.com | https://github.com/ChrisLTD/yo_portal

require('_config.php');

// Load settings from cookies
if(isset($_COOKIE['zip'])){
  $portal_zip_code = $_COOKIE['zip'];
}

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
  

<link rel="stylesheet" href="css/normalize.css">  
<link rel="stylesheet" href="css/styles.css">

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
            <label title="Put in your ZIP code to get personalized weather">ZIP Code</label>
            <input type="text" name="zip" size="40" value="<?=$portal_zip_code;?>">
            <div class="hr"></div>
            <label title="Use this to change the search engine">Search String</label>
            <input type="url" name="search_string" size="40" value="<?=$portal_search_string;?>" pattern="https?://.+">
            <div class="hr"></div>
            <label title="Should the cursor enter the search box when the page loads?">Search Autofocus</label>
            <input type="checkbox" name="search_autofocus" value="on" <?php if($portal_search_autofocus=="on"){ echo "checked"; } ;?>>
            <div class="hr"></div>
            <label title="Turn off to only show search box">Load News & Links</label>
            <input type="checkbox" name="show_news" value="on" <?php if($portal_show_news=="on"){ echo "checked"; } ;?>>
            <div class="hr"></div>
            <label title="Turn off to speed up page load by disabling web fonts">Load Web Fonts</label>
            <input type="checkbox" name="show_web_fonts" value="on" <?php if($portal_show_web_fonts=="on"){ echo "checked"; } ;?>>
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
    document.write('<script src="js/zepto.min.js"><\/script>');
    document.write('<script src="js/zepto.fx_methods.js"><\/script>');
  } else {
    // IS IE
    document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"><\/script>');
  }
  </script>
  
  <script>
  $(function(){
  
  <?php 
  if($portal_show_news != "off"):
  ?>
  
  // Call in the feeds
  $.ajax({
    url: "_fetchfeeds.php?zip=<?=urlencode($portal_zip_code);?>",
    cache: false,
    success: function(html){
      $('[role="main"] > .container').prepend( html );
      $('[role="main"]').fadeIn();
    }
  });
  
  <?php endif; ?>
  
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
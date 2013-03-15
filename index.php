<?
//Include SimplePie RSS parser
require 'scripts/simplepie.inc';  

//Get RSS Feeds

$nyt = new SimplePie();  
$nyt->set_feed_url('feed://feeds.nytimes.com/nyt/rss/HomePage');  
$nyt->enable_cache(true);  
$nyt->set_cache_duration(1800);  
$nyt->set_cache_location('/home/yoeyo/webapps/htdocs/portal/cache');  
$nyt->init();  
$nyt->handle_content_type();  

$weather = new SimplePie();  
$weather->set_feed_url('feed://rss.weather.com/weather/rss/local/27713?cm_ven=LWO&cm_cat=rss&par=LWO_rss');  
$weather->enable_cache(true);  
$weather->set_cache_duration(1800);  
$weather->set_cache_location('/home/yoeyo/webapps/htdocs/portal/cache');  
$weather->init();  
$weather->handle_content_type();  

$markets = new SimplePie();  
$markets->set_feed_url('http://pipes.yahoo.com/pipes/pipe.run?_id=ZKJobpaj3BGZOew9G8evXg&_render=rss&ticker=^GSPC%2C^DJI%2C^IXIC');  
$markets->enable_cache(true);  
$markets->set_cache_duration(1800);  
$markets->set_cache_location('/home/yoeyo/webapps/htdocs/portal/cache');  
$markets->init();  
$markets->handle_content_type();  


//Include Woot item class
require 'scripts/simplepie_woot.inc';  

$woot = new SimplePie();  
$woot->set_feed_url('feed://www.woot.com/salerss.aspx');  
$woot->set_item_class("SimplePie_Item_Woot");  
$woot->enable_cache(true);  
$woot->set_cache_duration(1800);  
$woot->set_cache_location('/home/yoeyo/webapps/htdocs/portal/cache');  
$woot->init();  
$woot->handle_content_type();  
  
$wootshirt = new SimplePie();  
$wootshirt->set_feed_url('feed://shirt.woot.com/salerss.aspx');  
$wootshirt->set_item_class("SimplePie_Item_Woot");  
$wootshirt->enable_cache(true);  
$wootshirt->set_cache_duration(1800);  
$wootshirt->set_cache_location('/home/yoeyo/webapps/htdocs/portal/cache');  
$wootshirt->init();  
$wootshirt->handle_content_type();  
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>yoeyo.com/portal</title>
	<link rel="icon" href="/favicon.ico" type="image/ico">
	<link href="default.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">

<h1>yoeyo.com/portal</h1>

<div id="search">
	<form action="scripts/search.php" method="GET">
	<? if($_GET["searcherror"]){ echo "<em>Error in search function. Please try again, or complain to Chris about it.</em>";} ?>
	<table align="center">
	<tr>
		<td><h2>Search</h2></td>
		<td>
			<select name="search">
			  <option value="google">Google</option>
			  <option value="blekko">Blekko</option>
				<option value="amazon">Amazon</option>
				<option value="wolfram">Wolfram Alpha</option>
				<option value="wikipedia">Wikipedia</option>
				<option value="imdb">IMDB</option>
				<option value="pricegrabber">Price Grabber</option>
				<option value="flickrcc"">Flickr CC</option>
			</select>
		</td>
		<td><input type="text" name="query" size="40" id="query" autofocus></td>
		<td><input type="submit" value="&nbsp;Go&nbsp;" id="submit"></td>
	</tr>
	</table>
	</form>
</div><!--/search-->

<div class="column first">
	<h2><a href="http://www.nytimes.com?_r=1&partner=rss&emc=rss">NYTimes</a> <em style="font-size: 50%; text-transform:uppercase;opacity: .5"><a href="http://prototype.nytimes.com/gst/articleSkimmer/">skimmer</a></em></h2>
		<ul class="news">
			<? 
			$nytitems = $nyt->get_items();
			$nytitems = array_slice($nytitems, "0", "10"); //Limit number of stories displayed
			foreach($nytitems as $item) : 
			?>  
				<? 
				$description = $item->get_description();
				$splitdescription = explode("<br", $description); //Parse ads from description
				?>
				<li><a href="<?=$item->get_link()?>" title="<?=$splitdescription[0];?>"><?=$item->get_title(); ?></a></li>
			<? endforeach; ?>
		</ul>
</div>

<div class="column">
	<? 
		$item = $weather->get_item(); 
		$description = $item->get_description();
		$reduceddescription = str_replace(". For more details?", "", $description); //Parse odd text from description
	?>
	<h2><a href="<?=$item->get_link();?>">Weather</a></h2>
		<p class="weather"><a href="<?=$item->get_link();?>"><?= $reduceddescription;?> in Durham, NC at <?=$item->get_date("g:i a");?>.</a></p>
	 
	 <br>
	
	<? //include "scripts/markets.php"; ?>

	 
	<h2>Woot</h2>
		<ul class="woot">
			<li>
				<? $item = $woot->get_item(); ?>
				<a href="<?=$item->get_link();?>"><img src="<?=$item->get_thumbnail_src();?>"  width="112">
				<?=$item->get_title();?></a>
				<?
					$soldout = $item->get_soldout_status();
					if($soldout=="True"){echo "<em>Sold Out</em> ";}
					else{ echo $item->get_price();}
					
					$wootoff = $item->get_wootoff_status();
					if($wootoff=="True"){echo "<strong>Woot Off!</strong> ";};
				?>
			</li>
			
			<li>
				<? $item = $wootshirt->get_item(); ?>
				<a href="<?=$item->get_link();?>"><img src="<?=$item->get_thumbnail_src();?>" width="112">
				Shirt: <?=$item->get_title();?></a>
				<?
					$soldout = $item->get_soldout_status();
					if($soldout=="True"){echo "<em>Sold Out</em> ";}
					else{ echo $item->get_price();}
				?>
			</li>
		</ul>
</div>

<div class="column">
	<h2>Links</h2>
		<ul class="links">
			<li><a href="http://www.msnbc.com"><strong>MSNBC</strong> &ndash; News</a></li>
			<li><a href="http://www.wral.com"><strong>WRAL</strong> &ndash; Local news</a></li>
			<li><a href="http://www.espn.com"><strong>ESPN</strong> &ndash; Sports</a></li>
			<li><a href="http://www.streetsatsouthpoint.com/movies"><strong>Southpoint Movies</strong> &ndash; Times</a></li>
			<li><a href="http://news.ycombinator.com/"><strong>Hacker News</strong> &ndash; Nerd news</a></li>
			<li><a href="http://www.dodtracker.com"><strong>DOD Tracker</strong> &ndash; Deals</a></li>
			<li><a href="http://tvlistings.aol.com/listings/nc/durham/time-warner-cable-digital-non-reb?zipcode=27701"><strong>TV Listings</strong> &ndash; TWC-NC</a></li>
			<li><a href="http://www.netflix.com"><strong>Netflix</strong> &ndash; Movies at home</a></li>
		</ul>
</div>

<div class="column last">
	<h2>Apps</h2>
		<ul class="links">
			<li><a href="http://www.gmail.com"><strong>GMail</strong> &ndash; E-mail</a></li>
			<li><a href="http://my.yahoo.com"><strong>My Yahoo</strong> &ndash; Portal</a></a></li>
			<li><a href="http://www.google.com/calendar"><strong>Google Calendar</strong> &ndash; Plan ahead</a></li>
			<li><a href="http://www.google.com/maps"><strong>Google Maps</strong> &ndash; Find stuff</a></li>
			<li><a href="http://www.rememberthemilk.com/login/"><strong>Remember the Milk</strong> &ndash; To do list</a></li>
			<li><a href="http://www.google.com/docs"><strong>Google Docs</strong> &ndash; Online Office</a></li>
			<li><a href="http://www.google.com/reader"><strong>GReader</strong> &ndash; RSS feeds</a></li>
			<li><a href="http://www.facebook.com"><strong>Facebook</strong> &ndash; Social network</a></li>
			<li><a href="http://www.twitter.com"><strong>Twitter</strong> &ndash; Social IMing</a></li>
			<li><a href="http://www.flickr.com"><strong>Flickr</strong> &ndash; Photos</a></li>
			<li><a href="http://www.picnik.com/app"><strong>Picnik</strong> &ndash; Image Editor</a></li>
			<li><a href="http://www.evernote.com"><strong>Evernote</strong> &ndash; Remember stuff</a></li>
		</ul>
</div>

<div class="clearboth"></div>

<cite id="footer" class="column last">&copy;<?=date("Y");?> <a href="http://www.yoeyo.com">Yoeyo, Ltd.</a></cite>

</div><!--/wrapper-->
</body>
</html>

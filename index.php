<?
// Settings
$portal_cache_location = '/Users/chrisltd/Dropbox/work/MAMP/htdocs/portal/cache';
// $portal_cache_location = '/home/yoeyo/webapps/htdocs/portal/cache';
$portal_cache_duration = 1800;
$portal_zip_code = '27713';
$portal_search_string = 'http://www.google.com/search?q=';

// Load settings from cookies
if(isset($_COOKIE['zip'])){
	$portal_zip_code = $_COOKIE['zip'];
}

if(isset($_COOKIE['search_string'])){
	$portal_zip_code = $_COOKIE['search_string'];
}

// Include SimplePie RSS parser
require_once('simplepie/autoloader.php');

// Get RSS Feeds

$nyt = new SimplePie();  
$nyt->set_feed_url('http://feeds.nytimes.com/nyt/rss/HomePage');  
$nyt->enable_cache(true);  
$nyt->set_cache_duration($portal_cache_duration);  
$nyt->set_cache_location($portal_cache_location);  
$nyt->init();  
$nyt->handle_content_type();  

$weather = new SimplePie();  
$weather->set_feed_url('http://rss.weather.com/weather/rss/local/' . $portal_zip_code . '?cm_ven=LWO&cm_cat=rss&par=LWO_rss');  
$weather->enable_cache(true);  
$weather->set_cache_duration($portal_cache_duration);  
$weather->set_cache_location($portal_cache_location);  
$weather->init();  
$weather->handle_content_type();  

$markets = new SimplePie();  
$markets->set_feed_url('http://pipes.yahoo.com/pipes/pipe.run?_id=ZKJobpaj3BGZOew9G8evXg&_render=rss&ticker=%5EGSPC%2CAAPL%2CGOOG');  
$markets->enable_cache(true);  
$markets->set_cache_duration($portal_cache_duration);  
$markets->set_cache_location($portal_cache_location);  
$markets->init();  
$markets->handle_content_type();  


//Include Woot item class
require_once('simplepie/simplepie_woot.inc');

$woot = new SimplePie();  
$woot->set_feed_url('http://www.woot.com/salerss.aspx');  
$woot->set_item_class("SimplePie_Item_Woot");  
$woot->enable_cache(true);  
$woot->set_cache_duration($portal_cache_duration);  
$woot->set_cache_location($portal_cache_location);  
$woot->init();  
$woot->handle_content_type();  
  
$wootshirt = new SimplePie();  
$wootshirt->set_feed_url('http://shirt.woot.com/salerss.aspx');  
$wootshirt->set_item_class("SimplePie_Item_Woot");  
$wootshirt->enable_cache(true);  
$wootshirt->set_cache_duration($portal_cache_duration);  
$wootshirt->set_cache_location($portal_cache_location);  
$wootshirt->init();  
$wootshirt->handle_content_type();  
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>yoeyo.com/portal</title>
	<link rel="icon" href="favicon.ico" type="image/ico">
	<link href="css/default.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">

<h1>yoeyo.com/portal</h1>

<div id="search">
	<form action="<?=$portal_search_string;?>" method="GET">
		<table align="center">
			<tr>
				<td><input type="text" name="query" size="40" id="query" autofocus></td>
				<td><input type="submit" value="Search" id="submit"></td>
			</tr>
		</table>
	</form>
</div><!--/search-->

<div class="column first">
	<h2><a href="http://www.nytimes.com?_r=1&partner=rss&emc=rss">NYTimes</a> <em style="font-size: 50%; text-transform:uppercase;opacity: .5"><a href="http://www.nytimes.com/skimmer">skimmer</a></em></h2>
		<ul class="news">
			<? 
			$nytitems = $nyt->get_items();
			$nytitems = array_slice($nytitems, "0", "10"); //Limit number of stories displayed
			foreach($nytitems as $item) : 
			?>  
				<? 
				$description = trim(strip_tags($item->get_description()));
				?>
				<li><a href="<?=$item->get_link()?>" title="<?=$description;?>"><?=$item->get_title(); ?></a></li>
			<? endforeach; ?>
		</ul>
</div>

<div class="column">
	<? 
		$item = $weather->get_item(); 
		$title = $item->get_title();
		$description = $item->get_description();
		$reduceddescription = str_replace(". For more details?", "", $description); //Parse odd text from description
	?>
	<h2><a href="<?=$item->get_link();?>">Weather</a></h2>
		<p class="weather"><a href="<?=$item->get_link();?>"><?=$title;?>:<br><b><?= $reduceddescription;?></b></a></p>
	 
	 <br>
	
	<div class="markets">	
		<h2>Markets</h2>
		<ul>
		
			<?  
				$item = $markets->get_item(0); //Get S&P 500 
				$description = $item->get_description();
				$splitdescription = explode(" ", $description);
				$pricechange = $splitdescription[7];
			?>
			<li><a href="<?=$item->get_link();?>"><strong>S&amp;P 500</strong> 
			<? if(strpos($pricechange, "-") === 0) //If the negative sign is the 1st char
					{ echo '<span class="down">' . $pricechange . '</span>';} 
			   else{
			   		{ echo '<span class="up">' . $pricechange . '</span>';} 
			   }
			?></a></li>
			
			<?  
				$item = $markets->get_item(1); //Get Apple
				$description = $item->get_description();
				$splitdescription = explode(" ", $description);
				$pricechange = $splitdescription[7];
			?>
			<li><a href="<?=$item->get_link();?>"><strong>Apple</strong> 
			<? if(strpos($pricechange, "-") === 0) //If the negative sign is the 1st char
					{ echo '<span class="down">' . $pricechange . '</span>';} 
			   else{
			   		{ echo '<span class="up">' . $pricechange . '</span>';} 
			   }
			?></a></li>
			
			<?  $item = $markets->get_item(2); //Get NASDAQ 
				$description = $item->get_description();
				$splitdescription = explode(" ", $description);
				$pricechange = $splitdescription[7];
			?>
			<li><a href="<?=$item->get_link();?>"><strong>Google</strong> 
			<? if(strpos($pricechange, "-") === 0) //If the negative sign is the 1st char
					{ echo '<span class="down">' . $pricechange . '</span>';} 
			   else{
			   		{ echo '<span class="up">' . $pricechange . '</span>';} 
			   }
			?></a></li>
	
		</ul> 
	</div><!--/markets-->

	
	<br>

	 
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
			<li><a href="http://www.espn.com"><strong>ESPN</strong> &ndash; Sports</a></li>
			<li><a href="http://news.ycombinator.com/"><strong>Hacker News</strong> &ndash; Nerd news</a></li>
			<li><a href="http://www.dodtracker.com"><strong>DOD Tracker</strong> &ndash; Deals</a></li>
			<li><a href="http://www.netflix.com"><strong>Netflix</strong> &ndash; Movies at home</a></li>
			<li><a href="http://instantwatcher.com"><strong>Instant Watcher</strong> &ndash; New on Netflix</a></li>
		</ul>
</div>

<div class="column last">
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
</div>

<div class="clearboth"></div>

<div class="settings">
<h2>Settings</h2>
	<form action="_setcookie.php" method="GET">
		<label>ZIP Code</label>
		<input type="text" name="zip" size="40" value="<?=$portal_zip_code;?>"><br>
		<label>Search String</label>
		<input type="text" name="search_string" size="40" value="<?=$portal_search_string;?>">
		<br><input type="submit" value="Set">
	</form>
</div>

<cite id="footer" class="column last">&copy;<?=date("Y");?> <a href="http://www.yoeyo.com">Yoeyo, Ltd.</a></cite>

</div><!--/wrapper-->
</body>
</html>

<?php

require_once('_config.php');
require_once('simplepie/autoloader.php'); // Include SimplePie RSS parser
require_once('simplepie/simplepie_woot.inc'); //Include Woot item class
require_once('forecastio/forecast.io.php');


if(isset($_GET["zip"])){
  $portal_zip_code = $_GET["zip"];
}

if(isset($_COOKIE['latitude'])){
  $portal_latitude = $_COOKIE['latitude'];
}

if(isset($_COOKIE['longitude'])){
  $portal_longitude = $_COOKIE['longitude'];
}

// Setup RSS Feeds

$nyt = new SimplePie();  
$nyt->set_feed_url('http://feeds.nytimes.com/nyt/rss/HomePage');  
$nyt->enable_cache(true);  
$nyt->set_cache_duration($portal_cache_duration);  
$nyt->set_cache_location($portal_cache_location);  

$markets = new SimplePie();  
$markets->set_feed_url('http://pipes.yahoo.com/pipes/pipe.run?_id=ZKJobpaj3BGZOew9G8evXg&_render=rss&ticker=' . urlencode(implode(array_keys($portal_stock_symbols), ",")));  
$markets->enable_cache(true);  
$markets->set_cache_duration($portal_cache_duration);  
$markets->set_cache_location($portal_cache_location);  

$woot = new SimplePie();  
$woot->set_feed_url('http://www.woot.com/salerss.aspx');  
$woot->set_item_class("SimplePie_Item_Woot");  
$woot->enable_cache(true);  
$woot->set_cache_duration($portal_cache_duration);  
$woot->set_cache_location($portal_cache_location);  
  
$wootshirt = new SimplePie();  
$wootshirt->set_feed_url('http://shirt.woot.com/salerss.aspx');  
$wootshirt->set_item_class("SimplePie_Item_Woot");  
$wootshirt->enable_cache(true);  
$wootshirt->set_cache_duration($portal_cache_duration);  
$wootshirt->set_cache_location($portal_cache_location);  

function getLocationName($latitude, $longitude, $username){
	$request_url = 'http://api.geonames.org/findNearbyPlaceNameJSON?lat=' . $latitude . '&lng=' . $longitude . '&username=' . $username;
	$content = file_get_contents($request_url);
	if ($content != '' && isset($content)) {
		$location_object = json_decode($content);
		return $location_object->geonames[0]->name;
	} else {
		return false;		
	}
}

?>

<?php 
  if($nyt->init()):
    $nyt->handle_content_type();
    $nytitems = $nyt->get_items();
    $nytitems = array_slice($nytitems, 0, 12); // limit results
    if( count($nytitems) > 0 ):
 ?>
<div class="column">
  <h2><a href="http://www.nytimes.com?_r=1&partner=rss&emc=rss">NYTimes</a> <em><a href="http://www.nytimes.com/skimmer">skimmer</a></em></h2>

  <ul class="news">
    <? 
    foreach($nytitems as $item): 
     $description = trim(strip_tags($item->get_description()));
      ?>
      <li><a href="<?=$item->get_link()?>" title="<?=$description;?>"><?=$item->get_title(); ?></a></li>
    <? endforeach; ?>
  </ul>

</div><!--/.column-->
<?php 
    endif; 
  endif; 
?>


<div class="column">

<?php 
	$cachefile = $portal_cache_location . "/weather" . $portal_latitude . $portal_longitude;
	$cachetime = 20 * 60; // 20 minutes
	
	// Serve from the cache if it is younger than $cachetime
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
		include($cachefile);
		echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
	} else {
		ob_start(); // start the output buffer
	
		$forecast = new ForecastIO($portal_forecastio_api_key);	
	
		if($condition = $forecast->getCurrentConditions($portal_latitude, $portal_longitude)):
?>

  <h2>Weather</h2>
  
  <ul class="weather">
    <li>
    	<canvas id="weather_icon" width="50" height="50" data-weather-state="<?php echo strtoupper($condition->getIcon());?>"></canvas>
    	<?php
    		$locationName = getLocationName($portal_latitude, $portal_longitude, $portal_geonames_username);
    		if($locationName){
    			echo $locationName;
    		} else {
    			echo 'Currently';
    		}
    	?>
    	<br><b><?php echo round($condition->getTemperature()); ?>&deg;</b> and <b><?php echo $condition->getSummary(); ?></b>
    </li>
  </ul>
  
<?php 
		endif; 

		$fp = fopen($cachefile, 'w'); // open the cache file for writing
		fwrite($fp, ob_get_contents()); // save the contents of output buffer to the file
		fclose($fp); // close the file

		ob_end_flush(); // Send the output to the browser

	} // end else
?>

<?php 
  if($markets->init()):
    $markets->handle_content_type();
    $marketitems = $markets->get_items();
    if( count($marketitems) > 0 ):
 ?>
    
  <h2>Stocks</h2>
  
  <table class="markets">

  <? 
  foreach($marketitems as $item) : 
  ?>  
    <? 
    $title = $item->get_title();
    $splittitle = explode(" ", $title);
    $symbol = $splittitle[0];
    $name = $portal_stock_symbols[$symbol]; // Get proper name from settings array
    $description = $item->get_description();
    $splitdescription = explode(" ", $description);
    $price = $splitdescription[1];
    $pricechange = $splitdescription[7];
    ?>
		<tr>
			<td><a href="<?=$item->get_link();?>"><strong title="<?=$symbol;?>"><?=$name;?></strong></a></td>
			<td><?=$price;?></td>
			<td>
			<? if(strpos($pricechange, "-") === 0) //If the negative sign is the 1st char
					{ echo '<span class="down">' . $pricechange . '</span>';} 
				 else{
						{ echo '<span class="up">' . $pricechange . '</span>';} 
				 }
			?>
			</td>
		</tr>
  <? endforeach; ?>
  </table>

<?php 
    endif; 
  endif; 
?>

<?php 
  if($woot->init()):
    $woot->handle_content_type();
?>   

  <h2>Woot</h2>
  
  <ul class="woot">
    <li>
      <? $item = $woot->get_item(); ?>
      <a href="<?=$item->get_link();?>"><img src="<?=$item->get_standard_src();?>"><br>
      <?php
	      $wootoff = strtolower($item->get_wootoff_status());
        if($wootoff=="true"){echo '<strong class="alert">Woot Off!</strong>';};
      ?>
      <b><?=$item->get_title();?></b></a>
      <?
        $soldout = strtolower($item->get_soldout_status());
        if($soldout=="true"): ?>
        	<em>Sold Out</em>
        <?php else: ?>
        <?=$item->get_price();?> 
        	<?php if($wootoff=="true"): ?>
        		<span class="info"><?=(1-$item->get_soldout_percentage()) * 100;?>% left</span>
      		<?php endif; ?>  	
			<?php endif; ?>
    </li>
    
    <?php 
      if($wootshirt->init()):
        $wootshirt->handle_content_type();
    ?>   
    <li>
      <? $item = $wootshirt->get_item(); ?>
      <a href="<?=$item->get_link();?>"><img src="<?=$item->get_standard_src();?>"><br>
      <b>Shirt: <?=$item->get_title();?></b></a>
      <?
        $soldout = $item->get_soldout_status();
        if($soldout=="True"){echo "<em>Sold Out</em> ";}
        else{ echo $item->get_price();}
      ?>
    </li>

    <?php endif;  // wootshirt ?>

  </ul>

<?php endif; // woot ?>

</div><!--/.column-->








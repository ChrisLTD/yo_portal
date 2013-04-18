$(function(){
  
  // Call in the feeds
  $.ajax({
    url: "_fetchfeeds.php?zip=<?=urlencode($portal_zip_code);?>",
    cache: false,
    success: function(html){
      $('[role="main"] > .container').prepend( html );
      $('[role="main"]').fadeIn();
      // Create weather icon
			var skycons = new Skycons({"color": "rgb(41,44,53)"});
			var weather_state = $("#weather_icon").data('weather-state');
			skycons_object = 'Skycons.' + weather_state;
			skycons.add("weather_icon", eval(skycons_object));
			skycons.play();
    }
  });
  

  
});
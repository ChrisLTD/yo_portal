$(function(){
  
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
  
  // Geolocation
  function geoerror(msg) {
		alert("Location services not available.");
	}
	
	function setLatLong(position) {
		$("#settings_latitude").val(position.coords.latitude.toFixed(4));
		$("#settings_longitude").val(position.coords.longitude.toFixed(4));
	}
  
  $("#get_current_location").click(function(event) {
		event.preventDefault();	
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(setLatLong, geoerror);
		} else {
			alert("Location services not available.");
		}		
	});

  
});
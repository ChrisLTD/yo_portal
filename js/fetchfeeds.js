$(function(){
  
  // Call in the feeds
  $.ajax({
    url: "_fetchfeeds.php?zip=<?=urlencode($portal_zip_code);?>",
    cache: false,
    success: function(html){
      $('[role="main"] > .container').prepend( html );
      $('[role="main"]').fadeIn();
    }
  });
  
});
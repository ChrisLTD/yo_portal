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
  
});
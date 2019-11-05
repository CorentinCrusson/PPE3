jQuery(window).resize(function(evt) {
  jQuery(".grid-content > div > div > .channelImage").height(jQuery(".grid-content > div > div > .channelImage").width());
});
jQuery(function() {
  jQuery(window).resize();
});

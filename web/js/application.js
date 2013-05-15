// HTML5 Fixes for common elements
['article','section','nav','aside','header','footer','page','main','figure','figcaption'].each(function(elementName) {
  document.createElement(elementName);
});

$(document).ready(function() {
  // Handle popups links
  $('a[rel=popup]').click(function(e) {
    e.preventDefault();
    window.open($(this).attr('href'));
  });
});
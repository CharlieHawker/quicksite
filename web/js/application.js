$(document).ready(function() {
  quicksite = new Quicksite;
});


Quicksite = function() {
  var self = this;
  self.init();
};

Quicksite.init = function() {
  $('a[rel=popup]').click(function(e) {
    e.preventDefault();
    window.open($(this).attr('href'));
  })
};
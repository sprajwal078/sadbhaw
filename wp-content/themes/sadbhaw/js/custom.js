  // IIFE - Immediately Invoked Function Expression
  (function($, window, document) {
    // The $ is now locally scoped
   // Listen for the jQuery ready event on the document
    $(function() {
      // The DOM is ready!
      $('#slider').on('show.bs.modal',function(e){
        var image = $(e.relatedTarget) // Button that triggered the modal
        $(this).carousel(image.data('position'));
      });
    });
   // The rest of the code goes here!
  }(window.jQuery, window, document));
  // The global jQuery object is passed as a parameter
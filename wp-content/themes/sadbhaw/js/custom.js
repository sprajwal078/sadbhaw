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

      //Show respective payement button after switching the payment select radio button
      $('#payment-select input[type=radio]').on('change',function(e){
        $('#'+this.value).siblings().hide().end().show()
      });

      var animate_done = false;
      //for stories slider
      setInterval(function(){
        var showm_item = $('.slide-item:visible');
        if(showm_item.next().length != 0){
          // $('.slide-item:visible').hide();
          // showm_item.next().show();
          $('.slide-item:visible').hide();
          showm_item.next().fadeIn('slow');
        }else{
          // $('.slide-item:visible').hide();
          // $('.slide-item').eq(0).show();
          $('.slide-item:visible').hide();
          $('.slide-item').eq(0).fadeIn('slow');
        }
      },5000);

      $(document).on('DOMMouseScroll MouseScrollEvent MozMousePixelScroll wheel scroll', function(event) {
      if($('.rollup').length > 0 ) {
        if ($('.rollup').position().top <= $(document).scrollTop() + 450) {
          if (!animate_done) {
            animate_done = true;
            $('.Count').each(function () {
              var $this = $(this);
              jQuery({Counter: 0}).animate({Counter: $this.text()}, {
                duration: 3000,
                easing: 'swing',
                step: function () {
                  $this.text(Math.ceil(this.Counter));
                }
              });
            });
          }

        }
      }
      $('body').addClass('down');
        event.stopPropagation();
      });
      if (window.location.hash) {
        $("a[href='" + window.location.hash + "']").tab('show');
      }


    var $click_button_togle = true;
    $('.iw-button-toggle').on('click',function(){
      if($click_button_togle){
        if($(window).width() < 992){
          $('.menu-default-menu-container, .menu-menu-with-icons-container').slideDown();
        }else{
          $('.menu-default-menu-container, .menu-menu-with-icons-container').show();
        }
        $(this).addClass('show_customer');
        $click_button_togle = false;
      }else{
        if($(window).width() < 992){
          $('.menu-default-menu-container, .menu-menu-with-icons-container').slideUp();
        }else{

          $('.menu-default-menu-container, .menu-menu-with-icons-container').show();

        }
        $(this).removeClass('show_customer');
        $click_button_togle = true;
      } 
    });
    $(window).on("resize",function(){ 
      if($(window).width() < 992){
        if($click_button_togle){
          $('.menu-default-menu-container, .menu-menu-with-icons-container').hide();
        }
      }else{
        $('.menu-default-menu-container, .menu-menu-with-icons-container').show();
      }
      
    });
      
    });
   // The rest of the code goes here!
  }(window.jQuery, window, document));
  // The global jQuery object is passed as a parameter
( function( $ ) {
	'use strict'; 

    //offcanvas search field autofocus
    $('#offcanvas-search-icon').on('click', function(){
      setTimeout(function() { $('.offcanvas-search .form-control').focus() }, 500)
    });

    $('.popup-image').magnificPopup({
        type:'image'
    });

    $('.popup-youtube, .popup-vimeo, .popup-gmaps, .popup-video').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
    
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
            verticalFit: true
        },
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
                return element.find('img');
            }
        }        
    });

    if($(".clientsCarousel").length){
        var citykidClientsCarousel = new Swiper(".clientsCarousel", {
            slidesPerView: 5,
            spaceBetween: 20,   
            loop: false,
            loopFillGroupWithBlank: false,
            navigation: false,            
            breakpoints: {
                240: {
                    slidesPerView: 1,
                },
                768: {
                slidesPerView: 3,
                },
                992: {
                slidesPerView: 4,
                },
                1024: {
                slidesPerView: 5,
                },
              },
          });
    }
  
    // Login modal
    if($("#citikidLoginModal").length){
        const citikidLoginModal = document.getElementById('citikidLoginModal')
        citikidLoginModal.addEventListener('show.bs.modal', event => {
            localStorage.setItem('citikidLoginModal', true);
            localStorage.removeItem('citikidRegisterModal');
        });
        citikidLoginModal.addEventListener('hidden.bs.modal', event => {
            localStorage.removeItem('citikidLoginModal');
        });

        // Register modal
        const citikidRegisterModal = document.getElementById('citikidRegisterModal')
        citikidRegisterModal.addEventListener('show.bs.modal', event => {
            localStorage.setItem('citikidRegisterModal', true);
            localStorage.removeItem('citikidLoginModal');
        });
        citikidRegisterModal.addEventListener('hidden.bs.modal', event => {
            localStorage.removeItem('citikidRegisterModal');
        });
        
        
        $(window).on('load', function(){
            if(Boolean(localStorage.getItem('citikidLoginModal')) === true){
                $('#citikidLoginModal').modal('show');            
            }
            if(Boolean(localStorage.getItem('citikidRegisterModal')) === true){
                $('#citikidRegisterModal').modal('show');            
            }
        });
    }

    /*----------------------------------------------------*/
  /*  ScrollUp
  /*----------------------------------------------------*/  
  $.scrollUp = function (options) {

    // Defaults
    var defaults = {
      scrollName: 'scrollUp', // Element ID
      topDistance: 600, // Distance from top before showing element (px)
      topSpeed: 800, // Speed back to top (ms)
      animation: 'slide', // Fade, slide, none
      animationInSpeed: 200, // Animation in speed (ms)
      animationOutSpeed: 200, // Animation out speed (ms)
      scrollText: '', // Text for element
      scrollImg: false, // Set true to use image
      activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    };

    var o = $.extend({}, defaults, options),
      scrollId = '#' + o.scrollName;

    // Create element
    $('<a/>', {
      id: o.scrollName,
      href: '#',
      title: o.scrollText
    }).appendTo('body');
    
    // If not using an image display text
    if (!o.scrollImg) {
      $(scrollId).html('<span class="icon-wrap"><i class="arrow-up"></i></span>');
    }

    // Minium CSS to make the magic happen
    $(scrollId).css({'display':'none','position': 'fixed','z-index': '99999'});

    // Active point overlay
    if (o.activeOverlay) {
      $("body").append("<div id='"+ o.scrollName +"-active'></div>");
      $(scrollId+"-active").css({ 'position': 'absolute', 'top': o.topDistance+'px', 'width': '100%', 'border-top': '1px dotted '+o.activeOverlay, 'z-index': '99999' });
    }

    // Scroll function
    $(window).on('scroll', function(){  
      switch (o.animation) {
        case "fade":
          $( ($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed) );
          break;
        case "slide":
          $( ($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed) );
          break;
        default:
          $( ($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0) );
      }
    });

  };

  if($('#geometry').length){
    $(document).on('change', '#geometry', function(){
        let mapField = $(this).closest('.rwmb-meta-box').find('#map');
        if(mapField.length > 0){
            mapField.val($(this).val()+',14').trigger('update');
            $('#address_listing').trigger('update');
        }
        update();
    });
  }
  
  
  if('' !== CITYKID.backtoTop){
    $.scrollUp();
  }
  
  
}( jQuery ) );

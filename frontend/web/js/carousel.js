jQuery(function($){

  'use strict';

  setTimeout(function(){
    $('.main-slider').addClass('active');
  }, 500);

  // -------------------------------------------------------------
  //   Centered Navigation
  // -------------------------------------------------------------
  // (function () {
    var $frame  = $('#carousel');
    // var $slidee = $frame.children('ul').eq(0);
    var $slidee = $frame.find('.slide');
    var $nav   = $('.carousel-nav');

    $(window).resize(function(e){
      $frame.sly('reload');
    });

    $frame.hover(
      function(){
        $nav.addClass('opacity');
      },
      function(){
        $nav.removeClass('opacity');
      }
    );

    // Call Sly on frame
    $frame.sly({
      horizontal: 1,
      // itemNav: 'centered',
      itemNav: 'forceCentered',
      // itemNav: 'basic',
      smart: 1,
      activateOn: 'click',
      // activateMiddle: 1,
      mouseDragging: 1,
      touchDragging: 1,
      // releaseSwing: 1,
      startAt: 0,
      // scrollTrap: 1,
      // scrollBar: $nav.find('.scrollbar'),
      scrollBy: 1,
      // pagesBar: $nav.find('.pages'),
      // activatePageOn: 'click',
      speed: 300,
      elasticBounds: 1,
      // easing: 'easeOutExpo',
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,

      // cycleBy: 'items',
      // cycleInterval: 200,
      // pauseOnHover: 1,

      // Buttons
      // backward: $('#backward'),
      // forward: $('#forward'),
      // prev: $nav.find('.prev'),
      // next: $nav.find('.next'),
      // prevPage: $('#prev-page'),
      // nextPage: $('#next-page')
    });

    $('#backward').hover(
      function(){
        $frame.sly('moveBy', -400);
      },
      function(){
        $frame.sly('stop');
      }
    );

    $('#forward').hover(
      function(){
        $frame.sly('moveBy', 400);
      },
      function(){
        $frame.sly('stop');
      }
    );

    $('#prev-page').hover(
      function(){
        $frame.sly('moveBy', -700);
      },
      function(){
        $frame.sly('stop');
      }
    );

    $('#next-page').hover(
      function(){
        $frame.sly('moveBy', 700);
      },
      function(){
        $frame.sly('stop');
      }
    );

  //   // To Start button
  //   $nav.find('.toStart').on('click', function () {
  //     var item = $(this).data('item');
  //     // Animate a particular item to the start of the frame.
  //     // If no item is provided, the whole content will be animated.
  //     $frame.sly('toStart', item);
  //   });

  //   // To Center button
  //   $nav.find('.toCenter').on('click', function () {
  //     var item = $(this).data('item');
  //     // Animate a particular item to the center of the frame.
  //     // If no item is provided, the whole content will be animated.
  //     $frame.sly('toCenter', item);
  //   });

  //   // To End button
  //   $nav.find('.toEnd').on('click', function () {
  //     var item = $(this).data('item');
  //     // Animate a particular item to the end of the frame.
  //     // If no item is provided, the whole content will be animated.
  //     $frame.sly('toEnd', item);
  //   });

  //   // Add item
  //   $nav.find('.add').on('click', function () {
  //     $frame.sly('add', '<li>' + $slidee.children().length + '</li>');
  //   });

  //   // Remove item
  //   $nav.find('.remove').on('click', function () {
  //     $frame.sly('remove', -1);
  //   });
  // }());

  $("#rs-slider").responsiveSlides({
    manualControls: '#carousel',
    nav: true,
    pause: false,
    prevText: '',
    nextText: '',
    // maxwidth: 540,
    after: function(){
      // $('#carousel .simple-slider').find('.active').removeClass('active');
      var number = $('.rslides1_on').data('number');

      $frame.sly('activate', number);
      console.log(number);
    }
  });

});
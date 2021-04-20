jQuery(function ($) {
  'use strict';

  setTimeout(function () {
    $('#mainSlider').addClass('active');
  }, 500);

  var $slider = $('#rs-slider');
  var $carousel = $('#carousel');
  // // var $slidee = $carousel.children('ul').eq(0);
  // var $slidee = $carousel.find(".carousel__slide");
  var isSliderClicked = false;

  $slider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
    isSliderClicked = true;
    $carousel.sly('activate', nextSlide);
    console.log(nextSlide);
  });

  $slider.on('afterChange', function (e, slick, currentSlide) {
    isSliderClicked = false;
  });

  $slider.slick({
    // asNavFor: $carousel,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: true,
    prevArrow: $('#rs-slider-prev'),
    nextArrow: $('#rs-slider-next'),
    fade: true,
    infinite: true,
    lazyLoad: 'ondemand',
    speed: 500,
    waitForAnimate: false,
  });

  // $carousel.on("init", function(e, slick) {
  //   slick.$slides.eq(0).addClass("active");
  //   $(".carousel__slide").on("click", function(e) {
  //     e.preventDefault();
  //     $slider.slick("slickGoTo", $(this).data().number);
  //   });
  // });

  // $carousel.on("swipe", function(e, slick, direction) {
  //   console.log(direction);
  // });

  // // $carousel.on("afterChange", function(e, slick, currentSlide) {
  // //   slick.$slides.eq(currentSlide).addClass("active");
  // // });

  // $carousel.on("beforeChange", function(e, slick, currentSlide, nextSlide) {
  //   slick.$slides.eq(currentSlide).removeClass("active");
  //   slick.$slides.eq(nextSlide).addClass("active");
  // });

  // $carousel.slick({
  //   infinite: false,
  //   arrows: false,
  //   centerMode: true,
  //   lazyLoad: "ondemand",
  //   variableWidth: true,
  //   slidesToShow: 10,
  //   swipeToSlide: true,
  //   waitForAnimate: false
  // });

  $(window).resize(function (e) {
    $carousel.sly('reload');
  });

  // $carousel.hover(
  //   function() {
  //     $nav.addClass("opacity");
  //   },
  //   function() {
  //     $nav.removeClass("opacity");
  //   }
  // );

  // Call Sly on frame
  $carousel.sly({
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

  $carousel.sly('on', 'active', function (e, itemIndex) {
    if (isSliderClicked) {
      return;
    }

    $slider.slick('slickGoTo', itemIndex);
    console.log('Sly index: ' + itemIndex);
  });

  $('#backward').hover(
    function () {
      $carousel.sly('moveBy', -400);
    },
    function () {
      $carousel.sly('stop');
    },
  );

  $('#forward').hover(
    function () {
      $carousel.sly('moveBy', 400);
    },
    function () {
      $carousel.sly('stop');
    },
  );

  $('#prev-page').hover(
    function () {
      $carousel.sly('moveBy', -700);
    },
    function () {
      $carousel.sly('stop');
    },
  );

  $('#next-page').hover(
    function () {
      $carousel.sly('moveBy', 700);
    },
    function () {
      $carousel.sly('stop');
    },
  );

  //   // To Start button
  //   $nav.find('.toStart').on('click', function () {
  //     var item = $(this).data('item');
  //     // Animate a particular item to the start of the frame.
  //     // If no item is provided, the whole content will be animated.
  //     $carousel.sly('toStart', item);
  //   });

  //   // To Center button
  //   $nav.find('.toCenter').on('click', function () {
  //     var item = $(this).data('item');
  //     // Animate a particular item to the center of the frame.
  //     // If no item is provided, the whole content will be animated.
  //     $carousel.sly('toCenter', item);
  //   });

  //   // To End button
  //   $nav.find('.toEnd').on('click', function () {
  //     var item = $(this).data('item');
  //     // Animate a particular item to the end of the frame.
  //     // If no item is provided, the whole content will be animated.
  //     $carousel.sly('toEnd', item);
  //   });

  //   // Add item
  //   $nav.find('.add').on('click', function () {
  //     $carousel.sly('add', '<li>' + $slidee.children().length + '</li>');
  //   });

  //   // Remove item
  //   $nav.find('.remove').on('click', function () {
  //     $carousel.sly('remove', -1);
  //   });
  // }());

  // $("#test-carousel").slick({
  //   // infinite: true,
  //   arrows: false,
  //   centerMode: true,
  //   variableWidth: true,
  //   dots: true,
  //   swipeToSlide: true,
  //   slidesToShow: 5
  //   // fade: true
  // });
});

jQuery(function($) {
  "use strict";

  setTimeout(function() {
    $("#mainSlider").addClass("active");
  }, 500);

  // -------------------------------------------------------------
  //   Centered Navigation
  // -------------------------------------------------------------
  // (function () {
  var $slider = $("#rs-slider");
  var $frame = $("#carousel");
  // var $slidee = $frame.children('ul').eq(0);
  var $slidee = $frame.find(".carousel__slide");
  var $nav = $(".carousel-nav");

  $(window).resize(function(e) {
    $frame.sly("reload");
  });

  $frame.hover(
    function() {
      $nav.addClass("opacity");
    },
    function() {
      $nav.removeClass("opacity");
    }
  );

  // // Call Sly on frame
  // $frame.sly({
  //   horizontal: 1,
  //   // itemNav: 'centered',
  //   itemNav: "forceCentered",
  //   // itemNav: 'basic',
  //   smart: 1,
  //   activateOn: "click",
  //   // activateMiddle: 1,
  //   mouseDragging: 1,
  //   touchDragging: 1,
  //   // releaseSwing: 1,
  //   startAt: 0,
  //   // scrollTrap: 1,
  //   // scrollBar: $nav.find('.scrollbar'),
  //   scrollBy: 1,
  //   // pagesBar: $nav.find('.pages'),
  //   // activatePageOn: 'click',
  //   speed: 300,
  //   elasticBounds: 1,
  //   // easing: 'easeOutExpo',
  //   dragHandle: 1,
  //   dynamicHandle: 1,
  //   clickBar: 1

  //   // cycleBy: 'items',
  //   // cycleInterval: 200,
  //   // pauseOnHover: 1,

  //   // Buttons
  //   // backward: $('#backward'),
  //   // forward: $('#forward'),
  //   // prev: $nav.find('.prev'),
  //   // next: $nav.find('.next'),
  //   // prevPage: $('#prev-page'),
  //   // nextPage: $('#next-page')
  // });

  // $frame.sly("on", "active", function(eventName, itemIndex) {
  //   console.log("Sly " + itemIndex);
  // });

  // $("#backward").hover(
  //   function() {
  //     $frame.sly("moveBy", -400);
  //   },
  //   function() {
  //     $frame.sly("stop");
  //   }
  // );

  // $("#forward").hover(
  //   function() {
  //     $frame.sly("moveBy", 400);
  //   },
  //   function() {
  //     $frame.sly("stop");
  //   }
  // );

  // $("#prev-page").hover(
  //   function() {
  //     $frame.sly("moveBy", -700);
  //   },
  //   function() {
  //     $frame.sly("stop");
  //   }
  // );

  // $("#next-page").hover(
  //   function() {
  //     $frame.sly("moveBy", 700);
  //   },
  //   function() {
  //     $frame.sly("stop");
  //   }
  // );

  $frame.slick({
    infinite: true,
    arrows: false,
    centerMode: true,
    variableWidth: true
  });

  $frame.on("init", function(e, slick) {
    slick.$slides.eq(0).addClass("active");
  });

  $frame.on("beforeChange", function(e, slick, currentSlide, nextSlide) {
    slick.$slides.eq(currentSlide).removeClass("active");
  });

  $frame.on("afterChange", function(e, slick, currentSlide) {
    slick.$slides.eq(currentSlide).addClass("active");
  });

  // $("#rs-slider").responsiveSlides({
  //   manualControls: "#carousel",
  //   nav: true,
  //   pause: false,
  //   prevText: "",
  //   nextText: "",
  //   // maxwidth: 540,
  //   before: function() {
  //     // console.log(i);
  //   },
  //   after: function() {
  //     // $('#carousel .simple-slider').find('.active').removeClass('active');
  //     var number = $(".rslides1_on").data("number");

  //     $frame.sly("activate", number);
  //     // console.log(number);
  //   }
  // });

  $slider.slick({
    asNavFor: $frame,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: true,
    prevArrow: $("#rs-slider-prev"),
    nextArrow: $("#rs-slider-next"),
    fade: true,
    infinite: true,
    speed: 500,
    waitForAnimate: false
  });

  // $slider.on("afterChange", function(e, slick, currentSlide) {
  //   $frame.sly("activate", currentSlide);
  //   // console.log(currentSlide);
  // });
});

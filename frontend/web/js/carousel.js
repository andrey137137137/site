jQuery(function($) {
  "use strict";

  setTimeout(function() {
    $("#mainSlider").addClass("active");
  }, 500);

  var $slider = $("#rs-slider");
  var $carousel = $("#carousel");
  // // var $slidee = $carousel.children('ul').eq(0);
  // var $slidee = $carousel.find(".carousel__slide");

  $slider.slick({
    asNavFor: $carousel,
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: true,
    prevArrow: $("#rs-slider-prev"),
    nextArrow: $("#rs-slider-next"),
    fade: true,
    infinite: true,
    lazyLoad: "ondemand",
    speed: 500,
    waitForAnimate: false
  });

  $carousel.on("init", function(e, slick) {
    slick.$slides.eq(0).addClass("active");
    $(".carousel__slide").on("click", function(e) {
      e.preventDefault();
      $slider.slick("slickGoTo", $(this).data().number);
    });
  });

  $carousel.on("swipe", function(e, slick, direction) {
    console.log(direction);
  });

  // $carousel.on("afterChange", function(e, slick, currentSlide) {
  //   slick.$slides.eq(currentSlide).addClass("active");
  // });

  $carousel.on("beforeChange", function(e, slick, currentSlide, nextSlide) {
    slick.$slides.eq(currentSlide).removeClass("active");
    slick.$slides.eq(nextSlide).addClass("active");
  });

  $carousel.slick({
    // infinite: true,
    arrows: false,
    centerMode: true,
    lazyLoad: "ondemand",
    variableWidth: true,
    slidesToShow: 10,
    swipeToSlide: true,
    waitForAnimate: false
  });

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

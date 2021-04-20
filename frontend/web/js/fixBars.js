jQuery(function ($) {
  'use strict';

  var $header = $('#main-header');
  var $footer = $('#main-footer');

  $('#menu-check').on('click', function () {
    $('#main-menu').slideToggle(300, function () {
      if ($(this).css('display') === 'none') {
        $(this).removeAttr('style');
      }
    });
  });

  // fixBars();
  // $(window).scroll(fixBars);

  // function fixBars()
  // {
  //   if ($(window).scrollTop() > 0)
  //   {
  //     $header.addClass('narrow');
  //   }
  //   else
  //   {
  //     $header.removeClass('narrow');
  //   }

  //   if ($(window).height() > $(document.body).height())
  //   {
  //     $footer.addClass('fixed');
  //   }
  //   else
  //   {
  //     $footer.removeClass('fixed');
  //   }

  //   $footer.css({opacity: 1});
  // }
});

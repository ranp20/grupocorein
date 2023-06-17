$(() => {
  // Product details main slider
  $('.product-details-slider').owlCarousel({
    loop: true,
    items: 1,
    autoplayTimeout: 5000,
    smartSpeed: 1200,
    autoplay: false,
    thumbs: true,
    dots: false,
    thumbImage: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    thumbContainerClass: 'owl-thumbs',
    thumbItemClass: 'owl-thumb-item',
  });

  // Product details image zoom
  $('.product-details-slider .item').zoom();

  // Video popup
  $('.video-btn a').magnificPopup({
    type: 'iframe',
    mainClass: 'mfp-fade'
  });
});
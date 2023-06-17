$(() => {
  // Flash Deal Area Start
  var $hero_slider_main = $(".hero-slider-main");
  $hero_slider_main.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    smartSpeed: 1200,
    items: 1,
    thumbs: false,
  });
  // heroarea-slider
  var $testimonialSlider = $('.heroarea-slider');
  $testimonialSlider.owlCarousel({
    loop: true,
    navText: [],
    nav: true,
    nav: true,
    dots: false,
    autoplay: true,
    thumbs: false,
    autoplayTimeout: 5000,
    smartSpeed: 1200,
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      576: {
        items: 1
      },
      950: {
        items: 1
      },
      960: {
        items: 1
      },
      1200: {
        items: 1
      }
    }
  });
  // popular_category_slider
  var $popular_category_slider = $(".popular-category-slider");
  $popular_category_slider.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    loop: false,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    margin: 15,
    thumbs: false,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 4,
      },
      1400: {
        items: 5
      }
    },
  });
  // feature_category_slider
  var $feature_category_slider = $(".feature-category-slider");
  $feature_category_slider.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    loop: false,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    margin: 15,
    thumbs: false,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 4,
      },
      1400: {
        items: 5
      }
    },
  });
  // Flash Deal Area Start
  var $flash_deal_slider = $(".flash-deal-slider");
  $flash_deal_slider.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    margin: 15,
    thumbs: false,
    responsive: {
      0: {
        items: 1,
        margin: 0,
      },
      576: {
        items: 1,
        margin: 0,
      },
      768: {
        items: 1,
        margin: 0,
      },
      992: {
        items: 2,
      },
      1200: {
        items: 2,
      },
      1400: {
        items: 2,
      },
    },
  });
  // col slider
  var $col_slider = $(".newproduct-slider");
  $col_slider.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    loop: false,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    margin: 15,
    thumbs: false,
    responsive: {
      0: {
        items: 1,
      },
      530: {
        items: 1,
      },
    },
  });
  // col slider 2
  var $col_slider2 = $(".toprated-slider");
  $col_slider2.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    loop: true,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    margin: 15,
    thumbs: false,
    responsive: {
      0: {
        items: 1,
      },
      530: {
        items: 1,
      },
    },
  });
  // newproduct-slider Area Start
  var $newproduct_slider = $(".features-slider");
  $newproduct_slider.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    loop: false,
    margin: 15,
    thumbs: false,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 4,
      },
      1400: {
        items: 5
      }
    },
  });
  // home-blog-slider
  var $home_blog_slider = $(".home-blog-slider");
  $home_blog_slider.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    loop: false,
    thumbs: false,
    margin: 15,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 3,
      },
      1400: {
        items: 3,
      }
    },
  });
  // brand-slider
  var $brand_slider = $(".brand-slider");
  $brand_slider.owlCarousel({
    navText: [],
    nav: true,
    dots: false,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    loop: true,
    thumbs: false,
    margin: 15,
    responsive: {
      0: {
        items: 2,
      },
      575: {
        items: 3,
      },
      790: {
        items: 4,
      },
      1100: {
        items: 4,
      },
      1200: {
        items: 4,
      },
      1400: {
        items: 5,
      }
    },
  });
  // toprated-slider Area Start
  var $relatedproductsliderv = $(".relatedproductslider");
  $relatedproductsliderv.owlCarousel({
    nav: false,
    dots: true,
    autoplayTimeout: 6000,
    smartSpeed: 1200,
    margin: 15,
    thumbs: false,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      992: {
        items: 4,
      },
      1200: {
        items: 4,
      },
      1400: {
        items: 5
      }
    },
  });
  // Blog Details Slider Area Start
  var $hero_slider_main = $(".blog-details-slider");
  $hero_slider_main.owlCarousel({
    navText: [],
    nav: true,
    dots: true,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    smartSpeed: 1200,
    items: 1,
    thumbs: false,
  });
  // Recent Blog Slider Area Start
  var $popular_category_slider = $(".resent-blog-slider");
  $popular_category_slider.owlCarousel({
    navText: [],
    nav: false,
    dots: true,
    loop: false,
    autoplayTimeout: 5000,
    smartSpeed: 1200,
    margin: 30,
    thumbs: false,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 2,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 3,
      }
    },
  });

  
});
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

  
  // ----------- HACER HOVER EN UN ELEMENTO CON DROPDOWN
	var namehoverAll = document.querySelectorAll("*[data-dropdown-custommenu]");
	var backdropHome = document.querySelector("#backdrop");
  let ctopbar = document.querySelector(".topbar");
  let cmtoparea = document.querySelector(".menu-top-area");
	namehoverAll.forEach(function(i,e){
		var namehover = i;
    ctopbar.addEventListener("mouseenter", function(f){
      namehoverAll.forEach(function(i,e){
        var namehover = i;      
        if(namehover.classList.contains("active")){
          backdropHome.classList.add("hide");
          namehover.classList.remove('active');
          namehover.nextElementSibling.classList.remove('active');
        }
      });
    });
    cmtoparea.addEventListener("mouseenter", function(f){
      namehoverAll.forEach(function(i,e){
        var namehover = i;      
        if(namehover.classList.contains("active")){
          backdropHome.classList.add("hide");
          namehover.classList.remove('active');
          namehover.nextElementSibling.classList.remove('active');
        }
      });
    });
		namehover.addEventListener("mouseenter",function(){
			var attrnamehov = this.getAttribute("data-dropdown-custommenu");
			if(attrnamehov.value === ''){
        console.log('No es un menu hover');
      }else{
        $("#backdrop").removeClass('hide');
				$(this).addClass('active');
				$(this).next().addClass('active');
      }
		});
	});
  // ----------- REMOVER ELEMENTO DROPDOWN AL HACER HOVER EN EL BACKDROP
	backdropHome.addEventListener("mouseenter", function(f){
    namehoverAll.forEach(function(i,e){
			var namehover = i;      
			if(namehover.classList.contains("active")){
				backdropHome.classList.add("hide");
				namehover.classList.remove('active');
				namehover.nextElementSibling.classList.remove('active');
			}
		});
	});
  /*
  // ----------- LISTADO DE MARCAS EN HEADERTOP
  var locationsGET = window.location.href;
  var csrfTokenFrm = $("#csl-fGv8n09c__sGaYs45").find("input[name='_token']").val();
  
  // var tmpLisAllBrands = [];
  const brandList = document.querySelector('.brand-list');
  const filterButtonsContainer = document.querySelector('.filter-buttons');
  const availableLetters = new Set();
  const numericButton = document.createElement('button'); // Create a button for numeric characters
  numericButton.textContent = '#';
  numericButton.disabled = true;

  
  getAllBrands();
  var tmpLisAllBrands = [];
  function getAllBrands(){
    // e.preventDefault();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': csrfTokenFrm
      },
      url: locationsGET+"getallbrands",
      type: "POST",
      dataType: "JSON",
      success: function(e){
        if(e.length != "undefined" || e != ""){
          var r = e.data;
          $.each(r, function(i,e){
            tmpLisAllBrands[i] = e;
          });
          
          const result = {};
          tmpLisAllBrands.forEach(brand => {
            // const firstChar = brand.name[0].toUpperCase();
            const firstChar = brand.name.charAt(0).toUpperCase();
            const initial = isNaN(firstChar) ? firstChar.toUpperCase() : '#';
            const brandGroup = document.getElementById(initial);
          
            if(!brandGroup){
          
              // console.error(`Brand group ${firstChar} not found.`);
              // return; // Skip this iteration          
              const newBrandGroup = document.createElement('div');
              newBrandGroup.classList.add('brand-group');
              newBrandGroup.id = firstChar;
              const header = document.createElement('h2');
              header.textContent = firstChar;
              newBrandGroup.appendChild(header);
              brandList.appendChild(newBrandGroup);
            }

            availableLetters.add(initial);

            // Check if the header for this group already exists
            const existingHeader = brandGroup.querySelector('h2');
            if(!existingHeader){
              const header = document.createElement('h2');
              header.textContent = isNaN(firstChar) ? firstChar.toUpperCase() : '#';
              brandGroup.appendChild(header);
            }

            const brandLink = document.createElement('a');
            brandLink.href = 'catalog?brand=' + brand.slug;
            brandLink.title = brand.name;
            brandLink.textContent = brand.name;
            brandLink.classList.add("brand-group-item");

            brandGroup.appendChild(brandLink);

            // Create filter button if it doesn't exist
            
            
            const existingFilterButton = filterButtonsContainer.querySelector(`button[data-letter="${initial}"]`);
            if (!existingFilterButton) {
              const filterButton = document.createElement('button');
              filterButton.textContent = initial;
              filterButton.setAttribute('data-letter', initial);
              filterButtonsContainer.appendChild(filterButton);
              let getAttrLetter = filterButton.getAttribute("data-letter");
              if(getAttrLetter == "#"){
                filterButton.classList.add("order-0");
              }
              // Add click event listener to filter buttons
              filterButton.addEventListener('click', () => {
                const groups = document.querySelectorAll('.brand-group');
                
                groups.forEach(group => {
                  if (group.id === initial) {
                    group.style.display = 'block';
                  } else {
                    group.style.display = 'none';
                  }
                });
              });

              // Check if the button corresponds to a numeric character
              if (/^\d/.test(firstChar)) {
                // filterButtonsContainer.insertBefore(numericButton, filterButton); // Insert the numeric button before the current button
                // filterButton.style.display = 'none'; // Hide the original numeric button
              }
            }
            

          });
          
        }else{
          console.log("Lo sentimos, hubo un error al obtener la información");
        }
      }
    });
  }
  // Disable unused filter buttons
  filterButtonsContainer.querySelectorAll('button').forEach(button => {
    const initialBtn = button.getAttribute('data-letter');
    // console.log(availableLetters);
    // console.log(availableLetters.size);
    // console.log(availableLetters.entries());
    if (!availableLetters.has(initialBtn)){
      // button.disabled = true;
    }else{
      button.disabled = false;
    }
    
  });
  */

  // Add click event listeners to filter buttons
  const filterButtons = document.querySelectorAll('.filter-button');
  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      const letter = button.textContent;
      const groups = document.querySelectorAll('.brand-group');
      
      groups.forEach(group => {
        if (group.id === letter) {
          group.style.display = 'block';
        } else {
          group.style.display = 'none';
        }
      });
    });
  });
});
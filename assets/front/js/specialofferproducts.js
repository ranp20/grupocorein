$(() => {
  $(document).ready(function (){
    // -------------- VALIDACIÓN DE POP-UP PARA BANNER DE ANUNCIO
    if(mainbs.is_announcement == 1){
      $('.announcement-banner').magnificPopup({
        type: 'inline',
        midClick: true,
        mainClass: 'mfp-fade',
        callbacks: {
          open: function (){
            $.magnificPopup.instance.close = function (){
              sessionStorage.setItem("announcement", "closed");
              $.magnificPopup.proto.close.call(this);
            };
          }
        }
      });
    }
    // -------------- CATEGORÍA (MÓVIL)
    $('#category_list .has-children .category_search span').on('click', function (e){
      e.preventDefault();
    });
    // -------------- BUSCADOR TOOGLE (MÓVIL)
    $('.close-m-serch').on('click', function (){
      $('.topbar .search-box-wrap').toggleClass('d-none');
    });
    $('.left-category-area .category-header').on('click', function (){
      $('.left-category-area .category-list').toggleClass("active")
    });
    $("[data-date-time]").each(function (){
      var $this = $(this),
      finalDate = $(this).attr("data-date-time");
      $this.countdown(finalDate, function (event){
        $this.html(
          event.strftime(
            `<span>%D<small>${language.Days}</small></span></small> <span>%H<small>${language.Hrs}</small></span> <span>%M<small>${language.Min}</small></span> <span>%S<small>${language.Sec}</small></span>`
          )
        );
      });
    });
    // Subscriber Form Submit
    $(document).on("submit", ".subscriber-form", function (e){
      e.preventDefault();
      var $this = $(this);
      var submit_btn = $this.find("button");
      submit_btn.find(".fa-spin").removeClass("d-none");
      $this.find("input[name=email]").prop("readonly", true);
      submit_btn.prop("disabled", true);
      $.ajax({
        method: "POST",
        url: $(this).prop("action"),
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data){
          if(data.errors){
            for (var error in data.errors){
              dangerNotification(data.errors[error]);
            }
          }else{
            if($this.hasClass("subscription-form")){
              $(".close-popup").click();
            }
            successNotification(data);
            $this.find("input[name=email]").val("");
          }
          submit_btn.find(".fa-spin").addClass("d-none");
          $this.find("input[name=email]").prop("readonly", false);
          submit_btn.prop("disabled", false);
        },
      });
    });
    // Subscriber Form Submit ENDS
    // Notifications
    function successNotification(title){
      $.notify(
        {
          title: ` <strong>${title}</strong>`,
          message: "",
          icon: "fas fa-check-circle",
        },
        {
          // settings
          element: "body",
          position: null,
          type: "success",
          allow_dismiss: true,
          newest_on_top: false,
          showProgressbar: false,
          placement: {
            from: "top",
            align: "right",
          },
          offset: 20,
          spacing: 10,
          z_index: 1031,
          delay: 5000,
          timer: 1000,
          url_target: "_blank",
          mouse_over: null,
          animate: {
            enter: "animated fadeInDown",
            exit: "animated fadeOutUp",
          },
          onShow: null,
          onShown: null,
          onClose: null,
          onClosed: null,
          icon_type: "class",
        }
      );
    }
    function dangerNotification(title){
      $.notify(
        {
          // options
          title: ` <strong>${title}</strong>`,
          message: "",
          icon: "fas fa-exclamation-triangle",
        },
        {
          // settings
          element: "body",
          position: null,
          type: "danger",
          allow_dismiss: true,
          newest_on_top: false,
          showProgressbar: false,
          placement: {
              from: "top",
              align: "right",
          },
          offset: 20,
          spacing: 10,
          z_index: 1031,
          delay: 5000,
          timer: 1000,
          url_target: "_blank",
          mouse_over: null,
          animate: {
              enter: "animated fadeInDown",
              exit: "animated fadeOutUp",
          },
          onShow: null,
          onShown: null,
          onClose: null,
          onClosed: null,
          icon_type: "class",
        }
      );
    };
    // Notifications Ends
    $(document).on('click', '.list-view', function (){
      let viewCheck = $(this).attr('data-step');
      let check = $(this);
      $('.list-view').removeClass('active');
      $('#search_form_specialofferproducts #view_check').val(viewCheck);
      $("#search_button_specialofferproducts").click();
      check.addClass('active');
    });
    // category wise product
    $(document).on('click', '.category_get,.product_get', function (){
      $('.' + this.className).removeClass('active');
      $(this).addClass('active');
      let geturl = $(this).attr('data-href');
      let view = $(this).attr('data-target');
      $('.' + view).removeClass('d-none');

      $.get(geturl, function (response){
        $('#' + view).html(response);
        $('.' + view).addClass('d-none');

        if(response.data === undefined){
          $('.' + view + '_not_found').removeClass('d-none');
        }else{
          $('.' + view + '_not_found').addClass('d-none');
        }
      });
    });
    // product quintity select js Start
    $(document).on('click', '.subclick', function (){
      let current_qty = parseInt($('.cart-amount').val());
      if(current_qty > 1){
        $('.cart-amount').val(current_qty - 1);
      }else{
        dangerNotification('La cantidad mínima debe ser 1');
      }
    });
    // product quintity select js Start
    $(document).on('click', '.addclick', function (){
      let current_stock = parseInt($('#current_stock').val());
      let current_qty = parseInt($('.cart-amount').val());
      if(current_stock == "unlimited" || current_stock == ""){
        $('.cart-amount').val(current_qty + 1);
      }else{
        if(current_qty < current_stock){
          $('.cart-amount').val(current_qty + 1);
        }else{
          dangerNotification('Cantidad máxima de producto es: '+current_stock);
        }
      }
    });
    $(document).on('keyup', '.cart-amount', function (){
      let current_stock = parseInt($('#current_stock').val());
      let key_val = parseInt($(this).val());
      if(current_stock == "unlimited" || current_stock == ""){
      }else{
        if(key_val > current_stock){
          dangerNotification('Cantidad máxima de producto es: '+current_stock);
          $('.cart-amount').val(current_stock);
        }
      }
      if(key_val <= 0){
        $('.cart-amount').val(1);
        dangerNotification('La cantidad mínima debe ser '+1);
      }
      if(current_stock == "unlimited" || current_stock == ""){
      }else{
        if(key_val > 0 && key_val < current_stock){
          $('.cart-amount').val(key_val);
        }
      }
    });
    $(document).on('click', '.wishlist_store', function (e){
      e.preventDefault();
      let wishlist_url = $(this).attr('href');
      $.get(wishlist_url, function (response){
        if(response.status == 0){
          location.href = response.link;
        }else if(response.status == 2){
          dangerNotification(response.message);
        }else{
          $('.wishlist1').addClass('d-none');
          $('.wishlist2').removeClass('d-none');
          $('.wishlist_count').text(response.count)
          successNotification(response.message);
        }
      })
    });
    // catalog js start
    $(document).on("click", ".brand-select", function (){
      $('.brand-select').prop('checked', false);
      let brand = $(this).val();
      $(this).prop('checked', true);
      $("#search_form_specialofferproducts #brand").val(brand);
      removePage();
      $("#search_button_specialofferproducts").click();
    });
    $(document).on("click", "#price_filter", function (){
      let min_price = parseInt($(".min_price").html());
      let max_price = parseInt($(".max_price").html());
      $("#search_form_specialofferproducts #minPrice").val(min_price);
      $("#search_form_specialofferproducts #maxPrice").val(max_price);
      removePage();
      $("#search_button_specialofferproducts").click();
    });
    $(document).on("change", "#sorting", function (){
      let sorting = $(this).val();
      $("#search_form_specialofferproducts #sorting").val(sorting);
      removePage();
      $("#search_button_specialofferproducts").click();
    });
    $(document).on("click", ".widget_price_filter", function (){
      let filter_prices = $(this).val();
      if(filter_prices){
        filter_prices = filter_prices.split(",");
        $("#search_form_specialofferproducts #minPrice").val(filter_prices[0]);
        $("#search_form_specialofferproducts #maxPrice").val(filter_prices[1]);
      }else{
        $("#search_form_specialofferproducts #minPrice").val('');
        $("#search_form_specialofferproducts #maxPrice").val('');
      }
      removePage();
      $("#search_button_specialofferproducts").click();
    });
    $(document).on('change', '#category_select', function (){
      let category = $(this).val();
      $('#search__category').val(category); // desktop
      $('#search__category-mob').val(category); // mobile
    });
    $(document).on('click', '#quick_filter li a', function (){
      $('#quick_filter li').removeClass('active');
      let filter = '';
      $(this).parent().addClass('active');
      if($(this).attr('data-href')){
        filter = $(this).attr('data-href');
      }else{
        filter = $(this).attr('data-href');
      }
      $("#search_form_specialofferproducts #quick_filter").val(filter);
      removePage();
      $("#search_button_specialofferproducts").click();
    });
    function removePage(){
      $("#search_form_specialofferproducts #page").val('');
    };
    $(document).on('click', '#category_list li a.category_search', function (){
      $('#category_list li').removeClass('active');
      let category = '';
      $(this).parent().addClass('active');
      if($(this).attr('data-href')){
        category = $(this).attr('data-href');
      }else{
        category = $(this).attr('data-href');
      }
      removePage();
      $("#search_form_specialofferproducts #childcategory").val('');
      $("#search_form_specialofferproducts #subcategory").val('');
      $("#search_form_specialofferproducts #category").val(category);
      $("#search_button_specialofferproducts").click();
    });
    $(document).on('click', '#subcategory_list li a.subcategory', function (){
      $('#subcategory_list li').removeClass('active');
      let category = '';
      $(this).parent().addClass('active');
      if($(this).attr('data-href')){
        category = $(this).attr('data-href');
      }else{
        category = $(this).attr('data-href');
      }
      $("#search_form_specialofferproducts #childcategory").val('');
      $("#search_form_specialofferproducts #subcategory").val(category);
      $("#search_button_specialofferproducts").click();
    });
    $(document).on('click', '#childcategory_list li a.childcategory', function (){
      $('#childcategory_list li').removeClass('active');
      let childcategory = '';
      $(this).parent().addClass('active');
      if($(this).attr('data-href')){
        childcategory = $(this).attr('data-href');
      }else{
        childcategory = $(this).attr('data-href');
      }
      removePage();
      $("#search_form_specialofferproducts #childcategory").val(childcategory);
      $("#search_button_specialofferproducts").click();
    });
    $(document).on('click', '#item_pagination .page-item .page-link', function (e){
      e.preventDefault();
      let pagination = $(this).text();
      let lastActive = parseInt($('#item_pagination .page-item.active .page-link').text());
      if(pagination == '›'){
        pagination = lastActive+1;  
      }else if(pagination == '‹'){
        pagination = lastActive -1; 
      }
      $("#search_form_specialofferproducts #page").val(pagination);
      $("#search_button_specialofferproducts").click();
    });
    $(document).on('click', '.option', function (){
      let option = [];
      $(this).parent().addClass('active');
      $("input.option").each(function (index){
        if($(this).is(':checked')){
          option.push($(this).val());
        }
      });
      removePage();
      $("#search_form_specialofferproducts #option").val(option);
      $("#search_button_specialofferproducts").click();
    });
    $(document).on('submit', '#search_form_specialofferproducts', function (e){
      e.preventDefault();

      let loader = `
      <div id="view_loader_div" class="">
      <div class="product-not-found">
      <img class="loader_image" src="${mainurl + '/assets/images/ajax_loader.gif'}" alt="">
      </div>
      </div>
      `;
      $('#list_view_ajax').html(loader);

      let form_url = $(this).attr('action');
      let method = $(this).attr('method');
      $.ajax({
        type: method,
        url: form_url,
        data: $(this).serialize(),
        success: function (data){
          window.scrollTo(0, 0);
          $('#list_view_ajax').html(data);
        }
      });
    });
    // catalog script end
    // rating from submit
    $(".ratingForm").on("submit", function (e){
      e.preventDefault();
      var $this = $(this);
      var submit_btn = $this.find("button");
      submit_btn.find(".fa-spin").removeClass("d-none");
      $this.find("textarea").prop("readonly", true);
      submit_btn.prop("disabled", true);
      $.ajax({
        method: "POST",
        url: $(this).prop("action"),
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data){
          if(data.errors){
            for (var error in data.errors){
              dangerNotification(data.errors[error]);
            }
          }else{
            successNotification(data);
            $this.find("textarea").val("");
          }

          $this.find("textarea").prop("readonly", false);
          submit_btn.prop("disabled", false);
          $(".modal_close").click();
        },
      });
    });
    // compare script start
    $(document).on("click", ".product_compare", function (){
      let compare_url = $(this).attr("data-target");
      $.get(compare_url, function (data){
        if(data.status == 1){
          successNotification(data.message);
        }else{
          dangerNotification(data.message);
        }
        $(".compare_count").text(data.compare_count);
      });
    });
    $(document).on("click", ".compare_remove", function (){
      let removeUrl = $(this).attr("data-href");
      $.get(removeUrl, function (){
        location.reload();
      });
    });
    // compare script end

    // cart script end
    $(document).on("submit", "#coupon_form", function (e){
      e.preventDefault();
      var form = $(this);
      var url = form.attr("action");
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function (data){
          if(data.status == true){
            successNotification(data.message);
            $("#view_cart_load").load(
              $("#cart_view_load").attr("data-target")
            );
          }else{
            dangerNotification(data.message);
          }
        },
      });
    });
    // user panel script start
    $(document).on("change", "#avater", function (){
      var file = event.target.files[0];
      var reader = new FileReader();
      reader.onload = function (e){
          $("#avater_photo_view").attr("src", e.target.result);
      };
      reader.readAsDataURL(file);
    });
    $('#submit_number').on('click', function (e){
      var link = $(this).data('href') + '?order_number=' + $('#order_number').val();
      $('#track-order').load(link);
      return false;
    });
  });
  $(document).on('change','#state_id_select',function(){
    var url = $('option:selected', this).attr('data-href');
    var state_id = $(this).val();
    $.get(url,function(response){
      $('.set__state_price_tr').removeClass('d-none');
      $('.set__state_price').text(response.state_price);
      $('.grand_total_set').text(response.grand_total);
      $('.state_id_setup').val(state_id);
    })
  });
  $(document).on('click', '#trams__condition', function (){
    if($(this).is(':checked')){
      $('#continue__button').attr('type', 'submit');
      $('#continue__button').prop('disabled', false);
    }else{
      $('#continue__button').attr('type', 'button');
      $('#continue__button').prop('disabled', true);
    }
  });
});
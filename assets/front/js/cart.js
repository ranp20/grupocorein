$(() => {
  // -------------- VALIDAR SI ES O NO UN OBJETO JSON
  function esJSON(texto) {
    try {
      JSON.parse(texto);
      return true;
    } catch (error) {
      return false;
    }
  }
  // -------------- ELIMINAR PRODUCTOS DE MANERA INDIVIDUAL...
  $(document).on("click",".remwithsvg", function(e){
    e.preventDefault();
    var csrfTokenFrm = $("#csl-fGv8n09c__sGaYs45").find("input[name='_token']").val();
    // alert(csrfTokenFrm);

    let idprod = $(this).parent().parent().find(".increaseQtycart").attr("data-target");
    let urlsend = $(this).attr("href");
    let clistItems = $(this).parent().parent().parent().find("tr");
    Swal.fire({
      title: '¿Estás seguro?',
      icon: 'warning',
      html: `<p class='font-w-300'>Se eliminará el producto del carrito.</p>`,
      showDenyButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      denyButtonText: `No, cancelar`,
    }).then((e) => {
      if(e.isConfirmed){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': csrfTokenFrm
          },
          type: 'GET',
          url: urlsend,
          // data: idprod,
          processData: false,
          contentType: false,
          beforeSend: function(){
            $("#cart_view_load").append(`
              <div class="d-flex align-items-center justify-content-center mx-auto c-LoadInCartList">
                <span>
                  <img src="./assets/images/Utilities/loader.gif" alt="icon-update" width="100" height="100" decoding="sync">
                </span>
              </div>
            `);
          },
          success: function(e){
            let res = JSON.parse(e);
            if(res.type == "success"){
              $.notify({
                // options
                title: `<strong>${res.mssg}</strong>`,
                message: '',
                icon: "fas fa-check-circle",
              },{
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
              });
              // if($("#ccksj934JBjFKScsKjs").length){
                $("#rnvc_cart").load(location.href + " #ccksj934JBjFKScsKjs");
              // }else{
              //   console.log("No existe el listado...");
              // }
              return false;
            }else{
              $.notify({
                // options
                title: `<strong>Hubo un error al eliminar el producto.</strong>`,
                message: '',
                icon: 'flaticon-alarm-1',
              },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                  from: "top",
                  align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
              });
              return false;
            }
          },
          complete: function(){
            requestSent = false;
          }
        });
      }else if(e.isDenied){
        // console.log('Se canceló la eliminación.');
      }else{

      }
    });


  });
  // -------------- ELIMINAR TODOS LOS PRODUCTOS DEL CARRITO...
  $(document).on("click",".remallwithoutic", function(e){
    e.preventDefault();
    var csrfTokenFrm = $("#csl-fGv8n09c__sGaYs45").find("input[name='_token']").val();
    // alert(csrfTokenFrm);

    let idprod = $(this).parent().parent().find(".increaseQtycart").attr("data-target");
    let urlsend = $(this).attr("href");
    let clistItems = $(this).parent().parent().parent().find("tr");
    Swal.fire({
      title: '¿Estás seguro?',
      icon: 'warning',
      html: `<p class='font-w-300'>Se eliminarán <strong>TODOS</strong> los productos del carrito.</p>`,
      showDenyButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      denyButtonText: `No, cancelar`,
    }).then((e) => {
      if(e.isConfirmed){
        
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': csrfTokenFrm
          },
          type: 'GET',
          url: urlsend,
          // data: idprod,
          processData: false,
          contentType: false,
          beforeSend: function(){
            
          },
          success: function(e){
            let res = JSON.parse(e);
            if(res.type == "success"){
              $.notify({
                // options
                title: `<strong>${res.mssg}</strong>`,
                message: '',
                icon: "fas fa-check-circle",
              },{
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
              });
              // if($("#ccksj934JBjFKScsKjs").length){
                $("#rnvc_cart").load(location.href + " #ccksj934JBjFKScsKjs");
              // }else{
              //   console.log("No existe el listado...");
              // }
              return false;
            }else{
              $.notify({
                // options
                title: `<strong>Hubo un error al eliminar el producto.</strong>`,
                message: '',
                icon: 'flaticon-alarm-1',
              },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                  from: "top",
                  align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
              });
              return false;
            }
          },
          complete: function(){
            requestSent = false;
          }
        });
        

      }else if(e.isDenied){
        // console.log('Se canceló la eliminación.');
      }else{

      }
    });


  });
  // -------------- NOTIFICACIONES
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
  }
  // -------------- DAR FORMATO A LOS NÚMEROS
  function number_format(number, decimals =2, dec_point, thousands_sep){
    // Strip all characters but numerical ones.
    number =(number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep =(typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec =(typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec){
          var k = Math.pow(10, prec);
          return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s =(prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if(s[0].length > 3){
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if((s[1] || '').length < prec){
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }
  // -------------- OBTENER EL ATRIBUTO SELECCIONADO
  function optionPrice(){
    let option_prices = $(".attribute_option :selected")
    .map(function(i, el){
      return $(el).attr("data-target");
    })
    .get();
    return option_prices;
  }
  // -------------- OBTENER LA SUMA DE PRECIOS EN OPCIONES EN EL PRODUCTO
  function optionPriceSum(options_prices){
    var price = 0;
    $.each(options_prices, function(i, v){
      price += parseFloat(v);
    });
    return price;
  }
  // -------------- VALIDACIÓN DE STOCK
  // -------------- DISMINUIR CANTIDAD DE PRODUCTOS (DETALLE DEL CARRITO)
  $(document).on('click', '.cartsubclick', function(el){
    let item_key = $(this).attr('data-target');
    let item_id = $(this).attr('data-id');
    let stocktoprodvalid = $(this).parent().find(".currentbyprod_stock").val();
    let current_qty = parseInt($(this).parent().find('.cartcart-amount').val());
    let qty = 0;
    if(stocktoprodvalid == "unlimited" || stocktoprodvalid == ""){
      if(current_qty > 1){
        qty = current_qty - 1;
        getDataInToCartList(1, item_key,item_id, qty, 0, el.currentTarget);
      }else{
        dangerNotification('La cantidad mínima debe ser 1');
      }
    }else{
      if(current_qty > 1){
        qty = current_qty - 1;
        getDataInToCartList(1, item_key,item_id, qty, 0, el.currentTarget);
      }else{
        dangerNotification('La cantidad mínima debe ser 1');
      }
    }
  });
  // -------------- INPUT DE CANTIDAD DE PRODUCTOS (DETALLE DEL CARRITO)
  $(document).on('keyup', '.cartcart-amount', function(){
    let stocktoprodvalid = $(this).parent().find(".currentbyprod_stock").val();
    let key_val = parseInt($(this).val());
    if(stocktoprodvalid == "unlimited" || stocktoprodvalid == ""){
    }else{
      let stocktoprodvalid_format = parseInt(stocktoprodvalid);
      if(key_val > stocktoprodvalid_format){
        dangerNotification('Cantidad máxima de producto es: '+stocktoprodvalid_format);
        $(this).val(stocktoprodvalid_format);
      }
    }
    if(key_val <= 0){
      $(this).val(1);
      dangerNotification('La cantidad mínima debe ser '+1);
    }
    if(stocktoprodvalid == "unlimited" || stocktoprodvalid == ""){
    }else{
      let stocktoprodvalid_format = parseInt(stocktoprodvalid);
      if(key_val > 0 && key_val < stocktoprodvalid_format){
        $(this).val(key_val);
      }
    }
  });
  // -------------- AÑADIR CANTIDAD DE PRODUCTOS (DETALLE DEL CARRITO)
  $(document).on('click', '.cartaddclick', function(el){
    let item_key = $(this).attr('data-target');
    let item_id = $(this).attr('data-id');
    let stocktoprodvalid = $(this).parent().find(".currentbyprod_stock").val();
    let current_qty = parseInt($(this).parent().find('.cartcart-amount').val());
    let qty = 0;
    if(stocktoprodvalid == "unlimited" || stocktoprodvalid == ""){
      qty = current_qty + 1;
      getDataInToCartList(1, item_key,item_id, qty, 0, el.currentTarget);
    }else{
      let stocktoprodvalid_format = parseInt(stocktoprodvalid);
      if(current_qty < stocktoprodvalid_format){
        qty = current_qty + 1;
        getDataInToCartList(1, item_key,item_id, qty, 0, el.currentTarget);
      }else{
        dangerNotification('Cantidad máxima de producto es: '+stocktoprodvalid_format);
      }
    }
  });
  // -------------- AGREGAR AL CARRITO
  function getDataInToCartList(status = 0, check = 0, item_key = 0, qty = 0, add_type = 0, elementthis){  
    
    let itemId;
    let type;
    if(check != 0){
      itemId = check;
      type = 1;
    }else{
      itemId = $("#item_id").val();
      type = 0;
    }

    let options_prices = optionPrice();
    let totalOptionPrice = parseFloat(optionPriceSum(options_prices));

    let quantity;
    quantity = parseInt(qty);
    if(isNaN(quantity)){
      quantity = 1;
    }
    if(qty != 0){
      quantity = qty;
    }

    let setCurrency = $(this).parent().find('input[data-id="set_currency"]').val();
    let currency_direction = $(this).parent().find('input[data-id="currency_direction"]').val();

    let demoPrice = parseFloat($(this).parent().find('input[data-id="demo_price"]').val());
    let subPrice = parseFloat(demoPrice + totalOptionPrice);
    let mainPrice = subPrice * quantity;
    mainPrice = number_format(mainPrice,2,decimal_separator,thousand_separator);
    if(currency_direction == 0){
      $(this).parent().find('input[data-id="main_price"]').html(mainPrice + setCurrency);
    }else{
      $(this).parent().find('input[data-id="main_price"]').html(setCurrency + mainPrice);
    }
    let submit_type = "from_cartlisting";

    // console.log("Estado: "+status);
    // console.log("ID producto: "+check);
    // console.log("Key producto: "+item_key);
    // console.log("Cantidad: "+qty);
    // console.log("Tipo de agregación: "+add_type);
    // console.log($(elementthis).parent().find(".cartcart-amount"));
    let headercartListLoaded = false;
    let cartListLoaded = false;
    if(status == 1){
      let addToCartUrl = `${mainurl}/product/add/cart?item_id=${itemId}&quantity=${quantity}&type=${type}&item_key=${item_key}&add_type=${add_type}&submit_type=${submit_type}`;
      // let asdas = `grupocorein/product/add/cart?item_id=4&quantity=119&type=1&item_key=4-&add_type=0&submit_type=from_cartlisting&_=1717976228670`;
      $.ajax({
        type: "GET",
        url: addToCartUrl,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
          $(".cart_count").text(data.qty);
          // -------------- Hacer un refresh del carrito de compras flotante en el header...
          // REFRESCAR SOLO UNA VEZ EL CARRITO, PREGUNTAR A CHATGPT CÓMO HACER PARA QUE SOLAMENTE SE REFRESQUE UNA VEZ AL USAR load()
          // OPCIÓN #1: SERÍA, CÓMO MANEJAR EL MÉTODO load() PARA QUE NO SE ESTÉ EJECUTANDO UNA Y OTRA VEZ Y/O APLICARLE ALGÚN PARÁMETRO PARA QUE SE EJECUTE SOLO UNA VEZ...
          // OPCIÓN #2: CUÁNDO SE TIENE MÁS DE UN load() DENTRO DE UNA FUNCIÓN, CÓMO MANEJARLOS PARA QUE SOLAMENTE SE REFRESQUEN UNA SOLA VEZ
          // $(".cart_view_header").load($("#header_cart_load").attr("data-target"));
          // $("#view_cart_load").load($("#cart_view_load").attr("data-target"));
          // OPCIÓN #3: QUE LOS ALERTS Y/O NOTIFICACIONES NO SE ENVÍEN UNA Y OTRA VEZ, PERO ESTO COMO ÚLTIMA ALTERNATIVA SI NADA FUNCIONA
          if(data.res.type == "success"){
            if(add_type == 1){
              location.href = mainurl + '/cart';
            }else{
              // -------------- HACER UN REFRESH DEL CARTHEADER...
              if(!headercartListLoaded){
                $(".cart_view_header").load($("#header_cart_load").attr("data-target"), function(){
                  headercartListLoaded = true;
                });
              }
              // -------------- HACER UN REFRESH DEL CART...
              if(!cartListLoaded){
                $("#view_cart_load").load($("#cart_view_load").attr("data-target"), function(){
                  successNotification(data.res.msg);
                  cartListLoaded = true;
                });
              }
            }
          }else if(data.res.type == "danger"){
            if(add_type == 1){
              location.href = mainurl + '/cart';
            }else{
              // -------------- HACER UN REFRESH DEL CARTHEADER...
              if(!headercartListLoaded){
                $(".cart_view_header").load($("#header_cart_load").attr("data-target"), function(){
                  headercartListLoaded = true;
                });
              }
              // -------------- HACER UN REFRESH DEL CART...
              if(!cartListLoaded){
                $("#view_cart_load").load($("#cart_view_load").attr("data-target"), function(){
                  dangerNotification(data.res.msg);
                  cartListLoaded = true;
                });
              }
            }
          }else{
            // -------------- HACER UN REFRESH DEL CARTHEADER...
            if(!headercartListLoaded){
              $(".cart_view_header").load($("#header_cart_load").attr("data-target"), function(){
                headercartListLoaded = true;
              });
            }
            // -------------- HACER UN REFRESH DEL CART...
            if(!cartListLoaded){
              $("#view_cart_load").load($("#cart_view_load").attr("data-target"), function(){
                dangerNotification('Error al procesar la información.');
                cartListLoaded = true;
              });
            }
          }          
        },
      });
    }
    

  }
});
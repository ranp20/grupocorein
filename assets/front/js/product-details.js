$(() => {
  $('#coupons-desc').modal({backdrop: 'static', keyboard: false})  
  // Cerrar modal...
  $(document).on("click","#mdl-CouponBtnClose",function(){
    clearInterval(updateInterval);
    $("#coupons-desc").modal("hide");
  });
  var csrfTokenFrm = $("#csl-fGv8n09c__sGaYs45").find("input[name='_token']").val();
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

  // ------------------- NUEVO CONTENIDO  
  $(document).on("change","#consult_departamento",function(){
    let departamento_id = $(this).val();
    let departamento_code = $('option:selected', this).attr('data-code');
    let url = $(this).attr('data-href');
    getProvinciaByIdDepartamento(url,departamento_code);
  });
  function getProvinciaByIdDepartamento(url,departamento_code){
    $.get(url+'?departamento_code='+departamento_code,function(data){
      if(data.length != "undefined"){
        if(data.data.length != 0 && data.data.length != "[]"){
          let response = data.data;
          let view_html = ``;
          $.each(response , function(i, e){
            view_html += `<option value="${e.id}" data-code="${e.provincia_code}">${e.provincia_name}</option>`;
          });
          let start = `<option value="">Elige Provincia</option>`;
          $('#consult_provincia').html(start+view_html);
        }else{
          let view_html = `<option value="">No hay información</option>`;
          $('#consult_provincia').html(view_html);
          let view_html2 = `<option value="">No hay información</option>`;
          $('#consult_distrito').html(view_html2);
        }
      }else{
        let view_html = `<option value="">No hay información</option>`;
        $('#consult_provincia').html(view_html);
      }
    });
  }
  $(document).on("change","#consult_provincia",function(){
    let provincia_id = $(this).val();
    let provincia_code = $('option:selected', this).attr('data-code');
    let url = $(this).attr('data-href');
    getDistritoByIdProvincia(url,provincia_code);
  });
  function getDistritoByIdProvincia(url,provincia_code){
    $.get(url+'?provincia_code='+provincia_code,function(data){
      if(data.length != "undefined"){
        if(data.data.length != 0 && data.data.length != "[]"){
          let response = data.data;
          let view_html = ``;
          $.each(response , function(i, e){
            view_html += `<option value="${e.id}" data-code="${e.distrito_code}">${e.distrito_name}</option>`;
          });
          let start = `<option value="">Elige Distrito</option>`;
          $('#consult_distrito').html(start+view_html);
        }else{
          let view_html = `<option value="">No hay información</option>`;
          $('#consult_distrito').html(view_html);
        }
      }else{
        let view_html = `<option value="">No hay información</option>`;
        $('#consult_distrito').html(view_html);
      }
    });
  }
  $(document).on("change","#consult_distrito",function(){
    let distrito_id = $(this).val();
    let url = $(this).attr('data-href');
    let selOptDepartamento = $("#consult_departamento option:selected").val();
    let selOptProvincia = $("#consult_provincia option:selected").val();
    if(selOptDepartamento != 0 && selOptDepartamento != "" && selOptProvincia != 0 && selOptProvincia != ""){
      getAmountDispatchByDistrito(url, selOptDepartamento, selOptProvincia, distrito_id);
    }else{
      // Ocultar los valores
    }
  });  
  function getAmountDispatchByDistrito(url, selOptDepartamento, selOptProvincia, distrito_id){
    $.get(url+'?departID='+selOptDepartamento+'&provID='+selOptProvincia+'&distrID='+distrito_id,function(data){
      if(data.length != "undefined"){
        if(data.data.length != 0 && data.data.length != "[]"){
          let response = data.data;
          let view_html = ``;
          let minAmmountformat = (Math.round(response.min_amount * 100) / 100).toFixed(2);

          view_html += `<div>
            <div><h4>Costo de envío, por monto menor a S/.1600.00 es: </h4></div>
            <div><h4><strong>S/. ${minAmmountformat}</strong></h4></div>
          </div>`;
          $('#svalgscirn45__3FgH3').html(view_html);
          
          $("#svalgscirn45__3FgH3").css({"display":"none"});
          $("#svalgscirn45__3FgH3").addClass('card-listenevent');
          $(`
            <div class="d-flex align-items-center justify-content-center mx-auto py-5 prchargeloader" style="max-width: 60px;width:60px;height:60px;">
              <img src="../assets/images/Utilities/loader.gif" alt="icon-update" width="100" height="100" decoding="sync">
            </div>
          `).insertBefore("#svalgscirn45__3FgH3");
          setTimeout(function(){
            $("#svalgscirn45__3FgH3").prev().remove();
            $("#svalgscirn45__3FgH3").removeClass('card-listenevent');
            $("#svalgscirn45__3FgH3").css({"display":"block"});
          }, 500);

        }else{
          let view_html = ``;
          $('#svalgscirn45__3FgH3').html(view_html);
        }
      }else{
        let view_html = ``;
        $('#svalgscirn45__3FgH3').html(view_html);
      }
    });
  }
  $(document).on("click",".variable-item",function(event){
    event.preventDefault();
    let dataHrefURL = $(this).data("href");
    let codeprod = $(this).attr("data-codeprod");
    let nameprod = $(this).attr("data-nameprod");
    $("#set_colr-code").val(codeprod);
    $("#set_colr-name").val(nameprod);
    if($(this).hasClass("tggle-select")){
      $(this).removeClass("tggle-select").siblings().removeClass("tggle-select");
      let dataColorsByProd = {
        "id_prod": $(this).attr('data-getsend'),
        "color_code": 0,
        "color_name": 0,
      };
      if(dataHrefURL != undefined){
        $.ajax({
          headers:{
            'X-CSRF-TOKEN': csrfTokenFrm
          },
          type: 'GET',
          url: dataHrefURL,
          data: {'id_prod':dataColorsByProd},
          success: function(e){
            if(e.res == "true"){
              $(".rst_varscolors__link").remove();
            }else{
              console.log("Error al eliminar los agregados");
            }
          }
        });
      }else{
        $("#rst_varscolors").html(``);
      }
    }else{
      $(this).addClass("tggle-select").siblings().removeClass("tggle-select");
      let dataColorsByProd = {
        "id_prod": $(this).attr('data-getsend'),
        "color_code": codeprod,
        "color_name": nameprod,
      };
      if(dataHrefURL != undefined){
        $.ajax({
          headers:{
            'X-CSRF-TOKEN': csrfTokenFrm
          },
          type: 'GET',
          url: dataHrefURL,
          data: {'id_prod':dataColorsByProd},
          success: function(e){
            if(e.res == "true"){
              // $(".rst_varscolors__link").remove();
            }else{
              console.log("Error al eliminar los agregados");
            }
          }
        });
      }else{
        $("#rst_varscolors").html(``);
      }
    }
    // $(this).toggleClass("tggle-select").siblings().removeClass("tggle-select");
    var siblingCount = $(this).parent().find(".tggle-select").length;
    if(siblingCount != 0){
      $("#rst_varscolors").html(`<a class="rst_varscolors__link" href="javascript:void(0);">Limpiar</a>`);
    }else{
      $("#rst_varscolors").html(``);
    }
    $("#aHJ8K4__98Gas").html(codeprod);
  });
  $(document).on("click",".rst_varscolors__link",function(evt){
    evt.preventDefault();
    $.each($(".variable-item"), function(i,e){
      $(this).removeClass("tggle-select");
    });
    $("#aHJ8K4__98Gas").html($("#prod-crr_sku").val());
    let dataHrefURL = $(this).data("href");
    if(dataHrefURL != undefined){
      $.ajax({
        headers:{
          'X-CSRF-TOKEN': csrfTokenFrm
        },
        type: 'GET',
        url: dataHrefURL,
        data: {'id_prod':$(this).attr('data-getsend')},
        success: function(e){
          console.log(e);
          if(e.res == "true"){
            $(".rst_varscolors__link").remove();
          }else{
            console.log("Error al eliminar los agregados");
          }
        }
      });
    }else{
      $(".rst_varscolors__link").remove();
    }
    
  });
  // ---------- ZOOM Y CAROUSEL PARA IMÁGENES CON BACKDROP
  /*
  Fancybox.bind('[data-fancybox="gallery"]', {
    Toolbar: {
      display: {
        left: ["infobar"],
        middle: [
          "zoomIn",
          "zoomOut",
          "toggle1to1",
          // "toggleZoom",
          // "zoomToMax",
          // "iterateZoom",
          "panLeft",
          "panRight",
          "panUp",
          "panDown",
          "rotateCCW",
          "rotateCW",
          "flipX",
          "flipY",
          "fitX",
          "fitY",
          "reset",
          "toggleFS"
        ],
        right: ["slideshow", "fullscreen", "thumbs", "close"],
      },
    },
  });
  */

  // var index = 0;
  // var $thumbs  = $('.thumbs').children();
  // var $primary = $('*[data-fancybox="gallery"]');

  // $primary.on('click', function() {
  //   // Clone thumbs object
  //   var $what = $.extend({}, $thumbs);
  //   // Replace corresponding link inside thumbs with primary  
  //   $what[ index ] = this;
  //   // Open fancyBox manually
  //   $.fancybox.open( $what, {}, index );
  //   return false;
  // });

  // $thumbs.mouseover(function() {
  //   // Find index
  //   index = $thumbs.index( this );
  //   // Update primary link
  //   $primary.attr('href', $(this).attr('href'));
  //   $primary.find('img').attr('src', $(this).find('img').attr('src') );
  // });

  // $(".cntAds--i__itm--cInfo figure").on( "mouseenter", function(){
  //   $(this).parent().parent().addClass("hoverInFigure");
  // }).on( "mouseleave", function(){
  //   $(this).parent().parent().removeClass("hoverInFigure");
  // });
  // IMPLEMENTANDO MAGICZOOMPLUS Y ALGUNAS FUNCIONES PARA LA GALERÍA...
  const scrollContainer = document.querySelector('.cGalleryScroll__c');
  let isMouseDown = false;
  let startX;
  let scrollLeft;
  scrollContainer.addEventListener('mousedown', (e) => {
    isMouseDown = true;
    startX = e.pageX - scrollContainer.offsetLeft;
    scrollLeft = scrollContainer.scrollLeft;
  });
  scrollContainer.addEventListener('mouseleave', () => {
    isMouseDown = false;
  });
  scrollContainer.addEventListener('mouseup', () => {
    isMouseDown = false;
  });
  scrollContainer.addEventListener('mousemove', (e) => {
    if (!isMouseDown) return;
    e.preventDefault();
    const x = e.pageX - scrollContainer.offsetLeft;
    const walk = (x - startX) * 1.5; // Adjust the scroll speed as needed
    scrollContainer.scrollLeft = scrollLeft - walk;
  });
  scrollContainer.addEventListener('touchstart', (e) => {
    isMouseDown = true;
    startX = e.touches[0].pageX - scrollContainer.offsetLeft;
    scrollLeft = scrollContainer.scrollLeft;
  });
  scrollContainer.addEventListener('touchend', () => {
    isMouseDown = false;
  });
  scrollContainer.addEventListener('touchcancel', () => {
    isMouseDown = false;
  });
  scrollContainer.addEventListener('touchmove', (e) => {
    if (!isMouseDown) return;
    e.preventDefault();
    const x = e.touches[0].pageX - scrollContainer.offsetLeft;
    const walk = (x - startX) * 1.5; // Adjust the scroll speed as needed
    scrollContainer.scrollLeft = scrollLeft - walk;
  });
  const scrollContainer2 = $('.cGalleryScroll');
  const content2 = $('.cGalleryScroll__c');
  const scrollButtons = $('.scroll-btn');
  const itemWidth = content2.find('.item').outerWidth(true); // Width of each item including margin
  $('.scroll-btn').on('click', function() {
    const isPrev = $(this).hasClass('prev');
    const scrollAmount = isPrev ? -itemWidth : itemWidth;
    const animationSpeed = 300; // You can use 'fast', 'slow', or a specific duration in milliseconds
    if (isPrev) {
    content2.animate({
      scrollLeft: '-=' + itemWidth
    }, animationSpeed);
    } else {
    content2.animate({
      scrollLeft: '+=' + itemWidth
    }, animationSpeed);
    }
    return false;
  });
  // APLICAR CUPÓN DE DESCUENTO DE ACUERDO AL PRODUCTO...
  // $(document).on("click","#accepcouponvalid",function(){
  //   if($(this).is("checked")){
  //     alert("Aplicar el cupón");
  //   }else{
  //     console.log("NADA");
  //   }
  // });
});
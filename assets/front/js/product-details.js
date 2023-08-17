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
  $(document).on("click",".variable-item",function(){
    let codeprod = $(this).attr("data-codeprod");
    $("#aHJ8K4__98Gas").html(codeprod);
  });
});
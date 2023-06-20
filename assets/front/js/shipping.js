$(() => {  
  var locationsGET = window.location.href;
  var csrfTokenFrm = $("#checkoutShipping").find("input[name='_token']").val();
  // ------------------- NUEVO CONTENIDO  
  $(document).on("change","#billing-departamento",function(){
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
          $('#billing-provincia').html(start+view_html);
        }else{
          let view_html = `<option value="">No hay información</option>`;
          $('#billing-provincia').html(view_html);
        }
      }else{
        let view_html = `<option value="">No hay información</option>`;
        $('#billing-provincia').html(view_html);
      }
    });
  }
  $(document).on("change","#billing-provincia",function(){
    let provincia_id = $(this).val();
    let provincia_code = $('option:selected', this).attr('data-code');
    let url = $(this).attr('data-href');
    getDistritoByIdCiudad(url,provincia_code);
  });
  function getDistritoByIdCiudad(url,provincia_code){
    $.get(url+'?provincia_code='+provincia_code,function(data){
      if(data.length != "undefined"){
        if(data.data.length != 0 && data.data.length != "[]"){
          let response = data.data;
          let view_html = ``;
          $.each(response , function(i, e){
            view_html += `<option value="${e.id}" data-code="${e.distrito_code}">${e.distrito_name}</option>`;
          });
          let start = `<option value="">Elige Distrito</option>`;
          $('#billing-distrito').html(start+view_html);
        }else{
          let view_html = `<option value="">No hay información</option>`;
          $('#billing-distrito').html(view_html);
        }
      }else{
        let view_html = `<option value="">No hay información</option>`;
        $('#billing-distrito').html(view_html);
      }
    });
  }  
});
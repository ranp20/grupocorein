$(() => {
  /*
  var locationsGET = window.location.href;
  var csrfTokenFrm = $("#cTentr-af1698__p").parent().find("input[name='_token']").val();

  getAllDepartamentos();  
  var tmpListDepartamentos = ``;
  function getAllDepartamentos(){
    // e.preventDefault();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': csrfTokenFrm
      },
      url: locationsGET+"/departamento",
      type: "POST",
      dataType: "JSON",
      success: function(e){
        if(e.length != "undefined" || e != ""){
          var r = e.data;
          var tmpFor = ``;
          $.each(r, function(i,e){
            tmpFor += `<option value="${e.id}" data-code="${e.departamento_code}">${e.departamento_name}</option>`;
          });
          let start = `<option value="">Elige Departamento</option>`;
          tmpListDepartamentos = start + tmpFor;
        }else{
          console.log("Lo sentimos, hubo un error al obtener la información");
        }
      }
    });
  }

  // ------------------- NUEVO CONTENIDO  
  $(document).on("change","#reg-departamento",function(){
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
          $('#reg-provincia').html(start+view_html);
        }else{
          let view_html = `<option value="">No hay información</option>`;
          $('#reg-provincia').html(view_html);
        }
      }else{
        let view_html = `<option value="">No hay información</option>`;
        $('#reg-provincia').html(view_html);
      }
    });
  }

  $(document).on("change","#reg-provincia",function(){
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
          $('#reg-distrito').html(start+view_html);
        }else{
          let view_html = `<option value="">No hay información</option>`;
          $('#reg-distrito').html(view_html);
        }
      }else{
        let view_html = `<option value="">No hay información</option>`;
        $('#reg-distrito').html(view_html);
      }
    });
  }
  */
});
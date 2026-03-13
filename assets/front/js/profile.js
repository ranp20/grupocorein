$(() => {
  let _tokenfrm = $("#csl-fGv8n09c__sGaYs45").find("input[name='_token']").val();
  // ------------ SHOW/HIDDEN PASSWORD
  $(document).on("click", "div.fnc-icon_passCtrl", function(){
    var inputTypeControlPass1 = $(this).parent().find("input").attr("type");
    if(inputTypeControlPass1 == "password"){
      $(this).parent().find("input").attr("type", "text");
      $(this).html(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="cAccount__cont--fAccount--form--controls--cIcon--pass"><path d="M12.015 7c4.751 0 8.063 3.012 9.504 4.636-1.401 1.837-4.713 5.364-9.504 5.364-4.42 0-7.93-3.536-9.478-5.407 1.493-1.647 4.817-4.593 9.478-4.593zm0-2c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 3c-2.209 0-4 1.792-4 4 0 2.209 1.791 4 4 4s4-1.791 4-4c0-2.208-1.791-4-4-4z" /></svg>`);
    }else{
      $(this).parent().find("input").attr("type", "password");
      $(this).html(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="cAccount__cont--fAccount--form--controls--cIcon--pass"><path d="M19.604 2.562l-3.346 3.137c-1.27-.428-2.686-.699-4.243-.699-7.569 0-12.015 6.551-12.015 6.551s1.928 2.951 5.146 5.138l-2.911 2.909 1.414 1.414 17.37-17.035-1.415-1.415zm-6.016 5.779c-3.288-1.453-6.681 1.908-5.265 5.206l-1.726 1.707c-1.814-1.16-3.225-2.65-4.06-3.66 1.493-1.648 4.817-4.594 9.478-4.594.927 0 1.796.119 2.61.315l-1.037 1.026zm-2.883 7.431l5.09-4.993c1.017 3.111-2.003 6.067-5.09 4.993zm13.295-4.221s-4.252 7.449-11.985 7.449c-1.379 0-2.662-.291-3.851-.737l1.614-1.583c.715.193 1.458.32 2.237.32 4.791 0 8.104-3.527 9.504-5.364-.729-.822-1.956-1.99-3.587-2.952l1.489-1.46c2.982 1.9 4.579 4.327 4.579 4.327z"/></svg>`);
    }
  });
  var locationsGET = window.location.href;
  var csrfTokenFrm = $(".subscriber-form").find("input[name='_token']").val();
  /*
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
 // ------------ FORMATO - SÓLO DÍGITOS PARA LOS ELEMENTOS CREADOS DESPUÉS DE CARGADO EL DOM
  $(document).on("input keyup keypress","input[data-valformat=onlydigits]", function(){
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
  // ----------- ACTUALIZAR ICONO DE USUARIO
  $(document).on("change","#photo_avataruser-front",function(e){
    let readerImg = new FileReader();
    let contUploadView = $("#avater_photo_view");
    if(e.target.files[0] == undefined || e.target.files[0] == "undefined"){
      $("#avater_photo_view").attr("src", "../assets/images/placeholder.png");
    }else{
      let changeIconUserUrl = $(this).attr("data-href");
      var formData = new FormData();
      var file = e.target.files[0];
      formData.append('photo', file);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': _tokenfrm
        },
        type: 'POST',
        url: changeIconUserUrl,
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function(){
          $(`<span class="c_changeloader-1">
          <span></span>
        </span>`).insertBefore("#avater_photo_view");
        },
        success: function(res){
          $("#avater_photo_view").prev().remove();
          if(res != ""){
            let data = JSON.parse(res);
            if(data.type == "success"){
              successNotification(data.mssg);
            }else{
              dangerNotification(data.mssg);
            }
          }else{
            dangerNotification('Hubo un error al actualizar el avatar.');
          }
        },
      });

      readerImg.readAsDataURL(e.target.files[0]);
      readerImg.onload = function(){
        contUploadView.attr("src", readerImg.result);
      }
    }
  });
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
  }
});
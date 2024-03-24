$(() => {
  var locationsGET = window.location.href;
  var csrfTokenFrm = $("#cTentr-af1698__p").parent().find("input[name='_token']").val();
  // ------------ FORMATO - SEPARADOR DE NÚMERO TELEFÓNICO(+51)
  $(document).on("input keyup keypress", "input[data-valformat=withspacesforthreenumbers]", function(e){
    let val = e.target.value;
    let lengthVal = $(this).val().replace(/ /g,'').length;
    if($(this).attr("maxlength") <= 9){
      $(this).val(val.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{3})/, '$1 $2 $3'));
    }else if(lengthVal <= 9){
      $(this).val(val.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{3})/, '$1 $2 $3'));
    }else{
      $(this).val(val.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{3})/, '$1 $2 $3'));
    }
  });
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
  // ------------ CONFIRMAR CONTRASEÑA (VALIDACIÓN)
  $(document).on("input keyup keypress", "#reg-pass-confirm", function(e){
    var valPassFirst = $("#reg-pass").val();
    var lengthPassFirst = $("#reg-pass").val().length;
    let valThis = e.target.value;
    let lengthThis = e.target.value.length;
    let thisFrmSubmit = $(this).parent().parent().parent().find("*[type=submit]");
    if(lengthThis == lengthPassFirst || lengthThis > lengthPassFirst){
      if(valThis == valPassFirst){
        thisFrmSubmit.removeClass("not-process");
        $("#mssg_cConfirmTwoPass").text("Las contraseñas coinciden*");
        $("#mssg_cConfirmTwoPass").removeClass("mssgSpn__error-mssg");
        $("#mssg_cConfirmTwoPass").addClass("mssgSpn__success-mssg");
        setTimeout(() => { $("#mssg_cConfirmTwoPass").text(""); }, 2600); // Desaparecer mensaje...
      }else{
        thisFrmSubmit.addClass("not-process");
        $("#mssg_cConfirmTwoPass").text("Las contraseñas NO coinciden*");
        $("#mssg_cConfirmTwoPass").removeClass("mssgSpn__success-mssg");
        $("#mssg_cConfirmTwoPass").addClass("mssgSpn__error-mssg");
      }
    }else{
      thisFrmSubmit.addClass("not-process");
      $("#mssg_cConfirmTwoPass").text("");
      // console.log("No es igual."); // Si se desea mostrar el mensaje a medida que el usuario escribe antes de la validación de la longitud...
    }
  });
  
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

  $(document).on("click","#reg-enterprise", function(){
    if($(this).is(":checked")){
      $(this).val("on");
      
      var tmpEnterprise = `
      <div class="col-sm-12">
        <h3 class="widget-title">Datos Personales</h3>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
          <label for="reg-address1">Dirección 1</label>
          <input class="form-control" type="text" name="reg_address1" placeholder="Dirección 1" id="reg-address1" value="" required>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
          <label for="reg-address2">Dirección 2 (Opcional)</label>
          <input class="form-control" type="text" name="reg_address2" placeholder="Dirección 2" id="reg-address2" value="" required>
        </div>
      </div>
      <div class="col-sm-12">
        <h3 class="widget-title">Datos de Empresa</h3>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-ruc">RUC</label>
          <input class="form-control" type="text" name="reg_ruc" placeholder="RUC" id="reg-ruc" value="" required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-razosocial">Razón social</label>
          <input class="form-control" type="text" name="reg_razonsocial" placeholder="Razón social" id="reg-razosocial" value="" required>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
          <label for="reg-addressfiscal">Dirección Fiscal</label>
          <input class="form-control" type="text" name="reg_addressfiscal" placeholder="Dirección Fiscal" id="reg-addressfiscal" value="" required>
        </div>
      </div>
      <div class="col-sm-12">
        <h3 class="widget-title">Dirección de Envío</h3>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-codepostal">Código Postal</label>
          <input class="form-control" type="text" name="reg_codepostal" placeholder="Código Postal" id="reg-codepostal" value="" required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-country">País</label>
          <select class="form-control" name="reg_country" id="reg-country" required>
            <option selected value="">Elige País</option>
            <option value="1">Perú</option>
          </select>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-departamento">Departamento</label>
          <select class="form-control" name="reg_departamento" id="reg-departamento" data-href="${locationsGET + '/provincia'}" required>
            ${tmpListDepartamentos}
          </select>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-provincia">Provincia</label>
          <select class="form-control" name="reg_provincia" id="reg-provincia" data-href="${locationsGET + '/distrito'}" required></select>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-distrito">Distrito</label>
          <select class="form-control" name="reg_distrito" id="reg-distrito" required></select>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="reg-streetaddress">Calle</label>
          <input class="form-control" type="text" name="reg_streetaddress" placeholder="Calle" id="reg-streetaddress" value="" required>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
          <label for="reg-referenceaddress">Referencia (Opcional)</label>
          <input class="form-control" type="text" name="reg_referenceaddress" placeholder="Referencia" id="reg-referenceaddress" value="">
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
          <label for="reg-addresseeaddress">Destinatario (Opcional)</label>
          <input class="form-control" type="text" name="reg_addresseeaddress" placeholder="Destinatario" id="reg-addresseeaddress" value="">
        </div>
      </div>
      `;
      $("#cTentr-af1698__p").html(tmpEnterprise);
    }else{
      $(this).val("off");
      $("#cTentr-af1698__p").html("");
    }
  });

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
});
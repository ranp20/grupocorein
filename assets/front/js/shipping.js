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
  $(document).on("change","#billing-distrito",function(){
    let distrito_id = $(this).val();
    let distrito_code = $('option:selected', this).attr('data-code');
    let url = $(this).attr('data-href');
    getUpdateAmountOrder(url,distrito_code);
  });
  function getUpdateAmountOrder(url,distrito_code){
    $.get(url+'?distrito_code='+distrito_code,function(data){
      if(data.length != "undefined"){
        if(data.data.length != 0 && data.data.length != "[]"){
          $("#crdLEvent__sd343fg-34Gas").addClass('card-listenevent');
          setTimeout(function(){
            $("#crdLEvent__sd343fg-34Gas").removeClass('card-listenevent');
          }, 500);
          $("#tblCrtReview-hd46_asdFHG54").html(`
            <div class="d-flex align-items-center justify-content-center mx-auto py-5" style="max-width: 60px;width:60px;height:60px;">
              <img src="../../assets/images/Utilities/loader.gif" alt="icon-update" width="100" height="100" decoding="sync">
            </div>
          `);
          setTimeout(function(){
            let r = data.data;
            let view_html = `
            <table class="table">
            <tbody>
            <tr>
              <td>Subtotal:</td>
              <td class="fw-bold spnLstCart__fz1 text-gray-dark">${r.carttotal}</td>
            </tr>
            <tr>
              <td>Envío:</td>
              <td class="text-gray-dark">
                <div class="cInfAmmtCart">
                  <div class="cInfAmmtCart__c">
                    <span class="fw-bold spnLstCart__fz1" id="cInfAmmtCart__c-346hg">${r.amountaddress}</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td class="text-lg text-primary">Total del pedido</td>
              <td class="fw-bold spnLstCart__fz2 text-lg text-primary grand_total_set">${r.totalamount}</td>
            </tr>
            </tbody>
            </table>
            `;
            $('#tblCrtReview-hd46_asdFHG54').html(view_html);
          }, 250);
        }else{
          $('#tblCrtReview-hd46_asdFHG54').html(view_html);
        }
      }else{
        $('#tblCrtReview-hd46_asdFHG54').html(view_html);
      }
    });
  }
});
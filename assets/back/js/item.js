$(() => {
  var locationsGET = window.location.href;
  var locationGETArray = locationsGET.split("/");
  var locationGETFormat = locationGETArray[0]+
                          locationGETArray[1]+'//'+
                          locationGETArray[2]+'/'+
                          locationGETArray[3]+'/'+
                          locationGETArray[4]+'/'+
                          locationGETArray[5];
  var csrfTokenFrm = $("#iptc-A3gs4FS_token").find("input[name='_token']").val();
  var taxesObj = [];
  
  getAllTaxes();
  function getAllTaxes(){
    // e.preventDefault();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': csrfTokenFrm
      },
      url: locationGETFormat+"/taxes",
      type: "POST",
      dataType: "JSON",
      success: function(e){
        if(e.length != "undefined" || e != ""){
          var r = e.data;
          var tmpFor = ``;
          $.each(r, function(i,e){
            taxesObj.push(e.value);
          });
        }else{
          console.log("Lo sentimos, hubo un error al obtener la información");
        }
      }
    });
  }  
  $(document).on("keyup", "input[data-valformat=withcomedecimal]", function(e){
    let val = e.target.value;
    let val_formatNumber = val.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    let val_formatNumberWithoutCome = val_formatNumber.replace(",","");
    $(this).val(val_formatNumber);
    let incIGV = taxesObj[0];
    let sincIGV = taxesObj[1];
    let incIGVFormat = taxesObj[0] / 100;
    let sincIGVFormat = taxesObj[1];
    let incIGVFormatOpe = parseFloat(val_formatNumberWithoutCome) + incIGVFormat;
    $("#c-prevammt__igvGs23s").text('S/. '+val_formatNumber);
  });
  $(document).on("change","#sections_id",function(){
    let tId = $(this).val();
    if(tId == 1){
      var tmpSelSection = `
      <div class="form-group pb-0">
        <label for="on-sale-price">En Promoción *</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">S/.</span>
          </div>
          <input type="text" data-valformat="withcomedecimal" id="on-sale-price" name="on_sale_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="" required>
        </div>
      </div>
      <div class="py-0 pt-0 form-group cPreviewAmmountIGV">
        <span style="display:block;"><strong>INCLUYE IGV: </strong></span>
        <span>Monto Final: </span>
        <span id="c-prevammt__igvGs23s">S/. 0.00</span>
      </div>
      `;
      $("#cTentr-af1698__p-adm").html(tmpSelSection);
    }else if(tId == 2){
      var tmpSelSection = `
      <div class="form-group pb-0">
        <label for="special-offer-price">Oferta Especial *</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">S/.</span>
          </div>
          <input type="text" data-valformat="withcomedecimal" id="special-offer-price" name="special_offer_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="" required>
        </div>
      </div>
      <div class="py-0 pt-0 form-group cPreviewAmmountIGV">
        <span style="display:block;"><strong>INCLUYE IGV: </strong></span>  
        <span>Monto Final: </span>
        <span id="c-prevammt__igvGs23s">S/. 0.00</span>
      </div>
      `;
      $("#cTentr-af1698__p-adm").html(tmpSelSection);
    }else{
      $("#cTentr-af1698__p-adm").html("");
    }
  });
});
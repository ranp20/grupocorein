$(() => {
  // alert("asdasd");
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
  // --------------- KEYUP INPUTS NAME = ITEM-NAME - TEXT
  $(document).on("keyup keypress input","input.item-name",function(e){
    var val = e.target.value;
    if(val != ""){
      getNameofProduct(encodeURIComponent(val));
    }
  });
  function getNameofProduct(productname){
    // e.preventDefault();
    var mssageAlertProd = "";
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': csrfTokenFrm
      },
      url: locationGETFormat+"/getproductname/"+productname,
      type: "GET",
      dataType: "JSON",
      success: function(e){
        if(e.length != "undefined" || e != ""){
          var r = e.data;
          if(r == "equals"){
            $("input.item-name").addClass("equals-values");
            $("#spn__iptequalsmssg").addClass("active");
            $("#spn__iptequalsmssg").text("El nombre del producto es idéntico a otro ya ingresado. Por favor, ingrese un nuevo nombre*");
          }else{
            $("input.item-name").removeClass("equals-values");
            $("#spn__iptequalsmssg").removeClass("active");
            $("#spn__iptequalsmssg").text("");
          }
        }else{
          console.log("Lo sentimos, hubo un error al obtener la información");
        }
      }
    });
    return mssageAlertProd;
  }

  $(document).on("keyup", "input[data-valformat=withcomedecimal]", function(e){
    let val = e.target.value;
    let val_formatNumber = val.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    let val_formatNumberWithoutCome = val_formatNumber.replace(/,/g,"");
    $(this).val(val_formatNumber);
    let incIGV = taxesObj[0];
    let sincIGV = taxesObj[1];
    let incIGVFormat = incIGV / 100;
    let sincIGVFormat = sincIGV;
    let incIGVFormatOpe = parseFloat(val_formatNumberWithoutCome);
    let incIGVFormatOpeMoreIGV = incIGVFormatOpe * incIGVFormat;
    let incIGVFormatOpeMoreIGVCalc = incIGVFormatOpe + incIGVFormatOpeMoreIGV;
    let val_formatNumberWithIGV = incIGVFormatOpeMoreIGVCalc.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $("#c-prevammt__igvGs23s").text('S/. '+val_formatNumberWithIGV);
  });
  function addIGVintoTag(elementOrTag){
    let val_formatNumberWithoutCome = elementOrTag.replace(/,/g,"");
    let incIGV = taxesObj[0];
    let incIGVFormat = incIGV / 100;
    let incIGVFormatOpe = parseFloat(val_formatNumberWithoutCome);
    let incIGVFormatOpeMoreIGV = incIGVFormatOpe * incIGVFormat;
    let incIGVFormatOpeMoreIGVCalc = incIGVFormatOpe + incIGVFormatOpeMoreIGV;
    let val_formatNumberWithIGV = incIGVFormatOpeMoreIGVCalc.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return val_formatNumberWithIGV;
  }
  $(document).on("change","#tax_id",function(){
    let tId = $(this).val();
    // console.log(tId);
    if(tId != "" && tId != 0 && tId == 1){
      $(".c_cPreviewAmmountIGV").html(`
      <div class="py-0 pt-0 form-group cPreviewAmmountIGV">
        <span style="display:block;"><strong>INCLUYE IGV: </strong></span>
        <span>Monto Final: </span>
        <span id="c-prevammt__igvGs23s">S/. ${addIGVintoTag($("input[data-archorigv='product']").val())}</span>
      </div>
      `);
    }else{
      $(".c_cPreviewAmmountIGV").html("");
    }
  });
  $(document).on("click","input[name=sections_id]",function(){
    let tId = $(this).val();
    if(tId == 1){
      var tmpSelSection = `
      <div class="form-group pb-0">
        <label for="on-sale-price">En Promoción *</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">S/.</span>
          </div>
          <input type="text" data-valformat="withcomedecimal" data-archorigv="product" id="on-sale-price" name="on_sale_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="" required>
        </div>
      </div>
      <div class="c_cPreviewAmmountIGV">
        <div class="py-0 pt-0 form-group cPreviewAmmountIGV">
          <span style="display:block;"><strong>INCLUYE IGV: </strong></span>
          <span>Monto Final: </span>
          <span id="c-prevammt__igvGs23s">S/. 0.00</span>
        </div>
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
          <input type="text" data-valformat="withcomedecimal" data-archorigv="product" id="special-offer-price" name="special_offer_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="" required>
        </div>
      </div>
      <div class="c_cPreviewAmmountIGV">
        <div class="py-0 pt-0 form-group cPreviewAmmountIGV">
          <span style="display:block;"><strong>INCLUYE IGV: </strong></span>  
          <span>Monto Final: </span>
          <span id="c-prevammt__igvGs23s">S/. 0.00</span>
        </div>
      </div>
      `;
      $("#cTentr-af1698__p-adm").html(tmpSelSection);
    }else{
      $("#cTentr-af1698__p-adm").html("");
    }
  });
  // --------------- KEYUP INPUTS ESPECIFICATIONS - TEXT
  $(document).on("keyup","input[name='specification_name[]']",function(e){
    let val = e.target.value;
    let btnAddSpecification = $(this).parent().parent().parent().find(".add-specification");
    btnAddSpecification.attr('data-text', val);
  });
  // --------------- KEYUP INPUTS ESPECIFICATIONS - DESCRIPTION
  $(document).on("keyup","input[name='specification_description[]']",function(e){
    let val = e.target.value;
    let btnAddSpecification = $(this).parent().parent().parent().find(".add-specification");
    btnAddSpecification.attr('data-text1', val);
  });
  // --------------- ADD ESPECIFICATIONS
  $('.add-specification').on('click',function(){
    var text = $(this).parent().parent().parent().find("input[name='specification_name[]").val();
    var text1 = $(this).parent().parent().parent().find("input[name='specification_description[]").val();
    $('#specifications-section').append(`
    <div class="d-flex">
      <div class="flex-grow-1">
        <div class="form-group">
          <input type="text" class="form-control" name="specification_name[]" placeholder="${text}" value="${text}">
        </div>
      </div>
      <div class="flex-grow-1">
        <div class="form-group">
          <input type="text" class="form-control" name="specification_description[]" placeholder="${text1}" value="${text1}">
        </div>
      </div>
      <div class="flex-btn">
        <button type="button" class="btn btn-danger remove-spcification">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    `);
    $(this).data('text', '');
    $(this).data('text1', '');
    // $('.social-picker').iconpicker();
  });
  // --------------- REMOVE ESPECIFICATIONS
  $(document).on('click','.remove-spcification',function(){
    $(this).parent().parent().remove();
  });
  // --------------- CARGAR EL ARCHIVO EN EL INPUT
  document.getElementById('adj_doc').onchange = function () {
    let fi = this;
    var totalFileSize = 0;
    if (fi.files.length > 0){
      for (var i = 0; i <= fi.files.length - 1; i++){
        var fsize = fi.files.item(i).size;
        var ftype = fi.files.item(i).type
        var fname = fi.files.item(i).name;
        this.nextElementSibling.innerHTML = fname;
      }
    }else{
      this.nextElementSibling.innerHTML = "Nada seleccionado";
    }
  };
});
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
  $(document).on("change","#atributoraiz",function(e){
    e.preventDefault();
    let optSelected = $("#atributoraiz option:selected").val();
    let optSelectedTxt = $("#atributoraiz option:selected").text();
    if(optSelected == 1 || optSelectedTxt == "COLOR" || optSelectedTxt == "color" || optSelectedTxt == "COLORES" || optSelectedTxt == "colores"){
      $("#cTentr-af172698__p-adm").html(`
      <div id="attrcolors-section">
        <div class="d-flex">
          <div class="flex-grow-1">
            <div class="form-group">
              <span><strong>Lista de colores</strong></span>
            </div>
          </div>
        </div>
        <div class="d-flex">
          <div class="flex-grow-1">
            <div class="form-group">
              <input type="text" class="form-control aia848d__clrcode" placeholder="Código de Producto" value="">
            </div>
          </div>
          <div class="flex-grow-1">
            <div class="form-group">
              <label class="color-picker">
                <span>
                  <input type="color" class="form-control aia848d__clrname" placeholder="Código de Color" value="">
                </span>
              </label>
            </div>
          </div>
          <div class="flex-btn">
            <button type="button" class="btn btn-success add-color" data-text="" data-text1=""> <i class="fa fa-plus"></i> </button>
          </div>
        </div>
      </div>
      <div class="d-flex c-sctGroupList">
        <div class="flex-grow-1">
          <div class="scGroupElems-sectionList">
            <div class="c-zTitleSectionFloating">
              <span class="c-zTitleSectionFloating__txt">Lista de <strong>Colores Agregados</strong></span>
            </div>
            <div class="scGroupElems-sectionList__c" id="attrcolors-sectionList__c">
              <div class="scGroupElems-sectionList__c__deftxt" id="defTxt57vnj-attrclr__anyval">
                <p>Sin Colores</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      `);
    }else{
      $("#cTentr-af172698__p-adm").html(``);
    }
  });
  // --------------- KEYUP INPUTS COLOR - TEXT
  $(document).on("keyup","input.aia848d__clrcode",function(e){
    let val = e.target.value;
    let btnAddSpecification = $(this).parent().parent().parent().find(".add-color");
    btnAddSpecification.attr('data-text', val);
  });
  // --------------- KEYUP INPUTS COLOR - DESCRIPTION
  $(document).on("input change","input.aia848d__clrname",function(e){
    let val = e.target.value;
    let btnAddSpecification = $(this).parent().parent().parent().parent().parent().find(".add-color");
    btnAddSpecification.attr('data-text1', val);
  });
  // --------------- ADD COLOR
  $(document).on("click",".add-color",function(){
    var text = $(this).parent().parent().parent().find("input.aia848d__clrcode").val();
    var text1 = $(this).parent().parent().parent().find("input.aia848d__clrname").val();
    var textFirstVal2 = (text != "" && text != null && text != undefined) ? text : "Código de Producto";
    $("#defTxt57vnj-attrclr__anyval").remove();
    $('#attrcolors-sectionList__c').append(`
      <div class="d-flex attrcolor-item">
        <div class="flex-grow-1">
          <div class="form-group">
            <input type="text" class="form-control" name="color_code[]" placeholder="${textFirstVal2}" value="${text}">
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="form-group">
            <label class="color-picker">
              <span>
                <input type="color" class="form-control" name="color_name[]" placeholder="${text1}" value="${text1}">
              </span>
            </label>
          </div>
        </div>
        <div class="flex-btn">
          <button type="button" class="btn btn-danger remove-color">
            <i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
    `);
    $(this).data('text', '');
    $(this).data('text1', '');
    $(".aia848d__clrcode").val('');
    $(".aia848d__clrname").val('');
  });  
  // --------------- REMOVE COLOR
  $(document).on('click','.remove-color',function(){
    $(this).parent().parent().remove();
    if($(".attrcolor-item").length){
    }else{
      $('#attrcolors-sectionList__c').append(`<div class="scGroupElems-sectionList__c__deftxt" id="defTxt57vnj-attrclr__anyval">
        <p>Sin Colores</p>
      </div>`);
    }
  });
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
    let cautionIncIGV = $("#e_hY-596kjkJN79").val();
    let cautionSinIGV = $("#e_hD-123kjkJN79").val();
    let val = e.target.value;
    let val_formatNumber = val.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    let val_formatNumberWithoutCome = val_formatNumber.replace(/,/g,"");
    $(this).val(val_formatNumber);
    let incIGV = (typeof taxesObj[0] != 'undefined') ? taxesObj[0] : cautionIncIGV;
    let sincIGV = (typeof taxesObj[1] != 'undefined') ? taxesObj[1] : cautionSinIGV;
    let incIGVFormat = incIGV / 100;
    let sincIGVFormat = sincIGV;
    let incIGVFormatOpe = parseFloat(val_formatNumberWithoutCome);
    let incIGVFormatOpeMoreIGV = incIGVFormatOpe * incIGVFormat;
    let incIGVFormatOpeMoreIGVCalc = incIGVFormatOpe + incIGVFormatOpeMoreIGV;
    let val_formatNumberWithIGV = incIGVFormatOpeMoreIGVCalc.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $("#c-prevammt__igvGs23s").text('S/. '+val_formatNumberWithIGV);
  });
  function addIGVintoTag(elementOrTag){
    let cautionIncIGV = $("#e_hY-596kjkJN79").val();
    let cautionSinIGV = $("#e_hD-123kjkJN79").val();
    var val_formatNumberWithIGV = "";
    if(elementOrTag != ""){
      let val_formatNumberWithoutCome = elementOrTag.replace(/,/g,"");
      let incIGV = (typeof taxesObj[0] != 'undefined') ? taxesObj[0] : cautionIncIGV;
      let incIGVFormat = incIGV / 100;
      let incIGVFormatOpe = parseFloat(val_formatNumberWithoutCome);
      let incIGVFormatOpeMoreIGV = incIGVFormatOpe * incIGVFormat;
      let incIGVFormatOpeMoreIGVCalc = incIGVFormatOpe + incIGVFormatOpeMoreIGV;
      val_formatNumberWithIGV = incIGVFormatOpeMoreIGVCalc.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    return val_formatNumberWithIGV;
  }
  $(document).on("change","#tax_id",function(){
    let tId = $(this).val();
    // console.log(tId);
    if($(".c_cPreviewAmmountIGV").length > 0){
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
  // --------------- MOSTRAR/OCULTAR LAS ESPECIFICACIONES
  $(document).on("click","input[name='is_specification']",function(){
    if($(this).is(":checked")){
      $(this).val(1);
      $("#cTentr-af1728903__p-adm").html(`
      <div id="specifications-section">
        <div class="d-flex">
          <div class="flex-grow-1">
            <div class="form-group">
              <input type="text" class="form-control aia843d__spcfname" name="specification_name[]" placeholder="Nombre de la especificación" value="">
            </div>
          </div>
          <div class="flex-grow-1">
            <div class="form-group">
              <input type="text" class="form-control aia843d__spcfdsc" name="specification_description[]" placeholder="Descripción de la especificacion" value="">
            </div>
          </div>
          <div class="flex-btn">
            <button type="button" class="btn btn-success add-specification" data-text="Nombre de la especificación" data-text1="Descripción de la especificacion"> <i class="fa fa-plus"></i> </button>
          </div>
        </div>
      </div>
      <div class="d-flex c-sctGroupList">
        <div class="flex-grow-1">
          <div class="scGroupElems-sectionList">
            <div class="c-zTitleSectionFloating">
              <span class="c-zTitleSectionFloating__txt">Lista de especificaciones</span>
            </div>
            <div class="scGroupElems-sectionList__c" id="specifications-sectionList__c">
              <div class="scGroupElems-sectionList__c__deftxt" id="defTxt57vnj-espc__anyval">
                <p>Sin Especificaciones</p>
              </div>
            </div>
          </div>
        </div>
      </div>`);
    }else{
      $(this).val(0);
      $("#cTentr-af1728903__p-adm").html(``);
    }
  });
  // --------------- KEYUP INPUTS ESPECIFICATIONS - TEXT
  $(document).on("keyup","input.aia843d__spcfname",function(e){
    let val = e.target.value;
    let btnAddSpecification = $(this).parent().parent().parent().find(".add-specification");
    btnAddSpecification.attr('data-text', val);
  });
  // --------------- KEYUP INPUTS ESPECIFICATIONS - DESCRIPTION
  $(document).on("keyup","input.aia843d__spcfdsc",function(e){
    let val = e.target.value;
    let btnAddSpecification = $(this).parent().parent().parent().find(".add-specification");
    btnAddSpecification.attr('data-text1', val);
  });
  // --------------- VALIDAR INPUT DE NOMBRE DE ESPEFICICACIÓN
  $(document).on("input keyup", "input.aia843d__spcfname", function(e){
    let valSpcfic = e.target.value;
    if(valSpcfic.trim() != ""){
      $("#ccffs89_51-2ifc099").text("");
    }else{
      $("#ccffs89_51-2ifc099").text("* Campo obligatorio");
    }
  });
  // --------------- ADD ESPECIFICATIONS
  $(document).on("click",".add-specification",function(){
    var text = $(this).parent().parent().parent().find("input.aia843d__spcfname").val();
    var text1 = $(this).parent().parent().parent().find("input.aia843d__spcfdsc").val();
    if(text.trim() != "" && text.trim() != undefined){
      $("#ccffs89_51-2ifc099").text("");
      $("#defTxt57vnj-espc__anyval").remove();
      $('#specifications-sectionList__c').append(`
      <div class="d-flex specification-item">
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
      $(".aia843d__spcfname").val('');
      $(".aia843d__spcfdsc").val('');
    }else{
      $("#ccffs89_51-2ifc099").text("* Campo obligatorio");
    }    
  });
  // --------------- REMOVE ESPECIFICATIONS
  $(document).on('click','.remove-spcification',function(){
    $(this).parent().parent().remove();
    if($(".specification-item").length){
    }else{
      $('#specifications-sectionList__c').append(`<div class="scGroupElems-sectionList__c__deftxt" id="defTxt57vnj-espc__anyval">
        <p>Sin Especificaciones</p>
      </div>`);
    }
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
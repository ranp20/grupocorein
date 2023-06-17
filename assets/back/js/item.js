$(() => {
  $(document).on("keyup", "input[data-valformat=withcomedecimal]", function(e){
    let val = e.target.value;
    let val_formatNumber = val.toString().replace(/[^\d.]/g, "").replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3').replace(/\.(\d{2})\d+/, '.$1').replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $(this).val(val_formatNumber);
  });
  $(document).on("change","#sections_id",function(){
    let tId = $(this).val();
    if(tId == 1){
      var tmpSelSection = `
      <div class="form-group">
        <label for="on-sale-price">En Promoción *</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">S/.</span>
          </div>
          <input type="text" data-valformat="withcomedecimal" id="on-sale-price" name="on_sale_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="" >
        </div>
      </div>
      `;
      $("#cTentr-af1698__p-adm").html(tmpSelSection);
    }else if(tId == 2){
      var tmpSelSection = `
      <div class="form-group">
        <label for="special-offer-price">Oferta Especial *</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text">S/.</span>
          </div>
          <input type="text" data-valformat="withcomedecimal" id="special-offer-price" name="special_offer_price" class="form-control" placeholder="Ingrese el precio" min="1" step="0.1" value="" >
        </div>
      </div>
      `;
      $("#cTentr-af1698__p-adm").html(tmpSelSection);
    }else{
      $("#cTentr-af1698__p-adm").html("");
    }
  });
});
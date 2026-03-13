$(() => {
  $(document).on("click","#sl_chkModAccessMethodPay",function(){
    if($(this).is(":checked")){
      $(this).val(1);
      let indSecContent = $('.c-accessMethodPay__rFa6GBin8');
      indSecContent.eq(0).addClass("dc_show").siblings().removeClass("dc_show");
      $("#txt-sl_chkModAccessMethodPay").text("Modo Producción");
      $("#txt-sl_chkModAccessMethodPay").attr('mod-integration', 'production');
    }else{
      $(this).val(0);
      let indSecContent = $('.c-accessMethodPay__rFa6GBin8');
      indSecContent.eq(1).addClass("dc_show").siblings().removeClass("dc_show");
      $("#txt-sl_chkModAccessMethodPay").text("Modo Producción");
      $("#txt-sl_chkModAccessMethodPay").attr('mod-integration', 'test');
    }
  });
});
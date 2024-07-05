$(() => {
  // --------------- TOGGLE CONTENT_INFO
  $(document).on("click","input[name=content_check]",function(){
    $('#' + $(this).attr('data-anchor')).toggleClass('active').siblings().removeClass('active'); // TOGGLE TABS
  });
  // --------------- TOGGLE CONTENT_BTN-CHECK
  $(document).on("click", "input[name=content_btncheck]", function(){
    var targetIds = $(this).attr('data-show').split(', ');
    var showId = targetIds[0];
    var hideId = targetIds[1];
    if($(this).is(':checked')){
      $(this).val("on");
      $("#" + showId).addClass('active').add($("#" + hideId).removeClass('active'));
      $("label[for=content-btncheck]").text('Habilitado');
    }else{
      $(this).val("off");
      $("#" + hideId).addClass('active').add($("#" + showId).removeClass('active'));
      $("label[for=content-btncheck]").text('Deshabilitado');
    }
  });
});
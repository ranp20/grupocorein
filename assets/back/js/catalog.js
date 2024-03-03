$(() => {
  $('.radio-check__vCatalog').on('change',function(){
    if(this.checked){
      // $(this).parent().parent().next().removeClass('d-none');
    }else{
      // $(this).parent().parent().next().addClass('d-none');
    }
  });
  // --------------- CARGAR EL ARCHIVO EN EL INPUT
  $(document).on("change",".upload-onefile",function(){
    $.each($(this), function(i, e){
      let fi = e;
      var totalFileSize = 0;
      if (e.files.length > 0){
        for (var i = 0; i <= e.files.length - 1; i++){
          var fsize = fi.files.item(i).size;
          var ftype = fi.files.item(i).type;
          var fname = fi.files.item(i).name;
          this.nextElementSibling.innerHTML = fname;
        }
      }else{
        this.nextElementSibling.innerHTML = "Nada seleccionado";
      }

    });
  });
});
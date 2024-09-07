$(() => {
  // ------------ FORMATO - SEPARADOR DE NÚMERO TELEFÓNICO(+51)
  $(document).on("input keyup keypress", "input[data-valformat=withspacesforthreenumbers]", function(e){
    let val = e.target.value;
    if($(this).attr("maxlength") <= 11){
      $(this).val(val.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{3})/, '$1 $2 $3'));
    }
  });
});
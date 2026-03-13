$(document).on("change", "#sorting_brandsletter", function () {
  let sorting = $(this).val();
  $("#sorting_brandletter").val(sorting);
  removePage();
  $("#search_button_marcas").click();
});

function removePage() {
  $("#search_form_marcas #page").val('');
}
$(document).on('submit', '#search_form_marcas', function(e){
  e.preventDefault();
  let loader = `
  <div id="view_loader_div" class="">
    <div class="product-not-found">
      <img class="loader_image" src="${mainurl + '/assets/images/ajax_loader.gif'}" alt="">
    </div>
  </div>
  `;
  $('#list_view_ajax').html(loader);

  let form_url = $(this).attr('action');
  let method = $(this).attr('method');
  $.ajax({
    type: method,
    url: form_url,
    data: $(this).serialize(),
    success: function(data){
      window.scrollTo(0, 0);
      $('#list_view_ajax').html(data);
    }
  });
});
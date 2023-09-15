$(document).on("change", "#sorting-catalogs", function () {
  let sorting = $(this).val();
  $("#sorting_cataloganio").val(sorting);
  removePage();
  $("#search_button_catalog").click();
});

function removePage() {
  $("#search_form_catalog #page").val('');
}
$(document).on('submit', '#search_form_catalog', function(e){
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

// $(document).on('click', '#item_pagination .page-item .page-link', function(e){
//   e.preventDefault();
//   let pagination = $(this).text();
//   let lastActive = parseInt($('#item_pagination .page-item.active .page-link').text());
//   if(pagination == '›'){
//     pagination = lastActive+1;  
//   }else if(pagination == '‹'){
//     pagination = lastActive -1;
//   }
//   $("#search_form #page").val(pagination);
//   $("#search_button").click();
// });

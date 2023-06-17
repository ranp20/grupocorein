$(document).on("change", "#sorting-catalogs", function () {
  let sorting = $(this).val();
  console.log(sorting);
  $("#sorting-catalogs").val(sorting);
  removePage();
  $("#search_button_catalog").click();
});

function removePage() {
  $("#search_form #page").val('');
}
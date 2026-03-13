$(() => {
  // ------------ FORMATO - SEPARADOR DE NÚMERO TELEFÓNICO(+51)
  $(document).on("input keyup keypress", "input[data-valformat=withspacesforthreenumbers]", function(e){
    let val = e.target.value;
    if($(this).attr("maxlength") <= 9){
      $(this).val(val.replace(/\D+/g, '').replace(/(\d{3})(\d{3})(\d{3})/, '$1 $2 $3'));
    }
  });
  // Social Picker
  if($('.social-picker').length > 0 ){
    $('button.social-picker').iconpicker();
  }
  // Appending Social Icons To Items
  $('.add-social').on('click',function(){
    var text = $(this).data('text');
    $('#social-section').append(`
    <div class="d-flex">
      <div>
        <div class="form-group">
          <button class="btn btn-secondary social-picker" name="social_icons[]" data-icon="fab fa-font-awesome">
          </button>
        </div>
      </div>
      <div class="flex-grow-1">
        <div class="form-group mb-1">
          <input type="text" class="form-control" name="social_links[]" placeholder="${text}">
        </div>
      </div>
      <div class="flex-btn">
        <button type="button" class="btn btn-danger remove-social">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    `);
    $('.social-picker').iconpicker();
  });
  // Appending Specification To Items
  $('.add-specification').on('click',function(){
    var text = $(this).data('text');
    var text1 = $(this).data('text1');
    $('#specifications-section').append(`
    <div class="d-flex">
      <div class="flex-grow-1">
        <div class="form-group">
          <input type="text" class="form-control" name="specification_name[]" placeholder="${text}" value="">
        </div>
      </div>
      <div class="flex-grow-1">
        <div class="form-group">
          <input type="text" class="form-control" name="specification_description[]" placeholder="${text1}" value="">
        </div>
      </div>
      <div class="flex-btn">
        <button type="button" class="btn btn-danger remove-spcification">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    `);
    $('.social-picker').iconpicker();
  });
  // Appending License To Items
  $('.add-license').on('click',function(){
    var text = $(this).data('text');
    var text1 = $(this).data('text1');
    $('#license-section').append(`
    <div class="d-flex">
      <div class="flex-grow-1">
        <div class="form-group">
          <input type="text" class="form-control" name="license_name[]" placeholder="${text}" value="">
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="form-group">
            <input type="text" class="form-control" name="license_key[]" placeholder="${text1}" value="">
          </div>
        </div>
        <div class="flex-btn">
          <button type="button" class="btn btn-danger remove-license">
            <i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
    `);
    $('.social-picker').iconpicker();
  });
  $(document).on('click','.remove-social',function(){
    $(this).parent().parent().remove();
  });
  $(document).on('click','.remove-spcification',function(){
    $(this).parent().parent().remove();
  });
  $(document).on('click','.remove-license',function(){
    $(this).parent().parent().remove();
  });
  /*
  $('.add-wtspnumbers_number').on('click',function(){
    var text = $(this).data('text');
    $('#wtspnumbers_number-section').append(`
      <div class="d-flex">
        <div>
          <div class="form-group">
            <button class="btn btn-secondary" name="social_icons[]" data-icon="fab fa-font-awesome"></button>
          </div>
        </div>
        <div class="flex-grow-1">
          <div class="form-group mb-1">
            <input type="text" class="form-control" name="social_links[]" placeholder="${text}">
          </div>
        </div>
        <div class="flex-btn">
          <button type="button" class="btn btn-danger remove-social">
            <i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      `);
    });
    */

  $(document).on("click",".add-whatsapp-number",function(){
    let cMainMenu = $("#wpsnumbsgadd_cC1Gdhj5-2lks .cCt_wtpsNmbrs__c__m");
    console.log(cMainMenu.length);
    if(cMainMenu.length > 0){
      $(`<div class="d-flex cCt_wtpsNmbrs__c__m">
      <div class="flex-grow-1 cCt_wtpsNmbrs__c__m__i">
        <div class="form-group">
          <input type="text" class="form-control" name="wtspnumbers_title[]" placeholder="Ingrese el título" value="" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="wtspnumbers_text[]" placeholder="Ingrese el texto" value="" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="wtspnumbers_number[]" placeholder="Ingrese el número" data-valformat="withspacesforthreenumbers" maxlength="9" value="" required>
        </div>
      </div>
      <div class="flex-btn">
        <button type="button" class="btn btn-danger remove-social">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>`).insertAfter(cMainMenu.last());
    }else{
      $('#wpsnumbsgadd_cC1Gdhj5-2lks').html(`<div class="d-flex cCt_wtpsNmbrs__c__m">
      <div class="flex-grow-1 cCt_wtpsNmbrs__c__m__i">
        <div class="form-group">
          <input type="text" class="form-control" name="wtspnumbers_title[]" placeholder="Ingrese el título" value="" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="wtspnumbers_text[]" placeholder="Ingrese el texto" value="" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="wtspnumbers_number[]" placeholder="Ingrese el número" data-valformat="withspacesforthreenumbers" maxlength="9" value="" required>
        </div>
      </div>
      <div class="flex-btn">
        <button type="button" class="btn btn-danger remove-social">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>`);
    }
    
  });
});
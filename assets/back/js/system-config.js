$(() => {


  $('.add-wtspnumbers_number').on('click',function(){
    var text = $(this).data('text');
    $('#wtspnumbers_number-section').append(`
      <div class="d-flex">
        <div>
          <div class="form-group">
            <button class="btn btn-secondary social-picker" name="social_icons[]" data-icon="fab fa-font-awesome"></button>
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

    [
      {"icons":["icono-tienda-1.png","icono-tienda-1.png"],"title":["aasdsd","dsad"],"text":["Hola, deseo más información sobre la plataforma.","asdsad"],"number":["900512661","918195134"]}
    ]
});
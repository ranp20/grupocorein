$(() => {
  // ----------- ELIMINAR PRODUCTOS DE MANERA INDIVIDUAL...
  $(document).on("click",".remwithsvg", function(e){
    e.preventDefault();
    var csrfTokenFrm = $("#csl-fGv8n09c__sGaYs45").find("input[name='_token']").val();
    // alert(csrfTokenFrm);

    let idprod = $(this).parent().parent().find(".increaseQtycart").attr("data-target");
    let urlsend = $(this).attr("href");
    // console.log("idprod: "+idprod+"\n"+"url: "+url);
    let clistItems = $(this).parent().parent().parent().find("tr");
    Swal.fire({
      title: '¿Estás seguro?',
      icon: 'warning',
      html: `<p class='font-w-300'>Se eliminará el producto del carrito.</p>`,
      showDenyButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      denyButtonText: `No, cancelar`,
    }).then((e) => {
      if(e.isConfirmed){
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': csrfTokenFrm
          },
          type: 'GET',
          url: urlsend,
          // data: idprod,
          processData: false,
          contentType: false,
          beforeSend: function(){
            
          },
          success: function(e){
            let res = JSON.parse(e);
            if(res.type == "success"){
              $.notify({
                // options
                title: `<strong>${res.mssg}</strong>`,
                message: '',
                icon: "fas fa-check-circle",
              },{
                // settings
                element: "body",
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: "_blank",
                mouse_over: null,
                animate: {
                  enter: "animated fadeInDown",
                  exit: "animated fadeOutUp",
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: "class",
              });
              // if($("#ccksj934JBjFKScsKjs").length){
                $("#rnvc_cart").load(location.href + " #ccksj934JBjFKScsKjs");
              // }else{
              //   console.log("No existe el listado...");
              // }
              return false;
            }else{
              $.notify({
                // options
                title: `<strong>Hubo un error al eliminar el producto.</strong>`,
                message: '',
                icon: 'flaticon-alarm-1',
              },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                  from: "top",
                  align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
              });
              return false;
            }
          },
          complete: function(){
            requestSent = false;
          }
        });
      }else if(e.isDenied){
        console.log('Se canceló la eliminación.');
      }else{

      }
    });


  });
  // ----------- ELIMINAR TODOS LOS PRODUCTOS DEL CARRITO...
  $(document).on("click",".remallwithoutic", function(e){
    e.preventDefault();
    var csrfTokenFrm = $("#csl-fGv8n09c__sGaYs45").find("input[name='_token']").val();
    // alert(csrfTokenFrm);

    let idprod = $(this).parent().parent().find(".increaseQtycart").attr("data-target");
    let urlsend = $(this).attr("href");
    // console.log("idprod: "+idprod+"\n"+"url: "+url);
    let clistItems = $(this).parent().parent().parent().find("tr");
    Swal.fire({
      title: '¿Estás seguro?',
      icon: 'warning',
      html: `<p class='font-w-300'>Se eliminarán <strong>TODOS</strong> los productos del carrito.</p>`,
      showDenyButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      denyButtonText: `No, cancelar`,
    }).then((e) => {
      if(e.isConfirmed){
        
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': csrfTokenFrm
          },
          type: 'GET',
          url: urlsend,
          // data: idprod,
          processData: false,
          contentType: false,
          beforeSend: function(){
            
          },
          success: function(e){
            let res = JSON.parse(e);
            if(res.type == "success"){
              $.notify({
                // options
                title: `<strong>${res.mssg}</strong>`,
                message: '',
                icon: "fas fa-check-circle",
              },{
                // settings
                element: "body",
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                  from: "top",
                  align: "right",
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: "_blank",
                mouse_over: null,
                animate: {
                  enter: "animated fadeInDown",
                  exit: "animated fadeOutUp",
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: "class",
              });
              // if($("#ccksj934JBjFKScsKjs").length){
                $("#rnvc_cart").load(location.href + " #ccksj934JBjFKScsKjs");
              // }else{
              //   console.log("No existe el listado...");
              // }
              return false;
            }else{
              $.notify({
                // options
                title: `<strong>Hubo un error al eliminar el producto.</strong>`,
                message: '',
                icon: 'flaticon-alarm-1',
              },{
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                  from: "top",
                  align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
              });
              return false;
            }
          },
          complete: function(){
            requestSent = false;
          }
        });
        

      }else if(e.isDenied){
        console.log('Se canceló la eliminación.');
      }else{

      }
    });


  });
});
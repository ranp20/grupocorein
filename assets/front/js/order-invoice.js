$(() => {
  
  var locationsGET = window.location.href;
  var csrfTokenFrm = $("#asda_al-IIDASD88tokeN").find("input[name='_token']").val();

  $(document).on("click","#cTentr-af1698__1prevChckp",function(e){
    e.preventDefault();
    let dataHrefURL = $(this).data("href");

    var optionsPDFObject ={
      fallbackLink: "<p>Este navegador no admite archivos PDF en línea. Por favor descargue el PDF para verlo: <a href='[url]'>Descargar PDF</a></p>",
      width: "100%",
      height: "100%",
      omitInlineStyles: true,
      id: "myPDFIdOrder",
      pdfOpenParams:{
        view: 'FitV'
      }
    };
    
    $.ajax({
      headers:{
        'X-CSRF-TOKEN': csrfTokenFrm
      },
      type: 'GET',
      url: dataHrefURL,
      data: {'id_order':$(this).attr('data-getsend')},
      xhrFields:{
        responseType: 'blob'
      },
      beforeSend: function(){
        $("#cTentr-af1698__1prevChckp-show").html(`
        <div class="d-flex align-items-center justify-content-center mx-auto py-5 h-100" style="max-width: 60px;width:60px;height:60px;">
          <img src="../../../assets/images/Utilities/loader.gif" alt="icon-update" width="100" height="100" decoding="sync">
        </div>
        `);
      },
      success: function(blob, status, xhr){
        
        var filename = "";
        var disposition = xhr.getResponseHeader('Content-Disposition');
        if(disposition && disposition.indexOf('attachment') !== -1){
          var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
          var matches = filenameRegex.exec(disposition);
          if(matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
        }

        if(typeof window.navigator.msSaveBlob !== 'undefined'){
          window.navigator.msSaveBlob(blob, filename);
        }else{
          var URL = window.URL || window.webkitURL;
          var downloadUrl = URL.createObjectURL(blob);
          /*
          var blobNameObject = new Blob([filename],{type: 'application/pdf'});
          var urlNewName = window.URL.createObjectURL(blobNameObject);
          */
          /*
          var blob = blob.slice(0, blob.size, blob.type);
          var newFile = new File([blob], 'oiaisdsadsad.pdf',{type: 'application/pdf'});
          console.log("asdasdasd"+newFile);
          */
          let a = $("#cTentr-af1698__1prevChckpPDFDown");
          a.attr('href', downloadUrl);
          a.attr('download', 'previsualizacion_del_pedido.pdf');
          if(filename){            
            PDFObject.embed(downloadUrl, "#cTentr-af1698__1prevChckp-show", optionsPDFObject);
          }else{
            PDFObject.embed(downloadUrl, "#cTentr-af1698__1prevChckp-show", optionsPDFObject);
          }
          PDFObject.embed(downloadUrl, "#cTentr-af1698__1prevChckp-show", optionsPDFObject);
        }       
      }
    });
  });
});
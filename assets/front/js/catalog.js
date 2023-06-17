$(() => {
  function lazy (){
    $(".lazy").Lazy({
      beforeLoad: function(element) {
        var imageSrc = element.data('src');
      },
      scrollDirection: 'vertical',
      effect: "fadeIn",
      effectTime:1000,
      threshold: 0,
      visibleOnly: false,  
      onError: function(element) {
        console.log('error loading ' + element.data('src'));
      }
    });
  }
  lazy();
});
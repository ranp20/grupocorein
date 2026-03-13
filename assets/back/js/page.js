$('.page-name').on('keyup',function(){
  let $this = $(this);
  let str = $this.val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'-').replace(/ /g, '-');
  $('#slug').val(str);
});
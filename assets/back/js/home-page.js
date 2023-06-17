$(() => {
  function replaceSpacesByHyphen(e){
    let str = e.val().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'-').replace(/ /g, '-');
    return str;
  }
  $(document).on("keyup keypress","#title1",function(e){$('#firsturl1').val(replaceSpacesByHyphen($(this)));});
  $(document).on("keyup keypress","#title2",function(e){$('#firsturl2').val(replaceSpacesByHyphen($(this)));});
  $(document).on("keyup keypress","#title3",function(e){$('#firsturl3').val(replaceSpacesByHyphen($(this)));});
  $(document).on("keyup keypress","#title1-2",function(e){$('#secondurl1-2').val(replaceSpacesByHyphen($(this)));});
  $(document).on("keyup keypress","#title2-2",function(e){$('#secondurl2-2').val(replaceSpacesByHyphen($(this)));});
  $(document).on("keyup keypress","#title3-2",function(e){$('#secondurl3-2').val(replaceSpacesByHyphen($(this)));});
  $(document).on("keyup keypress","#title1-3",function(e){$('#thirdurl1-3').val(replaceSpacesByHyphen($(this)));});
  $(document).on("keyup keypress","#title3-3",function(e){$('#thirdurl2-3').val(replaceSpacesByHyphen($(this)));});
});
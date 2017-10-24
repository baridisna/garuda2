
$(document).ready(function(){
  x=0;
  $("#add").click(function(e){
    e.preventDefault();

    if(x<10){
      x++;
    $('#items').append('<div><input type="text" name="user-name'+x+'"> <input type="text" name="user-email'+x+'">   '+
    '<input type="button" value="delete" id="delete"/></div>'); // kalo tomboll add ditekan string didalam <div></div> dalam append akan ditambahkan
  }
});

$('body').on('click','#delete' , function(e){
  $(this).parent('div').remove();
});

});

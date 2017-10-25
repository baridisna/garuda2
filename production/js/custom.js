
$(document).ready(function(){
  x=0;
  $("#add").click(function(e){
    e.preventDefault();

    if(x<10){
      x++;
    $('#items').append('<div><tr><td><input type="text" name="user-name'+x+'"></td> <td><input type="text" name="user-email'+x+'">   '+
    '<input type="button" value="delete" id="delete"/></td></tr></div>'); // kalo tomboll add ditekan string didalam <div></div> dalam append akan ditambahkan
  }
});

$('body').on('click','#delete' , function(e){
  $(this).parent('div').remove();
});

});

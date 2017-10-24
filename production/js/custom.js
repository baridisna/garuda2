
$(document).ready(function(){
  x=0;
  $("#add").click(function(e){
    e.preventDefault();

    if(x<10){
      x++;
    $('#items').append('<div><tr>
         <td><input type="text" name="dimensi[]" placeholder="Masukkan Dimensi" class="form-control name_list" /></td>

         <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
<td></td>

    </tr>
    <tr>
      <td></td>
      <td><input type="text" name="pertanyaan[]" placeholder="Masukkan Pertanyaan" class="form-control name_list" /></td>
    </tr></div>'); // kalo tomboll add ditekan string didalam <div></div> dalam append akan ditambahkan
  }
});

$('body').on('click','#delete' , function(e){
  $(this).parent('div').remove();
});

});

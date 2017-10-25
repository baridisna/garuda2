$(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field1').append(
            '<tr id="row'+i+'"><td><input type="text" name="dimensi[]" placeholder="Dimensi" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_dimensi').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_dimensi')[0].reset();  
                }  
           });  
      });

      var j=1;  
      $('#add_per').click(function(){  
           j++;  
           $('#dynamic_field2').append(
            '<tr id="row'+j+'"><td><form action="#" method="GET">                                              <label for="selecter_basic">Pilih Dimensi</label>                                              <select name="selecter_basic" id="selecter_basic" class="selecter_basic">                                                  <option>tangibles</option>                                                  <option>reliability</option>                                                  <option>responsiveness</option>                                                  <option>empathy</option>                                              </select>                                            </form></td><td><input type="text" name="pertanyaan[]" placeholder="Masukkan Pertanyaan" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+j+'" class="btn btn-danger btn_remove_per">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove_per', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_dimensi').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_dimensi')[0].reset();  
                }  
           });  
      });    
 });  
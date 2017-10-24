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
 });  
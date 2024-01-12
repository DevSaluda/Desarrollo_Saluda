$('document').ready(function($){
 
    // hide messages 
    $("#error_actualiza").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ActualizaHorario').submit(function(e){
 
        e.preventDefault();
 
 

    
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/ActualizaSucursalC.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                CargaSucursalesH();
                  $('#editModal').modal('hide');
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#ExitoActualiza').modal('toggle'); 
                  setTimeout(function(){ 
                      $('#ExitoActualiza').modal('hide') 
                  }, 2000); // abrir
                 
                         },
                         error: function(){
                            $("#show_error").fadeIn();
                         }
        });
    });  
 
    return false;
    });
$('document').ready(function($){
 
    // hide messages 
    $("#error_actualiza").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ActualizaHorario').submit(function(e){
 
        e.preventDefault();
 
 

        //name required
        var Fecha = $("input#fechact").val();
        if(Fecha == ""){
            $("#error_actualiza").fadeIn().text("Debes ingresar una fecha");
            $("input#fechact").focus();
            $("#error_actualiza").fadeOut(9000);
            return false;
        }
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/ActualizaFecha.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
        
                  CargaFechas();
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
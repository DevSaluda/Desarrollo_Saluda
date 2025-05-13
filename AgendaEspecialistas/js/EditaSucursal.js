$('document').ready(function($){
 
    // hide messages 
    $("#error_actualiza").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ActualizaHorario').submit(function(e){
 
        e.preventDefault();
 
 

        //name required
        var Fecha = $("select#sucursal").val();
        if(Fecha == ""){
            $("#error_actualiza").fadeIn().text("Debes elegir una sucursal");
            $("select#sucursal").focus();
            $("#error_actualiza").fadeOut(9000);
            return false;
        }
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/ActualizaSucursal.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                CargaSucursales();
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
$(document).ready(function($){
 
    // hide messages 
    $("#error_actualiza").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ActualizaHorario').submit(function(e){
 
        e.preventDefault();
 
 
        $("#error_actualiza").hide();
 
        //name required
        var Especial = $("input#Horario").val();
        if(Especial == ""){
            $("#error_actualiza").fadeIn().text("Debes ingresar una hora");
            $("input#Horario").focus();
            $("#error_actualiza").fadeOut(9000);
            return false;
        }
        var Estatus = $("select#colorpago").val();
        if(Estatus == ""){
            $("#error_actualiza").fadeIn().text("Debes elegir un estatus");
            $("select#colorpago").focus();
            $("#error_actualiza").fadeOut(9000);
            return false;
        }
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/ActualizaHorario.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
            
                CargaHorariosH();
                  $('#editModal').modal('hide');
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  $('#ExitoActualiza').modal('toggle'); 
                  setTimeout(function(){ 
                      $('#ExitoActualiza').modal('hide') 
                  }, 2000); // abrir
                 
                         },
                         error_actualiza: function(){
                            $("#show_error_actualiza").fadeIn();
                         }
        });
    });  
 
    return false;
    });
$(document).ready(function($){
 
    // hide messages 
    $("#error").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ActualizaEspecial').submit(function(e){
 
        e.preventDefault();
 
 
        $("#error").hide();
 
        //name required
        var Especial = $("input#ActualizaEspecial").val();
        if(Especial == ""){
            $("#error").fadeIn().text("Se requiere el nombre de la especialidad");
            $("input#Especial").focus();
            $("#error").fadeOut(9000);
            return false;
        }
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/ActualizaEstatusUltras.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                Swal.fire({
                    icon: 'success',
                    title: 'Actualizacion correcta',
                    
                    showConfirmButton: false,
                    timer:3000,
                  })
                  $("#ActualizaEspecial")[0].reset();
                 CargaResultadosUltras();
                  $('#editModal').modal('hide');
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                
                         },
                         error: function(){
                            $("#show_error").fadeIn();
                         }
        });
    });  
 
    return false;
    });
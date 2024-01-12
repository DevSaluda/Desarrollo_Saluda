$(document).ready(function($){
 
    // hide messages 
    $("#error").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
 
        $("#error").hide();
 
        //name required
        var Especialidad = $("input#especialidad").val();
        if(Especialidad == ""){
            $("#error").fadeIn().text("Se requiere el nombre de la especialidad");
            $("input#especialidad").focus();
            $("#error").fadeOut(9000);
            return false;
        }
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/GuardaCampana.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                Swal.fire({
                    icon: 'success',
                    title: 'Se han guardado los datos',
                    
                    showConfirmButton: false,
                    timer:3000,
                  })
                  $("#ajax-form")[0].reset();
                  CargaCampanas();
                
                
                         },
                         error: function(){
                            $("#show_error").fadeIn();
                         }
        });
    });  
 
    return false;
    });
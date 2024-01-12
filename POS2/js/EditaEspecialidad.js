$('document').ready(function($){
 
    // hide messages 
    $("#error_actualiza").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ActualizaEspecialidades').submit(function(e){
 
        e.preventDefault();

 
        //name required
        var ActualizaEspecial = $("input#ActualizaEspecial").val();
        if(ActualizaEspecial == ""){
            $("#error_actualiza").fadeIn().text("No puedes tener campos vacíos, por favor ingresa el nombre de la especialidad.");
            $("input#ActualizaEspecial").focus();
            $("#error_actualiza").fadeOut(5000);
            return false;
        }
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/ActualizaEspecialidad.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
               
                  CargaEspecialidades();
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
                            $("#show_error").fadeOut(5000);
                         }
        });
    });  
 
    return false;
    });
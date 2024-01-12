$(document).ready(function($){
 
    // hide messages 
    $("#error").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ActualizaEspecialista').submit(function(e){
 
        e.preventDefault();
 

 
        $('#ActualizaNombre').on('input', function (e) {
            if (!/^[ a-z0-9áéíóúüñ]*$/i.test(this.value)) {
                this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig,"");
            }
        });
        //name required
        var Especialista = $("input#ActualizaNombre").val();
        if(Especialista == ""){
            $("#error_especialista").fadeIn().text("Se requiere el nombre del especialista");
            $("input#ActualizaNombre").focus();
            $("#error_especialista").fadeOut(3000);
            return false;
        }
        var Especialidad = $("select#especialidad").val();
        if(Especialidad == "0"){
            $("#error_especialista").fadeIn().text("Debes elegir una especialidad");
            $("select#especialidad").focus();
            $("#error_especialista").fadeOut(3000);
            return false;
        }
        var Telefono = $("input#Tel").val();
        if(Telefono == ""){
            $("#error_especialista").fadeIn().text("Debes ingresar el numero de telefono");
            $("input#Tel").focus();
            $("#error_especialista").fadeOut(3000);
            return false;
        }
      
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/ActualizaEspecialista.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                CargaEspecialistasH();
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
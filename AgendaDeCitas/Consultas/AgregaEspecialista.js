$('document').ready(function($){
 
    // hide messages 
    $("#error_especialista").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
        $('#NombreEspecialista').on('input', function (e) {
            if (!/^[ a-z0-9áéíóúüñ@]*$/i.test(this.value)) {
                this.value = this.value.replace(/[^ a-z0-9áéíóúüñ@]+/ig,"");
            }
        });
        //name required
        var Especialista = $("input#NombreEspecialista").val();
        if(Especialista == ""){
            $("#error_especialista").fadeIn().text("Se requiere el nombre del especialista");
            $("input#NombreEspecialista").focus();
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
        var Telefono = $("input#tel").val();
        if(Telefono == ""){
            $("#error_especialista").fadeIn().text("Debes ingresar el numero de telefono");
            $("input#tel").focus();
            $("#error_especialista").fadeOut(3000);
            return false;
        }
        // email required
    
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/GuardaEspecialista.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                CargaEspecialistas();
                  $("#ajax-form")[0].reset();
            	 $("#Especialista").removeClass("in");
                  $(".modal-backdrop").remove();
                  $("#Especialista").hide();
                  $('#Exito').modal('toggle'); 
                setTimeout(function(){ 
                    $('#Exito').modal('hide') 
                }, 2000); // abrir
                         },
                         error: function(){
                            $("#show_error").fadeIn();
                         }
        });
    });  
 
    return false;
    });
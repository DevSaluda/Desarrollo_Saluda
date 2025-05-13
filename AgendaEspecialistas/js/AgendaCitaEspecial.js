$('document').ready(function($){
 
    // hide messages 
    $("#error_agenda").hide();
    $("#show_error").hide();
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
        //name required
        var Especialidad = $("select#especialidad").val();
        if(Especialidad == "0"){
            $("#error_agenda").fadeIn().text("Debes elegir una especialidad");
            $("select#especialidad").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Medico = $("select#medico").val();
        if(Medico == ""){
            $("#error_agenda").fadeIn().text("Debes elegir un médico");
            $("select#medico").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Sucursal = $("select#sucursal").val();
        if(Sucursal == ""){
            $("#error_agenda").fadeIn().text("Debes elegir una sucursal");
            $("select#sucursal").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Fecha = $("select#fecha").val();
        if(Fecha == ""){
            $("#error_agenda").fadeIn().text("Debes elegir una fecha");
            $("select#fecha").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
           var Hora = $("select#hora").val();
        if(Hora == ""){
            $("#error_agenda").fadeIn().text("Debes elegir una hora");
            $("select#hora").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Nombre = $("input#nombrep").val();
        if(Nombre == ""){
            $("#error_agenda").fadeIn().text("Debes ingresar el nombre del paciente");
            $("input#nombrep").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Telefono = $("input#telefono").val();
        if(Telefono == ""){
            $("#error_agenda").fadeIn().text("Debes ingresar el nombre del paciente");
            $("input#telefono").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Tipo = $("select#tipoconsulta").val();
        if(Tipo == "0"){
            $("#error_agenda").fadeIn().text("Debes elegir un tipo de consulta");
            $("select#tipoconsulta").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Estadopago = $("select#colorpago").val();
        if(Estadopago == "0"){
            $("#error_agenda").fadeIn().text("Debes elegir un tipo de consulta");
            $("select#colorpago").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var EstadoConsulta = $("select#colorcita").val();
        if(EstadoConsulta == "0"){
            $("#error_agenda").fadeIn().text("Debes elegir un tipo de consulta");
            $("select#colorcita").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        var Costo = $("select#costo").val();
        if(Costo == ""){
            $("#error_agenda").fadeIn().text("Debes elegir un tipo de consulta");
            $("select#costo").focus();
            $("#error_agenda").fadeOut(2000);
            return false;
        }
        
      

     
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/AgendaCita.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                CargaCampanas();
                  $("#ajax-form")[0].reset();
                  $("#AltaAgenda").removeClass("in");
                  $(".modal-backdrop").remove();
                  $("#AltaAgenda").hide();
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
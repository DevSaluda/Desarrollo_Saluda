$('document').ready(function($){
 
    // hide messages 
    $("#error_alta").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
        //name required
   
 
        var Especialidad = $("input#especialidad").val();
        if(Especialidad == ""){
            $("#error_alta").fadeIn().text("No puedes tener campos vacíos, por favor ingresa el nombre de la especialidad.");
            $("input#especialidad").focus();
            $("#error_alta").fadeOut(5000);
            return false;
        }
        // email required
        var Sucursal = $("select#sucursal").val();
        if(Sucursal == ""){
            $("#error_alta").fadeIn().text("Debes elegir la sucursal.");
            $("select#sucursal").focus();
            $("#error_alta").fadeOut(5000);
            return false;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/GuardaEspecialidad.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                CargaEspecialidades();
                $("#ajax-form")[0].reset();
                $("#Especialidad").removeClass("in");
                $(".modal-backdrop").remove();
                $("#Especialidad").hide();
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
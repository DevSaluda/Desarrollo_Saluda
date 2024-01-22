$('document').ready(function($){
 
    // hide messages 
    $("#error_alta").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
        //name required
        var Nombre = $("input#nombre").val();
        if(Nombre == ""){
            $("#error_alta").fadeIn().text("Debes ingresar el nombre");
            $("input#nombre").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var visita = $("select#visita").val();
        if(visita == ""){
            $("#error_alta").fadeIn().text("Debes elegir un tipo de visita");
            $("select#visita").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var Sexo = $("select#sexo").val();
        if(Sexo == "0"){
            $("#error_alta").fadeIn().text("Debes elegir un sexo");
            $("select#sexo").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var Edad= $("select#edad").val();
        if(Edad == "0"){
            $("#error_alta").fadeIn().text("Debes elegir una edad");
            $("select#edad").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var Talla = $("input#talla").val();
        if(Talla == ""){
            $("#error_alta").fadeIn().text("Debes ingresar una talla");
            $("input#talla").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var Peso = $("input#peso").val();
        if(Peso == ""){
            $("#error_alta").fadeIn().text("Debes ingresar un cantidad en el peso");
            $("input#peso").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var Temperatura = $("input#temp").val();
        if(Temperatura == ""){
            $("#error_alta").fadeIn().text("Debes ingresar la temperatura");
            $("input#temp").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var  TA = $("input#TA").val();
        if( TA == ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#TA").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var  FC = $("input#FC").val();
        if( FC == ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#FC").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var  FR = $("input#FR").val();
        if( FR == ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#FR").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var   DxTx = $("input#DxTx").val();
        if(  DxTx== ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#DxTx").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var    SaO2 = $("input#SaO2").val();
        if(  SaO2== ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#SaO2").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var  alergia = $("input#alergia").val();
        if(  alergia== ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#alergia").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var  Consulta = $("input#Consulta").val();
        if( Consulta== ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#Consulta").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var  Hora = $("select#hora").val();
        if( Hora== "0"){
            $("#error_alta").fadeIn().text("Debes elegir una hora");
            $("select#hora").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
        var  Doc = $("input#Doc").val();
        if( Doc== ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#Doc").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
       
       
        var  procede = $("input#procede").val();
        if( procede== ""){
            $("#error_alta").fadeIn().text("No puedes dejar campos en blanco.");
            $("input#procede").focus();
            $("#error_alta").fadeOut(2000);
            return false;
        }
       
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/GuardaCita.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
                 CargaPacientes();
                $("#ajax-form")[0].reset();
                $(".bd-example-modal-xl").removeClass("in");
                $(".modal-backdrop").remove();
                $(".bd-example-modal-xl").hide();
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
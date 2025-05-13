$('document').ready(function($){
 
    // hide messages 
    $("#error_alta").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
        //name required
        var Especialidad = $("select#especialidad").val();
        if(Especialidad == ""){
            $("#error_alta").fadeIn().text("Debes elegir una especialidad");
            $("select#especialidad").focus();
           
            $("#error_alta").fadeOut(9000);
            return false;
        }
             //name required
             var Medico = $("select#medico").val();
             if(Medico == ""){
                 $("#error_alta").fadeIn().text("Debes elegir un medico");
                 $("select#medico").focus();
                
                 $("#error_alta").fadeOut(9000);
                 return false;
             }
                  //name required
        var Especialidad = $("input#hora").val();
        if(Especialidad == ""){
            $("#error_alta").fadeIn().text("Debes ingresar una hora");
            $("input#hora").focus();
           
            $("#error_alta").fadeOut(9000);
            return false;
        }
 
      
 
        // email required
     
        // ajax
      
    });  
 
    return false;
    });
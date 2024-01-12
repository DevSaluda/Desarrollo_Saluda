$('document').ready(function($){
    
  $.validator.addMethod("Sololetras", function(value, element) {
      return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras");
    $.validator.addMethod("Telefonico", function(value, element) {
      return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar numeros!");
    $.validator.addMethod("Correos", function(value, element) {
      return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo valido!");
   
    $.validator.addMethod("Problema", function(value, element) {
      return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Curps", function(value, element) {
      return this.optional(element) || /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/
      .test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Verifique el curp");
    $.validator.addMethod("RFCC", function(value, element) {
      return this.optional(element) || /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Verifique el RFC");
    $.validator.addMethod("NSSS", function(value, element) {
      return this.optional(element) ||/^(\d{2})(\d{2})(\d{2})\d{5}$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Verifique el NSS");
   
   
  $("#PacientesNuevos").validate({
  rules: {
         
           NombreP:{
              required:true,
              minlength:6,
              maxlength:60,
              Sololetras:"",
           },
            Sexo:{
              required:true,
            },
            Alergias:{
              required:true,
              minlength:2,
              maxlength:60,
             
            }  , 
            fechaNac:{
              required:true,
            },
            Edad:{
              required:true,
            } 
  },
  messages: {
          
    
           NombreP:{
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Limite de caracteres sobrepasado",
              minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Debes ingresar el nombre completo"
           },
            Sexo:
            {
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
            Alergias:{
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Limite de caracteres sobrepasado",
              minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Si el paciente no tiene alergias escribe S/A"
            },
            fechaNac:{
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
            Edad:{
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            }
  },
      submitHandler: submitForm	
});	   
  // hide messages 
 

  function submitForm() {		
    
      
      var nombrep = $('#nombrep').val();
      var fechaNac = $('#fechaNac').val();
      var edad = $('#edad').val();
      var sexo = $('#sexo').val();
      var alergias = $('#alergias').val();
      var telefono = $('#telefono').val();
      var correo = $('#correo').val();
   var empresa = $('#empresa').val();
        var agenda = $('#agenda').val();
        var sistema = $('#sistema').val();
     
  $.ajax({				
    type : 'POST',
          url: "Consultas/AltaPacientes.php",
    data: {
         
            nombrep:nombrep,
            fechaNac:fechaNac,
            edad:edad,
            sexo:sexo,
            alergias:alergias,
              correo:correo,
            telefono:telefono,
            empresa:empresa,
            agenda:agenda,
            sistema:sistema
            
          },
          cache: false,
          beforeSend: function(){	
      $("#success").fadeOut();
      
      $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
     
                  
    },
          success: function(dataResult){
              var dataResult = JSON.parse(dataResult);

              if(dataResult.statusCode==250){
                  var modal_lv = 0;
                  $('.modal').on('shown.bs.modal', function (e) {
                    $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
                    $(e.currentTarget).css('zIndex',1052+modal_lv);
                    modal_lv++
                  });
                  
                  $('.modal').on('hidden.bs.modal', function (e) {
                    modal_lv--
                  });	
                  $("#submit_registro").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
                  $('#ErrorDupli').modal('toggle'); 
                  setTimeout(function(){ 
              }, 2000); // abrir
              setTimeout(function(){ 
                  $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
              }, 3000); // abrir

                 
              }
             
              else if(dataResult.statusCode==200){
                  
                   $("#submit_registro").html("Enviado <i class='fas fa-check'></i>")	
                 
                   $("#PacientesNuevos")[0].reset();
                   $("#AltaDePacientes").removeClass("in");
                   $(".modal-backdrop").remove();
                   $("#AltaDePacientes").hide();
                   CargaAltaPacientes();
                   $('#Exito').modal('toggle'); 
                   setTimeout(function(){ 
                       $('#Exito').modal('hide') 
                   }, 2000); // abrir
                   $("#Exito").show();
                   $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
                   
                  //  Solucionar muestra de modal de exito
                     
                         
              }
              else if(dataResult.statusCode==201){
                  alert("Error occured !");
                  $("#CS").html("Enviar <i class='fas fa-paper-plane'></i>")	
                  // Reemplazar mensaje de error.
               }		
                     
          
                      
        
      
    }
  });
  return false;
}   
});
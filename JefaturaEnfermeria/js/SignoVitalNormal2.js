$('document').ready(function($){
    
    $.validator.addMethod("Sololetras", function(value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
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
     
     
    $("#SignosVitalesCaptura").validate({
    rules: {
           
             Peso:{
                required:true,
               
             },
              Talla:{
                required:true,
              },
              Motivo:{
                required:true,
              },  
              Doctor:{
                required:true,
              },      
              Estado2:{
                required:true,
              },
              municipio:{
                required:true,
              },
              estado:{
                required:true,
              }          
  
  
    },
    messages: {
             Peso:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               Talla:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               Motivo:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               Doctor:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               Estado2:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               municipio:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               estado:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
            
    },
        submitHandler: submitForm	
  });	   
    // hide messages 
   
  
    function submitForm() {		
        var folioo = $('#folioo').val();
        var nombress = $('#nombress').val();
        var edadd = $('#edadd').val();
        var sexoo = $('#sexoo').val();
        var  txtPeso= $('#txtPeso').val();
        var txtTalla = $('#txtTalla').val();
        var imc = $('#imc').val();
        var estado = $('#estado').val();
        var temperatura = $('#temperatura').val();
        var fc = $('#fc').val();
        var fr = $('#fr').val();
        var ta = $('#ta').val();
        var ta2 = $('#ta2').val();
        var sa02 = $('#sa02').val();
        var dxtx = $('#dxtx').val();
        var motivo = $('#motivo').val();
        var doctor = $('#doctor').val();
        var estador = $('#estador').val();
        var municipior = $('#municipior').val();
        var localidadr = $('#localidadr').val();
        var tipov = $('#tipov').val();
        var visita = $('#visita').val();
        var user = $('#user').val();
        var sucursal = $('#sucursal').val();
        var tele = $('#tele').val();
        var correoo = $('#correoo').val();
        var alergias = $('#alergias').val();
        var turno = $('#turno').val();
        var empresa = $('#empresa').val();
        $.ajax({				
      type : 'POST',
            url: "Consultas/GuardaSignos.php",
      data: {
           folioo:folioo,
           nombress:nombress,
           edadd:edadd,
           sexoo:sexoo,
           txtPeso:txtPeso,
           txtTalla:txtTalla,
           imc:imc,
           estado:estado,
           temperatura:temperatura,
           fc:fc,
           fr:fr,
           ta:ta,
           ta2:ta2,
           sa02:sa02,
           dxtx:dxtx,
           motivo:motivo,
           doctor:doctor,
           estador:estador,
           municipior:municipior,
           localidadr:localidadr,
           tipov:tipov,
           visita:visita,
           user:user,
           sucursal:sucursal,
           tele:tele,
           correoo:correoo,
           alergias:alergias,
           turno:turno,
           empresa:empresa
            },
            cache: false,
            beforeSend: function(){	
        $("#success").fadeOut();
        
        $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
       
                    
      },
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    
                     $("#submit_registro").html("Enviado <i class='fas fa-check'></i>")	
                   
                     $("#SignosVitalesCaptura")[0].reset();
                     $('#editModal').modal('hide');
                     $('body').removeClass('modal-open');
                     $('.modal-backdrop').remove();
                     $('#Exito').modal('toggle'); 
                     setTimeout(function(){ 
                         $('#Exito').modal('hide') 
                     }, 2000); // abrir
                    
                            CargaSa();
                     PacientesAgenda();
                    
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
$('document').ready(function($){
  $("#datap").hide();
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
     
     
    $("#ConfPac").validate({
		rules: {
            Folio:{
                required:true,
             },
             Nombres:{
                required:true,
                maxlength:60,
                minlength:3,
                Sololetras:"",
             },
              
		},
		messages: {
            
			
             Folio:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                
             },
             Nombres:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Limite de caracteres sobrepasado",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Un nombre no puede tener solo un caracter"
             },
              
		},
        submitHandler: submitForm	
	});	   
    // hide messages 
   
 
    function submitForm() {		
      

        
		$.ajax({				
			type : 'POST',
            url: "Consultas/Confirmando.php",
			data: {
        id:$('#id').val(),
         nombres:$('#nombres').val(),
         fechaNac:$('#fechaNac').val(),
         edad:$('#edad').val(),
         sexo:$('#sexo').val(),
         alergias:$('#alergias').val(),
         tel:$('#tel').val(),
         correo:$('#correo').val(),
         },
            cache: false,
            beforeSend: function(){	
				$("#success").fadeOut();
				
				$("#submit").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
       
                    
			},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    
                     $("#submit").html("Confirmado <i class='fas fa-check'></i>");	
                       $("#submit").attr('disabled','disabled');
                       $("#ConfPac").hide();
                       $("#TituloModal").html("Captura de signos vitales");
                       $("#datap").show();
                    
                     
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
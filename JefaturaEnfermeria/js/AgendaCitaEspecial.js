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
     
     
    $("#ajax-form").validate({
		rules: {
            Sucursal:{
                required:true,
             },
            Especialidad:{
                required:true,
            },
            Medico:{
                required:true,
             },
             Fecha:{
                required:true,
             },
             Hora:{
                required:true,
             },
             Costo:{
                required:true,
             },
             NombreP:{
                required:true,
                minlength:2,
                maxlength:60,
                Sololetras:"",
             },
                        Telefono:{
                            required:true,
                            minlength:10,
                            maxlength:10,
                            Telefonico:"",
                        },
                        TipoConsulta:{
                            required:true,
                         },
                         Colorpago:{
                            required:true,
                         },
                         Colorcita:{
                            required:true,
                         },
		},
		messages: {
            
			Sucursal:{
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
         
            
             },
             Especialidad:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
             Medico:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
             Fecha:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
             Hora:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
             Costo:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
             NombreP:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Limite de caracteres sobrepasado",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Un nombre no puede tener solo un caracter"
             },
              Telefono:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El numero de telefono no puede tener mas de 10 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Debes ingresar los 10 caracteres del numero de telefono"
              },
              TipoConsulta:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
             Colorpago:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
             Colorcita:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
             },
		},
        submitHandler: submitForm	
	});	   
    // hide messages 
   
 
    function submitForm() {		
        var sucursal = $('#sucursal').val();
        var especialidad = $('#especialidad').val();
        var medico = $('#medico').val();
        var fecha = $('#fecha').val();
        var hora = $('#hora').val();
        var costo = $('#costo').val();
        var nombrep = $('#nombrep').val();
        var telefono = $('#telefono').val();
        var tipoconsulta = $('#tipoconsulta').val();
          var colorpago = $('#colorpago').val();
          var colorcita = $('#colorcita').val();
          var observaciones = $('#observaciones').val();
          var estatuspago = $('#estatuspago').val();
          var estatuscita = $('#estatuscita').val();
          var estatussegui = $('#estatussegui').val();
          var colorsegui = $('#colorsegui').val();
          var empresa = $('#empresa').val();
          var agenda = $('#agenda').val();
          var sistema = $('#sistema').val();
       
		$.ajax({				
			type : 'POST',
            url: "Consultas/AgendaCita.php",
			data: {
              sucursal:sucursal,
              especialidad:especialidad,
              medico:medico,
              fecha:fecha,
              hora:hora,
              costo:costo,
              nombrep:nombrep,
              telefono:telefono,
              tipoconsulta:tipoconsulta,
              colorpago:colorpago,
              colorcita:colorcita,
              observaciones:observaciones,
              estatuspago:estatuspago,
              estatuscita:estatuscita,
              estatussegui:estatussegui,
              colorsegui:colorsegui,
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
                if(dataResult.statusCode==200){
                    
                     $("#submit_registro").html("Enviado <i class='fas fa-check'></i>")	
                   
                     $("#ajax-form")[0].reset();
                     $("#AltaAgenda").removeClass("in");
                     $(".modal-backdrop").remove();
                     $("#AltaAgenda").hide();
                     CargaCampanas();
                     $('#Exito').modal('toggle'); 
                     setTimeout(function(){ 
                         $('#Exito').modal('hide') 
                     }, 2000); // abrir
                     $("#Exito").show();
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
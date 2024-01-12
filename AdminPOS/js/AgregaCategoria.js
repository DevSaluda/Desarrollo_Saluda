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
     
     
    $("#AgregaCategoriaNueva").validate({
		rules: {
           
            NombreCategoria:{
                required:true,
                minlength:5,
                maxlength:60,
                Sololetras:"",
             },
             Vigencia:{
              required:true,
             
           },
            
              
		},
		messages: {
            
			
            NombreCategoria :{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Limite de caracteres sobrepasado",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Un nombre no puede tener solo un caracter"
             },
             Vigencia :{
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
              
		},
        submitHandler: submitForm	
	});	   
    // hide messages 
   
 
    function submitForm() {		
      
        
        var nombrecategoria = $('#nombrecategoria').val();
        var vigencia = $('#vigencia').val();
        var usuario = $('#usuario').val();
        var vigenciaest = $('#vigenciaest').val();
     var empresa = $('#empresa').val();
      
          var sistema = $('#sistema').val();
       
		$.ajax({				
			type : 'POST',
            url: "Consultas/AltaCategorias.php",
			data: {
           
             nombrecategoria:nombrecategoria,
              vigencia:vigencia,
              usuario:usuario,
              vigenciaest:vigenciaest,
           
              empresa:empresa,
        
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
                   
                     $("#AgregaCategoriaNueva")[0].reset();
                     $("#AltaCategorias").removeClass("in");
                     $(".modal-backdrop").remove();
                     $("#AltaCategorias").hide();
                     CargaCategorias();
                     $('#Exito').modal('toggle'); 
                     setTimeout(function(){ 
                         $('#Exito').modal('hide') 
                     }, 2000); // abrir
                     $("#Exito").show();
                    
                     
                    //  Solucionar muestra de modal de exito
                       
                           
                }
                else if(dataResult.statusCode==201){
                  $("#submit_Age").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
                  $('#ErrorData').modal('toggle'); 
                  setTimeout(function(){ 
              }, 2000); // abrir
              setTimeout(function(){ 
                  $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
              }, 3000); // abrir
                 
               
                 }		
                       
						
                        
					
				
			}
		});
		return false;
	}   
});
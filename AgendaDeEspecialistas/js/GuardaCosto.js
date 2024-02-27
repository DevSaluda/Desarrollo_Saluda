$('document').ready(function($){
    $.validator.addMethod("Sololetras", function(value, element) {
        return this.optional(element) || /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
        
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
     
    $("#AltaDeCostos").validate({
        rules: {
            Nombres:{
                required:true,
                minlength: 2,
                maxlength: 40,
                Sololetras: "",
            },
           AltaCosto:{
               required:true,
           },
            Sucursal:{
               required:true,
              
            },
            Correo:{
             
                Correos: "",
            },
            Tel:{
                required:true,
                minlength: 1,
                maxlength: 10,
                Telefonico: "",
            }
            
 
 
   },
   messages: {
    Nombres:{
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
        maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El limite es 55 caracteres",
        minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Un nombre no puede tener solo 1 caracter"
      
       },
    AltaCosto:{
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
       },
            Sucursal:{
               required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              },
              Correo:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El limite es 55 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Un nombre no puede tener solo 1 caracter"
              },
              Tel:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El numero de telefono no puede tener mas de 10 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Si el AltaCosto no tiene telefono solo escribe un cero"
            
              }
            
           
   },
       submitHandler: submitForm	
 });	   
   // hide messages 
   
 
    function submitForm() {		
        var sucursal= $('#sucursal').val();
        var especialidad= $('#especialidad').val();
        var medico= $('#medico').val();
        var costo= $('#costo').val();
     var empresa = $('#empresa').val();
        var usuario = $('#usuario').val();

		
		$.ajax({				
			type : 'POST',
            url: "Consultas/GuardaCostos.php",
			data: {
            especialidad:especialidad,
              sucursal:sucursal,
          medico:medico,
          costo:costo,
               empresa:empresa,
               usuario:usuario

            },
            cache: false,
            beforeSend: function(){	
				
				
				$("#submit_registro").html("Un momento... <i class='fas fa-check'></i>");
                
                    
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
                    
                        $("#AltaDeCostos")[0].reset();
                                            $("#submit_registro").html("Completo <i class='fas fa-check'></i>");
                                            $("#AltaCosto").removeClass("in");
                                            $(".modal-backdrop").remove();
                                            $("#AltaCosto").hide();
                                            $('#Exito').modal('toggle');
                                                CargaCostos();
                                            setTimeout(function(){ 
                                                $('#Exito').modal('hide') 
                                            }, 2000); // abrir
                                            setTimeout(function(){ 
                                                $('#AgregarMasCostos').modal('show') 
                                            }, 2000); // abrir
                                            $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
                                                
                                        }
                                        else if(dataResult.statusCode==201){
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
                                            $('#ErrorData').modal('toggle'); 
                                            setTimeout(function(){ 
                                        }, 2000); // abrir
                                        setTimeout(function(){ 
                                            $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
                                        }, 3000); // abrir
                                           
                                         }		
                                               
                
                       
						
                        
					
				
			}
		});
		return false;
	}   
});

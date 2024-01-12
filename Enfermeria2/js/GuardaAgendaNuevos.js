$('document').ready(function($){
   
    $("#AgendaNuevoPaciente").validate({
        rules: {
            Folio:{
            requiered:true, 
            } ,
            Sucursal:{
                required:true,
               
             },
             
           editModal:{
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
            TipoConsulta:{
                required:true
            },

   },
   messages: {
       Folio:{
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
       },

    editModal:{
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
       },
            Sucursal:{
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
               TipoConsulta:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
   },
       submitHandler: submitForm	
 });	   
   // hide messages 
   
 
    function submitForm() {		
        var folio= $('#folio').val();
        var nombres= $('#nombres').val();
        var sucursal= $('#sucursal').val();
        var especialidad= $('#especialidad').val();
        var medico= $('#medico').val();
        var fecha= $('#fecha').val();
        var hora= $('#hora').val();
        var costo= $('#costo').val();
        var tipoconsulta= $('#tipoconsulta').val();
        var observaciones= $('#observaciones').val();
   var empresa = $('#empresa').val();
        var usuario = $('#usuario').val();
        var sistema = $('#sistema').val();
		
		$.ajax({				
			type : 'POST',
            url: "Consultas/GuardaCitaPacienteNuevo.php",
			data: {
                folio:folio,
                nombres:nombres,
                sucursal:sucursal,
                especialidad:especialidad,
           medico:medico,
           fecha:fecha,
           hora:hora,
           costo:costo,
           tipoconsulta:tipoconsulta,
           observaciones:observaciones,
               empresa:empresa,
               usuario:usuario,
               sistema:sistema

            },
            cache: false,
            beforeSend: function(){	
				
				
				$("#submit_Age").html("Un momento... <i class='fas fa-check'></i>");
                
                    
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
                    $("#submit_Age").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
                    $('#ErrorDupli').modal('toggle'); 
                    setTimeout(function(){ 
                }, 2000); // abrir
                setTimeout(function(){ 
                    $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
                }, 3000); // abrir

                   
                }
               
                   else if(dataResult.statusCode==200){
                    
                     
                                            $("#submit_Age").html("Completo <i class='fas fa-check'></i>");
                                            $("#editModal").removeClass("in");
                                            $(".modal-backdrop").remove();
                                            $("#editModal").hide();
                                            $('#Exito').modal('toggle'); 
                                           
                                            setTimeout(function(){ 
                                                $('#Exito').modal('hide') 
                                            }, 2000); // abrir
                                           
                                            $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
                                            setTimeout(function(){ 
                                                $('#EspereA').modal('show') 
                                            }, 2000); // abrir
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

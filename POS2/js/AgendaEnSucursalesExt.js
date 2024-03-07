$('document').ready(function($){
   
    $("#AgendaExterno").validate({
        rules: {
            NombresExt:{
                required:true, 
            } ,
            TelExt:{
                required:true,
               
             },
             
             SucursalExt:{
               required:true,
           },
           EspecialidadExt:{
               required:true,
           },
           FechaExt:{
             required:true,
         },
         HorasExt:{
                required:true,
            },
            MedicoExt:{
                required:true,
            },
            

   },
   messages: {
       NombresExt:{
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Debes escribir el nombre del paciente por favor ",
       },

    TelExt:{
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
       },
       SucursalExt:{
               required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              },
              EspecialidadExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               }, 
               FechaExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               MedicoExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               
               
   },
       submitHandler: submitForm	
 });	   
   // hide messages 
   
 
    function submitForm() {		
      
		
		$.ajax({				
			type : 'POST',
            url: "Consultas/AgendaCitaEnSucursalExtV1.php",
            data: $('#AgendaExterno').serialize(),
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
                                            $("#CitaExt").removeClass("in");
                                            $(".modal-backdrop").remove()
                                            $("#CitaExt").hide();
                                            $("#AgendaExterno")[0].reset();
                                            $('#AgendamientoExitoso').modal('toggle')
                                            setTimeout(function(){ 
                                                $('#AgendamientoExitoso').modal('hide') 
                                          
                                            }, 3000); // abrir
                                           
                                            $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
                                           
                                            CargaCitasEnSucursalExt();


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

$('document').ready(function($){
    
    $("#AltaSucursal").validate({
        rules: {
           
            Sucursal:{
               required:true,
              
            },
            messages: {
                Sucursal:{
                   required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                  },
                 
       },
        },
        submitHandler: submitForm	
	});	   
    // hide messages 
   
 
    function submitForm() {		
        var usuario= $('#usuario').val();
        var log= $('#log').val();
        var sistema = $('#sistema').val();
        var empresa = $('#empresa').val();
		
		$.ajax({				
			type : 'POST',
            url: "Consultas/GuardaSucursal.php",
			data: {
               usuario:usuario,
               log:log,
               sistema:sistema,
               empresa:empresa

            },
            cache: false,
            beforeSend: function(){	
				
				
				$("#CS").html("Bienvenido <i class='fas fa-check'></i>");
                
                    
			},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                        $('#CS').attr("disabled", true);
                        setTimeout(function(){ 
                            $('#Ingreso').modal('hide') 
                        }, 3000); 
                }
                else if(dataResult.statusCode==201){
                    alert("No se cargaron todos los datos, contacta a soporte.");
                   
                 }		
                       
						
                        
					
				
			}
		});
		return false;
	}   
});


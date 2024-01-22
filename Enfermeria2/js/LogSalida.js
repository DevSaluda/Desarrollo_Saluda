$('document').ready(function($){
    
    
   
    $("#Salida").validate({
		
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
			url  : 'Consultas/Logs.php',
			data: {
               usuario:usuario,
               log:log,
               sistema:sistema,
               empresa:empresa

            },
            cache: false,
            beforeSend: function(){	
				
				
				$("#CS").html("Cerrando sesión <i class='fas fa-check'></i>");
               
                    
			},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                        $('#CS').attr("disabled", true);
                        setTimeout(' window.location.href = "https://controlconsulta.com/Enfermeria2/Cierre"; ',2000);
                }
                else if(dataResult.statusCode==201){
                    alert("No se cargaron todos los datos, contacta a soporte.");
                   
                 }		
                       
						
                        
					
				
			}
		});
		return false;
	}   
});
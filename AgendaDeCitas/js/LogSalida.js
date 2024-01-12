$('document').ready(function($){
    
    
   
    $("#Logsalidas").validate({
		
        submitHandler: submitForm	
	});	   
    // hide messages 
   
 
    function submitForm() {	
        $.ajax({	
        type: 'POST',
        url  : 'Consultas/Logs2.php',
        data: $('#Logsalidas').serialize(),
        cache: false,
        beforeSend: function(){	
		
		
				
				
				$("#CS").html("Cerrando sesión <i class='fas fa-check'></i>");
               
                    
			},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                        $('#CS').attr("disabled", true);
                        setTimeout(' window.location.href = "https://controlfarmacia.com/ControldecitasV2/Cierre"; ',2000);
                }
                else if(dataResult.statusCode==201){
                    alert("No se cargaron todos los datos, contacta a soporte.");
                   
                 }		
                       
						
                        
					
				
			}
		});
		return false;
	}   
});
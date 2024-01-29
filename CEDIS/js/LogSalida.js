$('document').ready(function($){
    
    
   
    $("#Logsale").validate({
		
        submitHandler: submitForm	
	});	   
    // hide messages 
   
 
    function submitForm() {		
        var usuarioo= $('#usuarioo').val();
        var logg= $('#logg').val();
        var sistemaa = $('#sistemaa').val();
        var empresaa = $('#empresaa').val();
		
		$.ajax({				
			type : 'POST',
			url  : 'Consultas/LogsSalida.php',
			data: {
               usuarioo:usuarioo,
               logg:logg,
               sistemaa:sistemaa,
               empresaa:empresaa

            },
            cache: false,
            beforeSend: function(){	
				
				
				$("#CS").html("Cerrando sesión <i class='fas fa-check'></i>");
               
                    
			},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                        $('#CS').attr("disabled", true);
                        setTimeout(' window.location.href = "https://saludapos.com/CEDIS/Cierre"; ',2000);
                }
                else if(dataResult.statusCode==201){
                    alert("No se cargaron todos los datos, contacta a soporte.");
                   
                 }		
                       
						
                        
					
				
			}
		});
		return false;
	}   
});
$('document').ready(function($){
    
    
    $('#CS').hide();
    setTimeout(function(){ 
        $('#Carga').hide() 
    }, 3000); 
    setTimeout(function(){ 
        $('#CS').show() 
    }, 4000); 
    $("#Logs").validate({
		
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
$('document').ready(function ($) {
    $('#CS').hide();
    


   
    setTimeout(function(){ 
        $('#Carga').hide() 
    }, 3000); 
    setTimeout(function(){ 
        $('#CS').show() 
    }, 4000); 
    $("#Logs").validate({
		
        rules: {


            ActNomCat: {
                required: true,
            },
           
           ActVigenciaCat: {
                required: true,
            }
        },
        messages: {



            ActNomCat: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Limite de caracteres sobrepasado",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Un nombre no puede tener solo un caracter"
            },
         
           ActVigenciaCat: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Dato Requerido ",
            },
           

        },
        submitHandler: submitForm
    });
    // hide messages 


    function submitForm() {



        $.ajax({
            type: 'POST',
            url  : 'Consultas/Logs.php',
            data: $('#Logs').serialize(),
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


$('document').ready(function($){
    
    $("#AgregaSucursal").validate({
        rules: {
           
            Sucursal:{
               required:true,
              
            },
            
 
 
   },
   messages: {
            Sucursal:{
               required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              },
            
           
   },
       submitHandler: submitForm	
 });	   
   // hide messages 
   
 
    function submitForm() {		
        var sucursal= $('#sucursal').val();
        var nsucursal= $('#nsucursal').val();
        var empresa = $('#empresa').val();
        var usuario = $('#usuario').val();

		
		$.ajax({				
			type : 'POST',
            url: "Consultas/GuardaSucursalC.php",
			data: {
              
              sucursal:sucursal,
              nsucursal:nsucursal,
               empresa:empresa,
               usuario:usuario

            },
            cache: false,
            beforeSend: function(){	
				
				
				$("#submit_registro").html("Un momento... <i class='fas fa-check'></i>");
                
                    
			},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    
$("#AgregaSucursal")[0].reset();
                    $("#submit_registro").html("Completo <i class='fas fa-check'></i>");
                    $("#AltaSucursal").removeClass("in");
                    $(".modal-backdrop").remove();
                    $("#AltaSucursal").hide();
                    $('#Exito').modal('toggle'); 
                     CargaSucursalesC();
                    setTimeout(function(){ 
                        $('#Exito').modal('hide') 
                    }, 2000); // abrir
                    setTimeout(function(){ 
                        $('#AgregarMasucursal').modal('show') 
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


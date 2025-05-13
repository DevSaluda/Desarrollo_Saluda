
$('document').ready(function() {	
        $('#especialidad').on('change', function(){

        $('#ValidaEspecialidad').html('<img src="Imagenes/loader.gif"  />').fadeOut(1000);
        var sucursal = $(this).val();		
        var especialidad = $(this).val();		
      
       
        $.ajax({
            type: "POST",
            url: "Validaciones/Especialidades.php",
            data: {
                especialidad: especialidad,
                sucursal:sucursal
               
            },
                success: function(data) {
                $('#ValidaEspecialidad').fadeIn(1000).html(data);
                
            }
        });
    
});              
});    

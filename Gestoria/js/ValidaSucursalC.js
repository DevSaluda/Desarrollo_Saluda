
$('document').ready(function() {	
    $('#sucursal').on('change', function(){
    
        $('#ValidaSucursal').html('<img src="Imagenes/loader.gif"  />').fadeOut(1000);

        var sucursal = $(this).val();		
        var dataString = 'sucursal='+sucursal;

        $.ajax({
            type: "POST",
            url: "Validaciones/ValidaSucursalC.php",
            data: dataString,
            success: function(data) {
                $('#ValidaSucursal').fadeIn(1000).html(data);
                
            }
        });
    });              
});    


$('document').ready(function() {	
    $('#sucursal').on('change', function(){
    
        $('#submit_registro').html("Un momento, por favor <i class='fas fa-sync fa-spin'></i>")

        var sucursal = $(this).val();		
        var dataString = 'sucursal='+sucursal;

        $.ajax({
            type: "POST",
            url: "Validaciones/ValidaSucursalC.php",
            data: dataString,
            success: function(data) {
                $('#ValidaSucursal').fadeIn(1000).html(data);
                $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
                
            }
        });
    });              
});    

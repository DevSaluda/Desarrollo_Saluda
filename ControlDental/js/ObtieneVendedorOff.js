$('document').ready(function(){
    $('#sucursalvendedoroff').on('change', function(){
            if($('#sucursalvendedoroff').val() == ""){
                $('#vendedoroff').empty();
                $('<option value = "">Selecciona un vendedor</option>').appendTo('#vendedoroff');
                $('#vendedoroff').attr('disabled', 'disabled');
            }else{
                $('#vendedoroff').removeAttr('disabled', 'disabled');
                $('#vendedoroff').load('Consultas/Obtienevendedoroff.php?sucursalvendedoroff=' + $('#sucursalvendedoroff').val());
                          }
    });
});
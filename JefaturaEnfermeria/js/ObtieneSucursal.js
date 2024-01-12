$('document').ready(function(){
    $('#medico').on('change', function(){
            if($('#medico').val() == ""){
                $('#sucursal').empty();
                $('<option value = "">Selecciona una sucursal</option>').appendTo('#sucursal');
                $('#sucursal').attr('disabled', 'disabled');
            }else{
                $('#sucursal').removeAttr('disabled', 'disabled');
                $('#sucursal').load('Consultas/ObtieneSucursal.php?medico=' + $('#medico').val());
            }
    });
});
$('document').ready(function(){
    $('#sucursal').on('change', function(){
            if($('#sucursal').val() == ""){
                $('#medico').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#medico');
                $('#medico').attr('disabled', 'disabled');
            }else{
                $('#medico').removeAttr('disabled', 'disabled');
                $('#medico').load('Consultas/ObtieneMedicosSucursales.php?sucursal=' + $('#sucursal').val());
                
            }
    });
});
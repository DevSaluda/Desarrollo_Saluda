$('document').ready(function(){
    $('#sucursalvendedor').on('change', function(){
            if($('#sucursalvendedor').val() == ""){
                $('#vendedorafiltrar').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#vendedorafiltrar');
                $('#vendedorafiltrar').attr('disabled', 'disabled');
            }else{
                $('#vendedorafiltrar').removeAttr('disabled', 'disabled');
                $('#vendedorafiltrar').load('Consultas/Obtienevendedorafiltrar.php?sucursalvendedor=' + $('#sucursalvendedor').val());
                
            }
    });
});
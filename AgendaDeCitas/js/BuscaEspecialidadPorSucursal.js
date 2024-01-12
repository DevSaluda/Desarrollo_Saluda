$('document').ready(function(){
    $('#SucEs').on('change', function(){
            if($('#SucEs').val() == ""){
                $('#especialidadsuc').empty();
                $('<option value = "">Selecciona un especialidad</option>').appendTo('#especialidadsuc');
                $('#especialidadsuc').attr('disabled', 'disabled');
            }else{
                $('#especialidadsuc').removeAttr('disabled', 'disabled');
                $('#especialidadsuc').load('Consultas/ObEspecialidadSucursal.php?SucEs=' + $('#SucEs').val());
                
            }
    });
});
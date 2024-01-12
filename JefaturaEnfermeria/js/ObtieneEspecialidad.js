$('document').ready(function(){
    $('#sucursal').on('change', function(){
            if($('#sucursal').val() == ""){
                $('#especialidad').empty();
                 
                $('<option value = "">Selecciona una especialidad</option>').appendTo('#especialidad');
                $('#especialidad').attr('disabled', 'disabled');
            }else{
                $('#especialidad').removeAttr('disabled', 'disabled');
                $('#especialidad').load('Consultas/ObtieneEspecialidad.php?sucursal=' + $('#sucursal').val());
                
              
                          }
    });
});
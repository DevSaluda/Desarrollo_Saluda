$('document').ready(function(){
    $('#municipio').on('change', function(){
            if($('#municipio').val() == ""){
                $('#localidad').empty();
                $('<option value = "">Selecciona una localidad</option>').appendTo('#localidad');
                $('#localidad').attr('disabled', 'disabled');
            }else{
                $('#localidad').removeAttr('disabled', 'disabled');
                $('#localidad').load('Consultas/Obtienelocalidad.php?municipio=' + $('#municipio').val());
            }
    });
});
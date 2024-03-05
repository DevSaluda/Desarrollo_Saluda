$('document').ready(function(){
    $('#estado').on('change', function(){
            if($('#estado').val() == ""){
                $('#municipio').empty();
                $('<option value = "">Selecciona un municipio</option>').appendTo('#municipio');
                $('#municipio').attr('disabled', 'disabled');
            }else{
                $('#municipio').removeAttr('disabled', 'disabled');
                $('#municipio').load('Consultas/Obtienemunicipio.php?estado=' + $('#estado').val());
            }
    });
});
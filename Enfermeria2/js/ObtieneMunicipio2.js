$('document').ready(function(){
    $('#estado2').on('change', function(){
            if($('#estado2').val() == ""){
                $('#municipio').empty();
                $('<option value = "">Selecciona un municipio</option>').appendTo('#municipio');
                $('#municipio').attr('disabled', 'disabled');
            }else{
                $('#municipio').removeAttr('disabled', 'disabled');
                $('#municipio').load('Consultas/Obtienemunicipio.php?estado=' + $('#estado2').val());
            }
    });
});
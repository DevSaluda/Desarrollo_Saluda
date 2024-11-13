$('document').ready(function(){
    $('#sucursalExt').on('change', function(){
            if($('#fechaExt').val() == ""){
                $('#horasExt').empty();
                $('<option value = "">Selecciona un fecha</option>').appendTo('#horasExt');
                $('#horasExt').attr('disabled', 'disabled');
            }else{
                $('#horasExt').removeAttr('disabled', 'disabled');
                $('#horasExt').load('Consultas/ObtienehorasssExt.php?fechaExt=' + $('#fechaExt').val());
                
            }
    });
});

$('document').ready(function(){
    $('#sucursalExt').on('change', function(){
            if($('#medicoExt').val() == ""){
                $('#fechaExt').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#fechaExt');
                $('#fechaExt').attr('disabled', 'disabled');
            }else{
                $('#fechaExt').removeAttr('disabled', 'disabled');
                $('#fechaExt').load('Consultas/ObtieneFechassExt.php?medicoExt=' + $('#medicoExt').val());
                
            }
    });
});








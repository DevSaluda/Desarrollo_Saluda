$('document').ready(function(){
    $('#fechaExt').on('change', function(){
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




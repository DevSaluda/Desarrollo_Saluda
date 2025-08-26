$('document').ready(function(){
    $('#medicoExt').on('change', function(){
            if($('#medicoExt').val() == ""){
                $('#fechaExt').empty();
                $('<option value = "">Selecciona un medico</option>').appendTo('#fechaExt');
                $('#fechaExt').attr('disabled', 'disabled');
            }else{
                $('#fechaExt').removeAttr('disabled', 'disabled');
                $('#fechaExt').load('Consultas/ObtieneFechassExt.php?medicoExt=' + $('#medicoExt').val(), function() {
                    // Después de cargar las fechas, verificar si solo hay una opción
                    var opciones = $('#fechaExt option');
                    if (opciones.length === 2) { // 1 opción + la opción por defecto
                        // Solo hay una fecha disponible, seleccionarla automáticamente
                        $('#fechaExt').val($('#fechaExt option:last').val());
                        // Disparar el evento change para cargar las horas
                        $('#fechaExt').trigger('change');
                    }
                });
                
            }
    });
});




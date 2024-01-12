$('document').ready(function () {
    $('#promocionva').on('change', function () {
        if ($('#promocionva').val() == "") {
            $('#descuentova').empty();
            $('<option value = "">Selecciona un promoción</option>').appendTo('#descuentova');
            $('#descuentova').attr('disabled', 'disabled');
        } else {
            $('#descuentova').removeAttr('disabled', 'disabled');
            $('#descuentova').load('Consultas/ObtieneValorDescuento.php?promocionva=' + $('#promocionva').val());

        }
    });
});


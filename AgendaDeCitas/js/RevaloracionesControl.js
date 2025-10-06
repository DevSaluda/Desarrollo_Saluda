
function CargaRevaloraciones() {
    $.post("https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadasVista.php", "", function(data) {
        $("#RevaloracionesAgendadas").html(data);
    })
}
CargaRevaloraciones();



function CargaRevaloraciones() {


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#RevaloracionesAgendadas").html(data);
    })

}



CargaRevaloraciones();
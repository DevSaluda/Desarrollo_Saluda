function CargaRevaloraciones() {


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}



CargaRevaloraciones();
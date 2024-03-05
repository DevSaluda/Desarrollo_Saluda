function CargaRevaloraciones() {


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/RevaloracionesAgendadasSemanal.php", "", function(data) {
        $("#CitasDeRevaloracionSemanal").html(data);
    })

}



CargaRevaloraciones();
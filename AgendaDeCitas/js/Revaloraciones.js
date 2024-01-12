function CargaRevaloraciones() {


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}



CargaRevaloraciones();
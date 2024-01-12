function CargaRevaloraciones() {


    $.post("https://controlfarmacia.com/POS2/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}



CargaRevaloraciones();
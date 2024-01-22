function CargaRevaloraciones() {


    $.post("https://saludapos.com/POS2/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}



CargaRevaloraciones();
function CargaRevaloraciones() {


    $.post("https://saludapos.com/Enfermeria2/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}



CargaRevaloraciones();
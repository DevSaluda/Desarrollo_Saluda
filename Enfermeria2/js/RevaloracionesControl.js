function CargaRevaloraciones() {


    $.post("https://controlfarmacia.com/Enfermeria2/Consultas/RevaloracionesAgendadas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}



CargaRevaloraciones();
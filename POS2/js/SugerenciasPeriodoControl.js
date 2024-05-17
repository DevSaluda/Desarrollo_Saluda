function CargaRevaloraciones() {


    $.post("https://saludapos.com/POS2/Consultas/SugerenciasPorPeriodo.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();



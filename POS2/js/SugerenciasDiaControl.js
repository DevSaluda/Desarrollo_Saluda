function CargaRevaloraciones() {


    $.post("https://saludapos.com/POS2/Consultas/SugerenciasPorDia.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();



function CargaRevaloraciones() {


    $.post("https://saludapos.com/POS2/Consultas/SugerenciasPedidosPeriodo.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();



function CargaRevaloraciones() {


    $.post("https://saludapos.com/POS2/Consultas/SugerenciasPedidosDIas.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();



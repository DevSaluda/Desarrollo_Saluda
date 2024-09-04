function CargaRevaloraciones() {


    $.post("https://saludapos.com/POS2/Consultas/SugerenciasPedidos.php", "", function(data) {
        $("#CitasDeRevaloracion").html(data);
    })

}
CargaRevaloraciones();



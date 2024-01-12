function CargaProductos() {


    $.get("https://controlfarmacia.com/CEDISMOVIL/Consultas/ListaTraspasosPartner.php", "", function(data) {
        $("#tablaProductos").html(data);
    })

}



CargaProductos();
function CargaVentasDelDia() {


    $.post("https://saludapos.com/AdminPOS/Consultas/InventarioRapidoResultados.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



CargaVentasDelDia();
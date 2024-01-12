function CargaVentasDelDia() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/InventarioRapidoResultados.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



CargaVentasDelDia();
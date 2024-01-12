function CargaVentasDelDia() {


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/InventarioRapidoResultados.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



CargaVentasDelDia();
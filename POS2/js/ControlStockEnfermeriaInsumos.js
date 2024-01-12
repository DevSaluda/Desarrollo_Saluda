function StockPorSucursales() {


    $.post("https://controlfarmacia.com/POS2/Consultas/StockDeEnfermeria.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
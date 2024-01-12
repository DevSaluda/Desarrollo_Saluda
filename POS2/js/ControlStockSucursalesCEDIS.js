function StockPorSucursales() {


    $.post("https://controlfarmacia.com/POS2/Consultas/StockSucursalesV3.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
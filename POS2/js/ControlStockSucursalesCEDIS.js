function StockPorSucursales() {


    $.post("https://saludapos.com/POS2/Consultas/StockSucursalesV3.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
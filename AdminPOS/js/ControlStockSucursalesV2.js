function StockPorSucursales() {


    $.post("https://saludapos.com/AdminPOS/Consultas/StockSucursalesV2.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
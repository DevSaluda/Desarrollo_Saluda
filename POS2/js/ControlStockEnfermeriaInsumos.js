function StockPorSucursales() {


    $.post("https://saludapos.com/POS2/Consultas/StockDeEnfermeria.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
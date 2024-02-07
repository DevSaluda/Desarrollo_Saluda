function StockPorSucursales() {


    $.post("https://saludapos.com/AdminPOS/Consultas/StockDeEnfermeria.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
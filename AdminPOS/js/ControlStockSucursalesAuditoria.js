function StockPorSucursales() {


    $.post("https://saludapos.com/AdminPOS/Consultas/StockSucursalesAuditorias.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
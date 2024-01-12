function StockPorSucursales() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/StockDeEnfermeria.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
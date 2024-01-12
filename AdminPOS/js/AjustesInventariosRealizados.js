function StockPorSucursales() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/AjustesRealizados.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
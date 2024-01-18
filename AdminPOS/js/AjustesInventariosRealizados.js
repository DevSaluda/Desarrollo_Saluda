function StockPorSucursales() {


    $.post("https://saludapos.com/AdminPOS/Consultas/AjustesRealizados.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
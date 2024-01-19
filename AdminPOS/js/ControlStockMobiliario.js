function StockMobiliario() {


    $.post("https://saludapos.com/AdminPOS/Consultas/StockMobiliarioDisponibles.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockMobiliario();
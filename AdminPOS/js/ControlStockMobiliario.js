function StockMobiliario() {


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/StockMobiliarioDisponibles.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockMobiliario();
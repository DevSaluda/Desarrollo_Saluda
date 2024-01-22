function StockPorSucursales() {


    $.post("https://saludapos.com/CEDISMOVIL/Consultas/StockDeSucursalesFarmacias.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
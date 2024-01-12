function StockPorSucursales() {


    $.post("https://controlfarmacia.com/CEDISMOVIL/Consultas/StockDeSucursalesFarmacias.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
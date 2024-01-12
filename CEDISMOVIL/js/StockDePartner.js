function StockPorSucursales() {


    $.post("https://controlfarmacia.com/CEDISMOVIL/Consultas/StockDePartNer.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
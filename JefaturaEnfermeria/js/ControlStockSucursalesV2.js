function StockPorSucursales() {


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/StockSucursalesV2.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
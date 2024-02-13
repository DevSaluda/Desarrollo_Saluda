function StockPorSucursales() {


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/StockSucursalesV2.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
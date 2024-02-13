function StockPorSucursales() {


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/StockDeEnfermeria.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
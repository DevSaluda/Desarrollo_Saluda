function StockPorSucursales() {


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/StockDeEnfermeria.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
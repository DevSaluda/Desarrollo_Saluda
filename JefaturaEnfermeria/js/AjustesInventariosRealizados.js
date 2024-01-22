function StockPorSucursales() {


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/AjustesRealizados.php", "", function(data) {
        $("#TableStockSucursales").html(data);
    })

}



StockPorSucursales();
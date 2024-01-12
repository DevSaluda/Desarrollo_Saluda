function  StockPorSucursales(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/StockSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();
function  StockPorSucursales(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/StockSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();
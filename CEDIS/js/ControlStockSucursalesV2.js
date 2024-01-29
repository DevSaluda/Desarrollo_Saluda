function  StockPorSucursales(){


    $.post("https://saludapos.com/CEDIS/Consultas/StockSucursalesV2.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();
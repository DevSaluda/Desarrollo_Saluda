function  StockPorSucursales(){


    $.post("https://saludapos.com/CEDIS/Consultas/StockEntradas.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();
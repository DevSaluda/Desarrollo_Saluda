function  StockPorSucursales(){


    $.post("https://saludapos.com/CEDIS/Consultas/StockSucursales.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();
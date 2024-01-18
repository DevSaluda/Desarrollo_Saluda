function  StockPorSucursales(){


    $.post("https://saludapos.com/CEDIS/Consultas/StockCedis.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();
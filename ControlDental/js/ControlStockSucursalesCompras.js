function  StockPorSucursales(){


    $.post("https://saludapos.com/AdminPOS/Consultas/StockSucursalesCompras.php","",function(data){
      $("#TableStockSucursales").html(data);
    })

  }
  
  
  
  StockPorSucursales();